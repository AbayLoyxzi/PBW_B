<?php
require __DIR__ . '/koneksi.php';

// Parameter nim mengikuti tautan Hapus dan konfirmasi pada index.php di materi.
$nim = $_GET['nim'] ?? '';
if (!is_string($nim) || trim($nim) === '') {
    http_response_code(400);
    exit('NIM wajib diisi.');
}

$stmt = mysqli_prepare($koneksi, 'DELETE FROM mahasiswa WHERE nim = ?');
$query = false;
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 's', $nim);
    $query = mysqli_stmt_execute($stmt);
}

if ($query && mysqli_stmt_affected_rows($stmt) > 0) {
    echo "<script>
        alert('Data mahasiswa berhasil dihapus');
        window.location.href = 'index.php';
    </script>";
} else {
    http_response_code($query ? 404 : 500);
    echo "<script>
        alert('Data gagal dihapus atau tidak ditemukan');
        window.location.href = 'index.php';
    </script>";
}
