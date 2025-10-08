<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="max-w-screen-xl mx-auto p-6 space-y-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Lamaran untuk <?= html_escape($position->title); ?></h1>
            <p class="text-gray-600">Pantau dan kelola lamaran yang masuk untuk posisi ini.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="<?= site_url('admin/recruitment'); ?>" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm text-gray-600 hover:bg-gray-100"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
            <a href="<?= site_url('admin/recruitment/export_applications/' . $this->encryption_url->encode($position->id)); ?>" class="inline-flex items-center rounded-lg border border-blue-200 bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-600 hover:bg-blue-100">
                <i class="fas fa-file-export mr-2"></i>Ekspor CSV
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="text-sm text-gray-500">Total Lamaran</div>
            <div class="mt-2 text-2xl font-bold text-gray-900"><?= (int) count($applications); ?></div>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="text-sm text-gray-500">Deadline</div>
            <div class="mt-2 text-lg font-semibold text-gray-900"><?= $position->application_deadline ? date('d M Y', strtotime($position->application_deadline)) : 'Tidak ditentukan'; ?></div>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="text-sm text-gray-500">Status Lowongan</div>
            <div class="mt-2 inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold
                <?= $position->status === 'Published' ? 'bg-green-100 text-green-700' : ($position->status === 'Draft' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600'); ?>">
                <?= $position->status; ?>
            </div>
        </div>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
        <form method="get" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="md:col-span-2">
                <label class="mb-1 block text-sm font-medium text-gray-700">Cari Pelamar</label>
                <div class="relative">
                    <input type="text" name="q" value="<?= html_escape($filters['search'] ?? ''); ?>" class="form-input pl-10" placeholder="Nama, email, telepon">
                    <span class="absolute left-3 top-3 text-gray-400"><i class="fas fa-search"></i></span>
                </div>
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Status Lamaran</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <?php $statusOptions = ['Submitted','Under Review','Interview Scheduled','Accepted','Rejected','Withdrawn']; ?>
                    <?php foreach ($statusOptions as $status): ?>
                        <option value="<?= $status; ?>" <?= (($filters['status'] ?? '') === $status) ? 'selected' : ''; ?>><?= $status; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Dari Tanggal</label>
                <input type="date" name="date_from" value="<?= html_escape($filters['date_from'] ?? ''); ?>" class="form-input">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Sampai</label>
                <input type="date" name="date_to" value="<?= html_escape($filters['date_to'] ?? ''); ?>" class="form-input">
            </div>
            <div class="md:col-span-5 flex items-end gap-2">
                <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Terapkan</button>
                <a href="<?= site_url('admin/recruitment/applications/' . $this->encryption_url->encode($position->id)); ?>" class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">Reset</a>
            </div>
        </form>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="px-6 py-3">Pelamar</th>
                        <th class="px-6 py-3">Kontak</th>
                        <th class="px-6 py-3">Pengalaman</th>
                        <th class="px-6 py-3">Ekspektasi Gaji</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Dikirim</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white text-sm text-gray-700">
                    <?php if (empty($applications)): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                <div class="flex flex-col items-center space-y-2">
                                    <div class="rounded-full bg-gray-100 p-4 text-2xl text-gray-400"><i class="fas fa-user"></i></div>
                                    <p class="font-medium">Belum ada lamaran</p>
                                    <p class="text-sm">Promosikan lowongan ini untuk menarik kandidat terbaik.</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($applications as $application): ?>
                            <?php $encryptedApplicationId = $this->encryption_url->encode($application->id); ?>
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900"><?= html_escape($application->applicant_name); ?></div>
                                    <div class="text-xs text-gray-500">Posisi: <?= html_escape($application->job_title); ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col text-sm text-gray-600">
                                        <span><i class="fas fa-envelope mr-2"></i><?= html_escape($application->applicant_email); ?></span>
                                        <span><i class="fas fa-phone mr-2"></i><?= html_escape($application->applicant_phone); ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <?= $application->work_experience_years !== null ? (int) $application->work_experience_years . ' tahun' : '-'; ?>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <?= $application->expected_salary ? html_escape($application->expected_salary) : '-'; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                        <?php
                                            $statusColor = match ($application->status) {
                                                'Under Review' => 'bg-blue-100 text-blue-700',
                                                'Interview Scheduled' => 'bg-purple-100 text-purple-700',
                                                'Accepted' => 'bg-green-100 text-green-700',
                                                'Rejected' => 'bg-red-100 text-red-700',
                                                'Withdrawn' => 'bg-gray-100 text-gray-600',
                                                default => 'bg-yellow-100 text-yellow-700',
                                            };
                                            echo $statusColor;
                                        ?>
                                    ">
                                        <?= $application->status; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <?= date('d M Y H:i', strtotime($application->submitted_at)); ?>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="<?= site_url('admin/recruitment/application_detail/' . $encryptedApplicationId); ?>" class="inline-flex items-center rounded-lg border border-indigo-200 bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-600 hover:bg-indigo-100">
                                        <i class="fas fa-eye mr-1"></i>Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
