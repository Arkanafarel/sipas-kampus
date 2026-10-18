# SIPAS KAMPUS
**Sistem Informasi Pengaduan dan Layanan Aspirasi Kampus**

Aplikasi web berbasis **Laravel** yang memfasilitasi mahasiswa dalam menyampaikan pengaduan atau aspirasi fasilitas dan layanan kampus, serta memudahkan pihak pengelola/admin dalam memverifikasi, menindaklanjuti, dan mengunggah bukti penyelesaian laporan secara transparan.

---

## 📌 Fitur Utama

- **Autentikasi & Multi-Role**:
  - **Mahasiswa**: Registrasi akun baru (dengan NPM), login, melihat beranda.
  - **Admin**: Akses khusus panel admin & dashboard statistik.
- **Pengaduan Mahasiswa**:
  - Membuat pengaduan baru lengkap dengan kategori dan unggahan foto lampiran awal.
  - Riwayat pengaduan mandiri dengan status terkini.
  - Detail pengaduan, respons admin, serta foto & catatan bukti penyelesaian.
  - Fitur edit dan hapus pengaduan (hanya jika pengaduan masih berstatus *Sedang Diverifikasi Admin*).
- **Pengelolaan Admin**:
  - Dashboard ringkasan jumlah pengaduan berdasarkan status.
  - Daftar seluruh pengaduan kampus dengan pencarian dan filter status.
  - Detail pengaduan & formulir tindak lanjut (mengubah status, memberikan respons admin, serta mengunggah foto bukti penyelesaian dan catatan penyelesaian).

---

## 💻 Prasyarat Sistem (Prerequisites)

Sebelum menjalankan aplikasi, pastikan komputer/laptop sudah terpasang:

1. **PHP >= 8.2** (ekstensi aktif: `fileinfo`, `pdo`, `mbstring`, `openssl`, `curl`)
2. **Composer** ([Unduh Composer](https://getcomposer.org/))
3. **Database Server**:
   - **SQLite** (sudah bawaan PHP, paling praktis untuk lokal) **ATAU**
   - **MySQL / MariaDB** (via XAMPP / Laragon) **ATAU**
   - **PostgreSQL**
4. **Node.js & NPM** (opsional, jika ingin mengompilasi asset frontend Vite)

---

## 🚀 Panduan Instalasi & Menjalankan di Lokal

Ikuti langkah-langkah berikut di terminal (PowerShell / Command Prompt / Git Bash / Terminal):

### 1. Masuk ke Direktori Proyek
Buka terminal dan arahkan ke folder proyek:
```bash
cd sipas-kampus-main
```

### 2. Install Dependensi PHP (Composer)
Unduh dependensi Laravel:
```bash
composer install
```

---

### 3. Konfigurasi Environment (`.env`)
Salin file `.env.example` menjadi `.env`:

* **Di Windows PowerShell:**
  ```powershell
  Copy-Item .env.example .env
  ```
* **Di Windows CMD:**
  ```cmd
  copy .env.example .env
  ```
* **Di Git Bash / Linux / macOS:**
  ```bash
  cp .env.example .env
  ```

Buka file `.env` dan atur koneksi database sesuai preferensi Anda:

#### 👉 Pilihan A: Menggunakan SQLite (Paling Cepat & Praktis, Tanpa Perlu Setup XAMPP)
Di file `.env`, pastikan pengaturannya seperti berikut:
```env
DB_CONNECTION=sqlite
```
Lalu buat file database kosong di folder `database/`:
* **PowerShell:** `New-Item -Path database/database.sqlite -ItemType File -Force`
* **CMD:** `type nul > database\database.sqlite`
* **Git Bash / Linux:** `touch database/database.sqlite`

#### 👉 Pilihan B: Menggunakan MySQL (XAMPP / Laragon)
1. Nyalakan service MySQL di XAMPP / Laragon.
2. Buat database baru di `phpMyAdmin`, misalnya bernama `sipas_kampus`.
3. Sesuaikan file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sipas_kampus
   DB_USERNAME=root
   DB_PASSWORD=
   ```

---

### 4. Generate Application Key
Jalankan perintah untuk membuat enkripsi key aplikasi:
```bash
php artisan key:generate
```

---

### 5. Jalankan Migrasi & Seeder Database
Perintah ini akan membuat semua tabel yang dibutuhkan sekaligus mengisi data awal kategori pengaduan serta akun default Administrator:
```bash
php artisan migrate --seed
```

> **Catatan:** Jika seeder kategori ingin dijalankan secara spesifik, jalankan:
> ```bash
> php artisan db:seed --class=CategorySeeder
> ```

---

### 6. Hubungkan Storage Publik (Wajib untuk Foto)
Aplikasi menyimpan foto lampiran pengaduan dan bukti penyelesaian di storage. Hubungkan storage ke folder publik dengan menjalankan:
```bash
php artisan storage:link
```
*(Langkah ini sangat penting agar foto yang diunggah dapat tampil di browser).*

---

### 7. Install & Build Asset Frontend (Opsional)
Jika ingin mengompilasi asset frontend:
```bash
npm install
npm run build
```

---

### 8. Jalankan Server Lokal
Nyalakan server development Laravel:
```bash
php artisan serve
```

Aplikasi sekarang sudah berjalan! Buka browser Anda dan akses:
👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)** atau **[http://localhost:8000](http://localhost:8000)**

---

## 🔑 Akun Pengujian Bawaan

Setelah menjalankan `php artisan migrate --seed`, akun berikut otomatis tersedia:

| Peran | Email | Password | Keterangan |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@gmail.com` | `admin123` | Akses penuh dashboard admin & tindak lanjut |
| **Mahasiswa** | `mahasiswa@gmail.com` | `password123` | Akun pengujian mahasiswa bawaan |

---

## 🛠️ Catatan Pemecahan Masalah (Troubleshooting)

- **Foto tidak muncul setelah diupload:**
  Pastikan perintah `php artisan storage:link` sudah berhasil dijalankan, dan pastikan nilai `APP_URL` di `.env` sesuai dengan URL lokal yang Anda gunakan (contoh: `APP_URL=http://127.0.0.1:8000`).
- **Error database permission / database not found (SQLite):**
  Pastikan file `database/database.sqlite` benar-benar ada.
- **Ingin mereset database dari awal:**
  ```bash
  php artisan migrate:fresh --seed
  ```
