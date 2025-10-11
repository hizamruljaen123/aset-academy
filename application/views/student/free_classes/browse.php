<div class="p-4 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Header with gradient background -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl text-white">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold">Jelajahi Kelas Gratis</h1>
            <p class="text-blue-100 mt-2">Temukan kelas gratis yang sesuai dengan minat dan kebutuhan Anda</p>
        </div>
        <div class="flex space-x-3">
            <a href="<?php echo site_url('student/free_classes'); ?>" class="inline-flex items-center px-4 py-2 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
            <a href="<?php echo site_url('student/free_classes/my_classes'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 transition-all duration-300 hover:scale-105">
                <i class="fas fa-book-open mr-2"></i>
                Kelas Saya
            </a>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
        <div class="p-6">
            <form action="<?php echo site_url('student/free_classes/browse'); ?>" method="get" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search -->
                    <div class="col-span-1 md:col-span-3">
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" name="keyword" id="keyword" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-lg py-3" placeholder="Cari kelas..." value="<?php echo isset($search_params['keyword']) ? $search_params['keyword'] : ''; ?>">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="submit" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select id="category" name="category" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg">
                            <option value="">Semua Kategori</option>
                            <?php if (isset($categories) && !empty($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category; ?>" <?php echo (isset($search_params['category']) && $search_params['category'] == $category) ? 'selected' : ''; ?>><?php echo $category; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Level Filter -->
                    <div>
                        <label for="level" class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                        <select id="level" name="level" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg">
                            <option value="">Semua Level</option>
                            <option value="Dasar" <?php echo (isset($search_params['level']) && $search_params['level'] == 'Dasar') ? 'selected' : ''; ?>>Dasar</option>
                            <option value="Menengah" <?php echo (isset($search_params['level']) && $search_params['level'] == 'Menengah') ? 'selected' : ''; ?>>Menengah</option>
                            <option value="Lanjutan" <?php echo (isset($search_params['level']) && $search_params['level'] == 'Lanjutan') ? 'selected' : ''; ?>>Lanjutan</option>
                        </select>
                    </div>

                    <!-- Filter Button -->
                    <div class="flex items-end">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                            <i class="fas fa-filter mr-2"></i>
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Classes Grid -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
        <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">
                    <?php 
                    if (isset($search_params['keyword']) && !empty($search_params['keyword'])) {
                        echo 'Hasil Pencarian: "' . $search_params['keyword'] . '"';
                    } else {
                        echo 'Semua Kelas';
                    }
                    ?>
                </h2>
                <span class="text-sm text-gray-500">
                    <?php echo count($free_classes); ?> kelas ditemukan
                </span>
            </div>
        </div>
        <div class="p-6">
            <?php if (empty($free_classes)): ?>
                <div class="text-center py-8">
                    <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                        <i class="fas fa-search text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak Ada Kelas Ditemukan</h3>
                    <p class="text-gray-500 max-w-md mx-auto">Coba ubah filter atau kata kunci pencarian Anda.</p>
                    <a href="<?php echo site_url('student/free_classes/browse'); ?>" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                        <i class="fas fa-redo mr-2"></i>
                        Reset Filter
                    </a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach($free_classes as $class): ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <div class="h-40 bg-gray-200 relative">
                            <?php if (!empty($class->thumbnail)): ?>
                                <img src="<?php echo base_url($class->thumbnail); ?>" alt="<?php echo $class->title; ?>" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center" style="display: none;">
                                    <i class="fas fa-graduation-cap text-white text-4xl"></i>
                                </div>
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                    <i class="fas fa-graduation-cap text-white text-4xl"></i>
                                </div>
                            <?php endif; ?>
                            <div class="absolute top-2 right-2">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    <?php 
                                    if ($class->level == 'Dasar') echo 'bg-green-600 text-white';
                                    elseif ($class->level == 'Menengah') echo 'bg-yellow-600 text-white';
                                    else echo 'bg-red-600 text-white';
                                    ?>">
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
                                <div class="flex items-center text-xs text-gray-500">
                                    <span class="mr-2">
                                        <i class="fas fa-clock mr-1"></i>
                                        <?php echo $class->duration; ?> jam
                                    </span>
                                    <span>
                                        <i class="fas fa-users mr-1"></i>
                                        <?php echo isset($class->enrollment_count) ? $class->enrollment_count : '0'; ?>
                                        <?php if ($class->max_students): ?>
                                            /<?php echo $class->max_students; ?>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </div>
                            <?php if ($class->status == 'Coming Soon'): ?>
                                <button class="block w-full text-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-500 bg-gray-100 cursor-not-allowed" disabled>
                                    Coming Soon
                                </button>
                            <?php else: ?>
                                <a href="<?php echo site_url('student/free_classes/view/' . $class->id); ?>" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                    Lihat Kelas
                                </a>
                            <?php endif; ?>
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
