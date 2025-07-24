<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="activities">
                    <?php
                    $daftar = fetch($koneksi, 'daftar', ['id_daftar' => $_SESSION['id_daftar']]);
                    $formulir = fetch($koneksi, 'formulir', ['no_daftar' => $_SESSION['id_daftar']]);

                    if ($daftar && isset($daftar['kelas']) && $daftar['kelas']) {
                        // Ambil data kelas berdasarkan id_kelas
                        $kelas = fetch($koneksi, 'kelas', ['id_kelas' => $daftar['kelas']]);
                        $wali_kelas = fetch($koneksi, 'guru', ['id' => $kelas['walikelas_id']]);
                    ?>
                        <img src="<?= 'http://localhost/CINTA/' . $setting['kop'] ?>" width="100%" />

                        <div style="padding: 20px; border: 1px solid #000; margin-top: 20px;">
                            <h3 style="text-align: center; text-transform: uppercase;">
                                Berdasarkan hasil seleksi penerimaan peserta didik baru tahun pelajaran <?= $tahunAktif['tahun'] ?>
                            </h3>

                            <p style="text-align: justify; margin-top: 20px;">
                                Dengan ini Panitia Penerimaan Peserta Didik Baru menyatakan bahwa:
                            </p>

                            <table style="width: 100%; margin-top: 10px; font-size: 16px;">
                                <tr>
                                    <td style="width: 30%;">Nomor Pendaftaran</td>
                                    <td style="width: 2%;">:</td>
                                    <td><?= $formulir['no_daftar'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><?= $formulir['nama_siswa'] ?></td>
                                </tr>
                                <tr>
                                    <td>Asal Sekolah</td>
                                    <td>:</td>
                                    <td><?= $formulir['sekolah_asal'] ?></td>
                                </tr>
                            </table>

                            <div style="text-align: center; margin-top: 30px; padding: 20px; border: 2px solid #000;">
                                <h2 style="margin: 0; font-size: 28px;">DINYATAKAN</h2>
                                <h1 style="margin: 10px 0; font-size: 36px; color: darkblue;">DITERIMA</h1>
                                <p style="margin: 0;">Sebagai Siswa Kelas</p>
                                <h3 style="margin: 5px 0;"><?= $kelas['nama_kelas'] ?></h3>
                                <p style="margin: 0;">Tahun Pelajaran <?= $tahunAktif['tahun'] ?></p>
                                <p style="margin: 0;">Wali kelas <?= $wali_kelas['nama_guru'] ?></p>
                            </div>

                            <!-- <div style="margin-top: 40px; font-style: italic; font-size: 14px;">
                                * Harap melakukan daftar ulang sesuai jadwal yang telah ditentukan.
                            </div> -->
                        </div>

                    <?php } else { ?>
                        <?php $query = mysqli_query($koneksi, "SELECT * FROM pengumuman where jenis IN (0, 1) ORDER BY tgl DESC");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <div class="activity">
                                <div class="activity-icon bg-primary text-white shadow-primary">
                                    <i class="fas fa-bullhorn"></i>
                                </div>
                                <div class="activity-detail">
                                    <div class="mb-2">
                                        <span class="bullet"></span>
                                        <span class="text-job text-primary"><?= $data['tgl'] ?></span>
                                        <!-- <a class="text-job" href="#">View</a> -->

                                    </div>
                                    <h5><?= $data['judul'] ?></h5>
                                    <p><?= $data['pengumuman'] ?></p>
                                </div>
                            </div>
                    <?php }
                    } ?>

                </div>
            </div>
        </div>

    </div>
</div>