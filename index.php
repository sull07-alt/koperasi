<?php
require_once __DIR__ . '/Produk.php';
$db = (new Database())->getConnection();
$produk = new Produk($db);
$kata = trim($_GET['kata'] ?? '');
$dataProduk = $kata !== '' ? $produk->cariNama($kata) : $produk->semua();
function h($nilai) { return htmlspecialchars((string) $nilai, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Data Produk Koperasi</title></head>
<body>
<h1>Data Produk Koperasi</h1>
<p><a href="tambah.php">Tambah Produk</a></p>
<form method="get" action="index.php">
    <label for="kata">Cari nama produk:</label>
    <input type="text" id="kata" name="kata" value="<?= h($kata) ?>">
    <button type="submit">Cari</button>
    <?php if ($kata !== ''): ?><a href="index.php">Tampilkan semua</a><?php endif; ?>
</form>
<table border="1" cellpadding="5" cellspacing="0">
    <thead><tr><th>ID</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
    <tbody>
    <?php if (!$dataProduk): ?>
        <tr><td colspan="5">Data produk tidak ditemukan.</td></tr>
    <?php else: foreach ($dataProduk as $item): ?>
        <tr>
            <td><?= h($item['id']) ?></td>
            <td><?= h($item['nama']) ?></td>
            <td><?= h($item['harga']) ?></td>
            <td><?= h($item['stok']) ?></td>
            <td><a href="edit.php?id=<?= h($item['id']) ?>">Edit</a> | <a href="hapus.php?id=<?= h($item['id']) ?>" onclick="return confirm('Hapus produk ini?')">Hapus</a></td>
        </tr>
    <?php endforeach; endif; ?>
    </tbody>
</table>
</body>
</html>
