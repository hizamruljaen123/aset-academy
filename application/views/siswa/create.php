

<div class="bg-white rounded-lg shadow-xl overflow-hidden fade-in">
    <div class="p-6 bg-gradient-to-r from-cyan-500 to-teal-500 text-white">
        <div class="flex items-center space-x-4">
            <i class="fas fa-user-plus fa-2x"></i>
            <div>
                <h2 class="text-2xl font-bold">Tambah Siswa Baru</h2>
                <p class="text-sm opacity-90">Isi detail siswa di bawah ini untuk mendaftarkan siswa baru.</p>
            </div>
        </div>
    </div>

    <div class="p-6">
                        <?php 
        if(isset($error_upload)) {
            echo '<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert"><p>'. $error_upload .'</p></div>';
        }
        echo form_open_multipart('siswa/create'); 
        ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
                <div class="mt-2 flex justify-center items-center w-full">
                    <label for="foto_profil" class="flex flex-col justify-center items-center w-full h-full bg-gray-50 rounded-lg border-2 border-dashed border-gray-300 cursor-pointer hover:bg-gray-100 transition-colors p-6">
                        <img id="image_preview" src="<?php echo base_url('assets/images/default_avatar.png'); ?>" alt="Image Preview" class="h-32 w-32 object-cover rounded-full <?php echo set_value('foto_profil') ? '' : 'hidden'; ?>">
                        <div id="upload_placeholder" class="flex flex-col justify-center items-center pt-5 pb-6 <?php echo set_value('foto_profil') ? 'hidden' : ''; ?>">
                            <i class="fas fa-cloud-upload-alt fa-3x text-gray-400"></i>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk unggah</span></p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF (MAX. 2MB)</p>
                        </div>
                        <input id="foto_profil" name="foto_profil" type="file" class="hidden" onchange="previewImage(event)">
                    </label>
                </div> 
            </div>

            <div class="lg:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Informasi Pribadi</h3>
                    </div>
                    <div>
                        <label for="nis" class="block text-sm font-medium text-gray-700">NIS <span class="text-red-500">*</span></label>
                        <input type="text" id="nis" name="nis" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="<?php echo set_value('nis'); ?>" required>
                        <?php echo form_error('nis', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
                    </div>
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="<?php echo set_value('nama_lengkap'); ?>" required>
                        <?php echo form_error('nama_lengkap', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="<?php echo set_value('email'); ?>" required>
                        <?php echo form_error('email', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
                    </div>
                    <div>
                        <label for="no_telepon" class="block text-sm font-medium text-gray-700">No Telepon <span class="text-red-500">*</span></label>
                        <input type="text" id="no_telepon" name="no_telepon" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="<?php echo set_value('no_telepon'); ?>" required>
                        <?php echo form_error('no_telepon', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
                    </div>
                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea id="alamat" name="alamat" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" rows="3"><?php echo set_value('alamat'); ?></textarea>
                        <?php echo form_error('alamat', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
                    </div>
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="<?php echo set_value('tanggal_lahir'); ?>" required>
                        <?php echo form_error('tanggal_lahir', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
                    </div>
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                            <option value="L" <?php echo set_select('jenis_kelamin', 'L'); ?>>Laki-laki</option>
                            <option value="P" <?php echo set_select('jenis_kelamin', 'P'); ?>>Perempuan</option>
                        </select>
                        <?php echo form_error('jenis_kelamin', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
                    </div>
                    <div class="md:col-span-2 mt-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Informasi Akademik</h3>
                    </div>
                    <div>
                        <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas Programming <span class="text-red-500">*</span></label>
                        <select id="kelas" name="kelas" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="" disabled selected>-- Pilih Kelas --</option>
                            <?php foreach ($kelas_list as $k): ?>
                                <option value="<?php echo $k->nama_kelas; ?>" <?php echo set_select('kelas', $k->nama_kelas); ?>>
                                    <?php echo $k->nama_kelas; ?> (<?php echo $k->level; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo form_error('kelas', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
                    </div>
                    <div>
                        <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan <span class="text-red-500">*</span></label>
                        <select id="jurusan" name="jurusan" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="" disabled selected>-- Pilih Jurusan --</option>
                            <option value="Rekayasa Perangkat Lunak" <?php echo set_select('jurusan', 'Rekayasa Perangkat Lunak'); ?>>Rekayasa Perangkat Lunak</option>
                            <option value="Teknik Komputer dan Jaringan" <?php echo set_select('jurusan', 'Teknik Komputer dan Jaringan'); ?>>Teknik Komputer dan Jaringan</option>
                            <option value="Multimedia" <?php echo set_select('jurusan', 'Multimedia'); ?>>Multimedia</option>
                            <option value="Akuntansi" <?php echo set_select('jurusan', 'Akuntansi'); ?>>Akuntansi</option>
                            <option value="Administrasi Perkantoran" <?php echo set_select('jurusan', 'Administrasi Perkantoran'); ?>>Administrasi Perkantoran</option>
                        </select>
                        <?php echo form_error('jurusan', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                        <select id="status" name="status" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="" disabled selected>-- Pilih Status --</option>
                            <option value="Aktif" <?php echo set_select('status', 'Aktif'); ?>>Aktif</option>
                            <option value="Tidak Aktif" <?php echo set_select('status', 'Tidak Aktif'); ?>>Tidak Aktif</option>
                            <option value="Lulus" <?php echo set_select('status', 'Lulus'); ?>>Lulus</option>
                        </select>
                        <?php echo form_error('status', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end items-center space-x-4 pt-6 border-t border-gray-200 mt-6">
            <a href="<?php echo site_url('siswa'); ?>" class="inline-flex items-center px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-sm transition-transform transform hover:scale-105">
                <i class="fas fa-times mr-2"></i> Batal
            </a>
            <button type="submit" class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-cyan-500 to-teal-500 hover:from-cyan-600 hover:to-teal-600 text-white font-semibold rounded-lg shadow-lg transition-transform transform hover:scale-105">
                <i class="fas fa-save mr-2"></i> Simpan Siswa
            </button>
        </div>

        <?php echo form_close(); ?>
    </div>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('image_preview');
        const placeholder = document.getElementById('upload_placeholder');
        output.src = reader.result;
        output.classList.remove('hidden');
        placeholder.classList.add('hidden');
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

<?php $this->load->view('templates/footer'); ?>