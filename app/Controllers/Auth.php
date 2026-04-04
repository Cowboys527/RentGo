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
        helper('log'); 

        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Username tidak ditemukan');
        }

        if ($user['status'] != 'aktif') {
            return redirect()->back()->with('error', 'User tidak aktif');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah');
        }

        
        $session->set([
            'id_user'   => $user['id_user'],
            'nama'      => $user['nama'],
            'role'      => $user['role'],
            'logged_in' => true
        ]);

       
        log_activity('Login ke sistem');

        // REDIRECT ROLE
        switch ($user['role']) {
            case 'admin':
                return redirect()->to('/admin/dashboard');
            case 'kasir':
                return redirect()->to('/kasir/dashboard');
            case 'owner':
                return redirect()->to('/owner/dashboard');
            default:
                return redirect()->to('/');
        }
    }

    public function logout()
    {
        helper('log');

       
        log_activity('Logout dari sistem');

        session()->destroy();
        return redirect()->to('/login');
    }
}