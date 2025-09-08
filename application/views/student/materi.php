<div class="p-4 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Header with gradient background -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl text-white">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold">Materi Pembelajaran</h1>
            <p class="text-blue-100 mt-2">Akses materi untuk kelas Anda</p>
        </div>
        <a href="<?php echo site_url('student'); ?>" class="inline-flex items-center px-4 py-2 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Dashboard
        </a>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
        <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
            <h2 class="text-xl font-bold text-gray-800">Filter Materi</h2>
        </div>
        <div class="p-6">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="w-full md:w-1/3">
                    <label for="kelasFilter" class="block text-sm font-medium text-gray-700 mb-1">Filter berdasarkan kelas:</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-graduation-cap text-gray-400"></i>
                        </div>
                        <select id="kelasFilter" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-10 py-2 sm:text-sm border-gray-300 rounded-lg">
                            <option value="">Semua Kelas</option>
                            <?php if (isset($available_classes)): ?>
                                <?php foreach($available_classes as $kelas): ?>
                                    <option value="<?php echo $kelas->id; ?>"><?php echo $kelas->nama_kelas; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-2/3">
                    <label for="searchMateri" class="block text-sm font-medium text-gray-700 mb-1">Cari materi:</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" id="searchMateri" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-lg py-2" placeholder="Masukkan kata kunci untuk mencari materi...">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Materials Grid -->
    <?php if (empty($materials)): ?>
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
            <div class="p-16 flex flex-col items-center justify-center text-center">
                <div class="rounded-full bg-blue-100 p-6 mb-4">
                    <i class="fas fa-book-open text-4xl text-blue-500"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Materi</h3>
                <p class="text-gray-500 max-w-md">Materi pembelajaran belum tersedia untuk kelas Anda. Silakan periksa kembali nanti atau hubungi pengajar Anda.</p>
                <?php if (isset($no_class_assigned) && $no_class_assigned && isset($featured_materials) && !empty($featured_materials)): ?>
                <div class="mt-8 w-full max-w-md">
                    <h4 class="text-lg font-medium text-gray-700 mb-4">Materi Unggulan</h4>
                    <div class="space-y-2">
                        <?php foreach($featured_materials as $featured): ?>
                        <a href="<?php echo site_url('student/materi_detail/'.$featured->id); ?>" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-300">
                            <div class="rounded-full bg-indigo-100 p-2 mr-3">
                                <i class="fas fa-star text-indigo-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800"><?php echo $featured->judul; ?></p>
                                <p class="text-xs text-gray-500"><?php echo $featured->nama_kelas; ?></p>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <!-- No Results Message (Hidden by default) -->
        <div id="noResultsMessage" class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in hidden">
            <div class="p-16 flex flex-col items-center justify-center text-center">
                <div class="rounded-full bg-blue-100 p-6 mb-4">
                    <i class="fas fa-search text-4xl text-blue-500"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Tidak Ada Hasil</h3>
                <p class="text-gray-500 max-w-md">Tidak ada materi yang sesuai dengan filter atau pencarian Anda. Coba ubah kriteria pencarian.</p>
                <button id="clearSearch" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                    <i class="fas fa-times-circle mr-2"></i>
                    Hapus Filter
                </button>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach($materials as $materi): ?>
                <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden fade-in transition-all duration-300 hover:shadow-2xl hover:-translate-y-1" data-kelas="<?php echo $materi->kelas_id; ?>">
                    <!-- Card Header with Gradient -->
                    <div class="p-4 bg-gradient-to-r from-blue-600 to-indigo-700 flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-white/20 flex items-center justify-center text-white">
                                <i class="fas fa-book"></i>
                            </div>
                            <span class="ml-2 text-sm font-medium text-white"><?php echo $materi->nama_kelas; ?></span>
                        </div>
                        <button class="h-8 w-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors" title="Bookmark">
                            <i class="far fa-bookmark"></i>
                        </button>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2"><?php echo $materi->judul; ?></h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            <?php echo substr(strip_tags($materi->deskripsi), 0, 120) . (strlen(strip_tags($materi->deskripsi)) > 120 ? '...' : ''); ?>
                        </p>
                        
                        <!-- Meta Information -->
                        <div class="flex flex-wrap gap-3 mb-6">
                            <div class="flex items-center text-sm text-gray-500">
                                <div class="rounded-full bg-blue-100 p-1 mr-2">
                                    <i class="fas fa-calendar-alt text-blue-600 text-xs"></i>
                                </div>
                                <span><?php echo date('d M Y', strtotime($materi->created_at)); ?></span>
                            </div>
                            <?php if (isset($materi->total_parts) && $materi->total_parts > 0): ?>
                            <div class="flex items-center text-sm text-gray-500">
                                <div class="rounded-full bg-indigo-100 p-1 mr-2">
                                    <i class="fas fa-list text-indigo-600 text-xs"></i>
                                </div>
                                <span><?php echo $materi->total_parts; ?> Bagian</span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Card Footer -->
                    <div class="px-6 pb-6">
                        <a href="<?php echo site_url('student/materi_detail/'.$materi->id); ?>" class="inline-flex items-center justify-center w-full px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-[1.02]">
                            <i class="fas fa-eye mr-2"></i>
                            Lihat Materi
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fade in main container
    const materiContainer = document.querySelector('.transition-opacity');
    if (materiContainer) {
        materiContainer.classList.add('opacity-100');
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
    
    // Filter and search functionality
    const kelasFilter = document.getElementById('kelasFilter');
    const searchInput = document.getElementById('searchMateri');
    const materialCards = document.querySelectorAll('[data-kelas]');
    
    // Function to filter materials
    function filterMaterials() {
        const selectedKelas = kelasFilter.value;
        const searchTerm = searchInput.value.toLowerCase();
        let visibleCount = 0;
        
        materialCards.forEach(card => {
            const cardKelas = card.getAttribute('data-kelas');
            const title = card.querySelector('h3').textContent.toLowerCase();
            const description = card.querySelector('p.text-gray-600').textContent.toLowerCase();
            
            const matchesKelas = selectedKelas === '' || cardKelas === selectedKelas;
            const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
            
            if (matchesKelas && matchesSearch) {
                card.classList.remove('hidden');
                // Add a staggered animation effect
                card.style.transitionDelay = `${visibleCount * 0.05}s`;
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });
        
        // Show a message if no results found
        const noResultsMessage = document.getElementById('noResultsMessage');
        if (noResultsMessage) {
            if (visibleCount === 0 && materialCards.length > 0) {
                noResultsMessage.classList.remove('hidden');
            } else {
                noResultsMessage.classList.add('hidden');
            }
        }
    }
    
    // Filter by class
    if (kelasFilter) {
        kelasFilter.addEventListener('change', filterMaterials);
    }
    
    // Search functionality
    if (searchInput) {
        searchInput.addEventListener('input', filterMaterials);
        
        // Clear search button
        const clearSearchBtn = document.getElementById('clearSearch');
        if (clearSearchBtn) {
            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                filterMaterials();
            });
        }
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
    
    /* Card hover effects */
    .hover\:shadow-2xl {
        transition: all 0.3s ease;
    }
    
    .hover\:-translate-y-1:hover {
        transform: translateY(-4px);
    }
    
    /* Line clamp for text truncation */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
