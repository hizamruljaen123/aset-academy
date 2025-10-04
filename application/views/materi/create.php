<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
        <!-- Card Header -->
        <div class="p-8 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
            <h2 class="text-2xl font-bold text-gray-800">Tambah Materi Baru</h2>
            <p class="text-gray-500 mt-2">Isi detail materi di bawah ini.</p>
        </div>
        
        <!-- Card Body -->
        <div class="p-8">
            <?php echo form_open('materi/create/' . $kelas_id, 'class="space-y-6"'); ?>

                <!-- Judul Materi -->
                <div class="space-y-2">
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul Materi <span class="text-red-500">*</span></label>
                    <input type="text" id="judul" name="judul" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo set_value('judul'); ?>" required>
                    <?php echo form_error('judul', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>

                <!-- Deskripsi -->
                <div class="space-y-2">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Singkat <span class="text-red-500">*</span></label>
                    <!-- Quill Editor -->
                    <div id="editor" style="height: 150px;"></div>
                    <!-- Hidden textarea for form submission -->
                    <textarea id="deskripsi" name="deskripsi" style="display: none;" required><?php echo set_value('deskripsi'); ?></textarea>
                    <?php echo form_error('deskripsi', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>

                <!-- Konten Awal -->
                <div class="pt-6 border-t border-gray-200/50 mt-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-6">Konten Awal (Opsional)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="part_title" class="block text-sm font-medium text-gray-700">Judul Konten</label>
                            <input type="text" name="part_title" id="part_title" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div class="space-y-2">
                            <label for="part_type" class="block text-sm font-medium text-gray-700">Tipe Konten</label>
                            <select name="part_type" id="part_type" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Tidak ada</option>
                                <option value="video">Video (Link)</option>
                                <option value="image">Gambar (Upload)</option>
                                <option value="pdf">PDF (Upload)</option>
                                <option value="link">Link Eksternal</option>
                            </select>
                        </div>
                    </div>
                    <div id="content-input-area" class="mt-6">
                        <!-- Input dinamis akan muncul di sini -->
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end items-center space-x-3 pt-6 border-t border-gray-200/50 mt-8">
                    <a href="<?php echo site_url('materi/index/' . $kelas_id); ?>" class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-300 rounded-xl font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 border border-transparent rounded-xl font-medium text-sm text-white shadow-sm hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i> Simpan Materi
                    </button>
                </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const materiPage = document.querySelector('.transition-opacity');
    if (materiPage) {
        materiPage.classList.add('opacity-100');
    }

    const partTypeSelect = document.getElementById('part_type');
    const contentInputArea = document.getElementById('content-input-area');

    partTypeSelect.addEventListener('change', function() {
        const selectedType = this.value;
        let html = '';

        if (selectedType === 'video' || selectedType === 'link') {
            html = `
                <div class="space-y-2 mt-4">
                    <label for="part_content_link" class="block text-sm font-medium text-gray-700">URL</label>
                    <input type="url" name="part_content_link" id="part_content_link" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="https://example.com">
                </div>
            `;
        } else if (selectedType === 'image' || selectedType === 'pdf') {
            const fileType = selectedType === 'image' ? 'image/*' : '.pdf';
            html = `
                <div class="space-y-2 mt-4">
                    <label for="part_content_file" class="block text-sm font-medium text-gray-700">Upload File</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="part_content_file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Upload file</span>
                                    <input id="part_content_file" name="part_content_file" type="file" class="sr-only" accept="${fileType}">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">${selectedType === 'image' ? 'PNG, JPG, GIF up to 10MB' : 'PDF up to 10MB'}</p>
                        </div>
                    </div>
                </div>
            `;
        }

        contentInputArea.innerHTML = html;
    });
});
</script>

<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
// Initialize Quill editor
var quill = new Quill('#editor', {
    theme: 'snow',
    placeholder: 'Jelaskan singkat tentang materi ini...',
    modules: {
        toolbar: [
            ['bold', 'italic', 'underline'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['link'],
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
