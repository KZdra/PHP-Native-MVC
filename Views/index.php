<?php
$baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="text-center">
        <h1>Selamat Datang di Aplikasi CRUD</h1>
        <p class="lead mb-4">Klik tombol di bawah untuk masuk ke data siswa.</p>
        <a href="<?= $baseUrl ?>/siswa/" class="btn btn-primary btn-lg">Manage Data Siswa</a>
        <a href="<?= $baseUrl ?>/kelas/" class="btn btn-primary btn-lg">Kelola Kelas</a>
    </div>
</div>

</body>
</html>
