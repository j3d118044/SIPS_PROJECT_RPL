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
    <h1 class="h3 text-gray-900 mb-2 font-weight-bold text-center">Ubah</h1>
    <hr class="mb-1">
    <form method="post" action="<?= site_url('/admin/manajemen/ubah/' . $dataSoal["id_soal"]) ?>">
      <div class="container">
        <?php if (session()->getFlashdata('alert')) : ?>
          <div class="alert alert-<?= session()->getFlashdata('alert')['type']; ?> alert-dismissible fade show mt-2 mb-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
            <?= session()->getFlashdata('alert')['message'] ?>
          </div>
        <?php endif; ?>

        <!-- Soal -->
        <div class="row mb-1 mt-2">
          <div class="col-3 font-weight-bold">
            Soal
          </div>
          <div class="col">
            <textarea class="form-control1" id="textarea_soal" name="soal" rows="7">
              <?= $dataSoal["soal"] ?>
            </textarea>
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
              <?php $cekiterasi = 0 ?>
              <?php for ($i = 0; $i < count($dataJawaban); $i++) : ?>
                <tr>
                  <th class="align-middle"><?= $dataJawaban[$i]["id_pertanyaan"] ?></th>
                  <th>
                    <input type="text" class="form-control" name="jawaban[]" value="<?= $dataJawaban[$i]["jawaban"] ?>">
                  </th>
                </tr>
                <?php $cekiterasi++ ?>
              <?php endfor; ?>

              <?php
              $start = $cekiterasi + 1;
              $cekiterasi = 5 - $cekiterasi;
              ?>
              <?php if ($cekiterasi > 0) : ?>
                <?php for ($i = 0; $i < $cekiterasi; $i++) : ?>
                  <tr>
                    <th class="align-middle"><?= $start ?></th>
                    <th>
                      <input type="text" class="form-control" name="jawaban[]" value="" placeholder="opsional">
                    </th>
                  </tr>
                  <?php $start++ ?>
                <?php endfor; ?>
              <?php endif; ?>
            </table>
          </div>
        </div>

        <!-- Pembahasan -->
        <div class="row mb-1">
          <div class="col-3 font-weight-bold">
            Pembahasan
          </div>
          <div class="col">
            <textarea class="form-control1" id="textarea_pembahasan" name="pembahasan" rows="7">
              <?= $dataSoal["pembahasan"] ?>
            </textarea>
            <script>
              CKEDITOR.replace('textarea_pembahasan');
            </script>
          </div>
        </div>
      </div>
      <hr class="mt-2 mb-1">
      <div class="form-group row my-0">
        <div class="col-sm-6">
          <a href="<?= site_url('/admin/manajemen') ?>" class="btn btn-primary btn-user btn-block my-1"><i class="fa fa-arrow-left fa-sm"></i> Manajemen</a>
        </div>
        <div class="col-sm-6">
          <button type="submit" class="btn btn-primary btn-user btn-block my-1"><i class="fa fa-save fa-sm"></i> Simpan</a>
        </div>
      </div>
      <hr class="my-1">
    </form>
  </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>

<?= $this->section('footer_js'); ?>
<script>
</script>
<?= $this->endSection(); ?>