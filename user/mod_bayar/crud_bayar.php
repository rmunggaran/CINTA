<?php
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
session_start();

if ($pg == 'ubah') {
    $verifikasi = (isset($_POST['verifikasi'])) ? 1 : 0;
    $data = [
        'nama_bayar' => $_POST['nama'],
        'verifikasi' => $verifikasi
    ];
    $id_bayar = $_POST['id_bayar'];
    $excec = update($koneksi, 'bayar', $data, ['id_bayar' => $id_bayar]);
    echo $exec;
}
if ($pg == 'tambah') {
    $today = date("Ymd");
    $query = "SELECT max(id_bayar) AS last FROM bayar WHERE id_bayar LIKE '$today%'";
    $hasil = mysqli_query($koneksi, $query);
    $data  = mysqli_fetch_array($hasil);
    $lastNoTransaksi = $data['last'] ?? '';
    $lastNoUrut =  (int) substr($lastNoTransaksi, 8, 4);
    $nextNoUrut = $lastNoUrut + 1;

    $id_daftar = $_POST['id'];
    $tgl_bayar = $_POST['tgl'];
    $biaya_dipilih = $_POST['biaya_dipilih'] ?? [];

    $ektensi = ['jpg', 'png'];
    if ($_FILES['bukti']['name'] != '') {
        $logo = $_FILES['bukti']['name'];
        $temp = $_FILES['bukti']['tmp_name'];
        $ext = strtolower(pathinfo($logo, PATHINFO_EXTENSION));

        if (in_array($ext, $ektensi)) {
            $dest = 'bukti_transaksi/bukti_' . $today . '_' . uniqid() . '.' . $ext;
            $upload = move_uploaded_file($temp, $dest);
            if ($upload) {

                $sukses = true;

                foreach ($biaya_dipilih as $id_biaya) {
                    // Ambil data jumlah biaya dari tabel biaya
                    $q = mysqli_query($koneksi, "SELECT jumlah FROM biaya WHERE id_biaya='$id_biaya'");
                    $d = mysqli_fetch_array($q);
                    $jumlah = $d['jumlah'];

                    // Generate id_bayar unik per baris
                    $id_bayar = $today . sprintf('%04s', $nextNoUrut++);

                    $data = [
                        'id_bayar'      => $id_bayar,
                        'id_daftar'     => $id_daftar,
                        'id_biaya'      => $id_biaya,
                        'jumlah'        => $jumlah,
                        'tgl_bayar'     => $tgl_bayar,
                        'id_user'       => 0,
                        'bukti'         => $dest,
                        'verifikasi'    => 0,
                        'jenis_bayar'   => 'ppdb'
                    ];

                    $exec = insert($koneksi, 'bayar', $data);
                    if (!$exec) {
                        $sukses = false;
                        break;
                    }
                }

                echo $sukses ? 'ok' : 'Gagal menyimpan salah satu data';
            } else {
                echo "Upload bukti gagal";
            }
        } else {
            echo "Format file tidak didukung";
        }
    } else {
        echo "Bukti belum diupload";
    }
}

if ($pg == 'hapus') {
    $id_bayar = $_POST['id_bayar'];

    $bayar = fetch($koneksi, 'bayar', ['id_bayar' => $id_bayar]);
    if (file_exists($bayar['bukti'])) {
        if (unlink($bayar['bukti'])) {
            delete($koneksi, 'bayar', ['id_bayar' => $id_bayar]);
        }
    }
}
