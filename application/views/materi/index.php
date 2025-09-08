<div class="p-4 transition-opacity duration-500 opacity-0 bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Premium Header with Breadcrumbs -->
    <div class="mb-4 flex items-center space-x-2 text-sm text-gray-500">
        <a href="<?php echo site_url('kelas'); ?>" class="hover:text-blue-600">Kelas</a>
        <span>/</span>
        <a href="<?php echo site_url('kelas/detail/'.$kelas->id); ?>" class="hover:text-blue-600"><?php echo $kelas->nama_kelas; ?></a>
        <span>/</span>
        <span class="text-blue-600">Materi</span>
    </div>

    <!-- Hero Section with Glass Morphism Effect -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 p-8 rounded-2xl bg-white/80 backdrop-blur-lg shadow-lg ring-1 ring-white/10">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                <?php echo $kelas->nama_kelas; ?> Materi
            </h1>
            <p class="text-lg text-gray-500 mt-2">Kelola konten pembelajaran untuk kelas ini</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="<?php echo site_url('materi/create/' . $kelas->id); ?>" 
               class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-500 to-blue-600 border border-transparent rounded-xl font-medium text-sm text-white shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 group">
                <i class="fas fa-plus mr-2 group-hover:rotate-90 transition-transform"></i> 
                <span>Tambah Materi Baru</span>
            </a>
            <a href="<?php echo site_url('kelas/detail/' . $kelas->id); ?>" 
               class="inline-flex items-center px-5 py-3 bg-white border border-gray-300 rounded-xl font-medium text-sm text-gray-700 shadow hover:bg-gray-50 hover:shadow-md transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-arrow-left mr-2"></i> 
                <span>Kembali ke Kelas</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards with Animated Icons -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <div class="bg-white/80 backdrop-blur-lg p-6 rounded-2xl shadow-lg hover:shadow-xl ring-1 ring-white/10 transition-all duration-300">
            <div class="flex items-center">
                <div class="p-4 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 text-blue-600 shadow-inner mr-5 animate-pulse">
                    <i class="fas fa-book-open text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-4xl font-bold text-gray-800"><?php echo count($materi); ?></h3>
                    <p class="text-gray-500 font-medium">Total Materi</p>
                </div>
            </div>
        </div>
        <div class="bg-white/80 backdrop-blur-lg p-6 rounded-2xl shadow-lg hover:shadow-xl ring-1 ring-white/10 transition-all duration-300">
            <div class="flex items-center">
                <div class="p-4 rounded-full bg-gradient-to-br from-indigo-100 to-purple-200 text-indigo-600 shadow-inner mr-5 animate-bounce">
                    <i class="fas fa-code text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-4xl font-bold text-gray-800"><?php echo $kelas->bahasa_program; ?></h3>
                    <p class="text-gray-500 font-medium">Bahasa Pemrograman</p>
                </div>
            </div>
        </div>
        <div class="bg-white/80 backdrop-blur-lg p-6 rounded-2xl shadow-lg hover:shadow-xl ring-1 ring-white/10 transition-all duration-300">
            <div class="flex items-center">
                <div class="p-4 rounded-full bg-gradient-to-br from-green-100 to-teal-200 text-green-600 shadow-inner mr-5 animate-spin animate-spin-slow">
                    <i class="fas fa-layer-group text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-4xl font-bold text-gray-800"><?php echo $kelas->level; ?></h3>
                    <p class="text-gray-500 font-medium">Tingkat Kesulitan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Materi List with Advanced Card Design -->
    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl ring-1 ring-white/10 overflow-hidden mb-8">
        <div class="p-6 border-b border-white/20 bg-gradient-to-r from-gray-50/80 to-white/80">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Materi</h2>
                    <p class="text-gray-500">Semua konten pembelajaran tersedia di bawah</p>
                </div>
                <div class="relative">
                    <input type="text" placeholder="Cari materi..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
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
                    <a href="<?php echo site_url('materi/create/' . $kelas->id); ?>" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl text-white font-medium hover:from-blue-600 hover:to-blue-700 transition-all duration-300">
                        <i class="fas fa-plus mr-2"></i> Buat Materi Pertama
                    </a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($materi as $m): ?>
                        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-xl overflow-hidden border border-gray-200/50 transition-all duration-300 transform hover:-translate-y-1">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-indigo-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="p-6 relative z-10">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
                                        <?php echo $m->judul; ?>
                                    </h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Materi #<?php echo $m->id; ?>
                                    </span>
                                </div>
                                <p class="text-gray-500 mb-6 line-clamp-3"><?php echo $m->deskripsi; ?></p>
                                <div class="flex flex-wrap gap-2">
                                    <a href="<?php echo site_url('materi/detail/'.$m->id); ?>" 
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-medium rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200">
                                        <i class="fas fa-eye mr-2"></i> Preview
                                    </a>
                                    <a href="<?php echo site_url('materi/edit/'.$m->id); ?>" 
                                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-all duration-200">
                                        <i class="fas fa-pencil-alt mr-2"></i> Edit
                                    </a>
                                    <a href="<?php echo site_url('materi/delete/'.$m->id); ?>" 
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-sm font-medium rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200"
                                       onclick="return confirm('Hapus materi ini?')">
                                        <i class="fas fa-trash-alt mr-2"></i> Hapus
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const page = document.querySelector('.transition-opacity');
        if (page) page.classList.add('opacity-100');

        // Search functionality
        const searchInput = document.querySelector('input[type="text"]');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                document.querySelectorAll('.group h3').forEach(el => {
                    const card = el.closest('.group');
                    if (el.textContent.toLowerCase().includes(searchTerm)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
