<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Materi Saya</h1>
                <p class="text-sm opacity-90 mt-1"><?php echo count($materi); ?> materi yang Anda buat</p>
            </div>
            <div class="hidden sm:flex items-center space-x-6">
                <div class="text-center">
                    <div class="text-3xl font-bold"><?php echo count($materi); ?></div>
                    <div class="text-xs opacity-80">Total Materi</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold"><?php echo count($kelas); ?></div>
                    <div class="text-xs opacity-80">Untuk Kelas</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Materi</h2>
        <div class="flex items-center gap-4 w-full sm:w-auto">
            <div class="relative w-full sm:w-auto">
                <select class="appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option>Semua Kelas</option>
                    <?php foreach($kelas as $k): ?>
                        <option><?php echo $k->nama_kelas; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>
            <a href="<?php echo site_url('teacher/create_materi'); ?>" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-lg shadow-sm transition-colors">
                <i class="fas fa-plus mr-2"></i> Materi Baru
            </a>
        </div>
    </div>

    <!-- Materi Grid -->
    <?php if (empty($materi)): ?>
        <div class="text-center py-16 bg-white rounded-2xl shadow-md">
            <div class="mx-auto w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center mb-6">
                <i class="fas fa-book-open text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Materi</h3>
            <p class="text-gray-500 mb-6">Anda belum membuat materi untuk kelas manapun.</p>
            <a href="<?php echo site_url('teacher/create_materi'); ?>" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                Buat Materi Baru
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($materi as $m): ?>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col transform hover:-translate-y-1 transition-all duration-300">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-xs font-semibold bg-purple-100 text-purple-800 px-3 py-1 rounded-full"><?php echo $m->nama_kelas; ?></span>
                            <span class="text-xs text-gray-500"><?php echo date('d M Y', strtotime($m->updated_at)); ?></span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2 h-12"><?php echo $m->judul; ?></h3>
                        <p class="text-gray-600 text-sm mb-4 h-16 overflow-hidden"><?php echo character_limiter($m->deskripsi, 100); ?></p>
                    </div>
                    <div class="p-5 mt-auto bg-gray-50 border-t flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-layer-group mr-2 text-gray-400"></i><?php echo $m->jumlah_part; ?> Part Materi
                        </div>
                        <a href="<?php echo site_url('teacher/materi_detail/' . $m->id); ?>" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 hover:bg-gray-100 text-gray-800 text-sm font-medium rounded-lg shadow-sm transition-colors">
                            Detail <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
