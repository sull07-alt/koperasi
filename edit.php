<?php
require_once __DIR__ . '/Produk.php';
$db = (new Database())->getConnection();
$produk = new Produk($db);
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
}
if (!$id || !($data = $produk->cari($id))) {
    header('Location: index.php');
    exit;
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $harga = $_POST['harga'] ?? '';
    $stok = $_POST['stok'] ?? '';
    if ($nama === '' || !is_numeric($harga) || !filter_var($stok, FILTER_VALIDATE_INT) || (int)$stok < 0) {
        $error = 'Isi nama, harga yang valid, dan stok berupa bilangan bulat tidak negatif.';
        $data = ['id' => $id, 'nama' => $nama, 'harga' => $harga, 'stok' => $stok];
    } else {
        $produk->ubah($id, $nama, $harga, (int)$stok);
        header('Location: index.php');
        exit;
    }
}
function h($nilai) { return htmlspecialchars((string) $nilai, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><title>Edit Produk</title></head><body>
<h1>Edit Produk</h1>
<?php if ($error !== ''): ?><p><?= h($error) ?></p><?php endif; ?>
<form method="post">
<input type="hidden" name="id" value="<?= h($data['id']) ?>">
<p><label>Nama: <input type="text" name="nama" required value="<?= h($data['nama']) ?>"></label></p>
<p><label>Harga: <input type="number" name="harga" min="0" step="0.01" required value="<?= h($data['harga']) ?>"></label></p>
<p><label>Stok: <input type="number" name="stok" min="0" step="1" required value="<?= h($data['stok']) ?>"></label></p>
<button type="submit">Simpan Perubahan</button>
</form>
<p><a href="index.php">Kembali</a></p></body></html>
