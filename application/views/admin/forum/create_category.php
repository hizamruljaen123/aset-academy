<div class="max-w-screen-xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <a href="<?php echo site_url('admin_forum'); ?>" class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Tambah Kategori Forum</h1>
            <p class="text-gray-600 mt-2">Buat kategori baru untuk mengorganisir diskusi forum</p>
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

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form action="<?php echo site_url('admin_forum/create_category'); ?>" method="post">
                <div class="space-y-6">
                    <!-- Category Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kategori <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan nama kategori" required>
                        <?php echo form_error('name', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="description" id="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Jelaskan tentang kategori ini (opsional)"></textarea>
                        <?php echo form_error('description', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                            Slug <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="slug" id="slug" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="nama-kategori" required>
                        <p class="mt-1 text-sm text-gray-500">Slug digunakan dalam URL. Gunakan huruf kecil, angka, dan tanda hubung (-) saja.</p>
                        <?php echo form_error('slug', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Auto-generate slug -->
                    <div>
                        <button type="button" id="generate-slug" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            <i class="fas fa-magic mr-1"></i>Generate Slug dari Nama
                        </button>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                    <a href="<?php echo site_url('admin_forum'); ?>" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-save mr-2"></i>Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Auto-generate slug from name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const slug = name.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
        .replace(/\s+/g, '-') // Replace spaces with hyphens
        .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
        .trim('-'); // Trim hyphens from start and end

    document.getElementById('slug').value = slug;
});

// Manual generate slug button
document.getElementById('generate-slug').addEventListener('click', function() {
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    const name = nameInput.value;
    const slug = name.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
        .replace(/\s+/g, '-') // Replace spaces with hyphens
        .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
        .trim('-'); // Trim hyphens from start and end

    slugInput.value = slug;
});
</script>
