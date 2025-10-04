<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base_url = config_item('base_url');
?><!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>404 - Ups, Halaman Hilang!</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #e0f2fe, #f8fafc);
    }
    .icon-container {
        width: 160px;
        height: 160px;
        border-radius: 9999px;
        background: radial-gradient(circle at 30% 30%, rgba(59,130,246,0.2), transparent 60%),
                    radial-gradient(circle at 70% 70%, rgba(99,102,241,0.25), transparent 65%),
                    #1d4ed8;
        box-shadow: 0 20px 60px rgba(37, 99, 235, 0.35);
        animation: floaty 5s ease-in-out infinite;
    }
    .icon-container i {
        animation: wiggle 4s ease-in-out infinite;
    }
    @keyframes floaty {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
    }
    @keyframes wiggle {
        0%, 100% { transform: rotate(-6deg); }
        50% { transform: rotate(6deg); }
    }
</style>
</head>
<body class="min-h-screen flex items-center justify-center px-6 py-12">
    <div class="relative max-w-xl w-full">
        <div class="absolute inset-0 blur-3xl bg-gradient-to-r from-blue-200 via-indigo-200 to-sky-200 opacity-60"></div>
        <div class="relative text-center p-10 bg-white/80 backdrop-blur-xl rounded-3xl shadow-[0_25px_70px_rgba(79,70,229,0.25)]">
            <div class="icon-container mx-auto flex items-center justify-center text-white text-5xl mb-8">
                <i class="fas fa-compass"></i>
            </div>
            <h1 class="text-5xl font-extrabold text-slate-800 tracking-tight mb-3">404 — Nyasar Nih!</h1>
            <p class="text-sm font-semibold text-indigo-500 uppercase tracking-[0.35em] mb-4"><?php echo strip_tags($heading); ?></p>
            <p class="text-lg text-slate-500 max-w-md mx-auto mb-6">
                Halaman yang kamu cari sepertinya kabur entah ke mana. Mungkin lagi nongkrong di folder lain? 🤔
            </p>
            <div class="bg-slate-50 border border-slate-200 rounded-2xl px-6 py-5 text-slate-600 text-sm leading-relaxed mb-8">
                <p class="font-semibold text-slate-700 mb-1">Pesan dari penjaga server:</p>
                <p>“Tenang aja, napas dulu. Klik tombol di bawah biar kami antar balik ke beranda.”</p>
            </div>
            <a href="<?php echo $base_url; ?>" class="inline-flex items-center gap-3 px-7 py-3.5 rounded-full text-base font-semibold text-white bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 shadow-lg shadow-indigo-200/60 hover:shadow-indigo-300/80 transition-all duration-300">
                <i class="fas fa-house-chimney"></i>
                Balik ke Beranda
            </a>
        </div>
    </div>
</body>
</html>