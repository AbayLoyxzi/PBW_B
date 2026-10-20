<?php
require __DIR__ . '/koneksi.php';

$query = mysqli_query($koneksi, 'SELECT * FROM mahasiswa');
if (!$query) {
    http_response_code(500);
    exit('Data mahasiswa gagal dimuat.');
}

header('Content-Type: text/html; charset=UTF-8');
while ($data = mysqli_fetch_assoc($query)) {
    echo htmlspecialchars($data['nim'], ENT_QUOTES, 'UTF-8');
    echo ' - ';
    echo htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8');
    echo '<br>';
}
