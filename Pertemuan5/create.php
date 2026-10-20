<?php
require __DIR__ . '/fungsi.php';
$edit = false;
$errors = [];
$data = ['kode'=>'','judul'=>'','penulis'=>'','kategori'=>'','tahun'=>date('Y'),'stok'=>'0'];
require __DIR__ . '/form_buku.php';
