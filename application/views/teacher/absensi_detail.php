<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-500 to-teal-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold"><?= $title; ?></h1>
                <p class="text-sm opacity-90 mt-1">Pertemuan: <?= $jadwal['judul_pertemuan']; ?> (<?= date('d M Y', strtotime($jadwal['tanggal_pertemuan'])); ?>)</p>
            </div>
            <a href="<?= site_url('teacher/manage_kelas/' . $jadwal['kelas_id']); ?>" class="inline-flex items-center px-4 py-2 bg-white text-teal-600 font-bold rounded-lg shadow-md hover:bg-gray-100 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Kelas
            </a>
        </div>
    </div>

    <!-- Attendance Table -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Detail Absensi Siswa</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($absensi)): ?>
                        <?php foreach ($absensi as $absen): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $absen['nis']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $absen['nama_lengkap']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <?php 
                                        $status_classes = [
                                            'Hadir' => 'bg-green-100 text-green-800',
                                            'Sakit' => 'bg-yellow-100 text-yellow-800',
                                            'Izin' => 'bg-blue-100 text-blue-800',
                                            'Alpa' => 'bg-red-100 text-red-800',
                                        ];
                                        $class = $status_classes[$absen['status']] ?? 'bg-gray-100 text-gray-800';
                                    ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $class; ?>">
                                        <?= $absen['status']; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $absen['catatan'] ?: '-'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data absensi untuk pertemuan ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
