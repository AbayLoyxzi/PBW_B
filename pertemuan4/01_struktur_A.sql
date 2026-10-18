-- Latihan Kode Program A, halaman PDF 8.
-- Nama database dipisahkan dari tugas sebelumnya; struktur mengikuti PPT.
CREATE DATABASE IF NOT EXISTS akademik_pertemuan4
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE akademik_pertemuan4;

CREATE TABLE mahasiswa (
    nim VARCHAR(15) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    prodi VARCHAR(80) NOT NULL,
    angkatan YEAR NOT NULL,
    ipk DECIMAL(3,2) DEFAULT 0.00,
    CHECK (ipk BETWEEN 0.00 AND 4.00)
) ENGINE=InnoDB;

CREATE TABLE dosen (
    nidn VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(120) UNIQUE
) ENGINE=InnoDB;

CREATE TABLE mata_kuliah (
    kode_mk VARCHAR(12) PRIMARY KEY,
    nama_mk VARCHAR(100) NOT NULL,
    sks TINYINT UNSIGNED NOT NULL,
    nidn VARCHAR(20),
    CONSTRAINT fk_mk_dosen FOREIGN KEY (nidn)
        REFERENCES dosen(nidn)
        ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;
