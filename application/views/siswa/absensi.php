<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Absensi Saya</h1>
                <p class="text-sm opacity-90 mt-1">Rekap kehadiran di kelas <?php echo $siswa->kelas; ?></p>
            </div>
        </div>
    </div>

    <!-- Attendance Summary -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <?php 
                $summary = ['Hadir' => 0, 'Izin' => 0, 'Sakit' => 0, 'Alpa' => 0];
                foreach ($rekap as $r) {
                    $summary[$r['status']] = $r['total'];
                }
            ?>
            <div class="p-4 bg-green-50 rounded-lg">
                <div class="text-3xl font-bold text-green-600"><?php echo $summary['Hadir']; ?></div>
                <div class="text-sm font-medium text-gray-600">Hadir</div>
            </div>
            <div class="p-4 bg-blue-50 rounded-lg">
                <div class="text-3xl font-bold text-blue-600"><?php echo $summary['Izin']; ?></div>
                <div class="text-sm font-medium text-gray-600">Izin</div>
            </div>
            <div class="p-4 bg-yellow-50 rounded-lg">
                <div class="text-3xl font-bold text-yellow-600"><?php echo $summary['Sakit']; ?></div>
                <div class="text-sm font-medium text-gray-600">Sakit</div>
            </div>
            <div class="p-4 bg-red-50 rounded-lg">
                <div class="text-3xl font-bold text-red-600"><?php echo $summary['Alpa']; ?></div>
                <div class="text-sm font-medium text-gray-600">Alpa</div>
            </div>
        </div>
    </div>
</div>
