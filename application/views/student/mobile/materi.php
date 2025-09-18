<div class="space-y-4">
    <!-- Search Bar -->
    <div class="mobile-card">
        <div class="relative">
            <i data-feather="search" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
            <input type="text" placeholder="Cari materi..." class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
    </div>

    <!-- Class Assignment Status -->
    <?php if (isset($no_class_assigned) && $no_class_assigned): ?>
    <div class="mobile-card bg-yellow-50 border border-yellow-200">
        <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <i data-feather="alert-circle" class="w-4 h-4 text-yellow-600"></i>
            </div>
            <div class="flex-1">
                <h4 class="text-sm font-medium text-gray-900 mb-1">Belum Terdaftar di Kelas</h4>
                <p class="text-xs text-gray-600 mb-3">Anda belum terdaftar di kelas manapun. Silakan hubungi administrator untuk pendaftaran.</p>
                <button class="mobile-btn bg-yellow-600 text-white text-sm">
                    Hubungi Admin
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Featured Materials (when no class assigned) -->
    <?php if (isset($no_class_assigned) && $no_class_assigned && !empty($featured_materials)): ?>
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Materi Unggulan</h3>
        <div class="space-y-3">
            <?php foreach($featured_materials as $materi): ?>
                <div class="border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center text-white flex-shrink-0">
                            <i data-feather="star" class="w-5 h-5"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-gray-900 mb-1"><?php echo $materi->judul; ?></h4>
                            <p class="text-xs text-gray-500 mb-2"><?php echo $materi->nama_kelas; ?></p>
                            <p class="text-xs text-gray-600 line-clamp-2"><?php echo substr($materi->deskripsi, 0, 100) . (strlen($materi->deskripsi) > 100 ? '...' : ''); ?></p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-xs text-gray-500"><?php echo date('d M Y', strtotime($materi->created_at)); ?></span>
                                <button class="text-xs text-blue-600 font-medium">
                                    Lihat Detail <i data-feather="arrow-right" class="w-3 h-3 inline ml-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Class Materials (when class assigned) -->
    <?php if (!isset($no_class_assigned) || !$no_class_assigned): ?>
    <div class="mobile-card">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-lg font-bold text-gray-900">Materi Pembelajaran</h3>
            <span class="text-sm text-gray-500"><?php echo count($materials); ?> materi</span>
        </div>
        
        <?php if (empty($materials)): ?>
            <div class="text-center py-12">
                <i data-feather="book-open" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
                <h4 class="text-lg font-medium text-gray-900 mb-2">Belum ada materi</h4>
                <p class="text-sm text-gray-500">Materi pembelajaran akan segera tersedia</p>
            </div>
        <?php else: ?>
            <div class="space-y-3">
                <?php foreach($materials as $index => $materi): ?>
                    <div class="border border-gray-100 rounded-lg p-4 hover:shadow-md transition-all duration-200 hover:border-blue-200">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <span class="text-sm font-bold text-blue-600"><?php echo $index + 1; ?></span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-2">
                                    <h4 class="text-sm font-bold text-gray-900"><?php echo $materi->judul; ?></h4>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        Tersedia
                                    </span>
                                </div>
                                <p class="text-xs text-gray-600 mb-3 line-clamp-2"><?php echo substr($materi->deskripsi, 0, 120) . (strlen($materi->deskripsi) > 120 ? '...' : ''); ?></p>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3 text-xs text-gray-500">
                                        <span><i data-feather="calendar" class="w-3 h-3 mr-1"></i><?php echo date('d M Y', strtotime($materi->created_at)); ?></span>
                                        <span><i data-feather="clock" class="w-3 h-3 mr-1"></i>Estimasi 30 menit</span>
                                    </div>
                                    <button onclick="location.href='<?= site_url('student_mobile/materi_detail/'.$materi->id) ?>'" class="mobile-btn bg-blue-600 text-white text-xs">
                                        <i data-feather="play" class="w-3 h-3 inline mr-1"></i>
                                        Mulai Belajar
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Progress indicator -->
                        <div class="mt-3">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs text-gray-500">Progress</span>
                                <span class="text-xs text-gray-700 font-medium">0%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Material Categories -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Kategori Materi</h3>
        <div class="grid grid-cols-2 gap-3">
            <button class="p-3 bg-blue-50 rounded-lg text-center hover:bg-blue-100 transition-colors">
                <i data-feather="code" class="w-6 h-6 text-blue-600 mx-auto mb-2"></i>
                <span class="text-xs font-medium text-gray-900">Programming</span>
            </button>
            <button class="p-3 bg-green-50 rounded-lg text-center hover:bg-green-100 transition-colors">
                <i data-feather="database" class="w-6 h-6 text-green-600 mx-auto mb-2"></i>
                <span class="text-xs font-medium text-gray-900">Database</span>
            </button>
            <button class="p-3 bg-purple-50 rounded-lg text-center hover:bg-purple-100 transition-colors">
                <i data-feather="globe" class="w-6 h-6 text-purple-600 mx-auto mb-2"></i>
                <span class="text-xs font-medium text-gray-900">Web Dev</span>
            </button>
            <button class="p-3 bg-yellow-50 rounded-lg text-center hover:bg-yellow-100 transition-colors">
                <i data-feather="smartphone" class="w-6 h-6 text-yellow-600 mx-auto mb-2"></i>
                <span class="text-xs font-medium text-gray-900">Mobile Dev</span>
            </button>
        </div>
    </div>

    <!-- Study Statistics -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Statistik Belajar</h3>
        <div class="grid grid-cols-2 gap-3">
            <div class="bg-blue-50 rounded-lg p-3 text-center">
                <div class="text-2xl font-bold text-blue-600 mb-1">12</div>
                <div class="text-xs text-gray-600">Materi Selesai</div>
            </div>
            <div class="bg-green-50 rounded-lg p-3 text-center">
                <div class="text-2xl font-bold text-green-600 mb-1">8</div>
                <div class="text-xs text-gray-600">Jam Belajar</div>
            </div>
            <div class="bg-purple-50 rounded-lg p-3 text-center">
                <div class="text-2xl font-bold text-purple-600 mb-1">5</div>
                <div class="text-xs text-gray-600">Sertifikat</div>
            </div>
            <div class="bg-yellow-50 rounded-lg p-3 text-center">
                <div class="text-2xl font-bold text-yellow-600 mb-1">85%</div>
                <div class="text-xs text-gray-600">Nilai Rata</div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Aksi Cepat</h3>
        <div class="space-y-2">
            <button class="w-full flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i data-feather="download" class="w-4 h-4 text-blue-600"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Download Materi</span>
                </div>
                <i data-feather="chevron-right" class="w-4 h-4 text-gray-400"></i>
            </button>

            <button class="w-full flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <i data-feather="bookmark" class="w-4 h-4 text-green-600"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Materi Tersimpan</span>
                </div>
                <i data-feather="chevron-right" class="w-4 h-4 text-gray-400"></i>
            </button>

            <button class="w-full flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i data-feather="award" class="w-4 h-4 text-purple-600"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Sertifikat Saya</span>
                </div>
                <i data-feather="chevron-right" class="w-4 h-4 text-gray-400"></i>
            </button>
        </div>
    </div>
</div>

<script>
    // Initialize Feather Icons
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

        // Search functionality
        const searchInput = document.querySelector('input[type="text"]');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const materialCards = document.querySelectorAll('.border.border-gray-100, .border.border-gray-200');
                
                materialCards.forEach(card => {
                    const title = card.querySelector('h4').textContent.toLowerCase();
                    const description = card.querySelector('p').textContent.toLowerCase();
                    
                    if (title.includes(searchTerm) || description.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
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