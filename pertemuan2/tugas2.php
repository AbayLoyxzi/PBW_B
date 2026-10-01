<?php
interface BisaDihitung
{
    public function hargaAkhir(): float;
    public function totalHarga(): float;
}

class Produk implements BisaDihitung
{
    public function __construct(
        protected string $nama,
        protected float $harga,
        protected int $jumlah = 1
    ) {
        if ($nama === '') {
            throw new InvalidArgumentException('Nama produk wajib diisi.');
        }
        if ($harga < 0) {
            throw new InvalidArgumentException('Harga tidak boleh negatif.');
        }
        if ($jumlah < 1) {
            throw new InvalidArgumentException('Jumlah minimal satu produk.');
        }
    }

    public function hargaAkhir(): float
    {
        return $this->harga;
    }

    public function totalHarga(): float
    {
        return $this->hargaAkhir() * $this->jumlah;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function getHarga(): float
    {
        return $this->harga;
    }

    public function getJumlah(): int
    {
        return $this->jumlah;
    }
}

class ProdukDiskon extends Produk
{
    public function __construct(string $nama, float $harga, private float $diskon, int $jumlah = 1)
    {
        if ($diskon < 0 || $diskon > 50) {
            throw new InvalidArgumentException('Diskon harus berada di antara 0% dan 50%.');
        }
        parent::__construct($nama, $harga, $jumlah);
    }

    public function hargaAkhir(): float
    {
        return $this->harga * (1 - $this->diskon / 100);
    }

    public function getDiskon(): float
    {
        return $this->diskon;
    }
}

function rupiah(float $nilai): string
{
    return 'Rp ' . number_format($nilai, 0, ',', '.');
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$daftar = [
    new Produk('Keyboard', 250000, 2),
    new ProdukDiskon('Mouse', 150000, 10, 3),
    new ProdukDiskon('Headset', 425000, 15, 1),
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tugas 2 - Harga Produk</title>
    <style>
        :root { color-scheme: light; font-family: "Segoe UI", sans-serif; color: #18253b; background: #eef3fb; }
        body { margin: 0; padding: 48px 20px; }
        main { max-width: 880px; margin: 0 auto; }
        .card { overflow: hidden; border: 1px solid #dce5f2; border-radius: 18px; background: white; box-shadow: 0 16px 40px #17345b12; }
        header { padding: 28px 30px 20px; }
        h1 { margin: 0 0 8px; font-size: 27px; }
        header p { margin: 0; color: #61708a; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th, td { padding: 14px 18px; border-top: 1px solid #e7edf5; }
        th { color: #697894; font-size: 12px; text-transform: uppercase; letter-spacing: .06em; }
        td:last-child, th:last-child { text-align: right; }
        tbody tr:nth-child(even) { background: #f8faff; }
        tfoot td { font-weight: 700; background: #f1f5fc; }
        .discount { color: #267448; }
        @media (max-width: 620px) { body { padding: 20px 10px; } th, td { padding: 11px 8px; font-size: 13px; } }
    </style>
</head>
<body>
<main class="card">
    <header>
        <h1>Ringkasan Harga Produk</h1>
        <p>Contoh interface, inheritance, validasi diskon, dan perhitungan jumlah barang.</p>
    </header>
    <table>
        <thead><tr><th>Produk</th><th>Harga satuan</th><th>Diskon</th><th>Jumlah</th><th>Total</th></tr></thead>
        <tbody>
        <?php foreach ($daftar as $produk): ?>
            <?php $diskon = $produk instanceof ProdukDiskon ? $produk->getDiskon() : 0; ?>
            <tr>
                <td><?= e($produk->getNama()) ?></td>
                <td><?= e(rupiah($produk->getHarga())) ?></td>
                <td class="discount"><?= e((string) $diskon) ?>%</td>
                <td><?= e((string) $produk->getJumlah()) ?></td>
                <td><?= e(rupiah($produk->totalHarga())) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot><tr><td colspan="4">Total seluruh belanja</td><td><?= e(rupiah(array_sum(array_map(fn (Produk $produk): float => $produk->totalHarga(), $daftar)))) ?></td></tr></tfoot>
    </table>
</main>
</body>
</html>
