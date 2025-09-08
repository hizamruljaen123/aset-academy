<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-lg shadow">
        <div class="mb-4 md:mb-0">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Guru</h1>
            <p class="text-gray-600 mt-1">Selamat datang, <?php echo $this->session->userdata('nama_lengkap'); ?>!</p>
        </div>
        <div class="flex items-center text-gray-500">
            <i class="fas fa-calendar-alt mr-2"></i>
            <span><?php echo date('d F Y'); ?></span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow flex items-center">
            <div class="p-3 rounded-full bg-sky-100 text-sky-600 mr-4">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div>
                <h4 class="text-2xl font-bold text-gray-800"><?php echo $stats['total_kelas']; ?></h4>
                <p class="text-gray-600">Kelas Diampu</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <h4 class="text-2xl font-bold text-gray-800"><?php echo $stats['total_siswa']; ?></h4>
                <p class="text-gray-600">Total Siswa</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow flex items-center">
            <div class="p-3 rounded-full bg-teal-100 text-teal-600 mr-4">
                <i class="fas fa-book"></i>
            </div>
            <div>
                <h4 class="text-2xl font-bold text-gray-800"><?php echo $stats['total_materi']; ?></h4>
                <p class="text-gray-600">Materi Tersedia</p>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- My Classes -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900">Kelas Saya</h2>
                        <p class="text-sm text-gray-500">Kelas yang Anda ampu</p>
                    </div>
                    <a href="<?php echo site_url('teacher/kelas'); ?>" class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Lihat Semua
                    </a>
                </div>
                <div class="p-4">
                    <?php if (empty($kelas)): ?>
                        <div class="text-center py-8">
                            <i class="fas fa-chalkboard-teacher text-4xl text-gray-400 mb-2"></i>
                            <h3 class="text-lg font-medium text-gray-900">Belum ada kelas</h3>
                            <p class="text-gray-500">Anda belum ditugaskan untuk mengampu kelas</p>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <?php foreach(array_slice($kelas, 0, 4) as $k): ?>
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start mb-2">
                                        <span class="px-2 py-1 text-xs font-medium rounded bg-blue-100 text-blue-800"><?php echo $k->bahasa_program; ?></span>
                                        <span class="px-2 py-1 text-xs font-medium rounded <?php echo ($k->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; ?>">
                                            <?php echo $k->status; ?>
                                        </span>
                                    </div>
                                    <h4 class="font-medium text-gray-900 mb-1"><?php echo $k->nama_kelas; ?></h4>
                                    <p class="text-sm text-gray-500 mb-2"><?php echo $k->level; ?> • <?php echo $k->durasi; ?> Jam</p>
                                    <p class="text-sm font-medium text-gray-900">Rp <?php echo number_format($k->harga, 0, ',', '.'); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Students -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900">Siswa Terbaru</h2>
                        <p class="text-sm text-gray-500">Siswa di kelas Anda</p>
                    </div>
                    <a href="<?php echo site_url('teacher/siswa'); ?>" class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Lihat Semua
                    </a>
                </div>
                <div class="p-4">
                    <?php if (empty($recent_siswa)): ?>
                        <div class="text-center py-8">
                            <i class="fas fa-users text-4xl text-gray-400 mb-2"></i>
                            <p class="text-gray-500">Belum ada siswa</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-3">
                            <?php foreach($recent_siswa as $siswa): ?>
                                <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-gray-50">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold mr-3">
                                            <?php echo strtoupper(substr($siswa->nama_lengkap, 0, 1)); ?>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-900"><?php echo $siswa->nama_lengkap; ?></h4>
                                            <p class="text-xs text-gray-500"><?php echo $siswa->nis; ?> • <?php echo $siswa->nama_kelas; ?></p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-medium rounded <?php echo ($siswa->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                        <?php echo $siswa->status; ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <!-- Recent Materials -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900">Materi Terbaru</h2>
                        <p class="text-sm text-gray-500">Materi untuk kelas Anda</p>
                    </div>
                    <a href="<?php echo site_url('teacher/materi'); ?>" class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Lihat Semua
                    </a>
                </div>
                <div class="p-4">
                    <?php if (empty($recent_materi)): ?>
                        <div class="text-center py-8">
                            <i class="fas fa-book text-4xl text-gray-400 mb-2"></i>
                            <p class="text-gray-500">Belum ada materi</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-3">
                            <?php foreach($recent_materi as $materi): ?>
                                <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-gray-50">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 mr-3">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-900"><?php echo $materi->judul; ?></h4>
                                            <p class="text-xs text-gray-500"><?php echo $materi->nama_kelas; ?></p>
                                            <p class="text-xs text-gray-400"><?php echo date('d M Y', strtotime($materi->created_at)); ?></p>
                                        </div>
                                    </div>
                                    <a href="<?php echo site_url('teacher/materi_detail/'.$materi->id); ?>" class="inline-flex items-center p-1 border border-transparent rounded-full text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Aksi Cepat</h2>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-3 gap-2">
                        <a href="<?php echo site_url('teacher/kelas'); ?>" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-50 text-center">
                            <i class="fas fa-chalkboard-teacher text-blue-600 mb-2"></i>
                            <span class="text-xs font-medium">Kelas Saya</span>
                        </a>
                        <a href="<?php echo site_url('teacher/siswa'); ?>" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-50 text-center">
                            <i class="fas fa-users text-indigo-600 mb-2"></i>
                            <span class="text-xs font-medium">Siswa Saya</span>
                        </a>
                        <a href="<?php echo site_url('teacher/materi'); ?>" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-50 text-center">
                            <i class="fas fa-book text-teal-600 mb-2"></i>
                            <span class="text-xs font-medium">Materi</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dashboard = document.querySelector('.transition-opacity');
        if (dashboard) {
            dashboard.classList.add('opacity-100');
        }
    });
</script>
