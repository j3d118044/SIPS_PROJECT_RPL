<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Export Data Pelajar</title>
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #000000;
      text-align: center;
      height: 20px;
      margin: 8px;
    }
  </style>
</head>
<body>
  <p>
		<h2>SIPS - Rekap Data Pelajar</h2>
		<small>Dokumen ini dicetak pada <?= $waktu ?></small><br>
    <hr>
  </p>
  <table border="1px">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Organisasi</th>
        <th>Skor Kuis</th>
        <th>Waktu Kuis</th>
      </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    <?php foreach ($dataPelajar as $data): ?>
      <tr>
        <th><?= $i++ ?></th>
        <td style="text-align: left"><?= $data["nama"] ?></td>
        <td style="text-align: left"><?= $data["email"] ?></td>
        <td style="text-align: center"><?= $data["organisasi"] ?></td>
        <td style="text-align: center"><?= $data["skor_kuis"] ?></td>
        <td style="text-align: center"><?= $data["waktu_kuis"] ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>