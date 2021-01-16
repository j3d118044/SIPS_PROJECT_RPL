// $(document).ready(function () {
//   $(id).keyup(function () {
//     // gajadi eheheh
//   });
// });

function uppercaseEachPrefix(id) {
  let kalimat = $(id).val();
  let kata = kalimat.split(" ");

  for (var i = 0; i < kata.length; i++) {
    var j = kata[i].charAt(0).toUpperCase();
    kata[i] = j + kata[i].substr(1);
  }

  $(id).val(kata.join(" "));
}

// $(document).ready(function () {
//   // temp datanya
//   let temp_second = <?= session() ?>;

//   //Define vars to hold time values
//   let timer_detik = localStorage.getItem("temp_second")
//     ? localStorage.getItem("temp_second")
//     : 0;

//   //Define vars to hold "display" value
//   let timer_detik_show = 0;

//   //Define var to hold setInterval() function
//   let interval = null;

//   //Define var to hold stopwatch status
//   let timer_status = "stopped";

//   //Stopwatch function (logic to determine when to increment next value, etc.)
//   function resendEmailTimer() {
//     timer_detik++;

//     //Logic to determine when to increment next value
//     if (timer_detik / 60 === 1) {
//       timer_detik = 0;
//     }

//     //If seconds/minutes/hours are only one digit, add a leading 0 to the value
//     if (timer_detik < 10) {
//       displaySeconds = "0" + timer_detik.toString();
//     } else {
//       displaySeconds = timer_detik;
//     }

//     localStorage.setItem("temp_second", timer_detik);

//     localStorage.setItem(
//       "time",
//       displayHours + ":" + displayMinutes + ":" + displaySeconds
//     );

//     //Display updated time values to user
//     document.getElementById("display").innerHTML =
//       displayHours + ":" + displayMinutes + ":" + displaySeconds;
//     // document.getElementById("display").innerHTML = localStorage.getItem('seconds') + ":" + localStorage.getItem('minutes') + ":" + localStorage.getItem('hours');
//   }
// });
