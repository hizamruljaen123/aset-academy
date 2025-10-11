<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Aset Academy - Mobile App untuk Pembelajaran Modern</title>
    <meta name="description" content="Download aplikasi mobile Aset Academy untuk Android. Belajar kapan saja, dimana saja dengan pengalaman belajar yang modern dan interaktif.">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            overflow-x: hidden;
        }

        /* Animated Background */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0.1;
        }

        .animated-bg::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: white;
            border-radius: 50%;
            top: -100px;
            left: -100px;
            animation: float 20s infinite ease-in-out;
        }

        .animated-bg::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: white;
            border-radius: 50%;
            bottom: -200px;
            right: -200px;
            animation: float 25s infinite ease-in-out reverse;
        }

        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
        }

        .glass-white {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Animations */
        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(50px, 50px) rotate(90deg); }
            50% { transform: translate(0, 100px) rotate(180deg); }
            75% { transform: translate(-50px, 50px) rotate(270deg); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-slideup {
            animation: slideInUp 0.6s ease-out forwards;
        }

        .animate-slideright {
            animation: slideInRight 0.8s ease-out forwards;
        }

        .phone-mockup {
            position: relative;
            width: 300px;
            height: 600px;
            background: linear-gradient(145deg, #1e1e1e 0%, #2d2d2d 100%);
            border-radius: 40px;
            padding: 15px;
            box-shadow: 0 50px 100px rgba(0, 0, 0, 0.3);
            animation: float 6s ease-in-out infinite;
        }

        .phone-screen {
            width: 100%;
            height: 100%;
            background: white;
            border-radius: 30px;
            overflow: hidden;
            position: relative;
        }

        .phone-notch {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
            height: 25px;
            background: #1e1e1e;
            border-radius: 0 0 20px 20px;
            z-index: 10;
        }

        /* Gradient Button */
        .gradient-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
        }

        .gradient-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.6);
        }

        .feature-card {
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        /* Stats Counter */
        @keyframes countUp {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            color: white;
            font-size: 0.875rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }

        /* Floating Icons */
        .floating-icon {
            animation: float 3s ease-in-out infinite;
        }

        .floating-icon:nth-child(2) { animation-delay: 0.5s; }
        .floating-icon:nth-child(3) { animation-delay: 1s; }
    </style>
</head>
<body>
    <div class="animated-bg"></div>

    <!-- Header -->
    <header class="relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="bg-white rounded-lg p-2 shadow-lg">
                        <img src="<?= base_url('assets/img/logo.png') ?>" alt="Aset Academy" class="h-8">
                    </div>
                    <span class="text-white font-bold text-xl hidden sm:block">Aset Academy</span>
                </div>
                <a href="<?= site_url() ?>" class="glass px-6 py-3 rounded-full text-white font-semibold hover:bg-white hover:text-purple-600 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative z-10 pt-20 pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-white animate-slideup">
                    <!-- Badges -->
                    <div class="flex flex-wrap gap-3 mb-8">
                        <span class="badge">
                            <i class="fas fa-star text-yellow-300"></i>
                            Rating 4.8/5.0
                        </span>
                        <span class="badge">
                            <i class="fas fa-download"></i>
                            1,000+ Downloads
                        </span>
                        <span class="badge">
                            <i class="fas fa-users"></i>
                            500+ Pengguna Aktif
                        </span>
                    </div>

                    <h1 class="text-5xl lg:text-7xl font-black mb-6 leading-tight">
                        Belajar Jadi
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 to-pink-200">
                            Lebih Mudah
                        </span>
                    </h1>
                    
                    <p class="text-xl lg:text-2xl text-purple-100 mb-8 leading-relaxed">
                        Download aplikasi mobile Aset Academy dan nikmati pengalaman belajar modern dengan akses materi kapan saja, dimana saja! 🚀
                    </p>

                    <!-- Download Button -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <a href="https://is3.cloudhost.id/pantaoumedia/asset_academy/apps/asset_academy_v1.1.apk" 
                           download="Aset_Academy.apk"
                           class="gradient-btn px-8 py-5 rounded-2xl text-white font-bold text-lg flex items-center justify-center gap-3 group">
                            <i class="fab fa-android text-2xl"></i>
                            <div class="text-left">
                                <div class="text-xs opacity-75">Download untuk</div>
                                <div>Android App</div>
                            </div>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 glass rounded-2xl p-6">
                        <div class="text-center">
                            <div class="text-3xl font-black text-white mb-1">3.0MB</div>
                            <div class="text-purple-200 text-sm">Ukuran App</div>
                        </div>
                        <div class="text-center border-l border-r border-white border-opacity-20">
                            <div class="text-3xl font-black text-white mb-1">5.0+</div>
                            <div class="text-purple-200 text-sm">Android</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-black text-white mb-1">Free</div>
                            <div class="text-purple-200 text-sm">Gratis</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Phone Mockup -->
                <div class="relative animate-slideright hidden lg:block">
                    <div class="phone-mockup mx-auto">
                        <div class="phone-notch"></div>
                        <div class="phone-screen">
                            <div class="w-full h-full bg-gradient-to-b from-purple-100 to-blue-100 flex items-center justify-center">
                                <div class="text-center p-8">
                                    <i class="fas fa-graduation-cap text-purple-600 text-6xl mb-4"></i>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Aset Academy</h3>
                                    <p class="text-gray-600">Mobile Learning App</p>
                                    <div class="mt-8 space-y-3">
                                        <div class="bg-white rounded-lg p-3 shadow-md">
                                            <i class="fas fa-book text-purple-600 mr-2"></i>
                                            <span class="text-sm">Akses Materi</span>
                                        </div>
                                        <div class="bg-white rounded-lg p-3 shadow-md">
                                            <i class="fas fa-calendar text-blue-600 mr-2"></i>
                                            <span class="text-sm">Jadwal Kelas</span>
                                        </div>
                                        <div class="bg-white rounded-lg p-3 shadow-md">
                                            <i class="fas fa-comments text-green-600 mr-2"></i>
                                            <span class="text-sm">Forum Diskusi</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Icons -->
                    <div class="absolute -top-10 -left-10 floating-icon">
                        <div class="glass w-20 h-20 rounded-2xl flex items-center justify-center text-white text-2xl">
                            <i class="fas fa-rocket"></i>
                        </div>
                    </div>
                    <div class="absolute -bottom-10 -right-10 floating-icon">
                        <div class="glass w-20 h-20 rounded-2xl flex items-center justify-center text-white text-2xl">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="relative z-10 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-white rounded-3xl p-8 lg:p-12 shadow-2xl">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-black text-gray-900 mb-4">
                        Fitur Unggulan
                    </h2>
                    <p class="text-xl text-gray-600">
                        Semua yang kamu butuhkan untuk belajar lebih efektif
                    </p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="feature-card bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 hover:shadow-xl">
                        <div class="bg-blue-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                            <i class="fas fa-book text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Akses Materi</h3>
                        <p class="text-gray-600">Akses ribuan materi pembelajaran kapan saja dan dimana saja</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="feature-card bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 hover:shadow-xl">
                        <div class="bg-green-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                            <i class="fas fa-calendar-check text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Jadwal Kelas</h3>
                        <p class="text-gray-600">Pantau jadwal kelas dan reminder otomatis untuk setiap sesi</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="feature-card bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 hover:shadow-xl">
                        <div class="bg-purple-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                            <i class="fas fa-comments text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Forum Diskusi</h3>
                        <p class="text-gray-600">Diskusi interaktif dengan guru dan teman sekelas</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="feature-card bg-gradient-to-br from-red-50 to-red-100 rounded-2xl p-6 hover:shadow-xl">
                        <div class="bg-red-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                            <i class="fas fa-chart-line text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Progress Tracking</h3>
                        <p class="text-gray-600">Lacak kemajuan belajar dengan dashboard yang detail</p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="feature-card bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-6 hover:shadow-xl">
                        <div class="bg-yellow-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                            <i class="fas fa-bell text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Notifikasi Real-time</h3>
                        <p class="text-gray-600">Notifikasi penting tentang tugas dan pengumuman</p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="feature-card bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl p-6 hover:shadow-xl">
                        <div class="bg-indigo-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                            <i class="fas fa-wifi-slash text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Offline Mode</h3>
                        <p class="text-gray-600">Download materi dan belajar tanpa koneksi internet</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Installation Guide -->
    <section class="relative z-10 pb-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass rounded-3xl p-8 lg:p-12">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-black text-white mb-4">
                        <i class="fas fa-mobile-alt mr-3"></i>
                        Cara Install Aplikasi
                    </h2>
                    <p class="text-purple-100 text-lg">Ikuti langkah mudah berikut untuk install aplikasi</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Preparation Steps -->
                    <div class="glass-white rounded-2xl p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <div class="bg-purple-500 w-10 h-10 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-list-check text-white"></i>
                            </div>
                            Persiapan
                        </h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <div class="bg-green-100 rounded-full p-2 mr-3 mt-1">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                                <span class="text-gray-700">Android versi 5.0 atau lebih tinggi</span>
                            </li>
                            <li class="flex items-start">
                                <div class="bg-green-100 rounded-full p-2 mr-3 mt-1">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                                <span class="text-gray-700">Aktifkan "Install from Unknown Sources"</span>
                            </li>
                            <li class="flex items-start">
                                <div class="bg-green-100 rounded-full p-2 mr-3 mt-1">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                                <span class="text-gray-700">Minimal 10MB ruang penyimpanan</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Installation Steps -->
                    <div class="glass-white rounded-2xl p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <div class="bg-blue-500 w-10 h-10 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-rocket text-white"></i>
                            </div>
                            Langkah Install
                        </h3>
                        <ol class="space-y-4">
                            <li class="flex items-start">
                                <div class="bg-gradient-to-br from-purple-500 to-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold mr-3 mt-0.5 flex-shrink-0">1</div>
                                <span class="text-gray-700">Klik tombol "Download Android App"</span>
                            </li>
                            <li class="flex items-start">
                                <div class="bg-gradient-to-br from-purple-500 to-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold mr-3 mt-0.5 flex-shrink-0">2</div>
                                <span class="text-gray-700">Buka file APK yang sudah terdownload</span>
                            </li>
                            <li class="flex items-start">
                                <div class="bg-gradient-to-br from-purple-500 to-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold mr-3 mt-0.5 flex-shrink-0">3</div>
                                <span class="text-gray-700">Ikuti petunjuk instalasi</span>
                            </li>
                            <li class="flex items-start">
                                <div class="bg-gradient-to-br from-purple-500 to-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold mr-3 mt-0.5 flex-shrink-0">4</div>
                                <span class="text-gray-700">Login dan mulai belajar!</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative z-10 pb-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-yellow-400 via-pink-500 to-purple-500 rounded-3xl p-12 text-center shadow-2xl">
                <h2 class="text-4xl lg:text-5xl font-black text-white mb-6">
                    Siap Mulai Belajar? 🎓
                </h2>
                <p class="text-xl text-white mb-8 opacity-90">
                    Download aplikasi sekarang dan rasakan pengalaman belajar yang berbeda!
                </p>
                <a href="https://is3.cloudhost.id/pantaoumedia/asset_academy/apps/asset_academy_v1.1.apk" 
                   download="Aset_Academy.apk"
                   class="inline-flex items-center px-10 py-5 bg-white text-purple-600 font-black text-xl rounded-full hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-2xl">
                    <i class="fas fa-download mr-3"></i>
                    Download Gratis
                    <i class="fas fa-arrow-right ml-3"></i>
                </a>
                <p class="text-white mt-6 text-sm opacity-75">
                    <i class="fas fa-question-circle mr-2"></i>
                    Butuh bantuan? 
                    <a href="<?= site_url('contact') ?>" class="underline hover:text-yellow-200">Hubungi Support</a>
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 bg-gray-900 text-white py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="bg-white rounded-2xl p-3 inline-block mb-6">
                    <img src="<?= base_url('assets/img/logo.png') ?>" alt="Aset Academy" class="h-10">
                </div>
                <p class="text-gray-400 mb-4">
                    Aplikasi pembelajaran modern untuk generasi digital
                </p>
                <div class="flex justify-center space-x-6 mb-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-facebook text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-twitter text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-youtube text-2xl"></i>
                    </a>
                </div>
                <p class="text-gray-500 text-sm">
                    © 2024 Aset Academy. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Track download
        document.querySelectorAll('a[download]').forEach(link => {
            link.addEventListener('click', function() {
                console.log('📱 APK Download Started');
                
                // Show success message
                const notification = document.createElement('div');
                notification.className = 'fixed bottom-8 right-8 bg-green-500 text-white px-6 py-4 rounded-2xl shadow-2xl z-50 animate-slideup';
                notification.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-2xl"></i>
                        <div>
                            <div class="font-bold">Download Dimulai!</div>
                            <div class="text-sm opacity-90">File akan segera terunduh</div>
                        </div>
                    </div>
                `;
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.remove();
                }, 5000);
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>
