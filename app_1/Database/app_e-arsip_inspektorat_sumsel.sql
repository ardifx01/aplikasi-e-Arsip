-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 16, 2025 at 06:41 AM
-- Server version: 11.7.2-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_e-arsip_inspektorat_sumsel`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` int(8) UNSIGNED NOT NULL,
  `kode_jenis` char(50) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `status_cd` enum('normal','nullified') NOT NULL DEFAULT 'normal',
  `created_user` int(8) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_user` int(8) DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `nullified_user` int(8) DEFAULT NULL,
  `nullified_dttm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `kode_jenis`, `nama_jenis`, `keterangan`, `status_cd`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, '001', 'Surat Perintah Tugas', 'Surat Perintah Tugas Inspektorat Provinsi Sumatera Selatan', 'normal', NULL, '2025-07-10 13:54:43', NULL, NULL, NULL, NULL),
(2, '002', 'Peraturan Perundang-undangan', 'Peraturan Perundang-undangan', 'normal', 1, '2025-07-10 14:01:04', NULL, NULL, NULL, NULL),
(3, '003', 'Surat Keputusan Dan Surat Keterangan', 'Surat Keputusan Dan Surat Keterangan', 'normal', 1, '2025-07-10 14:01:25', NULL, NULL, NULL, NULL),
(4, '004', 'Surat Pengantar', 'Surat Pengantar', 'normal', 1, '2025-07-10 14:01:38', NULL, NULL, NULL, NULL),
(5, '005', 'Surat Pernyataan', 'Surat Pernyataan', 'normal', 1, '2025-07-10 14:01:51', NULL, NULL, NULL, NULL),
(6, '006', 'Surat Instruksi ', 'Surat Instruksi ', 'normal', 1, '2025-07-10 14:02:11', NULL, NULL, NULL, NULL),
(7, '007', 'Surat Perintah Menjalankan Tugas', 'Surat Perintah Menjalankan Tugas', 'normal', 1, '2025-07-10 14:02:34', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi`
--

CREATE TABLE `klasifikasi` (
  `id` int(8) UNSIGNED NOT NULL,
  `kode_klasifikasi` char(50) NOT NULL,
  `nama_klasifikasi` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `status_cd` enum('normal','nullified') NOT NULL DEFAULT 'normal',
  `created_user` int(8) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_user` int(8) DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `nullified_user` int(8) DEFAULT NULL,
  `nullified_dttm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klasifikasi`
--

INSERT INTO `klasifikasi` (`id`, `kode_klasifikasi`, `nama_klasifikasi`, `keterangan`, `status_cd`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, '001', 'Umum', 'Klasifikasi Surat Umum', 'normal', NULL, '2025-07-10 13:54:50', 1, '2025-07-10 14:04:25', NULL, NULL),
(2, '002', 'Kepegawaian', 'Klasifikasi Surat Kepegawaian', 'normal', 1, '2025-07-10 14:04:46', NULL, NULL, NULL, NULL),
(3, '003', 'Undangan', 'Klasifikasi Surat Undangan', 'normal', 1, '2025-07-10 14:05:03', NULL, NULL, NULL, NULL),
(4, '004', 'Keuangan', 'Klasifikasi Surat Keuangan', 'normal', 1, '2025-07-10 14:05:18', NULL, NULL, NULL, NULL),
(5, '005', 'Pendidikan', 'Klasifikasi Surat Pendidikan', 'normal', 1, '2025-07-10 14:05:36', NULL, NULL, NULL, NULL),
(6, '006', 'Laporan', 'Klasifikasi Surat Laporan', 'normal', 1, '2025-07-10 14:05:50', NULL, NULL, NULL, NULL),
(7, '007', 'Pengantar', 'Klasifikasi Surat Pengantar', 'normal', 1, '2025-07-10 14:06:06', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(14, '2025-07-05-155125', 'App\\Database\\Migrations\\Pengguna', 'default', 'App', 1752130418, 1),
(15, '2025-07-08-045202', 'App\\Database\\Migrations\\Unit', 'default', 'App', 1752130418, 1),
(16, '2025-07-08-094647', 'App\\Database\\Migrations\\Jenis', 'default', 'App', 1752130418, 1),
(17, '2025-07-08-111537', 'App\\Database\\Migrations\\Sifat', 'default', 'App', 1752130418, 1),
(18, '2025-07-08-230054', 'App\\Database\\Migrations\\Klasifikasi', 'default', 'App', 1752130418, 1),
(19, '2025-07-08-232201', 'App\\Database\\Migrations\\Surat', 'default', 'App', 1752130418, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(8) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telepon` char(20) NOT NULL,
  `email` char(50) NOT NULL,
  `username` char(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('user','admin','verifikasi','kepala') NOT NULL,
  `status_user` enum('active','deactive') NOT NULL DEFAULT 'active',
  `alamat` text NOT NULL,
  `status_cd` enum('normal','nullified') NOT NULL DEFAULT 'normal',
  `created_user` int(8) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_user` int(8) DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `nullified_user` int(8) DEFAULT NULL,
  `nullified_dttm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `jenis_kelamin`, `telepon`, `email`, `username`, `password`, `level`, `status_user`, `alamat`, `status_cd`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, 'Administrator System', 'P', '628 xxx-xxx-xxx', 'binarykid1412@gmail.com', 'admin', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'admin', 'active', 'https://github/redhorivai', 'normal', NULL, '2025-07-10 13:54:25', NULL, NULL, NULL, NULL),
(2, 'Petugas Umum', 'L', '081223123131', 'umum@mail.com', 'petugas_umum', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'user', 'active', 'jl. kapten rivai', 'normal', 1, '2025-07-10 14:34:15', NULL, NULL, NULL, NULL),
(3, 'Petugas Sekretaris', 'L', '08123123123', 'sekretaris@mail.com', 'petugas_sekretaris', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'verifikasi', 'active', 'Jl. Kapten Arivai', 'normal', 1, '2025-07-10 14:34:52', NULL, NULL, NULL, NULL),
(4, 'Petugas Kepala Inspektur', 'L', '08123424121', 'inspektur@mail.com', 'kepala_inspektur', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'kepala', 'active', 'jl. Kapten Arivai', 'normal', 1, '2025-07-10 14:35:42', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sifat`
--

CREATE TABLE `sifat` (
  `id` int(8) UNSIGNED NOT NULL,
  `kode_sifat` char(50) NOT NULL,
  `nama_sifat` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `status_cd` enum('normal','nullified') NOT NULL DEFAULT 'normal',
  `created_user` int(8) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_user` int(8) DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `nullified_user` int(8) DEFAULT NULL,
  `nullified_dttm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sifat`
--

INSERT INTO `sifat` (`id`, `kode_sifat`, `nama_sifat`, `keterangan`, `status_cd`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, '001', 'Biasa', 'Sifat Surat Biasa', 'normal', NULL, '2025-07-10 13:55:02', NULL, NULL, NULL, NULL),
(2, '002', 'Penting', 'Surat Penting', 'normal', 1, '2025-07-10 14:03:02', NULL, NULL, NULL, NULL),
(3, '003', 'Rahasia', 'Surat Rahasia', 'normal', 1, '2025-07-10 14:03:18', NULL, NULL, NULL, NULL),
(4, '004', 'Sangat Rahasia', 'Surat Sangat Rahasia', 'normal', 1, '2025-07-10 14:03:37', NULL, NULL, NULL, NULL),
(5, '005', 'Segera', 'Surat Segera', 'normal', 1, '2025-07-10 14:03:50', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` int(8) UNSIGNED NOT NULL,
  `tipe` enum('suratmasuk','suratkeluar') NOT NULL,
  `trackID` varchar(255) DEFAULT NULL,
  `koresponden` text DEFAULT NULL,
  `no_surat` varchar(255) DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `id_unit` int(10) UNSIGNED DEFAULT NULL,
  `id_jenis` int(10) UNSIGNED DEFAULT NULL,
  `id_sifat` int(10) UNSIGNED DEFAULT NULL,
  `id_klasifikasi` int(10) UNSIGNED DEFAULT NULL,
  `id_sekretaris` int(10) UNSIGNED NOT NULL,
  `id_kepala` int(10) UNSIGNED NOT NULL,
  `status` enum('pengajuan','proses','setuju') NOT NULL,
  `perihal` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `file_surat` text DEFAULT NULL,
  `status_cd` enum('normal','nullified') NOT NULL DEFAULT 'normal',
  `created_user` int(8) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_user` int(8) DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `nullified_user` int(8) DEFAULT NULL,
  `nullified_dttm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(8) UNSIGNED NOT NULL,
  `kode_unit` char(50) NOT NULL,
  `nama_unit` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `status_cd` enum('normal','nullified') NOT NULL DEFAULT 'normal',
  `created_user` int(8) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_user` int(8) DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `nullified_user` int(8) DEFAULT NULL,
  `nullified_dttm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `kode_unit`, `nama_unit`, `keterangan`, `status_cd`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, '001', 'Bagian Umum', 'Bagian Umum', 'normal', NULL, '2025-07-10 13:54:35', 1, '2025-07-10 13:56:37', NULL, NULL),
(2, '002', 'Bagian Kepegawaian', 'Bagian Kepegawaian', 'normal', 1, '2025-07-10 13:56:51', NULL, NULL, NULL, NULL),
(3, '003', 'Bagian Keuangan', 'Bagian Keuangan', 'normal', 1, '2025-07-10 13:57:27', NULL, NULL, NULL, NULL),
(4, '004', 'Inspektur Pembantu I', 'Inspektur Pembantu I', 'normal', 1, '2025-07-10 13:58:32', NULL, NULL, NULL, NULL),
(5, '005', 'Inspektur Pembantu II', 'Inspektur Pembantu II', 'normal', 1, '2025-07-10 13:58:44', NULL, NULL, NULL, NULL),
(6, '006', 'Inspektur Pembantu III', 'Inspektur Pembantu III', 'normal', 1, '2025-07-10 13:59:01', NULL, NULL, NULL, NULL),
(7, '007', 'Inspektur Pembantu IV', 'Inspektur Pembantu IV', 'normal', 1, '2025-07-10 13:59:36', NULL, NULL, NULL, NULL),
(8, '008', 'Inspektur Investigasi', 'Inspektur Investigasi', 'normal', 1, '2025-07-10 13:59:58', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sifat`
--
ALTER TABLE `sifat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_id_unit_foreign` (`id_unit`),
  ADD KEY `surat_id_jenis_foreign` (`id_jenis`),
  ADD KEY `surat_id_sifat_foreign` (`id_sifat`),
  ADD KEY `surat_id_klasifikasi_foreign` (`id_klasifikasi`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sifat`
--
ALTER TABLE `sifat`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `surat_id_jenis_foreign` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `surat_id_klasifikasi_foreign` FOREIGN KEY (`id_klasifikasi`) REFERENCES `klasifikasi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `surat_id_sifat_foreign` FOREIGN KEY (`id_sifat`) REFERENCES `sifat` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `surat_id_unit_foreign` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
