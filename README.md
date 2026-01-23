# 🚀 KarirKu - Modern Job Portal Application

<img width="1352" height="534" alt="Image" src="https://github.com/user-attachments/assets/efe04c02-6ade-4418-a224-0342ca2acef9" />

## 📖 Tentang Aplikasi

**KarirKu** adalah sebuah platform portal lowongan kerja berbasis web yang menghubungkan talenta terbaik dengan perusahaan impian mereka. Aplikasi ini dirancang untuk memfasilitasi tiga peran utama: Pelamar Kerja (Candidate), Perusahaan (Employer), dan Administrator.

Dibangun dengan arsitektur MVC yang kokoh menggunakan **Laravel** dan didukung oleh antarmuka modern **Tailwind CSS**, KarirKu menawarkan pengalaman pengguna yang responsif, cepat, dan intuitif.

Salah satu fitur unik di panel Admin adalah sistem _Teaser Statistik_ (Paywall UI) yang mensimulasikan fitur premium terkunci dengan pendekatan yang kreatif dan interaktif.

## 🛠️ Tech Stack (Teknologi yang Digunakan)

Aplikasi ini dikembangkan menggunakan teknologi industri terkini:

- **Backend Framework:** [Laravel 10.x](https://laravel.com) (PHP)
- **Frontend Templating:** Laravel Blade
- **Styling & UI:** [Tailwind CSS](https://tailwindcss.com)
- **Database:** MySQL
- **JavaScript:** Alpine.js (untuk interaksi ringan)
- **Icon Set:** Heroicons & SVG
- **Version Control:** Git

## ✨ Fitur Utama

### 👨‍💼 Super Admin

- **Manajemen User:** Melihat, mengedit, dan membuat user baru (Employer/Candidate).
- **Dashboard Statistik:** Tampilan analitik dengan UI _Glassmorphism_ dan fitur _Locked Content_ (Teaser).
- **Kontrol Akses:** Mengelola hak akses pengguna.

### 🏢 Employer (Perusahaan)

- **Posting Lowongan:** Membuat dan mempublikasikan lowongan pekerjaan.
- **Manajemen Profil:** Mengatur logo, deskripsi, dan alamat perusahaan.
- **Kelola Pelamar:** Melihat daftar pelamar yang masuk untuk setiap lowongan.

### 👨‍💻 Candidate (Pelamar)

- **Pencarian Kerja:** Mencari lowongan berdasarkan kategori atau lokasi.
- **Apply Job:** Melamar pekerjaan dengan mengunggah CV.
- **Riwayat Lamaran:** Memantau status lamaran yang telah dikirim.

---

## 💻 Panduan Instalasi (Local Development)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal Anda.

### Prasyarat

Pastikan Anda telah menginstal:

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL Database

### Langkah 1: Clone Repository

```bash
git clone [https://github.com/username-anda/karirku.git](https://github.com/username-anda/karirku.git)
cd karirku
```

### Langkah 2: Clone Repository

Install paket PHP (Laravel) dan JavaScript (Tailwind):

```bash
composer install
npm install
```

### Langkah 3: Konfigurasi Environment

```bash
cp .env.example .env
```

Buka file .env dan sesuaikan konfigurasi database Anda : 

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=job_portal
DB_USERNAME=root
DB_PASSWORD=
```

### Langkah 4: Generate Application Key

```bash
php artisan key:generate
```

### Langkah 5: Setup Database

```bash
php artisan migrate --seed
```

### Langkah 6: Jalankan Aplikasi

Terminal 1

```bash
npm run dev
```

Terminal 2

```bash
php artisan serve
```

Akses aplikasi melalui browser di: http://localhost:8000

---

## 🔐 Akun Demo (Seeder)

Jika menjalankan seeder, dapat menggunakan akun berikut untuk login:

<img width="390" height="141" alt="Image" src="https://github.com/user-attachments/assets/a274d041-e229-41a8-a999-7a73dedc2a59" />

---

## 📊 Flowchart Sistem 

<img width="2092" height="2420" alt="Image" src="https://github.com/user-attachments/assets/e8e941b4-bc74-4044-873b-192b836960cc" />

---

## 🗂️ Struktur Database (ERD)

<img width="2092" height="1099" alt="image" src="https://github.com/user-attachments/assets/23c2d426-141f-494f-b6c9-a04e2c0cb87c" />


---

## 🔌 API Documentation

Aplikasi KarirKu menyediakan **RESTful API** yang dapat digunakan untuk integrasi dengan aplikasi mobile (Android/iOS) atau layanan pihak ketiga. Sistem autentikasi menggunakan **Laravel Sanctum** (Bearer Token).

### Header Request
Setiap request ke endpoint yang diproteksi harus menyertakan header berikut:

```http
Accept: application/json
Authorization: Bearer <your_access_token>
```

### Daftar Endpoint Utama

<img width="527" height="311" alt="Image" src="https://github.com/user-attachments/assets/6ddb85c2-8ca4-44b4-91aa-3b4e6588dce4" />

### Cara Testing API (Postman/Insomnia)

- Lakukan request POST ke /api/login dengan body email & password.

- Salin token yang dikembalikan oleh response JSON.

- Gunakan token tersebut di tab Authorization > pilih tipe Bearer Token pada request selanjutnya.

---

## 📝 Lisensi

Proyek ini bersifat open-source di bawah lisensi MIT

---

<p align="center"> Dibuat dengan ❤️ oleh Alfdhiw </p>









