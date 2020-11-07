<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<header class="masthead">
    <div class="jumbotron jumbotron-fluid">
        <h1 style="text-align: right; margin-right: 90px;">Peringkat Latihan/Quiz</h1>
        <img src="<?= base_url('img/abstract-yellow.png'); ?>" class="img-fluid-left" alt="Responsive image">
        <img src="<?= base_url('img/big-18.png'); ?>" class="img-fluid-left" alt="Responsive image">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Skor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>1000</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>900</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>800</td>
                </tr>
            </tbody>
        </table>

    </div>
</header>
<?= $this->endSection('content'); ?>