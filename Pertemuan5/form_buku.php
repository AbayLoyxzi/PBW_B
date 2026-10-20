<?php kepala($edit ? 'Edit Buku' : 'Tambah Buku'); ?>
<section class="intro"><div><p class="eyebrow">DATA KOLEKSI</p><h1><?= $edit ? 'Edit buku' : 'Tambah buku' ?></h1><p>Lengkapi informasi buku. Semua kolom wajib diisi.</p></div><a class="reset" href="index.php">← Kembali ke katalog</a></section>
<section class="panel form-panel">
<?php if ($errors): ?><div class="error" role="alert"><strong>Data belum dapat disimpan</strong><ul><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
<form action="<?= $edit ? 'update.php' : 'store.php' ?>" method="post" class="book-form">
<input type="hidden" name="token" value="<?= e(token()) ?>">
<?php if ($edit): ?><input type="hidden" name="id" value="<?= e($id) ?>"><?php endif; ?>
<label>Kode buku<input name="kode" value="<?= e($data['kode']) ?>" required minlength="3" maxlength="15" pattern="[A-Za-z0-9-]{3,15}" placeholder="Contoh: BK006"></label>
<label>Judul buku<input name="judul" value="<?= e($data['judul']) ?>" required maxlength="150" placeholder="Masukkan judul buku"></label>
<label>Penulis<input name="penulis" value="<?= e($data['penulis']) ?>" required maxlength="100" placeholder="Nama penulis"></label>
<label>Kategori<select name="kategori" required><option value="">Pilih kategori</option><?php foreach (KATEGORI as $item): ?><option <?= $data['kategori'] === $item ? 'selected' : '' ?>><?= e($item) ?></option><?php endforeach; ?></select></label>
<div class="form-row"><label>Tahun terbit<input type="number" name="tahun" min="1900" max="<?= date('Y') ?>" value="<?= e($data['tahun']) ?>" required></label><label>Stok tersedia<input type="number" name="stok" min="0" max="999" step="1" value="<?= e($data['stok']) ?>" required></label></div>
<p class="hint">Stok 0 otomatis ditampilkan dengan status Habis.</p>
<div class="actions"><button type="submit">Simpan buku</button><a class="reset" href="index.php">Batal</a></div>
</form></section>
<?php kaki(); ?>
