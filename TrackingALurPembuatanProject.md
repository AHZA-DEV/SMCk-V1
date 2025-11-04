
# Tracking Alur Pembuatan Project - Sistem Manajemen Cuti Karyawan

## Progress Pengembangan

### ✅ 1. Setup Awal Project (Selesai)
- [x] Inisialisasi Laravel project
- [x] Setup database SQLite
- [x] Konfigurasi environment

### ✅ 2. Database Design (Selesai)
#### Migrations:
- [x] users_table (untuk Admin)
- [x] karyawans_table (untuk HRD dan Karyawan)
- [x] departemens_table
- [x] jenis_cutis_table
- [x] cutis_table
- [x] sisa_cuti_tahunans_table
- [x] notifikasis_table
- [x] pengaturan_sistems_table

#### Seeders:
- [x] AdminSeeder
- [x] KaryawanSeeder (HRD dan Karyawan)
- [x] DepartemenSeeder
- [x] JenisCutiSeeder
- [x] CutiSeeder
- [x] SisaCutiTahunanSeeder
- [x] NotifikasiSeeder
- [x] PengaturanSistemSeeder

### ✅ 3. Authentication System (Selesai)
- [x] Multi-guard authentication (web untuk admin, karyawan untuk HRD & Karyawan)
- [x] AuthController dengan login/logout
- [x] Login page menggunakan template dari public/template/login.html
- [x] Middleware CheckRole untuk authorization
- [x] Route protection berdasarkan role

### ✅ 4. View Structure (Selesai)
#### Layouts:
- [x] layouts/app.blade.php (Main layout)
- [x] layouts/navbar.blade.php
- [x] layouts/sidebar.blade.php (Dynamic sidebar berdasarkan role)

#### Admin Views:
- [x] admin/dashboard.blade.php
- [x] admin/kelola-karyawan/index.blade.php
- [x] admin/kelola-departemen/index.blade.php
- [x] admin/kelola-hrd/index.blade.php
- [x] admin/kelola-cuti/index.blade.php
- [x] admin/laporan/index.blade.php
- [x] admin/pengaturan/index.blade.php

#### HRD Views:
- [x] hrd/dashboard.blade.php
- [x] hrd/approval-cuti/index.blade.php
- [x] hrd/data-karyawan/index.blade.php
- [x] hrd/pengajuan-cuti/index.blade.php
- [x] hrd/riwayat-cuti/index.blade.php
- [x] hrd/laporan/index.blade.php
- [x] hrd/profil/index.blade.php

#### Karyawan Views:
- [x] karyawan/dashboard.blade.php
- [x] karyawan/ajukan-cuti/index.blade.php
- [x] karyawan/riwayat-cuti/index.blade.php
- [x] karyawan/sisa-cuti/index.blade.php
- [x] karyawan/profil/index.blade.php

### ✅ 5. Routing (Selesai)
- [x] Route untuk authentication (login, logout)
- [x] Route untuk Admin (dengan prefix 'admin')
- [x] Route untuk HRD (dengan prefix 'hrd')
- [x] Route untuk Karyawan (dengan prefix 'karyawan')
- [x] Middleware protection untuk setiap route group

### 🔄 6. Controllers Development (Dalam Progress - NEXT)
#### Controllers yang perlu dibuat/dilengkapi:
- [ ] AuthController - sudah ada, perlu enhancement
- [ ] DashboardController - untuk menampilkan data statistik dashboard
- [ ] KaryawanController - CRUD karyawan
- [ ] DepartemenController - CRUD departemen
- [ ] CutiController - Kelola pengajuan cuti (create, read, update, delete)
- [ ] JenisCutiController - Kelola jenis cuti
- [ ] NotifikasiController - Sistem notifikasi
- [ ] PengaturanSistemController - Pengaturan aplikasi
- [ ] SisaCutiTahunanController - Hitung sisa cuti

#### Fitur yang akan diimplementasi di Controllers:
- [ ] CRUD Operations untuk semua modul
- [ ] Approval/Rejection system untuk cuti
- [ ] Validasi pengajuan cuti (cek sisa cuti, overlap tanggal, dll)
- [ ] Generate laporan
- [ ] Upload dan validasi file (surat dokter untuk cuti sakit)
- [ ] Sistem notifikasi otomatis
- [ ] Perhitungan sisa cuti otomatis

### 📋 7. Business Logic yang Akan Diimplementasi (Coming Next)
- [ ] Validasi jatah cuti
- [ ] Perhitungan sisa cuti otomatis
- [ ] Approval workflow (HRD → Admin)
- [ ] Notifikasi email/sistem
- [ ] Generate laporan Excel/PDF
- [ ] Dashboard analytics dan statistik
- [ ] Calendar view untuk cuti

### 🎨 8. Frontend Enhancement (Future)
- [ ] JavaScript interactivity
- [ ] AJAX untuk real-time updates
- [ ] Form validation client-side
- [ ] Calendar widget untuk pengajuan cuti
- [ ] Chart.js untuk dashboard analytics
- [ ] DataTables untuk tabel yang besar

### 🔐 9. Security & Optimization (Future)
- [ ] Rate limiting untuk login
- [ ] CSRF protection
- [ ] XSS protection
- [ ] SQL injection prevention
- [ ] Session management
- [ ] Database query optimization
- [ ] Caching implementation

### 📱 10. Testing (Future)
- [ ] Unit testing
- [ ] Feature testing
- [ ] Browser testing

---

## Role & Permissions Summary

### Admin:
- Full access ke semua modul
- Kelola karyawan, HRD, departemen
- Lihat semua pengajuan cuti
- Generate laporan
- Pengaturan sistem

### HRD:
- Approve/Reject pengajuan cuti
- Kelola data karyawan (view only)
- Ajukan cuti sendiri
- Lihat riwayat cuti karyawan
- Generate laporan departemen

### Karyawan:
- Ajukan cuti
- Lihat riwayat cuti sendiri
- Cek sisa cuti
- Update profil sendiri

---

## Database Credentials untuk Testing

### Admin Login:
- Email: admin@gmail.com
- Password: password

### HRD Login:
- Email: hrd@gmail.com
- Password: password

### Karyawan Login:
- Email: budi.santoso@perusahaan.com
- Password: password

---

**Status Terakhir:** Views dan struktur dasar sudah selesai. Selanjutnya akan mengerjakan Controllers untuk implementasi business logic dan CRUD operations.



### Update error di bagian departemen models
Illuminate\Database\QueryException
vendor/laravel/framework/src/Illuminate/Database/Connection.php:824
SQLSTATE[HY000]: General error: 1 no such column: karyawans.departemen_id (Connection: sqlite, SQL: select "departemens".*, (select count(*) from "karyawans" where "departemens"."id" = "karyawans"."departemen_id") as "karyawans_count" from "departemens" limit 10 offset 0)

https://8000-firebase-smck-v1-1762159032451.cluster-a6zx3cwnb5hnuwbgyxmofxpkfe.cloudworkstations.dev/admin/departemen

# Illuminate\Database\QueryException - Internal Server Error

SQLSTATE[HY000]: General error: 1 no such column: karyawans.departemen_id (Connection: sqlite, SQL: select "departemens".*, (select count(*) from "karyawans" where "departemens"."id" = "karyawans"."departemen_id") as "karyawans_count" from "departemens" limit 10 offset 0)

PHP 8.2.27
Laravel 12.36.1
127.0.0.1:8000

## Stack Trace

0 - vendor/laravel/framework/src/Illuminate/Database/Connection.php:824
1 - vendor/laravel/framework/src/Illuminate/Database/Connection.php:778
2 - vendor/laravel/framework/src/Illuminate/Database/Connection.php:397
3 - vendor/laravel/framework/src/Illuminate/Database/Query/Builder.php:3188
4 - vendor/laravel/framework/src/Illuminate/Database/Query/Builder.php:3173
5 - vendor/laravel/framework/src/Illuminate/Database/Query/Builder.php:3763
6 - vendor/laravel/framework/src/Illuminate/Database/Query/Builder.php:3172
7 - vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:902
8 - vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:884
9 - vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:1125
10 - app/Http/Controllers/DepartemenController.php:12
11 - vendor/laravel/framework/src/Illuminate/Routing/ControllerDispatcher.php:46
12 - vendor/laravel/framework/src/Illuminate/Routing/Route.php:265
13 - vendor/laravel/framework/src/Illuminate/Routing/Route.php:211
14 - vendor/laravel/framework/src/Illuminate/Routing/Router.php:822
15 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:180
16 - app/Http/Middleware/CheckRole.php:21
17 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
18 - vendor/laravel/framework/src/Illuminate/Routing/Middleware/SubstituteBindings.php:50
19 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
20 - vendor/laravel/framework/src/Illuminate/Auth/Middleware/Authenticate.php:63
21 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
22 - vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/VerifyCsrfToken.php:87
23 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
24 - vendor/laravel/framework/src/Illuminate/View/Middleware/ShareErrorsFromSession.php:48
25 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
26 - vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php:120
27 - vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php:63
28 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
29 - vendor/laravel/framework/src/Illuminate/Cookie/Middleware/AddQueuedCookiesToResponse.php:36
30 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
31 - vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php:74
32 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
33 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:137
34 - vendor/laravel/framework/src/Illuminate/Routing/Router.php:821
35 - vendor/laravel/framework/src/Illuminate/Routing/Router.php:800
36 - vendor/laravel/framework/src/Illuminate/Routing/Router.php:764
37 - vendor/laravel/framework/src/Illuminate/Routing/Router.php:753
38 - vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php:200
39 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:180
40 - vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TransformsRequest.php:21
41 - vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/ConvertEmptyStringsToNull.php:31
42 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
43 - vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TransformsRequest.php:21
44 - vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TrimStrings.php:51
45 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
46 - vendor/laravel/framework/src/Illuminate/Http/Middleware/ValidatePostSize.php:27
47 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
48 - vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/PreventRequestsDuringMaintenance.php:109
49 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
50 - vendor/laravel/framework/src/Illuminate/Http/Middleware/HandleCors.php:48
51 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
52 - vendor/laravel/framework/src/Illuminate/Http/Middleware/TrustProxies.php:58
53 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
54 - vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/InvokeDeferredCallbacks.php:22
55 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
56 - vendor/laravel/framework/src/Illuminate/Http/Middleware/ValidatePathEncoding.php:26
57 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:219
58 - vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php:137
59 - vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php:175
60 - vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php:144
61 - vendor/laravel/framework/src/Illuminate/Foundation/Application.php:1220
62 - public/index.php:20
63 - vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php:23

## Request

GET /admin/departemen

## Headers

* **host**: 127.0.0.1:8000
* **user-agent**: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36
* **accept**: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8
* **accept-encoding**: gzip, deflate, br, zstd
* **accept-language**: en-US,en;q=0.7
* **connection**: keep-alive
* **cookie**: XSRF-TOKEN=eyJpdiI6IjU0TjJ2VG5QSU82aXdlOGZ4VW4zZ3c9PSIsInZhbHVlIjoiU3pWbDZRNVRSZ1lsQnlpR3hYdGNvZ0Y4dDlwN2RNMEx2SEhEMUNLU0crRjlPWU9nTXdaS0RMemN6MklHNWtOd0FaWXhHMGU1cVI4bXgvRnR2RVc0U3V3d2cyOVFjU2pTTDhCNTJ6dUhZTXJ0QS81bXcyanFBYjYySGFKQTEvclQiLCJtYWMiOiJjODcxY2E1MTc1MDk5ZDZhNGYwODE1NTI1Y2UxYTg0MTYzOWFlMDg1M2RmMjc3MzhkNWQ4ZGQ1ZjAyODM3MGNkIiwidGFnIjoiIn0%3D; laravel-session=eyJpdiI6InFKN25OWXpUMFIvVSsxWk9BRHEwQ1E9PSIsInZhbHVlIjoiNGxKcFduVVpnbEVCcTVyKzV2eFlFc2creDdja1ZRSmNPb0Y5dEh0eVJwOXRqM0dHNU9Xa2VYQllxMy80dVZKeS8wUFZ5WnNtUU9Dc1lReTFNcEVWTE94dnU1RkdqbUhTRlMzZGhsdkdTdEdwT2FMTmM5dzJXZGk5TTlDRTVwNUgiLCJtYWMiOiI0NmY3NWJhZGEzODkwMTM4MjhkNjNlYzk5OWU5NGMyZWU1MmUyMDk1YzQ2YTg2NDRhNWRmMzk5YzJlOTM5NmYwIiwidGFnIjoiIn0%3D
* **referer**: https://8000-firebase-smck-v1-1762159032451.cluster-a6zx3cwnb5hnuwbgyxmofxpkfe.cloudworkstations.dev/admin/hrd
* **sec-ch-ua**: "Chromium";v="142", "Brave";v="142", "Not_A Brand";v="99"
* **sec-ch-ua-mobile**: ?0
* **sec-ch-ua-platform**: "Windows"
* **sec-fetch-dest**: document
* **sec-fetch-mode**: navigate
* **sec-fetch-site**: same-origin
* **sec-fetch-user**: ?1
* **sec-gpc**: 1
* **sec-user-ip**: 36.68.111.247
* **upgrade-insecure-requests**: 1
* **x-forwarded-host**: 8000-firebase-smck-v1-1762159032451.cluster-a6zx3cwnb5hnuwbgyxmofxpkfe.cloudworkstations.dev
* **x-goog-workstations-endpoint**: workstations-821d8bc3-efe3-4d63-8be3-824b60ff9e5e.asia-east1-a.c.monospace-4.internal.:980

## Route Context

controller: App\Http\Controllers\DepartemenController@index
route name: admin.departemen.index
middleware: web, auth:web, role:admin

## Route Parameters

No route parameter data available.

## Database Queries

* sqlite - select * from "sessions" where "id" = 'v0FVGyy45OdMzIc6OywBUZY8ponwnOQmNsWWGiOT' limit 1 (0.74 ms)
* sqlite - select * from "users" where "id" = 1 limit 1 (0.12 ms)
* sqlite - select count(*) as aggregate from "departemens" (0.09 ms)
