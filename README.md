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

## 📖 Tentang Project

**Sistem Manajemen Cuti Karyawan** adalah aplikasi web yang dirancang untuk mempermudah pengelolaan cuti karyawan dalam sebuah organisasi. Aplikasi ini mendukung tiga role berbeda (Admin, HRD, dan Karyawan) dengan hak akses yang disesuaikan untuk setiap peran.

### 🎯 Tujuan Project
- Mengotomatisasi proses pengajuan dan persetujuan cuti
- Memudahkan tracking sisa cuti karyawan
- Menyediakan sistem notifikasi real-time
- Menghasilkan laporan cuti yang komprehensif
- Meningkatkan transparansi dan efisiensi dalam manajemen cuti

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
- ✅ Dashboard HRD
- ✅ Approve/Reject pengajuan cuti karyawan
- ✅ Lihat data karyawan
- ✅ Ajukan cuti pribadi
- ✅ Lihat riwayat cuti departemen
- ✅ Generate laporan departemen
- ✅ Kelola profil

### 👤 Karyawan
- ✅ Dashboard karyawan
- ✅ Ajukan cuti baru
- ✅ Lihat riwayat pengajuan cuti
- ✅ Cek sisa cuti tahunan
- ✅ Notifikasi status cuti
- ✅ Kelola profil pribadi

---

## 🛠️ Tech Stack

### Backend
- **Framework:** Laravel 12.x
- **Language:** PHP 8.2
- **Database:** SQLite
- **Authentication:** Multi-guard (Web & Karyawan)
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
- PHP >= 8.2
- Composer
- Node.js >= 18.x
- NPM atau Yarn

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone <repository-url>
   cd sistem-manajemen-cuti
   ```

2. **Install dependencies PHP**
   ```bash
   composer install
   ```

3. **Install dependencies JavaScript**
   ```bash
   npm install
   ```

4. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Setup database**
   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```

6. **Seed database (opsional - untuk data demo)**
   ```bash
   php artisan db:seed
   ```

7. **Build assets**
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

Akses aplikasi di: `http://localhost:5000`

### Production Mode

1. **Build assets untuk production**
   ```bash
   npm run build
   ```

2. **Jalankan server**
   ```bash
   php artisan serve --host=0.0.0.0 --port=5000
   ```

   Atau gunakan server production seperti Nginx/Apache dengan PHP-FPM.

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
- **users** - Data admin
- **karyawans** - Data karyawan dan HRD
- **departemens** - Data departemen
- **jenis_cutis** - Jenis-jenis cuti (tahunan, sakit, dll)
- **cutis** - Data pengajuan cuti
- **sisa_cuti_tahunans** - Tracking sisa cuti tahunan
- **notifikasis** - Sistem notifikasi
- **pengaturan_sistems** - Konfigurasi sistem

---

## 🏗️ Arsitektur Sistem

### Multi-Guard Authentication
Aplikasi menggunakan sistem multi-guard Laravel untuk memisahkan autentikasi:
- **Web Guard** → untuk Admin (tabel: users)
- **Karyawan Guard** → untuk HRD & Karyawan (tabel: karyawans)

### Role-Based Access Control (RBAC)
Middleware `CheckRole` mengatur akses berdasarkan role:
- **admin** → Full access
- **hrd** → Approval & management
- **karyawan** → Self-service

### Workflow Approval
```
Karyawan mengajukan cuti
    ↓
HRD review & approve/reject
    ↓
Sistem update sisa cuti
    ↓
Notifikasi ke karyawan
```

---

## 🎨 Routing Structure

```
/login                    → Halaman login
/admin/*                  → Routes untuk Admin
/hrd/*                    → Routes untuk HRD
/karyawan/*               → Routes untuk Karyawan
```

### Admin Routes (prefix: `/admin`)
- `/admin/dashboard` - Dashboard admin
- `/admin/karyawan` - CRUD karyawan
- `/admin/departemen` - CRUD departemen
- `/admin/cuti` - Kelola cuti
- `/admin/jenis-cuti` - CRUD jenis cuti
- `/admin/hrd` - Lihat data HRD
- `/admin/laporan` - Generate laporan
- `/admin/pengaturan` - Pengaturan sistem

### HRD Routes (prefix: `/hrd`)
- `/hrd/dashboard` - Dashboard HRD
- `/hrd/approval-cuti` - Approve/reject cuti
- `/hrd/data-karyawan` - Lihat data karyawan
- `/hrd/pengajuan-cuti` - Ajukan cuti pribadi
- `/hrd/riwayat-cuti` - Riwayat cuti
- `/hrd/laporan` - Laporan departemen
- `/hrd/profil` - Profil HRD

### Karyawan Routes (prefix: `/karyawan`)
- `/karyawan/dashboard` - Dashboard karyawan
- `/karyawan/ajukan-cuti` - Form pengajuan cuti
- `/karyawan/riwayat-cuti` - Riwayat pengajuan
- `/karyawan/sisa-cuti` - Lihat sisa cuti
- `/karyawan/profil` - Profil karyawan

---

## 🧪 Testing

### Menjalankan Tests
```bash
# Unit Tests
php artisan test

# Specific test
php artisan test --filter=CutiTest

# With coverage
php artisan test --coverage
```

---

## 📝 Commands Artisan Berguna

```bash
# Migrasi database
php artisan migrate
php artisan migrate:fresh --seed

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Generate key
php artisan key:generate

# Optimize aplikasi
php artisan optimize

# Tinker (REPL)
php artisan tinker
```

---

## 🔧 Konfigurasi

### Environment Variables
Edit file `.env` untuk mengubah konfigurasi:

```env
APP_NAME="Sistem Manajemen Cuti"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:5000

DB_CONNECTION=sqlite

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

### Vite Configuration
File `vite.config.js` sudah dikonfigurasi untuk development dan production.

---

## 📊 Database Schema

### ERD (Entity Relationship Diagram)
```
users (1) -----> (∞) cutis [sebagai approver]
departemens (1) -----> (∞) karyawans
karyawans (1) -----> (∞) cutis
karyawans (1) -----> (∞) sisa_cuti_tahunans
karyawans (1) -----> (∞) notifikasis
jenis_cutis (1) -----> (∞) cutis
```

---

## 🤝 Contributing

Kontribusi sangat diterima! Silakan ikuti langkah berikut:

1. Fork repository ini
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

### Coding Standards
- Ikuti PSR-12 coding standard untuk PHP
- Gunakan Laravel Pint untuk formatting: `./vendor/bin/pint`
- Tulis tests untuk fitur baru

---

## 📄 License

Project ini menggunakan lisensi **MIT License** - lihat file [LICENSE](LICENSE) untuk detail.

---

## 🐛 Bug Reports & Feature Requests

Jika menemukan bug atau ingin request fitur baru:
- Buka [Issues](../../issues)
- Jelaskan bug/fitur dengan detail
- Sertakan screenshot jika memungkinkan

---

## 📞 Kontak & Support

Untuk pertanyaan atau support:
- **Email:** support@example.com
- **Documentation:** [Wiki](../../wiki)
- **Issues:** [GitHub Issues](../../issues)

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework
- [Vite](https://vitejs.dev) - Next Generation Frontend Tooling
- Komunitas open source yang luar biasa

---

## 📚 Dokumentasi Tambahan

- [Tracking Alur Pembuatan Project](TrackingALurPembuatanProject.md)
- [Replit Configuration](replit.md)
- [API Documentation](docs/api.md) (coming soon)
- [Deployment Guide](docs/deployment.md) (coming soon)

---

<p align="center">
  Made with ❤️ using Laravel & Tailwind CSS
</p>

<p align="center">
  <sub>Built for efficient employee leave management</sub>
</p>
