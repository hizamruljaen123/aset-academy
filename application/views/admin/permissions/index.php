<?php
/**
 * Permissions Management Page
 * Main view for managing system permissions with tabbed interface
 */

// Page data should be passed from controller
$title = isset($title) ? $title : 'Kelola Permissions';
$permissions = isset($permissions) ? $permissions : [];
$permission_matrix = isset($permission_matrix) ? $permission_matrix : [];
$stats = isset($stats) ? $stats : [];
?>

<!-- Main Content Container -->
<div class="min-h-screen bg-gray-50">
    <!-- Page Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Kelola Permissions</h1>
                    <p class="mt-1 text-sm text-gray-500">Atur hak akses sistem berdasarkan role dan level</p>
                </div>
                <div class="flex space-x-3">
                    <a href="<?php echo site_url('admin/permissions/create'); ?>"
                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Permission
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Permissions</p>
                        <p class="text-3xl font-bold"><?php echo isset($stats['total_permissions']) ? $stats['total_permissions'] : 0; ?></p>
                    </div>
                    <div class="p-3 bg-blue-400/20 rounded-lg">
                        <i class="fas fa-key text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Active Permissions</p>
                        <p class="text-3xl font-bold"><?php echo isset($stats['active_permissions']) ? $stats['active_permissions'] : 0; ?></p>
                    </div>
                    <div class="p-3 bg-green-400/20 rounded-lg">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Roles</p>
                        <p class="text-3xl font-bold"><?php echo isset($stats['roles_count']) ? $stats['roles_count'] : 0; ?></p>
                    </div>
                    <div class="p-3 bg-purple-400/20 rounded-lg">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium">Modules</p>
                        <p class="text-3xl font-bold"><?php echo isset($stats['modules_count']) ? $stats['modules_count'] : 0; ?></p>
                    </div>
                    <div class="p-3 bg-orange-400/20 rounded-lg">
                        <i class="fas fa-cubes text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex flex-col lg:flex-row gap-4">
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Permission</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" id="search" name="search"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Cari berdasarkan module, action, atau role...">
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="min-w-0 flex-1">
                        <label for="role_filter" class="block text-sm font-medium text-gray-700 mb-2">Filter Role</label>
                        <select id="role_filter" name="role_filter"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Role</option>
                            <option value="super_admin">Super Admin</option>
                            <option value="admin">Admin</option>
                            <option value="guru">Guru</option>
                            <option value="siswa">Siswa</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="min-w-0 flex-1">
                        <label for="status_filter" class="block text-sm font-medium text-gray-700 mb-2">Filter Status</label>
                        <select id="status_filter" name="status_filter"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Status</option>
                            <option value="allowed">Allowed</option>
                            <option value="denied">Denied</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <!-- Tab Headers -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <button type="button" id="matrix-tab" data-tab="matrix"
                            class="tab-button active whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-blue-500 text-blue-600">
                        <i class="fas fa-table mr-2"></i>
                        Permission Matrix
                    </button>
                    <button type="button" id="detailed-tab" data-tab="detailed"
                            class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        <i class="fas fa-list mr-2"></i>
                        Detailed Permissions
                    </button>
                    <button type="button" id="actions-tab" data-tab="actions"
                            class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        <i class="fas fa-bolt mr-2"></i>
                        Quick Actions
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                <!-- Permission Matrix Tab -->
                <div id="matrix-content" class="tab-content active">
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Matrix Permissions</h2>
                        <p class="text-gray-600">Overview hak akses per role dan module</p>
                    </div>
                    <div class="space-y-4">
                        <?php if (isset($permission_matrix) && !empty($permission_matrix)): ?>
                            <?php foreach($permission_matrix as $module => $actions): ?>
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                    <!-- Module Header -->
                                    <div class="module-header flex items-center justify-between p-4 bg-gray-50 border-b border-gray-200 cursor-pointer hover:bg-gray-100 transition-colors"
                                         onclick="toggleModule('<?php echo strtolower($module); ?>')">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-full">
                                                <i class="fas fa-cube text-blue-600 text-sm"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">
                                                    <?php echo ucfirst($module); ?>
                                                </h3>
                                                <p class="text-sm text-gray-500">
                                                    <?php echo count($actions); ?> permissions
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="module-badge px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                                <?php echo count($actions); ?> actions
                                            </span>
                                            <button class="module-toggle-btn text-gray-400 hover:text-gray-600 transition-colors">
                                                <i class="fas fa-chevron-down transition-transform duration-200" id="icon-<?php echo strtolower($module); ?>"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Module Content -->
                                    <div id="module-<?php echo strtolower($module); ?>" class="module-content" style="display: none;">
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Super Admin</th>
                                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Guru</th>
                                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <?php foreach($actions as $action => $roles): ?>
                                                        <tr class="hover:bg-gray-50 permission-row">
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 action-cell">
                                                                <?php echo ucfirst($action); ?>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo (in_array('super_admin', $roles)) ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'; ?>">
                                                                    <?php if (in_array('super_admin', $roles)): ?>
                                                                        <i class="fas fa-check text-green-600 mr-1"></i> Yes
                                                                    <?php else: ?>
                                                                        <i class="fas fa-times text-red-500 mr-1"></i> No
                                                                    <?php endif; ?>
                                                                </span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo (in_array('admin', $roles)) ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800'; ?>">
                                                                    <?php if (in_array('admin', $roles)): ?>
                                                                        <i class="fas fa-check text-green-600 mr-1"></i> Yes
                                                                    <?php else: ?>
                                                                        <i class="fas fa-times text-red-500 mr-1"></i> No
                                                                    <?php endif; ?>
                                                                </span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo (in_array('guru', $roles)) ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-800'; ?>">
                                                                    <?php if (in_array('guru', $roles)): ?>
                                                                        <i class="fas fa-check text-green-600 mr-1"></i> Yes
                                                                    <?php else: ?>
                                                                        <i class="fas fa-times text-red-500 mr-1"></i> No
                                                                    <?php endif; ?>
                                                                </span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo (in_array('siswa', $roles)) ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; ?>">
                                                                    <?php if (in_array('siswa', $roles)): ?>
                                                                        <i class="fas fa-check text-green-600 mr-1"></i> Yes
                                                                    <?php else: ?>
                                                                        <i class="fas fa-times text-red-500 mr-1"></i> No
                                                                    <?php endif; ?>
                                                                </span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo (in_array('user', $roles)) ? 'bg-gray-100 text-gray-800' : 'bg-gray-100 text-gray-800'; ?>">
                                                                    <?php if (in_array('user', $roles)): ?>
                                                                        <i class="fas fa-check text-green-600 mr-1"></i> Yes
                                                                    <?php else: ?>
                                                                        <i class="fas fa-times text-red-500 mr-1"></i> No
                                                                    <?php endif; ?>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-12">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-key text-4xl text-gray-400 mb-3"></i>
                                    <p class="text-lg font-medium text-gray-900 mb-1">Belum ada permission yang dikonfigurasi</p>
                                    <p class="text-gray-500">Mulai dengan menambahkan permission baru</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Detailed Permissions Tab -->
                <div id="detailed-content" class="tab-content hidden">
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Detail Permissions</h2>
                        <p class="text-gray-600">Daftar lengkap permission dengan detail informasi</p>
                    </div>
                    <div class="overflow-auto" style="max-height: 550px;">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Module</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="permissions-body">
                                <?php if (empty($permissions)): ?>
                                    <tr>
                                        <td colspan="8" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <i class="fas fa-key text-4xl text-gray-400 mb-3"></i>
                                                <p class="text-lg font-medium text-gray-900 mb-1">Belum ada data permission</p>
                                                <p class="text-gray-500">Mulai dengan menambahkan permission baru</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php $no = 1; foreach ($permissions as $permission): ?>
                                        <tr class="hover:bg-gray-50 permission-detail-row">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $no++; ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 text-xs font-medium rounded-full role-cell <?php
                                                    echo ($permission->role == 'super_admin') ? 'bg-red-100 text-red-800' :
                                                        (($permission->role == 'admin') ? 'bg-yellow-100 text-yellow-800' :
                                                        (($permission->role == 'guru') ? 'bg-indigo-100 text-indigo-800' :
                                                        (($permission->role == 'siswa') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800')));
                                                ?>">
                                                    <?php echo ucfirst(str_replace('_', ' ', $permission->role)); ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 text-xs font-medium rounded-full border border-gray-300 text-gray-700">
                                                    Level <?php echo $permission->level; ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 module-detail-cell">
                                                <?php echo ucfirst($permission->module); ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 action-detail-cell">
                                                <?php echo ucfirst($permission->action); ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 text-xs font-medium rounded-full status-cell <?php echo ($permission->allowed) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                                    <?php echo ($permission->allowed) ? 'Allowed' : 'Denied'; ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <?php echo date('d/m/Y', strtotime($permission->created_at)); ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                                <div class="flex justify-center space-x-1">
                                                    <a href="<?php echo site_url('admin/permissions/edit/'.$permission->id); ?>"
                                                       class="text-indigo-600 hover:text-indigo-900 p-2 rounded-md hover:bg-indigo-50 transition-colors"
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?php echo site_url('admin/permissions/toggle/'.$permission->id); ?>"
                                                       class="text-yellow-600 hover:text-yellow-900 p-2 rounded-md hover:bg-yellow-50 transition-colors"
                                                       title="<?php echo ($permission->allowed) ? 'Deny' : 'Allow'; ?>"
                                                       onclick="return confirm('Apakah Anda yakin ingin mengubah status permission ini?')">
                                                        <i class="fas <?php echo ($permission->allowed) ? 'fa-ban' : 'fa-check'; ?>"></i>
                                                    </a>
                                                    <a href="<?php echo site_url('admin/permissions/delete/'.$permission->id); ?>"
                                                       class="text-red-600 hover:text-red-900 p-2 rounded-md hover:bg-red-50 transition-colors"
                                                       title="Hapus"
                                                       onclick="return confirm('Apakah Anda yakin ingin menghapus permission ini?')">
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

                <!-- Quick Actions Tab -->
                <div id="actions-content" class="tab-content hidden">
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Aksi Cepat</h2>
                        <p class="text-gray-600">Fitur untuk mengelola permission secara cepat</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <a href="<?php echo site_url('admin/permissions/reset_defaults'); ?>"
                           class="flex flex-col items-center p-6 border border-gray-300 rounded-lg hover:shadow-lg transition-all duration-200 text-center group"
                           onclick="return confirm('Apakah Anda yakin ingin mereset ke permission default?')">
                            <div class="p-4 bg-blue-100 rounded-full mb-4 group-hover:bg-blue-200 transition-colors">
                                <i class="fas fa-undo text-blue-600 text-2xl"></i>
                            </div>
                            <span class="text-lg font-semibold text-gray-900 mb-1">Reset Default</span>
                            <span class="text-sm text-gray-500">Kembalikan ke pengaturan awal</span>
                        </a>
                        <a href="<?php echo site_url('admin/permissions/export'); ?>"
                           class="flex flex-col items-center p-6 border border-gray-300 rounded-lg hover:shadow-lg transition-all duration-200 text-center group">
                            <div class="p-4 bg-green-100 rounded-full mb-4 group-hover:bg-green-200 transition-colors">
                                <i class="fas fa-download text-green-600 text-2xl"></i>
                            </div>
                            <span class="text-lg font-semibold text-gray-900 mb-1">Export</span>
                            <span class="text-sm text-gray-500">Unduh data permission</span>
                        </a>
                        <a href="<?php echo site_url('admin/permissions/import'); ?>"
                           class="flex flex-col items-center p-6 border border-gray-300 rounded-lg hover:shadow-lg transition-all duration-200 text-center group">
                            <div class="p-4 bg-purple-100 rounded-full mb-4 group-hover:bg-purple-200 transition-colors">
                                <i class="fas fa-upload text-purple-600 text-2xl"></i>
                            </div>
                            <span class="text-lg font-semibold text-gray-900 mb-1">Import</span>
                            <span class="text-sm text-gray-500">Impor data permission</span>
                        </a>
                    </div>

                    <!-- Additional Quick Actions -->
                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-lg border border-blue-200">
                            <h3 class="text-lg font-semibold text-blue-900 mb-3">Bulk Actions</h3>
                            <p class="text-blue-700 text-sm mb-4">Kelola multiple permissions sekaligus</p>
                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                <i class="fas fa-tasks mr-2"></i>
                                Manage Bulk
                            </button>
                        </div>
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-lg border border-green-200">
                            <h3 class="text-lg font-semibold text-green-900 mb-3">Permission Report</h3>
                            <p class="text-green-700 text-sm mb-4">Lihat laporan lengkap permission</p>
                            <button class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                <i class="fas fa-chart-bar mr-2"></i>
                                View Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Permissions CSS -->
<link href="<?php echo base_url('assets/css/permissions.css'); ?>" rel="stylesheet">

<!-- Permissions JS -->
<script src="<?php echo base_url('assets/js/permissions.js'); ?>"></script>

<script>
// Tab functionality and module toggling
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    // Function to activate a specific tab
    function activateTab(tabName) {
        // Update button styles
        tabButtons.forEach(btn => {
            const isActive = btn.getAttribute('data-tab') === tabName;
            btn.classList.toggle('active', isActive);
            btn.classList.toggle('border-blue-500', isActive);
            btn.classList.toggle('text-blue-600', isActive);
            btn.classList.toggle('border-transparent', !isActive);
            btn.classList.toggle('text-gray-500', !isActive);
            btn.classList.toggle('hover:text-gray-700', !isActive);
            btn.classList.toggle('hover:border-gray-300', !isActive);
        });

        // Update content visibility
        tabContents.forEach(content => {
            const isContentActive = content.id === tabName + '-content';
            content.classList.toggle('hidden', !isContentActive);
            content.classList.toggle('active', isContentActive);
        });
    }

    // Add click event listeners to tab buttons
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabName = button.getAttribute('data-tab');
            activateTab(tabName);
        });
    });

    // Initialize search and filter functionality
    const searchInput = document.getElementById('search');
    const roleFilter = document.getElementById('role_filter');
    const statusFilter = document.getElementById('status_filter');
    const matrixBody = document.getElementById('matrix-body');
    const permissionsBody = document.getElementById('permissions-body');

    function filterPermissions() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedRole = roleFilter.value.toLowerCase();
        const selectedStatus = statusFilter.value;

        // Filter Matrix Table - search within visible modules only
        const matrixRows = matrixBody.querySelectorAll('.permission-row');
        matrixRows.forEach(row => {
            const action = row.querySelector('.action-cell').textContent.toLowerCase();
            const searchMatch = action.includes(searchTerm);
            row.style.display = searchMatch ? '' : 'none';
        });

        // Filter Detailed Permissions Table
    const detailRows = permissionsBody.querySelectorAll('.permission-detail-row');
    statusFilter.addEventListener('change', filterPermissions);

    // Clear search on ESC key
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            this.value = '';
            filterPermissions();
        }
    });
});