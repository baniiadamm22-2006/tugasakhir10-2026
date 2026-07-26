# Human Resource Information System (HRIS)

> Sistem Monitoring dan Evaluasi Kinerja Karyawan Berdasarkan Riwayat Keluhan Berbasis Web

![Laravel](https://img.shields.io/badge/Laravel-10-red)
![Filament](https://img.shields.io/badge/Filament-v3-orange)
![PHP](https://img.shields.io/badge/PHP-8.3-blue)
![MariaDB](https://img.shields.io/badge/MariaDB-10.11-green)
![Docker](https://img.shields.io/badge/Docker-Enabled-blue)

## 📖 Tentang Project

Human Resource Information System (HRIS) merupakan sistem berbasis web yang dikembangkan untuk membantu Human Resource (HR) dalam melakukan monitoring dan evaluasi kinerja karyawan berdasarkan riwayat keluhan.

Sistem ini mengatasi proses pencatatan manual dengan menyediakan platform terintegrasi untuk mengelola data divisi, data karyawan, keluhan, perhitungan skor performa otomatis, dashboard monitoring, hingga pembuatan laporan PDF.

---

## ✨ Fitur Utama

- 🔐 Login & Authentication
- 👥 Manajemen Karyawan
- 🏢 Manajemen Divisi
- 📝 Manajemen Keluhan
- 📊 Dashboard Monitoring
- ⭐ Perhitungan Skor Performa Otomatis
- 📄 Generate Laporan PDF
- 📱 Integrasi WhatsApp API
- 📈 Statistik Performa Karyawan
- 📚 Riwayat Perubahan Status Keluhan

---

## ⚙️ Aturan Perhitungan Skor

Setiap karyawan memiliki skor awal **100**.

| Prioritas | Pengurangan |
|------------|------------|
| High | -10 |
| Medium | -5 |
| Low | -2 |

Jika status keluhan berubah menjadi **Selesai**, maka potongan skor dikurangi sebesar **50%**.

Contoh:

```
High (Pending)
100 - 10 = 90

Status berubah menjadi Selesai

90 + 5 = 95
```

Skor minimum adalah **0**.

---

## 🛠 Tech Stack

### Backend

- Laravel 10
- PHP 8.3
- Filament v3

### Frontend

- Blade
- Livewire
- HTML
- CSS

### Database

- MariaDB 10.11

### DevOps

- Docker
- Nginx
- Git
- GitHub

---

## 🏗 Arsitektur Sistem

Project menggunakan arsitektur **3-Tier Architecture**

```
Client
     │
     ▼
Laravel + Filament
     │
     ▼
MariaDB Database
```

---

## 📂 Modul Sistem

### Authentication

- Login
- Logout
- Session Management
- Role Authorization

### Division Management

- Create Division
- Update Division
- Delete Division
- List Division

### Employee Management

- CRUD Karyawan
- Skor Awal 100
- Status Karyawan

### Complaint Management

- Input Keluhan
- Prioritas
- Status
- Kategori
- History Status

### Performance Engine

Perhitungan otomatis menggunakan Eloquent Model Events.

Trigger ketika:

- Create Complaint
- Update Complaint
- Delete Complaint

---

## 📊 Dashboard

Dashboard menyediakan informasi berupa:

- Total Divisi
- Total Karyawan
- Total Keluhan
- Average Performance Score
- Grafik Keluhan
- Top Performing Division
- Lowest Employee Score

---

## 📄 Laporan

Generate laporan PDF berdasarkan:

- Bulan
- Divisi
- Karyawan

Output:

- Rekap Keluhan
- Skor Performa
- Statistik Evaluasi

---

## 📱 WhatsApp Integration

Sistem mendukung integrasi API WhatsApp untuk:

- Notifikasi karyawan dengan skor rendah
- Reminder tindak lanjut keluhan

---

## 🧪 Pengujian

Metode pengujian menggunakan:

- Black Box Testing
- User Acceptance Testing (UAT)

Hasil:

- ✅ 20 Test Case
- ✅ 100% PASS

---

## 🚀 Instalasi

Clone repository

```bash
git clone https://github.com/username/hris.git
```

Masuk ke folder project

```bash
cd hris
```

Copy environment

```bash
cp .env.example .env
```

Install dependency

```bash
composer install
```

Generate key

```bash
php artisan key:generate
```

Migrasi database

```bash
php artisan migrate --seed
```

Jalankan aplikasi

```bash
php artisan serve
```

---

## 🐳 Docker

Jalankan project menggunakan Docker

```bash
docker compose up -d
```

Stop container

```bash
docker compose down
```

---

## 📁 Struktur Project

```
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/
```

---

## 👨‍💻 Author

**Bani Adam**

Universitas Esa Unggul

Program Studi Teknik Informatika

Capstone Project 2025/2026

---

## 📚 Referensi

- Laravel Documentation
- Filament Documentation
- Docker Documentation
- MariaDB Documentation

---

## 📄 License

Project ini dikembangkan untuk kebutuhan akademik sebagai Capstone Project Universitas Esa Unggul.
