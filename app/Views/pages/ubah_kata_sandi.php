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
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h3 text-gray-900 mb-2 font-weight-bold text-center">Ubah Kata Sandi</h1>
              </div>
              <hr class="mb-2">

              <?php if (session()->getFlashdata('alert')) : ?>
                <div class="alert alert-<?= session()->getFlashdata('alert')['type']; ?> alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                  </button>
                  <?= session()->getFlashdata('alert')['message'] ?>
                </div>
              <?php endif; ?>

              <form action="<?= site_url('/ubah_kata_sandi'); ?>" method="post" autocomplete="off">
                <div class="form-group">
                  <input type="password" class="form-control form-control-user<?= ($validation->hasError('currentpassword')) ? 'is-invalid' : ''; ?>" id="currentpassword" name="currentpassword" placeholder="Kata Sandi Saat Ini" value="<?= old('currentpassword'); ?>">
                  <div class="invalid-feedback">
                    <?= ($validation->hasError('currentpassword')) ? $validation->getError('currentpassword') : ''; ?>
                  </div>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Kata Sandi Baru" value="<?= old('password'); ?>">
                  <div class="invalid-feedback">
                    <?= ($validation->hasError('password')) ? $validation->getError('password') : ''; ?>
                  </div>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user <?= ($validation->hasError('repassword')) ? 'is-invalid' : ''; ?>" id="repassword" name="repassword" placeholder="Konfirmasi Kata Sandi Baru" value="<?= old('repassword'); ?>">
                  <div class="invalid-feedback">
                    <?= ($validation->hasError('repassword')) ? $validation->getError('repassword') : ''; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <a href="<?= site_url('/profil') ?>" class="btn btn-primary btn-user btn-block my-1">
                      <i class="fa fa-user" aria-hidden="true"></i>
                      Profil
                    </a>
                  </div>
                  <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary btn-user btn-block my-1">
                      <i class="fa fa-save" aria-hidden="true"></i>
                      Simpan
                    </button>
                  </div>
                </div>
              </form>
              <hr class="my-1">
            </div>
          </div>
          <div class="col-lg-6 d-none d-lg-block bg-change-password-image"></div>
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