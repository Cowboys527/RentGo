<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['user'] = $model->findAll();

        return view('admin/user/index', $data);
    }

    public function tambah()
    {
        return view('admin/user/tambah');
    }

    public function simpan()
    {
        $model = new UserModel();

        $model->save([
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'nama' => $this->request->getPost('nama'),
            'role' => $this->request->getPost('role'),
        ]);

        return redirect()->to('/admin/user');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);

        return view('admin/user/edit', $data);
    }

    public function update($id)
    {
        $model = new UserModel();

        $model->update($id, [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'nama' => $this->request->getPost('nama'),
            'role' => $this->request->getPost('role'),
        ]);

        return redirect()->to('/admin/user');
    }

    public function hapus($id)
    {
        $model = new UserModel();
        $model->delete($id);

        return redirect()->to('/admin/user');
    }
}
