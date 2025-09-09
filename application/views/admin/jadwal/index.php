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

    <!-- Schedule Table -->
    <div class="bg-white rounded-2xl shadow-md p-6">
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
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($jadwal as $j): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $j['nama_kelas']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $j['pertemuan_ke']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $j['judul_pertemuan']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('d M Y', strtotime($j['tanggal_pertemuan'])); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('H:i', strtotime($j['waktu_mulai'])); ?> - <?= date('H:i', strtotime($j['waktu_selesai'])); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $j['nama_guru']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
});
</script>
