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

    <h1 class="h3 text-gray-900 mb-2 font-weight-bold text-center">Manajemen</h1>
    <hr>
    <div class="container mt-2">

      <?php if (session()->getFlashdata('alert')) : ?>
        <div class="alert alert-<?= session()->getFlashdata('alert')['type']; ?> alert-dismissible fade show mb-2" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
          </button>
          <?= session()->getFlashdata('alert')['message'] ?>
        </div>
      <?php endif; ?>

      <!-- Navigasi -->
      <div class="row float-right mb-2">
        <div class="col mt-1">
          <a href="<?= site_url('/admin/manajemen/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Tambah</a>
        </div>
      </div>
    </div>

    <div class="container mt-6">
      <div class="mt-3">
        <div class="table-responsive-datatable">
          <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Id</th>
                <th>Soal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($dataSoal) : ?>
                <?php $c = 1; ?>
                <?php foreach ($dataSoal as $soal) : ?>
                  <tr>
                    <td style="padding-top: 1.75rem"><?= $c++ ?></td>
                    <td style="text-align: left"><?= $soal["soal"] ?></td>
                    <td style="width: 15%">
                      <a href="<?= site_url('/admin/manajemen/detail/' . $soal["id_soal"]) ?>" class="btn btn-warning btn-user btn-block my-1"><i class="fas fa-info-circle"></i> Detail</a><br>
                      <a href="<?= site_url('/admin/manajemen/ubah/' . $soal["id_soal"]) ?>" class="btn btn-info btn-user btn-block my-1"><i class="fas fa-cog"></i> Ubah</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="3">Tidak ada data.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <hr class="mt-3 mb-1">
  </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>

<?= $this->section('footer_js'); ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
</script>
<script>
  $(document).ready(function() {
    $('#datatable').DataTable();
  });
</script>
<?= $this->endSection(); ?>