<?php
require("../../config/database.php");

$id_jurusan = isset($_POST['id_jurusan']) ? $_POST['id_jurusan'] : '';

$where = $id_jurusan != '' ?
    "WHERE (id_jurusan = '$id_jurusan' OR id_jurusan IS NULL OR id_jurusan=0) AND (jenis_biaya IS NULL OR jenis_biaya = 'ppdb')"
    : "WHERE (jenis_biaya IS NULL OR jenis_biaya != 'ppdb')";

$query = mysqli_query($koneksi, "SELECT SUM(jumlah) AS total FROM biaya $where");
$total = mysqli_fetch_array($query);

echo "<b>Total Biaya: Rp. " . number_format($total['total'], 0, ',', '.') . "</b>";
