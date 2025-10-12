<?php $this->load->view('templates/header'); ?>

<div class="p-4 sm:p-6 lg:p-8 min-h-screen bg-gradient-to-br from-gray-50 via-blue-50/30 to-indigo-50/30">
    <!-- Breadcrumb -->
    <?php
    $is_admin = isset($user_role) && in_array($user_role, ['admin', 'super_admin']);
    $base_url = $is_admin ? 'admin' : 'teacher';
    $dashboard_text = $is_admin ? 'Dashboard Admin' : 'Dashboard Guru';
    ?>
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="<?php echo site_url($base_url); ?>" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                    <i class="fas fa-home mr-2"></i>
                    <?php echo $dashboard_text; ?>
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <a href="<?php echo site_url($base_url . '/workshop-guests'); ?>" class="text-sm font-medium text-gray-700 hover:text-indigo-600">
                        Workshop Guests
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="text-sm font-medium text-gray-500"><?php echo html_escape($workshop->title); ?></span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-3xl shadow-2xl overflow-hidden mb-8">
        <div class="p-8">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl sm:text-4xl font-bold text-white">
                                <?php echo html_escape($workshop->title); ?>
                            </h1>
                            <p class="text-indigo-100 mt-1">Kelola Peserta Workshop</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap gap-3">
                    <?php if ($is_admin): ?>
                    <button onclick="printGuestList()" class="inline-flex items-center px-5 py-2.5 bg-white/20 backdrop-blur-md hover:bg-white/30 border border-white/30 rounded-xl font-medium text-sm text-white shadow-lg transition-all duration-200 transform hover:scale-105">
                        <i class="fas fa-print mr-2"></i>
                        Print
                    </button>
                    <a href="<?php echo site_url('admin/workshop-guests/export/' . $workshop->id); ?>" class="inline-flex items-center px-5 py-2.5 bg-green-500/90 hover:bg-green-600 backdrop-blur-md border border-white/30 rounded-xl font-medium text-sm text-white shadow-lg transition-all duration-200 transform hover:scale-105">
                        <i class="fas fa-file-excel mr-2"></i>
                        Export CSV
                    </a>
                    <?php else: ?>
                    <!-- Teacher: Read-only access badge -->
                    <div class="inline-flex items-center px-5 py-2.5 bg-yellow-500/20 backdrop-blur-md border border-yellow-300/50 rounded-xl font-medium text-sm text-white shadow-lg">
                        <i class="fas fa-eye mr-2"></i>
                        Mode Lihat Saja
                    </div>
                    <?php endif; ?>
                    
                    <a href="<?php echo site_url($base_url . '/workshop-guests'); ?>" class="inline-flex items-center px-5 py-2.5 bg-white/90 hover:bg-white backdrop-blur-md rounded-xl font-medium text-sm text-indigo-600 shadow-lg transition-all duration-200 transform hover:scale-105">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Workshop Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <i class="fas fa-calendar-alt text-blue-600"></i>
                        </div>
                        <h3 class="font-semibold text-gray-700">Tanggal</h3>
                    </div>
                    <p class="text-2xl font-bold text-gray-900"><?php echo date('d', strtotime($workshop->start_datetime)); ?></p>
                    <p class="text-sm text-gray-500"><?php echo date('F Y', strtotime($workshop->start_datetime)); ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <i class="fas fa-clock text-green-600"></i>
                        </div>
                        <h3 class="font-semibold text-gray-700">Waktu</h3>
                    </div>
                    <p class="text-lg font-bold text-gray-900"><?php echo date('H:i', strtotime($workshop->start_datetime)); ?></p>
                    <p class="text-sm text-gray-500">s/d <?php echo date('H:i', strtotime($workshop->end_datetime)); ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <i class="fas fa-map-marker-alt text-purple-600"></i>
                        </div>
                        <h3 class="font-semibold text-gray-700">Lokasi</h3>
                    </div>
                    <p class="text-sm font-medium text-gray-900 line-clamp-2"><?php echo html_escape($workshop->location); ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="p-2 bg-yellow-100 rounded-lg">
                            <i class="fas fa-tag text-yellow-600"></i>
                        </div>
                        <h3 class="font-semibold text-gray-700">Harga</h3>
                    </div>
                    <p class="text-xl font-bold text-gray-900">
                        <?php echo $workshop->price > 0 ? 'Rp ' . number_format($workshop->price, 0, ',', '.') : 'Gratis'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div class="text-white">
                    <p class="text-blue-100 text-sm font-medium mb-1">Total Peserta</p>
                    <h3 class="text-4xl font-bold"><?php echo $statistics['total_guests']; ?></h3>
                    <p class="text-blue-100 text-xs mt-2">
                        <i class="fas fa-user-friends mr-1"></i>Terdaftar
                    </p>
                </div>
                <div class="text-blue-100 opacity-75">
                    <i class="fas fa-users text-5xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div class="text-white">
                    <p class="text-green-100 text-sm font-medium mb-1">Rata-rata Usia</p>
                    <h3 class="text-4xl font-bold">
                        <?php
                        $avg_age = 0;
                        $total_guests = count($guests);
                        if ($total_guests > 0) {
                            foreach ($guests as $guest) {
                                $avg_age += $guest->usia;
                            }
                            $avg_age = round($avg_age / $total_guests);
                        }
                        echo $avg_age;
                        ?>
                    </h3>
                    <p class="text-green-100 text-xs mt-2">
                        <i class="fas fa-birthday-cake mr-1"></i>Tahun
                    </p>
                </div>
                <div class="text-green-100 opacity-75">
                    <i class="fas fa-chart-line text-5xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div class="text-white">
                    <p class="text-purple-100 text-sm font-medium mb-1">Tipe Pekerjaan</p>
                    <h3 class="text-4xl font-bold"><?php echo count($statistics['guests_by_job']); ?></h3>
                    <p class="text-purple-100 text-xs mt-2">
                        <i class="fas fa-briefcase mr-1"></i>Kategori
                    </p>
                </div>
                <div class="text-purple-100 opacity-75">
                    <i class="fas fa-user-tie text-5xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl shadow-xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div class="text-white">
                    <p class="text-pink-100 text-sm font-medium mb-1">Pendaftar Hari Ini</p>
                    <h3 class="text-4xl font-bold">
                        <?php
                        $today_count = 0;
                        foreach ($guests as $guest) {
                            if (date('Y-m-d', strtotime($guest->registered_at)) == date('Y-m-d')) {
                                $today_count++;
                            }
                        }
                        echo $today_count;
                        ?>
                    </h3>
                    <p class="text-pink-100 text-xs mt-2">
                        <i class="fas fa-calendar-day mr-1"></i>Peserta
                    </p>
                </div>
                <div class="text-pink-100 opacity-75">
                    <i class="fas fa-user-plus text-5xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Job Distribution Chart -->
    <?php if (!empty($statistics['guests_by_job'])): ?>
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-chart-pie text-indigo-600 mr-2"></i>
            Distribusi Pekerjaan Peserta
        </h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7 gap-4">
            <?php foreach ($statistics['guests_by_job'] as $job): ?>
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4 text-center border border-gray-200 hover:shadow-md transition-shadow">
                    <div class="text-3xl font-bold text-indigo-600"><?php echo $job->count; ?></div>
                    <div class="text-xs text-gray-600 mt-1 font-medium"><?php echo $job->pekerjaan; ?></div>
                    <div class="mt-2 bg-indigo-100 rounded-full h-1.5">
                        <div class="bg-indigo-600 h-1.5 rounded-full" style="width: <?php echo ($job->count / $statistics['total_guests']) * 100; ?>%"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Guest List -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 border-b border-gray-200">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-list text-indigo-600 mr-3"></i>
                        Daftar Peserta
                        <span class="ml-3 px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-medium">
                            <?php echo count($guests); ?> Peserta
                        </span>
                    </h2>
                    <p class="text-gray-500 mt-1">Data lengkap peserta workshop</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                    <div class="relative flex-1 lg:flex-initial">
                        <input type="text" id="searchInput" placeholder="Cari peserta..." 
                               class="w-full sm:w-64 pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                    </div>
                    <select id="jobFilter" class="px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <option value="">Semua Pekerjaan</option>
                        <?php foreach ($statistics['guests_by_job'] as $job): ?>
                            <option value="<?php echo $job->pekerjaan; ?>"><?php echo $job->pekerjaan; ?> (<?php echo $job->count; ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200" id="guestsTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            No
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Nama Lengkap
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Asal Institusi
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Usia
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Pekerjaan
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Kontak
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Tanggal Daftar
                        </th>
                        <?php if ($is_admin): ?>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Aksi
                        </th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($guests)): ?>
                        <?php $no = 1; foreach ($guests as $guest): ?>
                            <tr class="hover:bg-indigo-50/50 transition-colors duration-150 guest-row">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?php echo $no++; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm">
                                                <?php echo strtoupper(substr($guest->nama_lengkap, 0, 2)); ?>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900 guest-name">
                                                <?php echo html_escape($guest->nama_lengkap); ?>
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                ID: #<?php echo str_pad($guest->id, 4, '0', STR_PAD_LEFT); ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 guest-institution">
                                        <?php echo html_escape($guest->asal_kampus_sekolah); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                        <i class="fas fa-birthday-cake mr-1"></i>
                                        <?php echo $guest->usia; ?> tahun
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap guest-job">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold 
                                        <?php 
                                        $job_colors = [
                                            'Pelajar' => 'bg-green-100 text-green-800',
                                            'Mahasiswa' => 'bg-blue-100 text-blue-800',
                                            'Karyawan' => 'bg-purple-100 text-purple-800',
                                            'Wirausaha' => 'bg-yellow-100 text-yellow-800',
                                            'PNS' => 'bg-red-100 text-red-800',
                                            'Guru/Dosen' => 'bg-indigo-100 text-indigo-800',
                                            'Lainnya' => 'bg-gray-100 text-gray-800'
                                        ];
                                        echo isset($job_colors[$guest->pekerjaan]) ? $job_colors[$guest->pekerjaan] : 'bg-gray-100 text-gray-800';
                                        ?>">
                                        <i class="fas fa-briefcase mr-1"></i>
                                        <?php echo $guest->pekerjaan; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                    $raw_phone_number = preg_replace('/[^0-9]/', '', $guest->no_wa_telegram);
                                    $formatted_phone_number = $raw_phone_number;
                                    if (substr($raw_phone_number, 0, 2) === '08') {
                                        $formatted_phone_number = '62' . substr($raw_phone_number, 1);
                                    }
                                    ?>
                                    <a href="https://wa.me/<?php echo $formatted_phone_number; ?>"
                                       target="_blank" 
                                       class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-medium text-sm bg-green-50 hover:bg-green-100 px-3 py-1.5 rounded-lg transition-all">
                                        <i class="fab fa-whatsapp text-lg"></i>
                                        <span><?php echo html_escape($guest->no_wa_telegram); ?></span>
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <i class="far fa-calendar text-gray-400 mr-1"></i>
                                        <?php echo date('d/m/Y', strtotime($guest->registered_at)); ?>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        <i class="far fa-clock text-gray-400 mr-1"></i>
                                        <?php echo date('H:i', strtotime($guest->registered_at)); ?>
                                    </div>
                                </td>
                                <?php if ($is_admin): ?>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <button onclick="deleteGuest(<?php echo $guest->id; ?>, '<?php echo html_escape($guest->nama_lengkap); ?>')"
                                            class="inline-flex items-center justify-center w-10 h-10 text-red-600 hover:text-white hover:bg-red-600 rounded-lg transition-all duration-200 transform hover:scale-110">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="<?php echo $is_admin ? '8' : '7'; ?>" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-users text-4xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Belum Ada Peserta</h3>
                                    <p class="text-gray-500">Peserta workshop akan muncul di sini setelah mendaftar</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Table Footer with Pagination Info -->
        <?php if (!empty($guests)): ?>
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Menampilkan <span class="font-semibold" id="showingCount"><?php echo count($guests); ?></span> dari 
                    <span class="font-semibold"><?php echo count($guests); ?></span> peserta
                </div>
                <div class="text-sm text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>
                    Data diperbarui secara real-time
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all scale-95 opacity-0" id="deleteModalContent">
        <div class="p-6">
            <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Hapus Peserta?</h3>
            <p class="text-gray-600 text-center mb-6">
                Apakah Anda yakin ingin menghapus <span class="font-semibold text-gray-900" id="guestNameToDelete"></span>? 
                Tindakan ini tidak dapat dibatalkan.
            </p>
            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-xl transition-colors">
                    Batal
                </button>
                <button onclick="confirmDelete()" class="flex-1 px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-xl transition-colors">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #guestsTable, #guestsTable * {
        visibility: visible;
    }
    #guestsTable {
        position: absolute;
        left: 0;
        top: 0;
    }
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
let guestIdToDelete = null;

function deleteGuest(guestId, guestName) {
    guestIdToDelete = guestId;
    document.getElementById('guestNameToDelete').textContent = guestName;
    
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('deleteModalContent');
    
    modal.classList.remove('hidden');
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('deleteModalContent');
    
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        guestIdToDelete = null;
    }, 200);
}

function confirmDelete() {
    if (!guestIdToDelete) return;
    
    <?php
    // Determine base URL based on user role
    $delete_url = site_url($base_url . '/workshop-guests/delete-guest/');
    ?>
    
    fetch('<?php echo $delete_url; ?>' + guestIdToDelete, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeDeleteModal();
            
            // Show success message
            const successDiv = document.createElement('div');
            successDiv.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg z-50 flex items-center gap-3';
            successDiv.innerHTML = '<i class="fas fa-check-circle"></i><span>Peserta berhasil dihapus!</span>';
            document.body.appendChild(successDiv);
            
            setTimeout(() => {
                successDiv.classList.add('opacity-0', 'transition-opacity');
                setTimeout(() => {
                    successDiv.remove();
                    location.reload();
                }, 300);
            }, 2000);
        } else {
            closeDeleteModal();
            
            // Show error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-xl shadow-lg z-50 flex items-center gap-3';
            errorDiv.innerHTML = '<i class="fas fa-exclamation-circle"></i><span>' + data.message + '</span>';
            document.body.appendChild(errorDiv);
            
            setTimeout(() => {
                errorDiv.classList.add('opacity-0', 'transition-opacity');
                setTimeout(() => {
                    errorDiv.remove();
                }, 300);
            }, 3000);
        }
    })
    .catch(error => {
        alert('Terjadi kesalahan saat menghapus peserta');
        console.error('Error:', error);
    });
}

function printGuestList() {
    window.print();
}

// Search and Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const jobFilter = document.getElementById('jobFilter');
    const tableRows = document.querySelectorAll('.guest-row');
    
    function filterTable() {
        const searchValue = searchInput.value.toLowerCase();
        const jobValue = jobFilter.value.toLowerCase();
        let visibleCount = 0;
        
        tableRows.forEach(row => {
            const name = row.querySelector('.guest-name').textContent.toLowerCase();
            const institution = row.querySelector('.guest-institution').textContent.toLowerCase();
            const job = row.querySelector('.guest-job').textContent.toLowerCase();
            
            const matchesSearch = name.includes(searchValue) || institution.includes(searchValue);
            const matchesJob = jobValue === '' || job.includes(jobValue);
            
            if (matchesSearch && matchesJob) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Update showing count
        const showingCount = document.getElementById('showingCount');
        if (showingCount) {
            showingCount.textContent = visibleCount;
        }
    }
    
    if (searchInput) {
        searchInput.addEventListener('keyup', filterTable);
    }
    
    if (jobFilter) {
        jobFilter.addEventListener('change', filterTable);
    }
    
    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
});
</script>

<?php $this->load->view('templates/footer'); ?>
