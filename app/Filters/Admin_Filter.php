<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Admin_Filter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = NULL)
  {
    if (!session('adminid')) {
      return redirect()->to('/admin/masuk');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
  {
  }
}
