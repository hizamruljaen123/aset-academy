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
                            <a href="<?php echo site_url('home/free'); ?>" class="text-gray-700 hover:text-cyan-600 px-3 py-2 text-sm font-medium transition-colors">Kelas Gratis</a>
                            <a href="<?php echo site_url('home/about'); ?>" class="text-cyan-600 px-3 py-2 text-sm font-medium">Tentang</a>
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
                    Tentang <span class="gradient-text">Asset Academy</span>
                </h1>
                <p class="text-xl lg:text-2xl mb-8 text-cyan-100 max-w-3xl mx-auto leading-relaxed">
                    Platform pembelajaran programming terdepan yang berkomitmen untuk mendidik programmer masa depan
                </p>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20 scroll-reveal">
                <div>
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">
                        Misi Kami
                    </h2>
                    <p class="text-lg text-gray-600 mb-6">
                        Asset Academy hadir dengan misi untuk membuat pembelajaran programming menjadi lebih mudah diakses dan dipahami oleh siapa saja, tanpa memandang latar belakang pendidikan sebelumnya.
                    </p>
                    <p class="text-lg text-gray-600 mb-8">
                        Kami percaya bahwa setiap orang memiliki potensi untuk menjadi programmer handal. Tugas kami adalah membuka jalan bagi potensi tersebut melalui pendekatan pembelajaran yang inovatif dan menyenangkan.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                            <span class="text-gray-700">Pembelajaran Terstruktur</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                            <span class="text-gray-700">Instruktur Profesional</span>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Our Mission" class="w-full h-auto rounded-2xl shadow-2xl floating">
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center scroll-reveal">
                <div class="relative order-2 lg:order-1">
                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Our Vision" class="w-full h-auto rounded-2xl shadow-2xl floating">
                </div>
                <div class="order-1 lg:order-2">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">
                        Visi Kami
                    </h2>
                    <p class="text-lg text-gray-600 mb-6">
                        Menjadi platform pembelajaran programming terdepan di Indonesia yang menghasilkan ribuan programmer berkualitas setiap tahunnya.
                    </p>
                    <p class="text-lg text-gray-600 mb-8">
                        Kami ingin menciptakan ekosistem pembelajaran yang berkelanjutan, di mana siswa tidak hanya belajar teori tetapi juga langsung menerapkannya dalam proyek-proyek nyata.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex items-center">
                            <i class="fas fa-bullseye text-blue-600 text-xl mr-3"></i>
                            <span class="text-gray-700">Inovasi Teknologi</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-users text-purple-600 text-xl mr-3"></i>
                            <span class="text-gray-700">Komunitas Berkualitas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Tim <span class="gradient-text">Kami</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Profesional berpengalaman yang berdedikasi untuk membantu Anda mencapai tujuan programming
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white rounded-xl shadow-lg p-6 text-center card-hover">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full overflow-hidden border-4 border-cyan-100">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Team Member" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Budi Santoso</h3>
                    <p class="text-cyan-600 mb-4">CEO & Founder</p>
                    <p class="text-gray-600 text-sm">10+ tahun pengalaman di industri teknologi</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 text-center card-hover">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full overflow-hidden border-4 border-cyan-100">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Team Member" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Siti Rahayu</h3>
                    <p class="text-cyan-600 mb-4">CTO</p>
                    <p class="text-gray-600 text-sm">Spesialis dalam pengembangan kurikulum</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 text-center card-hover">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full overflow-hidden border-4 border-cyan-100">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Team Member" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Andi Prasetyo</h3>
                    <p class="text-cyan-600 mb-4">Lead Instructor</p>
                    <p class="text-gray-600 text-sm">Full-stack developer berpengalaman</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 text-center card-hover">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full overflow-hidden border-4 border-cyan-100">
                        <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Team Member" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Dewi Kusuma</h3>
                    <p class="text-cyan-600 mb-4">Community Manager</p>
                    <p class="text-gray-600 text-sm">Membangun komunitas belajar yang aktif</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Nilai <span class="gradient-text">Kami</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Prinsip yang menjadi dasar dalam setiap langkah kami
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-8 rounded-xl border border-cyan-200 scroll-reveal">
                    <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-graduation-cap text-cyan-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Kualitas Pendidikan</h3>
                    <p class="text-gray-700">Kami berkomitmen menyediakan materi pembelajaran terbaik dengan standar industri yang tinggi.</p>
                </div>

                <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-8 rounded-xl border border-cyan-200 scroll-reveal">
                    <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-handshake text-cyan-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Integritas</h3>
                    <p class="text-gray-700">Transparansi dan kejujuran dalam setiap interaksi dengan siswa dan mitra kami.</p>
                </div>

                <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-8 rounded-xl border border-cyan-200 scroll-reveal">
                    <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-lightbulb text-cyan-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Inovasi</h3>
                    <p class="text-gray-700">Terus berinovasi dalam metode pembelajaran untuk memberikan pengalaman terbaik.</p>
                </div>

                <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-8 rounded-xl border border-cyan-200 scroll-reveal">
                    <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-users text-cyan-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Kolaborasi</h3>
                    <p class="text-gray-700">Mendorong kolaborasi antar siswa untuk menciptakan lingkungan belajar yang suportif.</p>
                </div>

                <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-8 rounded-xl border border-cyan-200 scroll-reveal">
                    <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-heart text-cyan-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Kepedulian</h3>
                    <p class="text-gray-700">Peduli terhadap kesuksesan setiap siswa dalam mencapai tujuan karir mereka.</p>
                </div>

                <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-8 rounded-xl border border-cyan-200 scroll-reveal">
                    <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-cyan-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Pertumbuhan</h3>
                    <p class="text-gray-700">Mendorong pertumbuhan berkelanjutan baik untuk siswa maupun organisasi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-teal-500 to-cyan-600">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                Bergabung dengan Kami
            </h2>
            <p class="text-xl text-cyan-100 mb-8">
                Mulai perjalanan programming Anda bersama ribuan siswa lainnya
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
                <a href="<?php echo site_url('home/faq'); ?>" class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-cyan-600 transition-all duration-300 transform hover:scale-105">
                    Lihat FAQ
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
