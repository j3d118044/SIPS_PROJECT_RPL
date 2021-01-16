<?= $this->extend("layouts/pages") ?>

<?= $this->section("header_js") ?>
<script>
</script>
<?= $this->endSection() ?>

<?= $this->section("main_content") ?>

<!-- Begin Page Content -->
<div class="row row-1">
  <div class="col-lg-12">
    <h1 class="h3 text-gray-900 mb-2 font-weight-bold text-center">Peringkat</h1>
    <div class="card o-hidden border-0 shadow-lg">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <hr class="mb-1">
              <div class="card">
                <div class="card">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Foto</th>
                          <th>Nama</th>
                          <th>Organisasi</th>
                          <th>Skor</th>
                          <th>Waktu</th>
                        </tr>
                      </thead>
                      <?php if (!empty($peringkat)) : ?>
                        <tbody>
                          <?php $i = 1; ?>
                          <?php foreach ($peringkat as $data) : ?>
                            <tr>
                              <td><?= $i++ ?></td>
                              <td>
                                <img width="48" height="48" class="img-profile-rank rounded-circle" src="<?= base_url("assets/img/pelajar/" . $data["foto"]) ?>">
                              </td>
                              <td><?= $data["nama"] ?></td>
                              <td><?= $data["organisasi"] ?></td>
                              <td><?= $data["skor_kuis"] ?></td>
                              <td><?= $data["waktu_kuis"] ?></td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      <?php else : ?>
                        <tbody>
                          <tr>
                            <td colspan="6">Tidak ada data.</td>
                          </tr>
                        </tbody>
                      <?php endif; ?>
                    </table>
                  </div>
                </div>
              </div>
              <hr class="mt-1">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

<?= $this->endSection("content") ?>

<?= $this->section("footer_js") ?>
<script>
</script>
<?= $this->endSection()
?>