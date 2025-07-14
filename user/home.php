<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>

<div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card author-box card-primary">
            <div class="card-header">
                <h2 class="section-title">Info PPDB <?= date('Y') ?></h2>
            </div>
            <div class="card-body">

                <?php if ($siswa['konfirmasi'] == 1) { ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Terimakasih !!!<br />
                        Telah menyetujui penyataan pada <span class="badge badge-danger"> <?= $siswa['tgl_konfirmasi'] ?></span>
                    </div>

                    <!-- <div class="row">
                        <div class="col-lg-4">
                            <div class="activities">
                                <div class="activity">
                                    <div class="activity-icon bg-primary text-white shadow-primary">1</div>
                                    <div class="activity-detail">
                                        <h5>Formulir</h5>
                                        <a target="_blank" href="mod_formulir/print_daftar.php?id=<?= enkripsi($siswa['id_daftar']) ?>" class="badge badge-primary">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="activities">
                                <div class="activity">
                                    <div class="activity-icon bg-primary text-white shadow-primary">2</div>
                                    <div class="activity-detail">
                                        <h5>Surat Pernyataan Orang Tua/Wali</h5>
                                        <a href="?pg=kartu" class="badge badge-success">
                                            <i class="fas fa-eye"></i> Lihat Kartu
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="activities">
                                <div class="activity">
                                    <div class="activity-icon bg-primary text-white shadow-primary">3</div>
                                    <div class="activity-detail">
                                        <h5>Surat Pernyataan Calon Peserta Didik Baru</h5>
                                        <span class="badge badge-warning">
                                            <i class="fas fa-download"></i> Download
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                <?php } else { ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Hai <?= $siswa['nama'] ?> !!!<br />
                        <?php if ($siswa['status'] == 0) { ?>
                            Status Pendaftaran Kamu Saat ini <span class="badge badge-warning">Belum Diproses</span>
                        <?php } elseif ($siswa['status'] == 1) { ?>
                            Status Pendaftaran Kamu Saat ini <span class="badge badge-danger">Sudah Diproses</span>, Silahkan Segera Cetak Bukti Pendaftaran
                        <?php } ?>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="activities">
                                <div class="activity">
                                    <div class="activity-icon bg-primary text-white shadow-primary">1</div>
                                    <div class="activity-detail">
                                        <h5>Lengkapi Formulir</h5>
                                        <a class="badge badge-primary">
                                            <i class="fas fa-book"></i> Lengkapi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="activities">
                                <div class="activity">
                                    <div class="activity-icon bg-primary text-white shadow-primary">2</div>
                                    <div class="activity-detail">
                                        <h5>Upload Berkas</h5>
                                        <a class="badge badge-success">
                                            <i class="fas fa-upload"></i> Lengkapi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="activities">
                                <div class="activity">
                                    <div class="activity-icon bg-primary text-white shadow-primary">3</div>
                                    <div class="activity-detail">
                                        <h5>Daftar Ulang</h5>
                                        <?php if ($siswa['status'] == 1) { ?>
                                            <a href="?pg=df_ulang" class="badge badge-info">
                                                <i class="fas fa-eye"></i> Konfirmasi
                                            </a>
                                        <?php } else { ?>
                                            <a href="#" class="badge badge-info" data-confirm="Maaf Konfirmasi Daftar Ulang Belum bisa dilakukan !!|Status anda Masih Proses..">
                                                <i class="fas fa-eye"></i> Konfirmasi
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <!-- Pengumuman -->
                <div class="row mt-4">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="alert alert-info alert-has-icon">
                                <div class="alert-icon"><i class="fas fa-bullhorn"></i></div>
                                <div class="alert-body">
                                    <div class="alert-title">Pengumuman</div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="activities">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM pengumuman WHERE jenis IN (0, 1) ORDER BY tgl DESC LIMIT 1");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                        <div class="activity">
                                            <div class="activity-icon bg-primary text-white shadow-primary">
                                                <i class="fas fa-bullhorn"></i>
                                            </div>
                                            <div class="activity-detail">
                                                <div class="mb-2">
                                                    <span class="text-job text-primary"><?= $data['tgl'] ?></span>
                                                    <span class="bullet"></span>
                                                </div>
                                                <h5><?= $data['judul'] ?></h5>
                                                <p><?= $data['pengumuman'] ?></p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Sekolah -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <span class="badge badge-info"><?= $setting['npsn'] ?></span>
                                <br><br>
                                <img src="../<?= $setting['logo'] ?>" alt="Logo" class="img-fluid rounded-circle" width="120">
                                <h5 class="mt-2"><?= $setting['nsm'] ?></h5>
                            </div>

                            <div class="box-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <img src="../dist/img/support.png" width="45" alt="">
                                        <a href="https://<?= $setting['nsm'] ?>" target="_blank" class="btn btn-success">
                                            <i class="fas fa-globe"></i> Website Sekolah
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <img src="../dist/img/support.png" width="45" alt="">
                                        <a href="https://api.whatsapp.com/send?phone=+62<?= $setting['nolivechat'] ?>&text=<?= $setting['livechat'] ?>" target="_blank" class="btn btn-primary">
                                            <i class="fab fa-whatsapp"></i> <?= $setting['nolivechat'] ?>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <img src="../dist/img/support.png" width="45" alt="">
                                        <a href="#" target="_blank" class="btn btn-danger">
                                            <i class="fas fa-home"></i> <?= $setting['nsm'] ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->