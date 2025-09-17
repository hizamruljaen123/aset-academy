<div class="min-h-screen bg-gray-50">
    <!-- Chapter Header -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="<?= base_url('documentation') ?>" class="text-blue-200 hover:text-white inline-flex items-center">
                                    <i data-feather="home" class="w-4 h-4 mr-2"></i>
                                    Dokumentasi
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i data-feather="chevron-right" class="w-4 h-4 text-blue-200 mx-2"></i>
                                    <span class="text-white font-medium">Bab 1</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">Pengenalan Komputer dan Sistem Operasi</h1>
                    <p class="text-xl text-blue-100 max-w-3xl">Memahami komponen dasar komputer, hardware, software, dan berbagai sistem operasi yang populer.</p>
                </div>
                <div class="hidden md:block">
                    <i data-feather="monitor" class="w-24 h-24 text-blue-200 opacity-50"></i>
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
                        <div class="bg-blue-600 h-2 rounded-full" style="width: 10%"></div>
                    </div>
                    <span class="text-sm text-gray-600">Bab 1 dari 10</span>
                </div>
                <div class="flex space-x-2">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">Pemula</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full">15-20 menit</span>
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
                        <a href="#pengenalan-komputer" class="block text-sm text-gray-600 hover:text-blue-600 py-1">1.1 Pengenalan Komputer</a>
                        <a href="#hardware" class="block text-sm text-gray-600 hover:text-blue-600 py-1">1.2 Hardware Komputer</a>
                        <a href="#software" class="block text-sm text-gray-600 hover:text-blue-600 py-1">1.3 Software dan Sistem Operasi</a>
                        <a href="#sistem-operasi" class="block text-sm text-gray-600 hover:text-blue-600 py-1">1.4 Macam-macam Sistem Operasi</a>
                        <a href="#perintah-dasar" class="block text-sm text-gray-600 hover:text-blue-600 py-1">1.5 Perintah Dasar</a>
                        <a href="#praktik" class="block text-sm text-gray-600 hover:text-blue-600 py-1">1.6 Praktik Mandiri</a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3 space-y-12">
                <!-- Section 1.1 -->
                <section id="pengenalan-komputer" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">1.1</span>
                        Pengenalan Komputer
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Komputer adalah alat elektronik yang dapat menerima data, memproses data sesuai instruksi yang diberikan, menyimpan data, dan menghasilkan output. Dalam bahasa Indonesia, komputer berarti "penghitung" atau "pemproses data".
                        </p>

                        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-6">
                            <h4 class="font-semibold text-blue-900 mb-2">Fungsi Dasar Komputer</h4>
                            <ul class="list-disc list-inside text-blue-800 space-y-1">
                                <li>Input (Masukan): Menerima data dari pengguna</li>
                                <li>Process (Pemrosesan): Memproses data yang diterima</li>
                                <li>Output (Keluaran): Menampilkan hasil pemrosesan</li>
                                <li>Storage (Penyimpanan): Menyimpan data untuk digunakan kembali</li>
                            </ul>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-gray-900 mb-4">Ilustrasi Proses Komputer</h4>
                            <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 md:space-x-4">
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i data-feather="download" class="w-8 h-8 text-blue-600"></i>
                                    </div>
                                    <p class="text-sm font-medium">Input</p>
                                    <p class="text-xs text-gray-500">Data Masuk</p>
                                </div>
                                <i data-feather="arrow-right" class="w-6 h-6 text-gray-400 hidden md:block"></i>
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i data-feather="cpu" class="w-8 h-8 text-green-600"></i>
                                    </div>
                                    <p class="text-sm font-medium">Process</p>
                                    <p class="text-xs text-gray-500">Pemrosesan</p>
                                </div>
                                <i data-feather="arrow-right" class="w-6 h-6 text-gray-400 hidden md:block"></i>
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i data-feather="monitor" class="w-8 h-8 text-purple-600"></i>
                                    </div>
                                    <p class="text-sm font-medium">Output</p>
                                    <p class="text-xs text-gray-500">Hasil</p>
                                </div>
                                <i data-feather="arrow-right" class="w-6 h-6 text-gray-400 hidden md:block"></i>
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i data-feather="hard-drive" class="w-8 h-8 text-orange-600"></i>
                                    </div>
                                    <p class="text-sm font-medium">Storage</p>
                                    <p class="text-xs text-gray-500">Penyimpanan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 1.2 -->
                <section id="hardware" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">1.2</span>
                        Hardware Komputer
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Hardware adalah komponen fisik dari komputer yang dapat dilihat dan disentuh. Berikut adalah komponen utama hardware:
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-3 flex items-center">
                                    <i data-feather="cpu" class="w-5 h-5 mr-2"></i>
                                    Hardware Utama
                                </h4>
                                <ul class="space-y-2 text-green-800">
                                    <li><strong>CPU (Central Processing Unit):</strong> Otak komputer yang memproses data</li>
                                    <li><strong>RAM (Random Access Memory):</strong> Memori untuk menyimpan data sementara</li>
                                    <li><strong>Motherboard:</strong> Papan utama yang menghubungkan semua komponen</li>
                                    <li><strong>Power Supply:</strong> Sumber daya listrik untuk komputer</li>
                                </ul>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-3 flex items-center">
                                    <i data-feather="hard-drive" class="w-5 h-5 mr-2"></i>
                                    Hardware Penyimpanan
                                </h4>
                                <ul class="space-y-2 text-blue-800">
                                    <li><strong>Hard Disk Drive (HDD):</strong> Penyimpanan data utama</li>
                                    <li><strong>Solid State Drive (SSD):</strong> Penyimpanan cepat dan modern</li>
                                    <li><strong>Optical Drive:</strong> Untuk CD/DVD (jika tersedia)</li>
                                    <li><strong>USB Flash Drive:</strong> Penyimpanan portabel</li>
                                </ul>
                            </div>
                        </div>

                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 mb-6">
                            <h4 class="font-semibold text-yellow-900 mb-2 flex items-center">
                                <i data-feather="alert-triangle" class="w-5 h-5 mr-2"></i>
                                Periferal (Perangkat Tambahan)
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-yellow-800">
                                <div>
                                    <strong>Input Device:</strong><br>
                                    • Keyboard<br>
                                    • Mouse<br>
                                    • Scanner<br>
                                    • Microphone
                                </div>
                                <div>
                                    <strong>Output Device:</strong><br>
                                    • Monitor<br>
                                    • Printer<br>
                                    • Speaker<br>
                                    • Projector
                                </div>
                                <div>
                                    <strong>Input/Output:</strong><br>
                                    • Touchscreen<br>
                                    • USB Hub<br>
                                    • Network Card<br>
                                    • Bluetooth
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 1.3 -->
                <section id="software" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">1.3</span>
                        Software dan Sistem Operasi
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Software adalah sekumpulan instruksi atau program yang memberitahu komputer apa yang harus dilakukan. Software dibagi menjadi dua kategori utama:
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-purple-50 rounded-lg p-6">
                                <h4 class="font-semibold text-purple-900 mb-3">1. System Software (Perangkat Lunak Sistem)</h4>
                                <p class="text-purple-800 mb-3">Software yang mengelola hardware dan menyediakan platform untuk software aplikasi.</p>
                                
                                <div class="bg-white rounded p-4 mb-4">
                                    <h5 class="font-medium text-purple-900 mb-2">Sistem Operasi (Operating System)</h5>
                                    <p class="text-sm text-gray-700 mb-2">Software paling penting yang mengelola semua sumber daya komputer:</p>
                                    <ul class="text-sm text-gray-600 space-y-1">
                                        <li>• Mengelola memory dan proses</li>
                                        <li>• Mengontrol perangkat keras</li>
                                        <li>• Menyediakan antarmuka pengguna</li>
                                        <li>• Mengelola file dan folder</li>
                                    </ul>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-purple-900 mb-2">Driver Perangkat</h5>
                                        <p class="text-sm text-gray-600">Software yang menghubungkan hardware dengan sistem operasi</p>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-purple-900 mb-2">Utility Program</h5>
                                        <p class="text-sm text-gray-600">Program utilitas seperti antivirus, disk cleanup, dll</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-3">2. Application Software (Perangkat Lunak Aplikasi)</h4>
                                <p class="text-green-800 mb-3">Software yang digunakan pengguna untuk menyelesaikan tugas tertentu.</p>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <div class="bg-white rounded p-4 text-center">
                                        <i data-feather="file-text" class="w-8 h-8 text-green-600 mx-auto mb-2"></i>
                                        <h6 class="font-medium text-green-900 mb-1">Office Suite</h6>
                                        <p class="text-xs text-gray-600">Word, Excel, PowerPoint</p>
                                    </div>
                                    <div class="bg-white rounded p-4 text-center">
                                        <i data-feather="chrome" class="w-8 h-8 text-green-600 mx-auto mb-2"></i>
                                        <h6 class="font-medium text-green-900 mb-1">Web Browser</h6>
                                        <p class="text-xs text-gray-600">Chrome, Firefox, Edge</p>
                                    </div>
                                    <div class="bg-white rounded p-4 text-center">
                                        <i data-feather="image" class="w-8 h-8 text-green-600 mx-auto mb-2"></i>
                                        <h6 class="font-medium text-green-900 mb-1">Media Player</h6>
                                        <p class="text-xs text-gray-600">VLC, Windows Media</p>
                                    </div>
                                    <div class="bg-white rounded p-4 text-center">
                                        <i data-feather="message-circle" class="w-8 h-8 text-green-600 mx-auto mb-2"></i>
                                        <h6 class="font-medium text-green-900 mb-1">Communication</h6>
                                        <p class="text-xs text-gray-600">WhatsApp, Zoom, Skype</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 1.4 -->
                <section id="sistem-operasi" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">1.4</span>
                        Macam-macam Sistem Operasi
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Berikut adalah sistem operasi yang paling populer dan banyak digunakan:
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Windows -->
                            <div class="bg-blue-50 rounded-lg p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                        <i data-feather="windows" class="w-6 h-6 text-blue-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-blue-900">Microsoft Windows</h4>
                                        <p class="text-sm text-blue-700">Sistem operasi paling populer untuk PC</p>
                                    </div>
                                </div>
                                <ul class="text-sm text-blue-800 space-y-1">
                                    <li>• Antarmuka pengguna grafis (GUI)</li>
                                    <li>• Kompatibel dengan banyak software</li>
                                    <li>• Dukungan hardware luas</li>
                                    <li>• Versi terbaru: Windows 11</li>
                                </ul>
                            </div>

                            <!-- macOS -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                                        <i data-feather="apple" class="w-6 h-6 text-gray-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">macOS</h4>
                                        <p class="text-sm text-gray-700">Sistem operasi Apple untuk Mac</p>
                                    </div>
                                </div>
                                <ul class="text-sm text-gray-700 space-y-1">
                                    <li>• Desain elegan dan intuitif</li>
                                    <li>• Keamanan tinggi</li>
                                    <li>• Integrasi dengan ekosistem Apple</li>
                                    <li>• Stabilitas dan performa optimal</li>
                                </ul>
                            </div>

                            <!-- Linux -->
                            <div class="bg-orange-50 rounded-lg p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                                        <i data-feather="terminal" class="w-6 h-6 text-orange-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-orange-900">Linux</h4>
                                        <p class="text-sm text-orange-700">Sistem operasi open source</p>
                                    </div>
                                </div>
                                <ul class="text-sm text-orange-800 space-y-1">
                                    <li>• Gratis dan open source</li>
                                    <li>• Keamanan sangat baik</li>
                                    <li>• Dapat dikustomisasi</li>
                                    <li>• Populer untuk server</li>
                                </ul>
                            </div>

                            <!-- Mobile OS -->
                            <div class="bg-green-50 rounded-lg p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                        <i data-feather="smartphone" class="w-6 h-6 text-green-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-green-900">Mobile OS</h4>
                                        <p class="text-sm text-green-700">Sistem operasi untuk ponsel</p>
                                    </div>
                                </div>
                                <ul class="text-sm text-green-800 space-y-1">
                                    <li>• Android (Google)</li>
                                    <li>• iOS (Apple)</li>
                                    <li>• Optimasi untuk perangkat mobile</li>
                                    <li>• Aplikasi touchscreen</li>
                                </ul>
                            </div>
                        </div>

                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6">
                            <h4 class="font-semibold text-yellow-900 mb-2 flex items-center">
                                <i data-feather="lightbulb" class="w-5 h-5 mr-2"></i>
                                Tips Memilih Sistem Operasi
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-yellow-800">
                                <div>
                                    <strong>Pilih Windows jika:</strong><br>
                                    • Butuh kompatibilitas software luas<br>
                                    • Pengguna awam/beginner<br>
                                    • Gaming adalah prioritas
                                </div>
                                <div>
                                    <strong>Pilih Linux jika:</strong><br>
                                    • Ingin belajar programming serius<br>
                                    • Butuh keamanan tinggi<br>
                                    • Budget terbatas (gratis)
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 1.5 -->
                <section id="perintah-dasar" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">1.5</span>
                        Perintah Dasar
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Memahami perintah dasar sangat penting untuk mengoperasikan komputer secara efisien. Berikut adalah perintah dasar yang umum digunakan:
                        </p>

                        <div class="space-y-6 mb-6">
                            <!-- Windows Commands -->
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4 flex items-center">
                                    <i data-feather="command" class="w-5 h-5 mr-2"></i>
                                    Perintah Dasar Windows (Command Prompt)
                                </h4>
                                
                                <div class="space-y-4">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-blue-900 mb-2">Navigasi File dan Folder</h5>
                                        <div class="bg-gray-800 rounded p-3 text-green-400 font-mono text-sm">
                                            <div>cd nama_folder     ← Masuk ke folder</div>
                                            <div>cd ..            ← Kembali ke folder sebelumnya</div>
                                            <div>dir              ← Lihat isi folder</div>
                                            <div>mkdir nama_folder ← Buat folder baru</div>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-blue-900 mb-2">Manajemen File</h5>
                                        <div class="bg-gray-800 rounded p-3 text-green-400 font-mono text-sm">
                                            <div>copy file1.txt file2.txt    ← Salin file</div>
                                            <div>move file.txt D:\           ← Pindahkan file</div>
                                            <div>del nama_file.txt          ← Hapus file</div>
                                            <div>ren lama.txt baru.txt      ← Ganti nama file</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Linux/Mac Commands -->
                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4 flex items-center">
                                    <i data-feather="terminal" class="w-5 h-5 mr-2"></i>
                                    Perintah Dasar Linux/Mac (Terminal)
                                </h4>
                                
                                <div class="space-y-4">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-green-900 mb-2">Navigasi File dan Folder</h5>
                                        <div class="bg-gray-800 rounded p-3 text-green-400 font-mono text-sm">
                                            <div>cd nama_folder     ← Masuk ke folder</div>
                                            <div>cd ..            ← Kembali ke folder sebelumnya</div>
                                            <div>ls -la           ← Lihat isi folder (detailed)</div>
                                            <div>mkdir nama_folder ← Buat folder baru</div>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-green-900 mb-2">Manajemen File</h5>
                                        <div class="bg-gray-800 rounded p-3 text-green-400 font-mono text-sm">
                                            <div>cp file1.txt file2.txt      ← Salin file</div>
                                            <div>mv file.txt /home/user/     ← Pindahkan file</div>
                                            <div>rm nama_file.txt           ← Hapus file</div>
                                            <div>mv lama.txt baru.txt       ← Ganti nama file</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-50 rounded-lg p-6">
                            <h4 class="font-semibold text-purple-900 mb-4">Keyboard Shortcuts Penting</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h5 class="font-medium text-purple-900 mb-3">Windows</h5>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="font-mono bg-gray-200 px-2 py-1 rounded text-xs">Ctrl + C</span>
                                            <span class="text-gray-600">Copy</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="font-mono bg-gray-200 px-2 py-1 rounded text-xs">Ctrl + V</span>
                                            <span class="text-gray-600">Paste</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="font-mono bg-gray-200 px-2 py-1 rounded text-xs">Ctrl + Z</span>
                                            <span class="text-gray-600">Undo</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="font-mono bg-gray-200 px-2 py-1 rounded text-xs">Win + D</span>
                                            <span class="text-gray-600">Show Desktop</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="font-medium text-purple-900 mb-3">Mac</h5>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="font-mono bg-gray-200 px-2 py-1 rounded text-xs">Cmd + C</span>
                                            <span class="text-gray-600">Copy</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="font-mono bg-gray-200 px-2 py-1 rounded text-xs">Cmd + V</span>
                                            <span class="text-gray-600">Paste</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="font-mono bg-gray-200 px-2 py-1 rounded text-xs">Cmd + Z</span>
                                            <span class="text-gray-600">Undo</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="font-mono bg-gray-200 px-2 py-1 rounded text-xs">Cmd + Space</span>
                                            <span class="text-gray-600">Spotlight</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 1.6 -->
                <section id="praktik" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">1.6</span>
                        Praktik Mandiri
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Untuk memperkuat pemahaman Anda, coba lakukan latihan berikut:
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg p-6">
                                <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                                    <i data-feather="target" class="w-5 h-5 mr-2 text-blue-600"></i>
                                    Tugas 1: Eksplorasi Sistem Operasi
                                </h4>
                                <ol class="list-decimal list-inside space-y-2 text-gray-700">
                                    <li>Buka Command Prompt (Windows) atau Terminal (Mac/Linux)</li>
                                    <li>Coba perintah <code class="bg-gray-200 px-2 py-1 rounded">dir</code> atau <code class="bg-gray-200 px-2 py-1 rounded">ls</code> untuk melihat isi folder</li>
                                    <li>Buat folder baru dengan perintah <code class="bg-gray-200 px-2 py-1 rounded">mkdir latihan</code></li>
                                    <li>Masuk ke folder tersebut dengan <code class="bg-gray-200 px-2 py-1 rounded">cd latihan</code></li>
                                    <li>Buat file teks sederhana dan simpan di folder tersebut</li>
                                </ol>
                            </div>

                            <div class="bg-gradient-to-r from-green-50 to-teal-50 rounded-lg p-6">
                                <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                                    <i data-feather="search" class="w-5 h-5 mr-2 text-green-600"></i>
                                    Tugas 2: Identifikasi Komponen
                                </h4>
                                <ol class="list-decimal list-inside space-y-2 text-gray-700">
                                    <li>Identifikasi 5 komponen hardware di komputer Anda</li>
                                    <li>Cari tahu spesifikasi CPU dan RAM komputer Anda</li>
                                    <li>Periksa berapa kapasitas hard disk/SSD yang tersedia</li>
                                    <li>Cek versi sistem operasi yang Anda gunakan</li>
                                    <li>Catat 3 software aplikasi yang sering Anda gunakan</li>
                                </ol>
                            </div>

                            <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-lg p-6">
                                <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                                    <i data-feather="zap" class="w-5 h-5 mr-2 text-orange-600"></i>
                                    Tugas 3: Shortcut Challenge
                                </h4>
                                <p class="text-gray-700 mb-3">Praktikkan 10 keyboard shortcut berikut:</p>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                    <div class="bg-white rounded p-3 text-center">
                                        <div class="font-mono text-xs bg-gray-200 px-2 py-1 rounded mb-1">Ctrl+C</div>
                                        <div class="text-xs text-gray-600">Copy</div>
                                    </div>
                                    <div class="bg-white rounded p-3 text-center">
                                        <div class="font-mono text-xs bg-gray-200 px-2 py-1 rounded mb-1">Ctrl+V</div>
                                        <div class="text-xs text-gray-600">Paste</div>
                                    </div>
                                    <div class="bg-white rounded p-3 text-center">
                                        <div class="font-mono text-xs bg-gray-200 px-2 py-1 rounded mb-1">Ctrl+Z</div>
                                        <div class="text-xs text-gray-600">Undo</div>
                                    </div>
                                    <div class="bg-white rounded p-3 text-center">
                                        <div class="font-mono text-xs bg-gray-200 px-2 py-1 rounded mb-1">Alt+Tab</div>
                                        <div class="text-xs text-gray-600">Switch App</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-600 text-white rounded-lg p-6">
                            <h4 class="font-semibold mb-3 flex items-center">
                                <i data-feather="award" class="w-5 h-5 mr-2"></i>
                                Evaluasi Diri
                            </h4>
                            <p class="mb-3">Setelah menyelesaikan semua tugas, nilai pemahaman Anda:</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div class="bg-blue-500 rounded p-3">
                                    <strong>Level 1:</strong> Saya bisa menjelaskan perbedaan hardware dan software
                                </div>
                                <div class="bg-blue-500 rounded p-3">
                                    <strong>Level 2:</strong> Saya bisa menggunakan perintah dasar di terminal/command prompt
                                </div>
                                <div class="bg-blue-500 rounded p-3">
                                    <strong>Level 3:</strong> Saya bisa mengidentifikasi komponen komputer dan sistem operasi saya
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Navigation -->
                <div class="flex justify-between items-center bg-white rounded-lg shadow-md p-6">
                    <div>
                        <a href="<?= base_url('documentation') ?>" class="text-gray-600 hover:text-gray-800 flex items-center">
                            <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                            Kembali ke Daftar Bab
                        </a>
                    </div>
                    <div class="text-center">
                        <span class="text-sm text-gray-500">Bab 1 dari 10</span>
                        <div class="flex space-x-1 mt-1">
                            <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                            <!-- Add more dots for other chapters -->
                        </div>
                    </div>
                    <div>
                        <a href="<?= base_url('documentation/chapter2') ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center">
                            Lanjut ke Bab 2
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