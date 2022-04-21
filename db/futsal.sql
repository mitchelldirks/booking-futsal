-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2022 at 07:57 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
--
-- Database: `futsal`
--
-- --------------------------------------------------------
--
-- Table structure for table `lapangan`
--
CREATE TABLE `lapangan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `json` text DEFAULT NULL,
  `aktif` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `lapangan`
--
INSERT INTO `lapangan` (`id`, `nama`, `deskripsi`, `tipe`, `json`, `aktif`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Lapangan 1', 'Rumput Sintetis', 'Sintestis', '{\"15\":\"175000\",\"24\":\"200000\"}', 1, 1, '2022-04-12 23:25:50', 1, '2022-04-19 13:13:51');
-- --------------------------------------------------------
--
-- Table structure for table `lapangan_media`
--
CREATE TABLE `lapangan_media` (
  `id` int(1) NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `path` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Dumping data for table `lapangan_media`
--
INSERT INTO `lapangan_media` (`id`, `id_lapangan`, `path`, `created_by`, `created_at`) VALUES
(2, 1, 'images/pitch/c2d54d1e7970f31fb7cf20dd77b14cdd.jpg', 1, '2022-04-13 05:47:22');
-- --------------------------------------------------------
--
-- Table structure for table `transaksi`
--
CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `nama_customer` varchar(255) NOT NULL,
  `jam_mulai` int(11) NOT NULL,
  `durasi` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Dumping data for table `transaksi`
--
INSERT INTO `transaksi` (`id`, `kode_transaksi`, `id_customer`, `id_lapangan`, `nama_customer`, `jam_mulai`, `durasi`, `harga`, `tanggal`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, '2022042010123165189', 2, 1, 'Jamal Bahri', 23, 1, 200000, '2022-04-20', 1, 2, '2022-04-20 23:47:16', 2, '2022-04-20 23:47:16'),
(2, '2022042110120553045', 2, 1, 'Jamal Bahri', 20, 2, 400000, '2022-04-21', 1, 2, '2022-04-20 23:47:30', 2, '2022-04-20 23:47:30');
-- --------------------------------------------------------
--
-- Table structure for table `transaksi_detail`
--
CREATE TABLE `transaksi_detail` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` int(11) NOT NULL,
  `created_by` int(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Dumping data for table `transaksi_detail`
--
INSERT INTO `transaksi_detail` (`id`, `id_transaksi`, `id_lapangan`, `tanggal`, `jam`, `created_by`, `created_at`) VALUES
(1, 1, 1, '2022-04-20', 23, 2, '2022-04-20 23:47:16'),
(2, 2, 1, '2022-04-21', 20, 2, '2022-04-20 23:47:30'),
(3, 2, 1, '2022-04-21', 21, 2, '2022-04-20 23:47:30');
-- --------------------------------------------------------
--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `level` varchar(50) NOT NULL,
  `aktif` char(1) NOT NULL DEFAULT 'Y',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Dumping data for table `users`
--
INSERT INTO `users` (`id`, `username`, `password`, `nama`, `no_telp`, `email`, `alamat`, `level`, `aktif`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', '1234', 'admin@futsal.com', '', 'admin', 'Y', '2022-04-12 14:43:44', '', '2022-04-21 00:52:12', ''),
(2, 'jamal', '74f56399c89f4bd03ff5e85b6bf4e85f', 'Jamal Bahri', '082991829811', 'jamal@mailinator.com', 'Bojong Gede', 'owner', 'Y', '2022-04-12 22:38:05', '', '2022-04-21 00:52:16', ''),
(9, 'joel', 'c000ccf225950aac2a082a59ac5e57ff', 'Joel Liminata', '081259496362', 'joel@mailinator.com', '', 'customer', 'Y', '2022-04-21 00:37:38', '0', '2022-04-21 00:37:38', '0');
--
-- Indexes for dumped tables
--
--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `lapangan_media`
--
ALTER TABLE `lapangan_media`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lapangan_media`
--
ALTER TABLE `lapangan_media`
MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;