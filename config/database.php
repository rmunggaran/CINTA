<?php
// Pastikan BASEPATH hanya didefinisikan sekali dalam seluruh aplikasi
if (!defined('BASEPATH')) {
    define('BASEPATH', dirname(__FILE__));
}

// Deklarasi parameter koneksi database
$server   = "localhost";
$username = "root";
$password = "";
$database = "ppdb_dapit_1";

// Koneksi database
$koneksi = mysqli_connect($server, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die('Koneksi Database Gagal: ' . mysqli_connect_error());
}

// Ambil parameter GET dengan aman
$pg = isset($_GET['pg']) ? $_GET['pg'] : '';
$ac = isset($_GET['ac']) ? $_GET['ac'] : '';

// Setting waktu
date_default_timezone_set("Asia/Jakarta");
