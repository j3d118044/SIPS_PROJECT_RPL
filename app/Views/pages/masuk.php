<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<header class="masthead">
    <div class="jumbotron jumbotron-fluid">
        <img src="<?= base_url('img/circle-blue.png'); ?>" class="img-fluid-left" alt="Responsive image">
        <img src="<?= base_url('img/big-2.png'); ?>" class="img-fluid-left" alt="Responsive image">

        <div class="container">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div id="first">
                        <div class="myform form ">
                            <div class="logo mb-3">
                                <div class="col-md-12 text-center">
                                    <h1 style="color: #ffffff;">Masuk</h1>
                                </div>
                            </div>
                            <form action="" method="post" name="login">
                                <div class="form-group">
                                    <label style="color: #ffffff" for="exampleInputEmail1">Alamat Email</label>
                                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Masukkan email">
                                </div>
                                <div class="form-group">
                                    <label style="color: #ffffff" for="exampleInputEmail1">Kata Sandi</label>
                                    <input type="password" name="password" id="password" class="form-control" aria-describedby="emailHelp" placeholder="Masukkan Kata Sandi">
                                </div>
                                <div class="form-group">
                                    <p class="text-center" style="color: #ffffff">Dengan masuk Anda menerima <a href="#">persyaratan pengguna</a></p>
                                </div>
                                <div class="col-md-12 text-center ">
                                    <!-- <button type="submit" class=" btn btn-block mybtn btn-dark tx-tfm">Masuk</button> -->
                                    <a href="<?= site_url('pages/home') ?> " class=" btn btn-block mybtn btn-dark tx-tfm">Masuk</a>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="login-or">
                                        <hr class="hr-or">
                                        <span class="span-or">atau</span>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <p class="text-center">
                                        <a href="javascript:void();" class="google btn mybtn"><i class="fa fa-google-plus">
                                            </i> Masuk lewat Google
                                        </a>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <p class="text-center">Tidak memiliki akun? <a href="pages/daftar" id="signup">Daftar di sini</a></p>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div id="second">
                        <div class="myform form ">
                            <div class="logo mb-3">
                                <div class="col-md-12 text-center">
                                    <h1>Daftar</h1>
                                </div>
                            </div>
                            <form action="#" name="registration">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Depan</label>
                                    <input type="text" name="firstname" class="form-control" id="firstname" aria-describedby="emailHelp" placeholder="Masukkan Nama Depan">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Belakang</label>
                                    <input type="text" name="lastname" class="form-control" id="lastname" aria-describedby="emailHelp" placeholder="Masukkan Nama Belakang">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat Email</label>
                                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Masukkan Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kata Sandi</label>
                                    <input type="password" name="password" id="password" class="form-control" aria-describedby="emailHelp" placeholder="Masukkan Kata Sandi">
                                </div>
                                <div class="col-md-12 text-center mb-3">
                                    <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Daftar</button>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <p class="text-center"><a href="pages/masuk" id="signin">Sudah punya akun?</a></p>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>
</header>

<?= $this->endSection('content'); ?>