<div class="min-h-screen bg-gray-50 py-6 overflow-y-auto" style="height: 100vh;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <!-- Header Section -->
        <div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Session Management</h1>
                    <p class="mt-2 text-sm text-gray-600">Pantau dan kelola session pengguna aktif di sistem</p>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Sistem Aktif
                    </span>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Sessions Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Sessions</dt>
                                <dd class="text-lg font-medium text-gray-900"><?php echo number_format($total_sessions); ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Unique IPs Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm3 2a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">IP Address Unik</dt>
                                <dd class="text-lg font-medium text-gray-900"><?php echo number_format($total_unique_ips); ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Users Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Pengguna Aktif</dt>
                                <dd class="text-lg font-medium text-gray-900"><?php echo number_format(count($unique_ips)); ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Last Activity Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Aktivitas Terakhir</dt>
                                <dd class="text-lg font-medium text-gray-900">
                                    <?php
                                    if (!empty($unique_ips)) {
                                        echo date('H:i', max(array_column($unique_ips, 'last_activity')));
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Manajemen Session</h3>
                <div class="flex flex-wrap gap-3">
                    <button type="button" id="deleteAllSessions"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Hapus Semua Session
                    </button>
                    <button type="button" id="cleanupExpired"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Bersihkan Session Expired
                    </button>
                    <button type="button" onclick="location.reload()"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                        </svg>
                        Refresh Data
                    </button>
                </div>
            </div>
        </div>

        <!-- IP Addresses Table -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Daftar IP Address Aktif</h3>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">Total: <?php echo count($unique_ips); ?> IP</span>
                    </div>
                </div>

                <div class="overflow-x-auto overflow-y-auto max-h-96">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    IP Address
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Session Count
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Last Activity
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (empty($unique_ips)): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-lg font-medium">Tidak ada session aktif</p>
                                        <p class="text-sm">Semua session telah berakhir atau belum ada aktivitas</p>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                            <?php foreach ($unique_ips as $ip): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-8 h-8">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm3 2a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900"><?php echo $ip->ip_address; ?></div>
                                            <div class="text-sm text-gray-500">IPv4 Address</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <?php echo $ip->session_count; ?> session<?php echo $ip->session_count > 1 ? 's' : ''; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        <?php echo date('d M Y, H:i', $ip->last_activity); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                    $time_diff = time() - $ip->last_activity;
                                    $is_online = $time_diff < 300; // 5 minutes
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $is_online ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; ?>">
                                        <span class="w-1.5 h-1.5 mr-1.5 rounded-full <?php echo $is_online ? 'bg-green-400' : 'bg-gray-400'; ?>"></span>
                                        <?php echo $is_online ? 'Online' : 'Offline'; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button type="button" class="track-ip inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                                                data-ip="<?php echo $ip->ip_address; ?>">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Lacak IP
                                        </button>
                                        <button type="button" class="delete-ip-sessions inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                                                data-ip="<?php echo $ip->ip_address; ?>">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            Hapus
                                        </button>
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
    </div>
</div>

<!-- IP Tracking Modal -->
<div class="fixed inset-0 overflow-y-auto z-50" id="ipModal" style="display: none;">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75" id="modalBackdrop"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-7xl sm:w-full max-h-[90vh] w-full">
            <div class="bg-white px-6 py-6 sm:p-8 max-h-[85vh] overflow-y-auto">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">
                                Informasi IP Address
                            </h3>
                            <button type="button" id="closeModal" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Location Information -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="text-md font-medium text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Detail Lokasi
                                </h4>
                                <div id="locationInfo" class="space-y-3 max-h-96 overflow-y-auto">
                                    <div class="animate-pulse">
                                        <div class="h-4 bg-gray-300 rounded w-3/4 mb-2"></div>
                                        <div class="h-4 bg-gray-300 rounded w-1/2 mb-2"></div>
                                        <div class="h-4 bg-gray-300 rounded w-2/3"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Map Container -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="text-md font-medium text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                                    </svg>
                                    Peta Lokasi
                                </h4>
                                <div id="ipMap" class="w-full h-80 bg-gray-200 rounded-md flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                        </svg>
                                        <p class="text-sm text-gray-500">Memuat peta...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="closeModalBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
/* Custom Scrollbar Styles */
.overflow-y-auto::-webkit-scrollbar,
.overflow-x-auto::-webkit-scrollbar,
.overflow-y-auto::-webkit-scrollbar,
.max-h-96::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track,
.overflow-x-auto::-webkit-scrollbar-track,
.overflow-y-auto::-webkit-scrollbar-track,
.max-h-96::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb,
.overflow-x-auto::-webkit-scrollbar-thumb,
.overflow-y-auto::-webkit-scrollbar-thumb,
.max-h-96::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
    transition: background 0.2s ease;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover,
.overflow-x-auto::-webkit-scrollbar-thumb:hover,
.overflow-y-auto::-webkit-scrollbar-thumb:hover,
.max-h-96::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Firefox scrollbar */
.overflow-y-auto,
.overflow-x-auto,
.max-h-96 {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 #f1f5f9;
}

/* Modal specific scrollbar */
#ipModal .overflow-y-auto::-webkit-scrollbar {
    width: 4px;
}

#ipModal .overflow-y-auto::-webkit-scrollbar-track {
    background: #f9fafb;
}

#ipModal .overflow-y-auto::-webkit-scrollbar-thumb {
    background: #d1d5db;
}

#ipModal .overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}
</style>

<script>
$(document).ready(function() {
    let ipMap;

    // Modal functions
    function showModal() {
        $('#ipModal').fadeIn(300);
        $('body').addClass('overflow-hidden');
    }

    function hideModal() {
        $('#ipModal').fadeOut(300);
        $('body').removeClass('overflow-hidden');
        if (ipMap) {
            ipMap.remove();
            ipMap = null;
        }
    }

    // Modal event listeners
    $('#modalBackdrop, #closeModal, #closeModalBtn').on('click', hideModal);

    // Delete all sessions
    $('#deleteAllSessions').on('click', function() {
        if (confirm('Apakah Anda yakin ingin menghapus semua session? Anda akan logout setelah ini.')) {
            // Show loading state
            $(this).prop('disabled', true).html('<svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menghapus...');

            $.ajax({
                url: '<?php echo base_url("admin/session_management/delete_all_sessions"); ?>',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    } else {
                        alert('Gagal menghapus session: ' + response.message);
                        $('#deleteAllSessions').prop('disabled', false).html('<svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg> Hapus Semua Session');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat menghapus session');
                    $('#deleteAllSessions').prop('disabled', false).html('<svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg> Hapus Semua Session');
                }
            });
        }
    });

    // Cleanup expired sessions
    $('#cleanupExpired').on('click', function() {
        const hours = prompt('Berapa jam session yang dianggap expired? (default: 24)', '24');
        if (hours !== null) {
            $(this).prop('disabled', true).html('<svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Membersihkan...');

            $.ajax({
                url: '<?php echo base_url("admin/session_management/cleanup_expired"); ?>',
                type: 'POST',
                data: { hours: hours },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert('Gagal membersihkan session: ' + response.message);
                        $('#cleanupExpired').prop('disabled', false).html('<svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg> Bersihkan Session Expired');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat membersihkan session');
                    $('#cleanupExpired').prop('disabled', false).html('<svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg> Bersihkan Session Expired');
                }
            });
        }
    });

    // Track IP
    $('.track-ip').on('click', function() {
        const ipAddress = $(this).data('ip');
        showModal();

        // Reset map if exists
        if (ipMap) {
            ipMap.remove();
            ipMap = null;
        }

        $('#locationInfo').html(`
            <div class="animate-pulse space-y-3">
                <div class="h-4 bg-gray-300 rounded w-3/4"></div>
                <div class="h-4 bg-gray-300 rounded w-1/2"></div>
                <div class="h-4 bg-gray-300 rounded w-2/3"></div>
                <div class="h-4 bg-gray-300 rounded w-1/2"></div>
                <div class="h-4 bg-gray-300 rounded w-3/4"></div>
            </div>
        `);

        $('#ipMap').html(`
            <div class="w-full h-full bg-gray-200 rounded-md flex items-center justify-center">
                <div class="text-center">
                    <svg class="animate-spin w-8 h-8 text-blue-500 mx-auto mb-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="text-sm text-gray-500">Mengambil data lokasi...</p>
                </div>
            </div>
        `);

        $.ajax({
            url: '<?php echo base_url("admin/session_management/get_ip_info"); ?>',
            type: 'POST',
            data: { ip_address: ipAddress },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const data = response.data;

                    // Update location info with beautiful styling
                    let locationHtml = `
                        <div class="grid grid-cols-1 gap-3">
                            <div class="flex items-center p-3 bg-white rounded-md border border-gray-200">
                                <div class="flex-shrink-0 w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">Negara</p>
                                    <p class="text-sm font-medium text-gray-900">${data.country} <span class="text-gray-500">(${data.countryCode})</span></p>
                                </div>
                            </div>

                            <div class="flex items-center p-3 bg-white rounded-md border border-gray-200">
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.84L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.84l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">Kota & Region</p>
                                    <p class="text-sm font-medium text-gray-900">${data.city}, ${data.regionName}</p>
                                </div>
                            </div>

                            <div class="flex items-center p-3 bg-white rounded-md border border-gray-200">
                                <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">Timezone</p>
                                    <p class="text-sm font-medium text-gray-900">${data.timezone}</p>
                                </div>
                            </div>

                            <div class="flex items-center p-3 bg-white rounded-md border border-gray-200">
                                <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">ISP & Organisasi</p>
                                    <p class="text-sm font-medium text-gray-900">${data.isp}</p>
                                    ${data.org && data.org !== data.isp ? `<p class="text-xs text-gray-600">${data.org}</p>` : ''}
                                </div>
                            </div>

                            <div class="flex items-center p-3 bg-white rounded-md border border-gray-200">
                                <div class="flex-shrink-0 w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">Koordinat</p>
                                    <p class="text-sm font-medium text-gray-900">${data.lat}, ${data.lon}</p>
                                    <p class="text-xs text-gray-600">Latitude, Longitude</p>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#locationInfo').html(locationHtml);

                    // Initialize map
                    $('#ipMap').html('').css('height', '320px');
                    ipMap = L.map('ipMap').setView([data.lat, data.lon], 10);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(ipMap);

                    // Add marker with custom icon
                    const customIcon = L.divIcon({
                        html: `<div class="bg-red-500 w-6 h-6 rounded-full border-2 border-white shadow-lg flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                               </div>`,
                        className: 'custom-marker',
                        iconSize: [24, 24],
                        iconAnchor: [12, 12]
                    });

                    L.marker([data.lat, data.lon], { icon: customIcon }).addTo(ipMap)
                        .bindPopup(`
                            <div class="text-center">
                                <h3 class="font-semibold text-gray-900">${data.city}, ${data.country}</h3>
                                <p class="text-sm text-gray-600">IP: ${ipAddress}</p>
                                <p class="text-xs text-gray-500 mt-1">Lat: ${data.lat}, Lon: ${data.lon}</p>
                            </div>
                        `, {
                            className: 'custom-popup'
                        })
                        .openPopup();

                } else {
                    $('#locationInfo').html(`
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-red-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Data Tidak Ditemukan</h3>
                            <p class="text-sm text-gray-600">${response.message}</p>
                        </div>
                    `);
                    $('#ipMap').html(`
                        <div class="w-full h-full bg-gray-200 rounded-md flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                                <p class="text-sm text-gray-500">Peta tidak tersedia</p>
                            </div>
                        </div>
                    `);
                }
            },
            error: function() {
                $('#locationInfo').html(`
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-red-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Terjadi Kesalahan</h3>
                        <p class="text-sm text-gray-600">Tidak dapat mengambil data IP. Silakan coba lagi.</p>
                    </div>
                `);
                $('#ipMap').html(`
                    <div class="w-full h-full bg-gray-200 rounded-md flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                        <p class="text-sm text-gray-500">Peta tidak tersedia</p>
                    </div>
                `);
            }
        });
    });

    // Delete sessions by IP
    $('.delete-ip-sessions').on('click', function() {
        const ipAddress = $(this).data('ip');
        if (confirm(`Apakah Anda yakin ingin menghapus semua session untuk IP ${ipAddress}?`)) {
            const button = $(this);
            const originalHtml = button.html();
            button.prop('disabled', true).html('<svg class="animate-spin w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menghapus...');

            $.ajax({
                url: '<?php echo base_url("admin/session_management/delete_sessions_by_ip"); ?>',
                type: 'POST',
                data: { ip_address: ipAddress },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert('Gagal menghapus session: ' + response.message);
                        button.prop('disabled', false).html(originalHtml);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat menghapus session');
                    button.prop('disabled', false).html(originalHtml);
                }
            });
        }
    });
});
</script>
