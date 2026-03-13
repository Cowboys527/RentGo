<?php

namespace App\Controllers;
use App\Models\KendaraanModel;

class Kendaraan extends BaseController
{
    public function index()
    {
        $model = new KendaraanModel();

        $keyword = $this->request->getGet('keyword');
        $jenis   = $this->request->getGet('jenis');
        $status  = $this->request->getGet('status');

        if ($keyword) {
            $model->groupStart()
                  ->like('nama_kendaraan', $keyword)
                  ->orLike('plat_nomor', $keyword)
                  ->groupEnd();
        }

        if ($jenis) {
            $model->where('jenis', $jenis);
        }

        if ($status) {
            $model->where('status', $status);
        }

        $data['kendaraan'] = $model->paginate(5);
        $data['pager']     = $model->pager;

        $data['keyword'] = $keyword;
        $data['jenis']   = $jenis;
        $data['status']  = $status;

        return view('admin/kendaraan/index', $data);
    }

    public function tambah()
    {
        return view('admin/kendaraan/tambah');
    }

    public function simpan()
    {
        if (!$this->validate([
            'nama_kendaraan' => 'required',
            'jenis'          => 'required',
            'plat_nomor'     => 'required',
            'harga_sewa'     => 'required|numeric',
            'status'         => 'required',
        ])) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        $model = new KendaraanModel();
        $model->save($this->request->getPost());

        return redirect()->to('/admin/kendaraan')
                         ->with('success', 'Data kendaraan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $model = new KendaraanModel();
        $data['kendaraan'] = $model->find($id);

        return view('admin/kendaraan/edit', $data);
    }

    public function update($id)
    {
    if (!$this->validate([
        'nama_kendaraan' => 'required',
        'jenis'          => 'required',
        'plat_nomor'     => 'required',
        'harga_sewa'     => 'required|numeric',
    ])) {
        return redirect()->back()
                         ->withInput()
                         ->with('errors', $this->validator->getErrors());
    }

    $model = new KendaraanModel();
    $model->update($id, [
        'nama_kendaraan' => $this->request->getPost('nama_kendaraan'),
        'jenis'          => $this->request->getPost('jenis'),
        'plat_nomor'     => $this->request->getPost('plat_nomor'),
        'harga_sewa'     => $this->request->getPost('harga_sewa'),
    ]);

    return redirect()->to('/admin/kendaraan')
                     ->with('success', 'Data kendaraan berhasil diupdate');
    
    }
    public function hapus($id)
    {
        $model = new KendaraanModel();
        $model->delete($id);

        return redirect()->to('/admin/kendaraan')
                         ->with('success', 'Data kendaraan berhasil dihapus');
    }
}