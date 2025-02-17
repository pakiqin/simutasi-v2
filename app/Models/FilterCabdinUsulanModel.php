<?php

namespace App\Models;

use CodeIgniter\Model;

class FilterCabdinUsulanModel extends Model
{
    protected $table = 'usulan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nomor_usulan',
        'guru_nama',
        'guru_nip',
        'sekolah_asal',
        'status',
        'cabang_dinas_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Mendapatkan usulan berdasarkan status dan cabang dinas.
     *
     * @param string $status
     * @param string|null $cabangDinasId
     * @return array
     */
    public function getUsulanByStatus($status, $cabangDinasId = null, $limit = 10, $offset = 0)
    {
        $query = $this->where('status', $status);

        if ($cabangDinasId) {
            $query->where('cabang_dinas_id', $cabangDinasId); // Filter berdasarkan cabang dinas
        }

        return $query->orderBy('created_at', 'DESC')->findAll($limit, $offset);
    }
    
    public function getUsulanWithDokumenPaginated($status, $cabangDinasId = null, $perPage = 10)
    {
        $query = $this->select('usulan.*, pengiriman_usulan.dokumen_rekomendasi, pengiriman_usulan.status_usulan_cabdin, pengiriman_usulan.catatan')
            ->join('pengiriman_usulan', 'pengiriman_usulan.nomor_usulan = usulan.nomor_usulan', 'left')
            ->where('usulan.status', $status);

        if ($cabangDinasId) {
            $query->where('usulan.cabang_dinas_id', $cabangDinasId);
        }

        return $query->paginate($perPage, 'page_status02'); // Menggunakan pagination bawaan CI4
    }


    public function countUsulanByStatus($status, $cabangDinasId = null)
    {
        $query = $this->where('status', $status);

        if ($cabangDinasId) {
            $query->where('cabang_dinas_id', $cabangDinasId);
        }

        return $query->countAllResults();
    }

    public function countUsulanWithDokumen($status, $cabangDinasId = null)
    {
        $query = $this->db->table($this->table)
            ->join('pengiriman_usulan', 'pengiriman_usulan.nomor_usulan = usulan.nomor_usulan', 'left')
            ->where('usulan.status', $status);

        if ($cabangDinasId) {
            $query->where('usulan.cabang_dinas_id', $cabangDinasId);
        }

        return $query->countAllResults();
    }
}
