<?php

namespace App\Controllers;

use App\Models\VerifikasiBerkasModel;
use CodeIgniter\Controller;

class VerifikasiController extends BaseController
{
    protected $verifikasiBerkasModel;

    public function __construct()
    {
        $this->verifikasiBerkasModel = new VerifikasiBerkasModel();
    }
/*
    public function index()
    {
        //cek role
        if (!in_array(session()->get('role'), ['dinas', 'kabid', 'admin'])) {
            return redirect()->to('/unauthorized');
        }
        $perPage = 50; // Jumlah data per halaman
        $userId = session()->get('id'); // ID user dari sesi login

        // Ambil data cabang dinas berdasarkan user
        $db = \Config\Database::connect();
        $cabangDinasIds = $db->table('operator_cabang_dinas')
            ->select('cabang_dinas_id')
            ->where('user_id', $userId)
            ->get()
            ->getResultArray();

        $cabangDinasIds = array_column($cabangDinasIds, 'cabang_dinas_id');

        if (empty($cabangDinasIds)) {
            $cabangDinasIds = [0]; // Nilai default untuk menghindari error
        }

        // Ambil data untuk tabel kiri (usulan menunggu verifikasi)
        $usulanMenunggu = $this->verifikasiBerkasModel
            ->select('usulan.*,
                        cabang_dinas.kode_cabang, 
                        cabang_dinas.nama_cabang, 
                        pengiriman_usulan.dokumen_rekomendasi,
                        pengiriman_usulan.operator, 
                        pengiriman_usulan.no_hp,
                        pengiriman_usulan.updated_at as tanggal_dikirim, 
                        pengiriman_usulan.catatan,
                        pengiriman_usulan.status_usulan_cabdin')
            ->join('cabang_dinas',
                        'usulan.cabang_dinas_id = cabang_dinas.id', 'inner')
            ->join('pengiriman_usulan',
                        'usulan.nomor_usulan = pengiriman_usulan.nomor_usulan', 'inner')
            ->whereIn('usulan.cabang_dinas_id', $cabangDinasIds) // Filter berdasarkan cabang dinas pengguna
            ->where('pengiriman_usulan.status_usulan_cabdin', 'Terkirim') // Filter hanya data dengan status 'Terkirim'
            ->paginate($perPage, 'usulanMenunggu');

        $pagerMenunggu = $this->verifikasiBerkasModel->pager;

        // Ambil data untuk tabel kanan (usulan diverifikasi)
        $usulanDiverifikasi = $this->verifikasiBerkasModel
            ->select('usulan.*, cabang_dinas.kode_cabang, cabang_dinas.nama_cabang, 
                      pengiriman_usulan.dokumen_rekomendasi, pengiriman_usulan.operator, 
                      pengiriman_usulan.no_hp, pengiriman_usulan.updated_at as tanggal_dikirim, 
                      pengiriman_usulan.catatan, pengiriman_usulan.status_usulan_cabdin')
            ->join('cabang_dinas', 'usulan.cabang_dinas_id = cabang_dinas.id', 'inner')
            ->join('pengiriman_usulan', 'usulan.nomor_usulan = pengiriman_usulan.nomor_usulan', 'inner')
            ->whereIn('usulan.cabang_dinas_id', $cabangDinasIds) // Filter berdasarkan cabang dinas pengguna
            ->whereIn('pengiriman_usulan.status_usulan_cabdin', ['Lengkap', 'TdkLengkap']) // Tambahkan filter status Lengkap/TdkLengkap
            ->paginate($perPage, 'usulanDiverifikasi');

        $pagerDiverifikasi = $this->verifikasiBerkasModel->pager;

        // Data untuk view
        $data = [
            'usulanMenunggu' => $usulanMenunggu,
            'pagerMenunggu' => $pagerMenunggu,
            'usulanDiverifikasi' => $usulanDiverifikasi,
            'pagerDiverifikasi' => $pagerDiverifikasi,
        ];

        return view('verifikasi/index', $data);
    }
*/
    public function index()
    {
        $role = session()->get('role');
        $userId = session()->get('id');
        $perPage = 50;

        // Operator tidak bisa mengakses halaman verifikasi
        if ($role === 'operator') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $db = \Config\Database::connect();
        $cabangDinasIds = [];

        if ($role === 'dinas') {
            // Ambil cabang dinas berdasarkan user jika role adalah dinas
            $cabangDinasIds = $db->table('operator_cabang_dinas')
                ->select('cabang_dinas_id')
                ->where('user_id', $userId)
                ->get()
                ->getResultArray();

            $cabangDinasIds = array_column($cabangDinasIds, 'cabang_dinas_id');

            if (empty($cabangDinasIds)) {
                $cabangDinasIds = [0]; // Nilai default untuk menghindari error
            }
        }

        // Query untuk mengambil data usulan menunggu verifikasi
        $usulanMenunggu = $this->verifikasiBerkasModel
            ->select('usulan.*, cabang_dinas.kode_cabang, cabang_dinas.nama_cabang, 
                      pengiriman_usulan.dokumen_rekomendasi, pengiriman_usulan.operator, 
                      pengiriman_usulan.no_hp, pengiriman_usulan.updated_at as tanggal_dikirim, 
                      pengiriman_usulan.catatan, pengiriman_usulan.status_usulan_cabdin')
            ->join('cabang_dinas', 'usulan.cabang_dinas_id = cabang_dinas.id', 'inner')
            ->join('pengiriman_usulan', 'usulan.nomor_usulan = pengiriman_usulan.nomor_usulan', 'inner')
            ->where('pengiriman_usulan.status_usulan_cabdin', 'Terkirim')
            ->orderBy('tanggal_dikirim', 'ASC');

        // Jika role adalah dinas, filter berdasarkan cabang dinas yang menjadi kewenangannya
        if ($role === 'dinas') {
            $usulanMenunggu = $usulanMenunggu->whereIn('usulan.cabang_dinas_id', $cabangDinasIds);
        }

        $usulanMenunggu = $usulanMenunggu->paginate($perPage, 'usulanMenunggu');
        $pagerMenunggu = $this->verifikasiBerkasModel->pager;

        // Query untuk mengambil data usulan yang sudah diverifikasi
        $usulanDiverifikasi = $this->verifikasiBerkasModel
            ->select('usulan.*, cabang_dinas.kode_cabang, cabang_dinas.nama_cabang, 
                      pengiriman_usulan.dokumen_rekomendasi, pengiriman_usulan.operator, 
                      pengiriman_usulan.no_hp, pengiriman_usulan.updated_at as tanggal_dikirim, 
                      pengiriman_usulan.catatan, pengiriman_usulan.status_usulan_cabdin')
            ->join('cabang_dinas', 'usulan.cabang_dinas_id = cabang_dinas.id', 'inner')
            ->join('pengiriman_usulan', 'usulan.nomor_usulan = pengiriman_usulan.nomor_usulan', 'inner')
            ->whereIn('pengiriman_usulan.status_usulan_cabdin', ['Lengkap', 'TdkLengkap'])
            ->orderBy('pengiriman_usulan.updated_at', 'DESC');

        // Jika role adalah dinas, filter berdasarkan cabang dinas yang menjadi kewenangannya
        if ($role === 'dinas') {
            $usulanDiverifikasi = $usulanDiverifikasi->whereIn('usulan.cabang_dinas_id', $cabangDinasIds);
        }

        $usulanDiverifikasi = $usulanDiverifikasi->paginate($perPage, 'usulanDiverifikasi');
        $pagerDiverifikasi = $this->verifikasiBerkasModel->pager;

        // Kabid hanya bisa melihat (readonly)
        $readonly = ($role === 'kabid');

        // Data yang dikirim ke tampilan
        $data = [
            'usulanMenunggu' => $usulanMenunggu,
            'pagerMenunggu' => $pagerMenunggu,
            'usulanDiverifikasi' => $usulanDiverifikasi,
            'pagerDiverifikasi' => $pagerDiverifikasi,
            'readonly' => $readonly, // ✅ Kabid hanya bisa melihat
        ];

        return view('verifikasi/index', $data);
    }


    public function updateStatus()
    {
        $request = $this->request->getJSON(true); // Ambil data JSON dari client

        if (!isset($request['nomor_usulan'], $request['status'])) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap.'])->setStatusCode(400);
        }

        $nomorUsulan = $request['nomor_usulan'];
        $status = $request['status'];
        $catatan = $request['catatan'] ?? '';

        $db = \Config\Database::connect();

        try {
            if ($status === 'TdkLengkap') {
                // Update tabel pengiriman_usulan
                $db->table('pengiriman_usulan')
                    ->where('nomor_usulan', $nomorUsulan)
                    ->update([
                        'status_usulan_cabdin' => 'TdkLengkap',
                        'catatan' => $catatan
                    ]);

                // Tambahkan ke tabel usulan_status_history
                $db->table('usulan_status_history')
                    ->insert([
                        'nomor_usulan' => $nomorUsulan,
                        'status' => '02', // Status tetap 02
                        'updated_at' => date('Y-m-d H:i:s'),
                        'catatan_history' => "Proses Verifikasi Berkas di Dinas Provinsi (TdkLengkap). $catatan",
                    ]);

            } elseif ($status === 'Lengkap') {
                // Update tabel pengiriman_usulan
                $db->table('pengiriman_usulan')
                    ->where('nomor_usulan', $nomorUsulan)
                    ->update([
                        'status_usulan_cabdin' => 'Lengkap',
                        'catatan' => $catatan
                    ]);

                // Update tabel usulan
                $db->table('usulan')
                    ->where('nomor_usulan', $nomorUsulan)
                    ->update([
                        'status' => '03', // Status berubah menjadi 03
                    ]);

                // Tambahkan ke tabel usulan_status_history
                $db->table('usulan_status_history')
                    ->insert([
                        'nomor_usulan' => $nomorUsulan,
                        'status' => '03',
                        'updated_at' => date('Y-m-d H:i:s'),
                        'catatan_history' => "Proses Verifikasi Berkas di Dinas Provinsi (Lengkap). $catatan",
                    ]);
            }

            return $this->response->setJSON(['message' => 'Verifikasi berhasil diperbarui.']);
        } 
        catch (\Exception $e) {
        return $this->response->setJSON(['error' => $e->getMessage()])->setStatusCode(500);
        }
    }


}
