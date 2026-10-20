<?php
require __DIR__ . '/fungsi.php';
require __DIR__ . '/koneksi.php';
$edit = true;
$errors = [];
$id = idBuku($_GET);
$data = cariBuku($koneksi, $id);
require __DIR__ . '/form_buku.php';
