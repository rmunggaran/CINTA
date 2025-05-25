<?php
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
session_start();

$id = $_SESSION['id_daftar'];
$pg = $_POST['pg'] ?? '';

if ($pg == 'ubah') {
    $ekstensi = ['jpg', 'jpeg', 'png'];
    $data = [];

    // Akte Kelahiran
    if ($_FILES['akta']['name'] != '') {
        $file = $_FILES['akta'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $ekstensi)) {
            // Ambil data lama dari database (misalnya)
            $query = mysqli_query($koneksi, "SELECT akta FROM daftar WHERE id_daftar = '$id'");
            $lama = mysqli_fetch_assoc($query);
            if ($lama && file_exists('../../' . $lama['akta'])) {
                unlink('../../' . $lama['akta']); // Hapus file lama
            }

            $dest = 'assets/upload/akta/akta' . $id . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], '../../' . $dest)) {
                $data['akta'] = $dest;
            }
        }
    }

    // Kartu Keluarga
    if ($_FILES['kk']['name'] != '') {
        $file = $_FILES['kk'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $ekstensi)) {
            $query = mysqli_query($koneksi, "SELECT kk FROM daftar WHERE id_daftar = '$id'");
            $lama = mysqli_fetch_assoc($query);
            if ($lama && file_exists('../../' . $lama['kk'])) {
                unlink('../../' . $lama['kk']); // Hapus file lama
            }

            $dest = 'assets/upload/kk/kk' . $id . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], '../../' . $dest)) {
                $data['kk'] = $dest;
            }
        }
    }

    // KTP Ortu
    if ($_FILES['ktp_ortu']['name'] != '') {
        $file = $_FILES['ktp_ortu'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $ekstensi)) {
            $query = mysqli_query($koneksi, "SELECT ktp_ortu FROM daftar WHERE id_daftar = '$id'");
            $lama = mysqli_fetch_assoc($query);
            if ($lama && file_exists('../../' . $lama['ktp_ortu'])) {
                unlink('../../' . $lama['ktp_ortu']); // Hapus file lama
            }

            $dest = 'assets/upload/ktp_ortu/ktp_ortu' . $id . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], '../../' . $dest)) {
                $data['ktp_ortu'] = $dest;
            }
        }
    }

    // KPS/PKH (opsional)
    if ($_FILES['kps_pkh']['name'] != '') {
        $file = $_FILES['kps_pkh'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $ekstensi)) {
            $query = mysqli_query($koneksi, "SELECT kps_pkh FROM daftar WHERE id_daftar = '$id'");
            $lama = mysqli_fetch_assoc($query);
            if ($lama && file_exists('../../' . $lama['kps_pkh'])) {
                unlink('../../' . $lama['kps_pkh']); // Hapus file lama
            }

            $dest = 'assets/upload/kps_pkh/kps_pkh' . $id . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], '../../' . $dest)) {
                $data['kps_pkh'] = $dest;
            }
        }
    }

    // Jika ada file yang berhasil diupload
    if (!empty($data)) {
        $exec = update($koneksi, 'daftar', $data, ['id_daftar' => $id]);
        if ($exec) {
            header("Location: ../../user/?pg=berkas&status=success");
            exit();
        } else {
            header("Location: ../../user/?pg=berkas&status=error");
            exit();
        }
    } else {
        header("Location: ../../user/?pg=berkas&status=empty");
        exit();
    }
} else {
    echo "Akses tidak sah";
}
