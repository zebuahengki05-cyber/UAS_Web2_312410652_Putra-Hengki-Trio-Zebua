<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'slug', 'id_kategori', 'isi', 'status', 'gambar'];

    // Method ini digunakan oleh controller untuk menampilkan data join
    public function getArtikelWithKategori()
    {
        return $this->select('artikel.*, kategori.nama_kategori')
                    ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');
    }
}