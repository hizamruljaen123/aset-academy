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

        .stagger-animation {
            animation: fadeIn 0.8s ease-in-out;
        }

        .stagger-animation:nth-child(1) { animation-delay: 0.1s; }
        .stagger-animation:nth-child(2) { animation-delay: 0.2s; }
        .stagger-animation:nth-child(3) { animation-delay: 0.3s; }
        .stagger-animation:nth-child(4) { animation-delay: 0.4s; }

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
                            <a href="<?php echo site_url('home'); ?>" class="text-cyan-600 px-3 py-2 text-sm font-medium">Beranda</a>
                            <a href="<?php echo site_url('home/premium'); ?>" class="text-gray-700 hover:text-cyan-600 px-3 py-2 text-sm font-medium transition-colors">Kelas Premium</a>
                            <a href="<?php echo site_url('home/free'); ?>" class="text-gray-700 hover:text-cyan-600 px-3 py-2 text-sm font-medium transition-colors">Kelas Gratis</a>
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
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-white fade-in">
                    <h1 class="text-4xl lg:text-6xl font-bold mb-6 leading-tight">
                        Belajar <span class="gradient-text">Programming</span> <br>
                        Jadi Mudah & Menyenangkan
                    </h1>
                    <p class="text-xl lg:text-2xl mb-8 text-cyan-100 leading-relaxed">
                        Tingkatkan skill programming Anda dengan kelas premium dan gratis dari instruktur berpengalaman. Mulai dari pemula hingga expert.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="<?php echo site_url('home/premium'); ?>" class="bg-white text-cyan-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-rocket mr-2"></i>Lihat Kelas Premium
                        </a>
                        <a href="<?php echo site_url('home/free'); ?>" class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-cyan-600 transition-all duration-300 transform hover:scale-105">
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
                    <div class="text-4xl font-bold text-cyan-600 mb-2"><?php echo count($premium_classes); ?>+</div>
                    <div class="text-gray-600">Kelas Premium</div>
                </div>
                <div class="text-center stagger-animation">
                    <div class="text-4xl font-bold text-green-600 mb-2"><?php echo count($free_classes); ?>+</div>
                    <div class="text-gray-600">Kelas Gratis</div>
                </div>
                <div class="text-center stagger-animation">
                    <div class="text-4xl font-bold text-teal-600 mb-2">10K+</div>
                    <div class="text-gray-600">Siswa Aktif</div>
                </div>
                <div class="text-center stagger-animation">
                    <div class="text-4xl font-bold text-amber-600 mb-2">50+</div>
                    <div class="text-gray-600">Instruktur</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-teal-500 to-cyan-600">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                Siap Memulai Perjalanan Programming Anda?
            </h2>
            <p class="text-xl text-cyan-100 mb-8">
                Bergabunglah dengan ribuan siswa yang telah berhasil menguasai programming bersama Asset Academy
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <?php if ($this->session->userdata('logged_in')): ?>
                    <a href="<?php echo site_url('dashboard'); ?>" class="bg-white text-cyan-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Lanjutkan Belajar
                    </a>
                <?php else: ?>
                    <a href="<?php echo site_url('auth/register'); ?>" class="bg-white text-cyan-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Mulai Belajar Sekarang
                    </a>
                    <a href="<?php echo site_url('home/free'); ?>" class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-cyan-600 transition-all duration-300 transform hover:scale-105">
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

    <!-- JavaScript -->
    <script>
        // Simple fade-in animation
        document.querySelector('.fade-in').classList.add('opacity-100');
    </script>
</body>
</html>
