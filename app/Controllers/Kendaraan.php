<?php

namespace App\Controllers;
use App\Models\KendaraanModel;

class Kendaraan extends BaseController
{
    public function index()
    {
        $model = new KendaraanModel();
        $data['kendaraan'] = $model->findAll();

        return view('admin/kendaraan/index', $data);
    }

    public function tambah()
    {
        return view('admin/kendaraan/tambah');
    }

    public function simpan()
    {
        $model = new KendaraanModel();

        $model->save([
            'nama_kendaraan' => $this->request->getPost('nama_kendaraan'),
            'jenis' => $this->request->getPost('jenis'),
            'plat_nomor' => $this->request->getPost('plat_nomor'),
            'harga_sewa' => $this->request->getPost('harga_sewa'),
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/kendaraan');
    }

    public function edit($id)
    {
        $model = new KendaraanModel();
        $data['kendaraan'] = $model->find($id);

        return view('admin/kendaraan/edit', $data);
    }

    public function update($id)
    {
        $model = new KendaraanModel();

        $model->update($id, [
            'nama_kendaraan' => $this->request->getPost('nama_kendaraan'),
            'jenis' => $this->request->getPost('jenis'),
            'plat_nomor' => $this->request->getPost('plat_nomor'),
            'harga_sewa' => $this->request->getPost('harga_sewa'),
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/kendaraan');
    }

    public function hapus($id)
    {
        $model = new KendaraanModel();
        $model->delete($id);

        return redirect()->to('/admin/kendaraan');
    }
}
