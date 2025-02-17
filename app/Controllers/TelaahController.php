<?php

namespace App\Controllers;

use App\Models\TelaahBerkasModel;

class TelaahController extends BaseController
{
    protected $telaahBerkasModel;

    public function __construct()
    {
        $this->telaahBerkasModel = new TelaahBerkasModel();
        $this->db = \Config\Database::connect();

    }

    public function index()
    {
        $role = session()->get('role');
        $userId = session()->get('id'); // Ambil ID pengguna dari session
        $perPage = 50;

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
                $cabangDinasIds = [0]; // Default untuk menghindari error jika tidak ada hak akses
            }
        }

        // **1️⃣ Query Menunggu Telaah**
        $queryMenunggu = $this->telaahBerkasModel
            ->select('pengiriman_usulan.nomor_usulan, usulan.guru_nama, usulan.guru_nip, usulan.guru_nik, 
                      usulan.sekolah_asal, usulan.sekolah_tujuan, usulan.alasan, usulan.google_drive_link, usulan.created_at, 
                      cabang_dinas.id as cabang_dinas_id, cabang_dinas.nama_cabang, 
                      pengiriman_usulan.dokumen_rekomendasi, pengiriman_usulan.operator, 
                      pengiriman_usulan.no_hp, pengiriman_usulan.status_usulan_cabdin, pengiriman_usulan.created_at AS tanggal_dikirim, 
                      pengiriman_usulan.updated_at AS tanggal_update, pengiriman_usulan.catatan')
            ->join('usulan', 'pengiriman_usulan.nomor_usulan = usulan.nomor_usulan', 'inner') 
            ->join('cabang_dinas', 'usulan.cabang_dinas_id = cabang_dinas.id', 'left')
            ->where('pengiriman_usulan.status_usulan_cabdin', 'Lengkap')
            ->where('pengiriman_usulan.status_telaah', NULL)
            ->orderBy('tanggal_dikirim', 'ASC');

        // **Filter hanya untuk Role DINAS** (kabid & admin melihat semua data)
        if ($role === 'dinas') {
            $queryMenunggu->whereIn('usulan.cabang_dinas_id', $cabangDinasIds);
        }

        $usulanMenunggu = $queryMenunggu->paginate($perPage, 'usulanMenunggu');
        $pagerMenunggu = $this->telaahBerkasModel->pager;

        // **2️⃣ Query Sudah Ditelaah**
        $queryDitelaah = $this->telaahBerkasModel
            ->select('pengiriman_usulan.nomor_usulan, usulan.guru_nama, usulan.guru_nip, usulan.guru_nik, 
                      usulan.sekolah_asal, usulan.sekolah_tujuan, usulan.alasan, usulan.google_drive_link, usulan.created_at, 
                      cabang_dinas.id as cabang_dinas_id, cabang_dinas.nama_cabang, 
                      pengiriman_usulan.status_telaah, pengiriman_usulan.updated_at_telaah, 
                      pengiriman_usulan.dokumen_rekomendasi, pengiriman_usulan.operator, 
                      pengiriman_usulan.no_hp, pengiriman_usulan.status_usulan_cabdin, pengiriman_usulan.created_at AS tanggal_dikirim, 
                      pengiriman_usulan.updated_at AS tanggal_update, pengiriman_usulan.catatan_telaah')
            ->join('usulan', 'pengiriman_usulan.nomor_usulan = usulan.nomor_usulan', 'inner') 
            ->join('cabang_dinas', 'usulan.cabang_dinas_id = cabang_dinas.id', 'left')
            ->where('pengiriman_usulan.status_telaah !=', NULL)
            ->orderBy('pengiriman_usulan.updated_at_telaah', 'DESC');

        // **Filter hanya untuk Role DINAS** (kabid & admin melihat semua data)
        if ($role === 'dinas') {
            $queryDitelaah->whereIn('usulan.cabang_dinas_id', $cabangDinasIds);
        }

        $usulanDitelaah = $queryDitelaah->paginate($perPage, 'usulanDitelaah');
        $pagerDitelaah = $this->telaahBerkasModel->pager;

        // **3️⃣ Data untuk View**
        $readonly = ($role === 'dinas'); // Role dinas hanya bisa melihat (readonly)

        $data = [
            'usulanMenunggu' => $usulanMenunggu,
            'pagerMenunggu' => $pagerMenunggu,
            'usulanDitelaah' => $usulanDitelaah,
            'pagerDitelaah' => $pagerDitelaah,
            'perPage' => $perPage,
            'readonly' => $readonly, // ✅ Role dinas readonly, lainnya tidak
        ];

        return view('telaah/index', $data);
    }







    public function update()
    {
        $request = $this->request->getJSON(true);

        // Validasi data request
        if (!isset($request['nomor_usulan'], $request['status_telaah'])) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap.'])->setStatusCode(400);
        }

        $nomorUsulan = $request['nomor_usulan'];
        $statusTelaah = $request['status_telaah'];
        $catatanTelaah = $request['catatan_telaah'] ?? '';
        $statusUsulan = ($statusTelaah === 'Disetujui') ? '04' : '02';

        // Tentukan catatan history berdasarkan status telaah
        $catatanHistory = ($statusTelaah === 'Disetujui')
            ? "Telaah Usulan oleh Kepala Bidang GTK (Disetujui). " . $catatanTelaah
            : "Telaah Usulan oleh Kepala Bidang GTK (Ditolak). " . $catatanTelaah;

        try {
            // Mulai transaksi
            $this->db->transStart();

            // Update tabel pengiriman_usulan
            $this->db->table('pengiriman_usulan')
                ->where('nomor_usulan', $nomorUsulan)
                ->update([
                    'status_telaah' => $statusTelaah,
                    'catatan_telaah' => $catatanTelaah,
                    'updated_at_telaah' => date('Y-m-d H:i:s'),
                ]);

            // Update tabel usulan
            $this->db->table('usulan')
                ->where('nomor_usulan', $nomorUsulan)
                ->update(['status' => $statusUsulan]);

            // Tambahkan ke tabel usulan_status_history
            $this->db->table('usulan_status_history')
                ->insert([
                    'nomor_usulan' => $nomorUsulan,
                    'status' => $statusUsulan,
                    'catatan_history' => $catatanHistory,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

            // Akhiri transaksi
            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Transaksi gagal.');
            }

            return $this->response->setJSON(['message' => 'Status telaah berhasil diperbarui.']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => $e->getMessage()])->setStatusCode(500);
        }
    }
    




}
