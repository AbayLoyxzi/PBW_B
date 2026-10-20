# Panduan Screenshot Tugas 6

Seluruh 10 screenshot sudah tersedia di `screenshoot/` dan digunakan dalam `README.MD`. Daftar ini mengikuti isi capture pengguna. Screenshot nomor 2 dan 3 telah diganti namanya agar sesuai dengan isi gambar.

## Urutan Bukti Praktikum

| No. | Nama file | Isi screenshot |
|---|---|---|
| 1 | `1_struktur_mahasiswa.png` | Struktur tabel `mahasiswa` pada database `akademik_pertemuan6`: tujuh kolom, primary key, dan AUTO_INCREMENT. |
| 2 | `2_form_tambah_awal.png` | Form tambah Rija Rafid, NIM `452412121`, Teknik Informatika, angkatan 2024, IPK 3.95 sebelum disimpan. |
| 3 | `3_notifikasi_simpan.png` | Alert “Data mahasiswa berhasil disimpan”. |
| 4 | `4_tabel_awal.png` | Tabel menampilkan Rija Rafid dengan IPK 3.95 sebelum penambahan Ari Riski. |
| 5 | `5_form_tambah.png` | Form tambah Ari Riski, NIM `45249999`, Teknik Mesin, angkatan 2025, IPK 3.83 sebelum disimpan. |
| 6 | `6_hasil_tambah.png` | Tabel menampilkan Rija Rafid dan Ari Riski setelah penambahan. |
| 7 | `7_form_edit.png` | Form edit Rija Rafid dengan IPK diubah menjadi 3.79 sebelum disimpan. |
| 8 | `8_hasil_edit.png` | Tabel menunjukkan IPK Rija Rafid menjadi 3.79; Ari Riski tetap 3.83. |
| 9 | `9_konfirmasi_hapus.png` | Dialog konfirmasi penghapusan pada baris Ari Riski, dengan kedua mahasiswa masih terlihat. |
| 10 | `10_hasil_hapus.png` | Ari Riski sudah tidak ada; Rija Rafid tetap tersedia dengan IPK 3.79. |

## Jika Perlu Mengambil Ulang

- Buka [halaman CRUD](http://localhost/Semester_5/Prak_Pbw/Pertemuan6/index.php) dengan Apache dan MySQL aktif. Tampilan Tailwind CSS memerlukan akses CDN.
- Gunakan database `akademik_pertemuan6` sesuai `koneksi.php`. Jangan mengimpor ulang dump ke tabel yang sudah berisi hasil praktikum. Dump `akademik.sql` memuat data awal yang berbeda dari data pada screenshot dan tidak memuat perintah CREATE DATABASE atau USE.
- Foto form diambil sebelum Simpan, foto hasil diambil setelah tabel diperbarui, dan foto dialog hapus diambil sebelum memilih OK.
- Gunakan capture browser asli dengan teks terbaca. Jika memungkinkan, sertakan alamat halaman.
- Screenshot yang tersedia mendokumentasikan alur CRUD. Tidak ada capture khusus alur `form.php` → `simpan.php` → `data.php`.
