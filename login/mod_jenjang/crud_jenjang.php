<?php
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
if ($pg == 'tambah_kelas') {
    $data = [
        'kelas'   => $_POST['kelas'],
    ];
    $id_daftar = $_POST['id_daftar'];
    update($koneksi, 'daftar', $data, ['id_daftar' => $id_daftar]);
}

if ($pg == 'keluar') {
    $data = [
        'kelas' => null
    ];
    $id_daftar = $_POST['id_daftar'];
    update($koneksi, 'daftar', $data, ['id_daftar' => $id_daftar]);
}

if ($pg == 'ubah') {
    $status = (isset($_POST['status'])) ? 1 : 0;
    $id_kelas = $_POST['id_kelas'];
    $wali_kelas = $_POST['wali_kelas'];

    mysqli_query($koneksi, "UPDATE guru SET wali_kelas = NULL WHERE wali_kelas = '$id_kelas'");

    mysqli_query($koneksi, "UPDATE guru SET wali_kelas = '$id_kelas' WHERE id = '$wali_kelas'");

    $data = [
        'nama_kelas'   => $_POST['nama_kelas'],
        'kuota'   => $_POST['kuota'],
        'status' => $status,
        // 'jenjang' => $_POST['jenjang'],
        'jurusan_id' => $_POST['kategori'],
    ];
    update($koneksi, 'kelas', $data, ['id_kelas' => $id_kelas]);
}

if ($pg == 'tambah') {
    $id_kelas = uniqid('KLS');
    $wali_kelas = $_POST['wali_kelas'];
    $data = [
        'id_kelas' => $id_kelas,
        'nama_kelas'   => $_POST['nama_kelas'],
        'kuota'   => $_POST['kuota'],
        'status'         => 1,
        // 'jenjang' => $_POST['jenjang'],
        'jurusan_id' => $_POST['kategori'],
    ];
    $exec = insert($koneksi, 'kelas', $data);
    if ($exec) {
        // Update wali_kelas di tabel guru
        mysqli_query($koneksi, "UPDATE guru SET wali_kelas='$id_kelas' WHERE id='$wali_kelas'");
    }
    echo $exec;
}

if ($pg == 'hapus') {
    $id_kelas = $_POST['id_kelas'];
    mysqli_query($koneksi, "UPDATE guru SET wali_kelas = NULL WHERE wali_kelas = '$id_kelas'");
    delete($koneksi, 'kelas', ['id_kelas' => $id_kelas]);
}
