-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 05:25 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simawar_6c`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bagian`
--

CREATE TABLE `tbl_bagian` (
  `id_bagian` int(11) NOT NULL,
  `nm_bagian` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bagian`
--

INSERT INTO `tbl_bagian` (`id_bagian`, `nm_bagian`) VALUES
(1, 'kepegawaian'),
(2, 'akademik'),
(3, 'penelitian'),
(4, 'rektorat');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_srt_klr`
--

CREATE TABLE `tbl_srt_klr` (
  `id_srt_klr` int(11) NOT NULL,
  `no_srt` varchar(50) NOT NULL,
  `tgl_srt` date NOT NULL,
  `lampiran` varchar(50) NOT NULL,
  `hal` varchar(100) NOT NULL,
  `untuk` text NOT NULL,
  `file` text NOT NULL,
  `penandatangan` int(11) NOT NULL,
  `tgl_ttd` date DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `oleh` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_srt_klr`
--

INSERT INTO `tbl_srt_klr` (`id_srt_klr`, `no_srt`, `tgl_srt`, `lampiran`, `hal`, `untuk`, `file`, `penandatangan`, `tgl_ttd`, `status`, `tgl_input`, `oleh`) VALUES
(1, '20/UNISKA-MAB/2022', '2022-04-11', '1 Berkas', 'Permintaan Tempat Magang', 'PDAM Bandarmasih', '623bf2a96e82a.pdf', 4, '2022-04-11', 'Ditandatangani', '2022-04-19 05:18:57', 'rifaninoer'),
(5, '002/UNISKA/V/2022', '2022-05-22', '-', 'Pengajuan Dosen Tamu', 'ITB', '628a4c213d653.pdf', 3, NULL, 'New', '2022-05-22 22:43:18', 'rifaninoer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_srt_msk`
--

CREATE TABLE `tbl_srt_msk` (
  `id_srt_msk` int(11) NOT NULL,
  `no_srt` varchar(50) NOT NULL,
  `tgl_srt` date NOT NULL,
  `lampiran` varchar(50) NOT NULL,
  `hal` varchar(100) NOT NULL,
  `dari` text NOT NULL,
  `file` text NOT NULL,
  `tgl_terima` datetime NOT NULL,
  `penerima` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_srt_msk`
--

INSERT INTO `tbl_srt_msk` (`id_srt_msk`, `no_srt`, `tgl_srt`, `lampiran`, `hal`, `dari`, `file`, `tgl_terima`, `penerima`) VALUES
(2, '10/LPM/UNISKA/2021', '2022-05-22', '1 Berkas', 'Pengajuan Dosen', 'ifan', '628a3749376c4.pdf', '2022-05-22 21:14:15', 'rifaninoer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nm_user` varchar(200) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` int(11) NOT NULL,
  `tgl_reg` datetime NOT NULL,
  `oleh` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `theme` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `nm_user`, `nik`, `id_bagian`, `telp`, `email`, `foto`, `password`, `level`, `tgl_reg`, `oleh`, `status`, `theme`) VALUES
(1, 'Rifani', 'rifaninoer', '19631085', 1, '081251208618', 'rifaninoer@gmail.com', 'default.png', '$2y$10$RMQ6mpt/L0zMr2SfnaiRhObJUg6dR/8WIRlbMrenFMt9FuCRofFZ2', 1, '2022-04-19 05:02:06', 'rifaninoer', 1, 'dark-theme'),
(2, 'Ifan', 'Ifan Rifani', '19631086', 2, '081251208617', 'ifanrifani@gmail.com', 'default.png', '$2y$10$RMQ6mpt/L0zMr2SfnaiRhObJUg6dR/8WIRlbMrenFMt9FuCRofFZ2', 2, '2022-04-19 05:04:40', 'rifaninoer', 1, 'semi_dark'),
(3, 'riezki', 'riezki ifan', '19631087', 3, '081251208619', 'riezkiifan@gmail.com', 'default.png', '$2y$10$RMQ6mpt/L0zMr2SfnaiRhObJUg6dR/8WIRlbMrenFMt9FuCRofFZ2', 3, '2022-04-19 05:04:40', 'rifaninoer', 1, 'semi_dark'),
(4, 'muhammadrifani', 'muhammadrifani', '19631090', 4, '081251208610', 'muhammadrifani@gmail.com', 'default.png', '$2y$10$RMQ6mpt/L0zMr2SfnaiRhObJUg6dR/8WIRlbMrenFMt9FuCRofFZ2', 4, '2022-04-19 05:04:40', 'rifaninoer', 1, 'semi-dark');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bagian`
--
ALTER TABLE `tbl_bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indexes for table `tbl_srt_klr`
--
ALTER TABLE `tbl_srt_klr`
  ADD PRIMARY KEY (`id_srt_klr`);

--
-- Indexes for table `tbl_srt_msk`
--
ALTER TABLE `tbl_srt_msk`
  ADD PRIMARY KEY (`id_srt_msk`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bagian`
--
ALTER TABLE `tbl_bagian`
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_srt_klr`
--
ALTER TABLE `tbl_srt_klr`
  MODIFY `id_srt_klr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_srt_msk`
--
ALTER TABLE `tbl_srt_msk`
  MODIFY `id_srt_msk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
