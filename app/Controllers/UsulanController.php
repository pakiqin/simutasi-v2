<?php

namespace App\Controllers;

require_once APPPATH . 'ThirdParty/dompdf/autoload.inc.php';
use Dompdf\Dompdf; // Menggunakan namespace Dompdf


use App\Models\UsulanModel;
use App\Models\UsulanStatusHistoryModel;
use App\Models\PengirimanUsulanModel;

class UsulanController extends BaseController
{
    protected $usulanModel;
    protected $historyModel;
    protected $pengirimanModel;

    public function __construct()
    {
        $this->usulanModel = new UsulanModel();
        $this->historyModel = new UsulanStatusHistoryModel();
        $this->pengirimanModel = new PengirimanUsulanModel();
    }

    public function index()
    {
        $role = session()->get('role');
        $userId = session()->get('id');
        $perPage = $this->request->getVar('per_page') ?: 10;
        $searchNIP = $this->request->getVar('nip');

        $query = $this->usulanModel->orderBy('created_at', 'DESC'); 

//cek role tampilan --------------------
        if ($role === 'dinas') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }
        if ($role === 'operator') {
            $operatorModel = new \App\Models\OperatorCabangDinasModel();
            $operator = $operatorModel->where('user_id', $userId)->first();

            if ($operator && isset($operator['cabang_dinas_id'])) {
                $query = $query->where('cabang_dinas_id', $operator['cabang_dinas_id']);
            } else {
                $query = $query->where('cabang_dinas_id', null);
                 return redirect()->to('/dashboard')->with('error', 'Cabang dinas tidak ditemukan.');
            }
        }
        if ($role === 'kabid') {
            $data['readonly'] = true;
        } else {
            $data['readonly'] = false;
        }
        $readonly = ($role === 'kabid');

//akhir cek role tampilan --------------------

        if (!empty($searchNIP)) {
            $query = $query->like('guru_nip', $searchNIP);
        }

            $usulanData = $query->paginate($perPage, 'usulan');
        $pengirimanUsulanModel = new \App\Models\PengirimanUsulanModel();

        foreach ($usulanData as &$row) {
            $pengiriman = $pengirimanUsulanModel->where('nomor_usulan', $row['nomor_usulan'])->first();
            if ($pengiriman) {
                $row['status_usulan_cabdin'] = $pengiriman['status_usulan_cabdin'];
                $row['status_telaah'] = $pengiriman['status_telaah'];
            } else {
                $row['status_usulan_cabdin'] = null; // Tidak ada data di pengiriman_usulan
                $row['status_telaah'] = null;
            }
        }


        $data = [
            'usulan' => $usulanData,
            'pager' => $this->usulanModel->pager,
            'perPage' => $perPage,
            'searchNIP' => $searchNIP,
            'readonly' => $readonly,
        ];

        return view('usulan/index', $data);
    }

    public function getHistory($nomor_usulan)
    {
        // Ambil data dari tabel usulan_status_history
        $history = $this->historyModel->where('nomor_usulan', $nomor_usulan)
                                      ->orderBy('updated_at', 'ASC') // Urutkan dari yang terlama
                                      ->findAll();

        // Kembalikan data dalam format JSON
        return $this->response->setJSON($history);
    }



    public function create()
    {
        // Ambil ID pengguna dari session
        $userId = session()->get('id'); // Pastikan session user_id tersedia
        if (!$userId) {
            throw new \RuntimeException('User tidak ditemukan dalam session.');
        }

        // Ambil data dari tabel operator_cabang_dinas
        $operatorCabangDinasModel = new \App\Models\OperatorCabangDinasModel();
        $operator = $operatorCabangDinasModel->where('user_id', $userId)->first(); // Cari operator terkait user_id

        if (!$operator || !isset($operator['cabang_dinas_id'])) {
            throw new \RuntimeException('Cabang Dinas ID tidak ditemukan untuk pengguna yang login.');
        }

        // Ambil data cabang dinas berdasarkan cabang_dinas_id
        $cabangDinasModel = new \App\Models\CabangDinasModel();
        $cabangDinas = $cabangDinasModel->find($operator['cabang_dinas_id']);

        if (!$cabangDinas) {
            throw new \RuntimeException('Data Cabang Dinas tidak ditemukan.');
        }

        // Kirim data ke view
        $data['cabangDinas'] = $cabangDinas;
        return view('usulan/create', $data);
    }


    public function store()
    {
        // Ambil NIP dari input
        $guruNip = $this->request->getPost('guru_nip');
        $guruNik = $this->request->getPost('guru_nik');
        
            // Validasi NIK harus tepat 16 digit angka
        if (!preg_match('/^\d{16}$/', $guruNik)) {
            return redirect()->back()->with('error', 'NIK harus terdiri dari 16 digit angka.')->withInput();
        }

        // Cek apakah ada usulan dengan NIP yang sama dan belum selesai
        $existingUsulan = $this->usulanModel
            ->where('guru_nip', $guruNip)
            ->whereNotIn('status', ['08']) // Status "08" dianggap selesai
            ->first();

        if ($existingUsulan) {
            // Jika ada usulan yang belum selesai, kembalikan pesan error
            return redirect()->back()->with('error', 'Guru dengan NIP ini masih dalam proses usulan dan belum selesai.')->withInput();
        }

        // Ambil kode cabang dinas berdasarkan ID cabang_dinas yang sudah diset sebelumnya
        $cabangDinasId = $this->request->getPost('cabang_dinas_id'); // ID cabang_dinas dari form (hidden field)

        // Mendapatkan kode cabang untuk membentuk nomor usulan
        $kodeCabang = $this->getKodeCabangDinas($cabangDinasId); // Mendapatkan kode cabang (CD01)

        // Tanggal pengajuan dalam format YYYYMMDD
        $tanggal = date('Ymd');

        // Hitung nomor urut berdasarkan kode cabang dan tanggal
        $lastUsulan = $this->usulanModel
            ->select('nomor_usulan')
            ->like('nomor_usulan', "{$kodeCabang}{$tanggal}", 'after') // Filter berdasarkan kode cabang dan tanggal
            ->orderBy('nomor_usulan', 'DESC') // Urutkan dari yang terbesar
            ->first();

        if ($lastUsulan) {
            // Ekstrak nomor urut dari nomor usulan terakhir
            $lastNomorUrut = (int) substr($lastUsulan['nomor_usulan'], -4); // Ambil 4 digit terakhir
            $nomorUrut = sprintf('%04d', $lastNomorUrut + 1); // Tambahkan 1 dan format 4 digit
        } else {
            $nomorUrut = '0001'; // Jika belum ada, mulai dari 0001
        }
        // Gabungkan menjadi nomor unik
        $nomorUsulan = "{$kodeCabang}{$tanggal}{$nomorUrut}";

        // Simpan data usulan ke database
        $this->usulanModel->save([
            'guru_nama' => $this->request->getPost('guru_nama'),
            'guru_nik' => $this->request->getPost('guru_nik'),
            'guru_nip' => $guruNip,
            'sekolah_asal' => $this->request->getPost('sekolah_asal'),
            'sekolah_tujuan' => $this->request->getPost('sekolah_tujuan'),
            'alasan' => $this->request->getPost('alasan'),
            'google_drive_link' => $this->request->getPost('google_drive_link'),
            'nomor_usulan' => $nomorUsulan,
            'cabang_dinas_id' => $cabangDinasId,
            'status' => '01', // Status awal
        ]);

        // Simpan riwayat status awal
        $this->addStatusHistory($nomorUsulan, '01', 'Input data usulan mutasi oleh Cabang Dinas'); // Status awal: Diajukan

        // Set flash message untuk pesan sukses
        session()->setFlashdata('success', 'Usulan berhasil ditambahkan!');
        session()->setFlashdata('nomor_usulan', $nomorUsulan); // Simpan nomor usulan untuk konfirmasi cetak

        // Redirect ke halaman konfirmasi cetak
        return redirect()->to('/usulan/konfirmasi-cetak');
    }

    // Fungsi untuk mendapatkan kode cabang dinas berdasarkan ID
    private function getKodeCabangDinas($cabangDinasId)
    {
        $cabangDinasModel = new \App\Models\CabangDinasModel();
        $cabangDinas = $cabangDinasModel->find($cabangDinasId);
        return $cabangDinas['kode_cabang'];
    }

    // Fungsi untuk menyimpan riwayat status ke tabel usulan_status_history
    private function addStatusHistory($nomorUsulan, $status, $catatan = null)
    {
        $statusHistoryModel = new \App\Models\UsulanStatusHistoryModel();
        $statusHistoryModel->save([
            'nomor_usulan' => $nomorUsulan,
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s'),
            'catatan_history' => $catatan,
        ]);
    }

    public function konfirmasiCetak()
    {
        $nomorUsulan = session()->getFlashdata('nomor_usulan');
        if (!$nomorUsulan) {
            return redirect()->to('/usulan'); // Jika tidak ada nomor usulan, kembali ke daftar usulan
        }

        return view('usulan/konfirmasi_cetak', ['nomor_usulan' => $nomorUsulan]);
    }
    
    public function generateResi($nomorUsulan)
{
    // Ambil data usulan berdasarkan nomor_usulan
    $usulan = $this->usulanModel
        ->select('usulan.*, cabang_dinas.nama_cabang')
        ->join('cabang_dinas', 'usulan.cabang_dinas_id = cabang_dinas.id', 'left')
        ->where('nomor_usulan', $nomorUsulan)
        ->first();

    if (!$usulan) {
        return redirect()->to('/usulan')->with('error', 'Data usulan tidak ditemukan.');
    }

    // Data untuk template PDF
    $data = [
        'usulan' => $usulan,
        'tanggal_cetak' => date('d-m-Y'),
    ];

    // Load view untuk PDF
    $html = view('usulan/pdf_resi', $data);

    // Konfigurasi Dompdf
    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Pastikan tidak ada output sebelumnya
    ob_end_clean();

    // Set header agar PDF tampil di browser
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=\"resi_usulan_{$nomorUsulan}.pdf\"");
    
    echo $dompdf->output();
    exit;
}


    public function edit($id)
    {
        $data['usulan'] = $this->usulanModel->find($id);
        return view('usulan/edit', $data);
    }

    public function update($id)
    {
        $this->usulanModel->update($id, [
            'guru_nama' => $this->request->getPost('guru_nama'),
            'guru_nik' => $this->request->getPost('guru_nik'),
            'guru_nip' => $this->request->getPost('guru_nip'),
            'sekolah_asal' => $this->request->getPost('sekolah_asal'),
            'sekolah_tujuan' => $this->request->getPost('sekolah_tujuan'),
            'alasan' => $this->request->getPost('alasan'),
            'google_drive_link' => $this->request->getPost('google_drive_link'),
        ]);

        session()->setFlashdata('success', 'Usulan berhasil diperbarui!');
        return redirect()->to('/usulan');
    }

    public function delete($id)
    {
        $this->usulanModel->delete($id);
        session()->setFlashdata('success', 'Usulan berhasil dihapus!');
        return redirect()->to('/usulan');
    }

    public function deletetolak($id)
    {
        $pengirimanModel = new \App\Models\PengirimanUsulanModel();
        $usulanModel = new \App\Models\UsulanModel();

        $usulan = $usulanModel->find($id);
        $pengiriman = $pengirimanModel->where('nomor_usulan', $usulan['nomor_usulan'])->first();

        if ($pengiriman) {
            // Hapus file PDF jika ada
            if (!empty($pengiriman['dokumen_rekomendasi'])) {
                $filePath = WRITEPATH . 'uploads/rekomendasi/' . $pengiriman['dokumen_rekomendasi'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $pengirimanModel->where('nomor_usulan', $usulan['nomor_usulan'])->delete();
        }
        $this->usulanModel->delete($id);
        session()->setFlashdata('success', 'Usulan dan dokumen terkait berhasil dihapus!');
        return redirect()->to('/usulan');
    }

    public function revisi($nomorUsulan)
    {
        // Cari data usulan berdasarkan nomor_usulan
        $usulan = $this->usulanModel->where('nomor_usulan', $nomorUsulan)->first();

        if (!$usulan) {
            // Jika tidak ditemukan, kembalikan ke halaman daftar usulan dengan pesan error
            return redirect()->to('/usulan')->with('error', 'Usulan tidak ditemukan.');
        }

        // Kirim data ke view revisi
        return view('usulan/revisi', ['usulan' => $usulan]);
    }

    public function updateRevisi($id)
    {
        // Proses update revisi
        $this->usulanModel->update($id, [
            'guru_nama' => $this->request->getPost('guru_nama'),
            'guru_nik' => $this->request->getPost('guru_nik'),
            'guru_nip' => $this->request->getPost('guru_nip'),            
            'sekolah_asal' => $this->request->getPost('sekolah_asal'),
            'sekolah_tujuan' => $this->request->getPost('sekolah_tujuan'),
            'alasan' => $this->request->getPost('alasan'),
            'google_drive_link' => $this->request->getPost('google_drive_link'),
            //'status' => '01', // Mengubah status menjadi "01" setelah revisi
        ]);

        session()->setFlashdata('success', 'Revisi berhasil disimpan. Silahkan melanjutkan proses pengiriman melalui Menu Pengiriman Usulan');
        return redirect()->to('/usulan');
    }


}
