<div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Absensi Saya</h1>
        <p class="text-gray-600 mt-2">Pantau kehadiran Anda di semua kelas yang diikuti</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Total Hadir</h3>
                    <p class="text-2xl font-bold">
                        <?php
                        $total_present = 0;
                        foreach ($attendance_summary['present_classes'] as $class) {
                            $total_present += $class->present_count;
                        }
                        echo $total_present;
                        ?>
                    </p>
                </div>
                <i class="fas fa-check-circle text-4xl opacity-80"></i>
            </div>
        </div>

        <div class="bg-gradient-to-r from-red-500 to-pink-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Total Tidak Hadir</h3>
                    <p class="text-2xl font-bold">
                        <?php
                        $total_absent = 0;
                        foreach ($attendance_summary['present_classes'] as $class) {
                            $total_absent += $class->absent_count;
                        }
                        echo $total_absent;
                        ?>
                    </p>
                </div>
                <i class="fas fa-times-circle text-4xl opacity-80"></i>
            </div>
        </div>

        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Kelas Terdaftar</h3>
                    <p class="text-2xl font-bold"><?php echo count($enrolled_classes); ?></p>
                </div>
                <i class="fas fa-graduation-cap text-4xl opacity-80"></i>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="border-b border-gray-200">
            <nav class="flex">
                <button onclick="showTab('present')" id="present-tab" class="tab-button active px-6 py-4 text-sm font-medium border-b-2 border-blue-500 text-blue-600 bg-blue-50">
                    <i class="fas fa-check-circle mr-2"></i>Kelas Sudah Dihadiri
                    <span class="ml-2 bg-blue-600 text-white px-2 py-1 rounded-full text-xs"><?php echo count($attendance_summary['present_classes']); ?></span>
                </button>
                <button onclick="showTab('absent')" id="absent-tab" class="tab-button px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-calendar-times mr-2"></i>Belum Pernah Absen
                    <span class="ml-2 bg-gray-600 text-white px-2 py-1 rounded-full text-xs"><?php echo count($attendance_summary['absent_classes']); ?></span>
                </button>
                <button onclick="showTab('calendar')" id="calendar-tab" class="tab-button px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-calendar-alt mr-2"></i>Kalender Absensi
                </button>
            </nav>
        </div>

        <div class="p-6">
            <!-- Present Classes Tab -->
            <div id="present-tab-content" class="tab-content">
                <?php if (!empty($attendance_summary['present_classes'])): ?>
                    <div class="space-y-6">
                        <?php foreach ($attendance_summary['present_classes'] as $class): ?>
                            <div class="border border-gray-200 rounded-lg p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800"><?php echo $class->nama_kelas; ?></h3>
                                        <p class="text-gray-600"><?php echo $class->bahasa_program; ?> • Level <?php echo $class->level; ?></p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            Terdaftar sejak: <?php echo date('d M Y', strtotime($class->enrollment_date)); ?>
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-2xl font-bold text-green-600"><?php echo $class->present_count; ?>/<?php echo $class->total_sessions; ?></div>
                                        <div class="text-sm text-gray-600">Sesi hadir</div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div class="bg-green-50 p-4 rounded-lg text-center">
                                        <div class="text-2xl font-bold text-green-600"><?php echo $class->present_count; ?></div>
                                        <div class="text-sm text-green-700">Hadir</div>
                                    </div>
                                    <div class="bg-red-50 p-4 rounded-lg text-center">
                                        <div class="text-2xl font-bold text-red-600"><?php echo $class->absent_count; ?></div>
                                        <div class="text-sm text-red-700">Tidak Hadir</div>
                                    </div>
                                </div>

                                <div class="border-t pt-4">
                                    <h4 class="font-semibold text-gray-800 mb-3">Riwayat Absensi:</h4>
                                    <div class="space-y-2 max-h-48 overflow-y-auto">
                                        <?php foreach ($class->attendance_records as $record): ?>
                                            <div class="flex justify-between items-center py-2 px-3 bg-gray-50 rounded">
                                                <div>
                                                    <div class="font-medium"><?php echo $record->judul_pertemuan; ?></div>
                                                    <div class="text-sm text-gray-600"><?php echo date('d M Y', strtotime($record->tanggal_pertemuan)); ?> • <?php echo date('H:i', strtotime($record->waktu_mulai)); ?> - <?php echo date('H:i', strtotime($record->waktu_selesai)); ?></div>
                                                </div>
                                                <span class="px-2 py-1 text-xs font-medium rounded-full <?php echo ($record->status == 'Hadir') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                                    <?php echo $record->status; ?>
                                                </span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-12">
                        <i class="fas fa-check-circle text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Riwayat Absensi</h3>
                        <p class="text-gray-500">Anda belum pernah mengisi absensi di kelas manapun.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Absent Classes Tab -->
            <div id="absent-tab-content" class="tab-content hidden">
                <?php if (!empty($attendance_summary['absent_classes'])): ?>
                    <div class="space-y-6">
                        <?php foreach ($attendance_summary['absent_classes'] as $class): ?>
                            <div class="border border-gray-200 rounded-lg p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800"><?php echo $class->nama_kelas; ?></h3>
                                        <p class="text-gray-600"><?php echo $class->bahasa_program; ?> • Level <?php echo $class->level; ?></p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            Terdaftar sejak: <?php echo date('d M Y', strtotime($class->enrollment_date)); ?>
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">
                                            Belum pernah absen
                                        </span>
                                    </div>
                                </div>

                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                                        <div>
                                            <h4 class="font-medium text-blue-800">Belum Ada Riwayat Absensi</h4>
                                            <p class="text-blue-600 text-sm">Anda belum pernah mengisi absensi untuk kelas ini. Pastikan untuk hadir di pertemuan berikutnya.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-12">
                        <i class="fas fa-graduation-cap text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Semua Kelas Sudah Pernah Absen</h3>
                        <p class="text-gray-500">Anda sudah pernah mengisi absensi di semua kelas yang diikuti.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Calendar Tab -->
            <div id="calendar-tab-content" class="tab-content hidden">
                <div class="bg-white">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Kalender Absensi</h3>
                        <p class="text-gray-600 text-sm">Tanggal dengan warna menunjukkan status absensi Anda</p>
                    </div>

                    <div class="grid grid-cols-7 gap-1 mb-4">
                        <?php
                        $days = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
                        foreach ($days as $day) {
                            echo "<div class='p-2 text-center text-sm font-medium text-gray-500 bg-gray-100 rounded'>{$day}</div>";
                        }
                        ?>
                    </div>

                    <div id="calendar-grid" class="grid grid-cols-7 gap-1">
                        <!-- Calendar will be populated by JavaScript -->
                    </div>

                    <div class="mt-6 flex flex-wrap gap-4">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
                            <span class="text-sm text-gray-600">Hadir</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-red-500 rounded mr-2"></div>
                            <span class="text-sm text-gray-600">Tidak Hadir</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-blue-500 rounded mr-2"></div>
                            <span class="text-sm text-gray-600">Izin</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-yellow-500 rounded mr-2"></div>
                            <span class="text-sm text-gray-600">Sakit</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });

    // Remove active class from all tab buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active', 'text-blue-600', 'bg-blue-50', 'border-blue-500');
        button.classList.add('text-gray-500');
    });

    // Show selected tab content
    document.getElementById(tabName + '-tab-content').classList.remove('hidden');

    // Add active class to selected tab button
    const activeButton = document.getElementById(tabName + '-tab');
    activeButton.classList.add('active', 'text-blue-600', 'bg-blue-50', 'border-blue-500');
    activeButton.classList.remove('text-gray-500');
}

// Calendar functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize with present tab
    showTab('present');

    // Generate calendar
    generateCalendar();
});

function generateCalendar() {
    const calendarGrid = document.getElementById('calendar-grid');
    const now = new Date();
    const year = now.getFullYear();
    const month = now.getMonth();

    // Get first day of month and last day of month
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const startDate = new Date(firstDay);
    startDate.setDate(startDate.getDate() - firstDay.getDay()); // Start from Sunday

    // Attendance dates from PHP
    const attendanceDates = <?php echo json_encode($attendance_dates); ?>;

    // Create calendar cells
    let currentDate = new Date(startDate);
    let html = '';

    for (let i = 0; i < 42; i++) { // 6 weeks * 7 days
        const isCurrentMonth = currentDate.getMonth() === month;
        const dateStr = currentDate.toISOString().split('T')[0];

        // Find attendance for this date
        const attendanceForDate = attendanceDates.find(att => att.date === dateStr);

        let cellClass = 'p-2 text-center text-sm border rounded cursor-pointer transition-colors ';
        let cellContent = currentDate.getDate();

        if (!isCurrentMonth) {
            cellClass += 'text-gray-300 bg-gray-50';
        } else if (attendanceForDate) {
            // Add color based on attendance status
            switch (attendanceForDate.status) {
                case 'Hadir':
                    cellClass += 'bg-green-100 text-green-800 border-green-200 hover:bg-green-200';
                    break;
                case 'Tidak Hadir':
                case 'Alpa':
                    cellClass += 'bg-red-100 text-red-800 border-red-200 hover:bg-red-200';
                    break;
                case 'Izin':
                    cellClass += 'bg-blue-100 text-blue-800 border-blue-200 hover:bg-blue-200';
                    break;
                case 'Sakit':
                    cellClass += 'bg-yellow-100 text-yellow-800 border-yellow-200 hover:bg-yellow-200';
                    break;
                default:
                    cellClass += 'bg-gray-100 text-gray-800 border-gray-200 hover:bg-gray-200';
            }
            cellContent += '<br><small class="text-xs">' + attendanceForDate.status + '</small>';
        } else {
            cellClass += 'text-gray-700 hover:bg-gray-100';
        }

        html += `<div class="${cellClass}" title="${isCurrentMonth ? 'Tanggal: ' + dateStr : ''}">${cellContent}</div>`;

        currentDate.setDate(currentDate.getDate() + 1);
    }

    calendarGrid.innerHTML = html;
}
</script>
