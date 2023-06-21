<?php

namespace App\Controllers;

use App\Models\AssetModel;
use CodeIgniter\Controller;

class Asset extends BaseController
{
    public function index()
    {
        $model = new AssetModel();
        $data['assets'] = $model->findAll();

        return view('karyawan', $data);
    }

    public function save()
    {
        $model = new AssetModel();

        $data = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'jumlah' => $this->request->getPost('jumlah'),
        ];

        $model->insert($data);

        return redirect()->to('/karyawan');
    }

    public function edit($id)
    {
        $model = new AssetModel();
    
        $data['asset'] = $model->find($id);
    
        if (empty($data['asset'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data asset tidak ditemukan');
        }
    
        return view('karyawan', $data); // Ganti 'edit_asset' dengan nama view edit yang Anda inginkan
    }            

    public function update($id)
    {
        $model = new AssetModel();

        $data = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'jumlah' => $this->request->getPost('jumlah'),
        ];

        $model->update($id, $data);

        return redirect()->to('/karyawan');
    }

    public function delete($id)
    {
        $model = new AssetModel();

        $model->where('id', $id)->delete();

        return redirect()->to('/karyawan');
    }
}