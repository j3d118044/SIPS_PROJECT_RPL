<?php

namespace App\Controllers;

use App\Models\Pelajar_Model;

class Auth extends BaseController
{

  public function __construct()
  {
    $this->pelajar = new Pelajar_Model;
  }

  public function landing()
  {
    $this->data = [
      'title' => 'Selamat Datang di SIPS',
    ];
    return view('pages/landing', $this->data);
  }

  public function daftar()
  {
    session();

    $data = [
      'title' => 'Daftar',
      'validation' => \Config\Services::validation()
    ];

    return view('auth/daftar', $data);
  }

  public function daftarProses()
  {
    $email = $this->request->getVar('email');
    $nama = $this->request->getVar('nama');
    $password = $this->request->getVar('password');
    $repassword = $this->request->getVar('repassword');
    $organisasi = $this->request->getVar('organisasi');

    if (!$this->validate([
      'email' => [
        'rules' => 'required|valid_email|is_unique[pelajar.email]',
        'errors' =>  [
          'required' => 'E-mail wajib diisi.',
          'valid_email' => 'E-mail yang dimasukkan harus valid.',
          'is_unique' => 'E-mail sudah terdaftar.'
        ]
      ],
      'nama' => [
        'rules' => 'required|alpha_space|min_length[3]|max_length[30]',
        'errors' => [
          'required' => 'Nama wajib diisi.',
          'alpha_space' => 'Nama hanya dapat diisi oleh huruf dan spasi.',
          'min_length' => 'Panjang minimal adalah 3 karakter.',
          'max_length' => 'Panjang maksimal adalah 30 karakter.',
        ]
      ],
      'password' => [
        'rules' => 'required|min_length[6]',
        'errors' => [
          'required' => 'Kata sandi wajib diisi.',
          'min_length' => 'Panjang minimal adalah 6 karakter.'
        ]
      ],
      'repassword' => [
        'rules' => 'required|matches[password]',
        'errors' => [
          'required' => 'Kata sandi konfirmasi wajib diisi.',
          'matches' => 'Kata sandi konfirmasi harus sesuai.'
        ]
      ],
      'organisasi' => [
        'rules' => 'required|alpha_numeric_space|max_length[30]',
        'errors' => [
          'required' => 'Organisasi wajib diisi.',
          'alpha_numeric_space' => 'Hanya dapat diisi oleh huruf, angka, dan spasi.',
          'max_length' => 'Panjang maksimal adalah 30 karakter.'
        ]
      ],
      'foto' => [
        'rules' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'uploaded' => 'Foto harus diupload.',
          'max_size' => 'Maksimal ukuran foto adalah 1 MB.',
          'is_image' => 'File harus berupa gambar.',
          'mime_in' => 'File harus berupa gambar.',
        ]
      ]
    ])) {

      session()->setFlashdata(
        'alert',
        [
          'type' => 'danger',
          'message' => '<strong>Ups!</strong> Data yang dimasukkan salah.'
        ]
      );

      return redirect()->to('/daftar')->withInput();
    }

    $foto = $this->request->getFile('foto');
    $namaFoto = strtolower(str_replace(' ', '_', $nama)) . '_' . $foto->getName();
    $foto->move('assets/img/pelajar', $namaFoto);

    $token_aktivasi = $this->getToken(100);
    $this->pelajar->save([
      'email' => $email,
      'nama' => $nama,
      'kata_sandi' => password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]),
      'organisasi' => $organisasi,
      'foto' => $namaFoto,
      'aktivasi' => 0,
      'token_akt' => $token_aktivasi
    ]);

    $kirimEmail = $this->kirimEmail('aktivasi', $email, $token_aktivasi);

    session()->set('temp_email', $email);
    session()->markAsTempdata('temp_email', 120);

    if ($kirimEmail) {
      session()->setFlashdata(
        'alert',
        [
          'type' => 'success',
          'message' => '<strong>Berhasil!</strong> Silakan cek email. Apabila tidak terkirim, silakan kirim ulang melalui link <a href="' . site_url('/aktivasi/kirim_ulang') . '">berikut</a>.'
        ]
      );

      return redirect()->to('/masuk');
    } else {
      session()->setFlashdata(
        'alert',
        [
          'type' => 'danger',
          'message' => '<strong>Gagal!</strong> Link aktivasi tidak terkirim. Silakan kirim ulang melalui link <a href="' . site_url('/aktivasi/kirim_ulang') . '">berikut</a>.'
        ]
      );

      return redirect()->to('/masuk');
    }
  }

  public function aktivasi()
  {
    // session();

    $data = [
      'title' => 'Aktivasi',
      'validation' => \Config\Services::validation()
    ];

    return view('auth/aktivasi', $data);
  }

  public function aktivasiProses()
  {
    $email_form = $this->request->getVar('email');

    if (!$this->validate([
      'email' => [
        'rules' => 'required|valid_email',
        'errors' =>  [
          'required' => 'E-mail wajib diisi.',
          'valid_email' => 'E-mail yang dimasukkan harus valid.'
        ]
      ]
    ])) {
      session()->setFlashdata(
        'alert',
        [
          'type' => 'danger',
          'message' => '<strong>Ups!</strong> Data yang dimasukkan salah.'
        ]
      );
      return redirect()->to('/aktivasi/kirim_ulang')->withInput();
    }

    $email_db = $this->pelajar->getDataByEmail($email_form);
    $aktivasi = $this->pelajar->getDataByEmail($email_form, 'aktivasi');

    if ($email_db and ($email_db === $email_form)) {
      if ($aktivasi == 0) {
        $kirimEmail = $this->kirimEmail("aktivasi", $email_db, $this->pelajar->getDataByEmail($email_db, 'token_akt'));

        if ($kirimEmail) {
          session()->set("timer_status", "started");
          session()->setFlashdata(
            'alert',
            [
              'type' => 'success',
              'message' => '<strong>Berhasil!</strong> Silakan cek e-mail.'
            ]
          );
          return redirect()->to('/aktivasi/kirim_ulang');
        } else {
          session()->setFlashdata(
            'alert',
            [
              'type' => 'danger',
              'message' => '<strong>Gagal!</strong> Silakan coba dalam beberapa saat lagi.'
            ]
          );
          return redirect()->to('/aktivasi/kirim_ulang');
        }
      } else {
        session()->setFlashdata(
          'alert',
          [
            'type' => 'warning',
            'message' => '<strong>Ups!</strong> Akun sudah aktif. Silakan <a href="' . site_url('/masuk') . '">masuk</a>.'
          ]
        );
        return redirect()->to('/aktivasi/kirim_ulang')->withInput();
      }
    } else {
      session()->setFlashdata(
        'alert',
        [
          'type' => 'danger',
          'message' => '<strong>Ups!</strong> Data yang dimasukkan salah.'
        ]
      );
      return redirect()->to('/aktivasi/kirim_ulang')->withInput();
    }
  }

  public function aktivasiAkun($token_form, $id_pelajar)
  {
    $token_db = $this->pelajar->getToken($id_pelajar);

    if ($token_db and ($token_db === $token_form)) {
      // token sesuai
      $this->pelajar
        ->where(['id_pelajar' => $id_pelajar])
        ->set([
          'aktivasi' => 1,
          'token_akt' => null
        ])
        ->update();

      session()->setFlashdata(
        'alert',
        [
          'type' => 'success',
          'message' => '<strong>Berhasil!</strong> Silakan login.'
        ]
      );

      return redirect()->to('/masuk')->withInput();
    } else {

      return redirect()->to('/masuk')->withInput();
    }
  }

  public function masuk()
  {
    if (session('userid')) {
      return redirect()->to('/beranda');
    }

    $data = [
      'title' => 'Masuk',
      'validation' => \Config\Services::validation()
    ];

    return view('auth/masuk', $data);
  }

  public function masukProses()
  {
    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password');

    if (!$this->validate([
      'email' => [
        'rules' => 'required|valid_email',
        'errors' =>  [
          'required' => 'E-mail wajib diisi.',
          'valid_email' => 'E-mail yang dimasukkan harus valid.'
        ]
      ],
      'password' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Kata sandi wajib diisi.',
        ]
      ]
    ])) {

      session()->setFlashdata(
        'alert',
        [
          'type' => 'danger',
          'message' => '<strong>Ups!</strong> Data yang dimasukkan salah.'
        ]
      );

      return redirect()->to('/masuk')->withInput();
    }

    // cek email
    if ($this->pelajar->getDataByEmail($email, 'email')) {
      // cek kata sandi
      if (password_verify($password, $this->pelajar->getDataByEmail($email, 'kata_sandi'))) {
        // cek aktivasi
        if ($this->pelajar->getDataByEmail($email, 'aktivasi') === "1") {
          // set session
          session()->set("userid", $this->pelajar->getDataByEmail($email, 'id_pelajar'));
          return redirect()->to('/beranda');
        } else {
          // belum aktivasi
          session()->setFlashdata(
            'alert',
            [
              'type' => 'warning',
              'message' => '<strong>Ups!</strong> Silakan aktivasi akun terlebih dahulu <a href="' . site_url('/aktivasi/kirim_ulang') . '">disini</a>'
            ]
          );
          return redirect()->to('/masuk')->withInput();
        }
      } else {
        // password salah
        session()->setFlashdata(
          'alert',
          [
            'type' => 'danger',
            'message' => '<strong>Ups!</strong> Kata sandi tidak sesuai.'
          ]
        );
        return redirect()->to('/masuk')->withInput();
      }
    } else {
      // email tidak terdaftar
      session()->setFlashdata(
        'alert',
        [
          'type' => 'danger',
          'message' => '<strong>Ups!</strong> Email tidak sesuai.'
        ]
      );
      return redirect()->to('/masuk')->withInput();
    }
  }

  public function keluar()
  {
    session()->remove('userid');
    return redirect()->to('/masuk');
  }

  public function lupaKataSandi()
  {
    $data = [
      'title' => 'Lupa Kata Sandi',
      'validation' => \Config\Services::validation()
    ];

    return view('auth/kata_sandi_lupa', $data);
  }

  public function lupaKataSandiProses()
  {
    $email_form = $this->request->getVar('email');
    $email_db = $this->pelajar->getDataByEmail($email_form, 'email');

    if (!$this->validate([
      'email' => [
        'rules' => 'required|valid_email',
        'errors' =>  [
          'required' => 'E-mail wajib diisi.',
          'valid_email' => 'E-mail yang dimasukkan harus valid.'
        ]
      ]
    ])) {

      session()->setFlashdata(
        'alert',
        [
          'type' => 'danger',
          'message' => '<strong>Ups!</strong> Data yang dimasukkan salah.'
        ]
      );

      return redirect()->to('/kata_sandi/lupa')->withInput();
    }

    // jika email sesuai
    if ($email_db and ($email_db === $email_form)) {
      // cek token, udah ada atau belum
      if (!$this->pelajar->getDataByEmail($email_form, 'token_lks')) {
        $token_kata_sandi = $this->getToken(100);
        $this->pelajar
          ->where(['id_pelajar' => $this->pelajar->getDataByEmail($email_form, 'id_pelajar')])
          ->set([
            'token_lks' => $token_kata_sandi
          ])
          ->update();
      } else {
        // kalau udah ada, ambil aja datanya
        $token_kata_sandi = $this->pelajar->getDataByEmail($email_form, 'token_lks');
      }

      $kirimEmail = $this->kirimEmail('lupa_kata_sandi', $email_form, $token_kata_sandi);

      if ($kirimEmail) {
        session()->set("timer_lupa_kata_sandi", "started");
        session()->set("temp_email", $email_db);
        session()->markAsTempdata("temp_email", 120);

        session()->setFlashdata(
          'alert',
          [
            'type' => 'success',
            'message' => '<strong>Berhasil!</strong> Silakan cek e-mail.'
          ]
        );
        return redirect()->to('/kata_sandi/lupa');
      } else {
        session()->setFlashdata(
          'alert',
          [
            'type' => 'danger',
            'message' => '<strong>Gagal!</strong> Silakan coba dalam beberapa saat lagi.'
          ]
        );
        return redirect()->to('/kata_sandi/lupa');
      }
    } else {
      session()->setFlashdata(
        'alert',
        [
          'type' => 'danger',
          'message' => '<strong>Gagal!</strong> E-mail yang dimasukkan salah.'
        ]
      );
      return redirect()->to('/kata_sandi/lupa')->withInput();
    }
  }

  public function aturUlangKataSandi($token_uri = '', $id_pelajar = '')
  {
    if (!empty($token_uri) and !empty($id_pelajar)) {
      $token_db = $this->pelajar->getDataById($id_pelajar, 'token_lks');
      $id_pelajar_db = $this->pelajar->getDataById($id_pelajar, 'id_pelajar');
      if (
        ($token_db and ($token_db === $token_uri))
        and
        ($id_pelajar_db and ($id_pelajar_db === $id_pelajar))
      ) {

        $data = [
          'title' => 'Ubah Kata Sandi',
          'validation' => \Config\Services::validation(),
          'id' => $id_pelajar_db,
          'token' => $token_db
        ];

        return view('auth/kata_sandi_atur_ulang', $data);
      } else {

        session()->setFlashdata(
          'alert',
          [
            'type' => 'danger',
            'message' => '<strong>Gagal!</strong> Link tidak valid.'
          ]
        );

        return redirect()->to('/kata_sandi/lupa');
      }
    } else {

      session()->setFlashdata(
        'alert',
        [
          'type' => 'warning',
          'message' => '<strong>Gagal!</strong> Silakan masukkan e-mail terlebih dahulu.'
        ]
      );
      return redirect()->to('/kata_sandi/lupa');
    }
  }

  public function aturUlangKataSandiProses()
  {
    $id_pelajar = $this->request->getVar('id');
    $token_kata_sandi = $this->request->getVar('token');
    $password = $this->request->getVar('password');
    $repassword = $this->request->getVar('repassword');

    if (!$this->validate([
      'id' => [
        'rules' => 'required',
        'errors' =>  [
          'required' => '',
        ]
      ],
      'token' => [
        'rules' => 'required',
        'errors' =>  [
          'required' => '',
        ]
      ],
      'password' => [
        'rules' => 'required|min_length[6]',
        'errors' => [
          'required' => 'Kata sandi wajib diisi.',
          'min_length' => 'Panjang minimal 6 karakter.'
        ]
      ],
      'repassword' => [
        'rules' => 'required|matches[password]',
        'errors' => [
          'required' => 'Kata sandi konfirmasi wajib diisi.',
          'matches' => 'Kata sandi konfirmasi tidak sesuai.'
        ]
      ]
    ])) {

      session()->setFlashdata(
        'alert',
        [
          'type' => 'danger',
          'message' => '<strong>Ups!</strong> Data yang dimasukkan salah.'
        ]
      );

      return redirect()->to('/kata_sandi/atur_ulang/' . $token_kata_sandi . '/' . $id_pelajar)->withInput();
    }

    // ubah kata sandi
    $this->pelajar
      ->where(['id_pelajar' => $id_pelajar])
      ->set([
        'kata_sandi' => password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]),
        'token_lks' => null
      ])
      ->update();

    session()->setFlashdata(
      'alert',
      [
        'type' => 'success',
        'message' => '<strong>Berhasil!</strong> Kata sandi berhasil diubah. Silakan masuk.'
      ]
    );
    return redirect()->to('/masuk');
  }

  public function crypto_rand_secure($min, $max)
  {
    $range = $max - $min;
    if ($range < 1) return $min;
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1;
    $bits = (int) $log + 1;
    $filter = (int) (1 << $bits) - 1;
    do {
      $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
      $rnd = $rnd & $filter;
    } while ($rnd > $range);
    return $min + $rnd;
  }

  public function getToken($length)
  {
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    $max = strlen($codeAlphabet);
    for ($i = 0; $i < $length; $i++) {
      $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];
    }
    return $token;
  }

  public function kirimEmail($mode, $email, $token)
  {
    $id_pelajar = $this->pelajar->getDataByEmail($email, 'id_pelajar');

    // potong nama
    $nama = $this->pelajar->getDataByEmail($email, 'nama');

    // cek mode kirimnya, aktivasi atau lupa kata sandi
    // disini buat bedain pesan body-nya
    if ($mode == 'aktivasi') {
      $subjek = 'Aktivasi Akun SIPS';
      $link = site_url('/aktivasi/' . $token . '/' . $id_pelajar);
      $pesan = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.=
      w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        </head>
        <body style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; background-color: #f8fafc; color: #74787e; height: 100%; hyphens: auto;line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">
          <style>
            @media  only screen and (max-width: 600px) {
                .inner-body {
                  width: 100% !important;
                }
      
                .footer {
                  width: 100% !important;
                }
            }
      
            @media  only screen and (max-width: 500px) {
                .button {
                  width: 100% !important;
                }
            }
          </style>
          <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; background-color: #f8fafc; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
            <tr>
              <td align="center" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system,BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                  <tr>
                    <td class="header" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; padding: 25px 0; text-align: center;">
                      <a href="#" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #37375f; font-size: 19px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
                        SIPS
                      </a>
                    </td>
                  </tr>
                  <!-- Email Body -->
                  <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; background-color: #ffffff; border-bottom: 1px solid #edeff2; border-top: 1px solid #edeff2; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                      <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; background-color: #ffffff; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
                        <!-- Body content -->
                        <tr>
                          <td class="content-cell" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; padding: 35px;">
                            <h1 style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3D4852; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">Halo ' . $nama . ',</h1>
                            <p style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3D4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Terima kasih telah bergabung di aplikasi SIPS.</p>
                            <p style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3D4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Silakan aktivasi akun terlebih dahulu dengan menekan tombol dibawah ini:</p>
                            <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; margin: 30px auto; padding: 0; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                              <tr>
                                <td align="center" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                                    <tr>
                                      <td align="center" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                                          <tr>
                                            <td style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                                              <a href="' . $link . '" class="button button-primary" target="_blank" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; border-radius: 2rem; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #fff; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #37375f; border-top: 10px solid #37375f; border-right: 18px solid #37375f; border-bottom: 10px solid #37375f; border-left: 18px solid #37375f;">Aktivasi
                                              </a>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                            <p style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3D4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Salam hangat,<br>Kelompok 5 RPL</p>
      
                            <table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; border-top: 1px solid #edeff2; margin-top: 25px; padding-top: 25px;">
                              <tr>
                                <td style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                                  <p style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3D4852; line-height: 1.5em; margin-top: 0; text-align: left; font-size: 12px;">If you\'re having trouble clicking the "Aktivasi" button, copy and paste the URL below into your web browser: <a href="' . $link . '" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3869d4;">' . $link . '</a>
                                  </p>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                      <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
                        <tr>
                          <td class="content-cell" align="center" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; padding: 35px;">
                          <p style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; line-height: 1.5em; margin-top: 0; color: #aeaeae; font-size: 12px; text-align: center;">© 2020 Kelompok 5 RPL. All rights reserved.</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </body>
      </html>';
    } else if ($mode == 'lupa_kata_sandi') {
      $subjek = 'Atur Ulang Kata Sandi Akun SIPS';
      $link = site_url('/kata_sandi/atur_ulang/' . $token . '/' . $id_pelajar);
      $pesan = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.=
      w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        </head>
        <body style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; background-color: #f8fafc; color: #74787e; height: 100%; hyphens: auto;line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">
          <style>
            @media  only screen and (max-width: 600px) {
                .inner-body {
                  width: 100% !important;
                }
      
                .footer {
                  width: 100% !important;
                }
            }
      
            @media  only screen and (max-width: 500px) {
                .button {
                  width: 100% !important;
                }
            }
          </style>
          <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; background-color: #f8fafc; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
            <tr>
              <td align="center" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system,BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                  <tr>
                    <td class="header" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; padding: 25px 0; text-align: center;">
                      <a href="#" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #37375f; font-size: 19px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
                        SIPS
                      </a>
                    </td>
                  </tr>
                  <!-- Email Body -->
                  <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; background-color: #ffffff; border-bottom: 1px solid #edeff2; border-top: 1px solid #edeff2; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                      <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; background-color: #ffffff; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
                        <!-- Body content -->
                        <tr>
                          <td class="content-cell" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; padding: 35px;">
                            <h1 style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3D4852; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">Halo ' . $nama . ',</h1>
                            <p style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3D4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;"></p>
                            <p style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3D4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Email ini kamu terima atas permintaan untuk mengatur ulang kata sandi akunmu pada SIPS.</p>
                            <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; margin: 30px auto; padding: 0; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                              <tr>
                                <td align="center" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                                    <tr>
                                      <td align="center" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                                          <tr>
                                            <td style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                                              <a href="' . $link . '" class="button button-primary" target="_blank" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #fff; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #37375f; border-top: 10px solid #37375f; border-right: 18px solid #37375f; border-bottom: 10px solid #37375f; border-left: 18px solid #37375f; border-radius: 2rem;">Atur Ulang Kata Sandi
                                              </a>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                            <p style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3D4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Jika kamu tidak meminta mengatur ulang kata sandi, silakan abaikan saja email ini (tidak perlu ditindaklanjuti).</p>

                            <p style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3D4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Salam hangat,<br>Kelompok 5 RPL</p>
      
                            <table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; border-top: 1px solid #edeff2; margin-top: 25px; padding-top: 25px;">
                              <tr>
                                <td style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                                  <p style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3D4852; line-height: 1.5em; margin-top: 0; text-align: left; font-size: 12px;">If you\'re having trouble clicking the "Atur Ulang Kata Sandi" button, copy and paste the URL below into your web browser: <a href="' . $link . '" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3869d4;">' . $link . '</a>
                                  </p>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;">
                      <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
                        <tr>
                          <td class="content-cell" align="center" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; padding: 35px;">
                          <p style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; line-height: 1.5em; margin-top: 0; color: #aeaeae; font-size: 12px; text-align: center;">© 2020 Kelompok 5 RPL. All rights reserved.</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </body>
      </html>';
    }

    $this->email = \Config\Services::email();
    $this->email->setFrom('no-reply@naufalist.com', 'SIPS');
    $this->email->setTo($email);
    $this->email->setSubject($subjek);
    $this->email->setMessage($pesan);

    if (!$this->email->send()) {
      return false;
    } else {
      return true;
    }
  }
}
