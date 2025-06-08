<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="activities">
                    <?php
                    $daftar = fetch($koneksi, 'daftar', ['id_daftar' => $_SESSION['id_daftar']]);

                    if ($daftar && isset($daftar['kelas']) && $daftar['kelas']) {
                        // Ambil data kelas berdasarkan id_kelas
                        $kelas = fetch($koneksi, 'kelas', ['id_kelas' => $daftar['kelas']]);
                    ?>
                        <div class="alert alert-success alert-dismissable w-100">
                            <h4>Selamat anda telah telah di terima di MI Condong !!!</h4>
                            Anda masuk di
                            <span class="badge badge-danger"> <?= $kelas['nama_kelas'] ?> </span>
                        </div>
                    <?php } ?>
                    <?php $query = mysqli_query($koneksi, "SELECT * FROM pengumuman where jenis IN (0, 1) ORDER BY tgl DESC");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <div class="activity">
                            <div class="activity-icon bg-primary text-white shadow-primary">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <div class="activity-detail">
                                <div class="mb-2">
                                    <span class="bullet"></span>
                                    <span class="text-job text-primary"><?= $data['tgl'] ?></span>
                                    <!-- <a class="text-job" href="#">View</a> -->

                                </div>
                                <h5><?= $data['judul'] ?></h5>
                                <p><?= $data['pengumuman'] ?></p>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>

    </div>
</div>