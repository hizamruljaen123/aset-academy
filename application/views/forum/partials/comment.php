<?php
/**
 * Forum Comment Partial
 * Modular comment rendering for forum threads
 */

// Recursive function to render comments and replies
function render_comment($post, $thread, $depth = 0, $max_depth = 5) {
    if ($depth > $max_depth) {
        return '';
    }

    $ci = &get_instance();
    $session = $ci->session;

    $userId = $session->userdata('user_id');
    $userLevel = $session->userdata('level');
    $postUserId = isset($post->user_id) ? (int) $post->user_id : null;
    $threadUserId = isset($thread->user_id) ? (int) $thread->user_id : null;

    $postId = isset($post->id) ? (int) $post->id : 0;
    $threadId = isset($thread->id) ? (int) $thread->id : 0;

    $canEdit = ($userId && $postUserId && (int) $userId === $postUserId) || $userLevel === '1';

    $isAuthor = $threadUserId !== null && $postUserId !== null && $threadUserId === $postUserId;

    $roleBadges = [
        'super_admin' => ['label' => 'Super Admin', 'class' => 'bg-red-100 text-red-800'],
        'admin'       => ['label' => 'Admin', 'class' => 'bg-blue-100 text-blue-800'],
        'guru'        => ['label' => 'Guru', 'class' => 'bg-green-100 text-green-800'],
        'siswa'       => ['label' => 'Siswa', 'class' => 'bg-purple-100 text-purple-800'],
    ];

    $defaultBadge = ['label' => 'User', 'class' => 'bg-gray-100 text-gray-800'];
    $userRole = isset($post->user_role) ? $post->user_role : null;
    $badge = $roleBadges[$userRole] ?? $defaultBadge;

    $authorName = html_escape($post->author_name ?? 'User Tidak Dikenal');
    $authorInitial = strtoupper(substr($post->author_name ?? 'U', 0, 1));

    $createdAtRaw = isset($post->created_at) ? $post->created_at : 'now';
    $createdTimestamp = strtotime($createdAtRaw);
    if ($createdTimestamp === false) {
        $createdTimestamp = time();
    }
    $postedAgo = timespan($createdTimestamp, time()) . ' yang lalu';

    $replyUrl = site_url('forum/reply/' . $postId);
    $deleteUrl = site_url('forum/delete_post/' . $postId . '/' . $threadId);

    ob_start();
    ?>
    <div class="p-6 bg-white/60 backdrop-blur-sm rounded-xl shadow-sm border border-gray-200/50 mb-4 transition-all duration-300 hover:shadow-md" id="post-<?= $postId; ?>">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 relative">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center font-bold text-white shadow-lg">
                    <?= html_escape($authorInitial); ?>
                </div>
                <?php if ($isAuthor): ?>
                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-md">👑</div>
                <?php endif; ?>
            </div>

            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3">
                        <h4 class="font-semibold text-gray-900 flex items-center">
                            <span><?= $authorName; ?></span>
                            <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold <?= html_escape($badge['class']); ?>"><?= html_escape($badge['label']); ?></span>
                            <?php if ($isAuthor): ?>
                                <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800">Penulis</span>
                            <?php endif; ?>
                        </h4>
                        <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                            <i class="fas fa-clock mr-1"></i>
                            <?= html_escape($postedAgo); ?>
                        </span>
                    </div>

                    <?php if ($canEdit): ?>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-xl shadow-xl bg-white ring-1 ring-black/5 z-20 overflow-hidden">
                                <div class="py-1">
                                    <a href="#" class="flex items-center px-4 py-3 text-sm text-blue-600 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200 block w-full text-left">
                                        <i class="fas fa-edit mr-3"></i> Edit
                                    </a>
                                    <a href="<?= $deleteUrl; ?>" class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors duration-200 block w-full text-left" onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?');">
                                        <i class="fas fa-trash-alt mr-3"></i> Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-4 text-gray-800 leading-relaxed prose prose-indigo max-w-none">
                    <?= $post->content ?? ''; ?>
                </div>

                <div class="flex items-center space-x-4 text-sm font-medium">
                    <a href="<?= $replyUrl; ?>" class="inline-flex items-center space-x-2 px-3 py-2 text-green-600 hover:text-green-700 hover:bg-green-50 rounded-lg transition-all duration-300 group">
                        <i class="far fa-comment-dots group-hover:scale-110 transition-transform"></i>
                        <span>Balas</span>
                    </a>

                    <button type="button" class="inline-flex items-center space-x-2 px-3 py-2 text-gray-500 hover:text-gray-700 rounded-lg transition-colors">
                        <i class="fas fa-share mr-1"></i>
                        <span>Bagikan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php

    $output = ob_get_clean();

    if (!empty($post->replies)) {
        foreach ($post->replies as $reply) {
            $output .= render_comment($reply, $thread, $depth + 1, $max_depth);
        }
    }

    return $output;
}
?>
