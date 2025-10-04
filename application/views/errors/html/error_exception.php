<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$showBacktrace = defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE;
?><!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Exception Tersandung</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
    body { font-family: 'Poppins', sans-serif; background: #f8fafc; }
    .ring-glow { animation: ping 3s infinite alternate ease-in-out; }
    @keyframes ping { from { transform: scale(1); opacity: 1; } to { transform: scale(1.1); opacity: 0.6; } }
</style>
</head>
<body class="min-h-screen flex items-center justify-center px-6 py-16">
    <div class="relative w-full max-w-4xl">
        <div class="ring-glow absolute inset-0 rounded-[2.5rem] bg-gradient-to-r from-violet-200 via-fuchsia-200 to-sky-200 blur-3xl"></div>
        <div class="relative bg-white/85 backdrop-blur-xl rounded-[2.5rem] shadow-[0_25px_80px_RGBA(129,140,248,0.25)] p-10">
            <div class="flex flex-col gap-6">
                <div class="flex flex-wrap items-center gap-6">
                    <div class="w-28 h-28 rounded-3xl bg-gradient-to-br from-indigo-500 to-purple-500 text-white text-4xl flex items-center justify-center shadow-lg shadow-indigo-300/60">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-extrabold text-slate-800 mb-1">Ups, Exception Kepleset!</h1>
                        <p class="text-sm font-semibold text-purple-500 uppercase tracking-[0.3em]">Mesin lagi ngerengek, sabar ya…</p>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-slate-50 border border-slate-200 rounded-2xl px-6 py-5 text-sm text-slate-600">
                        <p class="font-semibold text-slate-800 mb-3">Detil Kejadian:</p>
                        <ul class="space-y-2">
                            <li><span class="font-semibold text-slate-700">Tipe:</span> <?php echo get_class($exception); ?></li>
                            <li><span class="font-semibold text-slate-700">Pesan:</span> <?php echo $message; ?></li>
                            <li><span class="font-semibold text-slate-700">File:</span> <?php echo $exception->getFile(); ?></li>
                            <li><span class="font-semibold text-slate-700">Baris:</span> <?php echo $exception->getLine(); ?></li>
                        </ul>
                    </div>
                    <div class="bg-white border border-purple-200 rounded-2xl px-6 py-5 text-sm text-purple-700 shadow-inner">
                        <p class="font-semibold mb-2">Pesan dari server:</p>
                        <p>“Kode kamu bikin saya mikir keras sampai nabrak tembok. Ayo periksa logic-nya, sisakan sedikit kasih sayang untuk mesin.”</p>
                        <p class="mt-3 text-xs text-purple-400">Tips: cek input, pastikan dependency aman, dan jalankan ulang setelah ngopi.</p>
                    </div>
                </div>
                <?php if ($showBacktrace): ?>
                <div class="bg-slate-900/90 text-slate-100 rounded-2xl px-6 py-5 text-xs overflow-x-auto">
                    <p class="font-semibold text-amber-300 mb-3">Jejak kaki (backtrace):</p>
                    <?php foreach ($exception->getTrace() as $error): ?>
                        <?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>
                            <div class="border border-slate-700/80 rounded-xl p-3 mb-3">
                                <p><span class="text-amber-200">File:</span> <?php echo $error['file']; ?></p>
                                <p><span class="text-amber-200">Baris:</span> <?php echo $error['line']; ?></p>
                                <p><span class="text-amber-200">Fungsi:</span> <?php echo $error['function']; ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <div class="flex flex-wrap items-center justify-between gap-3 text-sm text-slate-500">
                    <span class="inline-flex items-center gap-2"><i class="fas fa-circle-exclamation text-purple-500"></i> Jangan panik, ini cuma exception — bukan kiamat.</span>
                    <button onclick="history.back();" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold text-white bg-gradient-to-r from-purple-500 via-indigo-500 to-blue-500 shadow-md hover:shadow-lg transition-all">
                        <i class="fas fa-arrow-left"></i>
                        Balik ke Halaman Sebelumnya
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>