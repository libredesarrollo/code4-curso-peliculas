<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class MiFiltro implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if (false) {
            return redirect()->to('/dashboard/categoria');
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
