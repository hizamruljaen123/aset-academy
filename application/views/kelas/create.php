<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<div class="max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-6 mb-8 text-white">
        <div class="flex items-center space-x-4">
            <div class="bg-white/20 p-3 rounded-full">
                <i class="fas fa-code text-2xl"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold">Tambah Kelas Programming Baru</h1>
                <p class="text-blue-100 mt-1">Isi detail kelas untuk menambah koleksi kursus programming Anda</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-8 py-6">
            <?php echo form_open('kelas/create', ['class' => 'space-y-8']); ?>

            <!-- Basic Information Section -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-info-circle text-blue-600"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800">Informasi Dasar</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Kelas -->
                    <div class="space-y-2">
                        <label for="nama_kelas" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-tag text-blue-500 mr-2"></i>
                            Nama Kelas
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="text" id="nama_kelas" name="nama_kelas"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white"
                               value="<?php echo set_value('nama_kelas'); ?>"
                               placeholder="Masukkan nama kelas programming"
                               required>
                        <?php echo form_error('nama_kelas', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Kategori -->
                    <div class="space-y-2">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-folder text-blue-500 mr-2"></i>
                            Kategori
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <select id="category_id" name="category_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white"
                                required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category->id; ?>" <?php echo set_select('category_id', $category->id); ?>>
                                        <?php echo $category->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <?php echo form_error('category_id', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Bahasa Program -->
                    <div class="space-y-2">
                        <label for="bahasa_program" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-code text-blue-500 mr-2"></i>
                            Bahasa Program
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="text" id="bahasa_program" name="bahasa_program"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white"
                               value="<?php echo set_value('bahasa_program'); ?>"
                               placeholder="Contoh: Python, JavaScript, PHP"
                               required>
                        <?php echo form_error('bahasa_program', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Level -->
                    <div class="space-y-2">
                        <label for="level" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-layer-group text-green-500 mr-2"></i>
                            Level Kesulitan
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <select id="level" name="level"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white"
                                required>
                            <option value="" disabled selected>-- Pilih Level --</option>
                            <option value="Dasar" <?php echo set_select('level', 'Dasar'); ?>>Dasar</option>
                            <option value="Menengah" <?php echo set_select('level', 'Menengah'); ?>>Menengah</option>
                            <option value="Lanjutan" <?php echo set_select('level', 'Lanjutan'); ?>>Lanjutan</option>
                        </select>
                        <?php echo form_error('level', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="space-y-2">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                        Deskripsi Kelas
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <!-- Quill Editor -->
                    <div id="editor" style="height: 200px;"></div>
                    <!-- Hidden textarea for form submission -->
                    <textarea id="deskripsi" name="deskripsi" style="display: none;" required><?php echo set_value('deskripsi'); ?></textarea>
                    <?php echo form_error('deskripsi', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>
            </div>

            <!-- Settings Section -->
            <div class="space-y-6 pt-8 border-t border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-cogs text-green-600"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800">Pengaturan Kelas</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Level -->
                    <div class="space-y-2">
                        <label for="level" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-layer-group text-green-500 mr-2"></i>
                            Level Kesulitan
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <select id="level" name="level"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white"
                                required>
                            <option value="" disabled selected>-- Pilih Level --</option>
                            <option value="Dasar" <?php echo set_select('level', 'Dasar'); ?>>Dasar</option>
                            <option value="Menengah" <?php echo set_select('level', 'Menengah'); ?>>Menengah</option>
                            <option value="Lanjutan" <?php echo set_select('level', 'Lanjutan'); ?>>Lanjutan</option>
                        </select>
                        <?php echo form_error('level', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <label for="status" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-toggle-on text-green-500 mr-2"></i>
                            Status Kelas
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <select id="status" name="status"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white"
                                required>
                            <option value="" disabled selected>-- Pilih Status --</option>
                            <option value="Aktif" <?php echo set_select('status', 'Aktif'); ?>>Aktif</option>
                            <option value="Coming Soon" <?php echo set_select('status', 'Coming Soon'); ?>>Coming Soon</option>
                            <option value="Tidak Aktif" <?php echo set_select('status', 'Tidak Aktif'); ?>>Tidak Aktif</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Coming Soon: Kelas sudah dibuat dan muncul di website namun masih menunggu persiapan</p>
                        <?php echo form_error('status', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Durasi -->
                    <div class="space-y-2">
                        <label for="durasi" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-clock text-green-500 mr-2"></i>
                            Durasi (Jam)
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="number" id="durasi" name="durasi" min="1"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white"
                               value="<?php echo set_value('durasi'); ?>"
                               placeholder="20"
                               required>
                        <?php echo form_error('durasi', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                </div>
            </div>

            <!-- Pricing Section -->
            <div class="space-y-6 pt-8 border-t border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-money-bill-wave text-yellow-600"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800">Harga dan Pembayaran</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Harga -->
                    <div class="space-y-2">
                        <label for="harga" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-dollar-sign text-yellow-500 mr-2"></i>
                            Harga (Rp)
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                            <input type="number" id="harga" name="harga" min="0"
                                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white"
                                   value="<?php echo set_value('harga'); ?>"
                                   placeholder="500000"
                                   required>
                        </div>
                        <?php echo form_error('harga', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Online Meeting Link -->
                    <div class="space-y-2">
                        <label for="online_meet_link" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-video text-yellow-500 mr-2"></i>
                            Link Belajar Online
                        </label>
                        <div class="relative">
                            <i class="fas fa-link absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="url" id="online_meet_link" name="online_meet_link"
                                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white"
                                   value="<?php echo set_value('online_meet_link'); ?>"
                                   placeholder="https://zoom.us/j/1234567890 atau https://meet.google.com/abc-defg-hij">
                        </div>
                        <?php echo form_error('online_meet_link', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-end items-center space-y-3 sm:space-y-0 sm:space-x-4 pt-8 border-t border-gray-200">
                <a href="<?php echo site_url('kelas'); ?>"
                   class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-blue-600 border border-transparent rounded-lg text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Kelas
                </button>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
// Initialize Quill editor
var quill = new Quill('#editor', {
    theme: 'snow',
    placeholder: 'Jelaskan secara detail tentang kelas ini, materi yang akan dipelajari, dan target siswa',
    modules: {
        toolbar: [
            [{ 'header': [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['link', 'image'],
            ['clean']
        ]
    }
});

// Set initial content if available
<?php if (set_value('deskripsi')): ?>
    quill.root.innerHTML = <?= json_encode(set_value('deskripsi')) ?>;
<?php endif; ?>

// Update hidden textarea when content changes
quill.on('text-change', function() {
    document.getElementById('deskripsi').value = quill.root.innerHTML;
});

// Update textarea on form submit
document.querySelector('form').addEventListener('submit', function() {
    document.getElementById('deskripsi').value = quill.root.innerHTML;
});
</script>

<?php $this->load->view('templates/footer'); ?>
