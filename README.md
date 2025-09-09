# Asset Academy - Learning Management System

Aplikasi web modern untuk manajemen kursus online, dibangun dengan CodeIgniter 3, PHP 8, dan Tailwind CSS. Aplikasi ini menyediakan halaman landing yang dinamis dan sistem otentikasi.

## Fitur Utama

### Halaman Publik
- **Homepage Dinamis**: Menampilkan kelas premium, kelas gratis, dan testimoni siswa yang diambil dari database.
- **Halaman Kelas**: Halaman terpisah untuk menelusuri kelas premium dan kelas gratis.
- **Halaman Statis**: Halaman 'Tentang Kami' dan 'FAQ' dengan desain modern.
- **Desain Responsif**: Tampilan yang dioptimalkan untuk semua perangkat menggunakan Tailwind CSS.
- **Arsitektur Modular**: Menggunakan sistem template (header, navbar, footer) untuk kemudahan maintenance.

### Sistem Otentikasi
- **Login & Registrasi**: Halaman untuk pengguna masuk dan mendaftar.
- **Branding Konsisten**: Halaman otentikasi yang sesuai dengan branding "Asset Academy".

### Backend (Fitur yang Sudah Ada)
- **Manajemen Siswa**: Operasi CRUD untuk data siswa.
- **Manajemen Kelas**: Operasi CRUD untuk kelas programming.
- **Dashboard Admin**: (Asumsi) Terdapat dashboard untuk admin mengelola konten.

## Struktur Database

Database utama adalah `academy_lite`. Tabel-tabel penting yang digunakan:

- `kelas_programming`: Menyimpan detail kelas premium.
- `free_classes`: Menyimpan detail kelas gratis.
- `testimonials`: Menyimpan testimoni dari siswa.
- `users`: (Asumsi) Untuk otentikasi dan data pengguna.
- `siswa`: Untuk data siswa yang terdaftar di kelas.

## Instalasi & Setup

### Prasyarat
- PHP 8.0+
- MySQL 5.7+ atau MariaDB 10.2+
- Web Server (Contoh: Apache, Nginx, atau Laragon)
- Composer

### Langkah-langkah Instalasi

1.  **Clone Repository**
    ```bash
    git clone <url-repository-anda> aset-academy
    cd aset-academy
    ```

2.  **Konfigurasi Database**
    - Buat database baru di MySQL (misalnya, `academy_lite`).
    - Buka file `application/config/database.php` dan sesuaikan dengan konfigurasi database Anda:
      ```php
      'hostname' => 'localhost',
      'username' => 'root',
      'password' => '', // Sesuaikan dengan password Anda
      'database' => 'academy_lite',
      ```

3.  **Konfigurasi Base URL**
    - Buka file `application/config/config.php`.
    - Atur `base_url` sesuai dengan environment lokal Anda. Jika menggunakan Laragon, URL-nya mungkin seperti ini:
      ```php
      $config['base_url'] = 'http://aset-academy.test/';
      ```

4.  **Jalankan Migrasi Database**
    - CodeIgniter 3 menggunakan sistem migrasi untuk mengelola skema database. Untuk menjalankan migrasi terbaru:
    - Buka browser dan akses URL: `http://aset-academy.test/index.php/migrate`
    - Ini akan membuat tabel yang diperlukan seperti `testimonials`.

5.  **Impor Data Awal (Jika Ada)**
    - Impor file SQL yang berisi data awal (seperti `database.sql` atau file dummy data lainnya) ke database `academy_lite` Anda melalui phpMyAdmin atau command line.

6.  **Jalankan Aplikasi**
    - Buka `http://aset-academy.test/` di browser Anda untuk melihat halaman utama.

## Struktur Direktori Penting

```
aset-academy/
├── application/
│   ├── controllers/
│   │   ├── Home.php         # Controller untuk halaman publik
│   │   ├── Auth.php         # Controller untuk otentikasi
│   │   └── Migrate.php      # Controller untuk migrasi DB
│   ├── models/
│   │   ├── Kelas_model.php
│   │   ├── Free_class_model.php
│   │   └── Testimonial_model.php
│   ├── views/
│   │   ├── home/
│   │   │   ├── index.php      # Halaman utama
│   │   │   ├── premium.php
│   │   │   ├── free.php
│   │   │   ├── about.php
│   │   │   ├── faq.php
│   │   │   └── templates/     # Template modular
│   │   │       ├── _header.php
│   │   │       ├── _navbar.php
│   │   │       └── _footer.php
│   │   └── auth/
│   │       ├── login.php
│   │       └── register.php
│   ├── config/
│   │   ├── routes.php
│   │   └── database.php
│   └── migrations/
│       └── ..._create_testimonials_table.php
├── db/
│   └── database.sql         # Skema & data awal
└── assets/
    ├── css/
    └── js/
```

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).