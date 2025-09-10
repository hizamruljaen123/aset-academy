<div class="p-4 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Header with gradient background -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl text-white">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold">Kelas Saya</h1>
            <p class="text-blue-100 mt-2">Daftar kelas gratis yang Anda ikuti</p>
        </div>
        <div class="flex space-x-3">
            <a href="<?php echo site_url('student/free_classes'); ?>" class="inline-flex items-center px-4 py-2 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
            <a href="<?php echo site_url('student/free_classes/browse'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 transition-all duration-300 hover:scale-105">
                <i class="fas fa-search mr-2"></i>
                Jelajahi Kelas
            </a>
        </div>
    </div>

    <!-- Progress Stats -->
    <?php if (isset($progress_stats)): ?>
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
        <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
            <h2 class="text-xl font-bold text-gray-800">Progress Belajar Anda</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-blue-50 rounded-xl p-4 flex items-center">
                    <div class="rounded-full bg-blue-100 p-3 mr-4">
                        <i class="fas fa-book text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Kelas</p>
                        <p class="text-2xl font-bold text-gray-800"><?php echo $progress_stats['total_enrollments']; ?></p>
                    </div>
                </div>
                
                <div class="bg-green-50 rounded-xl p-4 flex items-center">
                    <div class="rounded-full bg-green-100 p-3 mr-4">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Kelas Selesai</p>
                        <p class="text-2xl font-bold text-gray-800"><?php echo $progress_stats['completed_enrollments']; ?></p>
                    </div>
                </div>
                
                <div class="bg-indigo-50 rounded-xl p-4 flex items-center">
                    <div class="rounded-full bg-indigo-100 p-3 mr-4">
                        <i class="fas fa-chart-line text-indigo-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Rata-rata Progress</p>
                        <div class="flex items-center">
                            <p class="text-2xl font-bold text-gray-800 mr-2"><?php echo $progress_stats['avg_progress']; ?>%</p>
                            <div class="w-24 bg-gray-200 rounded-full h-2.5">
                                <div class="bg-indigo-600 h-2.5 rounded-full" style="width: <?php echo $progress_stats['avg_progress']; ?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Class Tabs -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in" x-data="{ tab: 'all' }">
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px">
                <button @click="tab = 'all'" :class="{ 'border-blue-500 text-blue-600': tab === 'all', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'all' }" class="w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm">
                    Semua Kelas
                </button>
                <button @click="tab = 'active'" :class="{ 'border-blue-500 text-blue-600': tab === 'active', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'active' }" class="w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm">
                    Sedang Berjalan
                </button>
                <button @click="tab = 'completed'" :class="{ 'border-blue-500 text-blue-600': tab === 'completed', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'completed' }" class="w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm">
                    Selesai
                </button>
            </nav>
        </div>
        
        <div class="p-6">
            <!-- All Classes Tab -->
            <div x-show="tab === 'all'">
                <?php if (empty($enrollments)): ?>
                    <div class="text-center py-8">
                        <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                            <i class="fas fa-book text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">Belum Ada Kelas</h3>
                        <p class="text-gray-500 max-w-md mx-auto">Anda belum terdaftar di kelas gratis manapun.</p>
                        <a href="<?php echo site_url('student/free_classes/browse'); ?>" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                            <i class="fas fa-search mr-2"></i>
                            Jelajahi Kelas
                        </a>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach($enrollments as $enrollment): ?>
                            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                <div class="h-40 bg-gray-200 relative">
                                    <?php if (!empty($enrollment->thumbnail)): ?>
                                        <img src="<?php echo base_url($enrollment->thumbnail); ?>" alt="<?php echo $enrollment->title; ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                            <i class="fas fa-graduation-cap text-white text-4xl"></i>
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
                                            elseif ($enrollment->status == 'Enrolled') echo 'Sedang Berjalan';
                                            else echo 'Keluar';
                                            ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-800 mb-2 line-clamp-2"><?php echo $enrollment->title; ?></h3>
                                    <div class="flex items-center text-sm text-gray-600 mb-3">
                                        <i class="fas fa-user-tie mr-1"></i>
                                        <span><?php echo $enrollment->mentor_name; ?></span>
                                    </div>
                                    <div class="mb-3">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-1">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?php echo $enrollment->progress; ?>%"></div>
                                        </div>
                                        <div class="flex justify-between text-xs text-gray-500">
                                            <span>Progress</span>
                                            <span><?php echo $enrollment->progress; ?>%</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center text-xs text-gray-500 mb-4">
                                        <span>
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            Terdaftar: <?php echo date('d M Y', strtotime($enrollment->enrollment_date)); ?>
                                        </span>
                                        <?php if ($enrollment->status == 'Completed' && $enrollment->completion_date): ?>
                                            <span>
                                                <i class="fas fa-check-circle mr-1 text-green-600"></i>
                                                <?php echo date('d M Y', strtotime($enrollment->completion_date)); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($enrollment->online_meet_link) && $enrollment->status != 'Completed'): ?>
                                    <a href="<?php echo $enrollment->online_meet_link; ?>" target="_blank" class="mb-2 w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300">
                                        <i class="fas fa-video mr-2"></i>
                                        Join Meeting
                                    </a>
                                    <?php endif; ?>
                                    <a href="<?php echo site_url('student/free_classes/view/' . $enrollment->id); ?>" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                        <?php echo ($enrollment->status == 'Completed') ? 'Lihat Kembali' : 'Lanjutkan Belajar'; ?>
                                    </a>
                                    <div x-data="{ open: false }">
                                        <button @click="open = !open" class="w-full mt-2 text-sm text-gray-600 hover:text-gray-900">Lihat Detail</button>
                                        <div x-show="open" class="mt-4 p-4 bg-gray-50 rounded-lg">
                                            <h4 class="font-bold mb-2">Absensi Saya</h4>
                                            <ul class="space-y-2">
                                                <?php if (!empty($enrollment->attendance)): ?>
                                                    <?php foreach($enrollment->attendance as $att): ?>
                                                        <li class="flex justify-between items-center text-sm">
                                                            <span>Pertemuan <?php echo $att->pertemuan_ke; ?>: <?php echo $att->judul_pertemuan; ?></span>
                                                            <span class="px-2 py-1 text-xs rounded-full <?php echo ($att->status == 'Hadir') ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800'; ?>"><?php echo $att->status ?? 'Belum ada'; ?></span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <li class="text-sm text-gray-500">Tidak ada data absensi.</li>
                                                <?php endif; ?>
                                            </ul>
                                            <h4 class="font-bold mt-4 mb-2">Teman Sekelas</h4>
                                            <ul class="space-y-2">
                                                <?php if (isset($enrollment->classmates) && is_array($enrollment->classmates)): ?>
                                                    <?php foreach($enrollment->classmates as $classmate): ?>
                                                        <li class="text-sm"><?php echo $classmate->nama_lengkap; ?></li>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <li class="text-sm text-gray-500">Belum ada teman sekelas lain</li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Active Classes Tab -->
            <div x-show="tab === 'active'" x-cloak>
                <?php 
                $active_enrollments = array_filter($enrollments, function($enrollment) {
                    return $enrollment->status == 'Enrolled';
                });
                ?>
                
                <?php if (empty($active_enrollments)): ?>
                    <div class="text-center py-8">
                        <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                            <i class="fas fa-book text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak Ada Kelas Aktif</h3>
                        <p class="text-gray-500 max-w-md mx-auto">Anda tidak memiliki kelas yang sedang berjalan.</p>
                        <a href="<?php echo site_url('student/free_classes/browse'); ?>" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                            <i class="fas fa-search mr-2"></i>
                            Jelajahi Kelas
                        </a>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach($active_enrollments as $enrollment): ?>
                            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                <div class="h-40 bg-gray-200 relative">
                                    <?php if (!empty($enrollment->thumbnail)): ?>
                                        <img src="<?php echo base_url($enrollment->thumbnail); ?>" alt="<?php echo $enrollment->title; ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                            <i class="fas fa-graduation-cap text-white text-4xl"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="absolute top-2 right-2">
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-600 text-white">
                                            Sedang Berjalan
                                        </span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-800 mb-2 line-clamp-2"><?php echo $enrollment->title; ?></h3>
                                    <div class="flex items-center text-sm text-gray-600 mb-3">
                                        <i class="fas fa-user-tie mr-1"></i>
                                        <span><?php echo $enrollment->mentor_name; ?></span>
                                    </div>
                                    <div class="mb-3">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-1">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?php echo $enrollment->progress; ?>%"></div>
                                        </div>
                                        <div class="flex justify-between text-xs text-gray-500">
                                            <span>Progress</span>
                                            <span><?php echo $enrollment->progress; ?>%</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center text-xs text-gray-500 mb-4">
                                        <span>
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            Terdaftar: <?php echo date('d M Y', strtotime($enrollment->enrollment_date)); ?>
                                        </span>
                                    </div>
                                    <a href="<?php echo site_url('student/free_classes/view/' . $enrollment->id); ?>" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                        Lanjutkan Belajar
                                    </a>
                                    <div x-data="{ open: false }">
                                        <button @click="open = !open" class="w-full mt-2 text-sm text-gray-600 hover:text-gray-900">Lihat Detail</button>
                                        <div x-show="open" class="mt-4 p-4 bg-gray-50 rounded-lg">
                                            <h4 class="font-bold mb-2">Absensi Saya</h4>
                                            <ul class="space-y-2">
                                                <?php if (!empty($enrollment->attendance)): ?>
                                                    <?php foreach($enrollment->attendance as $att): ?>
                                                        <li class="flex justify-between items-center text-sm">
                                                            <span>Pertemuan <?php echo $att->pertemuan_ke; ?>: <?php echo $att->judul_pertemuan; ?></span>
                                                            <span class="px-2 py-1 text-xs rounded-full <?php echo ($att->status == 'Hadir') ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800'; ?>"><?php echo $att->status ?? 'Belum ada'; ?></span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <li class="text-sm text-gray-500">Tidak ada data absensi.</li>
                                                <?php endif; ?>
                                            </ul>
                                            <h4 class="font-bold mt-4 mb-2">Teman Sekelas</h4>
                                            <ul class="space-y-2">
                                                <?php if (isset($enrollment->classmates) && is_array($enrollment->classmates)): ?>
                                                    <?php foreach($enrollment->classmates as $classmate): ?>
                                                        <li class="text-sm"><?php echo $classmate->nama_lengkap; ?></li>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <li class="text-sm text-gray-500">Belum ada teman sekelas lain</li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Completed Classes Tab -->
            <div x-show="tab === 'completed'" x-cloak>
                <?php 
                $completed_enrollments = array_filter($enrollments, function($enrollment) {
                    return $enrollment->status == 'Completed';
                });
                ?>
                
                <?php if (empty($completed_enrollments)): ?>
                    <div class="text-center py-8">
                        <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                            <i class="fas fa-book text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">Belum Ada Kelas Selesai</h3>
                        <p class="text-gray-500 max-w-md mx-auto">Anda belum menyelesaikan kelas apapun.</p>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach($completed_enrollments as $enrollment): ?>
                            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                <div class="h-40 bg-gray-200 relative">
                                    <?php if (!empty($enrollment->thumbnail)): ?>
                                        <img src="<?php echo base_url($enrollment->thumbnail); ?>" alt="<?php echo $enrollment->title; ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                            <i class="fas fa-graduation-cap text-white text-4xl"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="absolute top-2 right-2">
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-600 text-white">
                                            Selesai
                                        </span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-800 mb-2 line-clamp-2"><?php echo $enrollment->title; ?></h3>
                                    <div class="flex items-center text-sm text-gray-600 mb-3">
                                        <i class="fas fa-user-tie mr-1"></i>
                                        <span><?php echo $enrollment->mentor_name; ?></span>
                                    </div>
                                    <div class="mb-3">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-1">
                                            <div class="bg-green-600 h-2.5 rounded-full" style="width: 100%"></div>
                                        </div>
                                        <div class="flex justify-between text-xs text-gray-500">
                                            <span>Progress</span>
                                            <span>100%</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center text-xs text-gray-500 mb-4">
                                        <span>
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            Terdaftar: <?php echo date('d M Y', strtotime($enrollment->enrollment_date)); ?>
                                        </span>
                                        <span>
                                            <i class="fas fa-check-circle mr-1 text-green-600"></i>
                                            <?php echo date('d M Y', strtotime($enrollment->completion_date)); ?>
                                        </span>
                                    </div>
                                    <a href="<?php echo site_url('student/free_classes/view/' . $enrollment->id); ?>" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300">
                                        Lihat Kembali
                                    </a>
                                    <div x-data="{ open: false }">
                                        <button @click="open = !open" class="w-full mt-2 text-sm text-gray-600 hover:text-gray-900">Lihat Detail</button>
                                        <div x-show="open" class="mt-4 p-4 bg-gray-50 rounded-lg">
                                            <h4 class="font-bold mb-2">Absensi Saya</h4>
                                            <ul class="space-y-2">
                                                <?php if (!empty($enrollment->attendance)): ?>
                                                    <?php foreach($enrollment->attendance as $att): ?>
                                                        <li class="flex justify-between items-center text-sm">
                                                            <span>Pertemuan <?php echo $att->pertemuan_ke; ?>: <?php echo $att->judul_pertemuan; ?></span>
                                                            <span class="px-2 py-1 text-xs rounded-full <?php echo ($att->status == 'Hadir') ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800'; ?>"><?php echo $att->status ?? 'Belum ada'; ?></span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <li class="text-sm text-gray-500">Tidak ada data absensi.</li>
                                                <?php endif; ?>
                                            </ul>
                                            <h4 class="font-bold mt-4 mb-2">Teman Sekelas</h4>
                                            <ul class="space-y-2">
                                                <?php if (isset($enrollment->classmates) && is_array($enrollment->classmates)): ?>
                                                    <?php foreach($enrollment->classmates as $classmate): ?>
                                                        <li class="text-sm"><?php echo $classmate->nama_lengkap; ?></li>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <li class="text-sm text-gray-500">Belum ada teman sekelas lain</li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fade in main container
        const container = document.querySelector('.transition-opacity');
        if (container) {
            container.classList.add('opacity-100');
        }
        
        // Initialize intersection observer for fade-in elements
        const fadeElements = document.querySelectorAll('.fade-in');
        
        if (fadeElements.length > 0) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('visible');
                        }, 100);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            fadeElements.forEach((element, index) => {
                // Add staggered delay based on element index
                element.style.transitionDelay = `${index * 0.1}s`;
                observer.observe(element);
            });
        }
    });
</script>

<style>
    /* Animation styles */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Line clamp for text truncation */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Alpine.js cloak */
    [x-cloak] {
        display: none !important;
    }
</style>
