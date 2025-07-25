 <?php
    $akhir  = new DateTime($setting['tgl_pengumuman']); //Waktu awal
    $awal = new DateTime(); // Waktu sekarang atau akhir
    $diff  = $awal->diff($akhir);

    ?>
 <ul class="sidebar-menu ">
     <li class="menu-header bg-warning"></li>



     <?php if ($user['level'] == 'admin') { ?>
     <?php } ?>

     <li class="dropdown ">
         <a href="#" class="nav-link has-dropdown"><i class="fas fa-home fa-fw"></i> <span>Kelembagaan</span></a>
         <ul class="dropdown-menu">
             <li><a class="nav-link" href="?pg=profil_lembaga">Profil Lembaga</a></li>
         </ul>
     </li>

     <li class="dropdown ">
         <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-friends"></i> <span>Data PPDB</span></a>
         <ul class="dropdown-menu">
             <li><a class="nav-link" href="?pg=daftar">Verifikasi</a></li>
             <!-- <li><a class="nav-link" href="?pg=berkas_ppdb">Daftar Berkas</a></li> -->
             <li><a class="nav-link text-success" href="?pg=diterima">Data Diterima</a></li>
             <li><a class="nav-link text-warning" href="?pg=df_ulang">Siswa Daftar Ulang</a></li>
             <li><a class="nav-link text-danger" href="?pg=ditolak">Ditolak / Revisi</a></li>
             <li><a class="nav-link" href="?pg=bayar">Pembayaran PPBD</a></li>
         </ul>
     </li>
     <?php if ($user['level'] == 'admin') { ?>
         <li class="dropdown ">
             <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire fa-fw"></i> <span>Data Master</span></a>
             <ul class="dropdown-menu">
                 <!-- <li><a class="nav-link" href="?pg=sekolah">Master Sekolah</a></li> -->
                 <li><a class="nav-link text-success" href="?pg=kelas">Master Kelas</a></li>
                 <li><a class="nav-link" href="?pg=jurusan">Jenis Pendidikan</a></li>
                 <!-- <li><a class="nav-link" href="?pg=jenis">Master Jenis Daftar</a></li> -->
             </ul>
         </li>

         <?php if ($user['level'] == 'admin') { ?>
             <li class="dropdown">
                 <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-friends"></i> <span>Data Guru</span></a>
                 <ul class="dropdown-menu">
                     <li><a class="nav-link" href="?pg=guru">Master Guru</a></li>
                 </ul>
             </li>
         <?php } ?>

     <?php } ?>
     <?php if ($user['level'] == 'admin') { ?>
         <li class="dropdown ">
             <a href="#" class="nav-link has-dropdown"><i class="fas fa-book"></i> <span>Cetak Data PPDB</span></a>
             <ul class="dropdown-menu">
                 <li><a class="nav-link" href="?pg=l_ppdbyes">Semua Data</a></li>
                 <li><a class="nav-link" href="?pg=l_ppdbyes_diterima">Data Diterima</a></li>
                 <li><a class="nav-link" href="?pg=l_ppdbyes_ditolak">Data Ditolak / Revisi</a></li>


             </ul>
         </li>
         <li class="dropdown ">
             <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i> <span>Akun</span></a>
             <ul class="dropdown-menu">
                 <li><a class="nav-link" href="?pg=user">Akun Admin</a></li>
                 <li><a class="nav-link" href="?pg=usersiswa">Akun Siswa</a></li>


             </ul>
         </li>
     <?php } ?>


     <?php if ($akhir <= $awal) { ?>
     <?php } ?>



     <div class="mt-4 p-3 hide-sidebar-mini">
         <button type="button" class="btn btn-primary btn-lg btn-block btn-icon-split" data-toggle="modal" data-target="#ppdb">
             <i class="fas fa-web"></i> Aktifkan PPDB
         </button>
     </div>
     <div class="p-3 hide-sidebar-mini">
         <button type="button" class="btn btn-success btn-lg btn-block btn-icon-split" data-toggle="modal" data-target="#tahun_ajaran">
             <i class="fas fa-web"></i> Tahun ajaran baru
         </button>
     </div>
 </ul>
 <div class="modal fade" id="ppdb" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form id="form-ppdb">
                 <div class="modal-header">
                     <h5 class="modal-title">Silahkan Pilih Tanggal PPDB</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">

                     Silahkan Sesuaikan Tanggal Mulai PPDB DISINI
                     <input type="date" name="tgl_pengumuman" class="form-control" value="<?= $setting['tgl_pengumuman'] ?>">


                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Simpan</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <div class="modal fade" id="tahun_ajaran" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form id="form-tahun-ajaran">
                 <div class="modal-header">
                     <h5 class="modal-title">Silahkan masukan tahun ajaran</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     Silahkan pilih tahun ajaran yang ingin di aktifkan
                     <select class="form-control" name="id_tahun" required>
                         <option disabled selected>Pilih Tahun Ajaran</option>
                         <?php
                            $q = mysqli_query($koneksi, "SELECT * FROM tahun_ajaran ORDER BY tahun DESC");
                            while ($t = mysqli_fetch_assoc($q)) {
                                $selected = ($t['aktif'] == 'Y') ? 'selected' : '';
                                echo "<option value='{$t['id']}' $selected>{$t['tahun']}</option>";
                            }
                            ?>
                     </select>
                     <br>
                     <p>Setiap penambahan tahun ajaran baru sistem akan otomatis memperbarui jenjang kelas.</p>

                 </div>
                 <div class="modal-footer">
                     <a href="?pg=setting" class="btn btn-secondary">Tambah Tahun Ajaran</a>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Simpan</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <script>
     $('#form-ppdb').submit(function(e) {
         e.preventDefault();
         $.ajax({
             type: 'POST',
             url: 'mod_setting/crud_setting.php?pg=aktifppdb',
             data: $(this).serialize(),
             success: function(data) {
                 if (data == 'ok') {
                     iziToast.success({
                         title: 'Mantap!',
                         message: 'Data Berhasil diaktifkan',
                         position: 'topRight'
                     });
                     setTimeout(function() {
                         window.location.reload();
                     }, 2000);
                     $('#tambahdata').modal('hide');
                 } else {
                     iziToast.error({
                         title: 'Maaf!',
                         message: 'Data Gagal ditambahkan ',
                         position: 'topRight'
                     });
                 }
                 //$('#bodyreset').load(location.href + ' #bodyreset');
             }
         });
         return false;
     });
     $('#form-tahun-ajaran').submit(function(e) {
         e.preventDefault();
         $.ajax({
             type: 'POST',
             url: 'mod_setting/crud_setting.php?pg=update_tahun_ajaran',
             data: $(this).serialize(),
             success: function(data) {
                 if (data == 'ok') {
                     iziToast.success({
                         title: 'Mantap!',
                         message: 'Data Berhasil Tahun Ajaran berhasil di update',
                         position: 'topRight'
                     });
                     setTimeout(function() {
                         window.location.reload();
                     }, 2000);
                     $('#tambahdata').modal('hide');
                 } else {
                     iziToast.error({
                         title: 'Maaf!',
                         message: 'Data Gagal ditambahkan ',
                         position: 'topRight'
                     });
                 }
                 //$('#bodyreset').load(location.href + ' #bodyreset');
             }
         });
         return false;
     });
 </script>