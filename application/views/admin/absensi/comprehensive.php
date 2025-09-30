<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold"><?php echo $title; ?></h1>
                <p class="text-sm opacity-90 mt-1">Pantau absensi semua siswa dan guru di sistem</p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold"><?php echo $stats['total_absensi']; ?></div>
                <div class="text-sm opacity-80">Total Absensi Siswa</div>
                <div class="text-lg font-bold text-blue-600 mt-1"><?php echo isset($stats['total_guru_hadir']) ? $stats['total_guru_hadir'] : 0; ?></div>
                <div class="text-xs opacity-70">Guru Hadir</div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-8">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold"><?php echo $stats['total_hadir']; ?></div>
                    <div class="text-sm opacity-80">Hadir</div>
                </div>
                <i class="fas fa-check-circle text-3xl opacity-80"></i>
            </div>
        </div>

        <div class="bg-gradient-to-r from-red-500 to-pink-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold"><?php echo $stats['total_tidak_hadir']; ?></div>
                    <div class="text-sm opacity-80">Tidak Hadir</div>
                </div>
                <i class="fas fa-times-circle text-3xl opacity-80"></i>
            </div>
        </div>

        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold"><?php echo $stats['total_izin']; ?></div>
                    <div class="text-sm opacity-80">Izin</div>
                </div>
                <i class="fas fa-user-clock text-3xl opacity-80"></i>
            </div>
        </div>

        <div class="bg-gradient-to-r from-yellow-500 to-orange-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold"><?php echo $stats['total_sakit']; ?></div>
                    <div class="text-sm opacity-80">Sakit</div>
                </div>
                <i class="fas fa-thermometer-half text-3xl opacity-80"></i>
            </div>
        </div>

        <div class="bg-gradient-to-r from-cyan-500 to-teal-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold"><?php echo isset($stats['total_guru_hadir']) ? $stats['total_guru_hadir'] : 0; ?></div>
                    <div class="text-sm opacity-80">Guru Hadir</div>
                </div>
                <i class="fas fa-chalkboard-teacher text-3xl opacity-80"></i>
            </div>
        </div>
    </div>

    <!-- Comprehensive Attendance Data -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Detail Absensi Lengkap</h2>
            <p class="text-gray-600 text-sm mt-1">Data absensi dikelompokkan berdasarkan jadwal pertemuan</p>
        </div>

        <div class="p-6">
            <?php if (!empty($absensi_comprehensive)): ?>
                <div class="space-y-8">
                    <?php foreach ($absensi_comprehensive as $jadwal_key => $jadwal_data): ?>
                        <?php $jadwal = $jadwal_data['jadwal_info']; ?>
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <!-- Jadwal Header -->
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-4 border-b border-gray-200">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-800"><?php echo $jadwal['judul']; ?></h3>
                                        <div class="flex flex-wrap items-center gap-4 mt-2 text-sm text-gray-600">
                                            <span class="flex items-center">
                                                <i class="fas fa-calendar mr-2"></i>
                                                <?php echo date('d M Y', strtotime($jadwal['tanggal'])); ?>
                                            </span>
                                            <span class="flex items-center">
                                                <i class="fas fa-clock mr-2"></i>
                                                <?php echo date('H:i', strtotime($jadwal['waktu_mulai'])); ?> -
                                                <?php echo date('H:i', strtotime($jadwal['waktu_selesai'])); ?>
                                            </span>
                                            <span class="flex items-center">
                                                <i class="fas fa-chalkboard-teacher mr-2"></i>
                                                <?php echo $jadwal['nama_guru'] ?: 'Guru Tidak Diketahui'; ?>
                                            </span>
                                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                                <?php echo $jadwal['class_type'] == 'premium' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'; ?>">
                                                <?php echo $jadwal['class_type'] == 'premium' ? 'Premium' : 'Gratis'; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-bold text-gray-800">
                                            <?php
                                            $total_siswa = count($jadwal_data['absensi']);
                                            $hadir_count = 0;
                                            foreach ($jadwal_data['absensi'] as $absen) {
                                                if ($absen->status == 'Hadir') $hadir_count++;
                                            }
                                            echo $hadir_count . '/' . $total_siswa;
                                            ?>
                                        </div>
                                        <div class="text-sm text-gray-600">Siswa Hadir</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Attendance List -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Absen</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <?php foreach ($jadwal_data['absensi'] as $absen): ?>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    <?php echo $absen->nis ?: '-'; ?>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-8 w-8">
                                                            <?php if (isset($absen->foto_profil) && $absen->foto_profil): ?>
                                                                <img class="h-8 w-8 rounded-full object-cover" src="<?php echo base_url('uploads/siswa/' . $absen->foto_profil); ?>" alt="Foto">
                                                            <?php else: ?>
                                                                <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center">
                                                                    <i class="fas fa-user text-gray-600 text-xs"></i>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="ml-3">
                                                            <div class="text-sm font-medium text-gray-900"><?php echo $absen->nama_siswa; ?></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <?php echo $absen->kelas ?: '-'; ?>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <?php echo $absen->jurusan ?: '-'; ?>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        <?php
                                                        switch($absen->status) {
                                                            case 'Hadir': echo 'bg-green-100 text-green-800'; break;
                                                            case 'Sakit': echo 'bg-blue-100 text-blue-800'; break;
                                                            case 'Izin': echo 'bg-yellow-100 text-yellow-800'; break;
                                                            case 'Alpa': echo 'bg-red-100 text-red-800'; break;
                                                            default: echo 'bg-gray-100 text-gray-800';
                                                        }
                                                        ?>">
                                                        <?php echo $absen->status; ?>
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <?php echo isset($absen->created_at) ? date('d M Y H:i', strtotime($absen->created_at)) : '-'; ?>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <?php echo $absen->catatan ?: '-'; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Data Absensi</h3>
                    <p class="text-gray-500">Belum ada siswa yang mengisi absensi di sistem.</p>
                </div>
            <?php endif; ?>
    </div>

    <!-- Teacher Attendance Section -->
    <?php if (!empty($absensi_guru)): ?>
    <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Absensi Guru</h2>
            <p class="text-gray-600 text-sm mt-1">Data kehadiran guru dalam mengajar</p>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guru</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pertemuan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($absensi_guru as $absen): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo isset($absen['tanggal_pertemuan']) ? date('d M Y', strtotime($absen['tanggal_pertemuan'])) : 'N/A'; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                                <i class="fas fa-chalkboard-teacher text-blue-600 text-sm"></i>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900"><?php echo $absen['nama_guru']; ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo isset($absen['judul_pertemuan']) ? $absen['judul_pertemuan'] : 'N/A'; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php
                                    if (isset($absen['tanggal_pertemuan']) && isset($absen['waktu_mulai']) && isset($absen['waktu_selesai'])) {
                                        echo date('H:i', strtotime($absen['waktu_mulai'])) . ' - ' . date('H:i', strtotime($absen['waktu_selesai']));
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <?php echo isset($absen['status']) ? $absen['status'] : 'Hadir'; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo isset($absen['catatan']) ? $absen['catatan'] : 'Mengajar di kelas'; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Legacy Data (if needed for backward compatibility) -->
    <?php if (!empty($absensi_siswa) || !empty($absensi_guru)): ?>
    <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Data Absensi Lama</h2>
            <p class="text-gray-600 text-sm mt-1">Data untuk backward compatibility</p>
        </div>
        <div class="p-6">
            <!-- Include legacy view if needed -->
            <?php if (!empty($absensi_siswa)): ?>
                <h3 class="text-lg font-semibold mb-4">Absensi Siswa</h3>
                <div class="overflow-x-auto mb-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guru</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($absensi_siswa as $absen): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo date('d M Y', strtotime($absen['tanggal_pertemuan'])); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $absen['nama_siswa']; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $absen['nama_guru']; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            <?php echo $absen['status']; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <?php if (!empty($absensi_guru)): ?>
                <h3 class="text-lg font-semibold mb-4">Absensi Guru</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guru</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($absensi_guru as $absen): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo date('d M Y', strtotime($absen['tanggal_pertemuan'])); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $absen['nama_guru']; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $absen['judul_pertemuan']; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Hadir
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
