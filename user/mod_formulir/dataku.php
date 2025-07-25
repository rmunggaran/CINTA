<?php
require 'D:/laragon/www/CINTA/config/database.php';

// Initialize empty $siswa array with default values
$siswa = [
    'no_pendaftaran' => '-',
    'kategori' => '-',
    'nama_siswa' => '-',
    'nomor_induk' => '-',
    'jenis_kelamin' => '-',
    'tempat_lahir' => '-',
    'tanggal_lahir' => '-',
    'anak_ke' => '-',
    'jumlah_saudara' => '-',
    'status_keluarga' => '-',
    'alamat_rumah' => '-',
    'alamat_sekarang' => '-',
    'kelas_diterima' => '-',
    'tanggal_diterima' => '-',
    'sekolah_asal' => '-',
    'alamat_sekolah_asal' => '-',
    'sttb_tahun' => '-',
    'sttb_nomor' => '-',
    'nama_ayah' => '-',
    'nama_ibu' => '-',
    'agama_ortu' => '-',
    'alamat_ortu' => '-',
    'pekerjaan_ayah' => '-',
    'pekerjaan_ibu' => '-',
    'pendidikan_ayah' => '-',
    'pendidikan_ibu' => '-',
    'penghasilan' => '-',
    'nama_wali' => '-',
    'agama_wali' => '-',
    'alamat_wali' => '-',
    'pendidikan_wali' => '-',
    'pekerjaan_wali' => '-'
];

// Check if session exists and fetch data
if (isset($_SESSION['id_daftar'])) {
    $no_pendaftaran = mysqli_real_escape_string($koneksi, $_SESSION['id_daftar']);
    $query = "SELECT * FROM formulir WHERE no_daftar = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 's', $no_pendaftaran);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $fetched_siswa = mysqli_fetch_assoc($result);

        if ($fetched_siswa) {
            $siswa = array_map('htmlspecialchars', $fetched_siswa);
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card author-box card-primary">
                <div class="card-header">
                    <h4>Data Pendaftar</h4>
                </div>
                <div class="card-body">
                    <?php if (!isset($siswa['no_daftar']) || empty($siswa['no_daftar'])) { ?>
                        <div style='padding:10px; background:#ffe0e0; border:1px solid red; color:red;'>
                            Formulir belum diisi.
                        </div>
                    <?php } else { ?>
                        <?php
                        $daftar = fetch($koneksi, 'daftar', ['id_daftar' => $siswa['no_daftar']]);

                        if ($daftar && isset($daftar['kelas']) && $daftar['kelas']) {
                            // Ambil data kelas berdasarkan id_kelas
                            $kelas = fetch($koneksi, 'kelas', ['id_kelas' => $daftar['kelas']]);
                        ?>
                            <div class="alert alert-success alert-dismissable">
                                <h4>Selamat anda telah telah di terima di MI Condong !!!</h4>
                                Anda masuk di
                                <span class="badge badge-danger"> <?= $kelas['nama_kelas'] ?> </span>
                            </div>
                        <?php } ?>

                        <div class="author-box-left">
                            <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle author-box-picture">
                            <div class="clearfix"></div>
                            <br>
                            <div class="author-box-job">Status Pendaftaran</div>
                            <span class="badge badge-success">Diverifikasi</span>
                        </div>
                        <div class="author-box-details">
                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-user"></i> Data Diri</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-user-friends"></i> Orang Tua</a>
                                </li>
                                <!-- <li class="nav-item">
                                <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-history"></i> Histori</a>
                            </li> -->
                            </ul>
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                            <tbody>
                                                <tr>
                                                    <td><b>Nomor Pendaftaran</b></td>
                                                    <td><?= htmlspecialchars($siswa['no_pendaftaran']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Jenis Pendidikan</b></td>
                                                    <?php
                                                    $jurusan = fetch($koneksi, 'jurusan', ['id_jurusan' => $siswa['kategori']]);
                                                    ?>
                                                    <td><?= htmlspecialchars($jurusan['nama_jurusan']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Nama Lengkap</b></td>
                                                    <td><?= htmlspecialchars($siswa['nama_siswa']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Nomor Induk</b></td>
                                                    <td><?= htmlspecialchars($siswa['nomor_induk']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Jenis Kelamin</b></td>
                                                    <td><?= htmlspecialchars($siswa['jenis_kelamin']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Tempat Lahir</b></td>
                                                    <td><?= htmlspecialchars($siswa['tempat_lahir']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Tanggal Lahir</b></td>
                                                    <td><?= htmlspecialchars($siswa['tanggal_lahir']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Anak Ke</b></td>
                                                    <td><?= htmlspecialchars($siswa['anak_ke']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Jumlah Saudara</b></td>
                                                    <td><?= htmlspecialchars($siswa['jumlah_saudara']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Status dalam Keluarga</b></td>
                                                    <td><?= htmlspecialchars($siswa['status_keluarga']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Alamat Rumah</b></td>
                                                    <td><?= htmlspecialchars($siswa['alamat_rumah']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Alamat Sekarang</b></td>
                                                    <td><?= htmlspecialchars($siswa['alamat_sekarang']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Kelas Diterima</b></td>
                                                    <td><?= htmlspecialchars($siswa['kelas_diterima']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Tanggal Diterima</b></td>
                                                    <td><?= htmlspecialchars($siswa['tanggal_diterima']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Sekolah Asal</b></td>
                                                    <td><?= htmlspecialchars($siswa['sekolah_asal']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Alamat Sekolah Asal</b></td>
                                                    <td><?= htmlspecialchars($siswa['alamat_sekolah_asal']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>STTB Tahun</b></td>
                                                    <td><?= htmlspecialchars($siswa['sttb_tahun']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>STTB Nomor</b></td>
                                                    <td><?= htmlspecialchars($siswa['sttb_nomor']) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                            <tbody>
                                                <tr>
                                                    <td><b>Nama Ayah</b></td>
                                                    <td><?= htmlspecialchars($siswa['nama_ayah']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Nama Ibu</b></td>
                                                    <td><?= htmlspecialchars($siswa['nama_ibu']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Agama Orang Tua</b></td>
                                                    <td><?= htmlspecialchars($siswa['agama_ortu']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Alamat Orang Tua</b></td>
                                                    <td><?= htmlspecialchars($siswa['alamat_ortu']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pekerjaan Ayah</b></td>
                                                    <td><?= htmlspecialchars($siswa['pekerjaan_ayah']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pekerjaan Ibu</b></td>
                                                    <td><?= htmlspecialchars($siswa['pekerjaan_ibu']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pendidikan Ayah</b></td>
                                                    <td><?= htmlspecialchars($siswa['pendidikan_ayah']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pendidikan Ibu</b></td>
                                                    <td><?= htmlspecialchars($siswa['pendidikan_ibu']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Penghasilan Perbulan</b></td>
                                                    <td><?= htmlspecialchars($siswa['penghasilan']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Nama Wali</b></td>
                                                    <td><?= htmlspecialchars($siswa['nama_wali']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Agama Wali</b></td>
                                                    <td><?= htmlspecialchars($siswa['agama_wali']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Alamat Wali</b></td>
                                                    <td><?= htmlspecialchars($siswa['alamat_wali']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pendidikan Wali</b></td>
                                                    <td><?= htmlspecialchars($siswa['pendidikan_wali']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pekerjaan Wali</b></td>
                                                    <td><?= htmlspecialchars($siswa['pekerjaan_wali']) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                                    <p>Histori pendaftaran belum tersedia.</p>
                                </div>
                            </div>
                            <div class="float-right mt-sm-0 mt-3">
                                <a href="index.php" class="btn btn-primary">Kembali <i class="fas fa-chevron-left"></i></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</div>