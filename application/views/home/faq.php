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

        .faq-item {
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .faq-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }

        .faq-content.open {
            max-height: 500px;
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
                            <a href="<?php echo site_url('home/about'); ?>" class="text-gray-700 hover:text-cyan-600 px-3 py-2 text-sm font-medium transition-colors">Tentang</a>
                            <a href="<?php echo site_url('home/faq'); ?>" class="text-cyan-600 px-3 py-2 text-sm font-medium">FAQ</a>
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
                    Pertanyaan <span class="gradient-text">Umum</span>
                </h1>
                <p class="text-xl lg:text-2xl mb-8 text-cyan-100 max-w-3xl mx-auto leading-relaxed">
                    Temukan jawaban untuk pertanyaan yang sering diajukan
                </p>
            </div>
        </div>
    </section>

    <!-- FAQ Content -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Pertanyaan yang Sering Diajukan
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Kami mengumpulkan pertanyaan umum untuk membantu Anda memahami layanan kami dengan lebih baik
                </p>
            </div>

            <div class="space-y-6 mb-16">
                <!-- FAQ Item 1 -->
                <div class="bg-white rounded-xl shadow-lg faq-item scroll-reveal">
                    <div class="p-6 cursor-pointer flex justify-between items-center" onclick="toggleFAQ(this)">
                        <h3 class="text-lg font-semibold text-gray-900">Apakah saya bisa belajar programming dari nol?</h3>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform duration-300"></i>
                    </div>
                    <div class="faq-content px-6 pb-0">
                        <div class="pb-6 text-gray-600 border-t border-gray-100 pt-6">
                            <p>Tentu saja! Kami memiliki kelas khusus untuk pemula yang dirancang untuk membantu Anda belajar programming dari dasar. Instruktur kami akan memandu Anda step by step dengan bahasa yang mudah dipahami.</p>
                            <p class="mt-3">Kelas pemula kami mencakup dasar-dasar programming, logika, dan konsep fundamental yang diperlukan untuk memahami bahasa pemrograman apapun.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white rounded-xl shadow-lg faq-item scroll-reveal">
                    <div class="p-6 cursor-pointer flex justify-between items-center" onclick="toggleFAQ(this)">
                        <h3 class="text-lg font-semibold text-gray-900">Berapa lama waktu yang dibutuhkan untuk menyelesaikan satu kelas?</h3>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform duration-300"></i>
                    </div>
                    <div class="faq-content px-6 pb-0">
                        <div class="pb-6 text-gray-600 border-t border-gray-100 pt-6">
                            <p>Waktu penyelesaian tergantung pada kompleksitas kelas dan waktu yang Anda dedikasikan. Rata-rata, siswa menyelesaikan kelas dalam 2-8 minggu dengan belajar 5-10 jam per minggu.</p>
                            <p class="mt-3">Kelas dasar biasanya membutuhkan waktu 2-4 minggu, sedangkan kelas lanjutan bisa memakan waktu 6-12 minggu tergantung pada kompleksitas materi.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white rounded-xl shadow-lg faq-item scroll-reveal">
                    <div class="p-6 cursor-pointer flex justify-between items-center" onclick="toggleFAQ(this)">
                        <h3 class="text-lg font-semibold text-gray-900">Apakah saya akan mendapat sertifikat setelah menyelesaikan kelas?</h3>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform duration-300"></i>
                    </div>
                    <div class="faq-content px-6 pb-0">
                        <div class="pb-6 text-gray-600 border-t border-gray-100 pt-6">
                            <p>Ya, Anda akan mendapat sertifikat resmi Asset Academy setelah menyelesaikan kelas dengan baik. Sertifikat ini dapat digunakan untuk melamar pekerjaan atau ditampilkan di portofolio Anda.</p>
                            <p class="mt-3">Sertifikat kami dilengkapi dengan kode verifikasi unik yang dapat diverifikasi oleh calon pemberi kerja atau institusi pendidikan.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="bg-white rounded-xl shadow-lg faq-item scroll-reveal">
                    <div class="p-6 cursor-pointer flex justify-between items-center" onclick="toggleFAQ(this)">
                        <h3 class="text-lg font-semibold text-gray-900">Apakah ada dukungan teknis jika saya mengalami kesulitan?</h3>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform duration-300"></i>
                    </div>
                    <div class="faq-content px-6 pb-0">
                        <div class="pb-6 text-gray-600 border-t border-gray-100 pt-6">
                            <p>Ya, kami menyediakan berbagai bentuk dukungan: forum diskusi, email support, dan komunitas siswa aktif. Instruktur juga akan menjawab pertanyaan Anda dalam waktu 24 jam.</p>
                            <p class="mt-3">Selain itu, kami juga menyediakan sesi tanya jawab langsung dengan instruktur setiap minggu untuk membantu Anda mengatasi kendala belajar.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="bg-white rounded-xl shadow-lg faq-item scroll-reveal">
                    <div class="p-6 cursor-pointer flex justify-between items-center" onclick="toggleFAQ(this)">
                        <h3 class="text-lg font-semibold text-gray-900">Apakah saya bisa mengakses materi kelas kapan saja?</h3>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform duration-300"></i>
                    </div>
                    <div class="faq-content px-6 pb-0">
                        <div class="pb-6 text-gray-600 border-t border-gray-100 pt-6">
                            <p>Ya, semua materi kelas dapat diakses 24/7. Anda bisa belajar sesuai dengan jadwal Anda sendiri tanpa batasan waktu, selama akun Anda masih aktif.</p>
                            <p class="mt-3">Materi juga tersedia dalam berbagai format (video, teks, dan kode) sehingga Anda bisa mengaksesnya di berbagai perangkat termasuk smartphone dan tablet.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 6 -->
                <div class="bg-white rounded-xl shadow-lg faq-item scroll-reveal">
                    <div class="p-6 cursor-pointer flex justify-between items-center" onclick="toggleFAQ(this)">
                        <h3 class="text-lg font-semibold text-gray-900">Bagaimana cara mendaftar dan mulai belajar?</h3>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform duration-300"></i>
                    </div>
                    <div class="faq-content px-6 pb-0">
                        <div class="pb-6 text-gray-600 border-t border-gray-100 pt-6">
                            <p>Prosesnya sangat mudah! Daftar akun gratis, pilih kelas yang Anda inginkan, lakukan pembayaran jika kelas premium, dan langsung mulai belajar. Panduan lengkap akan diberikan setelah pendaftaran.</p>
                            <p class="mt-3">Anda juga bisa mencoba kelas gratis kami terlebih dahulu untuk merasakan pengalaman belajar di Asset Academy sebelum memutuskan untuk berlangganan.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 7 -->
                <div class="bg-white rounded-xl shadow-lg faq-item scroll-reveal">
                    <div class="p-6 cursor-pointer flex justify-between items-center" onclick="toggleFAQ(this)">
                        <h3 class="text-lg font-semibold text-gray-900">Apakah kelas premium lebih baik dari kelas gratis?</h3>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform duration-300"></i>
                    </div>
                    <div class="faq-content px-6 pb-0">
                        <div class="pb-6 text-gray-600 border-t border-gray-100 pt-6">
                            <p>Kelas premium menawarkan materi yang lebih komprehensif, proyek nyata, dan dukungan personal dari instruktur. Namun, kelas gratis kami juga dirancang untuk memberikan nilai pembelajaran yang tinggi.</p>
                            <p class="mt-3">Kelas gratis cocok untuk memahami dasar-dasar programming, sedangkan kelas premium lebih cocok untuk mengembangkan skill secara profesional dan siap kerja.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 8 -->
                <div class="bg-white rounded-xl shadow-lg faq-item scroll-reveal">
                    <div class="p-6 cursor-pointer flex justify-between items-center" onclick="toggleFAQ(this)">
                        <h3 class="text-lg font-semibold text-gray-900">Apakah ada jaminan uang kembali?</h3>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform duration-300"></i>
                    </div>
                    <div class="faq-content px-6 pb-0">
                        <div class="pb-6 text-gray-600 border-t border-gray-100 pt-6">
                            <p>Kami menawarkan jaminan uang kembali dalam 7 hari pertama jika Anda tidak puas dengan kelas yang Anda beli. Anda dapat mencoba kelas selama seminggu dan memutuskan apakah ingin melanjutkan atau tidak.</p>
                            <p class="mt-3">Syarat dan ketentuan berlaku. Silakan hubungi tim support kami untuk informasi lebih lanjut mengenai proses pengembalian dana.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-8 text-center scroll-reveal">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Masih memiliki pertanyaan lain?</h3>
                <p class="text-gray-600 mb-6 max-w-2xl mx-auto">Tim support kami siap membantu Anda kapan saja. Jangan ragu untuk menghubungi kami!</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="mailto:support@academylite.com" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-envelope mr-2"></i>
                        Email Support
                    </a>
                    <a href="https://wa.me/6281234567890" class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                        <i class="fab fa-whatsapp mr-2"></i>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Questions -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 scroll-reveal">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Topik Terkait</h2>
                <p class="text-gray-600">Jelajahi pertanyaan berdasarkan kategori</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="#" class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow flex items-center space-x-4 card-hover">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Kurikulum</h3>
                        <p class="text-sm text-gray-500">Struktur pembelajaran</p>
                    </div>
                </a>

                <a href="#" class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow flex items-center space-x-4 card-hover">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-dollar-sign text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Pembayaran</h3>
                        <p class="text-sm text-gray-500">Metode & kebijakan</p>
                    </div>
                </a>

                <a href="#" class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow flex items-center space-x-4 card-hover">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-certificate text-purple-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Sertifikasi</h3>
                        <p class="text-sm text-gray-500">Verifikasi & pengakuan</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-teal-500 to-cyan-600">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                Siap Memulai Belajar?
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
                        Daftar Sekarang
                    </a>
                <?php endif; ?>
                <a href="<?php echo site_url('home/free'); ?>" class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-cyan-600 transition-all duration-300 transform hover:scale-105">
                    Coba Kelas Gratis
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
        // FAQ Toggle Function
        function toggleFAQ(element) {
            const content = element.nextElementSibling;
            const icon = element.querySelector('i');
            
            content.classList.toggle('open');
            icon.classList.toggle('rotate-180');
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

        // Event Listeners
        window.addEventListener('scroll', () => {
            revealOnScroll();
            toggleScrollToTop();
        });

        window.addEventListener('load', () => {
            revealOnScroll();
        });

        // Add rotate-180 class for icon rotation
        document.head.insertAdjacentHTML('beforeend', '<style>.rotate-180 { transform: rotate(180deg) !important; }</style>');
    </script>
</body>
</html>
