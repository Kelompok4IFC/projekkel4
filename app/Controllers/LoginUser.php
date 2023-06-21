<?php

namespace App\Controllers;

class LoginUser extends BaseController
{
    public function index()
    {
        $UserModel = new \App\Models\Usermodel();
        $login = $this->request->getPost('login');
        if ($login) {
            $username = $this->request->getPost('karyawan_username');
            $password = $this->request->getPost('karyawan_password');

            if ($username == '' || $password == '') {
                $err = "Silahkan masukan username dan password";
            }
            
            if (empty($err)) {
                $datauser = $UserModel->where("username", $username)->first();
                if ($datauser === null) {
                    $err = "Username salah";
                } elseif ($datauser['password'] != md5($password)) {
                    $err = "Password salah";
                }
            }
            
            if (empty($err)) {
                $dataSesi = [
                    'id_user' => $datauser['id_user'],
                    'username' => $datauser['username'],
                    'karyawan_password' => $datauser['password'],
                ];
                session()->set($dataSesi);
                return redirect()->to('pengaduan');
            }

            if ($err) {
                session()->setFlashdata('username', $username);
                session()->setFlashdata('error', $err);
                return redirect()->to("loginuser");
            }
        }
        return view('loginuser');
    }        
    
}