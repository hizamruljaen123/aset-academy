<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Data Absensi Siswa</h1>
                <p class="text-sm opacity-90 mt-1">Kelola dan pantau absensi semua siswa</p>
            </div>
        </div>
    </div>

    <!-- Attendance Table -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <h2 class="text-2xl font-bold text-gray-800">Semua Data Absensi</h2>
            <div class="relative w-full sm:w-64">
                <input type="text" placeholder="Cari..." id="searchInput" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-red-500">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white" id="absensiTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guru</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($absensi as $absen): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo date('d M Y', strtotime($absen['tanggal_absensi'])); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $absen['nama_siswa']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $absen['nama_kelas']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $absen['nama_guru']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php 
                                        switch($absen['status']) {
                                            case 'Hadir': echo 'bg-green-100 text-green-800'; break;
                                            case 'Izin': echo 'bg-blue-100 text-blue-800'; break;
                                            case 'Sakit': echo 'bg-yellow-100 text-yellow-800'; break;
                                            case 'Alpa': echo 'bg-red-100 text-red-800'; break;
                                        }
                                    ?>">
                                    <?php echo $absen['status']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $absen['catatan']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#absensiTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
