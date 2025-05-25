<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Pendaftar</h4>
                <div class="card-header-action">
                    <a class="btn btn-primary" href="mod_daftar/export_diterima.php" role="button"> Download Excel</a>

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
                                <th>NISN</th>
                                <th>Nama Pendaftar</th>
                                <th>Asal Sekolah</th>
                                <th>No Hp</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT daftar.*, formulir.* 
                                FROM daftar 
                                INNER JOIN formulir ON daftar.id_daftar = formulir.no_daftar where status='1' AND (kelas IS NULL OR TRIM(kelas) = '')");
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
                                        <a target="_blank" href="https://api.whatsapp.com/send?phone=62<?= $daftar['no_hp'] ?>&text=Terima%20kasih%20sudah%20mendaftar%20di%20SMK%20HS%20AGUNG%2C%0AHarap%20segera%20melunasi%20pembayaran.%20%28abaikan%20jika%20sudah%20lunas%29%0AInfo%20lebih%20lanjut%20silahkan%20kunjungi%20website%20ppdb.smkhsagung.sch.id%0ASilahkan%20login%20dan%20lengkapi%20data%20formulirnya.%20%0Ausername%20%3A%20%2A<?= $daftar['no_daftar'] ?>%2A%0Apassword%20%3A%20%2A<?= $daftar['password'] ?>%2A">
                                            <?= $daftar['no_hp'] ?></a>
                                    </td>
                                    <td>
                                        <?php if ($daftar['status'] == 1) { ?>
                                            <span class="badge badge-success">diterima</span>
                                        <?php } else { ?>
                                            <span class="badge badge-warning">Diverifikasi</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambah<?= $no ?>">
                                            <i class="fas fa-plus"></i> Tambah kelas
                                        </button>

                                        <a data-toggle="tooltip" data-placement="top" title="" data-original-title="detail siswa" href="?pg=detail&id=<?= enkripsi($daftar['id_daftar']) ?>" class="btn btn-sm btn-success"><i class="fas fa-eye    "></i> Detail</a>

                                        <button data-id="<?= $daftar['id_daftar'] ?>" class="hapus btn-sm btn btn-danger"><i class="fas fa-times    "></i> Cancel</button>

                                    </td>
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
                                                                <?php $qu = mysqli_query($koneksi, "select * from kelas");
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
<script>
    $('#table-1').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Apa kamu yakin ?',
            text: 'Akan membatalkan status diterima dan menghapus pembayaran dari pendaftar ini ?',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: 'mod_daftar/crud_daftar.php?pg=batal',
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
                        }, 2000);
                    }
                });
            }
        })

    });
</script>