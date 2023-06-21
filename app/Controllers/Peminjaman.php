<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use CodeIgniter\Controller;

class Peminjaman extends Controller
{
    public function index()
    {
        $model = new PeminjamanModel();
        $data['peminjaman'] = $model->findAll();

        return view('karyawan', $data);
    }

    public function save()
    {
        $model = new PeminjamanModel();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'nama_peminjam' => 'required',
            'nama_barang' => 'required',
            'tanggal' => 'required',
            'nama_penanggung_jawab' => 'required'
        ])) {
            $model->save([
                'nama_peminjam' => $this->request->getPost('nama_peminjam'),
                'nama_barang' => $this->request->getPost('nama_barang'),
                'tanggal' => $this->request->getPost('tanggal'),
                'nama_penanggung_jawab' => $this->request->getPost('nama_penanggung_jawab')
            ]);
        }

        return redirect()->to('/karyawan');
    }

    public function edit($id)
    {
        $model = new PeminjamanModel();
        $data['peminjaman'] = $model->find($id);

        return view('karyawan', $data);
    }

    public function update($id)
    {
        $model = new PeminjamanModel();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'nama_peminjam' => 'required',
            'nama_barang' => 'required',
            'tanggal' => 'required',
            'nama_penanggung_jawab' => 'required'
        ])) {
            $model->update($id, [
                'nama_peminjam' => $this->request->getPost('nama_peminjam'),
                'nama_barang' => $this->request->getPost('nama_barang'),
                'tanggal' => $this->request->getPost('tanggal'),
                'nama_penanggung_jawab' => $this->request->getPost('nama_penanggung_jawab')
            ]);
        }

        return redirect()->to('/karyawan');
    }

    public function delete($id)
    {
        $model = new PeminjamanModel();
        $model->delete($id);

        return redirect()->to('/karyawan');
    }
}