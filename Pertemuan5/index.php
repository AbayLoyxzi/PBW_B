<?php
require __DIR__ . '/fungsi.php';
require __DIR__ . '/koneksi.php';
$q = mb_substr(teks($_GET, 'q'), 0, 150);
$kategori = teks($_GET, 'kategori');
$status = teks($_GET, 'status');
if (!in_array($kategori, KATEGORI, true)) $kategori = '';
if (!in_array($status, ['tersedia', 'habis'], true)) $status = '';
// Seluruh nilai filter dikirim melalui placeholder, bukan digabung ke SQL.
$sql = "SELECT * FROM buku
        WHERE (judul LIKE ? OR kode LIKE ? OR penulis LIKE ?)
        AND (? = '' OR kategori = ?)
        AND (? = '' OR (? = 'tersedia' AND stok > 0) OR (? = 'habis' AND stok = 0))
        ORDER BY judul ASC, id ASC";
$like = '%' . $q . '%';
$stmt = $koneksi->prepare($sql);
$stmt->bind_param('ssssssss', $like, $like, $like, $kategori, $kategori, $status, $status, $status);
$stmt->execute();
$buku = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$ringkasan = $koneksi->query('SELECT COUNT(*) AS judul, COALESCE(SUM(stok),0) AS stok, COALESCE(SUM(stok = 0),0) AS habis FROM buku')->fetch_assoc();
kepala('Katalog Buku');
?>
<section class="intro"><div><p class="eyebrow">PERPUSTAKAAN DIGITAL</p><h1>Katalog buku</h1><p>Kelola koleksi dan pantau ketersediaan buku perpustakaan.</p></div><a class="button" href="create.php">+ Tambah buku</a></section>
<?php if (isset($_SESSION['pesan'])): ?><p class="notice"><?= e($_SESSION['pesan']) ?></p><?php unset($_SESSION['pesan']); endif; ?>
<section class="stats"><article><span>Total judul</span><strong><?= e($ringkasan['judul']) ?></strong></article><article><span>Eksemplar tersedia</span><strong><?= e($ringkasan['stok']) ?></strong></article><article><span>Judul stok habis</span><strong><?= e($ringkasan['habis']) ?></strong></article></section>
<section class="panel">
<form method="get" class="filters">
<label>Cari buku<input name="q" value="<?= e($q) ?>" placeholder="Judul, kode, atau penulis" maxlength="150"></label>
<label>Kategori<select name="kategori"><option value="">Semua kategori</option><?php foreach (KATEGORI as $item): ?><option <?= $kategori === $item ? 'selected' : '' ?>><?= e($item) ?></option><?php endforeach; ?></select></label>
<label>Ketersediaan<select name="status"><option value="">Semua status</option><option value="tersedia" <?= $status === 'tersedia' ? 'selected' : '' ?>>Tersedia</option><option value="habis" <?= $status === 'habis' ? 'selected' : '' ?>>Habis</option></select></label>
<button type="submit">Terapkan</button><a class="reset" href="index.php">Reset</a>
</form>
<div class="table-heading"><h2>Daftar koleksi</h2><span><?= count($buku) ?> judul ditampilkan</span></div>
<div class="table-wrap"><table><thead><tr><th>Kode</th><th>Judul &amp; penulis</th><th>Kategori</th><th>Tahun</th><th>Stok</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
<?php foreach ($buku as $row): ?>
<tr><td class="code"><?= e($row['kode']) ?></td><td><strong><?= e($row['judul']) ?></strong><small><?= e($row['penulis']) ?></small></td><td><?= e($row['kategori']) ?></td><td><?= e($row['tahun']) ?></td><td><?= e($row['stok']) ?></td><td><span class="badge <?= $row['stok'] > 0 ? 'available' : 'empty' ?>"><?= $row['stok'] > 0 ? 'Tersedia' : 'Habis' ?></span></td><td><div class="actions"><a href="edit.php?id=<?= e($row['id']) ?>">Edit</a><form action="delete.php" method="post" onsubmit="return confirm('Hapus buku ini?')"><input type="hidden" name="id" value="<?= e($row['id']) ?>"><input type="hidden" name="token" value="<?= e(token()) ?>"><button class="danger" type="submit">Hapus</button></form></div></td></tr>
<?php endforeach; ?>
<?php if (!$buku): ?><tr><td colspan="7" class="no-data">Tidak ada buku yang sesuai. Coba ubah pencarian atau filter.</td></tr><?php endif; ?>
</tbody></table></div></section>
<?php kaki(); ?>
