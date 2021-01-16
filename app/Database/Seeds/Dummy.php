<?php

namespace App\Database\Seeds;

class Dummy extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $admin = [
      "email" => "admin@gmail.com",
      "nama" => "Nama Saya Admin",
      "kata_sandi" =>
      '$2y$10$t7Anc6IjJSfTXzj83q4N9.Xn16hzpnKDg80IETtrSZd72isUB/3CG',
    ];

    $this->db->table("admin")->insert($admin);

    // $pelajar = [
    //   [
    //     "email" => "sagitahapsari205@gmail.com",
    //     "nama" => "Sagita Hapsari",
    //     "kata_sandi" =>
    //     '$2y$10$pdKcAiQfxWtK8HadQCGNfeoQ7wSUZDJvFJ.Ejc2/.TwKZopEeJxZ.',
    //     "organisasi" => "IPB",
    //     "foto" => "defaultpp.png",
    //     "skor_kuis" => "10",
    //     "waktu_kuis" => "00:00:05",
    //     "aktivasi" => "1",
    //   ],
    //   [
    //     "email" => "mnaufalwafi@gmail.com",
    //     "nama" => "Muhammad Naufal Wafi",
    //     "kata_sandi" =>
    //     "$2y$10$3QMYPoLMsC6pto0kgiEqIOLObaQ6QgGd2hQK6HoevXWpWtYWkd5Xq",
    //     "organisasi" => "IPB",
    //     "skor_kuis" => null,
    //     "waktu_kuis" => null,
    //     "foto" => "defaultpp.png",
    //     "aktivasi" => "1",
    //   ],
    // [
    //   "email" => "mnaufalwafi3@gmail.com",
    //   "nama" => "Muhammad Naufal Wafi3",
    //   "kata_sandi" =>
    //     "$2y$10$3QMYPoLMsC6pto0kgiEqIOLObaQ6QgGd2hQK6HoevXWpWtYWkd5Xq",
    //   "organisasi" => "IPB",
    //   "skor_kuis" => null,
    //   "waktu_kuis" => null,
    //   "foto" => "defaultpp.png",
    //   "aktivasi" => "1",
    // ],
    // [
    //   "email" => "mnaufalwafi4@gmail.com",
    //   "nama" => "Muhammad Naufal Wafi4",
    //   "kata_sandi" =>
    //     "$2y$10$3QMYPoLMsC6pto0kgiEqIOLObaQ6QgGd2hQK6HoevXWpWtYWkd5Xq",
    //   "organisasi" => "IPB",
    //   "skor_kuis" => null,
    //   "waktu_kuis" => null,
    //   "foto" => "defaultpp.png",
    //   "aktivasi" => "1",
    // ],
    // [
    //   "email" => "mnaufalwafi5@gmail.com",
    //   "nama" => "Muhammad Naufal Wafi5",
    //   "kata_sandi" =>
    //     "$2y$10$3QMYPoLMsC6pto0kgiEqIOLObaQ6QgGd2hQK6HoevXWpWtYWkd5Xq",
    //   "organisasi" => "IPB",
    //   "skor_kuis" => null,
    //   "waktu_kuis" => null,
    //   "foto" => "defaultpp.png",
    //   "aktivasi" => "1",
    // ],
    // [
    //   "email" => "mnaufalwafi6@gmail.com",
    //   "nama" => "Muhammad Naufal Wafi6",
    //   "kata_sandi" =>
    //     "$2y$10$3QMYPoLMsC6pto0kgiEqIOLObaQ6QgGd2hQK6HoevXWpWtYWkd5Xq",
    //   "organisasi" => "IPB",
    //   "skor_kuis" => null,
    //   "waktu_kuis" => null,
    //   "foto" => "defaultpp.png",
    //   "aktivasi" => "1",
    // ],
    // [
    //   "email" => "mnaufalwafi7@gmail.com",
    //   "nama" => "Muhammad Naufal Wafi7",
    //   "kata_sandi" =>
    //     "$2y$10$3QMYPoLMsC6pto0kgiEqIOLObaQ6QgGd2hQK6HoevXWpWtYWkd5Xq",
    //   "organisasi" => "IPB",
    //   "skor_kuis" => null,
    //   "waktu_kuis" => null,
    //   "foto" => "defaultpp.png",
    //   "aktivasi" => "1",
    // ],
    // [
    //   "email" => "mnaufalwafi8@gmail.com",
    //   "nama" => "Muhammad Naufal Wafi8",
    //   "kata_sandi" =>
    //     "$2y$10$3QMYPoLMsC6pto0kgiEqIOLObaQ6QgGd2hQK6HoevXWpWtYWkd5Xq",
    //   "organisasi" => "IPB",
    //   "skor_kuis" => null,
    //   "waktu_kuis" => null,
    //   "foto" => "defaultpp.png",
    //   "aktivasi" => "1",
    // ],
    // [
    //   "email" => "mnaufalwafi9@gmail.com",
    //   "nama" => "Muhammad Naufal Wafi9",
    //   "kata_sandi" =>
    //     "$2y$10$3QMYPoLMsC6pto0kgiEqIOLObaQ6QgGd2hQK6HoevXWpWtYWkd5Xq",
    //   "organisasi" => "IPB",
    //   "skor_kuis" => null,
    //   "waktu_kuis" => null,
    //   "foto" => "defaultpp.png",
    //   "aktivasi" => "1",
    // ],
    // [
    //   "email" => "mnaufalwafi10@gmail.com",
    //   "nama" => "Muhammad Naufal Wafi10",
    //   "kata_sandi" =>
    //     "$2y$10$3QMYPoLMsC6pto0kgiEqIOLObaQ6QgGd2hQK6HoevXWpWtYWkd5Xq",
    //   "organisasi" => "IPB",
    //   "skor_kuis" => null,
    //   "waktu_kuis" => null,
    //   "foto" => "defaultpp.png",
    //   "aktivasi" => "1",
    // ],
    // [
    //   "email" => "mnaufalwafi20@gmail.com",
    //   "nama" => "Muhammad Naufal Wafi20",
    //   "kata_sandi" =>
    //     "$2y$10$3QMYPoLMsC6pto0kgiEqIOLObaQ6QgGd2hQK6HoevXWpWtYWkd5Xq",
    //   "organisasi" => "IPB",
    //   "skor_kuis" => null,
    //   "waktu_kuis" => null,
    //   "foto" => "defaultpp.png",
    //   "aktivasi" => "1",
    // ],
    // [
    //   "email" => "mnaufalwafi201@gmail.com",
    //   "nama" => "Muhammad Naufal Wafi201",
    //   "kata_sandi" =>
    //     "$2y$10$3QMYPoLMsC6pto0kgiEqIOLObaQ6QgGd2hQK6HoevXWpWtYWkd5Xq",
    //   "organisasi" => "IPB",
    //   "skor_kuis" => null,
    //   "waktu_kuis" => null,
    //   "foto" => "defaultpp.png",
    //   "aktivasi" => "1",
    // ],
    // ];

    // $this->db->table("pelajar")->insertBatch($pelajar);

    // $soal = [
    //   [
    //     "soal" =>
    //     '<p>Ada&nbsp;<strong>3</strong>&nbsp;buah gedung, yaitu CA, CB, CC. CA terdiri dari&nbsp;<strong>1000&nbsp;</strong>host, CB&nbsp;<strong>2300&nbsp;</strong>host dan CC&nbsp;<strong>600&nbsp;</strong>host.&nbsp;<em>Block</em>&nbsp;IPnya misalkan <strong>10.0.0.0</strong>. Pertanyaan:</p><figure class="easyimage easyimage-full"><img alt="" width="800" src="blob:http://localhost:8080/c0abf872-da63-48f6-bcec-345284e7e1a8" /><figcaption></figcaption></figure><ol><li>Berapa ip pertama yang ada di gedung CA?</li><li>Berapakah subnet IP yang ada di gedung CB?</li><li>Berapa last ip yang ada di gedung CC?</li></ol>',
    //     "pembahasan" =>
    //     "<p>Karena, kebutuhan host pada gedung CA sebanyak...blablabla</p>",
    //   ],
    //   [
    //     "soal" =>
    //     "<p><strong>Soal ke-2.</strong></p><p>Ini adalah contoh soal. Jawabannya: 2</p>",
    //     "pembahasan" => "<p><strong>2</strong>. 2 adalah jawabannya.</p>",
    //   ],
    //   [
    //     "soal" =>
    //     "<p><strong>Soal ke-3.</strong></p><p>Ini adalah contoh soal. Jawabannya: 3</p>",
    //     "pembahasan" => "<p><strong>3</strong>. 3 adalah jawabannya.</p>",
    //   ],
    //   [
    //     "soal" =>
    //     "<p><strong>Soal ke-4.</strong></p><p>Ini adalah contoh soal. Jawabannya: 4</p>",
    //     "pembahasan" => "<p><strong>4</strong>. 4 adalah jawabannya.</p>",
    //   ],
    //   [
    //     "soal" =>
    //     "<p><strong>Soal ke-5.</strong></p><p>Ini adalah contoh soal. Jawabannya: 4</p>",
    //     "pembahasan" => "<p><strong>4</strong>. 4 adalah jawabannya.</p>",
    //   ],
    //   [
    //     "soal" =>
    //     "<p><strong>Soal ke-6.</strong></p><p>Ini adalah contoh soal. Jawabannya: 4</p>",
    //     "pembahasan" => "<p><strong>4</strong>. 4 adalah jawabannya.</p>",
    //   ],
    //   [
    //     "soal" =>
    //     "<p><strong>Soal ke-7.</strong></p><p>Ini adalah contoh soal. Jawabannya: 4</p>",
    //     "pembahasan" => "<p><strong>4</strong>. 4 adalah jawabannya.</p>",
    //   ],
    //   [
    //     "soal" =>
    //     "<p><strong>Soal ke-8.</strong></p><p>Ini adalah contoh soal. Jawabannya: 4</p>",
    //     "pembahasan" => "<p><strong>4</strong>. 4 adalah jawabannya.</p>",
    //   ],
    //   [
    //     "soal" =>
    //     "<p><strong>Soal ke-9.</strong></p><p>Ini adalah contoh soal. Jawabannya: 4</p>",
    //     "pembahasan" => "<p><strong>4</strong>. 4 adalah jawabannya.</p>",
    //   ],
    //   [
    //     "soal" =>
    //     "<p><strong>Soal ke-10.</strong></p><p>Ini adalah contoh soal. Jawabannya: 4</p>",
    //     "pembahasan" => "<p><strong>4</strong>. 4 adalah jawabannya.</p>",
    //   ],
    //   [
    //     "soal" =>
    //     "<p><strong>Soal ke-11.</strong></p><p>Ini adalah contoh soal. Jawabannya: 4</p>",
    //     "pembahasan" => "<p><strong>4</strong>. 4 adalah jawabannya.</p>",
    //   ],
    //   [
    //     "soal" =>
    //     "<p><strong>Soal ke-12.</strong></p><p>Ini adalah contoh soal. Jawabannya: 4</p>",
    //     "pembahasan" => "<p><strong>4</strong>. 4 adalah jawabannya.</p>",
    //   ],
    //   [
    //     "soal" =>
    //     "<p><strong>Soal ke-13.</strong></p><p>Ini adalah contoh soal. Jawabannya: 4</p>",
    //     "pembahasan" => "<p><strong>4</strong>. 4 adalah jawabannya.</p>",
    //   ],
    //   [
    //     "soal" =>
    //     "<p><strong>Soal ke-14.</strong></p><p>Ini adalah contoh soal. Jawabannya: 4</p>",
    //     "pembahasan" => "<p><strong>4</strong>. 4 adalah jawabannya.</p>",
    //   ],
    //   [
    //     "soal" =>
    //     "<p><strong>Soal ke-15.</strong></p><p>Ini adalah contoh soal. Jawabannya: 4</p>",
    //     "pembahasan" => "<p><strong>4</strong>. 4 adalah jawabannya.</p>",
    //   ],
    // ];

    // $this->db->table("soal_sk")->insertBatch($soal);

    // $jawaban = [
    //   [
    //     "id_soal" => 1,
    //     "id_pertanyaan" => 1,
    //     "jawaban" => "10.0.16.1",
    //   ],
    //   [
    //     "id_soal" => 1,
    //     "id_pertanyaan" => 2,
    //     "jawaban" => "255.255.240.0",
    //   ],
    //   [
    //     "id_soal" => 1,
    //     "id_pertanyaan" => 3,
    //     "jawaban" => "10.0.23.254",
    //   ],
    //   [
    //     "id_soal" => 2,
    //     "id_pertanyaan" => 1,
    //     "jawaban" => "2",
    //   ],
    //   [
    //     "id_soal" => 2,
    //     "id_pertanyaan" => 2,
    //     "jawaban" => "Rapunzel",
    //   ],
    //   [
    //     "id_soal" => 3,
    //     "id_pertanyaan" => 1,
    //     "jawaban" => "3",
    //   ],
    //   [
    //     "id_soal" => 3,
    //     "id_pertanyaan" => 2,
    //     "jawaban" => "Dua Lipa",
    //   ],
    //   [
    //     "id_soal" => 4,
    //     "id_pertanyaan" => 1,
    //     "jawaban" => "4",
    //   ],
    //   [
    //     "id_soal" => 4,
    //     "id_pertanyaan" => 2,
    //     "jawaban" => "Sean Connery",
    //   ],
    //   [
    //     "id_soal" => 5,
    //     "id_pertanyaan" => 1,
    //     "jawaban" => "Sean Connery",
    //   ],
    //   [
    //     "id_soal" => 6,
    //     "id_pertanyaan" => 1,
    //     "jawaban" => "Sean Connery",
    //   ],
    //   [
    //     "id_soal" => 7,
    //     "id_pertanyaan" => 1,
    //     "jawaban" => "Sean Connery",
    //   ],
    //   [
    //     "id_soal" => 8,
    //     "id_pertanyaan" => 1,
    //     "jawaban" => "Sean Connery",
    //   ],
    //   [
    //     "id_soal" => 9,
    //     "id_pertanyaan" => 1,
    //     "jawaban" => "Sean Connery",
    //   ],
    //   [
    //     "id_soal" => 10,
    //     "id_pertanyaan" => 1,
    //     "jawaban" => "Sean Connery",
    //   ],
    //   [
    //     "id_soal" => 11,
    //     "id_pertanyaan" => 1,
    //     "jawaban" => "Sean Connery",
    //   ],
    //   [
    //     "id_soal" => 12,
    //     "id_pertanyaan" => 1,
    //     "jawaban" => "Sean Connery",
    //   ],
    //   [
    //     "id_soal" => 13,
    //     "id_pertanyaan" => 1,
    //     "jawaban" => "Sean Connery",
    //   ],
    //   [
    //     "id_soal" => 14,
    //     "id_pertanyaan" => 1,
    //     "jawaban" => "Sean Connery",
    //   ],
    //   [
    //     "id_soal" => 15,
    //     "id_pertanyaan" => 1,
    //     "jawaban" => "Sean Connery",
    //   ],
    // ];

    // $this->db->table("jawaban_sk")->insertBatch($jawaban);
  }
}
