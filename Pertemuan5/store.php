<?php
require __DIR__ . '/fungsi.php';
wajibPost();
[$data, $errors] = validasiBuku($_POST);
if (!$errors) {
    require __DIR__ . '/koneksi.php';
    try {
        $stmt = $koneksi->prepare('INSERT INTO buku (kode, judul, penulis, kategori, tahun, stok) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssii', $data['kode'], $data['judul'], $data['penulis'], $data['kategori'], $data['tahun'], $data['stok']);
        $stmt->execute();
        pesanDanKembali('Buku berhasil ditambahkan.');
    } catch (mysqli_sql_exception $error) {
        error_log($error->getMessage());
        if ($error->getCode() === 1062) $errors[] = 'Kode buku sudah digunakan. Gunakan kode lain.';
        else { http_response_code(500); $errors[] = 'Penyimpanan gagal. Periksa koneksi dan struktur database.'; }
    }
}
if (http_response_code() !== 500) http_response_code(422);
$edit = false;
require __DIR__ . '/form_buku.php';
