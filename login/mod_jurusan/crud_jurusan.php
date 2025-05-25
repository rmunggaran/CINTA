<?php
require("../../config/database.php"); // pastikan sesuaikan path config
require("../../config/function.php");

if (isset($_GET['pg'])) {
    if ($_GET['pg'] == 'tambah') {
        $nama = htmlspecialchars($_POST['nama']);
        $kuota = intval($_POST['kuota']);
        
        $exec = mysqli_query($koneksi, "INSERT INTO jurusan (nama_jurusan, kuota, status) VALUES ('$nama', '$kuota', 1)");
        echo $exec ? 'success' : 'error';
    }

    if ($_GET['pg'] == 'hapus') {
        $nama = htmlspecialchars($_POST['nama']);
        
        $exec = mysqli_query($koneksi, "DELETE FROM jurusan WHERE nama_jurusan = '$nama'");
        echo $exec ? 'success' : 'error';
    }

    if ($_GET['pg'] == 'ubah') {
        $nama_lama = htmlspecialchars($_POST['nama_lama']);
        $nama_baru = htmlspecialchars($_POST['nama']);
        $kuota = intval($_POST['kuota']);
        $status = isset($_POST['status']) ? 1 : 0;

        $exec = mysqli_query($koneksi, "UPDATE jurusan SET nama_jurusan = '$nama_baru', kuota = '$kuota', status = '$status' WHERE nama_jurusan = '$nama_lama'");
        echo $exec ? 'success' : 'error';
    }
}
?>
