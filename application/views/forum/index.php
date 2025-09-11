<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-1xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block">Forum Diskusi</span>
            </h1>
            <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                Bergabunglah dalam diskusi, ajukan pertanyaan, dan berbagi pengetahuan dengan komunitas kami.
            </p>
        </div>

        <!-- Search and Filter -->
        <div class="mb-8">
            <div class="relative max-w-xl mx-auto">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Cari topik atau pertanyaan...">
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($categories as $category): ?>
                <a href="<?php echo site_url('forum/category/' . $category->slug); ?>" class="group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-500 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-lg bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-200">
                            <i class="fas fa-comments text-xl"></i>
                        </div>
                        <h3 class="ml-4 text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">
                            <?php echo $category->name; ?>
                        </h3>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        <?php echo $category->description; ?>
                    </p>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span class="inline-flex items-center">
                            <i class="far fa-comment-alt mr-1"></i>
                            <?php echo isset($category->thread_count) ? $category->thread_count : '0' ?> Topik
                        </span>
                        <span class="inline-flex items-center text-blue-600 group-hover:text-blue-800 transition-colors duration-200">
                            Lihat diskusi
                            <i class="fas fa-arrow-right ml-1 text-xs mt-0.5"></i>
                        </span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Popular Discussions Section -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Diskusi Populer</h2>
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <ul class="divide-y divide-gray-200">
                    <?php if (isset($popular_threads) && !empty($popular_threads)): ?>
                        <?php foreach ($popular_threads as $thread): ?>
                            <li class="px-6 py-4 hover:bg-gray-50 transition-colors duration-150">
                                <a href="<?php echo site_url('forum/thread/' . $thread->id); ?>" class="block">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-blue-600 truncate">
                                                <?php echo $thread->title; ?>
                                            </p>
                                            <p class="mt-1 text-sm text-gray-500">
                                                Dibuat oleh <?php echo $thread->author_name; ?> • 
                                                <time datetime="<?php echo $thread->created_at; ?>">
                                                    <?php echo timespan(strtotime($thread->created_at), time()) . ' yang lalu'; ?>
                                                </time>
                                            </p>
                                        </div>
                                        <div class="ml-4 flex-shrink-0 flex items-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="far fa-comment-alt mr-1"></i>
                                                <?php echo isset($thread->reply_count) ? $thread->reply_count : '0'; ?>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="px-6 py-8 text-center">
                            <p class="text-gray-500">Belum ada diskusi populer saat ini.</p>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="mt-12 bg-blue-50 rounded-xl p-8 text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Punya pertanyaan?</h3>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                Bergabunglah dengan komunitas kami dan dapatkan jawaban dari para ahli dan sesama anggota.
            </p>
            <a href="<?php echo site_url('forum/category/umum'); ?>" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                Mulai Diskusi Sekarang
                <i class="fas fa-arrow-right ml-2 text-sm"></i>
            </a>
        </div>
    </div>
</div>
