<div class="max-w-screen-xl mx-auto p-4">
    <!-- Workshops Admin Styles -->
    <link href="<?= base_url('assets/css/workshops-admin.css') ?>" rel="stylesheet">


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

    <!-- View Toggle and Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center space-x-4">
                <!-- View Toggle -->
                <div class="flex bg-gray-100 rounded-lg p-1">
                    <button id="table-view-btn" class="px-3 py-2 rounded-md text-sm font-medium bg-white text-gray-900 shadow-sm">
                        <i class="fas fa-table mr-2"></i> Tabel
                    </button>
                    <button id="grid-view-btn" class="px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-gray-900">
                        <i class="fas fa-th mr-2"></i> Grid
                    </button>
                </div>

                <!-- Search -->
                <div class="relative flex-1 max-w-md">
                    <input type="text" id="search-workshop" placeholder="Cari workshop..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <div class="flex gap-2">
                <select id="status-filter" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="completed">Completed</option>
                </select>
                <select id="type-filter" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Tipe</option>
                    <option value="workshop">Workshop</option>
                    <option value="seminar">Seminar</option>
                </select>
            </div>
        </div>
    
        <!-- Workshops Grid View -->
        <div id="grid-view" class="hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php if (empty($workshops)): ?>
                    <div class="col-span-full">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
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
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($workshops as $workshop): ?>
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 workshop-card"
                             data-status="<?= $workshop->status ?>"
                             data-type="<?= $workshop->type ?>"
                             data-title="<?= strtolower($workshop->title) ?>"
                             data-location="<?= strtolower($workshop->location) ?>">
    
                            <!-- Poster Image -->
                            <div class="relative h-48 bg-gradient-to-br from-blue-100 to-indigo-200 overflow-hidden">
                                <?php if ($workshop->thumbnail): ?>
                                    <img src="<?= base_url($workshop->thumbnail) ?>" alt="<?= $workshop->title ?>"
                                         class="w-full h-full object-cover hover:scale-110 transition-transform duration-500"
                                         onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="w-full h-full flex items-center justify-center" style="display: none;">
                                        <div class="text-center">
                                            <i class="fas fa-chalkboard-teacher text-4xl text-blue-300 mb-2"></i>
                                        </div>
                                    </div>
                                    <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-20 transition-all duration-300"></div>
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div class="text-center">
                                            <i class="fas fa-chalkboard-teacher text-4xl text-blue-300 mb-2"></i>
                                            <p class="text-blue-400 text-sm font-medium">No Poster</p>
                                        </div>
                                    </div>
                                <?php endif; ?>
    
                                <!-- Status Badge -->
                                <div class="absolute top-3 right-3">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        <?php if ($workshop->status == 'published'): ?>
                                            bg-green-100 text-green-800
                                        <?php elseif ($workshop->status == 'draft'): ?>
                                            bg-yellow-100 text-yellow-800
                                        <?php else: ?>
                                            bg-gray-100 text-gray-800
                                        <?php endif; ?>">
                                        <?= ucfirst($workshop->status) ?>
                                    </span>
                                </div>
    
                                <!-- Quick Actions Overlay -->
                                <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center opacity-0 hover:opacity-100">
                                    <div class="flex space-x-2">
                                        <a href="<?= site_url('admin/workshops/detail/' . encrypt_url($workshop->id)) ?>"
                                           class="p-2 bg-white rounded-full text-gray-700 hover:text-purple-600 transition-colors"
                                           title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= site_url('admin/workshops/edit/'.$workshop->id) ?>"
                                           class="p-2 bg-white rounded-full text-gray-700 hover:text-blue-600 transition-colors"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= site_url('admin/workshops/participants/'.$workshop->id) ?>"
                                           class="p-2 bg-white rounded-full text-gray-700 hover:text-green-600 transition-colors"
                                           title="Peserta">
                                            <i class="fas fa-users"></i>
                                        </a>
                                        <a href="<?= site_url('admin/workshops/delete/'.$workshop->id) ?>"
                                           class="p-2 bg-white rounded-full text-gray-700 hover:text-red-600 transition-colors"
                                           title="Hapus"
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus workshop ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Content -->
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="text-lg font-bold text-gray-900 line-clamp-2 flex-1 mr-2">
                                        <?= $workshop->title ?>
                                    </h3>
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full flex-shrink-0">
                                        <?= ucfirst($workshop->type) ?>
                                    </span>
                                </div>
    
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                        <span><?= date('d M Y', strtotime($workshop->start_datetime)) ?></span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-clock mr-2 text-gray-400"></i>
                                        <span><?= date('H:i', strtotime($workshop->start_datetime)) ?> - <?= date('H:i', strtotime($workshop->end_datetime)) ?></span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                                        <span class="truncate"><?= $workshop->location ?></span>
                                    </div>
                                </div>
    
                                <div class="flex items-center justify-between">
                                    <div class="text-sm">
                                        <?php if ($workshop->price > 0): ?>
                                            <span class="font-bold text-green-600">Rp <?= number_format($workshop->price, 0, ',', '.') ?></span>
                                        <?php else: ?>
                                            <span class="text-green-600 font-medium">Gratis</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        Max: <?= $workshop->max_participants ?> peserta
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Workshops Table View -->
    <div id="table-view" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Workshop</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Online Meeting</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($workshops)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
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
                                                <img class="h-10 w-10 rounded-full object-cover" src="<?= base_url($workshop->thumbnail) ?>" alt="<?= $workshop->title ?>"
                                                     onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center" style="display: none;">
                                                    <i class="fas fa-chalkboard-teacher text-blue-600"></i>
                                                </div>
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
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <?php if ($workshop->online_meet): ?>
                                        <a href="<?= $workshop->online_meet ?>" target="_blank"
                                           class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                            <i class="fas fa-video mr-1"></i>
                                            Meeting
                                        </a>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2 py-1 border border-gray-300 text-xs font-medium rounded text-gray-700 bg-gray-50 cursor-not-allowed">
                                            <i class="fas fa-video-slash mr-1"></i>
                                            Tidak Ada
                                        </span>
                                    <?php endif; ?>
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
                                        <a href="<?= site_url('admin/workshops/detail/' . encrypt_url($workshop->id)) ?>" class="text-purple-600 hover:text-purple-900" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= admin_workshop_url($workshop->id) ?>" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= admin_workshop_participants_url($workshop->id) ?>" class="text-blue-600 hover:text-blue-900" title="Peserta">
                                            <i class="fas fa-users"></i>
                                        </a>
                                        <a href="<?= site_url('admin/workshops/delete/' . encrypt_url($workshop->id)) ?>" class="text-red-600 hover:text-red-900" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus workshop ini?')">
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

    

    <!-- Workshops Admin Scripts -->
    <script src="<?= base_url('assets/js/workshops-admin.js') ?>"></script>