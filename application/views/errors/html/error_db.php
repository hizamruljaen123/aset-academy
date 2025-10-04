<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Database Lagi Mager</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
    body {
        font-family: 'Poppins', sans-serif;
        background: radial-gradient(circle at 20% 20%, rgba(34,197,94,0.2), transparent 55%),
                    radial-gradient(circle at 80% 30%, rgba(59,130,246,0.25), transparent 60%),
                    #f1f5f9;
    }
    .db-icon {
        width: 140px;
        height: 140px;
        border-radius: 32px;
        background: conic-gradient(from 180deg at 50% 50%, rgba(34,197,94,0.8), rgba(59,130,246,0.8), rgba(34,197,94,0.8));
        box-shadow: 0 25px 75px rgba(34,197,94,0.25);
        animation: gentleTilt 5s ease-in-out infinite;
    }
    .db-icon i {
        animation: softPulse 3.5s ease-in-out infinite;
    }
    @keyframes gentleTilt {
        0%, 100% { transform: rotate(-4deg) scale(1); }
        50% { transform: rotate(6deg) scale(1.03); }
    }
    @keyframes softPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.08); }
    }
</style>
</head>
<body class="min-h-screen flex items-center justify-center px-6 py-12">
    <div class="relative max-w-3xl w-full">
        <div class="absolute inset-0 blur-3xl bg-gradient-to-br from-emerald-200 via-sky-200 to-emerald-100 opacity-60"></div>
        <div class="relative bg-white/85 backdrop-blur-xl rounded-3xl shadow-[0_25px_70px_rgba(16,185,129,0.25)] p-10">
            <div class="flex flex-col gap-6">
                <div class="flex items-center gap-6">
                    <div class="db-icon flex items-center justify-center text-white text-5xl">
                        <i class="fas fa-database"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-800 mb-1"><?php echo strip_tags($heading); ?></h1>
                        <p class="text-sm font-semibold text-emerald-500 uppercase tracking-[0.3em]">Database lagi tidur siang</p>
                    </div>
                </div>
                <div class="bg-slate-50 border border-slate-200 rounded-2xl px-6 py-5 text-sm text-slate-600 leading-relaxed">
                    <p class="font-semibold text-slate-700 mb-2">Laporan kejadian:</p>
                    <div class="prose prose-sm max-w-none">
                        <?php echo $message; ?>
                    </div>
                    <p class="mt-4 text-slate-500">“Kayaknya database kami lagi butuh kopi. Coba refresh nanti, atau kontak tim kalau masih bandel.”</p>
                </div>
                <div class="flex flex-wrap items-center justify-between gap-3 text-sm">
                    <span class="inline-flex items-center gap-2 text-slate-500">
                        <i class="fas fa-circle-info text-emerald-500"></i>
                        Tips: cek koneksi, pastikan migrasi database sudah jalan, lalu coba lagi.
                    </span>
                    <a href="javascript:location.reload();" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 via-sky-500 to-blue-500 shadow-md shadow-emerald-200/60 hover:shadow-emerald-300/80 transition-all duration-300">
                        <i class="fas fa-rotate-right"></i>
                        Segarkan Halaman
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>