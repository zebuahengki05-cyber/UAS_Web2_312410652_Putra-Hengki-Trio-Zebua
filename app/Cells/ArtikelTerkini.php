<?php

namespace App\Cells;

use CodeIgniter\View\Cell;

class ArtikelTerkini extends Cell
{
    // Ubah nama fungsi menjadi tampilkan() agar terbebas dari aturan kaku parent class
    public function tampilkan()
    {
        $data['artikel'] = [
            [
                'judul' => 'Selamat Datang di Kuliah Web 2',
                'slug'  => 'selamat-datang-di-kuliah-web-2'
            ],
            [
                'judul' => 'Tutorial View Layout CodeIgniter 4',
                'slug'  => 'tutorial-view-layout-codeigniter-4'
            ],
            [
                'judul' => 'Mengenal Fitur View Cell Modular',
                'slug'  => 'mengenal-fitur-view-cell-modular'
            ]
        ];
        
        return view('components/artikel_terkini', $data);
    }
}