

<div class="p-6 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Page Header -->
    <div class="mb-8 bg-gradient-to-r from-indigo-600 to-blue-600 p-6 rounded-2xl shadow-xl text-white">
        <h1 class="text-2xl font-bold mb-2">Pilih Kelas</h1>
        <p class="text-blue-100">Pilih kelas untuk mengelola materi pembelajaran</p>
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
                <option value="Mahir">Mahir</option>
            </select>
        </div>
    </div>

    <!-- Class Grid -->
    <?php if (empty($kelas_list)): ?>
        <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
            <div class="mx-auto w-20 h-20 rounded-full bg-blue-50 flex items-center justify-center mb-4">
                <i class="fas fa-school text-blue-500 text-3xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada kelas yang tersedia</h3>
            <p class="text-gray-500 mb-4">Silakan tambahkan kelas terlebih dahulu untuk mulai mengelola materi.</p>
            <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-plus mr-2"></i> Tambah Kelas
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="classGrid">
            <?php foreach ($kelas_list as $k): 
                // Determine badge color based on level
                $levelColors = [
                    'Dasar' => 'bg-green-100 text-green-800',
                    'Menengah' => 'bg-yellow-100 text-yellow-800',
                    'Mahir' => 'bg-red-100 text-red-800',
                    'default' => 'bg-gray-100 text-gray-800'
                ];
                $badgeColor = $levelColors[$k->level] ?? $levelColors['default'];
            ?>
                <a href="<?php echo site_url('materi/index/' . $k->id); ?>" 
                   class="group bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-300 overflow-hidden flex flex-col h-full"
                   data-level="<?php echo strtolower($k->level); ?>"
                   data-search="<?php echo strtolower(html_escape($k->nama_kelas . ' ' . $k->deskripsi . ' ' . $k->bahasa_program)); ?>">
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-4">
                                <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                                    <i class="fas fa-code text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors mb-1">
                                    <?php echo html_escape($k->nama_kelas); ?>
                                </h3>
                                <p class="text-sm text-gray-500 mb-3 line-clamp-2">
                                    <?php echo html_escape($k->deskripsi); ?>
                                </p>
                                <div class="flex flex-wrap gap-2 mt-auto">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $badgeColor; ?>">
                                        <?php echo html_escape($k->level); ?>
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <i class="fas fa-code-branch text-xs mr-1"></i>
                                        <?php echo html_escape($k->bahasa_program); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 py-3 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-sm text-gray-500">
                            <i class="far fa-file-alt mr-1"></i>
                            <?php echo isset($k->materi_count) ? $k->materi_count . ' Materi' : 'Lihat Materi'; ?>
                        </span>
                        <span class="text-gray-400 group-hover:text-blue-500 transition-colors">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </div>
                </a>
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
    
    if (searchInput && classGrid) {
        const classItems = classGrid.querySelectorAll('a[data-search]');
        
        function filterClasses() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const selectedLevel = filterLevel.value.toLowerCase();
            let hasVisibleItems = false;
            
            classItems.forEach(item => {
                const searchText = item.getAttribute('data-search');
                const itemLevel = item.getAttribute('data-level');
                
                const matchesSearch = searchText.includes(searchTerm);
                const matchesLevel = !selectedLevel || itemLevel === selectedLevel.toLowerCase();
                
                if (matchesSearch && matchesLevel) {
                    item.style.display = 'flex';
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

<?php $this->load->view('templates/footer'); ?>
