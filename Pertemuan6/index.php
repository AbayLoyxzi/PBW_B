<?php
require __DIR__ . '/koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
if (!$query) {
    http_response_code(500);
    exit('Data mahasiswa gagal dimuat.');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Data Mahasiswa</title>
</head>
<body class="bg-gray-50 p-6 font-sans text-gray-800">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">

        <h2 class="text-2xl font-bold mb-4 text-gray-800">
            Data Mahasiswa
        </h2>

        <a href="create.php"
           class="inline-block bg-blue-600 text-white font-semibold px-4 py-2 rounded mb-4">
            + Tambah Mahasiswa
        </a>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-200 p-3 font-semibold">NIM</th>
                        <th class="border border-gray-200 p-3 font-semibold">Nama</th>
                        <th class="border border-gray-200 p-3 font-semibold">Email</th>
                        <th class="border border-gray-200 p-3 font-semibold">Prodi</th>
                        <th class="border border-gray-200 p-3 font-semibold">
                            Angkatan
                        </th>
                        <th class="border border-gray-200 p-3 font-semibold">IPK</th>
                        <th class="border border-gray-200 p-3 font-semibold text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (mysqli_num_rows($query) === 0) { ?>
                    <tr>
                        <td colspan="7" class="border border-gray-200 p-3 text-center">Belum ada data mahasiswa.</td>
                    </tr>
                    <?php } ?>
                    <?php while ($data = mysqli_fetch_assoc($query)) { ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="border border-gray-200 p-3"><?= htmlspecialchars($data['nim'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="border border-gray-200 p-3"><?= htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="border border-gray-200 p-3"><?= htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="border border-gray-200 p-3"><?= htmlspecialchars($data['prodi'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="border border-gray-200 p-3"><?= htmlspecialchars($data['angkatan'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="border border-gray-200 p-3"><?= htmlspecialchars($data['ipk'], ENT_QUOTES, 'UTF-8'); ?></td>

                        <td class="border border-gray-200 p-3 text-center">
                            <a href="edit.php?nim=<?= rawurlencode($data['nim']); ?>"
                               class="text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                Edit
                            </a>

                            <span class="mx-1 text-gray-300">|</span>

                            <a href="delete.php?nim=<?= rawurlencode($data['nim']); ?>"
                               onclick="return confirm('Yakin ingin menghapus data ini?')"
                               class="text-red-600 hover:text-red-800 hover:underline font-medium">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>