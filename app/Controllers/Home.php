<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title'   => 'Halaman Utama',
            'content' => 'Selamat datang di praktikum CodeIgniter 4 kami. Ini adalah konten yang dipanggil menggunakan konsep View Layout.'
        ];

        return view('home', $data);
    }
}