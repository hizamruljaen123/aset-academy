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

        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="ml-3">
                        <p><?php echo $this->session->flashdata('success'); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="ml-3">
                        <p><?php echo $this->session->flashdata('error'); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Admin Button for Adding Category -->
        <?php if (isset($is_admin) && $is_admin): ?>
        <div class="mb-8 text-right">
            <button onclick="openCategoryModal()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                <i class="fas fa-plus"></i>
                Tambah Kategori Baru
            </button>
        </div>
        <?php endif; ?>

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
        <?php if (!$has_threads && $is_super_admin): ?>
            <!-- First Thread Creation Form -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <div class="text-center mb-6">
                    <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                        <i class="fas fa-plus-circle text-blue-600 text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Mulai Forum Pertama</h2>
                    <p class="text-gray-600">Sebagai Super Admin, Anda dapat membuat topik diskusi pertama di forum ini.</p>
                </div>

                <form action="<?php echo site_url('forum/create_first_thread'); ?>" method="post" class="max-w-2xl mx-auto">
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="category_id" id="category_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Topik</label>
                        <input type="text" name="title" id="title" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan judul topik..." required>
                    </div>

                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten</label>
                        <textarea name="content" id="content" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Tulis konten diskusi..." required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                            <i class="fas fa-paper-plane mr-2"></i>Buat Topik Pertama
                        </button>
                    </div>
                </form>
            </div>
        <?php elseif (!empty($categories)): ?>
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
        <?php else: ?>
            <div class="text-center py-12">
                <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">Belum ada kategori forum yang tersedia.</p>
                <?php if (isset($is_admin) && $is_admin): ?>
                    <p class="text-gray-400 mt-2">Sebagai admin, Anda dapat membuat kategori pertama.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Popular Discussions Section -->
        <?php if ($has_threads): ?>
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
        <?php endif; ?>

        <!-- Call to Action -->
        <div class="mt-12 bg-blue-50 rounded-xl p-8 text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Punya pertanyaan?</h3>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                Bergabunglah dengan komunitas kami dan dapatkan jawaban dari para ahli dan sesama anggota.
            </p>
            <a href="<?php echo site_url('forum/category/diskusi-umum'); ?>" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                Mulai Diskusi Sekarang
                <i class="fas fa-arrow-right ml-2 text-sm"></i>
            </a>
        </div>
    </div>
</div>

<!-- Category Creation Modal for Admins -->
<?php if (isset($is_admin) && $is_admin): ?>
<div id="categoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center pb-3">
                <h3 id="categoryModalTitle" class="text-lg font-medium text-gray-900">Tambah Kategori Baru</h3>
                <button onclick="closeCategoryModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="categoryForm">
                <input type="hidden" id="categoryId" name="id" value="">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                    <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>
                <div class="mb-4">
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" id="slug" name="slug" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeCategoryModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
    // Category Modal Functions (for admins)
    function openCategoryModal() {
        const modal = document.getElementById('categoryModal');
        const form = document.getElementById('categoryForm');
        const title = document.getElementById('categoryModalTitle');
        const categoryId = document.getElementById('categoryId');

        form.reset();
        categoryId.value = '';
        title.textContent = 'Tambah Kategori Baru';
        form.action = '<?php echo site_url('forum/ajax_create_category'); ?>';

        modal.classList.remove('hidden');
    }

    function closeCategoryModal() {
        document.getElementById('categoryModal').classList.add('hidden');
    }

    // Category Form Submission
    document.addEventListener('DOMContentLoaded', function() {
        const categoryForm = document.getElementById('categoryForm');
        if (categoryForm) {
            categoryForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const actionUrl = this.action;

                fetch(actionUrl, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload(); // Reload to show new category
                    } else {
                        alert(data.message);
                    }
                    closeCategoryModal();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                    closeCategoryModal();
                });
            });

            // Auto-generate slug from name
            document.getElementById('name').addEventListener('input', function() {
                const name = this.value;
                const slug = name.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
                document.getElementById('slug').value = slug;
            });
        }
    });

    // Close modal on outside click
    window.onclick = function(event) {
        const categoryModal = document.getElementById('categoryModal');
        if (event.target === categoryModal) {
            closeCategoryModal();
        }
    }
</script>
