<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin_Model extends Model
{
  protected $table = "admin";
  protected $primaryKey = "id_admin";
  protected $allowedFields = ['email', 'nama', 'kata_sandi'];

  public function getDataByEmail($email, $data = 'email')
  {
    $response = $this->select($data)->where(['email' => $email])->first();

    if (!is_null($response)) {
      return $response[$data];
    } else {
      return null;
    }
  }

  public function getDataById($id_admin, $data = 'email')
  {
    $response = $this->select($data)->where(['id_admin' => $id_admin])->first();

    if (!is_null($response)) {
      return $response[$data];
    } else {
      return null;
    }
  }
}
