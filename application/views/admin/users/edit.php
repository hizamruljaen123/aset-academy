<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-2xl shadow-xl ring-1 ring-gray-200/50">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-800">Edit User: <?php echo $user->nama_lengkap; ?></h1>
            <p class="text-lg text-gray-500 mt-2">Perbarui informasi user</p>
        </div>
        <a href="<?php echo site_url('admin/users'); ?>" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl font-medium text-sm text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="mb-6 p-4 border-l-4 border-red-500 bg-red-50 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
                <p class="text-red-800"><?php echo $this->session->flashdata('error'); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- User Form -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8">
        <div class="p-6 border-b border-gray-200/50">
            <h2 class="text-2xl font-bold text-gray-800">Informasi User</h2>
        </div>
        <div class="p-6">
            <?php echo form_open('admin/users/update/' . $user->id, 'class="space-y-6"'); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                               value="<?php echo set_value('nama_lengkap', $user->nama_lengkap); ?>" required>
                        <?php echo form_error('nama_lengkap', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                    <div class="space-y-2">
                        <label for="username" class="block text-sm font-medium text-gray-700">Username <span class="text-red-500">*</span></label>
                        <input type="text" id="username" name="username" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                               value="<?php echo set_value('username', $user->username); ?>" required>
                        <?php echo form_error('username', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                               value="<?php echo set_value('email', $user->email); ?>" required>
                        <?php echo form_error('email', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                        <input type="password" id="password" name="password" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <?php echo form_error('password', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                        <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah password</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label for="role" class="block text-sm font-medium text-gray-700">Role <span class="text-red-500">*</span></label>
                        <select id="role" name="role" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required onchange="updateLevel()">
                            <option value="">Pilih Role</option>
                            <option value="super_admin" <?php echo set_select('role', 'super_admin', $user->role == 'super_admin'); ?>>Super Admin</option>
                            <option value="admin" <?php echo set_select('role', 'admin', $user->role == 'admin'); ?>>Admin</option>
                            <option value="guru" <?php echo set_select('role', 'guru', $user->role == 'guru'); ?>>Guru</option>
                            <option value="siswa" <?php echo set_select('role', 'siswa', $user->role == 'siswa'); ?>>Siswa</option>
                            <option value="user" <?php echo set_select('role', 'user', $user->role == 'user'); ?>>User</option>
                        </select>
                        <?php echo form_error('role', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                    <div class="space-y-2">
                        <label for="level" class="block text-sm font-medium text-gray-700">Level <span class="text-red-500">*</span></label>
                        <select id="level" name="level" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Level</option>
                            <option value="1" <?php echo set_select('level', '1', $user->level == '1'); ?>>Level 1 (Super Admin)</option>
                            <option value="2" <?php echo set_select('level', '2', $user->level == '2'); ?>>Level 2 (Admin)</option>
                            <option value="3" <?php echo set_select('level', '3', $user->level == '3'); ?>>Level 3 (Guru)</option>
                            <option value="4" <?php echo set_select('level', '4', $user->level == '4'); ?>>Level 4 (Siswa)</option>
                            <option value="5" <?php echo set_select('level', '5', $user->level == '5'); ?>>Level 5 (User)</option>
                        </select>
                        <?php echo form_error('level', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                    <div class="space-y-2">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                        <select id="status" name="status" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="Aktif" <?php echo set_select('status', 'Aktif', $user->status == 'Aktif'); ?>>Aktif</option>
                            <option value="Tidak Aktif" <?php echo set_select('status', 'Tidak Aktif', $user->status == 'Tidak Aktif'); ?>>Tidak Aktif</option>
                        </select>
                        <?php echo form_error('status', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                    <input type="text" id="department" name="department" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           value="<?php echo set_value('department', $user->department); ?>" placeholder="Contoh: IT, Marketing, HR">
                    <?php echo form_error('department', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    <p class="mt-1 text-xs text-gray-500">Opsional - untuk organisasi internal</p>
                </div>

                <div class="flex flex-wrap gap-3 pt-6 border-t border-gray-200/50 mt-6">
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 border border-transparent rounded-xl font-medium text-sm text-white shadow-sm hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                    <button type="reset" class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-300 rounded-xl font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <i class="fas fa-undo mr-2"></i>
                        Reset
                    </button>
                    <a href="<?php echo site_url('admin/users'); ?>" class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-300 rounded-xl font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
function updateLevel() {
    const roleSelect = document.getElementById('role');
    const levelSelect = document.getElementById('level');
    const selectedRole = roleSelect.value;
    
    // Clear current selection
    levelSelect.value = '';
    
    // Auto-select appropriate level based on role
    const roleLevelMap = {
        'super_admin': '1',
        'admin': '2',
        'guru': '3',
        'siswa': '4',
        'user': '5'
    };
    
    if (roleLevelMap[selectedRole]) {
        levelSelect.value = roleLevelMap[selectedRole];
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const materiPage = document.querySelector('.transition-opacity');
    if (materiPage) {
        materiPage.classList.add('opacity-100');
    }
});
</script>
