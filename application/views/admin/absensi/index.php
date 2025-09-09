<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <h1 class="text-3xl font-bold">Data Absensi</h1>
        <p class="text-sm opacity-90 mt-1">Kelola dan pantau absensi siswa dan guru</p>
    </div>

    <!-- Tab Navigation -->
    <div>
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <a href="#" id="tab-siswa" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-red-500 text-red-600">
                    Absensi Siswa
                </a>
                <a href="#" id="tab-guru" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Absensi Guru
                </a>
            </nav>
        </div>
    </div>

    <!-- Tab Content -->
    <div id="tab-content-siswa" class="mt-8">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Semua Data Absensi Siswa</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white" id="absensiTableSiswa">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pertemuan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guru</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($absensi_siswa as $absen): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('d M Y', strtotime($absen['tanggal_pertemuan'])); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $absen['nama_siswa']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $absen['judul_pertemuan']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $absen['nama_guru']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $absen['status']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $absen['catatan']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="tab-content-guru" class="mt-8 hidden">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Semua Data Absensi Guru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white" id="absensiTableGuru">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guru</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pertemuan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($absensi_guru as $absen): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $absen['tanggal_pertemuan'] ? date('d M Y', strtotime($absen['tanggal_pertemuan'])) : 'N/A'; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $absen['nama_guru']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $absen['judul_pertemuan'] ?: 'N/A'; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $absen['status']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $absen['catatan']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabSiswa = document.getElementById('tab-siswa');
    const tabGuru = document.getElementById('tab-guru');
    const contentSiswa = document.getElementById('tab-content-siswa');
    const contentGuru = document.getElementById('tab-content-guru');

    const activeClasses = ['border-red-500', 'text-red-600'];
    const inactiveClasses = ['border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300'];

    tabSiswa.addEventListener('click', function(e) {
        e.preventDefault();
        contentSiswa.classList.remove('hidden');
        contentGuru.classList.add('hidden');
        tabSiswa.classList.add(...activeClasses);
        tabSiswa.classList.remove(...inactiveClasses);
        tabGuru.classList.add(...inactiveClasses);
        tabGuru.classList.remove(...activeClasses);
    });

    tabGuru.addEventListener('click', function(e) {
        e.preventDefault();
        contentGuru.classList.remove('hidden');
        contentSiswa.classList.add('hidden');
        tabGuru.classList.add(...activeClasses);
        tabGuru.classList.remove(...inactiveClasses);
        tabSiswa.classList.add(...inactiveClasses);
        tabSiswa.classList.remove(...activeClasses);
    });
});
</script>
