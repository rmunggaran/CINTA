<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<section class='content'>
	<div class='row'>
		<div class='col-md-12 notif'></div>
		<div class='col-md-6'>
			<form id="form-setting">
				<div class='box box-solid'>
					<div class='box-header with-border'>
						<h3 class='box-title'>Pengaturan Aplikasi</h3>
						<div class='box-tools pull-right btn-group'>
							<button type='submit' id="save-btn" class='btn btn-sm btn-flat btn-success'><i class='fa fa-check'></i> Simpan</button>
						</div>
					</div><!-- /.box-header -->
					<div class='box-body'>
						<div class='form-group'>
							<label>Nama Sekolah</label>
							<input type='text' name='nama_sekolah' value="<?= $setting['nama_sekolah'] ?>" class='form-control' required='true' />
						</div>
						<div class='form-group'>
							<div class='row'>
								<div class='col-md-6'>
									<label>NSM/NSS Sekolah</label>
									<input type='text' name='nsm' value="<?= $setting['nsm'] ?>" class='form-control' required='true' />
								</div>
								<div class='col-md-6'>
									<label>NPSN Sekolah</label>
									<input type='text' name='npsn' value="<?= $setting['npsn'] ?>" class='form-control' required='true' />
								</div>
							</div>
						</div>

						<div class='form-group'>
							<div class='row'>
								<div class="col-sm-6 col-md-6">
									<label>Logo</label>
									<input type='file' name='logo' class='form-control' />
								</div>
								<div class="col-sm-6 col-md-6">
									&nbsp;<br />
									<img src="../<?= $setting['logo'] ?>" class="img-thumbnail" width="100">
								</div>
							</div>
						</div>
						<div class='form-group'>
							<div class='row'>
								<div class='col-md-12'>
									<label>Kop Sekolah</label>
									<input type='file' name='kop' class='form-control' />
								</div>
								<div class="col-sm-6 col-md-12">
									&nbsp;<br />
									<img src="../<?= $setting['kop'] ?>" class="img-thumbnail" width="800">
								</div>
							</div>
						</div>
						<div class='form-group'>
							<div class='row'>
								<div class='col-md-12'>
									<label>Logo PPDB</label>
									<input type='file' name='logo_ppdb' class='form-control' />
								</div>
								<div class="col-sm-6 col-md-12">
									&nbsp;<br />
									<img src="../<?= $setting['logo_ppdb'] ?>" class="img-thumbnail" width="200">
								</div>
							</div>
						</div>

					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</form>
		</div>
		<script>
			$('.custom-file-input').on('change', function() {
				let fileName = $(this).val().split('\\').pop();
				$(this).next('.custom-file-label').addClass("selected").html(fileName);
			});
			$('#form-setting').on('submit', function(e) {
				e.preventDefault();
				$.ajax({
					type: 'post',
					url: 'mod_setting/crud_setting.php?pg=ubah',
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

						iziToast.success({
							title: 'Mantap!',
							message: data,
							position: 'topRight'
						});
						setTimeout(function() {
							window.location.reload();
						}, 2000);


					}
				});
			});
		</script>
		<div class='col-md-6'>
			<form id="form-setting">
				<div class='box box-solid'>
					<div class='box-header with-border'>
						<h3 class='box-title'>Pengaturan PPDB</h3>
						<div class='box-tools pull-right btn-group'>
							<button type='' id="btn" class='btn btn-sm btn-flat btn-success'><i class='fa fa-check'></i> </button>
						</div>
					</div><!-- /.box-header -->
					<div class='box-body'>
						<div class="row">

							<div class="col-lg-12">
								<div class="card card-large-icons">
									<div class="card-icon bg-success text-white">
										<i class="fas fa-users"></i>
									</div>
									<div class="card-body">
										<h4>PPDB Online</h4>
										<p>Penggunaan Fitur PPDB Online bisa di setting di sisi</p>
										<a href="?pg=s_ppdb" class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
									</div>
								</div>
							</div>



							<div class="col-lg-12">
								<div class="card card-large-icons">
									<div class="card-icon bg-dark text-white">
										<i class="fas fa-phone"></i>
									</div>
									<div class="card-body">
										<h4>Kontak Pendaftaran</h4>
										<p>Silahkan Atur Kontak Pendaftaran Disini.</p>
										<a href="?pg=kontak" class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
									</div>
								</div>
							</div>



							<div class="col-lg-12">
								<div class="card card-large-icons">
									<div class="card-icon bg-warning text-white">
										<i class="fas fa-edit"></i>
									</div>
									<div class="card-body">
										<h4>Info PPDB</h4>
										<p>Setting pengaturan info PPDB Anda disini.</p>
										<a href="?pg=pengumuman" class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="card card-large-icons">
									<div class="card-icon bg-info text-white">
										<i class="fas fa-lock"></i>
									</div>
									<div class="card-body">
										<h4>Backup And Restore</h4>
										<p>Silahkan Backup dan restore File database anda Disini</p>
										<a href="?pg=backup" class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
									</div>
								</div>
							</div>






						</div><!-- /.box-body -->
					</div><!-- /.box -->
			</form>
		</div>


	</div>
</section><!-- /.content -->

<div class='row'>
	<div class='col-md-12 notif'></div>
	<div class='col-md-6'>
		<form id="form-live">
			<div class='box box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Pengaturan Live Chat</h3>
					<div class='box-tools pull-right btn-group'>
						<button type='submit' id="save-btn" class='btn btn-sm btn-flat btn-success'><i class='fa fa-check'></i> Simpan</button>
					</div>
				</div><!-- /.box-header -->
				<div class='box-body'>
					<div class='form-group'>
						<label>Text Klik Chat Daftar</label>
						<textarea class="form-control" name="klikchat"><?= $setting['klikchat'] ?></textarea>
					</div>
					<div class='form-group'>
						<label>Text Live Chat</label>
						<textarea class="form-control" name="livechat"><?= $setting['livechat'] ?></textarea>
					</div>

					<div class="form-group">
						<div class="label-wrapper">
							<label for="nolivechat">No WA Live Chat Tanpa Angka 0 (cth: 085.. = 85..)</label>
						</div>
						<div class="input-wrapper d-flex">
							<input type="text" placeholder="+62" disabled style="width: 60px" class="form-control">
							<input type="text" name="nolivechat" class="form-control" value="<?= $setting['nolivechat'] ?>" required>
						</div>
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</form>
	</div>
	<div class='col-md-6'>
		<div class='box box-solid'>
			<div class='box-header with-border'>
				<h3 class='box-title'>Pengaturan Tahun Ajaran</h3>
				<div class='box-tools pull-right btn-group'>
					<button type='submit' id="save-btn" class='btn btn-sm btn-flat btn-success' data-toggle="modal" data-target="#tambahtahun"><i class='fa fa-edit'></i> Tambah Tahun</button>
				</div>
			</div><!-- /.box-header -->

			<div class="modal fade" id="tambahtahun" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form id="form-tambah-tahun">
							<input type="text" id="tahun_ajaran" name="tahun_ajaran" value="<?= $tahunAktif['tahun']; ?>" hidden>
							<div class="modal-header">
								<h5 class="modal-title">Tambah Tahun Ajaran</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label>Tahun</label>
									<input type="text" name="tahun" class="form-control" placeholder="2025/2026" required="">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Add</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class='box-body'>
				<div class="table-responsive">
					<table class="table table-striped" id="table-1">
						<thead>
							<tr>
								<th class="text-center">
									#
								</th>
								<th>Tahun Ajaran</th>
								<th>status</th>
								<th>Status (Aktif / Tidak Aktif)</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$query = mysqli_query($koneksi, "SELECT * FROM tahun_ajaran");
							$no = 0;
							while ($tahun = mysqli_fetch_array($query)) {
								$no++;
							?>
								<tr>
									<td><?= $no; ?></td>
									<td><?= $tahun['tahun'] ?></td>
									<td>
										<?php if ($tahun['aktif'] == 'Y') { ?>
											<span class="badge badge-success">Aktif</span>
										<?php } else { ?>
											<span class="badge badge-danger">Tidak Aktif</span>
										<?php } ?>
									</td>
									<td>
										<form id="form-edit<?= $no ?>">
											<input type="hidden" name="id_tahun" value="<?= $tahun['id'] ?>">
											<div class="form-group">
												<label class="custom-switch mt-2">
													<input type="checkbox" name="status" class="custom-switch-input" value='1' <?php if ($tahun['aktif'] == 'Y') echo "checked"; ?>>
													<span class="custom-switch-indicator"></span>
													<span class="custom-switch-description"> Pilih Status</span>
												</label>
											</div>
										</form>
									</td>
									<td><button data-id="<?= $tahun['id'] ?>" class="hapus btn btn-danger">Hapus</button></td>
								</tr>
								<script>
									$('#form-edit<?= $no ?>').submit(function(e) {
										e.preventDefault();
										$.ajax({
											type: 'POST',
											url: 'mod_setting/crud_setting.php?pg=update_tahun_ajaran',
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
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
</div>
<script>
	$('input[name="status"]').change(function() {
		$(this).closest('form').submit();
	});
	$('#form-tambah-tahun').submit(function(e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'mod_setting/crud_setting.php?pg=tambah_tahun',
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

	$('#form-live').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			type: 'post',
			url: 'mod_setting/crud_setting.php?pg=live',
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

				iziToast.success({
					title: 'Mantap!',
					message: data,
					position: 'topRight'
				});
				setTimeout(function() {
					window.location.reload();
				}, 2000);


			}
		});
	});
</script>