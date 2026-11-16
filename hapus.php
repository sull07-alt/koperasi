<?php
require_once __DIR__ . '/Produk.php';
$db = (new Database())->getConnection();
$produk = new Produk($db);
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id) {
    $produk->hapus($id);
}
header('Location: index.php');
exit;
