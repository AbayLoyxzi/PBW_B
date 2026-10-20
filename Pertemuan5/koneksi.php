<?php
// Nilai bawaan untuk XAMPP; environment dipakai saat pengujian terisolasi.
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $koneksi = new mysqli(
        getenv('PBW_DB_HOST') ?: '127.0.0.1',
        getenv('PBW_DB_USER') ?: 'root',
        getenv('PBW_DB_PASSWORD') ?: '',
        getenv('PBW_DB_NAME') ?: 'perpustakaan_pertemuan5',
        (int) (getenv('PBW_DB_PORT') ?: 3306)
    );
    $koneksi->set_charset('utf8mb4');
} catch (mysqli_sql_exception $error) {
    error_log($error->getMessage());
    http_response_code(503);
    exit('Koneksi database belum tersedia. Nyalakan MySQL dan impor database.sql terlebih dahulu.');
}
