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

function generateNomorPendaftaran($koneksi)
{
    $query = "SELECT MAX(CAST(SUBSTRING(no_pendaftaran, 5) AS UNSIGNED)) as max_nomor FROM formulir WHERE no_pendaftaran LIKE 'PSB-%'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    $nextNomor = (int)($row['max_nomor'] ?? 0) + 1;
    return 'PSB-' . $nextNomor;
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

$id = $_SESSION['id_daftar'] ?? null;

// Proses data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ======= PROSES FORMULIR =======
    $no_pendaftaran = isset($_POST['no_pendaftaran']) && !empty($_POST['no_pendaftaran'])
        ? bersihkanInput($_POST['no_pendaftaran'], $koneksi)
        : generateNomorPendaftaran($koneksi);

    $no_daftar          = bersihkanInput($_POST['no_daftar'], $koneksi);
    $tahun_ajaran          = bersihkanInput($_POST['tahun_ajaran'], $koneksi);
    $kategori           = bersihkanInput($_POST['kategori'], $koneksi);
    $nama_siswa         = bersihkanInput($_POST['nama_siswa'], $koneksi);
    $nomor_induk        = bersihkanInput($_POST['nomor_induk'], $koneksi);
    $jenis_kelamin      = bersihkanInput($_POST['jenis_kelamin'], $koneksi);
    $tempat_lahir       = bersihkanInput($_POST['tempat_lahir'], $koneksi);
    $tanggal_lahir      = bersihkanInput($_POST['tanggal_lahir'], $koneksi);
    $anak_ke            = (int)bersihkanInput($_POST['anak_ke'], $koneksi);
    $jumlah_saudara     = (int)bersihkanInput($_POST['jumlah_saudara'], $koneksi);
    $status_keluarga    = bersihkanInput($_POST['status_keluarga'], $koneksi);
    $alamat_rumah       = bersihkanInput($_POST['alamat_rumah'], $koneksi);
    $alamat_sekarang    = bersihkanInput($_POST['alamat_sekarang'], $koneksi);
    $sekolah_asal       = bersihkanInput($_POST['sekolah_asal'], $koneksi);
    $alamat_sekolah_asal = bersihkanInput($_POST['alamat_sekolah_asal'], $koneksi);
    $sttb_tahun         = bersihkanInput($_POST['sttb_tahun'], $koneksi);
    $sttb_nomor         = bersihkanInput($_POST['sttb_nomor'], $koneksi);
    $nama_ayah          = bersihkanInput($_POST['nama_ayah'], $koneksi);
    $nama_ibu           = bersihkanInput($_POST['nama_ibu'], $koneksi);
    $agama_ortu         = bersihkanInput($_POST['agama_ortu'], $koneksi);
    $alamat_ortu        = bersihkanInput($_POST['alamat_ortu'], $koneksi);
    $pekerjaan_ayah     = bersihkanInput($_POST['pekerjaan_ayah'], $koneksi);
    $pekerjaan_ibu      = bersihkanInput($_POST['pekerjaan_ibu'], $koneksi);
    $pendidikan_ayah    = bersihkanInput($_POST['pendidikan_ayah'], $koneksi);
    $pendidikan_ibu     = bersihkanInput($_POST['pendidikan_ibu'], $koneksi);
    $penghasilan        = bersihkanInput($_POST['penghasilan'], $koneksi);
    $nama_wali          = bersihkanInput($_POST['nama_wali'], $koneksi);
    $agama_wali         = bersihkanInput($_POST['agama_wali'], $koneksi);
    $alamat_wali        = bersihkanInput($_POST['alamat_wali'], $koneksi);
    $pendidikan_wali    = bersihkanInput($_POST['pendidikan_wali'], $koneksi);
    $pekerjaan_wali     = bersihkanInput($_POST['pekerjaan_wali'], $koneksi);

    $data_formulir = [
        'no_pendaftaran' => $no_pendaftaran,
        'tahun_ajaran' => $tahun_ajaran,
        'no_daftar' => $no_daftar,
        'kategori' => $kategori,
        'nama_siswa' => $nama_siswa,
        'nomor_induk' => $nomor_induk,
        'jenis_kelamin' => $jenis_kelamin,
        'tempat_lahir' => $tempat_lahir,
        'tanggal_lahir' => $tanggal_lahir,
        'anak_ke' => $anak_ke,
        'jumlah_saudara' => $jumlah_saudara,
        'status_keluarga' => $status_keluarga,
        'alamat_rumah' => $alamat_rumah,
        'alamat_sekarang' => $alamat_sekarang,
        'sekolah_asal' => $sekolah_asal,
        'alamat_sekolah_asal' => $alamat_sekolah_asal,
        'sttb_tahun' => $sttb_tahun,
        'sttb_nomor' => $sttb_nomor,
        'nama_ayah' => $nama_ayah,
        'nama_ibu' => $nama_ibu,
        'agama_ortu' => $agama_ortu,
        'alamat_ortu' => $alamat_ortu,
        'pekerjaan_ayah' => $pekerjaan_ayah,
        'pekerjaan_ibu' => $pekerjaan_ibu,
        'pendidikan_ayah' => $pendidikan_ayah,
        'pendidikan_ibu' => $pendidikan_ibu,
        'penghasilan' => $penghasilan,
        'nama_wali' => $nama_wali,
        'agama_wali' => $agama_wali,
        'alamat_wali' => $alamat_wali,
        'pendidikan_wali' => $pendidikan_wali,
        'pekerjaan_wali' => $pekerjaan_wali
    ];

    $formulir_sukses = false;
    $berkas_sukses = false;

    $check = select($koneksi, 'formulir', ['no_daftar' => $no_daftar]);
    if ($check) {
        $exec_formulir = update($koneksi, 'formulir', $data_formulir, ['no_daftar' => $no_daftar]);
        $formulir_sukses = true;
    } else {
        $exec_formulir = insert($koneksi, 'formulir', $data_formulir);
        $formulir_sukses = true;
    }

    // ======= PROSES BERKAS =======
    $ekstensi = ['jpg', 'jpeg', 'png'];
    $data_berkas = [];

    if (!empty($_FILES['akta']['name'])) {
        $file = $_FILES['akta'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $ekstensi)) {
            $query = mysqli_query($koneksi, "SELECT akta FROM daftar WHERE id_daftar = '$id'");
            if (!$query) {
                die("Query error: " . mysqli_error($koneksi));
            }
            $lama = mysqli_fetch_assoc($query);
            if (!empty($lama['akta'])) {
                $file_lama = realpath(__DIR__ . '/../../' . $lama['akta']);
                if ($file_lama && is_file($file_lama)) {
                    unlink($file_lama);
                }
            }

            $dir = realpath(__DIR__ . '/../../assets/upload/akta');
            if (!$dir) {
                mkdir(__DIR__ . '/../../assets/upload/akta', 0777, true);
                $dir = realpath(__DIR__ . '/../../assets/upload/akta');
            }

            $dest = $dir . "/akta{$id}.{$ext}";
            if (move_uploaded_file($file['tmp_name'], $dest)) {
                $data_berkas['akta'] = 'assets/upload/akta/akta' . $id . '.' . $ext;
            }
        }
    }
    // --- KK ---
    if (!empty($_FILES['kk']['name'])) {
        $file = $_FILES['kk'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $ekstensi)) {
            $query = mysqli_query($koneksi, "SELECT kk FROM daftar WHERE id_daftar = '$id'");
            if (!$query) {
                die("Query error: " . mysqli_error($koneksi));
            }
            $lama = mysqli_fetch_assoc($query);
            if (!empty($lama['kk'])) {
                $file_lama = realpath(__DIR__ . '/../../' . $lama['kk']);
                if ($file_lama && is_file($file_lama)) {
                    unlink($file_lama);
                }
            }

            $dir = realpath(__DIR__ . '/../../assets/upload/kk');
            if (!$dir) {
                mkdir(__DIR__ . '/../../assets/upload/kk', 0777, true);
                $dir = realpath(__DIR__ . '/../../assets/upload/kk');
            }

            $dest = $dir . "/kk{$id}.{$ext}";
            if (move_uploaded_file($file['tmp_name'], $dest)) {
                $data_berkas['kk'] = 'assets/upload/kk/kk' . $id . '.' . $ext;
            }
        }
    }

    // --- KTP ORTU ---
    if (!empty($_FILES['ktp_ortu']['name'])) {
        $file = $_FILES['ktp_ortu'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $ekstensi)) {
            $query = mysqli_query($koneksi, "SELECT ktp_ortu FROM daftar WHERE id_daftar = '$id'");
            if (!$query) {
                die("Query error: " . mysqli_error($koneksi));
            }
            $lama = mysqli_fetch_assoc($query);

            if (!empty($lama['ktp_ortu'])) {
                $file_lama = realpath(__DIR__ . '/../../' . $lama['ktp_ortu']);
                if ($file_lama && is_file($file_lama)) {
                    unlink($file_lama);
                }
            }

            $dir = realpath(__DIR__ . '/../../assets/upload/ktp_ortu');
            if (!$dir) {
                mkdir(__DIR__ . '/../../assets/upload/ktp_ortu', 0777, true);
                $dir = realpath(__DIR__ . '/../../assets/upload/ktp_ortu');
            }

            $dest = $dir . "/ktp_ortu{$id}.{$ext}";
            if (move_uploaded_file($file['tmp_name'], $dest)) {
                $data_berkas['ktp_ortu'] = 'assets/upload/ktp_ortu/ktp_ortu' . $id . '.' . $ext;
            }
        }
    }

    // --- KPS/PKH ---
    if (!empty($_FILES['kps_pkh']['name'])) {
        $file = $_FILES['kps_pkh'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $ekstensi)) {
            $query = mysqli_query($koneksi, "SELECT kps_pkh FROM daftar WHERE id_daftar = '$id'");
            if (!$query) {
                die("Query error: " . mysqli_error($koneksi));
            }
            $lama = mysqli_fetch_assoc($query);

            if (!empty($lama['kps_pkh'])) {
                $file_lama = realpath(__DIR__ . '/../../' . $lama['kps_pkh']);
                if ($file_lama && is_file($file_lama)) {
                    unlink($file_lama);
                }
            }

            $dir = realpath(__DIR__ . '/../../assets/upload/kps_pkh');
            if (!$dir) {
                mkdir(__DIR__ . '/../../assets/upload/kps_pkh', 0777, true);
                $dir = realpath(__DIR__ . '/../../assets/upload/kps_pkh');
            }

            $dest = $dir . "/kps_pkh{$id}.{$ext}";
            if (move_uploaded_file($file['tmp_name'], $dest)) {
                $data_berkas['kps_pkh'] = 'assets/upload/kps_pkh/kps_pkh' . $id . '.' . $ext;
            }
        }
    }

    // --- ijazah ---
    if (!empty($_FILES['ijazah']['name'])) {
        $file = $_FILES['ijazah'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $ekstensi)) {
            $query = mysqli_query($koneksi, "SELECT ijazah FROM daftar WHERE id_daftar = '$id'");
            if (!$query) {
                die("Query error: " . mysqli_error($koneksi));
            }
            $lama = mysqli_fetch_assoc($query);

            if (!empty($lama['ijazah'])) {
                $file_lama = realpath(__DIR__ . '/../../' . $lama['ijazah']);
                if ($file_lama && is_file($file_lama)) {
                    unlink($file_lama);
                }
            }

            $dir = realpath(__DIR__ . '/../../assets/upload/ijazah');
            if (!$dir) {
                mkdir(__DIR__ . '/../../assets/upload/ijazah', 0777, true);
                $dir = realpath(__DIR__ . '/../../assets/upload/ijazah');
            }

            $dest = $dir . "/ijazah{$id}.{$ext}";
            if (move_uploaded_file($file['tmp_name'], $dest)) {
                $data_berkas['ijazah'] = 'assets/upload/ijazah/ijazah' . $id . '.' . $ext;
            }
        }
    }

    if (!empty($data_berkas)) {
        $exec_berkas = update($koneksi, 'daftar', $data_berkas, ['id_daftar' => $id]);
        if ($exec_berkas) {
            $berkas_sukses = true;
        }
    }

    if ($formulir_sukses && $berkas_sukses) {
        $_SESSION['flash'][] = [
            'status' => 'success',
            'message' => 'Formulir dan berkas berhasil disimpan.'
        ];
    } elseif ($formulir_sukses) {
        $_SESSION['flash'][] = [
            'status' => 'success',
            'message' => 'Formulir berhasil disimpan.'
        ];
    } elseif ($berkas_sukses) {
        $_SESSION['flash'][] = [
            'status' => 'success',
            'message' => 'Berkas berhasil diunggah.'
        ];
    } else {
        $_SESSION['flash'][] = [
            'status' => 'warning',
            'message' => 'Tidak ada data yang disimpan.'
        ];
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
    <?php if (isset($_SESSION['flash'])): ?>
        <script>
            <?php foreach ($_SESSION['flash'] as $item): ?>
                iziToast.<?= $item['status'] ?>({
                    title: '<?= ucfirst($item['status']) ?>',
                    message: '<?= $item['message'] ?>',
                    position: 'topRight'
                });
            <?php endforeach; ?>
        </script>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <?php
    // Ambil data siswa dari tabel daftar
    $siswa = fetch($koneksi, 'daftar', ['id_daftar' => $_SESSION['id_daftar']]);

    // Ambil data formulir berdasarkan no_daftar yang sama
    $formulir = fetch($koneksi, 'formulir', ['no_daftar' => $siswa['id_daftar']]);

    // Cek kondisi
    if ($formulir) {
        if ($siswa['status'] == 1) {
            // Jika sudah diverifikasi
            echo '<div class="alert alert-success alert-dismissable">
                Data anda telah diverifikasi
              </div>';
        } elseif ($siswa['status'] == 2) {
            // Jika sedang diverifikasi
            echo '<div class="alert alert-warning alert-dismissable">
                Periksa kembali data atau berkas Anda. Mungkin ada yang salah atau belum memenuhi syarat.
              </div>';
        } elseif ($siswa['status'] == 0) {
            // Jika sedang diverifikasi
            echo '<div class="alert alert-info alert-dismissable">
                Data anda sedang diverifikasi mohon ditunggu
              </div>';
        }
    }
    ?>



    <div class="container">
        <h2>DATA KELENGKAPAN ADMINISTRASI SISWA BARU</h2>
        <form action="" method="POST" id="formulir" enctype="multipart/form-data">
            <input type="hidden" id="no_daftar" name="no_daftar" value="<?= htmlspecialchars($no_daftarr) ?>" readonly required>
            <!-- 1. Data Siswa -->
            <div class="section-title">1. Data Siswa</div>
            <div class="form-group">
                <label for="no_pendaftaran">Nomor Pendaftaran:</label>
                <input type="text" id="no_pendaftaran" name="no_pendaftaran"
                    value="<?= isset($data['no_pendaftaran']) ? htmlspecialchars($data['no_pendaftaran']) : generateNomorPendaftaran($koneksi) ?>"
                    readonly required>

            </div>
            <div class="form-group">
                <label for="tahun_ajaran">Tahun Ajaran:</label>
                <input type="text" id="tahun_ajaran" name="tahun_ajaran"
                    value="<?= htmlspecialchars($data['tahun_ajaran'] ?? $tahunAktif['tahun']) ?>"
                    readonly required>
            </div>

            <div class="form-group">
                <label for="kategori">Jenis Pendidikan:</label>
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
                    <input type="text" id="sttb_tahun" name="sttb_tahun" value="<?= htmlspecialchars($data['sttb_tahun'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label for="sttb_nomor">STTB Nomor:</label>
                    <input type="text" id="sttb_nomor" name="sttb_nomor" value="<?= htmlspecialchars($data['sttb_nomor'] ?? '') ?>">
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
            <?php
            // Ambil data berkas dari database
            $id = $_SESSION['id_daftar'];
            $berkas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM daftar WHERE id_daftar = '$id'"));
            ?>
            <div class="section-title">6.Upload Berkas</div>
            <!-- Akta -->
            <div class="form-group mb-3">
                <label for="akta" class="form-label">Akte Kelahiran</label>
                <input class="form-control" type="file" name="akta" id="akta" accept=".jpg, .jpeg, .png">
                <?php if (!empty($berkas['akta'])): ?>
                    <p>File lama: <a href="../<?= $berkas['akta'] ?>?ts=<?= time() ?>" target="_blank">Lihat Akta</a></p>
                <?php endif; ?>
            </div>

            <!-- KK -->
            <div class="form-group mb-3">
                <label for="kk" class="form-label">Kartu Keluarga</label>
                <input class="form-control" type="file" name="kk" id="kk" accept=".jpg, .jpeg, .png">
                <?php if (!empty($berkas['kk'])): ?>
                    <p>File lama: <a href="../<?= $berkas['kk'] ?>?ts=<?= time() ?>" target="_blank">Lihat KK</a></p>
                <?php endif; ?>
            </div>

            <!-- KTP Ortu -->
            <div class="form-group mb-3">
                <label for="ktp_ortu" class="form-label">KTP Orang Tua</label>
                <input class="form-control" type="file" name="ktp_ortu" id="ktp_ortu" accept=".jpg, .jpeg, .png">
                <?php if (!empty($berkas['ktp_ortu'])): ?>
                    <p>File lama: <a href="../<?= $berkas['ktp_ortu'] ?>?ts=<?= time() ?>" target="_blank">Lihat KTP Ortu</a></p>

                <?php endif; ?>
            </div>

            <!-- KPS/PKH -->
            <div class="form-group mb-3">
                <label for="kps_pkh" class="form-label">KPS/PKH (jika ada)</label>
                <input class="form-control" type="file" name="kps_pkh" id="kps_pkh" accept=".jpg, .jpeg, .png">
                <?php if (!empty($berkas['kps_pkh'])): ?>
                    <p>File lama: <a href="../<?= $berkas['kps_pkh'] ?>?ts=<?= time() ?>" target="_blank">Lihat KPS/PKH</a></p>
                <?php endif; ?>
            </div>

            <!-- KPS/PKH -->
            <div class="form-group mb-3">
                <label for="kps_pkh" class="form-label">Ijazah TK (jika ada)</label>
                <input class="form-control" type="file" name="ijazah" id="ijazah" accept=".jpg, .jpeg, .png">
                <?php if (!empty($berkas['ijazah'])): ?>
                    <p>File lama: <a href="../<?= $berkas['ijazah'] ?>?ts=<?= time() ?>" target="_blank">Lihat ijazah</a></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn-submit" id="submit-all">Simpan</button>
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
        // <?php if ($gunakan_js): ?>
        //     window.onload = function() {
        //         const now = new Date();
        //         const nomor = 'PSB-' +
        //             now.getFullYear().toString().slice(-2) +
        //             (now.getMonth() + 1).toString().padStart(2, '0') +
        //             now.getDate().toString().padStart(2, '0') + '-' +
        //             Math.floor(1000 + Math.random() * 9000);
        //         document.getElementById('no_pendaftaran').value = nomor;
        //     };
        // <?php endif; ?>


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