<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <!-- Header with Back Button -->
    <div class="bg-white/90 backdrop-blur-md border-b border-gray-200 sticky top-0 z-10">
        <div class="container mx-auto px-3 py-2">
            <div class="flex justify-between items-center">
                <h1 class="text-lg font-bold text-gray-900 flex items-center">
                    <a href="<?= site_url('student_mobile/forum') ?>" class="inline-flex items-center text-blue-600 hover:text-blue-700 transition-colors duration-200 mr-3 text-xs">
                        <i data-feather="arrow-left" class="w-3 h-3 mr-1"></i>
                        <span>Kembali</span>
                    </a>
                    <span class="truncate">Forum: <?= html_escape($category->name) ?></span>
                </h1>
                <a href="<?= site_url('student_mobile/forum/create') ?>" class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium">
                    Thread Baru
                </a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-3 py-4 max-w-3xl">
        <?php if (empty($threads)): ?>
            <div class="text-center py-8 bg-white rounded-lg shadow-md border border-gray-100">
                <div class="w-10 h-10 mx-auto mb-3 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 flex items-center justify-center">
                    <i data-feather="message-square" class="w-5 h-5 text-blue-500"></i>
                </div>
                <p class="text-gray-500 font-medium text-sm">Belum ada diskusi dalam kategori ini</p>
                <a href="<?= site_url('student_mobile/forum/create') ?>" class="mt-3 inline-block text-blue-600 font-medium text-sm">
                    Buat thread pertama
                </a>
            </div>
        <?php else: ?>
            <div class="space-y-3">
                <?php foreach ($threads as $thread): ?>
                    <a href="<?= site_url('student_mobile/forum_thread_clean/' . $thread->id . '/' . $thread->slug) ?>" class="block bg-white rounded-lg shadow-md border border-gray-100 p-4 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <div class="flex justify-between items-start">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-1.5 mb-2">
                                    <?php if ($thread->is_pinned): ?>
                                        <span class="text-yellow-500">
                                            <i data-feather="pin" class="w-3 h-3"></i>
                                        </span>
                                    <?php endif; ?>
                                    <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md">
                                        Forum: <?= html_escape($category->name) ?>
                                    </span>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-2 text-sm leading-snug line-clamp-2">
                                    <?= html_escape($thread->title) ?>
                                </h3>
                                <div class="flex items-center text-xs text-gray-500 space-x-2">
                                    <div class="flex items-center">
                                        <i data-feather="message-square" class="w-3 h-3 mr-1"></i>
                                        <span class="text-xs"><?= $thread->post_count ?? 0 ?></span>
                                    </div>
                                    <div class="flex items-center">
                                        <i data-feather="eye" class="w-3 h-3 mr-1"></i>
                                        <span class="text-xs"><?= $thread->views ?? 0 ?></span>
                                    </div>
                                    <span class="text-xs">Oleh <?= html_escape($thread->nama_lengkap ?? $thread->username) ?></span>
                                    <span class="text-xs">•</span>
                                    <span class="text-xs"><?= date('d M Y, H:i', strtotime($thread->created_at)) ?></span>
                                </div>
                            </div>
                            <div class="ml-3 flex-shrink-0">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center shadow-sm">
                                    <i data-feather="user" class="w-4 h-4 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Load More -->
    <?php if (isset($has_more) && $has_more): ?>
        <div class="mt-4 text-center">
            <button id="load-more" class="px-4 py-2 border border-gray-200 rounded-lg text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                Muat Lebih Banyak
            </button>
        </div>
    <?php endif; ?>
</div>

<!-- Enhanced Feather Icons and Mobile Optimizations -->
<style>
    .prose p {
        margin-bottom: 0.75rem;
        line-height: 1.5;
    }

    .prose p:last-child {
        margin-bottom: 0;
    }

    /* Mobile-optimized scrollbar */
    ::-webkit-scrollbar {
        width: 4px;
        height: 4px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 6px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg, #3b82f6, #8b5cf6);
        border-radius: 6px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(45deg, #2563eb, #7c3aed);
    }

    /* Smooth animations optimized for mobile */
    * {
        scroll-behavior: smooth;
    }

    /* Enhanced hover effects for mobile */
    .hover\:shadow-lg:hover {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    /* Mobile-specific optimizations */
    @media (max-width: 640px) {
        .container {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        .space-y-3 > * + * {
            margin-top: 0.75rem;
        }

        .space-x-2 > * + * {
            margin-left: 0.5rem;
        }
    }

    /* Touch-friendly button sizes */
    button {
        min-height: 32px;
        min-width: 32px;
    }

    /* Optimized text sizes for mobile */
    .text-xs {
        font-size: 0.75rem;
        line-height: 1rem;
    }

    .text-sm {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }

    /* Compact thread cards */
    .thread-card {
        min-height: 80px;
    }

    /* Better line clamping for mobile */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Optimized avatar sizes for mobile */
    .avatar-compact {
        min-width: 20px;
        min-height: 20px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Feather Icons
        feather.replace();

        // Handle load more button with mobile optimization
        const loadMoreBtn = document.getElementById('load-more');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                this.innerHTML = '<i data-feather="loader" class="w-3 h-3 inline mr-1 animate-spin"></i> <span class="text-xs">Memuat...</span>';
                this.disabled = true;
                feather.replace();

                // Simulate loading (replace with actual AJAX call)
                setTimeout(() => {
                    this.innerHTML = '<span class="text-xs">Muat Lebih Banyak</span>';
                    this.disabled = false;
                }, 2000);
            });
        }

        // Enhanced thread card interactions optimized for touch
        const threadCards = document.querySelectorAll('.block.bg-white');
        threadCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                if (window.innerWidth > 768) { // Only on desktop
                    this.style.transform = 'translateY(-2px)';
                }
            });

            card.addEventListener('mouseleave', function() {
                if (window.innerWidth > 768) { // Only on desktop
                    this.style.transform = 'translateY(0)';
                }
            });

            // Add touch feedback for mobile
            card.addEventListener('touchstart', function() {
                this.style.transform = 'scale(0.98)';
            });

            card.addEventListener('touchend', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Mobile viewport optimization
        function optimizeForMobile() {
            const viewport = document.querySelector('meta[name=viewport]');
            if (window.innerWidth <= 768) {
                // Ensure proper mobile viewport
                if (!viewport) {
                    const meta = document.createElement('meta');
                    meta.name = 'viewport';
                    meta.content = 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no';
                    document.head.appendChild(meta);
                }
            }
        }

        // Run mobile optimizations
        optimizeForMobile();

        // Handle orientation changes
        window.addEventListener('orientationchange', function() {
            setTimeout(() => {
                optimizeForMobile();
            }, 500);
        });
    });
</script>
