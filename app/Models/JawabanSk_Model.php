<?php

namespace App\Models;

use CodeIgniter\Model;

class JawabanSk_Model extends Model
{
  protected $table = "jawaban_sk";
  protected $primaryKey = "id_jawaban";
  protected $allowedFields = ["id_soal", "id_pertanyaan", "jawaban"];

  public function getAllData()
  {
    $response = $this->select("*")->findAll();

    if (!is_null($response)) {
      return $response;
    } else {
      return null;
    }
  }

  public function countDataById($id_soal)
  {
    $response = $this->select($id_soal)
      ->where(["id_soal" => $id_soal])
      ->countAllResults();

    if (!is_null($response)) {
      return $response;
    } else {
      return null;
    }
  }

  public function getDataById($id_soal)
  {
    $response = $this->select("*")
      ->where(["id_soal" => $id_soal])
      ->findAll();

    if (!is_null($response)) {
      return $response;
    } else {
      return null;
    }
  }
}
