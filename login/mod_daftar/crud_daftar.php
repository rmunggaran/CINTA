<?php
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
if ($pg == 'ubah') {
    $status = (isset($_POST['status'])) ? 1 : 0;
    $nama = str_replace("'", "`", $_POST['nama']);
    $data = [
        'nisn' => $_POST['nisn'],
        'nama' => ucwords(strtoupper($nama)),
        'asal_sekolah' => $_POST['asal'],
        'no_hp' => str_replace(" ", "", $_POST['nohp']),
        'status' => $status
    ];
    $id_daftar = $_POST['id_daftar'];
    update($koneksi, 'daftar', $data, ['id_daftar' => $id_daftar]);
}
if ($pg == 'tambah') {
    $query = "SELECT max(no_daftar) as maxKode FROM daftar";
    $hasil = mysqli_query($koneksi, $query);
    $data  = mysqli_fetch_array($hasil);
    $kodedaftar = $data['maxKode'];
    $noUrut = (int) substr($kodedaftar, 8, 3);
    $noUrut++;
    $char = "PPDB" . date('Y');
    $newID = $char . sprintf("%03s", $noUrut);
    $nama = str_replace("'", "`", $_POST['nama']);
    $sekolah = fetch($koneksi, 'sekolah', ['npsn' => $_POST['asal']]);
    $data = [
        'no_daftar' => $newID,
        'jenis' => $_POST['jenis'],
        'nisn' => $_POST['nisn'],
        'nama' => ucwords(strtolower($nama)),
        'npsn_asal' => $sekolah['npsn'],
        'asal_sekolah' => $sekolah['nama_sekolah'],
        'jurusan' => $_POST['jurusan'],
        'password' => $_POST['password'],
        'no_hp' => str_replace(" ", "", $_POST['nohp']),
        'foto' => 'default.png'

    ];
    $exec = insert($koneksi, 'daftar', $data);
    echo mysqli_error($koneksi);
}
if ($pg == 'hapus') {
    $id_daftar = $_POST['id_daftar'];
    delete($koneksi, 'daftar', ['id_daftar' => $id_daftar]);
}
//membatalkan proses daftar ulang
if ($pg == 'konfirmasi') {
    $$data = [];

    $exec = delete($koneksi, 'daftar', $data, ['id_daftar' => $id]);
    if ($exec) {
        $pesan = [
            'pesan' => 'Selamat.... Data Pendaftar Berhasil Dikosongkan'
        ];
        echo 'ok';
    } else {
        $pesan = [
            'pesan' => mysqli_error($koneksi)
        ];
        echo mysqli_error($koneksi);
    }
}
if ($pg == 'batal') {

    $data = [
        'status' => 0
    ];
    $where = [
        'id_daftar' => $_POST['id_daftar']
    ];
    update($koneksi, 'daftar', $data, $where);
    delete($koneksi, 'bayar', $where);
}
if ($pg == 'bataldf') {

    $data = [
        'konfirmasi' => 0
    ];
    $where = [
        'id_daftar' => $_POST['id_daftar']
    ];
    update($koneksi, 'daftar', $data, $where);
}
if ($pg == 'status') {
    $status = (isset($_POST['status'])) ? $_POST['status'] : 0;
    $nama = str_replace("'", "`", $_POST['nama']);
    $data = [
        'nisn' => $_POST['nisn'],
        'nama' => ucwords(strtoupper($nama)),
        'tempat_lahir' => $_POST['tempat_lahir'],
        'tgl_lahir' => $_POST['tgl_lahir'],
        'no_hp' => str_replace(" ", "", $_POST['no_hp']),
        'status' => $status
    ];
    $where = [
        'id_daftar' => $_POST['id_daftar']
    ];
    $id_daftar = $_POST['id_daftar'];
    $update = update($koneksi, 'daftar', $data, $where);
    if ($update) {
        echo 'success';
    } else {
        echo mysqli_error($koneksi);
    }
}
if ($pg == 'nilai') {
    $nilai = (isset($_POST['nilai'])) ? $_POST['nilai'] : 0;
    $nama = str_replace("'", "`", $_POST['nama']);
    $data = [
        'bin1' => $_POST['bin1'],
        'mat1' => $_POST['mat1'],
        'ipa1' => $_POST['ipa1'],
        'big1' => $_POST['big1'],
        'bin2' => $_POST['bin2'],
        'mat2' => $_POST['mat2'],
        'ipa2' => $_POST['ipa2'],
        'big2' => $_POST['big2'],
        'bin3' => $_POST['bin3'],
        'mat3' => $_POST['mat3'],
        'ipa3' => $_POST['ipa3'],
        'big3' => $_POST['big3'],
        'bin4' => $_POST['bin4'],
        'mat4' => $_POST['mat4'],
        'ipa4' => $_POST['ipa4'],
        'big4' => $_POST['big4'],
        'bin5' => $_POST['bin5'],
        'mat5' => $_POST['mat5'],
        'ipa5' => $_POST['ipa5'],
        'big5' => $_POST['big5']
    ];
    $where = [
        'id_daftar' => $_POST['id_daftar']
    ];
    $id_daftar = $_POST['id_daftar'];
    update($koneksi, 'daftar', $data, $where);
}
if ($pg == 'simpandatadiri') {
    $status = (isset($_POST['status'])) ? 1 : 0;
    $data = [
        'kategori'         => $_POST['kategori'],
        'nama_siswa'       => $_POST['nama_siswa'],
        'nomor_induk'      => $_POST['nomor_induk'],
        'jenis_kelamin'    => $_POST['jenis_kelamin'],
        'tempat_lahir'     => $_POST['tempat_lahir'],
        'tanggal_lahir'    => $_POST['tanggal_lahir'],
        'anak_ke'          => $_POST['anak_ke'],
        'jumlah_saudara'   => $_POST['jumlah_saudara'],
        'status_keluarga'  => $_POST['status_keluarga'],
        'alamat_rumah'     => $_POST['alamat_rumah'],
        'alamat_sekarang'  => $_POST['alamat_sekarang'],
        'sekolah_asal'     => $_POST['sekolah_asal'],
        'sttb_tahun'       => $_POST['sttb_tahun'],
        'sttb_nomor'       => $_POST['sttb_nomor'],
        'tahun_ajaran'     => $_POST['tahun_ajaran'],

    ];
    $where = [
        'no_daftar' => $_POST['no_daftar']
    ];
    update($koneksi, 'formulir', $data, $where);
    echo mysqli_error($koneksi);

    echo "ok";
}


if ($pg == 'simpanortu') {

    $data = [
        'nama_ayah'                => $_POST['nama_ayah'],
        'nama_ibu'                => $_POST['nama_ibu'],
        'agama_ortu'          => $_POST['agama_ortu'],
        'alamat_ortu'           => $_POST['alamat_ortu'],
        'pekerjaan_ayah'             => $_POST['pekerjaan_ayah'],
        'pekerjaan_ibu'             => $_POST['pekerjaan_ibu'],
        'pendidikan_ayah'      => $_POST['pendidikan_ayah'],
        'pendidikan_ibu'      => $_POST['pendidikan_ibu'],
        'penghasilan'      => $_POST['penghasilan'],
        'nama_wali'      => $_POST['nama_wali'],
        'agama_wali'      => $_POST['agama_wali'],
        'alamat_wali'      => $_POST['alamat_wali'],
        'pendidikan_wali'      => $_POST['pendidikan_wali'],
        'pekerjaan_wali'      => $_POST['pekerjaan_wali'],

    ];
    $where = [
        'no_daftar' => $_POST['no_daftar']
    ];
    update($koneksi, 'formulir', $data, $where);
    echo mysqli_error($koneksi);

    echo "ok";
}
