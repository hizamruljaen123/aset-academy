<div class="forum-container p-4">
    <!-- Main Thread Post -->
    <div class="forum-card">
        <div class="forum-card-header">
            <div class="profile-pic"><?php echo strtoupper(substr($thread->nama_lengkap, 0, 1)); ?></div>
            <div class="author-info">
                <div class="author-name"><?php echo $thread->nama_lengkap; ?></div>
                <div class="post-time"><?php echo date('d M Y H:i', strtotime($thread->created_at)); ?></div>
            </div>
        </div>
        <h1 class="text-2xl font-bold mb-4"><?php echo $thread->title; ?></h1>
        <div class="forum-card-content prose max-w-none">
            <?php echo $thread->content; ?>
        </div>
        <div class="forum-card-actions">
            <a href="<?php echo site_url('forum/like/thread/' . $thread->id); ?>" class="action-btn"><i class="fas fa-thumbs-up"></i> <?php echo $likes; ?> Suka</a>
            <a href="#reply-form-main" class="action-btn"><i class="fas fa-comment"></i> Balas</a>
        </div>
    </div>

    <!-- Replies/Posts -->
    <?php
    function display_posts($posts, $forum_model, $parent_id = null, $level = 0) {
        foreach ($posts as $post) {
            if ($post->parent_id == $parent_id) {
                echo '<div class="forum-card"' . ($level > 0 ? ' style="margin-left: ' . ($level * 20) . 'px;"' : '') . '>';
                echo '<div class="forum-card-header">';
                echo '<div class="profile-pic">' . strtoupper(substr($post->nama_lengkap, 0, 1)) . '</div>';
                echo '<div class="author-info">';
                echo '<div class="author-name">' . $post->nama_lengkap . '</div>';
                echo '<div class="post-time">' . date('d M Y H:i', strtotime($post->created_at)) . '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div class="forum-card-content prose max-w-none">' . $post->content . '</div>';
                echo '<div class="forum-card-actions">';
                $post_likes = $forum_model->get_likes_count(null, $post->id);
                echo '<a href="' . site_url('forum/like/post/' . $post->id) . '" class="action-btn"><i class="fas fa-thumbs-up"></i> ' . $post_likes . ' Suka</a>';
                echo '<a href="#" onclick="toggleReplyForm(' . $post->id . ')" class="action-btn"><i class="fas fa-comment"></i> Balas</a>';
                if (in_array($_SESSION['role'], ['admin', 'super_admin'])) {
                    echo '<a href="' . site_url('admin/admin_forum/delete_post/' . $post->id) . '" class="action-btn text-red-500" onclick="return confirm(\'Yakin ingin menghapus komentar ini?\')"><i class="fas fa-trash"></i> Hapus</a>';
                }
                echo '</div>';
                // Nested reply form
                echo '<div id="reply-form-' . $post->id . '" class="reply-form">';
                echo form_open('forum/create_post/' . $post->thread_id);
                echo '<input type="hidden" name="parent_id" value="' . $post->id . '">';
                echo '<div class="quill-editor-container"><div id="editor-' . $post->id . '" style="height: 150px;"></div></div>';
                echo '<input type="hidden" name="content" id="content-' . $post->id . '">';
                echo '<button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Kirim Balasan</button>';
                echo form_close();
                echo '</div>';
                // Recursively display replies
                echo '<div class="post-replies">';
                display_posts($posts, $forum_model, $post->id, $level + 1);
                echo '</div>';
                echo '</div>';
            }
        }
    }
    display_posts($posts, $this->forum);
    ?>

    <!-- Main Reply Form -->
    <div id="reply-form-main" class="forum-card">
        <h3 class="text-xl font-bold mb-4">Beri Komentar</h3>
        <?php echo form_open('forum/create_post/' . $thread->id); ?>
            <div class="quill-editor-container">
                <div id="editor-main" style="height: 200px;"></div>
                <input type="hidden" name="content" id="content-main">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Kirim Komentar</button>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    var editors = {};
    function toggleReplyForm(postId) {
        var form = document.getElementById('reply-form-' + postId);
        form.classList.toggle('active');
        if (form.classList.contains('active') && !editors[postId]) {
            editors[postId] = new Quill('#editor-' + postId, { theme: 'snow', modules: { toolbar: [['bold', 'italic'], ['link', 'code-block']] } });
        }
        hljs.highlightAll();
    }

    document.addEventListener('DOMContentLoaded', function() {
        hljs.highlightAll();
        var mainEditor = new Quill('#editor-main', { theme: 'snow', modules: { toolbar: [['bold', 'italic', 'underline'], ['link', 'image', 'code-block']] } });

        var mainForm = document.querySelector('#reply-form-main form');
        mainForm.onsubmit = function() {
            var content = document.querySelector('#content-main');
            content.value = mainEditor.root.innerHTML;
        };

        document.body.addEventListener('submit', function(e) {
            if (e.target.closest('.reply-form')) {
                var form = e.target.closest('form');
                var postId = form.querySelector('input[name=parent_id]').value;
                var contentInput = form.querySelector('#content-' + postId);
                if (editors[postId]) {
                    contentInput.value = editors[postId].root.innerHTML;
                }
            }
        });
    });
</script>
