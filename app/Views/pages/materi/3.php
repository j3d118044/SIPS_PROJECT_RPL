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

              <div class="text-center">
                <h1 class="h3 text-gray-900 mb-2 font-weight-bold">CIDR</h1>
              </div>
              <hr class="mb-2">

              <div class="form-group row my-0">
                <div class="col-sm-12">
                  <p class="text-indent text-black"><i>Classless Inter-Domain Routing (CIDR)</i> adalah sebuah cara alternatif untuk mengklasifikasikan alamat-alamat <i>IP Address</i> berbeda dengan sistem klasifikasi ke dalam kelas A, kelas B, kelas C, kelas D, dan kelas E. Disebut juga sebagai <i>supernetting.</i> CIDR merupakan mekanisme <i>routing</i> dengan membagi alamat IP jaringan ke dalam kelas-kelas A, B, dan C.
                  </p>
                  <p class="text-indent text-black">CIDR digunakan untuk mempermudah penulisan notasi <i>subnet mask</i> agar lebih ringkas dibandingkan penulisan notasi <i>subnet mask</i> yang sesungguhnya. Untuk penggunaan notasi alamat CIDR pada <i>classfull address</i> pada kelas A adalah /8 sampai dengan /15, kelas B adalah /16 sampai dengan /23, dan kelas C adalah /24 sampai dengan /28. <i>Subnet mask </i>CIDR /31 dan /32 tidak pernah ada dalam jaringan yang nyata.
                  </p>

                  <h5 class="text-center mt-1">Tabel Kelas A</h5>
                  <div class="card">
                    <div class="card">
                      <div class="table-responsive mb-2">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>#bit</th>
                              <th>Subnet mask</th>
                              <th>CIDR</th>
                              <th>Jumlah Host</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>0</td>
                              <td>255.0.0.0</td>
                              <td>/8</td>
                              <td>16777216</td>
                            </tr>
                            <tr>
                              <td>1</td>
                              <td>255.128.0.0</td>
                              <td>/9</td>
                              <td>8388608</td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>255.192.0.0</td>
                              <td>/10</td>
                              <td>4194304</td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>255.224.0.0</td>
                              <td>/11</td>
                              <td>2097152</td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td>255.240.0.0</td>
                              <td>/12</td>
                              <td>1048576</td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td>255.248.0.0</td>
                              <td>/13</td>
                              <td>524288</td>
                            </tr>
                            <tr>
                              <td>6</td>
                              <td>255.252.0.0</td>
                              <td>/14</td>
                              <td>262144</td>
                            </tr>
                            <tr>
                              <td>7</td>
                              <td>255.254.0.0</td>
                              <td>/15</td>
                              <td>131072</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <h5 class="text-center mt-1">Tabel Kelas B</h5>
                  <div class="card">
                    <div class="card">
                      <div class="table-responsive mb-2">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>#bit</th>
                              <th>Subnet mask</th>
                              <th>CIDR</th>
                              <th>Jumlah Host</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>0</td>
                              <td>255.255.0.0</td>
                              <td>/16</td>
                              <td>65536</td>
                            </tr>
                            <tr>
                              <td>1</td>
                              <td>255.255.128.0</td>
                              <td>/17</td>
                              <td>32768</td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>255.255.192.0</td>
                              <td>/18</td>
                              <td>16384</td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>255.255.224.0</td>
                              <td>/19</td>
                              <td>8192</td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td>255.255.240.0</td>
                              <td>/20</td>
                              <td>4096</td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td>255.255.248.0</td>
                              <td>/21</td>
                              <td>2048</td>
                            </tr>
                            <tr>
                              <td>6</td>
                              <td>255.255.252.0</td>
                              <td>/22</td>
                              <td>1024</td>
                            </tr>
                            <tr>
                              <td>7</td>
                              <td>255.255.254.0</td>
                              <td>/23</td>
                              <td>512</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <h5 class="text-center mt-1">Tabel Kelas C</h5>
                  <div class="card">
                    <div class="card">
                      <div class="table-responsive mb-2">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>#bit</th>
                              <th>Subnet mask</th>
                              <th>CIDR</th>
                              <th>Jumlah Host</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>0</td>
                              <td>255.255.255.0</td>
                              <td>/24</td>
                              <td>256</td>
                            </tr>
                            <tr>
                              <td>1</td>
                              <td>255.255.255.128</td>
                              <td>/25</td>
                              <td>128</td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>255.255.255.192</td>
                              <td>/26</td>
                              <td>164</td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>255.255.255.224</td>
                              <td>/27</td>
                              <td>32</td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td>255.255.255.240</td>
                              <td>/28</td>
                              <td>16</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <a class="float-right" href="http://smk.kemdikbud.go.id/konten/1148/notasi-cidr-ip-versi-4">Sumber : http://smk.kemdikbud.go.id</a>
                </div>
              </div>
              <hr class="mt-2">
              <div class="form-group row">
                <div class="col-sm-6">
                  <a href="<?= site_url('/materi/2') ?>" class="btn btn-primary btn-user btn-block mt-2 mb-0"><i class="fa fa-chevron-left" aria-hidden="true"></i> Sebelumnya</a>
                </div>
                <div class="col-sm-6">
                  <a id="submit_btn" class="btn btn-primary btn-user btn-block  mt-2 mb-1" href="<?= site_url("/materi/4") ?>">Selanjutnya <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div>
              </div>
              <hr>
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