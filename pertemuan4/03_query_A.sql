-- Latihan Kode Program A, halaman PDF 20. Jalankan sesudah 01 dan 02.
USE akademik_pertemuan4;

INSERT INTO mahasiswa (nim, nama, email, prodi, angkatan, ipk) VALUES
('2026001','Andi Pratama','andi@kampus.ac.id','Teknik Informatika',2026,3.75),
('2026002','Siti Rahma','siti@kampus.ac.id','Sistem Informasi',2026,3.82),
('2025003','Budi Santoso','budi@kampus.ac.id','Teknik Informatika',2025,3.20);

-- Pemeriksaan tambahan untuk screenshot data awal: 3 mahasiswa.
SELECT * FROM mahasiswa ORDER BY nim;

-- Query latihan persis seperti PPT: hasil Siti, lalu Andi.
SELECT nim, nama, prodi, ipk
FROM mahasiswa
WHERE ipk >= 3.50
ORDER BY ipk DESC, nama ASC
LIMIT 10;
