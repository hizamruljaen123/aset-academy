<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
        <!-- Card Header -->
        <div class="p-8 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
            <h2 class="text-2xl font-bold text-gray-800">Edit Materi</h2>
            <p class="text-gray-500 mt-2">Perbarui detail materi di bawah ini.</p>
        </div>
        
        <!-- Card Body -->
        <div class="p-8">
            <?php echo form_open('materi/edit/' . $materi->id, 'class="space-y-6"'); ?>

                <!-- Judul Materi -->
                <div class="space-y-2">
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul Materi <span class="text-red-500">*</span></label>
                    <input type="text" id="judul" name="judul" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo set_value('judul', $materi->judul); ?>" required>
                    <?php echo form_error('judul', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>

                <!-- Deskripsi -->
                <div class="space-y-2">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Singkat <span class="text-red-500">*</span></label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required><?php echo set_value('deskripsi', $materi->deskripsi); ?></textarea>
                    <?php echo form_error('deskripsi', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end items-center space-x-3 pt-6 border-t border-gray-200/50 mt-8">
                    <a href="<?php echo site_url('materi/index/' . $materi->kelas_id); ?>" class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-300 rounded-xl font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 border border-transparent rounded-xl font-medium text-sm text-white shadow-sm hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i> Update Materi
                    </button>
                </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const page = document.querySelector('.transition-opacity');
    if (page) page.classList.add('opacity-100');
});
</script>

<?php $this->load->view('templates/footer'); ?>
