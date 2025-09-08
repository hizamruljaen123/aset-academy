<!-- Page Header -->
<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Hero Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 bg-white p-6 rounded-2xl shadow-xl ring-1 ring-gray-200/50">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-800 bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                <?php echo $materi->judul; ?>
            </h1>
            <p class="text-lg text-gray-500 mt-2"><?php echo $materi->deskripsi; ?></p>
            <div class="flex items-center mt-4 space-x-2">
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                    Materi ID: <?php echo $materi->id; ?>
                </span>
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                    Kelas: <?php echo $kelas->nama_kelas; ?>
                </span>
            </div>
        </div>
        <a href="<?php echo site_url('kelas/detail/' . $materi->kelas_id); ?>" 
           class="inline-flex items-center px-5 py-3 bg-white border border-gray-300 rounded-xl font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Kelas
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <?php if (empty($parts)): ?>
                <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200/50 p-8 text-center">
                    <div class="mx-auto h-24 w-24 flex items-center justify-center rounded-full bg-gradient-to-br from-gray-100 to-gray-200 text-gray-400 shadow-inner mb-5">
                        <i class="fas fa-box-open text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Belum ada konten</h3>
                    <p class="text-gray-500 mb-4">Mulai dengan menambahkan konten pertama menggunakan form di samping</p>
                </div>
            <?php else: ?>
                <?php foreach ($parts as $part): ?>
                    <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200/50 overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div class="flex items-center gap-4">
                                    <?php 
                                        $iconColor = 'text-gray-400';
                                        if ($part->part_type == 'video') $iconColor = 'text-red-500';
                                        if ($part->part_type == 'image') $iconColor = 'text-blue-500';
                                        if ($part->part_type == 'pdf') $iconColor = 'text-purple-500';
                                    ?>
                                    <div class="p-3 rounded-full bg-gradient-to-br from-gray-50 to-white shadow-inner">
                                        <i class="fas <?php 
                                            echo ($part->part_type == 'video') ? 'fa-video' : 
                                               (($part->part_type == 'image') ? 'fa-image' : 
                                               (($part->part_type == 'pdf') ? 'fa-file-pdf' : 'fa-link')); 
                                        ?> text-xl <?php echo $iconColor; ?>"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors duration-200">
                                            <?php echo $part->part_title; ?>
                                        </h4>
                                        <span class="text-xs font-medium px-2 py-1 rounded-full uppercase <?php 
                                            echo ($part->part_type == 'video') ? 'bg-red-100 text-red-800' : 
                                               (($part->part_type == 'image') ? 'bg-blue-100 text-blue-800' : 
                                               (($part->part_type == 'pdf') ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800')); 
                                        ?>">
                                            <?php echo $part->part_type; ?>
                                        </span>
                                    </div>
                                </div>
                                <a href="<?php echo site_url('materi/delete_part/' . $part->id); ?>" 
                                   class="text-gray-400 hover:text-red-500 transition-colors duration-200"
                                   onclick="return confirm('Yakin ingin menghapus part ini?')" 
                                   title="Hapus Part">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                            
                            <div class="mt-4 pl-14">
                                <?php if ($part->part_type == 'image'): ?>
                                    <img src="<?php echo base_url('uploads/' . $part->part_content); ?>" 
                                         alt="<?php echo $part->part_title; ?>" 
                                         class="max-w-full rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <?php elseif ($part->part_type == 'pdf'): ?>
                                    <a href="<?php echo base_url('uploads/' . $part->part_content); ?>" target="_blank"
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg text-white font-medium hover:from-purple-600 hover:to-purple-700 transition-all duration-200">
                                        <i class="fas fa-file-pdf mr-2"></i> Lihat PDF
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo $part->part_content; ?>" target="_blank"
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg text-white font-medium hover:from-blue-600 hover:to-blue-700 transition-all duration-200">
                                        <i class="fas <?php echo ($part->part_type == 'video') ? 'fa-play' : 'fa-external-link-alt'; ?> mr-2"></i>
                                        <?php echo ($part->part_type == 'video') ? 'Tonton Video' : 'Buka Link'; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 sticky top-6 overflow-hidden">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h3 class="text-xl font-bold text-gray-800">Tambah Konten Baru</h3>
                </div>
                <div class="p-6">
                    <?php echo form_open_multipart('materi/add_part/' . $materi->id, 'class="space-y-4"'); ?>
                        <div class="space-y-2">
                            <label for="part_title" class="block text-sm font-medium text-gray-700">Judul Konten</label>
                            <input type="text" name="part_title" id="part_title" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="part_type" class="block text-sm font-medium text-gray-700">Tipe Konten</label>
                            <select name="part_type" id="part_type" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="" disabled selected>Pilih Tipe</option>
                                <option value="video">Video (Link)</option>
                                <option value="image">Gambar (Upload)</option>
                                <option value="pdf">PDF (Upload)</option>
                                <option value="link">Link Eksternal</option>
                            </select>
                        </div>
                        
                        <div id="content-input-area">
                            <!-- Dynamic input will appear here -->
                        </div>
                        
                        <button type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <i class="fas fa-plus-circle mr-2"></i> Simpan Konten
                        </button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const page = document.querySelector('.transition-opacity');
    if (page) page.classList.add('opacity-100');

    const partTypeSelect = document.getElementById('part_type');
    const contentInputArea = document.getElementById('content-input-area');

    partTypeSelect.addEventListener('change', function() {
        const selectedType = this.value;
        let html = '';

        if (selectedType === 'video' || selectedType === 'link') {
            html = `
                <div class="space-y-2 mt-4">
                    <label for="part_content_link" class="block text-sm font-medium text-gray-700">URL</label>
                    <input type="url" name="part_content_link" id="part_content_link" 
                           class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           required placeholder="https://example.com">
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
                                    <input id="part_content_file" name="part_content_file" type="file" class="sr-only" accept="${fileType}" required>
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
