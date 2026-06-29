<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function login()
    {
        // Menampilkan halaman login
        return view('user/login');
    }

    public function login_action()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Cari user berdasarkan email
        $user = $model->where('useremail', $email)->first();

        if ($user) {
            $pass = $user['userpassword'];
            
            // Verifikasi password (jika di DB teks biasa, gunakan $password == $pass)
            // Di sini kita pakai password_verify jika password di DB di-hash, atau cek manual sesuai modul
            if ($password == $pass || password_verify($password, $pass)) {
                
                $session_data = [
                    'id'       => $user['id'],
                    'username' => $user['username'],
                    'email'    => $user['useremail'],
                    'logged_in'=> TRUE
                ];
                
                $session->set($session_data);
                return redirect()->to('/admin/artikel');
                
            } else {
                $session->setFlashdata('msg', 'Password Salah, Bro!');
                return redirect()->to('/user/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email Tidak Ditemukan!');
            return redirect()->to('/user/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/user/login');
    }
}