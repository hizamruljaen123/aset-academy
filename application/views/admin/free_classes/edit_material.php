<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="p-4 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Header with gradient background -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl text-white">
        <div class="mb-4 md:mb-0">
            <h1 class="text-2xl font-bold">Edit Materi: <?php echo html_escape($material->title); ?></h1>
            <p class="text-blue-100">Kelas: <?php echo html_escape($free_class->title); ?></p>
        </div>
        <a href="<?php echo site_url('admin/free_classes/edit/' . $free_class->id); ?>" class="inline-flex items-center px-4 py-2 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Kelas
        </a>
    </div>

    <!-- Alert Messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="mb-6 p-4 rounded-lg bg-green-50 border-l-4 border-green-500 flex items-center fade-in">
            <div class="rounded-full bg-green-100 p-2 mr-3">
                <i class="fas fa-check-circle text-green-600"></i>
            </div>
            <div class="flex-1 text-green-700">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="mb-6 p-4 rounded-lg bg-red-50 border-l-4 border-red-500 flex items-center fade-in">
            <div class="rounded-full bg-red-100 p-2 mr-3">
                <i class="fas fa-exclamation-circle text-red-600"></i>
            </div>
            <div class="flex-1 text-red-700">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
        <div class="p-6">
            <?php echo form_open('admin/free_classes/edit_material/' . $material->id, ['class' => 'space-y-6']); ?>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Materi <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo set_value('title', $material->title); ?>" required>
                        <?php echo form_error('title', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi <span class="text-red-500">*</span></label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required><?php echo set_value('description', $material->description); ?></textarea>
                        <?php echo form_error('description', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <div>
                        <label for="content_type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Konten <span class="text-red-500">*</span></label>
                        <select name="content_type" id="content_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" onchange="updateContentField()" required>
                            <option value="text" <?php echo set_select('content_type', 'text', $material->content_type === 'text'); ?>>Teks</option>
                            <option value="video" <?php echo set_select('content_type', 'video', $material->content_type === 'video'); ?>>Video (URL)</option>
                            <option value="pdf" <?php echo set_select('content_type', 'pdf', $material->content_type === 'pdf'); ?>>PDF (Nama File)</option>
                            <option value="link" <?php echo set_select('content_type', 'link', $material->content_type === 'link'); ?>>Tautan Eksternal</option>
                        </select>
                        <?php echo form_error('content_type', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <div id="content_field_container">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1" id="content_label">Konten <span class="text-red-500">*</span></label>
                        <div id="text_content" style="display: <?php echo ($material->content_type === 'text') ? 'block' : 'none'; ?>">
                            <textarea name="content" id="content_text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" rows="5"><?php echo ($material->content_type === 'text') ? set_value('content', $material->content) : ''; ?></textarea>
                        </div>
                        <div id="video_content" style="display: <?php echo ($material->content_type === 'video') ? 'block' : 'none'; ?>">
                            <input type="url" name="content" id="content_video" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo ($material->content_type === 'video') ? set_value('content', $material->content) : ''; ?>">
                            <p class="mt-1 text-xs text-gray-500">Masukkan URL video (contoh: https://www.youtube.com/watch?v=...)</p>
                        </div>
                        <div id="pdf_content" style="display: <?php echo ($material->content_type === 'pdf') ? 'block' : 'none'; ?>">
                            <input type="text" name="content" id="content_pdf" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo ($material->content_type === 'pdf') ? set_value('content', $material->content) : ''; ?>">
                            <p class="mt-1 text-xs text-gray-500">Masukkan nama file PDF yang sudah diunggah ke server</p>
                        </div>
                        <div id="link_content" style="display: <?php echo ($material->content_type === 'link') ? 'block' : 'none'; ?>">
                            <input type="url" name="content" id="content_link" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo ($material->content_type === 'link') ? set_value('content', $material->content) : ''; ?>">
                            <p class="mt-1 text-xs text-gray-500">Masukkan URL lengkap (contoh: https://contoh.com/materi)</p>
                        </div>
                        <?php echo form_error('content', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan <span class="text-red-500">*</span></label>
                        <input type="number" name="order" id="order" class="mt-1 block w-24 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" min="1" value="<?php echo set_value('order', $material->order); ?>" required>
                        <?php echo form_error('order', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 mt-8">
                    <a href="<?php echo site_url('admin/free_classes/edit/' . $free_class->id); ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fade in main container
        document.querySelector('.transition-opacity').classList.remove('opacity-0');
        
        // Initialize content field based on current content type
        updateContentField();
    });
    
    function updateContentField() {
        const contentType = document.getElementById('content_type').value;
        
        // Hide all content fields
        document.getElementById('text_content').style.display = 'none';
        document.getElementById('video_content').style.display = 'none';
        document.getElementById('pdf_content').style.display = 'none';
        document.getElementById('link_content').style.display = 'none';
        
        // Show selected content field
        document.getElementById(contentType + '_content').style.display = 'block';
        
        // Update content label
        const labels = {
            'text': 'Isi Teks',
            'video': 'URL Video',
            'pdf': 'Nama File PDF',
            'link': 'Tautan Eksternal'
        };
        document.getElementById('content_label').innerHTML = labels[contentType] + ' <span class="text-red-500">*</span>';
    }
</script>
