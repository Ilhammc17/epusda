-- MySQL dump 10.13  Distrib 8.0.28, for macos11 (x86_64)
--
-- Host: localhost    Database: epusda
-- ------------------------------------------------------
-- Server version	5.5.5-10.7.3-MariaDB

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
-- Table structure for table `pengarang_tambahan`
--

DROP TABLE IF EXISTS `pengarang_tambahan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengarang_tambahan` (
  `id_pengarang_tambahan` bigint(20) NOT NULL AUTO_INCREMENT,
  `buku_id` varchar(191) NOT NULL,
  `nama_pengarang_tambahan` varchar(191) NOT NULL,
  PRIMARY KEY (`id_pengarang_tambahan`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengarang_tambahan`
--

LOCK TABLES `pengarang_tambahan` WRITE;
/*!40000 ALTER TABLE `pengarang_tambahan` DISABLE KEYS */;
INSERT INTO `pengarang_tambahan` VALUES (1,'BK0018','a'),(2,'BK0018','a'),(3,'BK0018','a'),(4,'BK0018','a'),(5,'BK0021','Kemal'),(6,'BK0022','a'),(7,'BK001',''),(8,'BK0024',''),(9,'BK0025',''),(10,'BK0026','Rimmer'),(11,'BK0026','Lea Prasetyo'),(12,'BK0027',''),(13,'BK0028','Rizki Muhammad'),(14,'BK0029',''),(15,'BK0030',''),(16,'BK0031',''),(17,'BK0032',''),(18,'BK0033',''),(19,'BK0034',''),(20,'BK0035','Viana Akbari'),(21,'BK0035',''),(22,'BK0036',''),(23,'BK0037',''),(24,'BK0038',''),(25,'BK0039',''),(26,'BK0040',''),(27,'BK0041',''),(28,'BK0042',''),(29,'BK0043',''),(30,'BK0044',''),(31,'BK0045',''),(32,'BK0046',''),(33,'BK0047',''),(34,'BK0048',''),(35,'BK0049','Tjetjep S. Ranuatmaja'),(36,'BK0050',''),(37,'BK0051',''),(38,'BK0052',''),(39,'BK0053',''),(40,'BK0054',''),(41,'BK0055',''),(42,'BK0056',''),(43,'BK0057',''),(44,'BK0058',''),(45,'BK0059',''),(46,'BK0060',''),(47,'BK0061',''),(48,'BK0062',''),(49,'BK0063',''),(50,'BK0064',''),(51,'BK0065',''),(52,'BK0066',''),(53,'BK0067','Firman Sujadi'),(54,'BK0068',''),(55,'BK0069',''),(56,'BK0070',''),(57,'BK0071','Indriya'),(58,'BK0071','Hensi'),(59,'BK0071','Hesti'),(60,'BK0071','Akbar'),(61,'BK0072','');
/*!40000 ALTER TABLE `pengarang_tambahan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_atur`
--

DROP TABLE IF EXISTS `tbl_atur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_atur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_perpus` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telepon` varchar(25) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_atur`
--

LOCK TABLES `tbl_atur` WRITE;
/*!40000 ALTER TABLE `tbl_atur` DISABLE KEYS */;
INSERT INTO `tbl_atur` VALUES (1,'Epusda','Epusda@gmail.com','089618173609','Subang','epusda.png');
/*!40000 ALTER TABLE `tbl_atur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_biaya_denda`
--

DROP TABLE IF EXISTS `tbl_biaya_denda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_biaya_denda` (
  `id_biaya_denda` int(11) NOT NULL AUTO_INCREMENT,
  `harga_denda` varchar(255) NOT NULL,
  `stat` varchar(255) NOT NULL,
  `tgl_tetap` varchar(255) NOT NULL,
  PRIMARY KEY (`id_biaya_denda`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_biaya_denda`
--

LOCK TABLES `tbl_biaya_denda` WRITE;
/*!40000 ALTER TABLE `tbl_biaya_denda` DISABLE KEYS */;
INSERT INTO `tbl_biaya_denda` VALUES (1,'4000','Aktif','2021-01-29');
/*!40000 ALTER TABLE `tbl_biaya_denda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_buku`
--

DROP TABLE IF EXISTS `tbl_buku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `buku_id` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `subkategori_id` bigint(20) NOT NULL,
  `sumber_id` varchar(191) NOT NULL,
  `id_rak` int(11) NOT NULL,
  `sampul` varchar(255) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `pengarang` varchar(255) DEFAULT NULL,
  `thn_buku` varchar(255) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `dipinjam` int(11) NOT NULL,
  `tgl_masuk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_buku`
--

LOCK TABLES `tbl_buku` WRITE;
/*!40000 ALTER TABLE `tbl_buku` DISABLE KEYS */;
INSERT INTO `tbl_buku` VALUES (23,'BK001',24,17,'5',13,'f1358295b829025afc58bdb944ed43d7.jpg','978-602-8755-00-9',NULL,'Pupuk Kompos Cair','Seni Pertanian Modern','Panji Nugroho','2019','',8,0,'2022-07-08 08:07:56'),(24,'BK0024',24,17,'6',16,'5b313cabf4026838dc8635691824663e.jpg','978-602-8755-01-6',NULL,'Aneka Manfaat Kulit Buah &amp; Sayuran','Andi','Dini Nuris Nuraini','2020','',5,0,'2022-07-08 08:09:46'),(25,'BK0025',24,17,'5',16,'d107fe73ed1f996312c2c83a09a99a27.jpg','978-602-8755-02-3',NULL,'Motor Bensin Pada Mobil','YRAMA WIDYA','Drs. Daryanto','2020','',3,0,'2022-07-08 08:16:07'),(26,'BK0026',24,17,'6',17,'6ceabb16806313716a7b2813a83706d5.jpg','978-602-8755-03-0',NULL,'Mekanika Terapan Edisi 2','ERLANGGA','Titherington','2020','',2,0,'2022-07-08 08:17:47'),(27,'BK0027',24,17,'5',16,'3738a120e1d3437f451ac8810cf37667.jpg','978-602-8755-01-0',NULL,'Buku Pintar Televisi','GI','Drs. Doddy Permadi Indrajaya, M.Si.','2018','',2,0,'2022-07-08 08:19:10'),(28,'BK0028',25,31,'6',17,'6e62d46b515050a998f731c7c76ba67e.jpg','978-602-8755-01-2',NULL,'Filsafat Ilmu','RajaGrafindo Persada','Dr. Muhammad Syukri','2022','',2,0,'2022-07-08 08:23:14'),(29,'BK0029',25,30,'5',19,'2de1cb708f34b41ee3e2bb5cf28d8168.jpg','978-623-3463-03-4',NULL,'Filosofi Teras','Pbk','Henry Manampiring','2022','',2,0,'2022-07-08 08:26:52'),(30,'BK0030',25,33,'5',17,'0b33540aad4efb64ff1f20330b81d5f8.jpg','978-602-4257-71-2',NULL,'Peraturan Jabatan &amp; Kode Etik Pejabat Pembuat Akta Tanah (Ppat)','RajaGrafindo Persada','Prof. Dr Salim','2019','',1,0,'2022-07-08 08:30:21'),(31,'BK0031',25,33,'5',16,'1a11d764f8f4ecbb3ce3118c6207c4bc.jpg','978-979-0078-53-6',NULL,'Kode Etik Profesi Tentang Hukum','Sinar Grafika','Sinar Grafika','2019','',2,0,'2022-07-08 08:34:10'),(32,'BK0032',25,33,'4',14,'35d8605b777d6bb8ea85e1c69dcfabcf.jpg','978-602-7985-20-9',NULL,'Kode Etik Hakim','Prenada Media','Drs. H. Wildan Suyuthi','2017','',2,0,'2022-07-08 08:35:55'),(33,'BK0033',26,35,'5',16,'362762dbe72740c576fa136f3b04fe80.jpg','978-602-8755-00-3',NULL,'Dahsyatnya Energi Sholat','Al Mawardi','Ust. H. Saifuddin Aman','2020','',2,0,'2022-07-08 08:39:30'),(34,'BK0034',26,35,'6',16,'f605ee92daff02686f63fdb65437a1c7.jpg','978-602-8755-10-2',NULL,'Menjadi Muslimah Bahagia Sepanjang Masa','Ibadah Muslimah','Mizania','2018','',3,0,'2022-07-08 08:39:23'),(35,'BK0035',26,35,'4',16,'889764a8c0bd2d62cd4e65dc54a596d0.jpg','978-602-8755-02-7',NULL,'Ya Allah Beri Aku Satu Saja','Garapan Store','Nurul Asmayani','2019','',3,0,'2022-07-08 08:41:14'),(36,'BK0036',26,35,'5',16,'7854e771538cbbeb8b504bba45dacd63.jpg','978-602-8755-00-2',NULL,'Panduan Praktis dan Lengkap Shalat Fardhu &amp; Sunnah','Amzah','Ahmad Nawawi Sadili','2019','',2,0,'2022-07-08 08:43:34'),(37,'BK0037',27,46,'5',17,'cf53685a5e0f08f3f4fa876a9fdbb4a3.jpg','978-682-8755-02-2',NULL,'Pelajaran Ekonomi 3','ERLANGGA','Ritonga','2018','',3,0,'2022-07-08 08:45:06'),(38,'BK0038',27,46,'5',17,'402a3279f959093eb186c1dad4dbf93d.jpg','987-6657-7757-4',NULL,'Sma Matematika Ekonomi','Tim Master Eduka','Tim Master Eduka','2019','',3,0,'2022-07-08 08:46:48'),(39,'BK0039',27,43,'6',17,'3f71c657477ded2dc721dc7e00b72290.jpg','978-692-8755-02-4',NULL,'UUD 1945 &amp; Amandemen','Tim DC','Tim DC','2019','',2,0,'2022-07-08 08:48:41'),(40,'BK0040',27,43,'5',17,'bbcfc7e52c27b01985fbaccb765e0fe3.jpg','978-602-8755-02-2',NULL,'Hukum Konstitusi Masa Transisi','Garapan Store','Anom Surya Putra, SH','2019','',2,0,'2022-07-08 08:50:07'),(41,'BK0041',27,43,'5',17,'90fab72ee06b9b89209a057e350586d8.jpg','978-602-8155-02-3',NULL,'Ulat di Kebun Polri','Krishna Murti','Budi Hatees','2019','',2,0,'2022-07-08 08:51:21'),(42,'BK0042',29,57,'5',18,'0fc6a9108d7a5400c2bb3ee0dfc822ac.jpg','978-672-8755-02-3',NULL,'Menjelajahi Tata Surya','Garapan Store','A. Gunawan Admiranto','2019','',2,0,'2022-07-08 08:53:00'),(43,'BK0043',29,57,'5',18,'d327e330d0ea3e8b895b2127ab5e0680.jpg','978-602-2755-02-3',NULL,'Pengetahuan Luar Angkasa Cuaca&amp; Fenomena Alam','Garapan Store','Erlina Ayu','2019','',2,0,'2022-07-08 08:54:18'),(44,'BK0044',29,58,'6',17,'599e20c6bda152c5d63dbc88e08961bc.jpg','978-602-8755-20-9',NULL,'Fisika','ERLANGGA','Dr. Tan IK Gle','2019','',3,0,'2022-07-08 11:01:12'),(45,'BK0045',29,58,'5',18,'521cf799331428abbec6ffebc7c4b2c7.jpg','978-602-8725-00-9',NULL,'Saluran Transmisi Bumbung Gelombang  dan Teorema Jaringan','MJS','Drs. Ganti Depari','2019','',3,0,'2022-07-08 11:04:57'),(46,'BK0046',29,63,'6',18,'6d933c56d85f6a1b089b016d23cb2d63.jpg','978-602-8825-02-3',NULL,'Dasar - Dasar Fisiologi Tumbuhan','Benyamin Lakitan','Benyamin Lakitan','2019','',3,0,'2022-07-08 11:07:18'),(47,'BK0047',30,67,'5',18,'26e70d2593abf038c2cb0b12a9425389.jpg','978-602-7555-01-6',NULL,'Agrobisnis Melon &amp; Sukun','EE','Kusno Waluyo','2018','',4,0,'2022-07-08 11:12:59'),(48,'BK0048',30,67,'5',18,'3edf4a5afd09ba277aa3bf631814af5d.jpg','978-602-1955-02-3',NULL,'Beternak Ayam Kampung Petelur','Redaksi Agromedia','Redaksi Agromedia','2019','',3,0,'2022-07-08 11:15:01'),(49,'BK0049',30,67,'5',18,'a45b720ab055cd0cc11878b2e095bbec.jpg','978-602-2735-02-3',NULL,'Jagung Pun Menjadi Agung','Puri Delco','Nasin El-Kabumaini','2019','',2,0,'2022-07-08 11:33:41'),(50,'BK0050',30,67,'5',18,'ea4df2f2dfcd4c39f2aab8c26873e642.jpg','978-777-8755-02-3',NULL,'Tanaman Hias Berkhasiat','Putra Mandiri','Putra Mandiri','2018','',2,0,'2022-07-08 11:34:51'),(51,'BK0051',30,67,'6',18,'272ceb813b059e9b1ac216ea69a1d833.jpg','978-602-9995-02-0',NULL,'Bercocok Tanam Lada','AKS AGRARIS KANSUS','AKS AGRARIS KANSUS','2017','',1,0,'2022-07-08 11:36:20'),(52,'BK0052',31,80,'6',19,'8fb7adaaa1a6e87b5736cd92a4a3c546.jpg','978-772-8755-02-3',NULL,'Lagu - Lagu Untuk Sekolah Lanjutan','IIID','Muchlis , BA','2016','',3,0,'2022-07-08 11:41:53'),(53,'BK0053',31,80,'5',19,'14116f9c64fcb9d28e3f501f5922e429.jpg','978-602-9999-01-6',NULL,'Panduan Lagu Daerah Indonesia','Karina Melodi','Karina Melodi','2017','',2,0,'2022-07-08 11:43:16'),(54,'BK0054',31,80,'5',19,'a92ea9f140438275e41b6131bb21ee4b.jpg','978-602-9727-01-6',NULL,'Panduan Lagu Anak Indonesia','Findra Rahma','Findra Rahma','2017','',3,0,'2022-07-08 11:44:16'),(55,'BK0055',31,81,'5',19,'cb7f83b9614461ccf793aaea005dc19d.jpg','978-602-8195-01-6',NULL,'Komedi Ala Persia','ESERSIH','Firoozeh  Dumas','2019','',3,0,'2022-07-08 13:16:21'),(56,'BK0056',31,81,'5',19,'a7e57c3ee4ec40d7449b2c4677a6561e.jpg','978-602-1155-01-6',NULL,'Belajar  dan Berlatih Atletik','Pionir Jaya','Jess Jarver','2019','',3,0,'2022-07-08 13:17:53'),(57,'BK0057',31,79,'6',19,'2a32c5e9b810d2ae61900c9977a4dc53.jpg','978-602-0034-26-3',NULL,'Buku Saku Fotografi','Elex Media Komputindo','Edisin Paulus','2013','',2,0,'2022-07-08 13:22:13'),(58,'BK0058',32,83,'5',19,'882eef30757215bdb9807c86ea83d33d.jpg','978-602-8888-02-3',NULL,'Kumpulan Cerita Anak Irena Si Ratu Sampah','Garapan Store','T. Sandi Situmorang','2019','',2,0,'2022-07-08 13:23:49'),(59,'BK0059',32,83,'5',19,'96b3cad82bec84ad5d50c849388f278e.jpg','978-888-8755-01-6',NULL,'Setengah Hari Bersama Idola','Garapan Store','T. Sandi Situmorang','2020','',2,0,'2022-07-08 13:24:33'),(60,'BK0060',32,83,'5',19,'376190b2363e4f03896612e32e23d45e.jpg','978-333-8755-00-9',NULL,'Cerita Rakyat Indonesia Sabang-Merauke','Garapan Store','Yusuf Kristianto','2021','',3,0,'2022-07-08 13:25:46'),(61,'BK0061',32,83,'6',19,'49e4896be2fd542fd625ba0d0fd513e7.jpg','978-602-9282-00-9',NULL,'Cerita - Cerita Rakyat Nusantara II','DIPTA','Arni Windana','2019','',3,0,'2022-07-08 13:26:59'),(62,'BK0062',32,83,'6',19,'c8f069aed59b029c8f69c569cf8c566f.jpg','978-602-5253-01-6',NULL,'6 Dongeng Anak Paling Populer di Dunia','Garapan Store','Wahyu Setyorini','2018','',3,0,'2022-07-08 13:28:46'),(63,'BK0063',32,83,'5',19,'349619878e67659fd19e5609a97f526e.jpg','978-602-7689-02-3',NULL,'Pintu Misterius','PACI','Gutita Siti Amalia','2018','',3,0,'2022-07-08 13:41:20'),(64,'BK0064',32,83,'4',19,'227ec8bebbe15536cee4ca3bf2bde925.jpg','978-918-8755-01-6',NULL,'Big Brother','PACI','Sherina  Salsabila','2019','',2,0,'2022-07-08 13:42:57'),(65,'BK0065',33,85,'6',20,'efc281d92662a6a55204d28c4d39e19e.jpg','978-602-3434-02-3',NULL,'Bundaku Sayang','Buku Obor','Buku Obor','2019','',3,0,'2022-07-08 13:44:35'),(66,'BK0066',33,85,'5',20,'4c53451ad72646ee752937fdd37ddf56.jpg','978-602-0098-01-6',NULL,'Taiyo To Tetsu','Garapan Store','Yukio Mishima','2017','',2,0,'2022-07-08 13:45:55'),(67,'BK0067',33,85,'6',20,'48b3cd046131db1c03ee56e49b3f28e1.jpg','978-602-4356-00-9',NULL,'Sang Bintang Yang Terus Bersinar','Garapan Store','Nursanti Riandini','2018','',3,0,'2022-07-08 13:47:20'),(68,'BK0068',33,85,'5',20,'52237f1c0035977338d0a1311b4f08bc.jpg','978-602-8967-01-6',NULL,'Kak Seto Sahabat Anak-Anak','Buku Obor','Evi Manai','2020','',3,0,'2022-07-08 13:48:45'),(69,'BK0069',33,84,'4',20,'6cc38167b0cc8abcbf3155ae8cf2ce07.jpg','978-602-0000-02-3',NULL,'Harry Poter Jokowi dan Kita','Murai Kencana','Dr. Nusa Putra ','2019','',3,0,'2022-07-08 13:50:38'),(70,'BK0070',33,84,'4',20,'9f60bac7bd06c80fa7f6a279e7184384.jpg','978-602-9871-00-9',NULL,'Sosiologi dan Filsafat','Garapan Store','Emile Durkheim','2019','',3,0,'2022-07-08 13:51:57'),(71,'BK0071',33,84,'4',20,'46ea2224ddba9ff7794f63cca49ad250.jpg','978-222-8755-02-3',NULL,'The Paradise Journeys','Garapan Store','Muthia Esfand','2019','',2,0,'2022-07-08 13:53:44'),(72,'BK0072',27,44,'6',18,'79754c2f7a05a5b6f58d71293b171657.jpg','978-602-1286-01-6',NULL,'Agenda dan Penataan Keamanan di Asia Fasifik','OSIS25','Bantarto Bandoro','2017','',4,0,'2022-07-08 13:55:55');
/*!40000 ALTER TABLE `tbl_buku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_denda`
--

DROP TABLE IF EXISTS `tbl_denda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_denda` (
  `id_denda` int(11) NOT NULL AUTO_INCREMENT,
  `pinjam_id` varchar(255) NOT NULL,
  `denda` varchar(255) NOT NULL,
  `lama_waktu` int(11) NOT NULL,
  `tgl_denda` varchar(255) NOT NULL,
  PRIMARY KEY (`id_denda`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_denda`
--

LOCK TABLES `tbl_denda` WRITE;
/*!40000 ALTER TABLE `tbl_denda` DISABLE KEYS */;
INSERT INTO `tbl_denda` VALUES (5,'PJ009','0',0,'2020-05-20'),(6,'PJ0011','0',0,'2021-01-29'),(7,'PJ0012','4000',1,'2021-02-07'),(8,'PJ0013','0',0,'2021-02-08'),(9,'PJ0014','0',0,'2021-02-08'),(11,'PJ0017','24000',3,'2021-11-06'),(12,'PJ0026','0',0,'2021-11-06'),(13,'PJ0025','35972000',8993,'2022-01-04'),(14,'PJ0026','228000',57,'2022-01-04'),(16,'PJ005','0',0,'2022-01-24'),(17,'PJ003','0',0,'2022-01-24'),(22,'PJ0018','300000',75,'2022-06-30'),(23,'PJ0019','0',0,'2022-07-05');
/*!40000 ALTER TABLE `tbl_denda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kategori`
--

DROP TABLE IF EXISTS `tbl_kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `no_kelas` varchar(191) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kategori`
--

LOCK TABLES `tbl_kategori` WRITE;
/*!40000 ALTER TABLE `tbl_kategori` DISABLE KEYS */;
INSERT INTO `tbl_kategori` VALUES (24,'000','Karya Umum'),(25,'100','Ilmu Filsafat'),(26,'200','Agama'),(27,'300','Ilmu Sosial'),(28,'400','Ilmu Bahasa'),(29,'500','Ilmu Murni'),(30,'600','Ilmu Terapan'),(31,'700','Kesenian Olahraga dan Hiburan'),(32,'800','Fiksi'),(33,'900','Geografi dan Sejarah');
/*!40000 ALTER TABLE `tbl_kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_keranjang`
--

DROP TABLE IF EXISTS `tbl_keranjang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_keranjang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_buku` varchar(255) DEFAULT NULL,
  `nama_buku` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `jml` int(11) NOT NULL,
  `tahun` varchar(255) DEFAULT NULL,
  `login_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_keranjang`
--

LOCK TABLES `tbl_keranjang` WRITE;
/*!40000 ALTER TABLE `tbl_keranjang` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_keranjang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_login`
--

DROP TABLE IF EXISTS `tbl_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_login` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `anggota_id` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nim` varchar(25) DEFAULT NULL,
  `id_status` int(11) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` varchar(255) NOT NULL,
  `jenkel` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tgl_bergabung` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `ktp` varchar(191) NOT NULL,
  PRIMARY KEY (`id_login`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_login`
--

LOCK TABLES `tbl_login` WRITE;
/*!40000 ALTER TABLE `tbl_login` DISABLE KEYS */;
INSERT INTO `tbl_login` VALUES (1,'AG001','petugas','$2y$10$cBPIp9auqUmtsGc8ARRko.V.3SspEmoY6K4SReqHNmJeIoHZvMGLW','Petugas','Ilham','10106018',2,'Subang','1999-04-05','Laki-Laki','Subang','081234567890','Petugas@gmail.com','2019-11-20','user_1632210994.png',''),(2,'AG002','kemal','$2y$10$AIT3I7ahl5cRLpaqKZyUh.nbs4OjbrS06/4iBZSCQYZ9qUZMdzzXm','Anggota','Indri Destiani','10106019',2,'Subang','1998-11-18','Laki-Laki','Subang','081234567890','kemal@gmail.com','2019-11-21','user_1656404166.jpeg','ktp_1656231565.jpg'),(4,'','superadmin','$2y$10$rbsYs2aOAyKN.6LB3llz/uoY3WIySlaCztE.iYyypXTKRabJODpFS','Superadmin','superadmin','',2,'Subang','1999-04-05','Laki-Laki','Subang','081234567890','Petugas@gmail.com','2019-11-20','user_1632210994.png',''),(5,'','admin','$2y$10$Ecy14db7EZZKh8EYpEdf2OkJQ.UsvwgJY5gu8rgmOZ4y5ebzjbQ/a','Petugas','rafi',NULL,0,'','','','','085723853284','rafi@gmail.com','','',''),(7,'','bagus','$2y$10$7m/2epoCTh1gWVLVs/l6Mu0/6qHe.TuHcv3KUatAvojeMHEH4Ck7O','Petugas','bagus',NULL,0,'','','','','085723853284','bagassetia271@gmail.com','','',''),(11,'AG008','bagas','$2y$10$MOGIHAE7MvHitBDm8YEeOO3IRs2rWusAdpVwEAbJtKkiLoK.1Sw.W','Anggota','bagas','10104019',2,'subang','2022-06-08','Laki-Laki','asdfadf','123123123','knjkjshgh@gmail.com','2022-06-26','user_1656231176.jpg','user_1656231176.png');
/*!40000 ALTER TABLE `tbl_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pencarian`
--

DROP TABLE IF EXISTS `tbl_pencarian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_pencarian` (
  `id_pencarian` int(11) NOT NULL AUTO_INCREMENT,
  `subkategori_id` int(11) DEFAULT NULL,
  `tgl_pencarian` date DEFAULT NULL,
  PRIMARY KEY (`id_pencarian`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pencarian`
--

LOCK TABLES `tbl_pencarian` WRITE;
/*!40000 ALTER TABLE `tbl_pencarian` DISABLE KEYS */;
INSERT INTO `tbl_pencarian` VALUES (1,17,'2022-07-09'),(2,0,'2022-07-10'),(3,18,'2022-07-10');
/*!40000 ALTER TABLE `tbl_pencarian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pengunjung`
--

DROP TABLE IF EXISTS `tbl_pengunjung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_pengunjung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anggota_id` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `tgl_masuk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pengunjung`
--

LOCK TABLES `tbl_pengunjung` WRITE;
/*!40000 ALTER TABLE `tbl_pengunjung` DISABLE KEYS */;
INSERT INTO `tbl_pengunjung` VALUES (1,'AG001','Anang','2021-09-21 14:50:46','2021-09-21'),(3,'ag001','Anang','2021-09-21 14:52:48','2021-09-21'),(4,'10107001','Septian','2022-05-26 13:53:09','2022-05-26'),(5,'9389131','Ilham','2022-06-28 09:58:41','2022-06-28'),(6,'6436336','kemall','2022-06-28 09:58:50','2022-06-28'),(7,'874875','ilhakkk','2022-06-30 09:08:22','2022-06-30'),(8,'587385','ilhammm','2022-07-05 11:08:09','2022-07-05');
/*!40000 ALTER TABLE `tbl_pengunjung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pinjam`
--

DROP TABLE IF EXISTS `tbl_pinjam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_pinjam` (
  `id_pinjam` int(11) NOT NULL AUTO_INCREMENT,
  `pinjam_id` varchar(255) NOT NULL,
  `anggota_id` varchar(255) NOT NULL,
  `buku_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `jml` int(11) NOT NULL,
  `tgl_pinjam` varchar(255) NOT NULL,
  `lama_pinjam` int(11) NOT NULL,
  `tgl_balik` varchar(255) NOT NULL,
  `tgl_kembali` varchar(255) DEFAULT NULL,
  `periode` varchar(255) DEFAULT NULL,
  `periode_kembali` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pinjam`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pinjam`
--

LOCK TABLES `tbl_pinjam` WRITE;
/*!40000 ALTER TABLE `tbl_pinjam` DISABLE KEYS */;
INSERT INTO `tbl_pinjam` VALUES (3,'PJ003','AG002','BK009','Di Kembalikan',3,'2022-01-24',2,'2022-01-26','2022-01-24','01-2022','01-2022'),(4,'PJ003','AG002','BK008','Di Kembalikan',2,'2022-01-24',2,'2022-01-26','2022-01-24','01-2022','01-2022'),(5,'PJ005','AG002','BK009','Di Kembalikan',3,'2022-01-24',2,'2022-01-26','2022-01-24','01-2022','01-2022'),(18,'PJ0018','AG002','BK009','Di Kembalikan',1,'2022-04-14',2,'2022-04-16','2022-06-30','04-2022','06-2022'),(19,'PJ0019','AG008','BK0021','Di Kembalikan',1,'2022-07-05',8,'2022-07-13','2022-07-05','07-2022','07-2022'),(20,'PJ0020','AG002','BK0018','Dipinjam',2,'2022-07-05',7,'2022-07-12','0','07-2022',NULL),(21,'PJ0021','AG008','BK0022','Dipinjam',1,'2022-07-05',7,'2022-07-12','0','07-2022',NULL),(22,'PJ0022','AG008','BK0021','Dipinjam',1,'2022-07-06',7,'2022-07-13','0','07-2022',NULL),(23,'PJ0023','AG002','BK0021','Dipinjam',1,'2022-07-06',4,'2022-07-10','0','07-2022',NULL),(24,'PJ0024','AG008','BK0021','Dipinjam',1,'2022-07-06',1,'2022-07-07','0','07-2022',NULL),(25,'PJ0025','AG002','BK001','Dipinjam',6,'2022-07-07',8,'2022-07-15','0','07-2022',NULL);
/*!40000 ALTER TABLE `tbl_pinjam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rak`
--

DROP TABLE IF EXISTS `tbl_rak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_rak` (
  `id_rak` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rak` varchar(255) NOT NULL,
  PRIMARY KEY (`id_rak`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rak`
--

LOCK TABLES `tbl_rak` WRITE;
/*!40000 ALTER TABLE `tbl_rak` DISABLE KEYS */;
INSERT INTO `tbl_rak` VALUES (13,'Rak Buku 1'),(14,'Rak Buku 2'),(15,'Rak Buku 3'),(16,'Rak Buku 4'),(17,'Rak Buku 5'),(18,'Rak Buku 6'),(19,'Rak Buku 7'),(20,'Rak Buku 8');
/*!40000 ALTER TABLE `tbl_rak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_status`
--

DROP TABLE IF EXISTS `tbl_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_status`
--

LOCK TABLES `tbl_status` WRITE;
/*!40000 ALTER TABLE `tbl_status` DISABLE KEYS */;
INSERT INTO `tbl_status` VALUES (2,'Umum'),(6,'SMA'),(7,'PNS');
/*!40000 ALTER TABLE `tbl_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_subkategori`
--

DROP TABLE IF EXISTS `tbl_subkategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_subkategori` (
  `id_subkategori` bigint(20) NOT NULL AUTO_INCREMENT,
  `kategori_id` int(11) NOT NULL,
  `nama_subkategori` varchar(191) NOT NULL,
  PRIMARY KEY (`id_subkategori`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `tbl_subkategori_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `tbl_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_subkategori`
--

LOCK TABLES `tbl_subkategori` WRITE;
/*!40000 ALTER TABLE `tbl_subkategori` DISABLE KEYS */;
INSERT INTO `tbl_subkategori` VALUES (17,24,'Publikasi Umum dan Teknologi'),(18,24,'Bibiliografi'),(19,24,'Perpustakaan dan Informasi'),(20,24,'Ensiklopedia'),(21,24,'Majalah dan Jurnal'),(22,24,'Asosiasi, Organisasi dan Museum'),(23,24,'Media Massa, Junalisme, dan Publikasi'),(24,24,'Kutipan'),(25,24,'Manuskrip dan Buku Langka'),(27,25,'Metafisika'),(28,25,'Epistimologi'),(29,25,'Parapsikologi dan Okultisme'),(30,25,'Pemikiran Filosofis'),(31,25,'Filsafat dan Psikologi'),(32,25,'Psikologi Logis'),(33,25,'Etik'),(34,25,'Filosofi kuno, Zaman Pertengahan, dan Filosofi'),(35,26,'Agama Lain'),(36,26,'Alkitab'),(37,26,'Agama Islam'),(38,26,'Teologi Kristen'),(39,26,'Perbandingan Agama'),(40,27,'Statistik Umum'),(41,27,'Ilmu Politik'),(42,27,'Ilmu Ekonomi'),(43,27,'Ilmu Hukum'),(44,27,'Administrasi Negara'),(45,27,'Layanan Sosial'),(46,27,'Pendidikan'),(47,27,'Perdagangan, Komunikasi , Transport'),(48,27,'Adat Istiadat dan Kebiasaan'),(49,28,'Bahasa Indonesia'),(50,28,'Bahasa Inggris'),(51,28,'Bahasa Jerman'),(52,28,'Bahasa Perancis'),(53,28,'Bahasa Italia'),(54,28,'Bahasa Spanyol &amp; Portugis'),(55,28,'Bahasa Latin'),(56,29,'Matematika'),(57,29,'Astronomi'),(58,29,'Fisika'),(59,29,'Kimia'),(60,29,'Ilmu Pengetahuan  tentang bumi &amp; Dunia lain'),(61,29,'Paleontologi'),(62,29,'Ilmu Tentang Kehidupan'),(63,29,'Ilmu Tentang Tumbuhan'),(64,29,'Ilmu Tentang Hewan'),(65,30,'Ilmu Kedokteran'),(66,30,'Ilmu Teknik'),(67,30,'Pertanian'),(68,30,'Kesejahteraan rumah tangga'),(69,30,'Manajemen'),(70,30,'Teknologi Kimia'),(71,30,'Pabrik - Pabrik'),(72,30,'Bangunan'),(73,31,'Seni Perkotaan &amp; Pertanaman'),(74,31,'Arsitektur'),(75,31,'Seni Plastik &amp; Seni Pahat Patung'),(76,31,'Menggambar &amp; Seni dekorasi'),(77,31,'Seni Lukis &amp; Lukisan'),(78,31,'Seni Grafika'),(79,31,'Fotografi'),(80,31,'Musik'),(81,31,'Seni Rekereasi &amp; Pertunjukan'),(82,32,'Novel'),(83,32,'Buku Cerita'),(84,33,'Geografi dan Kisah Perjalanan'),(85,33,'Biografi'),(86,33,'Sejarah dunia purba'),(87,33,'Sejarah umum eropa'),(88,33,'Sejarah umum asia'),(89,33,'Sejarah umum Afrika'),(90,33,'Sejarah umum Amerika Utara');
/*!40000 ALTER TABLE `tbl_subkategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sumber`
--

DROP TABLE IF EXISTS `tbl_sumber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_sumber` (
  `id_sumber` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_sumber` varchar(191) NOT NULL,
  PRIMARY KEY (`id_sumber`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sumber`
--

LOCK TABLES `tbl_sumber` WRITE;
/*!40000 ALTER TABLE `tbl_sumber` DISABLE KEYS */;
INSERT INTO `tbl_sumber` VALUES (4,'APBN'),(5,'APBN 2019'),(6,'APBN 2020');
/*!40000 ALTER TABLE `tbl_sumber` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'epusda'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-10 12:07:01
