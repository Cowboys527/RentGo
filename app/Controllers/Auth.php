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

    if (!$user) {
        return redirect()->back()->with('error', 'Username tidak ditemukan');
    }

    // Cek status aktif
    if ($user['status'] != 'aktif') {
        return redirect()->back()->with('error', 'User tidak aktif');
    }

    // Cek password hash
    if (!password_verify($password, $user['password'])) {
        return redirect()->back()->with('error', 'Password salah');
    }

    // Set session
    $session->set([
        'id_user'   => $user['id_user'],
        'nama'      => $user['nama'],
        'role'      => $user['role'],
        'logged_in' => true
    ]);

    // Redirect sesuai role
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
        session()->destroy();
        return redirect()->to('/login');
    }
}