<div class="forum-container p-4">
    <h1 class="text-3xl font-bold mb-4">Forum Diskusi</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php foreach ($categories as $category): ?>
            <a href="<?php echo site_url('forum/category/' . $category->slug); ?>" class="forum-card block hover:bg-gray-50 transition-colors">
                <h2 class="text-xl font-bold text-blue-600"><?php echo $category->name; ?></h2>
                <p class="text-gray-600"><?php echo $category->description; ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</div>
