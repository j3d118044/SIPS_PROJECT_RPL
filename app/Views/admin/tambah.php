<?= $this->extend('layouts/pages'); ?>

<?= $this->section('header_js'); ?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<style>
  .ck-editor__editable_inline {
    min-height: 200px;
  }
</style>
<script>
</script>
<?= $this->endSection(); ?>

<?= $this->section('main_content'); ?>
<!-- Begin Page Content -->
<div class="row row-1">
  <div class="col-lg-12">

    <!-- Page Heading -->
    <h1 class="h3 text-gray-900 mb-2 font-weight-bold text-center">Tambah</h1>
    <hr>

    <form method="post" action="<?= site_url('/admin/manajemen/tambah') ?>">
      <div class="container mt-2">
        <div class="mt-2">

          <!-- Soal -->
          <div class="row mb-1">
            <div class="col-3 font-weight-bold">
              Soal
            </div>
            <div class="col">
              <textarea class="form-control1 <?= ($validation->hasError('soal')) ? 'is-invalid' : ''; ?>" id="textarea_soal" name="soal" rows="7">
            <?= old('soal'); ?>
            </textarea>
              <div class="invalid-feedback">
                <?= ($validation->hasError('soal')) ? $validation->getError('soal') : ''; ?>
              </div>
              <script>
                CKEDITOR.replace('textarea_soal');
              </script>
            </div>
          </div>

          <!-- Jawaban -->
          <div class="row mb-1">
            <div class="col-3 font-weight-bold">
              Jawaban
            </div>
            <div class="col">
              <table class="table table-bordered-admin">
                <tr>
                  <th class="align-middle">1</th>
                  <th>
                    <input type="text" class="form-control" name="jawaban[]" value="<?= old('jawaban') ? old('jawaban')[0] : '' ?>" placeholder="wajib diisi" required>
                  </th>
                </tr>
                <tr>
                  <th class="align-middle">2</th>
                  <th>
                    <input type="text" class="form-control" name="jawaban[]" value="<?= old('jawaban') ? old('jawaban')[1] : '' ?>" placeholder="opsional">
                  </th>
                </tr>
                <tr>
                  <th class="align-middle">3</th>
                  <th>
                    <input type="text" class="form-control" name="jawaban[]" value="<?= old('jawaban') ? old('jawaban')[2] : '' ?>" placeholder="opsional">
                  </th>
                </tr>
                <tr>
                  <th class="align-middle">4</th>
                  <th>
                    <input type="text" class="form-control" name="jawaban[]" value="<?= old('jawaban') ? old('jawaban')[3] : '' ?>" placeholder="opsional">
                  </th>
                </tr>
                <tr>
                  <th class="align-middle">5</th>
                  <th>
                    <input type="text" class="form-control" name="jawaban[]" value="<?= old('jawaban') ? old('jawaban')[4] : '' ?>" placeholder="opsional">
                  </th>
                </tr>
              </table>
            </div>
          </div>

          <!-- Pembahasan -->
          <div class="row mb-1">
            <div class="col-3 font-weight-bold">
              Pembahasan
            </div>
            <div class="col">
              <textarea class="form-control1 <?= ($validation->hasError('pembahasan')) ? 'is-invalid' : ''; ?>" id="textarea_pembahasan" name="pembahasan" rows="7">
            <?= old('pembahasan'); ?>
            </textarea>
              <div class="invalid-feedback">
                <?= ($validation->hasError('pembahasan')) ? $validation->getError('pembahasan') : ''; ?>
              </div>
              <script>
                CKEDITOR.replace('textarea_pembahasan');
              </script>
            </div>
          </div>

        </div>
      </div>
      <hr class="mb-1 mt-2">

      <div class="container">

        <div class="form-group row my-0">
          <div class="col-sm-6">
            <a href="<?= site_url('/admin/manajemen') ?>" class="btn btn-primary btn-user btn-block my-1"><i class="fa fa-arrow-left fa-sm"></i> Manajemen</a>
          </div>
          <div class="col-sm-6">
            <button type="submit" class="btn btn-primary btn-user btn-block my-1"><i class="fa fa-paper-plane fa-sm"></i> Tambah</a>
          </div>
        </div>
      </div>
    </form>
    <hr class="my-1">
  </div>
  <!-- /.container-fluid -->
  <?= $this->endSection(); ?>

  <?= $this->section('footer_js'); ?>
  <script>
  </script>
  <?= $this->endSection(); ?>