<?php
namespace App\Controllers\akun;

use App\Controllers\BaseController;
use App\Models\UserModel;

class OperatorCabdinController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

       public function index()
    {
        $perPage = $this->request->getVar('per_page') ?: 5; // Default jumlah data per halaman

        // Ambil data pengguna dengan role 'operator' menggunakan paginate
        $users = $this->userModel->where('role', 'operator')->paginate($perPage, 'users');

        // Kirim data ke view
        $data = [
            'users' => $users,
            'pager' => $this->userModel->pager, // Tambahkan pager untuk pagination
            'perPage' => $perPage, // Tambahkan variabel perPage ke view
        ];

        return view('operatorcabdin/index', $data);
    }
    
    public function create()
    {
        return view('operatorcabdin/create');
    }

    public function store()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status' => $this->request->getPost('status') ?: 'enable',            
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'operator',
        ];
        $this->userModel->save($data);
        return redirect()->to('/operatorcabdin')->with('message', 'Operator Cabdin berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        return view('operatorcabdin/edit', ['user' => $user]);
    }

    public function update($id)
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),            
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status' => $this->request->getPost('status'),                        
        ];

        if (!empty($this->request->getPost('password'))) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);
        return redirect()->to('/operatorcabdin')->with('message', 'Operator Cabdin berhasil diperbarui!');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/operatorcabdin')->with('message', 'Operator Cabdin berhasil dihapus!');
    }


    public function enable($id)
    {
        $this->userModel->update($id, ['status' => 'enable']);
        return redirect()->to('/operatorcabdin')->with('message', 'User berhasil diaktifkan!');
    }

    public function disable($id)
    {
        $this->userModel->update($id, ['status' => 'disable']);
        return redirect()->to('/operatorcabdin')->with('message', 'User berhasil dinonaktifkan!');
    }
}
