<?php
require("../../config/database.php"); // pastikan sesuaikan path config
require("../../config/function.php");

if (isset($_GET['pg'])) {
    // Proses Tambah Data Guru
    if ($_GET['pg'] == 'tambah') {
        $nama_guru = htmlspecialchars($_POST['nama_guru']);
        $pendidikan_terakhir = htmlspecialchars($_POST['pendidikan_terakhir']);
        $wali_kelas = htmlspecialchars($_POST['wali_kelas']);
        $foto = $_POST['foto']; // Foto bisa null atau dikirimkan melalui input

        // Query Insert Data Guru
        $exec = mysqli_query($koneksi, "INSERT INTO guru (nama_guru, pendidikan_terakhir, wali_kelas, foto) 
                                        VALUES ('$nama_guru', '$pendidikan_terakhir', '$wali_kelas', '$foto')");
        echo $exec ? 'success' : 'error';
    }

    // Proses Hapus Data Guru
    if ($_GET['pg'] == 'hapus') {
        $nama_guru = htmlspecialchars($_POST['nama_guru']);
        
        // Hapus Foto Guru jika ada
        $query = mysqli_query($koneksi, "SELECT foto FROM guru WHERE nama_guru = '$nama_guru'");
        $data = mysqli_fetch_assoc($query);
        if ($data['foto']) {
            $file_path = '../../assets/foto_guru/' . $data['foto'];
            if (file_exists($file_path)) {
                unlink($file_path); // Hapus file foto
            }
        }

        // Query Delete Data Guru
        $exec = mysqli_query($koneksi, "DELETE FROM guru WHERE nama_guru = '$nama_guru'");
        echo $exec ? 'success' : 'error';
    }

    // Proses Ubah Data Guru
    if ($_GET['pg'] == 'ubah') {
        $nama_lama = htmlspecialchars($_POST['nama_lama']);
        $nama_baru = htmlspecialchars($_POST['nama_guru']);
        $pendidikan_terakhir = htmlspecialchars($_POST['pendidikan_terakhir']);
        $wali_kelas = htmlspecialchars($_POST['wali_kelas']);
        $foto = $_POST['foto_lama']; // Menyimpan foto lama jika tidak ada foto baru yang diupload

        // Jika ada foto baru yang diupload
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            // Menghapus foto lama jika ada
            if ($foto && file_exists('../../assets/foto_guru/' . $foto)) {
                unlink('../../assets/foto_guru/' . $foto); // Menghapus foto lama
            }

            // Menyimpan foto baru
            $upload_dir = '../../assets/foto_guru/';
            $file_name = time() . '_' . basename($_FILES['foto']['name']);
            $upload_path = $upload_dir . $file_name;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $upload_path)) {
                $foto = $file_name; // Mengganti nama foto dengan file baru
            } else {
                echo "Gagal mengupload foto.";
                exit;
            }
        }

        // Query Update Data Guru
        $exec = mysqli_query($koneksi, "UPDATE guru SET nama_guru = '$nama_baru', pendidikan_terakhir = '$pendidikan_terakhir', 
                                        wali_kelas = '$wali_kelas', foto = '$foto' WHERE nama_guru = '$nama_lama'");
        echo $exec ? 'success' : 'error';
    }
}
?>
