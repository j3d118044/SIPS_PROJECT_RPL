<?= $this->extend('layouts/pages'); ?>

<?= $this->section('header_js'); ?>
<script>
</script>
<?= $this->endSection(); ?>

<?= $this->section('main_content'); ?>

<!-- Begin Page Content -->
<div class="row row-1">
  <div class="col-lg-12">
    <h1 class="h3 text-gray-900 mb-2 font-weight-bold text-center">Profil</h1>
    <div class="card o-hidden border-0 shadow-lg">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <hr>
              <a class="img-profile text-center mx-auto d-block mt-2 mb-1" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-profile img-thumbnail rounded-circle" src="
                <?php if (session()->has("userid")) { ?>
                <?= base_url("assets/img/pelajar/" . $foto) ?>
                <?php } elseif (session()->has("adminid")) { ?>
                <?= base_url("assets/img/" . $foto) ?>
                <?php } ?>
                ">
              </a>
              <h3 class="form-text text-center py-1 mt-0 mb-2">
                <?= $nama ?>
              </h3>
              <div class="form-group row my-0">
                <div class="col-sm-4">
                  <p>E-mail</p>
                </div>
                <div class="col-sm-8">
                  <span id="fh_add" type="text" class="form-control form-control-user"><?= $email ?>
                    <small id="fh_add_ans" class="text-success"></small>
                </div>
              </div>
              <div class="form-group row my-0">
                <div class="col-sm-4">
                  <p>Organisasi</p>
                </div>
                <div class="col-sm-8">
                  <span id="mx_add" type="text" class="form-control form-control-user" id=""><?= $organisasi ?>
                    <small id="mx_add_ans" class="text-success"></small>
                </div>
              </div>
              <hr class="mt-2">
              <div class="form-group row ">
                <div class="col-sm-6">
                  <a href="<?= site_url('/beranda') ?>" class="btn btn-primary btn-user btn-block mt-2 mb-0"><i class="fas fa-tachometer-alt"></i> Beranda</a>
                </div>
                <div class="col-sm-6">
                  <a id="submit_btn" class="btn btn-primary btn-user btn-block mt-2 mb-1" href="<?= site_url("/ubah_kata_sandi") ?>"><i <i class="fas fa-key"></i> Ubah Kata Sandi</a>
                </div>
              </div>
              <a class=" btn btn-primary btn-user btn-block mb-2" href="<?= site_url("/ubah_profil") ?>"><i <i class="fas fa-user-cog"></i> Ubah Profil</a>
              <hr>
            </div>
          </div>
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