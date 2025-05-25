<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="activities">
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