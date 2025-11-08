
# 📋 Sistem Manajemen Cuti Karyawan

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2">
  <img src="https://img.shields.io/badge/Tailwind_CSS-4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Vite-7.x-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
  <img src="https://img.shields.io/badge/SQLite-Database-003B57?style=for-the-badge&logo=sqlite&logoColor=white" alt="SQLite">
</p>

<p align="center">
  <b>Sistem manajemen cuti karyawan berbasis web yang modern dan efisien</b><br>
  Dibangun dengan Laravel 12, Tailwind CSS 4, dan teknologi terkini
</p>

---

## 📖 Daftar Isi

- [Tentang Project](#-tentang-project)
- [Fitur Utama](#-fitur-utama)
- [Tech Stack](#️-tech-stack)
- [Instalasi](#-instalasi)
- [Cara Menjalankan](#-cara-menjalankan)
- [Demo Credentials](#-demo-credentials)
- [Struktur Database](#-struktur-database)
- [Arsitektur Sistem](#️-arsitektur-sistem)
- [Routing Structure](#-routing-structure)
- [API Documentation](#-api-documentation)
- [Testing](#-testing)
- [Commands Artisan](#-commands-artisan-berguna)
- [Konfigurasi](#-konfigurasi)
- [Contributing](#-contributing)
- [License](#-license)
- [Kontak & Support](#-kontak--support)

---

## 📖 Tentang Project

**Sistem Manajemen Cuti Karyawan** adalah aplikasi web yang dirancang untuk mempermudah pengelolaan cuti karyawan dalam sebuah organisasi. Aplikasi ini mendukung tiga role berbeda (Admin, HRD, dan Karyawan) dengan hak akses yang disesuaikan untuk setiap peran.

### 🎯 Tujuan Project

- ✅ Mengotomatisasi proses pengajuan dan persetujuan cuti
- ✅ Memudahkan tracking sisa cuti karyawan
- ✅ Menyediakan sistem notifikasi real-time
- ✅ Menghasilkan laporan cuti yang komprehensif
- ✅ Meningkatkan transparansi dan efisiensi dalam manajemen cuti

---

## ✨ Fitur Utama

### 👨‍💼 Admin

- ✅ Dashboard dengan statistik lengkap
- ✅ Kelola data karyawan (CRUD)
- ✅ Kelola departemen (CRUD)
- ✅ Kelola jenis cuti (CRUD)
- ✅ Lihat dan kelola semua pengajuan cuti
- ✅ Kelola akun HRD
- ✅ Generate laporan cuti
- ✅ Pengaturan sistem

### 👥 HRD (Human Resources Department)

- ✅ Dashboard HRD dengan statistik approval
- ✅ Approve/Reject pengajuan cuti karyawan
- ✅ Lihat dan kelola data karyawan
- ✅ Ajukan cuti pribadi
- ✅ Lihat riwayat cuti departemen
- ✅ Generate laporan departemen
- ✅ Kelola profil dan password

### 👤 Karyawan

- ✅ Dashboard karyawan dengan statistik cuti
- ✅ Ajukan cuti baru
- ✅ Lihat riwayat pengajuan cuti
- ✅ Cek sisa cuti tahunan
- ✅ Notifikasi status cuti real-time
- ✅ Kelola profil pribadi dan password

---

## 🛠️ Tech Stack

### Backend

- **Framework:** Laravel 12.x
- **Language:** PHP 8.2
- **Database:** SQLite
- **Authentication:** Laravel Sanctum (Multi-guard: Web & Karyawan)
- **ORM:** Eloquent

### Frontend

- **Template Engine:** Blade
- **CSS Framework:** Tailwind CSS 4.0
- **Build Tool:** Vite 7.x
- **JavaScript:** Vanilla JS + Axios

### Development Tools

- **Package Manager:** Composer, NPM
- **Testing:** PHPUnit
- **Code Style:** Laravel Pint
- **Development Server:** Laravel Serve + Vite HMR

---

## 📦 Instalasi

### Prasyarat

Pastikan sistem Anda telah terinstall:

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- NPM atau Yarn

### Langkah Instalasi

**1. Clone repository**

```bash
git clone <repository-url>
cd sistem-manajemen-cuti
```

**2. Install dependencies PHP**

```bash
composer install
```

**3. Install dependencies JavaScript**

```bash
npm install
```

**4. Setup environment**

```bash
cp .env.example .env
php artisan key:generate
```

**5. Setup database**

```bash
touch database/database.sqlite
php artisan migrate
```

**6. Seed database (untuk data demo)**

```bash
php artisan db:seed
```

**7. Build assets**

```bash
npm run build
```

---

## 🚀 Cara Menjalankan

### Development Mode

**Opsi 1: Menjalankan secara terpisah**

```bash
# Terminal 1 - Laravel Server
php artisan serve --host=0.0.0.0 --port=5000

# Terminal 2 - Vite Dev Server
npm run dev
```

**Opsi 2: Menjalankan dengan Concurrently (Recommended)**

```bash
npx concurrently -c "#93c5fd,#c4b5fd" \
  "php artisan serve --host=0.0.0.0 --port=5000" \
  "npm run dev" \
  --names=laravel,vite \
  --kill-others-on-fail
```

Akses aplikasi di: `http://0.0.0.0:5000`

### Production Mode

**1. Build assets untuk production**

```bash
npm run build
```

**2. Optimize aplikasi**

```bash
php artisan optimize
```

**3. Jalankan server**

```bash
php artisan serve --host=0.0.0.0 --port=5000
```

---

## 👤 Demo Credentials

Setelah menjalankan `php artisan db:seed`, gunakan credentials berikut untuk login:

### Admin

```
Email: admin@gmail.com
Password: password
```

### HRD

```
Email: ani.wulandari@perusahaan.com
Password: password
```

### Karyawan

```
Email: budi.santoso@perusahaan.com
Password: password
```

---

## 📁 Struktur Database

### Tabel Utama

| Tabel | Deskripsi |
|-------|-----------|
| **users** | Data admin sistem |
| **karyawans** | Data karyawan dan HRD |
| **departemens** | Data departemen perusahaan |
| **jenis_cutis** | Jenis-jenis cuti (tahunan, sakit, dll) |
| **cutis** | Data pengajuan cuti |
| **sisa_cuti_tahunans** | Tracking sisa cuti tahunan per karyawan |
| **notifikasis** | Sistem notifikasi untuk karyawan |
| **pengaturan_sistems** | Konfigurasi sistem |

### ERD (Entity Relationship Diagram)

```
users (1) ────────────> (∞) cutis [sebagai approver]
departemens (1) ───────> (∞) karyawans
karyawans (1) ─────────> (∞) cutis
karyawans (1) ─────────> (∞) sisa_cuti_tahunans
karyawans (1) ─────────> (∞) notifikasis
jenis_cutis (1) ───────> (∞) cutis
```

---

## 🏗️ Arsitektur Sistem

### Multi-Guard Authentication

Aplikasi menggunakan sistem multi-guard Laravel untuk memisahkan autentikasi:

- **Web Guard** → untuk Admin (tabel: `users`)
- **Karyawan Guard** → untuk HRD & Karyawan (tabel: `karyawans`)

### Role-Based Access Control (RBAC)

Middleware `CheckRole` mengatur akses berdasarkan role:

- **admin** → Full access ke semua fitur
- **hrd** → Approval & management departemen
- **karyawan** → Self-service cuti

### Workflow Approval Cuti

```
┌─────────────────────────────┐
│ Karyawan mengajukan cuti    │
└──────────────┬──────────────┘
               │
               ▼
┌─────────────────────────────┐
│ HRD review & approve/reject │
└──────────────┬──────────────┘
               │
               ▼
┌─────────────────────────────┐
│ Sistem update sisa cuti     │
└──────────────┬──────────────┘
               │
               ▼
┌─────────────────────────────┐
│ Notifikasi ke karyawan      │
└─────────────────────────────┘
```

---

## 🎨 Routing Structure

### Web Routes

```
/login                    → Halaman login
/admin/*                  → Routes untuk Admin
/hrd/*                    → Routes untuk HRD
/karyawan/*               → Routes untuk Karyawan
```

### Admin Routes (prefix: `/admin`)

| Route | Deskripsi |
|-------|-----------|
| `/admin/dashboard` | Dashboard admin |
| `/admin/karyawan` | CRUD karyawan |
| `/admin/departemen` | CRUD departemen |
| `/admin/cuti` | Kelola cuti |
| `/admin/jenis-cuti` | CRUD jenis cuti |
| `/admin/hrd` | Lihat data HRD |
| `/admin/laporan` | Generate laporan |
| `/admin/pengaturan` | Pengaturan sistem |

### HRD Routes (prefix: `/hrd`)

| Route | Deskripsi |
|-------|-----------|
| `/hrd/dashboard` | Dashboard HRD |
| `/hrd/approval-cuti` | Approve/reject cuti |
| `/hrd/data-karyawan` | Lihat data karyawan |
| `/hrd/pengajuan-cuti` | Ajukan cuti pribadi |
| `/hrd/riwayat-cuti` | Riwayat cuti |
| `/hrd/laporan` | Laporan departemen |
| `/hrd/profil` | Profil HRD |

### Karyawan Routes (prefix: `/karyawan`)

| Route | Deskripsi |
|-------|-----------|
| `/karyawan/dashboard` | Dashboard karyawan |
| `/karyawan/ajukan-cuti` | Form pengajuan cuti |
| `/karyawan/riwayat-cuti` | Riwayat pengajuan |
| `/karyawan/sisa-cuti` | Lihat sisa cuti |
| `/karyawan/notifikasi` | Notifikasi |
| `/karyawan/profil` | Profil karyawan |

---

## 📡 API Documentation

Aplikasi ini menyediakan RESTful API yang lengkap untuk integrasi dengan sistem lain.

### Base URL

```
http://0.0.0.0:5000/api
```

### Dokumentasi Lengkap

Lihat dokumentasi API lengkap di: **[DokumentasiAPI.md](DokumentasiAPI.md)**

### Quick Start API

**Login:**

```bash
curl -X POST http://0.0.0.0:5000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@gmail.com",
    "password": "password",
    "guard": "web"
  }'
```

**Get Dashboard (dengan token):**

```bash
curl -X GET http://0.0.0.0:5000/api/admin/dashboard \
  -H "Authorization: Bearer {your-token-here}"
```

---

## 🧪 Testing

### Menjalankan Tests

```bash
# Semua tests
php artisan test

# Test spesifik
php artisan test --filter=CutiTest

# Dengan coverage
php artisan test --coverage
```

---

## 📝 Commands Artisan Berguna

### Database Commands

```bash
# Migrasi database
php artisan migrate

# Migrasi fresh dengan seeder
php artisan migrate:fresh --seed

# Rollback migrasi
php artisan migrate:rollback
```

### Cache Commands

```bash
# Clear semua cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize aplikasi
php artisan optimize

# Clear optimization
php artisan optimize:clear
```

### Development Commands

```bash
# Generate application key
php artisan key:generate

# Tinker (REPL)
php artisan tinker

# List semua routes
php artisan route:list

# List semua commands
php artisan list
```

---

## 🔧 Konfigurasi

### Environment Variables

Edit file `.env` untuk mengubah konfigurasi aplikasi:

```env
# Application
APP_NAME="Sistem Manajemen Cuti"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://0.0.0.0:5000

# Database
DB_CONNECTION=sqlite

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Mail (opsional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
```

### Vite Configuration

File `vite.config.js` sudah dikonfigurasi untuk development dan production. Tidak perlu diubah kecuali untuk kebutuhan khusus.

---

## 🤝 Contributing

Kontribusi sangat diterima! Silakan ikuti langkah berikut:

### Langkah Kontribusi

1. Fork repository ini
2. Buat branch fitur baru
   ```bash
   git checkout -b feature/AmazingFeature
   ```
3. Commit perubahan Anda
   ```bash
   git commit -m 'Add some AmazingFeature'
   ```
4. Push ke branch
   ```bash
   git push origin feature/AmazingFeature
   ```
5. Buat Pull Request

### Coding Standards

- Ikuti **PSR-12** coding standard untuk PHP
- Gunakan **Laravel Pint** untuk formatting:
  ```bash
  ./vendor/bin/pint
  ```
- Tulis tests untuk fitur baru
- Dokumentasikan kode Anda dengan baik

---

## 📄 License

Project ini menggunakan lisensi **MIT License**.

```
MIT License

Copyright (c) 2024 Sistem Manajemen Cuti

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

## 🐛 Bug Reports & Feature Requests

Jika menemukan bug atau ingin request fitur baru:

- 🐞 Buka **[Issues](../../issues)** untuk melaporkan bug
- 💡 Jelaskan bug/fitur dengan detail
- 📸 Sertakan screenshot jika memungkinkan
- 🔍 Cek apakah issue sudah pernah dilaporkan sebelumnya

---

## 📞 Kontak & Support

Untuk pertanyaan atau support:

- 📧 **Email:** support@example.com
- 📚 **Documentation:** [Wiki](../../wiki)
- 🐛 **Issues:** [GitHub Issues](../../issues)
- 💬 **Discussions:** [GitHub Discussions](../../discussions)

---

## 🙏 Acknowledgments

Terima kasih kepada:

- [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
- [Tailwind CSS](https://tailwindcss.com) - A utility-first CSS framework
- [Vite](https://vitejs.dev) - Next Generation Frontend Tooling
- [Laravel Sanctum](https://laravel.com/docs/sanctum) - API Authentication
- Komunitas open source yang luar biasa

---

## 📚 Dokumentasi Tambahan

- 📖 [Tracking Alur Pembuatan Project](TrackingALurPembuatanProject.md)
- 🔌 [API Documentation](DokumentasiAPI.md)
- ⚙️ [Replit Configuration](replit.md)

---

<p align="center">
  <b>Made with ❤️ using Laravel & Tailwind CSS</b>
</p>

<p align="center">
  <sub>Built for efficient employee leave management</sub>
</p>

<p align="center">
  <a href="#-daftar-isi">⬆️ Kembali ke atas</a>
</p>
