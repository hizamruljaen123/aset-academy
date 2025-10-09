<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo $description; ?>">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .maintenance-container {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            left: 10%;
            top: 20%;
            animation-delay: 0s;
        }
        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            right: 15%;
            top: 40%;
            animation-delay: 2s;
        }
        .shape:nth-child(3) {
            width: 100px;
            height: 100px;
            left: 20%;
            bottom: 20%;
            animation-delay: 4s;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="maintenance-container bg-white bg-opacity-95 backdrop-blur-sm rounded-2xl shadow-2xl p-8 md:p-12 max-w-2xl w-full mx-4 text-center relative z-10">
        <!-- Maintenance Icon -->
        <div class="mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-6">
                <i class="fas fa-tools text-white text-3xl"></i>
            </div>
        </div>

        <!-- Title -->
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
            Website Dalam Pemeliharaan
        </h1>

        <!-- Message -->
        <div class="text-lg text-gray-600 mb-8 leading-relaxed">
            <?php echo isset($maintenance_message) ? $maintenance_message : 'Website Aset Academy sedang dalam proses pemeliharaan untuk memberikan pengalaman yang lebih baik. Kami akan segera kembali melayani Anda.'; ?>
        </div>

        <!-- Features List -->
        <div class="bg-gray-50 rounded-xl p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Yang Sedang Kami Lakukan:</h3>
            <div class="grid md:grid-cols-2 gap-4 text-left">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span class="text-gray-700">Peningkatan performa sistem</span>
                </div>
                <div class="flex items-center space-x-3">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span class="text-gray-700">Update fitur terbaru</span>
                </div>
                <div class="flex items-center space-x-3">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span class="text-gray-700">Perbaikan keamanan</span>
                </div>
                <div class="flex items-center space-x-3">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span class="text-gray-700">Optimasi pengalaman pengguna</span>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="border-t border-gray-200 pt-8">
            <p class="text-gray-600 mb-4">
                Butuh bantuan segera? Hubungi kami:
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-6">
                <a href="mailto:support@asetacademy.id" class="flex items-center space-x-2 text-blue-600 hover:text-blue-800 transition-colors">
                    <i class="fas fa-envelope"></i>
                    <span>support@asetacademy.id</span>
                </a>
                <span class="hidden sm:block text-gray-400">|</span>
                <div class="flex items-center space-x-2 text-gray-600">
                    <i class="fas fa-clock"></i>
                    <span>Estimasi selesai: 2-4 jam</span>
                </div>
            </div>
        </div>

        <!-- Refresh Button -->
        <div class="mt-8">
            <button onclick="window.location.reload()" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-purple-700 transition-all duration-200 transform hover:scale-105">
                <i class="fas fa-refresh mr-2"></i>
                Periksa Status
            </button>
        </div>
    </div>

    <!-- Footer -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-white text-sm opacity-75">
        <p>&copy; <?php echo date('Y'); ?> Aset Academy. All rights reserved.</p>
    </div>
</body>
</html>
