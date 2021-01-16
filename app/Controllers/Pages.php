<?php

namespace App\Controllers;

use App\Models\Admin_Model;
use App\Models\Pelajar_Model;
use App\Models\SoalSk_Model;
use App\Models\JawabanSk_Model;

class Pages extends BaseController
{
  public function __construct()
  {
    $this->admin = new Admin_Model();
    $this->pelajar = new Pelajar_Model();
    $this->soal = new SoalSk_Model();
    $this->jawaban = new JawabanSk_Model();

    $this->data["status"] = "pelajar";
    $this->data["email"] = $this->pelajar->getDataById(
      session()->get("userid"),
      "email"
    );
    $this->data["nama"] = $this->pelajar->getDataById(
      session()->get("userid"),
      "nama"
    );
    $this->data["foto"] = $this->pelajar->getDataById(
      session()->get("userid"),
      "foto"
    );
    $this->data["organisasi"] = $this->pelajar->getDataById(
      session()->get("userid"),
      "organisasi"
    );
    $this->data["validation"] = \Config\Services::validation();
  }

  public function landing()
  {
    $this->data["title"] = "Selamat Datang di SIPS";
    return view("pages/landing", $this->data);
  }

  public function tentang()
  {
    $this->data["title"] = "Tentang";
    return view("pages/tentang", $this->data);
  }

  public function daftar()
  {
    $this->data["title"] = "Daftar";
    return view("pages/daftar", $this->data);
  }

  public function masuk()
  {
    $this->data["title"] = "Masuk";
    return view("pages/masuk", $this->data);
  }

  public function beranda()
  {
    $this->data["route"] = "beranda";
    $this->data["title"] = "Beranda";
    return view("pages/beranda", $this->data);
  }

  public function materi($id)
  {
    if ($id > 0) {
      $this->data["route"] = "materi";
      $this->data["title"] = "Materi";
      return view("pages/materi/" . $id, $this->data);
    }
  }

  public function latihan()
  {
    if (session()->has("latihan_sk") and session()->has("current_soal")) {
      return redirect()->to("/latihan/" . session()->get("current_soal"));
    }

    $this->data["route"] = "latihan";
    $this->data["title"] = "Latihan Studi Kasus";
    return view("pages/latihan", $this->data);
  }

  public function latihanProses()
  {
    if ($this->request->getPost("latihan_sk")) {
      if ($this->request->getPost("latihan_sk") == "reset") {
        session()->remove("latihan_sk");
        session()->remove("jawaban_1_status");
        session()->remove("jawaban_2_status");
        session()->remove("jawaban_3_status");
      }
      return redirect()->to("/latihan");
    }

    $random = $this->soal
      ->select("*")
      ->orderBy("id_soal", "RANDOM")
      ->limit(3)
      ->get()
      ->getResultArray();

    if (count($random) < 3) {
      session()->setFlashdata("alert", [
        "type" => "danger",
        "message" =>
        "<strong>Ups!</strong> Terjadi kesalahan. Data soal belum lengkap.",
      ]);

      return redirect()->to("/latihan");
    } else {
      $index = 1;
      foreach ($random as $data) {
        $id_soal_arr["soal_" . $index] = [
          "index" => $index,
          "id_soal" => $data["id_soal"],
          "terjawab" => false,
        ];
        $index++;
      }
      session()->set("latihan_sk", $id_soal_arr);

      return redirect()->to("/latihan/1");
    }
  }

  public function latihanSoal($index)
  {
    if (session()->has("latihan_sk")) {
      $this->data["route"] = "latihan";
      $this->data["title"] = "Latihan Studi Kasus";
      $this->data["dataSoal"] = session()->get("latihan_sk")["soal_" . $index];
      $this->data["dataSoal"]["soal"] = $this->soal->getDataById(
        $this->data["dataSoal"]["id_soal"],
        "soal"
      )["soal"];
      $this->data["dataSoal"]["jumlah_jawaban"] = $this->jawaban->countDataById(
        $this->data["dataSoal"]["id_soal"]
      );

      session()->set("current_soal", $index);

      return view("pages/latihan_soal", $this->data);
    } else {
      return redirect()->to("/latihan");
    }
  }

  public function latihanSoalProses($index)
  {
    $jawaban_form = $this->request->getPost("jawaban");
    $id_soal = session()->get("latihan_sk")["soal_" . $index]["id_soal"];

    $jawaban_db = $this->jawaban->getDataById($id_soal);

    $statusJawaban = [];
    for ($i = 0; $i < count($jawaban_db); $i++) {
      if (
        strtolower($jawaban_form[$i]) == strtolower($jawaban_db[$i]["jawaban"])
      ) {
        $statusJawaban[] = [
          "status" => true,
          "jawaban" => $jawaban_form[$i],
        ];
      } else {
        $statusJawaban[] = [
          "status" => false,
          "jawaban" => $jawaban_form[$i],
        ];
      }
    }

    $this->data["route"] = "latihan";
    $this->data["title"] = "Latihan Studi Kasus";
    $this->data["dataSoal"] = session()->get("latihan_sk")["soal_" . $index];
    $this->data["dataSoal"]["soal"] = $this->soal->getDataById(
      $this->data["dataSoal"]["id_soal"],
      "soal"
    )["soal"];
    $this->data["dataSoal"]["pilihan_jawaban"] = $this->jawaban->getDataById(
      $this->data["dataSoal"]["id_soal"]
    );
    $this->data["dataSoal"]["jumlah_jawaban"] = $this->jawaban->countDataById(
      $this->data["dataSoal"]["id_soal"]
    );

    session()->set("jawaban_" . $index . "_status", $statusJawaban);
    session()->set(
      "jawaban_" . $index . "_pembahasan",
      $this->soal->getDataById(
        $this->data["dataSoal"]["id_soal"],
        "pembahasan"
      )["pembahasan"]
    );

    return view("pages/latihan_soal", $this->data);
  }

  public function kuis()
  {
    $this->data["route"] = "kuis";
    $this->data["title"] = "Kuis";
    return view("pages/kuis", $this->data);
  }

  public function kuisPost()
  {
    if ($this->request->isAJAX()) {
      $waktu = $this->request->getPost("waktu");
      $skor = $this->request->getPost("skor");

      $id_pelajar = $this->pelajar->getDataById(
        session()->get("userid"),
        "id_pelajar"
      );

      if ($id_pelajar) {
        $this->pelajar
          ->where(["id_pelajar" => $id_pelajar])
          ->set([
            "skor_kuis" => $skor,
            "waktu_kuis" => $waktu,
          ])
          ->update();
      }
    }
  }

  public function peringkat()
  {
    $dataPeringkat = $this->pelajar
      ->select(["nama", "foto", "organisasi", "skor_kuis", "waktu_kuis"])
      ->orderBy("skor_kuis desc, waktu_kuis asc, nama asc")
      ->where("skor_kuis !=", null)
      ->where("waktu_kuis !=", null)
      ->findAll(10);

    $this->data["route"] = "peringkat";
    $this->data["title"] = "Peringkat";
    $this->data["peringkat"] = $dataPeringkat;

    return view("pages/peringkat", $this->data);
  }

  public function profil()
  {
    $this->data["route"] = "profil";
    $this->data["title"] = "Profil";
    return view("pages/profil", $this->data);
  }

  public function ubahProfil()
  {
    $this->data["route"] = "ubah_profil";
    $this->data["title"] = "Ubah Profil";
    return view("pages/ubah_profil", $this->data);
  }

  public function ubahProfilProses()
  {
    $email = $this->request->getVar("email");
    $nama = $this->request->getVar("nama");
    $organisasi = $this->request->getVar("organisasi");

    if ($email !== $this->pelajar->getDataById(session()->get("userid"))) {
      if (
        !$this->validate([
          "email" => [
            "rules" => "required|valid_email|is_unique[pelajar.email]",
            "errors" => [
              "required" => "E-mail wajib diisi.",
              "valid_email" => "E-mail yang dimasukkan harus valid.",
              "is_unique" => "E-mail sudah terdaftar.",
            ],
          ],
        ])
      ) {
        session()->setFlashdata("alert", [
          "type" => "danger",
          "message" => "<strong>Ups!</strong> Data yang dimasukkan salah.",
        ]);

        return redirect()
          ->to("/ubah_profil")
          ->withInput();
      }
    }

    if (
      !$this->validate([
        "nama" => [
          "rules" => "required|alpha_space|min_length[3]|max_length[30]",
          "errors" => [
            "required" => "Nama wajib diisi.",
            "alpha_space" => "Nama hanya dapat diisi oleh huruf dan spasi.",
            "min_length" => "Panjang minimal adalah 3 karakter.",
            "max_length" => "Panjang maksimal adalah 30 karakter.",
          ],
        ],
        "organisasi" => [
          "rules" => "required|alpha_numeric_space|max_length[30]",
          "errors" => [
            "required" => "Organisasi wajib diisi.",
            "alpha_numeric_space" =>
            "Hanya dapat diisi oleh huruf, angka, dan spasi.",
            "max_length" => "Panjang maksimal adalah 30 karakter.",
          ],
        ],
        "foto" => [
          "rules" =>
          "max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]",
          "errors" => [
            "max_size" => "Maksimal ukuran foto adalah 1 MB.",
            "is_image" => "File harus berupa gambar.",
            "mime_in" => "File harus berupa gambar.",
          ],
        ],
      ])
    ) {
      session()->setFlashdata("alert", [
        "type" => "danger",
        "message" => "<strong>Ups!</strong> Data yang dimasukkan salah.",
      ]);

      return redirect()
        ->to("/ubah_profil")
        ->withInput();
    }

    // ambil data foto dari form
    $foto = $this->request->getFile("foto");
    $nama_db = $this->pelajar->getDataById(session()->get("userid"), "nama");
    $email_db = $this->pelajar->getDataById(session()->get("userid"), "email");
    $organisasi_db = $this->pelajar->getDataById(session()->get("userid"), "organisasi");

    if (
      ($nama === $nama_db) and
      ($email === $email_db) and
      ($organisasi === $organisasi_db) and
      (empty($foto->getName()))
    ) {
      session()->setFlashdata("alert", [
        "type" => "warning",
        "message" => "<strong>Ups!</strong> Tidak ada data yang berubah",
      ]);
      return redirect()
        ->to("/ubah_profil")
        ->withInput();
    }

    if ($foto->getError() == 4) {
      $namaFoto = $this->request->getVar("fotoLama");
    } else {
      if ($this->request->getVar("fotoLama") != "defaultpp.png") {
        unlink("assets/img/pelajar/" . $this->request->getVar("fotoLama"));
      }
      $namaFoto =
        strtolower(str_replace(" ", "_", $nama)) . "_" . $foto->getName();
      $foto->move("assets/img/pelajar", $namaFoto);
    }

    // update data pelajar
    $this->pelajar
      ->where(["id_pelajar" => session()->get("userid")])
      ->set([
        "email" => $email,
        "nama" => $nama,
        "organisasi" => $organisasi,
        "foto" => $namaFoto,
      ])
      ->update();

    session()->setFlashdata("alert", [
      "type" => "success",
      "message" => "<strong>Berhasil!</strong> Data berhasil diubah.",
    ]);
    return redirect()->to("/ubah_profil");
  }

  public function ubahKataSandi()
  {
    session();

    $this->data["route"] = "ubah_kata_sandi";
    $this->data["title"] = "Ubah Kata Sandi";

    return view("pages/ubah_kata_sandi", $this->data);
  }

  public function ubahKataSandiProses()
  {
    $currentpassword = $this->request->getPost("currentpassword");
    $password = $this->request->getPost("password");
    $repassword = $this->request->getPost("repassword");

    if (
      !$this->validate([
        "currentpassword" => [
          "rules" => "required|min_length[6]",
          "errors" => [
            "required" => "Kata sandi saat ini wajib diisi.",
            "min_length" => "Panjang minimal 6 karakter.",
          ],
        ],
        "password" => [
          "rules" => "required|min_length[6]",
          "errors" => [
            "required" => "Kata sandi baru wajib diisi.",
            "min_length" => "Panjang minimal 6 karakter.",
          ],
        ],
        "repassword" => [
          "rules" => "required|matches[password]",
          "errors" => [
            "required" => "Kata sandi konfirmasi wajib diisi.",
            "matches" => "Kata sandi konfirmasi tidak sesuai.",
          ],
        ],
      ])
    ) {
      session()->setFlashdata("alert", [
        "type" => "danger",
        "message" => "<strong>Ups!</strong> Data yang dimasukkan salah.",
      ]);

      return redirect()
        ->to("/ubah_kata_sandi")
        ->withInput();
    }

    // cek kata sandi lama dengan yang ada di database
    if (
      !password_verify(
        $currentpassword,
        $this->pelajar->getDataById(session()->get("userid"), "kata_sandi")
      )
    ) {
      session()->setFlashdata("alert", [
        "type" => "danger",
        "message" => "<strong>Ups!</strong> Kata sandi lama tidak sesuai.",
      ]);
      return redirect()
        ->to("/ubah_kata_sandi")
        ->withInput();
    }

    // cek kata sandi baru dengan kata sandi lama
    if ($currentpassword == $password) {
      session()->setFlashdata("alert", [
        "type" => "warning",
        "message" =>
        "<strong>Ups!</strong> Silakan gunakan kombinasi baru untuk kata sandi baru.",
      ]);
      return redirect()
        ->to("/ubah_kata_sandi")
        ->withInput();
    }

    // ubah kata sandi
    $this->pelajar
      ->where(["id_pelajar" => session()->get("userid")])
      ->set([
        "kata_sandi" => password_hash($password, PASSWORD_DEFAULT, [
          "cost" => 10,
        ]),
      ])
      ->update();

    session()->setFlashdata("alert", [
      "type" => "success",
      "message" => "<strong>Berhasil!</strong> Kata sandi berhasil diubah.",
    ]);
    return redirect()->to("/ubah_kata_sandi");
  }
}
