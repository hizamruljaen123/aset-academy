<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
        <!-- Card Header -->
        <div class="p-8 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
            <h2 class="text-2xl font-bold text-gray-800">Edit Siswa</h2>
            <p class="text-gray-500 mt-2">Perbarui detail siswa di bawah ini.</p>
        </div>
        
        <!-- Card Body -->
        <div class="p-8">
            <?php echo form_open('siswa/edit/' . encrypt_url($siswa->id), 'class="space-y-6"'); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- NIS -->
                    <div class="space-y-2">
                        <label for="nis" class="block text-sm font-medium text-gray-700">NIS <span class="text-red-500">*</span></label>
                        <input type="text" id="nis" name="nis" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo set_value('nis', $siswa->nis); ?>" required>
                        <?php echo form_error('nis', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="space-y-2">
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo set_value('nama_lengkap', $siswa->nama_lengkap); ?>" required>
                        <?php echo form_error('nama_lengkap', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo set_value('email', $siswa->email); ?>" required>
                        <?php echo form_error('email', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- No Telepon -->
                    <div class="space-y-2">
                        <label for="no_telepon" class="block text-sm font-medium text-gray-700">No Telepon <span class="text-red-500">*</span></label>
                        <input type="text" id="no_telepon" name="no_telepon" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo set_value('no_telepon', $siswa->no_telepon); ?>" required>
                        <?php echo form_error('no_telepon', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Kelas -->
                    <div class="space-y-2">
                        <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas Programming <span class="text-red-500">*</span></label>
                        <select id="kelas" name="kelas" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">-- Pilih Kelas --</option>
                            <?php foreach ($kelas_list as $k): ?>
                                <option value="<?php echo $k->nama_kelas; ?>" <?php echo set_select('kelas', $k->nama_kelas, ($siswa->kelas == $k->nama_kelas)); ?>>
                                    <?php echo $k->nama_kelas; ?> (<?php echo $k->level; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo form_error('kelas', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Jurusan -->
                    <div class="space-y-2">
                        <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan <span class="text-red-500">*</span></label>
                        <select id="jurusan" name="jurusan" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">-- Pilih Jurusan --</option>
                            <option value="Rekayasa Perangkat Lunak" <?php echo set_select('jurusan', 'Rekayasa Perangkat Lunak', ($siswa->jurusan == 'Rekayasa Perangkat Lunak')); ?>>Rekayasa Perangkat Lunak</option>
                            <option value="Teknik Komputer dan Jaringan" <?php echo set_select('jurusan', 'Teknik Komputer dan Jaringan', ($siswa->jurusan == 'Teknik Komputer dan Jaringan')); ?>>Teknik Komputer dan Jaringan</option>
                            <option value="Multimedia" <?php echo set_select('jurusan', 'Multimedia', ($siswa->jurusan == 'Multimedia')); ?>>Multimedia</option>
                            <option value="Akuntansi" <?php echo set_select('jurusan', 'Akuntansi', ($siswa->jurusan == 'Akuntansi')); ?>>Akuntansi</option>
                            <option value="Administrasi Perkantoran" <?php echo set_select('jurusan', 'Administrasi Perkantoran', ($siswa->jurusan == 'Administrasi Perkantoran')); ?>>Administrasi Perkantoran</option>
                        </select>
                        <?php echo form_error('jurusan', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Alamat -->
                    <div class="space-y-2 md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea id="alamat" name="alamat" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" rows="3"><?php echo set_value('alamat', $siswa->alamat); ?></textarea>
                        <?php echo form_error('alamat', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="space-y-2">
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="<?php echo set_value('tanggal_lahir', $siswa->tanggal_lahir); ?>" required>
                        <?php echo form_error('tanggal_lahir', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="space-y-2">
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L" <?php echo set_select('jenis_kelamin', 'L', ($siswa->jenis_kelamin == 'L')); ?>>Laki-laki</option>
                            <option value="P" <?php echo set_select('jenis_kelamin', 'P', ($siswa->jenis_kelamin == 'P')); ?>>Perempuan</option>
                        </select>
                        <?php echo form_error('jenis_kelamin', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                        <select id="status" name="status" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Aktif" <?php echo set_select('status', 'Aktif', ($siswa->status == 'Aktif')); ?>>Aktif</option>
                            <option value="Tidak Aktif" <?php echo set_select('status', 'Tidak Aktif', ($siswa->status == 'Tidak Aktif')); ?>>Tidak Aktif</option>
                            <option value="Lulus" <?php echo set_select('status', 'Lulus', ($siswa->status == 'Lulus')); ?>>Lulus</option>
                        </select>
                        <?php echo form_error('status', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                </div>

                <div class="flex justify-end items-center space-x-3 pt-6 border-t border-gray-200/50 mt-8">
                    <a href="<?php echo site_url('siswa'); ?>" class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-300 rounded-xl font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 border border-transparent rounded-xl font-medium text-sm text-white shadow-sm hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i> Update Siswa
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