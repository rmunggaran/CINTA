<?php
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}

if ($pg == 'edit') {
    $id_guru = $_POST['id_guru'];
    $foto_lama = $_POST['foto_lama'];

    $data = [
        'nama_guru' => $_POST['nama_guru'],
        'pendidikan_terakhir' => $_POST['pendidikan_terakhir'],
        'wali_kelas' => $_POST['wali_kelas']
    ];

    // Jika user upload foto baru
    if (!empty($_FILES['foto']['name'])) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto = uniqid() . '.' . $ext;
        $upload = move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/foto_guru/" . $foto);
        if ($upload) {
            // Hapus foto lama jika ada
            if (!empty($foto_lama) && file_exists("../assets/foto_guru/" . $foto_lama)) {
                unlink("../assets/foto_guru/" . $foto_lama);
            }
            $data['foto'] = $foto;
        }
    }

    $exec = update($koneksi, 'guru', $data, ['id' => $id_guru]);
    echo $exec ? 'ok' : 'gagal';
}


if ($pg == 'tambah') {
    // Menyiapkan nama file
    $nama_file = $_FILES['foto']['name'];
    $tmp_file = $_FILES['foto']['tmp_name'];
    $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);
    $nama_baru = uniqid('foto_') . '.' . $ekstensi;

    // Folder tujuan simpan file
    $folder = '../../assets/foto_guru/'; // pastikan folder ini sudah dibuat dan writable

    // Upload file
    if (move_uploaded_file($tmp_file, $folder . $nama_baru)) {
        // Data ke database
        $data = [
            'nama_guru'           => $_POST['nama_guru'],
            'pendidikan_terakhir' => $_POST['pendidikan_terakhir'],
            'wali_kelas'          => $_POST['wali_kelas'],
            'foto'                => $nama_baru, // simpan nama file saja di DB
        ];

        $exec = insert($koneksi, 'guru', $data); // pastikan nama tabel benar, bukan 'kelas' kalau untuk guru
        echo $exec ? 'ok' : 'gagal';
    } else {
        echo 'upload_error: ' . $_FILES['foto']['error'];
    }
}


if ($pg == 'hapus') {
    $id = $_POST['id'];

    // Ambil data guru terlebih dahulu
    $guru = fetch($koneksi, 'guru', ['id' => $id]);

    if ($guru) {
        // Hapus file foto jika ada
        $foto_path = "../assets/foto_guru/" . $guru['foto'];
        if (!empty($guru['foto']) && file_exists($foto_path)) {
            unlink($foto_path);
        }

        // Hapus data dari DB
        $exec = delete($koneksi, 'guru', ['id' => $id]);
        echo $exec ? 'ok' : 'gagal';
    } else {
        echo 'data_tidak_ditemukan';
    }
}
