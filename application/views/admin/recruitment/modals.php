<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$employmentTypes = ['Full-time', 'Part-time', 'Contract', 'Internship', 'Freelance'];
$experienceLevels = ['Entry Level', 'Junior', 'Mid Level', 'Senior', 'Expert'];
$statuses = ['Draft', 'Published', 'Closed', 'Archived'];
?>

<div id="create-position-modal" class="modal-wrapper fixed inset-0 z-50 hidden items-center justify-center bg-black/30 p-4">
    <div class="max-h-[90vh] w-full max-w-4xl overflow-y-auto rounded-2xl bg-white shadow-xl">
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Buat Lowongan Baru</h2>
                <p class="text-sm text-gray-500">Lengkapi detail lowongan sebelum dipublikasikan.</p>
            </div>
            <button type="button" data-modal-dismiss class="rounded-full p-2 text-gray-500 hover:bg-gray-100">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <?= form_open('admin/recruitment/store', ['class' => 'space-y-6 px-6 py-6', 'autocomplete' => 'off']); ?>
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Judul Pekerjaan</label>
                        <input type="text" name="title" value="<?= set_value('title'); ?>" class="form-input" placeholder="Contoh: Backend Engineer" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Departemen</label>
                        <input type="text" name="department" value="<?= set_value('department'); ?>" class="form-input" placeholder="Contoh: Engineering" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                        <input type="text" name="location" value="<?= set_value('location'); ?>" class="form-input" placeholder="Contoh: Jakarta / Remote" required>
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Pekerjaan</label>
                            <select name="employment_type" class="form-select" required>
                                <option value="">Pilih tipe</option>
                                <?php foreach ($employmentTypes as $type): ?>
                                    <option value="<?= $type; ?>" <?= set_select('employment_type', $type); ?>><?= $type; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Level Pengalaman</label>
                            <select name="experience_level" class="form-select" required>
                                <option value="">Pilih level</option>
                                <?php foreach ($experienceLevels as $level): ?>
                                    <option value="<?= $level; ?>" <?= set_select('experience_level', $level); ?>><?= $level; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rentang Gaji</label>
                        <input type="text" name="salary_range" value="<?= set_value('salary_range'); ?>" class="form-input" placeholder="Contoh: Rp 8.000.000 - Rp 12.000.000">
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Deadline Lamaran</label>
                            <input type="date" name="application_deadline" value="<?= set_value('application_deadline'); ?>" class="form-input">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Maks. Pelamar</label>
                            <input type="number" min="1" name="max_applications" value="<?= set_value('max_applications'); ?>" class="form-input" placeholder="Contoh: 50">
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                            <input type="checkbox" name="is_featured" value="1" class="h-4 w-4 rounded border-gray-300 text-blue-600" <?= set_checkbox('is_featured', '1'); ?>>
                            Tandai sebagai featured
                        </label>
                        <select name="status" class="form-select w-auto" required>
                            <?php foreach ($statuses as $status): ?>
                                <option value="<?= $status; ?>" <?= set_select('status', $status, $status === 'Draft'); ?>><?= $status; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi Pekerjaan</label>
                        <textarea name="description" rows="6" class="form-textarea" placeholder="Gambaran umum pekerjaan" required><?= set_value('description'); ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggung Jawab</label>
                        <textarea name="responsibilities" rows="5" class="form-textarea" placeholder="Daftar tanggung jawab utama"><?= set_value('responsibilities'); ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Persyaratan</label>
                        <textarea name="requirements" rows="6" class="form-textarea" placeholder="Syarat yang harus dipenuhi" required><?= set_value('requirements'); ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Benefit</label>
                        <textarea name="benefits" rows="4" class="form-textarea" placeholder="Manfaat yang ditawarkan"><?= set_value('benefits'); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-200 pt-4">
                <button type="button" data-modal-dismiss class="rounded-lg border border-gray-200 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50">Batal</button>
                <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Simpan Lowongan</button>
            </div>
        <?= form_close(); ?>
    </div>
</div>
