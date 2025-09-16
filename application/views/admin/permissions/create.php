<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-2xl shadow-xl ring-1 ring-gray-200/50">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-800">Tambah Permission Baru</h1>
            <p class="text-lg text-gray-500 mt-2">Buat hak akses baru untuk role dan module tertentu</p>
        </div>
        <a href="<?php echo site_url('admin/permissions'); ?>" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl font-medium text-sm text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
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

    <!-- Permission Form -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
        <div class="p-6 border-b border-gray-200/50">
            <h2 class="text-2xl font-bold text-gray-800">Form Permission Baru</h2>
        </div>
        <div class="p-6">
            <?php echo form_open('admin/permissions/store', 'class="space-y-6"'); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="role" class="block text-sm font-medium text-gray-700">Role <span class="text-red-500">*</span></label>
                        <select name="role" id="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                            <option value="">Pilih Role</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?php echo $role; ?>"><?php echo ucfirst(str_replace('_', ' ', $role)); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="level" class="block text-sm font-medium text-gray-700">Level <span class="text-red-500">*</span></label>
                        <select name="level" id="level" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                            <option value="">Pilih Level</option>
                            <?php foreach ($levels as $level): ?>
                                <option value="<?php echo $level; ?>">Level <?php echo $level; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="module" class="block text-sm font-medium text-gray-700">Module <span class="text-red-500">*</span></label>
                        <select name="module" id="module" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                            <option value="">Pilih Module</option>
                            <?php foreach ($modules as $module): ?>
                                <option value="<?php echo $module; ?>"><?php echo ucfirst($module); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="action" class="block text-sm font-medium text-gray-700">Action <span class="text-red-500">*</span></label>
                        <select name="action" id="action" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                            <option value="">Pilih Action</option>
                            <?php foreach ($actions as $action): ?>
                                <option value="<?php echo $action; ?>"><?php echo ucfirst($action); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="space-y-2 pt-4">
                    <label class="block text-sm font-medium text-gray-700">Status Permission</label>
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="allowed" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500" checked>
                            <span class="ml-2 text-gray-700">Allowed (Diizinkan)</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="allowed" value="0" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-700">Denied (Ditolak)</span>
                        </label>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Pilih apakah role ini diizinkan atau ditolak untuk melakukan action pada module tersebut</p>
                </div>

                <div class="flex flex-wrap gap-3 pt-6 border-t border-gray-200/50 mt-6">
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 border border-transparent rounded-xl font-medium text-sm text-white shadow-sm hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Permission
                    </button>
                    <button type="reset" class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-300 rounded-xl font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <i class="fas fa-undo mr-2"></i>
                        Reset Form
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
    const createPage = document.querySelector('.transition-opacity');
    if (createPage) {
        createPage.classList.add('opacity-100');
    }
});
</script>