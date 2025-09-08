

<div class="card fade-in">
    <div class="card-header">
        <div>
            <h2 class="card-title">Tambah Kelas Baru</h2>
            <p class="card-subtitle">Isi detail kelas programming di bawah ini.</p>
        </div>
    </div>

    <div class="card-body">
        <?php echo form_open('kelas/create', ['class' => 'grid grid-cols-1 md:grid-cols-2 gap-6']); ?>

        <div>
            <label for="nama_kelas" class="form-label">Nama Kelas <span class="text-red-500">*</span></label>
            <input type="text" id="nama_kelas" name="nama_kelas" class="form-input" value="<?php echo set_value('nama_kelas'); ?>" required>
            <?php echo form_error('nama_kelas', '<p class="form-error">', '</p>'); ?>
        </div>

        <div>
            <label for="bahasa_program" class="form-label">Bahasa Program <span class="text-red-500">*</span></label>
            <input type="text" id="bahasa_program" name="bahasa_program" class="form-input" value="<?php echo set_value('bahasa_program'); ?>" required>
            <?php echo form_error('bahasa_program', '<p class="form-error">', '</p>'); ?>
        </div>

        <div class="md:col-span-2">
            <label for="deskripsi" class="form-label">Deskripsi <span class="text-red-500">*</span></label>
            <textarea id="deskripsi" name="deskripsi" class="form-input" rows="4" required><?php echo set_value('deskripsi'); ?></textarea>
            <?php echo form_error('deskripsi', '<p class="form-error">', '</p>'); ?>
        </div>

        <div>
            <label for="level" class="form-label">Level <span class="text-red-500">*</span></label>
            <select id="level" name="level" class="form-select" required>
                <option value="" disabled selected>-- Pilih Level --</option>
                <option value="Dasar" <?php echo set_select('level', 'Dasar'); ?>>Dasar</option>
                <option value="Menengah" <?php echo set_select('level', 'Menengah'); ?>>Menengah</option>
                <option value="Lanjutan" <?php echo set_select('level', 'Lanjutan'); ?>>Lanjutan</option>
            </select>
            <?php echo form_error('level', '<p class="form-error">', '</p>'); ?>
        </div>

        <div>
            <label for="status" class="form-label">Status <span class="text-red-500">*</span></label>
            <select id="status" name="status" class="form-select" required>
                <option value="" disabled selected>-- Pilih Status --</option>
                <option value="Aktif" <?php echo set_select('status', 'Aktif'); ?>>Aktif</option>
                <option value="Tidak Aktif" <?php echo set_select('status', 'Tidak Aktif'); ?>>Tidak Aktif</option>
            </select>
            <?php echo form_error('status', '<p class="form-error">', '</p>'); ?>
        </div>

        <div>
            <label for="durasi" class="form-label">Durasi (jam) <span class="text-red-500">*</span></label>
            <input type="number" id="durasi" name="durasi" class="form-input" value="<?php echo set_value('durasi'); ?>" required>
            <?php echo form_error('durasi', '<p class="form-error">', '</p>'); ?>
        </div>

        <div>
            <label for="harga" class="form-label">Harga (Rp) <span class="text-red-500">*</span></label>
            <input type="number" id="harga" name="harga" class="form-input" value="<?php echo set_value('harga'); ?>" required>
            <?php echo form_error('harga', '<p class="form-error">', '</p>'); ?>
        </div>

        <div class="md:col-span-2">
            <label for="online_meet_link" class="form-label">Link Belajar Online</label>
            <div class="relative">
                <i class="fas fa-link absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="url" id="online_meet_link" name="online_meet_link" class="form-input pl-10" value="<?php echo set_value('online_meet_link'); ?>" placeholder="https://zoom.us/j/1234567890">
            </div>
            <?php echo form_error('online_meet_link', '<p class="form-error">', '</p>'); ?>
        </div>

        <div class="md:col-span-2 flex justify-end items-center space-x-3 pt-4 border-t border-gray-200 mt-4">
            <a href="<?php echo site_url('kelas'); ?>" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Kelas
            </button>
        </div>

        <?php echo form_close(); ?>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>