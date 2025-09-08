<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Header with Quick Stats -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-2xl shadow-xl ring-1 ring-gray-200/50">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
            <p class="text-lg text-gray-500 mt-2">Selamat datang, <?php echo $this->session->userdata('nama_lengkap'); ?></p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="flex items-center bg-blue-50/50 px-4 py-2 rounded-xl">
                <i class="fas fa-users text-blue-600 mr-2"></i>
                <span class="font-medium"><?php echo $stats['total_siswa']; ?> Siswa</span>
            </div>
            <div class="flex items-center bg-indigo-50/50 px-4 py-2 rounded-xl">
                <i class="fas fa-chalkboard-teacher text-indigo-600 mr-2"></i>
                <span class="font-medium"><?php echo $stats['total_guru']; ?> Guru</span>
            </div>
            <div class="flex items-center text-gray-500">
                <i class="fas fa-calendar-alt mr-2"></i>
                <span><?php echo date('d F Y'); ?></span>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Student Distribution -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                <h2 class="text-2xl font-bold text-gray-800">Distribusi Siswa</h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Students per Class -->
                <div class="md:col-span-2">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Per Kelas</h3>
                    <div class="h-80">
                        <canvas id="studentsPerClassChart"></canvas>
                    </div>
                </div>
                
                <!-- Students per Major -->
                <div>
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Per Jurusan</h3>
                    <div class="h-64">
                        <canvas id="studentsPerMajorChart"></canvas>
                    </div>
                </div>
                
                <!-- Status Distribution -->
                <div>
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Status Siswa</h3>
                    <div class="h-64">
                        <canvas id="studentsStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Class Statistics -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                <h2 class="text-2xl font-bold text-gray-800">Statistik Kelas</h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Class by Level -->
                <div>
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Berdasarkan Level</h3>
                    <div class="h-64">
                        <canvas id="classesByLevelChart"></canvas>
                    </div>
                </div>
                
                <!-- Class by Status -->
                <div>
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Berdasarkan Status</h3>
                    <div class="h-64">
                        <canvas id="classesByStatusChart"></canvas>
                    </div>
                </div>
                
                <!-- Top Classes -->
                <div class="md:col-span-2">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Kelas dengan Siswa Terbanyak</h3>
                    <div class="space-y-3">
                        <?php foreach($top_classes as $index => $class): ?>
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <span class="w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-800 font-medium rounded-full mr-3">
                                    <?php echo $index + 1; ?>
                                </span>
                                <div class="flex-1">
                                    <h4 class="font-medium"><?php echo $class->nama_kelas; ?></h4>
                                    <p class="text-sm text-gray-500"><?php echo $class->bahasa_program; ?> • <?php echo $class->level; ?></p>
                                </div>
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                                    <?php echo $class->jumlah_siswa; ?> siswa
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Students -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">Siswa Terbaru</h2>
                    <a href="<?php echo site_url('admin/siswa'); ?>" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                <?php if(empty($recent_siswa)): ?>
                    <div class="text-center py-8">
                        <i class="fas fa-users text-4xl text-gray-400 mb-3"></i>
                        <p class="text-gray-500">Belum ada data siswa</p>
                    </div>
                <?php else: ?>
                    <div class="space-y-4">
                        <?php foreach($recent_siswa as $siswa): ?>
                            <div class="flex items-center p-4 border border-gray-100 rounded-xl hover:shadow-md transition-shadow">
                                <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold mr-4">
                                    <?php echo strtoupper(substr($siswa->nama_lengkap, 0, 1)); ?>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900"><?php echo $siswa->nama_lengkap; ?></h4>
                                    <p class="text-sm text-gray-500"><?php echo $siswa->nis; ?> • <?php echo $siswa->kelas; ?></p>
                                </div>
                                <span class="px-3 py-1 text-sm font-medium rounded-full <?php 
                                    echo ($siswa->status == 'Aktif') ? 'bg-green-100 text-green-800' : 
                                    (($siswa->status == 'Tidak Aktif') ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800'); 
                                ?>">
                                    <?php echo $siswa->status; ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent Classes -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">Kelas Terbaru</h2>
                    <a href="<?php echo site_url('admin/kelas'); ?>" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                <?php if(empty($recent_kelas)): ?>
                    <div class="text-center py-8">
                        <i class="fas fa-chalkboard-teacher text-4xl text-gray-400 mb-3"></i>
                        <p class="text-gray-500">Belum ada data kelas</p>
                    </div>
                <?php else: ?>
                    <div class="space-y-4">
                        <?php foreach($recent_kelas as $kelas): ?>
                            <div class="p-4 border border-gray-100 rounded-xl hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="px-3 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800">
                                        <?php echo $kelas->bahasa_program; ?>
                                    </span>
                                    <span class="px-3 py-1 text-sm font-medium rounded-full <?php 
                                        echo ($kelas->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; 
                                    ?>">
                                        <?php echo $kelas->status; ?>
                                    </span>
                                </div>
                                <h4 class="font-medium text-gray-900 mb-1"><?php echo $kelas->nama_kelas; ?></h4>
                                <p class="text-sm text-gray-500"><?php echo $kelas->level; ?> • <?php echo $kelas->durasi; ?> Jam</p>
                                <p class="text-sm font-medium text-gray-900 mt-2">Rp <?php echo number_format($kelas->harga, 0, ',', '.'); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const page = document.querySelector('.transition-opacity');
    if (page) page.classList.add('opacity-100');

    // Chart colors
    const colors = {
        blue: {
            bg: 'rgba(59, 130, 246, 0.7)',
            border: 'rgba(59, 130, 246, 1)'
        },
        indigo: {
            bg: 'rgba(99, 102, 241, 0.7)',
            border: 'rgba(99, 102, 241, 1)'
        },
        purple: {
            bg: 'rgba(139, 92, 246, 0.7)',
            border: 'rgba(139, 92, 246, 1)'
        },
        green: {
            bg: 'rgba(16, 185, 129, 0.7)',
            border: 'rgba(16, 185, 129, 1)'
        },
        yellow: {
            bg: 'rgba(245, 158, 11, 0.7)',
            border: 'rgba(245, 158, 11, 1)'
        },
        red: {
            bg: 'rgba(239, 68, 68, 0.7)',
            border: 'rgba(239, 68, 68, 1)'
        }
    };

    // Students per Class Chart
    new Chart(
        document.getElementById('studentsPerClassChart').getContext('2d'),
        {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($students_per_class, 'nama_kelas')); ?>,
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: <?php echo json_encode(array_column($students_per_class, 'jumlah_siswa')); ?>,
                    backgroundColor: Object.values(colors).map(c => c.bg),
                    borderColor: Object.values(colors).map(c => c.border),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        }
    );

    // Students per Major Chart
    new Chart(
        document.getElementById('studentsPerMajorChart').getContext('2d'),
        {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode(array_column($students_per_major, 'jurusan')); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_column($students_per_major, 'jumlah_siswa')); ?>,
                    backgroundColor: [
                        colors.blue.bg,
                        colors.indigo.bg,
                        colors.purple.bg,
                        colors.green.bg,
                        colors.yellow.bg
                    ],
                    borderColor: [
                        colors.blue.border,
                        colors.indigo.border,
                        colors.purple.border,
                        colors.green.border,
                        colors.yellow.border
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'right' }
                }
            }
        }
    );

    // Students Status Chart
    new Chart(
        document.getElementById('studentsStatusChart').getContext('2d'),
        {
            type: 'pie',
            data: {
                labels: <?php echo json_encode(array_column($students_status, 'status')); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_column($students_status, 'jumlah_siswa')); ?>,
                    backgroundColor: [
                        colors.green.bg,
                        colors.red.bg,
                        colors.yellow.bg
                    ],
                    borderColor: [
                        colors.green.border,
                        colors.red.border,
                        colors.yellow.border
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'right' }
                }
            }
        }
    );

    // Classes by Level Chart
    new Chart(
        document.getElementById('classesByLevelChart').getContext('2d'),
        {
            type: 'polarArea',
            data: {
                labels: <?php echo json_encode(array_column($classes_by_level, 'level')); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_column($classes_by_level, 'jumlah_kelas')); ?>,
                    backgroundColor: [
                        colors.blue.bg,
                        colors.indigo.bg,
                        colors.purple.bg
                    ],
                    borderColor: [
                        colors.blue.border,
                        colors.indigo.border,
                        colors.purple.border
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'right' }
                }
            }
        }
    );

    // Classes by Status Chart
    new Chart(
        document.getElementById('classesByStatusChart').getContext('2d'),
        {
            type: 'radar',
            data: {
                labels: <?php echo json_encode(array_column($classes_by_status, 'status')); ?>,
                datasets: [{
                    label: 'Kelas',
                    data: <?php echo json_encode(array_column($classes_by_status, 'jumlah_kelas')); ?>,
                    backgroundColor: colors.green.bg,
                    borderColor: colors.green.border,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        }
    );
});
</script>
