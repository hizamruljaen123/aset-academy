<?php
// Forum Index View - Mobile Optimized
// This file displays the forum index page with categories and threads
?>
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <!-- Header with Back Button -->
    <div class="bg-white/90 backdrop-blur-md border-b border-gray-200 sticky top-0 z-10">
        <div class="container mx-auto px-3 py-4 max-w-3xl">
            <div class="flex justify-between items-center">
                <h1 class="text-lg font-bold text-gray-900">Forum Diskusi</h1>
                <a href="<?= site_url('student_mobile/forum/create') ?>" class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium">
                    Thread Baru
                </a>
            </div>
        </div>

    <div class="container mx-auto px-3 py-4 max-w-3xl">
        <!-- Categories Section - More Prominent -->
        <div class="mb-6">
            <div class="bg-white rounded-lg shadow-md border border-gray-100 p-4 mb-4">
                <h2 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                    <i data-feather="grid" class="w-4 h-4 mr-2 text-blue-600"></i>
                    Kategori Forum
                </h2>
                <div class="max-h-64 overflow-y-auto category-scroll">
                    <div class="space-y-3 category-list pr-2">
                    <!-- Semua Kategori -->
                    <a href="<?= site_url('student_mobile/forum') ?>" class="flex items-center justify-between p-4 rounded-xl border-2 border-blue-200 bg-blue-50 hover:bg-blue-100 transition-all duration-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center shadow-lg">
                                <i data-feather="layers" class="w-5 h-5 text-white"></i>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-blue-900">Semua Kategori</div>
                                <div class="text-xs text-blue-700">Lihat semua diskusi forum</div>
                            </div>
                        </div>
                        <div class="text-blue-600">
                            <i data-feather="chevron-right" class="w-5 h-5"></i>
                        </div>
                    </a>

                    <?php foreach ($categories as $category): ?>
                        <!-- Kategori Individual -->
                        <a href="<?= site_url('student_mobile/forum/category/' . $category->id) ?>" class="flex items-center justify-between p-4 rounded-xl border-2 border-gray-200 bg-white hover:bg-gray-50 hover:border-gray-300 transition-all duration-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center shadow-lg">
                                    <i data-feather="tag" class="w-5 h-5 text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-semibold text-gray-900 truncate">
                                        <?= html_escape($category->name) ?>
                                    </div>
                                    <div class="text-xs text-gray-600 mt-0.5">
                                        Klik untuk melihat diskusi dalam kategori ini
                                    </div>
                                </div>
                            </div>
                            <div class="text-gray-400">
                                <i data-feather="chevron-right" class="w-5 h-5"></i>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="mb-4">
            <div class="relative">
                <input type="text" placeholder="Cari diskusi..." class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                <i data-feather="search" class="absolute right-3 top-2.5 text-gray-400 w-4 h-4"></i>
            </div>
        </div>

    <!-- Thread List -->
    <div class="bg-white rounded-lg shadow-md border border-gray-100 p-4 mb-6">
        <h2 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
            <i data-feather="message-square" class="w-4 h-4 mr-2 text-blue-600"></i>
            Diskusi Terbaru
        </h2>
        <div class="max-h-80 overflow-y-auto thread-scroll">
            <div class="space-y-3">
        <?php if (empty($threads)): ?>
            <div class="text-center py-8 bg-white rounded-lg shadow-md border border-gray-100">
                <div class="w-10 h-10 mx-auto mb-3 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 flex items-center justify-center">
                    <i data-feather="message-square" class="w-5 h-5 text-blue-500"></i>
                </div>
                <p class="text-gray-500 font-medium text-sm">Belum ada diskusi yang tersedia</p>
                <a href="<?= site_url('student_mobile/forum/create') ?>" class="mt-3 inline-block text-blue-600 font-medium text-sm">
                    Buat thread pertama
                </a>
            </div>
        <?php else: ?>
            <?php foreach ($threads as $thread): ?>
                <a href="<?= site_url('student_mobile/forum_thread_clean/' . $thread->id . '/' . $thread->slug) ?>" class="block bg-white rounded-lg shadow-md border border-gray-100 p-4 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 thread-card">
                    <div class="flex justify-between items-start">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-1.5 mb-2">
                                <?php if ($thread->is_pinned): ?>
                                    <span class="text-yellow-500">
                                        <i data-feather="pin" class="w-3 h-3"></i>
                                    </span>
                                <?php endif; ?>
                                <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md">
                                    <?= html_escape($thread->category_name) ?>
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
                                <span class="text-xs"><?= date('d M Y, H:i', strtotime($thread->created_at)) ?></span>
                            </div>
                        </div>
                        <div class="ml-3 flex-shrink-0">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center shadow-sm avatar-compact">
                                <i data-feather="user" class="w-4 h-4 text-white"></i>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Load More -->
    <?php if ($has_more): ?>
        <div class="mt-4 text-center">
            <button id="load-more" class="px-4 py-2 border border-gray-200 rounded-lg text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                Muat Lebih Banyak
            </button>
        </div>
    <?php endif; ?>
</div>
</div>

<!-- Enhanced Feather Icons and Mobile Optimizations -->
<style>
    .prose p {
        margin-bottom: 0.5rem;
        line-height: 1.4;
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

        .space-x-1\.5 > * + * {
            margin-left: 0.375rem;
        }
    }

    /* Touch-friendly button sizes */
    button {
        min-height: 32px;
        min-width: 32px;
    }

    /* Mobile-friendly scrollbars for categories and threads */
    .category-scroll,
    .thread-scroll {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .category-scroll::-webkit-scrollbar,
    .thread-scroll::-webkit-scrollbar {
        width: 4px;
        height: 4px;
    }

    .category-scroll::-webkit-scrollbar-track,
    .thread-scroll::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.05);
        border-radius: 6px;
    }

    .category-scroll::-webkit-scrollbar-thumb,
    .thread-scroll::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg, #3b82f6, #8b5cf6);
        border-radius: 6px;
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .category-scroll::-webkit-scrollbar-thumb:hover,
    .thread-scroll::-webkit-scrollbar-thumb:hover {
        opacity: 1;
    }

    /* Smooth momentum scrolling for iOS */
    .category-scroll,
    .thread-scroll {
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
    }

    /* Mobile optimizations for scroll containers */
    @media (max-width: 640px) {
        .category-scroll {
            max-height: 240px;
        }

        .thread-scroll {
            max-height: 320px;
        }

        /* Better touch targets for mobile */
        .category-scroll,
        .thread-scroll {
            -webkit-tap-highlight-color: transparent;
        }
    }

    /* Optimized avatar sizes for mobile */
    .avatar-compact {
        min-width: 20px;
        min-height: 20px;
    }

    /* Visual indicators for scrollable content */
    .category-scroll,
    .thread-scroll {
        position: relative;
    }

    .category-scroll::after,
    .thread-scroll::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 16px;
        background: linear-gradient(to top, rgba(255, 255, 255, 0.8), transparent);
        pointer-events: none;
        opacity: 0.7;
        z-index: 1;
    }

    /* Enhanced scroll performance */
    .category-scroll,
    .thread-scroll {
        transform: translateZ(0);
        -webkit-transform: translateZ(0);
        will-change: scroll-position;
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

/* Enhanced category list styling for mobile */
.category-list .space-y-3 > * + * {
    margin-top: 0.75rem;
}

/* Better touch feedback for category cards */
.category-list a {
    position: relative;
    overflow: hidden;
}

.category-list a::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.category-list a:hover::before {
    left: 100%;
}

/* Mobile-optimized category cards */
@media (max-width: 640px) {
    .category-list a {
        padding: 1rem;
        border-radius: 0.75rem;
    }

    .category-list .w-12 {
        width: 3rem;
        height: 3rem;
    }

    .category-list .text-sm {
        font-size: 0.9rem;
        line-height: 1.3;
    }

    .category-list .text-xs {
        font-size: 0.8rem;
        line-height: 1.2;
    }
}

/* Smooth hover transitions */
.category-list a {
    transform: translateY(0);
    transition: all 0.2s ease;
}

.category-list a:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 25px -5px rgba(0, 0, 0, 0.1);
}

    /* Hide scrollbar for touch scrolling */
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    /* Enhanced button styling for transparent design */
    .scrollbar-hide button,
    .scrollbar-hide a {
        position: relative;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
    }

    .scrollbar-hide button:hover,
    .scrollbar-hide a:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(0, 0, 0, 0.2);
    }

    /* Better touch feedback for filter buttons */
    .scrollbar-hide button:active,
    .scrollbar-hide a:active {
        transform: scale(0.95);
        background: rgba(255, 255, 255, 0.3);
        transition: all 0.1s ease;
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
                this.style.transition = 'transform 0.1s ease';
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

        // Enhanced touch scrolling for category filters
        const categoryContainer = document.querySelector('.overflow-x-auto');
        if (categoryContainer) {
            // Enable momentum scrolling on iOS
            categoryContainer.style.webkitOverflowScrolling = 'touch';

            // Add smooth scroll behavior
            categoryContainer.style.scrollBehavior = 'smooth';

            // Prevent vertical scroll when scrolling horizontally
            categoryContainer.addEventListener('touchstart', function(e) {
                const touch = e.touches[0];
                this.startX = touch.clientX;
                this.startY = touch.clientY;
            }, { passive: true });

            categoryContainer.addEventListener('touchmove', function(e) {
                if (!this.startX || !this.startY) return;

                const touch = e.touches[0];
                const deltaX = Math.abs(touch.clientX - this.startX);
                const deltaY = Math.abs(touch.clientY - this.startY);

                // If horizontal scroll is greater than vertical, prevent default
                if (deltaX > deltaY) {
                    e.stopPropagation();
                }
            }, { passive: true });
        }
    });
</script>

