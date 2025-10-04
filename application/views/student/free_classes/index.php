<div class="p-4 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Header with gradient background -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl text-white">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold">Kelas Gratis</h1>
            <p class="text-blue-100 mt-2">Jelajahi dan ikuti kelas gratis untuk meningkatkan kemampuan Anda</p>
        </div>
        <div class="flex space-x-3">
            <a href="<?php echo site_url('student/free_classes/my_classes'); ?>" class="inline-flex items-center px-4 py-2 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-105">
                <i class="fas fa-book-open mr-2"></i>
                Kelas Saya
            </a>
            <a href="<?php echo site_url('student/free_classes/browse'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 transition-all duration-300 hover:scale-105">
                <i class="fas fa-search mr-2"></i>
                Jelajahi Kelas
            </a>
        </div>
    </div>

    <!-- Progress Stats -->
    <?php if (isset($progress_stats) && $progress_stats['total_enrollments'] > 0): ?>
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

    <!-- Enrolled Classes -->
    <?php if (!empty($enrolled_classes)): ?>
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
        <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Kelas yang Sedang Diikuti</h2>
                <a href="<?php echo site_url('student/free_classes/my_classes'); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach($enrolled_classes as $class): ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="h-40 bg-gray-200 relative">
                        <?php if (!empty($class->thumbnail)): ?>
                            <img src="<?php echo $class->thumbnail; ?>" alt="<?php echo $class->title; ?>" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center" style="display: none;">
                                <i class="fas fa-graduation-cap text-white text-4xl"></i>
                            </div>
                        <?php else: ?>
                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-white text-4xl"></i>
                            </div>
                        <?php endif; ?>
                        <div class="absolute top-2 right-2">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-600 text-white">
                                <?php echo $class->level; ?>
                            </span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 mb-2 line-clamp-2"><?php echo $class->title; ?></h3>
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <i class="fas fa-user-tie mr-1"></i>
                            <span><?php echo $class->mentor_name; ?></span>
                        </div>
                        <div class="mb-3">
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-1">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?php echo $class->progress; ?>%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>Progress</span>
                                <span><?php echo $class->progress; ?>%</span>
                            </div>
                        </div>
                        <a href="<?php echo site_url('student/free_classes/learn/' . $class->id); ?>" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                            Lanjutkan Belajar
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Popular Classes -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
        <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Kelas Populer</h2>
                <a href="<?php echo site_url('student/free_classes/browse'); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Jelajahi Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        <div class="p-6">
            <?php if (empty($popular_classes)): ?>
                <div class="text-center py-8">
                    <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                        <i class="fas fa-book text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum Ada Kelas</h3>
                    <p class="text-gray-500 max-w-md mx-auto">Kelas gratis akan segera tersedia. Silakan periksa kembali nanti.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach($popular_classes as $class): ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <div class="h-40 bg-gray-200 relative">
                            <?php if (!empty($class->thumbnail)): ?>
                                <img src="<?php echo $class->thumbnail; ?>" alt="<?php echo $class->title; ?>" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center" style="display: none;">
                                    <i class="fas fa-graduation-cap text-white text-4xl"></i>
                                </div>
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                    <i class="fas fa-graduation-cap text-white text-4xl"></i>
                                </div>
                            <?php endif; ?>
                            <div class="absolute top-2 right-2">
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-600 text-white">
                                    <?php echo $class->level; ?>
                                </span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 mb-2 line-clamp-2"><?php echo $class->title; ?></h3>
                            <div class="flex items-center text-sm text-gray-600 mb-3">
                                <i class="fas fa-user-tie mr-1"></i>
                                <span><?php echo $class->mentor_name; ?></span>
                            </div>
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">
                                    <?php echo $class->category; ?>
                                </span>
                                <span class="text-xs text-gray-500">
                                    <i class="fas fa-users mr-1"></i>
                                    <?php echo isset($class->enrollment_count) ? $class->enrollment_count : '0'; ?> siswa
                                </span>
                            </div>
                            <a href="<?php echo site_url('student/free_classes/view/' . $class->id); ?>" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                Lihat Kelas
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Classes -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
        <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
            <h2 class="text-xl font-bold text-gray-800">Kelas Terbaru</h2>
        </div>
        <div class="p-6">
            <?php if (empty($recent_classes)): ?>
                <div class="text-center py-8">
                    <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                        <i class="fas fa-book text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum Ada Kelas</h3>
                    <p class="text-gray-500 max-w-md mx-auto">Kelas gratis akan segera tersedia. Silakan periksa kembali nanti.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach($recent_classes as $class): ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <div class="h-40 bg-gray-200 relative">
                            <?php if (!empty($class->thumbnail)): ?>
                                <img src="<?php echo $class->thumbnail; ?>" alt="<?php echo $class->title; ?>" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center" style="display: none;">
                                    <i class="fas fa-graduation-cap text-white text-4xl"></i>
                                </div>
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                    <i class="fas fa-graduation-cap text-white text-4xl"></i>
                                </div>
                            <?php endif; ?>
                            <div class="absolute top-2 right-2">
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-600 text-white">
                                    <?php echo $class->level; ?>
                                </span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 mb-2 line-clamp-2"><?php echo $class->title; ?></h3>
                            <div class="flex items-center text-sm text-gray-600 mb-3">
                                <i class="fas fa-user-tie mr-1"></i>
                                <span><?php echo $class->mentor_name; ?></span>
                            </div>
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">
                                    <?php echo $class->category; ?>
                                </span>
                                <span class="text-xs text-gray-500">
                                    <i class="fas fa-clock mr-1"></i>
                                    <?php echo $class->duration; ?> jam
                                </span>
                            </div>
                            <a href="<?php echo site_url('student/free_classes/view/' . $class->id); ?>" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                Lihat Kelas
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

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
</style>
