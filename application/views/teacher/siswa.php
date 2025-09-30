<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Siswa Saya</h1>
                <p class="text-sm opacity-90 mt-1"><?php echo count($siswa); ?> siswa di kelas Anda</p>
            </div>
            <div class="hidden sm:flex items-center space-x-6">
                <div class="text-center">
                    <div class="text-3xl font-bold"><?php echo count($siswa); ?></div>
                    <div class="text-xs opacity-80">Total Siswa</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold">0%</div>
                    <div class="text-xs opacity-80">Rata-rata Nilai</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Student List -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Siswa</h2>
            <div class="relative w-full sm:w-64">
                <input type="text" placeholder="Cari siswa..." id="searchInput" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-search text-gray-400"></i>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach($siswa as $s): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <?php if (isset($s->foto_profil) && !empty($s->foto_profil)): ?>
                                                <img class="h-10 w-10 rounded-full object-cover" src="<?php echo base_url('uploads/siswa/' . $s->foto_profil); ?>" alt="Foto profil <?php echo $s->nama_lengkap; ?>">
                                            <?php else: ?>
                                                <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                    <i class="fas fa-user text-gray-600 text-lg"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900"><?php echo $s->nama_lengkap; ?></div>
                                            <div class="text-sm text-gray-500"><?php echo isset($s->email) ? $s->email : '-'; ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo isset($s->kelas) ? $s->kelas : '-'; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo isset($s->jurusan) ? $s->jurusan : '-'; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo ((isset($s->status) && $s->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                        <?php echo isset($s->status) ? $s->status : 'Tidak Aktif'; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="<?php echo site_url('teacher/siswa_detail/' . $s->id); ?>" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Search functionality
    $('#searchInput').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('.siswa-table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
