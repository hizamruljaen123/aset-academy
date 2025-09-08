<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
        <!-- Card Header -->
        <div class="p-8 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
            <h2 class="text-2xl font-bold text-gray-800">Edit Kelas</h2>
            <p class="text-gray-500 mt-2">Perbarui detail kelas programming di bawah ini.</p>
        </div>
        
        <!-- Card Body -->
        <div class="p-8">
            <?php echo form_open('kelas/edit/'.$kelas->id, 'class="space-y-6"'); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="nama_kelas" class="block text-sm font-medium text-gray-700">Nama Kelas <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_kelas" name="nama_kelas" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo set_value('nama_kelas', $kelas->nama_kelas); ?>" required>
                        <?php echo form_error('nama_kelas', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <div class="space-y-2">
                        <label for="bahasa_program" class="block text-sm font-medium text-gray-700">Bahasa Program <span class="text-red-500">*</span></label>
                        <input type="text" id="bahasa_program" name="bahasa_program" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo set_value('bahasa_program', $kelas->bahasa_program); ?>" required>
                        <?php echo form_error('bahasa_program', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi <span class="text-red-500">*</span></label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required><?php echo set_value('deskripsi', $kelas->deskripsi); ?></textarea>
                        <?php echo form_error('deskripsi', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <div class="space-y-2">
                        <label for="level" class="block text-sm font-medium text-gray-700">Level <span class="text-red-500">*</span></label>
                        <select id="level" name="level" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="" disabled>-- Pilih Level --</option>
                            <option value="Dasar" <?php echo set_select('level', 'Dasar', $kelas->level == 'Dasar'); ?>>Dasar</option>
                            <option value="Menengah" <?php echo set_select('level', 'Menengah', $kelas->level == 'Menengah'); ?>>Menengah</option>
                            <option value="Lanjutan" <?php echo set_select('level', 'Lanjutan', $kelas->level == 'Lanjutan'); ?>>Lanjutan</option>
                        </select>
                        <?php echo form_error('level', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <div class="space-y-2">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                        <select id="status" name="status" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="" disabled>-- Pilih Status --</option>
                            <option value="Aktif" <?php echo set_select('status', 'Aktif', $kelas->status == 'Aktif'); ?>>Aktif</option>
                            <option value="Tidak Aktif" <?php echo set_select('status', 'Tidak Aktif', $kelas->status == 'Tidak Aktif'); ?>>Tidak Aktif</option>
                        </select>
                        <?php echo form_error('status', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <div class="space-y-2">
                        <label for="durasi" class="block text-sm font-medium text-gray-700">Durasi (jam) <span class="text-red-500">*</span></label>
                        <input type="number" id="durasi" name="durasi" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo set_value('durasi', $kelas->durasi); ?>" required>
                        <?php echo form_error('durasi', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <div class="space-y-2">
                        <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" id="harga" name="harga" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo set_value('harga', $kelas->harga); ?>" required>
                        <?php echo form_error('harga', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label for="online_meet_link" class="block text-sm font-medium text-gray-700">Link Belajar Online</label>
                        <input type="url" id="online_meet_link" name="online_meet_link" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo set_value('online_meet_link', $kelas->online_meet_link); ?>" placeholder="https://zoom.us/j/1234567890">
                        <?php echo form_error('online_meet_link', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                </div>

                <div class="flex justify-end items-center space-x-3 pt-6 border-t border-gray-200/50 mt-8">
                    <a href="<?php echo site_url('kelas'); ?>" class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-300 rounded-xl font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 border border-transparent rounded-xl font-medium text-sm text-white shadow-sm hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i> Update Kelas
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