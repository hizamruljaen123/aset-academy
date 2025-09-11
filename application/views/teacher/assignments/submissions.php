<div class="min-h-screen bg-gradient-to-br from-slate-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="flex items-center mb-4">
                    <a href="<?= site_url('teacher/assignments/view_class/' . $assignment->class_id . '/' . $assignment->class_type); ?>" class="flex items-center text-sm text-gray-500 hover:text-gray-700">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Daftar Tugas
                    </a>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Pengumpulan Tugas</h1>
                <p class="text-xl text-gray-600"><?= htmlspecialchars($assignment->title, ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="mt-4 flex items-center space-x-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        <?= count($submissions) ?> Pengumpulan
                    </span>
                    <span class="text-sm text-gray-500">
                        Batas: <?= $assignment->due_date ? date('d M Y, H:i', strtotime($assignment->due_date)) : 'Tidak ada batas' ?>
                    </span>
                </div>
            </div>
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">Publikasikan Semua Nilai</button>

        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pengumpulan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($submissions)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">Belum ada siswa yang mengumpulkan tugas ini.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($submissions as $submission): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($submission->nama_lengkap, ENT_QUOTES, 'UTF-8'); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-700"><?= date('d M Y, H:i', strtotime($submission->submitted_at)); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($submission->status == 'graded'): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Sudah Dinilai</span>
                                    <?php else: ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Terkumpul</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-bold text-gray-900"><?= $submission->grade ?? '-'; ?></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="<?= site_url('teacher/assignments/grade/' . $submission->id); ?>" class="bg-indigo-600 text-white px-3 py-1 rounded-md hover:bg-indigo-700">Beri Nilai</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
