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
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card-auth o-hidden border-0 shadow-lg mt-6 mb-6">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-12">
                <div class="float-right">
                  <a class="text-grey font-weight-bold" href="" data-toggle="modal" data-target="#aboutModal">Tentang</a>
                  <img class="logo-landing" data-toggle="modal" data-target="#aboutModal" src=" <?= base_url('assets/img/sips-logo-blue.png'); ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-left">
                    <h2 class="text-purple font-weight-bold">Selamat Datang di</h2>
                    <h1 class="text-dark-blue font-weight-bold">Subnetting IP Address!</h1>
                    <h3 class="text-grey font-weight-bold">Masuk atau Daftar</h3>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <a href="<?= site_url('/masuk'); ?>" class="btn btn-auth btn-user btn-block mb-2">
                        Masuk
                      </a>
                    </div>
                    <div class="col-lg-4">
                      <a href="<?= site_url('/daftar'); ?>" class="btn btn-auth btn-user btn-block mb-5">
                        Daftar
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 d-none d-lg-block bg-landing-image">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-text-center mt-2">
          <h5 class="modal-title text-gray-900 font-weight-bold text-center">Kelompok 5 TEK3A P1</h5>
          </button>
        </div>
        <div class="modal-body">
          <ul class="list-group list-group-flush">

            <!-- Profil Dosen -->
            <em class="font-weight-bold my-1">Dosen Pengajar</em>
            <li class="list-group-item align-items-center py-1 mb-1">
              <div class="row mb-1">
                <div class="col-3">
                  <img class="rounded-circle" width="70" height="auto" src=" <?= base_url('assets/img/kelompok/bu_sofi.jpg'); ?>" alt="">
                </div>
                <div class="col text-center mt-1">
                  Sofiyanti Indriasari S.Kom, M.Kom.<br>
                  <span class="badge badge-secondary badge-pill">201807198410052001</span>
                </div>
              </div>
            </li>
            <li class="list-group-item align-items-center py-1 mb-1">
              <div class="row mb-1">
                <div class="col-3">
                  <img class="rounded-circle" width="70" height="auto" src=" <?= base_url('assets/img/kelompok/pak_adit.jpg'); ?>" alt="">
                </div>
                <div class="col text-center mt-1">
                  Aditya Wicaksono, S.Kom, M.Kom.<br>
                  <span class="badge badge-secondary badge-pill">198210102006041027</span>
                </div>
              </div>
            </li>
            <li class="list-group-item align-items-center py-1 mb-1">
              <div class="row mb-1">
                <div class="col-3">
                  <img class="rounded-circle" width="70" height="auto" src=" <?= base_url('assets/img/kelompok/pak_endang.jpg'); ?>" alt="">
                </div>
                <div class="col text-center mt-1">
                  Endang Purnama Giri S.Kom, M.Kom.<br>
                  <span class="badge badge-secondary badge-pill">3673010407870002</span>
                </div>
              </div>
            </li>

            <!-- Profil Mahasiswa -->
            <em class="font-weight-bold mb-2">Mahasiswa</em>
            <li class="list-group-item align-items-center py-1">
              <div class="row align-items-center">
                <div class="col-md-2">
                  <img class="rounded-circle" width="40" height="auto" src=" <?= base_url('assets/img/kelompok/mala.jpg'); ?>" alt="mala">
                </div>
                <div class="col-md-6">
                  Nurmala Ameliana
                </div>
                <div class="col-md-4 text-center">
                  <span class="badge badge-dark-blue badge-pill">Tester</span>
                </div>
              </div>
            </li>
            <li class="list-group-item align-items-center py-1">
              <div class="row align-items-center">
                <div class="col-md-2">
                  <img class="rounded-circle" width="40" height="auto" src=" <?= base_url('assets/img/kelompok/wafi.png'); ?>" alt="mala">
                </div>
                <div class="col-md-6">
                  Muhammad Naufal Wafi
                </div>
                <div class="col-md-4 text-center">
                  <span class="badge badge-dark-blue badge-pill">Back End</span>
                </div>
              </div>
            </li>
            <li class="list-group-item align-items-center py-1">
              <div class="row align-items-center">
                <div class="col-md-2">
                  <img class="rounded-circle" width="40" height="auto" src=" <?= base_url('assets/img/kelompok/gita.jpg'); ?>" alt="mala">
                </div>
                <div class="col-md-6">
                  Sagita Hapsari
                </div>
                <div class="col-md-4 text-center">
                  <span class="badge badge-dark-blue badge-pill">Front End</span>
                </div>
              </div>
            </li>
            <li class="list-group-item align-items-center py-1">
              <div class="row align-items-center">
                <div class="col-md-2">
                  <img class="rounded-circle" width="40" height="auto" src=" <?= base_url('assets/img/kelompok/arvy.png'); ?>" alt="mala">
                </div>
                <div class="col-md-6">
                  Arvy Adhitya Sutisna
                </div>
                <div class="col-md-4 text-center">
                  <span class="badge badge-dark-blue badge-pill">Project Manager</span>
                </div>
              </div>
            </li>
            <li class="list-group-item align-items-center py-1">
              <div class="row align-items-center">
                <div class="col-md-2">
                  <img class="rounded-circle" width="40" height="auto" src=" <?= base_url('assets/img/kelompok/nazla.png'); ?>" alt="mala">
                </div>
                <div class="col-md-6">
                  Nazla Bella Fadilah
                </div>
                <div class="col-md-4  text-center">
                  <span class="badge badge-dark-blue badge-pill">System Analyst</span>
                </div>
              </div>
            </li>
            <li class="list-group-item align-items-center py-1">
              <div class="row align-items-center">
                <div class="col-md-2">
                  <img class="rounded-circle" width="40" height="auto" src=" <?= base_url('assets/img/kelompok/sendy.png'); ?>" alt="mala">
                </div>
                <div class="col-md-6">
                  Sendy Cahyono
                </div>
                <div class="col-md-4  text-center">
                  <span class="badge badge-dark-blue badge-pill">Documenter</span>
                </div>
              </div>
            </li>
            <li class="list-group-item align-items-center py-1">
              <div class="row align-items-center">
                <div class="col-md-2">
                  <img class="rounded-circle" width="40" height="auto" src=" <?= base_url('assets/img/kelompok/mala.jpg'); ?>" alt="mala">
                </div>
                <div class="col-md-6">
                  Annisa Nur Fitriyani
                </div>
                <div class="col-md-4 text-center">
                  <span class="badge badge-dark-blue badge-pill">Data Analyst</span>
                </div>
              </div>
            </li>
            <li class="list-group-item align-items-center py-1">
              <div class="row align-items-center">
                <div class="col-md-2">
                  <img class="rounded-circle" width="40" height="auto" src=" <?= base_url('assets/img/kelompok/zuzu.png'); ?>" alt="mala">
                </div>
                <div class="col-md-6">
                  Zuharman
                </div>
                <div class="col-md-4 text-center">
                  <span class="badge badge-dark-blue badge-pill">Tester</span>
                </div>
              </div>
            </li>
            
          </ul>
        </div>
        <li class="list-group-item align-items-center py-1">
          <div class="row mb-1">
            <div class="col text-center mt-1">
              The 3D Illustration by Alzea Arafat<br>
              <a class="badge badge-info badge-pill" href="https://www.figma.com/community/file/890095002328610853 ">https://www.figma.com/community/file/890095002328610853 </a>
            </div>
          </div>
        </li>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <?= $this->endSection(); ?>

  <?= $this->section("footer_js"); ?>
  <script>
  </script>
  <?= $this->endSection(); ?>