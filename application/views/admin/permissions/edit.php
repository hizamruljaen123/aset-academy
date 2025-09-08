<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-2xl shadow-xl ring-1 ring-gray-200/50">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-800">Edit Permission</h1>
            <p class="text-lg text-gray-500 mt-2">Perbarui hak akses untuk role dan module</p>
        </div>
        <a href="<?php echo site_url('admin/permissions'); ?>" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl font-medium text-sm text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <!-- Permission Form -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
        <div class="p-6 border-b border-gray-200/50">
            <h2 class="text-2xl font-bold text-gray-800">Detail Permission</h2>
        </div>
        <div class="p-6">
            <?php echo form_open('admin/permissions/update/' . $permission->id, 'class="space-y-6"'); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Role</label>
                        <p class="text-lg font-medium">
                            <span class="px-3 py-1 text-sm font-medium rounded-full <?php 
                                echo ($permission->role == 'super_admin') ? 'bg-red-100 text-red-800' : 
                                    (($permission->role == 'admin') ? 'bg-yellow-100 text-yellow-800' : 
                                    (($permission->role == 'guru') ? 'bg-indigo-100 text-indigo-800' : 
                                    (($permission->role == 'siswa') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800')));
                            ?>">
                                <?php echo ucfirst(str_replace('_', ' ', $permission->role)); ?>
                            </span>
                        </p>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Level</label>
                        <p class="text-lg font-medium">
                            <span class="px-3 py-1 text-sm font-medium rounded-full border border-gray-300 text-gray-700">
                                Level <?php echo $permission->level; ?>
                            </span>
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Module</label>
                        <p class="text-lg font-medium text-gray-900"><?php echo ucfirst($permission->module); ?></p>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Action</label>
                        <p class="text-lg font-medium text-gray-900"><?php echo ucfirst($permission->action); ?></p>
                    </div>
                </div>

                <div class="space-y-2 pt-4">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="allowed" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500" <?php echo ($permission->allowed) ? 'checked' : ''; ?>>
                            <span class="ml-2 text-gray-700">Allowed</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="allowed" value="0" class="h-4 w-4 text-blue-600 focus:ring-blue-500" <?php echo (!$permission->allowed) ? 'checked' : ''; ?>>
                            <span class="ml-2 text-gray-700">Denied</span>
                        </label>
                    </div>
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
                    <a href="<?php echo site_url('admin/permissions'); ?>" class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-300 rounded-xl font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editPage = document.querySelector('.transition-opacity');
    if (editPage) {
        editPage.classList.add('opacity-100');
    }
});
</script>
