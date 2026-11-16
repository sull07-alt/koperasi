<?php
require_once __DIR__ . '/Database.php';
class Produk
{
    private $conn;
    private $table = 'produk';
    public function __construct($db) { $this->conn = $db; }

    public function semua()
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function cari($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function tambah($nama, $harga, $stok)
    {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (nama, harga, stok) VALUES (?, ?, ?)");
        return $stmt->execute([$nama, $harga, $stok]);
    }
    public function ubah($id, $nama, $harga, $stok)
    {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET nama = ?, harga = ?, stok = ? WHERE id = ?");
        return $stmt->execute([$nama, $harga, $stok, $id]);
    }
    public function hapus($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function cariNama($kata)
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE nama LIKE ? ORDER BY id DESC");
        $stmt->execute(['%' . $kata . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
