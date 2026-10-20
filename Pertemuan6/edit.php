<?php
require __DIR__ . '/koneksi.php';

$nim = $_GET['nim'] ?? '';
if (!is_string($nim) || trim($nim) === '') {
    http_response_code(400);
    exit('NIM wajib diisi.');
}

$stmt = mysqli_prepare($koneksi, 'SELECT * FROM mahasiswa WHERE nim = ?');
if (!$stmt) {
    http_response_code(500);
    exit('Data gagal dimuat.');
}
mysqli_stmt_bind_param($stmt, 's', $nim);
if (!mysqli_stmt_execute($stmt)) {
    http_response_code(500);
    exit('Data gagal dimuat.');
}
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$data) {
    http_response_code(404);
    exit('Data tidak ditemukan.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Ubah Data <?= htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') ?></title>
</head>
<body class="bg-gray-50 p-6 font-sans text-gray-800">
    <form action="update.php" method="POST"
        class="max-w-sm mx-auto bg-white p-6 rounded-lg shadow-md flex flex-col">
        <h2 class="text-2xl font-bold mb-4">Ubah Data <?= htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') ?></h2>

        <label for="nim" class="text-sm font-semibold mb-1">NIM:</label>
        <input type="text" id="nim" name="nim" value="<?= htmlspecialchars($data['nim'], ENT_QUOTES, 'UTF-8') ?>" readonly required
            class="mb-4 p-2 border border-gray-300 rounded">

        <label for="nama" class="text-sm font-semibold mb-1">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') ?>" required
            class="mb-4 p-2 border border-gray-300 rounded">

        <label for="email" class="text-sm font-semibold mb-1">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8') ?>" required
            class="mb-4 p-2 border border-gray-300 rounded">

        <label for="prodi" class="text-sm font-semibold mb-1">Prodi:</label>
        <input type="text" id="prodi" name="prodi" value="<?= htmlspecialchars($data['prodi'], ENT_QUOTES, 'UTF-8') ?>" required
            class="mb-4 p-2 border border-gray-300 rounded">

        <label for="angkatan" class="text-sm font-semibold mb-1">Angkatan:</label>
        <input type="number" id="angkatan" name="angkatan" min="1900" max="9999" value="<?= htmlspecialchars($data['angkatan'], ENT_QUOTES, 'UTF-8') ?>" required
            class="mb-4 p-2 border border-gray-300 rounded">

        <label for="ipk" class="text-sm font-semibold mb-1">IPK:</label>
        <input type="number" id="ipk" name="ipk" step="0.01" min="0" max="4" value="<?= htmlspecialchars($data['ipk'], ENT_QUOTES, 'UTF-8') ?>" required
            class="mb-4 p-2 border border-gray-300 rounded">

        <button type="submit" class="bg-blue-600 text-white font-bold py-2 rounded">Simpan</button>
        <a href="index.php" class="mt-4 text-center text-blue-600 hover:underline">Kembali</a>
    </form>
</body>
</html>
