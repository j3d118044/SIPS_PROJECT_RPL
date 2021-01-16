<?= $this->extend('layouts/pages'); ?>

<?= $this->section('header_js'); ?>
<script>
</script>
<?= $this->endSection(); ?>

<?= $this->section('main_content'); ?>
<!-- Begin Page Content -->
<div class="row row-1">
  <div class="col-lg-12">
    <!-- Page Heading -->
    <h1 class="h3 text-gray-900 mb-2 font-weight-bold text-center">Detail</h1>
    <hr>

    <div class="container mt-1">
      <div class="mt-1">

        <!-- Soal -->
        <div class="row mb-1">
          <div class="col-3 font-weight-bold mt-1">
            Soal
          </div>
          <div class="col" style="color: black">
            <?= $dataSoal["soal"] ?>
          </div>
        </div>

        <!-- Jawaban -->
        <div class="row mb-1">
          <div class="col-3 font-weight-bold mt-1">
            Jawaban
          </div>
          <div class="col">
            <div class="card">
              <div class="card">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <?php foreach ($dataJawaban as $jawaban) : ?>
                      <tr>
                        <th><?= $jawaban["id_pertanyaan"] ?></th>
                        <th><?= $jawaban["jawaban"] ?></th>
                      </tr>
                    <?php endforeach; ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- Pembahasan -->
        <div class="row mb-1">
          <div class="col-3 font-weight-bold mt-1">
            Pembahasan
          </div>
          <div class="col" style="color: black">
            <?= $dataSoal["pembahasan"] ?>
          </div>
        </div>

      </div>
    </div>
    <hr class="mb-1">
    <div class="container">

      <!-- Navigasi -->
      <div class="form-group row">
        <div class="col-sm-6">
          <a href="javascript:window.history.go(-1);" class="btn btn-primary btn-user btn-block my-1"><i class="fa fa-arrow-left fa-sm"></i> Kembali</a>
        </div>
        <div class="col-sm-6">
          <a href="<?= site_url('/admin/manajemen/ubah/' . $dataSoal["id_soal"]) ?>" class="btn btn-primary btn-user btn-block my-1"><i class="fa fa-sync fa-sm"></i> Ubah</a>
        </div>
      </div>
      <div class="form-group row mt-1">
        <div class="col">
          <button type="button" class="btn btn-danger btn-user btn-block mb-1" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i>
            Hapus
          </button>
        </div>
      </div>
    </div>
    <hr class="my-1">
  </div>

  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah yakin ingin menghapus data?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <form action="<?= site_url('/admin/manajemen/detail/' . $dataSoal["id_soal"]) ?>" method="post" class="d-inline">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger btn-user btn-block">Yakin</button></form>
          <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Batal</button>
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