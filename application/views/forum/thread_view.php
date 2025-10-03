<?php $this->load->view('forum/viewers_modal'); ?>

<?php
// Load comment partial for modular rendering BEFORE using the function
$this->load->view('forum/partials/comment');
?>

<!-- Load modular CSS and JS -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/forum-thread.css'); ?>">
<script src="<?php echo base_url('assets/js/forum-thread.js'); ?>"></script>

<div class="forum-thread-container">
    <div class="forum-thread-wrapper">
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
        <div class="thread-card mb-8">
            <!-- Thread Header (Modernized) -->
            <div class="thread-header">
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
                                <?php 
                                // Get user role for thread creator
                                $creator_role = 'User';
                                $creator_role_class = 'bg-gray-100 text-gray-800';
                                if (isset($thread->user_role)) {
                                    switch ($thread->user_role) {
                                        case 'super_admin':
                                            $creator_role = 'Super Admin';
                                            $creator_role_class = 'bg-red-100 text-red-800';
                                            break;
                                        case 'admin':
                                            $creator_role = 'Admin';
                                            $creator_role_class = 'bg-blue-100 text-blue-800';
                                            break;
                                        case 'guru':
                                            $creator_role = 'Guru';
                                            $creator_role_class = 'bg-green-100 text-green-800';
                                            break;
                                        case 'siswa':
                                            $creator_role = 'Siswa';
                                            $creator_role_class = 'bg-purple-100 text-purple-800';
                                            break;
                                        default:
                                            $creator_role = 'User';
                                            $creator_role_class = 'bg-gray-100 text-gray-800';
                                    }
                                }
                                ?>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold <?php echo $creator_role_class; ?>"><?php echo $creator_role; ?></span>
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
            <div class="thread-content">
                <h1 class="thread-title"><?= html_escape($thread->title); ?></h1>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <div class="thread-body">
                        <?= $thread->content; ?>
                    </div>
                </div>
                
                <!-- Thread Actions (Modernized) -->
                <div class="thread-actions">
                    <div class="action-buttons">
                        <button type="button" class="action-button">
                            <i class="far fa-comment-alt text-blue-500"></i>
                            <span>Komentar</span>
                        </button>
                        <button type="button" id="open-viewers-modal" class="action-button" data-thread-id="<?= $thread->id; ?>">
                            <i class="far fa-eye text-gray-500"></i>
                            <span><?= $view_count; ?> Dilihat</span>
                        </button>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200">
                            <i class="far fa-bookmark mr-2"></i> Simpan
                        </button>
                        <button type="button" onclick="document.getElementById('reply-form-main').scrollIntoView({ behavior: 'smooth' });" class="reply-button">
                            <i class="far fa-comment-dots mr-2"></i> Balas Diskusi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comments Section (Enhanced) -->
        <div class="comments-section mb-8">
            <div class="comments-header">
                <h2 class="comments-title">
                    <i class="far fa-comments mr-3 text-indigo-600"></i>
                    <span>Diskusi (<?= $post_count; ?>)</span>
                </h2>
            </div>
            
            <!-- Comments List -->
            <div class="comments-list">
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
                <div class="load-more-section">
                    <button id="load-more-comments" class="load-more-button" data-offset="<?= count($posts); ?>">
                        <i class="fas fa-chevron-down"></i>
                        <span>Muat Lebih Banyak Komentar</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <!-- Main Reply Form (Simplified) -->
        <div id="reply-form-main" class="reply-form-container">
            <?= form_open('forum/create_post/' . $thread->id, ['class' => 'reply-form']); ?>
                <div class="user-avatar">
                    <div class="avatar-small">
                        <?= strtoupper(substr(($this->session->userdata('nama_lengkap') ?? 'U'), 0, 1)); ?>
                    </div>
                </div>
                <div class="form-content">
                    <div class="form-group">
                        <div class="editor-container">
                            <div id="quill-main" class="editor-wrapper"></div>
                        </div>
                        <input type="hidden" name="content" id="content-main-hidden" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="submit-button">
                            <i class="far fa-paper-plane mr-2"></i>
                            Kirim Komentar
                        </button>
                    </div>
                </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
