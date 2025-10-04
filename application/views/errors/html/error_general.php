<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base_url = config_item('base_url');
$isProduction = defined('ENVIRONMENT') && ENVIRONMENT === 'production';
?><!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Waduh, Sistem Lagi Bingung!</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
    body {
        font-family: 'Poppins', sans-serif;
        background: radial-gradient(circle at top left, #fde68a, transparent 40%),
                    radial-gradient(circle at bottom right, #fbcfe8, transparent 45%),
                    #f8fafc;
    }
    .icon-bubble {
        width: 150px;
        height: 150px;
        border-radius: 9999px;
        background: linear-gradient(135deg, rgba(248, 113, 113, 0.9), rgba(251, 191, 36, 0.9));
        box-shadow: 0 30px 60px rgba(248, 113, 113, 0.45);
        animation: bouncey 4.5s ease-in-out infinite;
    }
    .icon-bubble i {
        animation: pulse 2.5s ease-in-out infinite;
    }
    @keyframes bouncey {
        0%, 100% { transform: translateY(0) scale(1); }
        50% { transform: translateY(-14px) scale(1.05); }
    }
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
</style>
</head>
<body class="min-h-screen flex items-center justify-center px-6 py-12">
    <div class="relative w-full max-w-2xl">
        <div class="absolute inset-0 rounded-3xl bg-white blur-3xl opacity-60"></div>
        <div class="relative bg-white/80 backdrop-blur-xl rounded-3xl shadow-[0_25px_80px_rgba(248,113,113,0.25)] p-10">
            <div class="flex flex-col items-center text-center gap-6">
                <div class="icon-bubble flex items-center justify-center text-white text-5xl">
                    <i class="fas fa-bug"></i>
                </div>
                <div>
                    <h1 class="text-4xl font-extrabold text-slate-800 mb-1"><?php echo strip_tags($heading); ?></h1>
                    <p class="text-sm font-semibold text-amber-500 uppercase tracking-[0.25em]">Oops! Sistem lagi ngambek</p>
                </div>
                <div class="w-full bg-gradient-to-br from-slate-50 to-white border border-slate-200 rounded-2xl px-6 py-5 text-left text-slate-600 text-sm leading-relaxed shadow-inner">
                    <p class="font-semibold text-slate-700 mb-2">Curhatan mesin:</p>
                    <?php if ($isProduction): ?>
                        <p class="mb-4">“Ada sedikit gangguan teknis nih, tapi kami sudah kebut mengatasinya. Coba lagi sebentar lagi ya!”</p>
                    <?php else: ?>
                        <div class="prose prose-sm max-w-none">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <p class="mt-4 text-slate-500">“Santai aja. Sambil nunggu kami beresin, kamu bisa klik tombol di bawah biar balik ke tempat aman.”</p>
                </div>
                <a href="<?php echo $base_url; ?>" class="inline-flex items-center gap-3 px-7 py-3.5 rounded-full text-base font-semibold text-white bg-gradient-to-r from-rose-500 via-amber-500 to-orange-500 shadow-lg shadow-rose-200/70 hover:shadow-rose-300/80 transition-all duration-300">
                    <i class="fas fa-home-heart"></i>
                    Ajak Saya ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>