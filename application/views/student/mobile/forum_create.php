<div class="container mx-auto px-4 py-6 max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <!-- Header with blue background -->
        <div class="bg-blue-600 px-6 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-white">Buat Thread Baru</h1>
                <a href="<?= site_url('student_mobile/forum') ?>" class="text-blue-100 hover:text-white">
                    <i data-feather="x" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
        
        <!-- Form section -->
        <div class="p-6">
            <?= form_open('student_mobile/forum/save_thread') ?>
                
                <!-- Title field -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Thread <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Contoh: Cara mengerjakan tugas matematika"
                           value="<?= set_value('title') ?>"
                           required
                           autofocus>
                    <?= form_error('title', '<p class="mt-2 text-sm text-red-600">', '</p>') ?>
                </div>
                
                <!-- Category selection -->
                <div class="mb-6">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->id ?>" <?= set_select('category_id', $category->id) ?>><?= html_escape($category->name) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('category_id', '<p class="mt-2 text-sm text-red-600">', '</p>') ?>
                </div>
                
                <!-- Content field -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Isi Thread <span class="text-red-500">*</span></label>
                    <textarea name="content" id="content" rows="8" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Tulis penjelasan lengkap tentang thread Anda..."
                              required><?= set_value('content') ?></textarea>
                    <?= form_error('content', '<p class="mt-2 text-sm text-red-600">', '</p>') ?>
                </div>
                
                <!-- Form actions -->
                <div class="flex justify-end space-x-3">
                    <a href="<?= site_url('student_mobile/forum') ?>" 
                       class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <i data-feather="plus" class="w-4 h-4 mr-2 inline"></i>
                        Buat Thread
                    </button>
                </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        feather.replace();
        
        // Auto-resize textarea
        const textarea = document.getElementById('content');
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight) + 'px';
        
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    });
</script>
