<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$encryptedApplicationId = $this->encryption_url->encode($application->id);
$encryptedJobId = $this->encryption_url->encode($application->job_position_id);
$statusOptions = $status_options ?? ['Submitted','Under Review','Interview Scheduled','Accepted','Rejected','Withdrawn'];
?>

<div class="max-w-screen-xl mx-auto p-6 space-y-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Lamaran</h1>
            <p class="text-gray-600">Tinjau informasi kandidat dan perbarui status proses rekrutmen.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="<?= site_url('admin/recruitment/applications/' . $encryptedJobId); ?>" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke daftar lamaran
            </a>
            <a href="mailto:<?= html_escape($application->applicant_email); ?>" class="inline-flex items-center rounded-lg bg-blue-50 px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-blue-100">
                <i class="fas fa-envelope mr-2"></i>Kirim Email
            </a>
            <?php if (!empty($application->applicant_phone)): ?>
                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $application->applicant_phone); ?>" target="_blank" class="inline-flex items-center rounded-lg bg-green-50 px-3 py-2 text-sm font-semibold text-green-600 hover:bg-green-100">
                    <i class="fab fa-whatsapp mr-2"></i>Hubungi via WhatsApp
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
            <div class="flex items-start">
                <i class="fas fa-check-circle mr-3 mt-1"></i>
                <div><?= $this->session->flashdata('success'); ?></div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
            <div class="flex items-start">
                <i class="fas fa-exclamation-triangle mr-3 mt-1"></i>
                <div><?= $this->session->flashdata('error'); ?></div>
            </div>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Profil Kandidat</h2>
                        <p class="text-sm text-gray-500">Informasi yang diisi oleh pelamar.</p>
                    </div>
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
                </div>
                <div class="grid grid-cols-1 gap-6 px-6 py-6 md:grid-cols-2">
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400">Nama Lengkap</p>
                            <p class="text-base font-semibold text-gray-900"><?= html_escape($application->applicant_name); ?></p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400">Email</p>
                            <p class="text-sm text-gray-700"><?= html_escape($application->applicant_email); ?></p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400">Telepon</p>
                            <p class="text-sm text-gray-700"><?= $application->applicant_phone ? html_escape($application->applicant_phone) : '-'; ?></p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400">Alamat</p>
                            <p class="text-sm text-gray-700 whitespace-pre-wrap"><?= $application->applicant_address ? nl2br(html_escape($application->applicant_address)) : '-'; ?></p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400">Pendidikan</p>
                            <p class="text-sm text-gray-700">
                                <?= $application->education_level ? html_escape($application->education_level) : '-'; ?>
                                <?php if ($application->major_field): ?>
                                    <span class="text-gray-500">&mdash; <?= html_escape($application->major_field); ?></span>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-wide text-gray-400">Pengalaman</p>
                                <p class="text-sm text-gray-700"><?= $application->work_experience_years !== null ? (int)$application->work_experience_years . ' tahun' : '-'; ?></p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-wide text-gray-400">Tahun Lulus</p>
                                <p class="text-sm text-gray-700"><?= $application->graduation_year ?: '-'; ?></p>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400">Posisi & Perusahaan Saat Ini</p>
                            <p class="text-sm text-gray-700"><?= $application->current_position ? html_escape($application->current_position) : '-'; ?>
                                <?php if ($application->current_company): ?>
                                    <span class="text-gray-500">di <?= html_escape($application->current_company); ?></span>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400">Ekspektasi Gaji</p>
                            <p class="text-sm text-gray-700"><?= $application->expected_salary ? html_escape($application->expected_salary) : '-'; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-900">Dokumen & Lampiran</h2>
                </div>
                <div class="px-6 py-6">
                    <?php if (empty($attachments)): ?>
                        <p class="text-sm text-gray-500">Tidak ada lampiran yang diunggah.</p>
                    <?php else: ?>
                        <div class="space-y-3">
                            <?php foreach ($attachments as $attachment): ?>
                                <?php $encryptedAttachmentId = $this->encryption_url->encode($attachment->id); ?>
                                <div class="flex flex-col rounded-lg border border-gray-100 bg-gray-50 p-4 md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">
                                            <i class="fas fa-paperclip mr-2 text-gray-500"></i>
                                            <?= html_escape($attachment->file_label ?? 'Lampiran'); ?>
                                        </p>
                                        <p class="text-xs text-gray-500">Diunggah: <?= date('d M Y H:i', strtotime($attachment->created_at ?? $application->submitted_at)); ?></p>
                                    </div>
                                    <div class="mt-3 flex gap-2 md:mt-0">
                                        <a href="<?= site_url('admin/recruitment/download_attachment/' . $encryptedAttachmentId); ?>" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs text-gray-600 hover:bg-gray-100">
                                            <i class="fas fa-download mr-1"></i>Unduh
                                        </a>
                                        <a href="<?= site_url('admin/recruitment/delete_attachment/' . $encryptedAttachmentId); ?>" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100" onclick="return confirm('Hapus lampiran ini?');">
                                            <i class="fas fa-trash-alt mr-1"></i>Hapus
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-900">Motivasi & Catatan</h2>
                </div>
                <div class="grid grid-cols-1 gap-6 px-6 py-6 md:grid-cols-2">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400">Cover Letter</p>
                        <div class="mt-2 rounded-lg border border-gray-100 bg-gray-50 p-4 text-sm text-gray-700 whitespace-pre-wrap">
                            <?= $application->cover_letter ? nl2br(html_escape($application->cover_letter)) : 'Tidak ada cover letter.'; ?>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400">Keterampilan Tambahan</p>
                        <div class="mt-2 rounded-lg border border-gray-100 bg-gray-50 p-4 text-sm text-gray-700 whitespace-pre-wrap">
                            <?= $application->additional_skills ? nl2br(html_escape($application->additional_skills)) : 'Tidak ada catatan tambahan.'; ?>
                        </div>
                        <div class="mt-4">
                            <p class="text-xs uppercase tracking-wide text-gray-400">Link Portfolio</p>
                            <?php if (!empty($application->portfolio_link)): ?>
                                <a href="<?= prep_url($application->portfolio_link); ?>" target="_blank" class="text-sm font-semibold text-blue-600 hover:underline">
                                    <?= html_escape($application->portfolio_link); ?>
                                </a>
                            <?php else: ?>
                                <p class="text-sm text-gray-700">-</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-900">Status Rekrutmen</h2>
                </div>
                <div class="px-6 py-6">
                    <?= form_open('admin/recruitment/update_application_status'); ?>
                        <input type="hidden" name="application_id" value="<?= $encryptedApplicationId; ?>">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" class="form-select" required>
                                    <?php foreach ($statusOptions as $status): ?>
                                        <option value="<?= $status; ?>" <?= set_select('status', $status, $application->status === $status); ?>><?= $status; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jadwal Interview</label>
                                <input type="datetime-local" name="interview_date" value="<?= set_value('interview_date', $application->interview_date ? date('Y-m-d\\TH:i', strtotime($application->interview_date)) : ''); ?>" class="form-input">
                                <p class="mt-1 text-xs text-gray-500">Isi jika kandidat dijadwalkan untuk interview.</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Catatan Internal</label>
                                <textarea name="review_notes" rows="4" class="form-textarea"><?= set_value('review_notes', $application->review_notes); ?></textarea>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-between">
                            <div class="text-xs text-gray-400">
                                Terakhir diperbarui: <?= $application->reviewed_at ? date('d M Y H:i', strtotime($application->reviewed_at)) : 'Belum pernah'; ?>
                            </div>
                            <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Simpan</button>
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-900">Detail Posisi</h2>
                </div>
                <div class="space-y-4 px-6 py-6 text-sm text-gray-700">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400">Posisi</p>
                        <p class="font-semibold text-gray-900"><?= html_escape($application->job_title); ?></p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400">Departemen</p>
                        <p><?= html_escape($application->job_department); ?></p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400">Lokasi</p>
                        <p><?= $application->job_location ? html_escape($application->job_location) : '-'; ?></p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400">Jenis Pekerjaan</p>
                        <p><?= html_escape($application->employment_type); ?></p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400">Benefit</p>
                        <p class="whitespace-pre-wrap"><?= $application->job_benefits ? nl2br(html_escape($application->job_benefits)) : '-'; ?></p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400">Persyaratan</p>
                        <p class="whitespace-pre-wrap"><?= $application->job_requirements ? nl2br(html_escape($application->job_requirements)) : '-'; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
