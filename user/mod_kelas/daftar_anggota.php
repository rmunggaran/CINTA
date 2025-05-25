<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Anggota kelas</h4>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = $_GET['id'];
                            $query = mysqli_query($koneksi, "SELECT daftar.*, formulir.* 
                                FROM daftar 
                                INNER JOIN formulir ON daftar.id_daftar = formulir.no_daftar 
                                WHERE daftar.status = '1' AND daftar.kelas = '$id'
                            ");
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

                                    </td>
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
            text: 'Mengeluarkan siswa ini dari kelas ?',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: 'mod_jenjang/crud_jenjang.php?pg=keluar',
                    method: "POST",
                    data: 'id_daftar=' + id,
                    success: function(data) {
                        iziToast.warning({
                            title: 'O o w!',
                            message: 'Siswa Berhasil dikeluarkan',
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