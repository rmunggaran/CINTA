<?php ob_start();
require "../../config/database.php";
require "../../config/function.php";
require "../../config/functions.crud.php";
include "../../assets/modules/phpqrcode/qrlib.php";

session_start();
if (!isset($_SESSION['id_daftar'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
$siswa = fetch($koneksi, 'daftar', ['id_daftar' => dekripsi($_GET['id'])]);
$tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);

//isi qrcode jika di scan
$codeContents = $siswa['nisn'] . '-' . $siswa['nama'];

//simpan file kedalam temp
QRcode::png($codeContents, $tempdir . $siswa['nisn'] . '.png', QR_ECLEVEL_M, 4);
?>

<!-- General CSS Files -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<link rel="stylesheet" href="../../assets/modules/bootstrap/css/bootstrap.min.css">
<link rel="shortcut icon" href="https://thafd.bing.com/th/id/OIP.Zpz7TfZOtm_eIupu7mxKSwAAAA?rs=1&pid=ImgDetMain">

<!DOCTYPE html>
<html>
<head>
    <title>Formulir Pendaftaran <?= $siswa['nama'] ?></title>
</head>
<body onload="window.print();">
    <img src="../../<?= $setting['kop'] ?>" width="100%" />

    <hr>
    <b><center>Formulir Pendaftaran Peserta Didik Baru Tahun 2026</center></b>
    <br>

    <table width="100%" style="font-size: 13px" cellpadding="1" cellspacing="0">
        <tbody>
            <!-- 1. Nama Siswa -->
            <tr>
                <td>1.</td>
                <td><b>Nama Siswa</b></td>
                <td>:</td>
                <td><?= $siswa['nama'] ?></td>
            </tr>

            <!-- 2. Nomor Induk -->
            <tr>
                <td>2.</td>
                <td><b>Nomor Induk</b></td>
                <td>:</td>
                <td><?= $siswa['nisn'] ?></td>
            </tr>

            <!-- 3. Jenis Kelamin -->
            <tr>
                <td>3.</td>
                <td><b>Jenis Kelamin</b></td>
                <td>:</td>
                <td><?= ($siswa['jenkel'] == 'L') ? "Laki-Laki" : "Perempuan" ?></td>
            </tr>

            <!-- 4. Tempat dan Tanggal Lahir -->
            <tr>
                <td>4.</td>
                <td><b>Tempat dan Tanggal Lahir</b></td>
                <td>:</td>
                <td><?= $siswa['tempat_lahir'] ?>, <?= $siswa['tgl_lahir'] ?></td>
            </tr>

            <!-- 5. Anak Ke- -->
            <tr>
                <td>5.</td>
                <td><b>Anak Ke-</b></td>
                <td>:</td>
                <td><?= $siswa['anak_ke'] ?></td>
            </tr>

            <!-- 6. Jumlah Saudara -->
            <tr>
                <td>6.</td>
                <td><b>Jumlah Saudara</b></td>
                <td>:</td>
                <td><?= $siswa['jumlah_saudara'] ?> (Kandung: <?= $siswa['saudara_kandung'] ?>, Tiri: <?= $siswa['saudara_tiri'] ?>)</td>
            </tr>

            <!-- 7. Status dalam Keluarga -->
            <tr>
                <td>7.</td>
                <td><b>Status dalam Keluarga</b></td>
                <td>:</td>
                <td><?= $siswa['status_keluarga'] ?></td>
            </tr>

            <!-- 8. Alamat Siswa -->
            <tr>
                <td>8.</td>
                <td><b>Alamat Siswa</b></td>
                <td>:</td>
                <td>
                    <?php if ($siswa['alamat_tinggal'] == 'rumah') { ?>
                        Alamat Rumah: <?= $siswa['alamat_rumah'] ?>, RT/RW: <?= $siswa['rt'] ?>/<?= $siswa['rw'] ?>, Desa/Kel: <?= $siswa['desa'] ?>, Kec: <?= $siswa['kecamatan'] ?>, Kab/Kota: <?= $siswa['kota'] ?>, Telp: <?= $siswa['no_hp'] ?>
                    <?php } else { ?>
                        Alamat Sekarang: <?= $siswa['alamat_sekarang'] ?>, RT/RW: <?= $siswa['rt_sekarang'] ?>/<?= $siswa['rw_sekarang'] ?>, Desa/Kel: <?= $siswa['desa_sekarang'] ?>, Kec: <?= $siswa['kecamatan_sekarang'] ?>, Kab/Kota: <?= $siswa['kota_sekarang'] ?>, Telp: <?= $siswa['no_hp_sekarang'] ?>
                    <?php } ?>
                </td>
            </tr>

            <!-- 9. Diterima di Madrasah -->
            <tr>
                <td>9.</td>
                <td><b>Diterima di Madrasah Ini</b></td>
                <td>:</td>
                <td>Kelas: <?= $siswa['kelas_diterima'] ?>, Tanggal: <?= $siswa['tanggal_diterima'] ?></td>
            </tr>

            <!-- 10. Madrasah/Sekolah Asal/TK -->
            <tr>
                <td>10.</td>
                <td><b>Madrasah/Sekolah Asal/TK</b></td>
                <td>:</td>
                <td><?= $siswa['asal_sekolah'] ?></td>
            </tr>

            <!-- 11. STTB Sekolah Asal -->
            <tr>
                <td>11.</td>
                <td><b>STTB Sekolah Asal</b></td>
                <td>:</td>
                <td>Tahun: <?= $siswa['tahun_sttb'] ?>, Nomor: <?= $siswa['nomor_sttb'] ?></td>
            </tr>

            <!-- 12. Orangtua -->
            <tr>
                <td>12.</td>
                <td><b>Orangtua</b></td>
                <td>:</td>
                <td>
                    Nama Ayah: <?= $siswa['nama_ayah'] ?><br>
                    Nama Ibu: <?= $siswa['nama_ibu'] ?><br>
                    Agama Orang Tua: <?= $siswa['agama_ortu'] ?><br>
                    Alamat Orang Tua: <?= $siswa['alamat_ortu'] ?><br>
                    Pekerjaan Ayah: <?= $siswa['pekerjaan_ayah'] ?><br>
                    Pekerjaan Ibu: <?= $siswa['pekerjaan_ibu'] ?><br>
                    Pendidikan Ayah: <?= $siswa['pendidikan_ayah'] ?><br>
                    Pendidikan Ibu: <?= $siswa['pendidikan_ibu'] ?><br>
                    Penghasilan Orangtua Per Bulan: <?= $siswa['penghasilan_ortu'] ?><br>
                    Nama Wali: <?= $siswa['nama_wali'] ?>
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <br>
    <table width="100%">
        <tr>
            <td style="text-align: center">
                <font size="1">
                    <img class="img" src="temp/<?= $siswa['nisn'] ?>.png" style="width: 30mm; background-color: white; color: black;">
                </font>
            </td>

            <td style="text-align: center">
                <font size="2">
                    <img class="img" src="../../<?= $siswa['foto'] ?>" style="width: 30mm; height: 40mm; background-color: white; color: black;">
                </font>
            </td>

            <td style="text-align: left">
                <font size="5px">
                    <?= $setting['kec'] ?>, <?= date('d-M-Y ') ?>
                    <p>Pendaftar</p>
                    <br>
                    <p><strong><?= $siswa['nama'] ?></strong></p>
                </font>
            </td>
        </tr>
    </table>

</body>
</html>

<script>
    window.print();
</script>

<?php
// $html = ob_get_clean();
// require_once '../../vendor/autoload.php';

// use Dompdf\Dompdf;

// $dompdf = new Dompdf();
// $dompdf->loadHtml($html,'UTF-8');

// $dompdf->setPaper('A4', 'portrait');
// $dompdf->render();
// $dompdf->stream("PPDB2021_" . $siswa['nama'] . ".pdf", array("Attachment" => false));
// exit(0);
?>
