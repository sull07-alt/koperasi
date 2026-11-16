CREATE DATABASE IF NOT EXISTS koperasi;
USE koperasi;

CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    harga DECIMAL(12,2) NOT NULL DEFAULT 0,
    stok INT NOT NULL DEFAULT 0
);

INSERT INTO produk (nama, harga, stok) VALUES
('Beras', 15000.00, 20),
('Minyak Goreng', 18000.00, 15),
('Gula Pasir', 14000.00, 25);
