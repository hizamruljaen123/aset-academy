<div class="min-h-screen bg-gray-50">
    <!-- Chapter Header -->
    <section class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="<?= base_url('documentation') ?>" class="text-indigo-200 hover:text-white inline-flex items-center">
                                    <i data-feather="home" class="w-4 h-4 mr-2"></i>
                                    Dokumentasi
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i data-feather="chevron-right" class="w-4 h-4 text-indigo-200 mx-2"></i>
                                    <span class="text-white font-medium">Bab 6</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">Database dan SQL</h1>
                    <p class="text-xl text-indigo-100 max-w-3xl">Pengenalan database, query SQL dasar, dan manajemen data dengan MySQL dan PostgreSQL.</p>
                </div>
                <div class="hidden md:block">
                    <i data-feather="server" class="w-24 h-24 text-indigo-200 opacity-50"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Progress Indicator -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">Progress:</span>
                    <div class="w-32 bg-gray-200 rounded-full h-2">
                        <div class="bg-indigo-600 h-2 rounded-full" style="width: 60%"></div>
                    </div>
                    <span class="text-sm text-gray-600">Bab 6 dari 10</span>
                </div>
                <div class="flex space-x-2">
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-sm rounded-full">Pemula</span>
                    <span class="px-3 py-1 bg-teal-100 text-teal-800 text-sm rounded-full">30-35 menit</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h3 class="font-semibold text-gray-900 mb-4">Daftar Isi</h3>
                    <nav class="space-y-2">
                        <a href="#pengenalan-database" class="block text-sm text-gray-600 hover:text-indigo-600 py-1">6.1 Pengenalan Database</a>
                        <a href="#mysql-basics" class="block text-sm text-gray-600 hover:text-indigo-600 py-1">6.2 MySQL - Dasar</a>
                        <a href="#sql-queries" class="block text-sm text-gray-600 hover:text-indigo-600 py-1">6.3 Query SQL Dasar</a>
                        <a href="#crud-operations" class="block text-sm text-gray-600 hover:text-indigo-600 py-1">6.4 Operasi CRUD</a>
                        <a href="#relationships" class="block text-sm text-gray-600 hover:text-indigo-600 py-1">6.5 Relasi Tabel</a>
                        <a href="#praktik-database" class="block text-sm text-gray-600 hover:text-indigo-600 py-1">6.6 Praktik Database</a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3 space-y-12">
                <!-- Section 6.1 -->
                <section id="pengenalan-database" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-indigo-100 text-indigo-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">6.1</span>
                        Pengenalan Database
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Database adalah kumpulan data yang terorganisasi dan dapat diakses dengan mudah. Database modern menggunakan sistem manajemen database (DBMS) untuk mengelola data secara efisien.
                        </p>

                        <div class="bg-indigo-50 border-l-4 border-indigo-500 p-6 mb-6">
                            <h4 class="font-semibold text-indigo-900 mb-2">Jenis-jenis Database</h4>
                            <ul class="list-disc list-inside text-indigo-800 space-y-1">
                                <li><strong>Relational Database:</strong> Berbasis tabel (MySQL, PostgreSQL, Oracle)</li>
                                <li><strong>NoSQL Database:</strong> Non-relational (MongoDB, Redis, Cassandra)</li>
                                <li><strong>Graph Database:</strong> Berbasis graf (Neo4j, Amazon Neptune)</li>
                                <li><strong>Time Series Database:</strong> Data berbasis waktu (InfluxDB, TimescaleDB)</li>
                            </ul>
                        </div>

                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-gray-900 mb-4">Konsep Dasar Database</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-white rounded-lg p-4">
                                    <h5 class="font-semibold text-blue-900 mb-3">Database vs Spreadsheet</h5>
                                    <div class="space-y-2 text-sm text-gray-700">
                                        <div><strong>Spreadsheet:</strong></div>
                                        <ul class="list-disc list-inside ml-4 space-y-1">
                                            <li>Cocok untuk data kecil</li>
                                            <li>Manipulation manual</li>
                                            <li>Limitasi kolaborasi</li>
                                        </ul>
                                        <div><strong>Database:</strong></div>
                                        <ul class="list-disc list-inside ml-4 space-y-1">
                                            <li>Menangani data besar</li>
                                            <li>Query otomatis</li>
                                            <li>Multi-user support</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="bg-white rounded-lg p-4">
                                    <h5 class="font-semibold text-green-900 mb-3">Keuntungan Database</h5>
                                    <ul class="list-disc list-inside text-green-800 space-y-1">
                                        <li>Data consistency</li>
                                        <li>Data integrity</li>
                                        <li>Security & access control</li>
                                        <li>Backup & recovery</li>
                                        <li>Scalability</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 6.2 -->
                <section id="mysql-basics" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-indigo-100 text-indigo-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">6.2</span>
                        MySQL - Dasar
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            MySQL adalah sistem manajemen database relasional open source yang paling populer. Mari kita mulai dengan konsep dasar dan instalasi.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Instalasi MySQL</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Ubuntu/Debian</div>
                                    <div>sudo apt update</div>
                                    <div>sudo apt install mysql-server</div>
                                    <div>sudo mysql_secure_installation</div>
                                    <div></div>
                                    <div># Windows (XAMPP)</div>
                                    <div># Download XAMPP dari apachefriends.org</div>
                                    <div># Install dan jalankan MySQL dari XAMPP Control Panel</div>
                                    <div></div>
                                    <div># MacOS (Homebrew)</div>
                                    <div>brew install mysql</div>
                                    <div>brew services start mysql</div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Koneksi ke MySQL</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Login ke MySQL</div>
                                    <div>mysql -u root -p</div>
                                    <div></div>
                                    <div># Membuat database baru</div>
                                    <div>CREATE DATABASE belajar_db;</div>
                                    <div>USE belajar_db;</div>
                                    <div></div>
                                    <div># Membuat user baru</div>
                                    <div>CREATE USER 'user_baru'@'localhost' IDENTIFIED BY 'password123';</div>
                                    <div>GRANT ALL PRIVILEGES ON belajar_db.* TO 'user_baru'@'localhost';</div>
                                    <div>FLUSH PRIVILEGES;</div>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">Tipe Data MySQL</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-yellow-900 mb-2">Numeric Types</h5>
                                        <ul class="text-sm text-gray-700 space-y-1">
                                            <li><strong>INT:</strong> Bilangan bulat (-2.1M to 2.1M)</li>
                                            <li><strong>BIGINT:</strong> Bilangan bulat besar</li>
                                            <li><strong>DECIMAL:</strong> Bilangan desimal presisi tinggi</li>
                                            <li><strong>FLOAT/DOUBLE:</strong> Bilangan desimal</li>
                                        </ul>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-yellow-900 mb-2">String Types</h5>
                                        <ul class="text-sm text-gray-700 space-y-1">
                                            <li><strong>VARCHAR(n):</strong> String variabel (max n karakter)</li>
                                            <li><strong>CHAR(n):</strong> String tetap (n karakter)</li>
                                            <li><strong>TEXT:</strong> Teks panjang</li>
                                            <li><strong>DATE/DATETIME:</strong> Tanggal dan waktu</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 6.3 -->
                <section id="sql-queries" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-indigo-100 text-indigo-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">6.3</span>
                        Query SQL Dasar
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            SQL (Structured Query Language) adalah bahasa standar untuk berinteraksi dengan database relasional. Mari kita pelajari query dasar yang sering digunakan.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-purple-50 rounded-lg p-6">
                                <h4 class="font-semibold text-purple-900 mb-4">SELECT Statement</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>-- Select semua kolom</div>
                                    <div>SELECT * FROM mahasiswa;</div>
                                    <div></div>
                                    <div>-- Select kolom tertentu</div>
                                    <div>SELECT nama, nim FROM mahasiswa;</div>
                                    <div></div>
                                    <div>-- Select dengan kondisi</div>
                                    <div>SELECT * FROM mahasiswa WHERE jurusan = 'Teknik Informatika';</div>
                                    <div></div>
                                    <div>-- Select dengan DISTINCT</div>
                                    <div>SELECT DISTINCT jurusan FROM mahasiswa;</div>
                                    <div></div>
                                    <div>-- Select dengan alias</div>
                                    <div>SELECT nama AS 'Nama Lengkap', nim AS 'Nomor Induk' FROM mahasiswa;</div>
                                </div>
                            </div>

                            <div class="bg-pink-50 rounded-lg p-6">
                                <h4 class="font-semibold text-pink-900 mb-4">WHERE Clause</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>-- Operator perbandingan</div>
                                    <div>SELECT * FROM mahasiswa WHERE umur > 20;</div>
                                    <div>SELECT * FROM mahasiswa WHERE ipk >= 3.5;</div>
                                    <div>SELECT * FROM mahasiswa WHERE nim = '123456';</div>
                                    <div></div>
                                    <div>-- Operator logika</div>
                                    <div>SELECT * FROM mahasiswa WHERE jurusan = 'TI' AND umur > 20;</div>
                                    <div>SELECT * FROM mahasiswa WHERE jurusan = 'TI' OR jurusan = 'SI';</div>
                                    <div>SELECT * FROM mahasiswa WHERE NOT jurusan = 'TI';</div>
                                    <div></div>
                                    <div>-- Operator LIKE</div>
                                    <div>SELECT * FROM mahasiswa WHERE nama LIKE 'A%';</div>
                                    <div>SELECT * FROM mahasiswa WHERE nama LIKE '%i';</div>
                                    <div>SELECT * FROM mahasiswa WHERE nama LIKE '%an%';</div>
                                </div>
                            </div>

                            <div class="bg-indigo-50 rounded-lg p-6">
                                <h4 class="font-semibold text-indigo-900 mb-4">Aggregation Functions</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>-- Count</div>
                                    <div>SELECT COUNT(*) FROM mahasiswa;</div>
                                    <div>SELECT COUNT(DISTINCT jurusan) FROM mahasiswa;</div>
                                    <div></div>
                                    <div>-- Sum, Average, Min, Max</div>
                                    <div>SELECT SUM(ipk) FROM mahasiswa;</div>
                                    <div>SELECT AVG(ipk) FROM mahasiswa;</div>
                                    <div>SELECT MIN(ipk) FROM mahasiswa;</div>
                                    <div>SELECT MAX(ipk) FROM mahasiswa;</div>
                                    <div></div>
                                    <div>-- Group By</div>
                                    <div>SELECT jurusan, COUNT(*) FROM mahasiswa GROUP BY jurusan;</div>
                                    <div>SELECT jurusan, AVG(ipk) FROM mahasiswa GROUP BY jurusan;</div>
                                    <div></div>
                                    <div>-- Having</div>
                                    <div>SELECT jurusan, COUNT(*) FROM mahasiswa GROUP BY jurusan HAVING COUNT(*) > 10;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 6.4 -->
                <section id="crud-operations" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-indigo-100 text-indigo-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">6.4</span>
                        Operasi CRUD
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            CRUD (Create, Read, Update, Delete) adalah operasi dasar yang dilakukan pada database. Mari kita pelajari implementasinya dalam berbagai bahasa pemrograman.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Create (INSERT)</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>-- Insert satu baris</div>
                                    <div>INSERT INTO mahasiswa (nim, nama, jurusan, umur, ipk)</div>
                                    <div>VALUES ('123456', 'Ahmad', 'Teknik Informatika', 21, 3.75);</div>
                                    <div></div>
                                    <div>-- Insert multiple baris</div>
                                    <div>INSERT INTO mahasiswa (nim, nama, jurusan, umur, ipk)</div>
                                    <div>VALUES</div>
                                    <div>('234567', 'Budi', 'Sistem Informasi', 20, 3.60),</div>
                                    <div>('345678', 'Cici', 'Teknik Informatika', 22, 3.85);</div>
                                    <div></div>
                                    <div>-- Insert dengan subquery</div>
                                    <div>INSERT INTO nilai (nim, mata_kuliah, nilai)</div>
                                    <div>SELECT nim, 'Basis Data', 85 FROM mahasiswa WHERE jurusan = 'TI';</div>
                                </div>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Update dan Delete</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>-- Update data</div>
                                    <div>UPDATE mahasiswa SET ipk = 3.80 WHERE nim = '123456';</div>
                                    <div></div>
                                    <div>-- Update multiple fields</div>
                                    <div>UPDATE mahasiswa SET umur = umur + 1, ipk = ipk + 0.1 WHERE jurusan = 'TI';</div>
                                    <div></div>
                                    <div>-- Delete data</div>
                                    <div>DELETE FROM mahasiswa WHERE nim = '234567';</div>
                                    <div></div>
                                    <div>-- Delete dengan kondisi kompleks</div>
                                    <div>DELETE FROM mahasiswa WHERE ipk < 2.5 AND umur > 25;</div>
                                    <div></div>
                                    <div>-- Important: Always use WHERE with DELETE!</div>
                                    <div>-- DELETE FROM mahasiswa; -- Ini menghapus SEMUA data!</div>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
  <h4 class="font-semibold text-yellow-900 mb-4">CRUD dalam PHP</h4>
  <pre class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm overflow-x-auto">
<code>&lt;?php
$koneksi = mysqli_connect("localhost", "root", "", "belajar_db");

// Create
$sql = "INSERT INTO mahasiswa (nim, nama, jurusan) VALUES ('123456', 'Ahmad', 'TI')";
if (mysqli_query($koneksi, $sql)) {
    echo "Data berhasil ditambahkan";
}

// Read
$sql = "SELECT * FROM mahasiswa";
$result = mysqli_query($koneksi, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['nama'] . " - " . $row['jurusan'];
}

// Update
$sql = "UPDATE mahasiswa SET jurusan = 'SI' WHERE nim = '123456'";
mysqli_query($koneksi, $sql);

// Delete
$sql = "DELETE FROM mahasiswa WHERE nim = '123456'";
mysqli_query($koneksi, $sql);
?&gt;</code>
  </pre>
</div>

                        </div>
                    </div>
                </section>

                <!-- Section 6.5 -->
                <section id="relationships" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-indigo-100 text-indigo-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">6.5</span>
                        Relasi Tabel
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Relasi antar tabel adalah konsep fundamental dalam database relasional yang memungkinkan kita untuk menghubungkan data dari berbagai tabel secara logis.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-orange-50 rounded-lg p-6">
                                <h4 class="font-semibold text-orange-900 mb-4">Jenis Relasi</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white rounded-lg p-4">
                                        <h5 class="font-semibold text-orange-900 mb-3 flex items-center">
                                            <i data-feather="users" class="w-5 h-5 mr-2"></i>
                                            One-to-Many
                                        </h5>
                                        <ul class="space-y-2 text-sm text-gray-700">
                                            <li>• Satu mahasiswa memiliki banyak nilai</li>
                                            <li>• Satu jurusan memiliki banyak mahasiswa</li>
                                            <li>• Satu dosen mengajar banyak mata kuliah</li>
                                            <li>• Implementasi: Foreign key di tabel "many"</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="bg-white rounded-lg p-4">
                                        <h5 class="font-semibold text-orange-900 mb-3 flex items-center">
                                            <i data-feather="user-check" class="w-5 h-5 mr-2"></i>
                                            One-to-One
                                        </h5>
                                        <ul class="space-y-2 text-sm text-gray-700">
                                            <li>• Satu mahasiswa memiliki satu profil</li>
                                            <li>• Satu user memiliki satu setting</li>
                                            <li>• Satu order memiliki satu invoice</li>
                                            <li>• Implementasi: Foreign key di salah satu tabel</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-teal-50 rounded-lg p-6">
                                <h4 class="font-semibold text-teal-900 mb-4">Many-to-Many Relationship</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>-- Tabel mahasiswa</div>
                                    <div>CREATE TABLE mahasiswa (</div>
                                    <div>    nim VARCHAR(20) PRIMARY KEY,</div>
                                    <div>    nama VARCHAR(100) NOT NULL,</div>
                                    <div>    jurusan VARCHAR(50)</div>
                                    <div>);</div>
                                    <div></div>
                                    <div>-- Tabel mata_kuliah</div>
                                    <div>CREATE TABLE mata_kuliah (</div>
                                    <div>    kode_mk VARCHAR(10) PRIMARY KEY,</div>
                                    <div>    nama_mk VARCHAR(100) NOT NULL,</div>
                                    <div>    sks INT</div>
                                    <div>);</div>
                                    <div></div>
                                    <div>-- Tabel pivot untuk many-to-many</div>
                                    <div>CREATE TABLE mahasiswa_mk (</div>
                                    <div>    nim VARCHAR(20),</div>
                                    <div>    kode_mk VARCHAR(10),</div>
                                    <div>    semester VARCHAR(20),</div>
                                    <div>    PRIMARY KEY (nim, kode_mk),</div>
                                    <div>    FOREIGN KEY (nim) REFERENCES mahasiswa(nim),</div>
                                    <div>    FOREIGN KEY (kode_mk) REFERENCES mata_kuliah(kode_mk)</div>
                                    <div>);</div>
                                </div>
                            </div>

                            <div class="bg-red-50 rounded-lg p-6">
                                <h4 class="font-semibold text-red-900 mb-4">JOIN Operations</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>-- INNER JOIN</div>
                                    <div>SELECT m.nama, j.nama_jurusan</div>
                                    <div>FROM mahasiswa m</div>
                                    <div>INNER JOIN jurusan j ON m.kode_jurusan = j.kode_jurusan;</div>
                                    <div></div>
                                    <div>-- LEFT JOIN</div>
                                    <div>SELECT m.nama, j.nama_jurusan</div>
                                    <div>FROM mahasiswa m</div>
                                    <div>LEFT JOIN jurusan j ON m.kode_jurusan = j.kode_jurusan;</div>
                                    <div></div>
                                    <div>-- RIGHT JOIN</div>
                                    <div>SELECT m.nama, j.nama_jurusan</div>
                                    <div>FROM mahasiswa m</div>
                                    <div>RIGHT JOIN jurusan j ON m.kode_jurusan = j.kode_jurusan;</div>
                                    <div></div>
                                    <div>-- FULL OUTER JOIN (MySQL syntax)</div>
                                    <div>SELECT m.nama, j.nama_jurusan</div>
                                    <div>FROM mahasiswa m</div>
                                    <div>LEFT JOIN jurusan j ON m.kode_jurusan = j.kode_jurusan</div>
                                    <div>UNION</div>
                                    <div>SELECT m.nama, j.nama_jurusan</div>
                                    <div>FROM mahasiswa m</div>
                                    <div>RIGHT JOIN jurusan j ON m.kode_jurusan = j.kode_jurusan;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 6.6 -->
                <section id="praktik-database" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-indigo-100 text-indigo-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">6.6</span>
                        Praktik Database
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Praktik terbaik dalam pengelolaan database sangat penting untuk memastikan data aman, konsisten, dan performa yang optimal.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="font-semibold text-gray-900 mb-4">Best Practices</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white rounded-lg p-4">
                                        <h5 class="font-semibold text-gray-900 mb-3 flex items-center">
                                            <i data-feather="shield" class="w-5 h-5 mr-2"></i>
                                            Security Practices
                                        </h5>
                                        <ul class="space-y-2 text-sm text-gray-700">
                                            <li>• Gunakan prepared statements</li>
                                            <li>• Validasi input user</li>
                                            <li>• Batasi hak akses user</li>
                                            <li>• Enkripsi data sensitif</li>
                                            <li>• Backup data secara berkala</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="bg-white rounded-lg p-4">
                                        <h5 class="font-semibold text-gray-900 mb-3 flex items-center">
                                            <i data-feather="zap" class="w-5 h-5 mr-2"></i>
                                            Performance Optimization
                                        </h5>
                                        <ul class="space-y-2 text-sm text-gray-700">
                                            <li>• Index kolom yang sering diquery</li>
                                            <li>• Hindari SELECT *</li>
                                            <li>• Gunakan LIMIT untuk pagination</li>
                                            <li>• Optimalkan query JOIN</li>
                                            <li>• Monitor query yang lambat</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Database Design Patterns</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>-- Normalisasi Database</div>
                                    <div>-- 1NF: Setiap kolom harus atomic</div>
                                    <div>-- 2NF: Memenuhi 1NF + no partial dependency</div>
                                    <div>-- 3NF: Memenuhi 2NF + no transitive dependency</div>
                                    <div></div>
                                    <div>-- Contoh normalisasi</div>
                                    <div>-- Sebelum normalisasi (1NF violation)</div>
                                    <div>CREATE TABLE mahasiswa (</div>
                                    <div>    id INT PRIMARY KEY,</div>
                                    <div>    nama VARCHAR(100),</div>
                                    <div>    alamat VARCHAR(200),</div>
                                    <div>    telepon VARCHAR(20),</div>
                                    <div>    email VARCHAR(100)</div>
                                    <div>);</div>
                                    <div></div>
                                    <div>-- Setelah normalisasi (3NF)</div>
                                    <div>CREATE TABLE mahasiswa (</div>
                                    <div>    id INT PRIMARY KEY,</div>
                                    <div>    nama VARCHAR(100),</div>
                                    <div>    alamat_id INT,</div>
                                    <div>    FOREIGN KEY (alamat_id) REFERENCES alamat(id)</div>
                                    <div>);</div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
  <h4 class="font-semibold text-green-900 mb-4">Transaction Management</h4>
  <pre class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm overflow-x-auto">
<code>-- Contoh transaction dalam PHP
&lt;?php
$koneksi-&gt;begin_transaction();

try {
    // Transfer saldo
    $koneksi-&gt;query("UPDATE rekening SET saldo = saldo - 1000 WHERE no_rekening = 'A123'");
    $koneksi-&gt;query("UPDATE rekening SET saldo = saldo + 1000 WHERE no_rekening = 'B456'");

    // Log transaksi
    $koneksi-&gt;query("INSERT INTO transaksi (from_rek, to_rek, amount) VALUES ('A123', 'B456', 1000)");

    $koneksi-&gt;commit();
    echo "Transfer berhasil!";
} catch (Exception $e) {
    $koneksi-&gt;rollback();
    echo "Transfer gagal: " . $e-&gt;getMessage();
}
?&gt;</code>
  </pre>
</div>

                        </div>
                    </div>
                </section>

                <!-- Navigation -->
                <div class="flex justify-between items-center bg-white rounded-lg shadow-md p-6">
                    <div>
                        <a href="<?= base_url('documentation/chapter5') ?>" class="text-gray-600 hover:text-gray-800 flex items-center">
                            <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                            Kembali ke Bab 5
                        </a>
                    </div>
                    <div class="text-center">
                        <span class="text-sm text-gray-500">Bab 6 dari 10</span>
                        <div class="flex space-x-1 mt-1">
                            <div class="w-3 h-3 bg-indigo-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-indigo-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-indigo-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-indigo-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-indigo-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-indigo-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                        </div>
                    </div>
                    <div>
                        <a href="<?= base_url('documentation/chapter7') ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg flex items-center">
                            Lanjut ke Bab 7
                            <i data-feather="arrow-right" class="w-4 h-4 ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Initialize Feather Icons -->
    <script>
        feather.replace();
    </script>