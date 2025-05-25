<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ppdb_dapit_1"; // Ganti dengan nama database kamu

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
