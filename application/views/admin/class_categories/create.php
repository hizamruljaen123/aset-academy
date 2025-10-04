<!-- Content Area -->
<div class="max-w-3xl mx-auto">
    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-center">
            <a href="<?php echo site_url('admin/class_categories'); ?>"
               class="mr-4 text-gray-500 hover:text-gray-700 transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Tambah Kategori Kelas</h1>
                <p class="text-gray-600">Buat kategori baru untuk mengelompokkan kelas</p>
            </div>
        </div>
    </div>

    <!-- Create Form -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <form action="<?php echo site_url('admin/class_categories/create'); ?>" method="POST" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Kategori -->
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="<?php echo set_value('name'); ?>"
                           class="form-input w-full <?php echo (form_error('name')) ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : ''; ?>"
                           placeholder="Contoh: Web Development, Mobile App, Data Science"
                           required>
                    <?php echo form_error('name', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>

                <!-- Tipe Kelas -->
                <div>
                    <label for="class_type" class="block text-sm font-medium text-gray-700 mb-2">
                        Tipe Kelas <span class="text-red-500">*</span>
                    </label>
                    <select id="class_type"
                            name="class_type"
                            class="form-select w-full <?php echo (form_error('class_type')) ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : ''; ?>"
                            required>
                        <option value="">Pilih Tipe Kelas</option>
                        <option value="premium" <?php echo set_select('class_type', 'premium'); ?>>
                            Premium (Kelas Programming)
                        </option>
                        <option value="free" <?php echo set_select('class_type', 'free'); ?>>
                            Gratis (Free Classes)
                        </option>
                    </select>
                    <?php echo form_error('class_type', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>

                <!-- Status Aktif -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status
                    </label>
                    <div class="flex items-center">
                        <input type="checkbox"
                               id="is_active"
                               name="is_active"
                               value="1"
                               <?php echo set_checkbox('is_active', '1', TRUE); ?>
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">
                            Aktif (kategori dapat digunakan)
                        </label>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea id="description"
                              name="description"
                              rows="4"
                              class="form-textarea w-full <?php echo (form_error('description')) ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : ''; ?>"
                              placeholder="Jelaskan kategori ini lebih detail..."><?php echo set_value('description'); ?></textarea>
                    <?php echo form_error('description', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200 mt-6">
                <a href="<?php echo site_url('admin/class_categories'); ?>"
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                    Batal
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>

    <!-- Information Panel -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-400"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">Informasi</h3>
                <div class="mt-2 text-sm text-blue-700">
                    <ul class="list-disc list-inside space-y-1">
                        <li>Kategori digunakan untuk mengelompokkan kelas dengan topik yang sama</li>
                        <li>Slug akan dibuat otomatis dari nama kategori</li>
                        <li>Kategori yang tidak aktif tidak akan ditampilkan di halaman publik</li>
                        <li>Setiap kategori dapat digunakan untuk kelas premium atau gratis</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-generate slug from name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const slug = name.toLowerCase()
        .replace(/[^a-z0-9 -]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
    // You can add a slug preview here if needed
});
</script>
