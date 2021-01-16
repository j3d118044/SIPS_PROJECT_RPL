<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth_Filter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = NULL)
  {
    if (!session('userid')) {
      return redirect()->to('/masuk');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
  {
  }
}
