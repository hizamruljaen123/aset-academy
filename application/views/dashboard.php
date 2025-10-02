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
                <span class="font-medium"><?php echo number_format($stats['total_users']); ?> Pengguna</span>
            </div>
            <div class="flex items-center bg-green-50/50 px-4 py-2 rounded-xl">
                <i class="fas fa-graduation-cap text-green-600 mr-2"></i>
                <span class="font-medium"><?php echo number_format($stats['total_siswa']); ?> Siswa</span>
            </div>
            <div class="flex items-center bg-indigo-50/50 px-4 py-2 rounded-xl">
                <i class="fas fa-chalkboard-teacher text-indigo-600 mr-2"></i>
                <span class="font-medium"><?php echo number_format($stats['total_teachers']); ?> Guru</span>
            </div>
            <div class="flex items-center text-gray-500">
                <i class="fas fa-calendar-alt mr-2"></i>
                <span><?php echo date('d F Y'); ?></span>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Users Stats -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                    <p class="text-2xl font-bold text-gray-900"><?php echo number_format($stats['total_users']); ?></p>
                    <p class="text-xs text-gray-500 mt-1">
                        <span class="text-green-600 font-medium">+<?php echo $stats['new_users_today']; ?> hari ini</span>
                    </p>
                </div>
                <div class="p-3 bg-blue-50 rounded-xl">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Students Stats -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Siswa</p>
                    <p class="text-2xl font-bold text-gray-900"><?php echo number_format($stats['total_siswa']); ?></p>
                    <p class="text-xs text-gray-500 mt-1">
                        <span class="text-green-600 font-medium"><?php echo number_format($stats['siswa_aktif']); ?> aktif</span>
                    </p>
                </div>
                <div class="p-3 bg-green-50 rounded-xl">
                    <i class="fas fa-user-graduate text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Teachers Stats -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Guru</p>
                    <p class="text-2xl font-bold text-gray-900"><?php echo number_format($stats['total_teachers']); ?></p>
                    <p class="text-xs text-gray-500 mt-1">
                        <span class="text-green-600 font-medium"><?php echo number_format($stats['active_teachers']); ?> aktif</span>
                    </p>
                </div>
                <div class="p-3 bg-indigo-50 rounded-xl">
                    <i class="fas fa-chalkboard-teacher text-indigo-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Revenue Stats -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-gray-900">Rp<?php echo number_format($stats['total_revenue'], 0, ',', '.'); ?></p>
                    <p class="text-xs text-gray-500 mt-1">
                        <span class="text-green-600 font-medium">Rp<?php echo number_format($stats['monthly_revenue'], 0, ',', '.'); ?> bulan ini</span>
                    </p>
                </div>
                <div class="p-3 bg-purple-50 rounded-xl">
                    <i class="fas fa-money-bill-wave text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- User Growth Chart -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                <h2 class="text-xl font-bold text-gray-800">Pertumbuhan Pengguna (30 Hari)</h2>
            </div>
            <div class="p-6">
                <div class="h-80">
                    <canvas id="userGrowthChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Revenue Chart -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                <h2 class="text-xl font-bold text-gray-800">Pendapatan (30 Hari)</h2>
            </div>
            <div class="p-6">
                <div class="h-80">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Enrollments & Classes -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Enrollments Chart -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                <h2 class="text-xl font-bold text-gray-800">Pendaftaran Kelas (30 Hari)</h2>
            </div>
            <div class="p-6">
                <div class="h-80">
                    <canvas id="enrollmentsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Class Distribution -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                <h2 class="text-xl font-bold text-gray-800">Distribusi Kelas</h2>
            </div>
            <div class="p-6">
                <div class="h-80">
                    <canvas id="classDistributionChart"></canvas>
                </div>
            </div>
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
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Recent Payments -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">Pembayaran Terbaru</h2>
                    <a href="<?php echo site_url('admin/payments'); ?>" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                <?php if(empty($recent_payments)): ?>
                    <div class="text-center py-8">
                        <i class="fas fa-receipt text-4xl text-gray-400 mb-3"></i>
                        <p class="text-gray-500">Belum ada data pembayaran</p>
                    </div>
                <?php else: ?>
                    <div class="space-y-4">
                        <?php foreach($recent_payments as $payment): ?>
                            <div class="p-4 border border-gray-100 rounded-xl hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-800">
                                        <?php echo $payment->class_name; ?>
                                    </span>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full <?php 
                                        echo ($payment->status == 'Verified') ? 'bg-green-100 text-green-800' : 
                                        (($payment->status == 'Pending') ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'); 
                                    ?>">
                                        <?php echo $payment->status; ?>
                                    </span>
                                </div>
                                <h4 class="font-medium text-gray-900"><?php echo $payment->student_name; ?></h4>
                                <p class="text-sm text-gray-500">Rp <?php echo number_format($payment->amount, 0, ',', '.'); ?></p>
                                <p class="text-xs text-gray-400 mt-1">
                                    <?php echo date('d M Y', strtotime($payment->created_at)); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

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
                                <span class="px-3 py-1 text-xs font-medium rounded-full <?php 
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

    // User Growth Chart
    new Chart(
        document.getElementById('userGrowthChart').getContext('2d'),
        {
            type: 'line',
            data: {
                labels: <?php echo $chart_labels; ?>,
                datasets: [{
                    label: 'Pertumbuhan Pengguna',
                    data: <?php echo $chart_data; ?>,
                    fill: true,
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderColor: colors.blue.border,
                    borderWidth: 2,
                    tension: 0.3,
                    pointBackgroundColor: colors.blue.border,
                    pointBorderColor: '#fff',
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: colors.blue.border,
                    pointHoverBorderColor: '#fff',
                    pointHitRadius: 10,
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Pengguna: ' + context.parsed.y;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0, 0, 0, 0.05)' },
                        ticks: { 
                            precision: 0,
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        }
    );

    // Revenue Chart
    new Chart(
        document.getElementById('revenueChart').getContext('2d'),
        {
            type: 'bar',
            data: {
                labels: <?php echo $rev_labels; ?>,
                datasets: [{
                    label: 'Pendapatan',
                    data: <?php echo $rev_values; ?>,
                    backgroundColor: colors.green.bg,
                    borderColor: colors.green.border,
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Rp' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0, 0, 0, 0.05)' },
                        ticks: {
                            callback: function(value) {
                                return 'Rp' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        }
    );

    // Enrollments Chart
    new Chart(
        document.getElementById('enrollmentsChart').getContext('2d'),
        {
            type: 'line',
            data: {
                labels: <?php echo $enroll_dates; ?>,
                datasets: [
                    {
                        label: 'Kelas Premium',
                        data: <?php echo $prem_enroll_data; ?>,
                        borderColor: colors.blue.border,
                        backgroundColor: 'rgba(59, 130, 246, 0.05)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                        pointBackgroundColor: colors.blue.border,
                        pointBorderColor: '#fff',
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: colors.blue.border,
                        pointHoverBorderColor: '#fff',
                        pointHitRadius: 10,
                        pointBorderWidth: 2
                    },
                    {
                        label: 'Kelas Gratis',
                        data: <?php echo $free_enroll_data; ?>,
                        borderColor: colors.green.border,
                        backgroundColor: 'rgba(16, 185, 129, 0.05)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                        pointBackgroundColor: colors.green.border,
                        pointBorderColor: '#fff',
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: colors.green.border,
                        pointHoverBorderColor: '#fff',
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        borderDash: [5, 5]
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' pendaftaran';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0, 0, 0, 0.05)' },
                        ticks: { precision: 0 }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        }
    );

    // Class Distribution Chart
    const classCtx = document.getElementById('classDistributionChart').getContext('2d');
    if (classCtx) {
        new Chart(classCtx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode(array_column($class_dist, 'label')); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_column($class_dist, 'value')); ?>,
                    backgroundColor: [
                        colors.blue.bg,
                        colors.indigo.bg,
                        colors.purple.bg,
                        colors.green.bg,
                        colors.yellow.bg,
                        colors.red.bg
                    ],
                    borderColor: [
                        colors.blue.border,
                        colors.indigo.border,
                        colors.purple.border,
                        colors.green.border,
                        colors.yellow.border,
                        colors.red.border
                    ],
                    borderWidth: 1,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        padding: 12,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Classes by Level Chart
    const classesByLevelCtx = document.getElementById('classesByLevelChart');
    if (classesByLevelCtx) {
        new Chart(classesByLevelCtx.getContext('2d'), {
            type: 'polarArea',
            data: {
                labels: <?php echo json_encode(array_column($classes_by_level, 'level')); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_column($classes_by_level, 'jumlah_kelas')); ?>,
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
                    legend: { 
                        position: 'right',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + ' kelas';
                            }
                        }
                    }
                },
                scale: {
                    ticks: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    }

    // Classes by Status Chart
    const classesByStatusCtx = document.getElementById('classesByStatusChart');
    if (classesByStatusCtx) {
        new Chart(classesByStatusCtx.getContext('2d'), {
            type: 'radar',
            data: {
                labels: <?php echo json_encode(array_column($classes_by_status, 'status')); ?>,
                datasets: [{
                    label: 'Jumlah Kelas',
                    data: <?php echo json_encode(array_column($classes_by_status, 'jumlah_kelas')); ?>,
                    backgroundColor: 'rgba(16, 185, 129, 0.2)',
                    borderColor: colors.green.border,
                    borderWidth: 2,
                    pointBackgroundColor: colors.green.border,
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: colors.green.border
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + ' kelas';
                            }
                        }
                    }
                },
                scales: {
                    r: {
                        angleLines: { color: 'rgba(0, 0, 0, 0.1)' },
                        suggestedMin: 0,
                        ticks: {
                            precision: 0,
                            backdropColor: 'rgba(255, 255, 255, 0.75)'
                        }
                    }
                },
                elements: {
                    line: {
                        borderWidth: 3
                    }
                }
            }
        });
    }
});
</script>
