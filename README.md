# Sistem Informasi Buku Tamu Digital (SIBUTAD)
**Capstone Project** - Mata Kuliah Pemrograman Berbasis Objek. <br>
Roona adalah website penyewaan kostum yang mempermudah pengecekan ketersediaan, pemesanan, dan pengelolaan inventaris secara real-time. Dibangun dengan OOP dan CRUD, sistem ini menyediakan katalog digital, booking online, dan riwayat transaksi untuk mencegah double-booking serta meningkatkan efisiensi dan profesionalisme layanan penyewaan kostum.

- [Link Laporan](https://docs.google.com/document/d/1CJ0WXkBwxXyFXHOsJqdW30Fq5RImXJe83O54BUg1gEY/edit?tab=t.0)
- [Commit at Presentation Day](https://github.com/1019-pixie/roona/commit/b26088530fbcc777ce0d6558779dbd13ed8f468b)

## Tim
- H1101241038 Saskia Mecca Widyarni (Ketua)
- H1101241032 Tan Atira Yasmin
- H1101241011 Mas Jihan Afra Auzia
- H1101241019 Olivia Naura Fakhradika

## Cara Pakai di Local
- buat file `.env` (isi sesuai konfigurasi database (MYSQL atau PGSQL)), salin dari isi `.env.example`.
- run `loadenv` di CMD (akan load .env ke variabel process, agar bisa diakses oleh `getenv()`), cek dengan run `set DB_`.
- Run server Database, run Query (`db.sql` untuk database MYSQL)
- Run server `php -S localhost:8080 -t public`

## Cara deploy ke vercel
- run `vercel --prod` (bisa koneksi ke repo github untuk auto run)
- setup database: jika pakai `supabase`, run `db-pg.sql` di **SQL Editor** supabase, sesuaikan konfigurasi `DB_*` seperti pada contoh di `.env.prod.example`, dan paste-kan ke dalam **vercel environment variable**