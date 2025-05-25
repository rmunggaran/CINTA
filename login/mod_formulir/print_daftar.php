<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pendaftaran Peserta Didik Baru Tahun 2026</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 90%; margin: 20px auto; border-collapse: collapse; }
        td { padding: 5px; vertical-align: top; }
    </style>
</head>
<body>

<h2 style="text-align: center;">Formulir Pendaftaran Peserta Didik Baru Tahun 2026</h2>

<table>
    <tr><td>1.</td><td><b>Nama Siswa</b></td><td>:</td><td><?= $siswa['nama'] ?? '-' ?></td></tr>
    <tr><td>2.</td><td><b>Nomor Induk</b></td><td>:</td><td><?= $siswa['nis'] ?? '-' ?></td></tr>
    <tr><td>3.</td><td><b>Jenis Kelamin</b></td><td>:</td><td><?= $siswa['jk'] ?? '-' ?></td></tr>
    <tr><td>4.</td><td><b>Tempat dan Tanggal Lahir</b></td><td>:</td><td><?= ($siswa['tempat_lahir'] ?? '-') . ', ' . ($siswa['tanggal_lahir'] ?? '-') ?></td></tr>
    <tr><td>5.</td><td><b>Anak Ke-</b></td><td>:</td><td><?= $siswa['anak_ke'] ?? '-' ?></td></tr>
    <tr><td>6.</td><td><b>Jumlah Saudara</b></td><td>:</td>
        <td>
            <?= $siswa['jumlah_saudara'] ?? '-' ?> (Kandung: <?= $siswa['saudara_kandung'] ?? '-' ?>, Tiri: <?= $siswa['saudara_tiri'] ?? '-' ?>)
        </td>
    </tr>
    <tr><td>7.</td><td><b>Status dalam Keluarga</b></td><td>:</td><td><?= $siswa['status_keluarga'] ?? '-' ?></td></tr>
    <tr><td>8.</td><td><b>Alamat Siswa</b></td><td>:</td>
        <td>
            <?php if (($siswa['alamat_tinggal'] ?? '-') == 'rumah') { ?>
                Alamat Rumah: <?= $siswa['alamat_rumah'] ?? '-' ?>,
                RT/RW: <?= $siswa['rt'] ?? '-' ?>/<?= $siswa['rw'] ?? '-' ?>,
                Desa/Kel: <?= $siswa['desa'] ?? '-' ?>,
                Kec: <?= $siswa['kecamatan'] ?? '-' ?>,
                Kab/Kota: <?= $siswa['kota'] ?? '-' ?>,
                Telp: <?= $siswa['no_hp'] ?? '-' ?>
            <?php } else { ?>
                Alamat Sekarang: <?= $siswa['alamat_sekarang'] ?? '-' ?>,
                RT/RW: <?= $siswa['rt_sekarang'] ?? '-' ?>/<?= $siswa['rw_sekarang'] ?? '-' ?>,
                Desa/Kel: <?= $siswa['desa_sekarang'] ?? '-' ?>,
                Kec: <?= $siswa['kecamatan_sekarang'] ?? '-' ?>,
                Kab/Kota: <?= $siswa['kota_sekarang'] ?? '-' ?>,
                Telp: <?= $siswa['no_hp_sekarang'] ?? '-' ?>
            <?php } ?>
        </td>
    </tr>
    <tr><td>9.</td><td><b>Diterima di Madrasah Ini</b></td><td>:</td>
        <td>Kelas: <?= $siswa['kelas_diterima'] ?? '-' ?>, Tanggal: <?= $siswa['tanggal_diterima'] ?? '-' ?></td>
    </tr>
    <tr><td>10.</td><td><b>Madrasah/Sekolah Asal/TK</b></td><td>:</td><td><?= $siswa['sekolah_asal'] ?? '-' ?></td></tr>
    <tr><td>11.</td><td><b>STTB Sekolah Asal</b></td><td>:</td>
        <td>Tahun: <?= $siswa['tahun_sttb'] ?? '-' ?>, Nomor: <?= $siswa['nomor_sttb'] ?? '-' ?></td>
    </tr>
    <tr><td>12.</td><td><b>Orang Tua</b></td><td>:</td>
        <td>
            Nama Ayah: <?= $siswa['nama_ayah'] ?? '-' ?><br>
            Nama Ibu: <?= $siswa['nama_ibu'] ?? '-' ?><br>
            Agama: <?= $siswa['agama_orang_tua'] ?? '-' ?><br>
            Alamat: <?= $siswa['alamat_orang_tua'] ?? '-' ?><br>
            Pekerjaan Ayah: <?= $siswa['pekerjaan_ayah'] ?? '-' ?><br>
            Pekerjaan Ibu: <?= $siswa['pekerjaan_ibu'] ?? '-' ?><br>
            Pendidikan Ayah: <?= $siswa['pendidikan_ayah'] ?? '-' ?><br>
            Pendidikan Ibu: <?= $siswa['pendidikan_ibu'] ?? '-' ?><br>
            Penghasilan/Bulan: <?= $siswa['penghasilan_orang_tua'] ?? '-' ?><br>
            Nama Wali: <?= $siswa['nama_wali'] ?? '-' ?>
        </td>
    </tr>
</table>

</body>
</html>