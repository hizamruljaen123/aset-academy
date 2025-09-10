<div class="forum-container p-4">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-3xl font-bold"><?php echo $category->name; ?></h1>
            <p class="text-gray-600"><?php echo $category->description; ?></p>
        </div>
        <a href="<?php echo site_url('forum/create_thread/' . $category->slug); ?>" class="bg-blue-500 text-white px-4 py-2 rounded">Buat Topik Baru</a>
    </div>

    <?php foreach ($threads as $thread): ?>
        <div class="forum-card">
            <div class="forum-card-header">
                <div class="profile-pic"><?php echo strtoupper(substr($thread->nama_lengkap, 0, 1)); ?></div>
                <div class="author-info">
                    <a href="<?php echo site_url('forum/thread/' . $thread->id); ?>" class="author-name text-lg hover:underline"><?php echo $thread->title; ?></a>
                    <div class="post-time">oleh <?php echo $thread->nama_lengkap; ?> • <?php echo date('d M Y', strtotime($thread->created_at)); ?></div>
                </div>
            </div>
            <div class="text-right text-gray-600">
                <?php echo $thread->post_count; ?> jawaban
            </div>
        </div>
    <?php endforeach; ?>

    <div class="mt-4">
        <?php echo $pagination; ?>
    </div>
</div>
