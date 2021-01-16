<?= $this->extend('layouts/pages'); ?>

<?= $this->section('header_js'); ?>
<script>
</script>
<?= $this->endSection(); ?>

<?= $this->section('main_content'); ?>
<!-- Begin Page Content -->
<div class="row row-1">
  <div class="col-lg-12">
    <h1 class="h3 text-gray-900 mb-2 font-weight-bold text-center">Rekapitulasi</h1>
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

              <div class="form-group row my-0">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <p>Data Pelajar</p>
                </div>
                <div class="col-sm-3">
                  <a href="<?= site_url("/admin/rekapitulasi/pelajar/excel") ?>" class="btn btn-primary btn-user btn-block my-1"><i class="fas fa-download"></i> .xlsx</a>
                  <div class="invalid-feedback">
                  </div>
                </div>
                <div class="col-sm-3">
                  <a href="<?= site_url("/admin/rekapitulasi/pelajar/pdf") ?>" class="btn btn-primary btn-user btn-block my-1"><i class="fas fa-download"></i> .pdf</a>
                  <div class="invalid-feedback">
                  </div>
                </div>
                <div class="col-sm-1">
                </div>
              </div>

              <div class="form-group row my-0">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <p>Template</p>
                </div>
                <div class="col-sm-6">
                  <a href="<?= base_url("/uploads/Data_Pelajar_Template.xlsx") ?>" class="btn btn-primary btn-user btn-block my-1"><i class="fas fa-download"></i> Unduh</a>
                  <div class="invalid-feedback">
                  </div>
                </div>
                <div class="col-sm-1"></div>
              </div>

              <form action="<?= site_url("/admin/rekapitulasi/import") ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row my-0">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-4 my-1">
                    Unggah Data Pelajar
                  </div>
                  <div class="col-sm-6 my-1">
                    <div class="custom-file">
                      <?= csrf_field() ?>
                      <input class="custom-file-input <?= ($validation->hasError('file_excel')) ? 'is-invalid' : ''; ?>" type="file" name="file_excel" id="file" onchange="changeName()" required>
                      <?php if ($validation->hasError('file_excel')) { ?>
                        <div class="invalid-feedback">
                          <?= $validation->getError('file_excel'); ?>
                        </div>
                      <?php } else { ?>
                        <small class="text-muted">XLS/XLSX Max 5 MB</small>
                      <?php } ?>
                      <label class="custom-file-label" for="file">
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-1"></div>
                </div>
                <hr class="mt-2">

                <div class="form-group row">
                  <div class="col-sm-6">
                    <a href="<?= site_url('/admin/manajemen') ?>" class="btn btn-primary btn-user btn-block mt-2 mb-0"><i class="fas fa-arrow-left"></i> Manajemen</a>
                  </div>
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-user btn-block  mt-2 mb-1"><i class="fas fa-upload"></i> Kirim File</button>
                  </div>
                </div>
              </form>
              <hr class="mt-1">
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
  function changeName() {
    const file = document.querySelector('#file');
    const fileLabel = document.querySelector('.custom-file-label');

    // ganti url
    fileLabel.textContent = file.files[0].name.substring(0, 15) + '...';
    // fileLabel.textContent = file.files[0].name;
  }
</script>
<?= $this->endSection(); ?>