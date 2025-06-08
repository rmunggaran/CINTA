<?php
require 'D:/laragon/www/CINTA/config/database.php';

// Fungsi untuk membersihkan input
function bersihkanInput($data, $koneksi)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($koneksi, $data);
}

// Log error
function logError($message)
{
    file_put_contents('error.log', date('Y-m-d H:i:s') . " - " . $message . "\n", FILE_APPEND);
}

// Initialize message variables
$success_message = '';
$error_message = '';

$no_daftar = '';
$nama_siswa = '';
$alamat_rumah = '';
$gunakan_js = true;


if (isset($_GET['no_daftar'])) {
    $no_daftar = $_GET['no_daftar'];
    $stmt = $koneksi->prepare("SELECT * FROM formulir WHERE no_daftar = ?");
    if (!$stmt) {
        die("Prepare failed: " . $koneksi->error);
    }
    $stmt->bind_param("s", $no_daftar);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data) {
        $gunakan_js = false; // Tidak perlu JS
    }
    $stmt->close();
}

// Proses data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Bersihkan semua input
    $no_pendaftaran     = isset($_POST['no_pendaftaran']) ? bersihkanInput($_POST['no_pendaftaran'], $koneksi) : '';
    $no_daftar          = isset($_POST['no_daftar']) ? bersihkanInput($_POST['no_daftar'], $koneksi) : '';
    $kategori           = isset($_POST['kategori']) ? bersihkanInput($_POST['kategori'], $koneksi) : '';
    $nama_siswa         = isset($_POST['nama_siswa']) ? bersihkanInput($_POST['nama_siswa'], $koneksi) : '';
    $nomor_induk        = isset($_POST['nomor_induk']) ? bersihkanInput($_POST['nomor_induk'], $koneksi) : '';
    $jenis_kelamin      = isset($_POST['jenis_kelamin']) ? bersihkanInput($_POST['jenis_kelamin'], $koneksi) : '';
    $tempat_lahir       = isset($_POST['tempat_lahir']) ? bersihkanInput($_POST['tempat_lahir'], $koneksi) : '';
    $tanggal_lahir      = isset($_POST['tanggal_lahir']) ? bersihkanInput($_POST['tanggal_lahir'], $koneksi) : '';
    $anak_ke            = isset($_POST['anak_ke']) ? (int)bersihkanInput($_POST['anak_ke'], $koneksi) : 0;
    $jumlah_saudara     = isset($_POST['jumlah_saudara']) ? (int)bersihkanInput($_POST['jumlah_saudara'], $koneksi) : 0;
    $status_keluarga    = isset($_POST['status_keluarga']) ? bersihkanInput($_POST['status_keluarga'], $koneksi) : '';
    $alamat_rumah       = isset($_POST['alamat_rumah']) ? bersihkanInput($_POST['alamat_rumah'], $koneksi) : '';
    $alamat_sekarang    = isset($_POST['alamat_sekarang']) ? bersihkanInput($_POST['alamat_sekarang'], $koneksi) : '';
    $sekolah_asal       = isset($_POST['sekolah_asal']) ? bersihkanInput($_POST['sekolah_asal'], $koneksi) : '';
    $alamat_sekolah_asal = isset($_POST['alamat_sekolah_asal']) ? bersihkanInput($_POST['alamat_sekolah_asal'], $koneksi) : '';
    $sttb_tahun         = isset($_POST['sttb_tahun']) ? bersihkanInput($_POST['sttb_tahun'], $koneksi) : '';
    $sttb_nomor         = isset($_POST['sttb_nomor']) ? bersihkanInput($_POST['sttb_nomor'], $koneksi) : '';
    $nama_ayah          = isset($_POST['nama_ayah']) ? bersihkanInput($_POST['nama_ayah'], $koneksi) : '';
    $nama_ibu           = isset($_POST['nama_ibu']) ? bersihkanInput($_POST['nama_ibu'], $koneksi) : '';
    $agama_ortu         = isset($_POST['agama_ortu']) ? bersihkanInput($_POST['agama_ortu'], $koneksi) : '';
    $alamat_ortu        = isset($_POST['alamat_ortu']) ? bersihkanInput($_POST['alamat_ortu'], $koneksi) : '';
    $pekerjaan_ayah     = isset($_POST['pekerjaan_ayah']) ? bersihkanInput($_POST['pekerjaan_ayah'], $koneksi) : '';
    $pekerjaan_ibu      = isset($_POST['pekerjaan_ibu']) ? bersihkanInput($_POST['pekerjaan_ibu'], $koneksi) : '';
    $pendidikan_ayah    = isset($_POST['pendidikan_ayah']) ? bersihkanInput($_POST['pendidikan_ayah'], $koneksi) : '';
    $pendidikan_ibu     = isset($_POST['pendidikan_ibu']) ? bersihkanInput($_POST['pendidikan_ibu'], $koneksi) : '';
    $penghasilan        = isset($_POST['penghasilan']) ? bersihkanInput($_POST['penghasilan'], $koneksi) : '';
    $nama_wali          = isset($_POST['nama_wali']) ? bersihkanInput($_POST['nama_wali'], $koneksi) : '';
    $agama_wali         = isset($_POST['agama_wali']) ? bersihkanInput($_POST['agama_wali'], $koneksi) : '';
    $alamat_wali        = isset($_POST['alamat_wali']) ? bersihkanInput($_POST['alamat_wali'], $koneksi) : '';
    $pendidikan_wali    = isset($_POST['pendidikan_wali']) ? bersihkanInput($_POST['pendidikan_wali'], $koneksi) : '';
    $pekerjaan_wali     = isset($_POST['pekerjaan_wali']) ? bersihkanInput($_POST['pekerjaan_wali'], $koneksi) : '';

    // Validasi field wajib
    $required_fields = [
        'no_pendaftaran',
        'no_daftar',
        'kategori',
        'nama_siswa',
        'nomor_induk',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'anak_ke',
        'jumlah_saudara',
        'status_keluarga',
        'alamat_rumah',
        'alamat_sekarang',
        'sekolah_asal',
        'alamat_sekolah_asal',
        'sttb_tahun',
        'sttb_nomor',
        'nama_ayah',
        'nama_ibu',
        'agama_ortu',
        'alamat_ortu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'pendidikan_ayah',
        'pendidikan_ibu',
        'penghasilan'
    ];

    $error = false;
    foreach ($required_fields as $field) {
        if (empty($$field)) {
            $error = true;
            logError("Field $field tidak boleh kosong");
        }
    }

    if ($error) {
        $error_message = 'Ada field yang wajib diisi tetapi kosong. Silakan cek kembali.';
    } else {
        $is_edit = isset($_GET['edit']) && $_GET['edit'] === 'true' && isset($_GET['no_daftar']);

        if ($is_edit) {
            $no_daftar_param = bersihkanInput($_GET['no_daftar'], $koneksi);
            $query = "UPDATE formulir SET 
                no_pendaftaran=?, kategori=?, nama_siswa=?, nomor_induk=?, jenis_kelamin=?, 
                tempat_lahir=?, tanggal_lahir=?, anak_ke=?, jumlah_saudara=?, status_keluarga=?, 
                alamat_rumah=?, alamat_sekarang=?, 
                sekolah_asal=?, alamat_sekolah_asal=?, sttb_tahun=?, sttb_nomor=?, 
                nama_ayah=?, nama_ibu=?, agama_ortu=?, alamat_ortu=?, pekerjaan_ayah=?, 
                pekerjaan_ibu=?, pendidikan_ayah=?, pendidikan_ibu=?, penghasilan=?, 
                nama_wali=?, agama_wali=?, alamat_wali=?, pendidikan_wali=?, pekerjaan_wali=?
                WHERE no_daftar=?";
        } else {
            $query = "INSERT INTO formulir (
                no_pendaftaran, no_daftar, kategori, nama_siswa, nomor_induk, jenis_kelamin, 
                tempat_lahir, tanggal_lahir, anak_ke, jumlah_saudara, status_keluarga, 
                alamat_rumah, alamat_sekarang, 
                sekolah_asal, alamat_sekolah_asal, sttb_tahun, sttb_nomor, 
                nama_ayah, nama_ibu, agama_ortu, alamat_ortu, pekerjaan_ayah, 
                pekerjaan_ibu, pendidikan_ayah, pendidikan_ibu, penghasilan, 
                nama_wali, agama_wali, alamat_wali, pendidikan_wali, pekerjaan_wali
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        }

        $stmt = mysqli_prepare($koneksi, $query);

        if ($stmt) {
            $params = [
                $no_pendaftaran,
                $kategori,
                $nama_siswa,
                $nomor_induk,
                $jenis_kelamin,
                $tempat_lahir,
                $tanggal_lahir,
                $anak_ke,
                $jumlah_saudara,
                $status_keluarga,
                $alamat_rumah,
                $alamat_sekarang,
                $sekolah_asal,
                $alamat_sekolah_asal,
                $sttb_tahun,
                $sttb_nomor,
                $nama_ayah,
                $nama_ibu,
                $agama_ortu,
                $alamat_ortu,
                $pekerjaan_ayah,
                $pekerjaan_ibu,
                $pendidikan_ayah,
                $pendidikan_ibu,
                $penghasilan,
                $nama_wali,
                $agama_wali,
                $alamat_wali,
                $pendidikan_wali,
                $pekerjaan_wali
            ];

            if ($is_edit) {
                $bindTypes = 'ssssssssss' . str_repeat('s', 20) . 's'; // Total = 34 karakter
                $params[] = $no_daftar_param;
            } else {
                array_splice($params, 1, 0, $no_daftar);
                $bindTypes = str_repeat('s', 31);
            }

            mysqli_stmt_bind_param($stmt, $bindTypes, ...$params);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['no_pendaftaran'] = $no_pendaftaran;
                $success_message = $is_edit ? 'Data berhasil diperbarui!' : 'Data berhasil disimpan!';
            } else {
                logError("Gagal menyimpan data: " . mysqli_error($koneksi));
                $error_message = 'Gagal menyimpan data. Silakan coba lagi atau hubungi administrator.';
            }

            mysqli_stmt_close($stmt);
        } else {
            logError("Gagal mempersiapkan statement: " . mysqli_error($koneksi));
            $error_message = 'Terjadi kesalahan sistem. Silakan coba lagi atau hubungi administrator.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Administrasi Siswa Baru</title>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #5d5d5d;
            margin-bottom: 30px;
        }

        label {
            font-size: 16px;
            margin-bottom: 6px;
            display: block;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .section-title {
            background-color: #eaeaea;
            padding: 10px;
            font-weight: bold;
            margin-top: 30px;
            border-radius: 4px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .form-row .form-group {
            width: 100%;
        }

        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }

            .form-row .form-group {
                width: 100%;
            }
        }
    </style>
</head>
<?php

$no_daftarr = isset($_SESSION['id_daftar']) ? $_SESSION['id_daftar'] : '';
?>

<body>
    <div class="container">
        <h2>DATA KELENGKAPAN ADMINISTRASI SISWA BARU</h2>
        <form action="" method="POST" id="formulir">
            <input type="hidden" id="no_daftar" name="no_daftar" value="<?= htmlspecialchars($no_daftarr) ?>" readonly required>
            <!-- 1. Data Siswa -->
            <div class="section-title">1. Data Siswa</div>
            <div class="form-group">
                <label for="no_pendaftaran">Nomor Pendaftaran:</label>
                <input type="text" id="no_pendaftaran" name="no_pendaftaran" value="<?= htmlspecialchars($data['no_pendaftaran'] ?? '') ?>" readonly required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori Daftar Sebagai:</label>
                <select id="kategori" name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php $qu = mysqli_query($koneksi, "select * from jurusan");
                    while ($jur = mysqli_fetch_array($qu)) {
                    ?>
                        <option value="<?php echo $jur['id_jurusan']; ?>" <?= (isset($data['kategori']) && $data['kategori'] == $jur['id_jurusan']) ? 'selected' : '' ?>><?php echo $jur['nama_jurusan']; ?></option>

                    <?php } ?>
                    <!-- <option value="full" <?= (isset($data['kategori']) && $data['kategori'] == 'full') ? 'selected' : '' ?>>Full Day School</option>
                    <option value="reguler" <?= (isset($data['kategori']) && $data['kategori'] == 'reguler') ? 'selected' : '' ?>>Reguler</option> -->
                </select>
            </div>
            <div class="form-group">
                <label for="nama_siswa">Nama Siswa:</label>
                <input type="text" id="nama_siswa" name="nama_siswa" value="<?= htmlspecialchars($data['nama_siswa'] ?? '') ?>" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="nomor_induk">Nomor Induk Kependudukan (NIK):</label>
                    <input type="text" id="nomor_induk" name="nomor_induk" value="<?= htmlspecialchars($data['nomor_induk'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin:</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" <?= (isset($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="Perempuan" <?= (isset($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir:</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" value="<?= htmlspecialchars($data['tempat_lahir'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir:</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?= htmlspecialchars($data['tanggal_lahir'] ?? '') ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="anak_ke">Anak Ke:</label>
                    <input type="number" id="anak_ke" name="anak_ke" value="<?= htmlspecialchars($data['anak_ke'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_saudara">Jumlah Saudara:</label>
                    <input type="number" id="jumlah_saudara" name="jumlah_saudara" value="<?= htmlspecialchars($data['jumlah_saudara'] ?? '') ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="status_keluarga">Status dalam Keluarga:</label>
                <input type="text" id="status_keluarga" name="status_keluarga" value="<?= htmlspecialchars($data['status_keluarga'] ?? '') ?>" required>
            </div>
            <!-- 2. Alamat Siswa -->
            <div class="section-title">2. Alamat Siswa</div>
            <div class="form-group">
                <label for="alamat_rumah">Alamat Rumah:</label>
                <input type="text" id="alamat_rumah" name="alamat_rumah" value="<?= htmlspecialchars($data['alamat_rumah'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" id="copyAlamat1"> Gunakan Alamat Rumah untuk Alamat Sekarang
                </label>
            </div>
            <div class="form-group">
                <label for="alamat_sekarang">Alamat Sekarang:</label>
                <input type="text" id="alamat_sekarang" name="alamat_sekarang" value="<?= htmlspecialchars($data['alamat_sekarang'] ?? '') ?>" required>
            </div>
            <!-- 3. Diterima di Madrasah -->
            <!-- <div class="section-title">3. Diterima di Madrasah Ini</div>
            <div class="form-row">
                <div class="form-group">
                    <label for="kelas_diterima">Di Kelas:</label>
                    <input type="text" id="kelas_diterima" name="kelas_diterima" value="<?= htmlspecialchars($data['kelas_diterima'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_diterima">Pada Tanggal:</label>
                    <input type="date" id="tanggal_diterima" name="tanggal_diterima" value="<?= htmlspecialchars($data['tanggal_diterima'] ?? '') ?>" required>
                </div>
            </div> -->
            <!-- 4. Sekolah Asal -->
            <div class="section-title">3. Sekolah Asal</div>
            <div class="form-group">
                <label for="sekolah_asal">Nama Sekolah/TK Asal:</label>
                <input type="text" id="sekolah_asal" name="sekolah_asal" value="<?= htmlspecialchars($data['sekolah_asal'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat_sekolah_asal">Alamat Sekolah Asal:</label>
                <input type="text" id="alamat_sekolah_asal" name="alamat_sekolah_asal" value="<?= htmlspecialchars($data['alamat_sekolah_asal'] ?? '') ?>" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="sttb_tahun">STTB Tahun:</label>
                    <input type="text" id="sttb_tahun" name="sttb_tahun" value="<?= htmlspecialchars($data['sttb_tahun'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="sttb_nomor">STTB Nomor:</label>
                    <input type="text" id="sttb_nomor" name="sttb_nomor" value="<?= htmlspecialchars($data['sttb_nomor'] ?? '') ?>" required>
                </div>
            </div>
            <!-- 5. Orang Tua -->
            <div class="section-title">4. Orang Tua</div>
            <div class="form-group">
                <label for="nama_ayah">Nama Ayah:</label>
                <input type="text" id="nama_ayah" name="nama_ayah" value="<?= htmlspecialchars($data['nama_ayah'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label for="nama_ibu">Nama Ibu:</label>
                <input type="text" id="nama_ibu" name="nama_ibu" value="<?= htmlspecialchars($data['nama_ibu'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label for="agama_ortu">Agama Orang Tua:</label>
                <input type="text" id="agama_ortu" name="agama_ortu" value="<?= htmlspecialchars($data['agama_ortu'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" id="copyAlamat2"> Gunakan Alamat Rumah untuk Alamat Orang Tua
                </label>
            </div>
            <div class="form-group">
                <label for="alamat_ortu">Alamat Orang Tua:</label>
                <input type="text" id="alamat_ortu" name="alamat_ortu" value="<?= htmlspecialchars($data['alamat_ortu'] ?? '') ?>" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="pekerjaan_ayah">Pekerjaan Ayah:</label>
                    <select id="pekerjaan_ayah" name="pekerjaan_ayah" required>
                        <option value="">-- Pilih Pekerjaan Ayah --</option>
                        <option value="PNS" <?= (isset($data['pekerjaan_ayah']) && $data['pekerjaan_ayah'] == 'PNS') ? 'selected' : '' ?>>A. PNS</option>
                        <option value="TNI/POLRI" <?= (isset($data['pekerjaan_ayah']) && $data['pekerjaan_ayah'] == 'TNI/POLRI') ? 'selected' : '' ?>>B. TNI/POLRI</option>
                        <option value="Guru/Dosen" <?= (isset($data['pekerjaan_ayah']) && $data['pekerjaan_ayah'] == 'Guru/Dosen') ? 'selected' : '' ?>>C. Guru/Dosen</option>
                        <option value="Dokter" <?= (isset($data['pekerjaan_ayah']) && $data['pekerjaan_ayah'] == 'Dokter') ? 'selected' : '' ?>>D. Dokter</option>
                        <option value="Politikus" <?= (isset($data['pekerjaan_ayah']) && $data['pekerjaan_ayah'] == 'Politikus') ? 'selected' : '' ?>>E. Politikus</option>
                        <option value="Pegawai Swasta" <?= (isset($data['pekerjaan_ayah']) && $data['pekerjaan_ayah'] == 'Pegawai Swasta') ? 'selected' : '' ?>>F. Pegawai Swasta</option>
                        <option value="Wiraswasta/Pedagang" <?= (isset($data['pekerjaan_ayah']) && $data['pekerjaan_ayah'] == 'Wiraswasta/Pedagang') ? 'selected' : '' ?>>G. Wiraswasta/Pedagang</option>
                        <option value="Petani/Peternak" <?= (isset($data['pekerjaan_ayah']) && $data['pekerjaan_ayah'] == 'Petani/Peternak') ? 'selected' : '' ?>>H. Petani/Peternak</option>
                        <option value="Seni/Lukis/Artis/Sejenis" <?= (isset($data['pekerjaan_ayah']) && $data['pekerjaan_ayah'] == 'Seni/Lukis/Artis/Sejenis') ? 'selected' : '' ?>>I. Seni/Lukis/Artis/Sejenis</option>
                        <option value="Buruh" <?= (isset($data['pekerjaan_ayah']) && $data['pekerjaan_ayah'] == 'Buruh') ? 'selected' : '' ?>>J. Buruh</option>
                        <option value="IRT" <?= (isset($data['pekerjaan_ayah']) && $data['pekerjaan_ayah'] == 'IRT') ? 'selected' : '' ?>>K. IRT</option>
                        <option value="Lainnya" <?= (isset($data['pekerjaan_ayah']) && $data['pekerjaan_ayah'] == 'Lainnya') ? 'selected' : '' ?>>L. Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pekerjaan_ibu">Pekerjaan Ibu:</label>
                    <select id="pekerjaan_ibu" name="pekerjaan_ibu" required>
                        <option value="">-- Pilih Pekerjaan Ibu --</option>
                        <option value="PNS" <?= (isset($data['pekerjaan_ibu']) && $data['pekerjaan_ibu'] == 'PNS') ? 'selected' : '' ?>>A. PNS</option>
                        <option value="TNI/POLRI" <?= (isset($data['pekerjaan_ibu']) && $data['pekerjaan_ibu'] == 'TNI/POLRI') ? 'selected' : '' ?>>B. TNI/POLRI</option>
                        <option value="Guru/Dosen" <?= (isset($data['pekerjaan_ibu']) && $data['pekerjaan_ibu'] == 'Guru/Dosen') ? 'selected' : '' ?>>C. Guru/Dosen</option>
                        <option value="Dokter" <?= (isset($data['pekerjaan_ibu']) && $data['pekerjaan_ibu'] == 'Dokter') ? 'selected' : '' ?>>D. Dokter</option>
                        <option value="Politikus" <?= (isset($data['pekerjaan_ibu']) && $data['pekerjaan_ibu'] == 'Politikus') ? 'selected' : '' ?>>E. Politikus</option>
                        <option value="Pegawai Swasta" <?= (isset($data['pekerjaan_ibu']) && $data['pekerjaan_ibu'] == 'Pegawai Swasta') ? 'selected' : '' ?>>F. Pegawai Swasta</option>
                        <option value="Wiraswasta/Pedagang" <?= (isset($data['pekerjaan_ibu']) && $data['pekerjaan_ibu'] == 'Wiraswasta/Pedagang') ? 'selected' : '' ?>>G. Wiraswasta/Pedagang</option>
                        <option value="Petani/Peternak" <?= (isset($data['pekerjaan_ibu']) && $data['pekerjaan_ibu'] == 'Petani/Peternak') ? 'selected' : '' ?>>H. Petani/Peternak</option>
                        <option value="Seni/Lukis/Artis/Sejenis" <?= (isset($data['pekerjaan_ibu']) && $data['pekerjaan_ibu'] == 'Seni/Lukis/Artis/Sejenis') ? 'selected' : '' ?>>I. Seni/Lukis/Artis/Sejenis</option>
                        <option value="Buruh" <?= (isset($data['pekerjaan_ibu']) && $data['pekerjaan_ibu'] == 'Buruh') ? 'selected' : '' ?>>J. Buruh</option>
                        <option value="IRT" <?= (isset($data['pekerjaan_ibu']) && $data['pekerjaan_ibu'] == 'IRT') ? 'selected' : '' ?>>K. IRT</option>
                        <option value="Lainnya" <?= (isset($data['pekerjaan_ibu']) && $data['pekerjaan_ibu'] == 'Lainnya') ? 'selected' : '' ?>>L. Lainnya</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="pendidikan_ayah">Pendidikan Ayah:</label>
                    <select id="pendidikan_ayah" name="pendidikan_ayah" required>
                        <option value="">-- Pilih Pendidikan Ayah --</option>
                        <option value="Tidak Tamat SD/MI/Paket A" <?= (isset($data['pendidikan_ayah']) && $data['pendidikan_ayah'] == 'Tidak Tamat SD/MI/Paket A') ? 'selected' : '' ?>>A. Tidak Tamat SD/MI/Paket A</option>
                        <option value="SD/MI/Paket A" <?= (isset($data['pendidikan_ayah']) && $data['pendidikan_ayah'] == 'SD/MI/Paket A') ? 'selected' : '' ?>>B. SD/MI/Paket A</option>
                        <option value="SMP/MTs/Paket B" <?= (isset($data['pendidikan_ayah']) && $data['pendidikan_ayah'] == 'SMP/MTs/Paket B') ? 'selected' : '' ?>>C. SMP/MTs/Paket B</option>
                        <option value="SMA/MA/SMK/Paket C" <?= (isset($data['pendidikan_ayah']) && $data['pendidikan_ayah'] == 'SMA/MA/SMK/Paket C') ? 'selected' : '' ?>>D. SMA/MA/SMK/Paket C</option>
                        <option value="Diploma I/II" <?= (isset($data['pendidikan_ayah']) && $data['pendidikan_ayah'] == 'Diploma I/II') ? 'selected' : '' ?>>E. Diploma I/II</option>
                        <option value="Diploma III/IV" <?= (isset($data['pendidikan_ayah']) && $data['pendidikan_ayah'] == 'Diploma III/IV') ? 'selected' : '' ?>>F. Diploma III/IV</option>
                        <option value="S1 (Sarjana)" <?= (isset($data['pendidikan_ayah']) && $data['pendidikan_ayah'] == 'S1 (Sarjana)') ? 'selected' : '' ?>>G. S1 (Sarjana)</option>
                        <option value="S2 (Magister)" <?= (isset($data['pendidikan_ayah']) && $data['pendidikan_ayah'] == 'S2 (Magister)') ? 'selected' : '' ?>>H. S2 (Magister)</option>
                        <option value="S3 (Doktor)" <?= (isset($data['pendidikan_ayah']) && $data['pendidikan_ayah'] == 'S3 (Doktor)') ? 'selected' : '' ?>>I. S3 (Doktor)</option>
                        <option value="Lainnya" <?= (isset($data['pendidikan_ayah']) && $data['pendidikan_ayah'] == 'Lainnya') ? 'selected' : '' ?>>J. Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pendidikan_ibu">Pendidikan Ibu:</label>
                    <select id="pendidikan_ibu" name="pendidikan_ibu" required>
                        <option value="">-- Pilih Pendidikan Ibu --</option>
                        <option value="Tidak Tamat SD/MI/Paket A" <?= (isset($data['pendidikan_ibu']) && $data['pendidikan_ibu'] == 'Tidak Tamat SD/MI/Paket A') ? 'selected' : '' ?>>A. Tidak Tamat SD/MI/Paket A</option>
                        <option value="SD/MI/Paket A" <?= (isset($data['pendidikan_ibu']) && $data['pendidikan_ibu'] == 'SD/MI/Paket A') ? 'selected' : '' ?>>B. SD/MI/Paket A</option>
                        <option value="SMP/MTs/Paket B" <?= (isset($data['pendidikan_ibu']) && $data['pendidikan_ibu'] == 'SMP/MTs/Paket B') ? 'selected' : '' ?>>C. SMP/MTs/Paket B</option>
                        <option value="SMA/MA/SMK/Paket C" <?= (isset($data['pendidikan_ibu']) && $data['pendidikan_ibu'] == 'SMA/MA/SMK/Paket C') ? 'selected' : '' ?>>D. SMA/MA/SMK/Paket C</option>
                        <option value="Diploma I/II" <?= (isset($data['pendidikan_ibu']) && $data['pendidikan_ibu'] == 'Diploma I/II') ? 'selected' : '' ?>>E. Diploma I/II</option>
                        <option value="Diploma III/IV" <?= (isset($data['pendidikan_ibu']) && $data['pendidikan_ibu'] == 'Diploma III/IV') ? 'selected' : '' ?>>F. Diploma III/IV</option>
                        <option value="S1 (Sarjana)" <?= (isset($data['pendidikan_ibu']) && $data['pendidikan_ibu'] == 'S1 (Sarjana)') ? 'selected' : '' ?>>G. S1 (Sarjana)</option>
                        <option value="S2 (Magister)" <?= (isset($data['pendidikan_ibu']) && $data['pendidikan_ibu'] == 'S2 (Magister)') ? 'selected' : '' ?>>H. S2 (Magister)</option>
                        <option value="S3 (Doktor)" <?= (isset($data['pendidikan_ibu']) && $data['pendidikan_ibu'] == 'S3 (Doktor)') ? 'selected' : '' ?>>I. S3 (Doktor)</option>
                        <option value="Lainnya" <?= (isset($data['pendidikan_ibu']) && $data['pendidikan_ibu'] == 'Lainnya') ? 'selected' : '' ?>>J. Lainnya</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="penghasilan">Penghasilan Perbulan:</label>
                <select name="penghasilan" id="penghasilan" required>
                    <option value="">-- Pilih Penghasi Perbulan --</option>
                    <option value="Kurang dari Rp.500.000" <?= (isset($data['penghasilan']) && $data['penghasilan'] == 'Kurang dari Rp.500.000') ? 'selected' : '' ?>>Kurang dari Rp.500.000</option>
                    <option value="Rp.500.001 s/d Rp.1.000.000" <?= (isset($data['penghasilan']) && $data['penghasilan'] == 'Rp.500.001 s/d Rp.1.000.000') ? 'selected' : '' ?>>Rp.500.001 s/d Rp.1.000.000</option>
                    <option value="Rp.1.000.001 s/d Rp.3.000.000" <?= (isset($data['penghasilan']) && $data['penghasilan'] == 'Rp.1.000.001 s/d Rp.3.000.000') ? 'selected' : '' ?>>Rp.1.000.001 s/d Rp.3.000.000</option>
                    <option value="Rp.3.000.001 s/d Rp.5.000.000" <?= (isset($data['penghasilan']) && $data['penghasilan'] == 'Rp.3.000.001 s/d Rp.5.000.000') ? 'selected' : '' ?>>Rp.3.000.001 s/d Rp.5.000.000</option>
                    <option value="Lebih dari Rp.5.000.001" <?= (isset($data['penghasilan']) && $data['penghasilan'] == 'Lebih dari Rp.5.000.001') ? 'selected' : '' ?>>Lebih dari Rp.5.000.001</option>
                </select>
            </div>
            <!-- 6. Wali -->
            <div class="section-title">5. Wali</div>
            <div class="form-group">
                <label for="wali_dari">Wali Dari:</label>
                <select id="wali_dari" name="wali_dari" onchange="isiDataWali()">
                    <option value="">-- Pilih Wali --</option>
                    <option value="ayah">Ayah</option>
                    <option value="ibu">Ibu</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="nama_wali">Nama Wali:</label>
                    <input type="text" id="nama_wali" name="nama_wali" value="<?= htmlspecialchars($data['nama_wali'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="agama_wali">Agama:</label>
                    <input type="text" id="agama_wali" name="agama_wali" value="<?= htmlspecialchars($data['agama_wali'] ?? '') ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" id="copyAlamat3"> Gunakan Alamat Rumah untuk Alamat Wali
                </label>
            </div>
            <div class="form-group">
                <label for="alamat_wali">Alamat:</label>
                <input type="text" id="alamat_wali" name="alamat_wali" value="<?= htmlspecialchars($data['alamat_wali'] ?? '') ?>" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="pendidikan_wali">Pendidikan:</label>
                    <select id="pendidikan_wali" name="pendidikan_wali" required>
                        <option value="">-- Pilih Pendidikan Wali --</option>
                        <option value="Tidak Tamat SD/MI/Paket A" <?= (isset($data['pendidikan_wali']) && $data['pendidikan_wali'] == 'Tidak Tamat SD/MI/Paket A') ? 'selected' : '' ?>>A. Tidak Tamat SD/MI/Paket A</option>
                        <option value="SD/MI/Paket A" <?= (isset($data['pendidikan_wali']) && $data['pendidikan_wali'] == 'SD/MI/Paket A') ? 'selected' : '' ?>>B. SD/MI/Paket A</option>
                        <option value="SMP/MTs/Paket B" <?= (isset($data['pendidikan_wali']) && $data['pendidikan_wali'] == 'SMP/MTs/Paket B') ? 'selected' : '' ?>>C. SMP/MTs/Paket B</option>
                        <option value="SMA/MA/SMK/Paket C" <?= (isset($data['pendidikan_wali']) && $data['pendidikan_wali'] == 'SMA/MA/SMK/Paket C') ? 'selected' : '' ?>>D. SMA/MA/SMK/Paket C</option>
                        <option value="Diploma I/II" <?= (isset($data['pendidikan_wali']) && $data['pendidikan_wali'] == 'Diploma I/II') ? 'selected' : '' ?>>E. Diploma I/II</option>
                        <option value="Diploma III/IV" <?= (isset($data['pendidikan_wali']) && $data['pendidikan_wali'] == 'Diploma III/IV') ? 'selected' : '' ?>>F. Diploma III/IV</option>
                        <option value="S1 (Sarjana)" <?= (isset($data['pendidikan_wali']) && $data['pendidikan_wali'] == 'S1 (Sarjana)') ? 'selected' : '' ?>>G. S1 (Sarjana)</option>
                        <option value="S2 (Magister)" <?= (isset($data['pendidikan_wali']) && $data['pendidikan_wali'] == 'S2 (Magister)') ? 'selected' : '' ?>>H. S2 (Magister)</option>
                        <option value="S3 (Doktor)" <?= (isset($data['pendidikan_wali']) && $data['pendidikan_wali'] == 'S3 (Doktor)') ? 'selected' : '' ?>>I. S3 (Doktor)</option>
                        <option value="Lainnya" <?= (isset($data['pendidikan_wali']) && $data['pendidikan_wali'] == 'Lainnya') ? 'selected' : '' ?>>J. Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pekerjaan_wali">Pekerjaan:</label>
                    <select id="pekerjaan_wali" name="pekerjaan_wali" required>
                        <option value="">-- Pilih Pekerjaan Wali --</option>
                        <option value="PNS" <?= (isset($data['pekerjaan_wali']) && $data['pekerjaan_wali'] == 'PNS') ? 'selected' : '' ?>>A. PNS</option>
                        <option value="TNI/POLRI" <?= (isset($data['pekerjaan_wali']) && $data['pekerjaan_wali'] == 'TNI/POLRI') ? 'selected' : '' ?>>B. TNI/POLRI</option>
                        <option value="Guru/Dosen" <?= (isset($data['pekerjaan_wali']) && $data['pekerjaan_wali'] == 'Guru/Dosen') ? 'selected' : '' ?>>C. Guru/Dosen</option>
                        <option value="Dokter" <?= (isset($data['pekerjaan_wali']) && $data['pekerjaan_wali'] == 'Dokter') ? 'selected' : '' ?>>D. Dokter</option>
                        <option value="Politikus" <?= (isset($data['pekerjaan_wali']) && $data['pekerjaan_wali'] == 'Politikus') ? 'selected' : '' ?>>E. Politikus</option>
                        <option value="Pegawai Swasta" <?= (isset($data['pekerjaan_wali']) && $data['pekerjaan_wali'] == 'Pegawai Swasta') ? 'selected' : '' ?>>F. Pegawai Swasta</option>
                        <option value="Wiraswasta/Pedagang" <?= (isset($data['pekerjaan_wali']) && $data['pekerjaan_wali'] == 'Wiraswasta/Pedagang') ? 'selected' : '' ?>>G. Wiraswasta/Pedagang</option>
                        <option value="Petani/Peternak" <?= (isset($data['pekerjaan_wali']) && $data['pekerjaan_wali'] == 'Petani/Peternak') ? 'selected' : '' ?>>H. Petani/Peternak</option>
                        <option value="Seni/Lukis/Artis/Sejenis" <?= (isset($data['pekerjaan_wali']) && $data['pekerjaan_wali'] == 'Seni/Lukis/Artis/Sejenis') ? 'selected' : '' ?>>I. Seni/Lukis/Artis/Sejenis</option>
                        <option value="Buruh" <?= (isset($data['pekerjaan_wali']) && $data['pekerjaan_wali'] == 'Buruh') ? 'selected' : '' ?>>J. Buruh</option>
                        <option value="IRT" <?= (isset($data['pekerjaan_wali']) && $data['pekerjaan_wali'] == 'IRT') ? 'selected' : '' ?>>K. IRT</option>
                        <option value="Lainnya" <?= (isset($data['pekerjaan_wali']) && $data['pekerjaan_wali'] == 'Lainnya') ? 'selected' : '' ?>>L. Lainnya</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn-submit">Simpan</button>
        </form>
    </div>

    <script>
        function isiDataWali() {
            const waliDari = document.getElementById('wali_dari').value;

            if (waliDari === 'ayah') {
                // Isi data dari ayah
                document.getElementById('nama_wali').value = document.getElementById('nama_ayah').value;
                document.getElementById('agama_wali').value = document.getElementById('agama_ortu').value;
                document.getElementById('alamat_wali').value = document.getElementById('alamat_ortu').value;
                document.getElementById('pendidikan_wali').value = document.getElementById('pendidikan_ayah').value;
                document.getElementById('pekerjaan_wali').value = document.getElementById('pekerjaan_ayah').value;
            } else if (waliDari === 'ibu') {
                // Isi data dari ibu
                document.getElementById('nama_wali').value = document.getElementById('nama_ibu').value;
                document.getElementById('agama_wali').value = document.getElementById('agama_ortu').value;
                document.getElementById('alamat_wali').value = document.getElementById('alamat_ortu').value;
                document.getElementById('pendidikan_wali').value = document.getElementById('pendidikan_ibu').value;
                document.getElementById('pekerjaan_wali').value = document.getElementById('pekerjaan_ibu').value;
            }
            // Jika dipilih "Lainnya", biarkan kosong untuk diisi manual
        }


        document.getElementById('copyAlamat1').addEventListener('change', function() {
            const alamatRumah = document.getElementById('alamat_rumah').value;

            if (this.checked) {
                document.getElementById('alamat_sekarang').value = alamatRumah;
            } else {
                document.getElementById('alamat_sekarang').value = '';
            }
        });

        // Tambahan agar saat alamat rumah diubah saat checkbox aktif, juga ikut berubah otomatis
        document.getElementById('alamat_rumah').addEventListener('input', function() {
            const check = document.getElementById('copyAlamat1').checked;
            if (check) {
                document.getElementById('alamat_sekarang').value = this.value;
            }
        });
        document.getElementById('copyAlamat2').addEventListener('change', function() {
            const alamatRumah = document.getElementById('alamat_rumah').value;

            if (this.checked) {
                document.getElementById('alamat_ortu').value = alamatRumah;
            } else {
                document.getElementById('alamat_ortu').value = '';
            }
        });

        // Tambahan agar saat alamat rumah diubah saat checkbox aktif, juga ikut berubah otomatis
        document.getElementById('alamat_rumah').addEventListener('input', function() {
            const check = document.getElementById('copyAlamat2').checked;
            if (check) {
                document.getElementById('alamat_ortu').value = this.value;
            }
        });
        document.getElementById('copyAlamat3').addEventListener('change', function() {
            const alamatRumah = document.getElementById('alamat_rumah').value;

            if (this.checked) {
                document.getElementById('alamat_wali').value = alamatRumah;
            } else {
                document.getElementById('alamat_wali').value = '';
            }
        });

        // Tambahan agar saat alamat rumah diubah saat checkbox aktif, juga ikut berubah otomatis
        document.getElementById('alamat_rumah').addEventListener('input', function() {
            const check = document.getElementById('copyAlamat3').checked;
            if (check) {
                document.getElementById('alamat_wali').value = this.value;
            }
        });



        // Generate nomor pendaftaran
        <?php if ($gunakan_js): ?>
            window.onload = function() {
                const now = new Date();
                const nomor = 'PSB-' +
                    now.getFullYear().toString().slice(-2) +
                    (now.getMonth() + 1).toString().padStart(2, '0') +
                    now.getDate().toString().padStart(2, '0') + '-' +
                    Math.floor(1000 + Math.random() * 9000);
                document.getElementById('no_pendaftaran').value = nomor;
            };
        <?php endif; ?>


        // Display SweetAlert2 messages
        <?php if ($success_message): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?php echo $success_message; ?>',
                confirmButtonText: 'OK'
            }).then(() => {
                document.getElementById('formulir').reset();
                // Regenerate nomor pendaftaran after reset
                const now = new Date();
                const nomor = 'PSB-' +
                    now.getFullYear().toString().slice(-2) +
                    (now.getMonth() + 1).toString().padStart(2, '0') +
                    now.getDate().toString().padStart(2, '0') + '-' +
                    Math.floor(1000 + Math.random() * 9000);
                document.getElementById('no_pendaftaran').value = nomor;
            });
        <?php endif; ?>

        <?php if ($error_message): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?php echo $error_message; ?>',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    </script>
</body>

</html>