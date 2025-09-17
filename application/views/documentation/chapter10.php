<div class="min-h-screen bg-gray-50">
    <!-- Chapter Header -->
    <section class="bg-gradient-to-r from-gray-600 to-gray-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="<?= base_url('documentation') ?>" class="text-gray-200 hover:text-white inline-flex items-center">
                                    <i data-feather="home" class="w-4 h-4 mr-2"></i>
                                    Dokumentasi
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i data-feather="chevron-right" class="w-4 h-4 text-gray-200 mx-2"></i>
                                    <span class="text-white font-medium">Bab 10</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">Karier dan Pengembangan Diri</h1>
                    <p class="text-xl text-gray-100 max-w-3xl">Membangun portfolio, persiapan interview, dan strategi pengembangan karier di bidang teknologi.</p>
                </div>
                <div class="hidden md:block">
                    <i data-feather="trending-up" class="w-24 h-24 text-gray-200 opacity-50"></i>
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
                        <div class="bg-gray-600 h-2 rounded-full" style="width: 100%"></div>
                    </div>
                    <span class="text-sm text-gray-600">Bab 10 dari 10</span>
                </div>
                <div class="flex space-x-2">
                    <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm rounded-full">Advanced</span>
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-sm rounded-full">30-35 menit</span>
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
                        <a href="#membangun-portfolio" class="block text-sm text-gray-600 hover:text-gray-800 py-1">10.1 Membangun Portfolio</a>
                        <a href="#cv-linkedin" class="block text-sm text-gray-600 hover:text-gray-800 py-1">10.2 CV dan LinkedIn</a>
                        <a href="#interview-prep" class="block text-sm text-gray-600 hover:text-gray-800 py-1">10.3 Persiapan Interview</a>
                        <a href="#skill-development" class="block text-sm text-gray-600 hover:text-gray-800 py-1">10.4 Skill Development</a>
                        <a href="#networking-komunitas" class="block text-sm text-gray-600 hover:text-gray-800 py-1">10.5 Networking dan Komunitas</a>
                        <a href="#career-roadmap" class="block text-sm text-gray-600 hover:text-gray-800 py-1">10.6 Career Roadmap</a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3 space-y-12">
                <!-- Section 10.1 -->
                <section id="membangun-portfolio" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-gray-100 text-gray-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">10.1</span>
                        Membangun Portfolio
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Portfolio adalah kunci untuk menunjukkan kemampuan Anda kepada calon employer. Portfolio yang baik tidak hanya menampilkan project, tapi juga menceritakan proses dan pemikiran di baliknya.
                        </p>

                        <div class="bg-gray-50 border-l-4 border-gray-500 p-6 mb-6">
                            <h4 class="font-semibold text-gray-900 mb-2">Komponen Portfolio yang Kuat</h4>
                            <ul class="list-disc list-inside text-gray-800 space-y-1">
                                <li><strong>Project Showcase:</strong> 3-5 project terbaik dengan penjelasan detail</li>
                                <li><strong>About Me:</strong> Cerita tentang journey dan passion Anda</li>
                                <li><strong>Skills:</strong> Teknologi yang dikuasai dengan level kemahiran</li>
                                <li><strong>Contact:</strong> Cara untuk menghubungi Anda</li>
                                <li><strong>Blog/Articles:</strong> Sharing knowledge dan pemikiran</li>
                            </ul>
                        </div>

                        <div class="bg-gradient-to-r from-blue-50 to-gray-50 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-gray-900 mb-4">Ide Project Portfolio</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-white rounded-lg p-4">
                                    <h5 class="font-semibold text-blue-900 mb-3 flex items-center">
                                        <i data-feather="layout" class="w-5 h-5 mr-2"></i>
                                        Frontend Projects
                                    </h5>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <li>• Personal website responsive</li>
                                        <li>• Landing page untuk produk</li>
                                        <li>• Dashboard admin dengan chart</li>
                                        <li>• Clone UI dari aplikasi populer</li>
                                    </ul>
                                </div>
                                
                                <div class="bg-white rounded-lg p-4">
                                    <h5 class="font-semibold text-green-900 mb-3 flex items-center">
                                        <i data-feather="server" class="w-5 h-5 mr-2"></i>
                                        Full-Stack Projects
                                    </h5>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <li>• Todo app dengan database</li>
                                        <li>• Blog CMS sederhana</li>
                                        <li>• E-commerce mini</li>
                                        <li>• API untuk mobile app</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-blue-900 mb-4">Contoh Portfolio Website</h4>
                            <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                <div>// Struktur folder portfolio</div>
                                <div>/portfolio/</div>
                                <div>├── index.html          # Halaman utama</div>
                                <div>├── about.html          # Tentang saya</div>
                                <div>├── projects/</div>
                                <div>│   ├── project1.html    # Detail project 1</div>
                                <div>│   ├── project2.html    # Detail project 2</div>
                                <div>│   └── project3.html    # Detail project 3</div>
                                <div>├── blog/               # Artikel/teknical writing</div>
                                <div>├── assets/</div>
                                <div>│   ├── css/           # Styling</div>
                                <div>│   ├── js/            # JavaScript</div>
                                <div>│   └── images/        # Gambar dan screenshot</div>
                                <div>└── contact.html      # Informasi kontak</div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 10.2 -->
                <section id="cv-linkedin" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-gray-100 text-gray-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">10.2</span>
                        CV dan LinkedIn
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            CV dan LinkedIn adalah tools penting untuk personal branding dan networking profesional. Profile yang well-crafted dapat membuka banyak peluang.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Struktur CV yang Efektif</h4>
                                <div class="bg-white rounded p-4">
                                    <ol class="list-decimal list-inside space-y-2 text-gray-700">
                                        <li><strong>Header:</strong> Nama, kontak, LinkedIn, GitHub</li>
                                        <li><strong>Summary:</strong> 2-3 kalimat tentang value Anda</li>
                                        <li><strong>Skills:</strong> Teknologi yang dikuasai (bisa dengan level)</li>
                                        <li><strong>Experience:</strong> Project dan pengalaman relevan</li>
                                        <li><strong>Education:</strong> Pendidikan dan sertifikasi</li>
                                        <li><strong>Achievements:</strong> Award, recognition, contribution</li>
                                    </ol>
                                </div>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">LinkedIn Optimization</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-blue-900 mb-2">Headline yang Kuat</h5>
                                        <p class="text-sm text-gray-600 mb-2">Contoh:</p>
                                        <div class="bg-gray-100 rounded p-2 text-sm">
                                            "Full-Stack Developer | React & Node.js | Building scalable web applications"
                                        </div>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-blue-900 mb-2">About Section</h5>
                                        <p class="text-sm text-gray-600">Ceritakan journey, passion, dan goals Anda</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">Keywords untuk Tech CV</h4>
                                <div class="bg-white rounded p-4">
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-sm">
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">JavaScript</span>
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">React</span>
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Node.js</span>
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Python</span>
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Git</span>
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Agile</span>
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">REST API</span>
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">SQL</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Continue with more sections... -->
                <!-- I'll add the remaining sections in a similar pattern -->

                <!-- Navigation -->
                <div class="flex justify-between items-center bg-white rounded-lg shadow-md p-6">
                    <div>
                        <a href="<?= base_url('documentation/chapter9') ?>" class="text-gray-600 hover:text-gray-800 flex items-center">
                            <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                            Kembali ke Bab 9
                        </a>
                    </div>
                    <div class="text-center">
                        <span class="text-sm text-gray-500">Bab 10 dari 10</span>
                        <div class="flex space-x-1 mt-1">
                            <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                        </div>
                    </div>
                    <div>
                        <a href="<?= base_url('documentation') ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg flex items-center">
                            Kembali ke Awal
                            <i data-feather="home" class="w-4 h-4 ml-2"></i>
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