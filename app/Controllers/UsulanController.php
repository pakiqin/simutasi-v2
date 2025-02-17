<?php

namespace App\Controllers;

require_once APPPATH . 'ThirdParty/dompdf/autoload.inc.php';
use Dompdf\Dompdf; // Menggunakan namespace Dompdf


use App\Models\UsulanModel;
use App\Models\UsulanStatusHistoryModel;
use App\Models\PengirimanUsulanModel;
use App\Models\KabupatenModel;
use App\Models\SekolahModel;
use App\Models\CabangDinasModel;

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

        // 🔹 Cek Role dan Filter Data Sesuai Role
        if ($role === 'dinas') {
            // Dinas hanya melihat data berdasarkan cabang dinas user (tanpa tambah/edit/hapus)
            $operatorModel = new \App\Models\OperatorCabangDinasModel();
            $operator = $operatorModel->where('user_id', $userId)->first();

            if ($operator && isset($operator['cabang_dinas_id'])) {
                $query->where('cabang_dinas_id', $operator['cabang_dinas_id']);
            } else {
                return redirect()->to('/dashboard')->with('error', 'Cabang dinas tidak ditemukan.');
            }
        } elseif ($role === 'operator') {
            // Operator hanya bisa melihat data sesuai cabang dinasnya
            $operatorModel = new \App\Models\OperatorCabangDinasModel();
            $operator = $operatorModel->where('user_id', $userId)->first();

            if ($operator && isset($operator['cabang_dinas_id'])) {
                $query->where('cabang_dinas_id', $operator['cabang_dinas_id']);
            } else {
                return redirect()->to('/dashboard')->with('error', 'Cabang dinas tidak ditemukan.');
            }
        }

        // 🔹 Jika ada pencarian berdasarkan NIP
        if (!empty($searchNIP)) {
            $query = $query->like('guru_nip', $searchNIP);
        }

        // 🔹 Ambil Data Usulan dengan Pagination
        $usulanData = $query->paginate($perPage, 'usulan');

        // 🔹 Tambahkan Status Telaah ke Setiap Data
        $pengirimanUsulanModel = new \App\Models\PengirimanUsulanModel();
        foreach ($usulanData as &$row) {
            $pengiriman = $pengirimanUsulanModel->where('nomor_usulan', $row['nomor_usulan'])->first();
            $row['status_usulan_cabdin'] = $pengiriman['status_usulan_cabdin'] ?? null;
            $row['status_telaah'] = $pengiriman['status_telaah'] ?? null;
        }

        // 🔹 Tentukan Hak Akses Readonly untuk Role Kabid
        $readonly = ($role === 'kabid');

        // 🔹 Kirim Data ke View
        $data = [
            'usulan' => $usulanData,
            'pager' => $this->usulanModel->pager,
            'perPage' => $perPage,
            'searchNIP' => $searchNIP,
            'role' => $role, // Kirim role ke view untuk tampilan dinamis
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
    $role = session()->get('role');
    $userId = session()->get('id');

    // Cegah role 'dinas' mengakses halaman ini
    if ($role === 'dinas') {
        return redirect()->to('/usulan')->with('error', 'Anda tidak memiliki izin untuk menambah usulan.');
    }

    // Inisialisasi model
    $kabupatenModel = new \App\Models\KabupatenModel();
    $cabangDinasModel = new \App\Models\CabangDinasModel();
    $cabangDinasKabupatenModel = new \App\Models\CabangDinasKabupatenModel();
    $sekolahModel = new \App\Models\SekolahModel();    
    $operatorModel = new \App\Models\OperatorCabangDinasModel();

    // Inisialisasi array data untuk dikirim ke view
    $data = [
        'kabupaten_asal_id' => null,
        'kabupaten_asal_nama' => '',
        'cabang_dinas_asal_id' => null,
        'cabang_dinas_asal_nama' => '',
        'sekolahAsalList' => [], // Pastikan variabel ini selalu ada agar tidak error
        'kabupatenList' => $kabupatenModel->findAll(),
    ];

    // Jika role adalah operator, ambil otomatis Kabupaten Asal & Cabang Dinas Asal berdasarkan user
    if ($role === 'operator') {
        $operator = $operatorModel->where('user_id', $userId)->first();

        if ($operator) {
            // Ambil data cabang dinas dari operator
            $cabangDinasOperator = $cabangDinasModel->find($operator['cabang_dinas_id']);

            // Cari kabupaten yang terkait dengan cabang dinas
            $cabangDinasKabupaten = $cabangDinasKabupatenModel
                ->where('cabang_dinas_id', $operator['cabang_dinas_id'])
                ->first();

            // Ambil data kabupaten jika ada
            $kabupatenOperator = $cabangDinasKabupaten 
                ? $kabupatenModel->find($cabangDinasKabupaten['kabupaten_id']) 
                : null;

            // Ambil daftar sekolah berdasarkan Kabupaten Asal (jika ada)
            $sekolahAsalList = ($kabupatenOperator) 
                ? $sekolahModel->where('kabupaten_id', $kabupatenOperator['id_kab'])->findAll()
                : [];

            // Set data untuk tampilan form
            $data['kabupaten_asal_id'] = $kabupatenOperator ? $kabupatenOperator['id_kab'] : null;
            $data['kabupaten_asal_nama'] = $kabupatenOperator ? $kabupatenOperator['nama_kab'] : 'Tidak Ditemukan';
            $data['cabang_dinas_asal_id'] = $cabangDinasOperator ? $cabangDinasOperator['id'] : null;
            $data['cabang_dinas_asal_nama'] = $cabangDinasOperator ? $cabangDinasOperator['nama_cabang'] : 'Tidak Ditemukan';
            $data['sekolahAsalList'] = $sekolahAsalList;
        }
    }

    return view('usulan/create', $data);
}




    public function getCabangDinas($kabupatenId)
    {
        $db = \Config\Database::connect(); // Koneksi database secara langsung
        $cabangDinas = $db->table('cabang_dinas_kabupaten')
                          ->join('cabang_dinas', 'cabang_dinas.id = cabang_dinas_kabupaten.cabang_dinas_id')
                          ->where('kabupaten_id', $kabupatenId)
                          ->get()
                          ->getRowArray();

        if (!$cabangDinas) {
            return $this->response->setJSON([
                'id' => null,
                'nama_cabang' => "Cabang Dinas tidak ditemukan"
            ]);
        }

        return $this->response->setJSON([
            'id' => $cabangDinas['cabang_dinas_id'],
            'nama_cabang' => $cabangDinas['nama_cabang']
        ]);
    }

    public function getSekolah($kabupatenId)
    {
        $db = \Config\Database::connect(); // Koneksi database
        $sekolahList = $db->table('data_sekolah')
                          ->where('kabupaten_id', $kabupatenId)
                          ->orderBy('jenjang', 'ASC') // Urutkan berdasarkan jenjang (SLB, SMA, SMK)
                          ->orderBy('nama_sekolah', 'ASC') // Urutkan berdasarkan nama sekolah A-Z
                          ->get()
                          ->getResultArray();

        if (empty($sekolahList)) {
            return $this->response->setJSON([
                'error' => 'Tidak ada sekolah ditemukan untuk kabupaten ini'
            ]);
        }

        return $this->response->setJSON($sekolahList);
    }



    public function store()
    {
        // Ambil NIP dari input
        $guruNip = $this->request->getPost('guru_nip');
        $guruNik = $this->request->getPost('guru_nik');
        
        // Cek apakah ada usulan dengan NIP yang sama dan belum selesai
        $existingUsulan = $this->usulanModel
            ->groupStart()
                ->where('guru_nip', $guruNip)
                ->orWhere('guru_nik', $guruNik)
            ->groupEnd()
            ->whereNotIn('status', ['08']) // Status "08" dianggap selesai
            ->first();

        if ($existingUsulan) {
            // Jika ada usulan yang belum selesai, kembalikan pesan error
            session()->setFlashdata('error', 'Guru dengan NIP atau NIK ini masih dalam proses usulan dan belum selesai.');

            $data = [
                'kabupatenList' => (new \App\Models\KabupatenModel())->findAll(),
            ];

            // Kembali ke tampilan create
            return view('usulan/create', $data);
        }

    // Ambil ID Cabang Dinas Asal & Tujuan
    $cabangDinasAsalId = $this->request->getPost('cabang_dinas_asal_id');
    $cabangDinasTujuanId = $this->request->getPost('cabang_dinas_tujuan_id');
    $sekolahAsalId = $this->request->getPost('sekolah_asal_id');
    $sekolahTujuanId = $this->request->getPost('sekolah_tujuan_id');

    // Pastikan data sekolah dan cabang dinas tidak kosong
    if (empty($sekolahAsalId) || empty($sekolahTujuanId) || empty($cabangDinasAsalId)) {
        log_message('error', 'Data sekolah atau cabang dinas tidak ditemukan dalam POST request');
        return redirect()->back()->with('error', 'Gagal menyimpan usulan. Pastikan semua data telah diisi.')->withInput();
    }

    // Ambil nama sekolah berdasarkan ID yang dipilih
    $sekolahModel = new \App\Models\SekolahModel();
    $sekolahAsal = $sekolahModel->find($sekolahAsalId);
    $sekolahTujuan = $sekolahModel->find($sekolahTujuanId);

    // Ambil kode cabang dinas asal untuk nomor usulan
    $kodeCabang = $this->getKodeCabangDinas($cabangDinasAsalId); // Mendapatkan kode cabang (CD01)

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
        'guru_nama'         => $this->request->getPost('guru_nama'),
        'guru_nik'          => $guruNik,
        'guru_nip'          => $guruNip,
        'sekolah_asal'    => $sekolahAsal ? $sekolahAsal['nama_sekolah'] : null, // Simpan nama sekolah, bukan ID
        'sekolah_tujuan'  => $sekolahTujuan ? $sekolahTujuan['nama_sekolah'] : null, // Simpan nama sekolah
        'alasan'            => $this->request->getPost('alasan'),
        'google_drive_link' => $this->request->getPost('google_drive_link'),
        'cabang_dinas_id' => $cabangDinasAsalId, // Simpan cabang dinas asal        
        'nomor_usulan'      => $nomorUsulan,
        'status'            => '01', // Status awal
    ]);

        // Simpan riwayat status awal
        $this->addStatusHistory($nomorUsulan, '01', 'Input data usulan mutasi oleh Cabang Dinas'); // Status awal: Diajukan

         // Simpan nomor usulan ke session biasa (bukan flashdata)
        session()->set('nomor_usulan', $nomorUsulan);
            session()->setFlashdata('redirectToCetak', true);

        return redirect()->to('/usulan')->with('success', 'Usulan berhasil ditambahkan!');

    }

        public function destroy($id)
    {
        $usulan = $this->usulanModel->find($id);
        
        if (!$usulan) {
            return redirect()->to('/usulan')->with('error', 'Usulan tidak ditemukan.');
        }

        // Hapus data
        $this->usulanModel->delete($id);

        // Pastikan tidak ada redirect ke konfirmasi cetak saat menghapus
        session()->remove('nomor_usulan');
        session()->remove('redirectToCetak'); 

        return redirect()->to('/usulan')->with('success', 'Usulan berhasil dihapus!');
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

    public function konfirmasiCetak($nomorUsulan)
    {
        if (!$nomorUsulan) {
            return redirect()->to('/usulan')->with('error', 'Nomor usulan tidak valid.');
        }

        return view('usulan/konfirmasi_cetak', ['nomor_usulan' => $nomorUsulan]);
    }


    public function generateResi($nomorUsulan)
    {
        $usulan = $this->usulanModel
            ->select([
                'usulan.nomor_usulan',
                'usulan.guru_nama AS nama_guru',
                'usulan.guru_nip AS nip',
                'usulan.guru_nik AS nik',                
                'usulan.sekolah_asal',
                'usulan.sekolah_tujuan',
                'usulan.alasan AS alasan_mutasi',
                'usulan.created_at AS tanggal_usulan',
                'cabang_dinas.nama_cabang'
            ])
            ->join('cabang_dinas', 'usulan.cabang_dinas_id = cabang_dinas.id', 'left')
            ->where('usulan.nomor_usulan', trim($nomorUsulan))
            ->first();

        if (!$usulan) {
            return redirect()->to('/usulan')->with('error', 'Data usulan tidak ditemukan.');
        }

        // Data yang dikirim ke view
        $data = [
            'usulan' => $usulan,
            'tanggal_cetak' => date('d-m-Y'),
        ];

        // Load View ke DomPDF
        $html = view('usulan/pdf_resi', $data);
        $dompdf = new \Dompdf\Dompdf();

        // Aktifkan opsi agar Dompdf lebih cepat dan ringan
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->set_option('defaultFont', 'Arial');
        $dompdf->set_option('isHtml5ParserEnabled', true);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        ob_end_clean(); // Mencegah error buffer output

        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=\"resi_usulan.pdf\"");
        echo $dompdf->output();
        exit;
    }




    public function edit($id)
    {
        // Ambil data usulan dengan JOIN ke tabel yang terkait
        $usulan = $this->usulanModel
            ->select('usulan.*, 
                      sekolah_asal.nama_sekolah as sekolah_asal_nama,
                      sekolah_tujuan.nama_sekolah as sekolah_tujuan_nama,
                      kab_asal.id_kab as kabupaten_asal_id,
                      kab_asal.nama_kab as kabupaten_asal_nama,
                      kab_tujuan.id_kab as kabupaten_tujuan_id,
                      kab_tujuan.nama_kab as kabupaten_tujuan_nama,
                      cd_asal.id AS cabang_dinas_asal_id,
                      cd_asal.nama_cabang as cabang_dinas_asal_nama,
                      cd_tujuan.id AS cabang_dinas_tujuan_id,
                      cd_tujuan.nama_cabang as cabang_dinas_tujuan_nama')
            ->join('data_sekolah as sekolah_asal', 'usulan.sekolah_asal = sekolah_asal.nama_sekolah', 'left')
            ->join('data_sekolah as sekolah_tujuan', 'usulan.sekolah_tujuan = sekolah_tujuan.nama_sekolah', 'left')
            ->join('kabupaten as kab_asal', 'sekolah_asal.kabupaten_id = kab_asal.id_kab', 'left')
            ->join('kabupaten as kab_tujuan', 'sekolah_tujuan.kabupaten_id = kab_tujuan.id_kab', 'left')
            ->join('cabang_dinas_kabupaten as cdk_asal', 'kab_asal.id_kab = cdk_asal.kabupaten_id', 'left')
            ->join('cabang_dinas as cd_asal', 'cdk_asal.cabang_dinas_id = cd_asal.id', 'left')
            ->join('cabang_dinas_kabupaten as cdk_tujuan', 'kab_tujuan.id_kab = cdk_tujuan.kabupaten_id', 'left')
            ->join('cabang_dinas as cd_tujuan', 'cdk_tujuan.cabang_dinas_id = cd_tujuan.id', 'left')
            ->where('usulan.id', $id)
            ->first();

        // Pastikan data usulan ditemukan
        if (!$usulan) {
            return redirect()->to('/usulan')->with('error', 'Data usulan tidak ditemukan.');
        }

        // Ambil daftar kabupaten untuk dropdown
        $kabupatenModel = new KabupatenModel();
        $kabupatenList = $kabupatenModel->findAll();

        return view('usulan/edit', [
            'usulan' => $usulan,
            'kabupatenList' => $kabupatenList
        ]);
    }

    public function update($id)
    {
        // Ambil data usulan berdasarkan ID
        $usulan = $this->usulanModel->find($id);

        if (!$usulan) {
            return redirect()->to('/usulan')->with('error', 'Data usulan tidak ditemukan.');
        }

        // Ambil ID sekolah tujuan dari input (jika ada)
        $sekolahTujuanId = $this->request->getPost('sekolah_tujuan_id');

        // Jika user tidak memilih sekolah tujuan baru, gunakan nilai lama dari database
        if (!empty($sekolahTujuanId)) {
            // Ambil nama sekolah tujuan berdasarkan ID baru yang dipilih
            $sekolahModel = new \App\Models\SekolahModel();
            $sekolahTujuan = $sekolahModel->find($sekolahTujuanId);
            $sekolahTujuanNama = $sekolahTujuan ? $sekolahTujuan['nama_sekolah'] : $usulan['sekolah_tujuan'];
        } else {
            // Gunakan nama sekolah tujuan lama jika tidak diubah
            $sekolahTujuanNama = $usulan['sekolah_tujuan'];
        }

        // Ambil input dari form
        $data = [
            'guru_nama'         => $this->request->getPost('guru_nama'),
            'sekolah_tujuan'    => $sekolahTujuanNama, // Simpan **nama sekolah tujuan**, bukan ID
            'alasan'            => $this->request->getPost('alasan'),
            'google_drive_link' => $this->request->getPost('google_drive_link'),
        ];

        // Update data usulan
        $this->usulanModel->update($id, $data);

        // Set flash message sukses
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
