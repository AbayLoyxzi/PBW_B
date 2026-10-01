<?php
$hasil = null;
$pesan = '';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $a = (float) ($_POST['a'] ?? 0);
    $b = (float) ($_POST['b'] ?? 0);
    $operator = $_POST['operator'] ?? '+';

    switch ($operator) {
        case '+':
            $hasil = $a + $b;
            break;
        case '-':
            $hasil = $a - $b;
            break;
        case '*':
            $hasil = $a * $b;
            break;
        case '/':
            if ($b == 0.0) {
                $pesan = 'Pembagian dengan nol tidak diperbolehkan.';
            } else {
                $hasil = $a / $b;
            }
            break;
        default:
            $pesan = 'Operator tidak valid.';
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Kalkulator</title>
</head>
<body>
    <h1>Kalkulator Sederhana</h1>
    <form method="post">
        <input type="number" step="any" name="a" aria-label="Angka pertama" required>
        <select name="operator" aria-label="Operator">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">×</option>
            <option value="/">÷</option>
        </select>
        <input type="number" step="any" name="b" aria-label="Angka kedua" required>
        <button type="submit">Hitung</button>
    </form>
    <?php if ($pesan !== ''): ?>
        <p><?= htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8') ?></p>
    <?php elseif ($hasil !== null): ?>
        <p>Hasil: <?= htmlspecialchars((string) $hasil, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>
</body>
</html>
