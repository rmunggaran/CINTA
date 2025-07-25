<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Pendaftar Yang sudah daftar ulang</h4>
                <div class="card-header-action">
                    <a class="btn btn-primary" href="mod_daftar/export_dfulang.php" role="button"> Download Excel</a>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>NIK</th>
                                <th>Nama Pendaftar</th>
                                <th>Tanggal Konfirmasi</th>
                                <th>Status</th>
                                <th>kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id_tahun_aktif = $tahunAktif['tahun'];
                            $query = mysqli_query($koneksi, "SELECT daftar.*, formulir.* 
                                FROM daftar 
                                INNER JOIN formulir ON daftar.id_daftar = formulir.no_daftar where konfirmasi='1' AND formulir.tahun_ajaran = '$id_tahun_aktif'");
                            $no = 0;
                            while ($daftar = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $daftar['nomor_induk'] ?></td>
                                    <td><?= $daftar['nama_siswa'] ?></td>
                                    <td><?= $daftar['tgl_konfirmasi'] ?></td>

                                    <td>
                                        <?php if ($daftar['konfirmasi'] == 1) { ?>
                                            <span class="badge badge-success">Terkonfirmasi</span>
                                        <?php } else { ?>
                                            <span class="badge badge-warning">Diverifikasi</span>
                                        <?php } ?>
                                    </td>
                                    <?php
                                    $id_kelas = $daftar['kelas'];
                                    $qkelas = mysqli_query($koneksi, "SELECT nama_kelas FROM kelas WHERE id_kelas = '$id_kelas'");
                                    $dkelas = mysqli_fetch_assoc($qkelas);
                                    ?>
                                    <td>
                                        <?php if (!$daftar['kelas']) { ?>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambah<?= $no ?>">
                                                <i class="fas fa-plus"></i> Tambah kelas
                                            </button>
                                        <?php } else { ?>
                                            <a href="?pg=dt_kelas&id=?pg=dt_kelas&id=<?= $daftar['kelas'] ?>" class="btn btn-sm btn-info">
                                                <i class="fas fa-plus"></i> <?= $dkelas['nama_kelas'] ?>
                                            </a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <button data-id="<?= $daftar['id_daftar'] ?>" class="hapus btn-sm btn btn-danger"><i class="fas fa-times    "></i> Cancel</button>

                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="modal-tambah<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form id="form-edit<?= $no ?>">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Masukan ke kelas</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <input type="hidden" value="<?= $daftar['id_daftar'] ?>" name="id_daftar" class="form-control" required="">

                                                    <div class="form-group">
                                                        <label>Masukan ke kelas</label>
                                                        <select class='form-control' id="kelas" name="kelas" required>
                                                            <option value="">-- Pilih Kelas --</option>
                                                            <?php $qu = mysqli_query($koneksi, "select * from kelas where tahun_ajaran = '$id_tahun_aktif'");
                                                            while ($jur = mysqli_fetch_array($qu)) {
                                                            ?>
                                                                <option value="<?php echo $jur['id_kelas']; ?>"><?php echo $jur['nama_kelas']; ?></option>

                                                            <?php } ?>
                                                        </select>
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

                                <script>
                                    $('#form-edit<?= $no ?>').submit(function(e) {
                                        e.preventDefault();
                                        $.ajax({
                                            type: 'POST',
                                            url: 'mod_jenjang/crud_jenjang.php?pg=tambah_kelas',
                                            data: $(this).serialize(),
                                            success: function(data) {

                                                iziToast.success({
                                                    title: 'OKee!',
                                                    message: 'Berhasil dimasukan ke kelas',
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
    $('#table-1').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Apa kamu yakin ?',
            text: 'Akan membatalkan status diterima siswa ?',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: 'mod_daftar/crud_daftar.php?pg=bataldf',
                    method: "POST",
                    data: 'id_daftar=' + id,
                    success: function(data) {
                        iziToast.warning({
                            title: 'O o w!',
                            message: 'Data Berhasil dibatalkan',
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