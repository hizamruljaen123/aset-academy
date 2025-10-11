<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-lg shadow">
        <div class="mb-4 md:mb-0">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-gray-600 mt-1">Welcome back, <?php echo $this->session->userdata('nama_lengkap') ?: 'User'; ?>! Here's your academy overview.</p>
        </div>
        <div class="flex items-center text-gray-500">
            <i class="fas fa-calendar-alt mr-2"></i>
            <span><?php echo date('d F Y'); ?></span>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-lg shadow flex items-center">
                    <div class="p-3 rounded-full bg-sky-100 text-sky-600 mr-4">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-gray-800"><?php echo $stats['total_kelas']; ?></h4>
                        <p class="text-gray-600">Total Kelas</p>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow flex items-center">
                    <div class="p-3 rounded-full bg-teal-100 text-teal-600 mr-4">
                        <i class="fas fa-book"></i>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-gray-800"><?php echo $stats['total_materi']; ?></h4>
                        <p class="text-gray-600">Total Materi</p>
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
                    <div class="p-3 rounded-full bg-amber-100 text-amber-600 mr-4">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-gray-800"><?php echo $total_teachers; ?></h4>
                        <p class="text-gray-600">Total Guru</p>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-gray-800"><?php echo $stats['total_payments']; ?></h4>
                        <p class="text-gray-600">Total Pembayaran</p>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-gray-800"><?php echo $stats['verified_payments']; ?></h4>
                        <p class="text-gray-600">Pembayaran Diverifikasi</p>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-gray-800"><?php echo $stats['pending_payments']; ?></h4>
                        <p class="text-gray-600">Pembayaran Pending</p>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-gray-800">Rp <?php echo number_format($stats['revenue'] ?? 0, 0, ',', '.'); ?></h4>
                        <p class="text-gray-600">Total Pendapatan</p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Aktivitas Terbaru</h2>
                </div>
                <div class="p-4 space-y-4">
                    <?php foreach($recent_payments as $payment): ?>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 p-2 rounded-full bg-green-100 text-green-600 mr-3">
                            <i class="fas fa-money-bill-wave text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-800">
                                <strong><?php echo $payment->student_name; ?></strong> membeli kelas 
                                <strong><?php echo $payment->class_name; ?></strong> (Rp <?php echo number_format($payment->amount ?? 0, 0, ',', '.'); ?>)
                            </p>
                            <p class="text-xs text-gray-500"><?php echo date('d M Y', strtotime($payment->created_at)); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php foreach(array_slice($recent_siswa, 0, 2) as $siswa): ?>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 p-2 rounded-full bg-indigo-100 text-indigo-600 mr-3">
                            <i class="fas fa-user-plus text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-800">Siswa baru <strong><?php echo $siswa->nama_lengkap; ?></strong> telah ditambahkan.</p>
                            <p class="text-xs text-gray-500"><?php echo date('d M Y', strtotime($siswa->created_at)); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php foreach(array_slice($recent_kelas, 0, 2) as $kelas): ?>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 p-2 rounded-full bg-sky-100 text-sky-600 mr-3">
                            <i class="fas fa-plus-circle text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-800">Kelas baru <strong><?php echo $kelas->nama_kelas; ?></strong> telah dibuat.</p>
                            <p class="text-xs text-gray-500"><?php echo date('d M Y', strtotime($kelas->created_at)); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <!-- Jurusan Distribution -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Distribusi Jurusan</h2>
                </div>
                <div class="p-4">
                    <div id="jurusanChart" style="width: 100%; height: 500px;"></div>
                    <?php if (!empty($jurusan_dist)): ?>
                    <div class="mt-6">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3">Ringkasan Jumlah Siswa per Jurusan</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-2 text-left font-medium text-gray-600 uppercase tracking-wider">Jurusan</th>
                                        <th scope="col" class="px-4 py-2 text-right font-medium text-gray-600 uppercase tracking-wider">Total Siswa</th>
                                        <th scope="col" class="px-4 py-2 text-right font-medium text-gray-600 uppercase tracking-wider">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php 
                                        $totalJurusan = array_sum(array_map(function($item) { return $item['total'] ?? 0; }, $jurusan_dist));
                                    ?>
                                    <?php foreach ($jurusan_dist as $index => $item): 
                                        $count = $item['total'] ?? 0;
                                        $percentage = $totalJurusan > 0 ? round(($count / $totalJurusan) * 100, 1) : 0;
                                    ?>
                                    <tr data-chart-index="<?php echo $index; ?>" class="transition hover:bg-sky-50 cursor-pointer">
                                        <td class="px-4 py-2 text-gray-800"><?php echo $item['jurusan'] ?? '-'; ?></td>
                                        <td class="px-4 py-2 text-right font-semibold text-gray-900"><?php echo number_format($count); ?></td>
                                        <td class="px-4 py-2 text-right text-gray-700"><?php echo number_format($percentage, 1); ?>%</td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php else: ?>
                    <p class="mt-6 text-sm text-gray-500">Data jurusan belum tersedia.</p>
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
                        <a href="<?php echo site_url('kelas/create'); ?>" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-50 text-center">
                            <i class="fas fa-graduation-cap text-blue-600 mb-2"></i>
                            <span class="text-xs font-medium">Tambah Kelas</span>
                        </a>
                        <a href="<?php echo site_url('siswa/create'); ?>" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-50 text-center">
                            <i class="fas fa-user-plus text-indigo-600 mb-2"></i>
                            <span class="text-xs font-medium">Tambah Siswa</span>
                        </a>
                        <a href="<?php echo site_url('materi'); ?>" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-50 text-center">
                            <i class="fas fa-book-medical text-teal-600 mb-2"></i>
                            <span class="text-xs font-medium">Tambah Materi</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dashboard = document.querySelector('.transition-opacity');
    if (dashboard) {
        dashboard.classList.add('opacity-100');
    }
    
    const chartDom = document.getElementById('jurusanChart');
    const myChart = echarts.init(chartDom);
    const jurusanData = <?php echo json_encode($jurusan_dist); ?>;

    const chartData = jurusanData.map(item => ({
        name: item.jurusan,
        value: item.total
    }));

    const option = {
        tooltip: {
            trigger: 'item',
            formatter: '{b}: {c} ({d}%)'
        },
        legend: {
            show: false
        },
        series: [
            {
                name: 'Distribusi Jurusan',
                type: 'pie',
                radius: ['50%', '70%'],
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 10,
                    borderColor: '#fff',
                    borderWidth: 2
                },
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: '20',
                        fontWeight: 'bold'
                    }
                },
                labelLine: {
                    show: false
                },
                data: chartData
            }
        ],
        color: ['#38bdf8', '#2dd4bf', '#818cf8', '#f59e0b', '#fb7185']
    };

    option && myChart.setOption(option);

    const resetHighlights = () => {
        myChart.dispatchAction({ type: 'downplay', seriesIndex: 0 });
    };

    const tableRows = document.querySelectorAll('[data-chart-index]');
    tableRows.forEach(row => {
        const dataIndex = parseInt(row.dataset.chartIndex, 10);
        row.addEventListener('mouseenter', () => {
            resetHighlights();
            myChart.dispatchAction({ type: 'highlight', seriesIndex: 0, dataIndex });
            myChart.dispatchAction({ type: 'showTip', seriesIndex: 0, dataIndex });
        });
        row.addEventListener('mouseleave', () => {
            myChart.dispatchAction({ type: 'hideTip' });
            resetHighlights();
        });
        row.addEventListener('focus', () => {
            resetHighlights();
            myChart.dispatchAction({ type: 'highlight', seriesIndex: 0, dataIndex });
            myChart.dispatchAction({ type: 'showTip', seriesIndex: 0, dataIndex });
        });
        row.addEventListener('blur', () => {
            myChart.dispatchAction({ type: 'hideTip' });
            resetHighlights();
        });
        row.setAttribute('tabindex', '0');
    });

    window.addEventListener('resize', function() {
        myChart.resize();
    });
});
</script>
