<div class="max-w-screen-1xl mx-auto p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Pengumpulan Tugas</h1>
                <p class="text-gray-600"><?= htmlspecialchars($assignment->title, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <a href="<?= site_url('admin/assignments'); ?>" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Assignment Details -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">Kelas</h3>
                <p class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($assignment->class_name, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">Guru</h3>
                <p class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($assignment->teacher_name, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">Batas Waktu</h3>
                <p class="text-lg font-semibold text-gray-900">
                    <?= $assignment->due_date ? date('d M Y, H:i', strtotime($assignment->due_date)) : 'Tidak ada batas'; ?>
                </p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">Konten Tugas</h3>
                <p class="text-sm text-gray-600">
                    <?= !empty($assignment->description) ? substr(htmlspecialchars($assignment->description, ENT_QUOTES, 'UTF-8'), 0, 50) . '...' : 'Tidak ada deskripsi'; ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Pengumpulan</p>
                    <p class="text-2xl font-bold text-gray-900"><?= count($submissions) ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-upload text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Sudah Dinilai</p>
                    <p class="text-2xl font-bold text-gray-900"><?= count(array_filter($submissions, fn($s) => $s->grade !== null)) ?></p>
                </div>
                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Belum Dinilai</p>
                    <p class="text-2xl font-bold text-gray-900"><?= count(array_filter($submissions, fn($s) => $s->grade === null)) ?></p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Rata-rata Nilai</p>
                    <p class="text-2xl font-bold text-gray-900">
                        <?php 
                        $graded = array_filter($submissions, fn($s) => $s->grade !== null);
                        echo count($graded) > 0 ? number_format(array_sum(array_column($graded, 'grade')) / count($graded), 1) : '-';
                        ?>
                    </p>
                </div>
                <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-star text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Submissions Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pengumpulan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Konten</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($submissions)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-lg font-medium text-gray-900 mb-2">Belum ada pengumpulan</p>
                                    <p class="text-gray-500">Tunggu siswa mengumpulkan tugas</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($submissions as $submission): ?>
                            <tr data-submission-id="<?= $submission->id ?>">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-gray-500"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($submission->student_name, ENT_QUOTES, 'UTF-8'); ?></div>
                                            <div class="text-sm text-gray-500"><?= htmlspecialchars($submission->student_email, ENT_QUOTES, 'UTF-8'); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= date('d M Y, H:i', strtotime($submission->submitted_at)) ?>
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <div class="text-sm text-gray-900">
                                        <?php if (!empty($submission->content)): ?>
                                            <div class="max-h-20 overflow-hidden">
                                                <?= substr(htmlspecialchars($submission->content, ENT_QUOTES, 'UTF-8'), 0, 100) . '...' ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-gray-500">-</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if (!empty($submission->submission_file)): ?>
                                        <a href="<?= base_url('uploads/submissions/' . htmlspecialchars($submission->submission_file, ENT_QUOTES, 'UTF-8')) ?>" 
                                           target="_blank" 
                                           class="text-blue-600 hover:text-blue-900 text-sm">
                                            <i class="fas fa-file-pdf mr-1"></i>
                                            Lihat File
                                        </a>
                                    <?php else: ?>
                                        <span class="text-gray-500 text-sm">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap submission-status">
                                    <?php if ($submission->submission_status === 'graded'): ?>
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                                            Sudah Dinilai
                                        </span>
                                    <?php elseif ($submission->submission_status === 'late'): ?>
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">
                                            Terlambat
                                        </span>
                                    <?php else: ?>
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">
                                            Menunggu Penilaian
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 submission-grade">
                                    <?= $submission->grade !== null ? number_format($submission->grade, 1) : '-' ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex gap-2 justify-end">
                                        <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700" 
                                                onclick="openGradeModal(<?= $submission->id ?>, '<?= $submission->grade ?>', '<?= htmlspecialchars($submission->feedback ?? '', ENT_QUOTES) ?>')" 
                                                data-tooltip="Beri nilai">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="bg-gray-100 text-gray-700 px-3 py-1 rounded text-sm hover:bg-gray-200" 
                                                onclick="openDetailModal('<?= htmlspecialchars($submission->student_name, ENT_QUOTES) ?>', '<?= htmlspecialchars($submission->content ?? '', ENT_QUOTES) ?>', '<?= $submission->grade ?>', '<?= htmlspecialchars($submission->feedback ?? '', ENT_QUOTES) ?>', '<?= date('d M Y, H:i', strtotime($submission->submitted_at)) ?>', '<?= htmlspecialchars($submission->submission_file ?? '', ENT_QUOTES) ?>', '<?= $submission->submission_file ? base_url('uploads/submissions/' . $submission->submission_file) : '' ?>')" 
                                                data-tooltip="Lihat detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal untuk memberi nilai -->
<div id="gradeModal" class="modal fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="modal-content bg-white rounded-xl max-w-md w-full p-6 m-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Beri Nilai</h3>
            <button onclick="closeModal('gradeModal')" class="text-gray-500 hover:text-gray-800">&times;</button>
        </div>
        <form id="gradeForm" action="<?= site_url('admin/assignments/grade_submission') ?>" method="POST">
            <input type="hidden" id="submission_id" name="submission_id">
            <div class="mb-4">
                <label for="grade_input" class="form-label">Nilai</label>
                <input type="number" id="grade_input" name="grade" class="form-input w-full" placeholder="0-100" min="0" max="100" required>
            </div>
            <div class="mb-4">
                <label for="feedback_input" class="form-label">Komentar / Feedback</label>
                <textarea id="feedback_input" name="feedback" class="form-textarea w-full" rows="4" placeholder="Berikan feedback untuk siswa..."></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" class="bg-gray-200 text-gray-800 py-2 px-4 rounded-lg hover:bg-gray-300" onclick="closeModal('gradeModal')">
                    Batal
                </button>
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                    Simpan Nilai
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal untuk melihat detail -->
<div id="viewDetailModal" class="modal fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="modal-content bg-white rounded-xl max-w-2xl w-full p-6 m-4">
        <div class="flex justify-between items-center mb-4 border-b pb-3">
            <h3 class="text-lg font-semibold text-gray-900">Detail Pengumpulan</h3>
            <button onclick="closeModal('viewDetailModal')" class="text-gray-500 hover:text-gray-800">&times;</button>
        </div>
        <div class="space-y-4">
            <div>
                <h4 class="text-sm font-medium text-gray-500">Siswa</h4>
                <p id="detailStudentName" class="text-gray-900"></p>
            </div>
            <div>
                <h4 class="text-sm font-medium text-gray-500">Waktu Pengumpulan</h4>
                <p id="detailSubmittedAt" class="text-gray-900"></p>
            </div>
            <div class="hidden">
                <h4 class="text-sm font-medium text-gray-500">File</h4>
                <a id="detailFileLink" href="#" target="_blank" class="text-blue-600 hover:underline"></a>
            </div>
            <div>
                <h4 class="text-sm font-medium text-gray-500">Konten Jawaban</h4>
                <div id="detailContent" class="text-gray-800 bg-gray-50 p-3 rounded-lg max-h-40 overflow-y-auto"></div>
            </div>
            <div class="grid grid-cols-2 gap-4 pt-4 border-t mt-4">
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Nilai</h4>
                    <p id="detailGrade" class="text-lg font-bold text-blue-600"></p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Feedback</h4>
                    <p id="detailFeedback" class="text-gray-800"></p>
                </div>
            </div>
        </div>
         <div class="flex justify-end mt-6">
             <button type="button" class="bg-gray-200 text-gray-800 py-2 px-4 rounded-lg hover:bg-gray-300" onclick="closeModal('viewDetailModal')">
                    Tutup
             </button>
        </div>
    </div>
</div>
