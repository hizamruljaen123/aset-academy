<script>
// Base URL from PHP
const baseUrl = '<?= site_url() ?>';

// Map variables
let map;
let markerClusterGroup;
let isDarkMode = false;
let currentTileLayer;

// Location cache from JSON file (from server)
const locationCache = <?= json_encode($location_cache ?? []) ?>;

// Sessions data from server
const sessionsData = <?= json_encode($active_sessions ?? []) ?>;

// Queue for IP location requests to avoid overwhelming the API
let ipQueue = [];
let isProcessingQueue = false;
const maxConcurrentRequests = 3;
const requestDelay = 1500; // 1.5 seconds between requests

// Track processed IPs to avoid duplicate requests
let processedIPs = new Set();

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
}

// Toggle map style (dark/light)
function toggleMapStyle() {
    isDarkMode = !isDarkMode;
    
    map.removeLayer(currentTileLayer);
    
    if (isDarkMode) {
        currentTileLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '© OpenStreetMap contributors © CARTO',
            maxZoom: 18
        }).addTo(map);
    } else {
        currentTileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 18
        }).addTo(map);
    }
}

// Load session locations from JSON cache
function loadSessionLocations() {
    showMapLoading();
    markerClusterGroup.clearLayers();
    
    // Reset processed IPs set
    processedIPs.clear();
    
    let loadedLocations = 0;
    
    // Filter unique IPs
    const uniqueSessions = sessionsData.filter(session => {
        if (session.ip_address && !processedIPs.has(session.ip_address)) {
            processedIPs.add(session.ip_address);
            return true;
        }
        return false;
    });
    
    const totalSessions = uniqueSessions.length;
    document.getElementById('totalSessions').textContent = totalSessions;
    document.getElementById('loadingProgress').textContent = 0;
    
    if (totalSessions === 0) {
        hideMapLoading();
        document.getElementById('markerCount').textContent = 0;
        return;
    }
    
    // Process each session from locationCache
    uniqueSessions.forEach((session, index) => {
        if (locationCache[session.ip_address] && locationCache[session.ip_address].data) {
            const data = locationCache[session.ip_address].data;
            addMarkerToMap(session, data);
            loadedLocations++;
            document.getElementById('loadingProgress').textContent = index + 1;
            document.getElementById('markerCount').textContent = loadedLocations;
        } else if (session.ip_address) {
            // If location data is not in cache, fetch it
            fetchLocationForIP(session.ip_address, session);
        }
    });
    
    // Hide loading after a delay to allow processing
    setTimeout(() => {
        if (loadedLocations === totalSessions) {
            finishMapLoading(loadedLocations);
        }
    }, 2000);
}

// Add marker to map
function addMarkerToMap(session, data) {
    if (!data.lat || !data.lon) return;
    
    const colorClass = session.session_status === 'Active' ? 'green' : 
                     session.session_status === 'Idle' ? 'orange' : 'red';
    
    const icon = L.divIcon({
        className: 'custom-marker',
        html: `<div style="background-color: ${colorClass}; width: 12px; height: 12px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 6px rgba(0,0,0,0.4);"></div>`,
        iconSize: [12, 12],
        iconAnchor: [6, 6]
    });
    
    const marker = L.marker([data.lat, data.lon], { icon: icon });
    
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
                ${session.nama_lengkap ? `
                <div class="flex items-center">
                    <i class="fas fa-user text-gray-500 w-5 mr-2"></i>
                    <span>${session.nama_lengkap}</span>
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
            </div>
        </div>
    `;
    
    marker.bindPopup(popupContent, {
        maxWidth: 300,
        className: 'custom-popup'
    });
    
    markerClusterGroup.addLayer(marker);
}

function finishMapLoading(loadedLocations) {
    hideMapLoading();
    if (loadedLocations > 0) {
        map.fitBounds(markerClusterGroup.getBounds(), { padding: [50, 50] });
    }
}

function showMapLoading() {
    document.getElementById('mapLoadingOverlay').classList.remove('hidden');
    document.getElementById('refreshMapBtn').disabled = true;
    document.getElementById('refreshMapBtn').innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Loading...';
}

function hideMapLoading() {
    document.getElementById('mapLoadingOverlay').classList.add('hidden');
    document.getElementById('refreshMapBtn').disabled = false;
    document.getElementById('refreshMapBtn').innerHTML = '<i class="fas fa-sync-alt mr-1"></i> Refresh Map';
}

function refreshMap() {
    // Show loading
    showMapLoading();
    
    // Clear existing markers
    markerClusterGroup.clearLayers();
    
    // Reset marker count
    document.getElementById('markerCount').textContent = '0';
    
    // Clear processed IPs set to allow re-fetching
    processedIPs.clear();
    
    // Clear queue
    ipQueue = [];
    
    // Reload session locations
    loadSessionLocations();
    
    // Also refresh regions data
    if (window.regionsDataLoaded) {
        loadRegionsData();
    }
    
    showNotification('Map and data refreshed successfully', 'success');
}

// Load ISP Statistics with Plotly
window.ispStatsLoaded = false;
function loadISPStats() {
    const ispData = {};

    // Aggregate data from locationCache
    for (const ip in locationCache) {
        const data = locationCache[ip].data;
        if (data && data.isp) {
            if (!ispData[data.isp]) {
                ispData[data.isp] = { totalSessions: 0 };
            }
            ispData[data.isp].totalSessions++;
        }
    }

    const sortedISPs = Object.entries(ispData).sort(([, a], [, b]) => b.totalSessions - a.totalSessions);
    const top10ISPs = sortedISPs.slice(0, 10); // Top 10 ISPs

    // Populate table
    const tbody = document.getElementById('ispStatsTableBody');
    tbody.innerHTML = '';
    if (sortedISPs.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-server text-4xl mb-3"></i>
                    <p class="text-lg font-medium">Tidak ada data ISP tersedia</p>
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
                        <i class="fas fa-user mr-1"></i> -
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                        <i class="fas fa-user-secret mr-1"></i> -
                    </span>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    // Render Plotly Pie Chart
    const labels = top10ISPs.map(([isp,]) => isp);
    const values = top10ISPs.map(([, stats]) => stats.totalSessions);

    const data = [{
        values: values,
        labels: labels,
        type: 'pie',
        marker: {
            colors: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#14b8a6', '#f97316', '#06b6d4', '#84cc16']
        },
        textinfo: 'label+percent',
        textposition: 'outside',
        automargin: true
    }];

    const layout = {
        title: 'Top 10 ISP berdasarkan Total Sessions',
        height: 500,
        showlegend: true,
        font: {
            family: 'Inter, system-ui, sans-serif'
        }
    };

    Plotly.newPlot('ispChart', data, layout, {responsive: true});
    window.ispStatsLoaded = true;
}

// Load Country Statistics with Plotly
window.countryStatsLoaded = false;
function loadCountryStats() {
    const countryData = {};

    // Aggregate data from locationCache
    for (const ip in locationCache) {
        const data = locationCache[ip].data;
        if (data && data.country) {
            if (!countryData[data.country]) {
                countryData[data.country] = { totalSessions: 0, countryCode: data.countryCode };
            }
            countryData[data.country].totalSessions++;
        }
    }

    const sortedCountries = Object.entries(countryData).sort(([, a], [, b]) => b.totalSessions - a.totalSessions);
    const top10Countries = sortedCountries.slice(0, 10); // Top 10 countries

    // Populate table
    const tbody = document.getElementById('countryStatsTableBody');
    tbody.innerHTML = '';
    if (sortedCountries.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-flag text-4xl mb-3"></i>
                    <p class="text-lg font-medium">Tidak ada data negara tersedia</p>
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
                        <i class="fas fa-user mr-1"></i> -
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                        <i class="fas fa-user-secret mr-1"></i> -
                    </span>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    // Render Plotly Bar Chart
    const labels = top10Countries.map(([country,]) => country);
    const values = top10Countries.map(([, stats]) => stats.totalSessions);

    const data = [{
        x: labels,
        y: values,
        type: 'bar',
        marker: {
            color: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#14b8a6', '#f97316', '#06b6d4', '#84cc16']
        },
        text: values,
        textposition: 'auto'
    }];

    const layout = {
        title: 'Top 10 Negara berdasarkan Total Sessions',
        xaxis: {
            title: 'Negara'
        },
        yaxis: {
            title: 'Jumlah Sessions'
        },
        height: 500,
        font: {
            family: 'Inter, system-ui, sans-serif'
        }
    };

    Plotly.newPlot('countryChart', data, layout, {responsive: true});
    window.countryStatsLoaded = true;
}

// Load all data function
function loadAllData() {
    // Load regions data
    if (!window.regionsDataLoaded) {
        loadRegionsData();
    }

    // Load ISP data
    if (!window.ispStatsLoaded) {
        loadISPStats();
    }

    // Load Country data
    if (!window.countryStatsLoaded) {
        loadCountryStats();
    }
}

// Delete all sessions
function deleteAllSessions() {
    if (!confirm('⚠️ PERINGATAN: Ini akan logout SEMUA pengguna termasuk Anda!\n\nAnda yakin?')) {
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
        alert('Terjadi kesalahan saat menghapus sesi');
    });
}

// Delete user sessions
function deleteUserSessions(userId) {
    if (!confirm('Logout pengguna ini dari semua sesi?')) {
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
        showNotification('Terjadi kesalahan', 'error');
    });
}

// Delete IP sessions
function deleteIPSessions(ipAddress) {
    if (!confirm(`Blokir dan logout semua sesi dari IP: ${ipAddress}?`)) {
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
        showNotification('Terjadi kesalahan', 'error');
    });
}

// Delete single session
function deleteSession(sessionId) {
    if (!confirm('Matikan sesi ini?')) {
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
        showNotification('Terjadi kesalahan', 'error');
    });
}

// Get IP info
function getIPInfo(ipAddress) {
    document.getElementById('ipInfoModal').classList.remove('hidden');
    document.getElementById('ipInfoContent').innerHTML = '<div class="flex items-center justify-center py-12"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div></div>';
    
    // Fetch IP info from server (which uses findip.net API)
    fetch(`${baseUrl}/admin/session_management/get_ip_info`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: `ip_address=${encodeURIComponent(ipAddress)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.data) {
            const ipData = data.data;
            document.getElementById('ipInfoContent').innerHTML = `
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">IP Address</label>
                            <p class="text-lg font-mono">${ipData.query}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Negara</label>
                            <p class="text-lg">${ipData.country} (${ipData.countryCode})</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Region</label>
                            <p class="text-lg">${ipData.regionName || 'N/A'}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Kota</label>
                            <p class="text-lg">${ipData.city || 'Unknown'}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">ZIP Code</label>
                            <p class="text-lg">${ipData.zip || 'N/A'}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Timezone</label>
                            <p class="text-lg">${ipData.timezone || 'Unknown'}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">ISP</label>
                            <p class="text-lg">${ipData.isp || 'Unknown'}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Organisasi</label>
                            <p class="text-lg">${ipData.org || 'Unknown'}</p>
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm font-medium text-gray-500">Koordinat</label>
                            <p class="text-lg font-mono">${ipData.lat || 'Unknown'}, ${ipData.lon || 'Unknown'}</p>
                        </div>
                    </div>
                </div>
            `;
        } else {
            document.getElementById('ipInfoContent').innerHTML = '<div class="text-center text-red-600 py-8"><i class="fas fa-exclamation-circle text-4xl mb-3"></i><p>Gagal mengambil informasi IP</p></div>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('ipInfoContent').innerHTML = '<div class="text-center text-red-600 py-8"><i class="fas fa-times-circle text-4xl mb-3"></i><p>Error mengambil informasi IP</p></div>';
    });
}

function closeIPInfoModal() {
    document.getElementById('ipInfoModal').classList.add('hidden');
}

// Fetch location data for an IP address
function fetchLocationForIP(ipAddress, sessionData) {
    // Check if already processed
    if (processedIPs.has(ipAddress)) {
        return;
    }
    
    // Mark as processed
    processedIPs.add(ipAddress);
    
    // Check if already in cache
    if (locationCache[ipAddress] && locationCache[ipAddress].data) {
        updateMapWithLocation(sessionData, locationCache[ipAddress].data);
        return;
    }
    
    // Update UI to show loading
    const locationElement = document.getElementById(`location-${btoa(ipAddress).replace(/=/g, '')}`);
    if (locationElement) {
        locationElement.innerHTML = '<i class="fas fa-sync fa-spin mr-1 text-blue-500"></i> Getting location...';
    }
    
    // Add to queue
    ipQueue.push({ip: ipAddress, session: sessionData});
    processIPQueue();
}

// Process IP queue
function processIPQueue() {
    if (isProcessingQueue || ipQueue.length === 0) {
        return;
    }
    
    isProcessingQueue = true;
    processNextIP();
}

// Process next IP in queue
function processNextIP() {
    if (ipQueue.length === 0) {
        isProcessingQueue = false;
        return;
    }
    
    const ipItem = ipQueue.shift();
    const ipAddress = ipItem.ip;
    const sessionData = ipItem.session;
    
    // Fetch location data from server (which uses findip.net API)
    fetch(`${baseUrl}/admin/session_management/get_cached_location`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: `ip_address=${encodeURIComponent(ipAddress)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Use data (either cached or fresh)
            locationCache[ipAddress] = {data: data.data, timestamp: Date.now()};
            updateMapWithLocation(sessionData, data.data);
            
            // Update UI with location info
            const locationElement = document.getElementById(`location-${btoa(ipAddress).replace(/=/g, '')}`);
            if (locationElement) {
                locationElement.innerHTML = `${data.data.city || 'Unknown'}, ${data.data.countryCode || 'Unknown'}`;
            }
        } else {
            // Update UI to show error
            const locationElement = document.getElementById(`location-${btoa(ipAddress).replace(/=/g, '')}`);
            if (locationElement) {
                locationElement.innerHTML = '<i class="fas fa-exclamation-triangle text-yellow-500 mr-1"></i> Location unavailable';
            }
        }
    })
    .catch(error => {
        console.error('Error fetching location for IP:', ipAddress, error);
        // Update UI to show error
        const locationElement = document.getElementById(`location-${btoa(ipAddress).replace(/=/g, '')}`);
        if (locationElement) {
            locationElement.innerHTML = '<i class="fas fa-exclamation-triangle text-yellow-500 mr-1"></i> Location unavailable';
        }
    })
    .finally(() => {
        // Process next IP after delay
        setTimeout(processNextIP, requestDelay);
    });
}

// Update map with location data
function updateMapWithLocation(session, locationData) {
    if (locationData && locationData.lat && locationData.lon) {
        addMarkerToMap(session, locationData);
        
        // Update regions data
        const key = `${locationData.country}|${locationData.city}|${locationData.isp || 'Unknown'}`;
        if (!regionsData[key]) {
            regionsData[key] = {
                country: locationData.country,
                countryCode: locationData.countryCode,
                city: locationData.city,
                region: locationData.regionName,
                isp: locationData.isp || 'Unknown',
                lat: locationData.lat,
                lon: locationData.lon,
                totalSessions: 0
            };
        }
        regionsData[key].totalSessions++;
        
        // Update marker count
        const currentCount = parseInt(document.getElementById('markerCount').textContent) || 0;
        document.getElementById('markerCount').textContent = currentCount + 1;
        
        // Refresh regions table if loaded
        if (window.regionsDataLoaded) {
            showRegionsTable();
        }
    }
}

// View user sessions
function viewUserSessions(userId) {
    window.location.href = `${baseUrl}/admin/session_management/user_sessions/${userId}`;
}

// Cleanup expired sessions
function cleanupExpiredSessions() {
    const hours = prompt('Bersihkan sesi yang lebih lama dari berapa jam?', '24');
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
        showNotification('Terjadi kesalahan', 'error');
    });
}

// Export session data
function exportSessionData(format) {
    showNotification(`Mengekspor data sebagai ${format.toUpperCase()}...`, 'info');
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
    document.getElementById('regionsLoading').classList.remove('hidden');
    document.getElementById('regionsTable').classList.add('hidden');
    document.getElementById('loadRegionsBtn').disabled = true;
    document.getElementById('loadRegionsBtn').innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Loading...';
    
    regionsData = {};
    
    // Aggregate data from locationCache
    for (const ip in locationCache) {
        const data = locationCache[ip].data;
        if (data && data.country && data.city) {
            const key = `${data.country}|${data.city}|${data.isp || 'Unknown'}`;
            
            if (!regionsData[key]) {
                regionsData[key] = {
                    country: data.country,
                    countryCode: data.countryCode,
                    city: data.city,
                    region: data.regionName,
                    isp: data.isp || 'Unknown',
                    lat: data.lat,
                    lon: data.lon,
                    totalSessions: 0
                };
            }
            
            regionsData[key].totalSessions++;
        }
    }
    
    // If no data in cache, try to fetch from sessions data
    if (Object.keys(regionsData).length === 0 && sessionsData.length > 0) {
        // Process unique IPs from sessions data
        const processedIPs = new Set();
        sessionsData.forEach(session => {
            if (session.ip_address && !processedIPs.has(session.ip_address)) {
                processedIPs.add(session.ip_address);
                // Try to fetch location data for this IP
                fetchLocationForIP(session.ip_address, session);
            }
        });
    }
    
    document.getElementById('regionsProgress').textContent = Object.keys(locationCache).length || sessionsData.length;
    document.getElementById('regionsTotal').textContent = Object.keys(locationCache).length || sessionsData.length;
    
    showRegionsTable();
}

function showRegionsTable() {
    document.getElementById('regionsLoading').classList.add('hidden');
    document.getElementById('regionsTable').classList.remove('hidden');
    document.getElementById('loadRegionsBtn').disabled = false;
    document.getElementById('loadRegionsBtn').innerHTML = '<i class="fas fa-sync-alt mr-1"></i> Reload Regions Data';
    window.regionsDataLoaded = true;
    
    const tbody = document.getElementById('regionsTableBody');
    tbody.innerHTML = '';
    
    const sortedRegions = Object.values(regionsData).sort((a, b) => b.totalSessions - a.totalSessions);
    
    if (sortedRegions.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-globe text-4xl mb-3"></i>
                    <p class="text-lg font-medium">Tidak ada data geografis tersedia</p>
                    <p class="text-sm mt-2">Data akan dimuat secara otomatis saat pengguna mengakses sistem</p>
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
                <div class="text-sm text-gray-500">${region.region || 'N/A'}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                    ${region.totalSessions} session${region.totalSessions > 1 ? 's' : ''}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                    <i class="fas fa-user mr-1"></i> -
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                    <i class="fas fa-user-secret mr-1"></i> -
                </span>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-700">${region.isp || 'Unknown'}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button onclick="viewRegionOnMap(${region.lat}, ${region.lon})" class="text-blue-600 hover:text-blue-900" title="Lihat di Peta">
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
    document.querySelector('#map').scrollIntoView({ behavior: 'smooth', block: 'center' });
}

// Filter sessions (placeholder)
function filterSessions() {
    // Implement filter logic if needed
}

// Initialize on document ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize map first
    initMap();
    
    // Load map locations after a short delay
    setTimeout(function() {
        loadSessionLocations();
    }, 500);

    // Load all statistics data automatically after 1 second
    setTimeout(function() {
        loadAllData();
    }, 1000);
    
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

</script>
