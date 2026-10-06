-- Praktikum PBW - Pertemuan 3
-- Basis data akademik dari Pertemuan3.sql dengan perubahan schema dan query.
-- Target DB dibuat terpisah agar tidak menimpa database lain.

CREATE DATABASE IF NOT EXISTS `akademik_pertemuan3`
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `akademik_pertemuan3`;

SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET time_zone = '+00:00';

-- Tabel dosen
CREATE TABLE IF NOT EXISTS `dosen` (
  `nidn` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`nidn`),
  UNIQUE KEY `uq_dosen_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel mahasiswa
-- Modifikasi 1: IPK wajib terisi dan punya nilai awal 0.00.
-- Modifikasi 2: status_aktif membatasi status mahasiswa ke tiga pilihan.
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `nim` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `prodi` varchar(80) NOT NULL,
  `angkatan` year(4) NOT NULL DEFAULT 0000,
  `ipk` decimal(3,2) NOT NULL DEFAULT 0.00,
  `status_aktif` enum('aktif','cuti','lulus') NOT NULL DEFAULT 'aktif',
  PRIMARY KEY (`nim`),
  UNIQUE KEY `uq_mahasiswa_email` (`email`),
  CONSTRAINT `chk_mahasiswa_ipk` CHECK (`ipk` BETWEEN 0.00 AND 4.00)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel mata kuliah
CREATE TABLE IF NOT EXISTS `mata_kuliah` (
  `kode_mk` varchar(12) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `sks` tinyint(3) unsigned NOT NULL,
  `nidn` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kode_mk`),
  KEY `idx_mk_dosen` (`nidn`),
  CONSTRAINT `fk_mk_dosen` FOREIGN KEY (`nidn`) REFERENCES `dosen` (`nidn`)
    ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel KRS
-- Modifikasi 3: semester dibatasi ke rentang 1 sampai 8.
CREATE TABLE IF NOT EXISTS `krs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nim` varchar(15) NOT NULL,
  `kode_mk` varchar(12) NOT NULL,
  `semester` tinyint(3) unsigned NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL,
  `nilai_huruf` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_krs` (`nim`,`kode_mk`,`semester`,`tahun_ajaran`),
  KEY `idx_krs_mk` (`kode_mk`),
  CONSTRAINT `chk_krs_semester` CHECK (`semester` BETWEEN 1 AND 8),
  CONSTRAINT `fk_krs_mahasiswa` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_krs_mk` FOREIGN KEY (`kode_mk`) REFERENCES `mata_kuliah` (`kode_mk`)
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data mahasiswa dari dump awal. Status aktif mengikuti nilai DEFAULT.
INSERT IGNORE INTO `mahasiswa` (`nim`,`nama`,`email`,`prodi`,`angkatan`,`ipk`) VALUES
  ('2026001','Andi Pratama','andi@kampus.ac.id','Teknik Informatika',2026,3.75),
  ('2026002','Siti Rahma','siti@kampus.ac.id','Sistem Informasi',2026,3.82);

-- Data contoh untuk menunjukkan relasi dosen, mata kuliah, dan KRS.
INSERT IGNORE INTO `dosen` (`nidn`,`nama`,`email`) VALUES
  ('0012345678','Budi Santoso','budi@kampus.ac.id'),
  ('0098765432','Rina Putri','rina@kampus.ac.id');

INSERT IGNORE INTO `mata_kuliah` (`kode_mk`,`nama_mk`,`sks`,`nidn`) VALUES
  ('PBW301','Pemrograman Berbasis Web',3,'0012345678'),
  ('BD301','Basis Data',3,'0098765432');

INSERT IGNORE INTO `krs` (`nim`,`kode_mk`,`semester`,`tahun_ajaran`,`nilai_huruf`) VALUES
  ('2026001','PBW301',1,'2026/2027','A'),
  ('2026002','BD301',1,'2026/2027','AB');

-- Query modifikasi: menampilkan mahasiswa aktif dan mengurutkannya berdasarkan IPK.
SELECT `nim`, `nama`, `prodi`, `ipk`, `status_aktif`
FROM `mahasiswa`
WHERE `status_aktif` = 'aktif'
ORDER BY `ipk` DESC;

-- Query relasi: menampilkan KRS beserta nama mahasiswa, mata kuliah, dan dosen.
SELECT `m`.`nama` AS `mahasiswa`, `mk`.`nama_mk` AS `mata_kuliah`,
       `d`.`nama` AS `dosen`, `k`.`semester`, `k`.`tahun_ajaran`, `k`.`nilai_huruf`
FROM `krs` AS `k`
JOIN `mahasiswa` AS `m` ON `m`.`nim` = `k`.`nim`
JOIN `mata_kuliah` AS `mk` ON `mk`.`kode_mk` = `k`.`kode_mk`
LEFT JOIN `dosen` AS `d` ON `d`.`nidn` = `mk`.`nidn`
ORDER BY `m`.`nama`, `mk`.`nama_mk`;
