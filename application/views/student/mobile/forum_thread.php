<div class="container mx-auto px-4 py-6">
    <!-- Thread Header -->
    <div class="mb-6">
        <a href="<?= site_url('student_mobile/forum') ?>" class="inline-flex items-center text-blue-600 mb-4">
            <i data-feather="arrow-left" class="w-4 h-4 mr-1"></i>
            <span class="text-sm">Kembali ke Forum</span>
        </a>
        
        <div class="flex items-center space-x-2 mb-2">
            <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2 py-0.5 rounded">
                <?= html_escape($thread['category_name']) ?>
            </span>
            <?php if ($thread['is_pinned']): ?>
                <span class="text-xs font-medium text-yellow-600 bg-yellow-50 px-2 py-0.5 rounded flex items-center">
                    <i data-feather="pin" class="w-3 h-3 mr-1"></i>
                    Disematkan
                </span>
            <?php endif; ?>
        </div>
        
        <h1 class="text-xl font-bold text-gray-900 mb-2"><?= html_escape($thread['title']) ?></h1>
        
        <div class="flex items-center text-sm text-gray-500">
            <div class="flex items-center mr-4">
                <i data-feather="user" class="w-4 h-4 mr-1"></i>
                <span><?= html_escape($thread['author_name']) ?></span>
            </div>
            <div class="flex items-center">
                <i data-feather="clock" class="w-4 h-4 mr-1"></i>
                <span><?= timespan(strtotime($thread['created_at']), time()) ?> yang lalu</span>
            </div>
        </div>
    </div>
    
    <!-- Thread Content -->
    <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
        <div class="prose max-w-none">
            <?= $thread['content'] ?>
        </div>
        
        <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
            <div class="flex items-center space-x-2">
                <button class="text-gray-500 hover:text-blue-600 p-2 rounded-full hover:bg-gray-50">
                    <i data-feather="message-square" class="w-5 h-5"></i>
                </button>
                <span class="text-sm text-gray-500"><?= $thread['post_count'] ?> balasan</span>
            </div>
            <div class="flex items-center space-x-1">
                <span class="text-sm text-gray-500"><?= $thread['views'] ?>x dilihat</span>
                <button class="text-gray-500 hover:text-blue-600 p-2 rounded-full hover:bg-gray-50">
                    <i data-feather="share-2" class="w-5 h-5"></i>
                </button>
                <button class="text-gray-500 hover:text-red-500 p-2 rounded-full hover:bg-gray-50">
                    <i data-feather="heart" class="w-5 h-5"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Replies -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Balasan (<?= count($replies) ?>)</h2>
        
        <?php if (empty($replies)): ?>
            <div class="text-center py-8 bg-white rounded-xl shadow-sm">
                <i data-feather="message-square" class="w-10 h-10 text-gray-300 mx-auto mb-2"></i>
                <p class="text-gray-500">Belum ada balasan</p>
            </div>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($replies as $reply): ?>
                    <div class="bg-white rounded-xl shadow-sm p-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                                    <?php if (!empty($reply['author_avatar'])): ?>
                                        <img src="<?= base_url('uploads/avatars/' . $reply['author_avatar']) ?>" alt="<?= html_escape($reply['author_name']) ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <i data-feather="user" class="w-5 h-5 text-gray-400"></i>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-medium text-gray-900">
                                        <?= html_escape($reply['author_name']) ?>
                                    </h4>
                                    <span class="text-xs text-gray-500">
                                        <?= timespan(strtotime($reply['created_at']), time()) ?> yang lalu
                                    </span>
                                </div>
                                <div class="mt-1 text-sm text-gray-700">
                                    <?= $reply['content'] ?>
                                </div>
                                <div class="mt-2 flex items-center space-x-3 text-xs text-gray-500">
                                    <button class="flex items-center hover:text-blue-600">
                                        <i data-feather="thumbs-up" class="w-3.5 h-3.5 mr-1"></i>
                                        <span>Suka</span>
                                    </button>
                                    <button class="flex items-center hover:text-blue-600">
                                        <i data-feather="message-square" class="w-3.5 h-3.5 mr-1"></i>
                                        <span>Balas</span>
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
    <div class="bg-white rounded-xl shadow-sm p-4 sticky bottom-4 border border-gray-100">
        <form action="<?= site_url('student_mobile/forum/reply/' . $thread['id']) ?>" method="post">
            <div class="flex items-start space-x-2">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                        <?php if (!empty($user_avatar)): ?>
                            <img src="<?= base_url('uploads/avatars/' . $user_avatar) ?>" alt="<?= html_escape($user_name) ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <i data-feather="user" class="w-5 h-5 text-gray-400"></i>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex-1">
                    <textarea name="content" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Tulis balasan Anda..." required></textarea>
                    <div class="mt-2 flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Kirim Balasan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Initialize Feather Icons -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        feather.replace();
    });
</script>
