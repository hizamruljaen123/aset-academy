<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <h1 class="text-3xl font-bold">Absensi Saya</h1>
        <p class="text-sm opacity-90 mt-1">Lihat riwayat kehadiran Anda dalam format kalender dan tabel.</p>
    </div>

    <!-- Tab Navigation -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8">
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px">
                <button id="calendarTab" class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm border-blue-500 text-blue-600 active">
                    Kalender Absensi
                </button>
                <button id="tableTab" class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Tabel Absensi
                </button>
            </nav>
        </div>

        <!-- Calendar Content -->
        <div id="calendarContent" class="p-6">
            <!-- Legend -->
            <div class="attendance-legend mb-6">
                <div class="legend-item">
                    <div class="legend-color" style="background-color: #dcfce7;"></div>
                    <span>Hadir</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: #fef9c3;"></div>
                    <span>Sakit</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: #cffafe;"></div>
                    <span>Izin</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: #fee2e2;"></div>
                    <span>Alpa</span>
                </div>
            </div>

            <!-- Calendar -->
            <div id='calendar'></div>
        </div>

        <!-- Table Content -->
        <div id="tableContent" class="p-6 hidden">
            <!-- Table Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Riwayat Absensi</h2>
                <div class="text-sm text-gray-600">
                    Total: <?php echo count($absensi); ?> pertemuan
                </div>
            </div>

            <!-- Attendance Table -->
            <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pertemuan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guru</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($absensi)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($absensi as $absen): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $no++; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo date('d M Y', strtotime($absen['tanggal_pertemuan'])); ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <?php echo $absen['judul_pertemuan']; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo $absen['nama_guru']; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            <?php
                                            switch ($absen['status']) {
                                                case 'Hadir':
                                                    echo 'bg-green-100 text-green-800';
                                                    break;
                                                case 'Sakit':
                                                    echo 'bg-yellow-100 text-yellow-800';
                                                    break;
                                                case 'Izin':
                                                    echo 'bg-blue-100 text-blue-800';
                                                    break;
                                                case 'Alpa':
                                                    echo 'bg-red-100 text-red-800';
                                                    break;
                                                default:
                                                    echo 'bg-gray-100 text-gray-800';
                                            }
                                            ?>">
                                            <?php echo $absen['status']; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <?php echo $absen['catatan'] ?: '-'; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <div class="mx-auto w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                        <i class="fas fa-calendar-times text-gray-400 text-2xl"></i>
                                    </div>
                                    <p>Belum ada data absensi</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Summary Stats -->
            <?php if (!empty($absensi)): ?>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                    <?php
                    $stats = [
                        'Hadir' => 0,
                        'Sakit' => 0,
                        'Izin' => 0,
                        'Alpa' => 0
                    ];
                    foreach ($absensi as $absen) {
                        if (isset($stats[$absen['status']])) {
                            $stats[$absen['status']]++;
                        }
                    }
                    ?>
                    <div class="bg-green-50 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-green-600"><?php echo $stats['Hadir']; ?></div>
                        <div class="text-sm text-green-800">Hadir</div>
                    </div>
                    <div class="bg-yellow-50 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-yellow-600"><?php echo $stats['Sakit']; ?></div>
                        <div class="text-sm text-yellow-800">Sakit</div>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-blue-600"><?php echo $stats['Izin']; ?></div>
                        <div class="text-sm text-blue-800">Izin</div>
                    </div>
                    <div class="bg-red-50 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-red-600"><?php echo $stats['Alpa']; ?></div>
                        <div class="text-sm text-red-800">Alpa</div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Attendance Detail Modal -->
    <div id="attendanceModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Detail Kehadiran</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
            </div>
            <div>
                <p class="mb-2"><strong class="font-medium text-gray-600">Tanggal:</strong> <span id="modalDate"></span></p>
                <p class="mb-2"><strong class="font-medium text-gray-600">Kelas:</strong> <span id="modalClass"></span></p>
                <p class="mb-2"><strong class="font-medium text-gray-600">Guru:</strong> <span id="modalTeacher"></span></p>
                <p class="mb-2"><strong class="font-medium text-gray-600">Status:</strong> <span id="modalStatus"></span></p>
                <p><strong class="font-medium text-gray-600">Catatan:</strong> <span id="modalNotes"></span></p>
            </div>
        </div>
    </div>
</div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const calendarTab = document.getElementById('calendarTab');
    const tableTab = document.getElementById('tableTab');
    const calendarContent = document.getElementById('calendarContent');
    const tableContent = document.getElementById('tableContent');

    calendarTab.addEventListener('click', function() {
        calendarTab.className = 'w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm border-blue-500 text-blue-600 active';
        tableTab.className = 'w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300';
        calendarContent.classList.remove('hidden');
        tableContent.classList.add('hidden');
    });

    tableTab.addEventListener('click', function() {
        tableTab.className = 'w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm border-blue-500 text-blue-600 active';
        calendarTab.className = 'w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300';
        tableContent.classList.remove('hidden');
        calendarContent.classList.add('hidden');
    });

    // Calendar initialization
    var calendarEl = document.getElementById('calendar');

    var events = <?php echo json_encode(array_map(function($absen) {
        $class = '';
        switch ($absen['status']) {
            case 'Hadir': $class = 'event-hadir'; break;
            case 'Sakit': $class = 'event-sakit'; break;
            case 'Izin': $class = 'event-izin'; break;
            case 'Alpa': $class = 'event-alpa'; break;
        }
        return [
            'title' => $absen['status'],
            'start' => $absen['tanggal_pertemuan'],
            'className' => $class,
            'extendedProps' => [
                'nama_kelas' => $absen['judul_pertemuan'],
                'nama_guru' => $absen['nama_guru'],
                'catatan' => $absen['catatan'] ?: 'Tidak ada catatan',
                'status' => $absen['status']
            ]
        ];
    }, $absensi)); ?>;

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: events,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        eventClick: function(info) {
            document.getElementById('modalDate').textContent = new Date(info.event.start).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            document.getElementById('modalClass').textContent = info.event.extendedProps.nama_kelas;
            document.getElementById('modalTeacher').textContent = info.event.extendedProps.nama_guru;
            document.getElementById('modalStatus').textContent = info.event.extendedProps.status;
            document.getElementById('modalNotes').textContent = info.event.extendedProps.catatan;
            document.getElementById('attendanceModal').classList.remove('hidden');
        },
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            meridiem: false
        }
    });

    calendar.render();

    // Modal functionality
    const modal = document.getElementById('attendanceModal');
    const closeModalBtn = document.getElementById('closeModal');

    const closeModal = () => {
        modal.classList.add('hidden');
    };

    closeModalBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });
});
</script>

<style>
/* Tab styles */
.attendance-legend {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: center;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.legend-color {
    width: 1rem;
    height: 1rem;
    border-radius: 50%;
    border: 2px solid #e5e7eb;
}

/* Animation styles */
.fade-in {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.fade-in.visible {
    opacity: 1;
    transform: translateY(0);
}
</style>