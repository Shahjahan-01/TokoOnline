# Toko Online Sederhana (Proyek LKPD)

Aplikasi e-commerce sederhana (single store, multi buyer) dibuat dengan Laravel 11.
Mengimplementasikan: MVC, Blade Templating, CRUD, Relasi Database, Authentication, Authorization, dan Middleware — sesuai spesifikasi LKPD.

## Fitur yang sudah dikerjakan

1. **Landing Page** — daftar semua produk (nama, gambar, harga, stok) + tombol Checkout. Bisa diakses tanpa login.
2. **Register & Login** — pembeli bisa daftar akun baru dan masuk.
3. **Middleware Cek Login** (`cek.login`) — saat tombol Checkout ditekan tanpa login, muncul alert "Anda harus login terlebih dahulu" lalu diarahkan ke halaman login. Kalau sudah login, lanjut ke form checkout.
4. **Proses Checkout / Pemesanan** — form checkout menyimpan produk, jumlah, data pembeli, dan alamat pengiriman ke tabel `orders` dengan status awal `menunggu_pembayaran`. Stok produk otomatis berkurang.
5. **Kelola Produk (CRUD)** — admin bisa tambah, ubah, hapus produk, termasuk upload gambar.
6. **Daftar Pembeli / Pesanan Masuk** — admin bisa lihat semua pesanan beserta identitas pembeli, filter per status.
7. **Ubah Status Pengiriman** — admin bisa ubah status pesanan (Menunggu Pembayaran/Diproses/Dikirim/Selesai/Dibatalkan).
8. **Middleware Otorisasi Admin** (`admin`) — semua route `/admin/*` hanya bisa diakses user dengan role `admin`.
9. **Halaman Pesanan Saya** — pembeli hanya melihat riwayat pesanan miliknya sendiri.

### Pembayaran

Ada dua metode: **COD** dan **Transfer**. Untuk transfer, pembeli wajib upload gambar bukti transfer (disimpan di `storage/app/public/bukti-transfer`) yang bisa dilihat admin di halaman detail pesanan.

### Data alamat pengiriman

Supaya barang bisa sampai ke pembeli, form checkout meminta: nama penerima, nomor HP, alamat lengkap, kota/kabupaten, kode pos (opsional), dan catatan tambahan (opsional). Semua data ini disimpan langsung di tabel `orders` (bukan di tabel user), karena setiap pesanan bisa dikirim ke alamat yang berbeda-beda.

## Struktur Database

- **users** — `name`, `email`, `password`, `role` (admin/pembeli), `phone`, `address`
- **products** — `name`, `description`, `price`, `stock`, `image`
- **orders** — `user_id`, `product_id`, `quantity`, `price`, `total_price`, `payment_method`, `proof_image`, `recipient_name`, `phone`, `address`, `city`, `postal_code`, `notes`, `status`

Relasi: `User hasMany Order`, `Product hasMany Order`, `Order belongsTo User & Product`.

## Cara Menjalankan

Pastikan sudah terinstall **PHP >= 8.2**, **Composer**, dan **MySQL** di komputer kamu.

```bash
# 1. Masuk ke folder project
cd toko-online

# 2. Install dependency PHP
composer install

# 3. Copy file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Buat database MySQL bernama "toko_online" (lewat phpMyAdmin/terminal),
#    lalu sesuaikan DB_USERNAME & DB_PASSWORD di file .env kalau perlu

# 6. Jalankan migration + seeder (bikin tabel + akun admin + produk contoh)
php artisan migrate --seed

# 7. Buat symbolic link storage (biar gambar produk & bukti transfer bisa tampil)
php artisan storage:link

# 8. Jalankan server
php artisan serve
```

Buka `http://127.0.0.1:8000` di browser.

### Akun default

| Role    | Email               | Password |
|---------|---------------------|----------|
| Admin   | admin@tokokita.com  | password |
| Pembeli | daftar sendiri lewat halaman Register |

## Struktur Folder Penting

```
app/Http/Controllers/          -> Controller (Product, Checkout, Order, Auth)
app/Http/Controllers/Admin/    -> Controller khusus admin (Dashboard, Product, Order)
app/Http/Middleware/           -> CekLoginCheckout.php, CekAdmin.php
app/Models/                    -> User.php, Product.php, Order.php
database/migrations/           -> struktur tabel
database/seeders/               -> data awal (admin + produk contoh)
resources/views/                -> semua tampilan Blade
routes/web.php                  -> semua route aplikasi
```

## Catatan

- Styling pakai Tailwind CSS lewat CDN, jadi tidak perlu proses build (`npm run build`) segala macam — cukup jalankan `php artisan serve` saja.
- Kalau mau tambah/ubah role, atur langsung lewat kolom `role` di tabel `users` (isinya `admin` atau `pembeli`).
