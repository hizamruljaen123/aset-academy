<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Server Error - Sistem Dalam Perbaikan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .floating-shapes {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        .floating-shapes:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        .floating-shapes:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 20%;
            animation-delay: 2s;
        }
        .floating-shapes:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-6 py-16 relative overflow-hidden">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes"></div>
    <div class="floating-shapes"></div>
    <div class="floating-shapes"></div>

    <div class="relative w-full max-w-6xl z-10">
        <!-- Development Debug Information -->
        <?php if (defined('ENVIRONMENT') && ENVIRONMENT === 'development'): ?>
        <div class="mb-8 bg-red-50 border border-red-200 rounded-2xl p-6 shadow-lg">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-bug text-red-600"></i>
                </div>
                <h3 class="text-xl font-bold text-red-800">Development Debug Information</h3>
            </div>

            <div class="grid lg:grid-cols-2 gap-6">
                <!-- Error Details -->
                <div class="glass-card p-6 rounded-xl">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                        <h4 class="font-bold text-gray-800">Error Details</h4>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status Code:</span>
                            <span class="font-semibold text-red-600"><?php echo isset($status_code) ? $status_code : '500'; ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Heading:</span>
                            <span class="font-semibold"><?php echo isset($heading) ? $heading : 'Internal Server Error'; ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Message:</span>
                            <span class="font-semibold text-red-600"><?php echo isset($message) ? $message : 'An error occurred'; ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Timestamp:</span>
                            <span class="font-semibold"><?php echo date('Y-m-d H:i:s'); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Request Information -->
                <div class="glass-card p-6 rounded-xl">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-globe text-blue-500 mr-2"></i>
                        <h4 class="font-bold text-gray-800">Request Information</h4>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">URI:</span>
                            <span class="font-semibold font-mono text-xs bg-gray-100 px-2 py-1 rounded"><?php echo isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : 'N/A'; ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Method:</span>
                            <span class="font-semibold"><?php echo isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'N/A'; ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">IP:</span>
                            <span class="font-semibold"><?php echo isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'N/A'; ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">User Agent:</span>
                            <span class="font-semibold text-xs"><?php echo isset($_SERVER['HTTP_USER_AGENT']) ? substr($_SERVER['HTTP_USER_AGENT'], 0, 40) . '...' : 'N/A'; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error Trace -->
            <?php if (isset($trace) || function_exists('error_get_last')): ?>
            <div class="mt-6 glass-card p-6 rounded-xl">
                <div class="flex items-center mb-3">
                    <i class="fas fa-code text-purple-500 mr-2"></i>
                    <h4 class="font-bold text-gray-800">Error Stack Trace</h4>
                </div>
                <div class="bg-gray-900 text-green-400 p-4 rounded-lg font-mono text-xs overflow-x-auto max-h-40 overflow-y-auto">
                    <?php
                    if (isset($trace)) {
                        echo nl2br(htmlspecialchars($trace));
                    } elseif (($last_error = error_get_last()) !== null) {
                        echo '<pre>' . print_r($last_error, true) . '</pre>';
                    } else {
                        echo 'No stack trace available. Check application/logs/ for more details.';
                    }
                    ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- POST Data -->
            <?php if (!empty($_POST)): ?>
            <div class="mt-6 glass-card p-6 rounded-xl">
                <div class="flex items-center mb-3">
                    <i class="fas fa-database text-orange-500 mr-2"></i>
                    <h4 class="font-bold text-gray-800">POST Data</h4>
                </div>
                <div class="bg-gray-900 text-green-400 p-4 rounded-lg font-mono text-xs overflow-x-auto max-h-32 overflow-y-auto">
                    <pre><?php echo htmlspecialchars(print_r($_POST, true)); ?></pre>
                </div>
            </div>
            <?php endif; ?>

            <!-- Session Data -->
            <?php if (isset($_SESSION) && !empty($_SESSION)): ?>
            <div class="mt-6 glass-card p-6 rounded-xl">
                <div class="flex items-center mb-3">
                    <i class="fas fa-user-circle text-indigo-500 mr-2"></i>
                    <h4 class="font-bold text-gray-800">Session Data</h4>
                </div>
                <div class="bg-gray-900 text-green-400 p-4 rounded-lg font-mono text-xs overflow-x-auto max-h-32 overflow-y-auto">
                    <pre><?php echo htmlspecialchars(print_r($_SESSION, true)); ?></pre>
                </div>
            </div>
            <?php endif; ?>

            <!-- Recent Logs -->
            <div class="mt-6 glass-card p-6 rounded-xl">
                <div class="flex items-center mb-3">
                    <i class="fas fa-file-alt text-teal-500 mr-2"></i>
                    <h4 class="font-bold text-gray-800">Recent Application Logs</h4>
                </div>
                <div class="bg-gray-900 text-green-400 p-4 rounded-lg font-mono text-xs overflow-x-auto max-h-32 overflow-y-auto">
                    <?php
                    $log_file = APPPATH . 'logs/log-' . date('Y-m-d') . '.php';
                    if (file_exists($log_file)) {
                        $logs = file($log_file);
                        $recent_logs = array_slice($logs, -15); // Get last 15 lines
                        foreach ($recent_logs as $log) {
                            echo htmlspecialchars($log) . '<br>';
                        }
                    } else {
                        echo '<span class="text-yellow-400">No recent logs found. Check application/logs/ directory.</span>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Main Error Card -->
        <div class="glass-card rounded-3xl shadow-2xl overflow-hidden">
            <div class="grid lg:grid-cols-2 gap-0">
                <!-- Left Side - Error Info -->
                <div class="p-8 lg:p-12 flex flex-col justify-center">
                    <!-- Error Badge -->
                    <div class="inline-flex items-center gap-3 rounded-full bg-red-100 px-4 py-2 text-sm font-bold text-red-700 uppercase tracking-wider mb-6">
                        <div class="w-3 h-3 bg-red-500 rounded-full pulse-animation"></div>
                        <i class="fas fa-exclamation-triangle"></i>
                        Error 500
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-4xl lg:text-5xl font-bold leading-tight mb-4">
                        <span class="gradient-text">Oops!</span>
                        <br>Sistem Lagi Istirahat
                    </h1>

                    <!-- Description -->
                    <p class="text-lg text-gray-600 leading-relaxed mb-8">
                        Permintaan kamu bikin sistem kami kepanasan. Kami sudah catat kejadian ini dan akan segera membenahinya.
                        Untuk saat ini, coba istirahatkan halaman ini sebentar ya.
                    </p>

                    <!-- Status Info -->
                    <div class="flex flex-wrap gap-3 mb-8">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-green-200 bg-green-50 text-green-700 text-sm">
                            <i class="fas fa-wifi text-green-500"></i>
                            Tim dev sudah dapat notifikasi
                        </span>
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-sm">
                            <i class="fas fa-coffee text-blue-500"></i>
                            Sementara, ngopi dulu yuk
                        </span>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3">
                        <a href="<?php echo site_url(); ?>"
                           class="inline-flex items-center gap-3 px-6 py-3 rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <i class="fas fa-home"></i>
                            <span>Balik ke Beranda</span>
                        </a>
                        <button onclick="location.reload();"
                                class="inline-flex items-center gap-3 px-6 py-3 rounded-full border-2 border-indigo-200 bg-white text-indigo-600 font-semibold hover:bg-indigo-50 transition-all duration-300">
                            <i class="fas fa-redo-alt"></i>
                            <span>Coba Lagi</span>
                        </button>
                    </div>

                    <!-- Error ID -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>Error ID:</span>
                            <code class="bg-gray-100 px-2 py-1 rounded font-mono text-xs">
                                <?= isset($error_id) ? $error_id : strtoupper(bin2hex(random_bytes(3))); ?>
                            </code>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Visual -->
                <div class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 p-8 lg:p-12 flex items-center justify-center">
                    <!-- Background Decorations -->
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-10 right-10 w-32 h-32 bg-white rounded-full blur-2xl"></div>
                        <div class="absolute bottom-10 left-10 w-24 h-24 bg-white rounded-full blur-2xl"></div>
                    </div>

                    <!-- Main Icon -->
                    <div class="relative z-10 text-center">
                        <div class="w-24 h-24 mx-auto mb-6 bg-white/20 rounded-full flex items-center justify-center text-5xl shadow-lg">
                            <i class="fas fa-server text-white"></i>
                        </div>

                        <h2 class="text-2xl font-bold text-white mb-4">Apa yang Bisa Dilakukan?</h2>

                        <div class="space-y-3 text-indigo-100">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-indigo-300 rounded-full"></div>
                                <span class="text-sm">Segarkan halaman setelah beberapa saat</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-indigo-300 rounded-full"></div>
                                <span class="text-sm">Kembali ke beranda untuk menjelajah fitur lainnya</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-indigo-300 rounded-full"></div>
                                <span class="text-sm">Laporkan ke kami jika ini terus terjadi</span>
                            </div>
                        </div>

                        <!-- Help Links -->
                        <div class="mt-8 pt-6 border-t border-white/20">
                            <div class="flex justify-center space-x-4 text-xs text-indigo-200">
                                <a href="<?php echo site_url('forum'); ?>" class="hover:text-white transition-colors">
                                    <i class="fas fa-comments mr-1"></i>Forum Bantuan
                                </a>
                                <a href="mailto:support@aset-academy.com" class="hover:text-white transition-colors">
                                    <i class="fas fa-envelope mr-1"></i>Email Support
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
