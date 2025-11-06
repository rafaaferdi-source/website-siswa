CREATE TABLE barang (
  id INT AUTO_INCREMENT PRIMARY KEY,
  no VARCHAR(10),
  nama VARCHAR(100),
  barang VARCHAR(100),
  satuan VARCHAR(50),
  jumlah INT,
  harga_per_satuan DECIMAL(15,2),
  ppn DECIMAL(15,2),
  total DECIMAL(15,2),
  keterangan TEXT
);
