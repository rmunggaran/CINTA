<!-- <div class="section-header">
    <h3>Detail Pendaftar</h3>
</div> -->
<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php $siswa = fetch($koneksi, 'formulir', ['no_daftar' => dekripsi($_GET['id'])]); ?>
<?php $data = fetch($koneksi, 'daftar', ['id_daftar' => dekripsi($_GET['id'])]); ?>
<div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card author-box card-primary">
            <div class="card-header">
                <h4>Data Pendaftar</h4>
                <div class="card-header-action">
                    <a target="_blank" href="mod_daftar/print_daftar.php?id=<?= $_GET['id'] ?>" type="button" class="btn btn-success"><i class="fas fa-print    "></i> Cetak Form</a>
                    <a target="_blank" href="mod_daftar/pernyataan.php?id=<?= $_GET['id'] ?>" type="button" class="btn btn-success"><i class="fas fa-print    "></i> Surat Pernyataan</a>
                </div>

            </div>
            <div class="card-body">
                <div class="author-box-left">
                    <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle author-box-picture">
                    <div class="clearfix"></div>
                    <br>
                    <div class="author-box-job">Status Pendaftaran</div>
                    <?php if ($data['status'] == 1) { ?>
                        <span class="badge badge-success">Diterima</span>
                    <?php } else { ?>
                        <span class="badge badge-success">Diverifikasi</span>
                    <?php } ?>
                </div>
                <div class="author-box-details">
                    <?php if (!$siswa) { ?>
                        <div style='padding:10px; background:#ffe0e0; border:1px solid red; color:red;'>
                            Formulir belum diisi.
                        </div>
                    <?php } else { ?>

                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-user    "></i> Data Diri</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-user-friends    "></i> Orang Tua</a>
                            </li>
                            <!--   <li class="nav-item">
                            <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-history    "></i> Histori</a>
                        </li> -->
                        </ul>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                                <div class="table-responsiv">
                                    <table class="table table-striped table-sm ">
                                        <tbody>
                                            <!-- <tr>
                                            <td align="right"><b>NISN</b></td>
                                            <td align="left"></td>
                                        </tr> -->
                                            <tr>
                                                <td><b>Nomor Pendaftaran</b></td>
                                                <td><?= htmlspecialchars($siswa['no_pendaftaran']) ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Kategori</b></td>
                                                <td><?= htmlspecialchars($siswa['kategori']) ?></td>
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
                                <div class="table-responsiv">
                                    <table class="table table-striped table-sm ">
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

                                            <!-- DATA LENGKAP WALI -->
                                            <tr>
                                                <td align="center" colspan="2"><i class="fas fa-user-friends"></i> <b>Data Lengkap Wali</b></td>
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
                                Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor.
                            </div>
                        </div>

                        <div class="w-100 d-sm-none"></div>
                        <div class="float-right mt-sm-0 mt-3">
                            <a href="#" class="btn">View Posts <i class="fas fa-chevron-right"></i></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>