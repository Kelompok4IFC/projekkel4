<?php

namespace App\Controllers;

use App\Models\PengaduanModel;

class PengaduanUser extends BaseController
{
    public function index()
    {
    $pengaduanModel = new PengaduanModel();
    $data['pengaduan'] = $pengaduanModel->findAll();

    return view('pengaduan', $data);
    }

    public function savePengaduan()
    {
        $pengaduanModel = new PengaduanModel();
    
        // Ambil data pengaduan dari form
        $pengaduan = $this->request->getPost('pengaduan');
        $tanggal = $this->request->getPost('tanggal');
        $waktu = $this->request->getPost('waktu');
        $ruangan = $this->request->getPost('ruangan');
        $namaUser = $this->request->getPost('nama_user');
    
        // Simpan pengaduan ke database
        $pengaduanModel->save([
            'pengaduan' => $pengaduan,
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'ruangan' => $ruangan,
            'nama_user' => $namaUser
        ]);
    
        // Mengirimkan respons JSON ke client
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Pengaduan berhasil disimpan.'
        ]);
        return redirect()->to('/pengaduan');
    }
    public function logout(){
        session()->destroy();
        return redirect()->to('loginuser');
    }
}