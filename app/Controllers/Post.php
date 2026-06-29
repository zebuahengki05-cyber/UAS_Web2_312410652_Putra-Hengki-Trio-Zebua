<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ArtikelModel;

class Post extends ResourceController
{
    protected $format = 'json';

    // 1. GET ALL DATA (Membaca semua artikel) -> GET /post
    public function index()
    {
        $model = new ArtikelModel();
        $data = $model->findAll();
        
        return $this->respond([
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data artikel berhasil diambil.'
            ],
            'data'     => $data
        ], 200);
    }

    // 2. GET SINGLE DATA (Membaca satu artikel berdasarkan ID) -> GET /post/{id}
    public function show($id = null)
    {
        $model = new ArtikelModel();
        $data = $model->find($id);

        if ($data) {
            return $this->respond([
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Detail artikel berhasil ditemukan.'
                ],
                'data'     => $data
            ], 200);
        } else {
            return $this->failNotFound('Maaf, artikel dengan ID ' . $id . ' tidak ditemukan.');
        }
    }

    // 3. CREATE DATA (Menambah artikel baru) -> POST /post
    // 3. CREATE DATA (Menambah artikel baru secara aman) -> POST /post
    public function create()
    {
        $model = new ArtikelModel();
        
        // Ambil header Content-Type untuk mendeteksi jenis kiriman data
        $contentType = $this->request->header('Content-Type') ? $this->request->header('Content-Type')->getValue() : '';

        if (strpos($contentType, 'application/json') !== false) {
            // Jika dikirim sebagai RAW JSON murni
            $json = $this->request->getJSON();
            $judul = $json->judul ?? null;
            $isi   = $json->isi ?? null;
        } else {
            // Jika dikirim sebagai x-www-form-urlencoded atau form-data biasa
            $judul = $this->request->getPost('judul');
            $isi   = $this->request->getPost('isi');
        }

        // Validasi minimal agar database tidak jebol data kosong
        if (empty($judul) || empty($isi)) {
            return $this->fail('Kolom judul dan isi wajib diisi, bro!', 400);
        }

        $slug = url_title($judul, '-', true);

        $data = [
            'judul'       => $judul,
            'slug'        => $slug,
            'isi'         => $isi,
            'id_kategori' => 2, // Berikan ID kategori default yang ada di DB kamu
            'gambar'      => 'default.jpg'
        ];

        $model->insert($data);

        return $this->respondCreated([
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data artikel berhasil ditambahkan melalui API.'
            ]
        ]);
    }

    // 4. UPDATE DATA (Mengubah artikel berdasarkan ID) -> PUT /post/{id}
    public function update($id = null)
    {
        $model = new ArtikelModel();
        $json  = $this->request->getJSON();

        // Mengambil data inputan JSON put
        if ($json) {
            $data = [
                'judul' => $json->judul,
                'slug'  => url_title($json->judul, '-', true),
                'isi'   => $json->isi
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'judul' => $input['judul'] ?? null,
                'slug'  => isset($input['judul']) ? url_title($input['judul'], '-', true) : null,
                'isi'   => $input['isi'] ?? null
            ];
            // Bersihkan array dari data null yang tidak dikirim
            $data = array_filter($data);
        }

        // Pastikan datanya ada di database sebelum diupdate
        $cek = $model->find($id);
        if (!$cek) {
            return $this->failNotFound('Gagal update, artikel tidak ditemukan.');
        }

        $model->update($id, $data);

        return $this->respond([
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data artikel dengan ID ' . $id . ' berhasil diperbarui.'
            ]
        ], 200);
    }

    // 5. DELETE DATA (Menghapus artikel berdasarkan ID) -> DELETE /post/{id}
    public function delete($id = null)
    {
        $model = new ArtikelModel();
        $cek   = $model->find($id);

        if (!$cek) {
            return $this->failNotFound('Gagal menghapus, artikel tidak ditemukan.');
        }

        $model->delete($id);

        return $this->respond([
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data artikel berhasil dihapus.'
            ]
        ], 200);
    }
}