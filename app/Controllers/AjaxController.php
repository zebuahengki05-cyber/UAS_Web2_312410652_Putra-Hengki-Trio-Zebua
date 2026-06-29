<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriModel;

class AjaxController extends BaseController
{
    protected $artikelModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
        $this->kategoriModel = new KategoriModel(); 
    }

    // Fungsi penting agar Frontend (VueJS) diizinkan mengakses Backend
    private function addCorsHeaders()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") { exit; }
    }

    // Mengambil data artikel untuk tabel
    public function admin_index()
    {
        $this->addCorsHeaders();

        // Menggunakan join sederhana
        $data = $this->artikelModel->select('artikel.*, kategori.nama_kategori')
                                   ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left')
                                   ->findAll();

        // Mengembalikan data sebagai JSON
        return $this->response->setJSON(['status' => true, 'artikel' => $data]);
    }

    // Menambah artikel baru
    public function insert()
    {
        $this->addCorsHeaders();
        $json = json_decode($this->request->getBody());
        
        if ($json) {
            $this->artikelModel->save([
                'judul'  => $json->judul,
                'slug'   => url_title($json->judul, '-', true),
                'isi'    => $json->isi,
                'status' => $json->status ?? 0,
                'gambar' => 'default.jpg'
            ]);
            return $this->response->setJSON(['status' => true, 'message' => 'Sukses ditambahkan!']);
        }
        return $this->response->setJSON(['status' => false, 'message' => 'Data tidak valid']);
    }

    // Mengedit artikel
    public function update($id)
    {
        $this->addCorsHeaders();
        $json = json_decode($this->request->getBody());
        
        if ($json) {
            $this->artikelModel->update($id, [
                'judul'  => $json->judul,
                'isi'    => $json->isi,
                'status' => $json->status
            ]);
            return $this->response->setJSON(['status' => true, 'message' => 'Sukses diupdate!']);
        }
        return $this->response->setJSON(['status' => false, 'message' => 'Data tidak valid']);
    }

    // Menghapus artikel
    public function delete($id)
    {
        $this->addCorsHeaders();
        $this->artikelModel->delete($id);
        return $this->response->setJSON(['status' => true, 'message' => 'Sukses dihapus!']);
    }
}