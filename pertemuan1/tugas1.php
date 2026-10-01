<?php
function statusKelulusan(float $ipk): string
{
    if ($ipk >= 3.80) {
        return 'Dengan Pujian (Cumlaude)';
    }
    if ($ipk >= 3.50) {
        return 'Sangat Memuaskan';
    }
    if ($ipk >= 3.00) {
        return 'Memuaskan';
    }

    return 'Perlu Peningkatan';
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$mahasiswa = [
    'nim' => '2026001',
    'nama' => 'Andi Pratama',
    'prodi' => 'Teknik Informatika',
    'semester' => 1,
    'angkatan' => 2026,
    'status keaktifan' => 'Aktif',
    'ipk' => 3.85,
];

$ipkInput = (string) ($_POST['ipk'] ?? $mahasiswa['ipk']);
$pesan = '';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    if (!is_numeric($ipkInput)) {
        $pesan = 'IPK harus berupa angka.';
    } else {
        $ipkBaru = (float) $ipkInput;
        if ($ipkBaru < 0 || $ipkBaru > 4) {
            $pesan = 'IPK harus berada di antara 0.00 dan 4.00.';
        } else {
            $mahasiswa['ipk'] = $ipkBaru;
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tugas 1 - Biodata Mahasiswa</title>
    <style>
        :root { color-scheme: light; font-family: "Segoe UI", sans-serif; color: #17233b; background: #eef3fb; }
        body { margin: 0; padding: 48px 20px; }
        main { max-width: 760px; margin: 0 auto; }
        .card { padding: 32px; border: 1px solid #dce5f2; border-radius: 18px; background: white; box-shadow: 0 16px 40px #17345b12; }
        h1 { margin: 0 0 8px; font-size: 28px; }
        .subtitle { margin: 0 0 24px; color: #61708a; }
        .data { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; margin: 0; }
        .data div { padding: 14px; border-radius: 12px; background: #f5f8fd; }
        dt { color: #697894; font-size: 13px; }
        dd { margin: 5px 0 0; font-weight: 650; }
        form { display: flex; flex-wrap: wrap; align-items: end; gap: 12px; margin-top: 24px; padding-top: 22px; border-top: 1px solid #e7edf5; }
        label { display: grid; gap: 6px; font-size: 14px; font-weight: 600; }
        input, button { min-height: 42px; padding: 0 12px; border: 1px solid #cdd8e8; border-radius: 9px; font: inherit; }
        button { border-color: #3159ce; background: #3159ce; color: white; font-weight: 650; cursor: pointer; }
        .notice { margin: 14px 0 0; color: #a33131; }
        .badge { display: inline-block; padding: 5px 10px; border-radius: 999px; background: #e8efff; color: #274cb8; }
    </style>
</head>
<body>
<main>
    <section class="card">
        <h1>Biodata Mahasiswa</h1>
        <p class="subtitle">Contoh array asosiatif, fungsi, kondisi, dan perulangan PHP.</p>
        <dl class="data">
            <?php foreach ($mahasiswa as $kunci => $nilai): ?>
                <div>
                    <dt><?= e(ucwords($kunci)) ?></dt>
                    <dd><?= e((string) $nilai) ?></dd>
                </div>
            <?php endforeach; ?>
            <div>
                <dt>Predikat</dt>
                <dd><span class="badge"><?= e(statusKelulusan((float) $mahasiswa['ipk'])) ?></span></dd>
            </div>
        </dl>
        <form method="post">
            <label for="ipk">Uji validasi IPK (0.00-4.00)
                <input id="ipk" name="ipk" type="number" step="0.01" min="0" max="4" value="<?= e($ipkInput) ?>" required>
            </label>
            <button type="submit">Perbarui IPK</button>
        </form>
        <?php if ($pesan !== ''): ?>
            <p class="notice" role="alert"><?= e($pesan) ?></p>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
