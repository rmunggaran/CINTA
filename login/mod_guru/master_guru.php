<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<div class="section-header">
    <button type="button" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#tambahdata">
        <i class="far fa-edit"></i> Tambah Data Guru
    </button>

    <!-- Modal Tambah Guru -->
    <div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-tambah" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Guru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Guru</label>
                            <input type="text" name="nama_guru" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan_terakhir" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Wali Kelas</label>
                            <select class='form-control' id="wali_kelas" name="wali_kelas">
                                <option value="">-- Jadikan wali kelas --</option>
                                <?php $qu = mysqli_query($koneksi, "select * from kelas");
                                while ($jur = mysqli_fetch_array($qu)) {
                                ?>
                                    <option value="<?php echo $jur['id_kelas']; ?>"><?php echo $jur['nama_kelas']; ?></option>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control" accept="image/*" required>
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
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Guru</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Guru</th>
                                <th>Pendidikan Terakhir</th>
                                <th>Wali Kelas</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM guru");
                            $no = 0;
                            while ($guru = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $guru['nama_guru'] ?></td>
                                    <td><?= $guru['pendidikan_terakhir'] ?></td>
                                    <?php
                                    $kelasNama = '-'; // default jika tidak ada wali kelas

                                    if (!empty($guru['wali_kelas'])) {
                                        $kelas = fetch($koneksi, 'kelas', ['id_kelas' => $guru['wali_kelas']]);
                                        if ($kelas) {
                                            $kelasNama = $kelas['nama_kelas'];
                                        }
                                    }
                                    ?>
                                    <td><?= $kelasNama ?></td>
                                    <td>
                                        <img src="../assets/foto_guru/<?= $guru['foto'] ?>" width="50">
                                    </td>
                                    <td>
                                        <button data-id="<?= $guru['id'] ?>" class="hapus btn btn-danger">Hapus</button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit<?= $no ?>">Edit</button>

                                        <!-- Modal Edit Guru -->
                                        <div class="modal fade" id="modal-edit<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form id="form-edit<?= $no ?>" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Data Guru</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_guru" value="<?= $guru['id'] ?>">
                                                            <input type="hidden" name="foto_lama" value="<?= $guru['foto'] ?>">

                                                            <div class="form-group">
                                                                <label>Nama Guru</label>
                                                                <input type="text" name="nama_guru" value="<?= $guru['nama_guru'] ?>" class="form-control" required="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Pendidikan Terakhir</label>
                                                                <input type="text" name="pendidikan_terakhir" value="<?= $guru['pendidikan_terakhir'] ?>" class="form-control" required="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Wali Kelas</label>
                                                                <select class='form-control' id="wali_kelas" name="wali_kelas">
                                                                    <option value="">-- Jadikan wali kelas --</option>
                                                                    <?php $qu = mysqli_query($koneksi, "select * from kelas");
                                                                    while ($jur = mysqli_fetch_array($qu)) {
                                                                    ?>
                                                                        <option value="<?php echo $jur['id_kelas']; ?>" <?= $guru['wali_kelas'] == $jur['id_kelas'] ? 'selected' : '' ?>>
                                                                            <?php echo $jur['nama_kelas']; ?>
                                                                        </option>


                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Foto</label><br>
                                                                <?php if ($guru['foto']) { ?>
                                                                    <img src="../assets/foto_guru/<?= $guru['foto'] ?>" width="100" alt="Foto Guru">
                                                                    <br><br>
                                                                    <label>Ganti Foto (Opsional)</label>
                                                                    <input type="file" name="foto" class="form-control">
                                                                <?php } else { ?>
                                                                    <label>Upload Foto</label>
                                                                    <input type="file" name="foto" class="form-control">
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <script>
                                                    $('#form-edit<?= $no ?>').submit(function(e) {
                                                        e.preventDefault();
                                                        const form = this;
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: 'mod_guru/crud_guru.php?pg=edit',
                                                            data: new FormData(form),
                                                            processData: false,
                                                            contentType: false,
                                                            success: function(response) {
                                                                if (response.trim() === 'ok') {
                                                                    iziToast.success({
                                                                        title: 'Sukses!',
                                                                        message: 'Data guru berhasil diperbarui',
                                                                        position: 'topRight'
                                                                    });
                                                                    $(form).closest('.modal').modal('hide');
                                                                    setTimeout(() => location.reload(), 2000);
                                                                } else {
                                                                    iziToast.error({
                                                                        title: 'Gagal!',
                                                                        message: 'Gagal edit data (' + response + ')',
                                                                        position: 'topRight'
                                                                    });
                                                                }
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#form-tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'mod_guru/crud_guru.php?pg=tambah',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.trim() === 'ok') {
                    iziToast.success({
                        title: 'Sukses!',
                        message: 'Data guru berhasil ditambahkan',
                        position: 'topRight'
                    });
                    $('#tambahdata').modal('hide');
                    setTimeout(() => location.reload(), 2000);
                } else {
                    iziToast.error({
                        title: 'Error!',
                        message: 'Gagal tambah data (' + response + ')',
                        position: 'topRight'
                    });
                }
            }
        });
    });


    $('#table-1').on('click', '.hapus', function() {
        var id = $(this).data('id');
        swal({
            title: 'Yakin?',
            text: 'Data guru akan dihapus beserta fotonya!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: 'mod_guru/crud_guru.php?pg=hapus',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.trim() === 'ok') {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Data guru berhasil dihapus',
                                position: 'topRight'
                            });
                            setTimeout(() => location.reload(), 2000);
                        } else {
                            iziToast.error({
                                title: 'Gagal!',
                                message: 'Gagal menghapus data: ' + response,
                                position: 'topRight'
                            });
                        }
                    }
                });
            }
        });
    });
</script>