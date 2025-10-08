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
                            <?php if (isset($j->class_type) && $j->class_type == 'workshop'): ?>
                                <!-- Workshop Row -->
                                <tr class="bg-green-50 hover:bg-green-100" data-event-id="workshop_<?= $j->id; ?>">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-users mr-1"></i>
                                            Workshop
                                        </span><br>
                                        <span class="text-sm text-gray-600 mt-1 block"><?= $j->nama_kelas; ?></span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <?= ucfirst($j->pertemuan_ke); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= $j->judul_pertemuan; ?>
                                        <?php if (!empty($j->location)): ?>
                                            <br><small class="text-gray-400" data-field="location"><i class="fas fa-map-marker-alt"></i> <?= $j->location; ?></small>
                                        <?php endif; ?>
                                        <?php if (!empty($j->online_meet)): ?>
                                            <br><small class="text-blue-600" data-field="online_meet"><i class="fas fa-video"></i> Online Meeting</small>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-field="date"><?= date('d M Y', strtotime($j->tanggal_pertemuan)); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-field="time"><?= date('H:i', strtotime($j->waktu_mulai)); ?> - <?= date('H:i', strtotime($j->waktu_selesai)); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800" data-field="event_type">
                                            <i class="fas fa-user-tie mr-1"></i>
                                            Event
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="<?= site_url('admin/workshops/detail/' . encrypt_url($j->id)); ?>" class="text-green-600 hover:text-green-900">
                                            <i class="fas fa-eye mr-1"></i>Lihat
                                        </a>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <!-- Class Schedule Row -->
                                <tr class="hover:bg-gray-50" data-event-id="<?= $j->id; ?>">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" data-field="class_type">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            <?php if($j->class_type == 'premium'): ?>bg-yellow-100 text-yellow-800<?php else: ?>bg-blue-100 text-blue-800<?php endif; ?>">
                                            <?php if($j->class_type == 'premium'): ?><i class="fas fa-star mr-1"></i><?php else: ?><i class="fas fa-gift mr-1"></i><?php endif; ?>
                                            <?= ucfirst($j->class_type); ?>
                                        <span class="text-sm text-gray-600 mt-1 block"><?= $j->nama_kelas; ?></span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Pertemuan <?= $j->pertemuan_ke; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $j->judul_pertemuan; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-field="date"><?= date('d M Y', strtotime($j->tanggal_pertemuan)); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-field="time"><?= date('H:i', strtotime($j->waktu_mulai)); ?> - <?= date('H:i', strtotime($j->waktu_selesai)); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $j->nama_guru; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="<?= site_url('admin/jadwal/edit/' . $j->id); ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <a href="<?= site_url('admin/jadwal/delete/' . $j->id); ?>" class="text-red-600 hover:text-red-900 ml-4" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Calendar View -->
        <div class="hidden p-4 rounded-lg bg-white shadow-md" id="calendar-view" role="tabpanel" aria-labelledby="calendar-tab">
            <div id="calendar"></div>
            <div id="calendarLegend" class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Legend Kelas</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3" id="calendarLegendItems"></div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/admin_jadwal_calendar.js'); ?>" defer></script>
