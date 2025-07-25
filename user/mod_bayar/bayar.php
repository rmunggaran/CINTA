<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <?php
            $no_daftar = $_SESSION['id_daftar']; // pastikan ini sudah ada saat user login
            $qKategori = mysqli_query($koneksi, "SELECT kategori FROM formulir WHERE no_daftar = '$no_daftar'");
            $dKategori = mysqli_fetch_assoc($qKategori);
            $id_jurusan = $dKategori['kategori'];

            // Hitung total: biaya umum (NULL) + biaya jurusan user
            $query = mysqli_query($koneksi, "SELECT SUM(jumlah) AS total FROM biaya WHERE (id_jurusan IS NULL OR id_jurusan=0 OR id_jurusan = '$id_jurusan') AND (jenis_biaya IS NULL OR jenis_biaya = 'ppdb') AND status=1");
            $total = mysqli_fetch_array($query);
            ?>

            <div class="card-header">
                <h4>Data biaya</h4>
                <div class="card-header-action">
                    <b>Total Biaya Rp. <?= number_format($total['total'], 0, ',', '.') ?></b>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="card w-100 shadow-sm p-3 mb-5 bg-body rounded">
                            <div class="card-body">
                                <?= $setting['infobayar'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="table-responsiv">
                            <table class="table table-striped table-sm" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Nama Biaya</th>
                                        <th>Jumlah Biaya</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($koneksi, "select * from biaya WHERE (id_jurusan IS NULL OR id_jurusan=0 OR id_jurusan = '$id_jurusan') AND (jenis_biaya IS NULL OR jenis_biaya = 'ppdb') AND status=1");
                                    $no = 0;
                                    while ($biaya = mysqli_fetch_array($query)) {
                                        $no++;
                                    ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $biaya['nama_biaya'] ?></td>
                                            <td>Rp. <?= number_format($biaya['jumlah'], 0, ',', '.') ?></td>
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
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card author-box card-primary">
                    <div class="card-header">
                        <h4>DATA PEMBAYARAN</h4>
                        <div class="card-header-action">
                            <!-- Button trigger modal -->
                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modelId">
                                <i class="fas fa-info-circle    "></i> Info Pembayaran
                            </button> -->

                            <!-- Modal -->
                            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Info Pembayaran</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?= $setting['infobayar'] ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahdata">
                                <i class="fas fa-plus-circle    "></i> Tambah Bayar
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Pembayaran</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="form-bayar">
                                        <div class="modal-body">
                                            <input type="hidden" value="<?= $siswa['id_daftar'] ?>" name="id">
                                            <input type="hidden" name="kategori" id="kategori" value="<?= $id_jurusan ?>">
                                            <div class="form-group">
                                                <label for="jumlah">Jumlah Pembayaran Rp.</label>
                                                <input type="text" class="form-control uang" name="jumlah" id="jumlah" aria-describedby="helpjumlah" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Pilih Biaya yang Ingin Dibayar:</label>
                                                <?php
                                                $queryBiaya = mysqli_query($koneksi, "SELECT * FROM biaya WHERE (id_jurusan IS NULL OR id_jurusan=0 OR id_jurusan = '$id_jurusan') AND (jenis_biaya IS NULL OR jenis_biaya = 'ppdb') AND status = 1");
                                                while ($biaya = mysqli_fetch_assoc($queryBiaya)) {
                                                    // Cek apakah biaya ini sudah pernah dibayar oleh user ini
                                                    $id_biaya = $biaya['id_biaya'];
                                                    $cek = mysqli_query($koneksi, "SELECT 1 FROM bayar WHERE id_daftar = '{$siswa['id_daftar']}' AND id_biaya = '$id_biaya' AND (jenis_bayar IS NULL OR jenis_bayar = 'ppdb')");

                                                    if (mysqli_num_rows($cek) > 0) {
                                                        continue; // skip item yang sudah pernah dibayar
                                                    }
                                                ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="biaya_dipilih[]" value="<?= $biaya['id_biaya'] ?>" id="biaya_<?= $biaya['id_biaya'] ?>">
                                                        <label class="form-check-label" for="biaya_<?= $biaya['id_biaya'] ?>">
                                                            <?= $biaya['nama_biaya'] ?> (Rp <?= number_format($biaya['jumlah'], 0, ',', '.') ?>)
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                                <div class="mt-3">
                                                    <strong>Total yang harus dibayar: Rp <span id="total-bayar">0</span></strong>
                                                    <?php if ($id_jurusan = 1) { ?>
                                                        <p class="mt-3">note :minimal transaksi Rp.500.000</p>
                                                    <?php } ?>
                                                </div>
                                                <script>
                                                    // Data jumlah biaya per checkbox
                                                    const biayaMap = {};

                                                    <?php
                                                    mysqli_data_seek($queryBiaya, 0); // reset ulang pointer hasil query
                                                    while ($biaya = mysqli_fetch_assoc($queryBiaya)) {
                                                        echo "biayaMap['{$biaya['id_biaya']}'] = {$biaya['jumlah']};\n";
                                                    }
                                                    ?>

                                                    function updateTotalBayar() {
                                                        let total = 0;
                                                        document.querySelectorAll("input[name='biaya_dipilih[]']:checked").forEach((checkbox) => {
                                                            total += biayaMap[checkbox.value] || 0;
                                                        });

                                                        document.getElementById("total-bayar").innerText = total.toLocaleString('id-ID');
                                                        document.getElementById("jumlah").value = total; // isikan otomatis ke input jumlah
                                                    }

                                                    document.querySelectorAll("input[name='biaya_dipilih[]']").forEach((checkbox) => {
                                                        checkbox.addEventListener('change', updateTotalBayar);
                                                    });

                                                    // Jalankan saat awal (jika ada centang bawaan)
                                                    updateTotalBayar();
                                                </script>


                                            </div>

                                            <div class="form-group">
                                                <label for="tgl">Tanggal Pembayaran</label>
                                                <input type="text" class="form-control datepicker" name="tgl" id="tgl" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="bukti">Bukti Pembayaran</label>
                                                <input type="file" class="form-control-file" name="bukti" id="bukti" accept="image/*" aria-describedby="fileHelpId" required>
                                                <small id="fileHelpId" class="form-text text-muted">Upload file JPG/PNG</small>
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
                        <div class="table-responsive">
                            <table class="table table-striped table-sm" id="tablebayar" style="font-size: 12px">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Kode Transaksi</th>
                                        <th>Nama Siswa</th>
                                        <th>Nama Biaya</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Tgl Bayar</th>
                                        <th>verifikasi</th>
                                        <th>Bukti</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($koneksi, "select * from bayar a join daftar b ON a.id_daftar=b.id_daftar where a.id_daftar='$siswa[id_daftar]'AND (jenis_bayar IS NULL OR jenis_bayar = 'ppdb')");
                                    $no = 0;
                                    while ($bayar = mysqli_fetch_array($query)) {
                                        $user = fetch($koneksi, 'user', ['id_user' => $bayar['id_user']]);
                                        $no++;
                                        // echo '<pre>';
                                        // print_r($bayar);
                                        // echo '</pre>';

                                    ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $bayar['id_bayar'] ?></td>
                                            <td><?= $bayar['nama'] ?></td>
                                            <?php
                                            $biaya = fetch($koneksi, 'biaya', ['id_biaya' => $bayar['id_biaya']]);
                                            ?>
                                            <td><?= $biaya['nama_biaya'] ?? '-' ?></td>
                                            <td><?= "Rp " . number_format((int)$bayar['4'], 0, ",", ".") ?></td>
                                            <td><?= $bayar['tgl_bayar'] ?></td>
                                            <td>
                                                <?php if ($bayar['verifikasi'] == 1) { ?>
                                                    <span class="badge badge-success">Pembayaran diterima</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-success">Proses Cek</span>

                                                <?php } ?>
                                            </td>
                                            <td><a target="_blank" class="btn btn-primary btn-sm" href="mod_bayar/<?= $bayar['bukti'] ?>" role="button"><i class="fas fa-eye"></i> bukti</a></td>
                                            <td>
                                                <?php if ($bayar['verifikasi'] == 0) { ?>
                                                    <button data-id="<?= $bayar['id_bayar'] ?>" class="hapus btn btn-danger btn-sm"><i class="fas fa-trash    "></i> Batal</button>
                                                <?php } else { ?>
                                                    <a target="_blank" href="mod_bayar/print_kwitansi.php?id=<?= enkripsi($bayar['id_bayar']) ?>" class="btn btn-primary btn-sm"><i class="fas fa-print    "></i> Cetak</a>

                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                        <?php
                        $bayar = mysqli_fetch_array(mysqli_query($koneksi, "select sum(jumlah) as total from bayar where id_daftar='$siswa[id_daftar]'AND (jenis_bayar IS NULL OR jenis_bayar != 'spp')"));
                        $sisa = $total['total'] - $bayar['total'];

                        $baeu = mysqli_query($koneksi, "SELECT * FROM bayar WHERE id_daftar='$siswa[id_daftar]' AND (jenis_bayar IS NULL OR jenis_bayar != 'spp') ORDER BY id_bayar DESC LIMIT 1");
                        $data_terakhir = mysqli_fetch_assoc($baeu);
                        ?>
                        <table class="table table-sm table-striped mt-4" style="font-size:15px">
                            <tbody>
                                <tr>
                                    <th scope="row" width="200">TOTAL PEMBAYARAN</th>
                                    <td><?= "Rp " . number_format($bayar['total'], 0, ",", ".") ?></td>
                                </tr>
                                <?php if ($data_terakhir && $data_terakhir['verifikasi'] == 1) { ?>
                                    <tr>
                                        <th scope="row">SISA BAYAR</th>
                                        <td><?= "Rp " . number_format($sisa, 0, ",", ".") ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">STATUS</th>
                                        <td>
                                            <?php if ($sisa <= 0) { ?>
                                                <span class="badge badge-success">SUDAH LUNAS</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">BELUM LUNAS</span>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                <?php } else { ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var cleaveI = new Cleave('.uang', {
                numeral: true
            });
        </script>

        <script>
            $('#form-bayar').submit(function(e) {
                e.preventDefault();
                let jumlahBayar = parseInt($('#jumlah').val().replace(/\D/g, '')) || 0;
                let kategori = parseInt($('#kategori').val()) || 0;

                // Validasi hanya jika kategori = 1
                if (kategori === 1 && jumlahBayar < 600000) {
                    iziToast.error({
                        title: 'Maaf!',
                        message: 'Minimal pembayaran Rp 600.000 untuk kategori ini',
                        position: 'topRight'
                    });
                    return false;
                }
                $.ajax({
                    type: 'POST',
                    url: 'mod_bayar/crud_bayar.php?pg=tambah',
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
                        console.log(data);
                        if (data.trim() == 'ok') {
                            $('#tambahdata').modal('hide');
                            iziToast.success({
                                title: 'Mantap!',
                                message: 'Data berhasil disimpan',
                                position: 'topRight'
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);

                        } else {
                            iziToast.error({
                                title: 'Maaf!',
                                message: 'data gagal disimpan',
                                position: 'topRight'
                            });
                        }
                        //$('#bodyreset').load(location.href + ' #bodyreset');
                    }
                });
                return false;
            });


            $('#tablebayar').on('click', '.hapus', function() {
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
                            url: 'mod_bayar/crud_bayar.php?pg=hapus',
                            method: "POST",
                            data: 'id_bayar=' + id,
                            success: function(data) {
                                iziToast.error({
                                    title: 'Hmm!',
                                    message: 'Pembayaran berhasil dibatalkan',
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