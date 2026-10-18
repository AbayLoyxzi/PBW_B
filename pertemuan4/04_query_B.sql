-- Latihan Kode Program B, halaman PDF 21. Jalankan sesudah 03.
USE akademik_pertemuan4;

-- B1. Mengubah data.
UPDATE mahasiswa
SET ipk = 3.40
WHERE nim = '2025003';

-- Pemeriksaan tambahan untuk screenshot hasil UPDATE.
SELECT nim, nama, prodi, ipk
FROM mahasiswa WHERE nim = '2025003';

-- B2. Rekap sebelum penghapusan: TI = 2 / 3.58; SI = 1 / 3.82.
SELECT prodi, COUNT(*) AS jumlah, ROUND(AVG(ipk),2) AS rata_ipk
FROM mahasiswa
GROUP BY prodi
ORDER BY jumlah DESC;

-- B3. Verifikasi sebelum penghapusan, sesuai PPT.
SELECT * FROM mahasiswa WHERE nim = '2025003';

-- B4. Menghapus hanya mahasiswa yang sudah diverifikasi.
DELETE FROM mahasiswa WHERE nim = '2025003';

-- Pemeriksaan tambahan untuk screenshot akhir: tersisa Andi dan Siti.
SELECT * FROM mahasiswa ORDER BY nim;
SELECT * FROM mahasiswa WHERE nim = '2025003';
