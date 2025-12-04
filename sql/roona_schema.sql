CREATE DATABASE IF NOT EXISTS roona CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE roona;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','penyewa') NOT NULL DEFAULT 'penyewa',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE kategori_kostum (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL
);

CREATE TABLE kostum (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(150) NOT NULL,
  kategori_id INT,
  ukuran VARCHAR(50),
  stok INT DEFAULT 0,
  harga_sewa DECIMAL(12,2) NOT NULL,
  deskripsi TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  gambar VARCHAR(255) DEFAULT NULL,
  FOREIGN KEY (kategori_id) REFERENCES kategori_kostum(id) ON DELETE SET NULL
);

CREATE TABLE booking (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  tanggal_booking DATE NOT NULL,
  status ENUM('pending','confirmed','cancelled','completed') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE detail_booking (
  id INT AUTO_INCREMENT PRIMARY KEY,
  booking_id INT NOT NULL,
  kostum_id INT NOT NULL,
  qty INT NOT NULL DEFAULT 1,
  subtotal DECIMAL(12,2) NOT NULL,
  FOREIGN KEY (booking_id) REFERENCES booking(id) ON DELETE CASCADE,
  FOREIGN KEY (kostum_id) REFERENCES kostum(id) ON DELETE RESTRICT
);

CREATE TABLE transaksi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  booking_id INT NOT NULL UNIQUE,
  total_bayar DECIMAL(12,2) NOT NULL,
  metode_pembayaran VARCHAR(50),
  tanggal_bayar TIMESTAMP NULL,
  status ENUM('unpaid','paid','refunded') DEFAULT 'unpaid',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (booking_id) REFERENCES booking(id) ON DELETE CASCADE
);

-- SAMPLE DATA
INSERT INTO users (nama, email, password, role)
VALUES
('Admin Roona', 'admin@roona.test', '{HASH_ADMIN}', 'admin'),
('Budi Penyewa', 'budi@contoh.test', '{HASH_BUDI}', 'penyewa');

INSERT INTO kategori_kostum (nama) VALUES ('Tradisional'), ('Modern'), ('Fantasi');

INSERT INTO kostum (nama, kategori_id, ukuran, stok, harga_sewa, deskripsi)
VALUES
('Kebaya Merah', 1, 'M', 5, 100000, 'Kebaya tradisional warna merah'),
('Baju Putri', 3, 'L', 2, 150000, 'Kostum bergaya putri kerajaan'),
('Setelan Jas', 2, 'M', 3, 120000, 'Jas formal untuk pria');
gambar