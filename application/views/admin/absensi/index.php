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
                <div class="text-lg font-bold text-blue-300 mt-1"><?php echo isset($stats['total_guru_hadir']) ? $stats['total_guru_hadir'] : 0; ?></div>
                <div class="text-xs opacity-70">Guru Hadir</div>
            </div>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div>
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <a href="#" id="tab-siswa" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-red-500 text-red-600">
                    Absensi Siswa
                </a>
                <a href="#" id="tab-guru" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Absensi Guru
                </a>
            </nav>
        </div>
    </div>

    <!-- Tab Content - Siswa -->
    <div id="tab-content-siswa" class="mt-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-7 gap-6 mb-8">
            <!-- Total Hadir -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold"><?php echo $stats['total_hadir']; ?></div>
                        <div class="text-sm opacity-80">Hadir</div>
                    </div>
                    <i class="fas fa-check-circle text-3xl opacity-80"></i>
                </div>
            </div>

            <!-- Total Tidak Hadir -->
            <div class="bg-gradient-to-r from-red-500 to-pink-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold"><?php echo $stats['total_tidak_hadir']; ?></div>
                        <div class="text-sm opacity-80">Tidak Hadir</div>
                    </div>
                    <i class="fas fa-times-circle text-3xl opacity-80"></i>
                </div>
            </div>

            <!-- Total Izin -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold"><?php echo $stats['total_izin']; ?></div>
                        <div class="text-sm opacity-80">Izin</div>
                    </div>
                    <i class="fas fa-user-clock text-3xl opacity-80"></i>
                </div>
            </div>

            <!-- Total Sakit -->
            <div class="bg-gradient-to-r from-yellow-500 to-orange-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold"><?php echo $stats['total_sakit']; ?></div>
                        <div class="text-sm opacity-80">Sakit</div>
                    </div>
                    <i class="fas fa-thermometer-half text-3xl opacity-80"></i>
                </div>
            </div>

            <!-- Total Guru Tidak Hadir -->
            <div class="bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold"><?php echo isset($stats['total_guru_tidak_hadir']) ? $stats['total_guru_tidak_hadir'] : 0; ?></div>
                        <div class="text-sm opacity-80">Guru Tidak Hadir</div>
                    </div>
                    <i class="fas fa-user-times text-3xl opacity-80"></i>
                </div>
            </div>
        </div>

        <!-- Comprehensive Attendance Data -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Detail Absensi Siswa</h2>
                <p class="text-gray-600 text-sm mt-1">Data absensi siswa dikelompokkan berdasarkan jadwal pertemuan</p>
            </div>
            <div class="p-6">
                <?php if (!empty($absensi_siswa)): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white" id="absensiTableSiswa">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pertemuan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Absen</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($absensi_siswa as $absen): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $absen['nis'] ?? '-'; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                                                    <?php 
                                                    $photoPath = isset($absen['foto_profil']) && !empty($absen['foto_profil']) ? 
                                                        'assets/img/avatars/' . $absen['foto_profil'] : 
                                                        '';
                                                    $photoExists = !empty($absen['foto_profil']) && file_exists(FCPATH . 'assets/img/avatars/' . $absen['foto_profil']);
                                                    ?>
                                                    <?php if ($photoExists): ?>
                                                        <img class="h-full w-full object-cover" 
                                                             src="<?= base_url($photoPath); ?>" 
                                                             alt="<?= htmlspecialchars($absen['nama_siswa']); ?>"
                                                             onerror="this.onerror=null; this.parentElement.innerHTML='<i class=\'fas fa-user text-gray-500 text-xl\'></i>'">
                                                    <?php else: ?>
                                                        <i class="fas fa-user text-gray-500 text-xl"></i>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($absen['nama_siswa']); ?></div>
                                                    <div class="text-sm text-gray-500"><?= $absen['email'] ?? ''; ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?= htmlspecialchars($absen['kelas'] ?? '-'); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="font-medium"><?= htmlspecialchars($absen['judul_pertemuan'] ?? 'Pertemuan'); ?></div>
                                            <div class="text-xs text-gray-500"><?= date('d M Y', strtotime($absen['tanggal_pertemuan'] ?? 'now')); ?></div>
                                            <div class="text-xs text-gray-500"><?= date('H:i', strtotime($absen['waktu_mulai'] ?? '')) . ' - ' . date('H:i', strtotime($absen['waktu_selesai'] ?? '')); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php 
                                            $statusClass = [
                                                'Hadir' => 'bg-green-100 text-green-800',
                                                'Tidak Hadir' => 'bg-red-100 text-red-800',
                                                'Izin' => 'bg-yellow-100 text-yellow-800',
                                                'Sakit' => 'bg-blue-100 text-blue-800',
                                                'Alpa' => 'bg-gray-100 text-gray-800',
                                                'default' => 'bg-gray-100 text-gray-800'
                                            ];
                                            $status = $absen['status'] ?? 'Belum Absen';
                                            $class = $statusClass[$status] ?? $statusClass['default'];
                                            ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $class; ?>">
                                                <?= $status; ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <div class="max-w-xs truncate" title="<?= htmlspecialchars($absen['catatan'] ?? ''); ?>">
                                                <?= htmlspecialchars($absen['catatan'] ?? '-'); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?= !empty($absen['waktu_absen']) ? date('d M Y H:i', strtotime($absen['waktu_absen'])) : '-' ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-12">
                        <i class="fas fa-user-times text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Data Absensi Siswa</h3>
                        <p class="text-gray-500">Belum ada siswa yang mengisi absensi di sistem.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Tab Content - Guru -->
    <div id="tab-content-guru" class="mt-8 hidden">
        <!-- Guru Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Kehadiran Guru -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold"><?= isset($stats['total_guru_hadir']) ? $stats['total_guru_hadir'] : 0; ?></div>
                        <div class="text-sm opacity-80">Guru Hadir</div>
                    </div>
                    <i class="fas fa-user-check text-3xl opacity-80"></i>
                </div>
            </div>
            
            <!-- Total Tidak Hadir -->
            <div class="bg-gradient-to-r from-red-500 to-pink-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold"><?= isset($stats['total_guru_tidak_hadir']) ? $stats['total_guru_tidak_hadir'] : 0; ?></div>
                        <div class="text-sm opacity-80">Guru Tidak Hadir</div>
                    </div>
                    <i class="fas fa-user-times text-3xl opacity-80"></i>
                </div>
            </div>
            
            <!-- Persentasi Kehadiran -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <?php
                        $total = isset($stats['total_guru_hadir']) ? $stats['total_guru_hadir'] + $stats['total_guru_tidak_hadir'] : 0;
                        $percentage = $total > 0 ? round(($stats['total_guru_hadir'] / $total) * 100, 1) : 0;
                        ?>
                        <div class="text-2xl font-bold"><?= $percentage; ?>%</div>
                        <div class="text-sm opacity-80">Persentase Kehadiran</div>
                    </div>
                    <i class="fas fa-chart-line text-3xl opacity-80"></i>
                </div>
            </div>
            
            <!-- Total Jam Mengajar -->
            <div class="bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold"><?= isset($total_jam_mengajar) ? $total_jam_mengajar : '0'; ?> Jam</div>
                        <div class="text-sm opacity-80">Total Jam Mengajar</div>
                    </div>
                    <i class="fas fa-clock text-3xl opacity-80"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Daftar Absensi Guru</h2>
                    <div class="flex space-x-3">
                        <button id="exportPdfBtn" class="px-4 py-2 bg-red-100 text-red-600 rounded-lg text-sm font-medium hover:bg-red-200 transition-colors">
                            <i class="fas fa-file-pdf mr-2"></i>Export PDF
                        </button>
                        <button id="exportExcelBtn" class="px-4 py-2 bg-green-100 text-green-600 rounded-lg text-sm font-medium hover:bg-green-200 transition-colors">
                            <i class="fas fa-file-excel mr-2"></i>Export Excel
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="absensiTableGuru">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Guru</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pertemuan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="absensiGuruBody">
                        <?php if (!empty($absensi_guru)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($absensi_guru as $absen): 
                                // Debug: Log each attendance record
                                log_message('debug', 'Attendance record: ' . print_r($absen, true));
                                
                                // Set default values if not set
                                $absen['foto_profil'] = $absen['foto_profil'] ?? 'default.jpg';
                                $absen['nama_guru'] = $absen['nama_guru'] ?? 'Nama Tidak Tersedia';
                                $absen['judul_pertemuan'] = $absen['judul_pertemuan'] ?? 'Pertemuan ' . ($absen['pertemuan_ke'] ?? '1');
                                $absen['tanggal_pertemuan'] = $absen['tanggal_pertemuan'] ?? date('Y-m-d');
                                $absen['waktu_mulai'] = $absen['waktu_mulai'] ?? '00:00:00';
                                $absen['waktu_selesai'] = $absen['waktu_selesai'] ?? '00:00:00';
                                $absen['status'] = $absen['status'] ?? 'Belum Absen';
                                $absen['catatan'] = $absen['catatan'] ?? '-';
                                
                                // Determine subject/mata pelajaran
                                $mata_pelajaran = $absen['mata_pelajaran'] ?? 
                                               ($absen['class_type'] == 'premium' ? 'Kelas Premium' : 'Kelas Gratis');
                            ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $no++; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= date('d M Y', strtotime($absen['tanggal_pertemuan'])); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                                                <?php 
                                                $guruPhotoPath = isset($absen['foto_profil']) && !empty($absen['foto_profil']) ? 
                                                    'assets/img/avatars/' . $absen['foto_profil'] : 
                                                    '';
                                                $guruPhotoExists = !empty($absen['foto_profil']) && file_exists(FCPATH . 'assets/img/avatars/' . $absen['foto_profil']);
                                                ?>
                                                <?php if ($guruPhotoExists): ?>
                                                    <img class="h-full w-full object-cover" 
                                                         src="<?= base_url($guruPhotoPath); ?>" 
                                                         alt="<?= htmlspecialchars($absen['nama_guru']); ?>"
                                                         onerror="this.onerror=null; this.parentElement.innerHTML='<i class=\'fas fa-user text-gray-500 text-xl\'></i>'">
                                                <?php else: ?>
                                                    <i class="fas fa-user text-gray-500 text-xl"></i>
                                                <?php endif; ?>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($absen['nama_guru']); ?></div>
                                                <div class="text-sm text-gray-500"><?= $absen['nip'] ?? 'N/A'; ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars($mata_pelajaran); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars($absen['judul_pertemuan']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= date('H:i', strtotime($absen['waktu_mulai'])) . ' - ' . date('H:i', strtotime($absen['waktu_selesai'])); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php 
                                        $statusClass = [
                                            'Hadir' => 'bg-green-100 text-green-800',
                                            'Tidak Hadir' => 'bg-red-100 text-red-800',
                                            'Izin' => 'bg-yellow-100 text-yellow-800',
                                            'Sakit' => 'bg-blue-100 text-blue-800',
                                            'default' => 'bg-gray-100 text-gray-800'
                                        ];
                                        $class = $statusClass[$absen['status']] ?? $statusClass['default'];
                                        ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $class; ?>">
                                            <?= $absen['status']; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <div class="max-w-xs truncate" title="<?= htmlspecialchars($absen['catatan']); ?>">
                                            <?= htmlspecialchars($absen['catatan']); ?>
                                        </div>
                                    </td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data absensi guru</h3>
                                        <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan jadwal kelas terlebih dahulu.</p>
                                        <div class="mt-6">
                                            <a href="<?= base_url('jadwal'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                <i class="fas fa-plus mr-2"></i> Buat Jadwal Baru
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium">20</span> hasil
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <i class="fas fa-chevron-left h-5 w-5"></i>
                            </a>
                            <a href="#" aria-current="page" class="z-10 bg-red-50 border-red-500 text-red-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                1
                            </a>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                2
                            </a>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                3
                            </a>
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <i class="fas fa-chevron-right h-5 w-5"></i>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabSiswa = document.getElementById('tab-siswa');
    const tabGuru = document.getElementById('tab-guru');
    const contentSiswa = document.getElementById('tab-content-siswa');
    const contentGuru = document.getElementById('tab-content-guru');

    const activeClasses = ['border-red-500', 'text-red-600'];
    const inactiveClasses = ['border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300'];

    function switchTab(activeTab, inactiveTab, activeContent, inactiveContent) {
        activeContent.classList.remove('hidden');
        inactiveContent.classList.add('hidden');
        activeTab.classList.add(...activeClasses);
        activeTab.classList.remove(...inactiveClasses);
        inactiveTab.classList.add(...inactiveClasses);
        inactiveTab.classList.remove(...activeClasses);
    }

    tabSiswa.addEventListener('click', function(e) {
        e.preventDefault();
        switchTab(tabSiswa, tabGuru, contentSiswa, contentGuru);
    });

    tabGuru.addEventListener('click', function(e) {
        e.preventDefault();
        switchTab(tabGuru, tabSiswa, contentGuru, contentSiswa);
        
        // Initialize DataTable for teacher attendance if not already initialized
        if (!$.fn.DataTable.isDataTable('#absensiTableGuru')) {
            initGuruDataTable();
        }
    });

    // Check if we're on the Guru tab from URL hash
    if (window.location.hash === '#guru') {
        tabGuru.click();
    }

    // Initialize DataTable for teacher attendance
    function initGuruDataTable() {
        $('#absensiTableGuru').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
            },
            order: [[1, 'desc']], // Sort by date descending by default
            columnDefs: [
                { orderable: false, targets: [0, 8] }, // Disable sorting on No and Aksi columns
                { className: 'text-center', targets: [0, 5, 6] } // Center align these columns
            ],
            dom: '<"flex justify-between items-center mb-4"fB>rt<"flex justify-between items-center mt-4"ip>',
            buttons: [
                {
                    extend: 'excelHtml5',
                    className: 'bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm ml-2',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                    customize: function(doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
                }
            ]
        });
    }

    // Initialize DataTable for student attendance
    if ($.fn.DataTable.isDataTable('#absensiTableSiswa')) {
        $('#absensiTableSiswa').DataTable().destroy();
    }
    $('#absensiTableSiswa').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        },
        order: [[0, 'desc']], // Sort by first column (date) descending by default
        dom: '<"flex justify-between items-center mb-4"fB>rt<"flex justify-between items-center mt-4"ip>',
        buttons: [
            {
                extend: 'excelHtml5',
                className: 'bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdfHtml5',
                className: 'bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm ml-2',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                },
                customize: function(doc) {
                    doc.content[1].table.widths = 
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                }
            }
        ]
    });

    // Export buttons
    $('#exportPdfBtn').on('click', function() {
        $('#absensiTableGuru').DataTable().button('.buttons-pdf').trigger();
    });

    $('#exportExcelBtn').on('click', function() {
        $('#absensiTableGuru').DataTable().button('.buttons-excel').trigger();
    });
});

// Function to handle edit teacher attendance
function editAbsensiGuru(id) {
    // Implement edit functionality
    console.log('Edit absensi guru ID:', id);
    // You can use AJAX to load a modal with the form
    // Example: $('#editAbsensiModal').modal('show');
    // Then load the form data via AJAX
}

// Function to handle delete teacher attendance
function deleteAbsensiGuru(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data absensi ini?')) {
        // Implement delete functionality
        console.log('Delete absensi guru ID:', id);
        // You can use AJAX to delete the record
        // Example: 
        // $.post('<?= base_url('absensi/delete_guru/'); ?>' + id, function(response) {
        //     if (response.success) {
        //         location.reload();
        //     } else {
        //         alert('Gagal menghapus data absensi');
        //     }
        // });
    }
}
</script>

<!-- Add this to your head section or in a separate CSS file -->
<style>
    /* Custom styles for DataTables */
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        margin-left: 0.5rem;
    }
    
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.25rem 2rem 0.25rem 0.5rem;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.25rem 0.75rem;
        border: 1px solid #d1d5db;
        margin-left: -1px;
        color: #4b5563;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #ef4444;
        color: white !important;
        border-color: #ef4444;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f3f4f6;
        color: #111827 !important;
    }
    
    /* Make sure the table is responsive */
    .dataTables_wrapper .dataTables_scroll {
        overflow-x: auto;
    }
    
    /* Style for the active tab */
    .nav-tabs .nav-link.active {
        border-bottom: 2px solid #ef4444;
        color: #ef4444;
    }
    
    /* Style for status badges */
    .status-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .status-hadir { background-color: #d1fae5; color: #065f46; }
    .status-tidak-hadir { background-color: #fee2e2; color: #991b1b; }
    .status-izin { background-color: #fef3c7; color: #92400e; }
    .status-sakit { background-color: #dbeafe; color: #1e40af; }
</style>
