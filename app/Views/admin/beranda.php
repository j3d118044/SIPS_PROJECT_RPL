<?= $this->extend('layouts/pages'); ?>

<?= $this->section('header_js'); ?>
<script>
</script>
<?= $this->endSection(); ?>

<?= $this->section('main_content'); ?>
<!-- Begin Page Content -->
<div class="row row-1">
  <div class="col-lg-12">
    <div class="card o-hidden border-0 shadow-lg">
      <div class="card-body p-0">
        <div class="row">
          <!-- justify-content-center -->
          <div class="col-lg-6 d-none d-lg-block bg-dashboard-admin-image"></div>
          <div class="col-lg-6">
            <div class="p-5">

              <div class="text-center">
                <h1 class="h3 text-gray-900 mb-2 font-weight-bold typing">Hallo <?= $nama; ?>!</h1>
              </div>
              <h5 class="text-left mb-1" style="color: black">Anda mempunyai akses untuk :<br>
              </h5>
              <ol style="color: black; font-size: 3vh">
                <li>Mengedit, menambah, menghapus jawaban dan pembahasan di latihan studi kasus.</li>
                <li>Mengunduh template excel dan data pelajar.</li>
                <li>Mengunggah data pelajar.</li>
                <li>Melihat grafik kuis.</li>
              </ol>
              <div class="row">
                <div class="col-lg-12">
                  <a href="<?= site_url('admin/manajemen') ?>" class="btn btn-primary btn-user btn-block">
                    Manajemen
                  </a>
                </div>
              </div>
              <hr class="mt-2">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>

<?= $this->section('footer_js'); ?>
<script>
</script>
<?= $this->endSection(); ?>