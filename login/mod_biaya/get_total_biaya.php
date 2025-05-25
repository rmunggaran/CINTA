<?php
require("../../config/database.php");

$id_jurusan = isset($_POST['id_jurusan']) ? $_POST['id_jurusan'] : '';

// Buat query
$where = $id_jurusan != '' ? "WHERE id_jurusan = '$id_jurusan' OR id_jurusan IS NULL" : '';

$query = mysqli_query($koneksi, "SELECT SUM(jumlah) AS total FROM biaya $where");
$total = mysqli_fetch_array($query);

echo "<b>Total Biaya: Rp. " . number_format($total['total'], 0, ',', '.') . "</b>";
