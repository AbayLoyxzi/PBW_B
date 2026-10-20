<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Mahasiswa</title>
</head>
<body>
    <form action="simpan.php" method="post">
        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" required>
        <br><br>

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="prodi">Prodi:</label>
        <input type="text" id="prodi" name="prodi" required>
        <br><br>

        <label for="angkatan">Angkatan:</label>
        <input type="number" id="angkatan" name="angkatan" min="1900" max="9999" required>
        <br><br>

        <label for="ipk">IPK:</label>
        <input type="number" id="ipk" name="ipk" step="0.01" min="0" max="4" required>
        <br><br>

        <button type="submit">Simpan</button>
    </form>
    <p><a href="data.php">Lihat data mahasiswa</a></p>
</body>
</html>
