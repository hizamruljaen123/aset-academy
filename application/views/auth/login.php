<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Asset Academy</title>
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-indigo-500 to-purple-600">

    <div class="max-w-md w-full mx-8 p-8 bg-white rounded-lg shadow-lg transition-opacity duration-500 opacity-0">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">
                <i class="fas fa-graduation-cap text-blue-500"></i> Asset Academy
            </h1>
            <p class="text-gray-500 text-sm">Sistem Pendataan Siswa</p>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="mb-6 p-4 border-l-4 border-red-500 bg-red-50 rounded">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
                    <div>
                        <p class="font-semibold text-red-800">Error</p>
                        <p class="text-red-700 text-sm"><?php echo $this->session->flashdata('error'); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if ($this->session->flashdata('success')): ?>
            <div class="mb-6 p-4 border-l-4 border-green-500 bg-green-50 rounded">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 mr-3"></i>
                    <div>
                        <p class="font-semibold text-green-800">Success</p>
                        <p class="text-green-700 text-sm"><?php echo $this->session->flashdata('success'); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php echo form_open('auth', 'class="space-y-4"'); ?>
            <div class="space-y-2">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" id="username" name="username" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan username" required>
                </div>
            </div>

            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" id="password" name="password" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan password" required>
                </div>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Login
                </button>
            </div>
        <?php echo form_close(); ?>

        <div class="mt-6 text-center text-sm text-gray-500">
            <p class="mb-1">Default Login: <span class="font-medium text-gray-700">admin / admin</span></p>
            <p>Belum punya akun? <a href="<?php echo site_url('auth/register'); ?>" class="text-blue-500 hover:text-blue-600">Daftar di sini</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginCard = document.querySelector('.transition-opacity');
            if (loginCard) {
                loginCard.classList.add('opacity-100');
            }
        });
    </script>
</body>
</html>