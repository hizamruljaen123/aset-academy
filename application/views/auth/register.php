<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - ASET Academy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-indigo-500 to-purple-600">
    
    <div class="max-w-md w-full mx-8 p-8 bg-white rounded-lg shadow-lg transition-opacity duration-500 opacity-0">
        <div class="text-center mb-8">
            <center>
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="ASET Academy" class="h-8 mb-4">
            </center>
            <h2 class="text-xl font-bold text-gray-900">Form Registrasi Siswa</h2>
        </div>

        <?php if($this->session->flashdata('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <?php if($this->session->flashdata('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>
        
        <?= form_open('auth/process_register', 'class="space-y-4"') ?>
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
                    <input type="password" name="password" required
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
        
        <div class="mt-6 text-center text-sm text-gray-500">
            <p>Sudah punya akun? <a href="<?= site_url('auth') ?>" class="text-blue-500 hover:text-blue-600">Login disini</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            feather.replace();
            const registerCard = document.querySelector('.transition-opacity');
            if (registerCard) {
                registerCard.classList.add('opacity-100');
            }
        });
    </script>
</body>
</html>