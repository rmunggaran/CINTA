<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<?php if (isset($_GET['status'])): ?>
    <div class="text-white alert 
        <?php
        if ($_GET['status'] == 'success') echo 'alert-primary';
        elseif ($_GET['status'] == 'error') echo 'alert-danger';
        else echo 'alert-warning';
        ?>">
        <?php
        if ($_GET['status'] == 'success') echo '✅ Berkas berhasil diupload!';
        elseif ($_GET['status'] == 'error') echo '❌ Gagal menyimpan ke database.';
        else echo '⚠️ Tidak ada file yang diupload.';
        ?>
    </div>
<?php endif; ?>

<?php
// Ambil data berkas dari database
$id = $_SESSION['id_daftar'];
$berkas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM daftar WHERE id_daftar = '$id'"));
?>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Upload Dokumen Siswa</h5>
        </div>
        <div class="card-body">
            <form action="mod_berkas/crud_berkas.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="pg" value="ubah">

                <!-- Akta -->
                <div class="mb-3">
                    <label for="akta" class="form-label">Akte Kelahiran</label>
                    <input class="form-control" type="file" name="akta" id="akta" accept=".jpg, .jpeg, .png">
                    <?php if (!empty($berkas['akta'])): ?>
                        <p>File lama: <a href="../<?= $berkas['akta'] ?>" target="_blank">Lihat Akta</a></p>
                    <?php endif; ?>
                </div>

                <!-- KK -->
                <div class="mb-3">
                    <label for="kk" class="form-label">Kartu Keluarga</label>
                    <input class="form-control" type="file" name="kk" id="kk" accept=".jpg, .jpeg, .png">
                    <?php if (!empty($berkas['kk'])): ?>
                        <p>File lama: <a href="../<?= $berkas['kk'] ?>" target="_blank">Lihat KK</a></p>
                    <?php endif; ?>
                </div>

                <!-- KTP Ortu -->
                <div class="mb-3">
                    <label for="ktp_ortu" class="form-label">KTP Orang Tua</label>
                    <input class="form-control" type="file" name="ktp_ortu" id="ktp_ortu" accept=".jpg, .jpeg, .png">
                    <?php if (!empty($berkas['ktp_ortu'])): ?>
                        <p>File lama: <a href="../<?= $berkas['ktp_ortu'] ?>" target="_blank">Lihat KTP Ortu</a></p>
                    <?php endif; ?>
                </div>

                <!-- KPS/PKH -->
                <div class="mb-3">
                    <label for="kps_pkh" class="form-label">KPS/PKH (jika ada)</label>
                    <input class="form-control" type="file" name="kps_pkh" id="kps_pkh" accept=".jpg, .jpeg, .png">
                    <?php if (!empty($berkas['kps_pkh'])): ?>
                        <p>File lama: <a href="../<?= $berkas['kps_pkh'] ?>" target="_blank">Lihat KPS/PKH</a></p>
                    <?php endif; ?>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>