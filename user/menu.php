<ul class="sidebar-menu">
	<li class="menu-header bg-warning"></li>
	<?php
	$no_daftar = isset($_SESSION['id_daftar']) ? $_SESSION['id_daftar'] : null;
	$edit = 'false';

	if ($no_daftar) {
		$stmt = mysqli_prepare($koneksi, "SELECT 1 FROM formulir WHERE no_daftar = ?");
		mysqli_stmt_bind_param($stmt, 's', $no_daftar);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);

		if (mysqli_stmt_num_rows($stmt) > 0) {
			$edit = 'true';
		}

		mysqli_stmt_close($stmt);
	}
	$url_formulir = "http://localhost/CINTA/user/?pg=formulir&edit=$edit&no_daftar=$no_daftar";
	?>

	<li><a class="nav-link" href="<?= $url_formulir ?>"><i class="fas fa-indent"></i> <span>Formulir</span></a></li>
	<li><a class="nav-link" href="?pg=berkas"><i class="fas fa-upload    "></i> <span>Upload Berkas</span></a></li>
	<!-- <li><a class="nav-link" href="?pg=cetakkartu"><i class="fas fa-print"></i> <span>Cetak Kartu Pendaftaran</span></a></li> -->
	<?php if ($siswa['status'] == 1) { ?>
		<li><a class="nav-link" href="?pg=df_ulang"><i class="fas fa-address-card   "></i> <span>Daftar Ulang</span><small class="label pull-right badge badge-danger">wajib</small></a></li>
	<?php } else { ?>

	<?php } ?>

	<?php if ($siswa['status'] == 1) { ?>
		<li><a class="nav-link" href="?pg=bayar"><i class="fas fa-funnel-dollar fa-fw"></i> <span>Pembayaran</span></a></li>
	<?php } else { ?>

	<?php } ?>
	<?php if ($siswa['kelas']) { ?>
		<li><a class="nav-link" href="?pg=kelas&id=<?= $siswa['kelas'] ?>"><i class="fas fa-landmark fa-fw"></i> <span>Kelas</span></a></li>
	<?php } else { ?>

	<?php } ?>
	<li><a class="nav-link" href="?pg=pengumuman"><i class="fas fa-bullhorn fa-fw"></i> <span>Pengumuman</span></a></li>
</ul>
<!-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://<?= $setting['web'] ?>" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div> -->