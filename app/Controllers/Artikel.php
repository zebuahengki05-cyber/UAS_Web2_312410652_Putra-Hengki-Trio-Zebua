<?php

namespace App\Controllers;

use App\Models\ArtikelModel;

class Artikel extends BaseController
{
    protected $artikelModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
    }

    // --- GLOBAL CORS HANDLER ---
    public function _remap($method, ...$params)
    {
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');

        if ($this->request->getMethod() === 'options') {
            return $this->response->setStatusCode(200)->send();
        }

        if (method_exists($this, $method)) {
            return $this->$method(...$params);
        }
    }

    // --- API ENDPOINTS ---

    public function get_data_api()
    {
        $artikel = $this->artikelModel->findAll();
        
        return $this->response
            ->setHeader('Access-Control-Allow-Origin', '*')
            ->setJSON(['artikel' => $artikel]);
    }

    public function update_data_api($id = null)
    {
        $json = $this->request->getJSON();

        if (!$id || !$json) {
            return $this->response
                ->setHeader('Access-Control-Allow-Origin', '*')
                ->setStatusCode(400)
                ->setJSON(['status' => 'error', 'message' => 'Data tidak lengkap']);
        }

        $data = [
            'judul'  => $json->judul,
            'isi'    => $json->isi ?? '',
            'status' => (int)$json->status,
            'slug'   => url_title($json->judul, '-', true),
        ];

        if ($this->artikelModel->update($id, $data)) {
            return $this->response
                ->setHeader('Access-Control-Allow-Origin', '*')
                ->setJSON(['status' => 'success', 'message' => 'Data berhasil diupdate']);
        } else {
            return $this->response
                ->setHeader('Access-Control-Allow-Origin', '*')
                ->setStatusCode(500)
                ->setJSON(['status' => 'error', 'message' => 'Gagal update database']);
        }
    }

    public function delete_data_api($id = null)
    {
        if ($id && $this->artikelModel->delete($id)) {
            return $this->response
                ->setHeader('Access-Control-Allow-Origin', '*')
                ->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        }
        
        return $this->response
            ->setHeader('Access-Control-Allow-Origin', '*')
            ->setStatusCode(400)
            ->setJSON(['status' => 'error', 'message' => 'Gagal hapus']);
    }

    public function insert_data_api()
    {
        $this->response->setHeader('Access-Control-Allow-Origin', '*');

        $json = $this->request->getJSON();
        $data = [
            'judul'  => $json->judul,
            'status' => (int)$json->status,
            'slug'   => url_title($json->judul, '-', true),
        ];

        $this->artikelModel->insert($data);
        return $this->response->setJSON(['status' => 'success']);
    } // <-- Penutup fungsi insert_data_api

} // <-- Penutup class Artikel (INI YANG TADI HILANG)