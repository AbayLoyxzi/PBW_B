-- Impor satu kali melalui phpMyAdmin. Tidak menghapus database praktikum lain.
CREATE DATABASE IF NOT EXISTS perpustakaan_pertemuan5 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE perpustakaan_pertemuan5;

CREATE TABLE IF NOT EXISTS buku (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kode VARCHAR(15) NOT NULL UNIQUE,
    judul VARCHAR(150) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    kategori ENUM('Teknologi','Novel','Pendidikan','Sejarah') NOT NULL,
    tahun SMALLINT UNSIGNED NOT NULL CHECK (tahun BETWEEN 1900 AND 2100),
    stok SMALLINT UNSIGNED NOT NULL DEFAULT 0 CHECK (stok BETWEEN 0 AND 999)
) ENGINE=InnoDB;

-- Impor ulang tidak menggandakan atau menimpa data yang sudah diubah.
INSERT INTO buku (kode, judul, penulis, kategori, tahun, stok) VALUES
('BK001','Dasar Pemrograman PHP','Raka Pratama','Teknologi',2024,5),
('BK002','Senja di Perpustakaan','Nadia Putri','Novel',2023,0),
('BK003','Belajar Basis Data','Dimas Saputra','Teknologi',2025,3),
('BK004','Strategi Belajar Efektif','Sinta Lestari','Pendidikan',2022,7),
('BK005','Jejak Kota Nusantara','Arif Wibowo','Sejarah',2021,2)
ON DUPLICATE KEY UPDATE kode = VALUES(kode);
