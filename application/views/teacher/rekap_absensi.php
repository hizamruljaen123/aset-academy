<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Rekap Absensi</h1>
                <p class="text-sm opacity-90 mt-1"><?php echo $kelas->nama_kelas; ?></p>
            </div>
            <a href="<?php echo site_url('teacher/manage_kelas/' . $kelas->id); ?>" class="hidden sm:inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Kelas
            </a>
        </div>
    </div>

    <!-- Attendance Rekap -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Hadir</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Izin</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Sakit</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Alpa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php 
                        $rekap_by_date = [];
                        foreach ($rekap as $r) {
                            $rekap_by_date[$r['tanggal_absensi']][$r['status']] = $r['total'];
                        }
                    ?>
                    <?php foreach ($rekap_by_date as $tanggal => $statuses): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo date('d M Y', strtotime($tanggal)); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-green-600"><?php echo $statuses['Hadir'] ?? 0; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-blue-600"><?php echo $statuses['Izin'] ?? 0; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-yellow-600"><?php echo $statuses['Sakit'] ?? 0; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-red-600"><?php echo $statuses['Alpa'] ?? 0; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
