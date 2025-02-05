<?php

namespace App\Controllers;

use App\Models\UsulanModel;
use CodeIgniter\Controller;

class BerkasBKPSDMController extends BaseController
{
    protected $usulanModel;

    public function __construct()
    {
        $this->usulanModel = new UsulanModel();
    }

public function index()
{
    $role = session()->get('role');
    $userId = session()->get('id'); // Ambil ID pengguna dari session
    $perPage = 25;

    // Jika role adalah operator, redirect ke dashboard
    if ($role === 'operator') {
        return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
    }

    $db = \Config\Database::connect();
    $cabangDinasIds = [];

    // Jika role adalah "dinas", ambil daftar cabang dinas yang menjadi hak aksesnya
    if ($role === 'dinas') {
        $cabangDinasQuery = $db->table('operator_cabang_dinas')
            ->select('cabang_dinas_id')
            ->where('user_id', $userId)
            ->get()
            ->getResultArray();

        $cabangDinasIds = array_column($cabangDinasQuery, 'cabang_dinas_id');

        if (empty($cabangDinasIds)) {
            $cabangDinasIds = [0]; // Nilai default untuk menghindari error jika tidak ada cabang dinas
        }
    }

    // **1️⃣ Query Data Usulan Siap Kirim**
    $queryUsulanSiapKirim = $this->usulanModel
        ->select('usulan.*, 
                  cabang_dinas.nama_cabang, pengiriman_usulan.dokumen_rekomendasi, pengiriman_usulan.operator, pengiriman_usulan.no_hp, pengiriman_usulan.updated_at AS tanggal_dikirim, 
                  pengiriman_usulan.status_telaah, pengiriman_usulan.updated_at_telaah, pengiriman_usulan.catatan_telaah AS catatan_telaah, 
                  rekom_kadis.nomor_rekomkadis, rekom_kadis.tanggal_rekomkadis, rekom_kadis.file_rekomkadis')
        ->join('pengiriman_usulan', 'usulan.nomor_usulan = pengiriman_usulan.nomor_usulan', 'left')
        ->join('cabang_dinas', 'usulan.cabang_dinas_id = cabang_dinas.id', 'left')
        ->join('rekom_kadis', 'usulan.id_rekomkadis = rekom_kadis.id', 'left')
        ->where('usulan.status', '05')
        ->where('usulan.kirimbkpsdm IS NULL');

    // Jika role adalah dinas, filter hanya data sesuai cabang dinasnya
    if ($role === 'dinas') {
        $queryUsulanSiapKirim->whereIn('usulan.cabang_dinas_id', $cabangDinasIds);
    }

    $usulanSiapKirim = $queryUsulanSiapKirim->orderBy('usulan.created_at', 'DESC')->paginate($perPage, 'usulanSiapKirim');
    $pagerSiapKirim = $this->usulanModel->pager;

    // **2️⃣ Query Data Usulan Sudah Dikirim**
    $queryUsulanSudahDikirim = $this->usulanModel
        ->select('usulan.*, 
                  cabang_dinas.nama_cabang, pengiriman_usulan.dokumen_rekomendasi, pengiriman_usulan.operator, pengiriman_usulan.no_hp, pengiriman_usulan.updated_at AS tanggal_dikirim, 
                  pengiriman_usulan.status_telaah, pengiriman_usulan.updated_at_telaah, pengiriman_usulan.catatan_telaah AS catatan_telaah, 
                  rekom_kadis.nomor_rekomkadis, rekom_kadis.tanggal_rekomkadis, rekom_kadis.file_rekomkadis')
        ->join('pengiriman_usulan', 'usulan.nomor_usulan = pengiriman_usulan.nomor_usulan', 'left')
        ->join('cabang_dinas', 'usulan.cabang_dinas_id = cabang_dinas.id', 'left')
        ->join('rekom_kadis', 'usulan.id_rekomkadis = rekom_kadis.id', 'left')
        ->where('usulan.status', '06')
        ->where('usulan.kirimbkpsdm', '1');

    // Jika role adalah dinas, filter hanya data sesuai cabang dinasnya
    if ($role === 'dinas') {
        $queryUsulanSudahDikirim->whereIn('usulan.cabang_dinas_id', $cabangDinasIds);
    }

    $perPageBerkasDikirim = $this->request->getGet('perPageBerkasDikirim') ?? 25; // Default:

    $usulanSudahDikirim = $queryUsulanSudahDikirim
        ->orderBy('usulan.tglkirimbkpsdm', 'DESC')
        ->paginate($perPageBerkasDikirim, 'usulanSudahDikirim');

    $pagerSudahDikirim = $this->usulanModel->pager;

    // **3️⃣ Data untuk View**
    $data = [
        'usulanSiapKirim' => $usulanSiapKirim,
        'pagerSiapKirim' => $pagerSiapKirim,
        'usulanSudahDikirim' => $usulanSudahDikirim,
        'pagerSudahDikirim' => $pagerSudahDikirim,
        'perPageBerkasDikirim' => $perPageBerkasDikirim,
    ];

    return view('berkasbkpsdm/index', $data);
}



    public function kirimKeBKPSDM()
    {
        if ($this->request->isAJAX()) {
            $nomorUsulanList = $this->request->getJSON(true)['nomor_usulan'];

            if (empty($nomorUsulanList)) {
                return $this->response->setJSON(['error' => 'Tidak ada data yang dikirim.'])->setStatusCode(400);
            }

            $db = \Config\Database::connect();
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDateFormatted = date('d-m-Y H:i:s');

            try {
                $db->transStart();
                $dataDikirim = []; // Menampung daftar rincian
                
                foreach ($nomorUsulanList as $nomorUsulan) {
                    $db->table('usulan')
                        ->where('nomor_usulan', $nomorUsulan)
                        ->update([
                            'status' => '06',
                            'kirimbkpsdm' => '1',
                            'tglkirimbkpsdm' => $currentDateTime
                        ]);

                    $usulan = $db->table('usulan')
                                ->select('nomor_usulan, guru_nama, sekolah_asal, sekolah_tujuan')
                                ->where('nomor_usulan', $nomorUsulan)
                                ->get()
                                ->getRowArray();
                    

                    $dataDikirim[] = "{$usulan['nomor_usulan']} - {$usulan['guru_nama']} - {$usulan['sekolah_asal']}";

                    // Tambahkan ke tabel usulan_status_history
                    $db->table('usulan_status_history')
                        ->insert([
                            'nomor_usulan' => $nomorUsulan,
                            'status' => '06',
                            'catatan_history' => 'Berkas dikirim ke Badan Kepegawaian Aceh (BKA).'
                        ]);
                }

                $db->transComplete();

                if ($db->transStatus() === false) {
                    throw new \Exception("Gagal menyimpan data.");
                }

            return $this->response->setJSON([
                'message' => "Tanggal $currentDateFormatted, sebanyak " . count($nomorUsulanList) . " berkas telah berhasil dikirimkan ke BKA.",
                'daftar_rincian' => $dataDikirim
            ]);

            } catch (\Exception $e) {
                return $this->response->setJSON(['error' => $e->getMessage()])->setStatusCode(500);
            }
        }

    }



}
