<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Berkas PPDB</h4>
            </div>

            <div class="card-body">
                <p>
                    <small>Jika Tulisan Terdapat<a class="btn btn-sm btn-success">Lihat Disini</a>. Siswa Sudah Mengupload Berkas</small>
                </p>
                <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    No
                                </th>
                                <th>Nama Pendaftar</th>
                                <th>Asal sekolah</th>
                                <th>Akte Kelahiran</th>
                                <th>Kartu Keluarga</th>
                                <th>KTP Orang Tua</th>
                                <th>KPS/PKH (Jika Ada)</th>
                                <th>Ijazah (Jika Ada)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id_siswa = dekripsi($_GET['id']) ?? null; // contoh ambil dari URL
                            $query = mysqli_query($koneksi, "SELECT daftar.*, formulir.* 
                                FROM daftar 
                                INNER JOIN formulir ON daftar.id_daftar = formulir.no_daftar 
                                WHERE daftar.id_daftar = '$id_siswa'");
                            $no = 0;
                            while ($daftar = mysqli_fetch_array($query)) {
                                $no++;
                                $bayar = mysqli_fetch_array(mysqli_query($koneksi, "select sum(jumlah) as total from bayar where id_daftar='$daftar[id_daftar]' "));
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>

                                    <td><?= $daftar['nama_siswa'] ?></td>
                                    <td><?= $daftar['sekolah_asal'] ?></td>

                                    <td>
                                        <?php if ($daftar['akta'] != null) { ?>
                                            <a href="../<?= $daftar['akta'] ?>" target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Preview
                                            </a>
                                            <a href="../<?= $daftar['akta'] ?>" download class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i> Unduh
                                            </a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($daftar['kk'] != null) { ?>
                                            <a href="../<?= $daftar['kk'] ?>" target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Preview
                                            </a>
                                            <a href="../<?= $daftar['kk'] ?>" download class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i> Unduh
                                            </a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($daftar['ktp_ortu'] != null) { ?>
                                            <a href="../<?= $daftar['ktp_ortu'] ?>" target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Preview
                                            </a>
                                            <a href="../<?= $daftar['ktp_ortu'] ?>" download class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i> Unduh
                                            </a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($daftar['kps_pkh'] != null) { ?>
                                            <a href="../<?= $daftar['kps_pkh'] ?>" target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Preview
                                            </a>
                                            <a href="../<?= $daftar['kps_pkh'] ?>" download class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i> Unduh
                                            </a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($daftar['ijazah'] != null) { ?>
                                            <a href="../<?= $daftar['ijazah'] ?>" target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Preview
                                            </a>
                                            <a href="../<?= $daftar['ijazah'] ?>" download class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i> Unduh
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>

                            <?php }
                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>