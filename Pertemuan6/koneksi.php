<?php
$host = '127.0.0.1';
$user = 'root';
$password = '';
$dbname = 'akademik_pertemuan6';

// Gunakan hasil false agar penanganan kegagalan query tetap seperti materi.
mysqli_report(MYSQLI_REPORT_OFF);
$koneksi = mysqli_connect($host, $user, $password, $dbname);

if (!$koneksi) {
    http_response_code(500);
    exit('Koneksi gagal. Periksa MySQL dan database akademik.');
}

mysqli_set_charset($koneksi, 'utf8mb4');
