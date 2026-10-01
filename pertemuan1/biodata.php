<?php
function statusKelulusan(float $ipk): string
{
    if ($ipk >= 3.50) {
        return 'Sangat Memuaskan';
    }
    if ($ipk >= 3.00) {
        return 'Memuaskan';
    }

    return 'Perlu Peningkatan';
}

$mahasiswa = [
    'nim' => '2026001',
    'nama' => 'Andi Pratama',
    'prodi' => 'Teknik Informatika',
    'semester' => 1,
    'ipk' => 3.72,
];

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Biodata</title>
</head>
<body>
    <h1>Biodata Mahasiswa</h1>
    <ul>
        <?php foreach ($mahasiswa as $kunci => $nilai): ?>
            <li><?= e(ucfirst($kunci)) ?>: <?= e((string) $nilai) ?></li>
        <?php endforeach; ?>
    </ul>
    <p>Predikat: <?= e(statusKelulusan($mahasiswa['ipk'])) ?></p>
</body>
</html>
