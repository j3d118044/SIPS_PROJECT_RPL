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
        <!-- Modal -->
        <div class="modal fade" id="startLatihanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin mulai sekarang?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-footer">
                <form action="<?= site_url("/latihan") ?>" method="post">
                  <?= csrf_field() ?>
                  <button type="submit" class="btn btn-primary">Yakin!</button>
                </form>
                <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Belajar dulu deh kayaknya</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- justify-content-center -->
          <div class="col-lg-12">
            <div class="p-5">

              <!-- Page Heading -->
              <h1 class="h3 text-gray-900 mb-2 font-weight-bold text-center">Latihan Studi Kasus</h1>
              <hr>
              <div id="info" class="row justify-content-center mb-1" style="display: block;">
                <div class="col-lg-12">
                  <?php if (session()->getFlashdata("alert")) : ?>
                    <div class="alert alert-<?= session()->getFlashdata("alert")["type"] ?> alert-dismissible fade show mt-2 mb-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                      </button>
                      <?= session()->getFlashdata("alert")["message"] ?>
                    </div>
                  <?php endif; ?>

                  <div class="card text-center">
                    <div class="card-body">
                      <div class="card-text">
                        <div class="alert alert-info text-left" role="alert">
                          <h6 class="card-title font-weight-bold">Info:</h6>
                          <ul class="mb-0">
                            <li>Tekan tombol "<strong>Mulai</strong>" untuk memulai latihan.</li>
                            <li>Semua kolom jawaban <strong>wajib diisi</strong>!</li>
                            <li>Tekan tombol "<strong><i class="fa fa-chevron-right"></i></strong>" untuk mengakses soal <strong>selanjutnya</strong>.</li>
                            <li>Tekan tombol "<strong><i class="fa fa-chevron-left"></i></strong>" untuk mengakses soal <strong>sebelumnya</strong>.</li>
                            <li>Tekan tombol "<strong>Selesai</strong>" untuk mengakhiri latihan.</li>
                          </ul>
                        </div>
                      </div>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#startLatihanModal">
                        Mulai sekarang?
                      </button>
                    </div>
                  </div>
                </div>
              </div>
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