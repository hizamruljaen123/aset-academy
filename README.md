# Aplikasi Pendataan Siswa Academy Lite

Aplikasi CRUD sederhana untuk pendataan siswa peserta kelas coding online menggunakan CodeIgniter 3.13 dengan PHP 8 dan MySQL.

## Fitur

### Fitur Siswa
- **Create**: Menambah data siswa baru
- **Read**: Menampilkan daftar siswa dan detail siswa
- **Update**: Mengedit data siswa yang sudah ada
- **Delete**: Menghapus data siswa
- **Search**: Mencari siswa berdasarkan nama, NIS, kelas, atau jurusan
- **Validasi Form**: Validasi input data siswa
- **Responsive Design**: Tampilan yang responsif menggunakan Bootstrap 5

### Fitur Kelas Programming
- **Create**: Menambah kelas programming baru
- **Read**: Menampilkan daftar kelas dan detail kelas
- **Update**: Mengedit kelas yang sudah ada
- **Delete**: Menghapus kelas
- **Filter by Level**: Menampilkan kelas berdasarkan level (Dasar, Menengah, Lanjutan)
- **Filter by Bahasa**: Menampilkan kelas berdasarkan bahasa program

## Struktur Database

Aplikasi menggunakan database MySQL dengan nama `academy_lite` dan dua tabel utama:

### Tabel: `siswa`

| Field | Type | Description |
|-------|------|-------------|
| id | INT(11) | Primary key, auto increment |
| nis | VARCHAR(20) | Nomor Induk Siswa, unique |
| nama_lengkap | VARCHAR(100) | Nama lengkap siswa |
| email | VARCHAR(100) | Email siswa |
| no_telepon | VARCHAR(15) | Nomor telepon siswa |
| kelas | VARCHAR(100) | Nama kelas programming |
| jurusan | VARCHAR(50) | Jurusan siswa |
| alamat | TEXT | Alamat siswa |
| tanggal_lahir | DATE | Tanggal lahir siswa |
| jenis_kelamin | ENUM('L', 'P') | Jenis kelamin (Laki-laki/Perempuan) |
| status | ENUM('Aktif', 'Tidak Aktif', 'Lulus') | Status siswa |
| created_at | TIMESTAMP | Waktu pembuatan record |
| updated_at | TIMESTAMP | Waktu update record |

### Tabel: `kelas_programming`

| Field | Type | Description |
|-------|------|-------------|
| id | INT(11) | Primary key, auto increment |
| nama_kelas | VARCHAR(100) | Nama kelas programming, unique |
| deskripsi | TEXT | Deskripsi kelas |
| level | ENUM('Dasar', 'Menengah', 'Lanjutan') | Level kelas |
| bahasa_program | VARCHAR(50) | Bahasa program yang diajarkan |
| durasi | INT(11) | Durasi kelas dalam jam |
| harga | DECIMAL(10,2) | Harga kelas |
| status | ENUM('Aktif', 'Tidak Aktif') | Status kelas |
| created_at | TIMESTAMP | Waktu pembuatan record |
| updated_at | TIMESTAMP | Waktu update record |

## Data Dummy

Aplikasi dilengkapi dengan data dummy untuk kelas programming dan siswa:

### Kelas Programming yang Tersedia:
- Web Programming Dasar (HTML/CSS/JS)
- JavaScript & PHP Dasar
- React.js Dasar
- Laravel Framework
- Node.js & Express
- Python Django
- Vue.js Advanced
- API Development
- Mobile App Development
- DevOps & Deployment

### Data Siswa Dummy:
30 data siswa dengan berbagai kelas programming dan jurusan yang berbeda.

## Instalasi

### Prasyarat

- PHP 8.0 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- CodeIgniter 3.13
- Web server (Apache/Nginx)

### Langkah-langkah

1. **Clone atau Download Repository**
   ```bash
   git clone <repository-url>
   ```

2. **Impor Database**
   - Buat database MySQL dengan nama `academy_lite`
   - Impor file `database.sql` ke dalam database

3. **Konfigurasi Database**
   - Edit file `application/config/database.php`
   - Sesuaikan setting database:
     ```php
     $db['default'] = array(
         'hostname' => 'localhost',
         'username' => 'root',
         'password' => '',
         'database' => 'academy_lite',
         'dbdriver' => 'mysqli',
         'dbprefix' => '',
         'pconnect' => FALSE,
         'db_debug' => (ENVIRONMENT !== 'production'),
         'cache_on' => FALSE,
         'cachedir' => '',
         'char_set' => 'utf8mb4',
         'dbcollat' => 'utf8mb4_general_ci',
         'swap_pre' => '',
         'encrypt' => FALSE,
         'compress' => FALSE,
         'stricton' => FALSE,
         'failover' => array(),
         'save_queries' => TRUE
     );
     ```

4. **Konfigurasi Base URL**
   - Edit file `application/config/config.php`
   - Sesuaikan base URL sesuai dengan environment Anda:
     ```php
     $config['base_url'] = 'http://localhost/academy_lite/';
     ```

5. **Hak Akses File**
   - Pastikan folder `application/cache` dan `application/logs` memiliki hak akses write

6. **Jalankan Aplikasi**
   - Akses aplikasi melalui browser: `http://localhost/academy_lite/`

## Struktur Aplikasi

```
academy_lite/
├── application/
│   ├── controllers/
│   │   ├── Siswa.php          # Controller untuk CRUD siswa
│   │   └── Welcome.php
│   ├── models/
│   │   └── Siswa_model.php    # Model untuk data siswa
│   ├── views/
│   │   ├── siswa/
│   │   │   ├── index.php      # Halaman daftar siswa
│   │   │   ├── create.php     # Form tambah siswa
│   │   │   ├── edit.php       # Form edit siswa
│   │   │   └── detail.php     # Detail siswa
│   │   └── templates/
│   │       ├── header.php     # Template header
│   │       └── footer.php     # Template footer
│   └── config/
│       ├── database.php       # Konfigurasi database
│       └── routes.php         # Routing
├── database.sql               # File SQL untuk struktur database
├── index.php
└── system/
```

## Penggunaan

### 1. Menampilkan Daftar Siswa
- Akses: `http://localhost/academy_lite/siswa`
- Menampilkan semua data siswa dalam bentuk tabel
- Dilengkapi dengan fitur pencarian

### 2. Menambah Siswa
- Klik tombol "Tambah Siswa" pada halaman daftar
- Isi form dengan data siswa
- Klik "Simpan" untuk menyimpan data

### 3. Edit Siswa
- Klik tombol "Edit" pada baris data siswa yang ingin diedit
- Ubah data yang diperlukan
- Klik "Update" untuk menyimpan perubahan

### 4. Hapus Siswa
- Klik tombol "Hapus" pada baris data siswa yang ingin dihapus
- Konfirmasi penghapusan

### 5. Detail Siswa
- Klik tombol "Detail" untuk melihat informasi lengkap siswa

## Validasi Form

Aplikasi memiliki validasi form untuk setiap input:
- **NIS**: Wajib diisi dan harus unik
- **Nama Lengkap**: Wajib diisi
- **Email**: Wajib diisi, format email valid, dan harus unik
- **No Telepon**: Wajib diisi
- **Kelas**: Wajib diisi (X, XI, XII)
- **Jurusan**: Wajib diisi
- **Tanggal Lahir**: Wajib diisi
- **Jenis Kelamin**: Wajib diisi (L/P)
- **Status**: Wajib diisi (Aktif/Tidak Aktif/Lulus)

## Error Handling

- Error 404: Halaman tidak ditemukan
- Error database: Ditampilkan dalam mode development
- Validasi form: Pesan error ditampilkan di bawah setiap field

## Keamanan

- Validasi input form
- Protection against SQL injection (CodeIgniter Query Builder)
- XSS protection (CodeIgniter Security Class)

## Lisensi

[MIT License](LICENSE)

## Kontribusi

Silakan fork dan submit pull request untuk kontribusi.

## Contact

Untuk pertanyaan atau saran, silakan hubungi:
- Email: [your-email@example.com]
- GitHub: [your-github-username]