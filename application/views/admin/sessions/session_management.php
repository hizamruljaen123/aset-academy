<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

<!-- Plotly.js CDN -->
<script src="https://cdn.plot.ly/plotly-2.26.0.min.js"></script>

<!-- Session Management Dashboard -->
<div class="space-y-6">
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-map-marked-alt text-blue-400 text-xl mr-3"></i>
                        <h3 class="text-lg font-bold text-white">User Sessions Geographic Map</h3>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button onclick="toggleMapStyle()" class="px-3 py-1.5 bg-white/10 hover:bg-white/20 text-white text-sm rounded-lg transition-colors">
                            <i class="fas fa-palette mr-1"></i> Toggle Style
                        </button>
                        <button onclick="refreshMap()" id="refreshMapBtn" class="px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg transition-colors">
                            <i class="fas fa-sync-alt mr-1"></i> Refresh Map
                        </button>
                        <a href="<?= site_url('admin/session_management') ?>" class="px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-sm rounded-lg transition-colors">
                            <i class="fas fa-sync-alt mr-1"></i> Refresh All
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div id="map" class="w-full h-[600px] bg-gray-900"></div>
                    <!-- Loading Overlay for Map -->
                    <div id="mapLoadingOverlay" class="hidden absolute inset-0 bg-gray-900/80 backdrop-blur-sm flex items-center justify-center z-[1000]">
                        <div class="text-center">
                            <div class="inline-block animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-500 mb-4"></div>
                            <p class="text-white text-lg font-semibold">Loading Locations...</p>
                            <p class="text-white/70 text-sm mt-2">
                                <span id="loadingProgress">0</span> / <span id="totalSessions">0</span> sessions processed
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-3 border-t border-gray-200 flex items-center justify-between text-sm flex-wrap gap-4">
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">
                            <i class="fas fa-circle text-green-500 mr-1"></i> Active (< 5 min)
                        </span>
                        <span class="text-gray-600">
                            <i class="fas fa-circle text-yellow-500 mr-1"></i> Idle (5-30 min)
                        </span>
                        <span class="text-gray-600">
                            <i class="fas fa-circle text-red-500 mr-1"></i> Inactive (> 30 min)
                        </span>
                    </div>
                    <div class="flex items-center space-x-6">
                        <span class="text-gray-500 font-medium">
                            <i class="fas fa-map-pin mr-1"></i> <span id="markerCount">0</span> Locations
                        </span>
                        <div class="flex items-center space-x-3">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" id="filterActive" checked onchange="filterSessions()" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500 mr-1.5">
                                <span class="text-xs text-gray-600 font-medium">Active</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" id="filterIdle" checked onchange="filterSessions()" class="w-4 h-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500 mr-1.5">
                                <span class="text-xs text-gray-600 font-medium">Idle</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" id="filterInactive" checked onchange="filterSessions()" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500 mr-1.5">
                                <span class="text-xs text-gray-600 font-medium">Inactive</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Active Sessions -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1">Active Sessions</p>
                    <h3 class="text-3xl font-bold"><?= $total_sessions ?></h3>
                    <p class="text-blue-100 text-xs mt-2">
                        <i class="fas fa-globe mr-1"></i>
                        <?= $total_unique_ips ?> Unique IPs
                    </p>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <i class="fas fa-network-wired text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Logged In Users -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">Logged In Users</p>
                    <h3 class="text-3xl font-bold"><?= $logged_in_users ?></h3>
                    <p class="text-green-100 text-xs mt-2">
                        <i class="fas fa-user-check mr-1"></i>
                        Authenticated
                    </p>
                            </div>
                <div class="bg-white/20 rounded-full p-4">
                    <i class="fas fa-users text-3xl"></i>
                    </div>
                </div>
            </div>

        <!-- Guest Sessions -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium mb-1">Guest Sessions</p>
                    <h3 class="text-3xl font-bold"><?= $guest_sessions ?></h3>
                    <p class="text-purple-100 text-xs mt-2">
                        <i class="fas fa-user-secret mr-1"></i>
                        Anonymous
                    </p>
                            </div>
                <div class="bg-white/20 rounded-full p-4">
                    <i class="fas fa-user-shield text-3xl"></i>
                    </div>
                </div>
            </div>

        <!-- Today's Logins -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium mb-1">Today's Logins</p>
                    <h3 class="text-3xl font-bold"><?= $statistics->today_logins ?></h3>
                    <p class="text-orange-100 text-xs mt-2">
                        <i class="fas fa-clock mr-1"></i>
                        Avg: <?= $statistics->avg_session_duration ?> min
                    </p>
                            </div>
                <div class="bg-white/20 rounded-full p-4">
                    <i class="fas fa-sign-in-alt text-3xl"></i>
                        </div>
                    </div>
                </div>
            </div>
    
    
    <!-- ISP Statistics Section -->
    <div class="bg-white rounded-xl shadow-lg mt-6">
        <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-6">Sessions by ISP</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Chart -->
                <div id="ispChart" style="width:100%;"></div>
                <!-- Table -->
                <div class="overflow-x-auto overflow-y-auto rounded-xl shadow border border-gray-200" style="max-height: 450px;">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ISP</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Sessions</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Active Users</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guest Sessions</th>
                            </tr>
                        </thead>
                        <tbody id="ispStatsTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- ISP statistics will be loaded here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Country Statistics Section -->
    <div class="bg-white rounded-xl shadow-lg mt-6">
        <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-6">Sessions by Country</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Chart -->
                <div id="countryChart" style="width:100%;"></div>
                <!-- Table -->
                <div class="overflow-x-auto overflow-y-auto rounded-xl shadow border border-gray-200" style="max-height: 450px;">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Country</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Sessions</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Active Users</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guest Sessions</th>
                            </tr>
                        </thead>
                        <tbody id="countryStatsTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Country statistics will be loaded here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- All Sessions Section -->
    <div class="bg-white rounded-xl shadow-lg mt-6">
        <div class="p-6">
            <div id="content-sessions" class="space-y-6">
                <div class="flex items-center justify-between">
                    
                    <h3 class="text-xl font-semibold text-gray-800">All Active Sessions</h3>
                    
                    <div class="flex items-center space-x-3">
                        
                        <span onclick="cleanupExpiredSessions()" class="text-yellow-500">
                            <i class="fas fa-broom mr-1"></i> Cleanup Expired
                        </span>
                        <span onclick="deleteAllSessions()" class="text-red-600">
                            <i class="fas fa-trash-alt mr-1"></i> Delete All
                        </span>
                        <div class="relative">
                            <button id="exportDropdownButton" data-dropdown-toggle="exportDropdown" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg text-sm font-medium transition-colors inline-flex items-center" type="button">
                                <i class="fas fa-download mr-1"></i> Export <i class="fas fa-chevron-down ml-2"></i>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="exportDropdown" class="hidden absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-20">
                                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="exportDropdownButton">
                                    <a href="#" onclick="exportSessionData('csv')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">CSV</a>
                                    <a href="#" onclick="exportSessionData('json')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">JSON</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <input type="text" id="searchSessions" placeholder="Search sessions..." class="px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                <div class="overflow-x-auto overflow-y-auto rounded-xl shadow border border-gray-200" style="max-height: 450px;">
                
                <br>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Device / OS</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Browser</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Activity</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody id="sessionsTableBody" class="bg-white divide-y divide-gray-200">
                            <?php if (empty($active_sessions)): ?>
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                        <i class="fas fa-ghost text-4xl mb-3"></i>
                                        <p class="text-lg font-medium">No active sessions found.</p>
                                        <p class="text-sm">Time for a coffee break!</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($active_sessions as $session): ?>
                                    <tr class="hover:bg-gray-50 transition-colors" data-session-id="<?= html_escape($session->session_id) ?>">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($session->user_id): ?>
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-user text-blue-600 text-lg"></i>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900"><?= html_escape($session->nama_lengkap ?? 'Unknown') ?></div>
                                                        <div class="text-sm text-gray-500"><?= html_escape($session->email ?? '-') ?></div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-user-secret text-gray-600 text-lg"></i>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm text-gray-600">Guest</div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"><?= html_escape($session->ip_address) ?></div>
                                            <div class="text-sm text-gray-500 flex items-center">
                                                <?php if (isset($location_cache[$session->ip_address]['data'])): ?>
                                                    <?= html_escape($location_cache[$session->ip_address]['data']['city']) ?>, <?= html_escape($location_cache[$session->ip_address]['data']['countryCode']) ?>
                                                <?php else: ?>
                                                    <span class="flex items-center" id="location-<?= md5($session->ip_address) ?>">
                                                        <i class="fas fa-sync fa-spin mr-1 text-blue-500"></i> Getting location...
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <i class="fas fa-<?= (isset($session->platform) && $session->platform === 'Mobile') ? 'mobile-alt' : 'desktop' ?> mr-1"></i>
                                            <?= html_escape($session->platform ?? 'Desktop') ?> / <?= html_escape($session->os ?? 'Unknown') ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= html_escape($session->browser ?? 'Unknown') ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" title="<?= html_escape($session->last_activity_formatted ?? '') ?>">
                                            <?= isset($session->last_activity) ? timespan($session->last_activity, time()) : 'N/A' ?> ago
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?= html_escape($session->session_duration_minutes ?? 0) ?> minutes
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php
                                                $status_color = 'gray';
                                                $status = $session->session_status ?? 'Unknown';
                                                if ($status === 'Active') $status_color = 'green';
                                                else if ($status === 'Idle') $status_color = 'yellow';
                                                else if ($status === 'Inactive') $status_color = 'red';
                                            ?>
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-<?= $status_color ?>-100 text-<?= $status_color ?>-800">
                                                <?= html_escape($status) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-2">
                                                <?php if ($session->user_id): ?>
                                                    <button onclick="viewUserSessions('<?= $session->user_id ?>')" class="text-indigo-600 hover:text-indigo-900" title="View User Sessions">
                                                        <i class="fas fa-users"></i>
                                                    </button>
                                                    <button onclick="deleteUserSessions('<?= $session->user_id ?>')" class="text-red-600 hover:text-red-900" title="Force Logout User">
                                                        <i class="fas fa-user-slash"></i>
                                                    </button>
                                                <?php endif; ?>
                                                <button onclick="getIPInfo('<?= html_escape($session->ip_address) ?>')" class="text-blue-600 hover:text-blue-900" title="IP Info">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                                <button onclick="deleteIPSessions('<?= html_escape($session->ip_address) ?>')" class="text-orange-600 hover:text-orange-900" title="Block IP & Logout Sessions">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                                <button onclick="deleteSession('<?= html_escape($session->session_id) ?>')" class="text-red-600 hover:text-red-900" title="Kill Session">
                                                    <i class="fas fa-times-circle"></i>
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
    <!-- Regions Section -->
   
   
    <div class="bg-white rounded-xl shadow-lg mt-6">
        <div class="p-6">
            <div id="content-regions" class="space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-800">Sessions by Region</h3>
                    <div class="flex items-center space-x-3">
                        <input type="text" id="searchRegions" placeholder="Search regions..." class="px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <button onclick="loadRegionsData()" id="loadRegionsBtn" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-sync-alt mr-1"></i> Load Regions Data
                        </button>
                    </div>
                </div>

                <!-- Loading Overlay for Regions Table -->
                <div id="regionsLoading" class="flex items-center justify-center py-12 hidden">
                    <div class="text-center">
                        <div class="inline-block animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-500 mb-4"></div>
                        <p class="text-gray-700 text-lg font-semibold">Analyzing Regions...</p>
                        <p class="text-gray-500 text-sm mt-2">
                            <span id="regionsProgress">0</span> / <span id="regionsTotal">0</span> unique IPs processed
                        </p>
                    </div>
                </div>

                <div id="regionsTable" class="overflow-x-auto overflow-y-auto rounded-xl shadow border border-gray-200" style="max-height: 450px;">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Country</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City / Region</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Sessions</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Active Users</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guest Sessions</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ISP</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody id="regionsTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Region data will be loaded here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    

    

    <!-- IP Info Modal -->
    <div id="ipInfoModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex items-center justify-between rounded-t-xl">
                <h3 class="text-lg font-bold text-white flex items-center">
                    <i class="fas fa-info-circle mr-2"></i> IP Address Information
                </h3>
                <button onclick="closeIPInfoModal()" class="text-white hover:text-gray-200 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="ipInfoContent" class="p-6">
                <div class="flex items-center justify-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                </div>
            </div>
        </div>
    </div>


<?php include 'session.php'; ?>
<style>
    .leaflet-popup-content-wrapper {
        border-radius: 12px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .leaflet-popup-content {
        margin: 16px;
        font-family: inherit;
    }

    /* Dark mode map tiles */
    .dark-map-tiles {
        filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%);
    }

    /* Sticky table header with smooth scrolling */
    .overflow-y-auto {
        scrollbar-width: thin;
        scrollbar-color: rgba(59, 130, 246, 0.5) rgba(229, 231, 235, 0.5);
        scroll-behavior: smooth;
    }

    .overflow-y-auto::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .overflow-y-auto::-webkit-scrollbar-track {
        background: rgba(229, 231, 235, 0.5);
        border-radius: 4px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: rgba(59, 130, 246, 0.5);
        border-radius: 4px;
        transition: background 0.3s ease;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: rgba(59, 130, 246, 0.8);
    }

    /* Sticky header for tables */
    .overflow-y-auto table thead {
        position: sticky;
        top: 0;
        z-index: 10;
        background: #f9fafb;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    /* Loading animation for markers */
    @keyframes pulse-ring {
        0% {
            transform: scale(0.8);
            opacity: 1;
        }
        100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    .marker-pulse::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: inherit;
        animation: pulse-ring 1.5s ease-out infinite;
}
</style>
