<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold">Siswa Saya</h1>
                <p class="text-sm opacity-90 mt-1"><?php echo count($siswa); ?> siswa terdaftar di kelas Anda</p>
            </div>
            <div class="grid grid-cols-2 sm:flex gap-4">
                <?php 
                    $total_premium = 0;
                    $total_gratis = 0;
                    $total_active = 0;
                    $total_progress = 0;
                    
                    foreach($siswa as $s) {
                        if ($s->class_type == 'Premium') $total_premium++;
                        if ($s->class_type == 'Free') $total_gratis++;
                        if (in_array($s->status, ['Active', 'Enrolled', 'Aktif'])) $total_active++;
                        $total_progress += isset($s->progress) ? $s->progress : 0;
                    }
                    
                    $avg_progress = count($siswa) > 0 ? round($total_progress / count($siswa)) : 0;
                ?>
                <div class="text-center bg-white bg-opacity-20 rounded-lg p-3 backdrop-blur-sm">
                    <div class="text-2xl font-bold"><?php echo $total_premium; ?></div>
                    <div class="text-xs opacity-90">
                        <i class="fas fa-crown mr-1"></i>Premium
                    </div>
                </div>
                <div class="text-center bg-white bg-opacity-20 rounded-lg p-3 backdrop-blur-sm">
                    <div class="text-2xl font-bold"><?php echo $total_gratis; ?></div>
                    <div class="text-xs opacity-90">
                        <i class="fas fa-gift mr-1"></i>Gratis
                    </div>
                </div>
                <div class="text-center bg-white bg-opacity-20 rounded-lg p-3 backdrop-blur-sm">
                    <div class="text-2xl font-bold"><?php echo $total_active; ?></div>
                    <div class="text-xs opacity-90">
                        <i class="fas fa-check-circle mr-1"></i>Aktif
                    </div>
                </div>
                <div class="text-center bg-white bg-opacity-20 rounded-lg p-3 backdrop-blur-sm">
                    <div class="text-2xl font-bold"><?php echo $avg_progress; ?>%</div>
                    <div class="text-xs opacity-90">
                        <i class="fas fa-chart-line mr-1"></i>Rata-rata Progress
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Student List -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Siswa</h2>
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <!-- Search -->
                    <div class="relative flex-1 sm:flex-initial sm:w-64">
                        <input type="text" placeholder="Cari siswa..." id="searchInput" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Filters -->
            <div class="flex flex-wrap gap-3 items-center">
                <span class="text-sm font-medium text-gray-700">Filter:</span>
                <div class="flex gap-2">
                    <button class="filter-btn px-4 py-2 text-sm font-medium rounded-lg border transition-all active" data-filter="all">
                        <i class="fas fa-users mr-1"></i> Semua
                    </button>
                    <button class="filter-btn px-4 py-2 text-sm font-medium rounded-lg border transition-all" data-filter="Premium">
                        <i class="fas fa-crown mr-1"></i> Premium
                    </button>
                    <button class="filter-btn px-4 py-2 text-sm font-medium rounded-lg border transition-all" data-filter="Gratis">
                        <i class="fas fa-gift mr-1"></i> Gratis
                    </button>
                </div>
                <div class="h-6 w-px bg-gray-300"></div>
                <div class="flex gap-2">
                    <button class="status-filter-btn px-4 py-2 text-sm font-medium rounded-lg border transition-all" data-status="Active,Enrolled">
                        <i class="fas fa-check-circle mr-1"></i> Aktif
                    </button>
                    <button class="status-filter-btn px-4 py-2 text-sm font-medium rounded-lg border transition-all" data-status="Completed">
                        <i class="fas fa-trophy mr-1"></i> Selesai
                    </button>
                    <button class="status-filter-btn px-4 py-2 text-sm font-medium rounded-lg border transition-all" data-status="Pending">
                        <i class="fas fa-clock mr-1"></i> Pending
                    </button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <?php if (empty($siswa)): ?>
                <div class="text-center py-16">
                    <div class="mx-auto w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center mb-6">
                        <i class="fas fa-user-graduate text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Siswa</h3>
                    <p class="text-gray-500">Saat ini belum ada siswa yang terdaftar di kelas Anda.</p>
                </div>
            <?php else: ?>
                <table class="min-w-full bg-white siswa-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Daftar</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach($siswa as $s): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center">
                                                <span class="text-white font-bold text-sm"><?php echo strtoupper(substr($s->nama_lengkap, 0, 2)); ?></span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900"><?php echo $s->nama_lengkap; ?></div>
                                            <div class="text-sm text-gray-500">
                                                <i class="fas fa-envelope text-xs mr-1"></i>
                                                <?php echo isset($s->email) ? $s->email : '-'; ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900"><?php echo isset($s->kelas) ? $s->kelas : '-'; ?></div>
                                    <?php if (isset($s->jurusan) && !empty($s->jurusan)): ?>
                                        <div class="text-xs text-gray-500 mt-1">
                                            <i class="fas fa-code text-xs mr-1"></i><?php echo $s->jurusan; ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo ($s->class_type == 'Premium') ? 'bg-gradient-to-r from-yellow-100 to-orange-100 text-orange-800' : 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-800'; ?>">
                                        <i class="<?php echo ($s->class_type == 'Premium') ? 'fas fa-crown' : 'fas fa-gift'; ?> mr-1"></i>
                                        <?php echo $s->class_type == 'Free' ? 'Gratis' : $s->class_type; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-full">
                                            <div class="flex items-center justify-between mb-1">
                                                <span class="text-xs font-medium text-gray-700"><?php echo isset($s->progress) ? $s->progress : 0; ?>%</span>
                                            </div>
                                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full transition-all" style="width: <?php echo isset($s->progress) ? $s->progress : 0; ?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php 
                                        $status = isset($s->status) ? $s->status : 'Tidak Aktif';
                                        $statusClass = '';
                                        $statusIcon = '';
                                        
                                        // Status untuk Premium: Pending, Active, Suspended, Completed, Cancelled
                                        // Status untuk Gratis: Enrolled, Completed, Dropped
                                        if (in_array($status, ['Active', 'Enrolled', 'Aktif'])) {
                                            $statusClass = 'bg-green-100 text-green-800 border border-green-200';
                                            $statusIcon = 'fas fa-check-circle';
                                        } elseif (in_array($status, ['Completed'])) {
                                            $statusClass = 'bg-blue-100 text-blue-800 border border-blue-200';
                                            $statusIcon = 'fas fa-trophy';
                                        } elseif (in_array($status, ['Pending'])) {
                                            $statusClass = 'bg-yellow-100 text-yellow-800 border border-yellow-200';
                                            $statusIcon = 'fas fa-clock';
                                        } elseif (in_array($status, ['Suspended', 'Dropped'])) {
                                            $statusClass = 'bg-red-100 text-red-800 border border-red-200';
                                            $statusIcon = 'fas fa-ban';
                                        } elseif (in_array($status, ['Cancelled'])) {
                                            $statusClass = 'bg-gray-100 text-gray-800 border border-gray-200';
                                            $statusIcon = 'fas fa-times-circle';
                                        } else {
                                            $statusClass = 'bg-gray-100 text-gray-800 border border-gray-200';
                                            $statusIcon = 'fas fa-question-circle';
                                        }
                                    ?>
                                    <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full <?php echo $statusClass; ?>">
                                        <i class="<?php echo $statusIcon; ?> mr-1"></i>
                                        <?php echo $status; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <i class="far fa-calendar-alt text-gray-400 mr-1"></i>
                                        <?php 
                                            if (isset($s->enrollment_date)) {
                                                $date = new DateTime($s->enrollment_date);
                                                echo $date->format('d M Y');
                                            } else {
                                                echo '-';
                                            }
                                        ?>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        <?php 
                                            if (isset($s->enrollment_date)) {
                                                $date = new DateTime($s->enrollment_date);
                                                echo $date->format('H:i');
                                            }
                                        ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="<?php echo site_url('teacher/siswa_detail/' . $s->id); ?>" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-lg transition-all shadow-sm hover:shadow-md">
                                        <i class="fas fa-eye mr-1"></i>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
.filter-btn.active, .status-filter-btn.active {
    background: linear-gradient(to right, #3b82f6, #6366f1);
    color: white;
    border-color: #3b82f6;
    box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
}

.filter-btn:not(.active), .status-filter-btn:not(.active) {
    background: white;
    color: #6b7280;
    border-color: #e5e7eb;
}

.filter-btn:not(.active):hover, .status-filter-btn:not(.active):hover {
    background: #f9fafb;
    border-color: #d1d5db;
}
</style>

<script>
$(document).ready(function() {
    let currentTypeFilter = 'all';
    let currentStatusFilter = [];
    let searchValue = '';

    // Function to apply all filters
    function applyFilters() {
        $('.siswa-table tbody tr').each(function() {
            const $row = $(this);
            const rowText = $row.text().toLowerCase();
            const classTypeDisplay = $row.find('td:nth-child(3) span').text().trim();
            const status = $row.find('td:nth-child(5) span').text().trim();
            
            // Check search filter
            const matchesSearch = searchValue === '' || rowText.indexOf(searchValue) > -1;
            
            // Check type filter - handle both "Gratis" display and "Premium"
            let matchesType = false;
            if (currentTypeFilter === 'all') {
                matchesType = true;
            } else if (currentTypeFilter === 'Premium') {
                matchesType = classTypeDisplay === 'Premium';
            } else if (currentTypeFilter === 'Gratis') {
                matchesType = classTypeDisplay === 'Gratis';
            }
            
            // Check status filter
            const matchesStatus = currentStatusFilter.length === 0 || currentStatusFilter.some(s => status.toLowerCase().includes(s.toLowerCase()));
            
            // Show row only if all filters match
            $row.toggle(matchesSearch && matchesType && matchesStatus);
        });

        // Update showing count
        updateCount();
    }

    // Update count of visible rows
    function updateCount() {
        const visibleCount = $('.siswa-table tbody tr:visible').length;
        const totalCount = $('.siswa-table tbody tr').length;
        
        if (visibleCount < totalCount) {
            if ($('#filterCount').length === 0) {
                $('.siswa-table').before('<div id="filterCount" class="mb-3 text-sm text-gray-600"></div>');
            }
            $('#filterCount').html(`<i class="fas fa-filter mr-1"></i>Menampilkan <span class="font-semibold">${visibleCount}</span> dari <span class="font-semibold">${totalCount}</span> siswa`);
        } else {
            $('#filterCount').remove();
        }
    }

    // Search functionality
    $('#searchInput').on('keyup', function() {
        searchValue = $(this).val().toLowerCase();
        applyFilters();
    });

    // Type filter functionality
    $('.filter-btn').click(function() {
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        
        currentTypeFilter = $(this).data('filter');
        applyFilters();
    });

    // Status filter functionality (can select multiple)
    $('.status-filter-btn').click(function() {
        $(this).toggleClass('active');
        
        currentStatusFilter = [];
        $('.status-filter-btn.active').each(function() {
            const statusData = $(this).data('status').split(',');
            currentStatusFilter = currentStatusFilter.concat(statusData);
        });
        
        applyFilters();
    });

    // Initialize tooltips
    $('[data-tooltip]').hover(function() {
        const tooltip = $(this).data('tooltip');
        $(this).attr('title', tooltip);
    });
});
</script>
