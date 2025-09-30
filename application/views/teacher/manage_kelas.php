<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold"><?php echo $kelas->nama_kelas; ?></h1>
                <p class="text-sm opacity-90 mt-1">Level: <?php echo $kelas->level; ?> | <?php echo $kelas->bahasa_program; ?></p>
            </div>
            <div class="flex items-center space-x-4">
                <?php if (!empty($kelas->online_meet_link)): ?>
                    <a href="<?php echo $kelas->online_meet_link; ?>" target="_blank" class="hidden sm:inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg transition-colors">
                        <i class="fas fa-video mr-2"></i> Join Meeting
                    </a>
                <?php endif; ?>
                <a href="<?php echo site_url('teacher/kelas'); ?>" class="hidden sm:inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Student List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-md p-6">
                                <?php
                    $active_schedule = null;
                    $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
                    if (!empty($jadwal)) {
                        foreach ($jadwal as $j) {
                            $start_time = new DateTime($j->tanggal_pertemuan . ' ' . $j->waktu_mulai);
                            $end_time = new DateTime($j->tanggal_pertemuan . ' ' . $j->waktu_selesai);
                            if ($now >= $start_time && $now <= $end_time) {
                                $active_schedule = $j;
                                break;
                            }
                        }
                    }
                ?>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-800">Daftar Siswa</h2>
                    <div class="flex items-center space-x-2">
                        <a href="<?php echo site_url('teacher/rekap_absensi/' . $kelas->id); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-lg shadow-sm transition-colors">
                            <i class="fas fa-chart-bar mr-2"></i> Rekap
                        </a>
                        <button id="takeAttendanceBtn" data-jadwal-id="<?= $active_schedule ? $active_schedule->id : '' ?>" data-tanggal="<?= $active_schedule ? $active_schedule->tanggal_pertemuan : '' ?>" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-bold rounded-lg shadow-sm transition-colors <?= !$active_schedule ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' ?>" <?= !$active_schedule ? 'disabled' : '' ?>>
                            <i class="fas fa-edit mr-2"></i> Isi Absensi
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php if (!empty($siswa)): ?>
                                <?php foreach ($siswa as $s): ?>
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $s->email; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                <?php echo $s->status; ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="<?php echo site_url('teacher/siswa_detail/' . $s->id); ?>" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada siswa di kelas ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Column: Materials List -->
        <div class="lg:col-span-1 space-y-8">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Jadwal Kelas</h2>
                <div class="space-y-4">
                    <?php if (!empty($jadwal)): ?>
                        <?php foreach ($jadwal as $j): ?>
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <h4 class="font-semibold text-gray-900">Pertemuan <?php echo $j->pertemuan_ke; ?>: <?php echo $j->judul_pertemuan; ?></h4>
                                <p class="text-sm text-gray-600 mt-1"><?php echo date('d M Y', strtotime($j->tanggal_pertemuan)); ?> | <?php echo date('H:i', strtotime($j->waktu_mulai)); ?> - <?php echo date('H:i', strtotime($j->waktu_selesai)); ?></p>
                                <a href="<?= site_url('teacher/absensi/' . $j->id); ?>" class="text-sm text-blue-600 hover:underline">Lihat Absensi</a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center text-gray-500 py-4">Belum ada jadwal untuk kelas ini.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar Materi</h2>
                <div class="space-y-4">
                    <?php if (!empty($materi)): ?>
                        <?php foreach ($materi as $m): ?>
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors">
                                <a href="<?php echo site_url('teacher/materi_detail/' . $m->id); ?>" class="block">
                                    <h4 class="font-semibold text-gray-900"><?php echo $m->judul; ?></h4>
                                    <p class="text-sm text-gray-600 mt-1"><?php echo character_limiter($m->deskripsi, 50); ?></p>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center text-gray-500 py-4">Belum ada materi untuk kelas ini.</p>
                    <?php endif; ?>
                </div>
                <div class="mt-6">
                    <button class="w-full inline-flex items-center justify-center px-4 py-2 bg-cyan-500 hover:bg-cyan-600 text-white font-bold rounded-lg shadow-sm transition-colors">
                        <i class="fas fa-plus mr-2"></i> Tambah Materi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Modal -->
    <div id="attendanceModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-2xl mx-4">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Isi Absensi Kelas</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
            </div>
            <form action="<?php echo site_url('teacher/simpan_absensi/' . $kelas->id); ?>" method="post">
            <input type="hidden" name="jadwal_id" id="jadwal_id_input">
                <div class="mb-4">
                    <label for="tanggal_absensi" class="block text-sm font-medium text-gray-700">Tanggal Absensi</label>
                    <input type="date" name="tanggal_absensi" id="tanggal_absensi" value="<?php echo date('Y-m-d'); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="overflow-y-auto" style="max-height: 400px;">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($siswa as $s): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $s->nama_lengkap; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="absensi[<?php echo $s->id; ?>]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="Hadir">Hadir</option>
                                            <option value="Sakit">Sakit</option>
                                            <option value="Izin">Izin</option>
                                            <option value="Alpa">Alpa</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" name="catatan[<?php echo $s->id; ?>]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Catatan...">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-6 text-right">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg shadow-sm transition-colors">
                        <i class="fas fa-save mr-2"></i> Simpan Absensi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('attendanceModal');
        const openBtn = document.getElementById('takeAttendanceBtn');
        const closeBtn = document.getElementById('closeModal');

        const openModal = () => {
        const jadwalId = openBtn.dataset.jadwalId;
        const tanggal = openBtn.dataset.tanggal;
        document.getElementById('jadwal_id_input').value = jadwalId;
        document.getElementById('tanggal_absensi').value = tanggal;
        modal.classList.remove('hidden');
    };
        const closeModal = () => modal.classList.add('hidden');

        openBtn.addEventListener('click', openModal);
        closeBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });
    });
    </script>
</div>
