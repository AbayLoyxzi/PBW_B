-- Latihan Kode Program B, halaman PDF 9. Jalankan sesudah 01.
USE akademik_pertemuan4;

CREATE TABLE krs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(15) NOT NULL,
    kode_mk VARCHAR(12) NOT NULL,
    semester TINYINT UNSIGNED NOT NULL,
    tahun_ajaran VARCHAR(9) NOT NULL,
    nilai_huruf CHAR(2) NULL,
    CONSTRAINT uq_krs UNIQUE (nim, kode_mk, semester, tahun_ajaran),
    CONSTRAINT fk_krs_mahasiswa FOREIGN KEY (nim)
        REFERENCES mahasiswa(nim)
        ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_krs_mk FOREIGN KEY (kode_mk)
        REFERENCES mata_kuliah(kode_mk)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;
