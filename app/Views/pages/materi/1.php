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
                <h1 class="h3 text-gray-900 mb-2 font-weight-bold">IP Address</h1>
              </div>
              <hr class="mb-2">

              <div class="form-group row my-0">
                <div class="col-sm-12">
                  <p class="text-indent text-black"> Sebuah <i>IP Address</i> terdiri dari sekumpulan angka-angka. Angka-angka tersebut dikelompokkan menjadi 4. Setiap kelompok angka tersebut terdiri dari 1 sampai 3 digit angka. Rentang angka dalam <i>IP Address</i> berkisar antara 0 sampai dengan 255. Contoh <i>IP Address</i> adalah 192.168.38.1. Di dalam sebuah <i>IP Address</i> terdapat 2 bagian yaitu <i>Network ID</i> dan <i>Host ID.</i></p>

                  <h5 class="mb-2">Jenis-jenis <i>IP Address</i></h5>
                  <ol class="text-black">
                    <li><i>IP Public</i></li>
                    <p class="text-indent"> Sesuai dengan pernyataan diatas bahwa penggunaan <i>IP Public</i> memiliki luas cakupan yang lebih dari <i>IP Private</i>. Sehingga, dapat disimpulkan bahwa <i>IP Public</i> adalah sebuah alamat IP yang digunakan perangkat komputer dalam jaringan global atau internet. Dengan menggunakan <i>IP Public</i> ini pengguna internet dapat mengakses internet. Pengguna internet umumnya dapat mendapatkan <i>IP Public</i> ini melalui <i>provider internet</i> atau disebut <i>ISP (Internet Service Provider).</i></p>

                    <li><i>IP Private</i></li>
                    <p class="text-indent">Pengertian dari <i>IP Private</i> pastinya berbeda dengan <i>IP Public</i>. <i>IP Private</i> memiliki cakupan yang lebih kecil dibanding <i>IP Public</i>. IP jenis ini tidak dapat digunakan untuk mengakses internet. Lalu penggunaan <i>IP Private</i> ini untuk apa? <i>IP Private</i> biasanya digunakan dalam sistem jaringan lokal (LAN) seperti penggunaan telepon gratis pada sebuah perkantoran, hotel, atau sebuah instansi.</p>

                    <li><i>IP Dynamic</i></li>
                    <p class="text-indent"><i>IP Dynamic</i> adalah sebuah IP yang selalu berubah-rubah dari waktu ke waktu. Mengapa hal ini bisa terjadi? Karena hal ini merupakan biaya yang efektif bagi <i>provider internet</i> atau ISP untuk alokasi IP kepada pelanggan. Selain itu, penggunaan <i>IP Address</i> yang berubah-ubah ini disebabkan karena persediaan IP yang semakin lama semakin sedikit. Jadi, perubahan IP yang berubah tersebut sebenarnya karena penggunaan IP secara bergantian dan yang bertanggung jawab dalam hal ini adalah <i>provider internet</i> atau ISP.</p>

                    <li><i>IP Static</i></li>
                    <p class="text-indent">Berbeda dari <i>IP Dynamic</i>, <i>IP Static</i> adalah IP yang tidak akan berubah. Umumnya IP Statis digunakan oleh sebuah server atau perangkat yang penting. Pemberian IP ini jika ingin mendapatkannya maka wajib untuk membayar kepada <i>provider internet</i> atau ISP. Hal ini karena IP yang sudah kita gunakan tidak akan berubah dari waktu ke waktu.</p>
                  </ol>
                  <a class="float-right" href="https://idcloudhost.com/mengenal-apa-itu-ip-address-pengertian-fungsi-manfaat-dan-cara-kerjanya/">Sumber : https://idcloudhost.com
                  </a>
                </div>
              </div>

              <hr class="mt-2">
              <div class="form-group row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                  <a id="submit_btn" class="btn btn-primary btn-user btn-block  mt-2 mb-1" href="<?= site_url("/materi/2") ?>">Selanjutnya <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
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