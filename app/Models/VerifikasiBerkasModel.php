<?php

namespace App\Models;

use CodeIgniter\Model;

class VerifikasiBerkasModel extends Model
{
    protected $table = 'usulan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'guru_nama', 'guru_nip', 'sekolah_asal', 'sekolah_tujuan',
        'nomor_usulan', 'status', 'cabang_dinas_id', 'created_at'
    ];

    /**
     * ✅ Mendapatkan daftar usulan berdasarkan status tertentu dengan pagination
     */
    public function getUsulanByStatus($status, $cabangDinasIds = null, $perPage = 10, $paginationGroup = 'page_status03')
    {
        $query = $this->select('
                        usulan.*, 
                        cabang_dinas.nama_cabang, 
                        pengiriman_usulan.dokumen_rekomendasi, 
                        pengiriman_usulan.status_usulan_cabdin, 
                        pengiriman_usulan.operator, 
                        pengiriman_usulan.no_hp, 
                        pengiriman_usulan.updated_at AS tanggal_dikirim, 
                        pengiriman_usulan.catatan'
                    )
                    ->join('cabang_dinas', 'usulan.cabang_dinas_id = cabang_dinas.id', 'left') // ✅ Tambahkan relasi ke cabang_dinas
                    ->join('pengiriman_usulan', 'usulan.nomor_usulan = pengiriman_usulan.nomor_usulan', 'left') // ✅ Tambahkan relasi ke pengiriman_usulan
                    ->where('pengiriman_usulan.status_usulan_cabdin', $status)
                    ->orderBy('pengiriman_usulan.updated_at', 'ASC');

        if (!empty($cabangDinasIds)) {
            $query->whereIn('usulan.cabang_dinas_id', $cabangDinasIds);
        }

        return $query->paginate($perPage, $paginationGroup);
    }

    /**
     * ✅ Mendapatkan daftar usulan yang sudah diverifikasi dengan pagination
     */
    public function getUsulanWithDokumenPaginated($statuses, $cabangDinasIds = null, $perPage = 10, $paginationGroup = 'page_status04')
    {
        $query = $this->select('
                        usulan.*, 
                        cabang_dinas.nama_cabang, 
                        pengiriman_usulan.dokumen_rekomendasi, 
                        pengiriman_usulan.status_usulan_cabdin, 
                        pengiriman_usulan.operator, 
                        pengiriman_usulan.no_hp, 
                        pengiriman_usulan.updated_at AS tanggal_dikirim, 
                        pengiriman_usulan.catatan'
                    )
                    ->join('cabang_dinas', 'usulan.cabang_dinas_id = cabang_dinas.id', 'left') // ✅ Tambahkan kembali relasi ke cabang_dinas
                    ->join('pengiriman_usulan', 'pengiriman_usulan.nomor_usulan = usulan.nomor_usulan', 'left') // ✅ Pastikan join ke pengiriman_usulan
                    ->whereIn('pengiriman_usulan.status_usulan_cabdin', $statuses)
                    ->orderBy('pengiriman_usulan.updated_at', 'DESC');

        if (!empty($cabangDinasIds)) {
            $query->whereIn('usulan.cabang_dinas_id', $cabangDinasIds);
        }

        return $query->paginate($perPage, $paginationGroup);
    }
}
