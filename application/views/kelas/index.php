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
    <?php
        $levels = ['All', 'Dasar', 'Menengah', 'Lanjutan'];
        $levelDescriptions = [
            'All' => 'Semua kelas tersedia',
            'Dasar' => 'Fondasi keterampilan',
            'Menengah' => 'Tingkatkan kemampuan',
            'Lanjutan' => 'Eksplorasi lanjutan'
        ];
        $levelCounts = [
            'All' => count($kelas),
            'Dasar' => 0,
            'Menengah' => 0,
            'Lanjutan' => 0
        ];

        foreach ($kelas as $item) {
            $level = $item->level ?? 'Dasar';
            if (isset($levelCounts[$level])) {
                $levelCounts[$level]++;
            }
        }
    ?>
    <div class="mb-10">
        <div class="tab-wrapper">
            <div class="tab-nav" role="tablist" id="levelTabs">
                <?php foreach ($levels as $index => $level): ?>
                    <?php $levelKey = strtolower($level); ?>
                    <button type="button" class="tab-pill tab-pill-<?php echo $levelKey; ?> <?php echo $index === 0 ? 'tab-pill-active' : ''; ?>" data-level="<?php echo $levelKey; ?>">
                        <span class="tab-pill-body">
                            <span class="tab-icon">
                                <?php if ($level === 'All'): ?>
                                    <i class="fas fa-layer-group"></i>
                                <?php elseif ($level === 'Dasar'): ?>
                                    <i class="fas fa-seedling"></i>
                                <?php elseif ($level === 'Menengah'): ?>
                                    <i class="fas fa-rocket"></i>
                                <?php else: ?>
                                    <i class="fas fa-crown"></i>
                                <?php endif; ?>
                            </span>
                            <span class="tab-text">
                                <span class="tab-label"><?php echo $level; ?></span>
                                <span class="tab-subtitle"><?php echo $levelDescriptions[$level]; ?></span>
                            </span>
                        </span>
                        <span class="tab-count"><?php echo $levelCounts[$level]; ?></span>
                    </button>
                <?php endforeach; ?>
            </div>
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
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3" id="classGrid">
            <?php foreach ($kelas as $k):
                $levelKey = strtolower($k->level ?? 'Dasar');
                $hasThumbnail = !empty($k->gambar);
                $thumbnailPath = $hasThumbnail ? base_url($k->gambar) : '';
                $mentor = $this->Kelas_model->get_teachers_by_kelas($k->id);
                $mentor_name = !empty($mentor) ? $mentor[0]->nama_lengkap : 'Belum ada mentor';
                $mentor_photo = !empty($mentor) && !empty($mentor[0]->foto_profil) ? $mentor[0]->foto_profil : null;
                $enrolled = $this->Kelas_model->count_enrolled_students($k->id);
            ?>
                <div class="class-card group rounded-3xl border border-gray-100 bg-white/80 shadow-sm hover:shadow-xl transition-all overflow-hidden" data-level="<?php echo strtolower($k->level ?? 'dasar'); ?>" data-search="<?php echo strtolower(html_escape(($k->nama_kelas ?? '') . ' ' . ($k->deskripsi ?? '') . ' ' . ($k->bahasa_program ?? ''))); ?>">
                    <div class="relative">
                        <div class="aspect-[16/9] bg-gradient-to-br from-gray-100 via-gray-50 to-white flex items-center justify-center overflow-hidden relative">
                            <?php if ($hasThumbnail): ?>
                                <img src="<?php echo $thumbnailPath; ?>" alt="<?php echo html_escape($k->nama_kelas); ?>" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" onerror="this.style.display='none'; this.parentElement.querySelector('.fallback-icon').classList.remove('hidden');">
                            <?php endif; ?>
                            <div class="fallback-icon absolute inset-0 flex items-center justify-center text-4xl text-gray-300 z-10 <?php echo $hasThumbnail ? 'hidden' : ''; ?>">
                                <i class="fas fa-image"></i>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/45 via-black/10 to-transparent z-0"></div>
                        </div>
                        <div class="absolute top-4 left-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold text-white bg-emerald-500/90 backdrop-blur">
                            <i class="fas fa-code mr-2"></i>
                            <?php echo html_escape($k->bahasa_program ?? 'Programming'); ?>
                        </div>
                        <div class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold text-white <?php echo ($k->level == 'Dasar') ? 'bg-emerald-500/90' : (($k->level == 'Menengah') ? 'bg-amber-500/90' : 'bg-rose-500/90'); ?>">
                            <i class="fas fa-signal mr-2"></i>
                            <?php echo html_escape($k->level ?? 'Dasar'); ?>
                        </div>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="space-y-3">
                            <div class="flex flex-wrap items-center gap-3 text-xs text-gray-400 uppercase tracking-[.25em]">
                                <span><i class="fas fa-clock mr-1"></i><?php echo intval($k->durasi); ?> jam</span>
                                <span><i class="fas fa-money-bill-wave mr-1"></i>Rp <?php echo number_format($k->harga, 0, ',', '.'); ?></span>
                                <span><i class="fas fa-users mr-1"></i><?php echo $enrolled; ?> siswa</span>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 leading-tight group-hover:text-indigo-600 transition-colors">
                                <?php echo html_escape($k->nama_kelas); ?>
                            </h3>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <?php if ($mentor_photo): ?>
                                    <img src="<?php echo base_url($mentor_photo); ?>" alt="<?php echo $mentor_name; ?>" class="h-12 w-12 rounded-full object-cover shadow-inner">
                                <?php else: ?>
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 text-white flex items-center justify-center text-lg font-semibold shadow-inner">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800"><?php echo $mentor_name; ?></p>
                                    <p class="text-xs text-gray-400">Mentor Kelas</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold <?php echo ($k->status == 'Aktif') ? 'text-emerald-600 bg-emerald-100' : 'text-gray-600 bg-gray-100'; ?>">
                                    <span class="w-2 h-2 rounded-full mr-2 <?php echo ($k->status == 'Aktif') ? 'bg-emerald-500' : 'bg-gray-400'; ?>"></span>
                                    <?php echo $k->status; ?>
                                </span>
                                <?php if (!empty($k->online_meet_link)): ?>
                                    <div class="text-xs text-indigo-500 mt-2 inline-flex items-center gap-1">
                                        <i class="fas fa-video"></i>
                                        Online session
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 px-6 py-4 flex items-center justify-between bg-gray-50/60">
                        <a href="<?php echo site_url('kelas/detail/'.$k->id); ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                            <i class="fas fa-eye"></i>
                            Detail
                        </a>
                        <div class="flex items-center gap-3">
                            <a href="<?php echo site_url('kelas/edit/'.$k->id); ?>" class="inline-flex items-center gap-1 text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <a href="<?php echo site_url('kelas/delete/'.$k->id); ?>" class="inline-flex items-center gap-1 text-sm font-semibold text-rose-500 hover:text-rose-600" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                <i class="fas fa-trash-alt"></i>
                                Hapus
                            </a>
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
    const levelTabs = document.querySelectorAll('.tab-pill');
    levelTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            levelTabs.forEach(t => t.classList.remove('tab-pill-active'));
            this.classList.add('tab-pill-active');

            const level = this.getAttribute('data-level');
            filterLevel.value = level === 'all' ? '' : level.charAt(0).toUpperCase() + level.slice(1);

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
                const matchesLevel = !selectedLevel || itemLevel === selectedLevel.toLowerCase();
                
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

<style>
    .tab-wrapper {
        position: relative;
    }

    .tab-nav {
        display: flex;
        gap: 0.75rem;
        background: linear-gradient(135deg, rgba(226, 232, 240, 0.7), rgba(237, 233, 254, 0.7));
        padding: 0.75rem;
        border-radius: 9999px;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(12px);
        overflow-x: auto;
        scrollbar-width: none;
    }

    .tab-nav::-webkit-scrollbar {
        display: none;
    }

    .tab-pill {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.25rem;
        padding: 0.9rem 1.4rem;
        border-radius: 9999px;
        min-width: 200px;
        border: 1px solid rgba(148, 163, 184, 0.25);
        background: rgba(255, 255, 255, 0.65);
        color: #475569;
        font-weight: 600;
        transition: all 0.25s ease;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.08);
    }

    .tab-pill:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 20px rgba(15, 23, 42, 0.12);
        border-color: rgba(99, 102, 241, 0.35);
    }

    .tab-pill:focus {
        outline: none;
        border-color: rgba(99, 102, 241, 0.45);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
    }

    .tab-pill-body {
        display: inline-flex;
        align-items: center;
        gap: 1rem;
    }

    .tab-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 9999px;
        color: #fff;
        font-size: 1.1rem;
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.35);
        transition: transform 0.25s ease;
    }

    .tab-pill:hover .tab-icon {
        transform: scale(1.05) rotate(-2deg);
    }

    .tab-text {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.15rem;
    }

    .tab-label {
        font-size: 0.95rem;
        letter-spacing: 0.02em;
    }

    .tab-subtitle {
        font-size: 0.7rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.18em;
        color: rgba(71, 85, 105, 0.7);
    }

    .tab-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.3rem 0.7rem;
        border-radius: 9999px;
        background: rgba(15, 23, 42, 0.08);
        color: #0f172a;
        font-size: 0.75rem;
        min-width: 38px;
        font-weight: 700;
    }

    .tab-pill-active {
        color: #0f172a;
        border-color: transparent;
        box-shadow: 0 18px 28px rgba(79, 70, 229, 0.22), inset 0 1px 0 rgba(255, 255, 255, 0.4);
        transform: translateY(-3px);
    }

    .tab-pill-active .tab-subtitle {
        color: rgba(15, 23, 42, 0.7);
    }

    .tab-pill-active .tab-count {
        background: rgba(255, 255, 255, 0.35);
        color: #0f172a;
    }

    .tab-pill-all {
        background: rgba(237, 233, 254, 0.7);
    }

    .tab-pill-all .tab-icon {
        background: linear-gradient(135deg, #38bdf8, #6366f1);
    }

    .tab-pill-dasar .tab-icon {
        background: linear-gradient(135deg, #22c55e, #0ea5e9);
    }

    .tab-pill-menengah .tab-icon {
        background: linear-gradient(135deg, #f97316, #facc15);
    }

    .tab-pill-lanjutan .tab-icon {
        background: linear-gradient(135deg, #ef4444, #ec4899);
    }

    .tab-pill-all.tab-pill-active {
        background: linear-gradient(135deg, rgba(238, 242, 255, 0.95), rgba(224, 231, 255, 0.95));
    }

    .tab-pill-dasar.tab-pill-active {
        background: linear-gradient(135deg, rgba(187, 247, 208, 0.95), rgba(134, 239, 172, 0.95));
    }

    .tab-pill-menengah.tab-pill-active {
        background: linear-gradient(135deg, rgba(254, 215, 170, 0.95), rgba(254, 240, 138, 0.95));
    }

    .tab-pill-lanjutan.tab-pill-active {
        background: linear-gradient(135deg, rgba(254, 205, 211, 0.95), rgba(251, 207, 232, 0.95));
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    @media (max-width: 640px) {
        .tab-pill {
            min-width: 180px;
            padding: 0.75rem 1.15rem;
        }

        .tab-pill-body {
            gap: 0.75rem;
        }

        .tab-icon {
            width: 36px;
            height: 36px;
            font-size: 1rem;
        }

        .tab-text {
            gap: 0.05rem;
        }

        .tab-subtitle {
            font-size: 0.62rem;
        }
    }
</style>