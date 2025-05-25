<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<!-- Modal -->


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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT daftar.*, formulir.* 
                                FROM daftar 
                                INNER JOIN formulir ON daftar.id_daftar = formulir.no_daftar ");
                            $no = 0;
                            while ($daftar = mysqli_fetch_array($query)) {
                                $no++;
                                $bayar = mysqli_fetch_array(mysqli_query($koneksi, "select sum(jumlah) as total from bayar where id_daftar='$daftar[id_daftar]' "));
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>

                                    <td><?= $daftar['nama'] ?></td>
                                    <td><?= $daftar['asal_sekolah'] ?></td>

                                    <td>
                                        <?php if ($daftar['akta'] <> null) { ?><a data-toggle="tooltip" data-placement="top" title="" data-original-title="Akte Kelahiran" href="../<?= $daftar['akta'] ?>" class="btn btn-sm btn-success">Lihat Disini</a><?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($daftar['kk'] <> null) { ?><a data-toggle="tooltip" data-placement="top" title="" data-original-title="Kartu Keluarga" href="../<?= $daftar['kk'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-address-card    "></i></a><?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($daftar['ktp_ortu'] <> null) { ?> <a data-toggle="tooltip" data-placement="top" title="" data-original-title="KTP Orang Tua" href="../<?= $daftar['ktp_ortu'] ?>" class="btn btn-sm btn-warning"><i class="far fa-address-card    "></i></a><?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($daftar['kps_pkh'] <> null) { ?><a data-toggle="tooltip" data-placement="top" title="" data-original-title="KPS/PKH (Jika Ada)" href="../<?= $daftar['kps_pkh'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-envelope    "></i></a><?php } ?>
                                    </td>
                                    <td>
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