<?php
session_start();
const KATEGORI = ['Teknologi', 'Novel', 'Pendidikan', 'Sejarah'];

function e($nilai): string {
    return htmlspecialchars((string) $nilai, ENT_QUOTES, 'UTF-8');
}

function teks(array $sumber, string $kunci): string {
    return isset($sumber[$kunci]) && is_string($sumber[$kunci]) ? trim($sumber[$kunci]) : '';
}

function token(): string {
    return $_SESSION['token'] ??= bin2hex(random_bytes(32));
}

function wajibPost(): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Allow: POST');
        http_response_code(405);
        exit('Gunakan formulir untuk mengirim data.');
    }
    if (!hash_equals(token(), teks($_POST, 'token'))) {
        http_response_code(403);
        exit('Sesi formulir tidak valid. Muat ulang halaman lalu coba lagi.');
    }
}

function idBuku(array $sumber): int {
    $id = filter_var(teks($sumber, 'id'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if ($id === false) {
        http_response_code(400);
        exit('ID buku tidak valid.');
    }
    return $id;
}

function cariBuku(mysqli $koneksi, int $id): array {
    $stmt = $koneksi->prepare('SELECT * FROM buku WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
    if (!$data) {
        http_response_code(404);
        exit('Buku tidak ditemukan.');
    }
    return $data;
}

function validasiBuku(array $input): array {
    $data = [];
    foreach (['kode','judul','penulis','kategori','tahun','stok'] as $kolom) {
        $data[$kolom] = teks($input, $kolom);
    }
    $data['kode'] = strtoupper($data['kode']);
    $errors = [];
    if (!preg_match('/^[A-Z0-9-]{3,15}$/', $data['kode'])) $errors[] = 'Kode harus 3–15 huruf, angka, atau tanda hubung.';
    if (mb_strlen($data['judul']) < 1 || mb_strlen($data['judul']) > 150) $errors[] = 'Judul wajib diisi, maksimal 150 karakter.';
    if (mb_strlen($data['penulis']) < 1 || mb_strlen($data['penulis']) > 100) $errors[] = 'Penulis wajib diisi, maksimal 100 karakter.';
    if (!in_array($data['kategori'], KATEGORI, true)) $errors[] = 'Kategori tidak valid.';
    if (filter_var($data['tahun'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1900, 'max_range' => (int) date('Y')]]) === false) $errors[] = 'Tahun harus 1900 sampai tahun berjalan.';
    if (filter_var($data['stok'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 999]]) === false) $errors[] = 'Stok harus bilangan bulat 0–999.';
    return [$data, $errors];
}

function pesanDanKembali(string $pesan): void {
    $_SESSION['pesan'] = $pesan;
    header('Location: index.php', true, 303);
    exit;
}

function kepala(string $judul): void {
    echo '<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>'.e($judul).' | Pustaka Kampus</title><link rel="stylesheet" href="style.css"></head><body><header><a href="index.php" class="brand">Pustaka<span>Kampus</span></a><span>Praktikum PBW · Pertemuan 5</span></header><main>';
}

function kaki(): void {
    echo '</main><footer>Katalog buku perpustakaan · PHP &amp; MySQLi</footer></body></html>';
}
