<?php

namespace App\Models;

use CodeIgniter\Model;

class SoalSk_Model extends Model
{
  protected $table = "soal_sk";
  protected $primaryKey = "id_soal";
  protected $allowedFields = ["soal", "pembahasan"];

  public function getAllData()
  {
    $response = $this->select("*")->findAll();

    if (!is_null($response)) {
      return $response;
    } else {
      return null;
    }
  }

  public function getDataById($id_soal, $data = "*")
  {
    $response = $this->select($data)
      ->where(["id_soal" => $id_soal])
      ->first();

    if (!is_null($response)) {
      return $response;
    } else {
      return null;
    }
  }

  public function getIdBySoal($soal)
  {
    $response = $this->select("id_soal")
      ->where(["soal" => $soal])
      ->first();

    if (!is_null($response)) {
      return $response;
    } else {
      return null;
    }
  }
}
