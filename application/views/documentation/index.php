<?php $this->load->view('documentation/templates/_header'); ?>

    <!-- Hero Section -->
    <section class="relative py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="max-w-7xl mx-auto text-center">
            <div class="mb-8" data-aos="fade-up">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-4">
                    Dokumentasi Teknologi
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                        untuk Pemula
                    </span>
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Panduan lengkap dasar-dasar teknologi dan ilmu komputer yang dirancang khusus untuk pemula. 
                    Mulai dari nol dan jadilah ahli dengan 10 bab komprehensif.
                </p>
            </div>
            
            <div class="flex justify-center" data-aos="fade-up" data-aos-delay="200">
                <a href="#chapters" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-full hover:shadow-lg transform hover:scale-105 transition duration-300">
                    <i data-feather="book-open" class="mr-2"></i>
                    Mulai Belajar
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div class="p-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-4xl font-bold text-blue-600 mb-2">10</div>
                    <div class="text-gray-600">Bab Materi</div>
                </div>
                <div class="p-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-4xl font-bold text-purple-600 mb-2">50+</div>
                    <div class="text-gray-600">Contoh Kode</div>
                </div>
                <div class="p-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-4xl font-bold text-green-600 mb-2">100+</div>
                    <div class="text-gray-600">Gambar Ilustrasi</div>
                </div>
                <div class="p-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-4xl font-bold text-orange-600 mb-2">∞</div>
                    <div class="text-gray-600">Gratis</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Chapters Section -->
    <section id="chapters" class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    10 Bab Komprehensif
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Setiap bab dirancang untuk membangun pemahaman bertahap dari dasar hingga konsep yang lebih kompleks.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Chapter 1 -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-2 bg-gradient-to-r from-blue-500 to-blue-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-blue-600 bg-blue-100 px-3 py-1 rounded-full">Bab 1</span>
                            <i data-feather="monitor" class="w-8 h-8 text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Pengenalan Komputer dan Sistem Operasi</h3>
                        <p class="text-gray-600 mb-4">Memahami komponen dasar komputer, hardware, software, dan berbagai sistem operasi.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">15-20 menit</span>
                            <a href="<?= base_url('documentation/chapter1') ?>" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center">
                                Mulai <i data-feather="arrow-right" class="w-4 h-4 ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Chapter 2 -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="h-2 bg-gradient-to-r from-purple-500 to-purple-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-purple-600 bg-purple-100 px-3 py-1 rounded-full">Bab 2</span>
                            <i data-feather="wifi" class="w-8 h-8 text-purple-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Dasar-dasar Jaringan Komputer</h3>
                        <p class="text-gray-600 mb-4">Konsep jaringan, IP address, DNS, HTTP/HTTPS, dan protokol internet.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">20-25 menit</span>
                            <a href="<?= base_url('documentation/chapter2') ?>" class="text-purple-600 hover:text-purple-800 font-semibold flex items-center">
                                Mulai <i data-feather="arrow-right" class="w-4 h-4 ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Chapter 3 -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                    <div class="h-2 bg-gradient-to-r from-green-500 to-green-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-green-600 bg-green-100 px-3 py-1 rounded-full">Bab 3</span>
                            <i data-feather="code" class="w-8 h-8 text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Pengenalan Pemrograman</h3>
                        <p class="text-gray-600 mb-4">Konsep algoritma, flowchart, pseudocode, dan logika pemrograman.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">25-30 menit</span>
                            <a href="<?= base_url('documentation/chapter3') ?>" class="text-green-600 hover:text-green-800 font-semibold flex items-center">
                                Mulai <i data-feather="arrow-right" class="w-4 h-4 ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Chapter 4 -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="400">
                    <div class="h-2 bg-gradient-to-r from-orange-500 to-orange-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-orange-600 bg-orange-100 px-3 py-1 rounded-full">Bab 4</span>
                            <i data-feather="terminal" class="w-8 h-8 text-orange-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Bahasa Pemrograman Dasar</h3>
                        <p class="text-gray-600 mb-4">Mengenal Python, JavaScript, Java, PHP dan sintaks dasar pemrograman.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">30-35 menit</span>
                            <a href="<?= base_url('documentation/chapter4') ?>" class="text-orange-600 hover:text-orange-800 font-semibold flex items-center">
                                Mulai <i data-feather="arrow-right" class="w-4 h-4 ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Chapter 5 -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="500">
                    <div class="h-2 bg-gradient-to-r from-red-500 to-red-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-red-600 bg-red-100 px-3 py-1 rounded-full">Bab 5</span>
                            <i data-feather="database" class="w-8 h-8 text-red-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Struktur Data Dasar</h3>
                        <p class="text-gray-600 mb-4">Array, list, stack, queue, dictionary dan struktur data fundamental.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">25-30 menit</span>
                            <a href="<?= base_url('documentation/chapter5') ?>" class="text-red-600 hover:text-red-800 font-semibold flex items-center">
                                Mulai <i data-feather="arrow-right" class="w-4 h-4 ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Chapter 6 -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="600">
                    <div class="h-2 bg-gradient-to-r from-indigo-500 to-indigo-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-indigo-600 bg-indigo-100 px-3 py-1 rounded-full">Bab 6</span>
                            <i data-feather="server" class="w-8 h-8 text-indigo-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Database dan SQL</h3>
                        <p class="text-gray-600 mb-4">Pengenalan database, query SQL dasar, MySQL dan PostgreSQL.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">30-35 menit</span>
                            <a href="<?= base_url('documentation/chapter6') ?>" class="text-indigo-600 hover:text-indigo-800 font-semibold flex items-center">
                                Mulai <i data-feather="arrow-right" class="w-4 h-4 ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Chapter 7 -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="700">
                    <div class="h-2 bg-gradient-to-r from-teal-500 to-teal-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-teal-600 bg-teal-100 px-3 py-1 rounded-full">Bab 7</span>
                            <i data-feather="globe" class="w-8 h-8 text-teal-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Web Development Dasar</h3>
                        <p class="text-gray-600 mb-4">HTML, CSS, JavaScript untuk membangun website modern.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">35-40 menit</span>
                            <a href="<?= base_url('documentation/chapter7') ?>" class="text-teal-600 hover:text-teal-800 font-semibold flex items-center">
                                Mulai <i data-feather="arrow-right" class="w-4 h-4 ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Chapter 8 -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="800">
                    <div class="h-2 bg-gradient-to-r from-yellow-500 to-yellow-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-yellow-600 bg-yellow-100 px-3 py-1 rounded-full">Bab 8</span>
                            <i data-feather="git-branch" class="w-8 h-8 text-yellow-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Version Control dengan Git</h3>
                        <p class="text-gray-600 mb-4">Mengelola kode dengan Git, GitHub, dan kolaborasi tim.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">20-25 menit</span>
                            <a href="<?= base_url('documentation/chapter8') ?>" class="text-yellow-600 hover:text-yellow-800 font-semibold flex items-center">
                                Mulai <i data-feather="arrow-right" class="w-4 h-4 ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Chapter 9 -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="900">
                    <div class="h-2 bg-gradient-to-r from-pink-500 to-pink-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-pink-600 bg-pink-100 px-3 py-1 rounded-full">Bab 9</span>
                            <i data-feather="shield" class="w-8 h-8 text-pink-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Security dan Best Practices</h3>
                        <p class="text-gray-600 mb-4">Keamanan aplikasi, validasi data, dan praktik terbaik programming.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">25-30 menit</span>
                            <a href="<?= base_url('documentation/chapter9') ?>" class="text-pink-600 hover:text-pink-800 font-semibold flex items-center">
                                Mulai <i data-feather="arrow-right" class="w-4 h-4 ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Chapter 10 -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="1000">
                    <div class="h-2 bg-gradient-to-r from-gray-500 to-gray-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-gray-600 bg-gray-100 px-3 py-1 rounded-full">Bab 10</span>
                            <i data-feather="trending-up" class="w-8 h-8 text-gray-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Karier dan Pengembangan Diri</h3>
                        <p class="text-gray-600 mb-4">Membangun portfolio, persiapan interview, dan pengembangan karier.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">30-35 menit</span>
                            <a href="<?= base_url('documentation/chapter10') ?>" class="text-gray-600 hover:text-gray-800 font-semibold flex items-center">
                                Mulai <i data-feather="arrow-right" class="w-4 h-4 ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Kenapa Memilih Dokumentasi Kami?
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kami menyediakan pengalaman belajar yang komprehensif dan menyenangkan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-feather="book-open" class="w-8 h-8 text-blue-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Mudah Dipahami</h3>
                    <p class="text-gray-600">Penjelasan yang sederhana dengan contoh nyata dan ilustrasi menarik.</p>
                </div>

                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-feather="code" class="w-8 h-8 text-green-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Contoh Kode</h3>
                    <p class="text-gray-600">Banyak contoh kode praktis yang bisa langsung dicoba dan dipelajari.</p>
                </div>

                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-feather="clock" class="w-8 h-8 text-purple-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belajar Mandiri</h3>
                    <p class="text-gray-600">Pelajari kapan saja dan dimana saja sesuai dengan ritme Anda.</p>
                </div>

                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-feather="trending-up" class="w-8 h-8 text-orange-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Update Terus</h3>
                    <p class="text-gray-600">Konten yang selalu diperbarui mengikuti perkembangan teknologi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <div data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Siap Memulai Perjalanan Teknologi Anda?
                </h2>
                <p class="text-xl text-blue-100 mb-8">
                    Jangan tunggu lagi. Mulai belajar sekarang dan bangun fondasi yang kuat untuk karier teknologi Anda.
                </p>
                <a href="<?= base_url('documentation/chapter1') ?>" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-full hover:shadow-lg transform hover:scale-105 transition duration-300">
                    <i data-feather="rocket" class="mr-2"></i>
                    Mulai Bab 1
                </a>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('documentation/templates/_footer'); ?>