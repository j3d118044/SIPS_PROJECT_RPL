<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<header class="masthead">
    <div class="jumbotron jumbotron-fluid">
        <img src="<?= base_url('img/abstract-pink.png'); ?>" class="img-fluid-right" alt="Responsive image">
        <img src="<?= base_url('img/big-1.png'); ?>" class="img-fluid-right" alt="Responsive image">
        <h1 style="padding-left: 50px; font-size: 30px; color: #520070">Mari Belajar</h1>
        <h2 style="padding-left: 50px; font-size: 80px; color: #520070">Subnetting<br>IP Address</h2>
        <h3 style="padding-left: 50px; font-size: 20px; color: #8c8c8c">Masuk atau daftar akun Anda<br>untuk mulai belajar di SIPS</h3>
        <button type="button" class="btn btn-dark" href="pages/daftar">Daftar</button>
        <button type="button" class="btn btn-dark" href="pages/masuk">Masuk</button>
    </div>
</header>

<?= $this->endSection('content'); ?>