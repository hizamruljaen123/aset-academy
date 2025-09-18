<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Forum Diskusi</h1>
        <a href="<?= site_url('student_mobile/forum/create') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium">
            Thread Baru
        </a>
    </div>

    <!-- Search and Filter -->
    <div class="mb-6">
        <div class="relative">
            <input type="text" placeholder="Cari diskusi..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <i data-feather="search" class="absolute right-3 top-2.5 text-gray-400"></i>
        </div>
        
        <div class="flex space-x-2 mt-3 overflow-x-auto pb-2">
            <button class="px-4 py-1 bg-blue-100 text-blue-700 rounded-full text-sm whitespace-nowrap">Semua</button>
            <?php foreach ($categories as $category): ?>
                <a href="<?= site_url('student_mobile/forum/category/' . $category->id) ?>" class="px-4 py-1 bg-gray-100 text-gray-700 rounded-full text-sm whitespace-nowrap">
                    <?= html_escape($category->name) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Thread List -->
    <div class="space-y-4">
        <?php if (empty($threads)): ?>
            <div class="text-center py-12">
                <i data-feather="message-square" class="w-12 h-12 text-gray-300 mx-auto mb-4"></i>
                <p class="text-gray-500">Belum ada diskusi yang tersedia</p>
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
                                <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2 py-0.5 rounded">
                                    <?= html_escape($thread->category_name) ?>
                                </span>
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
    <?php if ($has_more): ?>
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
        
        // Handle load more button
        const loadMoreBtn = document.getElementById('load-more');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                // Implement load more functionality
                console.log('Load more clicked');
            });
        }
    });
</script>
