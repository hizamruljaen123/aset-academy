<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Asset Academy</title>
    
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
            <p class="text-gray-500 text-sm">Registrasi Akun Baru</p>
        </div>

        <?php echo form_open('auth/register', 'class="space-y-4"'); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" id="username" name="username" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan username" value="<?php echo set_value('username'); ?>" required>
                    </div>
                    <?php echo form_error('username', '<p class="text-red-600 text-xs mt-1">', '</p>'); ?>
                </div>
                
                <div class="space-y-2">
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user-tag text-gray-400"></i>
                        </div>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan nama lengkap" value="<?php echo set_value('nama_lengkap'); ?>" required>
                    </div>
                    <?php echo form_error('nama_lengkap', '<p class="text-red-600 text-xs mt-1">', '</p>'); ?>
                </div>
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" id="email" name="email" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan email" value="<?php echo set_value('email'); ?>" required>
                </div>
                <?php echo form_error('email', '<p class="text-red-600 text-xs mt-1">', '</p>'); ?>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan password" required>
                    </div>
                    <?php echo form_error('password', '<p class="text-red-600 text-xs mt-1">', '</p>'); ?>
                </div>
                
                <div class="space-y-2">
                    <label for="password_confirm" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password_confirm" name="password_confirm" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Konfirmasi password" required>
                    </div>
                    <?php echo form_error('password_confirm', '<p class="text-red-600 text-xs mt-1">', '</p>'); ?>
                </div>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-user-plus mr-2"></i>
                    Register
                </button>
            </div>
        <?php echo form_close(); ?>

        <div class="mt-6 text-center text-sm text-gray-500">
            <p>Sudah punya akun? <a href="<?php echo site_url('auth'); ?>" class="text-blue-500 hover:text-blue-600">Login di sini</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registerCard = document.querySelector('.transition-opacity');
            if (registerCard) {
                registerCard.classList.add('opacity-100');
            }
        });
    </script>
</body>
</html>