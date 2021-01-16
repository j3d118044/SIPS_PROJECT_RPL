<?= $this->extend('layouts/pages'); ?>

<?= $this->section('header_js'); ?>
<script>
</script>
<?= $this->endSection(); ?>

<?= $this->section('main_content'); ?>
<!-- Begin Page Content -->
<div class="row row-1">
  <div class="col-lg-12">
    <h1 class="h3 text-gray-900 mb-2 font-weight-bold text-center">Ubah Profil</h1>
    <div class="card o-hidden border-0 shadow-lg">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <hr class="mb-2">
              <?php if (session()->getFlashdata('alert')) : ?>
                <div class="alert alert-<?= session()->getFlashdata('alert')['type']; ?> alert-dismissible fade show mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                  </button>
                  <?= session()->getFlashdata('alert')['message'] ?>
                </div>
              <?php endif; ?>

              <form action="<?= site_url('/ubah_profil'); ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="fotoLama" value="<?= $foto; ?>">
                <div class="form-group row my-0">
                  <div class="col-sm-4">
                    Foto
                  </div>
                  <div class="col-sm-8 mb-1">
                    <div class="d-flex justify-content-center mt-0 mb-1">
                      <img src="<?= base_url('assets/img/pelajar/' . $foto) ?>" class="img-profile img-thumbnail rounded-circle">
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="previewImg()">
                      <?php if ($validation->hasError('foto')) { ?>
                        <div class="invalid-feedback">
                          <?= $validation->getError('foto'); ?>
                        </div>s
                      <?php } else { ?>
                        <small class="text-muted">JPG/JPEG/PNG Max 1 MB</small>
                      <?php } ?>
                      <label class="custom-file-label" for="foto"><?= substr($foto, 0, 20) . "..."; ?></label>
                    </div>
                  </div>
                </div>
                <div class="form-group row my-0">
                  <div class="col-sm-4">
                    <p>Nama Lengkap</p>
                  </div>
                  <div class="col-sm-8 my-1">
                    <input type="text" id="nama" name="nama" class="form-control form-control-user <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" placeholder="Nama Lengkap" value="<?= $nama ? $nama : "" ?>" onkeyup="uppercaseEachPrefix('#nama')">
                    <div class="invalid-feedback">
                      <?= ($validation->hasError('nama')) ? $validation->getError('nama') : ''; ?>
                    </div>
                  </div>
                </div>
                <div class="form-group row my-0">
                  <div class="col-sm-4">
                    <p>E-mail</p>
                  </div>
                  <div class="col-sm-8 my-1">
                    <input type="email" name="email" class="form-control form-control-user <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" placeholder="E-mail" value="<?= $email ? $email : "" ?>">
                    <div class="invalid-feedback">
                      <?= ($validation->hasError('email')) ? $validation->getError('email') : ''; ?>
                    </div>
                  </div>
                </div>
                <div class="form-group row my-0">
                  <div class="col-sm-4">
                    <p>Organisasi</p>
                  </div>
                  <div class="col-sm-8 my-1">
                    <input type="text" name="organisasi" class="form-control form-control-user <?= ($validation->hasError('organisasi')) ? 'is-invalid' : ''; ?>" placeholder="Organisasi" value="<?= $organisasi ? $organisasi : "" ?>" onkeyup="this.value = this.value.toUpperCase();">
                    <div class="invalid-feedback">
                      <?= ($validation->hasError('organisasi')) ? $validation->getError('organisasi') : ''; ?>
                    </div>
                  </div>
                </div>
                <hr class="mt-2">
                <div class="form-group row">
                  <div class="col-sm-6">
                    <a href="<?= site_url('/profil') ?>" class="btn btn-primary btn-user btn-block mt-2 mb-0"><i class="fas fa-user"></i> Profil</a>
                  </div>
                  <div class="col-sm-6">
                    <a id="submit_btn" class="btn btn-primary btn-user btn-block  mt-2 mb-1" href="<?= site_url("/ubah_kata_sandi") ?>"><i class="fas fa-key"></i> Ubah Kata Sandi</a>
                  </div>
                </div>
                <button type="submit" class=" btn btn-primary btn-user btn-block mb-2"><i class="fas fa-save"></i> Simpan Perubahan</button>
                <hr>
              </form>
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
  function previewImg() {
    const img = document.querySelector('#foto');
    const imgLabel = document.querySelector('.custom-file-label');
    const imgPreview = document.querySelector('.img-thumbnail');

    // ganti url
    imgLabel.textContent = img.files[0].name.substring(0, 20) + '...';
    // ganti preview
    const fileimg = new FileReader();
    fileimg.readAsDataURL(img.files[0]);

    fileimg.onload = function(e) {
      imgPreview.src = e.target.result;
    }
  }
</script>
<?= $this->endSection(); ?>