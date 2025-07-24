<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php $siswa = fetch($koneksi, 'daftar', ['id_daftar' => dekripsi($_GET['id'])]); ?>
<?php $formulir = fetch($koneksi, 'formulir', ['no_daftar' => dekripsi($_GET['id'])]); ?>

<div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card author-box card-primary">
            <div class="card-header">
                <h4>Data diri Siswa</h4>
                <div class="card-header-action">
                    <a target="_blank" href="mod_daftar/print_daftar.php?id=<?= $_GET['id'] ?>" type="button" class="btn btn-success"><i class="fas fa-print    "></i> Cetak Form</a>

                </div>
            </div>
            <div class="card-body">
                <div class="author-box-left">
                    <!-- <img alt="image" src="../<?= $siswa['foto'] ?>" class="rounded-circle author-box-picture"> -->
                    <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle author-box-picture">
                    <div class="clearfix"></div>
                    <br>
                    <div class="author-box-job">Status Siswa</div>
                    <?php if ($siswa['status'] == 1) { ?>
                        <span class="badge badge-success">Aktif</span>
                    <?php } else { ?>
                        <span class="badge badge-danger">Tidak Aktif</span>
                    <?php } ?>
                </div>

                <div class="author-box-details">
                    <?php if (!$formulir) { ?>
                        <div style='padding:10px; background:#ffe0e0; border:1px solid red; color:red;'>
                            Formulir belum diisi.
                        </div>
                    <?php } else { ?>

                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item col-sm-12 col-md-3">
                                <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-user    "></i> Data Diri</a>
                            </li>
                            <li class="nav-item col-sm-12 col-md-3">
                                <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-user-friends    "></i> Orang Tua</a>
                            </li>


                        </ul>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">

                                <form id="form-datadiri">
                                    <input type="hidden" name="no_daftar" value="<?php echo $formulir['no_daftar'] ?>">
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No Pendaftaran</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="no_pendaftaran" class="form-control" value="<?= $formulir['no_pendaftaran'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tahun Ajaran</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class='form-control' id="tahun_ajaran" name="tahun_ajaran" required>
                                                <option value="">-- Pilih Tahun Ajaran --</option>
                                                <?php $qu = mysqli_query($koneksi, "select * from tahun_ajaran");
                                                while ($tahun = mysqli_fetch_array($qu)) {
                                                ?>
                                                    <option value="<?php echo $tahun['tahun']; ?>" <?= ($formulir['tahun_ajaran'] == $tahun['tahun']) ? 'selected' : '' ?>><?php echo $tahun['tahun']; ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Pendidikan</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class='form-control' id="kategori" name="kategori" required>
                                                <option value="">-- Pilih Jenis Pendidikan --</option>
                                                <?php $qu = mysqli_query($koneksi, "select * from jurusan");
                                                while ($jur = mysqli_fetch_array($qu)) {
                                                ?>
                                                    <option value="<?php echo $jur['id_jurusan']; ?>" <?= (isset($formulir['kategori']) && $formulir['kategori'] == $jur['id_jurusan']) ? 'selected' : '' ?>><?php echo $jur['nama_jurusan']; ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="nama_siswa" class="form-control" value="<?= $formulir['nama_siswa'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIK</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="nomor_induk" class="form-control" value="<?= $formulir['nomor_induk'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Kelamin:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class='form-control' id="jenis_kelamin" name="jenis_kelamin" required>
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="Laki-laki" <?= (isset($formulir['jenis_kelamin']) && $formulir['jenis_kelamin'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                                                <option value="Perempuan" <?= (isset($formulir['jenis_kelamin']) && $formulir['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tempat Lahir:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="tempat_lahir" class="form-control" value="<?= $formulir['tempat_lahir'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Lahir</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="date" name="tanggal_lahir" class="form-control" value="<?= $formulir['tanggal_lahir'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Anak Ke:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="number" name="anak_ke" class="form-control" value="<?= $formulir['anak_ke'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah Saudara:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="number" name="jumlah_saudara" class="form-control" value="<?= $formulir['jumlah_saudara'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status dalam Keluarga:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="status_keluarga" class="form-control" value="<?= $formulir['status_keluarga'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat Rumah:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="alamat_rumah" class="form-control" value="<?= $formulir['alamat_rumah'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat Sekarang:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="alamat_sekarang" class="form-control" value="<?= $formulir['alamat_sekarang'] ?>">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kelas Diterima:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="kelas_diterima" class="form-control" value="<?= $formulir['kelas_diterima'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Diterima:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="tanggal_diterima" class="form-control" value="<?= $formulir['tanggal_diterima'] ?>">
                                        </div>
                                    </div> -->
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sekolah Asal:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="sekolah_asal" class="form-control" value="<?= $formulir['sekolah_asal'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat Sekolah Asal:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="alamat_sekolah_asal" class="form-control" value="<?= $formulir['alamat_sekolah_asal'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">STTB Tahun:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="sttb_tahun" class="form-control" value="<?= $formulir['sttb_tahun'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">STTB Nomor:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="sttb_nomor" class="form-control" value="<?= $formulir['sttb_nomor'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p>*Harap isi data alamat dengan sebenar-benarnya</p>
                                        <center><button id="btnsimpan" type="submit" class="btn btn-primary btn-lg mt-2">Simpan Data Diri</button></center>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                <form id="form-orangtua">
                                    <input type="hidden" name="no_daftar" value="<?php echo $formulir['no_daftar'] ?>">

                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Ayah</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="nama_ayah" class="form-control" value="<?= $formulir['nama_ayah'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Ibu</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="nama_ibu" class="form-control" value="<?= $formulir['nama_ibu'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Agama Orang Tua:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="agama_ortu" class="form-control" value="<?= $formulir['agama_ortu'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat Orang Tua:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="alamat_ortu" class="form-control" value="<?= $formulir['alamat_ortu'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pekerjaan Ayah:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class='form-control' id="pekerjaan_ayah" name="pekerjaan_ayah" required>
                                                <option value="">-- Pilih Pekerjaan Ayah --</option>
                                                <option value="PNS" <?= (isset($formulir['pekerjaan_ayah']) && $formulir['pekerjaan_ayah'] == 'PNS') ? 'selected' : '' ?>>A. PNS</option>
                                                <option value="TNI/POLRI" <?= (isset($formulir['pekerjaan_ayah']) && $formulir['pekerjaan_ayah'] == 'TNI/POLRI') ? 'selected' : '' ?>>B. TNI/POLRI</option>
                                                <option value="Guru/Dosen" <?= (isset($formulir['pekerjaan_ayah']) && $formulir['pekerjaan_ayah'] == 'Guru/Dosen') ? 'selected' : '' ?>>C. Guru/Dosen</option>
                                                <option value="Dokter" <?= (isset($formulir['pekerjaan_ayah']) && $formulir['pekerjaan_ayah'] == 'Dokter') ? 'selected' : '' ?>>D. Dokter</option>
                                                <option value="Politikus" <?= (isset($formulir['pekerjaan_ayah']) && $formulir['pekerjaan_ayah'] == 'Politikus') ? 'selected' : '' ?>>E. Politikus</option>
                                                <option value="Pegawai Swasta" <?= (isset($formulir['pekerjaan_ayah']) && $formulir['pekerjaan_ayah'] == 'Pegawai Swasta') ? 'selected' : '' ?>>F. Pegawai Swasta</option>
                                                <option value="Wiraswasta/Pedagang" <?= (isset($formulir['pekerjaan_ayah']) && $formulir['pekerjaan_ayah'] == 'Wiraswasta/Pedagang') ? 'selected' : '' ?>>G. Wiraswasta/Pedagang</option>
                                                <option value="Petani/Peternak" <?= (isset($formulir['pekerjaan_ayah']) && $formulir['pekerjaan_ayah'] == 'Petani/Peternak') ? 'selected' : '' ?>>H. Petani/Peternak</option>
                                                <option value="Seni/Lukis/Artis/Sejenis" <?= (isset($formulir['pekerjaan_ayah']) && $formulir['pekerjaan_ayah'] == 'Seni/Lukis/Artis/Sejenis') ? 'selected' : '' ?>>I. Seni/Lukis/Artis/Sejenis</option>
                                                <option value="Buruh" <?= (isset($formulir['pekerjaan_ayah']) && $formulir['pekerjaan_ayah'] == 'Buruh') ? 'selected' : '' ?>>J. Buruh</option>
                                                <option value="IRT" <?= (isset($formulir['pekerjaan_ayah']) && $formulir['pekerjaan_ayah'] == 'IRT') ? 'selected' : '' ?>>K. IRT</option>
                                                <option value="Lainnya" <?= (isset($formulir['pekerjaan_ayah']) && $formulir['pekerjaan_ayah'] == 'Lainnya') ? 'selected' : '' ?>>L. Lainnya</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pekerjaan Ibu:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class='form-control' id="pekerjaan_ibu" name="pekerjaan_ibu" required>
                                                <option value="">-- Pilih Pekerjaan Ibu --</option>
                                                <option value="PNS" <?= (isset($formulir['pekerjaan_ibu']) && $formulir['pekerjaan_ibu'] == 'PNS') ? 'selected' : '' ?>>A. PNS</option>
                                                <option value="TNI/POLRI" <?= (isset($formulir['pekerjaan_ibu']) && $formulir['pekerjaan_ibu'] == 'TNI/POLRI') ? 'selected' : '' ?>>B. TNI/POLRI</option>
                                                <option value="Guru/Dosen" <?= (isset($formulir['pekerjaan_ibu']) && $formulir['pekerjaan_ibu'] == 'Guru/Dosen') ? 'selected' : '' ?>>C. Guru/Dosen</option>
                                                <option value="Dokter" <?= (isset($formulir['pekerjaan_ibu']) && $formulir['pekerjaan_ibu'] == 'Dokter') ? 'selected' : '' ?>>D. Dokter</option>
                                                <option value="Politikus" <?= (isset($formulir['pekerjaan_ibu']) && $formulir['pekerjaan_ibu'] == 'Politikus') ? 'selected' : '' ?>>E. Politikus</option>
                                                <option value="Pegawai Swasta" <?= (isset($formulir['pekerjaan_ibu']) && $formulir['pekerjaan_ibu'] == 'Pegawai Swasta') ? 'selected' : '' ?>>F. Pegawai Swasta</option>
                                                <option value="Wiraswasta/Pedagang" <?= (isset($formulir['pekerjaan_ibu']) && $formulir['pekerjaan_ibu'] == 'Wiraswasta/Pedagang') ? 'selected' : '' ?>>G. Wiraswasta/Pedagang</option>
                                                <option value="Petani/Peternak" <?= (isset($formulir['pekerjaan_ibu']) && $formulir['pekerjaan_ibu'] == 'Petani/Peternak') ? 'selected' : '' ?>>H. Petani/Peternak</option>
                                                <option value="Seni/Lukis/Artis/Sejenis" <?= (isset($formulir['pekerjaan_ibu']) && $formulir['pekerjaan_ibu'] == 'Seni/Lukis/Artis/Sejenis') ? 'selected' : '' ?>>I. Seni/Lukis/Artis/Sejenis</option>
                                                <option value="Buruh" <?= (isset($formulir['pekerjaan_ibu']) && $formulir['pekerjaan_ibu'] == 'Buruh') ? 'selected' : '' ?>>J. Buruh</option>
                                                <option value="IRT" <?= (isset($formulir['pekerjaan_ibu']) && $formulir['pekerjaan_ibu'] == 'IRT') ? 'selected' : '' ?>>K. IRT</option>
                                                <option value="Lainnya" <?= (isset($formulir['pekerjaan_ibu']) && $formulir['pekerjaan_ibu'] == 'Lainnya') ? 'selected' : '' ?>>L. Lainnya</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pendidikan Ayah:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class='form-control' id="pendidikan_ayah" name="pendidikan_ayah" required>
                                                <option value="">-- Pilih Pendidikan Ayah --</option>
                                                <option value="Tidak Tamat SD/MI/Paket A" <?= (isset($formulir['pendidikan_ayah']) && $formulir['pendidikan_ayah'] == 'Tidak Tamat SD/MI/Paket A') ? 'selected' : '' ?>>A. Tidak Tamat SD/MI/Paket A</option>
                                                <option value="SD/MI/Paket A" <?= (isset($formulir['pendidikan_ayah']) && $formulir['pendidikan_ayah'] == 'SD/MI/Paket A') ? 'selected' : '' ?>>B. SD/MI/Paket A</option>
                                                <option value="SMP/MTs/Paket B" <?= (isset($formulir['pendidikan_ayah']) && $formulir['pendidikan_ayah'] == 'SMP/MTs/Paket B') ? 'selected' : '' ?>>C. SMP/MTs/Paket B</option>
                                                <option value="SMA/MA/SMK/Paket C" <?= (isset($formulir['pendidikan_ayah']) && $formulir['pendidikan_ayah'] == 'SMA/MA/SMK/Paket C') ? 'selected' : '' ?>>D. SMA/MA/SMK/Paket C</option>
                                                <option value="Diploma I/II" <?= (isset($formulir['pendidikan_ayah']) && $formulir['pendidikan_ayah'] == 'Diploma I/II') ? 'selected' : '' ?>>E. Diploma I/II</option>
                                                <option value="Diploma III/IV" <?= (isset($formulir['pendidikan_ayah']) && $formulir['pendidikan_ayah'] == 'Diploma III/IV') ? 'selected' : '' ?>>F. Diploma III/IV</option>
                                                <option value="S1 (Sarjana)" <?= (isset($formulir['pendidikan_ayah']) && $formulir['pendidikan_ayah'] == 'S1 (Sarjana)') ? 'selected' : '' ?>>G. S1 (Sarjana)</option>
                                                <option value="S2 (Magister)" <?= (isset($formulir['pendidikan_ayah']) && $formulir['pendidikan_ayah'] == 'S2 (Magister)') ? 'selected' : '' ?>>H. S2 (Magister)</option>
                                                <option value="S3 (Doktor)" <?= (isset($formulir['pendidikan_ayah']) && $formulir['pendidikan_ayah'] == 'S3 (Doktor)') ? 'selected' : '' ?>>I. S3 (Doktor)</option>
                                                <option value="Lainnya" <?= (isset($formulir['pendidikan_ayah']) && $formulir['pendidikan_ayah'] == 'Lainnya') ? 'selected' : '' ?>>J. Lainnya</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pendidikan Ibu:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class='form-control' id="pendidikan_ibu" name="pendidikan_ibu" required>
                                                <option value="">-- Pilih Pendidikan Ayah --</option>
                                                <option value="Tidak Tamat SD/MI/Paket A" <?= (isset($formulir['pendidikan_ibu']) && $formulir['pendidikan_ibu'] == 'Tidak Tamat SD/MI/Paket A') ? 'selected' : '' ?>>A. Tidak Tamat SD/MI/Paket A</option>
                                                <option value="SD/MI/Paket A" <?= (isset($formulir['pendidikan_ibu']) && $formulir['pendidikan_ibu'] == 'SD/MI/Paket A') ? 'selected' : '' ?>>B. SD/MI/Paket A</option>
                                                <option value="SMP/MTs/Paket B" <?= (isset($formulir['pendidikan_ibu']) && $formulir['pendidikan_ibu'] == 'SMP/MTs/Paket B') ? 'selected' : '' ?>>C. SMP/MTs/Paket B</option>
                                                <option value="SMA/MA/SMK/Paket C" <?= (isset($formulir['pendidikan_ibu']) && $formulir['pendidikan_ibu'] == 'SMA/MA/SMK/Paket C') ? 'selected' : '' ?>>D. SMA/MA/SMK/Paket C</option>
                                                <option value="Diploma I/II" <?= (isset($formulir['pendidikan_ibu']) && $formulir['pendidikan_ibu'] == 'Diploma I/II') ? 'selected' : '' ?>>E. Diploma I/II</option>
                                                <option value="Diploma III/IV" <?= (isset($formulir['pendidikan_ibu']) && $formulir['pendidikan_ibu'] == 'Diploma III/IV') ? 'selected' : '' ?>>F. Diploma III/IV</option>
                                                <option value="S1 (Sarjana)" <?= (isset($formulir['pendidikan_ibu']) && $formulir['pendidikan_ibu'] == 'S1 (Sarjana)') ? 'selected' : '' ?>>G. S1 (Sarjana)</option>
                                                <option value="S2 (Magister)" <?= (isset($formulir['pendidikan_ibu']) && $formulir['pendidikan_ibu'] == 'S2 (Magister)') ? 'selected' : '' ?>>H. S2 (Magister)</option>
                                                <option value="S3 (Doktor)" <?= (isset($formulir['pendidikan_ibu']) && $formulir['pendidikan_ibu'] == 'S3 (Doktor)') ? 'selected' : '' ?>>I. S3 (Doktor)</option>
                                                <option value="Lainnya" <?= (isset($formulir['pendidikan_ibu']) && $formulir['pendidikan_ibu'] == 'Lainnya') ? 'selected' : '' ?>>J. Lainnya</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Penghasilan Perbulan:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class='form-control' id="penghasilan" name="penghasilan" required>
                                                <option value="">-- Pilih Penghasi Perbulan --</option>
                                                <option value="Kurang dari Rp.500.000" <?= (isset($formulir['penghasilan']) && $formulir['penghasilan'] == 'Kurang dari Rp.500.000') ? 'selected' : '' ?>>Kurang dari Rp.500.000</option>
                                                <option value="Rp.500.001 s/d Rp.1.000.000" <?= (isset($formulir['penghasilan']) && $formulir['penghasilan'] == 'Rp.500.001 s/d Rp.1.000.000') ? 'selected' : '' ?>>Rp.500.001 s/d Rp.1.000.000</option>
                                                <option value="Rp.1.000.001 s/d Rp.3.000.000" <?= (isset($formulir['penghasilan']) && $formulir['penghasilan'] == 'Rp.1.000.001 s/d Rp.3.000.000') ? 'selected' : '' ?>>Rp.1.000.001 s/d Rp.3.000.000</option>
                                                <option value="Rp.3.000.001 s/d Rp.5.000.000" <?= (isset($formulir['penghasilan']) && $formulir['penghasilan'] == 'Rp.3.000.001 s/d Rp.5.000.000') ? 'selected' : '' ?>>Rp.3.000.001 s/d Rp.5.000.000</option>
                                                <option value="Lebih dari Rp.5.000.001" <?= (isset($formulir['penghasilan']) && $formulir['penghasilan'] == 'Lebih dari Rp.5.000.001') ? 'selected' : '' ?>>Lebih dari Rp.5.000.001</option>
                                            </select>
                                        </div>

                                    </div>

                                    <h5><i class="fas fa-user-check    "></i> Data Lengkap wali</h5>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Wali:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="nama_wali" class="form-control" value="<?= $formulir['nama_wali'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Agama Wali:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="agama_wali" class="form-control" value="<?= $formulir['agama_wali'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat Wali:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="alamat_wali" class="form-control" value="<?= $formulir['alamat_wali'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pendidikan Wali:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="pendidikan_wali" class="form-control" value="<?= $formulir['pendidikan_wali'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pekerjaan Wali:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="pekerjaan_wali" class="form-control" value="<?= $formulir['pekerjaan_wali'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p>*Harap isi data orang tua dengan sebenar-benarnya</p>
                                        <center><button id="btnsimpan" type="submit" class="btn btn-primary btn-lg mt-2">Simpan Data Orang Tua</button></center>
                                    </div>
                                </form>
                            </div>


                        </div>


                    <?php } ?>
                </div>

            </div>
        </div>
    </div>

</div>


<script>
    $('.form-control').keyup(function(event) {

        $(this).val($(this).val().toUpperCase());
    });
    $(document).ready(function() {
        $('#form-datadiri').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'mod_daftar/crud_daftar.php?pg=simpandatadiri',
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#btnsimpan').prop('disabled', true);
                },
                success: function(data) {
                    var json = data;
                    $('#btnsimpan').prop('disabled', false);
                    if (data == 'ok') {
                        iziToast.success({
                            title: 'Terima Kasih!',
                            message: 'Data Diri Anda berhasil disimpan',
                            position: 'topCenter'
                        });

                    } else {
                        iziToast.error({
                            title: 'Maaf!',
                            message: json,
                            position: 'topCenter'
                        });
                    }
                    $('#bodyreset').load(location.href + ' #bodyreset');
                }
            });
            return false;
        });
        $('#form-alamat').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'mod_daftar/crud_daftar.php?pg=simpanalamat',
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#btnsimpan').prop('disabled', true);
                },
                success: function(data) {
                    var json = data;
                    $('#btnsimpan').prop('disabled', false);
                    if (data == 'ok') {
                        iziToast.success({
                            title: 'Terima Kasih!',
                            message: 'Data Alamat anda berhasil disimpan',
                            position: 'topCenter'
                        });

                    } else {
                        iziToast.error({
                            title: 'Maaf!',
                            message: json,
                            position: 'topCenter'
                        });
                    }
                    $('#bodyreset').load(location.href + ' #bodyreset');
                }
            });
            return false;
        });
        $('#form-orangtua').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'mod_daftar/crud_daftar.php?pg=simpanortu',
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#btnsimpan').prop('disabled', true);
                },
                success: function(data) {
                    var json = data;
                    $('#btnsimpan').prop('disabled', false);
                    if (data == 'ok') {
                        iziToast.success({
                            title: 'Terima Kasih!',
                            message: 'Data Orang Tua anda berhasil disimpan',
                            position: 'topCenter'
                        });

                    } else {
                        iziToast.error({
                            title: 'Maaf!',
                            message: json,
                            position: 'topCenter'
                        });
                    }
                    //$('#bodyreset').load(location.href + ' #bodyreset');
                }
            });
            return false;
        });
        // $("#form-datadiri").validate({
        //     rules: {
        //         "b[firstname]": {
        //             : true
        //         },
        //         "b[email]": {
        //             : true,
        //             email: true
        //         },
        //         "book[contact]": {
        //             : true
        //         }
        //     },
        //     submitHandler: function(form) {
        //         var formData = $(form).serialize();
        //         alert(formData); // for demo
        //         // comment out ajax for demo
        //         /*
        //         $.ajax({
        //             url: "bs_client_function.php?action=new_b",
        //             type: "post",
        //             data: formData,
        //             beforeSend: function () {

        //             },
        //             success: function (data) {

        //             }
        //         });
        //         */
        //     }
        // });

    });
</script>