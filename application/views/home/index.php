<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="programming, coding, web development, academy, belajar programming, kursus online">
    <meta name="author" content="Academy Lite">

    <title><?php echo $title; ?></title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Styles -->
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stagger-animation {
            animation: fadeIn 0.8s ease-in-out;
        }

        .stagger-animation:nth-child(1) { animation-delay: 0.1s; }
        .stagger-animation:nth-child(2) { animation-delay: 0.2s; }
        .stagger-animation:nth-child(3) { animation-delay: 0.3s; }
        .stagger-animation:nth-child(4) { animation-delay: 0.4s; }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .scroll-reveal.reveal {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="<?php echo site_url('home'); ?>" class="text-2xl font-bold gradient-text">
                            Academy Lite
                        </a>
                    </div>
                    <div class="hidden md:block ml-10">
                        <div class="flex items-baseline space-x-4">
                            <a href="#home" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Beranda</a>
                            <a href="#premium" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Kelas Premium</a>
                            <a href="#free" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Kelas Gratis</a>
                            <a href="#about" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Tentang</a>
                            <a href="#faq" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">FAQ</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <?php if ($this->session->userdata('logged_in')): ?>
                        <a href="<?php echo site_url('dashboard'); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Dashboard
                        </a>
                    <?php else: ?>
                        <a href="<?php echo site_url('auth/login'); ?>" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">
                            Masuk
                        </a>
                        <a href="<?php echo site_url('auth/register'); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Daftar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-gradient relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-white fade-in">
                    <h1 class="text-4xl lg:text-6xl font-bold mb-6 leading-tight">
                        Belajar <span class="gradient-text">Programming</span> <br>
                        Jadi Mudah & Menyenangkan
                    </h1>
                    <p class="text-xl lg:text-2xl mb-8 text-blue-100 leading-relaxed">
                        Tingkatkan skill programming Anda dengan kelas premium dan gratis dari instruktur berpengalaman. Mulai dari pemula hingga expert.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#premium" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-rocket mr-2"></i>Lihat Kelas Premium
                        </a>
                        <a href="#free" class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-play-circle mr-2"></i>Kelas Gratis
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="floating">
                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Programming Illustration" class="w-full h-auto rounded-2xl shadow-2xl">
                    </div>
                    <div class="absolute -top-4 -right-4 bg-yellow-400 text-gray-900 px-4 py-2 rounded-lg font-semibold shadow-lg">
                        <i class="fas fa-star text-yellow-600 mr-1"></i>4.9/5 Rating
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center stagger-animation">
                    <div class="text-4xl font-bold text-blue-600 mb-2"><?php echo count($premium_classes); ?>+</div>
                    <div class="text-gray-600">Kelas Premium</div>
                </div>
                <div class="text-center stagger-animation">
                    <div class="text-4xl font-bold text-green-600 mb-2"><?php echo count($free_classes); ?>+</div>
                    <div class="text-gray-600">Kelas Gratis</div>
                </div>
                <div class="text-center stagger-animation">
                    <div class="text-4xl font-bold text-purple-600 mb-2">10K+</div>
                    <div class="text-gray-600">Siswa Aktif</div>
                </div>
                <div class="text-center stagger-animation">
                    <div class="text-4xl font-bold text-orange-600 mb-2">50+</div>
                    <div class="text-gray-600">Instruktur</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Premium Classes Section -->
    <section id="premium" class="py-20 bg-gray-50 scroll-reveal">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Kelas <span class="gradient-text">Premium</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Kelas berkualitas tinggi dengan materi komprehensif dan dukungan instruktur profesional
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($featured_premium as $class): ?>
                    <div class="bg-white rounded-xl shadow-lg card-hover overflow-hidden">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php echo html_escape($class->nama_kelas); ?>" class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4">
                                <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    Premium
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2"><?php echo html_escape($class->nama_kelas); ?></h3>
                            <p class="text-gray-600 mb-4 line-clamp-2"><?php echo html_escape($class->deskripsi); ?></p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm font-medium text-gray-700"><?php echo html_escape($class->bahasa_program); ?></span>
                                    <span class="text-sm text-gray-500">•</span>
                                    <span class="text-sm text-gray-500"><?php echo html_escape($class->level); ?></span>
                                </div>
                                <a href="<?php echo site_url('kelas/detail/' . $class->id); ?>" class="text-blue-600 hover:text-blue-800 font-medium">
                                    Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-12">
                <a href="<?php echo site_url('home/premium'); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Lihat Semua Kelas Premium <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Free Classes Section -->
    <section id="free" class="py-20 bg-white scroll-reveal">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Kelas <span class="gradient-text">Gratis</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Mulai perjalanan programming Anda dengan kelas gratis berkualitas tinggi
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($featured_free as $class): ?>
                    <div class="bg-white rounded-xl shadow-lg card-hover overflow-hidden border-2 border-green-200">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php echo html_escape($class->title); ?>" class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4">
                                <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    <i class="fas fa-gift mr-1"></i>Gratis
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2"><?php echo html_escape($class->title); ?></h3>
                            <p class="text-gray-600 mb-4 line-clamp-2"><?php echo html_escape($class->description); ?></p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm font-medium text-gray-700"><?php echo html_escape($class->category); ?></span>
                                    <span class="text-sm text-gray-500">•</span>
                                    <span class="text-sm text-gray-500"><?php echo html_escape($class->level); ?></span>
                                </div>
                                <a href="<?php echo site_url('free_classes/view/' . $class->id); ?>" class="text-green-600 hover:text-green-800 font-medium">
                                    Mulai Belajar <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-12">
                <a href="<?php echo site_url('home/free'); ?>" class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Lihat Semua Kelas Gratis <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-50 scroll-reveal">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Mengapa Memilih <span class="gradient-text">Academy Lite</span>?
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Kami berkomitmen memberikan pengalaman belajar terbaik untuk semua siswa
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg text-center card-hover">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-users text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Instruktur Berpengalaman</h3>
                    <p class="text-gray-600">Belajar dari instruktur profesional dengan pengalaman bertahun-tahun di industri</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg text-center card-hover">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-clock text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Fleksibilitas Waktu</h3>
                    <p class="text-gray-600">Belajar kapan saja dan di mana saja sesuai dengan jadwal Anda</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg text-center card-hover">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-certificate text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Sertifikat Resmi</h3>
                    <p class="text-gray-600">Dapatkan sertifikat resmi setelah menyelesaikan kelas</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg text-center card-hover">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-code text-2xl text-orange-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Proyek Praktis</h3>
                    <p class="text-gray-600">Pelajari dengan proyek-proyek nyata yang bisa langsung diterapkan</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg text-center card-hover">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-comments text-2xl text-red-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Komunitas Support</h3>
                    <p class="text-gray-600">Bergabung dengan komunitas siswa dan dapatkan dukungan dari teman-teman</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg text-center card-hover">
                    <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-mobile-alt text-2xl text-teal-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Mobile Friendly</h3>
                    <p class="text-gray-600">Akses materi belajar dari smartphone dan tablet Anda</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white scroll-reveal">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">
                        Tentang <span class="gradient-text">Academy Lite</span>
                    </h2>
                    <p class="text-lg text-gray-600 mb-6">
                        Academy Lite adalah platform pembelajaran programming terdepan yang berkomitmen untuk mendidik programmer masa depan. Kami menyediakan berbagai kelas premium dan gratis dengan kualitas terbaik.
                    </p>
                    <p class="text-lg text-gray-600 mb-8">
                        Dengan instruktur berpengalaman dan materi yang selalu update, kami membantu Anda menguasai skill programming dari level pemula hingga expert. Bergabunglah dengan ribuan siswa yang telah sukses berkarir di dunia teknologi.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                            <span class="text-gray-700">Materi Terstruktur & Komprehensif</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                            <span class="text-gray-700">Instruktur Profesional</span>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 mt-4">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                            <span class="text-gray-700">Proyek Praktis & Portofolio</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                            <span class="text-gray-700">Sertifikat Resmi</span>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="About Academy Lite" class="w-full h-auto rounded-2xl shadow-2xl">
                    <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-xl shadow-lg">
                        <div class="flex items-center space-x-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600">10K+</div>
                                <div class="text-sm text-gray-600">Siswa Aktif</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600">500+</div>
                                <div class="text-sm text-gray-600">Kelas</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-purple-600">50+</div>
                                <div class="text-sm text-gray-600">Instruktur</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-20 bg-gray-50 scroll-reveal">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Pertanyaan <span class="gradient-text">Umum</span>
                </h2>
                <p class="text-xl text-gray-600">
                    Temukan jawaban untuk pertanyaan yang sering ditanyakan
                </p>
            </div>

            <div class="space-y-4">
                <div class="bg-white rounded-lg shadow-sm">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFAQ(this)">
                        <span class="text-lg font-medium text-gray-900">Apakah saya bisa belajar programming dari nol?</span>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                    </button>
                    <div class="px-6 pb-4 hidden">
                        <p class="text-gray-600">Tentu saja! Kami memiliki kelas khusus untuk pemula yang dirancang untuk membantu Anda belajar programming dari dasar. Instruktur kami akan memandu Anda step by step dengan bahasa yang mudah dipahami.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFAQ(this)">
                        <span class="text-lg font-medium text-gray-900">Berapa lama waktu yang dibutuhkan untuk menyelesaikan satu kelas?</span>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                    </button>
                    <div class="px-6 pb-4 hidden">
                        <p class="text-gray-600">Waktu penyelesaian tergantung pada kompleksitas kelas dan waktu yang Anda dedikasikan. Rata-rata, siswa menyelesaikan kelas dalam 2-8 minggu dengan belajar 5-10 jam per minggu.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFAQ(this)">
                        <span class="text-lg font-medium text-gray-900">Apakah saya akan mendapat sertifikat setelah menyelesaikan kelas?</span>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                    </button>
                    <div class="px-6 pb-4 hidden">
                        <p class="text-gray-600">Ya, Anda akan mendapat sertifikat resmi Academy Lite setelah menyelesaikan kelas dengan baik. Sertifikat ini dapat digunakan untuk melamar pekerjaan atau ditampilkan di portofolio Anda.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFAQ(this)">
                        <span class="text-lg font-medium text-gray-900">Apakah ada dukungan teknis jika saya mengalami kesulitan?</span>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                    </button>
                    <div class="px-6 pb-4 hidden">
                        <p class="text-gray-600">Ya, kami menyediakan berbagai bentuk dukungan: forum diskusi, email support, dan komunitas siswa aktif. Instruktur juga akan menjawab pertanyaan Anda dalam waktu 24 jam.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFAQ(this)">
                        <span class="text-lg font-medium text-gray-900">Apakah saya bisa mengakses materi kelas kapan saja?</span>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                    </button>
                    <div class="px-6 pb-4 hidden">
                        <p class="text-gray-600">Ya, semua materi kelas dapat diakses 24/7. Anda bisa belajar sesuai dengan jadwal Anda sendiri tanpa batasan waktu, selama akun Anda masih aktif.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFAQ(this)">
                        <span class="text-lg font-medium text-gray-900">Bagaimana cara mendaftar dan mulai belajar?</span>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                    </button>
                    <div class="px-6 pb-4 hidden">
                        <p class="text-gray-600">Prosesnya sangat mudah! Daftar akun gratis, pilih kelas yang Anda inginkan, lakukan pembayaran jika kelas premium, dan langsung mulai belajar. Panduan lengkap akan diberikan setelah pendaftaran.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-700">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                Siap Memulai Perjalanan Programming Anda?
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                Bergabunglah dengan ribuan siswa yang telah berhasil menguasai programming bersama Academy Lite
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <?php if ($this->session->userdata('logged_in')): ?>
                    <a href="<?php echo site_url('dashboard'); ?>" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Lanjutkan Belajar
                    </a>
                <?php else: ?>
                    <a href="<?php echo site_url('auth/register'); ?>" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Mulai Belajar Sekarang
                    </a>
                    <a href="#free" class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:scale-105">
                        Jelajahi Kelas Gratis
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center mb-4">
                        <span class="text-2xl font-bold gradient-text">Academy Lite</span>
                    </div>
                    <p class="text-gray-400 mb-4 max-w-md">
                        Platform pembelajaran programming terdepan yang membantu Anda menguasai skill programming dari level pemula hingga expert.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Platform</h3>
                    <ul class="space-y-2">
                        <li><a href="#premium" class="text-gray-400 hover:text-white transition-colors">Kelas Premium</a></li>
                        <li><a href="#free" class="text-gray-400 hover:text-white transition-colors">Kelas Gratis</a></li>
                        <li><a href="<?php echo site_url('auth/login'); ?>" class="text-gray-400 hover:text-white transition-colors">Masuk</a></li>
                        <li><a href="<?php echo site_url('auth/register'); ?>" class="text-gray-400 hover:text-white transition-colors">Daftar</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Dukungan</h3>
                    <ul class="space-y-2">
                        <li><a href="#faq" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kontak</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Bantuan</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    &copy; <?php echo date('Y'); ?> Academy Lite. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="fixed bottom-8 right-8 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg opacity-0 transition-opacity duration-300">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- JavaScript -->
    <script>
        // FAQ Toggle Function
        function toggleFAQ(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('i');

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // Scroll Reveal Animation
        function revealOnScroll() {
            const elements = document.querySelectorAll('.scroll-reveal');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;

                if (elementTop < windowHeight - 100) {
                    element.classList.add('reveal');
                }
            });
        }

        // Scroll to Top Button
        function toggleScrollToTop() {
            const button = document.getElementById('scrollToTop');
            if (window.pageYOffset > 300) {
                button.style.opacity = '1';
            } else {
                button.style.opacity = '0';
            }
        }

        document.getElementById('scrollToTop').addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth Scroll for Navigation Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Event Listeners
        window.addEventListener('scroll', () => {
            revealOnScroll();
            toggleScrollToTop();
        });

        window.addEventListener('load', () => {
            revealOnScroll();
        });
    </script>
</body>
</html>
