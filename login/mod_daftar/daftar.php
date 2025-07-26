<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<!-- Modal -->
<!-- <div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-tambah">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Pendaftar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jenis">JENIS PENDAFTARAN</label>
                        <select class="form-control" name="jenis" id="jenis">
                            <option value="1">Siswa Baru</option>
                            <option value="2">Pindahan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>NISN</label>
                        <input type="text" name="nisn" class="form-control nisn" required="">
                    </div>
                    <div class="form-group">
                        <label>Nama Pendaftar</label>
                        <input type="text" name="nama" class="form-control" required="">
                    </div>

                    <div class="form-group">
                        <label for="asal">Asal Sekolah</label>
                        <select class="form-control" style="width: 100%" name="asal" id="asal" required>
                            <option value="">Pilih Asal Sekolah</option>
                            <?php
                            $query = mysqli_query($koneksi, "select * from sekolah where status='1'");
                            while ($sekolah = mysqli_fetch_array($query)) {
                            ?>
                                <option value="<?= $sekolah['npsn'] ?>"><?= $sekolah['nama_sekolah'] ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Pilihan Jurusan</label>
                        <select class="form-control" name="jurusan" id="jurusan" required>
                            <option value="">Pilih Jurusan</option>
                            <?php
                            $query = mysqli_query($koneksi, "select * from jurusan where status='1'");
                            while ($jurusan = mysqli_fetch_array($query)) {
                            ?>
                                <option value="<?= $jurusan['id_jurusan'] ?>"><?= $jurusan['id_jurusan'] ?> <?= $jurusan['nama_jurusan'] ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword4">PASSWORD (Mohon Diingat!)</label>
                        <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="nohp" class="form-control nohp" required="">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<div class="modal fade" id="hapusdata" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-konfirmasi">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data Pendaftar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    Terdapat <b><?= rowcount($koneksi, 'daftar') ?></b> Jumlah data Pendaftar Akan Di Hapus.


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Hapus Semua</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="importdata" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-import">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Import File Excel</label>
                        <input type="file" class="form-control-file" name="file" id="file" placeholder="" aria-describedby="helpfile" required>
                        <small id="helpfile" class="form-text text-muted">File harus .xls</small>
                    </div>

                    <p><a href="template_excel/importdaftar.xls">Download Format</a></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Pendaftar</h4>

                <div class="card-header-action">
                    <a class="btn btn-primary" href="mod_daftar/export_excel.php" role="button"> Download Excel</a>
                    <!-- <button type="button" class="btn btn-icon icon-left btn-info" data-toggle="modal" data-target="#tambahdata">
                        <i class="far fa-edit"></i> Tambah Data
                    </button> -->
                    <!--<button type="button" class="btn btn-danger m-b-5" data-toggle="modal" data-target="#importdata"><i class="sidebar-item-icon fa fa-upload"></i>
					Import Data
					</button>-->
                    <!-- <button type="button" class="btn btn-icon icon-left btn-warning" data-toggle="modal" data-target="#hapusdata">
                        <i class="fa fa-trash"></i> Hapus Data
                    </button> -->

                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    No
                                </th>
                                <th>NIK</th>
                                <th>Nama Pendaftar</th>
                                <th>Asal Sekolah</th>
                                <th>No Hp</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id_tahun_aktif = $tahunAktif['tahun'];
                            $query = mysqli_query($koneksi, "SELECT daftar.*, formulir.* 
                                FROM daftar 
                                INNER JOIN formulir ON daftar.id_daftar = formulir.no_daftar where (status IS NULL OR status = 0) AND formulir.tahun_ajaran = '$id_tahun_aktif'");
                            $no = 0;
                            while ($daftar = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $daftar['nomor_induk'] ?></td>
                                    <td><?= $daftar['nama_siswa'] ?></td>
                                    <td><?= $daftar['sekolah_asal'] ?></td>
                                    <td>
                                        <i class="fab fa-whatsapp text-success   "></i>
                                        <a target="_blank" href="https://api.whatsapp.com/send?phone=62<?= $daftar['no_hp'] ?>&text=Terima%20kasih%20sudah%20mendaftar%20di%20MI%20Condong%2C%0AHarap%20segera%20melunasi%20pembayaran.%20%28abaikan%20jika%20sudah%20lunas%29%0ASilahkan%20login%20dan%20lengkapi%20data%20formulirnya.%20%0Ausername%20%3A%20%2A<?= $daftar['nisn'] ?>%2A%0Apassword%20%3A%20%2A<?= $daftar['password'] ?>%2A">
                                            <?= $daftar['no_hp'] ?></a>
                                    </td>

                                    <td>
                                        <?php if ($daftar['status'] == 1) { ?>
                                            <span class="badge badge-success">Diterima</span>
                                        <?php } elseif ($daftar['status'] == 2) { ?>
                                            <span class="badge badge-danger">Dicadangkan </span>
                                        <?php } else { ?>
                                            <span class="badge badge-warning">Diverifikasi</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Formulir siswa" href="?pg=ubahdaftar&id=<?= enkripsi($daftar['id_daftar']) ?>" class="btn btn-sm btn-info"><i class="fas fa-book    "></i></a>
                                        <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Berkas Siswa" href="?pg=berkas_ppdb&id=<?= enkripsi($daftar['id_daftar']) ?>" class="btn btn-sm btn-warning"><i class="fas fa-file    "></i></a>
                                        <!-- Button trigger modal -->
                                        <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Cetak" href="mod_daftar/print_daftar.php?id=<?= enkripsi($daftar['id_daftar']) ?>" class="btn btn-sm btn-success"><i class="fas fa-print    "></i></a>
                                        <!-- Button trigger modal -->
                                        <span data-toggle="tooltip" title="Verifikasi">
                                            <button type="button" class="btn btn-sm btn-primary"
                                                data-toggle="modal"
                                                data-target="#modal-edit<?= $no ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </span>

                                        <span data-toggle="tooltip" title="Hapus">
                                            <button data-id="<?= $daftar['id_daftar'] ?>" class="hapus btn-sm btn btn-danger"><i class="fas fa-trash    "></i></button>
                                        </span>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-edit<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form id="form-edit<?= $no ?>">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <input type="hidden" value="<?= $daftar['id_daftar'] ?>" name="id_daftar" class="form-control" required="">

                                                            <div class="form-group">
                                                                <label>Username</label>
                                                                <input type="text" value="<?= $daftar['nisn'] ?>" name="nisn" class="form-control nisn" required="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nama Siswa</label>
                                                                <input type="text" value="<?= $daftar['nama'] ?>" name="nama" class="form-control" required="">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Tempat Lahir</label>
                                                                <input type="text" value="<?= $daftar['tempat_lahir'] ?>" name="tempat_lahir" class="form-control" required="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tanggal Lahir</label>
                                                                <input type="date" value="<?= $daftar['tanggal_lahir'] ?>" name="tgl_lahir" class="form-control" required="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>No HP</label>
                                                                <input type="number" value="<?= $daftar['no_hp'] ?>" name="no_hp" class="form-control" required="">
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="control-label">Pilih Status</div>
                                                                <div class="custom-switches-stacked mt-2">
                                                                    <label class="custom-switch">
                                                                        <input type="radio" name="status" value="0" class="custom-switch-input" <?= $daftar['status'] == 0 ? 'checked' : '' ?>>
                                                                        <span class="custom-switch-indicator"></span>
                                                                        <span class="custom-switch-description">Diverifikasi</span>
                                                                    </label>
                                                                    <label class="custom-switch">
                                                                        <input type="radio" name="status" value="1" class="custom-switch-input" <?= $daftar['status'] == 1 ? 'checked' : '' ?>>
                                                                        <span class="custom-switch-indicator"></span>
                                                                        <span class="custom-switch-description">Diterima</span>
                                                                    </label>
                                                                    <label class="custom-switch">
                                                                        <input type="radio" name="status" value="2" class="custom-switch-input" <?= $daftar['status'] == 2 ? 'checked' : '' ?>>
                                                                        <span class="custom-switch-indicator"></span>
                                                                        <span class="custom-switch-description">Ditolak / Revisi </span>
                                                                    </label>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <script>
                                    $('#form-edit<?= $no ?>').submit(function(e) {
                                        e.preventDefault();
                                        $.ajax({
                                            type: 'POST',
                                            url: 'mod_daftar/crud_daftar.php?pg=status',
                                            data: $(this).serialize(),
                                            success: function(data) {

                                                iziToast.success({
                                                    title: 'OKee!',
                                                    message: 'Status Berhasil diubah',
                                                    position: 'topRight'
                                                });
                                                setTimeout(function() {
                                                    window.location.reload();
                                                }, 2000);
                                                $('#modal-edit<?= $no ?>').modal('hide');
                                                //$('#bodyreset').load(location.href + ' #bodyreset');
                                            }
                                        });
                                        return false;
                                    });
                                </script>
                                <script>
                                    $('#form-nilai<?= $no ?>').submit(function(e) {
                                        e.preventDefault();
                                        $.ajax({
                                            type: 'POST',
                                            url: 'mod_daftar/crud_daftar.php?pg=nilai',
                                            data: $(this).serialize(),
                                            success: function(data) {

                                                iziToast.success({
                                                    title: 'OKee!',
                                                    message: 'Nilai Berhasil ditambah',
                                                    position: 'topRight'
                                                });
                                                setTimeout(function() {
                                                    window.location.reload();
                                                }, 2000);
                                                $('#modal-edit<?= $no ?>').modal('hide');
                                                //$('#bodyreset').load(location.href + ' #bodyreset');
                                            }
                                        });
                                        return false;
                                    });
                                </script>
                            <?php }
                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    //IMPORT FILE PENDUKUNG 
    $('#form-import').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'mod_siswa/crud_siswa.php?pg=import2',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('form button').on("click", function(e) {
                    e.preventDefault();
                });
            },
            success: function(data) {

                $('#importdata').modal('hide');
                iziToast.success({
                    title: 'Mantap!',
                    message: data,
                    position: 'topRight'
                });
                setTimeout(function() {
                    window.location.reload();
                }, 2000);


            }
        });
    });
    var cleaveI = new Cleave('.nisn', {

        blocks: [10]

    });
    var cleaveI = new Cleave('.nohp', {
        blocks: [4, 4, 4, 5]
    });
    $('#form-tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'mod_daftar/crud_daftar.php?pg=tambah',
            data: $(this).serialize(),
            beforeSend: function() {
                $('form button').on("click", function(e) {
                    e.preventDefault();
                });
            },
            success: function(data) {

                iziToast.success({
                    title: 'Mantap!',
                    message: 'data berhasil disimpan',
                    position: 'topRight'
                });
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
                $('#tambahdata').modal('hide');
                //$('#bodyreset').load(location.href + ' #bodyreset');
            }
        });
        return false;
    });

    $('#table-1').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Are you sure?',
            text: 'Akan menghapus data ini!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: 'mod_daftar/crud_daftar.php?pg=hapus',
                    method: "POST",
                    data: 'id_daftar=' + id,
                    success: function(data) {
                        iziToast.error({
                            title: 'Horee!',
                            message: 'Data Berhasil dihapus',
                            position: 'topRight'
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
        })

    });
</script>
<script>
    $('#form-konfirmasi').submit(function(e) {
        e.preventDefault();
        swal({
            title: 'Apa kamu yakin ?',
            text: 'Akan Menghapus data anda ?',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: 'mod_daftar/crud_daftar.php?pg=konfirmasi',
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        iziToast.success({
                            title: 'Terimakasih!',
                            message: 'Data Berhasil di Hapus',
                            position: 'topRight'
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    }
                });
            }
        })

    });
</script>