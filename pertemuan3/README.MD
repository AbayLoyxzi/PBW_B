# Praktikum PBW - Pertemuan 3

## Isi folder

- `Pertemuan3_awal.sql` adalah salinan dump SQL yang diberikan sebelum dimodifikasi.
- `Pertemuan3_modifikasi.sql` adalah file utama untuk diimpor dan dijalankan.
- `screenshoot/` adalah tempat menyimpan screenshot asli yang kamu ambil sendiri.

## Ringkasan database

Database akademik ini memiliki empat tabel yang saling terhubung:

- `mahasiswa` menyimpan NIM, nama, email, program studi, angkatan, dan IPK.
- `dosen` menyimpan NIDN, nama, dan email dosen.
- `mata_kuliah` menyimpan kode, nama, jumlah SKS, dan dosen pengampu.
- `krs` menghubungkan mahasiswa dengan mata kuliah pada semester dan tahun ajaran tertentu.

Primary key memberi identitas unik untuk setiap baris. Foreign key menjaga agar KRS hanya merujuk mahasiswa dan mata kuliah yang tersedia. KRS juga memiliki unique key gabungan `nim`, `kode_mk`, `semester`, dan `tahun_ajaran`, sehingga mahasiswa tidak bisa mengambil mata kuliah yang sama dua kali pada periode yang sama.

## Modifikasi SQL

1. **Status mahasiswa:** kolom `status_aktif` bertipe `ENUM` menerima `aktif`, `cuti`, atau `lulus`. Nilai awalnya `aktif`.
2. **Validasi IPK:** `ipk` sekarang wajib diisi, nilai awalnya `0.00`, dan dibatasi antara `0.00` sampai `4.00`.
3. **Validasi semester:** constraint `chk_krs_semester` membatasi semester KRS dari 1 sampai 8.
4. **Query hasil:** query pertama memfilter mahasiswa aktif dan mengurutkannya berdasarkan IPK. Query kedua menggabungkan data KRS, mahasiswa, mata kuliah, dan dosen.

Dump awal sudah memiliki kolom `ipk` dan unique key gabungan KRS. Karena itu, keduanya dipertahankan dan tidak dihitung sebagai modifikasi baru. File hasil memakai database baru bernama `akademik_pertemuan3`, bukan nama database pribadi dari dump sumber.

## Cara menjalankan

1. Buka **XAMPP Control Panel**, lalu jalankan **Apache** dan **MySQL**.
2. Buka browser ke `http://localhost/phpmyadmin`.
3. Pilih tab **Import**, pilih `Pertemuan3_modifikasi.sql` dari folder ini, lalu tekan **Go/Kirim**. File SQL membuat database `akademik_pertemuan3` secara otomatis.
4. Buka database `akademik_pertemuan3`. Pastikan empat tabel (`dosen`, `mahasiswa`, `mata_kuliah`, `krs`) terlihat.
5. Buka tab **SQL** untuk menjalankan ulang query contoh di bagian akhir file. Query pertama menampilkan mahasiswa aktif; query kedua menampilkan hasil gabungan KRS dan tabel terkait.

## Error dan perbaikannya

Contoh error yang bisa direproduksi adalah **foreign key constraint fails / MariaDB error 1452**. Error ini terjadi jika baris KRS memakai NIM yang belum ada pada `mahasiswa` atau kode mata kuliah yang belum ada pada `mata_kuliah`.

Untuk memunculkan error dengan aman, buka tab **SQL** dan jalankan:

```sql
INSERT INTO `krs` (`nim`,`kode_mk`,`semester`,`tahun_ajaran`,`nilai_huruf`)
VALUES ('9999999','PBW301',1,'2026/2027','A');
```

Query tersebut ditolak karena NIM `9999999` belum terdaftar. Perbaikannya adalah memakai NIM dan kode mata kuliah yang sudah terdaftar, atau memasukkan data induk yang benar terlebih dahulu. Baris yang gagal tidak tersimpan. Coba cek data induk dengan:

```sql
SELECT `nim`, `nama` FROM `mahasiswa` WHERE `nim` = '2026001';
SELECT `kode_mk`, `nama_mk` FROM `mata_kuliah` WHERE `kode_mk` = 'PBW301';
```

Catatan: bagian ini adalah simulasi penyebab error yang umum pada foreign key. Jika saat impor kamu melihat pesan error yang berbeda, catat pesan aslinya dan kirim ke aku agar README bisa disesuaikan dengan kejadian nyata.

## Screenshot yang perlu kamu ambil

Screenshot cukup **dua buah**, dan keduanya diambil dari tampilan tabel phpMyAdmin. Jangan screenshot kode atau pesan error. Simpan file PNG ke folder `screenshoot/` ini.

| Nama file | Tampilan yang harus terlihat |
| --- | --- |
| `1_tabel_sebelum.png` | phpMyAdmin > database `akademik_sebelum` > tabel `mahasiswa` > tab **Structure/Struktur**. Pastikan kolom awal terlihat dan belum ada `status_aktif`. |
| `2_tabel_sesudah.png` | phpMyAdmin > database `akademik_pertemuan3` > tabel `mahasiswa` > tab **Structure/Struktur**. Pastikan kolom `status_aktif` dan definisi IPK yang sudah dimodifikasi terlihat. |

### Cara menyiapkan tampilan sebelum dan sesudah

1. Di phpMyAdmin, buat database kosong bernama `akademik_sebelum`.
2. Klik database `akademik_sebelum`, buka tab **Import**, pilih `Pertemuan3_awal.sql`, lalu tekan **Go/Kirim**. File awal tidak membuat database sendiri, jadi pilih database itu sebelum mengimpor.
3. Buka tabel `mahasiswa` lalu tab **Structure/Struktur**. Ambil screenshot pertama sebagai `1_tabel_sebelum.png`.
4. Impor `Pertemuan3_modifikasi.sql`. File ini membuat database terpisah `akademik_pertemuan3`.
5. Buka database `akademik_pertemuan3`, pilih tabel `mahasiswa`, lalu tab **Structure/Struktur**. Ambil screenshot kedua sebagai `2_tabel_sesudah.png`.

Ambil keduanya dengan **Win + Shift + S** dan simpan ke folder `screenshoot/`. Jangan mengimpor dump awal ke database yang sudah berisi data penting; gunakan database kosong `akademik_sebelum` khusus untuk perbandingan.

## Materi yang dipakai

Materi Pertemuan 3 membahas tabel, tipe data, primary key, foreign key, constraint, serta query SQL seperti `SELECT`, `WHERE`, dan `ORDER BY`. File ini menerapkannya pada skema akademik dan menampilkan hasil query melalui phpMyAdmin.
