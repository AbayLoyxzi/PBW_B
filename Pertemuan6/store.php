<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Gunakan formulir untuk mengirim data.');
}

$fields = ['nim', 'nama', 'email', 'prodi', 'angkatan', 'ipk'];
foreach ($fields as $field) {
    if (!isset($_POST[$field]) || !is_string($_POST[$field]) || trim($_POST[$field]) === '') {
        http_response_code(400);
        exit('Semua kolom wajib diisi.');
    }
}

$nim = trim($_POST['nim']);
$nama = trim($_POST['nama']);
$email = trim($_POST['email']);
$prodi = trim($_POST['prodi']);
$angkatan = filter_var($_POST['angkatan'], FILTER_VALIDATE_INT);
$ipk = filter_var($_POST['ipk'], FILTER_VALIDATE_FLOAT);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)
    || $angkatan === false || $angkatan < 1900 || $angkatan > 9999
    || $ipk === false || $ipk < 0 || $ipk > 4) {
    http_response_code(400);
    exit('Email, angkatan, atau IPK tidak valid. IPK harus antara 0 dan 4.');
}

require __DIR__ . '/koneksi.php';

$stmt = mysqli_prepare($koneksi, 'INSERT INTO mahasiswa (nim, nama, email, prodi, angkatan, ipk) VALUES (?, ?, ?, ?, ?, ?)');
$query = false;
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ssssid', $nim, $nama, $email, $prodi, $angkatan, $ipk);
    $query = mysqli_stmt_execute($stmt);
}

if ($query) {
    echo "<script>
        alert('Data mahasiswa berhasil disimpan');
        window.location.href = 'index.php';
    </script>";
} else {
    http_response_code(400);
    echo "<script>
        alert('Data gagal disimpan. Periksa data yang dimasukkan.');
        window.history.back();
    </script>";
}
