# Asset Academy - Comprehensive Learning Management System

Aplikasi web modern untuk manajemen kursus online, dibangun dengan CodeIgniter 3, PHP 8, dan Tailwind CSS. Platform lengkap yang menyediakan pengalaman belajar programming dari tingkat pemula hingga mahir.

## Fitur Utama

### Halaman Publik
- **Homepage Dinamis**: Kelas premium, gratis, testimoni, dan workshop terdekat
- **Kelas Programming**: Katalog premium & gratis dengan detail instruktur dan materi
- **Workshop & Seminar**: Event pembelajaran dengan sistem pendaftaran online
- **Corporate Solutions**: Partnership, corporate training, dan digital solutions untuk UMKM
- **Contact & Support**: Sistem kontak terintegrasi dengan WhatsApp
- **Mobile App**: Dukungan aplikasi Android dengan pengalaman optimal

### Sistem Otentikasi
- **Multi-Role System**: Admin, Teacher, Student dengan role-based access
- **Secure Authentication**: Session management dan password security
- **Profile Management**: Sistem pengelolaan profil lengkap

### Dashboard Admin
- **User Management**: CRUD semua pengguna (siswa, guru, admin)
- **Content Management**: Kelas, workshop, forum, dan materi
- **Payment Verification**: Verifikasi transaksi dan manajemen pembayaran
- **Analytics Dashboard**: Statistik platform dan performa
- **System Administration**: Moderasi forum, assignment oversight, attendance monitoring

### Dashboard Siswa
- **Learning Portal**: Enrollment kelas premium & gratis
- **Progress Tracking**: Monitoring kemajuan belajar dan sertifikat
- **Assignment System**: Pengumpulan dan penilaian tugas
- **Forum Participation**: Diskusi interaktif dengan komunitas
- **Payment Integration**: Sistem pembayaran untuk kelas premium

### Dashboard Guru
- **Class Management**: Pengelolaan kelas dengan siswa dan materi
- **Material Upload**: Sistem upload dan organisasi konten pembelajaran
- **Assignment Creation**: Pembuatan dan grading tugas
- **Attendance Tracking**: Pencatatan kehadiran dengan QR code
- **Student Analytics**: Monitoring performa dan progress siswa

### Payment & Transaction
- **Premium Enrollment**: Pembayaran kelas dengan multiple bank support
- **Transaction Management**: History, verification, dan refund system
- **Invoice Generation**: Sistem invoice otomatis

### Forum Diskusi
- **Category-based Forum**: Organisasi diskusi berdasarkan topik
- **Thread Management**: Reply system dengan nested discussion
- **Moderation Tools**: Admin controls untuk content management

### Learning Management
- **Material Organization**: Sistem modul dengan progress tracking
- **Assignment System**: Creation, submission, dan grading workflow
- **Certificate Generation**: Sertifikat otomatis setelah completion

### Workshop Management
- **Event Creation**: CRUD workshop dengan detail lengkap
- **Participant Registration**: Sistem pendaftaran dengan tracking
- **Material Distribution**: Upload dan distribusi materi event

### Analytics & Monitoring
- **User Statistics**: Analytics berdasarkan role dan aktivitas
- **Course Performance**: Tracking completion dan engagement
- **Revenue Reports**: Financial analytics untuk admin

## Struktur Database

Database utama `academy_lite` dengan tabel core:
- `users`, `siswa` - User management
- `kelas_programming`, `free_classes` - Course content
- `workshops`, `workshop_participants` - Event management
- `forum_*` tables - Discussion system
- `payments`, `assignments` - Transaction & learning tools
- `absensi`, `enrollments` - Attendance & enrollment tracking

## Instalasi & Setup

### Prasyarat
- PHP 8.0+, MySQL 5.7+, Web Server, Composer

### Langkah Instalasi
1. **Clone & Setup**: `git clone <repo> && cd aset-academy`
2. **Database Config**: Setup `academy_lite` di `application/config/database.php`
3. **Base URL**: Configure di `application/config/config.php`
4. **Dependencies**: `composer install && npm install`
5. **Migration**: Akses `/index.php/migrate` atau import SQL files
6. **Assets**: `npm run build`
7. **Launch**: Akses homepage dan login admin

## Arsitektur Aplikasi

```
application/
├── controllers/          # Business logic
│   ├── Home.php         # Public pages
│   ├── Auth.php         # Authentication
│   ├── admin/           # Admin features
│   ├── student/         # Student features
│   └── teacher/         # Teacher features
├── models/              # Data access layer
├── views/               # Presentation layer
└── config/              # Configuration files
```

## Teknologi Stack
- **Backend**: CodeIgniter 3.1.13, PHP 8+
- **Frontend**: Tailwind CSS, Alpine.js
- **Database**: MySQL/MariaDB
- **Mobile**: Android App (APK included)

## Support & Contact
- **Email**: support@asetacademy.id
- **WhatsApp**: +62 896-7601-8562
- **Website**: [asetacademy.id](https://asetacademy.id)

## Lisensi
[MIT License](LICENSE) - Asset Academy  2024