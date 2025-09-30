<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-teal-500 to-cyan-600 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Absensi Kelas</h1>
                <p class="text-sm opacity-90 mt-1"><?php echo $kelas->nama_kelas; ?></p>
            </div>
            <a href="<?php echo site_url('teacher/manage_kelas/' . $kelas->id); ?>" class="hidden sm:inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Kelas
            </a>
        </div>
    </div>

    <!-- Attendance Form -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <form action="<?php echo site_url('teacher/simpan_absensi/' . $kelas->id); ?>" method="post">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                <h2 class="text-2xl font-bold text-gray-800">Form Absensi</h2>
                <div class="flex items-center gap-4 w-full sm:w-auto">
                    <input type="date" name="tanggal_absensi" value="<?php echo $tanggal; ?>" class="w-full sm:w-auto bg-white border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <button type="submit" name="filter" value="true" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-lg shadow-sm transition-colors">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($siswa as $s): ?>
                            <?php
                                $absen = null;
                                foreach ($absensi as $a) {
                                    if ($a->siswa_id == $s->id) {
                                        $absen = $a;
                                        break;
                                    }
                                }
                            ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" src="<?php echo base_url('uploads/siswa/' . ($s->foto_profil ?: 'default_avatar.png')); ?>" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900"><?php echo $s->nama_lengkap; ?></div>
                                            <div class="text-sm text-gray-500"><?php echo $s->nis; ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center space-x-2">
                                        <?php $statuses = ['Hadir', 'Izin', 'Sakit', 'Alpa']; ?>
                                        <?php foreach ($statuses as $status): ?>
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="absensi[<?php echo $s->id; ?>]" value="<?php echo $status; ?>" class="form-radio h-5 w-5 text-teal-600" <?php echo ($absen && $absen['status'] == $status) ? 'checked' : ''; ?>>
                                                <span class="ml-2 text-sm text-gray-700"><?php echo $status; ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="catatan[<?php echo $s->id; ?>]" class="w-full bg-white border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-1 focus:ring-teal-500" value="<?php echo $absen->catatan ?? ''; ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-teal-500 to-cyan-600 hover:from-teal-600 hover:to-cyan-700 text-white font-semibold rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i> Simpan Absensi
                </button>
            </div>
        </form>
    </div>
</div>
