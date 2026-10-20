<?php
// Versi dasar studi kasus buku: adaptasi alur data.php pada materi.
require dirname(__DIR__) . '/koneksi.php';
$query = $koneksi->query('SELECT kode, judul, penulis FROM buku ORDER BY id');
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Data Buku - Versi Awal</title></head><body>
<h1>Data Buku Perpustakaan</h1>
<p>Versi awal: menampilkan kode, judul, dan penulis buku.</p>
<table border="1" cellpadding="8" cellspacing="0"><thead><tr><th>Kode</th><th>Judul</th><th>Penulis</th></tr></thead><tbody>
<?php while ($data = $query->fetch_assoc()): ?>
<tr><td><?= htmlspecialchars($data['kode'], ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars($data['judul'], ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars($data['penulis'], ENT_QUOTES, 'UTF-8') ?></td></tr>
<?php endwhile; ?>
</tbody></table></body></html>
