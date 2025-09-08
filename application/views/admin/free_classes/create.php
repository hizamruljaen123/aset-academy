<div class="bg-white rounded-lg shadow-md p-6 mb-6 fade-in">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Kelas Gratis Baru</h2>
        <a href="<?php echo site_url('admin/free_classes'); ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <?php echo form_open_multipart('admin/free_classes/create', ['class' => 'space-y-6']); ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Judul Kelas -->
            <div class="space-y-2">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Kelas <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="<?php echo set_value('title'); ?>" required>
                <?php echo form_error('title', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
            </div>

            <!-- Kategori -->
            <div class="space-y-2">
                <label for="category" class="block text-sm font-medium text-gray-700">Kategori <span class="text-red-500">*</span></label>
                <input type="text" id="category" name="category" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="<?php echo set_value('category'); ?>" required>
                <?php echo form_error('category', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
            </div>

            <!-- Level -->
            <div class="space-y-2">
                <label for="level" class="block text-sm font-medium text-gray-700">Level <span class="text-red-500">*</span></label>
                <select id="level" name="level" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    <option value="Dasar" <?php echo set_select('level', 'Dasar', true); ?>>Dasar</option>
                    <option value="Menengah" <?php echo set_select('level', 'Menengah'); ?>>Menengah</option>
                    <option value="Lanjutan" <?php echo set_select('level', 'Lanjutan'); ?>>Lanjutan</option>
                </select>
                <?php echo form_error('level', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
            </div>

            <!-- Durasi -->
            <div class="space-y-2">
                <label for="duration" class="block text-sm font-medium text-gray-700">Durasi (jam) <span class="text-red-500">*</span></label>
                <input type="number" id="duration" name="duration" min="1" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="<?php echo set_value('duration', '1'); ?>" required>
                <?php echo form_error('duration', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
            </div>

            <!-- Mentor -->
            <div class="space-y-2">
                <label for="mentor_id" class="block text-sm font-medium text-gray-700">Mentor <span class="text-red-500">*</span></label>
                <select id="mentor_id" name="mentor_id" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    <option value="">Pilih Mentor</option>
                    <?php foreach ($mentors as $mentor): ?>
                        <option value="<?php echo $mentor->id; ?>" <?php echo set_select('mentor_id', $mentor->id); ?>><?php echo $mentor->nama_lengkap; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php echo form_error('mentor_id', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
            </div>

            <!-- Maksimal Siswa -->
            <div class="space-y-2">
                <label for="max_students" class="block text-sm font-medium text-gray-700">Maksimal Siswa</label>
                <input type="number" id="max_students" name="max_students" min="1" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="<?php echo set_value('max_students'); ?>">
                <p class="text-xs text-gray-500">Biarkan kosong untuk tidak membatasi jumlah siswa</p>
                <?php echo form_error('max_students', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
            </div>

            <!-- Tanggal Mulai -->
            <div class="space-y-2">
                <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="<?php echo set_value('start_date'); ?>">
                <?php echo form_error('start_date', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
            </div>

            <!-- Tanggal Selesai -->
            <div class="space-y-2">
                <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                <input type="date" id="end_date" name="end_date" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="<?php echo set_value('end_date'); ?>">
                <?php echo form_error('end_date', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
            </div>

            <!-- Status -->
            <div class="space-y-2">
                <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                <select id="status" name="status" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    <option value="Draft" <?php echo set_select('status', 'Draft', true); ?>>Draft</option>
                    <option value="Published" <?php echo set_select('status', 'Published'); ?>>Dipublikasikan</option>
                    <option value="Archived" <?php echo set_select('status', 'Archived'); ?>>Diarsipkan</option>
                </select>
                <?php echo form_error('status', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
            </div>

            <!-- Thumbnail -->
            <div class="space-y-2">
                <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <p class="text-xs text-gray-500">Format: JPG, JPEG, PNG. Maks: 2MB</p>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="space-y-2">
            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi <span class="text-red-500">*</span></label>
            <textarea id="description" name="description" rows="6" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required><?php echo set_value('description'); ?></textarea>
            <?php echo form_error('description', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                <i class="fas fa-save mr-2"></i>
                Simpan Kelas
            </button>
        </div>
    <?php echo form_close(); ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize intersection observer for fade-in elements
        const fadeElements = document.querySelectorAll('.fade-in');
        
        if (fadeElements.length > 0) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('visible');
                        }, 100);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            fadeElements.forEach((element, index) => {
                // Add staggered delay based on element index
                element.style.transitionDelay = `${index * 0.1}s`;
                observer.observe(element);
            });
        }
    });
</script>

<style>
    /* Animation styles */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>
