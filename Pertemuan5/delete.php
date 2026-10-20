<?php
require __DIR__ . '/fungsi.php';
wajibPost();
$id = idBuku($_POST);
require __DIR__ . '/koneksi.php';
$stmt = $koneksi->prepare('DELETE FROM buku WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
if ($stmt->affected_rows === 0) {
    http_response_code(404);
    exit('Buku tidak ditemukan.');
}
pesanDanKembali('Buku berhasil dihapus.');
