-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: 2023_pps
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `kelas_mengajar`
--

DROP TABLE IF EXISTS `kelas_mengajar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kelas_mengajar` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` int DEFAULT NULL,
  `semester_id` int DEFAULT NULL,
  `mapel_id` int DEFAULT NULL,
  `rombel_walas_id` int DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=358 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kelas_presensi`
--

DROP TABLE IF EXISTS `kelas_presensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kelas_presensi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `mapel_mengajar_id` int NOT NULL,
  `siswa_kelas_id` int NOT NULL,
  `jam_ke` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pertemuan_ke` int DEFAULT NULL,
  `kehadiran` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13328 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_guru`
--

DROP TABLE IF EXISTS `m_guru`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_guru` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nuptk` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nm_guru` varchar(100) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `m_siswa`
--

DROP TABLE IF EXISTS `m_siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_siswa` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nisn` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `jk` varchar(12) NOT NULL,
  `nama_ortu` varchar(100) NOT NULL,
  `hp_ortu` varchar(20) NOT NULL,
  `is_active` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1158 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `m_siswa_kelas`
--

DROP TABLE IF EXISTS `m_siswa_kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_siswa_kelas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `rombel_id` int unsigned DEFAULT NULL,
  `siswa_id` int unsigned DEFAULT NULL,
  `status_kelas` varchar(50) DEFAULT NULL,
  `status_naik_kelas` varchar(50) DEFAULT NULL,
  `ket_naik_kelas` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1253 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `mapel`
--

DROP TABLE IF EXISTS `mapel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mapel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mapel` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mapel`
--

/*!40000 ALTER TABLE `mapel` DISABLE KEYS */;
INSERT INTO `mapel` VALUES (1,'Al-Qur\'an / Adillah Fiqh'),(2,'Tajwid / Tahsinul Qiraah'),(3,'Tahfidzh al-Qur\'an'),(4,'Hadits'),(5,'Nahwu'),(6,'Sharaf'),(7,'Al Jurumiah'),(8,'Tahqiq Al-Miftah'),(9,'Tasmi\' Al Miftah'),(10,'Tasmi\' Sharaf'),(11,'Tarekh'),(12,'SKI'),(13,'Balaghah'),(14,'Ushul Fiqh'),(15,'Qawa\'id al-Fiqhiyah'),(16,'Mazahib'),(17,'Mantiq'),(18,'Ilmu Tafsir'),(19,'Ilmu Hadits'),(20,'Ketarbiyahan'),(21,'BAM'),(22,'Tauhid'),(23,'Akidah Akhlak'),(24,'Ilmu Kalam'),(25,'Akhlak / Tashauf'),(26,'Akhlak (IIK)'),(27,'Fiqih'),(28,'Fiqih Syariah'),(29,'Pengetahuan Sosial'),(30,'PPKN'),(31,'Sejarah Nasional'),(32,'Geografi'),(33,'Ekonomi'),(34,'Sosiologi'),(35,'Pengetahuan Alam'),(36,'Matematika'),(37,'Fisika'),(38,'Biologi'),(39,'Kimia'),(40,'Tafsir-Ilmu Tafsir'),(41,'Hadits-Ilmu Hadits'),(42,'Fikih-Ushul Fikih'),(43,'Bahasa Indonesia'),(44,'Bahasa Inggris'),(45,'Bahasa Arab'),(46,'Praktek Ibadah'),(47,'Matematika Peminatan'),(48,'Sejarah Peminatan'),(49,'Bahasa Arab Peminatan'),(50,'INFORMATIKA'),(51,'Al-Qur\'an Hadits');
/*!40000 ALTER TABLE `mapel` ENABLE KEYS */;

--
-- Table structure for table `pelanggaran_item`
--

DROP TABLE IF EXISTS `pelanggaran_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pelanggaran_item` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `jenis_id` int NOT NULL,
  `nama_pelanggaran` text,
  `poin` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelanggaran_item`
--

/*!40000 ALTER TABLE `pelanggaran_item` DISABLE KEYS */;
INSERT INTO `pelanggaran_item` VALUES (1,1,'Mencemarkan nama baik Madrasah, baik di lingkungan Madarasah dan di luar 100 |\nMadrasah',100),(2,1,'Melakukan perbuatan asusila',100),(3,1,'Menyalahgunakan obat-obatan terlarang/ narkotika (menghisap ganja, memakai morphin, minum-minuman keras, tawuran, menghisap lem, main judi)',100),(4,1,'Memprovokasi, merencanakan, melakukan demontrasi terhadap keputusan Yayasan Syekh Sulaimana Arrasuli dan lembaga MTI Candung',100),(5,2,'Membaca/ membawa/menonton/ membuat buku/ gambar vidio porno',75),(6,2,'Berduaan berlawanan jenis baik di Madrasah maupun di luar Madrasah',75),(7,2,'Memalak/ mengompas/ mencuri',75),(8,2,'Melawan kepada guru (berkata kasar, bersuara tinggi, tidak mengindahkan panggilan ustadz/ustadzah dan karyawan Madrasah)',75),(9,2,'Berurusan dengan pihak berwajib karena melanggar peraturan yang berlaku',75),(10,2,'Memakai pakaian yang tidak sesuai dengan syariat Islam',50),(11,2,'Berkelahi atau main hakim sendiri termasuk pengroyokan',50),(12,2,'Terlibat atau menjadi anggota kelompok anak nakal atau kelompok terlarang',50),(13,2,'Membawa atau menyimpan senjata tajam di madrasah',50),(14,2,'Membawa hp android ke madrasah tampa izin dari pimpinan untuk kelas 1-6 kecuali ada izin dari kepala madrasah',50),(15,2,' Merusak fasilitas Madrasah (Santri wajib mengganti/memperbaiki fasilitas tersebut)',50),(16,2,'Membawa novel/komik ke madrasah yang mengandung unsur pornografi',50),(17,2,'Memalsukan tanda tangan orang lain (orang tua, guru, dan lain-lain)',50),(18,3,'Tidak hadir tanpa keterangan (ALFA)',10),(19,3,'Cabut pada jam pelajaran',10),(20,3,'Kelaur dari lokal tampa izin dari guru yang mengajar jam PBM berlangsung',10),(21,3,'Keluar dari perkarangan Madrasah tampa izin dari guru piket',10),(22,3,'Tidak shalat zhuhur berjama’ah di Masjid Syekh Sulaiman Arrasuli',10),(23,3,'Membawa/ merokok dilingkungan atau diluar Madrasah',10),(24,3,'Tidak mengikuti upacara bendera dan tausiah',10),(25,3,'Berkata-kata kotor dilingkungan dan diluar Madrasah',10),(26,3,'Melakukan tindakan bullying dilikungan dan diluar Madrasah',10),(27,3,'Mencoret fasilitas Madrasah',10),(28,3,'Tidak memakai pakaian sesuai dengan peraturan yang telah ditetapkan oleh Madrasah',10),(29,3,'Tidak mengikuti acara yang diselenggarakan oleh OSTI',10),(30,3,'Membawa teman kepekarangan sekolah selama PBM berlansung',10),(31,3,'Merayakan ulang tahun dilingkungan Madarasah',10),(32,3,'Main di warnet/ rental PS/ dalam dan diluar jam pelajaran',10),(33,4,'Tidak mengumpulkan HP android selama PBM khusus untuk kelas 7',8),(34,4,'Berambut panjang/ pakai jeli/ dicat/ atau tidak rapi',8),(35,4,'Duduk dikursi dan atau meja ustadz / ustadzah',8),(36,4,'Terlambat masuk pada jam pelajaran',8),(37,4,'Kuku panjang/ diwarnai',8),(38,4,'Tidak melaksakan tadarus sesuai jam yang telah ditetapkan oleh madrasah',8),(39,4,'Memarkir sepeda motor disembarangan tempat yang mengganggu ketertiban umum',8),(40,4,'Tidak membawa peralatan shalat',8),(41,4,'Tidak membawa kitab dan buku pelajaran atau catatan',8),(42,4,'Tidak mengikuti salah satu kegiatan ekstra kurikuler',8),(43,4,'Memakai jeket selain jeket almamater dilingkungan sekolah',5),(44,4,'Memakai perhiasan/aksesoris selain anting bagi santriwati',5),(45,4,'Berteriak-teriak di dalam pekarangan sekolah',5),(46,4,'Membuang sampah tidak pada tempatnya',5),(47,4,'Meludah/ membuang benda dari lantai atas ke bawah',5),(48,4,'Keluar kelas pada pergantian jam pelajaran',5),(49,4,'Memakai make up',5);
/*!40000 ALTER TABLE `pelanggaran_item` ENABLE KEYS */;

--
-- Table structure for table `pelanggaran_jenis`
--

DROP TABLE IF EXISTS `pelanggaran_jenis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pelanggaran_jenis` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelanggaran_jenis`
--

/*!40000 ALTER TABLE `pelanggaran_jenis` DISABLE KEYS */;
INSERT INTO `pelanggaran_jenis` VALUES (1,'SANGAT BERAT'),(2,'BERAT'),(3,'SEDANG'),(4,'RINGAN');
/*!40000 ALTER TABLE `pelanggaran_jenis` ENABLE KEYS */;

--
-- Table structure for table `pelanggaran_siswa`
--

DROP TABLE IF EXISTS `pelanggaran_siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pelanggaran_siswa` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `periode_langgar_id` int DEFAULT NULL,
  `user_created_id` int DEFAULT NULL,
  `siswa_kelas_id` int NOT NULL COMMENT 'Dari Tabel m_siswa_kelas',
  `pelanggaran_id` int NOT NULL,
  `bukti_pelanggaran` text,
  `status_tindak_lanjut` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `tgl_kejadian` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=254 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `periode`
--

DROP TABLE IF EXISTS `periode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periode` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nm_periode` varchar(100) NOT NULL,
  `status_periode` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periode`
--

/*!40000 ALTER TABLE `periode` DISABLE KEYS */;
INSERT INTO `periode` VALUES (1,'2023/2024',1),(2,'2024/2025',NULL);
/*!40000 ALTER TABLE `periode` ENABLE KEYS */;

--
-- Table structure for table `sekolah`
--

DROP TABLE IF EXISTS `sekolah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sekolah` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nm_sekolah` varchar(100) NOT NULL,
  `kepsek` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sekolah`
--

/*!40000 ALTER TABLE `sekolah` DISABLE KEYS */;
INSERT INTO `sekolah` VALUES (1,'MTs TI Canduang','H. Aldri, S. Ag'),(2,'MAS TI Canduang','Candra, S. Pd.I');
/*!40000 ALTER TABLE `sekolah` ENABLE KEYS */;

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `semester` (
  `id` int NOT NULL AUTO_INCREMENT,
  `semester` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semester`
--

/*!40000 ALTER TABLE `semester` DISABLE KEYS */;
INSERT INTO `semester` VALUES (1,'I'),(2,'II');
/*!40000 ALTER TABLE `semester` ENABLE KEYS */;

--
-- Table structure for table `tm_kelas_level`
--

DROP TABLE IF EXISTS `tm_kelas_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tm_kelas_level` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `sekolah_id` int NOT NULL,
  `level_kelas` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_kelas_level`
--

/*!40000 ALTER TABLE `tm_kelas_level` DISABLE KEYS */;
INSERT INTO `tm_kelas_level` VALUES (1,1,'KELAS I'),(2,1,'KELAS II'),(3,1,'KELAS III'),(4,1,'KELAS IV'),(5,2,'4 KH'),(6,2,'KELAS 5'),(7,2,'KELAS 6'),(8,2,'KELAS 7');
/*!40000 ALTER TABLE `tm_kelas_level` ENABLE KEYS */;

--
-- Table structure for table `tm_kelas_rombel`
--

DROP TABLE IF EXISTS `tm_kelas_rombel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tm_kelas_rombel` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `periode_id` int DEFAULT NULL,
  `level_kelas_id` int DEFAULT NULL,
  `rombel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guru_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tm_kelas_rombel_walas`
--

DROP TABLE IF EXISTS `tm_kelas_rombel_walas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tm_kelas_rombel_walas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `periode_id` int DEFAULT NULL,
  `rombel` varchar(255) NOT NULL,
  `guru_id` int NOT NULL,
  `status_walas` int DEFAULT NULL COMMENT '1 = Aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `user_fullname` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `dscription` text NOT NULL,
  `is_active` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','Abdul Yamin','$2y$10$5BqwGJ51j7mJQi7mSbLj3uZ9F1ubC3qWaIXbch4EQdw8gpn3z5zKC','-',1),(2,'admins','Abdul Yamin','$2y$10$ebA07pRhVzZxoLSInSBZUuHsqajL7yBlIx92ow3pe20Rvos.7GCse','-',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Dumping routines for database '2023_pps'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-15 16:37:35
