<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">
    <div class="container mx-auto px-3 py-4 max-w-4xl">
        <!-- Back Button (Enhanced) -->
        <div class="mb-4">
            <a href="<?= site_url('student_mobile/forum') ?>" class="inline-flex items-center px-3 py-2 text-indigo-600 hover:text-indigo-700 bg-white rounded-full shadow-sm hover:shadow-md transition-all duration-300 text-sm font-medium border border-indigo-100">
                <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                <span>Kembali ke Forum</span>
            </a>
        </div>

        <!-- Flash Messages (Modernized) -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-4 text-sm shadow-sm" role="alert">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i data-feather="check-circle" class="w-4 h-4 mr-2 text-green-500"></i>
                    </div>
                    <span class="font-medium"><?= html_escape($this->session->flashdata('success')) ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-4 text-sm shadow-sm" role="alert">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i data-feather="alert-circle" class="w-4 h-4 mr-2 text-red-500"></i>
                    </div>
                    <span class="font-medium"><?= html_escape($this->session->flashdata('error')) ?></span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Thread Header (Enhanced) -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6 mb-6 hover:shadow-xl transition-all duration-500">
            <!-- Category and Pin Badges (Improved) -->
            <div class="flex items-center flex-wrap gap-2 mb-4">
                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg">
                    <i data-feather="tag" class="w-3 h-3 mr-1.5"></i>
                    <?= html_escape($thread->category_name) ?>
                </span>
                <?php if ($thread->is_pinned): ?>
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-lg animate-pulse">
                        <i data-feather="pin" class="w-3 h-3 mr-1.5"></i>
                        Disematkan
                    </span>
                <?php endif; ?>
            </div>

            <!-- Thread Title (Typography Enhanced) -->
            <h1 class="text-2xl font-bold text-gray-900 mb-4 leading-tight tracking-tight">
                <?= html_escape($thread->title) ?>
            </h1>

            <!-- Thread Meta Information (Modern Cards) -->
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                <div class="flex items-center bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl px-3 py-2 border border-indigo-100">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center mr-2 shadow-md">
                        <i data-feather="user" class="w-4 h-4 text-white"></i>
                    </div>
                    <span class="font-semibold text-gray-800"><?= html_escape($thread->nama_lengkap) ?></span>
                </div>

                <div class="flex items-center bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl px-3 py-2 border border-gray-200">
                    <i data-feather="clock" class="w-4 h-4 mr-2 text-gray-500"></i>
                    <span class="font-medium"><?= timespan(strtotime($thread->created_at), time()) ?></span>
                </div>

                <div class="flex items-center bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl px-3 py-2 border border-gray-200">
                    <i data-feather="eye" class="w-4 h-4 mr-2 text-gray-500"></i>
                    <span class="font-medium"><?= number_format($thread->views) ?>x dilihat</span>
                </div>
            </div>
        </div>

        <!-- Thread Content (Enhanced Prose) -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6 mb-8 hover:shadow-xl transition-all duration-500">
            <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
                <div class="text-base leading-7 mb-0">
                    <?= nl2br(html_escape($thread->content)) ?>
                </div>
            </div>

            <!-- Thread Actions (Modernized) -->
            <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200/50">
                <div class="flex items-center space-x-4">
                    <button class="flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-indigo-50 to-purple-50 text-indigo-700 font-semibold shadow-sm hover:from-indigo-100 hover:to-purple-100 transition-all duration-300 group">
                        <i data-feather="message-square" class="w-4 h-4 group-hover:scale-110 transition-transform duration-200"></i>
                        <span class="text-sm"><?= $thread->post_count ?> balasan</span>
                    </button>
                </div>

                <div class="flex items-center space-x-3">
                    <button class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100 text-gray-600 hover:from-indigo-50 hover:to-purple-50 hover:text-indigo-600 transition-all duration-300 group shadow-sm hover:shadow-md" onclick="shareThread()">
                        <i data-feather="share-2" class="w-5 h-5 group-hover:scale-110 transition-transform duration-200"></i>
                    </button>
                    <button
                        class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100 text-gray-600 hover:from-red-50 hover:to-rose-50 hover:text-red-500 transition-all duration-300 group like-button shadow-sm hover:shadow-md relative"
                        data-thread-id="<?= $thread->id ?>"
                        data-liked="<?= isset($thread->user_has_liked) && $thread->user_has_liked ? 'true' : 'false' ?>"
                        onclick="toggleLike(this)"
                    >
                        <i data-feather="heart" class="w-5 h-5 group-hover:scale-110 transition-transform duration-200"></i>
                        <?php if ($thread->user_has_liked): ?>
                            <div class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-lg">♥</div>
                        <?php endif; ?>
                    </button>
                    <span class="text-sm font-semibold text-gray-700 like-count bg-white px-2 py-1 rounded-full shadow-sm"><?= $thread->like_count > 0 ? number_format($thread->like_count) : 'Suka' ?></span>
                </div>
            </div>
        </div>

        <!-- Replies Section (Enhanced) -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i data-feather="message-circle" class="w-5 h-5 mr-2 text-indigo-600"></i>
                    <span>Diskusi (<?= count($replies) ?>)</span>
                </h2>
                <?php if (count($replies) > 5): ?>
                    <button class="text-xs text-indigo-600 hover:text-indigo-700 font-medium" onclick="scrollToReplies()">Lihat Semua</button>
                <?php endif; ?>
            </div>

            <?php if (empty($replies)): ?>
                <div class="text-center py-12 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl shadow-lg border border-indigo-100">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-r from-indigo-100 to-purple-100 flex items-center justify-center shadow-md">
                        <i data-feather="message-square" class="w-8 h-8 text-indigo-500"></i>
                    </div>
                    <p class="text-gray-700 font-semibold text-lg mb-1">Belum ada diskusi</p>
                    <p class="text-gray-500 text-sm">Jadilah yang pertama berbagi pemikiran Anda!</p>
                </div>
            <?php else: ?>
                <div class="space-y-5">
                    <?php foreach ($replies as $reply):
                        // Check if this is a top-level post or a reply
                        $is_top_level = $reply->parent_id == 0;
                        $replies_html = '';
                        
                        if (isset($reply->replies) && !empty($reply->replies)):
                            foreach ($reply->replies as $sub_reply):
                                $replies_html .= '
                                <div class="flex items-start space-x-4 mt-4 ml-8 pl-4 border-l-2 border-indigo-200">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gradient-to-r from-emerald-500 to-teal-600 flex items-center justify-center shadow-sm mt-1">
                                        <i data-feather="user" class="w-4 h-4 text-white"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center space-x-3 mb-2">
                                            <h5 class="text-sm font-semibold text-gray-800">
                                                ' . html_escape($sub_reply->author_name) . '
                                            </h5>
                                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">
                                                ' . timespan(strtotime($sub_reply->created_at), time()) . '
                                            </span>
                                        </div>
                                        <div class="text-gray-700 text-sm leading-relaxed bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-3 border border-gray-200">
                                            ' . nl2br(html_escape($sub_reply->content)) . '
                                        </div>
                                        <div class="flex items-center space-x-3 mt-2 text-xs text-gray-500">
                                            <button class="flex items-center space-x-1 px-2 py-1 rounded-lg hover:bg-gray-200 transition-colors">
                                                <i data-feather="thumbs-up" class="w-3 h-3"></i>
                                                <span>Suka</span>
                                            </button>
                                            <button class="flex items-center space-x-1 px-2 py-1 rounded-lg hover:bg-gray-200 transition-colors">
                                                <i data-feather="reply" class="w-3 h-3"></i>
                                                <span>Balas</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>';
                            endforeach;
                        endif;
                        
                        if ($is_top_level):
                    ?>
                        <div id="reply-<?= $reply->id ?>" class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6 hover:shadow-2xl transition-all duration-500 hover:-translate-y-1 reply-card">
                            <div class="flex items-start space-x-4">
                                <!-- User Avatar (Enhanced) -->
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg relative">
                                        <i data-feather="user" class="w-6 h-6 text-white"></i>
                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-md">✓</div>
                                    </div>
                                </div>

                                <!-- Reply Content (Enhanced) -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-3">
                                            <h4 class="text-base font-bold text-gray-900 tracking-tight">
                                                <?= html_escape($reply->author_name) ?>
                                            </h4>
                                            <span class="text-sm text-gray-500 bg-gradient-to-r from-gray-100 to-gray-200 px-3 py-1 rounded-full font-medium">
                                                <?= timespan(strtotime($reply->created_at), time()) ?>
                                            </span>
                                        </div>
                                        <div class="flex items-center space-x-2 text-xs text-gray-400">
                                            <button class="p-1 hover:bg-gray-200 rounded-full transition-colors">
                                                <i data-feather="more-vertical" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="text-gray-800 leading-relaxed mb-4 text-base prose prose-indigo max-w-none">
                                        <?= nl2br(html_escape($reply->content)) ?>
                                    </div>

                                    <!-- Reply Actions (Enhanced) -->
                                    <div class="flex items-center space-x-4 text-sm">
                                        <button class="flex items-center space-x-2 px-4 py-2 rounded-xl bg-gradient-to-r from-indigo-50 to-purple-50 text-indigo-700 font-medium hover:from-indigo-100 hover:to-purple-100 transition-all duration-300 group shadow-sm">
                                            <i data-feather="thumbs-up" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                            <span>Suka</span>
                                        </button>
                                        <button class="flex items-center space-x-2 px-4 py-2 rounded-xl bg-gradient-to-r from-emerald-50 to-teal-50 text-emerald-700 font-medium hover:from-emerald-100 hover:to-teal-100 transition-all duration-300 group shadow-sm">
                                            <i data-feather="message-square" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                            <span>Balas</span>
                                        </button>
                                        <button class="flex items-center space-x-1 px-3 py-2 text-xs text-gray-500 hover:text-gray-700 rounded-lg transition-colors">
                                            <i data-feather="share-2" class="w-3 h-3"></i>
                                            <span>Bagikan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Nested replies (Enhanced) -->
                            <?php if (!empty($replies_html)): ?>
                                <div class="mt-6 ml-16 border-l-4 border-indigo-200 pl-6 bg-gradient-to-r from-indigo-50/50 to-purple-50/50 rounded-2xl p-4">
                                    <?php echo $replies_html; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php
                        endif;
                    endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Reply Form (Modernized) -->
        <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl border border-white/30 p-5 sticky bottom-4 z-10">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-r from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg">
                        <i data-feather="edit-3" class="w-5 h-5 text-white"></i>
                    </div>
                </div>

                <div class="flex-1">
                    <form action="<?= site_url('student_mobile/forum/reply/' . encrypt_url($thread->id)) ?>" method="post" class="space-y-3">
                        <div>
                            <textarea
                                name="content"
                                rows="3"
                                class="w-full px-4 py-3 border-0 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:outline-none resize-none transition-all duration-300 bg-gradient-to-br from-gray-50 to-gray-100 text-base placeholder-gray-500 shadow-inner"
                                placeholder="Bagikan pemikiran Anda... (Gunakan @ untuk mention, # untuk hashtag)"
                                required
                            ></textarea>
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <button type="button" class="p-2 hover:bg-gray-200 rounded-xl transition-colors">
                                    <i data-feather="image" class="w-5 h-5"></i>
                                </button>
                                <button type="button" class="p-2 hover:bg-gray-200 rounded-xl transition-colors">
                                    <i data-feather="link" class="w-5 h-5"></i>
                                </button>
                            </div>
                            <button
                                type="submit"
                                class="group flex items-center space-x-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl text-sm"
                            >
                                <i data-feather="send" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                <span>Kirim Balasan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Modern Styles and Animations -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    * {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        scroll-behavior: smooth;
    }
    
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }
    
    .prose {
        color: #374151;
    }
    
    .prose h1, .prose h2, .prose h3, .prose h4 {
        color: #1f2937;
        font-weight: 700;
    }
    
    .prose p {
        margin-bottom: 1rem;
        line-height: 1.7;
        color: #4b5563;
    }
    
    /* Enhanced Scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }
    
    ::-webkit-scrollbar-track {
        background: rgba(248, 250, 252, 0.5);
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg, #6366f1, #a855f7);
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(45deg, #4f46e5, #9333ea);
    }
    
    /* Glassmorphism Effects */
    .glass {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }
    
    /* Enhanced Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
    }
    
    .float-animation {
        animation: float 3s ease-in-out infinite;
    }
    
    /* Reply Card Enhancements */
    .reply-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .reply-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #6366f1, #a855f7);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .reply-card:hover::before {
        transform: scaleX(1);
    }
    
    /* Button Enhancements */
    button {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    button:hover::before {
        left: 100%;
    }
    
    /* Form Enhancements */
    textarea {
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    textarea:focus {
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        transform: translateY(-1px);
    }
    
    /* Mobile Optimizations */
    @media (max-width: 640px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .space-y-5 > * + * {
            margin-top: 1.25rem;
        }
        
        h1 {
            font-size: 1.5rem;
        }
        
        .reply-card {
            padding: 1.5rem;
        }
    }
    
    /* Dark mode support (optional) */
    @media (prefers-color-scheme: dark) {
        body {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: #f1f5f9;
        }
        
        .glass {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(148, 163, 184, 0.2);
            color: #f1f5f9;
        }
        
        .prose {
            color: #e2e8f0;
        }
    }
    
    /* Loading states */
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Feather Icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }

        // Enhanced smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Auto-focus textarea on load
        const textarea = document.querySelector('textarea[name="content"]');
        if (textarea) {
            textarea.addEventListener('focus', function() {
                this.parentElement.parentElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'end'
                });
            });
            
            // Auto-resize textarea
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        }

        // Enhanced form submission with loading
        const form = document.querySelector('form[action*="/reply/"]');
        const submitButton = document.querySelector('button[type="submit"]');
        
        if (form && submitButton) {
            form.addEventListener('submit', function(e) {
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <div class="flex items-center space-x-2">
                        <i data-feather="loader" class="w-4 h-4 animate-spin"></i>
                        <span class="text-sm">Mengirim...</span>
                    </div>
                `;
                feather.replace();
                
                // Re-enable after 5 seconds as fallback
                setTimeout(() => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = `
                        <i data-feather="send" class="w-4 h-4"></i>
                        <span>Kirim Balasan</span>
                    `;
                    feather.replace();
                }, 5000);
            });
        }

        // Enhanced like functionality with animation
        window.toggleLike = function(button) {
            const threadId = button.dataset.threadId;
            const isLiked = button.dataset.liked === 'true';
            const icon = button.querySelector('i');
            const countSpan = document.querySelector('.like-count');
            
            // Animation for like button
            button.style.transform = 'scale(0.95)';
            setTimeout(() => {
                button.style.transform = 'scale(1)';
            }, 150);
            
            // Show loading
            icon.classList.add('animate-pulse');
            
            fetch(`<?= site_url('student_mobile/forum/toggle_like/' . $thread->id) ?>`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ thread_id: threadId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.dataset.liked = (!isLiked).toString();
                    
                    // Heart animation
                    if (!isLiked) {
                        icon.setAttribute('data-feather', 'heart');
                        button.classList.add('bg-red-50', 'text-red-500', 'ring-2', 'ring-red-200');
                        button.style.transform = 'scale(1.1)';
                        setTimeout(() => {
                            button.style.transform = 'scale(1)';
                        }, 200);
                        
                        // Particles effect (simple)
                        createHeartParticles(button);
                    } else {
                        icon.setAttribute('data-feather', 'heart');
                        button.classList.remove('bg-red-50', 'text-red-500', 'ring-2', 'ring-red-200');
                    }
                    
                    // Update count with animation
                    if (countSpan) {
                        const currentCount = parseInt(countSpan.textContent.replace(/\D/g, '')) || 0;
                        const newCount = isLiked ? currentCount - 1 : currentCount + 1;
                        countSpan.style.transform = 'scale(1.2)';
                        countSpan.innerHTML = newCount > 0 ? `<i data-feather="heart" class="w-3 h-3 inline text-red-500 mr-1"></i>${newCount}` : 'Suka';
                        setTimeout(() => {
                            countSpan.style.transform = 'scale(1)';
                        }, 200);
                        feather.replace();
                    }
                }
                feather.replace();
                icon.classList.remove('animate-pulse');
            })
            .catch(error => {
                console.error('Error toggling like:', error);
                icon.classList.remove('animate-pulse');
                button.style.transform = 'scale(1)';
            });
        };

        // Simple heart particles
        function createHeartParticles(element) {
            for (let i = 0; i < 5; i++) {
                const particle = document.createElement('div');
                particle.innerHTML = '♥';
                particle.style.cssText = `
                    position: fixed;
                    font-size: 20px;
                    color: #ef4444;
                    pointer-events: none;
                    z-index: 1000;
                    left: ${element.offsetLeft + element.offsetWidth/2}px;
                    top: ${element.offsetTop}px;
                    animation: heartFloat 0.6s ease-out forwards;
                    opacity: 0;
                `;
                document.body.appendChild(particle);
                
                setTimeout(() => {
                    particle.style.opacity = '1';
                    particle.style.transform = `translate(${Math.random()*50 - 25}px, ${Math.random()*-50}px) rotate(${Math.random()*360}deg) scale(0.5)`;
                }, 10);
                
                setTimeout(() => {
                    document.body.removeChild(particle);
                }, 600);
            }
        }

        // Enhanced share functionality
        window.shareThread = function() {
            const threadUrl = window.location.href;
            const threadTitle = '<?= html_escape($thread->title) ?>';
            
            if (navigator.share) {
                navigator.share({
                    title: threadTitle,
                    text: 'Diskusi menarik di forum Aset Academy!',
                    url: threadUrl
                }).catch(console.error);
            } else if (navigator.clipboard) {
                navigator.clipboard.writeText(threadUrl).then(() => {
                    showToast('Link disalin ke clipboard!', 'success');
                }).catch(() => {
                    showToast('Gagal menyalin link', 'error');
                });
            } else {
                // Fallback prompt
                prompt('Salin link ini:', threadUrl);
            }
        };

        // Toast notifications
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 z-50 p-4 rounded-xl shadow-lg transform translate-x-full transition-transform duration-300 text-white text-sm font-medium ${
                type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-indigo-500'
            }`;
            toast.textContent = message;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 100);
            
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe reply cards
        document.querySelectorAll('.reply-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });

        // Enhanced mobile optimizations
        function optimizeForMobile() {
            // Add dynamic viewport adjustments
            let vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        }

        optimizeForMobile();
        window.addEventListener('resize', optimizeForMobile);
        window.addEventListener('orientationchange', () => {
            setTimeout(optimizeForMobile, 500);
        });

        // Prevent body scroll when modal is open (if any)
        document.addEventListener('touchmove', function(e) {
            if (document.querySelector('.modal-open')) {
                e.preventDefault();
            }
        }, { passive: false });

        // PWA install prompt (if applicable)
        let deferredPrompt;
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
        });
    });
</script>
