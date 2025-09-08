

<div class="card fade-in">
    <div class="card-header">
        <div>
            <h2 class="card-title">Tambah Siswa Baru</h2>
            <p class="card-subtitle">Isi detail siswa di bawah ini.</p>
        </div>
    </div>

    <div class="card-body">
        <?php echo form_open('siswa/create', ['class' => 'grid grid-cols-1 md:grid-cols-2 gap-6']); ?>

        <div>
            <label for="nis" class="form-label">NIS <span class="text-red-500">*</span></label>
            <input type="text" id="nis" name="nis" class="form-input" value="<?php echo set_value('nis'); ?>" required>
            <?php echo form_error('nis', '<p class="form-error">', '</p>'); ?>
        </div>

        <div>
            <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-input" value="<?php echo set_value('nama_lengkap'); ?>" required>
            <?php echo form_error('nama_lengkap', '<p class="form-error">', '</p>'); ?>
        </div>

        <div>
            <label for="email" class="form-label">Email <span class="text-red-500">*</span></label>
            <input type="email" id="email" name="email" class="form-input" value="<?php echo set_value('email'); ?>" required>
            <?php echo form_error('email', '<p class="form-error">', '</p>'); ?>
        </div>

        <div>
            <label for="no_telepon" class="form-label">No Telepon <span class="text-red-500">*</span></label>
            <input type="text" id="no_telepon" name="no_telepon" class="form-input" value="<?php echo set_value('no_telepon'); ?>" required>
            <?php echo form_error('no_telepon', '<p class="form-error">', '</p>'); ?>
        </div>

        <div>
            <label for="kelas" class="form-label">Kelas Programming <span class="text-red-500">*</span></label>
            <select id="kelas" name="kelas" class="form-select" required>
                <option value="" disabled selected>-- Pilih Kelas --</option>
                <?php foreach ($kelas_list as $k): ?>
                    <option value="<?php echo $k->nama_kelas; ?>" <?php echo set_select('kelas', $k->nama_kelas); ?>>
                        <?php echo $k->nama_kelas; ?> (<?php echo $k->level; ?>)
                    </option>
                <?php endforeach; ?>
            </select>
            <?php echo form_error('kelas', '<p class="form-error">', '</p>'); ?>
        </div>

        <div>
            <label for="jurusan" class="form-label">Jurusan <span class="text-red-500">*</span></label>
            <select id="jurusan" name="jurusan" class="form-select" required>
                <option value="" disabled selected>-- Pilih Jurusan --</option>
                <option value="Rekayasa Perangkat Lunak" <?php echo set_select('jurusan', 'Rekayasa Perangkat Lunak'); ?>>Rekayasa Perangkat Lunak</option>
                <option value="Teknik Komputer dan Jaringan" <?php echo set_select('jurusan', 'Teknik Komputer dan Jaringan'); ?>>Teknik Komputer dan Jaringan</option>
                <option value="Multimedia" <?php echo set_select('jurusan', 'Multimedia'); ?>>Multimedia</option>
                <option value="Akuntansi" <?php echo set_select('jurusan', 'Akuntansi'); ?>>Akuntansi</option>
                <option value="Administrasi Perkantoran" <?php echo set_select('jurusan', 'Administrasi Perkantoran'); ?>>Administrasi Perkantoran</option>
            </select>
            <?php echo form_error('jurusan', '<p class="form-error">', '</p>'); ?>
        </div>

        <div class="md:col-span-2">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea id="alamat" name="alamat" class="form-input" rows="3"><?php echo set_value('alamat'); ?></textarea>
            <?php echo form_error('alamat', '<p class="form-error">', '</p>'); ?>
        </div>

        <div>
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-red-500">*</span></label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-input" value="<?php echo set_value('tanggal_lahir'); ?>" required>
            <?php echo form_error('tanggal_lahir', '<p class="form-error">', '</p>'); ?>
        </div>

        <div>
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-red-500">*</span></label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                <option value="L" <?php echo set_select('jenis_kelamin', 'L'); ?>>Laki-laki</option>
                <option value="P" <?php echo set_select('jenis_kelamin', 'P'); ?>>Perempuan</option>
            </select>
            <?php echo form_error('jenis_kelamin', '<p class="form-error">', '</p>'); ?>
        </div>

        <div>
            <label for="status" class="form-label">Status <span class="text-red-500">*</span></label>
            <select id="status" name="status" class="form-select" required>
                <option value="" disabled selected>-- Pilih Status --</option>
                <option value="Aktif" <?php echo set_select('status', 'Aktif'); ?>>Aktif</option>
                <option value="Tidak Aktif" <?php echo set_select('status', 'Tidak Aktif'); ?>>Tidak Aktif</option>
                <option value="Lulus" <?php echo set_select('status', 'Lulus'); ?>>Lulus</option>
            </select>
            <?php echo form_error('status', '<p class="form-error">', '</p>'); ?>
        </div>

        <div class="md:col-span-2 flex justify-end items-center space-x-3 pt-4 border-t border-gray-200 mt-4">
            <a href="<?php echo site_url('siswa'); ?>" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Siswa
            </button>
        </div>

        <?php echo form_close(); ?>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>