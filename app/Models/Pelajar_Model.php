<?php

namespace App\Models;

use CodeIgniter\Model;

class Pelajar_Model extends Model
{
  protected $table = "pelajar";
  protected $primaryKey = "id_pelajar";
  protected $allowedFields = [
    'email', 'nama', 'kata_sandi', 'organisasi', 'foto',
    'skor_kuis', 'waktu_kuis', 'aktivasi', 'token_akt', 'token_lks'
  ];

  public function getDataByEmail($email, $data = 'email')
  {
    $response = $this->select($data)->where(['email' => $email])->first();

    if (!is_null($response)) {
      return $response[$data];
    } else {
      return null;
    }
  }

  public function getDataById($id_pelajar, $data = 'email')
  {
    $response = $this->select($data)->where(['id_pelajar' => $id_pelajar])->first();

    if (!is_null($response)) {
      return $response[$data];
    } else {
      return null;
    }
  }

  public function getToken($id_pelajar)
  {
    return $this->select('token_akt')->where(['id_pelajar' => $id_pelajar])->first()['token_akt'];
  }
}
