
<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Hero Header -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 bg-white p-6 rounded-2xl shadow-xl ring-1 ring-gray-200/50">
        <div class="flex-1">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between sm:gap-4">
                <div class="flex-1">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        <?php echo $materi->judul; ?>
                    </h1>
                    <div class="text-base sm:text-lg text-gray-500 mt-2 prose max-w-none"><?php echo $materi->deskripsi; ?></div>
                    <div class="flex flex-wrap items-center gap-2 mt-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                            Materi ID: <?php echo $materi->id; ?>
                        </span>
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                            Kelas: <?php echo $kelas->nama_kelas; ?>
                        </span>
                        <a href="<?php echo site_url('kelas/detail/' . $materi->kelas_id); ?>"
                           class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Kelas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-8 space-y-6 overflow-y-auto" style="max-height: 550px;">
            <?php if (empty($parts)): ?>
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl shadow-lg ring-1 ring-gray-200/50 p-8 text-center border-t-4 border-blue-500">
                    <div class="mx-auto h-20 w-20 flex items-center justify-center rounded-full bg-blue-50 text-blue-500 shadow-inner mb-5">
                        <i class="fas fa-lightbulb text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-gray-800 mb-3">Materi Ini Masih Kosong!</h3>
                    <p class="text-gray-600 text-lg mb-6">Ayo mulai tambahkan konten menarik untuk materi ini.</p>
                    <p class="text-sm text-gray-500">Gunakan form di samping untuk menambahkan video, gambar, PDF, atau link eksternal.</p>
                </div>
            <?php else: ?>
                <?php foreach ($parts as $part): ?>
                    <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200/50 overflow-hidden transition-all duration-300 hover:scale-[1.01] hover:shadow-xl group">
                        <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-4 flex-grow">
                                <?php
                                    $iconClass = 'fa-link';
                                    $iconColor = 'text-gray-500';
                                    $badgeBg = 'bg-gray-100 text-gray-800';

                                    if ($part->part_type == 'video') {
                                        $iconClass = 'fa-video';
                                        $iconColor = 'text-red-500';
                                        $badgeBg = 'bg-red-100 text-red-800';
                                    } elseif ($part->part_type == 'image') {
                                        $iconClass = 'fa-image';
                                        $iconColor = 'text-blue-500';
                                        $badgeBg = 'bg-blue-100 text-blue-800';
                                    } elseif ($part->part_type == 'pdf') {
                                        $iconClass = 'fa-file-pdf';
                                        $iconColor = 'text-purple-500';
                                        $badgeBg = 'bg-purple-100 text-purple-800';
                                    }
                                ?>
                                <div class="p-3 rounded-full bg-gradient-to-br from-gray-50 to-white shadow-inner flex-shrink-0">
                                    <i class="fas <?php echo $iconClass; ?> text-xl <?php echo $iconColor; ?>"></i>
                                </div>
                                <div class="flex-grow">
                                    <h4 class="font-bold text-lg text-gray-800 group-hover:text-blue-600 transition-colors duration-200">
                                        <?php echo $part->part_title; ?>
                                    </h4>
                                    <span class="text-xs font-medium px-2 py-1 rounded-full uppercase <?php echo $badgeBg; ?>">
                                        <?php echo $part->part_type; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-shrink-0 flex items-center gap-3 mt-3 sm:mt-0">
                                <?php if ($part->part_type == 'image'): ?>
                                    <a href="<?php echo base_url('uploads/' . $part->part_content); ?>" target="_blank"
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg text-white font-medium hover:from-blue-600 hover:to-blue-700 transition-all duration-200 text-sm shadow-md">
                                        <i class="fas fa-eye mr-2"></i> Lihat Gambar
                                    </a>
                                <?php elseif ($part->part_type == 'pdf'): ?>
                                    <a href="<?php echo base_url('uploads/' . $part->part_content); ?>" target="_blank"
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg text-white font-medium hover:from-purple-600 hover:to-purple-700 transition-all duration-200 text-sm shadow-md">
                                        <i class="fas fa-file-pdf mr-2"></i> Lihat PDF
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo $part->part_content; ?>" target="_blank"
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg text-white font-medium hover:from-blue-600 hover:to-blue-700 transition-all duration-200 text-sm shadow-md">
                                        <i class="fas <?php echo ($part->part_type == 'video') ? 'fa-play' : 'fa-external-link-alt'; ?> mr-2"></i>
                                        <?php echo ($part->part_type == 'video') ? 'Tonton Video' : 'Buka Link'; ?>
                                    </a>
                                <?php endif; ?>
                                <a href="<?php echo site_url('materi/delete_part/' . $part->id); ?>"
                                   class="p-2 rounded-full bg-gray-100 text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors duration-200"
                                   onclick="return confirm('Yakin ingin menghapus part ini?')"
                                   title="Hapus Part">
                                    <i class="fas fa-trash text-base"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-4">
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 sticky top-6 overflow-hidden border-t-4 border-indigo-500">
                <div class="p-6 bg-gradient-to-r from-indigo-50 to-white border-b border-gray-200/50">
                    <h3 class="text-2xl font-extrabold text-indigo-800 flex items-center gap-3">
                        <i class="fas fa-plus-square text-indigo-500"></i> Tambah Konten Baru
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Lengkapi detail untuk menambahkan bagian materi.</p>
                </div>
                <div class="p-6">
                    <?php echo form_open_multipart('materi/add_part/' . $materi->id, 'class="space-y-5"'); ?>
                        <div class="space-y-2">
                            <label for="part_title" class="block text-sm font-semibold text-gray-700">Judul Konten</label>
                            <input type="text" name="part_title" id="part_title" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5" placeholder="Contoh: Pengenalan HTML" required>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="part_type" class="block text-sm font-semibold text-gray-700">Tipe Konten</label>
                            <select name="part_type" id="part_type" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 bg-white" required>
                                <option value="" disabled selected>Pilih Tipe</option>
                                <option value="video">Video (Link YouTube/Vimeo)</option>
                                <option value="image">Gambar (Upload JPG/PNG)</option>
                                <option value="pdf">PDF (Upload Dokumen)</option>
                                <option value="link">Link Eksternal (Website)</option>
                            </select>
                        </div>
                        
                        <div id="content-input-area">
                            <!-- Dynamic input will appear here -->
                        </div>
                        
                        <button type="submit"
                                class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-base font-semibold text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:-translate-y-0.5">
                            <i class="fas fa-cloud-upload-alt mr-2"></i> Simpan Konten Baru
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
                <div class="space-y-2 mt-5">
                    <label for="part_content_link" class="block text-sm font-semibold text-gray-700">URL Konten</label>
                    <input type="url" name="part_content_link" id="part_content_link"
                           class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5"
                           required placeholder="https://www.youtube.com/watch?v=example">
                </div>
            `;
        } else if (selectedType === 'image' || selectedType === 'pdf') {
            const fileType = selectedType === 'image' ? 'image/*' : '.pdf';
            html = `
                <div class="space-y-2 mt-5">
                    <label for="part_content_file" class="block text-sm font-semibold text-gray-700">Upload File</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-indigo-300 border-dashed rounded-xl hover:border-indigo-400 transition-colors duration-200">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-indigo-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="part_content_file" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Unggah file</span>
                                    <input id="part_content_file" name="part_content_file" type="file" class="sr-only" accept="${fileType}" required>
                                </label>
                                <p class="pl-1">atau seret dan lepas</p>
                            </div>
                            <p class="text-xs text-gray-500">${selectedType === 'image' ? 'PNG, JPG, GIF hingga 10MB' : 'PDF hingga 10MB'}</p>
                        </div>
                    </div>
                </div>
            `;
        }

        contentInputArea.innerHTML = html;
    });
});
</script>
