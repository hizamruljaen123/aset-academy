<?php $this->load->view('forum/viewers_modal'); ?>

<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="<?php echo site_url('forum'); ?>" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <i class="fas fa-home mr-2"></i>
                        Forum
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2"><?php echo $thread->title; ?></span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Main Thread -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
            <!-- Thread Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-start justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-medium text-lg">
                            <?php echo strtoupper(substr($thread->nama_lengkap, 0, 1)); ?>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900"><?php echo $thread->nama_lengkap; ?></div>
                            <div class="flex items-center text-sm text-gray-500">
                                <time datetime="<?php echo $thread->created_at; ?>">
                                    <?php echo timespan(strtotime($thread->created_at), time()) . ' yang lalu'; ?>
                                </time>
                                <?php if ($thread->is_pinned): ?>
                                    <span class="mx-2">•</span>
                                    <span class="text-yellow-600"><i class="fas fa-thumbtack"></i> Disematkan</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($this->session->userdata('user_id') == $thread->user_id || $this->session->userdata('level') == '1'): ?>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                <div class="py-1" role="menu" aria-orientation="vertical">
                                    <?php if ($this->session->userdata('level') == '1'): ?>
                                        <a href="<?php echo site_url('forum/toggle_pin/' . $thread->id); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                            <i class="fas fa-thumbtack mr-2"></i>
                                            <?php echo $thread->is_pinned ? 'Lepas Sematan' : 'Sematkan'; ?>
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?php echo site_url('forum/edit_thread/' . $thread->id); ?>" class="block px-4 py-2 text-sm text-blue-600 hover:bg-gray-100" role="menuitem">
                                        <i class="fas fa-edit mr-2"></i> Edit
                                    </a>
                                    <a href="<?php echo site_url('forum/delete_thread/' . $thread->id); ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100" role="menuitem" onclick="return confirm('Apakah Anda yakin ingin menghapus topik ini?');">
                                        <i class="fas fa-trash-alt mr-2"></i> Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Thread Content -->
            <div class="px-6 py-4">
                <h1 class="text-2xl font-bold text-gray-900 mb-4"><?php echo $thread->title; ?></h1>
                <div class="prose max-w-none text-gray-700">
                    <?php echo $thread->content; ?>
                </div>
                
                <!-- Thread Actions -->
                <div class="mt-6 pt-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="flex space-x-4">
                        <button type="button" class="inline-flex items-center text-gray-500 hover:text-blue-600">
                            <i class="far fa-thumbs-up mr-1"></i>
                            <span><?php echo $likes; ?> Suka</span>
                        </button>
                        <button type="button" id="open-comments-modal" class="inline-flex items-center text-gray-500 hover:text-blue-600">
                            <i class="far fa-comment-alt mr-1"></i>
                            <span><?php echo $post_count; ?> Komentar</span>
                        </button>
                        <button type="button" id="open-viewers-modal" class="inline-flex items-center text-gray-500 hover:text-blue-600">
                            <i class="far fa-eye mr-1"></i>
                            <span><?php echo $view_count; ?> Dilihat</span>
                        </button>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="button" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="far fa-bookmark mr-1"></i> Simpan
                        </button>
                        <button type="button" onclick="document.getElementById('reply-form-main').scrollIntoView({ behavior: 'smooth' });" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="far fa-comment-dots mr-1"></i> Balas
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">
                    <i class="far fa-comments mr-2"></i>
                    Diskusi (<?php echo $post_count; ?>)
                </h2>
            </div>
            
            <!-- Comments List -->
            <div id="comments-container" class="divide-y divide-gray-200">
                <?php if (!empty($posts)): ?>
                    <?php foreach($posts as $post): ?>
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-150" id="post-<?php echo $post->id; ?>">
                            <div class="flex">
                                <!-- Author Avatar -->
                                <div class="flex-shrink-0 mr-4">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-medium text-lg">
                                        <?php echo strtoupper(substr($post->nama_lengkap, 0, 1)); ?>
                                    </div>
                                </div>
                                
                                <!-- Comment Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">
                                                <?php echo $post->nama_lengkap; ?>
                                                <?php if ($post->user_id == $thread->user_id): ?>
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        Penulis
                                                    </span>
                                                <?php endif; ?>
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                <time datetime="<?php echo $post->created_at; ?>">
                                                    <?php echo timespan(strtotime($post->created_at), time()) . ' yang lalu'; ?>
                                                </time>
                                            </p>
                                        </div>
                                        <?php if ($this->session->userdata('user_id') == $post->user_id || $this->session->userdata('level') == '1'): ?>
                                            <div class="relative" x-data="{ open: false }">
                                                <button @click="open = !open" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                                    <div class="py-1" role="menu">
                                                        <a href="#" class="block px-4 py-2 text-sm text-blue-600 hover:bg-gray-100" role="menuitem">
                                                            <i class="fas fa-edit mr-2"></i> Edit
                                                        </a>
                                                        <a href="<?php echo site_url('forum/delete_post/' . $post->id . '/' . $thread->id); ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100" role="menuitem" onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?');">
                                                            <i class="fas fa-trash-alt mr-2"></i> Hapus
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="mt-2 text-sm text-gray-700 prose max-w-none">
                                        <?php echo $post->content; ?>
                                    </div>
                                    
                                    <div class="mt-3 flex items-center text-sm text-gray-500">
                                        <button type="button" class="inline-flex items-center mr-4 hover:text-blue-600">
                                            <i class="far fa-thumbs-up mr-1"></i>
                                            <span>Suka</span>
                                        </button>
                                        <button type="button" class="inline-flex items-center hover:text-blue-600" @click="document.getElementById('reply-to-<?php echo $post->id; ?>').classList.toggle('hidden'); document.getElementById('reply-to-<?php echo $post->id; ?>').scrollIntoView({ behavior: 'smooth' });">
                                            <i class="far fa-comment-dots mr-1"></i>
                                            <span>Balas</span>
                                        </button>
                                    </div>
                                    
                                    <!-- Nested Replies -->
                                    <?php if (isset($post->replies) && !empty($post->replies)): ?>
                                        <div class="mt-4 pl-4 border-l-2 border-gray-200 space-y-4">
                                            <?php foreach($post->replies as $reply): ?>
                                                <div class="pt-4 first:pt-0">
                                                    <div class="flex">
                                                        <div class="flex-shrink-0 mr-3">
                                                            <div class="h-8 w-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center text-sm font-medium">
                                                                <?php echo strtoupper(substr($reply->nama_lengkap, 0, 1)); ?>
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 bg-gray-50 rounded-lg p-3">
                                                            <div class="flex items-center justify-between">
                                                                <p class="text-sm font-medium text-gray-900">
                                                                    <?php echo $reply->nama_lengkap; ?>
                                                                    <?php if ($reply->user_id == $thread->user_id): ?>
                                                                        <span class="ml-1 text-xs text-blue-600">(Penulis)</span>
                                                                    <?php endif; ?>
                                                                </p>
                                                                <span class="text-xs text-gray-500">
                                                                    <?php echo timespan(strtotime($reply->created_at), time(), 1); ?> lalu
                                                                </span>
                                                            </div>
                                                            <div class="mt-1 text-sm text-gray-600">
                                                                <?php echo $reply->content; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Reply Form (Hidden by default) -->
                            <div id="reply-to-<?php echo $post->id; ?>" class="mt-4 pl-14 hidden">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="h-8 w-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm font-medium">
                                                <?php echo strtoupper(substr($this->session->userdata('nama_lengkap'), 0, 1)); ?>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <form action="<?php echo site_url('forum/create_post/' . $thread->id . '/' . $post->id); ?>" method="post">
                                                <div class="quill-editor-container">
                                                    <div id="editor-reply-<?php echo $post->id; ?>" style="min-height: 100px;"></div>
                                                    <input type="hidden" name="content" id="content-reply-<?php echo $post->id; ?>">
                                                </div>
                                                <div class="mt-3 flex justify-end space-x-2">
                                                    <button type="button" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="this.closest('div[id^="reply-to-"]').classList.add('hidden');">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                        Kirim Balasan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="p-8 text-center">
                        <i class="far fa-comment-slash text-4xl text-gray-300 mb-2"></i>
                        <p class="text-gray-500">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Load More Comments Button -->
            <?php if ($post_count > count($posts)): ?>
                <div class="px-6 py-4 border-t border-gray-200 text-center">
                    <button id="load-more-comments" class="text-blue-600 hover:text-blue-800 text-sm font-medium" data-offset="<?php echo count($posts); ?>">
                        Muat lebih banyak komentar
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <!-- Show More Comments Link -->
        <?php if ($post_count > 3): ?>
            <div class="text-center mt-4">
                <a href="#" id="show-more-comments" class="text-blue-500 hover:underline">Tampilkan komentar lain</a>
            </div>
        <?php endif; ?>

        <!-- Main Reply Form -->
        <div id="reply-form-main" class="mt-4 pt-4 border-t">
            <?php echo form_open('forum/create_post/' . $thread->id); ?>
                <div class="quill-editor-container">
                    <div id="editor-main" style="height: 100px;"></div>
                    <input type="hidden" name="content" id="content-main">
                </div>
                <div class="text-right mt-2">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Kirim</button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- Comments Modal -->
<div id="comments-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="font-bold text-lg">Semua Komentar</h3>
            <button id="close-modal" class="text-gray-500 hover:text-gray-800">&times;</button>
        </div>
        <div id="modal-comments-container" class="p-4 overflow-y-auto"></div>
        <div class="p-4 border-t text-center">
            <button id="load-more-comments" class="bg-blue-500 text-white px-4 py-2 rounded">Tampilkan lebih banyak</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Viewers Modal Logic
    const viewersModal = document.getElementById('viewers-modal');
    const openViewersModalBtn = document.getElementById('open-viewers-modal');
    const closeViewersModalBtn = document.getElementById('close-viewers-modal');
    const viewersList = document.getElementById('viewers-list');

    if (openViewersModalBtn) {
        openViewersModalBtn.addEventListener('click', function() {
            fetch(`<?php echo site_url('forum/get_viewers/' . $thread->id); ?>`)
                .then(response => response.json())
                .then(data => {
                    viewersList.innerHTML = ''; // Clear previous list
                    if (data.length > 0) {
                        data.forEach(viewer => {
                            const viewerEl = document.createElement('div');
                            viewerEl.className = 'flex items-center space-x-3 mb-3 p-2 rounded-lg hover:bg-gray-50';
                            viewerEl.innerHTML = `
                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold text-sm">
                                    ${viewer.nama_lengkap.charAt(0).toUpperCase()}
                                </div>
                                <div class="flex-1">
                                    <div class="font-medium text-gray-800">${viewer.nama_lengkap}</div>
                                    <div class="text-xs text-gray-500">Dilihat pada ${new Date(viewer.viewed_at).toLocaleString('id-ID')}</div>
                                </div>
                            `;
                            viewersList.appendChild(viewerEl);
                        });
                    } else {
                        viewersList.innerHTML = '<p class="text-gray-500 text-center">Belum ada yang melihat thread ini.</p>';
                    }
                    viewersModal.classList.remove('hidden');
                });
        });
    }

    if (closeViewersModalBtn) {
        closeViewersModalBtn.addEventListener('click', function() {
            viewersModal.classList.add('hidden');
        });
    }

    if (viewersModal) {
        viewersModal.addEventListener('click', function(e) {
            if (e.target === viewersModal) {
                viewersModal.classList.add('hidden');
            }
        });
    }

    // Comments Modal and Quill Editor Logic
    const openCommentsModalBtn = document.getElementById('open-comments-modal');
    if (openCommentsModalBtn) {
        openCommentsModalBtn.addEventListener('click', function() {
            openModal();
        });
    }
    var mainEditor = new Quill('#editor-main', { theme: 'snow', modules: { toolbar: [['bold', 'italic'], ['link', 'code-block']] } });
    var mainForm = document.querySelector('#reply-form-main form');
    mainForm.onsubmit = function() {
        document.querySelector('#content-main').value = mainEditor.root.innerHTML;
    };

    const showMoreLink = document.getElementById('show-more-comments');
    const commentsModal = document.getElementById('comments-modal');
    const closeModalBtn = document.getElementById('close-modal');
    const modalCommentsContainer = document.getElementById('modal-comments-container');
    const loadMoreBtn = document.getElementById('load-more-comments');
    let offset = 0;

    function openModal() {
        commentsModal.classList.remove('hidden');
        offset = 0;
        modalCommentsContainer.innerHTML = '';
        loadComments();
    }

    function closeModal() {
        commentsModal.classList.add('hidden');
    }

    function loadComments() {
        fetch(`<?php echo site_url('forum/get_comments_ajax/' . $thread->id); ?>?offset=${offset}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    data.forEach(post => {
                        const commentEl = document.createElement('div');
                        commentEl.className = 'flex items-start space-x-3 mb-4';
                        commentEl.innerHTML = `
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold mt-1">
                                ${post.nama_lengkap.charAt(0).toUpperCase()}
                            </div>
                            <div class="flex-1 bg-gray-100 rounded-lg p-3">
                                <div class="font-bold">${post.nama_lengkap}</div>
                                <div class="text-sm prose max-w-none">${post.content}</div>
                            </div>
                        `;
                        modalCommentsContainer.appendChild(commentEl);
                    });
                    offset += data.length;
                    if (data.length < 10) {
                        loadMoreBtn.style.display = 'none';
                    } else {
                        loadMoreBtn.style.display = 'block';
                    }
                } else {
                    loadMoreBtn.style.display = 'none';
                }
            });
    }

    if (showMoreLink) {
        showMoreLink.addEventListener('click', function(e) {
            e.preventDefault();
            openModal();
        });
    }

    closeModalBtn.addEventListener('click', closeModal);
    loadMoreBtn.addEventListener('click', loadComments);

    // Load More Comments Button
    const loadMoreCommentsBtn = document.getElementById('load-more-comments');
    if (loadMoreCommentsBtn) {
        loadMoreCommentsBtn.addEventListener('click', function() {
            const offset = this.getAttribute('data-offset');
            const threadId = <?php echo $thread->id; ?>;
            
            fetch(`<?php echo site_url('forum/get_comments_ajax/' . $thread->id); ?>?offset=${offset}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const commentsContainer = document.getElementById('comments-container');
                        
                        data.forEach(post => {
                            const commentEl = document.createElement('div');
                            commentEl.className = 'p-6 hover:bg-gray-50 transition-colors duration-150';
                            commentEl.id = 'post-' + post.id;
                            
                            let repliesHtml = '';
                            if (post.replies && post.replies.length > 0) {
                                repliesHtml = `
                                    <div class="mt-4 pl-4 border-l-2 border-gray-200 space-y-4">
                                        ${post.replies.map(reply => `
                                            <div class="pt-4 first:pt-0">
                                                <div class="flex">
                                                    <div class="flex-shrink-0 mr-3">
                                                        <div class="h-8 w-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center text-sm font-medium">
                                                            ${reply.nama_lengkap.charAt(0).toUpperCase()}
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 bg-gray-50 rounded-lg p-3">
                                                        <div class="flex items-center justify-between">
                                                            <p class="text-sm font-medium text-gray-900">
                                                                ${reply.nama_lengkap}
                                                                ${reply.user_id == <?php echo $thread->user_id; ?> ? '<span class="ml-1 text-xs text-blue-600">(Penulis)</span>' : ''}
                                                            </p>
                                                            <span class="text-xs text-gray-500">
                                                                ${timespan(strtotime(reply.created_at), time(), 1)} lalu
                                                            </span>
                                                        </div>
                                                        <div class="mt-1 text-sm text-gray-600">
                                                            ${reply.content}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        `).join('')}
                                    </div>
                                `;
                            }
                            
                            commentEl.innerHTML = `
                                <div class="flex">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-medium text-lg">
                                            ${post.nama_lengkap.charAt(0).toUpperCase()}
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">
                                                    ${post.nama_lengkap}
                                                    ${post.user_id == <?php echo $thread->user_id; ?> ? '<span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Penulis</span>' : ''}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    <time datetime="${post.created_at}">
                                                        ${timespan(strtotime(post.created_at), time())} yang lalu
                                                    </time>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-2 text-sm text-gray-700 prose max-w-none">
                                            ${post.content}
                                        </div>
                                        <div class="mt-3 flex items-center text-sm text-gray-500">
                                            <button type="button" class="inline-flex items-center mr-4 hover:text-blue-600">
                                                <i class="far fa-thumbs-up mr-1"></i>
                                                <span>Suka</span>
                                            </button>
                                            <button type="button" class="inline-flex items-center hover:text-blue-600" onclick="document.getElementById('reply-to-${post.id}').classList.toggle('hidden'); document.getElementById('reply-to-${post.id}').scrollIntoView({ behavior: 'smooth' });">
                                                <i class="far fa-comment-dots mr-1"></i>
                                                <span>Balas</span>
                                            </button>
                                        </div>
                                        ${repliesHtml}
                                    </div>
                                </div>
                            `;
                            
                            commentsContainer.appendChild(commentEl);
                        });
                        
                        // Update offset
                        this.setAttribute('data-offset', parseInt(offset) + data.length);
                        
                        // Hide button if no more comments
                        if (data.length < 10) {
                            this.style.display = 'none';
                        }
                    } else {
                        this.style.display = 'none';
                    }
                });
        });
    }
});
</script>
