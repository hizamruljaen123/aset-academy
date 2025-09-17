<div class="min-h-screen bg-gray-50">
    <!-- Chapter Header -->
    <section class="bg-gradient-to-r from-purple-600 to-purple-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="<?= base_url('documentation') ?>" class="text-purple-200 hover:text-white inline-flex items-center">
                                    <i data-feather="home" class="w-4 h-4 mr-2"></i>
                                    Dokumentasi
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i data-feather="chevron-right" class="w-4 h-4 text-purple-200 mx-2"></i>
                                    <span class="text-white font-medium">Bab 2</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">Dasar-dasar Jaringan Komputer</h1>
                    <p class="text-xl text-purple-100 max-w-3xl">Memahami konsep jaringan komputer, internet, dan protokol komunikasi yang digunakan.</p>
                </div>
                <div class="hidden md:block">
                    <i data-feather="wifi" class="w-24 h-24 text-purple-200 opacity-50"></i>
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
                        <div class="bg-purple-600 h-2 rounded-full" style="width: 20%"></div>
                    </div>
                    <span class="text-sm text-gray-600">Bab 2 dari 10</span>
                </div>
                <div class="flex space-x-2">
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm rounded-full">Pemula</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full">20-25 menit</span>
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
                        <a href="#pengenalan-jaringan" class="block text-sm text-gray-600 hover:text-purple-600 py-1">2.1 Pengenalan Jaringan</a>
                        <a href="#topologi-jaringan" class="block text-sm text-gray-600 hover:text-purple-600 py-1">2.2 Topologi Jaringan</a>
                        <a href="#protokol-jaringan" class="block text-sm text-gray-600 hover:text-purple-600 py-1">2.3 Protokol Jaringan</a>
                        <a href="#ip-address" class="block text-sm text-gray-600 hover:text-purple-600 py-1">2.4 IP Address dan DNS</a>
                        <a href="#http-https" class="block text-sm text-gray-600 hover:text-purple-600 py-1">2.5 HTTP dan HTTPS</a>
                        <a href="#praktik-jaringan" class="block text-sm text-gray-600 hover:text-purple-600 py-1">2.6 Praktik Jaringan</a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3 space-y-12">
                <!-- Section 2.1 -->
                <section id="pengenalan-jaringan" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-purple-100 text-purple-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">2.1</span>
                        Pengenalan Jaringan Komputer
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Jaringan komputer adalah kumpulan dua atau lebih komputer yang saling terhubung untuk dapat saling berbagi sumber daya (resource) seperti file, printer, koneksi internet, dan lainnya.
                        </p>

                        <div class="bg-purple-50 border-l-4 border-purple-500 p-6 mb-6">
                            <h4 class="font-semibold text-purple-900 mb-2">Tujuan Jaringan Komputer</h4>
                            <ul class="list-disc list-inside text-purple-800 space-y-1">
                                <li>Berbagi sumber daya (file, printer, internet)</li>
                                <li>Komunikasi antar pengguna</li>
                                <li>Centralized management (pengelolaan terpusat)</li>
                                <li>Backup dan keamanan data</li>
                                <li>Akses remote (jarak jauh)</li>
                            </ul>
                        </div>

                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-gray-900 mb-4">Jenis-jenis Jaringan Berdasarkan Jangkauan</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-white rounded-lg p-4 text-center">
                                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i data-feather="home" class="w-8 h-8 text-blue-600"></i>
                                    </div>
                                    <h5 class="font-semibold text-blue-900 mb-2">PAN (Personal Area Network)</h5>
                                    <p class="text-sm text-gray-600">Jangkauan: 1-10 meter</p>
                                    <p class="text-xs text-gray-500 mt-1">Contoh: Bluetooth, USB tethering</p>
                                </div>
                                
                                <div class="bg-white rounded-lg p-4 text-center">
                                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i data-feather="wifi" class="w-8 h-8 text-green-600"></i>
                                    </div>
                                    <h5 class="font-semibold text-green-900 mb-2">LAN (Local Area Network)</h5>
                                    <p class="text-sm text-gray-600">Jangkauan: 1-5 km</p>
                                    <p class="text-xs text-gray-500 mt-1">Contoh: Jaringan kantor, kampus</p>
                                </div>
                                
                                <div class="bg-white rounded-lg p-4 text-center">
                                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i data-feather="globe" class="w-8 h-8 text-purple-600"></i>
                                    </div>
                                    <h5 class="font-semibold text-purple-900 mb-2">WAN (Wide Area Network)</h5>
                                    <p class="text-sm text-gray-600">Jangkauan: Global</p>
                                    <p class="text-xs text-gray-500 mt-1">Contoh: Internet</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6">
                            <h4 class="font-semibold text-yellow-900 mb-2 flex items-center">
                                <i data-feather="alert-triangle" class="w-5 h-5 mr-2"></i>
                                Komponen Dasar Jaringan
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-yellow-800">
                                <div>
                                    <strong>Perangkat Keras (Hardware):</strong>
                                    <ul class="list-disc list-inside mt-2 space-y-1">
                                        <li>Network Interface Card (NIC)</li>
                                        <li>Router dan Switch</li>
                                        <li>Kabel jaringan (UTP, Fiber Optic)</li>
                                        <li>Access Point (WiFi)</li>
                                    </ul>
                                </div>
                                <div>
                                    <strong>Perangkat Lunak (Software):</strong>
                                    <ul class="list-disc list-inside mt-2 space-y-1">
                                        <li>Network Operating System</li>
                                        <li>Protocol stack (TCP/IP)</li>
                                        <li>Network drivers</li>
                                        <li>Security software</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 2.2 -->
                <section id="topologi-jaringan" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-purple-100 text-purple-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">2.2</span>
                        Topologi Jaringan
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Topologi jaringan menggambarkan cara perangkat jaringan dihubungkan secara fisik atau logika. Berikut adalah jenis-jenis topologi yang umum:
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-3 flex items-center">
                                    <i data-feather="circle" class="w-5 h-5 mr-2"></i>
                                    Topologi Bus
                                </h4>
                                <p class="text-blue-800 mb-3">Semua perangkat terhubung ke satu kabel utama (backbone).</p>
                                <div class="bg-white rounded p-4">
                                    <strong class="text-blue-900">Kelebihan:</strong>
                                    <ul class="text-sm text-blue-700 space-y-1">
                                        <li>• Mudah instalasi dan konfigurasi</li>
                                        <li>• Biaya relatif murah</li>
                                        <li>• Cocok untuk jaringan kecil</li>
                                    </ul>
                                </div>
                                <div class="bg-white rounded p-4 mt-2">
                                    <strong class="text-red-900">Kekurangan:</strong>
                                    <ul class="text-sm text-red-700 space-y-1">
                                        <li>• Kinerja menurun saat banyak perangkat</li>
                                        <li>• Jika kabel utama putus, seluruh jaringan down</li>
                                        <li>• Sulit untuk troubleshooting</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-3 flex items-center">
                                    <i data-feather="star" class="w-5 h-5 mr-2"></i>
                                    Topologi Star (Bintang)
                                </h4>
                                <p class="text-green-800 mb-3">Semua perangkat terhubung ke pusat (switch/hub).</p>
                                <div class="bg-white rounded p-4">
                                    <strong class="text-green-900">Kelebihan:</strong>
                                    <ul class="text-sm text-green-700 space-y-1">
                                        <li>• Mudah menambah/mengurangi perangkat</li>
                                        <li>• Jika satu perangkat error, tidak mempengaruhi yang lain</li>
                                        <li>• Performa lebih stabil</li>
                                    </ul>
                                </div>
                                <div class="bg-white rounded p-4 mt-2">
                                    <strong class="text-red-900">Kekurangan:</strong>
                                    <ul class="text-sm text-red-700 space-y-1">
                                        <li>• Jika pusat down, seluruh jaringan down</li>
                                        <li>• Membutuhkan lebih banyak kabel</li>
                                        <li>• Biaya lebih tinggi untuk switch/hub</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="bg-purple-50 rounded-lg p-6">
                                <h4 class="font-semibold text-purple-900 mb-3 flex items-center">
                                    <i data-feather="hexagon" class="w-5 h-5 mr-2"></i>
                                    Topologi Ring (Cincin)
                                </h4>
                                <p class="text-purple-800 mb-3">Perangkat terhubung membentuk lingkaran tertutup.</p>
                                <div class="bg-white rounded p-4">
                                    <strong class="text-purple-900">Kelebihan:</strong>
                                    <ul class="text-sm text-purple-700 space-y-1">
                                        <li>• Tidak ada collision data</li>
                                        <li>• Performa konsisten</li>
                                        <li>• Cocok untuk jaringan besar</li>
                                    </ul>
                                </div>
                                <div class="bg-white rounded p-4 mt-2">
                                    <strong class="text-red-900">Kekurangan:</strong>
                                    <ul class="text-sm text-red-700 space-y-1">
                                        <li>• Jika satu perangkat error, bisa mengganggu seluruh jaringan</li>
                                        <li>• Sulit untuk menambah perangkat baru</li>
                                        <li>• Troubleshooting kompleks</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-gray-900 mb-4">Ilustrasi Topologi Jaringan</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="text-center">
                                    <div class="bg-blue-100 rounded-lg p-4 mb-3">
                                        <div class="text-xs font-mono text-blue-800 mb-2">BUS TOPOLOGY</div>
                                        <div class="flex justify-center items-center space-x-2">
                                            <div class="w-4 h-4 bg-blue-600 rounded-full"></div>
                                            <div class="w-12 h-1 bg-blue-600"></div>
                                            <div class="w-4 h-4 bg-blue-600 rounded-full"></div>
                                            <div class="w-12 h-1 bg-blue-600"></div>
                                            <div class="w-4 h-4 bg-blue-600 rounded-full"></div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600">Semua perangkat terhubung ke satu kabel utama</p>
                                </div>
                                
                                <div class="text-center">
                                    <div class="bg-green-100 rounded-lg p-4 mb-3">
                                        <div class="text-xs font-mono text-green-800 mb-2">STAR TOPOLOGY</div>
                                        <div class="flex justify-center items-center">
                                            <div class="w-6 h-6 bg-green-600 rounded-full"></div>
                                            <div class="absolute">
                                                <div class="w-3 h-3 bg-green-600 rounded-full" style="transform: translate(-20px, -10px)"></div>
                                                <div class="w-3 h-3 bg-green-600 rounded-full" style="transform: translate(20px, -10px)"></div>
                                                <div class="w-3 h-3 bg-green-600 rounded-full" style="transform: translate(0, 15px)"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600">Semua perangkat terhubung ke pusat</p>
                                </div>
                                
                                <div class="text-center">
                                    <div class="bg-purple-100 rounded-lg p-4 mb-3">
                                        <div class="text-xs font-mono text-purple-800 mb-2">RING TOPOLOGY</div>
                                        <div class="flex justify-center items-center">
                                            <div class="relative w-16 h-16">
                                                <div class="absolute w-3 h-3 bg-purple-600 rounded-full" style="top: 0; left: 50%; transform: translateX(-50%)"></div>
                                                <div class="absolute w-3 h-3 bg-purple-600 rounded-full" style="top: 50%; right: 0; transform: translateY(-50%)"></div>
                                                <div class="absolute w-3 h-3 bg-purple-600 rounded-full" style="bottom: 0; left: 50%; transform: translateX(-50%)"></div>
                                                <div class="absolute w-3 h-3 bg-purple-600 rounded-full" style="top: 50%; left: 0; transform: translateY(-50%)"></div>
                                                <div class="absolute inset-2 border-2 border-purple-600 rounded-full"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600">Perangkat terhubung membentuk lingkaran</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 2.3 -->
                <section id="protokol-jaringan" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-purple-100 text-purple-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">2.3</span>
                        Protokol Jaringan
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Protokol adalah aturan dan standar yang mengatur komunikasi antar perangkat dalam jaringan. Tanpa protokol, perangkat tidak bisa saling memahami.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">TCP/IP Protocol Suite</h4>
                                <div class="bg-white rounded p-4 mb-4">
                                    <h5 class="font-medium text-blue-900 mb-2">Application Layer</h5>
                                    <ul class="text-sm text-blue-800 space-y-1">
                                        <li><strong>HTTP/HTTPS:</strong> Web browsing</li>
                                        <li><strong>FTP:</strong> File transfer</li>
                                        <li><strong>SMTP:</strong> Email sending</li>
                                        <li><strong>DNS:</strong> Domain name resolution</li>
                                    </ul>
                                </div>
                                <div class="bg-white rounded p-4 mb-4">
                                    <h5 class="font-medium text-blue-900 mb-2">Transport Layer</h5>
                                    <ul class="text-sm text-blue-800 space-y-1">
                                        <li><strong>TCP:</strong> Reliable, connection-oriented</li>
                                        <li><strong>UDP:</strong> Fast, connectionless</li>
                                    </ul>
                                </div>
                                <div class="bg-white rounded p-4">
                                    <h5 class="font-medium text-blue-900 mb-2">Network Layer</h5>
                                    <ul class="text-sm text-blue-800 space-y-1">
                                        <li><strong>IP:</strong> Addressing and routing</li>
                                        <li><strong>ICMP:</strong> Error reporting</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Perbedaan TCP vs UDP</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-green-900 mb-2">TCP (Transmission Control Protocol)</h5>
                                        <ul class="text-sm text-green-800 space-y-1">
                                            <li>✓ Reliable (terjamin sampai)</li>
                                            <li>✓ Connection-oriented</li>
                                            <li>✓ Error detection & correction</li>
                                            <li>✓ Ordered delivery</li>
                                            <li>✓ Slower but reliable</li>
                                            <li><strong>Contoh:</strong> Web, Email, FTP</li>
                                        </ul>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-orange-900 mb-2">UDP (User Datagram Protocol)</h5>
                                        <ul class="text-sm text-orange-800 space-y-1">
                                            <li>✓ Fast & lightweight</li>
                                            <li>✓ Connectionless</li>
                                            <li>✓ No error recovery</li>
                                            <li>✓ No delivery guarantee</li>
                                            <li>✓ Faster but unreliable</li>
                                            <li><strong>Contoh:</strong> Video streaming, Gaming</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 2.4 -->
                <section id="ip-address" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-purple-100 text-purple-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">2.4</span>
                        IP Address dan DNS
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            IP Address adalah alamat unik untuk setiap perangkat di jaringan, sedangkan DNS (Domain Name System) menerjemahkan nama domain menjadi IP address.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Jenis-jenis IP Address</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-blue-900 mb-2">IPv4</h5>
                                        <ul class="text-sm text-blue-800 space-y-1">
                                            <li>Format: 192.168.1.1</li>
                                            <li>32-bit address</li>
                                            <li>~4.3 milyar alamat</li>
                                            <li>Masih dominan saat ini</li>
                                        </ul>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-green-900 mb-2">IPv6</h5>
                                        <ul class="text-sm text-green-800 space-y-1">
                                            <li>Format: 2001:0db8:85a3::8a2e:0370:7334</li>
                                            <li>128-bit address</li>
                                            <li>~3.4×10³⁸ alamat</li>
                                            <li>Future of internet</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Kelas IP Address (IPv4)</h4>
                                <div class="bg-white rounded p-4 mb-4">
                                    <table class="w-full text-sm">
                                        <thead>
                                            <tr class="bg-green-100">
                                                <th class="text-left p-2">Kelas</th>
                                                <th class="text-left p-2">Range</th>
                                                <th class="text-left p-2">Default Subnet</th>
                                                <th class="text-left p-2">Penggunaan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="p-2">A</td>
                                                <td class="p-2">1.0.0.0 - 126.255.255.255</td>
                                                <td class="p-2">255.0.0.0</td>
                                                <td class="p-2">Jaringan besar</td>
                                            </tr>
                                            <tr class="bg-gray-50">
                                                <td class="p-2">B</td>
                                                <td class="p-2">128.0.0.0 - 191.255.255.255</td>
                                                <td class="p-2">255.255.0.0</td>
                                                <td class="p-2">Jaringan menengah</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2">C</td>
                                                <td class="p-2">192.0.0.0 - 223.255.255.255</td>
                                                <td class="p-2">255.255.255.0</td>
                                                <td class="p-2">Jaringan kecil</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">DNS (Domain Name System)</h4>
                                <div class="bg-white rounded p-4 mb-4">
                                    <h5 class="font-medium text-yellow-900 mb-2">Cara Kerja DNS</h5>
                                    <ol class="list-decimal list-inside space-y-2 text-sm text-gray-700">
                                        <li>User mengetik www.example.com</li>
                                        <li>Browser cek cache lokal</li>
                                        <li>Query ke DNS resolver</li>
                                        <li>Resolver cek root server</li>
                                        <li>Root server arahkan ke TLD server</li>
                                        <li>TLD server arahkan ke authoritative server</li>
                                        <li>IP address dikembalikan ke user</li>
                                    </ol>
                                </div>
                                <div class="bg-gray-800 rounded p-3 text-green-400 font-mono text-sm">
                                    <div># Cek DNS dengan command line</div>
                                    <div>nslookup google.com</div>
                                    <div>dig google.com</div>
                                    <div></div>
                                    <div># Cek DNS di Windows</div>
                                    <div>ipconfig /displaydns</div>
                                    <div>ipconfig /flushdns</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 2.5 -->
                <section id="http-https" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-purple-100 text-purple-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">2.5</span>
                        HTTP dan HTTPS
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            HTTP (HyperText Transfer Protocol) adalah protokol untuk mentransfer data di web, sedangkan HTTPS adalah versi aman dengan enkripsi.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Perbedaan HTTP vs HTTPS</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-red-900 mb-2">HTTP</h5>
                                        <ul class="text-sm text-red-800 space-y-1">
                                            <li>❌ Tidak terenkripsi</li>
                                            <li>❌ Rentan terhadap serangan</li>
                                            <li>❌ Tidak ada verifikasi</li>
                                            <li>✓ Lebih cepat</li>
                                            <li>✓ Tidak memerlukan sertifikat</li>
                                            <li>Port: 80</li>
                                        </ul>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-green-900 mb-2">HTTPS</h5>
                                        <ul class="text-sm text-green-800 space-y-1">
                                            <li>✓ Terenkripsi (SSL/TLS)</li>
                                            <li>✓ Aman dari serangan</li>
                                            <li>✓ Ada verifikasi identitas</li>
                                            <li>❌ Lebih lambat sedikit</li>
                                            <li>❌ Memerlukan sertifikat SSL</li>
                                            <li>Port: 443</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">HTTP Request Methods</h4>
                                <div class="bg-white rounded p-4">
                                    <table class="w-full text-sm">
                                        <thead>
                                            <tr class="bg-green-100">
                                                <th class="text-left p-2">Method</th>
                                                <th class="text-left p-2">Deskripsi</th>
                                                <th class="text-left p-2">Contoh Penggunaan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="p-2 font-mono">GET</td>
                                                <td class="p-2">Mengambil data</td>
                                                <td class="p-2">Mengambil halaman web</td>
                                            </tr>
                                            <tr class="bg-gray-50">
                                                <td class="p-2 font-mono">POST</td>
                                                <td class="p-2">Mengirim data</td>
                                                <td class="p-2">Submit form, upload file</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 font-mono">PUT</td>
                                                <td class="p-2">Update data</td>
                                                <td class="p-2">Update profil user</td>
                                            </tr>
                                            <tr class="bg-gray-50">
                                                <td class="p-2 font-mono">DELETE</td>
                                                <td class="p-2">Menghapus data</td>
                                                <td class="p-2">Delete postingan</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">HTTP Status Codes</h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-green-900 mb-2">2xx Success</h5>
                                        <ul class="text-sm text-gray-700 space-y-1">
                                            <li><strong>200 OK:</strong> Request berhasil</li>
                                            <li><strong>201 Created:</strong> Resource dibuat</li>
                                            <li><strong>204 No Content:</strong> Success tanpa content</li>
                                        </ul>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-orange-900 mb-2">3xx Redirection</h5>
                                        <ul class="text-sm text-gray-700 space-y-1">
                                            <li><strong>301 Moved:</strong> Permanent redirect</li>
                                            <li><strong>302 Found:</strong> Temporary redirect</li>
                                            <li><strong>304 Not Modified:</strong> Cache masih valid</li>
                                        </ul>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-red-900 mb-2">4xx Client Error</h5>
                                        <ul class="text-sm text-gray-700 space-y-1">
                                            <li><strong>400 Bad Request:</strong> Request invalid</li>
                                            <li><strong>401 Unauthorized:</strong> Butuh autentikasi</li>
                                            <li><strong>404 Not Found:</strong> Resource tidak ditemukan</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 2.6 -->
                <section id="praktik-jaringan" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-purple-100 text-purple-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">2.6</span>
                        Praktik Jaringan
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Untuk memperkuat pemahaman Anda, coba lakukan latihan praktik berikut:
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg p-6">
                                <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                                    <i data-feather="target" class="w-5 h-5 mr-2 text-blue-600"></i>
                                    Tugas 1: Eksplorasi Jaringan Lokal
                                </h4>
                                <ol class="list-decimal list-inside space-y-2 text-gray-700">
                                    <li>Buka Command Prompt/Terminal di komputer Anda</li>
                                    <li>Ketik <code class="bg-gray-200 px-2 py-1 rounded">ipconfig</code> (Windows) atau <code class="bg-gray-200 px-2 py-1 rounded">ifconfig</code> (Mac/Linux)</li>
                                    <li>Catat IP address komputer Anda</li>
                                    <li>Coba perintah <code class="bg-gray-200 px-2 py-1 rounded">ping google.com</code> untuk test koneksi</li>
                                    <li>Gunakan <code class="bg-gray-200 px-2 py-1 rounded">tracert google.com</code> untuk melihat route</li>
                                </ol>
                            </div>

                            <div class="bg-gradient-to-r from-green-50 to-teal-50 rounded-lg p-6">
                                <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                                    <i data-feather="search" class="w-5 h-5 mr-2 text-green-600"></i>
                                    Tugas 2: Setup Jaringan Sederhana
                                </h4>
                                <ol class="list-decimal list-inside space-y-2 text-gray-700">
                                    <li>Koneksikan 2-3 komputer ke router WiFi yang sama</li>
                                    <li>Pastikan semua komputer mendapat IP dari DHCP</li>
                                    <li>Coba ping antar komputer untuk test connectivity</li>
                                    <li>Bagikan folder/file antar komputer</li>
                                    <li>Test printing ke printer yang sama (jika tersedia)</li>
                                </ol>
                            </div>

                            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-lg p-6">
                                <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                                    <i data-feather="zap" class="w-5 h-5 mr-2 text-yellow-600"></i>
                                    Tugas 3: Analisis Website
                                </h4>
                                <ol class="list-decimal list-inside space-y-2 text-gray-700">
                                    <li>Buka browser dan akses website favorit Anda</li>
                                    <li>Buka Developer Tools (F12)</li>
                                    <li>Pergi ke tab Network</li>
                                    <li>Refresh halaman dan amati request/response</li>
                                    <li>Catat status code, method, dan waktu response</li>
                                    <li>Identifikasi protokol yang digunakan (HTTP/HTTPS)</li>
                                </ol>
                            </div>
                        </div>

                        <div class="bg-purple-600 text-white rounded-lg p-6">
                            <h4 class="font-semibold mb-3 flex items-center">
                                <i data-feather="award" class="w-5 h-5 mr-2"></i>
                                Evaluasi Diri
                            </h4>
                            <p class="mb-3">Setelah menyelesaikan semua tugas, nilai pemahaman Anda:</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div class="bg-purple-500 rounded p-3">
                                    <strong>Level 1:</strong> Saya bisa menjelaskan perbedaan LAN, WAN, dan PAN
                                </div>
                                <div class="bg-purple-500 rounded p-3">
                                    <strong>Level 2:</strong> Saya bisa mengidentifikasi IP address dan subnet mask komputer saya
                                </div>
                                <div class="bg-purple-500 rounded p-3">
                                    <strong>Level 3:</strong> Saya bisa menjelaskan perbedaan HTTP dan HTTPS serta status code yang umum
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Navigation -->
                <div class="flex justify-between items-center bg-white rounded-lg shadow-md p-6">
                    <div>
                        <a href="<?= base_url('documentation/chapter1') ?>" class="text-gray-600 hover:text-gray-800 flex items-center">
                            <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                            Kembali ke Bab 1
                        </a>
                    </div>
                    <div class="text-center">
                        <span class="text-sm text-gray-500">Bab 2 dari 10</span>
                        <div class="flex space-x-1 mt-1">
                            <div class="w-3 h-3 bg-purple-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-purple-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-purple-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-purple-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-purple-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-purple-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                        </div>
                    </div>
                    <div>
                        <a href="<?= base_url('documentation/chapter3') ?>" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg flex items-center">
                            Lanjut ke Bab 3
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