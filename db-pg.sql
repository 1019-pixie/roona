-- CREATE DATABASE roona;
-- \c roona;
-- PGSQL

-- ==========================
-- TABLE: users
-- ==========================
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'penyewa'
        CHECK (role IN ('penyewa', 'admin')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================
-- TABLE: kategori_kostum
-- ==========================
CREATE TABLE kategori_kostum (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(100) NOT NULL
);

-- ==========================
-- TABLE: kostum
-- ==========================
CREATE TABLE kostum (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    kategori_id INTEGER REFERENCES kategori_kostum(id),
    ukuran VARCHAR(50),
    stok INTEGER NOT NULL DEFAULT 0,
    harga_sewa INTEGER NOT NULL,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================
-- TABLE: booking
-- ==========================
CREATE TABLE booking (
    id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL REFERENCES users(id),
    tanggal_booking DATE NOT NULL,
    status VARCHAR(20) DEFAULT 'pending'
        CHECK (status IN ('pending', 'approved', 'cancelled')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================
-- TABLE: detail_booking
-- ==========================
CREATE TABLE detail_booking (
    id SERIAL PRIMARY KEY,
    booking_id INTEGER NOT NULL REFERENCES booking(id) ON DELETE CASCADE,
    kostum_id INTEGER NOT NULL REFERENCES kostum(id),
    qty INTEGER NOT NULL,
    subtotal INTEGER NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================
-- TABLE: transaksi
-- ==========================
CREATE TABLE transaksi (
    id SERIAL PRIMARY KEY,
    booking_id INTEGER NOT NULL REFERENCES booking(id) ON DELETE CASCADE,
    total_bayar INTEGER NOT NULL,
    status VARCHAR(20) DEFAULT 'unpaid'
        CHECK (status IN ('unpaid', 'paid')),
    tanggal_bayar TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
