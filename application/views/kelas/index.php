<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Page Header -->
    <div class="mb-8 bg-gradient-to-r from-indigo-600 to-blue-600 p-6 rounded-2xl shadow-xl text-white">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold mb-2">Kelas Programming</h1>
                <p class="text-blue-100">Kelola dan lihat semua kelas programming yang tersedia</p>
            </div>
            <a href="<?php echo site_url('kelas/create'); ?>" class="inline-flex items-center px-5 py-3 bg-white text-indigo-600 rounded-xl font-medium hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl">
                <i class="fas fa-plus mr-2"></i>
                Tambah Kelas Baru
            </a>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="mb-6 flex flex-col sm:flex-row gap-4">
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" id="searchClass" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari kelas...">
        </div>
        <div class="w-full sm:w-48">
            <select id="filterLevel" class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-lg">
                <option value="">Semua Level</option>
                <option value="Dasar">Dasar</option>
                <option value="Menengah">Menengah</option>
                <option value="Lanjutan">Lanjutan</option>
            </select>
        </div>
    </div>

    <!-- Level Navigation Tabs -->
    <div class="mb-8">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" id="levelTabs">
                <button class="level-tab active whitespace-nowrap py-2 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600" data-level="all">
                    <i class="fas fa-th-large mr-2"></i>Semua Kelas
                </button>
                <button class="level-tab whitespace-nowrap py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-level="Dasar">
                    <i class="fas fa-seedling mr-2"></i>Dasar
                </button>
                <button class="level-tab whitespace-nowrap py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-level="Menengah">
                    <i class="fas fa-chart-line mr-2"></i>Menengah
                </button>
                <button class="level-tab whitespace-nowrap py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-level="Lanjutan">
                    <i class="fas fa-rocket mr-2"></i>Lanjutan
                </button>
            </nav>
        </div>
    </div>

    <!-- Class Grid -->
    <?php if (empty($kelas)): ?>
        <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
            <div class="mx-auto w-20 h-20 rounded-full bg-blue-50 flex items-center justify-center mb-4">
                <i class="fas fa-code text-blue-500 text-3xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada kelas yang tersedia</h3>
            <p class="text-gray-500 mb-4">Silakan tambahkan kelas terlebih dahulu untuk mulai mengelola kelas programming.</p>
            <a href="<?php echo site_url('kelas/create'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-plus mr-2"></i> Tambah Kelas
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="classGrid">
            <?php foreach ($kelas as $k):
                // Determine badge color based on level
                $levelColors = [
                    'Dasar' => 'bg-green-100 text-green-800',
                    'Menengah' => 'bg-yellow-100 text-yellow-800',
                    'Lanjutan' => 'bg-red-100 text-red-800',
                    'default' => 'bg-gray-100 text-gray-800'
                ];
                $badgeColor = $levelColors[$k->level] ?? $levelColors['default'];
            ?>
                <div class="class-card group bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-300 overflow-hidden" data-level="<?php echo strtolower($k->level ?? 'dasar'); ?>" data-search="<?php echo strtolower(html_escape(($k->nama_kelas ?? '') . ' ' . ($k->deskripsi ?? '') . ' ' . ($k->bahasa_program ?? ''))); ?>">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="w-12 h-12 rounded-lg <?php echo ($k->status == 'Aktif') ? 'bg-green-50 text-green-600' : 'bg-gray-50 text-gray-600'; ?> flex items-center justify-center">
                                        <i class="fas fa-code text-xl"></i>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">
                                        <?php echo html_escape($k->nama_kelas); ?>
                                    </h3>
                                    <p class="text-sm text-gray-500"><?php echo html_escape($k->bahasa_program); ?></p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $badgeColor; ?>">
                                <?php echo html_escape($k->level ?? 'Dasar'); ?>
                            </span>
                        </div>
                        
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                            <?php echo html_escape($k->deskripsi); ?>
                        </p>
                        
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                <div class="text-lg font-bold text-gray-800"><?php echo $k->durasi; ?></div>
                                <div class="text-xs text-gray-500">Jam</div>
                            </div>
                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                <div class="text-lg font-bold text-gray-800">Rp <?php echo number_format($k->harga, 0, ',', '.'); ?></div>
                                <div class="text-xs text-gray-500">Harga</div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo ($k->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; ?>">
                                <?php echo $k->status; ?>
                            </span>
                            <div class="flex space-x-2">
                                <a href="<?php echo site_url('kelas/detail/'.$k->id); ?>" class="text-blue-600 hover:text-blue-800 p-1 rounded-full hover:bg-blue-50 transition-colors" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo site_url('kelas/edit/'.$k->id); ?>" class="text-indigo-600 hover:text-indigo-800 p-1 rounded-full hover:bg-indigo-50 transition-colors" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?php echo site_url('kelas/delete/'.$k->id); ?>" class="text-red-600 hover:text-red-800 p-1 rounded-full hover:bg-red-50 transition-colors" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Empty State Template (Hidden) -->
<template id="noResultsTemplate">
    <div class="md:col-span-3 text-center py-16">
        <div class="mx-auto w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">
            <i class="fas fa-search text-gray-400 text-2xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-1">Kelas tidak ditemukan</h3>
        <p class="text-gray-500">Coba kata kunci lain atau filter yang berbeda</p>
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fade in animation
    document.querySelector('.transition-opacity').classList.remove('opacity-0');
    
    const searchInput = document.getElementById('searchClass');
    const filterLevel = document.getElementById('filterLevel');
    const classGrid = document.getElementById('classGrid');
    const noResultsTemplate = document.getElementById('noResultsTemplate');
    let noResultsElement = null;
    
    // Level tab functionality
    const levelTabs = document.querySelectorAll('.level-tab');
    levelTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            levelTabs.forEach(t => {
                t.classList.remove('active', 'border-blue-500', 'text-blue-600');
                t.classList.add('border-transparent', 'text-gray-500');
            });
            
            // Add active class to clicked tab
            this.classList.add('active', 'border-blue-500', 'text-blue-600');
            this.classList.remove('border-transparent', 'text-gray-500');
            
            // Update filter level
            const level = this.getAttribute('data-level');
            filterLevel.value = level;
            
            // Trigger filter
            filterClasses();
        });
    });
    
    if (searchInput && classGrid) {
        const classItems = classGrid.querySelectorAll('.class-card');
        
        function filterClasses() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const selectedLevel = filterLevel.value.toLowerCase();
            let hasVisibleItems = false;
            
            classItems.forEach(item => {
                const searchText = item.getAttribute('data-search');
                const itemLevel = item.getAttribute('data-level');
                
                const matchesSearch = searchText.includes(searchTerm);
                const matchesLevel = !selectedLevel || itemLevel === selectedLevel.toLowerCase() || selectedLevel === 'all';
                
                if (matchesSearch && matchesLevel) {
                    item.style.display = 'block';
                    hasVisibleItems = true;
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Show/hide no results message
            if (!hasVisibleItems) {
                if (!noResultsElement) {
                    noResultsElement = noResultsTemplate.content.cloneNode(true);
                    classGrid.appendChild(noResultsElement);
                }
            } else if (noResultsElement) {
                const existingNoResults = classGrid.querySelector('.no-results-message');
                if (existingNoResults) {
                    existingNoResults.remove();
                }
                noResultsElement = null;
            }
        }
        
        searchInput.addEventListener('input', filterClasses);
        filterLevel.addEventListener('change', filterClasses);
    }
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kelasPage = document.querySelector('.transition-opacity');
        if (kelasPage) {
            kelasPage.classList.add('opacity-100');
        }
    });
</script>

<?php $this->load->view('templates/footer'); ?>