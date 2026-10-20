# Menjalankan Program dan Mengambil Screenshot

README.MD adalah laporan. File ini khusus petunjuk menjalankan dan menyiapkan bukti gambar asli.

## Persiapan

1. Buka XAMPP Control Panel, lalu nyalakan **Apache** dan **MySQL**. Jika gagal, baca pesan XAMPP terlebih dahulu; jangan mengganti atau menghapus folder data MySQL.
2. Buka `http://localhost/phpmyadmin`, pilih tab **Import** dari tingkat server, pilih `Pertemuan5/database.sql`, lalu klik **Go/Kirim**. File sudah membuat dan memilih database `perpustakaan_pertemuan5`.
3. Pastikan tidak ada panel error. Database harus memiliki tabel `buku` dengan lima baris awal. Jangan impor `akademik.sql` dari ZIP contoh untuk tugas ini.
4. Buka `http://localhost/Semester_5/Prak_Pbw/Pertemuan5/`.
5. Simpan semua screenshot pada `C:\xampp\htdocs\Semester_5\Prak_Pbw\Pertemuan5\screenshoot`. Gunakan PNG dengan nama persis di bawah. Jangan gunakan gambar materi sebagai bukti hasil program.

Koneksi bawaan: host `127.0.0.1`, port `3306`, user `root`, password kosong. Jika XAMPP menggunakan kredensial atau port lain, sesuaikan nilai bawaan pada `koneksi.php`. Port 3315/8056 pada VALIDASI.txt hanya dipakai selama pengujian sementara dan tidak perlu dipakai untuk menjalankan tugas.

## Urutan Screenshot

Ambil nomor 1–6 sebelum menambah, mengedit, atau menghapus data supaya angka pada laporan sesuai kondisi awal. Gunakan Win+Shift+S, lalu simpan PNG. Pada browser, sertakan alamat halaman dan bagian hasil yang dibahas. Zoom keluar seperlunya agar tabel terlihat lengkap.

| No. | Buka dan lakukan | Bagian yang ditangkap | Nama file |
|---|---|---|---|
| 1 | Buka `sebelum/index.php` di VS Code. | Kode SELECT, perulangan, dan tabel; seluruh file cukup pendek untuk satu gambar. | `1_sebelum_code.png` |
| 2 | Buka `http://localhost/Semester_5/Prak_Pbw/Pertemuan5/sebelum/`. | Judul dan tabel awal berisi lima buku. | `2_output_sebelum.png` |
| 3 | Buka `index.php` utama di VS Code. | Bagian atas mulai pembacaan filter, SQL SELECT dengan LIKE/AND, bind_param, execute, hingga ringkasan. | `3_sesudah_code.png` |
| 4 | Buka katalog utama, klik Reset. | Ringkasan 5 judul, 17 eksemplar, 1 stok habis, filter, dan tabel koleksi. | `4_output_sesudah.png` |
| 5 | Klik Tambah buku; isi data sesuai tabel isian di bawah. Jangan simpan dulu. | Formulir lengkap yang sudah diisi. | `5_form_tambah.png` |
| 6 | Kembali ke katalog; pilih kategori Teknologi dan ketersediaan Tersedia; klik Terapkan. | Dua filter terpilih dan dua hasil buku: Belajar Basis Data serta Dasar Pemrograman PHP. | `6_hasil_filter.png` |
| 7 | Klik Tambah buku; isi kembali data di bawah dengan kode BK001, lalu Simpan buku. | Pesan kode sudah digunakan, beserta isian yang tetap terjaga. | `7_error_kode_duplikat.png` |
| 8 | Pada formulir error, ubah kode saja menjadi BK006; klik Simpan buku. | Pesan Buku berhasil ditambahkan, ringkasan 6 judul/21 eksemplar, dan baris Praktik Web Dinamis. Ambil sebelum refresh agar pesan sukses terlihat. | `8_hasil_perbaikan.png` |

### Isian untuk Nomor 5 dan 7

| Kolom | Isi |
|---|---|
| Kode buku | `BK001` (memang sudah ada, untuk pengujian error) |
| Judul buku | `Praktik Web Dinamis` |
| Penulis | `Raka Pratama` |
| Kategori | `Teknologi` |
| Tahun terbit | `2024` |
| Stok tersedia | `4` |

Pada nomor 8, ganti BK001 menjadi BK006. Jika BK006 sudah ada karena percobaan sebelumnya, hapus hanya data percobaan tersebut terlebih dahulu atau pakai kode baru dan sesuaikan laporan. Jangan menghapus lima buku awal.

## Cek Sebelum Dikumpulkan

- Delapan gambar berasal dari screenshot sendiri dan disimpan dalam `screenshoot`.
- Buka preview README.MD di VS Code: seluruh gambar harus tampil sesuai keterangannya. Sebelum gambar diambil, tautan gambar pada README memang masih menunggu file.
- Bagian screenshot nomor 4 dan 6 menggunakan kondisi awal; nomor 8 menggunakan kondisi setelah satu buku ditambahkan.
- Jika data atau judul diubah saat pengambilan, sesuaikan keterangan laporan dengan hasil sebenarnya.
- CRUD edit/hapus sudah diuji pada database sementara. Untuk mencoba sendiri, gunakan buku percobaan BK006; jangan mengubah data awal sebelum screenshot nomor 1–6 selesai.

`database.sql` tidak menghapus data saat diimpor ulang. Karena itu, impor ulang bukan tombol reset: buku percobaan yang sudah dibuat akan tetap ada. Hapus buku percobaan melalui aplikasi jika ingin kembali ke lima buku awal.
