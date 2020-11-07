<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<header class="masthead">
    <div class="jumbotron jumbotron-fluid">
        <img src="<?= base_url('img/circle-blue.png'); ?>" class="img-fluid-right" alt="Responsive image">
        <img src="<?= base_url('img/big-12.png'); ?>" class="img-fluid-right" alt="Responsive image">
        <h1 style="padding-left: 50px; font-size: 30px; color: #520070">Tentang Website</h1>
        <h2 style="padding-left: 50px; font-size: 20px; color: #520070">Ilustrasi 3D oleh Alzea Arafat</h2>
        <h3 style="padding-left: 50px; font-size: 20px; color: #8c8c8c">Hak Cipta 2020</h3>
    </div>
</header>

<?= $this->endSection('content'); ?>