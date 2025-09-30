<div class="max-w-screen-xl mx-auto p-4 sm:p-6 lg:p-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Kelola Forum</h1>
                <p class="text-gray-600">Kelola kategori, topik, dan komentar forum diskusi</p>
            </div>
            <div class="flex gap-3">
                <button onclick="openCategoryModal('create')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Tambah Kategori
                </button>
                <a href="<?php echo site_url('forum'); ?>" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors flex items-center gap-2">
                    <i class="fas fa-eye"></i>
                    Lihat Forum
                </a>
            </div>
        </div>
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

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Total Kategori</p>
                    <p class="text-2xl font-bold"><?php echo count($categories); ?></p>
                </div>
                <div class="bg-blue-400 bg-opacity-50 p-3 rounded-lg">
                    <i class="fas fa-folder text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm">Total Topik</p>
                    <p class="text-2xl font-bold"><?php echo $total_threads; ?></p>
                </div>
                <div class="bg-green-400 bg-opacity-50 p-3 rounded-lg">
                    <i class="fas fa-comments text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-sm">Total Komentar</p>
                    <p class="text-2xl font-bold"><?php echo count($posts ?? []); ?></p>
                </div>
                <div class="bg-yellow-400 bg-opacity-50 p-3 rounded-lg">
                    <i class="fas fa-reply text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm">Aktif Hari Ini</p>
                    <p class="text-2xl font-bold"><?php echo count($posts ?? []); ?></p>
                </div>
                <div class="bg-purple-400 bg-opacity-50 p-3 rounded-lg">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Categories Management -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">Kategori Forum</h2>
                <button onclick="openCategoryModal('create')" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                    <i class="fas fa-plus mr-1"></i>Tambah
                </button>
            </div>
            <div class="divide-y divide-gray-200">
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <div class="px-6 py-4 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h3 class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($category->name); ?></h3>
                                    <p class="text-sm text-gray-500 mt-1"><?php echo htmlspecialchars($category->description); ?></p>
                                    <p class="text-xs text-gray-400 mt-1">Slug: <?php echo $category->slug; ?></p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button onclick="openCategoryModal('edit', <?php echo $category->id; ?>)" class="text-blue-600 hover:text-blue-800 p-2" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="confirmDeleteCategory(<?php echo $category->id; ?>)" class="text-red-600 hover:text-red-800 p-2" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="px-6 py-8 text-center">
                        <p class="text-gray-500">Belum ada kategori forum.</p>
                        <button onclick="openCategoryModal('create')" class="text-blue-600 hover:text-blue-800 text-sm font-medium mt-2 inline-block">
                            Buat kategori pertama
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent Threads -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">Topik Terbaru</h2>
                <button onclick="openThreadModal('create')" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                    <i class="fas fa-plus mr-1"></i>Topik Baru
                </button>
            </div>
            <div class="divide-y divide-gray-200">
                <?php if (!empty($threads)): ?>
                    <?php foreach ($threads as $thread): ?>
                        <div class="px-6 py-4 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-medium text-gray-900 truncate"><?php echo htmlspecialchars($thread->title); ?></h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Oleh <?php echo htmlspecialchars($thread->nama_lengkap); ?> •
                                        <?php echo date('d M Y', strtotime($thread->created_at)); ?> •
                                        Kategori: <?php echo htmlspecialchars($thread->category_name); ?>
                                    </p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-eye mr-1"></i>
                                        <?php echo $thread->views; ?>
                                    </span>
                                    <button onclick="openThreadModal('edit', <?php echo $thread->id; ?>)" class="text-blue-600 hover:text-blue-800 p-2" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="confirmDeleteThread(<?php echo $thread->id; ?>)" class="text-red-600 hover:text-red-800 p-2" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="px-6 py-8 text-center">
                        <p class="text-gray-500">Belum ada topik forum.</p>
                        <button onclick="openThreadModal('create')" class="text-green-600 hover:text-green-800 text-sm font-medium mt-2 inline-block">
                            Buat topik pertama
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent Posts -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">Komentar Terbaru</h2>
                <button onclick="openPostModal('create')" class="bg-purple-600 text-white px-3 py-1 rounded text-sm hover:bg-purple-700">
                    <i class="fas fa-plus mr-1"></i>Komentar Baru
                </button>
            </div>
            <div class="divide-y divide-gray-200">
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="px-6 py-4 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-medium text-gray-900 truncate"><?php echo htmlspecialchars($post->thread_title); ?></h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Oleh <?php echo htmlspecialchars($post->nama_lengkap); ?> •
                                        <?php echo date('d M Y H:i', strtotime($post->created_at)); ?>
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">Komentar: <?php echo substr(strip_tags($post->content), 0, 50); ?>...</p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button onclick="openPostModal('edit', <?php echo $post->id; ?>)" class="text-blue-600 hover:text-blue-800 p-2" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="confirmDeletePost(<?php echo $post->id; ?>)" class="text-red-600 hover:text-red-800 p-2" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="px-6 py-8 text-center">
                        <p class="text-gray-500">Belum ada komentar forum.</p>
                        <button onclick="openPostModal('create')" class="text-purple-600 hover:text-purple-800 text-sm font-medium mt-2 inline-block">
                            Tambah komentar pertama
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Category CRUD Modals -->
    <!-- Create Category Modal -->
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

    <!-- Thread CRUD Modal -->
    <div id="threadModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center pb-3">
                    <h3 id="threadModalTitle" class="text-lg font-medium text-gray-900">Buat Topik Baru</h3>
                    <button onclick="closeThreadModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form id="threadForm">
                    <input type="hidden" id="threadId" name="id" value="">
                    <div class="mb-4">
                        <label for="threadCategory" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select id="threadCategory" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat->id; ?>"><?php echo htmlspecialchars($cat->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="threadTitle" class="block text-sm font-medium text-gray-700">Judul Topik</label>
                        <input type="text" id="threadTitle" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="threadContent" class="block text-sm font-medium text-gray-700">Konten</label>
                        <textarea id="threadContent" name="content" rows="8" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required></textarea>
                    </div>
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="isPinned" name="is_pinned" value="1">
                        <label for="isPinned" class="ml-2 text-sm text-gray-700">Pin topik ini (tampil di atas)</label>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeThreadModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Post CRUD Modal -->
    <div id="postModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center pb-3">
                    <h3 id="postModalTitle" class="text-lg font-medium text-gray-900">Tambah Komentar Baru</h3>
                    <button onclick="closePostModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form id="postForm">
                    <input type="hidden" id="postId" name="id" value="">
                    <div class="mb-4">
                        <label for="postThread" class="block text-sm font-medium text-gray-700">Topik</label>
                        <select id="postThread" name="thread_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" required>
                            <option value="">Pilih Topik</option>
                            <?php foreach ($threads as $thread): ?>
                                <option value="<?php echo $thread->id; ?>"><?php echo htmlspecialchars($thread->title); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="postContent" class="block text-sm font-medium text-gray-700">Konten Komentar</label>
                        <textarea id="postContent" name="content" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" required></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closePostModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-lg font-medium text-gray-900">Konfirmasi Hapus</h3>
                    <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div id="deleteConfirmBody" class="mb-4 text-gray-700">
                    Apakah Anda yakin ingin menghapus item ini?
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                    <button id="confirmDeleteBtn" onclick="performDelete()" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modals -->
    <script>
        let currentDeleteType = '';
        let currentDeleteId = 0;

        // Category Modal Functions
        function openCategoryModal(action, id = null) {
            const modal = document.getElementById('categoryModal');
            const form = document.getElementById('categoryForm');
            const title = document.getElementById('categoryModalTitle');
            const categoryId = document.getElementById('categoryId');

            form.reset();
            categoryId.value = '';

            if (action === 'create') {
                title.textContent = 'Tambah Kategori Baru';
                form.action = '<?php echo site_url('admin_forum/ajax_create_category'); ?>';
            } else if (action === 'edit') {
                title.textContent = 'Edit Kategori';
                categoryId.value = id;
                form.action = '<?php echo site_url('admin_forum/ajax_update_category/' . id); ?>';
                // Load category data via AJAX
                fetch('<?php echo site_url('admin_forum/ajax_get_category/'); ?>' + id)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('name').value = data.data.name;
                            document.getElementById('description').value = data.data.description;
                            document.getElementById('slug').value = data.data.slug;
                        }
                    });
                form.action = '<?php echo site_url('admin_forum/ajax_update_category/'); ?>' + id;
            }

            modal.classList.remove('hidden');
        }

        function closeCategoryModal() {
            document.getElementById('categoryModal').classList.add('hidden');
        }

        // Category Form Submission
        document.getElementById('categoryForm').addEventListener('submit', function(e) {
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
                    location.reload(); // Reload to show updated list
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

        // Delete Functions
        function confirmDeleteCategory(id) {
            currentDeleteType = 'category';
            currentDeleteId = id;
            document.getElementById('deleteConfirmBody').innerHTML = 'Apakah Anda yakin ingin menghapus kategori ini? Semua topik dalam kategori ini juga akan terhapus.';
            document.getElementById('confirmDeleteBtn').onclick = function() { performDeleteCategory(id); };
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        function confirmDeleteThread(id) {
            currentDeleteType = 'thread';
            currentDeleteId = id;
            document.getElementById('deleteConfirmBody').innerHTML = 'Apakah Anda yakin ingin menghapus topik ini? Semua komentar dalam topik ini juga akan terhapus.';
            document.getElementById('confirmDeleteBtn').onclick = function() { performDeleteThread(id); };
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        function performDeleteCategory(id) {
            fetch('<?php echo site_url('admin_forum/ajax_delete_category/'); ?>' + id, { method: 'POST' })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                    closeDeleteModal();
                });
        }

        function performDeleteThread(id) {
            fetch('<?php echo site_url('admin_forum/ajax_delete_thread/'); ?>' + id, { method: 'POST' })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                    closeDeleteModal();
                });
        }

        function closeDeleteModal() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
        }

        // Close modals on outside click
        window.onclick = function(event) {
            const categoryModal = document.getElementById('categoryModal');
            const deleteModal = document.getElementById('deleteConfirmModal');
            if (event.target === categoryModal) {
                closeCategoryModal();
            }
            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        }
    </script>
</div>
