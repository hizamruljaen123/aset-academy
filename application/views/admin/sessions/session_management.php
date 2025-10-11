<!-- Session Management Dashboard -->
<div class="space-y-6">
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

    <!-- Tab Navigation -->
    <div class="bg-white rounded-xl shadow-lg mt-6">
        <div class="p-4 border-b border-gray-200">
            <div class="flex space-x-2 overflow-x-auto">
                <button id="tab-sessions" onclick="switchTab('sessions')" class="tab-button active px-4 py-2 rounded-lg text-sm font-medium">
                    <i class="fas fa-list-alt mr-1"></i> All Sessions
                </button>
                <button id="tab-regions" onclick="switchTab('regions')" class="tab-button px-4 py-2 rounded-lg text-sm font-medium">
                    <i class="fas fa-globe-americas mr-1"></i> Regions
                </button>
                <button id="tab-isp-stats" onclick="switchTab('isp-stats')" class="tab-button px-4 py-2 rounded-lg text-sm font-medium">
                    <i class="fas fa-server mr-1"></i> ISP Statistics
                </button>
                <button id="tab-country-stats" onclick="switchTab('country-stats')" class="tab-button px-4 py-2 rounded-lg text-sm font-medium">
                    <i class="fas fa-flag mr-1"></i> Country Statistics
                </button>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="p-6">
            <!-- All Sessions Content -->
            <div id="content-sessions" class="tab-content space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-800">All Active Sessions</h3>
                    <div class="flex items-center space-x-3">
                        <input type="text" id="searchSessions" placeholder="Search sessions..." class="px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <button onclick="cleanupExpiredSessions()" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-broom mr-1"></i> Cleanup Expired
                        </button>
                        <button onclick="deleteAllSessions()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-trash-alt mr-1"></i> Delete All
                        </button>
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

                <div class="overflow-x-auto rounded-xl shadow border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
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
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($session->user_id): ?>
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full" src="<?= get_profile_picture($session->user_id) ?>" alt="">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900"><?= html_escape($session->nama_lengkap) ?></div>
                                                        <div class="text-sm text-gray-500"><?= html_escape($session->email) ?></div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="text-sm text-gray-600 flex items-center">
                                                    <i class="fas fa-user-secret mr-2 text-lg"></i> Guest
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"><?= html_escape($session->ip_address) ?></div>
                                            <div class="text-sm text-gray-500">
                                                <?php if (isset($location_cache[$session->ip_address]['data'])): ?>
                                                    <?= html_escape($location_cache[$session->ip_address]['data']['city']) ?>, <?= html_escape($location_cache[$session->ip_address]['data']['countryCode']) ?>
                                                <?php else: ?>
                                                    Unknown Location
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <i class="fas fa-<?= ($session->platform === 'Mobile') ? 'mobile-alt' : 'desktop' ?> mr-1"></i>
                                            <?= html_escape($session->platform) ?> / <?= html_escape($session->os) ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= html_escape($session->browser) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" title="<?= html_escape($session->last_activity_formatted) ?>">
                                            <?= html_escape(timespan($session->last_activity, time())) ?> ago
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?= html_escape($session->session_duration_minutes) ?> minutes
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php
                                                $status_color = 'gray';
                                                if ($session->session_status === 'Active') $status_color = 'green';
                                                else if ($session->session_status === 'Idle') $status_color = 'yellow';
                                                else if ($session->session_status === 'Inactive') $status_color = 'red';
                                            ?>
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-<?= $status_color ?>-100 text-<?= $status_color ?>-800">
                                                <?= html_escape($session->session_status) ?>
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

            <!-- Map Section (Full Width) -->
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

            <!-- Regions Tab Content -->
            <div id="content-regions" class="tab-content hidden space-y-6">
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

                <div id="regionsTable" class="overflow-x-auto rounded-xl shadow border border-gray-200">
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

            <!-- ISP Statistics Tab Content -->
            <div id="content-isp-stats" class="tab-content hidden space-y-6">
                <h3 class="text-xl font-semibold text-gray-800">Sessions by ISP</h3>
                <div class="bg-gray-50 p-4 rounded-lg shadow">
                    <canvas id="ispChart"></canvas>
                </div>
                <div class="overflow-x-auto rounded-xl shadow border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
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

            <!-- Country Statistics Tab Content -->
            <div id="content-country-stats" class="tab-content hidden space-y-6">
                <h3 class="text-xl font-semibold text-gray-800">Sessions by Country</h3>
                <div class="bg-gray-50 p-4 rounded-lg shadow">
                    <canvas id="countryChart"></canvas>
                </div>
                <div class="overflow-x-auto rounded-xl shadow border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
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

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

<style>
    .tab-button {
        color: #6b7280;
        background-color: transparent;
    }

    .tab-button:hover {
        background-color: #f3f4f6;
        color: #1f2937;
    }

    .tab-button.active {
        background-color: #3b82f6;
        color: white;
    }

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

<script>
    // Base URL from PHP
    const baseUrl = '<?= site_url() ?>';

    // Map variables
    let map;
    let markerClusterGroup;
    let isDarkMode = false;
    let currentTileLayer;

    // Initialize map
    function initMap() {
        // Create map centered on Indonesia
        map = L.map('map', {
            zoomControl: true,
            attributionControl: true
        }).setView([-2.5489, 118.0149], 5);

        // Light mode tile layer
        currentTileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 18
        }).addTo(map);

        // Initialize marker cluster group
        markerClusterGroup = L.markerClusterGroup({
            maxClusterRadius: 50,
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true
        });

        map.addLayer(markerClusterGroup);

        // Don't auto-load locations, wait for user action or delayed load
        // This ensures tables show first
    }

    // Toggle map style (dark/light)
    function toggleMapStyle() {
        isDarkMode = !isDarkMode;
        
        map.removeLayer(currentTileLayer);
        
        if (isDarkMode) {
            // Dark mode tiles
            currentTileLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                attribution: '© OpenStreetMap contributors © CARTO',
                maxZoom: 18
            }).addTo(map);
        } else {
            // Light mode tiles
            currentTileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 18
            }).addTo(map);
        }
    }

    // Location cache from server
    const locationCache = <?= json_encode($location_cache) ?>;

    // Load session locations with caching
    function loadSessionLocations() {
        // Show loading overlay
        showMapLoading();
        
        markerClusterGroup.clearLayers();
        
        const sessions = <?= json_encode($active_sessions) ?>;
        const processedIPs = new Set();
        let loadedLocations = 0;
        let processedCount = 0;
        
        // Filter unique IPs
        const uniqueSessions = sessions.filter(session => {
            if (session.ip_address && !processedIPs.has(session.ip_address)) {
                processedIPs.add(session.ip_address);
                return true;
            }
            return false;
        });
        
        const totalSessions = uniqueSessions.length;
        document.getElementById('totalSessions').textContent = totalSessions;
        
        if (totalSessions === 0) {
            hideMapLoading();
            document.getElementById('markerCount').textContent = 0;
            return;
        }
        
        // Process each unique session
        uniqueSessions.forEach((session, index) => {
            // Add small delay to avoid rate limiting
            setTimeout(() => {
                // Check cache first
                if (locationCache[session.ip_address] && locationCache[session.ip_address].data) {
                    processedCount++;
                    document.getElementById('loadingProgress').textContent = processedCount;
                    
                    const data = locationCache[session.ip_address].data;
                    addMarkerToMap(session, data);
                    loadedLocations++;
                    document.getElementById('markerCount').textContent = loadedLocations;
                    
                    if (processedCount === totalSessions) {
                        finishMapLoading(loadedLocations);
                    }
                    return;
                }
                
                // Fetch from API if not cached
                fetch(`${baseUrl}/admin/session_management/fetch_locations`, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `ip_address=${encodeURIComponent(session.ip_address)}`
                })
                .then(response => response.json())
                .then(result => {
                    processedCount++;
                    document.getElementById('loadingProgress').textContent = processedCount;
                    
                    if (result.success && result.data) {
                        // Cache it
                        locationCache[session.ip_address] = {
                            data: result.data,
                            timestamp: Math.floor(Date.now() / 1000)
                        };
                        
                        addMarkerToMap(session, result.data);
                        loadedLocations++;
                        document.getElementById('markerCount').textContent = loadedLocations;
                    }
                    
                    if (processedCount === totalSessions) {
                        finishMapLoading(loadedLocations);
                    }
                })
                .catch(error => {
                    console.error('Error fetching IP location:', error);
                    processedCount++;
                    document.getElementById('loadingProgress').textContent = processedCount;
                    
                    if (processedCount === totalSessions) {
                        finishMapLoading(loadedLocations);
                    }
                });
            }, index * 100); // 100ms delay between requests
        });
    }

    // Add marker to map
    function addMarkerToMap(session, data) {
        // Determine marker color based on session status
        const colorClass = session.session_status === 'Active' ? 'green' : 
                         session.session_status === 'Idle' ? 'orange' : 'red';
        
        // Create custom icon
        const icon = L.divIcon({
            className: 'custom-marker',
            html: `<div style="background-color: ${colorClass}; width: 12px; height: 12px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 6px rgba(0,0,0,0.4);"></div>`,
            iconSize: [12, 12],
            iconAnchor: [6, 6]
        });
        
        // Create marker
        const marker = L.marker([data.lat, data.lon], { icon: icon });
        
        // Create popup content
        const popupContent = `
            <div class="text-sm">
                <div class="font-bold text-lg mb-2 text-gray-800">
                    <i class="fas fa-map-marker-alt text-blue-500 mr-1"></i>
                    ${data.city || 'Unknown'}, ${data.country || 'Unknown'}
                </div>
                <hr class="my-2">
                <div class="space-y-1.5">
                    <div class="flex items-center">
                        <i class="fas fa-desktop text-gray-500 w-5 mr-2"></i>
                        <span class="font-mono text-xs">${session.ip_address}</span>
                    </div>
                    ${session.username ? `
                    <div class="flex items-center">
                        <i class="fas fa-user text-gray-500 w-5 mr-2"></i>
                        <span>${session.nama_lengkap}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-shield-alt text-gray-500 w-5 mr-2"></i>
                        <span class="text-xs">${session.role || 'N/A'}</span>
                    </div>
                    ` : ''}
                    <div class="flex items-center">
                        <i class="fas fa-signal text-gray-500 w-5 mr-2"></i>
                        <span class="px-2 py-0.5 text-xs rounded-full ${
                            session.session_status === 'Active' ? 'bg-green-100 text-green-800' : 
                            session.session_status === 'Idle' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'
                        }">${session.session_status}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock text-gray-500 w-5 mr-2"></i>
                        <span>${session.session_duration_minutes} minutes</span>
                    </div>
                    <div class="flex items-center text-xs text-gray-600">
                        <i class="fas fa-globe text-gray-500 w-5 mr-2"></i>
                        <span>${data.isp || 'Unknown ISP'}</span>
                    </div>
                    <div class="flex items-center text-xs text-gray-600">
                        <i class="fas fa-map-pin text-gray-500 w-5 mr-2"></i>
                        <span>${data.lat.toFixed(4)}, ${data.lon.toFixed(4)}</span>
                    </div>
                </div>
            </div>
        `;
        
        marker.bindPopup(popupContent, {
            maxWidth: 300,
            className: 'custom-popup'
        });
        
        markerClusterGroup.addLayer(marker);
    }

    // Finish map loading
    function finishMapLoading(loadedLocations) {
        hideMapLoading();
        if (loadedLocations > 0) {
            // Fit map to show all markers
            map.fitBounds(markerClusterGroup.getBounds(), { padding: [50, 50] });
        }
    }

    // Show map loading overlay
    function showMapLoading() {
        document.getElementById('mapLoadingOverlay').classList.remove('hidden');
        document.getElementById('refreshMapBtn').disabled = true;
        document.getElementById('refreshMapBtn').innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Loading...';
    }

    // Hide map loading overlay
    function hideMapLoading() {
        document.getElementById('mapLoadingOverlay').classList.add('hidden');
        document.getElementById('refreshMapBtn').disabled = false;
        document.getElementById('refreshMapBtn').innerHTML = '<i class="fas fa-sync-alt mr-1"></i> Refresh';
    }

    // Refresh map
    function refreshMap() {
        loadSessionLocations();
        showNotification('Map refreshed successfully', 'success');
    }

    // Global Chart instances
    let ispChartInstance = null;
    let countryChartInstance = null;

    // Generate random colors for charts
    function generateRandomColors(num) {
        const colors = [];
        for (let i = 0; i < num; i++) {
            const hue = (i * 137 + 57) % 360; // Use a prime number for better distribution
            colors.push(`hsl(${hue}, 70%, 50%)`);
        }
        return colors;
    }

    // Load ISP Statistics
    window.ispStatsLoaded = false;
    function loadISPStats() {
        const ispData = {};

        // Aggregate data from locationCache
        for (const ip in locationCache) {
            const data = locationCache[ip].data;
            if (data && data.isp) {
                if (!ispData[data.isp]) {
                    ispData[data.isp] = { totalSessions: 0, activeUsers: 0, guestSessions: 0 };
                }
                // For simplicity, just counting total sessions from cache for ISP stats
                ispData[data.isp].totalSessions++;
            }
        }

        const sortedISPs = Object.entries(ispData).sort(([, a], [, b]) => b.totalSessions - a.totalSessions);

        // Populate table
        const tbody = document.getElementById('ispStatsTableBody');
        tbody.innerHTML = '';
        if (sortedISPs.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-server text-4xl mb-3"></i>
                        <p class="text-lg font-medium">No ISP data available</p>
                    </td>
                </tr>
            `;
        } else {
            sortedISPs.forEach(([isp, stats]) => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50 transition-colors';
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${isp}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                            ${stats.totalSessions} session${stats.totalSessions > 1 ? 's' : ''}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                            <i class="fas fa-user mr-1"></i> ${stats.activeUsers}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                            <i class="fas fa-user-secret mr-1"></i> ${stats.guestSessions}
                        </span>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Render chart
        if (ispChartInstance) {
            ispChartInstance.destroy();
        }
        const ctx = document.getElementById('ispChart').getContext('2d');
        const labels = sortedISPs.map(([isp,]) => isp);
        const data = sortedISPs.map(([, stats]) => stats.totalSessions);
        const backgroundColors = generateRandomColors(labels.length);

        ispChartInstance = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: backgroundColors,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Total Sessions by ISP'
                    }
                }
            }
        });

        window.ispStatsLoaded = true;
    }

    // Load Country Statistics
    window.countryStatsLoaded = false;
    function loadCountryStats() {
        const countryData = {};

        // Aggregate data from locationCache
        for (const ip in locationCache) {
            const data = locationCache[ip].data;
            if (data && data.country) {
                if (!countryData[data.country]) {
                    countryData[data.country] = { totalSessions: 0, activeUsers: 0, guestSessions: 0, countryCode: data.countryCode };
                }
                countryData[data.country].totalSessions++;
            }
        }

        const sortedCountries = Object.entries(countryData).sort(([, a], [, b]) => b.totalSessions - a.totalSessions);

        // Populate table
        const tbody = document.getElementById('countryStatsTableBody');
        tbody.innerHTML = '';
        if (sortedCountries.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-flag text-4xl mb-3"></i>
                        <p class="text-lg font-medium">No Country data available</p>
                    </td>
                </tr>
            `;
        } else {
            sortedCountries.forEach(([country, stats]) => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50 transition-colors';
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="text-2xl mr-3">${getFlagEmoji(stats.countryCode)}</span>
                            <div class="text-sm font-medium text-gray-900">${country}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                            ${stats.totalSessions} session${stats.totalSessions > 1 ? 's' : ''}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                            <i class="fas fa-user mr-1"></i> ${stats.activeUsers}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                            <i class="fas fa-user-secret mr-1"></i> ${stats.guestSessions}
                        </span>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Render chart
        if (countryChartInstance) {
            countryChartInstance.destroy();
        }
        const ctx = document.getElementById('countryChart').getContext('2d');
        const labels = sortedCountries.map(([country,]) => country);
        const data = sortedCountries.map(([, stats]) => stats.totalSessions);
        const backgroundColors = generateRandomColors(labels.length);

        countryChartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Sessions',
                    data: data,
                    backgroundColor: backgroundColors,
                    borderColor: backgroundColors.map(color => color.replace('70%', '50%').replace('50%)', '40%)')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Total Sessions by Country'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Sessions'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Country'
                        }
                    }
                }
            }
        });

        window.countryStatsLoaded = true;
    }

    // Switch tab function
    function switchTab(tabName) {
        // Hide all content
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        
        // Remove active from all buttons
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('active');
        });
        
        // Show selected content
        document.getElementById(`content-${tabName}`).classList.remove('hidden');
        
        // Add active to selected button
        document.getElementById(`tab-${tabName}`).classList.add('active');
        
        // Load regions data if regions tab is opened and not loaded yet
        if (tabName === 'regions' && !window.regionsDataLoaded) {
            loadRegionsData();
        }

        // Load ISP data if ISP tab is opened and not loaded yet
        if (tabName === 'isp-stats' && !window.ispStatsLoaded) {
            loadISPStats();
        }

        // Load Country data if Country tab is opened and not loaded yet
        if (tabName === 'country-stats' && !window.countryStatsLoaded) {
            loadCountryStats();
        }
    }

    // Delete all sessions
    function deleteAllSessions() {
        if (!confirm('⚠️ WARNING: This will force logout ALL users including yourself!\n\nAre you absolutely sure?')) {
            return;
        }
        
        fetch(`${baseUrl}/admin/session_management/delete_all_sessions`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.href = data.redirect;
                    } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting sessions');
        });
    }

    // Delete user sessions
    function deleteUserSessions(userId) {
        if (!confirm('Force logout this user from all sessions?')) {
            return;
        }
        
        fetch(`${baseUrl}/admin/session_management/delete_sessions_by_user`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `user_id=${userId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                setTimeout(() => location.reload(), 1500);
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('An error occurred', 'error');
        });
    }

    // Delete IP sessions
    function deleteIPSessions(ipAddress) {
        if (!confirm(`Block and force logout all sessions from IP: ${ipAddress}?`)) {
            return;
        }
        
        fetch(`${baseUrl}/admin/session_management/delete_sessions_by_ip`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `ip_address=${encodeURIComponent(ipAddress)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                setTimeout(() => location.reload(), 1500);
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('An error occurred', 'error');
        });
    }

    // Delete single session
    function deleteSession(sessionId) {
        if (!confirm('Kill this session?')) {
            return;
        }
        
        fetch(`${baseUrl}/admin/session_management/delete_session`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `session_id=${encodeURIComponent(sessionId)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                setTimeout(() => location.reload(), 1500);
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('An error occurred', 'error');
        });
    }

    // Get IP info
    function getIPInfo(ipAddress) {
        document.getElementById('ipInfoModal').classList.remove('hidden');
        document.getElementById('ipInfoContent').innerHTML = '<div class="flex items-center justify-center py-12"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div></div>';
        
        fetch(`http://ip-api.com/json/${ipAddress}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('ipInfoContent').innerHTML = `
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">IP Address</label>
                                    <p class="text-lg font-mono">${data.query}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Country</label>
                                    <p class="text-lg">${data.country} (${data.countryCode})</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Region</label>
                                    <p class="text-lg">${data.regionName}</p>
                            </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">City</label>
                                    <p class="text-lg">${data.city}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">ZIP Code</label>
                                    <p class="text-lg">${data.zip || 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Timezone</label>
                                    <p class="text-lg">${data.timezone}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">ISP</label>
                                    <p class="text-lg">${data.isp}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Organization</label>
                                    <p class="text-lg">${data.org}</p>
                                </div>
                                <div class="col-span-2">
                                    <label class="text-sm font-medium text-gray-500">Coordinates</label>
                                    <p class="text-lg font-mono">${data.lat}, ${data.lon}</p>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    document.getElementById('ipInfoContent').innerHTML = '<div class="text-center text-red-600 py-8"><i class="fas fa-exclamation-circle text-4xl mb-3"></i><p>Failed to fetch IP information</p></div>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('ipInfoContent').innerHTML = '<div class="text-center text-red-600 py-8"><i class="fas fa-times-circle text-4xl mb-3"></i><p>Error fetching IP information</p></div>';
            });
    }

    function closeIPInfoModal() {
        document.getElementById('ipInfoModal').classList.add('hidden');
    }

    // View user sessions
    function viewUserSessions(userId) {
        window.location.href = `${baseUrl}/admin/session_management/user_sessions/${userId}`;
    }

    // Cleanup expired sessions
    function cleanupExpiredSessions() {
        const hours = prompt('Cleanup sessions older than how many hours?', '24');
        if (!hours) return;
        
        fetch(`${baseUrl}/admin/session_management/cleanup_expired`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `hours=${hours}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                setTimeout(() => location.reload(), 1500);
                } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('An error occurred', 'error');
        });
    }

    // Export session data
    function exportSessionData(format) {
        showNotification(`Exporting data as ${format.toUpperCase()}...`, 'info');
        // Implementation for export functionality
    }

    // Show notification
    function showNotification(message, type = 'info') {
        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            info: 'bg-blue-500'
        };
        
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 transform translate-x-0`;
        notification.innerHTML = `<i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : 'info'}-circle mr-2"></i>${message}`;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Load regions data
    let regionsData = {};
    window.regionsDataLoaded = false;

    function loadRegionsData() {
        // Show loading
        document.getElementById('regionsLoading').classList.remove('hidden');
        document.getElementById('regionsTable').classList.add('hidden');
        document.getElementById('loadRegionsBtn').disabled = true;
        document.getElementById('loadRegionsBtn').innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Loading...';
        
        const sessions = <?= json_encode($active_sessions) ?>;
        const processedIPs = new Set();
        const uniqueSessions = sessions.filter(session => {
            if (session.ip_address && !processedIPs.has(session.ip_address)) {
                processedIPs.add(session.ip_address);
                return true;
            }
            return false;
        });
        
        const totalSessions = uniqueSessions.length;
        document.getElementById('regionsTotal').textContent = totalSessions;
        
        let processedCount = 0;
        regionsData = {};
        
        if (totalSessions === 0) {
            showRegionsTable();
            return;
        }
        
        uniqueSessions.forEach((session, index) => {
            setTimeout(() => {
                // Check cache first
                if (locationCache[session.ip_address] && locationCache[session.ip_address].data) {
                    processedCount++;
                    document.getElementById('regionsProgress').textContent = processedCount;
                    
                    const data = locationCache[session.ip_address].data;
                    aggregateRegionData(data, session);
                    
                    if (processedCount === totalSessions) {
                        showRegionsTable();
                    }
                    return;
                }
                
                // Fetch if not cached
                fetch(`${baseUrl}/admin/session_management/fetch_locations`, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `ip_address=${encodeURIComponent(session.ip_address)}`
                })
                .then(response => response.json())
                .then(result => {
                    processedCount++;
                    document.getElementById('regionsProgress').textContent = processedCount;
                    
                    if (result.success && result.data) {
                        // Cache it
                        locationCache[session.ip_address] = {
                            data: result.data,
                            timestamp: Math.floor(Date.now() / 1000)
                        };
                        
                        aggregateRegionData(result.data, session);
                    }
                    
                    if (processedCount === totalSessions) {
                        showRegionsTable();
                    }
                })
                .catch(error => {
                    console.error('Error fetching IP location:', error);
                    processedCount++;
                    document.getElementById('regionsProgress').textContent = processedCount;
                    
                    if (processedCount === totalSessions) {
                        showRegionsTable();
                    }
                });
            }, index * 50); // Faster since we're using cache
        });
    }

    // Aggregate region data
    function aggregateRegionData(data, session) {
        const key = `${data.country}|${data.city}|${data.isp}`;
        
        if (!regionsData[key]) {
            regionsData[key] = {
                country: data.country,
                countryCode: data.countryCode,
                city: data.city,
                region: data.regionName,
                isp: data.isp,
                lat: data.lat,
                lon: data.lon,
                sessions: [],
                totalSessions: 0,
                activeUsers: 0,
                guestSessions: 0
            };
        }
        
        regionsData[key].sessions.push(session);
        regionsData[key].totalSessions++;
        
        if (session.username) {
            regionsData[key].activeUsers++;
                    } else {
            regionsData[key].guestSessions++;
        }
    }

    function showRegionsTable() {
        document.getElementById('regionsLoading').classList.add('hidden');
        document.getElementById('regionsTable').classList.remove('hidden');
        document.getElementById('loadRegionsBtn').disabled = false;
        document.getElementById('loadRegionsBtn').innerHTML = '<i class="fas fa-sync-alt mr-1"></i> Reload Regions Data';
        window.regionsDataLoaded = true;
        
        const tbody = document.getElementById('regionsTableBody');
        tbody.innerHTML = '';
        
        // Sort by total sessions
        const sortedRegions = Object.values(regionsData).sort((a, b) => b.totalSessions - a.totalSessions);
        
        if (sortedRegions.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-globe text-4xl mb-3"></i>
                        <p class="text-lg font-medium">No geographic data available</p>
                    </td>
                </tr>
            `;
            return;
        }
        
        sortedRegions.forEach(region => {
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50 transition-colors';
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <span class="text-2xl mr-3">${getFlagEmoji(region.countryCode)}</span>
                        <div>
                            <div class="text-sm font-medium text-gray-900">${region.country}</div>
                            <div class="text-sm text-gray-500">${region.countryCode}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-gray-900">${region.city}</div>
                    <div class="text-sm text-gray-500">${region.region}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                        ${region.totalSessions} session${region.totalSessions > 1 ? 's' : ''}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                        <i class="fas fa-user mr-1"></i> ${region.activeUsers}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                        <i class="fas fa-user-secret mr-1"></i> ${region.guestSessions}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-700">${region.isp}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button onclick="viewRegionOnMap(${region.lat}, ${region.lon})" class="text-blue-600 hover:text-blue-900" title="View on Map">
                        <i class="fas fa-map-marker-alt"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    // Get flag emoji from country code
    function getFlagEmoji(countryCode) {
        if (!countryCode) return '🏳️';
        const codePoints = countryCode
            .toUpperCase()
            .split('')
            .map(char => 127397 + char.charCodeAt());
        return String.fromCodePoint(...codePoints);
    }

    // View region on map
    function viewRegionOnMap(lat, lon) {
        map.setView([lat, lon], 10);
        // Scroll to map
        document.querySelector('#map').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Search functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize map first (without loading locations)
        initMap();
        
        // Load map locations after 1 second delay to ensure tables render first
        setTimeout(function() {
            loadSessionLocations();
        }, 1000);

        // Initialize the first tab (e.g., 'sessions')
        switchTab('sessions');
        
        // Search sessions
        document.getElementById('searchSessions')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#sessionsTableBody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
        
        // Search regions
        document.getElementById('searchRegions')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#regionsTableBody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
    });
});
