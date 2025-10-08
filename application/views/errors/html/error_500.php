<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Maaf, Sistem Lagi Lelah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background: radial-gradient(circle at top, #eef2ff 0%, #f8fafc 60%, #ffffff 100%); }
        .blurry-ring { animation: float 6s ease-in-out infinite alternate; }
        @keyframes float {
            0% { transform: translateY(0px) scale(1); opacity: 0.85; }
            100% { transform: translateY(-12px) scale(1.05); opacity: 1; }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-6 py-16 text-slate-800">
    <div class="relative w-full max-w-5xl">
        <div class="blurry-ring absolute inset-0 rounded-[2.75rem] bg-gradient-to-r from-violet-200 via-sky-200 to-indigo-200 blur-3xl"></div>
        <div class="relative overflow-hidden rounded-[2.75rem] bg-white/90 backdrop-blur-xl shadow-[0_30px_120px_rgba(79,70,229,0.2)]">
            <div class="grid md:grid-cols-2 gap-0">
                <div class="p-10 md:p-14 flex flex-col justify-center gap-6">
                    <div class="inline-flex items-center gap-3 rounded-full bg-indigo-100 px-4 py-2 text-sm font-semibold text-indigo-700 uppercase tracking-[0.35em]">
                        <i class="fas fa-circle-exclamation"></i>
                        Error 500
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-slate-900">
                        Ups, Mesinnya Lagi Pusing
                    </h1>
                    <p class="text-lg text-slate-600 leading-relaxed">
                        Permintaan kamu bikin sistem kami kepanasan. Kami sudah catat kejadian ini dan akan segera membenahinya. Untuk saat ini, coba istirahatkan halaman ini sebentar ya.
                    </p>
                    <div class="flex flex-wrap gap-3 text-sm text-slate-500">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-slate-200 bg-slate-50">
                            <i class="fas fa-code"></i>
                            Tim dev sudah dapat notifikasi
                        </span>
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-slate-200 bg-slate-50">
                            <i class="fas fa-mug-hot"></i>
                            Sementara, ngopi dulu
                        </span>
                    </div>
                    <div class="flex flex-wrap items-center gap-3 pt-6">
                        <a href="<?php echo site_url(); ?>" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-blue-500 text-white font-semibold shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transition-transform hover:-translate-y-0.5">
                            <i class="fas fa-house"></i>
                            Balik ke Beranda
                        </a>
                        <button onclick="location.reload();" class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-indigo-200 bg-white text-indigo-600 font-semibold hover:bg-indigo-50 transition">
                            <i class="fas fa-rotate"></i>
                            Coba Lagi
                        </button>
                    </div>
                </div>
                <div class="relative hidden md:flex items-center justify-center bg-gradient-to-br from-indigo-600 via-violet-600 to-blue-600 text-white">
                    <div class="absolute -top-12 -right-12 w-64 h-64 rounded-full bg-white/10 blur-3xl"></div>
                    <div class="absolute -bottom-12 -left-12 w-72 h-72 rounded-full bg-white/10 blur-3xl"></div>
                    <div class="relative p-10 text-center space-y-6">
                        <div class="mx-auto w-28 h-28 rounded-3xl bg-white/15 flex items-center justify-center text-4xl shadow-lg shadow-indigo-900/30">
                            <i class="fas fa-server"></i>
                        </div>
                        <h2 class="text-2xl font-semibold">Apa yang Bisa Dilakukan?</h2>
                        <ul class="space-y-3 text-sm text-indigo-100">
                            <li class="flex items-center gap-3"><i class="fas fa-check text-indigo-200"></i><span>Segarkan halaman setelah beberapa saat</span></li>
                            <li class="flex items-center gap-3"><i class="fas fa-check text-indigo-200"></i><span>Kembali ke beranda untuk menjelajah fitur lainnya</span></li>
                            <li class="flex items-center gap-3"><i class="fas fa-check text-indigo-200"></i><span>Laporkan ke kami jika ini terus terjadi</span></li>
                        </ul>
                        <div class="pt-6 text-xs text-indigo-200/80">
                            Error ID: <span class="font-semibold"><?= isset($error_id) ? $error_id : strtoupper(bin2hex(random_bytes(3))); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
