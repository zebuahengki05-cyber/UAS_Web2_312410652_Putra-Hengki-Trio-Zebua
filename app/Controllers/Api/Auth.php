<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class Auth extends ResourceController
{
    protected $format = 'json';

    public function login() 
    {
    // Tambahkan ini di paling atas method login agar tidak kena blokir
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    
        // 1. Menerima data dari request body
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $model = new UserModel();

        // 2. Cari user berdasarkan username atau email
        $user = $model->where('username', $username)
                      ->orWhere('useremail', $username)
                      ->first();

        // 3. Verifikasi password (karena di DB masih teks biasa)
        if ($user && ($password === $user['userpassword'])) {
            return $this->respond([
                'status' => 200,
                'error' => null,
                'messages' => 'Login Berhasil',
                'data' => [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'token' => base64_encode("TOKEN-SECRET-".$user['username'])
                ]
            ], 200);
        } else {
            return $this->failUnauthorized('Username atau Password yang Anda masukkan salah.');
        }
    }
}