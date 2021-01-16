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
          <div class="col-lg-6 d-none d-lg-block bg-dashboard-student-image"></div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h3 text-gray-900 mb-2 font-weight-bold">Hallo <?= $nama; ?>!</h1>
              </div>
              <h4 class="text-left" style="color: black">Di SIPS ini Anda dapat membaca materi, mengerjakan latihan studi kasus,
                mengerjakan kuis dan melihat peringkat kuis secara global.
              </h4>
              <div class="row">
                <div class="col-lg-12">
                  <a href="<?= site_url('pages/materi') ?>" class="btn btn-primary btn-user btn-block my-1">
                    Mulai Belajar
                  </a>
                </div>
              </div>
              <hr class="my-1">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>

<?= $this->section("footer_js"); ?>
<script>
</script>
<?= $this->endSection(); ?>