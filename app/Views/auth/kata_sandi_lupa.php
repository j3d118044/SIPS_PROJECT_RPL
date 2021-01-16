<?= $this->extend('layouts/auth'); ?>

<?= $this->section('header_js'); ?>
<script>
  // localStorage.clear();
  <?php
  // session()->set("timer_lupa_kata_sandi", "stopped")
  ?>

  let sec = localStorage.getItem("sec") ? parseInt(localStorage.getItem("sec")) : 60;
  let interval = null;

  $(document).ready(function() {
    if (localStorage.getItem("sec")) {
      interval = window.setInterval(btnTimer, 1000);
      $("#btn_resend").prop('disabled', true);
      $("#btn_resend").html("Mohon tunggu " + sec + " detik");
      $("#form_resend").submit(function(e) {
        e.preventDefault();
      });
    } else {
      <?php if (session()->get("timer_lupa_kata_sandi") == "started") { ?>
        interval = window.setInterval(btnTimer, 1000);
        $("#btn_resend").prop('disabled', true);
      <?php } else { ?>
        window.clearInterval(interval);
        $("#btn_resend").prop('disabled', false);
      <?php } ?>
    }
  })

  function btnTimer() {
    if (sec > 0) {
      $("#btn_resend").prop('disabled', true);
      $("#btn_resend").html("Mohon tunggu " + sec + " detik");
      $("#form_resend").submit(function(e) {
        e.preventDefault();
      });
      sec--
      localStorage.setItem("sec", sec);
    } else {
      window.clearInterval(interval);
      sec = 0;
      <?php session()->set("timer_lupa_kata_sandi", "stopped") ?>
      localStorage.clear();
      $("#btn_resend").prop('disabled', false);
      $("#btn_resend").html("Kirim");
      $('#form_resend').unbind('submit')
    }
  }
</script>
<?= $this->endSection(); ?>

<?= $this->section('auth_content'); ?>

<body class="bg-custom">
  <!-- bg-gradient-primary -->

  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card-auth o-hidden border-0 shadow-lg mt-9 mb-9">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-5 d-none d-lg-block bg-password-forget-image">
                <a href="<?= site_url('/'); ?>">
                  <img class="logo" src=" <?= base_url('assets/img/sips-logo-blue.png'); ?>"> </a>
              </div>
              <div class="col-lg-7">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h3 text-gray-900 mb-2 font-weight-bold">Lupa Kata Sandi</h1>
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

                  <form id="form_resend" class="user" action="<?= site_url('/kata_sandi/lupa'); ?>" method="post" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="E-mail" value="<?= session()->get('temp_email') ? session()->get('temp_email') : old('email'); ?>">
                      <div class="invalid-feedback">
                        <?= ($validation->hasError('email')) ? $validation->getError('email') : ''; ?>
                      </div>
                    </div>
                    <button id="btn_resend" type="submit" class="btn btn-auth btn-user btn-block">Kirim</button>
                  </form>

                  <hr class="mt-2 mb-1">
                  <div class="text-center">
                    <a class="small" href="<?= site_url('/daftar'); ?>">Belum punya akun? Daftar!</a>
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
    </div>
  </div>
  <?= $this->endSection(); ?>

  <?= $this->section("footer_js"); ?>
  <script>
  </script>
  <?= $this->endSection(); ?>