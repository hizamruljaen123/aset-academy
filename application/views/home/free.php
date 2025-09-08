<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="programming, coding, web development, academy, belajar programming, kursus online">
    <meta name="author" content="Asset Academy">

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
            background: linear-gradient(135deg, #2dd4bf 0%, #06b6d4 100%);
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

        .gradient-text {
            background: linear-gradient(135deg, #2dd4bf 0%, #06b6d4 100%);
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

        .level-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .filter-active {
            background-color: #10b981;
            color: white;
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
                            Asset Academy
                        </a>
                    </div>
                    <div class="hidden md:block ml-10">
                        <div class="flex items-baseline space-x-4">
                            <a href="<?php echo site_url('home'); ?>" class="text-gray-700 hover:text-cyan-600 px-3 py-2 text-sm font-medium transition-colors">Beranda</a>
                            <a href="<?php echo site_url('home/premium'); ?>" class="text-gray-700 hover:text-cyan-600 px-3 py-2 text-sm font-medium transition-colors">Kelas Premium</a>
                            <a href="<?php echo site_url('home/free'); ?>" class="text-cyan-600 px-3 py-2 text-sm font-medium">Kelas Gratis</a>
                            <a href="<?php echo site_url('home/about'); ?>" class="text-gray-700 hover:text-cyan-600 px-3 py-2 text-sm font-medium transition-colors">Tentang</a>
                            <a href="<?php echo site_url('home/faq'); ?>" class="text-gray-700 hover:text-cyan-600 px-3 py-2 text-sm font-medium transition-colors">FAQ</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <?php if ($this->session->userdata('logged_in')): ?>
                        <a href="<?php echo site_url('dashboard'); ?>" class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Dashboard
                        </a>
                    <?php else: ?>
                        <a href="<?php echo site_url('auth/login'); ?>" class="text-gray-700 hover:text-cyan-600 px-3 py-2 text-sm font-medium transition-colors">
                            Masuk
                        </a>
                        <a href="<?php echo site_url('auth/register'); ?>" class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Daftar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="text-center text-white fade-in">
                <h1 class="text-4xl lg:text-5xl font-bold mb-6">
                    Kelas <span class="gradient-text">Gratis</span>
                </h1>
                <p class="text-xl lg:text-2xl mb-8 text-cyan-100 max-w-3xl mx-auto leading-relaxed">
                    Mulai perjalanan programming Anda dengan kelas gratis berkualitas tinggi tanpa biaya apapun
                </p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-8 bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p class="text-gray-600">Menampilkan <span class="font-semibold"><?php echo count($free_classes); ?></span> kelas gratis</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <button class="filter-btn px-4 py-2 text-sm rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 filter-active" data-filter="all">Semua</button>
                    <button class="filter-btn px-4 py-2 text-sm rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200" data-filter="Dasar">Dasar</button>
                    <button class="filter-btn px-4 py-2 text-sm rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200" data-filter="Menengah">Menengah</button>
                    <button class="filter-btn px-4 py-2 text-sm rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200" data-filter="Mahir">Mahir</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Free Classes -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php if (empty($free_classes)): ?>
                <div class="text-center py-16">
                    <div class="mx-auto w-24 h-24 rounded-full bg-teal-100 flex items-center justify-center mb-6">
                        <i class="fas fa-gift text-teal-600 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak ada kelas gratis tersedia</h3>
                    <p class="text-gray-600 mb-6">Silakan periksa kembali nanti untuk kelas baru</p>
                    <a href="<?php echo site_url('home'); ?>" class="inline-flex items-center px-6 py-3 bg-teal-600 text-white rounded-lg font-medium hover:bg-teal-700 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="classesContainer">
                    <?php foreach ($free_classes as $class): 
                        // Determine badge color based on level
                        $levelColors = [
                            'Dasar' => 'bg-green-100 text-green-800',
                            'Menengah' => 'bg-yellow-100 text-yellow-800',
                            'Mahir' => 'bg-red-100 text-red-800',
                            'default' => 'bg-gray-100 text-gray-800'
                        ];
                        $badgeColor = $levelColors[$class->level] ?? $levelColors['default'];
                    ?>
                        <div class="bg-white rounded-xl shadow-lg card-hover overflow-hidden border-2 border-teal-200 class-item" data-level="<?php echo html_escape($class->level); ?>">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php echo html_escape($class->title); ?>" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4">
                                    <span class="bg-teal-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                        <i class="fas fa-gift mr-1"></i>Gratis
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2"><?php echo html_escape($class->title); ?></h3>
                                    <span class="level-badge <?php echo $badgeColor; ?>">
                                        <?php echo html_escape($class->level); ?>
                                    </span>
                                </div>
                                <p class="text-gray-600 mb-4 line-clamp-2"><?php echo html_escape($class->description); ?></p>
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm font-medium text-gray-700"><?php echo html_escape($class->category); ?></span>
                                        <span class="text-sm text-gray-500">•</span>
                                        <span class="text-sm text-gray-500"><?php echo html_escape($class->duration); ?> menit</span>
                                    </div>
                                    <div class="flex items-center text-yellow-500">
                                        <i class="fas fa-star"></i>
                                        <span class="text-sm font-medium text-gray-700 ml-1">4.8</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-sm text-gray-500"><?php echo html_escape($class->material_count); ?> materi</span>
                                    </div>
                                    <a href="<?php echo site_url('free_classes/view/' . $class->id); ?>" class="text-teal-600 hover:text-teal-800 font-medium flex items-center">
                                        Mulai Belajar <i class="fas fa-arrow-right ml-1 text-sm"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Manfaat Kelas <span class="gradient-text">Gratis</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Kenapa Anda harus mencoba kelas gratis kami sebelum berlangganan
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-8 rounded-xl border border-teal-200 text-center card-hover scroll-reveal">
                    <div class="w-16 h-16 bg-teal-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-lock-open text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Akses Tanpa Batas</h3>
                    <p class="text-gray-700">Belajar tanpa batasan waktu dan biaya apapun</p>
                </div>

                <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-8 rounded-xl border border-teal-200 text-center card-hover scroll-reveal">
                    <div class="w-16 h-16 bg-teal-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Kualitas Terjamin</h3>
                    <p class="text-gray-700">Materi berkualitas sama dengan kelas premium</p>
                </div>

                <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-8 rounded-xl border border-teal-200 text-center card-hover scroll-reveal">
                    <div class="w-16 h-16 bg-teal-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-lightbulb text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Pengenalan Konsep</h3>
                    <p class="text-gray-700">Pahami dasar programming sebelum berlangganan</p>
                </div>

                <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-8 rounded-xl border border-teal-200 text-center card-hover scroll-reveal">
                    <div class="w-16 h-16 bg-teal-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Komunitas Belajar</h3>
                    <p class="text-gray-700">Bergabung dengan komunitas siswa aktif</p>
                </div>

                <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-8 rounded-xl border border-teal-200 text-center card-hover scroll-reveal">
                    <div class="w-16 h-16 bg-teal-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-certificate text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Sertifikat Kelulusan</h3>
                    <p class="text-gray-700">Dapatkan sertifikat setelah menyelesaikan kelas</p>
                </div>

                <div class="bg-gradient-to-br from-teal-500 to-cyan-600 p-8 rounded-xl border border-teal-200 text-center card-hover scroll-reveal">
                    <div class="w-16 h-16 bg-teal-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-rocket text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Langkah Awal Karir</h3>
                    <p class="text-gray-700">Mulai perjalanan karir di dunia teknologi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-teal-500 to-cyan-600">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                Siap Memulai Belajar Gratis?
            </h2>
            <p class="text-xl text-cyan-100 mb-8">
                Tidak ada alasan untuk menunda lagi - mulai belajar programming sekarang juga!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <?php if ($this->session->userdata('logged_in')): ?>
                    <a href="<?php echo site_url('dashboard'); ?>" class="bg-white text-cyan-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Lanjutkan Belajar
                    </a>
                <?php else: ?>
                    <a href="<?php echo site_url('auth/register'); ?>" class="bg-white text-cyan-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Daftar Sekarang
                    </a>
                <?php endif; ?>
                <a href="<?php echo site_url('home/premium'); ?>" class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-cyan-600 transition-all duration-300 transform hover:scale-105">
                    Lihat Kelas Premium
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center mb-4">
                        <span class="text-2xl font-bold gradient-text">Asset Academy</span>
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
                        <li><a href="<?php echo site_url('home/premium'); ?>" class="text-gray-400 hover:text-white transition-colors">Kelas Premium</a></li>
                        <li><a href="<?php echo site_url('home/free'); ?>" class="text-gray-400 hover:text-white transition-colors">Kelas Gratis</a></li>
                        <li><a href="<?php echo site_url('auth/login'); ?>" class="text-gray-400 hover:text-white transition-colors">Masuk</a></li>
                        <li><a href="<?php echo site_url('auth/register'); ?>" class="text-gray-400 hover:text-white transition-colors">Daftar</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Dukungan</h3>
                    <ul class="space-y-2">
                        <li><a href="<?php echo site_url('home/faq'); ?>" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="<?php echo site_url('home/about'); ?>" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kontak</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Bantuan</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    &copy; <?php echo date('Y'); ?> Asset Academy. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="fixed bottom-8 right-8 bg-cyan-600 hover:bg-cyan-700 text-white p-3 rounded-full shadow-lg opacity-0 transition-opacity duration-300">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- JavaScript -->
    <script>
        // Filter functionality
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('filter-active');
                });
                
                // Add active class to clicked button
                this.classList.add('filter-active');
                
                // Get filter value
                const filter = this.getAttribute('data-filter');
                
                // Filter classes
                const classItems = document.querySelectorAll('.class-item');
                classItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-level') === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

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
