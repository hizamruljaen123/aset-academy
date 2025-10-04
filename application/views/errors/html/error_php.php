<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$showBacktrace = defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE;
?><!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>PHP Lagi Ngomel</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
    body { font-family: 'Poppins', sans-serif; background: #fdf2f8; }
    .icon-spin { animation: spinny 6s linear infinite; }
    @keyframes spinny { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</style>
</head>
<body class="min-h-screen flex items-center justify-center px-6 py-12">
    <div class="relative max-w-4xl w-full">
        <div class="absolute inset-0 blur-3xl bg-gradient-to-br from-rose-200 via-pink-200 to-fuchsia-200 opacity-60"></div>
        <div class="relative bg-white/85 backdrop-blur-xl rounded-[2.5rem] shadow-[0_25px_70px_RGBA(251,113,133,0.25)] p-10">
            <div class="flex flex-col gap-6">
                <div class="flex flex-wrap items-center gap-6">
                    <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-rose-500 to-pink-500 text-white text-4xl flex items-center justify-center shadow-lg shadow-rose-200/70">
                        <i class="fas fa-code icon-spin"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-extrabold text-slate-800 mb-1">PHP Lagi Ngomel!</h1>
                        <p class="text-sm font-semibold text-rose-500 uppercase tracking-[0.3em]">Ada bug lucu nih...</p>
                    </div>
                </div>
                <div class="bg-rose-50 border border-rose-200 rounded-2xl px-6 py-5 text-sm text-rose-700">
                    <p class="font-semibold text-rose-800 mb-3">Detail Error:</p>
                    <ul class="space-y-2">
                        <li><span class="font-semibold text-rose-900">Severity:</span> <?php echo $severity; ?></li>
                        <li><span class="font-semibold text-rose-900">Pesan:</span> <?php echo $message; ?></li>
                        <li><span class="font-semibold text-rose-900">File:</span> <?php echo $filepath; ?></li>
                        <li><span class="font-semibold text-rose-900">Baris:</span> <?php echo $line; ?></li>
                    </ul>
                </div>
                <?php if ($showBacktrace): ?>
                <div class="bg-slate-900/95 text-pink-100 rounded-2xl px-6 py-5 text-xs overflow-x-auto">
                    <p class="font-semibold text-rose-200 mb-3">Catatan detektif (backtrace):</p>
                    <?php foreach (debug_backtrace() as $error): ?>
                        <?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>
                            <div class="border border-rose-400/40 rounded-xl p-3 mb-3">
                                <p><span class="text-rose-200">File:</span> <?php echo $error['file']; ?></p>
                                <p><span class="text-rose-200">Baris:</span> <?php echo $error['line']; ?></p>
                                <p><span class="text-rose-200">Fungsi:</span> <?php echo $error['function']; ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <div class="flex flex-wrap items-center justify-between gap-3 text-sm text-rose-500">
                    <span class="inline-flex items-center gap-2"><i class="fas fa-heart-crack text-rose-400"></i> Santuy, ini cuma error sementara. Mesin masih sayang kok.</span>
                    <button onclick="history.back();" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold text-white bg-gradient-to-r from-rose-500 via-pink-500 to-fuchsia-500 shadow-md hover:shadow-lg transition-all">
                        <i class="fas fa-undo"></i>
                        Balik ke Halaman Sebelumnya
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>