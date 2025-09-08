<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-2xl shadow-xl ring-1 ring-gray-200/50">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-800">Detail User: <?php echo $user->nama_lengkap; ?></h1>
            <p class="text-lg text-gray-500 mt-2">Informasi lengkap user</p>
        </div>
        <a href="<?php echo site_url('admin/users'); ?>" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl font-medium text-sm text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <!-- User Card -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
        <div class="p-6 border-b border-gray-200/50">
            <h2 class="text-2xl font-bold text-gray-800">Profil User</h2>
        </div>
        <div class="p-6">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- User Avatar -->
                <div class="flex-shrink-0">
                    <div class="h-32 w-32 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-4xl font-bold">
                        <?php echo strtoupper(substr($user->nama_lengkap, 0, 1)); ?>
                    </div>
                </div>
                
                <!-- User Details -->
                <div class="flex-1">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                            <p class="text-lg font-medium text-gray-900"><?php echo $user->nama_lengkap; ?></p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Username</p>
                            <p class="text-lg font-medium text-blue-600"><?php echo $user->username; ?></p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p class="text-lg font-medium text-gray-900"><?php echo $user->email; ?></p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Role</p>
                            <span class="px-3 py-1 text-sm font-medium rounded-full <?php 
                                echo ($user->role == 'super_admin') ? 'bg-red-100 text-red-800' : 
                                    (($user->role == 'admin') ? 'bg-yellow-100 text-yellow-800' : 
                                    (($user->role == 'guru') ? 'bg-indigo-100 text-indigo-800' : 
                                    (($user->role == 'siswa') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800')));
                            ?>">
                                <?php echo ucfirst(str_replace('_', ' ', $user->role)); ?>
                            </span>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Level</p>
                            <span class="px-3 py-1 text-sm font-medium rounded-full bg-gray-100 text-gray-800">
                                Level <?php echo $user->level; ?>
                            </span>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Status</p>
                            <span class="px-3 py-1 text-sm font-medium rounded-full <?php echo ($user->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; ?>">
                                <?php echo $user->status; ?>
                            </span>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Department</p>
                            <p class="text-lg font-medium text-gray-900"><?php echo $user->department ?: '-'; ?></p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Terakhir Login</p>
                            <p class="text-lg font-medium text-gray-900">
                                <?php 
                                if ($user->last_login) {
                                    echo date('d/m/Y H:i', strtotime($user->last_login));
                                } else {
                                    echo '<span class="text-gray-400">Belum login</span>';
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const detailPage = document.querySelector('.transition-opacity');
    if (detailPage) {
        detailPage.classList.add('opacity-100');
    }
});
</script>
