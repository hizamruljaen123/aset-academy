<?php $this->load->view('forum/viewers_modal'); ?>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <!-- Enhanced Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2 md:space-x-4 bg-white/80 backdrop-blur-sm rounded-xl p-3 shadow-sm border border-white/20">
                <li class="inline-flex items-center">
                    <a href="<?php echo site_url('forum'); ?>" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors duration-300">
                        <i class="fas fa-home mr-2 text-indigo-500"></i>
                        Forum
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-sm mx-2"></i>
                        <span class="text-sm font-semibold text-gray-700 bg-gradient-to-r from-indigo-100 to-purple-100 px-3 py-1 rounded-full"><?= html_escape($thread->title); ?></span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Main Thread (Enhanced Glassmorphism) -->
        <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-xl overflow-hidden mb-8 border border-white/20">
            <!-- Thread Header (Modernized) -->
            <div class="px-8 py-6 border-b border-gray-200/50">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0 relative">
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center font-bold text-xl text-white shadow-lg">
                                <?= strtoupper(substr(($thread->nama_lengkap ?? 'U'), 0, 1)); ?>
                            </div>
                            <?php if ($thread->is_pinned): ?>
                                <div class="absolute -top-2 -right-2 w-6 h-6 bg-amber-500 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-md animate-bounce">📌</div>
                            <?php endif; ?>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="text-lg font-bold text-gray-900 truncate"><?= html_escape($thread->nama_lengkap ?? 'User Tidak Dikenal'); ?></h3>
                            <div class="flex items-center space-x-4 text-sm text-gray-600 mt-1">
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-1.5 text-indigo-500"></i>
                                    <time datetime="<?= $thread->created_at; ?>"><?= timespan(strtotime($thread->created_at), time()) . ' yang lalu'; ?></time>
                                </div>
                                <?php if ($thread->is_pinned): ?>
                                    <div class="flex items-center text-amber-600 font-medium">
                                        <i class="fas fa-thumbtack mr-1"></i>
                                        Disematkan
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($this->session->userdata('user_id') == $thread->user_id || $this->session->userdata('level') == '1'): ?>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="p-2 rounded-xl text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200">
                                <i class="fas fa-ellipsis-v text-lg"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-56 rounded-2xl shadow-2xl bg-white ring-1 ring-black/5 z-20 overflow-hidden">
                                <div class="py-1">
                                    <?php if ($this->session->userdata('level') == '1'): ?>
                                        <a href="<?= site_url('forum/toggle_pin/' . $thread->id); ?>" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors duration-200 block w-full text-left">
                                            <i class="fas fa-thumbtack mr-3 text-indigo-500"></i>
                                            <?= $thread->is_pinned ? 'Lepas Sematan' : 'Sematkan'; ?>
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?= site_url('forum/edit_thread/' . $thread->id); ?>" class="flex items-center px-4 py-3 text-sm text-blue-600 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200 block w-full text-left">
                                        <i class="fas fa-edit mr-3"></i> Edit
                                    </a>
                                    <a href="<?= site_url('forum/delete_thread/' . $thread->id); ?>" class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors duration-200 block w-full text-left" onclick="return confirm('Apakah Anda yakin ingin menghapus topik ini?');">
                                        <i class="fas fa-trash-alt mr-3"></i> Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Thread Content (Enhanced) -->
            <div class="px-8 py-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-6 leading-tight tracking-tight"><?= html_escape($thread->title); ?></h1>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <div class="bg-gradient-to-r from-gray-50 to-indigo-50 rounded-2xl p-6 border border-gray-200/50">
                        <?= $thread->content; ?>
                    </div>
                </div>
                
                <!-- Thread Actions (Modernized) -->
                <div class="mt-8 pt-6 border-t border-gray-200/50 flex items-center justify-between">
                    <div class="flex space-x-6">
                        <button type="button" class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-indigo-50 to-purple-50 text-indigo-700 rounded-xl font-medium shadow-sm hover:from-indigo-100 hover:to-purple-100 transition-all duration-300 group">
                            <i class="far fa-thumbs-up text-indigo-500 group-hover:scale-110 transition-transform"></i>
                            <span><?= $likes; ?> Suka</span>
                        </button>
                        <button type="button" id="open-comments-modal" class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-cyan-50 text-blue-700 rounded-xl font-medium shadow-sm hover:from-blue-100 hover:to-cyan-100 transition-all duration-300 group">
                            <i class="far fa-comment-alt text-blue-500 group-hover:scale-110 transition-transform"></i>
                            <span><?= $post_count; ?> Komentar</span>
                        </button>
                        <button type="button" id="open-viewers-modal" class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-gray-50 to-gray-100 text-gray-700 rounded-xl font-medium shadow-sm hover:bg-gray-100 transition-all duration-300 group">
                            <i class="far fa-eye text-gray-500 group-hover:scale-110 transition-transform"></i>
                            <span><?= $view_count; ?> Dilihat</span>
                        </button>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200">
                            <i class="far fa-bookmark mr-2"></i> Simpan
                        </button>
                        <button type="button" onclick="document.getElementById('reply-form-main').scrollIntoView({ behavior: 'smooth' });" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all duration-300 transform hover:scale-105">
                            <i class="far fa-comment-dots mr-2"></i> Balas Diskusi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comments Section (Enhanced) -->
        <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-xl overflow-hidden mb-8 border border-white/20 p-4">
            <div class="px-8 py-6 border-b border-gray-200/50">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="far fa-comments mr-3 text-indigo-600"></i>
                    <span>Diskusi (<?= $post_count; ?>)</span>
                </h2>
            </div>
            
            <!-- Comments List -->
            <div id="comments-container" class="divide-y divide-gray-200/50">
                <?php if (!empty($posts)): ?>
                    <?php foreach($posts as $post): ?>
                        <?php echo render_comment($post, $thread, 0); ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="p-12 text-center bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl border border-indigo-200/50">
                        <i class="far fa-comment-slash text-6xl text-gray-300 mb-4 opacity-75"></i>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum ada diskusi</h3>
                        <p class="text-gray-500 text-lg">Jadilah yang pertama berkomentar dan memulai percakapan!</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Load More Comments Button (Enhanced) -->
            <?php if ($post_count > count($posts)): ?>
                <div class="px-8 py-6 border-t border-gray-200/50 text-center bg-gradient-to-r from-indigo-50 to-purple-50">
                    <button id="load-more-comments" class="inline-flex items-center space-x-2 px-6 py-3 bg-white text-indigo-600 font-semibold rounded-xl shadow-lg hover:shadow-xl hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all duration-300 transform hover:scale-105" data-offset="<?= count($posts); ?>">
                        <i class="fas fa-chevron-down"></i>
                        <span>Muat Lebih Banyak Komentar</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <!-- Show More Comments Link (Enhanced) -->
        <?php if ($post_count > 3): ?>
            <div class="text-center mt-6 p-4 bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20">
                <a href="#" id="show-more-comments" class="inline-flex items-center space-x-2 text-indigo-600 hover:text-indigo-700 font-semibold text-lg transition-colors duration-300">
                    <i class="fas fa-comments"></i>
                    <span>Tampilkan Semua Komentar</span>
                </a>
            </div>
        <?php endif; ?>

        <!-- Main Reply Form (Simplified) -->
        <div id="reply-form-main" class="mt-8 p-6 bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-white/20">
            <?= form_open('forum/create_post/' . $thread->id, ['class' => 'space-y-4']); ?>
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            <?= strtoupper(substr(($this->session->userdata('nama_lengkap') ?? 'U'), 0, 1)); ?>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-4">
                            <label for="content-main" class="block text-sm font-medium text-gray-700 mb-2">Komentar Anda</label>
                            <textarea id="content-main" name="content" rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 resize-vertical" placeholder="Tulis komentar Anda di sini..." required></textarea>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all duration-300 transform hover:scale-105">
                                <i class="far fa-paper-plane mr-2"></i>
                                Kirim Komentar
                            </button>
                        </div>
                    </div>
                </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<!-- Enhanced Comments Modal -->
<div id="comments-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4">
    <div class="bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl w-full max-w-4xl max-h-[95vh] flex flex-col overflow-hidden">
        <div class="flex justify-between items-center p-6 border-b border-gray-200/50 bg-gradient-to-r from-indigo-50 to-purple-50">
            <div class="flex items-center space-x-3">
                <i class="far fa-comments text-2xl text-indigo-600"></i>
                <h3 class="text-xl font-bold text-gray-900">Semua Diskusi</h3>
            </div>
            <button id="close-modal" class="p-2 rounded-xl text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="modal-comments-container" class="p-6 overflow-y-auto flex-1"></div>
        <div class="p-6 border-t border-gray-200/50 bg-white/50 text-center">
            <button id="load-more-comments" class="inline-flex items-center space-x-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-chevron-down"></i>
                <span>Tampilkan Lebih Banyak</span>
            </button>
        </div>
    </div>
</div>

<!-- Modern Styles and Scripts -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

* {
    font-family: 'Inter', sans-serif;
}

body {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
}

.prose {
    color: #475569;
    line-height: 1.7;
}

.prose h1, .prose h2, .prose h3 {
    color: #1e293b;
    font-weight: 700;
}

.prose p {
    margin-bottom: 1rem;
    color: #64748b;
}

/* Enhanced Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(248, 250, 252, 0.5);
    border-radius: 12px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(45deg, #6366f1, #a855f7);
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(45deg, #4f46e5, #9333ea);
}

/* Glassmorphism */
.glass {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.18);
}

/* Animations */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
}

.float-animation {
    animation: float 4s ease-in-out infinite;
}

@keyframes pulse-glow {
    0%, 100% { box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.4); }
    50% { box-shadow: 0 0 0 20px rgba(99, 102, 241, 0); }
}

/* Card Hover Effects */
.hover\:shadow-2xl:hover {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    transform: translateY(-4px);
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
    transition: left 0.6s;
}

button:hover::before {
    left: 100%;
}

/* Form Focus States */
input:focus, textarea:focus, .ql-editor:focus {
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    border-color: #6366f1;
    transform: translateY(-1px);
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }
    
    .prose {
        font-size: 0.95rem;
    }
    
    h1 {
        font-size: 2rem;
    }
}

/* Dark Mode */
@media (prefers-color-scheme: dark) {
    body {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: #f1f5f9;
    }
    
    .glass {
        background: rgba(15, 23, 42, 0.5);
        border: 1px solid rgba(148, 163, 184, 0.2);
        color: #f1f5f9;
    }
    
    .prose {
        color: #cbd5e1;
    }
    
    .prose h1, .prose h2, .prose h3 {
        color: #f8fafc;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced Viewers Modal
    const viewersModal = document.getElementById('viewers-modal');
    const openViewersModalBtn = document.getElementById('open-viewers-modal');
    const closeViewersModalBtn = document.getElementById('close-viewers-modal');

    if (openViewersModalBtn) {
        openViewersModalBtn.addEventListener('click', function() {
            fetch(`<?= site_url('forum/get_viewers/' . $thread->id); ?>`)
                .then(response => response.json())
                .then(data => {
                    const viewersList = document.getElementById('viewers-list');
                    viewersList.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach((viewer, index) => {
                            const viewerEl = document.createElement('div');
                            viewerEl.className = `flex items-center space-x-4 p-4 rounded-2xl ${index % 2 === 0 ? 'bg-indigo-50' : 'bg-purple-50'} transition-all duration-200 hover:shadow-md`;
                            viewerEl.innerHTML = `
                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                    ${viewer.nama_lengkap.charAt(0).toUpperCase()}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-semibold text-gray-900">${viewer.nama_lengkap}</div>
                                    <div class="text-sm text-gray-600">${new Date(viewer.viewed_at).toLocaleString('id-ID', {
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric',
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    })}</div>
                                </div>
                            `;
                            viewersList.appendChild(viewerEl);
                        });
                    } else {
                        viewersList.innerHTML = '<div class="text-center py-8 text-gray-500"><i class="far fa-eye-slash text-3xl mb-2 block"></i><p>Belum ada yang melihat thread ini.</p></div>';
                    }
                    viewersModal.classList.remove('hidden');
                    viewersModal.querySelector('.modal-content').classList.add('scale-100', 'opacity-100');
                });
        });
    }

    if (closeViewersModalBtn) {
        closeViewersModalBtn.addEventListener('click', function() {
            viewersModal.classList.add('hidden');
            viewersModal.querySelector('.modal-content').classList.remove('scale-100', 'opacity-100');
        });
    }

    if (viewersModal) {
        viewersModal.addEventListener('click', function(e) {
            if (e.target === viewersModal) {
                viewersModal.classList.add('hidden');
                viewersModal.querySelector('.modal-content').classList.remove('scale-100', 'opacity-100');
            }
        });
    }

    // AJAX Like Functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.like-btn')) {
            e.preventDefault();
            const btn = e.target.closest('.like-btn');
            const postId = btn.dataset.postId;
            const type = btn.dataset.type || 'post';
            const icon = btn.querySelector('i');
            const countSpan = btn.querySelector('.like-count');
            const currentCount = parseInt(countSpan.textContent) || 0;
            const isLiked = btn.classList.contains('liked');

            fetch(`<?= site_url('forum/like/') ?>${type}/${postId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.liked) {
                        btn.classList.add('liked');
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        countSpan.textContent = data.count;
                        btn.querySelector('.like-text').textContent = 'Unlike';
                    } else {
                        btn.classList.remove('liked');
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        countSpan.textContent = data.count;
                        btn.querySelector('.like-text').textContent = 'Suka';
                    }
                } else {
                    alert(data.message || 'Error liking post');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error liking post');
            });
        }
    });

    // Enhanced Comments Modal
    const openCommentsModalBtn = document.getElementById('open-comments-modal');
    const showMoreLink = document.getElementById('show-more-comments');
    const commentsModal = document.getElementById('comments-modal');
    const closeModalBtn = document.getElementById('close-modal');
    const modalCommentsContainer = document.getElementById('modal-comments-container');
    const loadMoreBtn = document.getElementById('load-more-comments');
    let modalOffset = 0;

    function openModal() {
        commentsModal.classList.remove('hidden');
        commentsModal.querySelector('.bg-white').classList.add('scale-100', 'opacity-100');
        modalOffset = 0;
        modalCommentsContainer.innerHTML = '<div class="text-center py-8 text-gray-500"><i class="fas fa-spinner fa-spin text-2xl mb-2 block"></i><p>Memuat komentar...</p></div>';
        loadComments();
    }

    function closeModal() {
        commentsModal.querySelector('.bg-white').classList.remove('scale-100', 'opacity-100');
        setTimeout(() => commentsModal.classList.add('hidden'), 300);
    }

    function loadComments() {
        fetch(`<?= site_url('forum/get_comments_ajax/' . $thread->id); ?>?offset=${modalOffset}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    data.forEach(post => {
                        const commentEl = document.createElement('div');
                        commentEl.className = 'flex items-start space-x-4 p-4 rounded-2xl mb-4 bg-white shadow-sm border border-gray-200/50';
                        commentEl.innerHTML = `
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                ${post.nama_lengkap.charAt(0).toUpperCase()}
                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-gray-900 mb-1">${post.nama_lengkap}</div>
                                <div class="text-sm prose max-w-none text-gray-700 leading-relaxed">${post.content}</div>
                                <div class="text-xs text-gray-500 mt-2">${new Date(post.created_at).toLocaleString('id-ID')}</div>
                            </div>
                        `;
                        modalCommentsContainer.appendChild(commentEl);
                    });
                    modalOffset += data.length;
                    loadMoreBtn.style.display = data.length < 10 ? 'none' : 'inline-flex';
                } else {
                    modalCommentsContainer.innerHTML = '<div class="text-center py-8 text-gray-500"><i class="far fa-comments text-3xl mb-2 block opacity-50"></i><p>Tidak ada komentar lagi.</p></div>';
                    loadMoreBtn.style.display = 'none';
                }
            }).catch(() => {
                modalCommentsContainer.innerHTML = '<div class="text-center py-8 text-red-500"><i class="fas fa-exclamation-triangle text-2xl mb-2 block"></i><p>Gagal memuat komentar. Coba lagi.</p></div>';
            });
    }

    if (openCommentsModalBtn) openCommentsModalBtn.addEventListener('click', openModal);
    if (showMoreLink) showMoreLink.addEventListener('click', (e) => { e.preventDefault(); openModal(); });
    if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
    if (loadMoreBtn) loadMoreBtn.addEventListener('click', loadComments);

    commentsModal.addEventListener('click', (e) => {
        if (e.target === commentsModal) closeModal();
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            const modals = document.querySelectorAll('.hidden');
            modals.forEach(modal => modal.classList.add('hidden'));
        }
    });
});
</script>

<?php
// Recursive function to render comments and replies
function render_comment($post, $thread, $depth = 0, $max_depth = 5) {
    if ($depth > $max_depth) return '';
    
    $ci =& get_instance();
    $user_id = $ci->session->userdata('user_id');
    $is_author = $post->user_id == $thread->user_id;
    $can_edit = $user_id == $post->user_id || $ci->session->userdata('level') == '1';
    $like_class = !empty($post->user_has_liked) && $post->user_has_liked == 1 ? 'liked' : '';
    $like_icon = !empty($post->user_has_liked) && $post->user_has_liked == 1 ? 'fas' : 'far';
    $like_text = !empty($post->user_has_liked) && $post->user_has_liked == 1 ? 'Unlike' : 'Suka';
    $like_count = !empty($post->like_count) ? $post->like_count : 0;
    
    // Simple list format without nesting
    $output = '<div class="p-6 bg-white/60 backdrop-blur-sm rounded-xl shadow-sm border border-gray-200/50 mb-4 transition-all duration-300 hover:shadow-md" id="post-' . $post->id . '">';
    $output .= '<div class="flex items-start space-x-4">';
    
    // Avatar
    $output .= '<div class="flex-shrink-0">';
    $output .= '<div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center font-bold text-white shadow-lg">';
    $output .= strtoupper(substr(($post->author_name ?? 'U'), 0, 1));
    $output .= '</div>';
    if ($is_author) {
        $output .= '<div class="absolute -bottom-1 -right-1 w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-md">👑</div>';
    }
    $output .= '</div>';
    
    // Content
    $output .= '<div class="flex-1 min-w-0">';
    
    // Header
    $output .= '<div class="flex items-center justify-between mb-3">';
    $output .= '<div class="flex items-center space-x-3">';
    $output .= '<h4 class="font-semibold text-gray-900">';
    $output .= html_escape($post->author_name ?? 'User Tidak Dikenal');
    if ($is_author) {
        $output .= '<span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800">Penulis</span>';
    }
    $output .= '</h4>';
    $output .= '<span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">';
    $output .= '<i class="fas fa-clock mr-1"></i>';
    $output .= timespan(strtotime($post->created_at ?? 'now'), time()) . ' yang lalu';
    $output .= '</span>';
    $output .= '</div>';
    
    // Edit/Delete menu
    if ($can_edit) {
        $output .= '<div class="relative" x-data="{ open: false }">';
        $output .= '<button @click="open = !open" class="p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200">';
        $output .= '<i class="fas fa-ellipsis-h"></i>';
        $output .= '</button>';
        $output .= '<div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-xl shadow-xl bg-white ring-1 ring-black/5 z-20 overflow-hidden">';
        $output .= '<div class="py-1">';
        $output .= '<a href="#" class="flex items-center px-4 py-3 text-sm text-blue-600 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200 block w-full text-left">';
        $output .= '<i class="fas fa-edit mr-3"></i> Edit';
        $output .= '</a>';
        $delete_url = site_url('forum/delete_post/' . $post->id . '/' . $thread->id);
        $output .= '<a href="' . $delete_url . '" class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors duration-200 block w-full text-left" onclick="return confirm(\'Apakah Anda yakin ingin menghapus komentar ini?\');">';
        $output .= '<i class="fas fa-trash-alt mr-3"></i> Hapus';
        $output .= '</a>';
        $output .= '</div></div></div>';
    }
    $output .= '</div>';
    
    // Content body
    $output .= '<div class="mb-4 text-gray-800 leading-relaxed prose prose-indigo max-w-none">';
    $output .= $post->content ?? '';
    $output .= '</div>';
    
    // Actions
    $output .= '<div class="flex items-center space-x-4 text-sm font-medium">';
    
    // Like button
    $output .= '<button type="button" class="like-btn inline-flex items-center space-x-2 px-3 py-2 text-indigo-600 hover:text-indigo-700 hover:bg-indigo-50 rounded-lg transition-all duration-300 group ' . $like_class . '" data-post-id="' . $post->id . '" data-type="post">';
    $output .= '<i class="' . $like_icon . ' fa-thumbs-up group-hover:scale-110 transition-transform"></i>';
    $output .= '<span class="like-count">' . $like_count . '</span>';
    $output .= '<span class="like-text">' . $like_text . '</span>';
    $output .= '</button>';
    
    // Reply link
    $reply_url = site_url('forum/reply/' . $post->id);
    $output .= '<a href="' . $reply_url . '" class="inline-flex items-center space-x-2 px-3 py-2 text-green-600 hover:text-green-700 hover:bg-green-50 rounded-lg transition-all duration-300 group">';
    $output .= '<i class="far fa-comment-dots group-hover:scale-110 transition-transform"></i>';
    $output .= '<span>Balas</span>';
    $output .= '</a>';
    
    $output .= '<button type="button" class="inline-flex items-center space-x-2 px-3 py-2 text-gray-500 hover:text-gray-700 rounded-lg transition-colors">';
    $output .= '<i class="fas fa-share mr-1"></i>';
    $output .= '<span>Bagikan</span>';
    $output .= '</button>';
    $output .= '</div>';
    
    $output .= '</div>'; // End flex-1
    $output .= '</div>'; // End flex
    $output .= '</div>'; // End post div
    
    // Render replies as separate comments
    if (isset($post->replies) && !empty($post->replies)) {
        foreach ($post->replies as $reply) {
            $output .= render_comment($reply, $thread, $depth + 1, $max_depth);
        }
    }
    
    return $output;
}
?>
