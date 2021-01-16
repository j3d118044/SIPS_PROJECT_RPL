<?= $this->include("layouts/header") ?>

<?= $this->renderSection("header_js") ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar-nav bg-gradient-background sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <img class="logo-sidebar" src=" <?= base_url("assets/img/sips-logo-purple.png") ?>">
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <?php if (session()->has("adminid") and $status === "admin") { ?>
        <li class="nav-item <?= $route == "beranda" ? "active" : "" ?>">
          <a class="nav-link" href="<?= site_url("admin/beranda") ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Beranda</span>
          </a>
        </li>
        <li class="nav-item <?= $route == "manajemen" ? "active" : "" ?>">
          <a class="nav-link" href="<?= site_url("admin/manajemen") ?>">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Manajemen</span>
          </a>
        </li>
        <li class="nav-item <?= $route == "rekapitulasi" ? "active" : "" ?>">
          <a class="nav-link" href="<?= site_url("admin/rekapitulasi") ?>">
            <i class="fas fa-fw fa-file"></i>
            <span>Rekapitulasi</span>
          </a>
        </li>
        <li class="nav-item <?= $route == "grafik" ? "active" : "" ?>">
          <a class="nav-link" href="<?= site_url("admin/grafik_kuis") ?>">
            <i class="fas fa-fw fa-chart-pie"></i>
            <span>Grafik</span>
          </a>
        </li>
      <?php } elseif (session()->has("userid") and $status === "pelajar") { ?>
        <li class="nav-item  <?= $route == "beranda" ? "active" : "" ?>">
          <a class="nav-link " href="<?= site_url("beranda") ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Beranda</span>
          </a>
        </li>
        <li class="nav-item <?= $route == "materi" ? "active" : "" ?>">
          <a class="nav-link <?= $route == "materi" ? "" : "collapsed" ?>" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="<?= $route == "materi" ? "true" : "false" ?>" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-book"></i>
            <span>Materi</span>
          </a>
          <div id="collapseUtilities" class="collapse <?= $route == "materi" ? "show" : "" ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="<?= site_url("materi/1") ?>">IP Address</a>
              <a class="collapse-item" href="<?= site_url("materi/2") ?>">Subnetting</a>
              <a class="collapse-item" href="<?= site_url("materi/3") ?>">CIDR</a>
              <a class="collapse-item" href="<?= site_url("materi/4") ?>">VLSM</a>
            </div>
          </div>
        </li>
        <li class="nav-item <?= $route == "latihan" ? "active" : "" ?>">
          <a class="nav-link" href="<?= site_url("latihan") ?>">
            <i class="fas fa-fw fa-pencil-alt"></i>
            <span>Latihan</span>
          </a>
        </li>
        <li class="nav-item <?= $route == "kuis" ? "active" : "" ?>">
          <a class="nav-link" href="<?= site_url("kuis") ?>">
            <i class="fas fa-fw fa-desktop"></i>
            <span>Kuis</span>
          </a>
        </li>
        <li class="nav-item <?= $route == "peringkat" ? "active" : "" ?>">
          <a class="nav-link" href="<?= site_url("peringkat") ?>">
            <i class="fas fa-fw fa-trophy"></i>
            <span>Peringkat</span>
          </a>
        </li>
      <?php } ?>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-transparent topbar mb-4 static-top">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if (
                  session()->has("adminid") and
                  $status === "admin"
                ) { ?>
                  <span class="mr-3 d-none d-lg-inline text-gray-600"><i class="fas fa-fw fa-user"></i> <?= $email ?></span>
                <?php } elseif (
                  session()->has("userid") and
                  $status === "pelajar"
                ) { ?>
                  <span class="mr-3 d-none d-lg-inline text-gray-600"><i class="fas fa-fw fa-user"></i> <?= $nama ?></span>
                <?php } ?>
                <img class="img-profile rounded-circle" src="
                      <?php if (
                        session()->has("userid") and
                        $status === "pelajar"
                      ) { ?>
                      <?= base_url("assets/img/pelajar/" . $foto) ?>
                      <?php } elseif (
                        session()->has("adminid") and
                        $status === "admin"
                      ) { ?>
                      <?= base_url("assets/img/" . $foto) ?>
                      <?php } ?>
                    ">
              </a>

              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <?php if (
                  session()->has("adminid") and
                  $status === "admin"
                ) { ?>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Keluar
                  </a>
                <?php } elseif (
                  session()->has("userid") and
                  $status === "pelajar"
                ) { ?>
                  <a class="dropdown-item <?= $route == "profil" ? "active" : "" ?>" href="<?= site_url("/profil") ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profil
                  </a>
                  <a class="dropdown-item <?= $route == "ubah_profil" ? "active" : "" ?>" href="<?= site_url("/ubah_profil") ?>">
                    <i class="fas fa-user-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                    Ubah Profil
                  </a>
                  <a class="dropdown-item <?= $route == "ubah_kata_sandi" ? "active" : "" ?>" href="<?= site_url("/ubah_kata_sandi") ?>">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                    Ubah Kata Sandi
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Keluar
                  </a>
                <?php } ?>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <?= $this->renderSection("main_content") ?>

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-transparent">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; SIPS 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Silakan Klik "Keluar" di bawah jika ingin keluar.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="
          <?php if (session()->has("adminid") and $status === "admin") { ?>
          <?= site_url("/admin/keluar") ?>
          <?php } elseif (
            session()->has("userid") and
            $status === "pelajar"
          ) { ?>
          <?= site_url("/keluar") ?>
          <?php } ?>
          ">Keluar</a>
        </div>
      </div>
    </div>
  </div>

  <?= $this->include("layouts/footer") ?>

  <?= $this->renderSection("footer_js") ?>

</body>

</html>