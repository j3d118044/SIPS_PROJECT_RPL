<?= $this->extend('layouts/pages'); ?>

<?= $this->section('header_js'); ?>
<script>
  function startKuis() {
    // window.open('http://localhost/kuis.php','mywin', "width="+screen.availWidth+",height="+screen.availHeight);
    hide("info");
    // hide("result");
    show("kuis");
    show("time");
    $("#startKuisModal").modal('hide');

    let inputId = ["#net_add", "#mx_add", "#fh_add", "#lh_add", "#bc_add"];

    inputId.forEach(element => {
      $(element).val("");
      $(element).attr("class", "form-control");
      $(element + "_ans").empty();
    });
    $("#submit_btn").prop('disabled', false);

    interval = window.setInterval(stopWatch, 1000);
    // status = "started";
  }

  function stopKuis() {

    // skor null/<0, tidak disimpan
    if (localStorage.getItem('score') !== null && parseInt(localStorage.getItem('score')) > 0) {
      // console.log(localStorage.getItem('score'));
      $.ajax({
        url: '<?= site_url('/kuis'); ?>',
        method: 'post',
        data: {
          waktu: localStorage.getItem('time'),
          skor: localStorage.getItem('score'),
          // [csrfName]: csrfHash
        },
        dataType: 'json',
      })
    }

    show("info");
    // show("result");
    hide("kuis");
    hide("time");

    // status = "stopped";

    window.clearInterval(interval);
    seconds = 0;
    minutes = 0;
    hours = 0;
    document.getElementById("display").innerHTML = "00:00:00";
    // document.getElementById("startStop").innerHTML = "Start";
    // //
    document.getElementById("score").innerHTML = "0";

    console.log("score: " + localStorage.getItem('score') + " time: " + localStorage.getItem('time'));

    if (localStorage.getItem('score') && localStorage.getItem('time')) {
      $("#last_score").html(localStorage.getItem('score'));
      $("#time_elapsed").html(localStorage.getItem('time'));
      show("result");
    } else {
      $("#last_score").html('');
      $("#time_elapsed").html('');
      hide("result");
    }

    localStorage.clear();

  }

  function hide(x) {
    document.getElementById(x).style.display = "none";
    //  document.getElementById(x).classList.add("hidden");
  }

  function show(x) {
    document.getElementById(x).style.display = null;
  }
</script>

<script>
  window.onload = function() {
    // hide("info");
    if (localStorage.getItem('time')) {
      document.getElementById("display").innerHTML = localStorage.getItem('time');

      hide("result");
      hide("info");
      show("kuis");
      show("time");
      $("#startKuisModal").modal('hide');

      // window.clearInterval(interval);
      interval = window.setInterval(stopWatch, 1000);
    } else {
      show("info");
    }
  }
</script>

<script>
  //Define vars to hold time values
  let seconds = localStorage.getItem('seconds') ? localStorage.getItem('seconds') : 0;
  let minutes = localStorage.getItem('minutes') ? localStorage.getItem('minutes') : 0;
  let hours = localStorage.getItem('hours') ? localStorage.getItem('hours') : 0;

  //Define vars to hold "display" value
  let displaySeconds = 0;
  let displayMinutes = 0;
  let displayHours = 0;

  //Define var to hold setInterval() function
  let interval = null;

  //Define var to hold stopwatch status
  let status = "stopped";

  //Stopwatch function (logic to determine when to increment next value, etc.)
  function stopWatch() {

    seconds++;

    //Logic to determine when to increment next value
    if (seconds / 60 === 1) {
      seconds = 0;
      minutes++;

      if (minutes / 60 === 1) {
        minutes = 0;
        hours++;
      }

    }

    //If seconds/minutes/hours are only one digit, add a leading 0 to the value
    if (seconds < 10) {
      displaySeconds = "0" + seconds.toString();
    } else {
      displaySeconds = seconds;
    }

    if (minutes < 10) {
      displayMinutes = "0" + minutes.toString();
    } else {
      displayMinutes = minutes;
    }

    if (hours < 10) {
      displayHours = "0" + hours.toString();
    } else {
      displayHours = hours;
    }

    localStorage.setItem('seconds', seconds);
    localStorage.setItem('minutes', minutes);
    localStorage.setItem('hours', hours);

    localStorage.setItem('time', displayHours + ":" + displayMinutes + ":" + displaySeconds);

    //Display updated time values to user
    document.getElementById("display").innerHTML = displayHours + ":" + displayMinutes + ":" + displaySeconds;

  }

  function startStop() {

    if (status === "stopped") {

      //Start the stopwatch (by calling the setInterval() function)
      interval = window.setInterval(stopWatch, 1000);
      document.getElementById("startStop").innerHTML = "Stop";
      status = "started";

    } else {

      window.clearInterval(interval);
      document.getElementById("startStop").innerHTML = "Start";
      status = "stopped";

    }

  }

  //Function to reset the stopwatch
  function reset() {

    window.clearInterval(interval);
    seconds = 0;
    minutes = 0;
    hours = 0;
    document.getElementById("display").innerHTML = "00:00:00";
    document.getElementById("startStop").innerHTML = "Start";

    localStorage.clear();

  }
</script>

<script>
  $("html").mouseleave(function() {});

  var sA = [10, 172, 192],
    sB = [
      [0, 255],
      [16, 15],
      [167, 168]
    ],
    mN = [
      [8, 7],
      [16, 7],
      [24, 6]
    ],
    mI = [1, 128, 64, 32, 16, 8, 4, 2, 1, 128, 64, 32, 16, 8, 4, 2, 1, 128, 64, 32, 16, 8, 4];

  var rIP, mIP, mod, xIP, Ax, Bx, Cx, Dx, Fh, Lh, Bc;
  var trial = 0,
    score = 0,
    mode = "",
    count = 0,
    time, stat = 0;

  $(document).ready(function() {
    mode = $("#netclass option:selected").text();

    rand_ip();
    if (localStorage.getItem('score')) {
      document.getElementById("score").innerHTML = localStorage.getItem('score');
      // return rand_ip();
    } else {
      document.getElementById("result").style.display = "none";
    }

  });

  function rand_ip() {
    var A, B, C, D, M, i, rA;
    count = 0;
    stat = 0;

    temp_score = localStorage.getItem('score') ? localStorage.getItem('score') : 0;

    switch (Number($("#netclass option:selected").val())) {
      case 1:
        rA = rand_index(0, 0);
        mode = "A";
        break;
      case 2:
        rA = rand_index(0, 1);
        mode = "B";
        break;
      case 3:
        rA = rand_index(1, 2);
        mode = "C";
        break;
      case 4:
        rA = rand_index(0, 2);
        mode = "A/B/C";
        break;
    }

    let inputId = ["#net_add", "#mx_add", "#fh_add", "#lh_add", "#bc_add"];

    inputId.forEach(element => {
      $(element).val("");
      $(element).attr("class", "form-control");
      $(element + "_ans").empty();
    });

    $("#check_btn").prop('disabled', false);
    $("#submit_btn").prop('disabled', false);

    A = sA[rA];
    B = rand_index(sB[rA][0], sB[rA][1]);
    C = rand_index(0, 255);
    D = rand_index(0, 255);

    M = rand_index(mN[rA][0], mN[rA][1]);
    mod = mI[M - 8];
    rIP = A + "." + B + "." + C + "." + D;

    if (M > 24 && M < 31) { // Segment D
      Ax = A;
      Bx = B;
      Cx = C;
      Dx = find_net(D);
      mIP = "255.255.255." + (256 - mod);
      Fh = Ax + "." + Bx + "." + Cx + "." + (Dx + 1);
      Lh = Ax + "." + Bx + "." + Cx + "." + (Dx + mod - 2);
      Bc = Ax + "." + Bx + "." + Cx + "." + (Dx + mod - 1);
    }

    if (M > 16 && M < 25) { //Segment C
      Ax = A;
      Bx = B;
      Dx = 0;
      Cx = find_net(C);
      mIP = "255.255." + (256 - mod) + ".0";
      Fh = Ax + "." + Bx + "." + (Cx) + "." + (Dx + 1);
      Lh = Ax + "." + Bx + "." + (Cx + mod - 1) + "." + 254;
      Bc = Ax + "." + Bx + "." + (Cx + mod - 1) + "." + 255;
    }

    if (M > 8 && M < 17) { //Segment B
      Ax = A;
      Cx = 0;
      Dx = 0;
      Bx = find_net(B);
      mIP = "255." + (256 - mod) + ".0.0";
      Fh = Ax + "." + Bx + "." + Cx + "." + (Dx + 1);
      Lh = Ax + "." + (Bx + mod - 1) + "." + 255 + "." + 254;
      Bc = Ax + "." + (Bx + mod - 1) + "." + 255 + "." + 255;
    }

    if (M == 8) { //Segment A
      Bx = 0;
      Cx = 0;
      Dx = 0;
      Ax = A;
      mIP = "255.0.0.0";
      Fh = Ax + "." + Bx + "." + Cx + "." + (Dx + 1);
      Lh = Ax + ".255.255.254";
      Bc = Ax + ".255.255.255";
    }

    xIP = Ax + "." + Bx + "." + Cx + "." + Dx;
    $("#rand_ip").html(rIP + " /" + M);
  }

  function second() {
    count++;
    time = setTimeout(second, 1000);
  }

  function rand_index(bot, top) {
    if (bot + 1 == top) {
      return top;
    } else {
      return Math.floor((Math.random() * (top + 1)) + bot);
    }
  }

  function find_net(x) {

    for (var i = x; i >= 0; i--) {
      if (i % mod == 0) {
        break;
      }
    }
    return i;

  }

  function submit() {

    if (!$("#net_add").val() ||
      !$("#mx_add").val() ||
      !$("#fh_add").val() ||
      !$("#lh_add").val() ||
      !$("#bc_add").val()) {
      $('#alert').modal('show')
      return;
    }

    temp_score = 0;
    var net = $("#net_add").val(),
      mx = $("#mx_add").val(),
      fh = $("#fh_add").val(),
      lh = $("#lh_add").val(),
      bc = $("#bc_add").val();

    if (net === xIP) {
      $("#net_add").addClass('is-valid');
      temp_score += 2;
    } else {
      $("#net_add").addClass('is-invalid');
      $("#net_add_ans").html(xIP);
    }

    if (mx === mIP) {
      $("#mx_add").addClass('is-valid');
      temp_score += 2;
    } else {
      $("#mx_add").addClass('is-invalid');
      $("#mx_add_ans").html(mIP);
    }

    if (fh === Fh) {
      $("#fh_add").addClass('is-valid');
      temp_score += 2;
    } else {
      $("#fh_add").addClass('is-invalid');
      $("#fh_add_ans").html(Fh);
    }

    if (lh === Lh) {
      $("#lh_add").addClass('is-valid');
      temp_score += 2;
    } else {
      $("#lh_add").addClass('is-invalid');
      $("#lh_add_ans").html(Lh);
    }

    if (bc === Bc) {
      $("#bc_add").addClass('is-valid');
      temp_score += 2;
    } else {
      $("#bc_add").addClass('is-invalid');
      $("#bc_add_ans").html(Bc);
    }

    if (localStorage.getItem('score')) {
      temp_score += parseInt(localStorage.getItem('score'));
    }

    localStorage.setItem('score', temp_score);
    $("#score").html(localStorage.getItem('score'));
    console.log(temp_score + "//" + localStorage.getItem('score'));

    $("#submit_btn").prop('disabled', true);

  }

  function resetLocal() {
    localStorage.clear();
  }

  function check() {
    // score=0;
    var net = $("#net_add").val(),
      mx = $("#mx_add").val(),
      fh = $("#fh_add").val(),
      lh = $("#lh_add").val(),
      bc = $("#bc_add").val();

    if (net == xIP) {
      $("#net_add").addClass('is-valid');
    } else {
      $("#net_add").addClass('is-invalid');
    }

    if (mx == mIP) {
      $("#mx_add").addClass('is-valid');
    } else {
      $("#mx_add").addClass('is-invalid');
    }

    if (fh == Fh) {
      $("#fh_add").addClass('is-valid');
    } else {
      $("#fh_add").addClass('is-invalid');
    }

    if (lh == Lh) {
      $("#lh_add").addClass('is-valid');
    } else {
      $("#lh_add").addClass('is-invalid');
    }

    if (bc == Bc) {
      $("#bc_add").addClass('is-valid');
    } else {
      $("#bc_add").addClass('is-invalid');
    }
  }
</script>
<?= $this->endSection(); ?>

<?= $this->section('main_content'); ?>
<!-- Begin Page Content -->
<div class="row row-1">
  <div class="col-lg-12">
    <h1 class="h3 text-gray-900 mb-2 font-weight-bold text-center">Kuis</h1>
    <hr class="mb-1">
    <div class="card o-hidden border-0 shadow-lg">
      <div class="card-body p-0">
        <!-- Modal -->
        <div class="modal fade" id="startKuisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin mulai sekarang?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-footer">
                <button onclick="startKuis()" type="button" class="btn btn-primary">Yakin!</button>
                <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Belajar dulu deh kayaknya</button>
              </div>
            </div>
          </div>
        </div>

        <div id="info" class="row justify-content-center mb-1" style="display: none;">
          <div class="col-lg-12">
            <div class="card text-center">
              <div class="card-body">
                <div class="card-text">
                  <div id="result" class="alert alert-success alert-dismissible fade show text-left" role="alert" style="display: none;">
                    Kuis berakhir dengan skor <strong id="last_score"></strong> poin dalam waktu <strong id="time_elapsed"></strong>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="alert alert-info text-left" role="alert">
                    <h6 class="card-title font-weight-bold">Info:</h6>
                    <ul class="mb-0">
                      <li>Tekan tombol "<strong>Mulai</strong>" untuk memulai kuis.</li>
                      <li>Semua kolom jawaban <strong>wajib diisi</strong>!</li>
                      <li>Tekan tombol "<strong>Ganti Soal</strong>" untuk mengubah soal.</li>
                      <li>Skor untuk tiap jawaban adalah <strong>2</strong> poin. (1 soal = 10 poin)</li>
                      <li>Skor akan ter-<i>update</i> ke basis data jika nilainya lebih dari <strong>0</strong> poin.</li>
                      <li>Tekan tombol "<strong>Selesai</strong>" untuk mengakhiri kuis.</li>
                    </ul>
                  </div>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#startKuisModal">
                  Mulai sekarang?
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Nested Row within Card Body -->
        <div id="kuis" class="row" style="display: none;">
          <div class="col-lg-12">
            <div class="modal fade" tabindex="-1" role="dialog" id="alert">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Isi terlebih dahulu dan jangan menyerah!</i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="p-5">

              <div class="form-group row">
                <div class="col-sm-4">
                  <select class="form-control" id="netclass">
                    <option value="1">A</option>
                    <option value="2">B</option>
                    <option value="3">C</option>
                    <option value="4" selected>A/B/C</option>
                  </select>
                  <small class="form-text text-muted py-1">
                    Kelas Network
                  </small>
                </div>
                <div class="col-sm-6">
                  <h3>
                    <span id="rand_ip" class="badge badge-dark">IP Address</span>
                  </h3>
                </div>
              </div>
              <hr class="mb-2">
              <div class="form-group row my-0">
                <div class="col-sm-4">
                  <p>Network</p>
                </div>
                <div class="col-sm-8">
                  <input id="net_add" type="text" class="form-control form-control-user" placeholder="Network Address" autocomplete="off">
                  <small id="net_add_ans" class="text-success"></small>
                </div>
              </div>
              <div class="form-group row my-0">
                <div class="col-sm-4">
                  <p>First Host</p>
                </div>
                <div class="col-sm-8">
                  <input id="fh_add" type="text" class="form-control form-control-user" placeholder="First Host Address" autocomplete="off">
                  <small id="fh_add_ans" class="text-success"></small>
                </div>
              </div>
              <div class="form-group row my-0">
                <div class="col-sm-4">
                  <p>Netmask</p>
                </div>
                <div class="col-sm-8">
                  <input id="mx_add" type="text" class="form-control form-control-user" id="" placeholder="Subnet Mask" autocomplete="off">
                  <small id="mx_add_ans" class="text-success"></small>
                </div>
              </div>
              <div class="form-group row my-0">
                <div class="col-sm-4">
                  <p>Broadcast</p>
                </div>
                <div class="col-sm-8">
                  <input id="bc_add" type="text" class="form-control form-control-user" placeholder="Broadcast Address" autocomplete="off">
                  <small id="bc_add_ans" class="text-success"></small>
                </div>
              </div>
              <div class="form-group row my-0">
                <div class="col-sm-4">
                  <p>Last Host</p>
                </div>
                <div class="col-sm-8">
                  <input id="lh_add" type="text" class="form-control form-control-user" placeholder="Last Host" autocomplete="off">
                  <small id="lh_add_ans" class="text-success"></small>
                </div>
              </div>
              <hr class="my-1">
              <div class="form-group row my-0">
                <div class="col-sm-6">
                  <button class="btn btn-primary btn-user btn-block my-1" onclick="rand_ip()">Ganti Soal</button>
                </div>
                <div class="col-sm-6">
                  <button id="submit_btn" class="btn btn-primary btn-user btn-block my-1" onclick="submit()">Kirim</button>
                </div>
              </div>
              <div id="time" style="display: null;">
                <div class="form-group row my-0">
                  <div class="col-sm-6">
                    <p>Waktu</p>
                  </div>
                  <div class="col-sm-6">
                    <p id="display">00:00:00</p>
                  </div>
                </div>
                <div class="form-group row my-0">
                  <div class="col-sm-6">
                    <p>Skor</p>
                  </div>
                  <div class="col-sm-6">
                    <p id="score">0</p>
                  </div>
                </div>
              </div>
              <button class="btn btn-primary btn-user btn-block" onclick="stopKuis()"><i class=""></i>Selesai</button>
              <hr class="mt-2">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>

<?= $this->section("footer_js"); ?>
<script>
</script>
<?= $this->endSection(); ?>