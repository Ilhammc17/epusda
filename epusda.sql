-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2022 at 08:21 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

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

INSERT INTO `tbl_buku` (`id_buku`, `buku_id`, `id_kategori`, `id_rak`, `sampul`, `isbn`, `lampiran`, `title`, `penerbit`, `pengarang`, `thn_buku`, `isi`, `jml`, `dipinjam`, `tgl_masuk`) VALUES
(8, 'BK008', 2, 1, 'ac947b2da45d496b807bd333d90fd100.png', '132-123-234-231', '989c4ebb0fd5cc4ef90b9539da949ed7.pdf', 'CARA MUDAH BELAJAR PEMROGRAMAN C++', 'INFORMATIKA BANDUNG', 'BUDI RAHARJO ', '2012', '<table class=\"table table-bordered\" style=\"background-color: rgb(255, 255, 255); width: 653px; color: rgb(51, 51, 51);\"><tbody><tr><td style=\"padding: 8px; line-height: 1.42857; border-color: rgb(244, 244, 244);\">Tipe Buku</td><td style=\"padding: 8px; line-height: 1.42857; border-color: rgb(244, 244, 244);\">Kertas</td></tr><tr><td style=\"padding: 8px; line-height: 1.42857; border-color: rgb(244, 244, 244);\">Bahasa</td><td style=\"padding: 8px; line-height: 1.42857; border-color: rgb(244, 244, 244);\">Indonesia</td></tr></tbody></table>', 23, 0, '2022-05-26 12:40:14'),
(17, 'BK009', 2, 1, 'aaa580cab9ad3ea611870af91ccb83ae.jpg', '123213134', NULL, 'Belajar Web PHP &amp; MySQL', 'buku belajar', 'Ilham', '2021', '', 10, 1, '2022-05-26 12:39:42');

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
-- Table structure for table `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(2, 'Umum'),
(4, 'SD'),
(5, 'SMP'),
(6, 'SMA'),
(7, 'PNS');

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
  `id_jurusan` int(11) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` varchar(255) NOT NULL,
  `jenkel` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tgl_bergabung` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id_login`, `anggota_id`, `user`, `pass`, `level`, `nama`, `nim`, `id_jurusan`, `tempat_lahir`, `tgl_lahir`, `jenkel`, `alamat`, `telepon`, `email`, `tgl_bergabung`, `foto`) VALUES
(1, 'AG001', 'petugas', '$2y$10$cBPIp9auqUmtsGc8ARRko.V.3SspEmoY6K4SReqHNmJeIoHZvMGLW', 'Petugas', 'Ilham', '10106018', 2, 'Subang', '1999-04-05', 'Laki-Laki', 'Subang', '081234567890', 'Petugas@gmail.com', '2019-11-20', 'user_1632210994.png'),
(2, 'AG002', 'kemal', '$2y$10$AIT3I7ahl5cRLpaqKZyUh.nbs4OjbrS06/4iBZSCQYZ9qUZMdzzXm', 'Anggota', 'Kemal kasep', '10106019', 2, 'Subang', '1998-11-18', 'Laki-Laki', 'Subang', '081234567890', 'kemal@gmail.com', '2019-11-21', 'user_1653548245.png'),
(4, '', 'superadmin', '$2y$10$rbsYs2aOAyKN.6LB3llz/uoY3WIySlaCztE.iYyypXTKRabJODpFS', 'Superadmin', 'superadmin', '', 2, 'Subang', '1999-04-05', 'Laki-Laki', 'Subang', '081234567890', 'Petugas@gmail.com', '2019-11-20', 'user_1632210994.png'),
(5, '', 'admin', '$2y$10$Ecy14db7EZZKh8EYpEdf2OkJQ.UsvwgJY5gu8rgmOZ4y5ebzjbQ/a', 'Petugas', 'rafi', NULL, 0, '', '', '', '', '085723853284', 'rafi@gmail.com', '', ''),
(7, '', 'bagus', '$2y$10$7m/2epoCTh1gWVLVs/l6Mu0/6qHe.TuHcv3KUatAvojeMHEH4Ck7O', 'Petugas', 'bagus', NULL, 0, '', '', '', '', '085723853284', 'bagassetia271@gmail.com', '', '');

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

--
-- Indexes for dumped tables
--

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
-- Indexes for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

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
-- AUTO_INCREMENT for dumped tables
--

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
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_denda`
--
ALTER TABLE `tbl_denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
