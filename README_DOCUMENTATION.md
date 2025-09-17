# Dokumentasi Teknologi Aset Academy

## 📚 Tentang Dokumentasi Ini

Dokumentasi ini adalah panduan lengkap dasar-dasar teknologi dan ilmu komputer yang dirancang khusus untuk pemula. Terdiri dari 10 bab komprehensif yang membahas berbagai aspek penting dalam dunia teknologi, dari konsep dasar komputer hingga pengembangan karier di bidang teknologi.

## 🎯 Target Audience

- **Pemula** yang ingin memulai perjalanan di dunia teknologi
- **Mahasiswa** yang membutuhkan referensi belajar
- **Career switchers** yang ingin pindah ke bidang teknologi
- **Pengajar** yang membutuhkan materi pembelajaran

## 📖 Daftar Isi

### Bab 1: Pengenalan Komputer dan Sistem Operasi
- ✅ Komponen hardware komputer
- ✅ Software dan sistem operasi
- ✅ Perintah dasar terminal/command prompt
- ✅ Tips memilih sistem operasi

### Bab 2: Dasar-dasar Jaringan Komputer
- ✅ Konsep jaringan komputer
- ✅ Topologi jaringan (Bus, Star, Ring)
- ✅ Protokol jaringan (TCP/IP, HTTP/HTTPS)
- ✅ IP Address dan DNS

### Bab 3: Pengenalan Pemrograman
- ✅ Konsep algoritma dan flowchart
- ✅ Variabel dan tipe data
- ✅ Struktur kontrol (if-else, loop)
- ✅ Pseudocode dan logika pemrograman

### Bab 4: Bahasa Pemrograman Dasar
- ✅ Perbandingan bahasa pemrograman
- ✅ Sintaks dasar Python, JavaScript, Java, PHP
- ✅ Contoh program sederhana
- ✅ Tips memilih bahasa pemrograman

### Bab 5: Struktur Data Dasar
- ✅ Array dan List
- ✅ Stack dan Queue
- ✅ Dictionary dan Map
- ✅ Tree dan Graph (dasar)

### Bab 6: Database dan SQL
- ✅ Konsep database relasional
- ✅ MySQL dan PostgreSQL
- ✅ Query SQL dasar (SELECT, INSERT, UPDATE, DELETE)
- ✅ Relasi antar tabel

### Bab 7: Web Development Dasar
- ✅ HTML, CSS, JavaScript
- ✅ Frontend vs Backend
- ✅ Framework web populer
- ✅ Responsive design

### Bab 8: Version Control dengan Git
- ✅ Konsep version control
- ✅ Git dan GitHub
- ✅ Branching dan merging
- ✅ Kolaborasi tim

### Bab 9: Security dan Best Practices
- ✅ Keamanan aplikasi web
- ✅ Validasi dan sanitasi input
- ✅ Enkripsi dan hashing
- ✅ OWASP Top 10

### Bab 10: Karier dan Pengembangan Diri
- ✅ Membangun portfolio
- ✅ Persiapan interview
- ✅ Skill development
- ✅ Networking dan komunitas

## 🚀 Cara Menggunakan Dokumentasi

### 1. Akses Halaman Utama
Buka browser dan akses:
```
http://localhost/aset-academy/documentation
```

### 2. Navigasi Antar Bab
- Gunakan menu navigasi di sidebar untuk berpindah antar bagian
- Setiap bab memiliki durasi estimasi belajar
- Progress bar menunjukkan seberapa jauh Anda telah belajar

### 3. Praktik Mandiri
- Setiap bab memiliki bagian "Praktik Mandiri" dengan tugas-tugas konkrit
- Cobalah semua contoh kode yang disediakan
- Jangan hanya membaca - praktikkan langsung!

### 4. Kode Contoh
Semua kode contoh dalam dokumentasi ini:
- ✅ Ditulis dalam bahasa Indonesia
- ✅ Dapat dicoba langsung
- ✅ Dilengkapi dengan penjelasan detail
- ✅ Mencakup berbagai bahasa pemrograman

## 🛠️ Fitur Utama

### 📱 Responsive Design
- Tampilan optimal di desktop, tablet, dan mobile
- Navigasi yang intuitif dan user-friendly

### 🎨 Professional UI
- Desain modern dengan gradient backgrounds
- Animasi smooth dengan AOS (Animate On Scroll)
- Icon dari Feather Icons

### 💻 Code Highlighting
- Syntax highlighting untuk kode program
- Berbagai bahasa pemrograman: Python, JavaScript, Java, PHP, SQL
- Copy-paste friendly

### 📊 Progress Tracking
- Progress bar untuk tracking belajar
- Indikator bab yang sudah diselesaikan
- Estimasi waktu belajar per bab

## 🎯 Tips Belajar Efektif

1. **Jangan Terburu-buru** - Nikmati proses belajar, jangan skip bagian yang sulit
2. **Praktik Terus** - Setiap kali melihat kode contoh, coba sendiri
3. **Buat Catatan** - Tulis poin-poin penting dalam buku catatan
4. **Join Komunitas** - Bergabung dengan komunitas programmer untuk diskusi
5. **Bangun Project** - Mulai buat project kecil setelah menyelesaikan beberapa bab

## 🔧 Teknologi yang Digunakan

- **Backend:** PHP dengan CodeIgniter 3
- **Frontend:** HTML5, CSS3, JavaScript
- **CSS Framework:** Tailwind CSS
- **Icons:** Feather Icons
- **Animations:** AOS (Animate On Scroll)
- **Code Highlighting:** Custom CSS untuk syntax highlighting

## 📁 Struktur File

```
application/
├── controllers/
│   └── Documentation.php          # Controller untuk semua halaman dokumentasi
├── views/
│   └── documentation/
│       ├── index.php             # Halaman utama dokumentasi
│       ├── chapter1.php          # Bab 1: Komputer dan Sistem Operasi
│       ├── chapter2.php          # Bab 2: Jaringan Komputer
│       ├── chapter3.php          # Bab 3: Pengenalan Pemrograman
│       ├── chapter4.php          # Bab 4: Bahasa Pemrograman
│       ├── chapter5.php          # Bab 5: Struktur Data
│       ├── chapter6.php          # Bab 6: Database dan SQL
│       ├── chapter7.php          # Bab 7: Web Development
│       ├── chapter8.php          # Bab 8: Version Control
│       ├── chapter9.php          # Bab 9: Security
│       └── chapter10.php         # Bab 10: Karier dan Pengembangan Diri
└── config/
    └── routes.php                # Routing untuk dokumentasi

assets/
└── css/
    └── documentation.css          # Styling khusus untuk halaman dokumentasi
```

## 🚀 Getting Started

### Prasyarat
- PHP 7.0 atau lebih tinggi
- MySQL/MariaDB (opsional untuk bab database)
- Web server (Apache/Nginx) atau XAMPP/WAMP

### Instalasi
1. Clone repository ini
2. Copy ke folder web server (htdocs, www, dll)
3. Import database jika diperlukan
4. Akses via browser: `http://localhost/aset-academy/documentation`

## 🤝 Kontribusi

Kami menyambut kontribusi dari komunitas! Silakan:
- Laporkan bug atau masalah
- Ajukan fitur baru
- Kirim pull request untuk perbaikan
- Berikan feedback dan saran

## 📞 Kontak

Untuk pertanyaan atau bantuan:
- Email: support@aset-academy.com
- Website: https://www.aset-academy.com
- Discord: [Join our Discord server]

## 📄 Lisensi

Dokumentasi ini adalah bagian dari Aset Academy dan dilisensikan di bawah MIT License.

---

**Selamat belajar! 🎉** 
Jangan lupa untuk praktik dan terus eksplorasi. Dunia teknologi sangat luas dan penuh dengan peluang. Semangat! 💪