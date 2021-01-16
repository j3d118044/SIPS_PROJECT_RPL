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
                <h1 class="h3 text-gray-900 mb-2 font-weight-bold">Subnetting</h1>
              </div>
              <hr class="mb-2">

              <div class="form-group row my-0">
                <div class="col-sm-12">
                  <p class="text-indent text-black"><i>Subnetting</i> adalah proses untuk memecahkan atau membagi sebuat <i>network</i> menjadi beberapa <i>network</i> yang lebih kecil, atau <i>subnetting</i> merupakan sebuah teknik yang mengizinkan para administrator jaringan untuk memanfaatkan 32 bit <i>IP Address</i> yang tersedia dengan lebih efisien.</p>

                  <h5 class="mb-2">Fungsi <i>Subnetting</i></h5>
                  <ol class="text-black">
                    <li>Penghematan alamat IP mengalokasikan <i>IP Address</i> yang terbatas agar lebih efisien.</li>
                    <li>Mengoptimalisasi unjuk kerja jaringan walaupun sebuah organisasi memiliki ribuan <i>host device</i>, mengoperasikan semua <i>devices</i> tersebut di dalam <i>network ID</i> yang sama akan memperlambat <i>network</i>.</li>
                  </ol>

                  <h5 class="mb-2">Tujuan <i>Subnetting</i></h5>
                  <ol class="text-black">
                    <li>Untuk mengefisienkan pengalamatan jaringan misalnya untuk jaringan yang hanya mempunyai 10 <i>host</i>, kalau kita ingin menggunakan kelas C saja terdapat 254 – 10 = 244 alamat yang tidak terpakai.</li>
                    <li>Dapat membagi satu kelas <i>network</i> atas sejumlah <i>subnetwork</i> dengan artikata membagi suatu kelas jaringan menjadi bagian-bagian yang lebih kecil.</li>
                    <li>Untuk membuat lebih efisien alokasi <i>IP Address</i> dalam sebuah jaringan supaya bisa memaksimalkan penggunaan <i>ip adderss.</i></li>
                  </ol>
                  <h5 class="text-center mt-1">Tabel Kelas</h5>
                  <div class="card">
                    <div class="card">
                      <div class="table-responsive mb-2">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>Class</th>
                              <th>Oktet Pertama</th>
                              <th>Subnet Mask Default</th>
                              <th>Private Address</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>A</td>
                              <td>1-127</td>
                              <td>255.0.0.0</td>
                              <td>10.0.0.0-10.255.255.255</td>
                            </tr>
                            <tr>
                              <td>B</td>
                              <td>128-191</td>
                              <td>255.255.0.0</td>
                              <td>172.16.0.0-172.31.255.255</td>
                            </tr>
                            <tr>
                              <td>C</td>
                              <td>192-223</td>
                              <td>255.255.255.0</td>
                              <td>192.168.0.0-192.168.255.255</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <a class="float-right" href="https://www.dosenpendidikan.co.id/pengertian-subnetting/">sumber : https://www.dosenpendidikan.co.id</a>
                </div>
              </div>
              <hr class="mt-2">
              <div class="form-group row">
                <div class="col-sm-6">
                  <a href="<?= site_url('/materi/1') ?>" class="btn btn-primary btn-user btn-block mt-2 mb-0"><i class="fa fa-chevron-left" aria-hidden="true"></i> Sebelumnya</a>
                </div>
                <div class="col-sm-6">
                  <a id="submit_btn" class="btn btn-primary btn-user btn-block  mt-2 mb-1" href="<?= site_url("/materi/3") ?>">Selanjutnya <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
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