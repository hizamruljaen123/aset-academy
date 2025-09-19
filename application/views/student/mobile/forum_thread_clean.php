<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <div class="container mx-auto px-3 py-4 max-w-3xl">
        <!-- Back Button (Small) -->
        <div class="mb-4">
            <a href="<?= site_url('student_mobile/forum') ?>" class="inline-flex items-center text-blue-600 hover:text-blue-700 transition-colors duration-200 text-xs">
                <i data-feather="arrow-left" class="w-3 h-3 mr-1"></i>
                <span>Kembali ke Forum</span>
            </a>
        </div>

        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('success')):
        ?>
            <div class="bg-green-50 border border-green-200 text-green-700 px-3 py-2 rounded-lg mb-4 text-xs" role="alert">
                <div class="flex items-center">
                    <i data-feather="check-circle" class="w-3 h-3 mr-1.5"></i>
                    <span><?php echo $this->session->flashdata('success'); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')):
        ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-3 py-2 rounded-lg mb-4 text-xs" role="alert">
                <div class="flex items-center">
                    <i data-feather="alert-circle" class="w-3 h-3 mr-1.5"></i>
                    <span><?php echo $this->session->flashdata('error'); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Thread Header -->
        <div class="bg-white rounded-lg shadow-md border border-gray-100 p-4 mb-4 hover:shadow-lg transition-shadow duration-300">
            <!-- Category and Pin Badges -->
            <div class="flex items-center flex-wrap gap-1.5 mb-3">
                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-sm">
                    <i data-feather="tag" class="w-2.5 h-2.5 mr-1"></i>
                    <?= html_escape($thread->category_name) ?>
                </span>
                <?php if ($thread->is_pinned):
                ?>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-gradient-to-r from-yellow-500 to-orange-500 text-white shadow-sm">
                        <i data-feather="pin" class="w-2.5 h-2.5 mr-1"></i>
                        Disematkan
                    </span>
                <?php endif; ?>
            </div>

            <!-- Thread Title -->
            <h1 class="text-lg md:text-xl font-bold text-gray-900 mb-3 leading-tight">
                <?= html_escape($thread->title) ?>
            </h1>

            <!-- Thread Meta Information -->
            <div class="flex items-center flex-wrap gap-3 text-xs text-gray-600">
                <div class="flex items-center bg-gray-50 rounded-md px-2 py-1">
                                    <div class="w-6 h-6 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center mr-1.5 avatar-small">
                                        <i data-feather="user" class="w-2.5 h-2.5 text-white"></i>
                                    </div>
                    <span class="font-medium text-xs"><?= html_escape($thread->nama_lengkap) ?></span>
                </div>

                <div class="flex items-center bg-gray-50 rounded-md px-2 py-1">
                    <i data-feather="clock" class="w-3 h-3 mr-1 text-gray-500"></i>
                    <span class="text-xs"><?= date('d M Y, H:i', strtotime($thread->created_at)) ?></span>
                </div>

                <div class="flex items-center bg-gray-50 rounded-md px-2 py-1">
                    <i data-feather="eye" class="w-3 h-3 mr-1 text-gray-500"></i>
                    <span class="text-xs"><?= $thread->views ?>x dilihat</span>
                </div>
            </div>
        </div>

        <!-- Thread Content -->
        <div class="bg-white rounded-lg shadow-md border border-gray-100 p-4 mb-6 hover:shadow-lg transition-shadow duration-300">
            <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                <div class="text-sm leading-6">
                    <?= nl2br(html_escape($thread->content)) ?>
                </div>
            </div>

            <!-- Thread Actions -->
            <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100">
                <div class="flex items-center space-x-3">
                    <button class="flex items-center space-x-2 px-3 py-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 transition-colors duration-200 group">
                        <i data-feather="message-square" class="w-3.5 h-3.5 group-hover:scale-110 transition-transform duration-200"></i>
                        <span class="text-xs font-medium"><?= $thread->post_count ?> balasan</span>
                    </button>
                </div>

                <div class="flex items-center space-x-3">
                    <button class="flex items-center justify-center w-8 h-8 rounded-lg bg-gray-50 hover:bg-blue-50 text-gray-600 hover:text-blue-600 transition-all duration-200 group">
                        <i data-feather="share-2" class="w-4 h-4 group-hover:scale-110 transition-transform duration-200"></i>
                    </button>
                    <button class="flex items-center justify-center w-8 h-8 rounded-lg bg-gray-50 hover:bg-red-50 text-gray-600 hover:text-red-500 transition-all duration-200 group">
                        <i data-feather="heart" class="w-4 h-4 group-hover:scale-110 transition-transform duration-200"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Replies Section -->
        <div class="mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base font-bold text-gray-900 flex items-center">
                    <i data-feather="message-circle" class="w-4 h-4 mr-1.5 text-blue-600"></i>
                    Balasan (<?= count($replies) ?>)
                </h2>
            </div>

            <?php if (empty($replies)):
            ?>
                <div class="text-center py-6 bg-white rounded-lg shadow-md border border-gray-100">
                    <div class="w-8 h-8 mx-auto mb-2 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 flex items-center justify-center avatar-small">
                        <i data-feather="message-square" class="w-4 h-4 text-blue-500"></i>
                    </div>
                    <p class="text-gray-500 font-medium text-sm">Belum ada balasan</p>
                    <p class="text-xs text-gray-400 mt-0.5">Jadilah yang pertama memberikan balasan!</p>
                </div>
            <?php else:
            ?>
                <div class="space-y-3">
                    <?php foreach ($replies as $reply):
                    ?>
                        <div id="reply-<?= $reply->id ?>" class="bg-white rounded-lg shadow-md border border-gray-100 p-4 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 reply-card">
                            <div class="flex items-start space-x-3">
                                <!-- User Avatar -->
                                <div class="flex-shrink-0">
                                    <div class="w-6 h-6 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center shadow-sm avatar-small">
                                        <i data-feather="user" class="w-3 h-3 text-white"></i>
                                    </div>
                                </div>

                                <!-- Reply Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center space-x-2">
                                            <h4 class="text-xs font-semibold text-gray-900">
                                                <?= html_escape($reply->author_name) ?>
                                            </h4>
                                            <span class="text-xs text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded-md">
                                                <?= date('d M Y, H:i', strtotime($reply->created_at)) ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="text-gray-700 leading-relaxed mb-3 text-sm">
                                        <?= nl2br(html_escape($reply->content)) ?>
                                    </div>

                                    <!-- Reply Actions -->
                                    <div class="flex items-center space-x-3">
                                        <button class="flex items-center justify-center w-8 h-8 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200 group">
                                            <i data-feather="thumbs-up" class="w-4 h-4 group-hover:scale-110 transition-transform duration-200"></i>
                                        </button>
                                        <button class="flex items-center justify-center w-8 h-8 rounded-lg text-gray-600 hover:text-green-600 hover:bg-green-50 transition-all duration-200 group">
                                            <i data-feather="message-square" class="w-4 h-4 group-hover:scale-110 transition-transform duration-200"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Reply Form -->
        <div class="bg-white rounded-lg shadow-lg border border-gray-100 p-4 sticky bottom-4 backdrop-blur-md bg-white/95">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-6 h-6 rounded-full bg-gradient-to-r from-green-500 to-blue-500 flex items-center justify-center shadow-sm avatar-small">
                        <i data-feather="user" class="w-3 h-3 text-white"></i>
                    </div>
                </div>

                <div class="flex-1">
                    <form action="<?= site_url('student_mobile/forum/reply/' . $thread->id) ?>" method="post">
                        <div class="mb-3">
                            <textarea
                                name="content"
                                rows="2"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none transition-all duration-200 bg-gray-50 focus:bg-white text-sm"
                                placeholder="Tulis balasan Anda..."
                                required
                            ></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-lg hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg text-sm"
                            >
                                <i data-feather="send" class="w-3.5 h-3.5 inline mr-1.5"></i>
                                Kirim Balasan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    .hover\:shadow-xl:hover {
        box-shadow: 0 15px 35px -8px rgba(0, 0, 0, 0.12);
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

        .space-x-4 > * + * {
            margin-left: 1rem;
        }
    }

    /* Touch-friendly button sizes - updated for smaller avatars */
    button {
        min-height: 32px;
        min-width: 32px;
    }

    /* Optimized avatar sizes for mobile - updated for smaller avatars */
    .avatar-small {
        min-width: 20px;
        min-height: 20px;
    }

    /* Ensure reply cards have adequate touch targets */
    .reply-card {
        min-height: 60px;
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Feather Icons
        feather.replace();

        // Handle anchor links for replies with mobile optimization
        if (window.location.hash) {
            const hash = window.location.hash;
            const element = document.querySelector(hash);
            if (element) {
                // Mobile-optimized delay
                setTimeout(() => {
                    element.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center',
                        inline: 'nearest'
                    });
                    // Shorter highlight for mobile
                    element.style.boxShadow = '0 0 0 2px rgba(59, 130, 246, 0.4)';
                    setTimeout(() => {
                        element.style.boxShadow = '';
                    }, 1500);
                }, 300);
            }
        }

        // Add smooth scrolling to reply form with mobile optimization
        const replyButtons = document.querySelectorAll('button[title="Balas"]');
        const replyForm = document.querySelector('form[action*="/reply/"]');

        replyButtons.forEach(button => {
            button.addEventListener('click', function() {
                replyForm.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                // Focus after scroll for mobile
                setTimeout(() => {
                    replyForm.querySelector('textarea').focus();
                }, 300);
            });
        });

        // Add loading animation to submit button with mobile optimization
        const submitButton = document.querySelector('button[type="submit"]');
        const form = document.querySelector('form[action*="/reply/"]');

        form.addEventListener('submit', function() {
            submitButton.innerHTML = '<i data-feather="loader" class="w-3 h-3 inline mr-1 animate-spin"></i> <span class="text-xs">Mengirim...</span>';
            submitButton.disabled = true;
            feather.replace();
        });

        // Enhanced reply interactions optimized for touch
        const replyCards = document.querySelectorAll('.bg-white.rounded-lg.shadow-md');
        replyCards.forEach(card => {
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
