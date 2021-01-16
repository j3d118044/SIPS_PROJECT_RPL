<?= $this->extend('layouts/auth'); ?>

<?= $this->section('header_js'); ?>
<script>
</script>
<?= $this->endSection(); ?>

<?= $this->section('auth_content'); ?>

<body class="bg-custom">
  <!-- bg-gradient-primary -->

  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card-auth o-hidden border-0 shadow-lg mt-8 mb-8">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-5 d-none d-lg-block bg-password-change-image">
                <a href="<?= site_url('/'); ?>"><img class="logo" src=" <?= base_url('assets/img/sips-logo-blue.png'); ?>"> </a>
              </div>
              <div class="col-lg-7">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h3 text-gray-900 mb-2 font-weight-bold">Ubah Kata Sandi</h1>
                  </div>

                  <?php if (session()->getFlashdata('alert')) : ?>
                    <div class="alert alert-<?= session()->getFlashdata('alert')['type']; ?> alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                      </button>
                      <?= session()->getFlashdata('alert')['message'] ?>
                    </div>
                  <?php endif; ?>

                  <form class="user" action="<?= site_url('/kata_sandi/atur_ulang'); ?>" method="post" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Kata Sandi baru" value="<?= old('password'); ?>">
                      <div class="invalid-feedback">
                        <?= ($validation->hasError('password')) ? $validation->getError('password') : ''; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user <?= ($validation->hasError('repassword')) ? 'is-invalid' : ''; ?>" id="repassword" name="repassword" placeholder="Ulangi Kata Sandi baru" value="<?= old('repassword'); ?>">
                      <div class="invalid-feedback">
                        <?= ($validation->hasError('repassword')) ? $validation->getError('repassword') : ''; ?>
                      </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="token" value="<?= $token ?>">
                    <button type="submit" class="btn btn-auth btn-user btn-block">
                      Kirim
                    </button>
                  </form>
                  <hr class="mt-2 mb-1">
                  <div class="text-center">
                    <a class="small" href="<?= site_url('/masuk'); ?>">&larr; Kembali ke laman masuk</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?= $this->endSection(); ?>

  <?= $this->section("footer_sjs"); ?>
  <script>
  </script>
  <?= $this->endSection(); ?>