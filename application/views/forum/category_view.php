<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-1xl mx-auto">
        <!-- Category Header -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-3xl font-bold text-gray-900"><?php echo $category->name; ?></h1>
                    <p class="text-gray-600 mt-2"><?php echo $category->description; ?></p>
                </div>
                <a href="<?php echo site_url('forum/create_thread/' . $category->id); ?>" 
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Topik Baru
                </a>
            </div>
        </div>

        <!-- Thread List -->
        <div class="space-y-4">
            <?php if (!empty($threads)): ?>
                <?php foreach ($threads as $thread): ?>
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-start">
                                <!-- Author Avatar -->
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-medium text-lg">
                                        <?php echo strtoupper(substr($thread->nama_lengkap, 0, 1)); ?>
                                    </div>
                                </div>
                                
                                <!-- Thread Content -->
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-lg font-medium text-gray-900 hover:text-blue-600 transition-colors duration-150">
                                            <a href="<?php echo site_url('forum/thread/' . $thread->id); ?>">
                                                <?php if ($thread->is_pinned): ?>
                                                    <span class="text-yellow-500 mr-2"><i class="fas fa-thumbtack"></i></span>
                                                <?php endif; ?>
                                                <?php echo $thread->title; ?>
                                            </a>
                                        </h3>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Menunggu
                                        </span>
                                    </div>
                                    
                                    <div class="mt-1 text-sm text-gray-500">
                                        <span>Oleh </span>
                                        <span class="font-medium text-gray-700"><?php echo $thread->nama_lengkap; ?></span>
                                        <?php 
                                        // Add role badge
                                        if (isset($thread->user_role)) {
                                            $role_class = 'bg-gray-100 text-gray-800';
                                            $role_text = 'User';
                                            switch ($thread->user_role) {
                                                case 'super_admin':
                                                    $role_class = 'bg-red-100 text-red-800';
                                                    $role_text = 'Super Admin';
                                                    break;
                                                case 'admin':
                                                    $role_class = 'bg-blue-100 text-blue-800';
                                                    $role_text = 'Admin';
                                                    break;
                                                case 'guru':
                                                    $role_class = 'bg-green-100 text-green-800';
                                                    $role_text = 'Guru';
                                                    break;
                                                case 'siswa':
                                                    $role_class = 'bg-purple-100 text-purple-800';
                                                    $role_text = 'Siswa';
                                                    break;
                                                default:
                                                    $role_class = 'bg-gray-100 text-gray-800';
                                                    $role_text = 'User';
                                            }
                                            echo '<span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold ' . $role_class . '">' . $role_text . '</span>';
                                        }
                                        ?>
                                        <span class="mx-1">•</span>
                                        <time datetime="<?php echo $thread->created_at; ?>">
                                            <?php echo timespan(strtotime($thread->created_at), time()) . ' yang lalu'; ?>
                                        </time>
                                    </div>
                                    
                                    <?php if (!empty($thread->latest_posts)): ?>
                                        <div class="mt-3 pl-4 border-l-2 border-blue-200">
                                            <?php foreach($thread->latest_posts as $post): ?>
                                                <div class="text-sm text-gray-600 mb-2">
                                                    <span class="font-medium text-gray-800"><?php echo $post->nama_lengkap; ?>:</span>
                                                    <span class="text-gray-600"><?php echo strip_tags(character_limiter($post->content, 120)); ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="mt-3 flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex space-x-4">
                                            <span class="inline-flex items-center">
                                                <i class="far fa-comment-alt mr-1"></i>
                                                <?php echo $thread->post_count . ' ' . ($thread->post_count == 1 ? 'Jawaban' : 'Jawaban'); ?>
                                            </span>
                                            <span class="inline-flex items-center">
                                                <i class="far fa-eye mr-1"></i>
                                                <?php echo isset($thread->views) ? $thread->views : '0'; ?> Dilihat
                                            </span>
                                        </div>
                                        <a href="<?php echo site_url('forum/thread/' . $thread->id); ?>" class="text-blue-600 hover:text-blue-800 font-medium">
                                            Lihat Diskusi <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <!-- Pagination -->
                <?php if (isset($pagination)): ?>
                    <div class="mt-8">
                        <?php echo $pagination; ?>
                    </div>
                <?php endif; ?>
                
            <?php else: ?>
                <!-- Empty State -->
                <div class="text-center py-12 bg-white rounded-lg shadow">
                    <i class="fas fa-comment-slash text-4xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada topik diskusi</h3>
                    <p class="mt-2 text-gray-500">Jadilah yang pertama memulai diskusi di kategori ini!</p>
                    <div class="mt-6">
                        <a href="<?php echo site_url('forum/create_thread/' . $category->id); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-plus mr-2"></i>
                            Buat Topik Baru
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
