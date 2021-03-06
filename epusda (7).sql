-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2022 at 11:43 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epusda`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengarang_tambahan`
--

CREATE TABLE `pengarang_tambahan` (
  `id_pengarang_tambahan` bigint(20) NOT NULL,
  `buku_id` varchar(191) NOT NULL,
  `nama_pengarang_tambahan` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengarang_tambahan`
--

INSERT INTO `pengarang_tambahan` (`id_pengarang_tambahan`, `buku_id`, `nama_pengarang_tambahan`) VALUES
(1, 'BK0018', 'a'),
(2, 'BK0018', 'a'),
(3, 'BK0018', 'a'),
(4, 'BK0018', 'a'),
(5, 'BK0021', 'Kemal'),
(6, 'BK0022', 'a'),
(7, 'BK001', ''),
(8, 'BK0024', ''),
(9, 'BK0025', ''),
(10, 'BK0026', 'Rimmer'),
(11, 'BK0026', 'Lea Prasetyo'),
(12, 'BK0027', ''),
(13, 'BK0028', 'Rizki Muhammad'),
(14, 'BK0029', ''),
(15, 'BK0030', ''),
(16, 'BK0031', ''),
(17, 'BK0032', ''),
(18, 'BK0033', ''),
(19, 'BK0034', ''),
(20, 'BK0035', 'Viana Akbari'),
(21, 'BK0035', ''),
(22, 'BK0036', ''),
(23, 'BK0037', ''),
(24, 'BK0038', ''),
(25, 'BK0039', ''),
(26, 'BK0040', ''),
(27, 'BK0041', ''),
(28, 'BK0042', ''),
(29, 'BK0043', ''),
(30, 'BK0044', ''),
(31, 'BK0045', ''),
(32, 'BK0046', ''),
(33, 'BK0047', ''),
(34, 'BK0048', ''),
(35, 'BK0049', 'Tjetjep S. Ranuatmaja'),
(36, 'BK0050', ''),
(37, 'BK0051', ''),
(38, 'BK0052', ''),
(39, 'BK0053', ''),
(40, 'BK0054', ''),
(41, 'BK0055', ''),
(42, 'BK0056', ''),
(43, 'BK0057', ''),
(44, 'BK0058', ''),
(45, 'BK0059', ''),
(46, 'BK0060', ''),
(47, 'BK0061', ''),
(48, 'BK0062', ''),
(49, 'BK0063', ''),
(50, 'BK0064', ''),
(51, 'BK0065', ''),
(52, 'BK0066', ''),
(53, 'BK0067', 'Firman Sujadi'),
(54, 'BK0068', ''),
(55, 'BK0069', ''),
(56, 'BK0070', ''),
(57, 'BK0071', 'Indriya'),
(58, 'BK0071', 'Hensi'),
(59, 'BK0071', 'Hesti'),
(60, 'BK0071', 'Akbar'),
(61, 'BK0072', ''),
(62, 'BK0073', ''),
(63, 'BK0073', 'sdssf'),
(64, 'BK0075', 'bvnn'),
(65, 'BK0073', ''),
(66, 'BK0073', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_atur`
--

CREATE TABLE `tbl_atur` (
  `id` int(11) NOT NULL,
  `nama_perpus` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telepon` varchar(25) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_atur`
--

INSERT INTO `tbl_atur` (`id`, `nama_perpus`, `email`, `telepon`, `alamat`, `logo`) VALUES
(1, 'SIPERSU', 'Sipersu@gmail.com', '089618173609', '', '20220712_011003_00001.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biaya_denda`
--

CREATE TABLE `tbl_biaya_denda` (
  `id_biaya_denda` int(11) NOT NULL,
  `harga_denda` varchar(255) NOT NULL,
  `stat` varchar(255) NOT NULL,
  `tgl_tetap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_biaya_denda`
--

INSERT INTO `tbl_biaya_denda` (`id_biaya_denda`, `harga_denda`, `stat`, `tgl_tetap`) VALUES
(1, '4000', 'Tidak Aktif', '2021-01-29'),
(16, '10000', 'Tidak Aktif', '2022-07-13'),
(17, '20000', 'Tidak Aktif', '2022-07-13'),
(24, '', 'Tidak Aktif', '2022-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku`
--

CREATE TABLE `tbl_buku` (
  `id_buku` int(11) NOT NULL,
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
  `tgl_masuk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_buku`
--

INSERT INTO `tbl_buku` (`id_buku`, `buku_id`, `id_kategori`, `subkategori_id`, `sumber_id`, `id_rak`, `sampul`, `isbn`, `lampiran`, `title`, `penerbit`, `pengarang`, `thn_buku`, `isi`, `jml`, `dipinjam`, `tgl_masuk`) VALUES
(1, 'BK002', 24, 17, '4', 16, '5b313cabf4026838dc8635691824663e.jpg', '978-602-8755-01-6', NULL, 'Aneka Manfaat Kulit Buah &amp; Sayuran', 'Andi', 'Dini Nuris Nuraini', '2020', '', 1, 1, '2022-07-15 12:46:00'),
(23, 'BK001', 24, 17, '5', 13, 'f1358295b829025afc58bdb944ed43d7.jpg', '978-602-8755-00-9', NULL, 'Pupuk Kompos Cair', 'Seni Pertanian Modern', 'Panji Nugroho', '2019', '', 2, 2, '2022-07-15 12:42:37'),
(25, 'BK003', 24, 17, '5', 16, 'd107fe73ed1f996312c2c83a09a99a27.jpg', '978-602-8755-02-3', NULL, 'Motor Bensin Pada Mobil', 'YRAMA WIDYA', 'Drs. Daryanto', '2020', '', 1, 1, '2022-07-15 12:47:29'),
(28, 'BK006', 25, 31, '4', 17, '6e62d46b515050a998f731c7c76ba67e.jpg', '978-602-8755-01-2', NULL, 'Filsafat Ilmu', 'RajaGrafindo Persada', 'Dr. Muhammad Syukri', '2022', '', 29, 1, '2022-07-15 12:53:17'),
(29, 'BK007', 25, 30, '5', 19, '2de1cb708f34b41ee3e2bb5cf28d8168.jpg', '978-623-3463-03-4', NULL, 'Filosofi Teras', 'Pbk', 'Henry Manampiring', '2022', '', 15, 5, '2022-07-15 12:50:01'),
(30, 'BK008', 25, 33, '5', 17, '0b33540aad4efb64ff1f20330b81d5f8.jpg', '978-602-4257-71-2', NULL, 'Peraturan Jabatan &amp; Kode Etik Pejabat Pembuat Akta Tanah (Ppat)', 'RajaGrafindo Persada', 'Prof. Dr Salim', '2019', '', 4, 1, '2022-07-08 08:30:21'),
(31, 'BK009', 25, 33, '5', 16, '1a11d764f8f4ecbb3ce3118c6207c4bc.jpg', '978-979-0078-53-6', NULL, 'Kode Etik Profesi Tentang Hukum', 'Sinar Grafika', 'Sinar Grafika', '2019', '', 7, 1, '2022-07-08 08:34:10'),
(32, 'BK010', 25, 33, '4', 14, '35d8605b777d6bb8ea85e1c69dcfabcf.jpg', '978-602-7985-20-9', NULL, 'Kode Etik Hakim', 'Prenada Media', 'Drs. H. Wildan Suyuthi', '2017', '', 11, 8, '2022-07-08 08:35:55'),
(33, 'BK011', 26, 35, '5', 16, '362762dbe72740c576fa136f3b04fe80.jpg', '978-602-8755-00-3', NULL, 'Dahsyatnya Energi Sholat', 'Al Mawardi', 'Ust. H. Saifuddin Aman', '2020', '', 1, 0, '2022-07-15 12:43:57'),
(34, 'BK012', 26, 35, '4', 16, 'f605ee92daff02686f63fdb65437a1c7.jpg', '978-602-8755-10-2', NULL, 'Menjadi Muslimah Bahagia Sepanjang Masa', 'Ibadah Muslimah', 'Mizania', '2018', '', 3, 1, '2022-07-15 12:43:22'),
(35, 'BK0035', 26, 35, '4', 16, '889764a8c0bd2d62cd4e65dc54a596d0.jpg', '978-602-8755-02-7', NULL, 'Ya Allah Beri Aku Satu Saja', 'Garapan Store', 'Nurul Asmayani', '2019', '', 2, 0, '2022-07-15 12:44:11'),
(36, 'BK0036', 26, 35, '5', 16, '7854e771538cbbeb8b504bba45dacd63.jpg', '978-602-8755-00-2', NULL, 'Panduan Praktis dan Lengkap Shalat Fardhu &amp; Sunnah', 'Amzah', 'Ahmad Nawawi Sadili', '2019', '', 11, 10, '2022-07-08 08:43:34'),
(37, 'BK0037', 27, 46, '5', 17, 'cf53685a5e0f08f3f4fa876a9fdbb4a3.jpg', '978-682-8755-02-2', NULL, 'Pelajaran Ekonomi 3', 'ERLANGGA', 'Ritonga', '2018', '', 15, 2, '2022-07-15 13:25:58'),
(38, 'BK0038', 27, 46, '5', 17, '402a3279f959093eb186c1dad4dbf93d.jpg', '987-6657-7757-4', NULL, 'Sma Matematika Ekonomi', 'Tim Master Eduka', 'Tim Master Eduka', '2019', '', 4, 1, '2022-07-15 12:45:20'),
(39, 'BK0039', 27, 43, '5', 17, '3f71c657477ded2dc721dc7e00b72290.jpg', '978-692-8755-02-4', NULL, 'UUD 1945 &amp; Amandemen', 'Tim DC', 'Tim DC', '2019', '', 6, 3, '2022-07-15 12:51:14'),
(40, 'BK0040', 27, 43, '5', 17, 'bbcfc7e52c27b01985fbaccb765e0fe3.jpg', '978-602-8755-02-2', NULL, 'Hukum Konstitusi Masa Transisi', 'Garapan Store', 'Anom Surya Putra, SH', '2019', '', 6, 2, '2022-07-15 12:51:32'),
(41, 'BK0041', 27, 43, '5', 17, '90fab72ee06b9b89209a057e350586d8.jpg', '978-602-8155-02-3', NULL, 'Ulat di Kebun Polri', 'Krishna Murti', 'Budi Hatees', '2019', '', 2, 0, '2022-07-15 12:44:31'),
(42, 'BK0042', 29, 57, '5', 18, '0fc6a9108d7a5400c2bb3ee0dfc822ac.jpg', '978-672-8755-02-3', NULL, 'Menjelajahi Tata Surya', 'Garapan Store', 'A. Gunawan Admiranto', '2019', '', 14, 4, '2022-07-08 08:53:00'),
(43, 'BK0043', 29, 57, '5', 18, 'd327e330d0ea3e8b895b2127ab5e0680.jpg', '978-602-2755-02-3', NULL, 'Pengetahuan Luar Angkasa Cuaca&amp; Fenomena Alam', 'Garapan Store', 'Erlina Ayu', '2019', '', 4, 1, '2022-07-08 08:54:18'),
(44, 'BK0044', 29, 58, '6', 17, '599e20c6bda152c5d63dbc88e08961bc.jpg', '978-602-8755-20-9', NULL, 'Fisika', 'ERLANGGA', 'Dr. Tan IK Gle', '2019', '', 18, 1, '2022-07-08 11:01:12'),
(45, 'BK0045', 29, 58, '5', 18, '521cf799331428abbec6ffebc7c4b2c7.jpg', '978-602-8725-00-9', NULL, 'Saluran Transmisi Bumbung Gelombang  dan Teorema Jaringan', 'MJS', 'Drs. Ganti Depari', '2019', '', 6, 6, '2022-07-08 11:04:57'),
(46, 'BK0046', 29, 63, '6', 18, '6d933c56d85f6a1b089b016d23cb2d63.jpg', '978-602-8825-02-3', NULL, 'Dasar - Dasar Fisiologi Tumbuhan', 'Benyamin Lakitan', 'Benyamin Lakitan', '2019', '', 23, 3, '2022-07-08 11:07:18'),
(47, 'BK0047', 30, 67, '5', 18, '26e70d2593abf038c2cb0b12a9425389.jpg', '978-602-7555-01-6', NULL, 'Agrobisnis Melon &amp; Sukun', 'EE', 'Kusno Waluyo', '2018', '', 8, 4, '2022-07-15 13:29:57'),
(48, 'BK0048', 30, 67, '5', 18, '3edf4a5afd09ba277aa3bf631814af5d.jpg', '978-602-1955-02-3', NULL, 'Beternak Ayam Kampung Petelur', 'Redaksi Agromedia', 'Redaksi Agromedia', '2019', '', 3, 0, '2022-07-08 11:15:01'),
(49, 'BK0049', 30, 67, '5', 18, 'a45b720ab055cd0cc11878b2e095bbec.jpg', '978-602-2735-02-3', NULL, 'Jagung Pun Menjadi Agung', 'Puri Delco', 'Nasin El-Kabumaini', '2019', '', 7, 2, '2022-07-15 12:52:50'),
(50, 'BK0050', 30, 67, '5', 18, 'ea4df2f2dfcd4c39f2aab8c26873e642.jpg', '978-777-8755-02-3', NULL, 'Tanaman Hias Berkhasiat', 'Putra Mandiri', 'Putra Mandiri', '2018', '', 1, 0, '2022-07-08 11:34:51'),
(51, 'BK0051', 30, 67, '5', 18, '272ceb813b059e9b1ac216ea69a1d833.jpg', '978-602-9995-02-0', NULL, 'Bercocok Tanam Lada', 'AKS AGRARIS KANSUS', 'AKS AGRARIS KANSUS', '2017', '', 3, 0, '2022-07-15 12:52:35'),
(52, 'BK0052', 31, 80, '6', 19, '8fb7adaaa1a6e87b5736cd92a4a3c546.jpg', '978-772-8755-02-3', NULL, 'Lagu - Lagu Untuk Sekolah Lanjutan', 'IIID', 'Muchlis , BA', '2016', '', 3, 0, '2022-07-08 11:41:53'),
(53, 'BK0053', 31, 80, '5', 19, '14116f9c64fcb9d28e3f501f5922e429.jpg', '978-602-9999-01-6', NULL, 'Panduan Lagu Daerah Indonesia', 'Karina Melodi', 'Karina Melodi', '2017', '', 4, 1, '2022-07-08 11:43:16'),
(54, 'BK0054', 31, 80, '5', 19, 'a92ea9f140438275e41b6131bb21ee4b.jpg', '978-602-9727-01-6', NULL, 'Panduan Lagu Anak Indonesia', 'Findra Rahma', 'Findra Rahma', '2017', '', 7, 5, '2022-07-08 11:44:16'),
(55, 'BK0055', 31, 81, '5', 19, 'cb7f83b9614461ccf793aaea005dc19d.jpg', '978-602-8195-01-6', NULL, 'Komedi Ala Persia', 'ESERSIH', 'Firoozeh  Dumas', '2019', '', 13, 2, '2022-07-08 13:16:21'),
(56, 'BK0056', 31, 81, '5', 19, 'a7e57c3ee4ec40d7449b2c4677a6561e.jpg', '978-602-1155-01-6', NULL, 'Belajar  dan Berlatih Atletik', 'Pionir Jaya', 'Jess Jarver', '2019', '', 3, 0, '2022-07-15 12:53:56'),
(57, 'BK0057', 31, 79, '5', 19, '2a32c5e9b810d2ae61900c9977a4dc53.jpg', '978-602-0034-26-3', NULL, 'Buku Saku Fotografi', 'Elex Media Komputindo', 'Edisin Paulus', '2013', '', 19, 2, '2022-07-15 12:55:18'),
(58, 'BK0058', 32, 83, '5', 19, '882eef30757215bdb9807c86ea83d33d.jpg', '978-602-8888-02-3', NULL, 'Kumpulan Cerita Anak Irena Si Ratu Sampah', 'Garapan Store', 'T. Sandi Situmorang', '2019', '', 2, 0, '2022-07-15 12:49:13'),
(59, 'BK0059', 32, 83, '5', 19, '96b3cad82bec84ad5d50c849388f278e.jpg', '978-888-8755-01-6', NULL, 'Setengah Hari Bersama Idola', 'Garapan Store', 'T. Sandi Situmorang', '2020', '', 1, 0, '2022-07-15 12:48:48'),
(60, 'BK0060', 32, 83, '5', 19, '376190b2363e4f03896612e32e23d45e.jpg', '978-333-8755-00-9', NULL, 'Cerita Rakyat Indonesia Sabang-Merauke', 'Garapan Store', 'Yusuf Kristianto', '2021', '', 1, 0, '2022-07-15 12:48:35'),
(61, 'BK0061', 32, 83, '4', 19, '49e4896be2fd542fd625ba0d0fd513e7.jpg', '978-602-9282-00-9', NULL, 'Cerita - Cerita Rakyat Nusantara II', 'DIPTA', 'Arni Windana', '2019', '', 1, 1, '2022-07-15 12:49:30'),
(63, 'BK0063', 32, 83, '5', 19, '349619878e67659fd19e5609a97f526e.jpg', '978-602-7689-02-3', NULL, 'Pintu Misterius', 'PACI', 'Gutita Siti Amalia', '2018', '', 1, 1, '2022-07-15 12:41:43'),
(64, 'BK0064', 32, 83, '4', 19, '227ec8bebbe15536cee4ca3bf2bde925.jpg', '978-918-8755-01-6', NULL, 'Big Brother', 'PACI', 'Sherina  Salsabila', '2019', '', 6, 6, '2022-07-15 12:42:52'),
(65, 'BK0065', 33, 85, '6', 20, 'efc281d92662a6a55204d28c4d39e19e.jpg', '978-602-3434-02-3', NULL, 'Bundaku Sayang', 'Buku Obor', 'Buku Obor', '2019', '', 9, 1, '2022-07-08 13:44:35'),
(66, 'BK0066', 33, 85, '5', 20, '4c53451ad72646ee752937fdd37ddf56.jpg', '978-602-0098-01-6', NULL, 'Taiyo To Tetsu', 'Garapan Store', 'Yukio Mishima', '2017', '', 2, 1, '2022-07-15 12:41:28'),
(67, 'BK0067', 33, 85, '4', 20, '48b3cd046131db1c03ee56e49b3f28e1.jpg', '978-602-4356-00-9', NULL, 'Sang Bintang Yang Terus Bersinar', 'Garapan Store', 'Nursanti Riandini', '2018', '', 6, 1, '2022-07-15 12:41:23'),
(68, 'BK0068', 33, 85, '5', 20, '52237f1c0035977338d0a1311b4f08bc.jpg', '978-602-8967-01-6', NULL, 'Kak Seto Sahabat Anak-Anak', 'Buku Obor', 'Evi Manai', '2020', '', 2, 1, '2022-07-15 12:41:08'),
(69, 'BK0069', 33, 84, '4', 20, '6cc38167b0cc8abcbf3155ae8cf2ce07.jpg', '978-602-0000-02-3', NULL, 'Harry Poter Jokowi dan Kita', 'Murai Kencana', 'Dr. Nusa Putra ', '2019', '', 6, 1, '2022-07-15 12:54:47'),
(70, 'BK0070', 33, 84, '4', 20, '9f60bac7bd06c80fa7f6a279e7184384.jpg', '978-602-9871-00-9', NULL, 'Sosiologi dan Filsafat', 'Garapan Store', 'Emile Durkheim', '2019', '', 3, 1, '2022-07-15 12:55:00'),
(71, 'BK0071', 33, 84, '4', 20, '46ea2224ddba9ff7794f63cca49ad250.jpg', '978-222-8755-02-3', NULL, 'The Paradise Journeys', 'Garapan Store', 'Muthia Esfand', '2019', '', 6, 1, '2022-07-15 12:54:11'),
(72, 'BK0072', 27, 44, '4', 18, '79754c2f7a05a5b6f58d71293b171657.jpg', '978-602-1286-01-6', NULL, 'Agenda dan Penataan Keamanan di Asia Fasifik', 'OSIS25', 'Bantarto Bandoro', '2017', '', 17, 1, '2022-07-15 12:52:00'),
(77, 'BK0073', 24, 17, '5', 16, NULL, '978-602-8755-01-0', NULL, 'Buku Pintar televisi', 'ERLANGGA', ' Drs. Doddy Permadi Indrajaya, M.Si.', '2018', '', 8, 6, '2022-07-15 13:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_denda`
--

CREATE TABLE `tbl_denda` (
  `id_denda` int(11) NOT NULL,
  `pinjam_id` varchar(255) NOT NULL,
  `denda` varchar(255) NOT NULL,
  `lama_waktu` int(11) NOT NULL,
  `tgl_denda` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_denda`
--

INSERT INTO `tbl_denda` (`id_denda`, `pinjam_id`, `denda`, `lama_waktu`, `tgl_denda`) VALUES
(5, 'PJ009', '0', 0, '2020-05-20'),
(6, 'PJ0011', '0', 0, '2021-01-29'),
(7, 'PJ0012', '4000', 1, '2021-02-07'),
(8, 'PJ0013', '0', 0, '2021-02-08'),
(9, 'PJ0014', '0', 0, '2021-02-08'),
(11, 'PJ0017', '24000', 3, '2021-11-06'),
(16, 'PJ005', '0', 0, '2022-01-24'),
(17, 'PJ003', '0', 0, '2022-01-24'),
(22, 'PJ0018', '300000', 75, '2022-06-30'),
(29, 'PJ0047', '0', 0, '2022-07-13'),
(30, 'PJ0094', '0', 0, '2022-07-14'),
(31, 'PJ0088', '0', 0, '2022-07-15'),
(32, 'PJ0085', '0', 0, '2022-07-15'),
(33, 'PJ0073', '0', 0, '2022-07-15'),
(34, 'PJ0062', '0', 0, '2022-07-15'),
(35, 'PJ0072', '0', 0, '2022-07-15'),
(36, 'PJ0071', '0', 0, '2022-07-15'),
(37, 'PJ0070', '0', 0, '2022-07-15'),
(38, 'PJ0068', '0', 0, '2022-07-15'),
(39, 'PJ0067', '0', 0, '2022-07-15'),
(40, 'PJ0066', '0', 0, '2022-07-15'),
(41, 'PJ0065', '0', 0, '2022-07-15'),
(42, 'PJ0064', '0', 0, '2022-07-15'),
(43, 'PJ0063', '0', 0, '2022-07-15'),
(44, 'PJ0061', '0', 0, '2022-07-15'),
(45, 'PJ0060', '0', 0, '2022-07-15'),
(46, 'PJ0059', '0', 0, '2022-07-15'),
(47, 'PJ0058', '0', 0, '2022-07-15'),
(48, 'PJ0057', '0', 0, '2022-07-15'),
(49, 'PJ0056', '0', 0, '2022-07-15'),
(50, 'PJ0055', '0', 0, '2022-07-15'),
(51, 'PJ0054', '0', 0, '2022-07-15'),
(52, 'PJ0053', '0', 0, '2022-07-15'),
(53, 'PJ0046', '0', 0, '2022-07-15'),
(54, 'PJ0043', '0', 0, '2022-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `no_kelas` varchar(191) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `no_kelas`, `nama_kategori`) VALUES
(24, '000', 'Karya Umum'),
(25, '100', 'Ilmu Filsafat'),
(26, '200', 'Agama'),
(27, '300', 'Ilmu Sosial'),
(28, '400', 'Ilmu Bahasa'),
(29, '500', 'Ilmu Murni'),
(30, '600', 'Ilmu Terapan'),
(31, '700', 'Kesenian Olahraga dan Hiburan'),
(32, '800', 'Fiksi'),
(33, '900', 'Geografi dan Sejarah');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id` int(11) NOT NULL,
  `kode_buku` varchar(255) DEFAULT NULL,
  `nama_buku` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `jml` int(11) NOT NULL,
  `tahun` varchar(255) DEFAULT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id_login` int(11) NOT NULL,
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
  `ktp` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id_login`, `anggota_id`, `user`, `pass`, `level`, `nama`, `nim`, `id_status`, `tempat_lahir`, `tgl_lahir`, `jenkel`, `alamat`, `telepon`, `email`, `tgl_bergabung`, `foto`, `ktp`) VALUES
(1, 'AG001PE', 'petugas', '$2y$10$cBPIp9auqUmtsGc8ARRko.V.3SspEmoY6K4SReqHNmJeIoHZvMGLW', 'Petugas', 'Ilham', '10106018', 2, 'Subang', '1999-04-05', 'Laki-Laki', 'Subang', '081234567890', 'Petugas@gmail.com', '2019-11-20', 'user_1632210994.png', ''),
(2, 'AG0025', 'kemal', '$2y$10$AIT3I7ahl5cRLpaqKZyUh.nbs4OjbrS06/4iBZSCQYZ9qUZMdzzXm', 'Anggota', 'Indri Destiani', '10106015', 2, 'Subang', '1998-11-18', 'Laki-Laki', 'Subang', '081234567890', 'kemal@gmail.com', '2019-11-21', 'user_1656404166.jpeg', 'ktp_1656231565.jpg'),
(4, 'AG001S', 'superadmin', '$2y$10$rbsYs2aOAyKN.6LB3llz/uoY3WIySlaCztE.iYyypXTKRabJODpFS', 'Superadmin', 'superadmin', '', 2, 'Subang', '1999-04-05', 'Laki-Laki', 'Subang', '081234567890', 'Petugas@gmail.com', '2019-11-20', 'user_1632210994.png', ''),
(7, '', 'Pengadaan', '$2y$10$7m/2epoCTh1gWVLVs/l6Mu0/6qHe.TuHcv3KUatAvojeMHEH4Ck7O', 'Pengadaan', 'bagus', NULL, 0, '', '', '', '', '085723853284', 'bagassetia271@gmail.com', '', '', ''),
(11, 'AG0022', 'bagas', '$2y$10$MOGIHAE7MvHitBDm8YEeOO3IRs2rWusAdpVwEAbJtKkiLoK.1Sw.W', 'Anggota', 'bagas', '10106011', 2, 'subang', '2022-06-08', 'Laki-Laki', 'asdfadf', '123123123', 'knjkjshgh@gmail.com', '2022-06-26', 'user_1656231176.jpg', 'user_1656231176.png'),
(12, 'AG0012', 'satria', '$2y$10$kaQd1zX4GY0mt6E2dKJBW.8bUDnLcoZQV4b8FZVvR0RmcUJvRXBP.', 'Anggota', 'Satria', '10106001', 2, 'Subang', '2022-07-01', 'Laki-Laki', 'Kp Majasari', '084862789897', 'satria@gmail.com', '2022-07-11', 'user_1657557995.jpg', 'user_1657557995.png'),
(13, 'AG0013', 'satya', '$2y$10$F3cNTc8t7ZxyceicFopp.eGDpQoIpwDF2M0Gg9kJXv61lb4kGm5r6', 'Anggota', 'Satya', '10106002', 2, 'subang', '2022-07-15', 'Laki-Laki', 'Kp Majasari', '0848629789682', 'satya@gmail.com', '2022-07-11', 'user_1657558051.jpg', 'user_1657558051.png'),
(14, 'AG0014', 'badri', '$2y$10$8GuDSJ7GjVnbjktqE4K1U.Lm9pmSH5AfXeNqSIRhAsKCKPMLZnol2', 'Anggota', 'Badri', '10106003', 2, 'subang', '2022-07-23', 'Laki-Laki', 'Kp Sukamenak', '08486274682', 'badri@gmail.com', '2022-07-11', 'user_1657558160.jpg', 'user_1657558160.png'),
(15, 'AG0015', 'ling', '$2y$10$0D7Uuo.yhgXchllo2YzRBeLoRwBsJrtKpTadIUNpkoP1oV84jq2nC', 'Anggota', 'Ling', '10106004', 2, 'subang', '2022-07-08', 'Laki-Laki', 'Kp Jabong', '08486257682', 'ling@gmail.com', '2022-07-11', 'user_1657558234.jpg', 'user_1657558234.png'),
(16, 'AG0016', 'gugun', '$2y$10$bFnUAJuDbNca6K.j/MBA0.gLW6CLr/VyuoIYGQC1VImIZTqRMD/om', 'Anggota', 'Gugun', '10106005', 2, 'subang', '2022-07-08', 'Laki-Laki', 'Kp Cibogo', '08486990682', 'gugun@gmail.com', '2022-07-11', 'user_1657558309.jpg', 'user_1657558309.png'),
(17, 'AG0017', 'yuyun', '$2y$10$pZcavRfN.CCurPLcblWQe.2KxRZki/auftZAuNJtkpYYALd2m3ZVu', 'Anggota', 'Yuyun', '10106006', 2, 'subang', '2022-07-09', 'Laki-Laki', 'Kp Subang', '084808758472', 'yuyun@gmail.com', '2022-07-11', 'user_1657558433.jpg', 'user_1657558433.png'),
(18, 'AG0018', 'fuyan', '$2y$10$IwhLmAf26T7jDzWJyWBWwOfHsG2GiGNZfoOMJ2nbmo.wYiqnjos/y', 'Anggota', 'Fuyan', '10106007', 2, 'subang', '2022-07-01', 'Laki-Laki', 'Kp Santiong', '084861118472', 'fuyan@gmail.com', '2022-07-11', 'user_1657558612.jpg', 'user_1657558612.png'),
(19, 'AG0019', 'cici', '$2y$10$vdhiyzj1u5HbTaOnjWtxaezDQ9FkMxQ1/0vbPAA8YUybuThV43jQ.', 'Anggota', 'Cici', '10106008', 2, 'subang', '2022-07-07', 'Laki-Laki', 'Kp Majasari', '084862964472', 'cici@gmail.com', '2022-07-11', 'user_1657558756.jpg', 'user_1657558756.png'),
(20, 'AG0020', 'gayan', '$2y$10$XvfDj1x6Mi8hSSNNjQyqq.O.Pm029hbyY2ZI3/DYRZS2RkeJoCtpm', 'Anggota', 'Gayan', '10106009', 2, 'subang', '2022-07-23', 'Laki-Laki', 'Kp Majasari', '084899746825', 'gayan@gmail.com', '2022-07-12', 'user_1657558879.jpg', 'user_1657558879.png'),
(21, 'AG0021', 'franco', '$2y$10$IIGuY032rtvbpl4mrbmbZOYPnhfr0YrGXlsXMGc3w1k1FoV8S0if2', 'Anggota', 'Franco', '10106010', 2, 'subang', '2022-07-08', 'Laki-Laki', 'Kp Subang', '084861186825', 'franco@gmail.com', '2022-07-12', 'user_1657559104.jpg', 'user_1657559104.png'),
(22, 'AG0022', 'karina', '$2y$10$WKwW.RZqzt0I4gvip6RXw.NrBf.e73sPe.5A8TxKNhb3vJ80nNIyq', 'Anggota', 'Karina', '10106012', 2, 'subang', '2022-07-21', 'Laki-Laki', 'Kp Majasari', '084862098825', 'karina@gmail.com', '2022-07-12', 'user_1657559168.jpg', 'user_1657559168.png'),
(23, 'AG0023', 'wiliam', '$2y$10$.NjjEjNHab5H8nqJVxnrI.NhsYCUntM19/joLE8KUZH9uWstXI03e', 'Anggota', 'Wiliam', '10106013', 2, 'subang', '2022-07-16', 'Laki-Laki', 'Kp Majasari', '084868846825', 'wiliam@gmail.com', '2022-07-12', 'user_1657559290.jpg', 'user_1657559290.png'),
(24, 'AG0024', 'fanny', '$2y$10$p90DExMDVlm1zZiuwwCvpOQ1vbuDhy3zYdG1D1aEYVlB/9r/OD2LC', 'Anggota', 'Fanny', '10106014', 2, 'subang', '2022-07-14', 'Perempuan', 'Kp Majasari', '084867775472', 'fanny@gmail.com', '2022-07-12', 'user_1657560646.jpg', 'user_1657560646.png'),
(26, 'AG0025', 'tatang', '$2y$10$0Y65kVQH/3PzP7fej4h8u.u7Qwn2i51aTwApoETowsPgKbH69hw92', 'Anggota', 'Tatang', '10106016', 2, 'subang', '2022-07-15', 'Laki-Laki', 'Kp Majasari', '084862878825', 'tatang@gmail.com', '2022-07-12', 'user_1657561090.jpg', 'user_1657561090.png'),
(27, 'AG0027', 'fatna', '$2y$10$Gh6chFt/EsUd6vbw3V1kaOyMrUhIdmBPcWz9jG3rNzap66enNaqIW', 'Anggota', 'Fatna', '10106017', 2, 'subang', '2022-07-30', 'Laki-Laki', 'Kp Majasari', '084862006825', 'fatna@gmail.com', '2022-07-12', 'user_1657561152.jpg', 'user_1657561152.png'),
(28, 'AG0028', 'roni', '$2y$10$kJjnzYth2t.QQvOmTQrYuu2Shy.pQjKrX/bggU0g.c1ZKIT87Gb8a', 'Anggota', 'Roni', '10106018', 2, 'subang', '2022-07-15', 'Laki-Laki', 'Kp Majasari', '084862746825', 'roni@gmail.com', '2022-07-12', 'user_1657561262.jpg', 'user_1657561262.png'),
(29, 'AG0029', 'yanto', '$2y$10$S2YkqLBmprrgOWdhFmw9TeS0hC/QBZUXUuAs0fUi9yx1BcMaigqu6', 'Anggota', 'Yanto', '10106019', 2, 'subang', '2022-07-08', 'Laki-Laki', 'Kp Majasari', '084863488472', 'yanto@gmail.com', '2022-07-12', 'user_1657561347.jpg', 'user_1657561347.png'),
(30, 'AG0030', 'tatara', '$2y$10$5/DxR4oq6TTgTERM8OL2AeLSBwnzw/y0bKUxmIoJitE9rtiOHOeNi', 'Anggota', 'Tatara', '10104020', 2, 'subang', '2022-07-09', 'Laki-Laki', 'Kp Majasari', '084862898472', 'tatara@gmail.com', '2022-07-12', 'user_1657561440.jpg', 'user_1657561440.png'),
(31, 'AG0031', 'harley', '$2y$10$q15D8/FdnQD7byh0UvLNruWlJBeeuGUxQLf0Uy6zvS6Btab96Keey', 'Anggota', 'Harley', '10104021', 2, 'subang', '2022-07-15', 'Laki-Laki', 'Kp Pagaden', '084861148472', 'harley@gmail.com', '2022-07-12', 'user_1657561544.jpg', 'user_1657561544.png'),
(32, 'AG0032', 'maryanto', '$2y$10$FxHDPkJ.hF0Il4OQMikqH.vMTT35ZD/gKb2oPdbmKlkIMgzqrVeci', 'Anggota', 'Maryanto', '10104022', 2, 'subang', '2022-07-15', 'Laki-Laki', 'Kp Pagaden', '084862908472', 'maryanto@gmail.com', '2022-07-12', 'user_1657561691.jpg', 'user_1657561691.png'),
(33, 'AG0033', 'totong', '$2y$10$MQcuyjhMOcpG8Y0JgAlaC.2KPJO1NJnDiLh9N0X38HyiNKrfz7ixG', 'Anggota', 'Totong', '10104023', 2, 'subang', '2022-07-16', 'Laki-Laki', 'Kp Majasari', '084865568472', 'totong@gmail.com', '2022-07-12', 'user_1657561810.jpg', 'user_1657561810.png'),
(34, 'AG0034', 'yuyuna', '$2y$10$iXZOK875D0AtKQJUkdAKmeqNKRN1JOfrtKfbMCUr22g2mLPwURetC', 'Anggota', 'Yuyuna', '10104024', 2, 'subang', '2022-07-08', 'Laki-Laki', 'Kp Majasari', '084864768472', 'yuyuna@gmail.com', '2022-07-12', 'user_1657561897.jpg', 'user_1657561897.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pencarian`
--

CREATE TABLE `tbl_pencarian` (
  `id_pencarian` int(11) NOT NULL,
  `subkategori_id` int(11) DEFAULT NULL,
  `tgl_pencarian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pencarian`
--

INSERT INTO `tbl_pencarian` (`id_pencarian`, `subkategori_id`, `tgl_pencarian`) VALUES
(5, 17, '2022-07-15'),
(6, 30, '2022-07-15'),
(7, 30, '2022-07-15'),
(8, 30, '2022-07-15'),
(9, 30, '2022-07-15'),
(10, 30, '2022-07-15'),
(11, 17, '2022-07-15'),
(12, 17, '2022-07-15'),
(13, 17, '2022-07-15'),
(14, 17, '2022-07-15'),
(15, 17, '2022-07-15'),
(16, 17, '2022-07-15'),
(17, 17, '2022-07-15'),
(18, 17, '2022-07-15'),
(19, 17, '2022-07-15'),
(20, 17, '2022-07-15'),
(21, 17, '2022-07-15'),
(22, 17, '2022-07-15'),
(23, 17, '2022-07-15'),
(24, 17, '2022-07-15'),
(25, 17, '2022-07-15'),
(26, 17, '2022-07-15'),
(27, 17, '2022-07-15'),
(28, 17, '2022-07-15'),
(29, 17, '2022-07-15'),
(30, 17, '2022-07-15'),
(31, 31, '2022-07-15'),
(32, 31, '2022-07-15'),
(33, 31, '2022-07-15'),
(34, 33, '2022-07-15'),
(35, 33, '2022-07-15'),
(36, 33, '2022-07-15'),
(37, 33, '2022-07-15'),
(38, 33, '2022-07-15'),
(39, 33, '2022-07-15'),
(40, 35, '2022-07-15'),
(41, 35, '2022-07-15'),
(42, 35, '2022-07-15'),
(43, 35, '2022-07-15'),
(44, 35, '2022-07-15'),
(45, 35, '2022-07-15'),
(46, 35, '2022-07-15'),
(47, 35, '2022-07-15'),
(48, 35, '2022-07-15'),
(49, 43, '2022-07-15'),
(50, 43, '2022-07-15'),
(51, 44, '2022-07-15'),
(52, 44, '2022-07-15'),
(53, 44, '2022-07-15'),
(54, 46, '2022-07-15'),
(55, 46, '2022-07-15'),
(56, 46, '2022-07-15'),
(57, 46, '2022-07-15'),
(58, 57, '2022-07-15'),
(59, 57, '2022-07-15'),
(60, 57, '2022-07-15'),
(61, 58, '2022-07-15'),
(62, 58, '2022-07-15'),
(63, 63, '2022-07-15'),
(64, 63, '2022-07-15'),
(65, 67, '2022-07-15'),
(66, 67, '2022-07-15'),
(67, 79, '2022-07-15'),
(68, 79, '2022-07-15'),
(69, 80, '2022-07-15'),
(70, 80, '2022-07-15'),
(71, 81, '2022-07-15'),
(72, 81, '2022-07-15'),
(73, 83, '2022-07-15'),
(74, 83, '2022-07-15'),
(75, 83, '2022-07-15'),
(76, 84, '2022-07-15'),
(77, 84, '2022-07-15'),
(78, 84, '2022-07-15'),
(79, 84, '2022-07-15'),
(80, 84, '2022-07-15'),
(81, 85, '2022-07-15'),
(82, 85, '2022-07-15'),
(83, 85, '2022-07-15'),
(84, 85, '2022-07-15'),
(85, 85, '2022-07-15'),
(86, 85, '2022-07-15'),
(87, 85, '2022-07-15'),
(88, 85, '2022-07-15'),
(89, 85, '2022-07-15'),
(90, 84, '2022-07-15'),
(91, 84, '2022-07-15'),
(92, 84, '2022-07-15'),
(93, 84, '2022-07-15'),
(94, 84, '2022-07-15'),
(95, 84, '2022-07-15'),
(96, 84, '2022-07-15'),
(97, 81, '2022-07-15'),
(98, 81, '2022-07-15'),
(99, 81, '2022-07-15'),
(100, 81, '2022-07-15'),
(101, 83, '2022-07-15'),
(102, 83, '2022-07-15'),
(103, 83, '2022-07-15'),
(104, 83, '2022-07-15'),
(105, 80, '2022-07-15'),
(106, 80, '2022-07-15'),
(107, 80, '2022-07-15'),
(108, 80, '2022-07-15'),
(109, 80, '2022-07-15'),
(110, 79, '2022-07-15'),
(111, 79, '2022-07-15'),
(112, 79, '2022-07-15'),
(113, 79, '2022-07-15'),
(114, 81, '2022-07-15'),
(115, 81, '2022-07-15'),
(116, 79, '2022-07-15'),
(117, 79, '2022-07-15'),
(118, 79, '2022-07-15'),
(119, 79, '2022-07-15'),
(120, 57, '2022-07-15'),
(121, 57, '2022-07-15'),
(122, 57, '2022-07-15'),
(123, 44, '2022-07-15'),
(124, 44, '2022-07-15'),
(125, 44, '2022-07-15'),
(126, 43, '2022-07-15'),
(127, 43, '2022-07-15'),
(128, 43, '2022-07-15'),
(129, 43, '2022-07-15'),
(130, 43, '2022-07-15'),
(131, 46, '2022-07-15'),
(132, 46, '2022-07-15'),
(133, 46, '2022-07-15'),
(134, 46, '2022-07-15'),
(135, 46, '2022-07-15'),
(136, 44, '2022-07-15'),
(137, 44, '2022-07-15'),
(138, 57, '2022-07-15'),
(139, 57, '2022-07-15'),
(140, 57, '2022-07-15'),
(141, 57, '2022-07-15'),
(142, 30, '2022-07-15'),
(143, 30, '2022-07-15'),
(144, 30, '2022-07-15'),
(145, 30, '2022-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengunjung`
--

CREATE TABLE `tbl_pengunjung` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(191) NOT NULL,
  `pendidikan_terakhir` varchar(191) NOT NULL,
  `jenis_kelamin` varchar(191) NOT NULL,
  `alamat` text NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pengunjung`
--

INSERT INTO `tbl_pengunjung` (`id`, `nama`, `pekerjaan`, `pendidikan_terakhir`, `jenis_kelamin`, `alamat`, `token`, `created_at`) VALUES
(13, 'ilham', 'Pegawai Swasta', 'SMA', 'Laki - Laki', 'SUBANG', '8083', '2022-07-12 17:58:22'),
(15, 'ilhamm', 'Mahasiswa', 'SMP', 'Laki - Laki', 'subang', '5966', '2022-07-14 07:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam`
--

CREATE TABLE `tbl_pinjam` (
  `id_pinjam` int(11) NOT NULL,
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
  `periode_kembali` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pinjam`
--

INSERT INTO `tbl_pinjam` (`id_pinjam`, `pinjam_id`, `anggota_id`, `buku_id`, `status`, `jml`, `tgl_pinjam`, `lama_pinjam`, `tgl_balik`, `tgl_kembali`, `periode`, `periode_kembali`) VALUES
(95, 'PJ001', 'AG0034', 'BK0072', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(96, 'PJ0096', 'AG0030', 'BK0073', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(97, 'PJ0097', 'AG0031', 'BK0073', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(98, 'PJ0098', 'AG0014', 'BK0073', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(99, 'PJ0099', 'AG0020', 'BK0073', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(100, 'PJ00100', 'AG0015', 'BK0073', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(101, 'PJ00101', 'AG0034', 'BK0073', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(102, 'PJ00102', 'AG0022', 'BK003', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(103, 'PJ00103', 'AG0022', 'BK001', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(104, 'PJ00104', 'AG0015', 'BK001', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(105, 'PJ00105', 'AG0032', 'BK002', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(106, 'PJ00106', 'AG0034', 'BK007', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(107, 'PJ00107', 'AG0031', 'BK007', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(108, 'PJ00108', 'AG0033', 'BK007', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(109, 'PJ00109', 'AG0030', 'BK007', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(110, 'PJ00110', 'AG0020', 'BK007', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(111, 'PJ00111', 'AG0032', 'BK0064', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(112, 'PJ00112', 'AG0030', 'BK0063', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(113, 'PJ00113', 'AG0025', 'BK0064', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(114, 'PJ00114', 'AG0024', 'BK0064', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(115, 'PJ00115', 'AG0013', 'BK0064', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(116, 'PJ00116', 'AG0014', 'BK0064', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(117, 'PJ00117', 'AG0027', 'BK0064', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(118, 'PJ00118', 'AG0032', 'BK0062', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(119, 'PJ00119', 'AG0030', 'BK0061', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(120, 'PJ00120', 'AG0031', 'BK006', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(121, 'PJ00121', 'AG0031', 'BK009', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(122, 'PJ00122', 'AG0032', 'BK0044', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(123, 'PJ00123', 'AG0031', 'BK008', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(124, 'PJ00124', 'AG0015', 'BK012', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(125, 'PJ00125', 'AG0033', 'BK0040', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(126, 'PJ00126', 'AG0031', 'BK0040', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(127, 'PJ00127', 'AG0034', 'BK0038', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(128, 'PJ00128', 'AG0022', 'BK0037', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(129, 'PJ00129', 'AG0034', 'BK0037', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(130, 'PJ00130', 'AG0031', 'BK0042', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(131, 'PJ00131', 'AG0030', 'BK0042', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(132, 'PJ00132', 'AG0031', 'BK0043', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(133, 'PJ00133', 'AG0016', 'BK0042', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(134, 'PJ00134', 'AG0018', 'BK0042', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(135, 'PJ00135', 'AG0030', 'BK0046', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(136, 'PJ00136', 'AG0031', 'BK0046', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(137, 'PJ00137', 'AG0020', 'BK0046', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(138, 'PJ00138', 'AG0020', 'BK0049', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(139, 'PJ00139', 'AG0015', 'BK0049', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(140, 'PJ00140', 'AG0017', 'BK0057', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(141, 'PJ00141', 'AG0021', 'BK0053', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(142, 'PJ00142', 'AG0027', 'BK0055', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(143, 'PJ00143', 'AG0031', 'BK0055', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(144, 'PJ00144', 'AG0016', 'BK0057', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(145, 'PJ00145', 'AG0031', 'BK0070', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL),
(146, 'PJ00146', 'AG0034', 'BK0065', 'Dipinjam', 1, '2022-07-15', 7, '2022-07-22', '0', '07-2022', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rak`
--

CREATE TABLE `tbl_rak` (
  `id_rak` int(11) NOT NULL,
  `nama_rak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rak`
--

INSERT INTO `tbl_rak` (`id_rak`, `nama_rak`) VALUES
(13, 'Rak Buku 1'),
(14, 'Rak Buku 2'),
(15, 'Rak Buku 3'),
(16, 'Rak Buku 4'),
(17, 'Rak Buku 5'),
(18, 'Rak Buku 6'),
(19, 'Rak Buku 7'),
(20, 'Rak Buku 8');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `id_status` int(11) NOT NULL,
  `nama_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`id_status`, `nama_status`) VALUES
(2, 'Umum'),
(6, 'SMA'),
(7, 'PNS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subkategori`
--

CREATE TABLE `tbl_subkategori` (
  `id_subkategori` bigint(20) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nama_subkategori` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subkategori`
--

INSERT INTO `tbl_subkategori` (`id_subkategori`, `kategori_id`, `nama_subkategori`) VALUES
(17, 24, 'Publikasi Umum dan Teknologi'),
(18, 24, 'Bibiliografi'),
(19, 24, 'Perpustakaan dan Informasi'),
(20, 24, 'Ensiklopedia'),
(21, 24, 'Majalah dan Jurnal'),
(22, 24, 'Asosiasi, Organisasi dan Museum'),
(23, 24, 'Media Massa, Junalisme, dan Publikasi'),
(24, 24, 'Kutipan'),
(25, 24, 'Manuskrip dan Buku Langka'),
(27, 25, 'Metafisika'),
(28, 25, 'Epistimologi'),
(29, 25, 'Parapsikologi dan Okultisme'),
(30, 25, 'Pemikiran Filosofis'),
(31, 25, 'Filsafat dan Psikologi'),
(32, 25, 'Psikologi Logis'),
(33, 25, 'Etik'),
(34, 25, 'Filosofi kuno, Zaman Pertengahan, dan Filosofi'),
(35, 26, 'Agama Lain'),
(36, 26, 'Alkitab'),
(37, 26, 'Agama Islam'),
(38, 26, 'Teologi Kristen'),
(39, 26, 'Perbandingan Agama'),
(40, 27, 'Statistik Umum'),
(41, 27, 'Ilmu Politik'),
(42, 27, 'Ilmu Ekonomi'),
(43, 27, 'Ilmu Hukum'),
(44, 27, 'Administrasi Negara'),
(45, 27, 'Layanan Sosial'),
(46, 27, 'Pendidikan'),
(47, 27, 'Perdagangan, Komunikasi , Transport'),
(48, 27, 'Adat Istiadat dan Kebiasaan'),
(49, 28, 'Bahasa Indonesia'),
(50, 28, 'Bahasa Inggris'),
(51, 28, 'Bahasa Jerman'),
(52, 28, 'Bahasa Perancis'),
(53, 28, 'Bahasa Italia'),
(54, 28, 'Bahasa Spanyol &amp; Portugis'),
(55, 28, 'Bahasa Latin'),
(56, 29, 'Matematika'),
(57, 29, 'Astronomi'),
(58, 29, 'Fisika'),
(59, 29, 'Kimia'),
(60, 29, 'Ilmu Pengetahuan  tentang bumi &amp; Dunia lain'),
(61, 29, 'Paleontologi'),
(62, 29, 'Ilmu Tentang Kehidupan'),
(63, 29, 'Ilmu Tentang Tumbuhan'),
(64, 29, 'Ilmu Tentang Hewan'),
(65, 30, 'Ilmu Kedokteran'),
(66, 30, 'Ilmu Teknik'),
(67, 30, 'Pertanian'),
(68, 30, 'Kesejahteraan rumah tangga'),
(69, 30, 'Manajemen'),
(70, 30, 'Teknologi Kimia'),
(71, 30, 'Pabrik - Pabrik'),
(72, 30, 'Bangunan'),
(73, 31, 'Seni Perkotaan &amp; Pertanaman'),
(74, 31, 'Arsitektur'),
(75, 31, 'Seni Plastik &amp; Seni Pahat Patung'),
(76, 31, 'Menggambar &amp; Seni dekorasi'),
(77, 31, 'Seni Lukis &amp; Lukisan'),
(78, 31, 'Seni Grafika'),
(79, 31, 'Fotografi'),
(80, 31, 'Musik'),
(81, 31, 'Seni Rekereasi &amp; Pertunjukan'),
(82, 32, 'Novel'),
(83, 32, 'Buku Cerita'),
(84, 33, 'Geografi dan Kisah Perjalanan'),
(85, 33, 'Biografi'),
(86, 33, 'Sejarah dunia purba'),
(87, 33, 'Sejarah umum eropa'),
(88, 33, 'Sejarah umum asia'),
(89, 33, 'Sejarah umum Afrika'),
(90, 33, 'Sejarah umum Amerika Utara');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sumber`
--

CREATE TABLE `tbl_sumber` (
  `id_sumber` bigint(20) NOT NULL,
  `nama_sumber` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sumber`
--

INSERT INTO `tbl_sumber` (`id_sumber`, `nama_sumber`) VALUES
(4, 'APBN'),
(5, 'APBN 2019');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id_token` int(11) NOT NULL,
  `token` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id_token`, `token`) VALUES
(1, '5966');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengarang_tambahan`
--
ALTER TABLE `pengarang_tambahan`
  ADD PRIMARY KEY (`id_pengarang_tambahan`);

--
-- Indexes for table `tbl_atur`
--
ALTER TABLE `tbl_atur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_biaya_denda`
--
ALTER TABLE `tbl_biaya_denda`
  ADD PRIMARY KEY (`id_biaya_denda`);

--
-- Indexes for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `tbl_denda`
--
ALTER TABLE `tbl_denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id_login`),
  ADD UNIQUE KEY `user` (`user`);

--
-- Indexes for table `tbl_pencarian`
--
ALTER TABLE `tbl_pencarian`
  ADD PRIMARY KEY (`id_pencarian`);

--
-- Indexes for table `tbl_pengunjung`
--
ALTER TABLE `tbl_pengunjung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indexes for table `tbl_rak`
--
ALTER TABLE `tbl_rak`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tbl_subkategori`
--
ALTER TABLE `tbl_subkategori`
  ADD PRIMARY KEY (`id_subkategori`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `tbl_sumber`
--
ALTER TABLE `tbl_sumber`
  ADD PRIMARY KEY (`id_sumber`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengarang_tambahan`
--
ALTER TABLE `pengarang_tambahan`
  MODIFY `id_pengarang_tambahan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbl_atur`
--
ALTER TABLE `tbl_atur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_biaya_denda`
--
ALTER TABLE `tbl_biaya_denda`
  MODIFY `id_biaya_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `tbl_denda`
--
ALTER TABLE `tbl_denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2213;

--
-- AUTO_INCREMENT for table `tbl_pencarian`
--
ALTER TABLE `tbl_pencarian`
  MODIFY `id_pencarian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `tbl_pengunjung`
--
ALTER TABLE `tbl_pengunjung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `tbl_rak`
--
ALTER TABLE `tbl_rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_subkategori`
--
ALTER TABLE `tbl_subkategori`
  MODIFY `id_subkategori` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tbl_sumber`
--
ALTER TABLE `tbl_sumber`
  MODIFY `id_sumber` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_subkategori`
--
ALTER TABLE `tbl_subkategori`
  ADD CONSTRAINT `tbl_subkategori_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `tbl_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
