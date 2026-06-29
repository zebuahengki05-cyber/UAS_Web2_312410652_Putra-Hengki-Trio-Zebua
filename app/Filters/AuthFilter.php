<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;

class AuthFilter implements FilterInterface
{
    use ResponseTrait;

    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine('Authorization');
        
        // Cek jika header ada dan dimulai dengan 'Bearer '
        if (!empty($header) && strpos($header, 'Bearer ') === 0) {
            return;
        }

        // KUNCI: Kirim balik respons JSON agar Axios tidak bingung
        return service('response')->setJSON([
            'status' => 401,
            'error' => 'Akses ditolak: Token tidak valid.'
        ])->setStatusCode(401);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}