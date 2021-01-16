<?php

namespace App\Controllers;

use App\Models\Admin_Model;
use App\Models\Pelajar_Model;
use App\Models\SoalSk_Model;
use App\Models\JawabanSk_Model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use TCPDF;

use App\Libraries\Datatables;

class Admin extends BaseController
{
  public function __construct()
  {
    $this->admin = new Admin_Model();
    $this->pelajar = new Pelajar_Model();
    $this->soal = new SoalSk_Model();
    $this->jawaban = new JawabanSk_Model();

    $this->data["status"] = "admin";
    $this->data["email"] = $this->admin->getDataById(
      session()->get("adminid"),
      "email"
    );
    $this->data["nama"] = $this->admin->getDataById(
      session()->get("adminid"),
      "nama"
    );
    $this->data["foto"] = "default.png";
    $this->data["validation"] = \Config\Services::validation();
  }

  public function beranda()
  {
    $this->data["route"] = "beranda";
    $this->data["title"] = "Admin | Beranda";
    return view("admin/beranda", $this->data);
  }

  public function manajemen()
  {
    $this->data["route"] = "manajemen";
    $this->data["title"] = "Admin | Manajemen";
    $this->data["dataSoal"] = $this->soal->getAllData();
    return view("admin/manajemen", $this->data);
  }

  public function detail($id_soal)
  {
    $this->data["dataJawaban"] = $this->jawaban->getDataById($id_soal);
    if (!$this->data["dataJawaban"]) {
      return $this->manajemen();
    }

    $this->data["route"] = "manajemen";
    $this->data["title"] = "Admin | Detail";
    $this->data["dataSoal"] = $this->soal->getDataById($id_soal);

    return view("admin/detail", $this->data);
  }

  public function tambah()
  {
    $this->data["route"] = "manajemen";
    $this->data["title"] = "Admin | Tambah";

    return view("admin/tambah", $this->data);
  }

  public function tambahProses()
  {
    $soal = $this->request->getVar("soal");
    $jawaban = $this->request->getVar("jawaban");
    $pembahasan = $this->request->getVar("pembahasan");

    if (
      !$this->validate([
        "soal" => [
          "rules" => "required",
          "errors" => [
            "required" => "Soal wajib diisi.",
          ],
        ],
      ])
    ) {
      session()->setFlashdata("alert", [
        "type" => "danger",
        "message" => "<strong>Ups!</strong> Data yang dimasukkan salah.",
      ]);
      return redirect()
        ->to("/admin/manajemen/tambah")
        ->withInput();
    }

    if (empty($jawaban[0])) {
      session()->setFlashdata("alert", [
        "type" => "danger",
        "message" =>
        "<strong>Ups!</strong> Jawaban wajib diisi. (minimal satu).",
      ]);
      return redirect()
        ->to("/admin/manajemen/tambah")
        ->withInput();
    }

    $this->soal->save([
      "soal" => $soal,
      "pembahasan" => $pembahasan,
    ]);

    $id_soal = $this->soal->getIdBySoal($soal)["id_soal"];

    $c = 1;
    for ($i = 0; $i < count($jawaban); $i++) {
      if (!empty($jawaban[$i])) {
        $this->jawaban->save([
          "id_soal" => $id_soal,
          "id_pertanyaan" => $c,
          "jawaban" => $jawaban[$i],
        ]);
        $c++;
      }
    }

    session()->setFlashdata("alert", [
      "type" => "success",
      "message" => "<strong>Berhasil!</strong> Data berhasil ditambah.",
    ]);

    return redirect()->to("/admin/manajemen");
  }

  public function ubah($id_soal)
  {
    $this->data["dataJawaban"] = $this->jawaban->getDataById($id_soal);
    if (!$this->data["dataJawaban"]) {
      return $this->manajemen();
    }

    $this->data["route"] = "manajemen";
    $this->data["title"] = "Admin | Ubah";
    $this->data["dataSoal"] = $this->soal->getDataById($id_soal);
    return view("admin/ubah", $this->data);
  }

  public function ubahProses($id_soal)
  {
    // ambil data dari form
    $soal = $this->request->getVar("soal");
    $jawaban = $this->request->getVar("jawaban");
    $pembahasan = $this->request->getVar("pembahasan");

    // ambil data dari db
    $soal_db = $this->soal->getDataById($id_soal, 'soal')['soal'];
    $jawaban_db = $this->jawaban->getDataById($id_soal, 'jawaban');

    $jawaban_db_new = [];
    for ($i = 0; $i < count($jawaban_db); $i++) {
      $jawaban_db_new[] = $jawaban_db[$i]["jawaban"];
    }

    if (count($jawaban_db_new) < 5) {
      $counter = 5 - (count($jawaban_db_new));
      while ($counter != 0) {
        $jawaban_db_new[] = "";
        $counter--;
      }
    }
    $pembahasan_db = $this->soal->getDataById($id_soal, 'pembahasan')["pembahasan"];


    // cek jawaban, minimal ada 1, yaitu terisi diposisi ke-1
    if (empty($jawaban[0])) {
      session()->setFlashdata("alert", [
        "type" => "danger",
        "message" => "<strong>Ups!</strong> Jawaban ke-1 wajib diisi.",
      ]);
      return redirect()
        ->to("/admin/manajemen/ubah/" . $id_soal)
        ->withInput();
    }

    // rearrange array
    $jawaban_new = array_filter($jawaban);
    $jawaban_new = array_values($jawaban_new);

    if (count($jawaban_new) < 5) {
      $counter = 5 - (count($jawaban_new));
      while ($counter != 0) {
        $jawaban_new[] = "";
        $counter--;
      }
    }

    // cek data form = data db (jawaban)
    $jawaban_berubah = false;
    for ($i = 0; $i < count($jawaban_db_new); $i++) {
      if ($jawaban_new[$i] !== $jawaban_db_new[$i]) {
        $jawaban_berubah = true;
        break;
      }
    }
    // cek data form = data db (soal)
    if (
      ($soal === $soal_db) and
      (!$jawaban_berubah) and
      ($pembahasan === $pembahasan_db)
    ) {
      session()->setFlashdata("alert", [
        "type" => "warning",
        "message" => "<strong>Ups!</strong> Tidak ada data yang berubah",
      ]);
      return redirect()
        ->to("/admin/manajemen/ubah/" . $id_soal)
        ->withInput();
    }

    // update soal
    $this->soal
      ->where(["id_soal" => $id_soal])
      ->set([
        "soal" => $soal,
        "pembahasan" => $pembahasan,
      ])
      ->update();

    // hapus semua data jawaban yang ada di database
    $this->jawaban->where(["id_soal" => $id_soal])->delete();

    // masukkan data jawaban yang baru
    $c = 1;
    for ($i = 0; $i < count($jawaban_new); $i++) {
      if (!empty($jawaban_new[$i])) {
        $this->jawaban->save([
          "id_soal" => $id_soal,
          "id_pertanyaan" => $c,
          "jawaban" => $jawaban_new[$i],
        ]);
        $c++;
      }
    }

    session()->setFlashdata("alert", [
      "type" => "success",
      "message" => "<strong>Berhasil!</strong> Data berhasil diubah.",
    ]);

    return redirect()
      ->to("/admin/manajemen/ubah/" . $id_soal)
      ->withInput();
  }

  public function hapus($id_soal)
  {
    $this->soal->delete($id_soal);
    $this->jawaban->where(["id_soal" => $id_soal])->delete();

    session()->setFlashdata("alert", [
      "type" => "success",
      "message" => "<strong>Berhasil!</strong> Data berhasil dihapus.",
    ]);

    return redirect()->to("/admin/manajemen");
  }

  public function grafik_kuis()
  {
    $this->data["route"] = "grafik";
    $this->data["title"] = "Admin | Grafik Kuis";

    return view("admin/grafik_kuis", $this->data);
  }

  public function grafik_kuis_data()
  {
    $totalPelajar = $this->pelajar->countAllResults();
    $mengerjakanKuis = $this->pelajar
      ->select("*")
      ->where("skor_kuis !=", null)
      ->where("waktu_kuis !=", null)
      ->countAllResults();
    $tidakMengerjakanKuis = $totalPelajar - $mengerjakanKuis;

    $fusionData = [
      [
        "label" => "Mengerjakan Kuis",
        "value" => $mengerjakanKuis,
      ],
      [
        "label" => "Belum/Tidak Mengerjakan Kuis",
        "value" => $tidakMengerjakanKuis,
      ],
    ];

    $response = [
      // Chart Configuration
      "chart" => [
        "caption" => "Data Pelajar terhadap Kuis SIPS<br><br>",
        "subCaption" =>
        "Total Pelajar: " .
          $totalPelajar .
          ".<br>Mengerjakan Kuis: " .
          $mengerjakanKuis .
          ".<br>Belum/Tidak Mengerjakan Kuis: " .
          $tidakMengerjakanKuis .
          ".",
        "xAxisName" => "x Axis",
        "yAxisName" => "y Axis",
        "numberSuffix" => "num Suffix",
        "theme" => "fusion",
      ],
      // Chart Data
      "data" => $fusionData,
    ];

    echo json_encode($response);
  }

  public function rekapitulasi()
  {
    $this->data["route"] = "rekapitulasi";
    $this->data["title"] = "Admin | Rekapitulasi";

    return view("admin/rekapitulasi", $this->data);
  }

  public function rekapitulasiPelajarPdf()
  {
    $dataPelajar = $this->pelajar->select('nama, email, organisasi, skor_kuis, waktu_kuis')->findAll();

    // return view("admin/rekapitulasi_pdf", [
    //   'dataPelajar'=> $dataPelajar,
    //   'waktu' => date('d-m-Y H:i:s')
		// ]);

    $html = view('admin/rekapitulasi_pdf',[
      'dataPelajar'=> $dataPelajar,
      'waktu' => date('d-m-Y H-i-s')
		]);

		$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('SIPS');
		$pdf->SetTitle('Data Pelajar');
		$pdf->SetSubject('Export PDF');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->addPage();

    $pdf->writeHTML($html, true, false, true, false, '');
    
		$this->response->setContentType('application/pdf');
    $namaFile = "Data_Pelajar" . date('_d-m-Y_H-i-s');
		$pdf->Output($namaFile.'.pdf', 'I');
  }

  public function rekapitulasiPelajarExcel()
  {
    $dataPelajar = $this->pelajar->select('nama, email, organisasi, skor_kuis, waktu_kuis')->findAll();

    $spreadsheet = new Spreadsheet();

    $sheet = $spreadsheet->getActiveSheet();

    $styleArrayFirstRow = [
      'font' => [
        'bold' => true,
      ]
    ];

    $spreadsheet
      ->setActiveSheetIndex(0)
      ->setCellValue("A1", "Nama")
      ->setCellValue("B1", "Email")
      ->setCellValue("C1", "Organisasi")
      ->setCellValue("D1", "Skor Kuis")
      ->setCellValue("E1", "Waktu Kuis");

    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);

    $highestColumn = $sheet->getHighestColumn();
    $sheet
      ->getStyle('A1:' . $highestColumn . '1')
      ->applyFromArray($styleArrayFirstRow);

    $column = 2;

    foreach ($dataPelajar as $data) {
      $spreadsheet
        ->setActiveSheetIndex(0)
        ->setCellValue("A" . $column, $data["nama"])
        ->setCellValue("B" . $column, $data["email"])
        ->setCellValue("C" . $column, $data["organisasi"])
        ->setCellValue("D" . $column, $data["skor_kuis"])
        ->setCellValue("E" . $column, $data["waktu_kuis"]);
      $column++;
    }

    $writer = new Xlsx($spreadsheet);
    $namaFile = "Data_Pelajar" . date('_d-m-Y_H-i-s');

    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment;filename=" . $namaFile . ".xlsx");
    header("Cache-Control: max-age=0");

    $writer->save("php://output");

    die();
  }

  public function rekapitulasiImport()
  {
    $file = $this->request->getFile("file_excel");

    if (
      !$this->validate([
        "file_excel" => [
          "rules" => "uploaded[file_excel]|ext_in[file_excel,xls,xlsx]|max_size[file_excel,5000]",
          "errors" => [
            'uploaded'  => "File excel wajib diisi",
            'ext_in'    => "File excel hanya boleh diisi dengan xls atau xlsx.",
            'max_size'  => "File excel maksimal 5 MB",
          ],
        ]
      ])
    ) {
      session()->setFlashdata("alert", [
        "type" => "danger",
        "message" => "<strong>Ups!</strong> Data yang dimasukkan salah.",
      ]);

      return redirect()->to("/admin/rekapitulasi")->withInput();
    }

    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader
      ->load($file)
      ->getActiveSheet()
      ->toArray();

    for ($i = 1; $i < count($spreadsheet); $i++) {

      try {
        $insert = $this->pelajar->save([
          'email' => $spreadsheet[$i][1],
          'nama' => $spreadsheet[$i][0],
          'kata_sandi' => password_hash($spreadsheet[$i][2], PASSWORD_DEFAULT, ['cost' => 10]),
          'organisasi' => $spreadsheet[$i][3],
          'foto' => "defaultpp.png",
          'aktivasi' => 1,
        ]);
      } catch (\Exception $e) {

        session()->setFlashdata(
          'alert',
          [
            'type' => 'danger',
            'message' => '<strong>Gagal!</strong> ' . $e->getMessage()
          ]
        );

        return redirect()->to('/admin/rekapitulasi');
      }
    }

    session()->setFlashdata(
      'alert',
      [
        'type' => 'success',
        'message' => '<strong>Berhasil!</strong> Data berhasil ditambah.'
      ]
    );

    return redirect()->to('/admin/rekapitulasi');
  }

  public function test_manajemensoal()
  {

    $this->data["route"] = "";
    $this->data["title"] = "";
    $this->data["dataSoal"] = $this->soal->getAllData();
    return view("admin/test_manajemensoal", $this->data);
  }

  public function test_manajemenjawaban()
  {
    $this->data["route"] = "";
    $this->data["title"] = "";
    $this->data["dataJawaban"] = $this->jawaban->getAllData();
    return view("admin/test_manajemenjawaban", $this->data);
  }

  public function get_json()
  {
    $this->datatables->add_column("no", 'ID-$1', "id_soal");
    $this->datatables->select("id_soal");
    $this->datatables->add_column(
      "action",
      anchor('soal/edit/$1', "Update", ["class" => "btn btn-primary btn-xs"]) .
        " " .
        anchor('soal/del/$1', "Delete", ["class" => "btn btn-danger btn-xs"])
    );
    $this->datatables->from("soal_sk");
    return print_r($this->datatables->generate());
  }

  public function datatable()
  {
    $this->data["route"] = "";
    $this->data["title"] = "";
    $this->data["dataSoal"] = $this->soal->orderBy("id_soal", "asc")->findAll();
    return view("admin/test_datatable", $this->data);
  }

  public function fusion()
  {
    $this->data["route"] = "";
    $this->data["title"] = "";
    return view("admin/test_fusion", $this->data);
  }

  public function fusion_data()
  {
    $fusionData = [
      [
        "label" => "Manhattan",
        "value" => 290,
      ],
      [
        "label" => "Manhattan2",
        "value" => 300,
      ],
    ];

    $response = [
      // Chart Configuration
      "chart" => [
        "caption" => "Caption",
        "subCaption" => "Sub Caption",
        "xAxisName" => "x Axis",
        "yAxisName" => "y Axis",
        "numberSuffix" => "num Suffix",
        "theme" => "fusion",
      ],
      // Chart Data
      "data" => $fusionData,
    ];

    echo json_encode($response);
  }

  public function masuk()
  {
    session();

    if (session('adminid')) {
      return redirect()->to('/admin/beranda');
    }

    $this->data["title"] = "Admin | Masuk";

    return view("admin/masuk", $this->data);
  }

  public function masukPost()
  {
    $email = $this->request->getVar("email");
    $password = $this->request->getVar("password");

    if (
      !$this->validate([
        "email" => [
          "rules" => "required|valid_email",
          "errors" => [
            "required" => "E-mail wajib diisi.",
            "valid_email" => "E-mail yang dimasukkan harus valid.",
          ],
        ],
        "password" => [
          "rules" => "required",
          "errors" => [
            "required" => "Kata sandi wajib diisi.",
          ],
        ],
      ])
    ) {
      session()->setFlashdata("alert", [
        "type" => "danger",
        "message" => "<strong>Ups!</strong> Data yang dimasukkan salah.",
      ]);

      return redirect()
        ->to("/admin/masuk")
        ->withInput();
    }

    // cek email
    if ($this->admin->getDataByEmail($email, "email")) {
      // cek kata sandi
      if (
        password_verify(
          $password,
          $this->admin->getDataByEmail($email, "kata_sandi")
        )
      ) {
        // set session
        session()->set(
          "adminid",
          $this->admin->getDataByEmail($email, "id_admin")
        );
        // session()->markAsTempdata('userid', 10);
        return redirect()->to("/admin/beranda");
      } else {
        // password salah
        session()->setFlashdata("alert", [
          "type" => "danger",
          "message" => "<strong>Ups!</strong> Kata sandi tidak sesuai.",
        ]);
        return redirect()
          ->to("/admin/masuk")
          ->withInput();
      }
    } else {
      // email tidak terdaftar
      session()->setFlashdata("alert", [
        "type" => "danger",
        "message" => "<strong>Ups!</strong> Email tidak sesuai.",
      ]);
      return redirect()
        ->to("/admin/masuk")
        ->withInput();
    }
  }

  public function keluar()
  {
    session()->remove("adminid");

    return redirect()->to("/admin/masuk");
  }
}
