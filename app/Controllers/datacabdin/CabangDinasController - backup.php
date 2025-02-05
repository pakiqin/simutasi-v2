<?php

namespace App\Controllers\datacabdin;

use App\Controllers\BaseController;
use App\Models\CabangDinasModel;

class CabangDinasController extends BaseController
{
    protected $cabangDinasModel;

    public function __construct()
    {
        $this->cabangDinasModel = new CabangDinasModel();
    }

    public function index()
    {
        $perPage = $this->request->getVar('per_page') ?: 5; // Default jumlah data per halaman
        $currentPage = $this->request->getVar('page') ?: 1;

        $data = [
            'cabang_dinas' => $this->cabangDinasModel->paginate($perPage, 'cabang_dinas'),
            'pager' => $this->cabangDinasModel->pager,
            'perPage' => $perPage,
        ];

        return view('datacabdin/index', $data); // Path view harus sesuai dengan namespace
    }

    public function create()
    {
        return view('datacabdin/create'); // Path view untuk form tambah data
    }

    public function store()
    {
        $this->cabangDinasModel->save([
            'kode_cabang' => $this->request->getPost('kode_cabang'),
            'nama_cabang' => $this->request->getPost('nama_cabang'),
        ]);

        return redirect()->to('/cabang-dinas')->with('message', 'Cabang Dinas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = [
            'cabang_dinas' => $this->cabangDinasModel->find($id),
        ];
        return view('datacabdin/edit', $data);
    }

    public function update($id)
    {
        $this->cabangDinasModel->update($id, [
            'kode_cabang' => $this->request->getPost('kode_cabang'),
            'nama_cabang' => $this->request->getPost('nama_cabang'),
        ]);

        return redirect()->to('/cabang-dinas')->with('message', 'Cabang Dinas berhasil diperbarui!');
    }

    public function delete($id)
    {
        $this->cabangDinasModel->delete($id);
        return redirect()->to('/cabang-dinas')->with('message', 'Cabang Dinas berhasil dihapus!');
    }
}
