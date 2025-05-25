-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table ppdb_dapit_1.bayar
CREATE TABLE IF NOT EXISTS `bayar` (
  `id_bayar` varchar(20) NOT NULL,
  `id_user` int NOT NULL,
  `id_daftar` int NOT NULL,
  `jumlah` int NOT NULL,
  `tgl_bayar` date NOT NULL,
  `keterangan` int DEFAULT NULL,
  `bukti` varchar(50) DEFAULT NULL,
  `verifikasi` int NOT NULL DEFAULT '0',
  `hapus` int DEFAULT NULL,
  PRIMARY KEY (`id_bayar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ppdb_dapit_1.bayar: ~6 rows (approximately)
INSERT INTO `bayar` (`id_bayar`, `id_user`, `id_daftar`, `jumlah`, `tgl_bayar`, `keterangan`, `bukti`, `verifikasi`, `hapus`) VALUES
	('202305250001', 0, 301, 150000, '2023-05-25', NULL, 'bukti_transaksi/bukti_202305250001.png', 1, NULL),
	('202505230001', 0, 316, 600000, '2025-05-23', NULL, 'bukti_transaksi/bukti_202505230001.png', 1, NULL),
	('202505240001', 0, 316, 50000, '2025-05-24', NULL, 'bukti_transaksi/bukti_202505240001.png', 1, NULL),
	('202505240002', 0, 316, 200000, '2025-05-24', NULL, 'bukti_transaksi/bukti_202505240002.png', 1, NULL),
	('202505250001', 0, 320, 500000, '2025-05-25', NULL, 'bukti_transaksi/bukti_202505250001.png', 1, NULL),
	('202505250002', 0, 320, 650000, '2025-05-25', NULL, 'bukti_transaksi/bukti_202505250002.png', 1, NULL),
	('202505260001', 0, 321, 500000, '2025-05-26', NULL, 'bukti_transaksi/bukti_202505260001.jpg', 1, NULL);

-- Dumping structure for table ppdb_dapit_1.biaya
CREATE TABLE IF NOT EXISTS `biaya` (
  `id_biaya` varchar(50) NOT NULL,
  `nama_biaya` varchar(200) NOT NULL,
  `jumlah` int NOT NULL,
  `status` varchar(200) NOT NULL,
  `id_jurusan` int DEFAULT NULL,
  PRIMARY KEY (`id_biaya`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ppdb_dapit_1.biaya: ~4 rows (approximately)
INSERT INTO `biaya` (`id_biaya`, `nama_biaya`, `jumlah`, `status`, `id_jurusan`) VALUES
	('FD2025', 'Biaya full day', 500000, '1', 1),
	('FDS', 'Uang gedung', 500000, '1', NULL),
	('PPDB2023', 'Pendaftaran', 150000, '1', NULL),
	('RE2025', 'Biaya Reguler', 100000, '1', 2);

-- Dumping structure for table ppdb_dapit_1.daftar
CREATE TABLE IF NOT EXISTS `daftar` (
  `id_daftar` int NOT NULL AUTO_INCREMENT,
  `no_daftar` varchar(20) DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `jenis` int DEFAULT NULL,
  `nis` varchar(30) DEFAULT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `no_kk` varchar(30) DEFAULT NULL,
  `nisn` varchar(30) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `warga_siswa` varchar(20) DEFAULT NULL,
  `foto` varchar(128) NOT NULL,
  `jenkel` varchar(1) DEFAULT NULL,
  `tempat_lahir` varchar(128) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `asal_sekolah` varchar(128) DEFAULT NULL,
  `npsn_asal` varchar(20) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `jurusan` varchar(30) DEFAULT '',
  `jenjang` varchar(11) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `status_tinggal` varchar(100) DEFAULT NULL,
  `alamat` text,
  `rt` varchar(5) DEFAULT NULL,
  `rw` varchar(5) DEFAULT NULL,
  `desa` varchar(128) DEFAULT NULL,
  `kecamatan` varchar(128) DEFAULT NULL,
  `kota` varchar(128) DEFAULT NULL,
  `provinsi` varchar(128) DEFAULT NULL,
  `kode_pos` varchar(6) DEFAULT NULL,
  `koordinat` varchar(100) DEFAULT NULL,
  `transportasi` varchar(128) DEFAULT NULL,
  `no_hp` varchar(16) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `anak_ke` int DEFAULT NULL,
  `saudara` int DEFAULT NULL,
  `biaya_sekolah` varchar(100) DEFAULT NULL,
  `paud` text,
  `tk` text,
  `hepatitis` varchar(10) DEFAULT NULL,
  `polio` varchar(10) DEFAULT NULL,
  `bcg` varchar(10) DEFAULT NULL,
  `campak` varchar(10) DEFAULT NULL,
  `dpt` varchar(10) DEFAULT NULL,
  `covid` varchar(10) DEFAULT NULL,
  `citacita` text,
  `hobi` text,
  `status_keluarga` varchar(50) DEFAULT NULL,
  `tinggal` varchar(128) DEFAULT NULL,
  `jarak` varchar(128) DEFAULT NULL,
  `waktu` varchar(128) DEFAULT NULL,
  `nik_ayah` varchar(16) DEFAULT NULL,
  `nama_ayah` varchar(128) DEFAULT NULL,
  `tempat_lahir_ayah` varchar(100) DEFAULT NULL,
  `tahun_ayah` date DEFAULT NULL,
  `status_ayah` varchar(128) DEFAULT NULL,
  `pendidikan_ayah` varchar(128) DEFAULT NULL,
  `pekerjaan_ayah` varchar(128) DEFAULT NULL,
  `penghasilan_ayah` varchar(128) DEFAULT NULL,
  `no_hp_ayah` varchar(16) DEFAULT NULL,
  `nik_ibu` varchar(16) DEFAULT NULL,
  `nama_ibu` varchar(128) DEFAULT NULL,
  `tempat_lahir_ibu` varchar(100) DEFAULT NULL,
  `tahun_ibu` date DEFAULT NULL,
  `status_ibu` varchar(128) DEFAULT NULL,
  `pendidikan_ibu` varchar(128) DEFAULT NULL,
  `pekerjaan_ibu` varchar(128) DEFAULT NULL,
  `penghasilan_ibu` varchar(128) DEFAULT NULL,
  `no_hp_ibu` varchar(16) DEFAULT NULL,
  `nik_wali` varchar(16) DEFAULT NULL,
  `nama_wali` varchar(128) DEFAULT NULL,
  `tempat_lahir_wali` varchar(100) DEFAULT NULL,
  `tahun_wali` date DEFAULT NULL,
  `pendidikan_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali` varchar(50) DEFAULT NULL,
  `penghasilan_wali` varchar(50) DEFAULT NULL,
  `no_hp_wali` varchar(16) DEFAULT NULL,
  `no_ijazah` varchar(128) DEFAULT NULL,
  `no_shun` varchar(128) DEFAULT NULL,
  `no_ujian` varchar(128) DEFAULT NULL,
  `no_kip` varchar(30) DEFAULT NULL,
  `kip` varchar(256) DEFAULT NULL,
  `kk` text,
  `kepala_keluarga` varchar(100) DEFAULT NULL,
  `ijazah` varchar(256) DEFAULT NULL,
  `akta` varchar(256) DEFAULT NULL,
  `file_shun` varchar(256) DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `alasan_keluar` varchar(100) DEFAULT NULL,
  `surat_keluar` varchar(255) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `aktif` int DEFAULT '0',
  `status` int DEFAULT '0',
  `sekolah_tujuan` varchar(10) DEFAULT NULL,
  `npsn_sekolah_tujuan` varchar(10) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `tgl_konfirmasi` date DEFAULT NULL,
  `konfirmasi` int DEFAULT NULL,
  `bayar` varchar(100) DEFAULT NULL,
  `online` int DEFAULT '0',
  `password` text,
  `jumlah` varchar(10) DEFAULT NULL,
  `ktp_ortu` varchar(256) DEFAULT NULL,
  `kps_pkh` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id_daftar`)
) ENGINE=InnoDB AUTO_INCREMENT=322 DEFAULT CHARSET=latin1;

-- Dumping data for table ppdb_dapit_1.daftar: ~7 rows (approximately)
INSERT INTO `daftar` (`id_daftar`, `no_daftar`, `id_siswa`, `jenis`, `nis`, `nik`, `no_kk`, `nisn`, `nama`, `warga_siswa`, `foto`, `jenkel`, `tempat_lahir`, `tgl_lahir`, `asal_sekolah`, `npsn_asal`, `kelas`, `jurusan`, `jenjang`, `agama`, `status_tinggal`, `alamat`, `rt`, `rw`, `desa`, `kecamatan`, `kota`, `provinsi`, `kode_pos`, `koordinat`, `transportasi`, `no_hp`, `email`, `anak_ke`, `saudara`, `biaya_sekolah`, `paud`, `tk`, `hepatitis`, `polio`, `bcg`, `campak`, `dpt`, `covid`, `citacita`, `hobi`, `status_keluarga`, `tinggal`, `jarak`, `waktu`, `nik_ayah`, `nama_ayah`, `tempat_lahir_ayah`, `tahun_ayah`, `status_ayah`, `pendidikan_ayah`, `pekerjaan_ayah`, `penghasilan_ayah`, `no_hp_ayah`, `nik_ibu`, `nama_ibu`, `tempat_lahir_ibu`, `tahun_ibu`, `status_ibu`, `pendidikan_ibu`, `pekerjaan_ibu`, `penghasilan_ibu`, `no_hp_ibu`, `nik_wali`, `nama_wali`, `tempat_lahir_wali`, `tahun_wali`, `pendidikan_wali`, `pekerjaan_wali`, `penghasilan_wali`, `no_hp_wali`, `no_ijazah`, `no_shun`, `no_ujian`, `no_kip`, `kip`, `kk`, `kepala_keluarga`, `ijazah`, `akta`, `file_shun`, `tgl_keluar`, `alasan_keluar`, `surat_keluar`, `level`, `aktif`, `status`, `sekolah_tujuan`, `npsn_sekolah_tujuan`, `tgl_daftar`, `tgl_konfirmasi`, `konfirmasi`, `bayar`, `online`, `password`, `jumlah`, `ktp_ortu`, `kps_pkh`) VALUES
	(294, 'PPDB2021001', 0, 1, '', '123456789123456', '123456789123456', '1234567899', 'SISWA 1', 'WNI', 'assets/upload/foto_siswa/siswa977.jpg', 'L', 'WONOGIRI', '2021-12-23', 'MIN 1 WONOGIRI', '678945', NULL, 'BS', NULL, 'Islam', 'Tinggal dengan Orangtua/Wali', 'JL TANDON', '02', '02', 'GIRIWONO', 'WONOGIRI', 'WONOGIRI', 'JAWA TENGAH', '57613', '-7.7921380, 110.9078180', 'Antar Jemput Sekolah', '081228603030', 'PREKETEK@GMAIL.COM', 1, 1, 'Orang Tua', 'Ya', 'Ya', 'Ya', 'Ya', 'Ya', 'Ya', 'Ya', 'Ya', 'Dokter', 'Membaca', '', '', 'Kurang dari 5 km', '10-19 menit', '33112212121212', 'KATEMIN', 'WONOGIRI', '1988-12-12', 'Masih Hidup', 'SMP/Sederajat', 'Seniman/Pelukis/Artis/Sejenis', '3.000.001 - 5.000.000', '087838553345', '1234567897898787', 'KATMI', 'WONOGIRI', '1988-12-12', 'Meninggal Dunia', 'S3', 'Politikus', 'Lebih dari 5.000.000', '087838553345', '', '', NULL, '0000-00-00', '', '', '', '', NULL, NULL, NULL, '', 'assets/upload/kip/kip773.jpg', 'assets/upload/kk/kk979.jpg', 'KASNO DIMEJO', 'assets/upload/ijazah/ijazah31.jpg', 'assets/upload/akta/akta266.jpg', NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, '2022-01-10', 1, NULL, 1, '123456', '200', NULL, NULL),
	(310, 'PPDB2025013', 0, 1, NULL, NULL, NULL, '12221274', 'Ranti', NULL, 'default.png', NULL, 'Tasikmalaya', '2025-05-06', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0987655679', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '12221274', NULL, NULL, NULL),
	(311, 'PPDB2025014', 0, 1, NULL, NULL, NULL, '12221275', 'FERLA', NULL, 'default.png', NULL, 'Tasikmalaya', '2025-05-06', '', '', NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123456789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, '12221275', NULL, NULL, NULL),
	(312, 'PPDB2025015', 0, 1, NULL, NULL, NULL, '12221273', 'Tesa', NULL, 'default.png', NULL, '', '0000-00-00', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0898763455', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '12221273', NULL, NULL, NULL),
	(316, 'PPDB2025019', 0, 1, NULL, NULL, NULL, '12345', 'Joni', NULL, 'default.png', NULL, NULL, NULL, 'SD N KERDONMIRI II', '69977331', 'KLS6831a4ce925b8', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '082268231871', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'assets/upload/kk/kk316.jpg', NULL, NULL, 'assets/upload/akta/akta316.jpg', NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, '2025-05-23', 1, NULL, 1, '12345', NULL, 'assets/upload/ktp_ortu/ktp_ortu316.jpg', 'assets/upload/kps_pkh/kps_pkh316.jpg'),
	(317, 'PPDB2025020', NULL, 1, NULL, NULL, NULL, '1234566666', 'UJANG', NULL, 'default.png', NULL, 'Tokyo', '2025-05-23', '', '', NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '832937483433', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'assets/upload/kk/kk317.png', NULL, NULL, 'assets/upload/akta/akta317.jpg', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ujang123', NULL, 'assets/upload/ktp_ortu/ktp_ortu317.png', 'assets/upload/kps_pkh/kps_pkh317.png'),
	(318, 'PPDB2025021', NULL, 1, NULL, NULL, NULL, '12738323923', 'RISA HIMAWARI', NULL, 'default.png', NULL, 'Tokyo', '2025-05-24', '', '', 'KLS6831a9c408ea2', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8377326372', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'assets/upload/kk/kk318.png', NULL, NULL, 'assets/upload/akta/akta318.png', NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, '2025-05-24', 1, NULL, 1, 'risa123', NULL, 'assets/upload/ktp_ortu/ktp_ortu318.png', 'assets/upload/kps_pkh/kps_pkh318.png'),
	(320, 'PPDB2025022', NULL, 1, NULL, NULL, NULL, '12938494394', 'MAMAN MACAN', NULL, 'default.png', NULL, 'Tokyo', '2031-03-31', '', '', 'KLS6831a4ce925b8', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8273823728', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'assets/upload/kk/kk320.png', NULL, NULL, 'assets/upload/akta/akta320.png', NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL, NULL, '2025-05-25', 1, NULL, 1, 'maman123', NULL, 'assets/upload/ktp_ortu/ktp_ortu320.png', 'assets/upload/kps_pkh/kps_pkh320.png'),
	(321, 'PPDB2025023', NULL, 1, NULL, NULL, NULL, '19389239238923', 'ABDUL', NULL, 'default.png', NULL, 'Bandung', '2025-05-26', '', '', 'KLS6831a9c408ea2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0923923923', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'assets/upload/kk/kk321.jpg', NULL, NULL, 'assets/upload/akta/akta321.jpg', NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, '2025-05-26', 1, NULL, 1, 'abdul123', NULL, 'assets/upload/ktp_ortu/ktp_ortu321.jpg', 'assets/upload/kps_pkh/kps_pkh321.jpg');

-- Dumping structure for table ppdb_dapit_1.formulir
CREATE TABLE IF NOT EXISTS `formulir` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_pendaftaran` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_daftar` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kategori` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_siswa` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nomor_induk` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `anak_ke` int DEFAULT NULL,
  `jumlah_saudara` int DEFAULT NULL,
  `status_keluarga` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat_rumah` text COLLATE utf8mb4_general_ci,
  `alamat_sekarang` text COLLATE utf8mb4_general_ci,
  `kelas_diterima` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_diterima` date DEFAULT NULL,
  `sekolah_asal` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat_sekolah_asal` text COLLATE utf8mb4_general_ci,
  `sttb_tahun` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sttb_nomor` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_ayah` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_ibu` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `agama_ortu` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat_ortu` text COLLATE utf8mb4_general_ci,
  `pekerjaan_ayah` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pekerjaan_ibu` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pendidikan_ayah` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pendidikan_ibu` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penghasilan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_wali` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `agama_wali` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat_wali` text COLLATE utf8mb4_general_ci,
  `pendidikan_wali` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pekerjaan_wali` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ppdb_dapit_1.formulir: ~2 rows (approximately)
INSERT INTO `formulir` (`id`, `no_pendaftaran`, `no_daftar`, `kategori`, `nama_siswa`, `nomor_induk`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `anak_ke`, `jumlah_saudara`, `status_keluarga`, `alamat_rumah`, `alamat_sekarang`, `kelas_diterima`, `tanggal_diterima`, `sekolah_asal`, `alamat_sekolah_asal`, `sttb_tahun`, `sttb_nomor`, `nama_ayah`, `nama_ibu`, `agama_ortu`, `alamat_ortu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `pendidikan_ayah`, `pendidikan_ibu`, `penghasilan`, `nama_wali`, `agama_wali`, `alamat_wali`, `pendidikan_wali`, `pekerjaan_wali`) VALUES
	(18, 'PSB-250522-3701', '316', '1', 'Joni', '12823823232', 'Laki-laki', 'Tokyo', '2002-02-02', 3, 3, 'ANAK', 'kadksad dksakdksa', 'kadksad dksakdksa', '1', '2025-05-22', 'ksadksakd', 'dkskkdsa', 'skadkas', 'ksakdksa', 'kadksakd', 'ksadmksa', 'ksakd', 'kadksad dksakdksa', 'Politikus', 'Pegawai Swasta', 'Diploma I/II', 'S1 (Sarjana)', 'Kurang dari Rp.500.000', 'adsajdjsad', 'sakdksakdsa', 'skdksakd', 'SMP/MTs/Paket B', 'Dokter'),
	(19, 'PSB-250523-5004', '317', '1', 'Ujang ganteng', '12823823233', 'Laki-laki', 'Tokyo', '2222-02-22', 3, 3, 'anak', 'manonjaya', 'manonjaya', '1', '2223-02-22', 'ksadksakd', 'dkskkdsa', 'skadkas', 'ksakdksa', 'Dedi kusnandar', 'ksadmksa', 'Islam', 'manonjaya', 'Buruh', 'Petani/Peternak', 'SMA/MA/SMK/Paket C', 'Diploma I/II', 'Rp.3.000.001 s/d Rp.5.000.000', 'Dedi kusnandar', 'Islam', 'manonjaya', 'SMA/MA/SMK/Paket C', 'Buruh'),
	(23, 'PSB-250524-1830', '318', '2', 'Risa Himawari', '128328382738', 'Perempuan', 'Tokyo', '2031-02-21', 3, 3, 'Anak', 'Desa manonjaya, kec.Manonjaya, Kab,Tasikmalaya, Prov.Jawa Barat', 'Desa manonjaya, kec.Manonjaya, Kab,Tasikmalaya, Prov.Jawa Barat', '1', '2034-07-03', 'Fuji Yochien', 'Jepang', '2033', '923823293232323', 'Dedi kusnandar', 'Mizuhara', 'Islam', 'Desa manonjaya, kec.Manonjaya, Kab,Tasikmalaya, Prov.Jawa Barat', 'Wiraswasta/Pedagang', 'Seni/Lukis/Artis/Sejenis', 'S1 (Sarjana)', 'S1 (Sarjana)', 'Lebih dari Rp.5.000.001', 'Mizuhara', 'Islam', 'Desa manonjaya, kec.Manonjaya, Kab,Tasikmalaya, Prov.Jawa Barat', 'S1 (Sarjana)', 'Seni/Lukis/Artis/Sejenis'),
	(24, 'PSB-250525-8254', '320', '1', 'Maman macan', '12938832832392', 'Laki-laki', 'Tokyo', '2031-04-09', 1, 2, 'Anak', 'Desa manonjaya, kec.Manonjaya, Kab,Tasikmalaya, Prov.Jawa Barat', 'Desa manonjaya, kec.Manonjaya, Kab,Tasikmalaya, Prov.Jawa Barat', '1', '2035-07-03', 'Fuji Yochien', 'Jepang', '2033', '923823293232323', 'Dedi kusnandar', 'Mizuhara', 'Islam', 'Desa manonjaya, kec.Manonjaya, Kab,Tasikmalaya, Prov.Jawa Barat', 'Guru/Dosen', 'Dokter', 'Diploma I/II', 'S1 (Sarjana)', 'Rp.3.000.001 s/d Rp.5.000.000', 'Dedi kusnandar', 'Islam', 'Desa manonjaya, kec.Manonjaya, Kab,Tasikmalaya, Prov.Jawa Barat', 'Diploma I/II', 'Guru/Dosen'),
	(25, 'PSB-250526-1703', '321', '2', 'Abdul', '19283923923323', 'Laki-laki', 'Bandung', '2009-02-25', 1, 1, 'anak', 'jln.contoh no 10', 'jln.contoh no 10', '1', '2025-06-06', 'Fuji Yochien', 'Jepang', '2033', '923823293232323', 'nanang', 'alya', 'Islam', 'jln.contoh no 10', 'TNI/POLRI', 'Lainnya', 'SD/MI/Paket A', 'Diploma I/II', 'Lebih dari Rp.5.000.001', 'alya', 'Islam', 'jln.contoh no 10', 'Diploma I/II', 'Lainnya');

-- Dumping structure for table ppdb_dapit_1.guru
CREATE TABLE IF NOT EXISTS `guru` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_guru` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `pendidikan_terakhir` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `wali_kelas` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ppdb_dapit_1.guru: ~2 rows (approximately)
INSERT INTO `guru` (`id`, `nama_guru`, `pendidikan_terakhir`, `wali_kelas`, `foto`) VALUES
	(1, 'Bu Sitii', 'S1 PGSDd', 'KLS6831a4ce925b8', 'siti.png'),
	(10, 'Risa', 'D3', '', 'foto_68327bdc035f6.jpg'),
	(11, 'Tesa', 'D3', 'KLS6831a9c408ea2', 'foto_68327cae30fcf.jpg'),
	(12, 'Bu aneng', 'S1 PGSD', '', 'foto_6832da9280d3d.png');

-- Dumping structure for table ppdb_dapit_1.histori
CREATE TABLE IF NOT EXISTS `histori` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_permohonan` varchar(30) NOT NULL,
  `nik` int NOT NULL,
  `status` int NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ppdb_dapit_1.histori: ~0 rows (approximately)

-- Dumping structure for table ppdb_dapit_1.jenis
CREATE TABLE IF NOT EXISTS `jenis` (
  `id_jenis` varchar(50) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ppdb_dapit_1.jenis: ~3 rows (approximately)
INSERT INTO `jenis` (`id_jenis`, `nama_jenis`, `status`) VALUES
	('KH', 'Khusus', 1),
	('PD', 'Pindahan', 1),
	('SB', 'Siswa Baru', 1);

-- Dumping structure for table ppdb_dapit_1.jenjang
CREATE TABLE IF NOT EXISTS `jenjang` (
  `id_jenjang` varchar(5) NOT NULL,
  `nama_jenjang` varchar(50) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `wali` int NOT NULL,
  PRIMARY KEY (`id_jenjang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ppdb_dapit_1.jenjang: ~0 rows (approximately)

-- Dumping structure for table ppdb_dapit_1.jurusan
CREATE TABLE IF NOT EXISTS `jurusan` (
  `id_jurusan` int NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  `kuota` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `jumlah_pendaftar` int DEFAULT '0',
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ppdb_dapit_1.jurusan: ~2 rows (approximately)
INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `kuota`, `status`, `jumlah_pendaftar`) VALUES
	(1, 'FULL DAY SCHOOL', 25, 1, 0),
	(2, 'REGULER', 25, 1, 0);

-- Dumping structure for table ppdb_dapit_1.kelas
CREATE TABLE IF NOT EXISTS `kelas` (
  `id_kelas` varchar(50) NOT NULL,
  `nama_kelas` varchar(100) DEFAULT NULL,
  `kuota` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ppdb_dapit_1.kelas: ~1 rows (approximately)
INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `kuota`, `status`) VALUES
	('KLS6831a4ce925b8', 'Kelas A', 25, 1),
	('KLS6831a9c408ea2', 'Kelas B', 25, 1);

-- Dumping structure for table ppdb_dapit_1.kontak
CREATE TABLE IF NOT EXISTS `kontak` (
  `id_kontak` int NOT NULL AUTO_INCREMENT,
  `nama_kontak` varchar(50) DEFAULT NULL,
  `no_kontak` varchar(50) DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id_kontak`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ppdb_dapit_1.kontak: ~2 rows (approximately)
INSERT INTO `kontak` (`id_kontak`, `nama_kontak`, `no_kontak`, `status`) VALUES
	(1, 'CS 1', '089999999999', 1),
	(2, 'CS 2', '082222222', 1);

-- Dumping structure for table ppdb_dapit_1.pengumuman
CREATE TABLE IF NOT EXISTS `pengumuman` (
  `id_pengumuman` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pengumuman` text,
  `tgl` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jenis` int DEFAULT '0',
  PRIMARY KEY (`id_pengumuman`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ppdb_dapit_1.pengumuman: ~3 rows (approximately)
INSERT INTO `pengumuman` (`id_pengumuman`, `id_user`, `judul`, `pengumuman`, `tgl`, `jenis`) VALUES
	(2, 5, 'Info Aplikasi', '<p style="color: rgb(108, 117, 125);"><span style="font-weight: bolder;">Gelombang Pertama</span>&nbsp;Tanggal 1 Desember 2023 Sampai 30 Mei 2023&nbsp;<span style="font-weight: bolder;">Gelombang Kedua&nbsp;</span>Tanggal 1 Juni Sampai Tanggal 30 Juni 2023</p><p style="color: rgb(108, 117, 125);">Note: Pendaftaran Gelombang Pertama Gratis Biaya Pendaftaran dan Biaya Daftar Ulang</p><p style="color: rgb(108, 117, 125);"><br></p>', '2023-05-24 05:58:08', 1),
	(3, 5, 'Info PPDB Online 2023', '<p><b>Gelombang Pertama</b>Â Tanggal 1 Desember 2023 Sampai 30 Mei 2023Â <b>Gelombang Kedua </b>Tanggal 1 Juni Sampai Tanggal 30 Juni 2023</p><p>Note: Pendaftaran Gelombang Pertama Gratis Biaya Pendaftaran dan Biaya Daftar Ulang</p>', '2023-05-21 06:30:10', 2),
	(6, 5, 'Lorem', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate officiis autem facere fugiat pariatur magnam facilis quidem accusamus, enim rem sit, ducimus dolorum adipisci eius fuga impedit ex voluptatum hic iusto temporibus praesentium quo! Necessitatibus mollitia, tenetur nemo modi, incidunt nisi accusamus neque quasi officiis reprehenderit quos, consectetur sint dicta.', '2025-05-25 06:18:27', 0),
	(7, 5, 'Info segera bayar', '<p>sdksdkskds kdks</p>', '2025-05-25 15:52:48', 1);

-- Dumping structure for table ppdb_dapit_1.sekolah
CREATE TABLE IF NOT EXISTS `sekolah` (
  `npsn` varchar(16) NOT NULL,
  `nama_sekolah` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`npsn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ppdb_dapit_1.sekolah: ~2 rows (approximately)
INSERT INTO `sekolah` (`npsn`, `nama_sekolah`, `alamat`, `status`) VALUES
	('20402445', 'Mi Condong', 'Komplek Pst.Condong, Setianagara, Cibeureum, Kota ', 1),
	('69977331', 'SD N KERDONMIRI II', 'Jl. Karangwetan,Rongkop,Gunungkidul', 1);

-- Dumping structure for table ppdb_dapit_1.setting
CREATE TABLE IF NOT EXISTS `setting` (
  `id_setting` int NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `jenjang` int NOT NULL,
  `nsm` varchar(30) NOT NULL,
  `npsn` varchar(30) DEFAULT NULL,
  `status` text NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kota` varchar(30) DEFAULT NULL,
  `provinsi` varchar(30) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `favicon` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_telp` varchar(50) DEFAULT NULL,
  `klikchat` text,
  `livechat` text,
  `nolivechat` varchar(50) DEFAULT NULL,
  `infobayar` text,
  `syarat` text,
  `kab` text NOT NULL,
  `kec` text NOT NULL,
  `web` text NOT NULL,
  `kepala` text NOT NULL,
  `nip` text NOT NULL,
  `ppdb` text,
  `kop` varchar(50) NOT NULL,
  `logo_ppdb` varchar(100) NOT NULL,
  `tgl_pengumuman` date NOT NULL,
  `tgl_tutup` date NOT NULL,
  PRIMARY KEY (`id_setting`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ppdb_dapit_1.setting: ~1 rows (approximately)
INSERT INTO `setting` (`id_setting`, `nama_sekolah`, `jenjang`, `nsm`, `npsn`, `status`, `alamat`, `kota`, `provinsi`, `logo`, `favicon`, `email`, `no_telp`, `klikchat`, `livechat`, `nolivechat`, `infobayar`, `syarat`, `kab`, `kec`, `web`, `kepala`, `nip`, `ppdb`, `kop`, `logo_ppdb`, `tgl_pengumuman`, `tgl_tutup`) VALUES
	(1, 'MI CONDONG', 0, '-', '20402448', 'Swasta', 'Komplek Pst. Condong, Setianagara, Cibeureum', 'Tasikmalaya', 'Jawa Barat', 'assets/img/logo/logo518.png', NULL, 'micondong@gmail.com', '-', 'Assalamu Alaikum\r\n\r\nMohon informasi PPDB', 'Assalamu Alaikum\r\n\r\nMohon informasi PPDB', '087828116091', '<p>Pembayaran Pendaftaran bisa di transfer melalui :</p><p>BRI - 12353435 - MI Condong</p><p>BCA - 123513 - MI Condong</p>', '<p><br></p><ol><li>Surat Keterangan Lulus</li><li>Akta Kelahiran</li><li>Kartu Keluarga</li></ol>', '', '', '-', 'Cece Insan Kamil S.Ag', '-', '1', 'assets/img/kop/kop458.png', 'assets/img/logo/logo_ppdb430.png', '2025-04-29', '2021-05-20');

-- Dumping structure for table ppdb_dapit_1.siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `id_siswa` int NOT NULL AUTO_INCREMENT,
  `no` int NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nisn` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `kelas` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `foto_profil` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ppdb_dapit_1.siswa: ~0 rows (approximately)
INSERT INTO `siswa` (`id_siswa`, `no`, `nama`, `nisn`, `password`, `kelas`, `status`, `foto_profil`) VALUES
	(1, 12345, 'joni', '12345', '12345', 'XI', 1, NULL);

-- Dumping structure for table ppdb_dapit_1.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(128) NOT NULL,
  `level` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` text NOT NULL,
  `status` int NOT NULL,
  `foto` int NOT NULL,
  `mapel` text NOT NULL,
  `nuptk` text NOT NULL,
  `jenkel` varchar(20) NOT NULL,
  `tempat_lahir` text NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tmt` year NOT NULL,
  `no_sk` text NOT NULL,
  `jenis` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `nik` int NOT NULL,
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

-- Dumping data for table ppdb_dapit_1.user: ~2 rows (approximately)
INSERT INTO `user` (`id_user`, `nama_user`, `level`, `username`, `password`, `status`, `foto`, `mapel`, `nuptk`, `jenkel`, `tempat_lahir`, `tgl_lahir`, `tmt`, `no_sk`, `jenis`, `no_hp`, `nik`) VALUES
	(5, 'ADMIN', 'admin', 'admin', '$2y$10$kqHkA.usgKh4TNcJJH1h..Pvn.puyeNgYZWncJo3pfXm.nlAkiP6C', 1, 0, '', '', '', '', '0000-00-00', '0000', '', '', '', 0),
	(64, 'admin2', 'admin', 'admin2', '$2y$10$T/MZ7XLIytMie1oHcxZET.1cNa967mS7y/1RrPoriFCqUd8jTkIyO', 1, 0, '', '', '', '', '0000-00-00', '0000', '', '', '', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
