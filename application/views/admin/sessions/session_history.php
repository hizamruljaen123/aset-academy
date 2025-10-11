<!-- Session History Dashboard -->
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Session History & Logs</h2>
                <p class="text-gray-600 mt-1">View and analyze past user sessions and login activities</p>
            </div>
            <div class="flex items-center space-x-3">
                <button onclick="exportHistoryData()" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-colors">
                    <i class="fas fa-download mr-1"></i> Export Data
                </button>
                <a href="<?= site_url('admin/session_management') ?>" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Active Sessions
                </a>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <form method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">User ID</label>
                    <input type="text" name="user_id" value="<?= html_escape($filters['user_id']) ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Filter by user ID">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">IP Address</label>
                    <input type="text" name="ip_address" value="<?= html_escape($filters['ip_address']) ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Filter by IP address">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Logout Type</label>
                    <select name="logout_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">All Types</option>
                        <option value="manual" <?= $filters['logout_type'] === 'manual' ? 'selected' : '' ?>>Manual Logout</option>
                        <option value="timeout" <?= $filters['logout_type'] === 'timeout' ? 'selected' : '' ?>>Timeout</option>
                        <option value="admin_force" <?= $filters['logout_type'] === 'admin_force' ? 'selected' : '' ?>>Admin Force</option>
                        <option value="system" <?= $filters['logout_type'] === 'system' ? 'selected' : '' ?>>System</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date From</label>
                    <input type="date" name="date_from" value="<?= html_escape($filters['date_from']) ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                    <i class="fas fa-filter mr-1"></i> Apply Filters
                </button>
                <a href="<?= site_url('admin/session_management/history') ?>" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg text-sm font-medium transition-colors">
                    <i class="fas fa-times mr-1"></i> Clear Filters
                </a>
            </div>
        </form>
    </div>

    <!-- Session Logs Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Session History</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Session ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Login Time</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logout Time</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logout Type</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($session_logs)): ?>
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-history text-4xl mb-3"></i>
                                <p class="text-lg font-medium">No session history found.</p>
                                <p class="text-sm">Session logs will appear here once users start logging in and out.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($session_logs as $log): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-xs font-mono text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                        <?= substr($log->session_id, 0, 8) ?>...
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($log->user_id): ?>
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-blue-600 text-sm"></i>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?= html_escape($log->nama_lengkap ?: $log->username) ?>
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    <?= html_escape($log->email) ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-sm text-gray-500">
                                            <i class="fas fa-user-secret mr-1"></i> Guest
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= html_escape($log->ip_address) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= date('M d, Y H:i', strtotime($log->login_time)) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= $log->logout_time ? date('M d, Y H:i', strtotime($log->logout_time)) : '-' ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php if ($log->session_duration): ?>
                                        <?= gmdate('H:i:s', $log->session_duration) ?>
                                    <?php else: ?>
                                        <span class="text-gray-400">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                        $type_colors = [
                                            'manual' => 'blue',
                                            'timeout' => 'yellow',
                                            'admin_force' => 'red',
                                            'system' => 'gray'
                                        ];
                                        $color = $type_colors[$log->logout_type] ?? 'gray';
                                    ?>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-<?= $color ?>-100 text-<?= $color ?>-800">
                                        <?= ucfirst(str_replace('_', ' ', $log->logout_type)) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="viewSessionDetails('<?= $log->session_id ?>')" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-eye"></i> Details
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Session Details Modal -->
    <div id="sessionDetailsModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex items-center justify-between rounded-t-xl">
                <h3 class="text-lg font-bold text-white flex items-center">
                    <i class="fas fa-info-circle mr-2"></i> Session Details
                </h3>
                <button onclick="closeSessionDetailsModal()" class="text-white hover:text-gray-200 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="sessionDetailsContent" class="p-6">
                <div class="flex items-center justify-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function viewSessionDetails(sessionId) {
    document.getElementById('sessionDetailsModal').classList.remove('hidden');
    document.getElementById('sessionDetailsContent').innerHTML = '<div class="flex items-center justify-center py-12"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div></div>';

    fetch(`<?= site_url('admin/session_management/get_session_details') ?>/${sessionId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('sessionDetailsContent').innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Session ID</label>
                                <p class="mt-1 text-sm font-mono bg-gray-100 p-2 rounded">${data.session.session_id}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">User</label>
                                <p class="mt-1 text-sm">${data.session.nama_lengkap || 'Guest'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">IP Address</label>
                                <p class="mt-1 text-sm font-mono">${data.session.ip_address}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Login Time</label>
                                <p class="mt-1 text-sm">${new Date(data.session.login_time).toLocaleString()}</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Logout Time</label>
                                <p class="mt-1 text-sm">${data.session.logout_time ? new Date(data.session.logout_time).toLocaleString() : 'Still Active'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Duration</label>
                                <p class="mt-1 text-sm">${data.session.session_duration ? formatDuration(data.session.session_duration) : 'N/A'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Logout Type</label>
                                <p class="mt-1 text-sm">${data.session.logout_type ? data.session.logout_type.replace('_', ' ').toUpperCase() : 'N/A'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">User Agent</label>
                                <p class="mt-1 text-sm font-mono text-xs bg-gray-100 p-2 rounded break-all">${data.session.user_agent || 'N/A'}</p>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                document.getElementById('sessionDetailsContent').innerHTML = '<div class="text-center text-red-600 py-8"><i class="fas fa-exclamation-circle text-4xl mb-3"></i><p>Session details not found</p></div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('sessionDetailsContent').innerHTML = '<div class="text-center text-red-600 py-8"><i class="fas fa-times-circle text-4xl mb-3"></i><p>Error loading session details</p></div>';
        });
}

function closeSessionDetailsModal() {
    document.getElementById('sessionDetailsModal').classList.add('hidden');
}

function formatDuration(seconds) {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const secs = seconds % 60;

    if (hours > 0) {
        return `${hours}h ${minutes}m ${secs}s`;
    } else if (minutes > 0) {
        return `${minutes}m ${secs}s`;
    } else {
        return `${secs}s`;
    }
}

function exportHistoryData() {
    // Implementation for exporting session history data
    alert('Export functionality would be implemented here');
}
</script>
