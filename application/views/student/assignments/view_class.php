<div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Tugas: <?= htmlspecialchars((isset($class->nama_kelas) ? $class->nama_kelas : (isset($class->title) ? $class->title : 'Kelas Tidak Diketahui')), ENT_QUOTES, 'UTF-8'); ?></h1>
            <a href="<?= site_url('student/assignments'); ?>" class="text-sm text-blue-600 hover:underline">&larr; Kembali ke Daftar Kelas</a>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Tugas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batas Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Pengumpulan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($assignments)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">Belum ada tugas untuk kelas ini.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($assignments as $assignment): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($assignment->title, ENT_QUOTES, 'UTF-8'); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-700"><?= $assignment->due_date ? date('d M Y, H:i', strtotime($assignment->due_date)) : 'Tidak ada'; ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($assignment->submission): ?>
                                        <?php if ($assignment->submission->status == 'graded'): ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Sudah Dinilai</span>
                                        <?php else: ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Terkumpul</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Belum Mengerjakan</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-bold text-gray-900">
                                        <?= ($assignment->submission && $assignment->submission->status == 'graded') ? $assignment->submission->grade : '-'; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="<?= site_url('student/assignments/submit/' . $assignment->id); ?>" class="bg-indigo-600 text-white px-3 py-1 rounded-md hover:bg-indigo-700">
                                        <?= ($assignment->submission) ? 'Lihat Pengumpulan' : 'Kerjakan'; ?>
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
