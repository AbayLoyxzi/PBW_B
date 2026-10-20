<?php
require __DIR__ . '/fungsi.php';
wajibPost();
$id = idBuku($_POST);
require __DIR__ . '/koneksi.php';
cariBuku($koneksi, $id);
[$data, $errors] = validasiBuku($_POST);
if (!$errors) {
    try {
        $stmt = $koneksi->prepare('UPDATE buku SET kode = ?, judul = ?, penulis = ?, kategori = ?, tahun = ?, stok = ? WHERE id = ?');
        $stmt->bind_param('ssssiii', $data['kode'], $data['judul'], $data['penulis'], $data['kategori'], $data['tahun'], $data['stok'], $id);
        $stmt->execute();
        pesanDanKembali('Data buku berhasil diperbarui.');
    } catch (mysqli_sql_exception $error) {
        error_log($error->getMessage());
        if ($error->getCode() === 1062) $errors[] = 'Kode buku sudah digunakan. Gunakan kode lain.';
        else { http_response_code(500); $errors[] = 'Perubahan gagal. Periksa koneksi dan struktur database.'; }
    }
}
if (http_response_code() !== 500) http_response_code(422);
$edit = true;
require __DIR__ . '/form_buku.php';
