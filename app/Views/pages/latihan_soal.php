<?= $this->extend("layouts/pages") ?>

<?= $this->section("header_js") ?>
<script>
</script>
<?= $this->endSection() ?>

<?= $this->section("main_content") ?>

<!-- Begin Page Content -->
<div class="row row-1">
  <div class="col-lg-12">
    <div class="card o-hidden border-0 shadow-lg">
      <div class="card-body p-0">
        <div class="row">
          <!-- justify-content-center -->
          <div class="col-lg-12">
            <div class="p-5">

              <h1 class="h3 text-gray-900 mb-2 font-weight-bold text-center">
                Soal ke-<?= $dataSoal["index"] ?> dari 3
              </h1>
              <hr>

              <h5 class="text-black mb-2">
                <?= $dataSoal["soal"] ?>
              </h5>

              <h5>Jawab :</h5>

              <form method="post" action="<?= site_url("/latihan/" . $dataSoal["index"]) ?>">
                <?= csrf_field() ?>

                <?php for ($i = 1; $i <= $dataSoal["jumlah_jawaban"]; $i++) : ?>
                  <div class="form-group-answer row my-0">
                  <div class="col-sm-1 text-black text-center py-2">
                    <?= $i ?>
                  </div>
                    <div class="col-sm-5">
                      <input class="form-control form-control-user
                        <?php if (session()->has("jawaban_" . $dataSoal["index"] . "_status")) : ?>
                        <?= session()->get("jawaban_" . $dataSoal["index"] . "_status")[$i - 1]["status"] == true
                            ? "is-valid"
                            : "is-invalid"
                        ?>
                        <?php endif; ?>" name="jawaban[]" placeholder="Jawaban <?= $i ?>" value="<?= session()->has("jawaban_" . $dataSoal["index"] . "_status") ? session()->get("jawaban_" . $dataSoal["index"] . "_status")[$i - 1]["jawaban"] : "" ?>" <?= session()->has("jawaban_" . $dataSoal["index"] . "_status") ? "disabled" : "" ?> required>
                    </div>
                  </div>
                <?php endfor; ?>

                <hr class="mt-2 mb-1">
                <div class="form-group row my-0">
                  <div class="col-sm-0">
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group row my-0">

                      <!-- Get nilai segmen -->
                      <?php $segmen = current_url(true)->getSegment(2); ?>

                      <!-- Button Sebelumnya -->
                      <div class="col-sm-2">
                        <?php if ($segmen > 1) : ?>
                          <a href="<?= site_url("/latihan/" . ($segmen - 1)) ?>" class="btn btn-primary btn-user btn-block my-1">
                          <?php else : ?>
                            <a class="btn btn-primary btn-user btn-block my-1 disabled">
                            <?php endif; ?>
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                            </a>
                      </div>

                      <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-user btn-block my-1" <?= session()->has("jawaban_" . $segmen . "_status") ? "disabled" : "" ?>>
                          <i class="" aria-hidden="true"></i>Kirim Jawaban
                        </button>
                      </div>

                      <div class="col-sm-4">
                        <button type="button" class="btn btn-primary btn-user btn-block my-1" <?= !session()->has("jawaban_" . $segmen . "_status") ? "disabled" : "" ?> data-toggle="modal" data-target="#pembahasanModal">
                          <i class="" aria-hidden="true"></i>Pembahasan
                        </button>
                      </div>

                      <!-- Button Selanjutnya -->
                      <div class="col-sm-2">
                        <?php if ($segmen < 3) : ?>
                          <a href="<?= site_url("/latihan/" . ($segmen + 1)) ?>" class="btn btn-primary btn-user btn-block my-1">
                          <?php else : ?>
                            <a class="btn btn-primary btn-user btn-block my-1 disabled">
                            <?php endif; ?>
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </a>
                      </div>
                    </div>
                  </div>
                </div>
              </form>

              <hr class="mt-1">
              <form method="post" action="<?= site_url("/latihan") ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="latihan_sk" value="reset">
                <button type="submit" class="btn btn-primary btn-user btn-block my-2">
                  <i class="" aria-hidden="true"></i>Selesai
                </button>
              </form>
              <hr>

              <!-- Pembahasan Modal-->
              <?php if (
                session()->has("jawaban_" . $dataSoal["index"] . "_pembahasan")
              ) : ?>
                <div class="modal fade" id="pembahasanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-text-center">
                        <h5 class="modal-title text-center text-gray-900 font-weight-bold mt-2" id="exampleModalLabel">Pembahasan</h5>
                      </div>
                      <div class="modal-body mr-7" style="color: black;">
                        <?= session()->get(
                          "jawaban_" . $dataSoal["index"] . "_pembahasan"
                        ) ?>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- /.container-fluid -->

<?= $this->endSection() ?>

<?= $this->section("footer_js") ?>
<script>
</script>
<?= $this->endSection()
?>