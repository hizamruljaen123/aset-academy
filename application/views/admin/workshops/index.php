<div class="max-w-screen-xl mx-auto p-4">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Workshop & Seminar</h1>
            <p class="text-gray-600">Atur semua workshop dan seminar untuk siswa dan pengunjung</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="<?= site_url('admin/workshops/create') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                <i class="fas fa-plus"></i>
                Buat Baru
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Total Workshop</p>
                    <p class="text-2xl font-bold"><?= count($workshops) ?></p>
                </div>
                <div class="bg-blue-400 bg-opacity-50 p-3 rounded-lg">
                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm">Workshop Aktif</p>
                    <p class="text-2xl font-bold"><?= count(array_filter($workshops, function($w) { return $w->status === 'published'; })) ?></p>
                </div>
                <div class="bg-green-400 bg-opacity-50 p-3 rounded-lg">
                    <i class="fas fa-calendar-check text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm">Total Peserta</p>
                    <p class="text-2xl font-bold">0</p>
                </div>
                <div class="bg-purple-400 bg-opacity-50 p-3 rounded-lg">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Workshops Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 border-b border-gray-200 bg-gray-50">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="relative flex-1">
                    <input type="text" id="search-workshop" placeholder="Cari workshop..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <div class="flex gap-2">
                    <select class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Workshop</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($workshops)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-chalkboard-teacher text-gray-400 text-xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada workshop</h3>
                                    <p class="text-gray-500 mb-4">Mulai buat workshop atau seminar pertama Anda</p>
                                    <a href="<?= site_url('admin/workshops/create') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-plus mr-2"></i>Buat Workshop Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($workshops as $workshop): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 mr-3">
                                            <?php if ($workshop->thumbnail): ?>
                                                <img class="h-10 w-10 rounded-full object-cover" src="<?= base_url($workshop->thumbnail) ?>" alt="<?= $workshop->title ?>">
                                            <?php else: ?>
                                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                    <i class="fas fa-chalkboard-teacher text-blue-600"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900"><?= $workshop->title ?></div>
                                            <div class="text-sm text-gray-500"><?= ucfirst($workshop->type) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"><?= date('d M Y', strtotime($workshop->start_datetime)) ?></div>
                                    <div class="text-sm text-gray-500"><?= date('H:i', strtotime($workshop->start_datetime)) ?> - <?= date('H:i', strtotime($workshop->end_datetime)) ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= $workshop->location ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?php if ($workshop->status == 'published'): ?>
                                            bg-green-100 text-green-800
                                        <?php elseif ($workshop->status == 'draft'): ?>
                                            bg-yellow-100 text-yellow-800
                                        <?php else: ?>
                                            bg-gray-100 text-gray-800
                                        <?php endif; ?>">
                                        <?= ucfirst($workshop->status) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="<?= site_url('admin/workshops/edit/'.$workshop->id) ?>" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= site_url('admin/workshops/participants/'.$workshop->id) ?>" class="text-blue-600 hover:text-blue-900" title="Peserta">
                                            <i class="fas fa-users"></i>
                                        </a>
                                        <a href="<?= site_url('admin/workshops/delete/'.$workshop->id) ?>" class="text-red-600 hover:text-red-900" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus workshop ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-workshop');
    const rows = document.querySelectorAll('tbody tr');
    
    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        
        rows.forEach(row => {
            const title = row.querySelector('td:first-child div div:first-child').textContent.toLowerCase();
            const type = row.querySelector('td:first-child div div:last-child').textContent.toLowerCase();
            const location = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || type.includes(searchTerm) || location.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>
