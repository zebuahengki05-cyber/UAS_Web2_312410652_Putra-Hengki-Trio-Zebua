<?php

namespace App\Filters; // <--- INI WAJIB SAMA DENGAN FOLDER

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CorsFilter implements FilterInterface 
{
    public function before(RequestInterface $request, $arguments = null) 
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        
        if ($request->getMethod() === 'options') {
            exit; // Berhenti di sini untuk request OPTIONS
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) 
    {
        // Kosongkan saja
    }
}