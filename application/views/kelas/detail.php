

<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Hero Banner with Gradient -->
    <div class="relative rounded-2xl overflow-hidden mb-8 h-64">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-700 opacity-90"></div>
        <div class="absolute inset-0 flex items-center p-8 z-10">
            <div class="flex flex-col md:flex-row items-start md:items-center w-full">
                <div class="flex items-center mb-6 md:mb-0 md:mr-8">
                    <div class="flex items-center justify-center h-20 w-20 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-3xl">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="ml-6">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white/20 text-white backdrop-blur-sm">
                            <?php echo $kelas->bahasa_program; ?>
                        </span>
                        <h1 class="text-3xl md:text-4xl font-bold text-white mt-2"><?php echo $kelas->nama_kelas; ?></h1>
                        <p class="text-white/80 mt-1 max-w-2xl"><?php echo $kelas->deskripsi; ?></p>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 ml-auto">
                    <a href="<?php echo site_url('kelas/edit/'.$kelas->id); ?>" 
                       class="inline-flex items-center px-5 py-2.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl text-white font-medium hover:bg-white/20 transition-all duration-300">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                    <a href="<?php echo site_url('kelas'); ?>" 
                       class="inline-flex items-center px-5 py-2.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl text-white font-medium hover:bg-white/20 transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 shadow-lg ring-1 ring-gray-200/50 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 text-blue-600 shadow-inner mr-4">
                    <i class="fas fa-layer-group text-xl"></i>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-gray-800"><?php echo $kelas->level; ?></h3>
                    <p class="text-gray-500 font-medium">Level</p>
                </div>
            </div>
        </div>
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 shadow-lg ring-1 ring-gray-200/50 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-gradient-to-br from-yellow-100 to-yellow-200 text-yellow-600 shadow-inner mr-4">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-gray-800"><?php echo $kelas->durasi; ?> Jam</h3>
                    <p class="text-gray-500 font-medium">Durasi</p>
                </div>
            </div>
        </div>
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 shadow-lg ring-1 ring-gray-200/50 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-gradient-to-br from-green-100 to-green-200 text-green-600 shadow-inner mr-4">
                    <i class="fas fa-dollar-sign text-xl"></i>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-gray-800">Rp <?php echo number_format($kelas->harga, 0, ',', '.'); ?></h3>
                    <p class="text-gray-500 font-medium">Harga</p>
                </div>
            </div>
        </div>
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 shadow-lg ring-1 ring-gray-200/50 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-gradient-to-br from-purple-100 to-purple-200 text-purple-600 shadow-inner mr-4">
                    <i class="fas fa-signal text-xl"></i>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-gray-800"><?php echo $kelas->status; ?></h3>
                    <p class="text-gray-500 font-medium">Status</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Materi Section -->
    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8">
        <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50/80 to-white/80">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Materi</h2>
                    <p class="text-gray-500">Semua materi yang tersedia dalam kelas ini</p>
                </div>
                <a href="<?php echo site_url('materi/index/' . $kelas->id); ?>" 
                   class="mt-4 sm:mt-0 inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 border border-transparent rounded-xl font-medium text-sm text-white shadow-sm hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5">
                    <i class="fas fa-plus mr-2"></i> Tambah Materi
                </a>
            </div>
        </div>
        <div class="p-6">
            <?php if (empty($materi)): ?>
                <div class="text-center py-16">
                    <div class="mx-auto h-32 w-32 flex items-center justify-center rounded-full bg-gradient-to-br from-gray-100 to-gray-200 text-gray-400 shadow-inner mb-6">
                        <i class="fas fa-book-open text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">Belum Ada Materi</h3>
                    <p class="text-gray-500 max-w-md mx-auto mb-6">Mulai dengan membuat materi pertama untuk kelas ini</p>
                    <a href="<?php echo site_url('materi/create/' . $kelas->id); ?>" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl text-white font-medium hover:from-blue-600 hover:to-blue-700 transition-all duration-300">
                        <i class="fas fa-plus mr-2"></i> Buat Materi Pertama
                    </a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($materi as $item): ?>
                        <div class="bg-white rounded-xl shadow-lg ring-1 ring-gray-200/50 overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-200 mb-2">
                                    <?php echo $item['judul']; ?>
                                </h3>
                                <p class="text-gray-500 line-clamp-2 mb-4"><?php echo $item['deskripsi']; ?></p>
                                <div class="flex flex-wrap gap-2">
                                    <button class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white text-sm font-medium rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition-all duration-200 view-parts-btn" 
                                            data-parts='<?php echo json_encode($item['parts']); ?>' 
                                            data-judul="<?php echo htmlspecialchars($item['judul']); ?>">
                                        <i class="fas fa-list-ul mr-2"></i> Lihat Parts
                                    </button>
                                    <a href="<?php echo site_url('materi/detail/' . $item['id']); ?>" 
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-medium rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200">
                                        <i class="fas fa-cog mr-2"></i> Kelola
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="parts-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md max-h-[90vh] overflow-auto z-10">
        <div class="p-6 border-b border-gray-200">
            <h3 id="modal-title" class="text-xl font-bold text-gray-800"></h3>
            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="modal-body" class="p-6">
            <!-- Content will be injected here -->
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const page = document.querySelector('.transition-opacity');
    if (page) page.classList.add('opacity-100');

    const modal = document.getElementById('parts-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalBody = document.getElementById('modal-body');

    document.querySelectorAll('.view-parts-btn').forEach(button => {
        button.addEventListener('click', function() {
            const parts = JSON.parse(this.dataset.parts);
            const judul = this.dataset.judul;
            
            modalTitle.textContent = 'Lampiran untuk: ' + judul;
            
            if (parts.length > 0) {
                let content = '<div class="space-y-3">';
                parts.forEach(part => {
                    let icon = '';
                    let color = '';
                    switch(part.part_type) {
                        case 'video': 
                            icon = 'fa-video';
                            color = 'bg-red-100 text-red-600';
                            break;
                        case 'image': 
                            icon = 'fa-image';
                            color = 'bg-blue-100 text-blue-600';
                            break;
                        case 'pdf': 
                            icon = 'fa-file-pdf';
                            color = 'bg-purple-100 text-purple-600';
                            break;
                        case 'link': 
                            icon = 'fa-link';
                            color = 'bg-green-100 text-green-600';
                            break;
                    }
                    
                    content += `
                        <div class="flex items-center p-3 rounded-lg ${color} bg-opacity-50">
                            <i class="fas ${icon} mr-3 text-lg"></i>
                            <div>
                                <h4 class="font-medium">${part.part_title}</h4>
                                <p class="text-xs text-gray-500">${part.part_type}</p>
                            </div>
                        </div>
                    `;
                });
                content += '</div>';
                modalBody.innerHTML = content;
            } else {
                modalBody.innerHTML = '<p class="text-center text-gray-500 py-8">Tidak ada lampiran untuk materi ini.</p>';
            }
            
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    });

    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    window.closeModal = closeModal;
});
</script>

<?php $this->load->view('templates/footer'); ?>