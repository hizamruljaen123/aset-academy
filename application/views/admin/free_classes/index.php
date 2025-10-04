<?php
    $levels = ['All', 'Dasar', 'Menengah', 'Lanjutan'];
    $groupedClasses = [];

    foreach ($levels as $level) {
        $groupedClasses[$level] = array_filter($free_classes, function($class) use ($level) {
            return $level === 'All' || $class->level === $level;
        });
    }
?>

<div class="p-4 sm:p-6 lg:p-8 space-y-8">
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-500 via-teal-500 to-sky-500 text-white shadow-xl">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute -left-10 -top-24 w-64 h-64 bg-white rounded-full mix-blend-overlay blur-3xl"></div>
            <div class="absolute right-0 bottom-0 w-72 h-72 bg-white rounded-full mix-blend-overlay blur-3xl"></div>
        </div>
        <div class="relative z-10 p-8 sm:p-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="space-y-3 max-w-xl">
                <div class="inline-flex items-center px-4 py-1 rounded-full bg-white/20 text-sm font-medium backdrop-blur">
                    <i class="fas fa-sparkles mr-2"></i>
                    Hub Gratis, Impact Maksimal
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold leading-tight">Kelola Kelas Gratis dengan Tampilan Modern</h1>
                <p class="text-white/80 text-base sm:text-lg">Eksplor kelas berdasarkan level kemampuan, pantau statistik utama, dan kelola konten dengan pengalaman admin yang sleek.</p>
            </div>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <a href="<?php echo site_url('admin/free_classes/create'); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-2xl bg-white text-emerald-600 font-semibold shadow-lg hover:-translate-y-0.5 transition-transform">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kelas Baru
                </a>
                <div class="flex items-center justify-center px-5 py-3 rounded-2xl bg-white/15 backdrop-blur text-sm font-medium">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    <?php echo count($free_classes); ?> Kelas Aktif
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100">
        <div class="p-6 border-b border-gray-100 flex flex-wrap items-center gap-4 justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Koleksi Kelas Gratis</h2>
                <p class="text-sm text-gray-500 mt-1">Telusuri kelas berdasar level kemampuan atau lihat semuanya sekaligus.</p>
            </div>
            <div class="hidden sm:flex items-center gap-4 text-sm text-gray-500">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Level Dasar
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    Level Menengah
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                    Level Lanjutan
                </div>
            </div>
        </div>

        <div class="px-6 pt-6">
            <div class="tab-wrapper">
                <div class="tab-nav" role="tablist">
                    <?php foreach ($levels as $index => $level): ?>
                        <?php
                            $levelKey = strtolower($level);
                            $subtitle = 'Semua kelas gratis';
                            if ($level === 'Dasar') {
                                $subtitle = 'Fondasi keterampilan';
                            } elseif ($level === 'Menengah') {
                                $subtitle = 'Tingkatkan kemampuan';
                            } elseif ($level === 'Lanjutan') {
                                $subtitle = 'Eksplorasi lanjutan';
                            }
                        ?>
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
                                    <span class="tab-subtitle"><?php echo $subtitle; ?></span>
                                </span>
                            </span>
                            <span class="tab-count"><?php echo count($groupedClasses[$level]); ?></span>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="tab-panels">
            <?php foreach ($levels as $index => $level): ?>
                <div class="tab-panel <?php echo $index === 0 ? 'tab-panel-active' : ''; ?>" data-level="<?php echo strtolower($level); ?>">
                    <?php if (empty($groupedClasses[$level])): ?>
                        <div class="p-12 text-center text-gray-400">
                            <div class="mx-auto w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center text-3xl mb-4">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-600">Belum ada kelas pada level ini</h3>
                            <p class="text-sm text-gray-500 mt-2">Tambahkan kelas baru atau ubah level kelas yang ada.</p>
                        </div>
                    <?php else: ?>
                        <div class="grid gap-6 p-6 md:grid-cols-2 xl:grid-cols-3">
                            <?php foreach ($groupedClasses[$level] as $class): ?>
                                <?php
                                    $hasThumbnail = !empty($class->thumbnail);
                                    $thumbnailPath = $hasThumbnail ? base_url($class->thumbnail) : '';
                                ?>
                                <div class="group rounded-3xl border border-gray-100 bg-white/80 shadow-sm hover:shadow-xl transition-all overflow-hidden">
                                    <div class="relative">
                                        <div class="aspect-[16/9] bg-gradient-to-br from-gray-100 via-gray-50 to-white flex items-center justify-center overflow-hidden relative">
                                            <?php if ($hasThumbnail): ?>
                                                <img src="<?php echo $thumbnailPath; ?>" alt="<?php echo $class->title; ?>" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" onerror="this.style.display='none'; this.parentElement.querySelector('.fallback-icon').classList.remove('hidden');">
                                            <?php endif; ?>
                                            <div class="fallback-icon absolute inset-0 flex items-center justify-center text-4xl text-gray-300 z-10 <?php echo $hasThumbnail ? 'hidden' : ''; ?>">
                                                <i class="fas fa-image"></i>
                                            </div>
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent z-0"></div>
                                        </div>
                                        <div class="absolute top-4 left-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold text-white bg-emerald-500/90 backdrop-blur z-20">
                                            <i class="fas fa-book mr-2"></i>
                                            <?php echo $class->category; ?>
                                        </div>
                                        <div class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold text-white <?php echo ($class->level == 'Dasar') ? 'bg-emerald-500/90' : (($class->level == 'Menengah') ? 'bg-amber-500/90' : 'bg-rose-500/90'); ?> z-20">
                                            <i class="fas fa-signal mr-2"></i>
                                            <?php echo $class->level; ?>
                                        </div>
                                    </div>
                                    <div class="p-6 space-y-4">
                                        <div class="space-y-2">
                                            <div class="flex items-center gap-2 text-xs text-gray-400 uppercase tracking-[.25em]">
                                                <span><i class="fas fa-clock mr-1"></i><?php echo $class->duration; ?> menit</span>
                                                <?php if (!empty($class->max_students)): ?>
                                                    <span><i class="fas fa-user-friends mr-1"></i><?php echo $class->max_students; ?> kuota</span>
                                                <?php endif; ?>
                                            </div>
                                            <h3 class="text-xl font-semibold text-gray-900 leading-tight"><?php echo $class->title; ?></h3>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div class="h-12 w-12 rounded-full bg-gradient-to-br from-emerald-500 to-teal-500 text-white flex items-center justify-center text-lg font-semibold shadow-inner">
                                                    <i class="fas fa-user-tie"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-semibold text-gray-800"><?php echo $class->mentor_name; ?></p>
                                                    <p class="text-xs text-gray-400">Mentor</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold <?php echo ($class->status == 'Published') ? 'text-emerald-600 bg-emerald-100' : 'text-gray-600 bg-gray-100'; ?>">
                                                    <span class="w-2 h-2 rounded-full mr-2 <?php echo ($class->status == 'Published') ? 'bg-emerald-500' : 'bg-gray-400'; ?>"></span>
                                                    <?php echo $class->status; ?>
                                                </span>
                                                <div class="text-xs text-gray-400 mt-2">
                                                    <?php echo $this->Free_class_model->count_enrolled_students($class->id); ?> siswa terdaftar
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-t border-gray-100 px-6 py-4 flex items-center justify-between bg-gray-50/60">
                                        <div class="flex items-center space-x-4">
                                            <a href="<?php echo site_url('admin/free_classes/edit/' . $class->id); ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </a>
                                            <a href="<?php echo site_url('admin/free_classes/detail/' . $class->id); ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700">
                                                <i class="fas fa-eye"></i>
                                                Detail
                                            </a>
                                        </div>
                                        <a href="<?php echo site_url('admin/free_classes/delete/' . $class->id); ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-rose-500 hover:text-rose-600" onclick="return confirm('Yakin ingin menghapus kelas ini?');">
                                            <i class="fas fa-trash-alt"></i>
                                            Hapus
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-pill');
        const tabPanels = document.querySelectorAll('.tab-panel');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const level = button.dataset.level;

                tabButtons.forEach(btn => btn.classList.remove('tab-pill-active'));
                button.classList.add('tab-pill-active');

                tabPanels.forEach(panel => {
                    if (panel.dataset.level === level) {
                        panel.classList.add('tab-panel-active');
                    } else {
                        panel.classList.remove('tab-panel-active');
                    }
                });
            });
        });
    });
</script>

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

    .tab-panel {
        display: none;
    }

    .tab-panel-active {
        display: block;
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
