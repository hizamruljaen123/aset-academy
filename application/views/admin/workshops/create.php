<div class="max-w-screen-xl mx-auto p-4">
    <div class="mb-6">
        <a href="<?= site_url('admin/workshops') ?>" class="text-blue-600 hover:text-blue-800 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Workshop
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Buat Workshop/Seminar Baru</h1>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p><?= $this->session->flashdata('error') ?></p>
            </div>
        <?php endif; ?>

        <?= form_open_multipart('admin/workshops/create', ['class' => 'space-y-6']) ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1 md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Workshop</label>
                    <input type="text" name="title" id="title" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('title') ?>" required>
                    <?= form_error('title', '<p class="mt-1 text-sm text-red-600">', '</p>') ?>
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Jenis</label>
                    <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="workshop" <?= set_select('type', 'workshop', true) ?>>Workshop</option>
                        <option value="seminar" <?= set_select('type', 'seminar') ?>>Seminar</option>
                    </select>
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                    <input type="number" name="price" id="price" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('price', '0') ?>">
                    <p class="mt-1 text-xs text-gray-500">Masukkan 0 untuk workshop gratis</p>
                </div>

                <div>
                    <label for="start_datetime" class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai</label>
                    <input type="datetime-local" name="start_datetime" id="start_datetime" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('start_datetime') ?>" required>
                    <?= form_error('start_datetime', '<p class="mt-1 text-sm text-red-600">', '</p>') ?>
                </div>

                <div>
                    <label for="end_datetime" class="block text-sm font-medium text-gray-700 mb-1">Waktu Selesai</label>
                    <input type="datetime-local" name="end_datetime" id="end_datetime" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('end_datetime') ?>" required>
                    <?= form_error('end_datetime', '<p class="mt-1 text-sm text-red-600">', '</p>') ?>
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <input type="text" name="location" id="location" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('location') ?>" required>
                    <?= form_error('location', '<p class="mt-1 text-sm text-red-600">', '</p>') ?>
                </div>

                <div>
                    <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-1">Maksimal Peserta</label>
                    <input type="number" name="max_participants" id="max_participants" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('max_participants', '30') ?>" required>
                    <?= form_error('max_participants', '<p class="mt-1 text-sm text-red-600">', '</p>') ?>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= set_value('description') ?></textarea>
                    <?= form_error('description', '<p class="mt-1 text-sm text-red-600">', '</p>') ?>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-3">Poster Workshop</label>

                    <!-- Poster Upload Area -->
                    <div class="relative">
                        <div id="poster-upload-area" class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-blue-400 transition-colors duration-300 cursor-pointer bg-gray-50 hover:bg-blue-50">
                            <div id="poster-preview" class="hidden mb-4">
                                <img id="poster-image" src="" alt="Poster Preview" class="max-w-full max-h-64 mx-auto rounded-lg shadow-lg">
                                <button type="button" id="remove-poster" class="mt-2 px-3 py-1 bg-red-500 text-white text-sm rounded-md hover:bg-red-600 transition-colors">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </div>

                            <div id="upload-placeholder">
                                <div class="mb-4">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                </div>
                                <div class="text-lg font-medium text-gray-700 mb-2">Upload Poster Workshop</div>
                                <div class="text-sm text-gray-500 mb-4">
                                    Klik untuk memilih file atau drag & drop gambar di sini
                                </div>
                                <div class="text-xs text-gray-400">
                                    Format: JPG, JPEG, PNG, GIF • Maks: 2MB • Rekomendasi: 1200x800px
                                </div>
                            </div>

                            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        </div>
                    </div>

                    <!-- Upload Progress -->
                    <div id="upload-progress" class="hidden mt-4">
                        <div class="bg-gray-200 rounded-full h-2">
                            <div id="progress-bar" class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                        </div>
                        <div class="text-sm text-gray-600 mt-1" id="progress-text">Mengupload...</div>
                    </div>

                    <!-- Error Messages -->
                    <div id="upload-error" class="hidden mt-2 p-3 bg-red-100 border border-red-400 text-red-700 rounded-md text-sm">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span id="error-message"></span>
                    </div>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="draft" <?= set_select('status', 'draft', true) ?>>Draft</option>
                        <option value="published" <?= set_select('status', 'published') ?>>Published</option>
                    </select>
                </div>
            </div>

            <div class="pt-5 border-t border-gray-200">
                <div class="flex justify-end">
                    <a href="<?= site_url('admin/workshops') ?>" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </a>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan Workshop
                    </button>
                </div>
            </div>
        <?= form_close() ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const descriptionField = document.getElementById('description');

    // Initialize a simple WYSIWYG editor if available
    if (typeof ClassicEditor !== 'undefined') {
        ClassicEditor
            .create(descriptionField)
            .catch(error => {
                console.error(error);
            });
    }

    // Enhanced Poster Upload Functionality
    const posterUploadArea = document.getElementById('poster-upload-area');
    const thumbnailInput = document.getElementById('thumbnail');
    const posterPreview = document.getElementById('poster-preview');
    const posterImage = document.getElementById('poster-image');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const removePosterBtn = document.getElementById('remove-poster');
    const uploadProgress = document.getElementById('upload-progress');
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');
    const uploadError = document.getElementById('upload-error');
    const errorMessage = document.getElementById('error-message');

    let selectedFile = null;

    // Drag and Drop functionality
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        posterUploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        posterUploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        posterUploadArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        posterUploadArea.classList.add('border-blue-500', 'bg-blue-50');
        posterUploadArea.classList.remove('border-gray-300', 'bg-gray-50');
    }

    function unhighlight(e) {
        posterUploadArea.classList.remove('border-blue-500', 'bg-blue-50');
        posterUploadArea.classList.add('border-gray-300', 'bg-gray-50');
    }

    posterUploadArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length > 0) {
            handleFileSelect(files[0]);
        }
    }

    // File input change handler
    thumbnailInput.addEventListener('change', function(e) {
        if (this.files.length > 0) {
            handleFileSelect(this.files[0]);
        }
    });

    // Remove poster handler
    removePosterBtn.addEventListener('click', function() {
        resetPosterUpload();
    });

    function handleFileSelect(file) {
        // Validate file
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        const maxSize = 2 * 1024 * 1024; // 2MB

        if (!validTypes.includes(file.type)) {
            showError('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
            return;
        }

        if (file.size > maxSize) {
            showError('Ukuran file terlalu besar. Maksimal 2MB.');
            return;
        }

        selectedFile = file;
        previewImage(file);
        hideError();
    }

    function previewImage(file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            posterImage.src = e.target.result;
            uploadPlaceholder.classList.add('hidden');
            posterPreview.classList.remove('hidden');
        };

        reader.readAsDataURL(file);
    }

    function resetPosterUpload() {
        selectedFile = null;
        thumbnailInput.value = '';
        posterImage.src = '';
        posterPreview.classList.add('hidden');
        uploadPlaceholder.classList.remove('hidden');
        hideError();
    }

    function showError(message) {
        errorMessage.textContent = message;
        uploadError.classList.remove('hidden');
    }

    function hideError() {
        uploadError.classList.add('hidden');
    }

    // Form validation enhancement
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        // Additional validation can be added here
        if (selectedFile) {
            // File is selected, proceed with form submission
            showUploadProgress();
        }
    });

    function showUploadProgress() {
        uploadProgress.classList.remove('hidden');
        let progress = 0;

        const interval = setInterval(() => {
            progress += Math.random() * 15;
            if (progress >= 100) {
                progress = 100;
                clearInterval(interval);
            }

            progressBar.style.width = progress + '%';
            progressText.textContent = 'Mengupload... ' + Math.round(progress) + '%';
        }, 200);
    }

    // Image optimization helper
    function optimizeImage(file, maxWidth = 1200, maxHeight = 800, quality = 0.8) {
        return new Promise((resolve) => {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            const img = new Image();

            img.onload = function() {
                // Calculate new dimensions
                let { width, height } = img;

                if (width > height) {
                    if (width > maxWidth) {
                        height = (height * maxWidth) / width;
                        width = maxWidth;
                    }
                } else {
                    if (height > maxHeight) {
                        width = (width * maxHeight) / height;
                        height = maxHeight;
                    }
                }

                canvas.width = width;
                canvas.height = height;

                // Draw and compress
                ctx.drawImage(img, 0, 0, width, height);

                canvas.toBlob(resolve, 'image/jpeg', quality);
            };

            img.src = URL.createObjectURL(file);
        });
    }
});
</script>
