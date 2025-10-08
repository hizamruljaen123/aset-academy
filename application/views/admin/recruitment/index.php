<div class="max-w-screen-xl mx-auto p-6 space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Lowongan Kerja</h1>
            <p class="text-gray-600">Kelola posisi pekerjaan yang aktif dan pantau performa rekrutmen.</p>
        </div>
        <div class="flex gap-2">
            <button data-modal-target="create-position-modal" data-modal-toggle="create-position-modal"
                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-white shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <i class="fas fa-plus mr-2"></i>Buat Lowongan</button>
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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Lowongan</p>
                    <p class="text-2xl font-bold text-gray-900"><?= (int) ($stats['total_positions'] ?? 0); ?></p>
                </div>
                <div class="rounded-full bg-blue-100 p-3 text-blue-600">
                    <i class="fas fa-briefcase"></i>
                </div>
            </div>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Dipublikasikan</p>
                    <p class="text-2xl font-bold text-gray-900"><?= (int) ($stats['published_positions'] ?? 0); ?></p>
                </div>
                <div class="rounded-full bg-green-100 p-3 text-green-600">
                    <i class="fas fa-bullhorn"></i>
                </div>
            </div>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Lamaran Aktif</p>
                    <p class="text-2xl font-bold text-gray-900"><?= (int) ($stats['active_applications'] ?? 0); ?></p>
                </div>
                <div class="rounded-full bg-purple-100 p-3 text-purple-600">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Lamaran Masuk</p>
                    <p class="text-2xl font-bold text-gray-900"><?= (int) ($stats['total_applications'] ?? 0); ?></p>
                </div>
                <div class="rounded-full bg-orange-100 p-3 text-orange-500">
                    <i class="fas fa-file-alt"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
        <form method="get" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Cari</label>
                <div class="relative">
                    <input type="text" name="q" value="<?= html_escape($filters['search'] ?? ''); ?>" placeholder="Judul, departemen, lokasi"
                        class="form-input pl-10" />
                    <span class="absolute left-3 top-3 text-gray-400"><i class="fas fa-search"></i></span>
                </div>
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <?php foreach (['Draft', 'Published', 'Closed', 'Archived'] as $status): ?>
                        <option value="<?= $status; ?>" <?= (($filters['status'] ?? '') === $status) ? 'selected' : ''; ?>><?= $status; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Departemen</label>
                <select name="department" class="form-select">
                    <option value="">Semua Departemen</option>
                    <?php foreach ($departments as $department): ?>
                        <option value="<?= html_escape($department); ?>" <?= (($filters['department'] ?? '') === $department) ? 'selected' : ''; ?>><?= html_escape($department); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Terapkan</button>
                <a href="<?= site_url('admin/recruitment'); ?>" class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">Reset</a>
            </div>
        </form>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="px-6 py-3">Posisi</th>
                        <th class="px-6 py-3">Departemen</th>
                        <th class="px-6 py-3">Lokasi</th>
                        <th class="px-6 py-3">Tipe</th>
                        <th class="px-6 py-3">Pelamar</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white text-sm text-gray-700">
                    <?php if (empty($positions)): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center space-y-2">
                                    <div class="rounded-full bg-gray-100 p-4 text-2xl text-gray-400"><i class="fas fa-briefcase"></i></div>
                                    <p class="font-medium">Belum ada lowongan</p>
                                    <p class="text-sm">Buat lowongan baru untuk mulai menerima lamaran.</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($positions as $position): ?>
                            <?php $encryptedId = $this->encryption_url->encode($position->id); ?>
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900 flex items-center gap-2">
                                        <?= html_escape($position->title); ?>
                                        <?php if ((int) $position->is_featured === 1): ?>
                                            <span class="rounded-full bg-yellow-100 px-2 py-0.5 text-xs font-semibold text-yellow-700">Featured</span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-xs text-gray-500">Deadline: <?= $position->application_deadline ? date('d M Y', strtotime($position->application_deadline)) : 'Tidak ditentukan'; ?></p>
                                </td>
                                <td class="px-6 py-4 text-gray-600"><?= html_escape($position->department); ?></td>
                                <td class="px-6 py-4 text-gray-600"><?= html_escape($position->location); ?></td>
                                <td class="px-6 py-4 text-gray-600"><?= html_escape($position->employment_type); ?></td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-gray-900"><?= (int) ($position->total_applications ?? 0); ?> lamaran</span>
                                        <span class="text-xs text-gray-500">Dalam review: <?= (int) ($position->active_applications ?? 0); ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                        <?= $position->status === 'Published' ? 'bg-green-100 text-green-700' : ($position->status === 'Draft' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600'); ?>">
                                        <?= $position->status; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="<?= site_url('career/detail/' . $encryptedId); ?>" target="_blank" class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs text-gray-600 hover:bg-gray-100"><i class="fas fa-external-link-alt mr-1"></i>Preview</a>
                                        <a href="<?= site_url('admin/recruitment/edit/' . $encryptedId); ?>" class="rounded-lg border border-indigo-200 bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-600 hover:bg-indigo-100"><i class="fas fa-edit mr-1"></i>Edit</a>
                                        <a href="<?= site_url('admin/recruitment/delete/' . $encryptedId); ?>" class="rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100" onclick="return confirm('Yakin ingin menghapus lowongan ini? Semua lamaran akan ikut terhapus.');"><i class="fas fa-trash-alt mr-1"></i>Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (!empty($stats['recent_applications'])): ?>
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-gray-900">Lamaran Terbaru</h2>
            <div class="space-y-3">
                <?php foreach ($stats['recent_applications'] as $application): ?>
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between rounded-lg border border-gray-100 bg-gray-50 px-4 py-3">
                        <div class="flex flex-col">
                            <p class="font-semibold text-gray-900"><?= html_escape($application->applicant_name); ?></p>
                            <span class="text-sm text-gray-600"><?= html_escape($application->applicant_email); ?> &bull; <?= html_escape($application->applicant_phone); ?></span>
                        </div>
                        <div class="mt-2 flex flex-col items-start md:mt-0 md:flex-row md:items-center md:gap-6">
                            <span class="text-sm text-gray-500">Status: <?= html_escape($application->status); ?></span>
                            <span class="text-xs text-gray-400"><?= date('d M Y H:i', strtotime($application->submitted_at)); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php $this->load->view('admin/recruitment/modals'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalToggleButtons = document.querySelectorAll('[data-modal-toggle]');
        modalToggleButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const target = btn.getAttribute('data-modal-target');
                const modal = document.getElementById(target);
                if (modal) {
                    modal.classList.toggle('hidden');
                }
            });
        });

        document.querySelectorAll('[data-modal-dismiss]').forEach(btn => {
            btn.addEventListener('click', function () {
                const modal = btn.closest('.modal-wrapper');
                modal?.classList.add('hidden');
            });
        });
    });
</script>
