<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $model = new UserModel();

        $keyword = $this->request->getGet('keyword');
        $role    = $this->request->getGet('role');

        if ($keyword) {
            $model->groupStart()
                  ->like('username', $keyword)
                  ->orLike('nama', $keyword)
                  ->groupEnd();
        }

        if ($role) {
            $model->where('role', $role);
        }

        $data['user']    = $model->paginate(5);
        $data['pager']   = $model->pager;
        $data['keyword'] = $keyword;
        $data['role']    = $role;

        return view('admin/user/index', $data);
    }

    public function tambah()
    {
        return view('admin/user/tambah');
    }

    public function simpan()
    {
        if (!$this->validate([
            'username' => 'required|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'nama'     => 'required',
            'role'     => 'required',
            'status'   => 'required'
        ])) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        $model->save([
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama'     => $this->request->getPost('nama'),
            'role'     => $this->request->getPost('role'),
            'status'   => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/user')
            ->with('success_user', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);
        return view('admin/user/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'username' => "required|is_unique[users.username,id_user,$id]",
            'nama'     => 'required',
            'role'     => 'required',
            'status'   => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $dataUpdate = [
            'username' => $this->request->getPost('username'),
            'nama'     => $this->request->getPost('nama'),
            'role'     => $this->request->getPost('role'),
            'status'   => $this->request->getPost('status'),
        ];

        if ($this->request->getPost('password')) {
            $dataUpdate['password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }

        $model = new UserModel();
        $model->update($id, $dataUpdate);

        return redirect()->to('/admin/user')
            ->with('success_user', 'User berhasil diupdate');
    }

    public function hapus($id)
    {
        $model = new UserModel();
        $model->delete($id);

        return redirect()->to('/admin/user')
            ->with('success_user', 'User berhasil dihapus');
    }
}