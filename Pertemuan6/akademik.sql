-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2026 at 05:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `prodi` varchar(80) NOT NULL,
  `angkatan` year(4) NOT NULL,
  `ipk` decimal(3,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `email`, `prodi`, `angkatan`, `ipk`) VALUES
(1, '45242100', 'Aman', 'abay@gmail.com', 'Informatika', '2024', 3.00),
(3, '1234567', 'Dogil', 'dogilbogor@gmail.com', 'Teknik Jawa', '2050', 4.00);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_mk` varchar(12) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `sks` tinyint(3) UNSIGNED NOT NULL,
  `dosen_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nidn` (`nidn`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_mk` (`kode_mk`),
  ADD KEY `fk_mk_dosen` (`dosen_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `fk_mk_dosen` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
