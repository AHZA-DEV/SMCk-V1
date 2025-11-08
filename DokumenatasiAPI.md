
# Dokumentasi API - Sistem Manajemen Cuti

## Base URL
```
http://127.0.0.1/api
```

## Authentication
API ini menggunakan Laravel Sanctum untuk autentikasi. Setelah login, gunakan token yang diterima pada header setiap request:

```
Authorization: Bearer {token}
```

---

## 1. Authentication

### 1.1 Login
**Endpoint:** `POST /login`

**Request Body:**
```json
{
  "email": "admin@example.com",
  "password": "password123",
  "guard": "web"  // "web" untuk admin, "karyawan" untuk karyawan/hrd
}
```

**Response Success:**
```json
{
  "success": true,
  "message": "Login berhasil",
  "data": {
    "user": {
      "id": 1,
      "nama": "Admin User",
      "email": "admin@example.com",
      ...
    },
    "token": "1|abc123...",
    "guard": "admin"  // atau "karyawan", "hrd"
  }
}
```

**Response Error:**
```json
{
  "success": false,
  "message": "Email atau password salah"
}
```

### 1.2 Logout
**Endpoint:** `POST /logout`

**Headers:** `Authorization: Bearer {token}`

**Response:**
```json
{
  "success": true,
  "message": "Logout berhasil"
}
```

### 1.3 Get Current User
**Endpoint:** `GET /me`

**Headers:** `Authorization: Bearer {token}`

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "nama": "John Doe",
    "email": "john@example.com",
    ...
  }
}
```

---

## 2. Admin API

### 2.1 Dashboard

#### Get Dashboard Stats
**Endpoint:** `GET /admin/dashboard`

**Headers:** `Authorization: Bearer {token}`

**Response:**
```json
{
  "success": true,
  "data": {
    "total_karyawan": 50,
    "total_departemen": 5,
    "cuti_pending": 10,
    "cuti_disetujui": 25,
    "cuti_terbaru": [...]
  }
}
```

### 2.2 Karyawan Management

#### Get All Karyawan
**Endpoint:** `GET /admin/karyawan`

**Query Parameters:**
- `per_page` (optional): Jumlah data per halaman (default: 10)

**Response:**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [...],
    "total": 50,
    "per_page": 10
  }
}
```

#### Create Karyawan
**Endpoint:** `POST /admin/karyawan`

**Request Body:**
```json
{
  "nip": "K001",
  "nama": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "departemen_id": 1,
  "jabatan": "Staff IT",
  "tanggal_masuk": "2024-01-01",
  "peran": "karyawan",  // "karyawan" atau "hrd"
  "status": "aktif"  // "aktif" atau "nonaktif"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Karyawan berhasil ditambahkan",
  "data": {...}
}
```

#### Get Karyawan by ID
**Endpoint:** `GET /admin/karyawan/{id}`

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "nip": "K001",
    "nama": "John Doe",
    "departemen": {...}
  }
}
```

#### Update Karyawan
**Endpoint:** `PUT /admin/karyawan/{id}`

**Request Body:**
```json
{
  "nip": "K001",
  "nama": "John Doe Updated",
  "email": "john@example.com",
  "departemen_id": 1,
  "jabatan": "Senior Staff IT",
  "tanggal_masuk": "2024-01-01",
  "peran": "karyawan",
  "status": "aktif",
  "password": "newpassword123"  // optional
}
```

**Response:**
```json
{
  "success": true,
  "message": "Karyawan berhasil diupdate",
  "data": {...}
}
```

#### Delete Karyawan
**Endpoint:** `DELETE /admin/karyawan/{id}`

**Response:**
```json
{
  "success": true,
  "message": "Karyawan berhasil dihapus"
}
```

### 2.3 Departemen Management

#### Get All Departemen
**Endpoint:** `GET /admin/departemen`

**Query Parameters:**
- `per_page` (optional): Jumlah data per halaman

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "nama_departemen": "IT",
        "kode_departemen": "IT001",
        "karyawans_count": 10
      }
    ]
  }
}
```

#### Create Departemen
**Endpoint:** `POST /admin/departemen`

**Request Body:**
```json
{
  "nama_departemen": "IT Department",
  "kode_departemen": "IT001"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Departemen berhasil ditambahkan",
  "data": {...}
}
```

#### Get Departemen by ID
**Endpoint:** `GET /admin/departemen/{id}`

#### Update Departemen
**Endpoint:** `PUT /admin/departemen/{id}`

**Request Body:**
```json
{
  "nama_departemen": "IT Department Updated",
  "kode_departemen": "IT001"
}
```

#### Delete Departemen
**Endpoint:** `DELETE /admin/departemen/{id}`

**Response Error (jika masih ada karyawan):**
```json
{
  "success": false,
  "message": "Departemen tidak dapat dihapus karena masih memiliki karyawan"
}
```

### 2.4 Cuti Management

#### Get All Cuti
**Endpoint:** `GET /admin/cuti`

**Query Parameters:**
- `per_page` (optional): Jumlah data per halaman

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "karyawan": {...},
        "jenis_cuti": {...},
        "tanggal_mulai": "2024-01-01",
        "tanggal_selesai": "2024-01-03",
        "status": "pending"
      }
    ]
  }
}
```

#### Get Cuti by ID
**Endpoint:** `GET /admin/cuti/{id}`

#### Update Cuti Status
**Endpoint:** `PUT /admin/cuti/{id}/status`

**Request Body:**
```json
{
  "status": "disetujui",  // "pending", "disetujui", "ditolak"
  "catatan_approver": "Approved"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Status cuti berhasil diupdate",
  "data": {...}
}
```

#### Delete Cuti
**Endpoint:** `DELETE /admin/cuti/{id}`

### 2.5 Jenis Cuti Management

#### Get All Jenis Cuti
**Endpoint:** `GET /admin/jenis-cuti`

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "nama_cuti": "Cuti Tahunan",
        "jumlah_hari": 12,
        "keterangan": "Cuti tahunan karyawan"
      }
    ]
  }
}
```

#### Create Jenis Cuti
**Endpoint:** `POST /admin/jenis-cuti`

**Request Body:**
```json
{
  "nama_cuti": "Cuti Tahunan",
  "jumlah_hari": 12,
  "keterangan": "Cuti tahunan karyawan"
}
```

#### Get Jenis Cuti by ID
**Endpoint:** `GET /admin/jenis-cuti/{id}`

#### Update Jenis Cuti
**Endpoint:** `PUT /admin/jenis-cuti/{id}`

#### Delete Jenis Cuti
**Endpoint:** `DELETE /admin/jenis-cuti/{id}`

### 2.6 HRD Management

#### Get All HRD
**Endpoint:** `GET /admin/hrd`

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nip": "H001",
      "nama": "HRD User",
      "peran": "hrd",
      "departemen": {...}
    }
  ]
}
```

#### Create HRD
**Endpoint:** `POST /admin/hrd`

**Request Body:**
```json
{
  "nip": "H001",
  "nama": "HRD User",
  "email": "hrd@example.com",
  "password": "password123",
  "departemen_id": 1,
  "tanggal_bergabung": "2024-01-01",
  "jatah_cuti_tahunan": 12
}
```

#### Get HRD by ID
**Endpoint:** `GET /admin/hrd/{id}`

#### Update HRD
**Endpoint:** `PUT /admin/hrd/{id}`

#### Delete HRD
**Endpoint:** `DELETE /admin/hrd/{id}`

### 2.7 Pengaturan Sistem

#### Get Pengaturan
**Endpoint:** `GET /admin/pengaturan`

**Response:**
```json
{
  "success": true,
  "data": {
    "nama_aplikasi": "Sistem Manajemen Cuti",
    "jumlah_cuti_tahunan": 12,
    "email_notifikasi": "admin@example.com"
  }
}
```

#### Update Pengaturan
**Endpoint:** `PUT /admin/pengaturan`

**Request Body:**
```json
{
  "nama_aplikasi": "Sistem Manajemen Cuti",
  "jumlah_cuti_tahunan": 12,
  "email_notifikasi": "admin@example.com"
}
```

### 2.8 Laporan

#### Get Laporan
**Endpoint:** `GET /admin/laporan`

**Query Parameters:**
- `type`: "cuti", "karyawan", atau "departemen"
- `start_date` (optional): Filter tanggal mulai
- `end_date` (optional): Filter tanggal selesai
- `status` (optional): Filter status cuti
- `departemen_id` (optional): Filter departemen
- `peran` (optional): Filter peran karyawan

**Response (type=cuti):**
```json
{
  "success": true,
  "data": [...],
  "summary": {
    "total": 100,
    "disetujui": 80,
    "ditolak": 15,
    "pending": 5
  }
}
```

#### Export Laporan
**Endpoint:** `POST /admin/laporan/export`

---

## 3. HRD API

### 3.1 Dashboard

#### Get Dashboard Stats
**Endpoint:** `GET /hrd/dashboard`

**Response:**
```json
{
  "success": true,
  "data": {
    "stats": {
      "pending": 10,
      "disetujui_hari_ini": 5,
      "ditolak_bulan_ini": 2,
      "total_karyawan": 50
    },
    "pengajuan_terbaru": [...]
  }
}
```

### 3.2 Approval Cuti

#### Get Pending Approval
**Endpoint:** `GET /hrd/approval-cuti`

**Query Parameters:**
- `search` (optional): Cari berdasarkan nama/NIP
- `departemen_id` (optional): Filter departemen

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "karyawan": {...},
        "jenis_cuti": {...},
        "tanggal_mulai": "2024-01-01",
        "status": "pending"
      }
    ]
  }
}
```

#### Get Approval Detail
**Endpoint:** `GET /hrd/approval-cuti/{id}`

#### Approve Cuti
**Endpoint:** `POST /hrd/approval-cuti/{id}/approve`

**Request Body:**
```json
{
  "catatan": "Approved"  // optional
}
```

**Response:**
```json
{
  "success": true,
  "message": "Pengajuan cuti berhasil disetujui",
  "data": {...}
}
```

#### Reject Cuti
**Endpoint:** `POST /hrd/approval-cuti/{id}/reject`

**Request Body:**
```json
{
  "alasan_penolakan": "Karyawan sudah mengambil cuti bulan ini"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Pengajuan cuti berhasil ditolak",
  "data": {...}
}
```

### 3.3 Data Karyawan

#### Get All Karyawan
**Endpoint:** `GET /hrd/data-karyawan`

**Query Parameters:**
- `search` (optional): Cari berdasarkan nama/NIP/email
- `departemen_id` (optional): Filter departemen
- `status` (optional): Filter status

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [...]
  }
}
```

#### Get Karyawan Detail
**Endpoint:** `GET /hrd/data-karyawan/{id}`

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "nip": "K001",
    "nama": "John Doe",
    "departemen": {...},
    "cutis": [...]
  }
}
```

### 3.4 Riwayat Cuti

#### Get Riwayat Cuti
**Endpoint:** `GET /hrd/riwayat-cuti`

**Query Parameters:**
- `search` (optional): Cari berdasarkan nama/NIP
- `status` (optional): Filter status
- `departemen_id` (optional): Filter departemen
- `tanggal_mulai` (optional): Filter tanggal mulai
- `tanggal_selesai` (optional): Filter tanggal selesai

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [...]
  }
}
```

#### Get Riwayat Detail
**Endpoint:** `GET /hrd/riwayat-cuti/{id}`

### 3.5 Laporan

#### Get Laporan
**Endpoint:** `GET /hrd/laporan`

**Query Parameters:**
- `bulan` (optional): Bulan laporan (1-12)
- `tahun` (optional): Tahun laporan
- `departemen_id` (optional): Filter departemen

**Response:**
```json
{
  "success": true,
  "data": {
    "periode": {
      "bulan": 1,
      "tahun": 2024
    },
    "statistik": {
      "total_pengajuan": 50,
      "disetujui": 40,
      "ditolak": 5,
      "pending": 5
    },
    "per_jenis_cuti": [...],
    "per_departemen": [...],
    "detail": [...]
  }
}
```

#### Export Laporan
**Endpoint:** `POST /hrd/laporan/export`

**Query Parameters:**
- `bulan` (optional)
- `tahun` (optional)
- `departemen_id` (optional)

### 3.6 Profil

#### Get Profil
**Endpoint:** `GET /hrd/profil`

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "nip": "H001",
    "nama": "HRD User",
    "email": "hrd@example.com",
    "departemen": {...}
  }
}
```

#### Update Profil
**Endpoint:** `PUT /hrd/profil`

**Request Body:**
```json
{
  "nama": "HRD User Updated",
  "email": "hrd@example.com",
  "no_telepon": "08123456789",
  "alamat": "Jl. Example No. 123"
}
```

#### Update Password
**Endpoint:** `PUT /hrd/profil/password`

**Request Body:**
```json
{
  "password_lama": "oldpassword",
  "password_baru": "newpassword",
  "password_baru_confirmation": "newpassword"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Password berhasil diubah"
}
```

---

## 4. Karyawan API

### 4.1 Dashboard

#### Get Dashboard Stats
**Endpoint:** `GET /karyawan/dashboard`

**Response:**
```json
{
  "success": true,
  "data": {
    "karyawan": {...},
    "statistik": {
      "sisa_cuti": 10,
      "total_cuti_diajukan": 2,
      "total_cuti_disetujui": 5,
      "total_cuti_ditolak": 1
    },
    "riwayat_cuti_terbaru": [...]
  }
}
```

### 4.2 Profil

#### Get Profil
**Endpoint:** `GET /karyawan/profil`

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "nip": "K001",
    "nama": "John Doe",
    "email": "john@example.com",
    "departemen": {...}
  }
}
```

#### Update Profil
**Endpoint:** `PUT /karyawan/profil`

**Request Body:**
```json
{
  "nama_depan": "John",
  "nama_belakang": "Doe",
  "email": "john@example.com",
  "no_telepon": "08123456789",
  "alamat": "Jl. Example No. 123",
  "foto_profil": "file"  // multipart/form-data
}
```

**Response:**
```json
{
  "success": true,
  "message": "Profil berhasil diupdate",
  "data": {...}
}
```

#### Update Password
**Endpoint:** `PUT /karyawan/profil/password`

**Request Body:**
```json
{
  "password_lama": "oldpassword",
  "password_baru": "newpassword",
  "password_baru_confirmation": "newpassword"
}
```

### 4.3 Ajukan Cuti

#### Get Jenis Cuti
**Endpoint:** `GET /karyawan/ajukan-cuti`

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nama_cuti": "Cuti Tahunan",
      "jumlah_hari": 12,
      "keterangan": "..."
    }
  ]
}
```

#### Submit Cuti
**Endpoint:** `POST /karyawan/ajukan-cuti`

**Request Body:**
```json
{
  "jenis_cuti_id": 1,
  "tanggal_mulai": "2024-01-01",
  "tanggal_selesai": "2024-01-03",
  "alasan": "Keperluan keluarga"
}
```

**Response Success:**
```json
{
  "success": true,
  "message": "Pengajuan cuti berhasil diajukan",
  "data": {...}
}
```

**Response Error (sisa cuti tidak cukup):**
```json
{
  "success": false,
  "message": "Sisa cuti tidak mencukupi"
}
```

### 4.4 Riwayat Cuti

#### Get Riwayat Cuti
**Endpoint:** `GET /karyawan/riwayat-cuti`

**Query Parameters:**
- `status` (optional): Filter status
- `tahun` (optional): Filter tahun

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "jenis_cuti": {...},
        "tanggal_mulai": "2024-01-01",
        "tanggal_selesai": "2024-01-03",
        "status": "disetujui",
        "disetujui_oleh": {...}
      }
    ]
  }
}
```

#### Get Riwayat Detail
**Endpoint:** `GET /karyawan/riwayat-cuti/{id}`

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "jenis_cuti": {...},
    "tanggal_mulai": "2024-01-01",
    "tanggal_selesai": "2024-01-03",
    "jumlah_hari": 3,
    "alasan": "Keperluan keluarga",
    "status": "disetujui",
    "disetujui_oleh": {...},
    "tanggal_approve": "2024-01-01 10:00:00",
    "catatan_approval": "Approved"
  }
}
```

### 4.5 Sisa Cuti

#### Get Sisa Cuti
**Endpoint:** `GET /karyawan/sisa-cuti`

**Response:**
```json
{
  "success": true,
  "data": {
    "sisa_cuti_saat_ini": 10,
    "riwayat_sisa_cuti": [
      {
        "tahun": 2024,
        "sisa_cuti": 10,
        "cuti_terpakai": 2
      },
      {
        "tahun": 2023,
        "sisa_cuti": 0,
        "cuti_terpakai": 12
      }
    ]
  }
}
```

### 4.6 Notifikasi

#### Get All Notifikasi
**Endpoint:** `GET /karyawan/notifikasi`

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "judul": "Cuti Disetujui",
        "pesan": "Pengajuan cuti Anda telah disetujui",
        "dibaca": false,
        "created_at": "2024-01-01 10:00:00"
      }
    ]
  }
}
```

#### Get Unread Count
**Endpoint:** `GET /karyawan/notifikasi/unread-count`

**Response:**
```json
{
  "success": true,
  "data": {
    "unread_count": 5
  }
}
```

#### Mark as Read
**Endpoint:** `PUT /karyawan/notifikasi/{id}/mark-as-read`

**Response:**
```json
{
  "success": true,
  "message": "Notifikasi berhasil ditandai sebagai dibaca"
}
```

#### Mark All as Read
**Endpoint:** `PUT /karyawan/notifikasi/mark-all-as-read`

**Response:**
```json
{
  "success": true,
  "message": "Semua notifikasi berhasil ditandai sebagai dibaca"
}
```

---

## Error Responses

### Validation Error (422)
```json
{
  "success": false,
  "errors": {
    "email": ["The email field is required."],
    "password": ["The password must be at least 6 characters."]
  }
}
```

### Unauthorized (401)
```json
{
  "success": false,
  "message": "Unauthenticated."
}
```

### Forbidden (403)
```json
{
  "success": false,
  "message": "Akun Anda tidak aktif"
}
```

### Not Found (404)
```json
{
  "success": false,
  "message": "Data tidak ditemukan"
}
```

### Server Error (500)
```json
{
  "success": false,
  "message": "Internal server error"
}
```

---

## Notes

1. Semua endpoint yang memerlukan autentikasi harus menyertakan header `Authorization: Bearer {token}`
2. Untuk upload file (foto profil), gunakan `Content-Type: multipart/form-data`
3. Tanggal menggunakan format `YYYY-MM-DD`
4. DateTime menggunakan format `YYYY-MM-DD HH:mm:ss`
5. Pagination menggunakan parameter `per_page` dan response standard Laravel pagination
6. Guard `web` untuk admin, `karyawan` untuk karyawan dan HRD (dibedakan lewat field `peran`)

---

## Testing dengan cURL

### Login Admin
```bash
curl -X POST http://0.0.0.0:5000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@example.com",
    "password": "password",
    "guard": "web"
  }'
```

### Login Karyawan
```bash
curl -X POST http://0.0.0.0:5000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "karyawan@example.com",
    "password": "password",
    "guard": "karyawan"
  }'
```

### Get Dashboard (dengan token)
```bash
curl -X GET http://0.0.0.0:5000/api/karyawan/dashboard \
  -H "Authorization: Bearer {your-token-here}"
```

### Submit Cuti
```bash
curl -X POST http://0.0.0.0:5000/api/karyawan/ajukan-cuti \
  -H "Authorization: Bearer {your-token-here}" \
  -H "Content-Type: application/json" \
  -d '{
    "jenis_cuti_id": 1,
    "tanggal_mulai": "2024-01-01",
    "tanggal_selesai": "2024-01-03",
    "alasan": "Keperluan keluarga"
  }'
```
