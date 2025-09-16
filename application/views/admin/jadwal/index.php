<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Kelola Jadwal Kelas</h1>
                <p class="text-sm opacity-90 mt-1">Atur dan pantau semua jadwal kelas yang tersedia</p>
            </div>
            <a href="<?= site_url('admin/jadwal/create'); ?>" class="inline-flex items-center px-4 py-2 bg-white text-indigo-600 font-bold rounded-lg shadow-md hover:bg-gray-100 transition-colors">
                <i class="fas fa-plus-circle mr-2"></i>
                Tambah Jadwal
            </a>
        </div>
    </div>

    <!-- Tabs -->
    <div class="mb-4 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="table-tab" data-tabs-target="#table-view" type="button" role="tab" aria-controls="table-view" aria-selected="true">Tabel</button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="calendar-tab" data-tabs-target="#calendar-view" type="button" role="tab" aria-controls="calendar-view" aria-selected="false">Kalender</button>
            </li>
        </ul>
    </div>

    <!-- Tab Content -->
    <div id="myTabContent">
        <!-- Table View -->
        <div class="hidden p-4 rounded-lg bg-white shadow-md" id="table-view" role="tabpanel" aria-labelledby="table-tab">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                <h2 class="text-2xl font-bold text-gray-800">Semua Jadwal</h2>
                <div class="relative w-full sm:w-64">
                    <input type="text" placeholder="Cari jadwal..." id="searchInput" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white" id="jadwalTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pertemuan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guru</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($jadwal as $j): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $j->nama_kelas; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $j->pertemuan_ke; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $j->judul_pertemuan; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('d M Y', strtotime($j->tanggal_pertemuan)); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('H:i', strtotime($j->waktu_mulai)); ?> - <?= date('H:i', strtotime($j->waktu_selesai)); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $j->nama_guru; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="<?= site_url('admin/jadwal/edit/' . $j->id); ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <a href="<?= site_url('admin/jadwal/delete/' . $j->id); ?>" class="text-red-600 hover:text-red-900 ml-4" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Calendar View -->
        <div class="hidden p-4 rounded-lg bg-white shadow-md" id="calendar-view" role="tabpanel" aria-labelledby="calendar-tab">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('jadwalTable');
    const rows = table.getElementsByTagName('tr');

    searchInput.addEventListener('keyup', function() {
        const filter = searchInput.value.toLowerCase();
        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;
            for (let j = 0; j < cells.length; j++) {
                if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
            if (found) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });

    // FullCalendar initialization
    const calendarEl = document.getElementById('calendar');
    const calendarView = document.getElementById('calendar-view');
    let calendar;

    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            // Check if the 'hidden' class is removed
            if (mutation.attributeName === 'class' && !calendarView.classList.contains('hidden')) {
                if (!calendar) {
                    // Initialize and render the calendar for the first time
                    calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        events: '<?= site_url('admin/jadwal/get_events') ?>'
                    });
                    calendar.render();
                } else {
                    // If already initialized, just update its size
                    calendar.updateSize();
                }
            }
        });
    });

    // Configure and start the observer
    observer.observe(calendarView, { attributes: true });
});
</script>
