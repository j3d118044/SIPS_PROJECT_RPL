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
    <div class="card-auth o-hidden border-0 shadow-lg mt-4 mb-4">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image">
            <a href="<?= site_url('/'); ?>"><img class="logo" src=" <?= base_url('assets/img/sips-logo-blue.png'); ?>"> </a>
          </div><!-- col-lg-5 -->
          <div class="col-lg-7">
            <!-- col-lg-7 -->
            <div class="p-5">
              <div class="text-center">
                <h1 class="h3 text-gray-900 mb-2 font-weight-bold">Daftar Akun SIPS</h1>
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

              <form class="user" action="<?= site_url('/daftar'); ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="E-mail" value="<?= old('email'); ?>">
                  <div class="invalid-feedback">
                    <?= ($validation->hasError('email')) ? $validation->getError('email') : ''; ?>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= old('nama'); ?>" onkeyup="uppercaseEachPrefix('#nama')">
                  <div class="invalid-feedback">
                    <?= ($validation->hasError('nama')) ? $validation->getError('nama') : ''; ?>
                  </div>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Kata Sandi" value="<?= old('password'); ?>">
                  <div class="invalid-feedback">
                    <?= ($validation->hasError('password')) ? $validation->getError('password') : ''; ?>
                  </div>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user <?= ($validation->hasError('repassword')) ? 'is-invalid' : ''; ?>" id="repassword" name="repassword" placeholder="Ulangi Kata Sandi" value="<?= old('repassword'); ?>">
                  <div class="invalid-feedback">
                    <?= ($validation->hasError('repassword')) ? $validation->getError('repassword') : ''; ?>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user <?= ($validation->hasError('organisasi')) ? 'is-invalid' : ''; ?>" id="organisasi" name="organisasi" placeholder="Organisasi/Institusi" value="<?= old('organisasi'); ?>" onkeyup="this.value = this.value.toUpperCase();">
                  <div class="invalid-feedback">
                    <?= ($validation->hasError('organisasi')) ? $validation->getError('organisasi') : ''; ?>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12 mb-sm-0">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="previewImg()">
                      <?php if ($validation->hasError('foto')) { ?>
                        <div class="invalid-feedback">
                          <?= $validation->getError('foto'); ?>
                        </div>
                      <?php } else { ?>
                        <small class="text-muted">JPG/JPEG/PNG Max 1 MB</small>
                      <?php } ?>
                      <label class="custom-file-label" for="foto"><span>Pilih foto</span></label>
                    </div>
                    <div class="col-sm-12 d-flex justify-content-center mt-1">
                      <img src="<?= base_url('assets/img/default.png') ?>" class="img-profile img-thumbnail img-preview rounded-circle">
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-auth btn-user btn-block">
                  Daftar
                </button>
              </form>

              <hr class="mt-2 mb-1">
              <div class="text-center">
                <a class="small" href="<?= site_url('/kata_sandi/lupa'); ?>">Lupa kata sandi?</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?= site_url('/masuk'); ?>">Sudah punya akun? Masuk!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?= $this->endSection(); ?>

  <?= $this->section("footer_js"); ?>
  <script>
    function previewImg() {
      const img = document.querySelector('#foto');
      const imgLabel = document.querySelector('.custom-file-label');
      const imgPreview = document.querySelector('.img-preview');

      // ganti url
      imgLabel.textContent = img.files[0].name.substring(0, 20) + '...';
      // imgLabel.textContent = img.files[0].name;

      // ganti preview
      const fileimg = new FileReader();
      fileimg.readAsDataURL(img.files[0]);

      fileimg.onload = function(e) {
        imgPreview.src = e.target.result;
      }
    }
  </script>
  <?= $this->endSection(); ?>