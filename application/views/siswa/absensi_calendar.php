<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <h1 class="text-3xl font-bold">Kalender Absensi Saya</h1>
        <p class="text-sm opacity-90 mt-1">Lihat riwayat kehadiran Anda dalam format kalender.</p>
    </div>

    <!-- Calendar Container -->
    <div class="calendar-container">
        <!-- Legend -->
        <div class="attendance-legend">
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

    const modal = document.getElementById('attendanceModal');
    const closeModalBtn = document.getElementById('closeModal');

    // Function to close the modal
    const closeModal = () => {
        modal.classList.add('hidden');
    };

    // Event listeners to close the modal
    closeModalBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });
});
</script>