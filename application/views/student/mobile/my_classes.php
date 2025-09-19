<div class="min-h-screen bg-gray-50 pb-20">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-4 py-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <button onclick="history.back()" class="mr-3 p-2 rounded-full bg-white/20 hover:bg-white/30 transition-colors">
                    <i data-feather="arrow-left" class="w-5 h-5"></i>
                </button>
                <div>
                    <h1 class="text-xl font-bold">Kelas Saya</h1>
                    <p class="text-blue-100 text-sm">Daftar kelas yang Anda ikuti</p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 -mt-4">
        <!-- Progress Stats -->
        <?php if (isset($progress_stats) && !empty($progress_stats)): ?>
        <div class="bg-white rounded-2xl shadow-lg p-4 mb-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Progress Belajar Anda</h2>
            <div class="grid grid-cols-3 gap-4">
                <div class="text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i data-feather="book" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo $progress_stats['total_enrollments']; ?></p>
                    <p class="text-xs text-gray-500">Total Kelas</p>
                </div>

                <div class="text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i data-feather="check-circle" class="w-6 h-6 text-green-600"></i>
                    </div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo $progress_stats['completed_enrollments']; ?></p>
                    <p class="text-xs text-gray-500">Selesai</p>
                </div>

                <div class="text-center">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i data-feather="trending-up" class="w-6 h-6 text-indigo-600"></i>
                    </div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo $progress_stats['avg_progress']; ?>%</p>
                    <p class="text-xs text-gray-500">Rata-rata</p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Class Tabs -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6" x-data="{ tab: 'all' }">
            <div class="border-b border-gray-200">
                <nav class="flex">
                    <button @click="tab = 'all'" :class="{ 'border-blue-500 text-blue-600': tab === 'all', 'border-transparent text-gray-500': tab !== 'all' }"
                            class="w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm transition-colors">
                        Semua Kelas
                    </button>
                    <button @click="tab = 'active'" :class="{ 'border-blue-500 text-blue-600': tab === 'active', 'border-transparent text-gray-500': tab !== 'active' }"
                            class="w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm transition-colors">
                        Aktif
                    </button>
                    <button @click="tab = 'completed'" :class="{ 'border-blue-500 text-blue-600': tab === 'completed', 'border-transparent text-gray-500': tab !== 'completed' }"
                            class="w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm transition-colors">
                        Selesai
                    </button>
                </nav>
            </div>

            <div class="p-4">
                <!-- All Classes Tab -->
                <div x-show="tab === 'all'" x-transition>
                    <?php if (empty($enrollments)): ?>
                        <div class="text-center py-8">
                            <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                                <i data-feather="book" class="w-8 h-8 text-blue-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Kelas</h3>
                            <p class="text-gray-500 text-sm mb-4">Anda belum terdaftar di kelas gratis manapun.</p>
                            <a href="<?php echo site_url('student_mobile/browse_classes'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                                <i class="fas fa-search mr-2"></i>
                                Jelajahi Kelas
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php foreach($enrollments as $enrollment): ?>
                                <div class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200">
                                    <div class="h-32 bg-gray-200 relative">
                                        <?php if (!empty($enrollment->thumbnail)): ?>
                                            <img src="<?php echo base_url($enrollment->thumbnail); ?>" alt="<?php echo $enrollment->title; ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                                <i data-feather="graduation-cap" class="w-12 h-12 text-white"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="absolute top-2 right-2">
                                            <span class="px-2 py-1 text-xs rounded-full
                                                <?php
                                                if ($enrollment->status == 'Completed') echo 'bg-green-600 text-white';
                                                elseif ($enrollment->status == 'Enrolled') echo 'bg-blue-600 text-white';
                                                else echo 'bg-red-600 text-white';
                                                ?>">
                                                <?php
                                                if ($enrollment->status == 'Completed') echo 'Selesai';
                                                elseif ($enrollment->status == 'Enrolled') echo 'Aktif';
                                                else echo 'Keluar';
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-bold text-gray-800 mb-2 text-sm line-clamp-2"><?php echo $enrollment->title; ?></h3>
                                        <div class="flex items-center text-xs text-gray-600 mb-3">
                                            <i data-feather="user" class="w-3 h-3 mr-1"></i>
                                            <span><?php echo $enrollment->mentor_name; ?></span>
                                        </div>
                                        <div class="mb-3">
                                            <div class="w-full bg-gray-200 rounded-full h-2 mb-1">
                                                <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: <?php echo $enrollment->progress; ?>%"></div>
                                            </div>
                                            <div class="flex justify-between text-xs text-gray-500">
                                                <span>Progress</span>
                                                <span><?php echo $enrollment->progress; ?>%</span>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center text-xs text-gray-500 mb-4">
                                            <span>
                                                <i data-feather="calendar" class="w-3 h-3 inline mr-1"></i>
                                                Terdaftar: <?php echo date('d/m/Y', strtotime($enrollment->enrollment_date)); ?>
                                            </span>
                                            <?php if ($enrollment->status == 'Completed' && $enrollment->completion_date): ?>
                                                <span>
                                                    <i data-feather="check-circle" class="w-3 h-3 inline mr-1 text-green-600"></i>
                                                    <?php echo date('d/m/Y', strtotime($enrollment->completion_date)); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="flex space-x-2 mb-3">
                                            <a href="<?php echo site_url('student/free_classes/view/' . $enrollment->id); ?>" class="flex-1 text-center px-3 py-2 border border-transparent rounded-lg shadow-sm text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                                                <?php echo ($enrollment->status == 'Completed') ? 'Lihat Kembali' : 'Lanjutkan'; ?>
                                            </a>
                                        </div>

                                        <!-- Expandable Details -->
                                        <div x-data="{ open: false }">
                                            <button @click="open = !open" class="w-full text-center text-xs text-gray-600 hover:text-gray-900 py-2 border-t border-gray-200">
                                                <span x-text="open ? 'Sembunyikan Detail' : 'Lihat Detail'"></span>
                                                <i data-feather="chevron-down" class="w-3 h-3 inline ml-1 transition-transform" :class="{ 'rotate-180': open }"></i>
                                            </button>
                                            <div x-show="open" x-transition class="mt-4 space-y-4">
                                                <!-- Attendance -->
                                                <div>
                                                    <h4 class="font-bold mb-2 text-sm">Absensi Saya</h4>
                                                    <div class="space-y-2">
                                                        <?php if (!empty($enrollment->attendance)): ?>
                                                            <?php foreach($enrollment->attendance as $att): ?>
                                                                <div class="flex justify-between items-center text-xs">
                                                                    <span>Pertemuan <?php echo $att->pertemuan_ke; ?>: <?php echo $att->judul_pertemuan; ?></span>
                                                                    <span class="px-2 py-1 text-xs rounded-full <?php echo ($att->status == 'Hadir') ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800'; ?>">
                                                                        <?php echo $att->status ?? 'Belum ada'; ?>
                                                                    </span>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <p class="text-xs text-gray-500">Tidak ada data absensi.</p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <!-- Classmates -->
                                                <div>
                                                    <h4 class="font-bold mb-2 text-sm">Teman Sekelas</h4>
                                                    <div class="space-y-1">
                                                        <?php if (isset($enrollment->classmates) && is_array($enrollment->classmates) && !empty($enrollment->classmates)): ?>
                                                            <?php foreach(array_slice($enrollment->classmates, 0, 5) as $classmate): ?>
                                                                <div class="flex items-center text-xs">
                                                                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                                                        <i data-feather="user" class="w-3 h-3 text-blue-600"></i>
                                                                    </div>
                                                                    <span><?php echo $classmate->nama_lengkap; ?></span>
                                                                </div>
                                                            <?php endforeach; ?>
                                                            <?php if (count($enrollment->classmates) > 5): ?>
                                                                <p class="text-xs text-gray-500">+<?php echo count($enrollment->classmates) - 5; ?> lainnya</p>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <p class="text-xs text-gray-500">Belum ada teman sekelas lain</p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Active Classes Tab -->
                <div x-show="tab === 'active'" x-transition x-cloak>
                    <?php
                    $active_enrollments = array_filter($enrollments, function($enrollment) {
                        return $enrollment->status == 'Enrolled';
                    });
                    ?>

                    <?php if (empty($active_enrollments)): ?>
                        <div class="text-center py-8">
                            <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                                <i data-feather="book" class="w-8 h-8 text-blue-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Kelas Aktif</h3>
                            <p class="text-gray-500 text-sm mb-4">Anda tidak memiliki kelas yang sedang berjalan.</p>
                            <a href="<?php echo site_url('student_mobile/browse_classes'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                                <i data-feather="search" class="w-4 h-4 mr-2"></i>
                                Jelajahi Kelas
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php foreach($active_enrollments as $enrollment): ?>
                                <div class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200">
                                    <div class="h-32 bg-gray-200 relative">
                                        <?php if (!empty($enrollment->thumbnail)): ?>
                                            <img src="<?php echo base_url($enrollment->thumbnail); ?>" alt="<?php echo $enrollment->title; ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                                <i data-feather="graduation-cap" class="w-12 h-12 text-white"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="absolute top-2 right-2">
                                            <span class="px-2 py-1 text-xs rounded-full bg-blue-600 text-white">Aktif</span>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-bold text-gray-800 mb-2 text-sm line-clamp-2"><?php echo $enrollment->title; ?></h3>
                                        <div class="flex items-center text-xs text-gray-600 mb-3">
                                            <i data-feather="user" class="w-3 h-3 mr-1"></i>
                                            <span><?php echo $enrollment->mentor_name; ?></span>
                                        </div>
                                        <div class="mb-3">
                                            <div class="w-full bg-gray-200 rounded-full h-2 mb-1">
                                                <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: <?php echo $enrollment->progress; ?>%"></div>
                                            </div>
                                            <div class="flex justify-between text-xs text-gray-500">
                                                <span>Progress</span>
                                                <span><?php echo $enrollment->progress; ?>%</span>
                                            </div>
                                        </div>
                                        <a href="<?php echo site_url('student/free_classes/view/' . $enrollment->id); ?>" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                                            Lanjutkan Belajar
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Completed Classes Tab -->
                <div x-show="tab === 'completed'" x-transition x-cloak>
                    <?php
                    $completed_enrollments = array_filter($enrollments, function($enrollment) {
                        return $enrollment->status == 'Completed';
                    });
                    ?>

                    <?php if (empty($completed_enrollments)): ?>
                        <div class="text-center py-8">
                            <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                                <i data-feather="check-circle" class="w-8 h-8 text-blue-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Kelas Selesai</h3>
                            <p class="text-gray-500 text-sm">Anda belum menyelesaikan kelas apapun.</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php foreach($completed_enrollments as $enrollment): ?>
                                <div class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200">
                                    <div class="h-32 bg-gray-200 relative">
                                        <?php if (!empty($enrollment->thumbnail)): ?>
                                            <img src="<?php echo base_url($enrollment->thumbnail); ?>" alt="<?php echo $enrollment->title; ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                                <i data-feather="graduation-cap" class="w-12 h-12 text-white"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="absolute top-2 right-2">
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-600 text-white">Selesai</span>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-bold text-gray-800 mb-2 text-sm line-clamp-2"><?php echo $enrollment->title; ?></h3>
                                        <div class="flex items-center text-xs text-gray-600 mb-3">
                                            <i data-feather="user" class="w-3 h-3 mr-1"></i>
                                            <span><?php echo $enrollment->mentor_name; ?></span>
                                        </div>
                                        <div class="mb-3">
                                            <div class="w-full bg-gray-200 rounded-full h-2 mb-1">
                                                <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                                            </div>
                                            <div class="flex justify-between text-xs text-gray-500">
                                                <span>Progress</span>
                                                <span>100%</span>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center text-xs text-gray-500 mb-4">
                                            <span>
                                                <i data-feather="calendar" class="w-3 h-3 inline mr-1"></i>
                                                Terdaftar: <?php echo date('d/m/Y', strtotime($enrollment->enrollment_date)); ?>
                                            </span>
                                            <span>
                                                <i data-feather="check-circle" class="w-3 h-3 inline mr-1 text-green-600"></i>
                                                <?php echo date('d/m/Y', strtotime($enrollment->completion_date)); ?>
                                            </span>
                                        </div>
                                        <a href="<?php echo site_url('student/free_classes/view/' . $enrollment->id); ?>" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 transition-colors">
                                            Lihat Kembali
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize Feather Icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
</script>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    [x-cloak] {
        display: none !important;
    }
</style>
