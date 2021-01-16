<?= $this->extend("layouts/pages") ?>

<?= $this->section("header_js") ?>
<script>

</script>
<?= $this->endSection() ?>

<?= $this->section("main_content") ?>

<!-- Begin Page Content -->
<div class="row row-1">
  <div class="col-lg-12">
    <div class="card o-hidden border-0 shadow-lg">
      <div class="card-body p-0">
        <div class="row">
          <!-- justify-content-center -->
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h3 text-gray-900 mb-2 font-weight-bold">VLSM</h1>
              </div>
              <hr class="mb-2">

              <div class="form-group row my-0">
                <div class="col-sm-12">
                  <p class="text-indent text-black">Perhitungan <i>IP Address</i> menggunakan metode VLSM adalah metode yang berbeda dengan memberikan suatu <i>Network Address</i> lebih dari satu <i>subnet mask,</i> jika menggunakan CIDR dimana suatu <i>Network ID</i> hanya memiliki satu <i>subnet mask</i> saja, perbedaan yang mendasar disini juga adalah terletak pada pembagian blok, pembagian blok VLSM bebas dan hanya dilakukan oleh si pemilik <i>Network Address</i> yang telah diberikan kepadanya atau dengan kata lain sebagai <i>IP Address</i> local dan <i>IP Address</i> ini tidak dikenal dalam jaringan internet, namun tetap dapat melakukan koneksi kedalam jaringan internet, hal ini terjadi dikarenakan jaringan internet hanya mengenal <i>IP Address</i> berkelas. </p>
                  <p class="text-indent text-black">Metode VLSM ataupun CIDR pada prinsipnya sama yaitu untuk mengatasi kekurangan <i>IP Address</i> dan dilakukannya pemecahan <i>Network ID</i> guna mengatasi kekerungan <i>IP Address</i> tersebut. <i>Network Address</i> yang telah diberikan oleh lembaga IANA jumlahnya sangat terbatas, biasanya suatu perusahaan baik instansi pemerintah, swasta maupun institusi pendidikan yang terkoneksi ke jaringan internet hanya memilik <i>Network ID</i> tidak lebih dari 5 – 7 <i>Network ID (IP Public). </i></p>
                  <p>
                  </p>

                  <p class="text-indent text-black">Dalam penerapan <i>IP Address</i> menggunakan metode VLSM agar tetap dapat berkomunikasi kedalam jaringan internet sebaiknya pengelolaan <i>network</i>-nya dapat memenuhi persyaratan, sebagai berikut:</p>
                  <ol class="text-black">
                    <li><i>Routing protocol</i> yang digunakan harus mampu membawa informasi mengenai notasi <i>prefix</i> untuk setiap rute <i>broadcast</i>-nya <i>(routing protocol : RIP, IGRP, EIGRP, OSPF dan lainnya, bahan bacaan lanjut protocol routing : CNAP 1-2)</i></li>
                    <li>Semua perangkat <i>router</i> yang digunakan dalam jaringan harus mendukung metode VLSM yan menggunakan algoritma penerus paket informasi.</li>
                  </ol>

                  <h5 class="mt-2">Manfaat VLSM</h5>
                  <ol class="text-black">
                    <li>Efisien menggunakan alamat IP karena alamat IP yang dialokasikan sesuai dengan kebutuhan ruang <i>host</i> setiap <i>subnet.</i></li>
                    <li>VLSM mendukung hirarkis menangani desain sehingga dapat secara efektif mendukung rute agregasi, juga disebut <i>route summarization.</i></li>
                    <li>Berhasil mengurangi jumlah rute di <i>routing table</i> oleh berbagai jaringan <i>subnet</i> dalam satu ringkasan alamat. Misalnya <i>subnet</i> 192.168.10.0/24, 192.168.11.0/24 dan 192.168.12.0/24 semua akan dapat diringkas menjadi 192.168.8.0/21.</li>
                  </ol>

                  <h5 class="mt-2">Penerapan VLSM: 130.20.0.0/20</h5>
                  <ol class="text-black">
                    <li>Kita hitung jumlah <i>subnet</i> dahulu menggunakan CIDR, dan didapat:<br>
                      11111111.11111111.11110000.00000000 = /20<br>
                      Jumlah angka binary 1 pada 2 oktet terakhir <i>subnet</i> adalah 4 maka:<br>
                      Jumlah <i>subnet</i> = (2x) = 24 = 16<br>
                      Maka blok tiap <i>subnet</i>nya adalah:<br><br>
                      Blok <i>subnet</i> ke 1 = 130.20.0.0/20<br>
                      Blok <i>subnet</i> ke 2 = 130.20.16.0/20<br>
                      Blok <i>subnet</i> ke 3 = 130.20.32.0/20<br><br>
                      dst … sampai dengan<br><br>
                      Blok <i>subnet</i> ke 16 = 130.20.240.0/20<br><br></li>
                    <li>Selanjutnya kita ambil nilai blok ke 3 dari hasil CIDR yaitu:<br><br>
                      130.20.32.0<br><br></li>
                    <li>kita pecah menjadi 16 blok <i>subnet</i>, dimana nilai 16 diambil dari hasil perhitungan <i>subnet</i> pertama yaitu:<br>
                      /20 = (2x) = 24 = 16<br><br></li>
                    <li>Selanjutnya nilai <i>subnet</i> di ubah tergantung kebutuhan untuk pembahasan ini kita gunakan /24, maka didapat:<br>
                      130.20.32.0/24<br><br></li>
                    <li>Kemudian diperbanyak menjadi 16 blok lagi sehingga didapat 16 blok baru yaitu :<br><br>
                      Blok <i>subnet</i> VLSM 1-1 = 130.20.32.0/24<br>
                      Blok <i>subnet</i> VLSM 1-2 = 130.20.33.0/24<br>
                      Blok <i>subnet</i> VLSM 1-3 = 130.20.34.0/24<br>
                      Blok <i>subnet</i> VLSM 1-4 = 130.20.35.0/24<br><br>
                      dst … sampai dengan<br><br>
                      Blok <i>subnet</i> VLSM 1-16 = 130.20.47/24<br><br></li>
                    <li>Selanjutnya kita ambil kembali nilai ke 1 dari blok <i>subnet</i> VLSM 1-1 yaitu<br>
                      130.20.32.0<br><br></li>
                    <li>Kemudian kita pecah menjadi 16:2 = 8 blok <i>subnet</i> lagi, namun oktet ke 4 pada <i>Network ID</i> yang kita ubah juga menjadi 8 blok kelipatan dari 32 sehingga didapat :<br><br>
                      Blok <i>subnet</i> VLSM 2-1 = 130.20.32.0/27<br>
                      Blok <i>subnet</i> VLSM 2-2 = 130.20.32.32/27<br>
                      Blok <i>subnet</i> VLSM 2-3 = 130.20.33.64/27<br>
                      Blok <i>subnet</i> VLSM 2-4 = 130.20.34.96/27<br>
                      Blok <i>subnet</i> VLSM 2-5 = 130.20.35.128/27<br>
                      Blok <i>subnet</i> VLSM 2-6 = 130.20.36.160/27<br>
                      Blok <i>subnet</i> VLSM 2-1 = 130.20.37.192/27<br>
                      Blok <i>subnet</i> VLSM 2-1 = 130.20.38.224/27<br></li>
                  </ol>
                  <a class="float-right" href="https://ilmukomputer.org/wp-content/uploads/2007/12/metode-ip-address-lanjutan-vlsm.pdf">Sumber : https://ilmukomputer.org</a>
                </div>
              </div>
              <hr class="mt-1">
              <div class="form-group row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                  <a id="submit_btn" class="btn btn-primary btn-user btn-block  mt-2 mb-1" href="<?= site_url("/materi/3") ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i> Sebelumnya</a>
                </div>
                <div class="col-sm-4">
                </div>
              </div>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- /.container-fluid -->

<?= $this->endSection() ?>

<?= $this->section("footer_js") ?>
<script>
</script>
<?= $this->endSection()
?>