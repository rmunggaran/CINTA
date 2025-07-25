<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>

<?php
// Ambil nilai parameter pg dari URL
$pg = isset($_GET['pg']) ? $_GET['pg'] : '';

// Routing halaman berdasarkan nilai 'pg'
switch ($pg) {
    case 'guru':
        include "mod_guru/master_guru.php";
        break;
    case 'df_ulang':
        include "mod_daftar/daftarulang.php";
        break;
    case 'daftar':
        include "mod_daftar/daftar.php";
        break;
    case 'berkas_ppdb':
        include "mod_daftar/daftar_berkas.php";
        break;
    case 'l_ppdbyes':
        include "mod_laporan/laporanyes.php";
        break;
    case 'l_ppdbyes_diterima':
        include "mod_laporan/laporanyes_diterima.php";
        break;
    case 'l_ppdbyes_ditolak':
        include "mod_laporan/laporanyes_ditolak.php";
        break;
    case 'move':
        include "mod_daftar/move.php";
        break;
    case 'ubahsiswa':
        include "mod_siswa/formulir.php";
        break;
    case 'ubahdaftar':
        include "mod_daftar/formulir.php";
        break;
    case 'profil_lembaga':
        include "mod_setting/profil_lembaga.php";
        break;
    case 'detail':
    case 'detailsiswa':
        include "mod_daftar/detail.php";
        break;
    case 'diterima':
        include "mod_daftar/daftar_diterima.php";
        break;
    case 'ditolak':
        include "mod_daftar/daftar_ditolak.php";
        break;
    case 'siswa':
        include "mod_siswa/daftar.php";
        break;
    case 'ubah_kelas':
        include "mod_siswa/ubah_kelas.php";
        break;
    case 'akunppdb':
        include "mod_laporan/kartu.php";
        break;
    case 'masuk':
        include "mod_siswa/mutasi_masuk.php";
        break;
    case 'backup':
        include "backup_restore/backup-data.php";
        break;
    case 'restore':
        include "backup_restore/restore.php";
        break;
    case 'pindah':
        include "mod_siswa/mutasi_keluar.php";
        break;
    case 'rekapsiswa':
        include "mod_siswa/ringkasan.php";
        break;
    case 'luluskan':
        include "mod_siswa/luluskan.php";
        break;
    case 'alumni':
        include "mod_siswa/alumni.php";
        break;
    case 'detail_gtk':
        include "mod_gtk/detail.php";
        break;
    case 'sekolah':
        cek_login_admin();
        include "mod_sekolah/sekolah.php";
        break;
    case 'kelas':
        cek_login_admin();
        include "mod_jenjang/jenjang.php";
        break;
    case 'dt_kelas':
        cek_login_admin();
        include "mod_jenjang/daftar_anggota.php";
        break;
    case 'jurusan':
        cek_login_admin();
        include "mod_jurusan/jurusan.php";
        break;
    // case 'jenis':
    //     cek_login_admin();
    //     include "mod_jenis/jenis.php";
    //     break;
    case 'biaya':
        cek_login_admin();
        include "mod_biaya/biaya.php";
        break;
    case 'bayar':
        include "mod_bayar/bayar.php";
        break;
    case 'bayar_spp':
        include "mod_bayar_spp/bayar_spp.php";
        break;
    case 'user-profile':
        include "mod_user/user-profile.php";
        break;
    case 'user':
        cek_login_admin();
        include "mod_user/user.php";
        break;
    case 'usersiswa':
        cek_login_admin();
        include "mod_user/usersiswa.php";
        break;
    case 'setting':
        cek_login_admin();
        include "mod_setting/setting.php";
        break;
    case 'setting2':
        cek_login_admin();
        include "mod_setting/setting2.php";
        break;
    case 's_ppdb':
        include "mod_setting/s_ppdb.php";
        break;
    case 's_spp':
        include "mod_setting/s_spp.php";
        break;
    case 'kontak':
        cek_login_admin();
        include "mod_kontak/kontak.php";
        break;
    case 'infobayar':
        cek_login_admin();
        include "mod_web/pembayaran.php";
        break;
    case 'syarat':
        cek_login_admin();
        include "mod_web/syarat.php";
        break;
    case 'pengumuman':
        cek_login_admin();
        include "mod_pengumuman/pengumuman.php";
        break;
}
?>
