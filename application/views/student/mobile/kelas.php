<div class="space-y-4">
    <!-- Header -->
    <div class="mobile-card">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-900">Kelas Saya</h2>
            <button onclick="location.href='<?= site_url("student_mobile") ?>'" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <i data-feather="arrow-left" class="w-5 h-5 text-gray-600"></i>
            </button>
        </div>
        
        <!-- Tab Navigation -->
        <div class="flex bg-gray-100 rounded-lg p-1">
            <button onclick="switchTab('active')" id="activeTab" class="flex-1 py-2 px-4 rounded-md text-sm font-medium bg-white text-blue-600 shadow-sm">
                Aktif
            </button>
            <button onclick="switchTab('completed')" id="completedTab" class="flex-1 py-2 px-4 rounded-md text-sm font-medium text-gray-600 hover:text-gray-900">
                Selesai
            </button>
            <button onclick="switchTab('premium')" id="premiumTab" class="flex-1 py-2 px-4 rounded-md text-sm font-medium text-gray-600 hover:text-gray-900">
                Premium
            </button>
        </div>
    </div>

    <!-- Active Classes Tab -->
    <div id="activeContent" class="space-y-4">
        <?php if (empty($active_classes)): ?>
            <div class="text-center py-12">
                <i data-feather="graduation-cap" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
                <h4 class="text-lg font-medium text-gray-900 mb-2">Belum ada kelas aktif</h4>
                <p class="text-sm text-gray-500 mb-4">Anda belum terdaftar di kelas manapun</p>
                <button onclick="location.href='<?= site_url("student_mobile/browse_classes") ?>'" class="mobile-btn bg-blue-600 text-white">
                    Cari Kelas
                </button>
            </div>
        <?php else: ?>
            <?php foreach($active_classes as $kelas): ?>
                <div class="mobile-card">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-1"><?php echo $kelas->nama_kelas; ?></h3>
                            <p class="text-sm text-gray-500"><?php echo $kelas->bahasa_program; ?> • <?php echo $kelas->level; ?></p>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                            Aktif
                        </span>
                    </div>
                    
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg p-4 text-white mb-3">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm opacity-90">Progress</span>
                            <span class="text-sm font-medium"><?php echo $kelas->progress ?? '0%'; ?></span>
                        </div>
                        <div class="w-full bg-white/20 rounded-full h-2">
                            <div class="bg-white h-2 rounded-full" style="width: <?php echo $kelas->progress ?? '0%'; ?>"></div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-3 mb-4">
                        <div class="text-center">
                            <div class="text-lg font-bold text-gray-900"><?php echo $kelas->total_materi ?? 0; ?></div>
                            <div class="text-xs text-gray-500">Materi</div>
                        </div>
                        <div class="text-center">
                            <div class="text-lg font-bold text-gray-900"><?php echo $kelas->total_siswa ?? 0; ?></div>
                            <div class="text-xs text-gray-500">Siswa</div>
                        </div>
                        <div class="text-center">
                            <div class="text-lg font-bold text-gray-900"><?php echo $kelas->durasi ?? 0; ?></div>
                            <div class="text-xs text-gray-500">Jam</div>
                        </div>
                    </div>
                    
                    <div class="flex space-x-2">
                        <button onclick="location.href='<?= site_url("student_mobile/materi?kelas_id=".$kelas->id) ?>'" class="mobile-btn flex-1 bg-blue-600 text-white">
                            <i data-feather="book-open" class="w-4 h-4 inline mr-1"></i>
                            Belajar
                        </button>
                        <button onclick="location.href='<?= site_url("student_mobile/absensi?kelas_id=".$kelas->id) ?>'" class="mobile-btn flex-1 border border-gray-300 text-gray-700">
                            <i data-feather="calendar" class="w-4 h-4 inline mr-1"></i>
                            Absensi
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Completed Classes Tab -->
    <div id="completedContent" class="space-y-4 hidden">
        <?php if (empty($completed_classes)): ?>
            <div class="text-center py-12">
                <i data-feather="award" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
                <h4 class="text-lg font-medium text-gray-900 mb-2">Belum ada kelas selesai</h4>
                <p class="text-sm text-gray-500">Lengkapi kelas Anda untuk mendapatkan sertifikat</p>
            </div>
        <?php else: ?>
            <?php foreach($completed_classes as $kelas): ?>
                <div class="mobile-card">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-1"><?php echo $kelas->nama_kelas; ?></h3>
                            <p class="text-sm text-gray-500"><?php echo $kelas->bahasa_program; ?> • <?php echo $kelas->level; ?></p>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                            Selesai
                        </span>
                    </div>
                    
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg p-4 text-white mb-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm opacity-90">Nilai Akhir</div>
                                <div class="text-2xl font-bold"><?php echo $kelas->nilai_akhir ?? 'A'; ?></div>
                            </div>
                            <i data-feather="award" class="w-8 h-8 opacity-80"></i>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <i data-feather="calendar" class="w-4 h-4 inline mr-1"></i>
                            Selesai: <?php echo date('d M Y', strtotime($kelas->tanggal_selesai)); ?>
                        </div>
                        <button class="text-blue-600 text-sm font-medium">
                            Lihat Sertifikat <i data-feather="external-link" class="w-3 h-3 inline ml-1"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Premium Classes Tab -->
    <div id="premiumContent" class="space-y-4 hidden">
        <?php if (empty($premium_classes)): ?>
            <div class="text-center py-12">
                <i data-feather="crown" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
                <h4 class="text-lg font-medium text-gray-900 mb-2">Belum ada kelas premium</h4>
                <p class="text-sm text-gray-500">Jelajahi kelas premium untuk pengalaman belajar yang lebih baik</p>
                <button onclick="location.href='<?= site_url("student_mobile/browse_premium") ?>'" class="mobile-btn bg-yellow-600 text-white">
                    Jelajahi Premium
                </button>
            </div>
        <?php else: ?>
            <?php foreach($premium_classes as $kelas): ?>
                <div class="mobile-card border-2 border-yellow-200">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-1">
                                <h3 class="text-lg font-bold text-gray-900"><?php echo $kelas->nama_kelas; ?></h3>
                                <i data-feather="crown" class="w-4 h-4 text-yellow-600"></i>
                            </div>
                            <p class="text-sm text-gray-500"><?php echo $kelas->bahasa_program; ?> • <?php echo $kelas->level; ?></p>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                            Premium
                        </span>
                    </div>
                    
                    <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-lg p-4 text-white mb-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm opacity-90">Harga</div>
                                <div class="text-xl font-bold">Rp <?php echo number_format($kelas->harga, 0, ',', '.'); ?></div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm opacity-90">Diskon</div>
                                <div class="text-lg font-bold">-<?php echo $kelas->diskon ?? '0%'; ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex space-x-2">
                        <button onclick="location.href='<?= site_url("student_mobile/premium_detail/".$kelas->id) ?>'" class="mobile-btn flex-1 bg-yellow-600 text-white">
                            <i data-feather="eye" class="w-4 h-4 inline mr-1"></i>
                            Detail
                        </button>
                        <button onclick="location.href='<?= site_url("payment/initiate/".$kelas->id) ?>'" class="mobile-btn flex-1 border border-yellow-600 text-yellow-600">
                            <i data-feather="shopping-cart" class="w-4 h-4 inline mr-1"></i>
                            Beli
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Browse Classes CTA -->
    <div class="mobile-card bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200">
        <div class="text-center py-4">
            <i data-feather="search" class="w-8 h-8 text-blue-600 mx-auto mb-2"></i>
            <h4 class="text-sm font-medium text-gray-900 mb-1">Tidak menemukan kelas yang Anda inginkan?</h4>
            <p class="text-xs text-gray-600 mb-3">Jelajahi ratusan kelas programming tersedia</p>
            <button onclick="location.href='<?= site_url("student_mobile/browse_classes") ?>'" class="mobile-btn bg-blue-600 text-white">
                Jelajahi Kelas
            </button>
        </div>
    </div>
</div>

<script>
    function switchTab(tab) {
        // Hide all content
        document.getElementById('activeContent').classList.add('hidden');
        document.getElementById('completedContent').classList.add('hidden');
        document.getElementById('premiumContent').classList.add('hidden');
        
        // Remove active state from all tabs
        document.getElementById('activeTab').classList.remove('bg-white', 'text-blue-600', 'shadow-sm');
        document.getElementById('activeTab').classList.add('text-gray-600');
        document.getElementById('completedTab').classList.remove('bg-white', 'text-blue-600', 'shadow-sm');
        document.getElementById('completedTab').classList.add('text-gray-600');
        document.getElementById('premiumTab').classList.remove('bg-white', 'text-blue-600', 'shadow-sm');
        document.getElementById('premiumTab').classList.add('text-gray-600');
        
        // Show selected content and activate tab
        document.getElementById(tab + 'Content').classList.remove('hidden');
        document.getElementById(tab + 'Tab').classList.add('bg-white', 'text-blue-600', 'shadow-sm');
        document.getElementById(tab + 'Tab').classList.remove('text-gray-600');
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        feather.replace();
    });
</script>