<?php
require_once __DIR__ . '/Produk.php';
$db = (new Database())->getConnection();
$produk = new Produk($db);
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $harga = $_POST['harga'] ?? '';
    $stok = $_POST['stok'] ?? '';
    if ($nama === '' || !is_numeric($harga) || !filter_var($stok, FILTER_VALIDATE_INT) || (int)$stok < 0) {
        $error = 'Isi nama, harga yang valid, dan stok berupa bilangan bulat tidak negatif.';
    } else {
        $produk->tambah($nama, $harga, (int)$stok);
        header('Location: index.php');
        exit;
    }
}
function h($nilai) { return htmlspecialchars((string) $nilai, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><title>Tambah Produk</title></head><body>
<h1>Tambah Produk</h1>
<?php if ($error !== ''): ?><p><?= h($error) ?></p><?php endif; ?>
<form method="post">
<p><label>Nama: <input type="text" name="nama" required value="<?= h($_POST['nama'] ?? '') ?>"></label></p>
<p><label>Harga: <input type="number" name="harga" min="0" step="0.01" required value="<?= h($_POST['harga'] ?? '') ?>"></label></p>
<p><label>Stok: <input type="number" name="stok" min="0" step="1" required value="<?= h($_POST['stok'] ?? '') ?>"></label></p>
<button type="submit">Simpan</button>
</form>
<p><a href="index.php">Kembali</a></p></body></html>
