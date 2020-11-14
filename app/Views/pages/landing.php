<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="section ">
    <div class="row justify-content-center">
        <div class="col-10 col-sm-8 col-md-9 col-lg-10">
            <div class="row">
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 ">
                    <h1>Mari Belajar</h1>
                    <h2>Subnetting<br>IP Address</h2>
                    <h3>Masuk atau daftar akun Anda</h3>
                    <a class="btn btn-dark btn-sign-up" href="<?= site_url('pages/daftar') ?>">Daftar</a>
                    <a class="btn btn-dark btn-sign-in" href="<?= site_url('pages/masuk') ?>">Masuk</a>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                    <!-- <a href="/" class="pop-up-about" target="_self" data-toggle="modal" data-target="#anggotaKelompok">
                        <i class="fa fa-users fa-md"></i> About
                    </a> -->
                    <img src="<?= base_url('img/abstract-pink.png'); ?>" class="img-fluid-right" alt="Responsive image">
                    <img src="<?= base_url('img/big-1.png'); ?>" class="img-fluid-right" alt="Responsive image">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </header> -->

<?= $this->endSection('content'); ?>