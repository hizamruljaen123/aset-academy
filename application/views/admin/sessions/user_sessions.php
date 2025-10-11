<!-- User Sessions Dashboard -->
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">User Sessions</h2>
                <p class="text-gray-600 mt-1">Manage all sessions for user: <strong><?= html_escape($user->nama_lengkap ?: $user->username) ?></strong></p>
            </div>
            <div class="flex items-center space-x-3">
                <button onclick="forceLogoutAll()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors">
                    <i class="fas fa-user-slash mr-1"></i> Force Logout All
                </button>
                <a href="<?= site_url('admin/session_management') ?>" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg text-sm font-medium transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i> Back to All Sessions
                </a>
            </div>
        </div>
    </div>

    <!-- User Info Card -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center space-x-6">
            <div class="flex-shrink-0 h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-user text-blue-600 text-2xl"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-semibold text-gray-900">
                    <?= html_escape($user->nama_lengkap ?: $user->username) ?>
                </h3>
                <p class="text-gray-600">
                    <i class="fas fa-envelope mr-2"></i><?= html_escape($user->email) ?>
                </p>
                <p class="text-gray-600">
                    <i class="fas fa-user-tag mr-2"></i><?= ucfirst($user->role) ?>
                </p>
                <p class="text-gray-600">
                    <i class="fas fa-calendar mr-2"></i>Joined: <?= date('M d, Y', strtotime($user->created_at)) ?>
                </p>
            </div>
            <div class="text-right">
                <div class="text-3xl font-bold text-blue-600">
                    <?= count($user_sessions) ?>
                </div>
                <div class="text-sm text-gray-500">Active Sessions</div>
            </div>
        </div>
    </div>

    <!-- Sessions Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Active Sessions</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Session ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Agent</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Login Time</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Activity</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($user_sessions)): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-user-clock text-4xl mb-3"></i>
                                <p class="text-lg font-medium">No active sessions found for this user.</p>
                                <p class="text-sm">This user is not currently logged in from any device.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($user_sessions as $session): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-xs font-mono text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                        <?= substr($session->id, 0, 8) ?>...
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= html_escape($session->ip_address) ?>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs font-mono text-gray-500 bg-gray-100 p-2 rounded block max-w-xs truncate" title="<?= html_escape($session->user_agent) ?>">
                                        <?= html_escape($session->user_agent) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php if ($session->login_time): ?>
                                        <?= date('M d, Y H:i', strtotime($session->login_time)) ?>
                                    <?php else: ?>
                                        <span class="text-gray-400">Unknown</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= timespan($session->timestamp, time()) ?> ago
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php if ($session->login_time): ?>
                                        <?= round((time() - strtotime($session->login_time)) / 60) ?> minutes
                                    <?php else: ?>
                                        <span class="text-gray-400">Unknown</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="killSession('<?= $session->id ?>')" class="text-red-600 hover:text-red-900 mr-2">
                                        <i class="fas fa-times-circle"></i> Kill
                                    </button>
                                    <button onclick="getIPInfo('<?= $session->ip_address ?>')" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-info-circle"></i> IP Info
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- IP Info Modal (reused from main session management) -->
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

<script>
// Kill specific session
function killSession(sessionId) {
    if (!confirm('Are you sure you want to kill this session? The user will be logged out.')) {
        return;
    }

    fetch(`<?= site_url('admin/session_management/delete_session') ?>`, {
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
            showNotification('Session killed successfully', 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showNotification(data.message || 'Error killing session', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An error occurred', 'error');
    });
}

// Force logout all sessions for this user
function forceLogoutAll() {
    if (!confirm('⚠️ WARNING: This will force logout this user from ALL active sessions!\n\nAre you absolutely sure?')) {
        return;
    }

    fetch(`<?= site_url('admin/session_management/delete_sessions_by_user') ?>`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `user_id=<?= $user->id ?>`
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

// Get IP info (reused function)
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
                        </div>
                        <div class="pt-4 border-t">
                            <label class="text-sm font-medium text-gray-500">Coordinates</label>
                            <p class="text-lg font-mono">${data.lat}, ${data.lon}</p>
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
</script>
