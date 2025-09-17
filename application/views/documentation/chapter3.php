<div class="min-h-screen bg-gray-50">
    <!-- Chapter Header -->
    <section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="<?= base_url('documentation') ?>" class="text-green-200 hover:text-white inline-flex items-center">
                                    <i data-feather="home" class="w-4 h-4 mr-2"></i>
                                    Dokumentasi
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i data-feather="chevron-right" class="w-4 h-4 text-green-200 mx-2"></i>
                                    <span class="text-white font-medium">Bab 3</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">Pengenalan Pemrograman</h1>
                    <p class="text-xl text-green-100 max-w-3xl">Memahami konsep dasar pemrograman, algoritma, flowchart, dan logika pemrograman untuk pemula.</p>
                </div>
                <div class="hidden md:block">
                    <i data-feather="code" class="w-24 h-24 text-green-200 opacity-50"></i>
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
                        <div class="bg-green-600 h-2 rounded-full" style="width: 30%"></div>
                    </div>
                    <span class="text-sm text-gray-600">Bab 3 dari 10</span>
                </div>
                <div class="flex space-x-2">
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full">Pemula</span>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">25-30 menit</span>
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
                        <a href="#pengenalan-algoritma" class="block text-sm text-gray-600 hover:text-green-600 py-1">3.1 Pengenalan Algoritma</a>
                        <a href="#flowchart" class="block text-sm text-gray-600 hover:text-green-600 py-1">3.2 Flowchart dan Pseudocode</a>
                        <a href="#variabel-tipe-data" class="block text-sm text-gray-600 hover:text-green-600 py-1">3.3 Variabel dan Tipe Data</a>
                        <a href="#operator" class="block text-sm text-gray-600 hover:text-green-600 py-1">3.4 Operator dan Ekspresi</a>
                        <a href="#struktur-kontrol" class="block text-sm text-gray-600 hover:text-green-600 py-1">3.5 Struktur Kontrol</a>
                        <a href="#praktik-programming" class="block text-sm text-gray-600 hover:text-green-600 py-1">3.6 Praktik Programming</a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3 space-y-12">
                <!-- Section 3.1 -->
                <section id="pengenalan-algoritma" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">3.1</span>
                        Pengenalan Algoritma
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Algoritma adalah sekumpulan instruksi atau langkah-langkah sistematis untuk menyelesaikan suatu masalah atau mencapai tujuan tertentu. Dalam pemrograman, algoritma adalah fondasi dari setiap program yang kita buat.
                        </p>

                        <div class="bg-green-50 border-l-4 border-green-500 p-6 mb-6">
                            <h4 class="font-semibold text-green-900 mb-2">Ciri-ciri Algoritma yang Baik</h4>
                            <ul class="list-disc list-inside text-green-800 space-y-1">
                                <li><strong>Input:</strong> Memiliki 0 atau lebih input</li>
                                <li><strong>Output:</strong> Memiliki minimal 1 output</li>
                                <li><strong>Definiteness:</strong> Instruksi jelas dan tidak ambigu</li>
                                <li><strong>Finiteness:</strong> Berhenti setelah jumlah langkah terbatas</li>
                                <li><strong>Effectiveness:</strong> Efisien dan dapat dilakukan secara praktis</li>
                            </ul>
                        </div>

                        <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-gray-900 mb-4">Contoh Algoritma Sederhana: Membuat Kopi</h4>
                            <div class="bg-white rounded-lg p-4">
                                <ol class="list-decimal list-inside space-y-2 text-gray-700">
                                    <li>Siapkan gelas, kopi, gula, dan air panas</li>
                                    <li>Masukkan 1 sendok kopi ke dalam gelas</li>
                                    <li>Tambahkan gula sesuai selera (opsional)</li>
                                    <li>Tuang air panas ke dalam gelas</li>
                                    <li>Aduk sampai rata</li>
                                    <li>Kopi siap diminum</li>
                                </ol>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-gray-900 mb-4">Contoh Algoritma dalam Pemrograman: Menghitung Luas Persegi Panjang</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h5 class="font-medium text-gray-900 mb-2">Algoritma dalam Bahasa Indonesia:</h5>
                                    <ol class="list-decimal list-inside space-y-1 text-sm text-gray-700">
                                        <li>Mulai</li>
                                        <li>Input panjang (p)</li>
                                        <li>Input lebar (l)</li>
                                        <li>Hitung luas = p × l</li>
                                        <li>Tampilkan hasil luas</li>
                                        <li>Selesai</li>
                                    </ol>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-900 mb-2">Implementasi dalam Python:</h5>
                                    <div class="bg-gray-800 rounded p-3 text-green-400 font-mono text-sm">
                                        <div># Input panjang dan lebar</div>
                                        <div>panjang = float(input("Masukkan panjang: "))</div>
                                        <div>lebar = float(input("Masukkan lebar: "))</div>
                                        <div></div>
                                        <div># Hitung luas</div>
                                        <div>luas = panjang * lebar</div>
                                        <div></div>
                                        <div># Tampilkan hasil</div>
                                        <div>print(f"Luas persegi panjang: {luas}")</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 3.2 -->
                <section id="flowchart" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">3.2</span>
                        Flowchart dan Pseudocode
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Flowchart adalah representasi visual dari algoritma menggunakan simbol-simbol grafis, sedangkan pseudocode adalah deskripsi algoritma dalam bentuk bahasa yang mirip dengan bahasa pemrograman tetapi lebih mudah dibaca manusia.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Simbol-simbol Flowchart</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <div class="bg-white rounded p-4 text-center">
                                        <div class="w-12 h-8 bg-blue-600 rounded mx-auto mb-2"></div>
                                        <h6 class="font-medium text-blue-900 mb-1">Start/End</h6>
                                        <p class="text-xs text-gray-600">Mulai/Akhir</p>
                                    </div>
                                    <div class="bg-white rounded p-4 text-center">
                                        <div class="w-12 h-8 bg-green-600 mx-auto mb-2"></div>
                                        <h6 class="font-medium text-green-900 mb-1">Process</h6>
                                        <p class="text-xs text-gray-600">Proses</p>
                                    </div>
                                    <div class="bg-white rounded p-4 text-center">
                                        <div class="w-12 h-8 bg-yellow-600 mx-auto mb-2"></div>
                                        <h6 class="font-medium text-yellow-900 mb-1">Input/Output</h6>
                                        <p class="text-xs text-gray-600">Masukan/Keluaran</p>
                                    </div>
                                    <div class="bg-white rounded p-4 text-center">
                                        <div class="w-12 h-8 bg-purple-600 mx-auto mb-2"></div>
                                        <h6 class="font-medium text-purple-900 mb-1">Decision</h6>
                                        <p class="text-xs text-gray-600">Keputusan</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Contoh Flowchart: Cek Nilai Ujian</h4>
                                <div class="bg-white rounded p-4">
                                    <div class="text-center">
                                        <div class="inline-block">
                                            <div class="w-20 h-6 bg-blue-600 rounded text-white text-xs flex items-center justify-center mb-2">START</div>
                                            <div class="w-1 h-4 bg-gray-400 mx-auto mb-2"></div>
                                            <div class="w-24 h-8 bg-yellow-600 text-white text-xs flex items-center justify-center mb-2">Input Nilai</div>
                                            <div class="w-1 h-4 bg-gray-400 mx-auto mb-2"></div>
                                            <div class="w-20 h-12 bg-purple-600 text-white text-xs flex items-center justify-center mb-2 relative">
                                                <div>Nilai ≥ 70?</div>
                                                <div class="absolute -right-8 top-1/2 transform -translate-y-1/2">
                                                    <div class="text-xs text-green-600">Ya</div>
                                                </div>
                                                <div class="absolute -left-8 top-1/2 transform -translate-y-1/2">
                                                    <div class="text-xs text-red-600">Tidak</div>
                                                </div>
                                            </div>
                                            <div class="flex justify-between mb-2">
                                                <div class="w-1 h-8 bg-gray-400"></div>
                                                <div class="w-1 h-8 bg-gray-400"></div>
                                            </div>
                                            <div class="flex justify-between items-end mb-2">
                                                <div class="w-20 h-8 bg-green-600 text-white text-xs flex items-center justify-center">Lulus</div>
                                                <div class="w-20 h-8 bg-red-600 text-white text-xs flex items-center justify-center">Tidak Lulus</div>
                                            </div>
                                            <div class="w-1 h-4 bg-gray-400 mx-auto mb-2"></div>
                                            <div class="w-20 h-6 bg-blue-600 rounded text-white text-xs flex items-center justify-center">END</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">Contoh Pseudocode: Program Login Sederhana</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>PROGRAM LoginSederhana</div>
                                    <div>DEKLARASI</div>
                                    <div>    username : string</div>
                                    <div>    password : string</div>
                                    <div>    username_benar : string = "admin"</div>
                                    <div>    password_benar : string = "12345"</div>
                                    <div>ALGORITMA</div>
                                    <div>    output("Masukkan username: ")</div>
                                    <div>    input(username)</div>
                                    <div>    output("Masukkan password: ")</div>
                                    <div>    input(password)</div>
                                    <div>    </div>
                                    <div>    IF username = username_benar AND password = password_benar THEN</div>
                                    <div>        output("Login berhasil! Selamat datang.")</div>
                                    <div>    ELSE</div>
                                    <div>        output("Username atau password salah!")</div>
                                    <div>    ENDIF</div>
                                    <div>ENDPROGRAM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 3.3 -->
                <section id="variabel-tipe-data" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">3.3</span>
                        Variabel dan Tipe Data
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Variabel adalah tempat untuk menyimpan data dalam program, sedangkan tipe data menentukan jenis data yang dapat disimpan dalam variabel tersebut.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Tipe Data Dasar</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-blue-900 mb-3">Tipe Data Angka (Numeric)</h5>
                                        <ul class="space-y-2 text-sm text-blue-800">
                                            <li><strong>Integer:</strong> Bilangan bulat (1, 2, 3, -5, 0)</li>
                                            <li><strong>Float/Double:</strong> Bilangan desimal (3.14, -2.5, 0.5)</li>
                                        </ul>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-blue-900 mb-3">Tipe Data Teks (String)</h5>
                                        <ul class="space-y-2 text-sm text-blue-800">
                                            <li><strong>String:</strong> Teks ("Halo", "Programming", "123")</li>
                                            <li><strong>Character:</strong> Karakter tunggal ('A', '1', '?')</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Contoh Variabel dalam Berbagai Bahasa</h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-green-900 mb-2">Python</h5>
                                        <div class="bg-gray-800 rounded p-2 text-green-400 font-mono text-xs">
                                            <div>umur = 25</div>
                                            <div>nama = "Budi"</div>
                                            <div>tinggi = 175.5</div>
                                            <div>is_mahasiswa = True</div>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-green-900 mb-2">JavaScript</h5>
                                        <div class="bg-gray-800 rounded p-2 text-green-400 font-mono text-xs">
                                            <div>let umur = 25;</div>
                                            <div>let nama = "Budi";</div>
                                            <div>let tinggi = 175.5;</div>
                                            <div>let isMahasiswa = true;</div>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-green-900 mb-2">Java</h5>
                                        <div class="bg-gray-800 rounded p-2 text-green-400 font-mono text-xs">
                                            <div>int umur = 25;</div>
                                            <div>String nama = "Budi";</div>
                                            <div>double tinggi = 175.5;</div>
                                            <div>boolean isMahasiswa = true;</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">Aturan Penamaan Variabel</h4>
                                <div class="bg-white rounded p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <h5 class="font-medium text-green-900 mb-2">✅ Boleh</h5>
                                            <ul class="text-sm text-gray-700 space-y-1">
                                                <li>• namaDepan, umur, total_harga</li>
                                                <li>• userName, studentAge, maxValue</li>
                                                <li>• Dimulai dengan huruf atau underscore</li>
                                                <li>• Mengandung huruf, angka, underscore</li>
                                            </ul>
                                        </div>
                                        <div>
                                            <h5 class="font-medium text-red-900 mb-2">❌ Tidak Boleh</h5>
                                            <ul class="text-sm text-gray-700 space-y-1">
                                                <li>• 2nama, 123total (dimulai angka)</li>
                                                <li>• nama depan, harga$ (spasi/karakter khusus)</li>
                                                <li>• Nama yang sudah jadi keyword</li>
                                                <li>• Terlalu pendek atau tidak deskriptif</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 3.4 - Operator dan Ekspresi -->
                <section id="operator" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">3.4</span>
                        Operator dan Ekspresi
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Operator adalah simbol yang digunakan untuk melakukan operasi pada data. Ekspresi adalah kombinasi dari nilai, variabel, dan operator yang menghasilkan nilai baru.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Jenis-jenis Operator</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-blue-900 mb-3">Operator Aritmatika</h5>
                                        <div class="bg-gray-800 rounded p-3 text-green-400 font-mono text-sm">
                                            <div>+  → Penjumlahan: 5 + 3 = 8</div>
                                            <div>-  → Pengurangan: 5 - 3 = 2</div>
                                            <div>*  → Perkalian: 5 * 3 = 15</div>
                                            <div>/  → Pembagian: 5 / 3 = 1.67</div>
                                            <div>%  → Modulus: 5 % 3 = 2</div>
                                            <div>** → Pangkat: 5 ** 2 = 25</div>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-blue-900 mb-3">Operator Perbandingan</h5>
                                        <div class="bg-gray-800 rounded p-3 text-green-400 font-mono text-sm">
                                            <div>== → Sama dengan: 5 == 5 → True</div>
                                            <div>!= → Tidak sama: 5 != 3 → True</div>
                                            <div>>  → Lebih besar: 5 > 3 → True</div>
                                            <div><  → Lebih kecil: 5 < 3 → False</div>
                                            <div>>= → Lebih besar/sama: 5 >= 5 → True</div>
                                            <div><= → Lebih kecil/sama: 5 <= 3 → False</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Operator Logika</h4>
                                <div class="bg-white rounded p-4 mb-4">
                                    <table class="w-full text-sm">
                                        <thead>
                                            <tr class="bg-green-100">
                                                <th class="text-left p-2">Operator</th>
                                                <th class="text-left p-2">Nama</th>
                                                <th class="text-left p-2">Contoh</th>
                                                <th class="text-left p-2">Hasil</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="p-2 font-mono">and</td>
                                                <td class="p-2">AND</td>
                                                <td class="p-2">True and False</td>
                                                <td class="p-2">False</td>
                                            </tr>
                                            <tr class="bg-gray-50">
                                                <td class="p-2 font-mono">or</td>
                                                <td class="p-2">OR</td>
                                                <td class="p-2">True or False</td>
                                                <td class="p-2">True</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 font-mono">not</td>
                                                <td class="p-2">NOT</td>
                                                <td class="p-2">not True</td>
                                                <td class="p-2">False</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">Contoh Ekspresi Kompleks</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Ekspresi dengan multiple operator</div>
                                    <div>hasil = (10 + 5) * 2 - 8 / 4</div>
                                    <div># Urutan operasi: parentheses → multiplication → division → addition → subtraction</div>
                                    <div># Step by step: (15) * 2 - 2 = 30 - 2 = 28</div>
                                    <div></div>
                                    <div># Ekspresi logika kompleks</div>
                                    <div>lulus = (nilai >= 70) and (kehadiran >= 75) or (nilai_project >= 80)</div>
                                    <div></div>
                                    <div># Ekspresi dengan string</div>
                                    <div>nama_lengkap = nama_depan + " " + nama_belakang</div>
                                    <div>pesan = f"Halo, {nama_lengkap}! Selamat datang."</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 3.5 - Struktur Kontrol -->
                <section id="struktur-kontrol" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">3.5</span>
                        Struktur Kontrol
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Struktur kontrol mengontrol alur eksekusi program. Ada tiga jenis utama: sequence (urutan), selection (pemilihan), dan repetition (perulangan).
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Struktur If-Else (Pemilihan)</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># If statement sederhana</div>
                                    <div>if umur >= 18:</div>
                                    <div>    print("Anda sudah dewasa")</div>
                                    <div></div>
                                    <div># If-else statement</div>
                                    <div>if nilai >= 80:</div>
                                    <div>    grade = "A"</div>
                                    <div>elif nilai >= 70:</div>
                                    <div>    grade = "B"</div>
                                    <div>elif nilai >= 60:</div>
                                    <div>    grade = "C"</div>
                                    <div>else:</div>
                                    <div>    grade = "D"</div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Struktur Perulangan (Loop)</h4>
                                <div class="space-y-4">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-green-900 mb-2">For Loop</h5>
                                        <div class="bg-gray-800 rounded p-3 text-green-400 font-mono text-sm">
                                            <div># Perulangan dengan range</div>
                                            <div>for i in range(5):</div>
                                            <div>    print(f"Iterasi ke-{i}")</div>
                                            <div></div>
                                            <div># Perulangan melalui list</div>
                                            <div>buah = ["apel", "mangga", "jeruk"]</div>
                                            <div>for b in buah:</div>
                                            <div>    print(f"Saya suka {b}")</div>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-green-900 mb-2">While Loop</h5>
                                        <div class="bg-gray-800 rounded p-3 text-green-400 font-mono text-sm">
                                            <div>count = 0</div>
                                            <div>while count < 5:</div>
                                            <div>    print(f"Count: {count}")</div>
                                            <div>    count += 1</div>
                                            <div></div>
                                            <div># Loop dengan break</div>
                                            <div>while True:</div>
                                            <div>    input_user = input("Ketik 'exit' untuk keluar: ")</div>
                                            <div>    if input_user == "exit":</div>
                                            <div>        break</div>
                                            <div>    print(f"Anda mengetik: {input_user}")</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">Nested Structures (Bersarang)</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Nested if-else</div>
                                    <div>if user_type == "admin":</div>
                                    <div>    if login_attempts <= 3:</div>
                                    <div>        print("Access granted")</div>
                                    <div>    else:</div>
                                    <div>        print("Account locked")</div>
                                    <div></div>
                                    <div># Nested loops</div>
                                    <div>for i in range(3):</div>
                                    <div>    for j in range(3):</div>
                                    <div>        print(f"({i}, {j})", end=" ")</div>
                                    <div>    print()</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 3.6 - Praktik Programming -->
                <section id="praktik-programming" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">3.6</span>
                        Praktik Programming
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Untuk memperkuat pemahaman Anda, coba implementasikan konsep-konsep yang telah dipelajari dalam project-project sederhana berikut:
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                                    <i data-feather="target" class="w-5 h-5 mr-2 text-blue-600"></i>
                                    Tugas 1: Kalkulator Sederhana
                                </h4>
                                <div class="bg-white rounded p-4 mb-4">
                                    <h5 class="font-medium text-gray-900 mb-2">Requirements:</h5>
                                    <ul class="list-disc list-inside space-y-1 text-sm text-gray-700">
                                        <li>Input dua angka dari user</li>
                                        <li>Pilihan operasi: tambah, kurang, kali, bagi</li>
                                        <li>Validasi input (cek angka atau bukan)</li>
                                        <li>Handle division by zero</li>
                                        <li>Tampilkan hasil dengan format yang rapi</li>
                                    </ul>
                                </div>
                                <div class="bg-gray-800 rounded p-3 text-green-400 font-mono text-sm">
                                    <div># Pseudocode</div>
                                    <div>INPUT angka1</div>
                                    <div>INPUT angka2</div>
                                    <div>INPUT operasi</div>
                                    <div></div>
                                    <div>IF operasi == "+" THEN</div>
                                    <div>    hasil = angka1 + angka2</div>
                                    <div>ELSE IF operasi == "-" THEN</div>
                                    <div>    hasil = angka1 - angka2</div>
                                    <div>ELSE IF operasi == "*" THEN</div>
                                    <div>    hasil = angka1 * angka2</div>
                                    <div>ELSE IF operasi == "/" AND angka2 != 0 THEN</div>
                                    <div>    hasil = angka1 / angka2</div>
                                    <div>ELSE</div>
                                    <div>    OUTPUT "Operasi tidak valid atau pembagian oleh nol"</div>
                                    <div>ENDIF</div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-r from-green-50 to-teal-50 rounded-lg p-6">
                                <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                                    <i data-feather="search" class="w-5 h-5 mr-2 text-green-600"></i>
                                    Tugas 2: Program Penilaian Siswa
                                </h4>
                                <div class="bg-white rounded p-4 mb-4">
                                    <h5 class="font-medium text-gray-900 mb-2">Requirements:</h5>
                                    <ul class="list-disc list-inside space-y-1 text-sm text-gray-700">
                                        <li>Input nama dan nilai UTS, UAS, Tugas</li>
                                        <li>Hitung nilai akhir dengan bobot: UTS 30%, UAS 40%, Tugas 30%</li>
                                        <li>Konversi ke huruf (A: 85-100, B: 70-84, C: 55-69, D: 40-54, E: <40)</li>
                                        <li>Tampilkan nama, nilai akhir, dan grade</li>
                                        <li>Berikan komentar berdasarkan grade</li>
                                    </ul>
                                </div>
                                <div class="bg-gray-800 rounded p-3 text-green-400 font-mono text-sm">
                                    <div># Hitung nilai akhir</div>
                                    <div>nilai_akhir = (uts * 0.3) + (uas * 0.4) + (tugas * 0.3)</div>
                                    <div></div>
                                    <div># Konversi ke grade</div>
                                    <div>IF nilai_akhir >= 85 THEN</div>
                                    <div>    grade = "A"</div>
                                    <div>    komentar = "Excellent!"</div>
                                    <div>ELSE IF nilai_akhir >= 70 THEN</div>
                                    <div>    grade = "B"</div>
                                    <div>    komentar = "Good job!"</div>
                                    <div>ELSE IF nilai_akhir >= 55 THEN</div>
                                    <div>    grade = "C"</div>
                                    <div>    komentar = "Keep trying!"</div>
                                    <div>ELSE IF nilai_akhir >= 40 THEN</div>
                                    <div>    grade = "D"</div>
                                    <div>    komentar = "Need improvement"</div>
                                    <div>ELSE</div>
                                    <div>    grade = "E"</div>
                                    <div>    komentar = "Please study harder"</div>
                                    <div>ENDIF</div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-lg p-6">
                                <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                                    <i data-feather="zap" class="w-5 h-5 mr-2 text-yellow-600"></i>
                                    Tugas 3: Game Tebak Angka
                                </h4>
                                <div class="bg-white rounded p-4 mb-4">
                                    <h5 class="font-medium text-gray-900 mb-2">Requirements:</h5>
                                    <ul class="list-disc list-inside space-y-1 text-sm text-gray-700">
                                        <li>Generate angka random antara 1-100</li>
                                        <li>Player tebak angka dengan hint "terlalu besar" atau "terlalu kecil"</li>
                                        <li>Batasi jumlah tebakan (misal 7 kali)</li>
                                        <li>Tampilkan jumlah tebakan yang digunakan</li>
                                        <li>Berikan opsi untuk main lagi</li>
                                    </ul>
                                </div>
                                <div class="bg-gray-800 rounded p-3 text-green-400 font-mono text-sm">
                                    <div># Generate angka random</div>
                                    <div>angka_rahasia = random(1, 100)</div>
                                    <div>tebakan_ke = 0</div>
                                    <div>max_tebakan = 7</div>
                                    <div></div>
                                    <div>WHILE tebakan_ke < max_tebakan DO</div>
                                    <div>    INPUT tebakan</div>
                                    <div>    tebakan_ke = tebakan_ke + 1</div>
                                    <div>    </div>
                                    <div>    IF tebakan == angka_rahasia THEN</div>
                                    <div>        OUTPUT "Selamat! Anda berhasil menebak!"</div>
                                    <div>        BREAK</div>
                                    <div>    ELSE IF tebakan > angka_rahasia THEN</div>
                                    <div>        OUTPUT "Terlalu besar! Coba lagi."</div>
                                    <div>    ELSE</div>
                                    <div>        OUTPUT "Terlalu kecil! Coba lagi."</div>
                                    <div>    ENDIF</div>
                                    <div>ENDWHILE</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-green-600 text-white rounded-lg p-6">
                            <h4 class="font-semibold mb-3 flex items-center">
                                <i data-feather="award" class="w-5 h-5 mr-2"></i>
                                Evaluasi Diri
                            </h4>
                            <p class="mb-3">Setelah menyelesaikan semua tugas, nilai pemahaman Anda:</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div class="bg-green-500 rounded p-3">
                                    <strong>Level 1:</strong> Saya bisa membuat program dengan if-else dan loop sederhana
                                </div>
                                <div class="bg-green-500 rounded p-3">
                                    <strong>Level 2:</strong> Saya bisa menggunakan operator dan ekspresi dengan benar
                                </div>
                                <div class="bg-green-500 rounded p-3">
                                    <strong>Level 3:</strong> Saya bisa membuat program kompleks dengan nested structures
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Navigation -->
                <div class="flex justify-between items-center bg-white rounded-lg shadow-md p-6">
                    <div>
                        <a href="<?= base_url('documentation/chapter2') ?>" class="text-gray-600 hover:text-gray-800 flex items-center">
                            <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                            Kembali ke Bab 2
                        </a>
                    </div>
                    <div class="text-center">
                        <span class="text-sm text-gray-500">Bab 3 dari 10</span>
                        <div class="flex space-x-1 mt-1">
                            <div class="w-3 h-3 bg-green-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-600 rounded-full"></div>
                            <div class="w-3 h-3 bggreen-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                        </div>
                    </div>
                    <div>
                        <a href="<?= base_url('documentation/chapter4') ?>" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg flex items-center">
                            Lanjut ke Bab 4
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