<div class="p-4 transition-opacity duration-500 opacity-0 permissions-container">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-2xl shadow-xl ring-1 ring-gray-200/50">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-800">Kelola Permissions</h1>
            <p class="text-lg text-gray-500 mt-2">Atur hak akses user berdasarkan role dan level</p>
        </div>
        <a href="<?php echo site_url('admin/permissions/create'); ?>" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 border border-transparent rounded-xl font-medium text-sm text-white shadow-sm hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5">
            <i class="fas fa-plus mr-2"></i>
            Tambah Permission
        </a>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="mb-6 p-4 border-l-4 border-green-500 bg-green-50 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                <p class="text-green-800"><?php echo $this->session->flashdata('success'); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Permission Matrix -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8">
        <div class="p-6 border-b border-gray-200/50">
            <h2 class="text-2xl font-bold text-gray-800">Matrix Permissions</h2>
            <p class="text-gray-500">Overview hak akses per role dan module</p>
        </div>
        <div class="p-6">
            <div class="table-responsive">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Module</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Super Admin</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Guru</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (isset($permission_matrix) && !empty($permission_matrix)): ?>
                            <?php foreach($permission_matrix as $module => $actions): ?>
                                <?php foreach($actions as $action => $roles): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo ucfirst($module); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo ucfirst($action); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <?php if (in_array('super_admin', $roles)): ?>
                                                <i class="fas fa-check text-green-500"></i>
                                            <?php else: ?>
                                                <i class="fas fa-times text-red-500"></i>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <?php if (in_array('admin', $roles)): ?>
                                                <i class="fas fa-check text-green-500"></i>
                                            <?php else: ?>
                                                <i class="fas fa-times text-red-500"></i>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <?php if (in_array('guru', $roles)): ?>
                                                <i class="fas fa-check text-green-500"></i>
                                            <?php else: ?>
                                                <i class="fas fa-times text-red-500"></i>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <?php if (in_array('siswa', $roles)): ?>
                                                <i class="fas fa-check text-green-500"></i>
                                            <?php else: ?>
                                                <i class="fas fa-times text-red-500"></i>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <?php if (in_array('user', $roles)): ?>
                                                <i class="fas fa-check text-green-500"></i>
                                            <?php else: ?>
                                                <i class="fas fa-times text-red-500"></i>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-key text-4xl text-gray-400 mb-3"></i>
                                        <p class="text-lg font-medium text-gray-900 mb-1">Belum ada permission yang dikonfigurasi</p>
                                        <p class="text-gray-500">Mulai dengan menambahkan permission baru</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Detailed Permissions -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8">
        <div class="p-6 border-b border-gray-200/50">
            <h2 class="text-2xl font-bold text-gray-800">Detail Permissions</h2>
        </div>
        <div class="p-6">
            <div class="table-responsive">
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
                    <tbody class="bg-white divide-y divide-gray-200">
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
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $no++; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full <?php 
                                            echo ($permission->role == 'super_admin') ? 'bg-red-100 text-red-800' : 
                                                (($permission->role == 'admin') ? 'bg-yellow-100 text-yellow-800' : 
                                                (($permission->role == 'guru') ? 'bg-indigo-100 text-indigo-800' : 
                                                (($permission->role == 'siswa') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800')));
                                        ?>">
                                            <?php echo ucfirst(str_replace('_', ' ', $permission->role)); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full border border-gray-300 text-gray-700">
                                            Level <?php echo $permission->level; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo ucfirst($permission->module); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo ucfirst($permission->action); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full <?php echo ($permission->allowed) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                            <?php echo ($permission->allowed) ? 'Allowed' : 'Denied'; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo date('d/m/Y', strtotime($permission->created_at)); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="<?php echo site_url('admin/permissions/edit/'.$permission->id); ?>" 
                                               class="text-indigo-600 hover:text-indigo-900 p-1 rounded-full hover:bg-indigo-50" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?php echo site_url('admin/permissions/toggle/'.$permission->id); ?>" 
                                               class="text-yellow-600 hover:text-yellow-900 p-1 rounded-full hover:bg-yellow-50" 
                                               title="<?php echo ($permission->allowed) ? 'Deny' : 'Allow'; ?>"
                                               onclick="return confirm('Apakah Anda yakin ingin mengubah status permission ini?')">
                                                <i class="fas <?php echo ($permission->allowed) ? 'fa-ban' : 'fa-check'; ?>"></i>
                                            </a>
                                            <a href="<?php echo site_url('admin/permissions/delete/'.$permission->id); ?>" 
                                               class="text-red-600 hover:text-red-900 p-1 rounded-full hover:bg-red-50" 
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
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
        <div class="p-6 border-b border-gray-200/50">
            <h2 class="text-2xl font-bold text-gray-800">Aksi Cepat</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="<?php echo site_url('admin/permissions/reset_defaults'); ?>" 
                   class="flex flex-col items-center p-4 border border-gray-300 rounded-xl hover:shadow-md transition-shadow text-center"
                   onclick="return confirm('Apakah Anda yakin ingin mereset ke permission default?')">
                    <i class="fas fa-undo text-blue-600 mb-2"></i>
                    <span class="text-sm font-medium">Reset Default</span>
                </a>
                <a href="<?php echo site_url('admin/permissions/export'); ?>" 
                   class="flex flex-col items-center p-4 border border-gray-300 rounded-xl hover:shadow-md transition-shadow text-center">
                    <i class="fas fa-download text-green-600 mb-2"></i>
                    <span class="text-sm font-medium">Export</span>
                </a>
                <a href="<?php echo site_url('admin/permissions/import'); ?>" 
                   class="flex flex-col items-center p-4 border border-gray-300 rounded-xl hover:shadow-md transition-shadow text-center">
                    <i class="fas fa-upload text-purple-600 mb-2"></i>
                    <span class="text-sm font-medium">Import</span>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom styles for permissions page */
.permissions-container {
    max-height: 70vh;
    overflow-y: auto;
    overflow-x: auto;
    scrollbar-width: thin;
    scrollbar-color: #cbd5e0 #f7fafc;
}

.permissions-container::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.permissions-container::-webkit-scrollbar-track {
    background: #f7fafc;
    border-radius: 4px;
}

.permissions-container::-webkit-scrollbar-thumb {
    background: #cbd5e0;
    border-radius: 4px;
}

.permissions-container::-webkit-scrollbar-thumb:hover {
    background: #a0aec0;
}

/* Ensure tables are responsive */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const permissionsPage = document.querySelector('.transition-opacity');
    if (permissionsPage) {
        permissionsPage.classList.add('opacity-100');
    }

    // Add smooth scrolling for better UX
    const container = document.querySelector('.permissions-container');
    if (container) {
        container.style.scrollBehavior = 'smooth';
    }
});
</script>
