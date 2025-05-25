<?php
require("../../config/database.php");
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_PPDB.xls");
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}

function fetch($koneksi, $tabel, $where = [])
{
    $sql = "SELECT * FROM $tabel WHERE ";
    $conditions = [];
    foreach ($where as $key => $val) {
        $conditions[] = "$key = '" . mysqli_real_escape_string($koneksi, $val) . "'";
    }
    $sql .= implode(" AND ", $conditions) . " LIMIT 1";
    $query = mysqli_query($koneksi, $sql);
    return mysqli_fetch_assoc($query);
}
?>
<style>
    .str {
        mso-number-format: \@;
    }
</style>

<center>
    <h3>DATA SISWA </h3>
</center>
<table border="1">
    <thead>
        <tr>
            <th class="text-left">
                No
            </th>
            <th>no pendaftaran</th>
            <th>id daftar</th>
            <th>kategoori</th>
            <th>Nama siswa</th>
            <th>Nomor Induk</th>
            <th>Jenis kelamin</th>
            <th>Tempat tanggal lahir</th>
            <th>Anak ke</th>
            <th>Jumlah saudara</th>
            <th>Status di keluarga</th>
            <th>Alamat rumah</th>
            <th>Alamat Sekarang</th>
            <th>Kelas di terima</th>
            <th>tanggal di terima</th>
            <th>Asal sekolah</th>
            <th>Alamat asal sekolah</th>
            <th>STTB tahun</th>
            <th>STTB nomor</th>
            <th>Nama ayah</th>
            <th>Nama ibu</th>
            <th>Agama orang tua</th>
            <th>alamat orang tua</th>
            <th>Pekerjaan ayah</th>
            <th>Pekerjaan ibu</th>
            <th>Pendidikan ayah</th>
            <th>Pendidikan ibu</th>
            <th>Penghasilan</th>
            <th>Nama wali</th>
            <th>Agama wali</th>
            <th>alamat wali</th>
            <th>Pekerjaan wali</th>
            <th>Pendidikan wali</th>


        </tr>
    </thead>
    <tbody>
        <?php
        $query = mysqli_query($koneksi, "select * from formulir");
        $no = 0;
        while ($siswa = mysqli_fetch_array($query)) {
            $no++;
        ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $siswa['no_pendaftaran'] ?></td>
                <td><?= $siswa['no_daftar'] ?></td>
                <?php
                $jurusan = fetch($koneksi, 'jurusan', ['id_jurusan' => $siswa['kategori']]);
                ?>
                <td><?= $jurusan['nama_jurusan'] ?></td>
                <td><?= $siswa['nama_siswa'] ?></td>
                <td><?= $siswa['nomor_induk'] ?></td>
                <td><?= $siswa['jenis_kelamin'] ?></td>
                <td><?= $siswa['tempat_lahir'] ?>, <?= $siswa['tanggal_lahir'] ?></td>
                <td><?= $siswa['anak_ke'] ?></td>
                <td><?= $siswa['jumlah_saudara'] ?></td>
                <td><?= $siswa['status_keluarga'] ?></td>
                <td><?= $siswa['alamat_rumah'] ?></td>
                <td><?= $siswa['alamat_sekarang'] ?></td>
                <td><?= $siswa['kelas_diterima'] ?></td>
                <td><?= $siswa['tanggal_diterima'] ?></td>
                <td><?= $siswa['sekolah_asal'] ?></td>
                <td><?= $siswa['alamat_sekolah_asal'] ?></td>
                <td><?= $siswa['sttb_tahun'] ?></td>
                <td><?= $siswa['sttb_nomor'] ?></td>
                <td><?= $siswa['nama_ayah'] ?></td>
                <td><?= $siswa['nama_ibu'] ?></td>
                <td><?= $siswa['agama_ortu'] ?></td>
                <td><?= $siswa['alamat_ortu'] ?></td>
                <td><?= $siswa['pekerjaan_ayah'] ?></td>
                <td><?= $siswa['pekerjaan_ibu'] ?></td>
                <td><?= $siswa['pendidikan_ayah'] ?></td>
                <td><?= $siswa['pendidikan_ibu'] ?></td>
                <td><?= $siswa['penghasilan'] ?></td>
                <td><?= $siswa['nama_wali'] ?></td>
                <td><?= $siswa['agama_wali'] ?></td>
                <td><?= $siswa['alamat_wali'] ?></td>
                <td><?= $siswa['pendidikan_wali'] ?></td>
                <td><?= $siswa['pekerjaan_wali'] ?></td>


            </tr>

        <?php }
        ?>


    </tbody>
</table>