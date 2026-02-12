<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function dashboard()
    {
        if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }
        return view('admin/dashboard');
    }
}
