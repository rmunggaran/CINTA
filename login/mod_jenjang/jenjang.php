<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<div class="section-header">

    <button type="button" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#tambahdata">
        <i class="far fa-edit"></i> Tambah Data
    </button>

    <!-- Modal -->
    <div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-tambah">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Kelas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <input type="text" name="nama_kelas" class="form-control" required="">
                        </div>
                        <!-- <div class="form-group">
                            <label>Jenjang</label>
                            <select name="jenjang" id="jenjang" class="form-control" required>
                                <option value=''>--Pilih Jenjang--</option>
                                <option value='1'>Kelas 1</option>
                                <option value='2'>Kelas 2</option>
                                <option value='3'>Kelas 3</option>
                                <option value='4'>Kelas 4</option>
                                <option value='5'>Kelas 5</option>
                                <option value='6'>Kelas 6</option>
                            </select>
                        </div> -->
                        <div class="form-group">
                            <label>Wali Kelas</label>
                            <select name="wali_kelas" class="form-control" required>
                                <option value="">-- Pilih Wali Kelas --</option>
                                <?php
                                $queryGuru = mysqli_query($koneksi, "SELECT * FROM guru WHERE wali_kelas IS NULL OR wali_kelas = ''");
                                while ($guru = mysqli_fetch_assoc($queryGuru)) {
                                    echo "<option value='" . $guru['id'] . "'>" . $guru['nama_guru'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>kuota</label>
                            <input type="text" name="kuota" class="form-control" required="">
                        </div>

                        <div class="form-group">
                            <label for="kategori">Jenis Pendidikan:</label>
                            <select id="kategori" name="kategori" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php $qu = mysqli_query($koneksi, "select * from jurusan");
                                while ($jur = mysqli_fetch_array($qu)) {
                                ?>
                                    <option value="<?php echo $jur['id_jurusan']; ?>" <?= (isset($data['kategori']) && $data['kategori'] == $jur['id_jurusan']) ? 'selected' : '' ?>><?php echo $jur['nama_jurusan']; ?></option>

                                <?php } ?>
                                <!-- <option value="full" <?= (isset($data['kategori']) && $data['kategori'] == 'full') ? 'selected' : '' ?>>Full Day School</option>
                    <option value="reguler" <?= (isset($data['kategori']) && $data['kategori'] == 'reguler') ? 'selected' : '' ?>>Reguler</option> -->
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


</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Kelas</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>id_kelas</th>
                                <th>Nama Kelas</th>
                                <th>Wali Kelas</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "
                            SELECT kelas.*, guru.nama_guru 
                            FROM kelas 
                            LEFT JOIN guru ON guru.wali_kelas = kelas.id_kelas 
                            ORDER BY nama_kelas + 0 ASC
                        ");

                            $no = 0;
                            while ($jenjang = mysqli_fetch_array($query)) {
                                $no++;

                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $jenjang['id_kelas'] ?></td>
                                    <td><?= $jenjang['nama_kelas'] ?></td>
                                    <td><?= $jenjang['nama_guru'] ?? '-' ?></td>
                                    <td>
                                        <?php if ($jenjang['status'] == 1) { ?>
                                            <span class="badge badge-success">Aktif</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">Tidak aktif</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Lihat anggota" href="?pg=dt_kelas&id=<?= $jenjang['id_kelas'] ?>" class="btn btn-sm btn-success"><i class="fas fa-eye    "></i> Detail</a>
                                        <!-- <button data-id="<?= $jenjang['id_kelas'] ?>" class="hapus btn btn-danger">Hapus</button> -->
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit<?= $no ?>">
                                            Edit
                                        </button>

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
                                                            <input type="hidden" value="<?= $jenjang['id_kelas'] ?>" name="id_kelas" class="form-control" required="">
                                                            <div class="form-group">
                                                                <label>Nama Kelas</label>
                                                                <input type="text" name="nama_kelas" value="<?= $jenjang['nama_kelas'] ?>" class="form-control" required="">
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <label>Jenjang</label>
                                                                <select name="jenjang" id="jenjang" class="form-control" required>
                                                                    <option value=''>--Pilih Jenjang--</option>
                                                                    <option value='1' <?= $jenjang['jenjang'] == 1 ? 'selected' : '' ?>>Kelas 1</option>
                                                                    <option value='2' <?= $jenjang['jenjang'] == 2 ? 'selected' : '' ?>>Kelas 2</option>
                                                                    <option value='3' <?= $jenjang['jenjang'] == 3 ? 'selected' : '' ?>>Kelas 3</option>
                                                                    <option value='4' <?= $jenjang['jenjang'] == 4 ? 'selected' : '' ?>>Kelas 4</option>
                                                                    <option value='5' <?= $jenjang['jenjang'] == 5 ? 'selected' : '' ?>>Kelas 5</option>
                                                                    <option value='6' <?= $jenjang['jenjang'] == 6 ? 'selected' : '' ?>>Kelas 6</option>
                                                                </select>
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label>Wali Kelas</label>
                                                                <select name="wali_kelas" class="form-control" required>
                                                                    <option value="">-- Pilih Wali Kelas --</option>
                                                                    <?php
                                                                    // Ambil guru yang belum jadi wali kelas ATAU yang sekarang jadi wali kelas kelas ini
                                                                    $queryGuru = mysqli_query($koneksi, "
            SELECT * FROM guru 
            WHERE wali_kelas IS NULL OR wali_kelas = '' OR wali_kelas = '{$jenjang['id_kelas']}'
        ");
                                                                    while ($guru = mysqli_fetch_assoc($queryGuru)) {
                                                                        $selected = $guru['wali_kelas'] == $jenjang['id_kelas'] ? 'selected' : '';
                                                                        echo "<option value='" . $guru['id'] . "' $selected>" . $guru['nama_guru'] . "</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>kuota</label>
                                                                <input type="text" name="kuota" value="<?= $jenjang['kuota'] ?>" class="form-control" required="">
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="control-label">Status Jenjang</div>
                                                                <label class="custom-switch mt-2">
                                                                    <input type="checkbox" name="status" class="custom-switch-input" value='1' <?php if ($jenjang['status'] == 1) {
                                                                                                                                                    echo "checked";
                                                                                                                                                } ?>>
                                                                    <span class="custom-switch-indicator"></span>
                                                                    <span class="custom-switch-description"> Pilih Status</span>
                                                                </label>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="kategori">Jenis Pendidikan:</label>
                                                                <select id="kategori" name="kategori" class="form-control" required>
                                                                    <option value="">-- Pilih Kategori --</option>
                                                                    <?php $qu = mysqli_query($koneksi, "select * from jurusan");
                                                                    while ($jur = mysqli_fetch_array($qu)) {
                                                                    ?>
                                                                        <option value="<?php echo $jur['id_jurusan']; ?>" <?= (isset($jenjang['jurusan_id']) && $jenjang['jurusan_id'] == $jur['id_jurusan']) ? 'selected' : '' ?>><?php echo $jur['nama_jurusan']; ?></option>

                                                                    <?php } ?>
                                                                    <!-- <option value="full" <?= (isset($data['kategori']) && $data['kategori'] == 'full') ? 'selected' : '' ?>>Full Day School</option>
                    <option value="reguler" <?= (isset($data['kategori']) && $data['kategori'] == 'reguler') ? 'selected' : '' ?>>Reguler</option> -->
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
                                    </td>
                                </tr>
                                <script>
                                    $('#form-edit<?= $no ?>').submit(function(e) {
                                        e.preventDefault();
                                        $.ajax({
                                            type: 'POST',
                                            url: 'mod_jenjang/crud_jenjang.php?pg=ubah',
                                            data: $(this).serialize(),
                                            success: function(data) {

                                                iziToast.success({
                                                    title: 'OKee!',
                                                    message: 'Data Berhasil diubah',
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
    $('#form-tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'mod_jenjang/crud_jenjang.php?pg=tambah',
            data: $(this).serialize(),
            success: function(data) {

                iziToast.success({
                    title: 'Mantap!',
                    message: 'Data Berhasil ditambahkan',
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
                    url: 'mod_jenjang/crud_jenjang.php?pg=hapus',
                    method: "POST",
                    data: 'id_kelas=' + id,
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