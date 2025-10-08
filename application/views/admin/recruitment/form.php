<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="max-w-screen-xl mx-auto p-6 space-y-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Lowongan Kerja</h1>
            <p class="text-gray-600">Perbarui detail posisi pekerjaan dan status publikasinya.</p>
        </div>
        <div class="flex gap-2">
            <a href="<?= site_url('admin/recruitment'); ?>" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm text-gray-600 hover:bg-gray-100"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
            <?php $previewUrl = site_url('career/detail/' . $this->encryption_url->encode($position->id)); ?>
            <a href="<?= $previewUrl; ?>" target="_blank" class="inline-flex items-center rounded-lg bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-600 hover:bg-blue-100"><i class="fas fa-external-link-alt mr-2"></i>Lihat Halaman Publik</a>
        </div>
    </div>

    <?php if (!empty($this->session->flashdata('success'))): ?>
        <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
            <div class="flex items-start">
                <i class="fas fa-check-circle mr-3 mt-1"></i>
                <div><?= $this->session->flashdata('success'); ?></div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($this->session->flashdata('error'))): ?>
        <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
            <div class="flex items-start">
                <i class="fas fa-exclamation-triangle mr-3 mt-1"></i>
                <div><?= $this->session->flashdata('error'); ?></div>
            </div>
        </div>
    <?php endif; ?>

    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
        <?= form_open('admin/recruitment/update/' . $this->encryption_url->encode($position->id), ['class' => 'p-6 space-y-8', 'autocomplete' => 'off']); ?>
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Judul Pekerjaan</label>
                        <input type="text" name="title" value="<?= set_value('title', $position->title); ?>" class="form-input" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Departemen</label>
                        <input type="text" name="department" value="<?= set_value('department', $position->department); ?>" class="form-input" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                        <input type="text" name="location" value="<?= set_value('location', $position->location); ?>" class="form-input" required>
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Pekerjaan</label>
                            <select name="employment_type" class="form-select" required>
                                <?php foreach (['Full-time','Part-time','Contract','Internship','Freelance'] as $type): ?>
                                    <option value="<?= $type; ?>" <?= set_select('employment_type', $type, $position->employment_type === $type); ?>><?= $type; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Level Pengalaman</label>
                            <select name="experience_level" class="form-select" required>
                                <?php foreach (['Entry Level','Junior','Mid Level','Senior','Expert'] as $level): ?>
                                    <option value="<?= $level; ?>" <?= set_select('experience_level', $level, $position->experience_level === $level); ?>><?= $level; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rentang Gaji (opsional)</label>
                        <input type="text" name="salary_range" value="<?= set_value('salary_range', $position->salary_range); ?>" class="form-input" placeholder="Contoh: Rp 8.000.000 - Rp 12.000.000">
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Deadline Lamaran</label>
                            <input type="date" name="application_deadline" value="<?= set_value('application_deadline', $position->application_deadline); ?>" class="form-input">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Maksimal Pelamar</label>
                            <input type="number" min="1" name="max_applications" value="<?= set_value('max_applications', $position->max_applications); ?>" class="form-input">
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center gap-4">
                        <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                            <input type="checkbox" name="is_featured" value="1" class="h-4 w-4 rounded border-gray-300 text-blue-600" <?= set_checkbox('is_featured', '1', (int)$position->is_featured === 1); ?>>
                            Tandai sebagai featured
                        </label>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="form-select" required>
                                <?php foreach (['Draft','Published','Closed','Archived'] as $status): ?>
                                    <option value="<?= $status; ?>" <?= set_select('status', $status, $position->status === $status); ?>><?= $status; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi Pekerjaan</label>
                        <textarea name="description" rows="6" class="form-textarea" required><?= set_value('description', $position->description); ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggung Jawab</label>
                        <textarea name="responsibilities" rows="5" class="form-textarea" placeholder="Daftar tanggung jawab utama"><?= set_value('responsibilities', $position->responsibilities); ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Persyaratan</label>
                        <textarea name="requirements" rows="6" class="form-textarea" required><?= set_value('requirements', $position->requirements); ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Benefit</label>
                        <textarea name="benefits" rows="4" class="form-textarea" placeholder="Fasilitas dan benefit yang diberikan"><?= set_value('benefits', $position->benefits); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-200 pt-4">
                <a href="<?= site_url('admin/recruitment'); ?>" class="rounded-lg border border-gray-200 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50">Batal</a>
                <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Simpan Perubahan</button>
            </div>
        <?= form_close(); ?>
    </div>
</div>
