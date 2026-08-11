# Si-BAHALAB

**Sistem Informasi Barang Habis Pakai Laboratorium (Bahan Habis Pakai)**
Laboratorium Kesehatan dan Kalibrasi Provinsi Kalimantan Tengah.

Aplikasi web PHP untuk digitalisasi pengelolaan BHP: penerimaan, stok, distribusi (SBBK), pengajuan, serta modul pemeriksaan HPV DNA dan TB (inklusi tagihan/invoice).

## Fitur

- Autentikasi (login + register) dengan `password_hash`, CSRF token, dan session timeout
- Manajemen stok BHP (masuk, keluar, update, hapus)
- Penerimaan BHP & pembuatan SBBK (Surat Bukti Barang Keluar) otomatis
- Pengajuan BHP dengan tracking status (Diajukan / Disetujui / Ditolak)
- Modul HPV DNA & TB: penerimaan sampel, status pengerjaan, payment & invoice (PDF via dompdf)
- Ekspor data ke Excel (phpspreadsheet)
- Template desain responsif (side bar, dark mode)

## Kebutuhan Sistem

- PHP **>= 8.2** (64-bit) — diverifikasi otomatis oleh `vendor/composer/platform_check.php`
- MySQL / MariaDB
- [Composer](https://getcomposer.org/)
- Ekstensi PHP yang dibutuhkan dependensi (`php-zip`, `php-gd`/`php-gmp`, `php-xml`, `php-mbstring`, `php-intl`)

## Instalasi Lokal (Laragon / XAMPP)

1. Salin project ke folder web server (mis. `C:\laragon\www\sibahalab`).
2. Install dependensi:

   ```bash
   composer install
   ```

3. Salin `.env.example` menjadi `.env` dan sesuaikan kredensial database:

   ```bash
   cp .env.example .env
   ```

   Isi `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME` sesuai pengaturan MySQL lokal.

4. Buat database dan impor `bahalab.sql` (berisi struktur **dan** data terbaru dari database lokal):

   ```bash
   mysql -u root -p -e "SOURCE bahalab.sql"
   ```

   atau impor `bahalab.sql` lewat phpMyAdmin.

5. Jalankan lewat browser: `http://localhost/sibahalab`

> File `bahalab.sql` dibuat dari dump database lokal (`bahalab`) sehingga berisi data nyata.
> Akun pengguna yang aktif mengikuti data di dump tersebut.

## Instalasi dengan Docker Desktop

Project sudah dilengkapi `Dockerfile` dan `docker-compose.yml`. Nama database tetap `bahalab` dan struktur file tidak berubah.

1. Pastikan **Docker Desktop** sudah terinstall dan berjalan.
2. Buka terminal di folder project, lalu jalankan:

   ```bash
   docker compose up -d --build
   ```

   Untuk pengembangan lokal (termasuk Adminer):

   ```bash
   docker compose --profile dev up -d --build
   ```

3. Tunggu sampai container siap. Database `bahalab.sql` akan otomatis diimpor saat database pertama kali dibuat.
4. Buka aplikasi: `http://localhost:8080`

   - MySQL tersedia di port `3307` (host) / `3306` (container).
   - Web server Apache tersedia di port `8080` (host) / `80` (container) agar tidak bentrok dengan Laragon.
   - Adminer (manajemen database via browser): `http://localhost:8081` — lalu login dengan Server = `db`, User = `root`, Password = `root_bahalab_2025`, Database = `bahalab`. MySQL memang tidak bisa dibuka lewat browser biasa, gunakan Adminer atau aplikasi klien MySQL.

5. Untuk menghentikan:

   ```bash
   docker compose down
   ```

   Untuk menghentikan sekaligus menghapus data database:

   ```bash
   docker compose down -v
   ```

### Catatan Docker

- `vendor/` tidak ikut di-commit. Saat container pertama kali jalan, `composer install` dijalankan otomatis oleh `docker-entrypoint.sh`.
- Sesuai port MySQL container dipetakan ke `3307`, bukan `3306`, supaya tidak konflik dengan MySQL Laragon.
- **Adminer diberi `profile: dev`** sehingga tidak ikut ter-deploy ke Dokploy/produksi. Jalankan hanya untuk pengembangan lokal.

## Deploy ke Server (Shared Hosting)

1. Push project ke repository (lihat bagian Git).
2. Di server, lakukan `git clone` atau unggah file via FTP.
3. Jalankan `composer install --no-dev --optimize-autoloader`.
4. Buat database baru dan impor `bahalab.sql`.
5. Salin `.env.example` menjadi `.env`, isi kredensial database server.
6. Pastikan PHP server minimal 8.2.

### Catatan hosting Apache

- File `.htaccess` sudah disertakan (proteksi file sensitif seperti `.env` dan `bahalab.sql`, menonaktifkan listing direktori).
- Jika server tidak memakai Apache (mis. Nginx), terapkan aturan proteksi setara secara manual.

## Git & Push ke GitHub

File yang sebaiknya di-commit:

- Seluruh kode PHP, `css/`, `js/`, `assets/img/` (logo & kop)
- `composer.json` **dan** `composer.lock` (versi dependensi terkunci)
- `bahalab.sql` (dump struktur **+ data lokal**)
- `.env.example` (template, **bukan** `.env` asli)
- `Dockerfile`, `docker-compose.yml`, `.dockerignore`, `docker-entrypoint.sh` (support Docker Desktop)

File yang otomatis diabaikan `.gitignore`:

- `vendor/` (jalankan `composer install` di server)
- `.env` (kredensial lokal)
- `*.zip`, `*.bak`

### ⚠️ Keamanan data

`bahalab.sql` berisi **data kesehatan nyata** (sampel HPV/TB: nama & puskesmas). Pastikan repository GitHub Anda **PRIVATE** agar data ini tidak bocor ke publik. Perbarui dump ini setiap kali data berubah:

```bash
mysqldump -u root -p bahalab > bahalab.sql
```

### Alur push pertama

```bash
git init
git add .
git commit -m "Initial commit Si-BAHALAB"
git branch -M main
git remote add origin https://github.com/USERNAME/sibahalab.git
git push -u origin main
```

## Struktur Utama

| File          | Fungsi                                   |
|---------------|------------------------------------------|
| `config.php`  | Koneksi DB, loader `.env`, helper, CSRF   |
| `auth.php`    | Proteksi halaman (session + timeout)      |
| `index.php`   | Login (dengan captcha)                    |
| `register.php`| Registrasi pengguna baru                  |
| `stock.php`   | Dashboard & manajemen stok BHP            |
| `penerimaan.php` / `sbbk.php` | Penerimaan BHP & distribusi SBBK |
| `hpv-dna.php` / `tb.php` | Modul pemeriksaan HPV DNA & TB    |
| `payment-hpv.php` / `payment-tb.php` | Tagihan & status pembayaran |
| `export-*.php`| Ekspor data ke Excel                       |
| `invoice-*.php` / `print-sbbk.php` | Cetak invoice/PDF via dompdf    |

## Lisensi

Hak cipta © 2025. Internal Laboratorium Kesehatan dan Kalibrasi Provinsi Kalimantan Tengah.
