<?php 

namespace App\Controllers;
use App\Controllers\BaseController;

class Logout extends BaseController
{
    public function checkLogin()
{
    $session = session();
    if (!$session->has('isLoggedIn') || $session->get('isLoggedIn') !== true)
    {
        return redirect()->to('/login'); // Jika belum login, redirect ke halaman login
    }
}
public function login()
{
    $session = session();
    $session->set('isLoggedIn', true);
    return redirect()->to('/dashboard');
}

public function dashboard()
{
    $this->checkLogin(); // Panggil method checkLogin()
    // Lakukan proses lanjutan
}

public function logout()
{
    $session = session();
    $session->remove('isLoggedIn');
    return redirect()->to('/login');
}

    
}
