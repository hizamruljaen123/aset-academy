<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - ASET Academy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .register-bg {
            background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
        }
    </style>
</head>
<body class="font-sans bg-gray-100">
    <!-- Header -->
    <header class="register-bg text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
            <div class="flex items-center space-x-2">
                    <img src="<?= base_url('assets/img/logo-white.png') ?>" alt="ASET Academy" width="250px">
            </div>
            </div>
            <a href="<?= site_url('mobile/login') ?>" class="text-white hover:text-blue-200">
                <i data-feather="user-plus" class="w-5 h-5"></i>
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-[calc(100vh-120px)] register-bg flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Register Form Container -->
            <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6 text-center">Form Registrasi</h2>
                
                <?php if($this->session->flashdata('register_error')): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= $this->session->flashdata('register_error') ?>
                    </div>
                <?php endif; ?>
                
                <?php if($this->session->flashdata('register_success')): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?= $this->session->flashdata('register_success') ?>
                    </div>
                <?php endif; ?>
                
                <?= form_open('mobile/register/process', 'class="space-y-4"') ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Username <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i data-feather="user" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                            <input type="text" name="username" required
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Buat username unik">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i data-feather="mail" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                            <input type="email" name="email" required
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="email@example.com">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i data-feather="user" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                            <input type="text" name="nama_lengkap" required
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Nama lengkap Anda">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i data-feather="lock" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                            <input type="password" name="password" id="password" required
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Minimal 6 karakter">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i data-feather="lock" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                            <input type="password" name="confirm_password" required
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Ulangi password Anda">
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Daftar Sekarang
                    </button>
                <?= form_close() ?>
            </div>
            
            <div class="text-center text-white text-sm">
                Sudah punya akun? <a href="<?= site_url('mobile/login') ?>" class="font-medium hover:underline">Login disini</a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="register-bg text-white text-center p-4 text-sm">
        <p> 2023 ASET Academy. All rights reserved.</p>
    </footer>

    <script>
        // Initialize Feather Icons
        document.addEventListener('DOMContentLoaded', function() {
            feather.replace();
        });
    </script>
</body>
</html>
