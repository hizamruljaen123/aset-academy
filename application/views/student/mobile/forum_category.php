<div class="container mx-auto px-4 py-6">
    <!-- Back button -->
    <a href="<?= site_url('student_mobile/forum') ?>" class="inline-flex items-center text-blue-600 mb-4">
        <i data-feather="arrow-left" class="w-4 h-4 mr-1"></i>
        <span>Kembali ke Forum</span>
    </a>

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900"><?= html_escape($category->name) ?></h1>
        <a href="<?= site_url('student_mobile/forum/create') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium">
            Thread Baru
        </a>
    </div>

    <!-- Thread List -->
    <div class="space-y-4">
        <?php if (empty($threads)): ?>
            <div class="text-center py-12">
                <i data-feather="message-square" class="w-12 h-12 text-gray-300 mx-auto mb-4"></i>
                <p class="text-gray-500">Belum ada diskusi dalam kategori ini</p>
                <a href="<?= site_url('student_mobile/forum/create') ?>" class="mt-4 inline-block text-blue-600 font-medium">
                    Buat thread pertama
                </a>
            </div>
        <?php else: ?>
            <?php foreach ($threads as $thread): ?>
                <a href="<?= site_url('student_mobile/forum/thread/' . $thread->id . '/' . $thread->slug) ?>" class="block bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-1">
                                <?php if ($thread->is_pinned): ?>
                                    <span class="text-yellow-500">
                                        <i data-feather="pin" class="w-3.5 h-3.5"></i>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <h3 class="font-medium text-gray-900 mb-2 line-clamp-2">
                                <?= html_escape($thread->title) ?>
                            </h3>
                            <div class="flex items-center text-xs text-gray-500 space-x-3">
                                <div class="flex items-center">
                                    <i data-feather="message-square" class="w-3.5 h-3.5 mr-1"></i>
                                    <span><?= $thread->post_count ?? 0 ?></span>
                                </div>
                                <div class="flex items-center">
                                    <i data-feather="eye" class="w-3.5 h-3.5 mr-1"></i>
                                    <span><?= $thread->views ?? 0 ?></span>
                                </div>
                                <span>Oleh <?= html_escape($thread->nama_lengkap ?? $thread->username) ?></span>
                                <span>•</span>
                                <span><?= timespan(strtotime($thread->created_at), time()) ?> yang lalu</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                                <i data-feather="user" class="w-5 h-5 text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Load More -->
    <?php if (isset($has_more) && $has_more): ?>
        <div class="mt-6 text-center">
            <button id="load-more" class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Muat Lebih Banyak
            </button>
        </div>
    <?php endif; ?>
</div>

<!-- Initialize Feather Icons -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        feather.replace();
        
        // Load more functionality
        const loadMoreBtn = document.getElementById('load-more');
        if (loadMoreBtn) {
            let page = 1;
            const categoryId = '<?= $category->id ?>';
            const threadList = document.querySelector('.space-y-4');
            
            loadMoreBtn.addEventListener('click', function() {
                page++;
                const url = `<?= site_url('student_mobile/forum/category/') ?>${categoryId}?page=${page}`;
                
                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newThreads = doc.querySelector('.space-y-4');
                        const newLoadMore = doc.getElementById('load-more');
                        
                        // Append new threads
                        threadList.innerHTML += newThreads.innerHTML;
                        
                        // Update or remove load more button
                        if (!newLoadMore) {
                            loadMoreBtn.remove();
                        }
                        
                        // Re-initialize feather icons for new content
                        feather.replace();
                    })
                    .catch(error => {
                        console.error('Error loading more threads:', error);
                        loadMoreBtn.textContent = 'Error loading more';
                        loadMoreBtn.disabled = true;
                    });
            });
        }
    });
</script>
