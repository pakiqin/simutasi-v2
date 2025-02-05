<?php

namespace App\Models;

use CodeIgniter\Model;

class PengirimanUsulanModel extends Model
{
    protected $table = 'usulan'; // Nama tabel yang digunakan
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nomor_usulan',
        'guru_nama',
        'guru_nip',
        'sekolah_asal',
        'sekolah_tujuan',
        'status',
        'created_at',
        'updated_at',
        'google_drive_link'
    ];

    // Fungsi untuk mendapatkan data usulan dengan status tertentu
    public function getUsulanByStatus($status)
    {
        return $this->where('status', $status)->findAll();
    }

    // Fungsi untuk memperbarui status usulan
    public function updateStatus($nomorUsulan, $status)
    {
        return $this->where('nomor_usulan', $nomorUsulan)->set(['status' => $status])->update();
    }
}
