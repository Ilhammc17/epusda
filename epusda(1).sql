-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2022 at 02:25 PM
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
(4, 'BK0018', 'a');

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
(1, 'Epusda', 'Epusda@gmail.com', '089618173609', 'Subang', 'epusda.png');

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
(1, '4000', 'Aktif', '2021-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku`
--

CREATE TABLE `tbl_buku` (
  `id_buku` int(11) NOT NULL,
  `buku_id` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `subkategori_id` bigint(20) NOT NULL,
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

INSERT INTO `tbl_buku` (`id_buku`, `buku_id`, `id_kategori`, `subkategori_id`, `id_rak`, `sampul`, `isbn`, `lampiran`, `title`, `penerbit`, `pengarang`, `thn_buku`, `isi`, `jml`, `dipinjam`, `tgl_masuk`) VALUES
(20, 'BK0018', 13, 1, 6, '4cf8511ab5359374a243141e1f060307.jpg', 'a', NULL, 'a', 'a', 'a', '2222', '<p>a</p>', 12, 0, '2022-06-26 17:48:56');

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
(12, 'PJ0026', '0', 0, '2021-11-06'),
(13, 'PJ0025', '35972000', 8993, '2022-01-04'),
(14, 'PJ0026', '228000', 57, '2022-01-04'),
(16, 'PJ005', '0', 0, '2022-01-24'),
(17, 'PJ003', '0', 0, '2022-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Pemrograman'),
(3, 'Machine Learning'),
(4, 'Karya Umum'),
(5, 'Filsafat'),
(6, 'Agama'),
(7, 'Ilmu Sosial'),
(8, 'Ilmu Bahasa'),
(9, 'Ilmu Murni'),
(10, 'Ilmu Terapan'),
(11, 'Kesenian Olahraga Hiiburan'),
(12, 'Fiksi'),
(13, 'Geografi dan Sejarah');

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
(1, 'AG001', 'petugas', '$2y$10$cBPIp9auqUmtsGc8ARRko.V.3SspEmoY6K4SReqHNmJeIoHZvMGLW', 'Petugas', 'Ilham', '10106018', 2, 'Subang', '1999-04-05', 'Laki-Laki', 'Subang', '081234567890', 'Petugas@gmail.com', '2019-11-20', 'user_1632210994.png', ''),
(2, 'AG002', 'kemal', '$2y$10$AIT3I7ahl5cRLpaqKZyUh.nbs4OjbrS06/4iBZSCQYZ9qUZMdzzXm', 'Anggota', 'Kemal kasep', '10106019', 2, 'Subang', '1998-11-18', 'Laki-Laki', 'Subang', '081234567890', 'kemal@gmail.com', '2019-11-21', 'user_1653548245.png', 'ktp_1656231565.jpg'),
(4, '', 'superadmin', '$2y$10$rbsYs2aOAyKN.6LB3llz/uoY3WIySlaCztE.iYyypXTKRabJODpFS', 'Superadmin', 'superadmin', '', 2, 'Subang', '1999-04-05', 'Laki-Laki', 'Subang', '081234567890', 'Petugas@gmail.com', '2019-11-20', 'user_1632210994.png', ''),
(5, '', 'admin', '$2y$10$Ecy14db7EZZKh8EYpEdf2OkJQ.UsvwgJY5gu8rgmOZ4y5ebzjbQ/a', 'Petugas', 'rafi', NULL, 0, '', '', '', '', '085723853284', 'rafi@gmail.com', '', '', ''),
(7, '', 'bagus', '$2y$10$7m/2epoCTh1gWVLVs/l6Mu0/6qHe.TuHcv3KUatAvojeMHEH4Ck7O', 'Petugas', 'bagus', NULL, 0, '', '', '', '', '085723853284', 'bagassetia271@gmail.com', '', '', ''),
(11, 'AG008', 'bagas', '$2y$10$MOGIHAE7MvHitBDm8YEeOO3IRs2rWusAdpVwEAbJtKkiLoK.1Sw.W', 'Anggota', 'bagas', '10104019', 2, 'subang', '2022-06-08', 'Laki-Laki', 'asdfadf', '123123123', 'knjkjshgh@gmail.com', '2022-06-26', 'user_1656231176.jpg', 'user_1656231176.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengunjung`
--

CREATE TABLE `tbl_pengunjung` (
  `id` int(11) NOT NULL,
  `anggota_id` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `tgl_masuk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pengunjung`
--

INSERT INTO `tbl_pengunjung` (`id`, `anggota_id`, `nama`, `created_at`, `tgl_masuk`) VALUES
(1, 'AG001', 'Anang', '2021-09-21 14:50:46', '2021-09-21'),
(2, 'ag002', 'Fauzan Falah', '2021-09-21 14:52:12', '2021-09-21'),
(3, 'ag001', 'Anang', '2021-09-21 14:52:48', '2021-09-21'),
(4, '10107001', 'Septian', '2022-05-26 13:53:09', '2022-05-26');

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
(3, 'PJ003', 'AG002', 'BK009', 'Di Kembalikan', 3, '2022-01-24', 2, '2022-01-26', '2022-01-24', '01-2022', '01-2022'),
(4, 'PJ003', 'AG002', 'BK008', 'Di Kembalikan', 2, '2022-01-24', 2, '2022-01-26', '2022-01-24', '01-2022', '01-2022'),
(5, 'PJ005', 'AG002', 'BK009', 'Di Kembalikan', 3, '2022-01-24', 2, '2022-01-26', '2022-01-24', '01-2022', '01-2022'),
(18, 'PJ0018', 'AG002', 'BK009', 'Dipinjam', 1, '2022-04-14', 2, '2022-04-16', '0', '04-2022', NULL);

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
(1, 'Rak Buku 1'),
(4, 'Rak Buku 2'),
(5, 'Rak Buku 3'),
(6, 'Rak Buku 4');

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
(1, 13, 'Publikasi umum'),
(2, 13, 'Bibiliografi');

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
  ADD PRIMARY KEY (`id_login`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengarang_tambahan`
--
ALTER TABLE `pengarang_tambahan`
  MODIFY `id_pengarang_tambahan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_atur`
--
ALTER TABLE `tbl_atur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_biaya_denda`
--
ALTER TABLE `tbl_biaya_denda`
  MODIFY `id_biaya_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_denda`
--
ALTER TABLE `tbl_denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_pengunjung`
--
ALTER TABLE `tbl_pengunjung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_rak`
--
ALTER TABLE `tbl_rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_subkategori`
--
ALTER TABLE `tbl_subkategori`
  MODIFY `id_subkategori` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
