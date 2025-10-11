<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - ASET Academy</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <div class="min-h-screen flex">
        <!-- Left Side - Branding Section (50%) -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-indigo-600 to-purple-700 p-12 flex-col justify-center relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-20 h-20 bg-white rounded-full"></div>
                <div class="absolute top-32 right-20 w-16 h-16 bg-yellow-300 rounded-full"></div>
                <div class="absolute bottom-20 left-20 w-24 h-24 bg-pink-300 rounded-full"></div>
                <div class="absolute bottom-32 right-10 w-12 h-12 bg-green-300 rounded-full"></div>
            </div>

            <div class="relative z-10">
                <!-- Logo -->
                <div class="mb-8" data-aos="fade-down" data-aos-duration="1000">
                    <img src="<?= base_url('assets/img/logo-white.png') ?>" alt="ASET Academy" class="h-12" onerror="this.src='<?= base_url('assets/img/logo.png') ?>'">
                </div>

                <!-- Main Content -->
                <div class="text-white" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                        Bergabunglah<br>
                        <span class="text-yellow-300">Komunitas Developer</span>
                    </h1>
                    <p class="text-xl text-white/90 mb-8 leading-relaxed">
                        Mulai perjalanan coding Anda hari ini. Dapatkan akses ke materi berkualitas, mentor berpengalaman, dan sertifikat resmi untuk karir impian Anda.
                    </p>

                    <!-- Benefits -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3" data-aos="fade-up" data-aos-delay="400">
                            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-white text-lg"></i>
                            </div>
                            <span class="text-lg">Akses Materi Premium</span>
                        </div>
                        <div class="flex items-center space-x-3" data-aos="fade-up" data-aos-delay="500">
                            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-handshake text-white text-lg"></i>
                            </div>
                            <span class="text-lg">Bimbingan Mentor</span>
                        </div>
                        <div class="flex items-center space-x-3" data-aos="fade-up" data-aos-delay="600">
                            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-trophy text-white text-lg"></i>
                            </div>
                            <span class="text-lg">Sertifikat Resmi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Register Form (50%) -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8" data-aos="fade-down">
                    <img src="<?= base_url('assets/img/logo.png') ?>" alt="ASET Academy" class="h-10 mx-auto">
                </div>

                <!-- Register Card -->
                <div class="bg-white rounded-2xl shadow-xl p-8 transition-all duration-500 opacity-0 transform translate-y-4" data-aos="fade-up" data-aos-duration="1000">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Bergabung dengan Kami</h2>
                        <p class="text-gray-600">Buat akun baru untuk memulai perjalanan coding Anda</p>
                    </div>

                    <?php if($this->session->flashdata('error')): ?>
                        <div class="mb-6 p-4 border-l-4 border-red-500 bg-red-50 rounded-lg" data-aos="fade-down">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
                                <div class="text-red-700 text-sm">
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($this->session->flashdata('success')): ?>
                        <div class="mb-6 p-4 border-l-4 border-green-500 bg-green-50 rounded-lg" data-aos="fade-down">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                                <div class="text-green-700 text-sm">
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?= form_open('auth/process_register', 'class="space-y-4"') ?>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Username <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" name="username" required
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                       placeholder="Buat username unik">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input type="email" name="email" required
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                       placeholder="email@example.com">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-id-card text-gray-400"></i>
                                </div>
                                <input type="text" name="nama_lengkap" required
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                       placeholder="Nama lengkap Anda">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" name="password" required
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                       placeholder="Minimal 6 karakter">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" name="confirm_password" required
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                       placeholder="Ulangi password Anda">
                            </div>
                        </div>

                        <button type="submit"
                                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:scale-105">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i class="fas fa-user-plus text-indigo-300 group-hover:text-indigo-200"></i>
                            </span>
                            Daftar Sekarang
                        </button>
                    <?= form_close() ?>

                    <div class="mt-6 text-center text-sm text-gray-500">
                        <p>Sudah punya akun? <a href="<?= site_url('auth') ?>" class="text-indigo-600 hover:text-indigo-500 font-semibold">Login di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init();

            // Animate register card
            setTimeout(() => {
                const registerCard = document.querySelector('.bg-white.rounded-2xl');
                if (registerCard) {
                    registerCard.classList.remove('opacity-0', 'translate-y-4');
                    registerCard.classList.add('opacity-100', 'translate-y-0');
                }
            }, 100);
        });
    </script>
</body>
</html>