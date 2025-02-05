<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
protected $allowedFields = ['username', 'password', 'role', 'cabang_dinas_id', 'email', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

public function getUsersWithCabang()
{
    return $this->select('users.*, cabang_dinas.kode_cabang, cabang_dinas.nama_cabang')
                ->join('cabang_dinas', 'cabang_dinas.id = users.cabang_dinas_id', 'left')
                ->findAll();
}

public function countAll()
{
    return $this->db->table($this->table)->countAllResults();
}


}
