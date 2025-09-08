<div class="p-6 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl text-white">
        <div class="mb-4 md:mb-0">
            <h1 class="text-2xl font-bold">Kelola Penugasan Kelas</h1>
            <p class="text-blue-100">Atur kelas yang diajar oleh <strong><?php echo html_escape($teacher->nama_lengkap); ?></strong></p>
        </div>
        <a href="<?php echo site_url('admin_guru'); ?>" class="inline-flex items-center px-4 py-2 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar Guru
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Assigned Classes Column -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden fade-in">
            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                <h2 class="text-xl font-bold text-gray-800">Kelas yang Ditugaskan <span class="text-blue-600">(<?php echo count($assigned_kelas); ?>)</span></h2>
                <p class="text-sm text-gray-500">Daftar kelas yang saat ini diajar</p>
            </div>
            <div class="p-6">
                <?php if (empty($assigned_kelas)): ?>
                    <div class="text-center py-8">
                        <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                            <i class="fas fa-chalkboard text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada kelas</h3>
                        <p class="text-gray-500 text-sm">Guru ini belum ditugaskan untuk mengajar kelas manapun.</p>
                    </div>
                <?php else: ?>
                    <div class="space-y-4">
                        <?php foreach($assigned_kelas as $kelas): ?>
                            <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-4">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-base font-medium text-gray-900 truncate"><?php echo html_escape($kelas->nama_kelas); ?></h4>
                                    <p class="text-sm text-gray-500"><?php echo html_escape($kelas->bahasa_program); ?> • <?php echo html_escape($kelas->level); ?></p>
                                </div>
                                <?php echo form_open('admin_guru/remove_class', ['class' => 'ml-4']); ?>
                                    <input type="hidden" name="teacher_id" value="<?php echo $teacher->id; ?>">
                                    <input type="hidden" name="class_id" value="<?php echo $kelas->id; ?>">
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center text-red-600 hover:bg-red-50 rounded-full transition-colors" title="Hapus Penugasan" onclick="return confirm('Anda yakin ingin menghapus penugasan kelas ini?')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                <?php echo form_close(); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Available Classes Column -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden fade-in">
            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                <h2 class="text-xl font-bold text-gray-800">Kelas Tersedia</h2>
                <p class="text-sm text-gray-500">Tugaskan kelas baru untuk guru ini</p>
            </div>
            <div class="p-6">
                <?php 
                $assigned_ids = array_column($assigned_kelas, 'id');
                $available_classes = array_filter($all_kelas, function($k) use ($assigned_ids) {
                    return !in_array($k->id, $assigned_ids) && $k->status == 'Aktif';
                });
                ?>
                <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="searchClass" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari kelas tersedia...">
                </div>

                <?php if (empty($available_classes)): ?>
                    <div class="text-center py-8">
                        <div class="mx-auto w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mb-4">
                            <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada kelas tersedia</h3>
                        <p class="text-gray-500 text-sm">Semua kelas aktif sudah ditugaskan atau tidak ada kelas aktif yang tersedia.</p>
                    </div>
                <?php else: ?>
                    <div class="space-y-4 available-class-list" id="availableClasses">
                        <?php foreach($available_classes as $kelas): ?>
                            <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow" data-search="<?php echo strtolower(html_escape($kelas->nama_kelas . ' ' . $kelas->bahasa_program)); ?>">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-4">
                                    <i class="fas fa-code"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-base font-medium text-gray-900 truncate"><?php echo html_escape($kelas->nama_kelas); ?></h4>
                                    <p class="text-sm text-gray-500"><?php echo html_escape($kelas->bahasa_program); ?> • <?php echo html_escape($kelas->level); ?></p>
                                </div>
                                <?php echo form_open('admin_guru/assign_class', ['class' => 'ml-4']); ?>
                                    <input type="hidden" name="teacher_id" value="<?php echo $teacher->id; ?>">
                                    <input type="hidden" name="class_id" value="<?php echo $kelas->id; ?>">
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center text-white bg-green-600 hover:bg-green-700 rounded-full transition-colors" title="Tugaskan Kelas">
                                        <i class="fas fa-plus text-xs"></i>
                                    </button>
                                <?php echo form_close(); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fade in animation
    document.querySelector('.transition-opacity').classList.remove('opacity-0');
    
    // Search functionality
    const searchInput = document.getElementById('searchClass');
    const availableClasses = document.getElementById('availableClasses');
    
    if (searchInput && availableClasses) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            const classItems = availableClasses.querySelectorAll('[data-search]');
            
            if (searchTerm === '') {
                // Show all items when search is empty
                classItems.forEach(item => {
                    item.style.display = 'flex';
                });
                return;
            }
            
            let hasResults = false;
            
            classItems.forEach(item => {
                const searchText = item.getAttribute('data-search') || '';
                if (searchText.includes(searchTerm)) {
                    item.style.display = 'flex';
                    hasResults = true;
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Show/hide no results message
            const noResults = document.getElementById('noResults');
            if (!hasResults) {
                if (!noResults) {
                    const noResultsDiv = document.createElement('div');
                    noResultsDiv.id = 'noResults';
                    noResultsDiv.className = 'text-center py-8 text-gray-500';
                    noResultsDiv.innerHTML = `
                        <i class="fas fa-search text-3xl mb-2 text-gray-300"></i>
                        <p class="font-medium">Tidak ditemukan kelas yang sesuai</p>
                        <p class="text-sm">Coba kata kunci lain atau periksa ejaan</p>
                    `;
                    availableClasses.appendChild(noResultsDiv);
                }
            } else if (noResults) {
                noResults.remove();
            }
        });
    }
    
    // Add smooth scroll to top when assigning/removing classes
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
});
</script>
