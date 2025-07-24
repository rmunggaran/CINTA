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
                    <input type="text" id="tahun_ajaran" name="tahun_ajaran" value="<?= $tahunAktif['tahun']; ?>" hidden>
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
                        <div class="form-group">
                            <label>Wali Kelas</label>
                            <select name="wali_kelas" class="form-control" required>
                                <option value="">-- Pilih Wali Kelas --</option>
                                <?php
                                $tahun_ajaran_aktif = $tahunAktif['tahun'];
                                $queryGuru = mysqli_query($koneksi, "
                                    SELECT * FROM guru 
                                    WHERE id NOT IN (
                                        SELECT walikelas_id 
                                        FROM kelas 
                                        WHERE walikelas_id IS NOT NULL
                                        AND tahun_ajaran = '$tahun_ajaran_aktif'
                                    )
                                ");
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
                                <th>Rombel</th>
                                <th>Wali Kelas</th>
                                <th>Tahun Ajaran</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id_tahun_aktif = $tahunAktif['tahun'];
                            $query = mysqli_query($koneksi, "
                                SELECT kelas.*, guru.nama_guru 
                                FROM kelas 
                                LEFT JOIN guru ON guru.id = kelas.walikelas_id 
                                WHERE kelas.tahun_ajaran = '$id_tahun_aktif'
                                ORDER BY nama_kelas + 0 ASC
                            ");

                            $no = 0;
                            while ($jenjang = mysqli_fetch_array($query)) {
                                $no++;

                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $jenjang['nama_kelas'] ?></td>
                                    <td><?= $jenjang['nama_guru'] ?? '-' ?></td>
                                    <td><?= $jenjang['tahun_ajaran'] ?? '-' ?></td>
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
                                                            <div class="form-group">
                                                                <label>Wali Kelas</label>
                                                                <select name="wali_kelas" class="form-control" required>
                                                                    <option value="">-- Pilih Wali Kelas --</option>
                                                                    <?php
                                                                    $tahun_ajaran_aktif = $tahunAktif['tahun'];
                                                                    $queryGuru = mysqli_query($koneksi, "
                                                                        SELECT * FROM guru 
                                                                        WHERE id NOT IN (
                                                                            SELECT walikelas_id FROM kelas 
                                                                            WHERE walikelas_id IS NOT NULL
                                                                            AND tahun_ajaran = '$tahun_ajaran_aktif'
                                                                        ) 
                                                                        OR id = '" . $jenjang['walikelas_id'] . "'
                                                                    ");
                                                                    while ($guru = mysqli_fetch_assoc($queryGuru)) {
                                                                        $selected = $guru['id'] == $jenjang['walikelas_id'] ? 'selected' : '';
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