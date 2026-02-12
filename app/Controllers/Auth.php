<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            if ($password == $user['password']) {

                $sessionData = [
                    'id_user' => $user['id_user'],
                    'nama'    => $user['nama'],
                    'role'    => $user['role'],
                    'logged_in' => true
                ];

                $session->set($sessionData);

                // Redirect berdasarkan role
                if ($user['role'] == 'admin') {
                    return redirect()->to('/admin/dashboard');
                } elseif ($user['role'] == 'kasir') {
                    return redirect()->to('/kasir/dashboard');
                } elseif ($user['role'] == 'owner') {
                    return redirect()->to('/owner/dashboard');
                }

            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak ditemukan');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
