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
}
