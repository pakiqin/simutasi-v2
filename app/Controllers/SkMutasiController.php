<?php

namespace App\Controllers;

use App\Models\UsulanModel;
use App\Models\SkMutasiModel;
use CodeIgniter\Controller;

class SkMutasiController extends Controller
{
    protected $usulanModel;
    protected $skMutasiModel;
    
    public function __construct()
    {
        $this->usulanModel = new UsulanModel();
        $this->skMutasiModel = new SkMutasiModel();
    }

    public function index()
    {
        $role = session()->get('role');
        $userId = session()->get('id');

        if ($role === 'operator') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $db = \Config\Database::connect();
        $cabangDinasIds = [];

        if ($role === 'dinas') {
            $cabangDinasQuery = $db->table('operator_cabang_dinas')
                ->select('cabang_dinas_id')
                ->where('user_id', $userId)
                ->get()
                ->getResultArray();
            $cabangDinasIds = array_column($cabangDinasQuery, 'cabang_dinas_id');
        }

        // Ambil jumlah data per halaman dari request
        $perPageKiri = $this->request->getGet('perPageKiri') ?? 10;
        $perPageKanan = $this->request->getGet('perPageKanan') ?? 10;

        $queryKiri = $this->usulanModel
            ->select('usulan.*')
            ->where('usulan.status', '06')
            ->orderBy('usulan.created_at', 'ASC');

        $usulanKiri = $queryKiri->paginate($perPageKiri, 'usulanKiri');
        $pagerKiri = $this->usulanModel->pager;

        $queryKanan = $this->usulanModel
            ->select('usulan.*, sk_mutasi.*')
            ->join('sk_mutasi', 'usulan.nomor_usulan = sk_mutasi.nomor_usulan', 'left')
            ->where('usulan.status', '07')
            ->orderBy('usulan.created_at', 'DESC');

        $usulanKanan = $queryKanan->paginate($perPageKanan, 'usulanKanan');
        $pagerKanan = $this->usulanModel->pager;

        return view('skmutasi/index', [
            'usulanKiri' => $usulanKiri,
            'pagerKiri' => $pagerKiri,
            'usulanKanan' => $usulanKanan,
            'pagerKanan' => $pagerKanan,
            'perPageKiri' => $perPageKiri,
            'perPageKanan' => $perPageKanan,
        ]);
    }



    public function upload()
    {
        $nomorUsulan = $this->request->getPost('nomor_usulan');
        $jenisMutasi = $this->request->getPost('jenis_mutasi'); // SK Mutasi / Nota Dinas
        $nomorSK = $this->request->getPost('nomor_skmutasi');
        $tanggalSK = $this->request->getPost('tanggal_skmutasi');
        $file = $this->request->getFile('file_skmutasi');

        // **Validasi file PDF & ukuran maksimal 1 MB**
        if (!$file->isValid() || $file->getMimeType() !== 'application/pdf') {
            return redirect()->back()->with('error', 'File harus dalam format PDF.');
        }

        if ($file->getSize() > 1024 * 1024) { // Maksimal 1 MB
            return redirect()->back()->with('error', 'Ukuran file tidak boleh lebih dari 1 MB.');
        }

        // **Format Nama File**
        $tanggalFormatted = date('Ymd', strtotime($tanggalSK));
        $fileName = "{$nomorUsulan}-{$tanggalFormatted}.pdf"; // Format baru

        // **Direktori Penyimpanan**
        $uploadPath = WRITEPATH . 'uploads/sk_mutasi'; // Lokasi C:\xampp\htdocs\simutasi\writable\uploads\sk_mutasi

        // **Pindahkan file ke direktori sk_mutasi**
        $file->move($uploadPath, $fileName);

        // **Simpan ke tabel sk_mutasi**
        $this->skMutasiModel->insert([
            'nomor_usulan' => $nomorUsulan,
            'jenis_mutasi' => $jenisMutasi,
            'nomor_skmutasi' => $nomorSK,
            'tanggal_skmutasi' => $tanggalSK,
            'file_skmutasi' => $fileName,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // **Update status usulan ke 07**
        $this->usulanModel->where('nomor_usulan', $nomorUsulan)
                          ->set(['status' => '07'])
                          ->update();

        // **Catatan history**
        $catatanHistory = ($jenisMutasi === 'SK Mutasi') ? 'SK Mutasi (dapat diunduh)' : 'Nota Dinas (dapat diunduh)';

        // **Simpan ke tabel usulan_status_history**
        $db = \Config\Database::connect();
        $db->table('usulan_status_history')->insert([
            'nomor_usulan' => $nomorUsulan,
            'status' => '07',
            'catatan_history' => $catatanHistory
        ]);

        return redirect()->to('/skmutasi')->with('success', "$jenisMutasi berhasil diunggah.");
    }


    public function update()
    {
        $idSkMutasi = $this->request->getPost('id_skmutasi');
        $nomorUsulan = $this->request->getPost('nomor_usulan');
        $jenisMutasi = $this->request->getPost('jenis_mutasi'); // SK Mutasi / Nota Dinas
        $nomorSK = $this->request->getPost('nomor_skmutasi');
        $tanggalSK = $this->request->getPost('tanggal_skmutasi');
        $file = $this->request->getFile('file_skmutasi');

        // **Ambil data lama dari database**
        $existingData = $this->skMutasiModel->where('id_skmutasi', $idSkMutasi)->first();
        if (!$existingData) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // **Format nama file baru**
        $tanggalFormatted = date('Ymd', strtotime($tanggalSK));
        $fileName = "{$nomorUsulan}-{$tanggalFormatted}.pdf"; // Format baru

        // **Direktori penyimpanan**
        $uploadPath = WRITEPATH . 'uploads/sk_mutasi';
        $fileUpdated = false;

        // **Jika ada file baru yang diunggah**
        if ($file && $file->isValid() && $file->getMimeType() === 'application/pdf') {
            if ($file->getSize() > 1024 * 1024) { // Maksimal 1MB
                return redirect()->back()->with('error', 'Ukuran file tidak boleh lebih dari 1 MB.');
            }

            // **Hapus file lama jika ada**
            $oldFilePath = $uploadPath . '/' . $existingData['file_skmutasi'];
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            // **Pindahkan file baru**
            $file->move($uploadPath, $fileName);
            $fileUpdated = true;
        } else {
            // **Gunakan nama file lama jika tidak diunggah file baru**
            $fileName = $existingData['file_skmutasi'];
        }

        // **Update data di database**
        $updateData = [
            'jenis_mutasi' => $jenisMutasi,
            'nomor_skmutasi' => $nomorSK,
            'tanggal_skmutasi' => $tanggalSK,
            'file_skmutasi' => $fileName,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->skMutasiModel->update($idSkMutasi, $updateData);

        // **Update catatan history berdasarkan jenis mutasi & apakah file diperbarui**
        if ($fileUpdated) {
            $catatanHistory = ($jenisMutasi === 'SK Mutasi') 
                ? 'SK Mutasi diperbaharui (dapat diunduh)' 
                : 'Nota Dinas diperbaharui (dapat diunduh)';
        } else {
            $catatanHistory = ($jenisMutasi === 'SK Mutasi') 
                ? 'SK Mutasi diperbaharui (tanpa perubahan file)' 
                : 'Nota Dinas diperbaharui (tanpa perubahan file)';
        }

       // **Cek apakah nomor_usulan dengan status = 07 sudah ada di tabel usulan_status_history**
        $db = \Config\Database::connect();
        $existingHistory = $db->table('usulan_status_history')
                              ->where('nomor_usulan', $nomorUsulan)
                              ->where('status', '07')
                              ->get()
                              ->getRowArray();

        if ($existingHistory) {
            // **Jika sudah ada, lakukan UPDATE**
            $db->table('usulan_status_history')
               ->where('nomor_usulan', $nomorUsulan)
               ->where('status', '07')
               ->update(['catatan_history' => $catatanHistory]);
        } else {
            // **Jika belum ada, lakukan INSERT**
            $db->table('usulan_status_history')->insert([
                'nomor_usulan' => $nomorUsulan,
                'status' => '07',
                'catatan_history' => $catatanHistory
            ]);
        }

        return redirect()->to('/skmutasi')->with('success', 'Data SK Mutasi berhasil diperbarui.');
    }


    public function delete($idSkMutasi)
    {
        $db = \Config\Database::connect();

        // **Ambil data dari tabel sk_mutasi berdasarkan ID**
        $skMutasi = $this->skMutasiModel->where('id_skmutasi', $idSkMutasi)->first();
        if (!$skMutasi) {
            return redirect()->back()->with('error', 'Data SK Mutasi tidak ditemukan.');
        }

        $nomorUsulan = $skMutasi['nomor_usulan'];
        $filePath = WRITEPATH . 'uploads/sk_mutasi/' . $skMutasi['file_skmutasi'];

        // **Hapus file PDF dari penyimpanan jika ada**
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // **Hapus data dari tabel sk_mutasi**
        $this->skMutasiModel->where('id_skmutasi', $idSkMutasi)->delete();

        // **Update status usulan ke 06 (belum unggah SK Mutasi)**
        $this->usulanModel->where('nomor_usulan', $nomorUsulan)
                          ->set(['status' => '06'])
                          ->update();

        // **Cek apakah nomor_usulan dengan status = 07 sudah ada di tabel usulan_status_history**
        $existingHistory = $db->table('usulan_status_history')
                              ->where('nomor_usulan', $nomorUsulan)
                              ->where('status', '07')
                              ->get()
                              ->getRowArray();

        if ($existingHistory) {
            // **Jika sudah ada, hapus data tersebut**
            $db->table('usulan_status_history')
               ->where('nomor_usulan', $nomorUsulan)
               ->where('status', '07')
               ->delete();
        }

        return redirect()->to('/skmutasi')->with('success', 'SK Mutasi berhasil dihapus.');
    }


}
