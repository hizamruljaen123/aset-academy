<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Aset Academy Mobile App</title>
    <meta name="description" content="Download the Aset Academy mobile app for Android. Access your courses, materials, and learning resources on the go.">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .bg-gradient-secondary { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .bg-gradient-success { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <img src="<?= base_url('assets/img/logo.png') ?>" alt="Aset Academy Logo" class="h-8 mr-3">
                </div>
                <a href="<?= site_url() ?>" class="text-blue-600 hover:text-blue-800 font-medium">
                    <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <div class="animate-float mb-8">
                <i class="fas fa-mobile-alt text-6xl text-blue-600 mb-4"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Download Aset Academy
                <span class="block text-blue-600">Mobile App</span>
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Akses materi pembelajaran, jadwal kelas, dan fitur interaktif lainnya dimana saja dengan aplikasi mobile Aset Academy.
            </p>
        </div>

        <!-- Download Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <div class="text-center">
                <div class="bg-gradient-success rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                    <i class="fab fa-android text-3xl text-white"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Aplikasi Android</h2>
                <p class="text-gray-600 mb-6">
                    Versi terbaru aplikasi mobile Aset Academy untuk perangkat Android.
                </p>

                <!-- Download Button -->
                <a href="<?= base_url('assets/release/Asset Academy.apk') ?>"
                   download="Asset Academy.apk"
                   class="inline-flex items-center px-8 py-4 bg-gradient-primary text-white font-semibold rounded-lg hover:shadow-lg transform hover:-translate-y-1 transition-all duration-200">
                    <i class="fas fa-download mr-3"></i>
                    Download APK
                    <span class="ml-2 text-sm opacity-75">(3.0 MB)</span>
                </a>

                <div class="mt-6 text-sm text-gray-500">
                    <p><i class="fas fa-info-circle mr-2"></i>Ukuran file: 3.0 MB</p>
                    <p><i class="fas fa-mobile mr-2"></i>Kompatibel dengan Android 5.0+</p>
                </div>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow">
                <div class="bg-blue-100 rounded-full w-12 h-12 flex items-center justify-center mb-4">
                    <i class="fas fa-book text-blue-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Akses Materi</h3>
                <p class="text-gray-600">Pelajari materi pembelajaran kapan saja dan dimana saja melalui aplikasi mobile.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow">
                <div class="bg-green-100 rounded-full w-12 h-12 flex items-center justify-center mb-4">
                    <i class="fas fa-calendar-alt text-green-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Jadwal Kelas</h3>
                <p class="text-gray-600">Pantau jadwal kelas dan kegiatan akademik dengan mudah melalui aplikasi.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow">
                <div class="bg-purple-100 rounded-full w-12 h-12 flex items-center justify-center mb-4">
                    <i class="fas fa-comments text-purple-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Forum Diskusi</h3>
                <p class="text-gray-600">Berinteraksi dengan guru dan teman sekelas melalui forum diskusi interaktif.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow">
                <div class="bg-red-100 rounded-full w-12 h-12 flex items-center justify-center mb-4">
                    <i class="fas fa-trophy text-red-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Progress Tracking</h3>
                <p class="text-gray-600">Lacak kemajuan belajar Anda dengan fitur tracking yang lengkap.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow">
                <div class="bg-indigo-100 rounded-full w-12 h-12 flex items-center justify-center mb-4">
                    <i class="fas fa-bell text-indigo-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Notifikasi Real-time</h3>
                <p class="text-gray-600">Dapatkan notifikasi penting tentang tugas, jadwal, dan pengumuman.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow">
                <div class="bg-yellow-100 rounded-full w-12 h-12 flex items-center justify-center mb-4">
                    <i class="fas fa-download text-yellow-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Offline Access</h3>
                <p class="text-gray-600">Unduh materi untuk akses offline tanpa koneksi internet.</p>
            </div>
        </div>

        <!-- Installation Instructions -->
        <div class="bg-blue-50 rounded-xl p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                <i class="fas fa-tools mr-3"></i>Cara Install Aplikasi
            </h3>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Persiapan:</h4>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Pastikan perangkat Android Anda versi 5.0 atau lebih tinggi</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Aktifkan "Install from Unknown Sources" di pengaturan keamanan</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Pastikan ada cukup ruang penyimpanan (minimal 10MB)</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Langkah Install:</h4>
                    <ol class="space-y-3 text-gray-700">
                        <li class="flex items-start">
                            <span class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">1</span>
                            <span>Klik tombol "Download APK" di atas</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">2</span>
                            <span>Buka file APK yang sudah terdownload</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">3</span>
                            <span>Ikuti petunjuk instalasi yang muncul</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">4</span>
                            <span>Buka aplikasi dan login dengan akun Anda</span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Contact Support -->
        <div class="text-center mt-12">
            <p class="text-gray-600 mb-4">
                Mengalami kesulitan instalasi? <a href="mailto:support@asetacademy.id" class="text-blue-600 hover:text-blue-800 font-medium">Hubungi Support</a>
            </p>
            <p class="text-sm text-gray-500">
                Aplikasi ini dikembangkan untuk memberikan pengalaman belajar terbaik bagi siswa Aset Academy
            </p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <img src="<?= base_url('assets/img/logo-white.png') ?>" alt="Aset Academy Logo" class="h-8 mx-auto mb-4">
                <p class="text-gray-400">
                    © 2024 Aset Academy. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Track download clicks
        document.querySelector('a[download]').addEventListener('click', function() {
            // You can add analytics tracking here
            console.log('APK download initiated');
        });
    </script>
</body>
</html>
