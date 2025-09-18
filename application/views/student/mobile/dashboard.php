<div class="space-y-4">
    <!-- Quick Stats Cards -->
    <?php if (isset($total_materi) && $total_materi > 0): ?>
    <div class="mobile-card">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i data-feather="book" class="w-5 h-5 text-blue-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Materi</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo $total_materi; ?></p>
                </div>
            </div>
            <i data-feather="chevron-right" class="w-5 h-5 text-gray-400"></i>
        </div>
    </div>
    <?php endif; ?>

    <?php if (isset($total_classmates) && $total_classmates > 0): ?>
    <div class="mobile-card">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <i data-feather="users" class="w-5 h-5 text-indigo-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Teman Sekelas</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo $total_classmates; ?></p>
                </div>
            </div>
            <i data-feather="chevron-right" class="w-5 h-5 text-gray-400"></i>
        </div>
    </div>
    <?php endif; ?>

    <!-- Student Profile Card -->
    <?php if (isset($student_profile) && $student_profile): ?>
    <div class="mobile-card">
        <div class="flex items-center space-x-4">
            <div class="mobile-avatar">
                <?php echo strtoupper(substr($student_profile->nama_lengkap, 0, 1)); ?>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-900"><?php echo $student_profile->nama_lengkap; ?></h3>
                <p class="text-sm text-gray-500"><?php echo $student_profile->kelas; ?> - <?php echo $student_profile->jurusan; ?></p>
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium <?php echo ($student_profile->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                    <?php echo $student_profile->status; ?>
                </span>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-2 gap-3">
            <div class="bg-gray-50 rounded-lg p-3">
                <div class="flex items-center space-x-2">
                    <i data-feather="id-card" class="w-4 h-4 text-gray-500"></i>
                    <span class="text-xs text-gray-500">NIS</span>
                </div>
                <p class="text-sm font-medium text-gray-900 mt-1"><?php echo $student_profile->nis; ?></p>
            </div>
            <div class="bg-gray-50 rounded-lg p-3">
                <div class="flex items-center space-x-2">
                    <i data-feather="phone" class="w-4 h-4 text-gray-500"></i>
                    <span class="text-xs text-gray-500">Telepon</span>
                </div>
                <p class="text-sm font-medium text-gray-900 mt-1"><?php echo $student_profile->no_telepon; ?></p>
            </div>
        </div>
        <button onclick="location.href='<?= site_url('student_mobile/profile') ?>'" class="mobile-btn w-full mt-4 bg-blue-600 text-white">
            <i data-feather="edit-3" class="w-4 h-4 inline mr-2"></i>
            Edit Profil
        </button>
    </div>
    <?php endif; ?>

    <!-- Tab Navigation -->
    <div class="mobile-tabs">
        <button class="mobile-tab active" onclick="switchTab('regular')">
            Kelas Reguler
        </button>
        <button class="mobile-tab" onclick="switchTab('premium')">
            Kelas Premium
        </button>
    </div>

    <!-- Regular Class Content -->
    <div id="regularClassContent">
        <!-- Current Class Info -->
        <?php if (isset($class_details) && $class_details): ?>
        <div class="mobile-card">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-gray-900">Kelas Saya</h3>
                <span class="px-3 py-1 text-xs font-medium rounded-full <?php echo ($class_details->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; ?>">
                    <?php echo $class_details->status; ?>
                </span>
            </div>
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg p-4 text-white mb-4">
                <h4 class="text-lg font-bold mb-2"><?php echo $class_details->nama_kelas; ?></h4>
                <span class="px-2 py-1 bg-white/20 rounded-full text-xs font-medium">
                    <?php echo $class_details->bahasa_program; ?>
                </span>
                <div class="mt-3 space-y-1">
                    <div class="flex items-center text-sm">
                        <i data-feather="trending-up" class="w-4 h-4 mr-2"></i>
                        <span><?php echo $class_details->level; ?></span>
                    </div>
                    <div class="flex items-center text-sm">
                        <i data-feather="clock" class="w-4 h-4 mr-2"></i>
                        <span><?php echo $class_details->durasi; ?> Jam</span>
                    </div>
                    <div class="flex items-center text-sm">
                        <i data-feather="book-open" class="w-4 h-4 mr-2"></i>
                        <span><?php echo $total_materi; ?> Materi</span>
                    </div>
                </div>
            </div>
            <button onclick="location.href='<?= site_url('student_mobile/materi') ?>'" class="mobile-btn w-full bg-blue-600 text-white">
                <i data-feather="book" class="w-4 h-4 inline mr-2"></i>
                Lihat Materi
            </button>
        </div>
        <?php endif; ?>

        <!-- Recent Materials -->
        <div class="mobile-card">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-gray-900">Materi Terbaru</h3>
                <button onclick="location.href='<?= site_url('student_mobile/materi') ?>'" class="text-sm text-blue-600">
                    Lihat Semua
                </button>
            </div>
            <?php if (empty($recent_materials)): ?>
                <div class="text-center py-8">
                    <i data-feather="book-open" class="w-12 h-12 text-gray-300 mx-auto mb-2"></i>
                    <p class="text-sm text-gray-500">Belum ada materi</p>
                </div>
            <?php else: ?>
                <div class="space-y-3">
                    <?php foreach($recent_materials as $materi): ?>
                        <div class="border border-gray-100 rounded-lg p-3 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i data-feather="file-text" class="w-4 h-4 text-blue-600"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900"><?php echo $materi->judul; ?></h4>
                                    <p class="text-xs text-gray-500 mt-1"><?php echo date('d M Y', strtotime($materi->created_at)); ?></p>
                                    <p class="text-xs text-gray-600 mt-1 line-clamp-2"><?php echo substr($materi->deskripsi, 0, 80) . (strlen($materi->deskripsi) > 80 ? '...' : ''); ?></p>
                                </div>
                            </div>
                            <button onclick="location.href='<?= site_url('student_mobile/materi_detail/'.$materi->id) ?>'" class="mobile-btn w-full mt-3 bg-gray-100 text-gray-700 text-sm">
                                <i data-feather="eye" class="w-4 h-4 inline mr-1"></i>
                                Lihat Detail
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Available Classes -->
        <div class="mobile-card">
            <h3 class="text-lg font-bold text-gray-900 mb-3">Kelas Tersedia</h3>
            <?php if (empty($available_classes)): ?>
                <div class="text-center py-8">
                    <i data-feather="graduation-cap" class="w-12 h-12 text-gray-300 mx-auto mb-2"></i>
                    <p class="text-sm text-gray-500">Belum ada kelas</p>
                </div>
            <?php else: ?>
                <div class="space-y-3">
                    <?php foreach(array_slice($available_classes, 0, 3) as $kelas): ?>
                        <div class="border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between mb-2">
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                    <?php echo $kelas->bahasa_program; ?>
                                </span>
                                <span class="px-2 py-1 text-xs font-medium rounded-full <?php echo ($kelas->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; ?>">
                                    <?php echo $kelas->status; ?>
                                </span>
                            </div>
                            <h4 class="text-sm font-bold text-gray-900 mb-1"><?php echo $kelas->nama_kelas; ?></h4>
                            <p class="text-xs text-gray-600 mb-3 line-clamp-2"><?php echo substr($kelas->deskripsi, 0, 100) . (strlen($kelas->deskripsi) > 100 ? '...' : ''); ?></p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3 text-xs text-gray-500">
                                    <span><i data-feather="trending-up" class="w-3 h-3 mr-1"></i><?php echo $kelas->level; ?></span>
                                    <span><i data-feather="clock" class="w-3 h-3 mr-1"></i><?php echo $kelas->durasi; ?> Jam</span>
                                </div>
                                <span class="text-sm font-bold text-gray-900">Rp <?php echo number_format($kelas->harga, 0, ',', '.'); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (count($available_classes) > 3): ?>
                        <button class="mobile-btn w-full mt-3 border border-blue-600 text-blue-600">
                            Lihat <?php echo count($available_classes) - 3; ?> kelas lainnya
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Premium Class Content -->
    <div id="premiumClassContent" class="hidden">
        <?php if (!empty($paid_classes) || !empty($available_paid_classes)): ?>
            <!-- Paid Classes Section -->
            <?php if (!empty($paid_classes)): ?>
            <div class="mobile-card">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Kelas yang Telah Dibeli</h3>
                <div class="space-y-3">
                    <?php foreach($paid_classes as $class): ?>
                        <div class="border border-green-200 rounded-lg p-3 bg-green-50">
                            <div class="flex items-start justify-between mb-2">
                                <h4 class="text-sm font-bold text-gray-900"><?php echo $class->nama_kelas; ?></h4>
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                    Sudah Dibeli
                                </span>
                            </div>
                            <p class="text-xs text-gray-600 mb-3"><?php echo $class->deskripsi; ?></p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500">Harga: Rp <?php echo number_format($class->harga, 0, ',', '.'); ?></span>
                                <button onclick="location.href='<?= site_url('kelas/detail/'.$class->class_id) ?>'" class="mobile-btn bg-blue-600 text-white text-xs">
                                    Akses Kelas
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Available Paid Classes Section -->
            <?php if (!empty($available_paid_classes)): ?>
            <div class="mobile-card">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Kelas Premium Tersedia</h3>
                <div class="space-y-3">
                    <?php foreach($available_paid_classes as $class): ?>
                        <div class="border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between mb-2">
                                <h4 class="text-sm font-bold text-gray-900"><?php echo $class->nama_kelas; ?></h4>
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                    Premium
                                </span>
                            </div>
                            <p class="text-xs text-gray-600 mb-3 line-clamp-2"><?php echo substr($class->deskripsi, 0, 100) . (strlen($class->deskripsi) > 100 ? '...' : ''); ?></p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-bold text-gray-900">Rp <?php echo number_format($class->harga, 0, ',', '.'); ?></span>
                                <button onclick="location.href='<?= site_url('payment/initiate/'.$class->id) ?>'" class="mobile-btn bg-blue-600 text-white text-xs">
                                    <i data-feather="shopping-cart" class="w-3 h-3 inline mr-1"></i>
                                    Beli Sekarang
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="mobile-card">
                <div class="text-center py-12">
                    <i data-feather="graduation-cap" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada kelas premium</h3>
                    <p class="text-sm text-gray-500">Silakan cek kembali nanti untuk kelas premium terbaru</p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Class Materials Summary -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Materi Pembelajaran</h3>
        <?php if (empty($class_materials)): ?>
            <div class="text-center py-8">
                <i data-feather="book-open" class="w-12 h-12 text-gray-300 mx-auto mb-2"></i>
                <p class="text-sm text-gray-500">Belum ada materi tersedia</p>
            </div>
        <?php else: ?>
            <div class="flex items-center justify-center mb-4">
                <div class="relative">
                    <div class="w-20 h-20 rounded-full bg-blue-100 flex flex-col items-center justify-center">
                        <span class="text-xl font-bold text-blue-600"><?php echo count($class_materials); ?></span>
                        <span class="text-xs text-gray-500">Materi</span>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <?php foreach(array_slice($class_materials, 0, 3) as $materi): ?>
                    <a href="<?= site_url('student_mobile/materi_detail/'.$materi->id) ?>" class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-blue-50 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i data-feather="file-text" class="w-4 h-4 text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-900"><?php echo $materi->judul; ?></h4>
                                <p class="text-xs text-gray-500"><?php echo date('d M Y', strtotime($materi->created_at)); ?></p>
                            </div>
                        </div>
                        <i data-feather="chevron-right" class="w-4 h-4 text-gray-400"></i>
                    </a>
                <?php endforeach; ?>
                <?php if (count($class_materials) > 3): ?>
                    <button onclick="location.href='<?= site_url('student_mobile/materi') ?>'" class="mobile-btn w-full mt-2 border border-blue-600 text-blue-600">
                        Lihat <?php echo count($class_materials) - 3; ?> materi lainnya
                    </button>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Classmates -->
    <?php if (!empty($classmates)): ?>
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Teman Sekelas</h3>
        <div class="space-y-3">
            <?php foreach($classmates as $classmate): ?>
                <div class="flex items-center space-x-3 p-2 border border-gray-100 rounded-lg">
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold text-sm">
                        <?php echo strtoupper(substr($classmate->nama_lengkap, 0, 1)); ?>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-gray-900"><?php echo $classmate->nama_lengkap; ?></h4>
                        <p class="text-xs text-gray-500"><?php echo $classmate->jurusan; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if ($total_classmates > 5): ?>
                <div class="text-center pt-2">
                    <span class="text-sm text-gray-500">+ <?php echo $total_classmates - 5; ?> teman lainnya</span>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Jadwal Section -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Jadwal Kelas</h3>
        <?php if (!empty($jadwal)):
            foreach ($jadwal as $j):
        ?>
            <div class="p-3 mb-3 bg-gray-50 rounded-lg border border-gray-200">
                <h4 class="font-semibold text-gray-900 text-sm">Pertemuan <?php echo $j['pertemuan_ke']; ?>: <?php echo $j['judul_pertemuan']; ?></h4>
                <p class="text-xs text-gray-600 mt-1"><?php echo date('d M Y', strtotime($j['tanggal_pertemuan'])); ?> | <?php echo date('H:i', strtotime($j['waktu_mulai'])); ?> - <?php echo date('H:i', strtotime($j['waktu_selesai'])); ?></p>
            </div>
        <?php 
            endforeach;
        else:
        ?>
            <p class="text-center text-gray-500 py-4 text-sm">Belum ada jadwal untuk kelas ini.</p>
        <?php endif; ?>
    </div>

    <!-- Quick Actions -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Aksi Cepat</h3>
        <div class="grid grid-cols-2 gap-3">
            <button onclick="location.href='<?= site_url('student_mobile/profile') ?>'" class="mobile-btn bg-blue-50 text-blue-600">
                <i data-feather="user" class="w-5 h-5 mx-auto mb-2"></i>
                <span class="text-xs">Profil Saya</span>
            </button>
            <button onclick="location.href='<?= site_url('student_mobile/materi') ?>'" class="mobile-btn bg-indigo-50 text-indigo-600">
                <i data-feather="book" class="w-5 h-5 mx-auto mb-2"></i>
                <span class="text-xs">Materi</span>
            </button>
            <button class="mobile-btn bg-green-50 text-green-600">
                <i data-feather="graduation-cap" class="w-5 h-5 mx-auto mb-2"></i>
                <span class="text-xs">Kelas</span>
            </button>
            <button class="mobile-btn bg-purple-50 text-purple-600">
                <i data-feather="help-circle" class="w-5 h-5 mx-auto mb-2"></i>
                <span class="text-xs">Bantuan</span>
            </button>
        </div>
    </div>
</div>

<script>
    // Tab switching functionality
    function switchTab(tab) {
        const regularTab = document.querySelector('.mobile-tab:nth-child(1)');
        const premiumTab = document.querySelector('.mobile-tab:nth-child(2)');
        const regularContent = document.getElementById('regularClassContent');
        const premiumContent = document.getElementById('premiumClassContent');
        
        if (tab === 'regular') {
            regularTab.classList.add('active');
            premiumTab.classList.remove('active');
            regularContent.classList.remove('hidden');
            premiumContent.classList.add('hidden');
        } else {
            premiumTab.classList.add('active');
            regularTab.classList.remove('active');
            premiumContent.classList.remove('hidden');
            regularContent.classList.add('hidden');
        }
    }
    
    // Initialize Feather Icons after DOM content is loaded
    document.addEventListener('DOMContentLoaded', function() {
        feather.replace();
        
        // Add fade-in animation to cards
        const cards = document.querySelectorAll('.mobile-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>