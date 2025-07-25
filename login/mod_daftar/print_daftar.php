<?php
ob_start();
require "../../config/database.php";
require "../../config/function.php";
require "../../config/functions.crud.php";
include "../../assets/modules/phpqrcode/qrlib.php";
session_start();

if (!isset($_SESSION['id_user'])) {
	die('Anda tidak diijinkan mengakses langsung');
}

$siswa = fetch($koneksi, 'daftar', ['id_daftar' => dekripsi($_GET['id'])]);
$formulir = fetch($koneksi, 'formulir', ['no_daftar' => dekripsi($_GET['id'])]);
$tempdir = "temp/";
if (!file_exists($tempdir)) mkdir($tempdir);

$codeContents = $siswa['nisn'] . '-' . $siswa['nama'];
QRcode::png($codeContents, $tempdir . $siswa['nisn'] . '.png', QR_ECLEVEL_M, 4);
?>

<!DOCTYPE html>
<html>

<head>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<link rel="stylesheet" href="../../assets/modules/bootstrap/css/bootstrap.min.css">
	<link rel="shortcut icon" href="https://www.mr-ell.com/media_library/images/7c751732ad0e716986752287a3861548.png">
	<title>Formulir_PPDB<?= $siswa['nama'] ?></title>
</head>

<body onload="window.print();">
	<img src="../../<?= $setting['kop'] ?>" width="100%" />
	<hr>
	<b>
		<center>Formulir Pendaftaran Peserta Didik Baru Tahun Ajaran <?= $formulir['tahun_ajaran']; ?></center>
	</b><br>

	<?php if ($formulir) { ?>
		<table width="100%" style="font-size: 13px" cellpadding="1" cellspacing="0">
			<tbody>
				<tr>
					<td colspan="1"><b>1.</b></td>
					<td colspan="4"><b>Data Siswa</b></td>
				</tr>
				<tr>
					<td style="width: 5%;"></td>
					<td style="width: 25%;">No Pendaftaran</td>
					<td style="width: 2%;">:</td>
					<td><?= $formulir['no_pendaftaran'] ?></td>
				</tr>
				<?php
				$id_jurusan = $formulir['kategori'];
				$qJurusan = mysqli_query($koneksi, "SELECT nama_jurusan FROM jurusan WHERE id_jurusan = '$id_jurusan'");
				$dJurusan = mysqli_fetch_assoc($qJurusan);
				?>
				<tr>
					<td></td>
					<td>Jenis Pendidikan</td>
					<td>:</td>
					<td><?= $dJurusan['nama_jurusan'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Nama Lengkap</td>
					<td>:</td>
					<td><?= $formulir['nama_siswa'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>NIK</td>
					<td>:</td>
					<td><?= $formulir['nomor_induk'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Jenis Kelamin</td>
					<td>:</td>
					<td><?= $formulir['jenis_kelamin'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Tempat Lahir</td>
					<td>:</td>
					<td><?= $formulir['tempat_lahir'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Tanggal Lahir</td>
					<td>:</td>
					<td><?= $formulir['tanggal_lahir'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Anak Ke</td>
					<td>:</td>
					<td><?= $formulir['anak_ke'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Jumlah Saudara</td>
					<td>:</td>
					<td><?= $formulir['jumlah_saudara'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Status dalam Keluarga</td>
					<td>:</td>
					<td><?= $formulir['status_keluarga'] ?></td>
				</tr>
			</tbody>
		</table>

		<table width="100%" style="font-size: 13px" cellpadding="1" cellspacing="0">
			<tbody>
				<tr>
					<td colspan="1"><b>2.</b></td>
					<td colspan="4"><b>Alamat Siswa</b></td>
				</tr>
				<tr>
					<td style="width: 5%;"></td>
					<td style="width: 25%;">Alamat Rumah</td>
					<td style="width: 2%;">:</td>
					<td><?= $formulir['alamat_rumah'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Alamat Sekarang</td>
					<td>:</td>
					<td><?= $formulir['alamat_sekarang'] ?></td>
				</tr>
			</tbody>
		</table>

		<table width="100%" style="font-size: 13px" cellpadding="1" cellspacing="0">
			<tbody>
				<tr>
					<td colspan="1"><b>3.</b></td>
					<td colspan="4"><b>Sekolah Asal</b></td>
				</tr>
				<tr>
					<td style="width: 5%;"></td>
					<td style="width: 25%;">Sekolah Asal</td>
					<td style="width: 2%;">:</td>
					<td><?= $formulir['sekolah_asal'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Alamat Sekolah Asal</td>
					<td>:</td>
					<td><?= $formulir['alamat_sekolah_asal'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>STTB Tahun</td>
					<td>:</td>
					<td><?= $formulir['sttb_tahun'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>STTB Nomor</td>
					<td>:</td>
					<td><?= $formulir['sttb_nomor'] ?></td>
				</tr>
			</tbody>
		</table>
		<table width="100%" style="font-size: 13px" cellpadding="1" cellspacing="0">
			<tbody>
				<tr>
					<td colspan="1"><b>4.</b></td>
					<td colspan="4"><b>Orang Tua</b></td>
				</tr>
				<tr>
					<td style="width: 5%;"></td>
					<td style="width: 25%;">Nama Ayah</td>
					<td style="width: 2%;">:</td>
					<td><?= $formulir['nama_ayah'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Agama Orang Tua</td>
					<td>:</td>
					<td><?= $formulir['agama_ortu'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Alamat Orang Tua</td>
					<td>:</td>
					<td><?= $formulir['alamat_ortu'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Pekerjaan Ayah</td>
					<td>:</td>
					<td><?= $formulir['pekerjaan_ayah'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Pekerjaan Ibu</td>
					<td>:</td>
					<td><?= $formulir['pekerjaan_ibu'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Pendidikan Ayah</td>
					<td>:</td>
					<td><?= $formulir['pendidikan_ayah'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Pendidikan Ibu</td>
					<td>:</td>
					<td><?= $formulir['pendidikan_ibu'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Penghasilan Perbulan</td>
					<td>:</td>
					<td><?= $formulir['penghasilan'] ?></td>
				</tr>
			</tbody>
		</table>
		<table width="100%" style="font-size: 13px" cellpadding="1" cellspacing="0">
			<tbody>
				<tr>
					<td colspan="1"><b>5.</b></td>
					<td colspan="4"><b>Wali</b></td>
				</tr>
				<tr>
					<td style="width: 5%;"></td>
					<td style="width: 25%;">Nama Wali</td>
					<td style="width: 2%;">:</td>
					<td><?= $formulir['nama_wali'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Agama Wali</td>
					<td>:</td>
					<td><?= $formulir['agama_wali'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Alamat Wali</td>
					<td>:</td>
					<td><?= $formulir['alamat_wali'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Pendidikan Wali</td>
					<td>:</td>
					<td><?= $formulir['pendidikan_wali'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>Pekerjaan Wali</td>
					<td>:</td>
					<td><?= $formulir['pekerjaan_wali'] ?></td>
				</tr>

			</tbody>
		</table>

		<br><br>
		<table width="100%">
			<tr>
				<td style="text-align: center">
					<!-- <img src="temp/<?= $siswa['nisn'] ?>.png" style="width: 30mm; background-color: white; color: black;"> -->
				</td>
				<td>
					<div style="width: 300px; margin-left: auto; margin-right: 100px; text-align: center;">
						<p><?= $setting['kec'] ?>, <?= date('d-M-Y') ?></p>
						<p>Pendaftar</p><br><br>
						<p><strong><?= $formulir['nama_wali'] ?></strong></p>
					</div>
				</td>


			</tr>
		</table>

	<?php } else { ?>
		<div style='padding:10px; background:#ffe0e0; border:1px solid red; color:red;'>
			Formulir belum diisi.
		</div>
	<?php } ?>

	<script>
		window.print();
	</script>
</body>

</html>