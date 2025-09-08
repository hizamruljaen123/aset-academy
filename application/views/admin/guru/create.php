<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-lg shadow">
        <div class="mb-4 md:mb-0">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Guru Baru</h1>
            <p class="text-gray-600 mt-1">Buat akun untuk guru baru</p>
        </div>
        <a href="<?php echo site_url('admin_guru'); ?>" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Formulir Guru</h2>
        </div>
        <div class="p-6">
            <?php echo form_open('admin_guru/create', 'class="space-y-6"'); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                               value="<?php echo set_value('nama_lengkap'); ?>" required>
                        <?php echo form_error('nama_lengkap', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                               value="<?php echo set_value('email'); ?>" required>
                        <?php echo form_error('email', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="username" class="block text-sm font-medium text-gray-700">Username <span class="text-red-500">*</span></label>
                        <input type="text" id="username" name="username" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                               value="<?php echo set_value('username'); ?>" required>
                        <?php echo form_error('username', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password <span class="text-red-500">*</span></label>
                        <input type="password" id="password" name="password" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <?php echo form_error('password', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                        <p class="mt-1 text-xs text-gray-500">Minimal 6 karakter.</p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 pt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Guru
                    </button>
                    <button type="reset" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                        <i class="fas fa-undo mr-2"></i>
                        Reset
                    </button>
                    <a href="<?php echo site_url('admin_guru'); ?>" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
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
        const formCard = document.querySelector('.transition-opacity');
        if (formCard) {
            formCard.classList.add('opacity-100');
        }
    });
</script>
