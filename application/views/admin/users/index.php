<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-2xl shadow-xl ring-1 ring-gray-200/50">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-800">Kelola User</h1>
            <p class="text-lg text-gray-500 mt-2">Manajemen semua user sistem</p>
        </div>
        <a href="<?php echo site_url('admin/users/create'); ?>" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-500 to-blue-600 border border-transparent rounded-2xl font-medium text-sm text-white shadow-sm hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5">
            <i class="fas fa-plus mr-2"></i> Tambah User
        </a>
    </div>

    <!-- Flash Messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="mb-6 p-4 border-l-4 border-green-500 bg-green-50 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                <p class="text-green-800"><?php echo $this->session->flashdata('success'); ?></p>
            </div>
        </div>
    <?php endif; ?>
    
    <?php if ($this->session->flashdata('error')): ?>
        <div class="mb-6 p-4 border-l-4 border-red-500 bg-red-50 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
                <p class="text-red-800"><?php echo $this->session->flashdata('error'); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-white p-5 rounded-2xl shadow-lg ring-1 ring-gray-200/50 flex items-center hover:shadow-xl transition-shadow duration-300">
            <div class="p-4 rounded-full bg-blue-100 text-blue-600 mr-5 shadow-inner">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-gray-800"><?php echo isset($stats['total_users']) ? $stats['total_users'] : 0; ?></h3>
                <p class="text-gray-500 font-medium">Total User</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl shadow-lg ring-1 ring-gray-200/50 flex items-center hover:shadow-xl transition-shadow duration-300">
            <div class="p-4 rounded-full bg-green-100 text-green-600 mr-5 shadow-inner">
                <i class="fas fa-user-check text-xl"></i>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-gray-800"><?php echo isset($stats['active_users']) ? $stats['active_users'] : 0; ?></h3>
                <p class="text-gray-500 font-medium">User Aktif</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl shadow-lg ring-1 ring-gray-200/50 flex items-center hover:shadow-xl transition-shadow duration-300">
            <div class="p-4 rounded-full bg-yellow-100 text-yellow-600 mr-5 shadow-inner">
                <i class="fas fa-user-shield text-xl"></i>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-gray-800"><?php echo isset($stats['admin_users']) ? $stats['admin_users'] : 0; ?></h3>
                <p class="text-gray-500 font-medium">Admin</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl shadow-lg ring-1 ring-gray-200/50 flex items-center hover:shadow-xl transition-shadow duration-300">
            <div class="p-4 rounded-full bg-purple-100 text-purple-600 mr-5 shadow-inner">
                <i class="fas fa-chalkboard-teacher text-xl"></i>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-gray-800"><?php echo isset($stats['teacher_users']) ? $stats['teacher_users'] : 0; ?></h3>
                <p class="text-gray-500 font-medium">Guru</p>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200/50 overflow-hidden mb-8">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Filter Role:</label>
                    <select id="roleFilter" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Role</option>
                        <option value="super_admin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="guru">Guru</option>
                        <option value="siswa">Siswa</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Filter Level:</label>
                    <select id="levelFilter" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Level</option>
                        <option value="1">Level 1 (Super Admin)</option>
                        <option value="2">Level 2 (Admin)</option>
                        <option value="3">Level 3 (Guru)</option>
                        <option value="4">Level 4 (Siswa)</option>
                        <option value="5">Level 5 (User)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status:</label>
                    <select id="statusFilter" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari User:</label>
                    <div class="relative">
                        <input type="text" id="searchUser" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Cari user...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200/50 overflow-hidden">
        <div class="p-6 border-b border-gray-200/50">
            <h2 class="text-2xl font-bold text-gray-800">Daftar User</h2>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Login</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-users text-4xl text-gray-400 mb-3"></i>
                                        <p class="text-lg font-medium text-gray-900 mb-1">Belum ada data user</p>
                                        <p class="text-gray-500">Mulai dengan menambahkan user baru</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($users as $user): ?>
                                <tr class="hover:bg-gray-50" data-role="<?php echo $user->role; ?>" data-level="<?php echo $user->level; ?>" data-status="<?php echo $user->status; ?>">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $no++; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold mr-3">
                                                <?php echo strtoupper(substr($user->nama_lengkap, 0, 1)); ?>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900"><?php echo $user->nama_lengkap; ?></div>
                                                <div class="text-xs text-gray-500"><?php echo $user->department ?: '-'; ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600"><?php echo $user->username; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $user->email; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full <?php 
                                            echo ($user->role == 'super_admin') ? 'bg-red-100 text-red-800' : 
                                                (($user->role == 'admin') ? 'bg-yellow-100 text-yellow-800' : 
                                                (($user->role == 'guru') ? 'bg-indigo-100 text-indigo-800' : 
                                                (($user->role == 'siswa') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800')));
                                        ?>">
                                            <?php echo ucfirst(str_replace('_', ' ', $user->role)); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                            Level <?php echo $user->level; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full <?php echo ($user->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; ?>">
                                            <?php echo $user->status; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php 
                                        if ($user->last_login) {
                                            echo date('d/m/Y H:i', strtotime($user->last_login));
                                        } else {
                                            echo '<span class="text-gray-400">Belum login</span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="<?php echo site_url('admin/users/detail/'.$user->id); ?>" class="text-blue-600 hover:text-blue-900 p-1 rounded-full hover:bg-blue-50" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?php echo site_url('admin/users/edit/'.$user->id); ?>" class="text-indigo-600 hover:text-indigo-900 p-1 rounded-full hover:bg-indigo-50" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <?php if ($user->id != $this->session->userdata('user_id')): ?>
                                                <a href="<?php echo site_url('admin/users/toggle_status/'.$user->id); ?>" 
                                                   class="text-yellow-600 hover:text-yellow-900 p-1 rounded-full hover:bg-yellow-50" 
                                                   title="<?php echo ($user->status == 'Aktif') ? 'Nonaktifkan' : 'Aktifkan'; ?>"
                                                   onclick="return confirm('Apakah Anda yakin ingin mengubah status user ini?')">
                                                    <i class="fas <?php echo ($user->status == 'Aktif') ? 'fa-ban' : 'fa-check'; ?>"></i>
                                                </a>
                                                <?php if ($user->role != 'super_admin'): ?>
                                                    <a href="<?php echo site_url('admin/users/delete/'.$user->id); ?>" 
                                                       class="text-red-600 hover:text-red-900 p-1 rounded-full hover:bg-red-50" 
                                                       title="Hapus"
                                                       onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const materiPage = document.querySelector('.transition-opacity');
    if (materiPage) {
        materiPage.classList.add('opacity-100');
    }

    const roleFilter = document.getElementById('roleFilter');
    const levelFilter = document.getElementById('levelFilter');
    const statusFilter = document.getElementById('statusFilter');
    const searchInput = document.getElementById('searchUser');
    const tableRows = document.querySelectorAll('tbody tr[data-role]');
    
    function filterTable() {
        const selectedRole = roleFilter.value;
        const selectedLevel = levelFilter.value;
        const selectedStatus = statusFilter.value;
        const searchTerm = searchInput.value.toLowerCase();
        
        tableRows.forEach(row => {
            const rowRole = row.getAttribute('data-role');
            const rowLevel = row.getAttribute('data-level');
            const rowStatus = row.getAttribute('data-status');
            const rowText = row.textContent.toLowerCase();
            
            const roleMatch = selectedRole === '' || rowRole === selectedRole;
            const levelMatch = selectedLevel === '' || rowLevel === selectedLevel;
            const statusMatch = selectedStatus === '' || rowStatus === selectedStatus;
            const searchMatch = searchTerm === '' || rowText.includes(searchTerm);
            
            if (roleMatch && levelMatch && statusMatch && searchMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    roleFilter.addEventListener('change', filterTable);
    levelFilter.addEventListener('change', filterTable);
    statusFilter.addEventListener('change', filterTable);
    searchInput.addEventListener('input', filterTable);
});
</script>
