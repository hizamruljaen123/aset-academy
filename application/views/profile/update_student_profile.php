<div class="p-4 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Header with gradient background -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl text-white">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold">Update Profil</h1>
            <p class="text-blue-100 mt-2">Perbarui informasi profil Anda</p>
        </div>
        <a href="<?php echo site_url('profile/view'); ?>" class="inline-flex items-center px-4 py-2 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Profil
        </a>
    </div>

    <!-- Alert Messages -->
    <?php if (validation_errors()): ?>
        <div class="mb-6 p-4 rounded-lg bg-red-50 border-l-4 border-red-500 flex items-center fade-in">
            <div class="rounded-full bg-red-100 p-2 mr-3">
                <i class="fas fa-exclamation-circle text-red-600"></i>
            </div>
            <div class="flex-1 text-red-700">
                <?php echo validation_errors(); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Update Profile Form -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
        <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
            <h2 class="text-2xl font-bold text-gray-800">Informasi Pribadi</h2>
            <p class="text-gray-500 mt-1">Perbarui informasi pribadi Anda</p>
        </div>
        <div class="p-6">
            <?php echo form_open('profile/update', ['class' => 'space-y-6']); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Lengkap -->
                    <div class="space-y-2">
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-lg py-2" placeholder="Masukkan nama lengkap" value="<?php echo set_value('nama_lengkap', isset($user->nama_lengkap) ? $user->nama_lengkap : ''); ?>" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" id="email" name="email" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-lg py-2" placeholder="Masukkan email" value="<?php echo set_value('email', isset($user->email) ? $user->email : ''); ?>" required>
                        </div>
                    </div>

                    <!-- No Telepon -->
                    <div class="space-y-2">
                        <label for="no_telepon" class="block text-sm font-medium text-gray-700">No. Telepon <span class="text-red-500">*</span></label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone-alt text-gray-400"></i>
                            </div>
                            <input type="text" id="no_telepon" name="no_telepon" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-lg py-2" placeholder="Masukkan nomor telepon" value="<?php echo set_value('no_telepon', isset($profile->no_telepon) ? $profile->no_telepon : ''); ?>" required>
                        </div>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="space-y-2">
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar-alt text-gray-400"></i>
                            </div>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-lg py-2" value="<?php echo set_value('tanggal_lahir', isset($profile->tanggal_lahir) ? $profile->tanggal_lahir : ''); ?>" required>
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <div class="flex space-x-4">
                            <div class="flex items-center">
                                <input id="jenis_kelamin_l" name="jenis_kelamin" type="radio" value="L" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300" <?php echo set_radio('jenis_kelamin', 'L', isset($profile->jenis_kelamin) && $profile->jenis_kelamin == 'L'); ?> required>
                                <label for="jenis_kelamin_l" class="ml-2 block text-sm text-gray-700">Laki-laki</label>
                            </div>
                            <div class="flex items-center">
                                <input id="jenis_kelamin_p" name="jenis_kelamin" type="radio" value="P" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300" <?php echo set_radio('jenis_kelamin', 'P', isset($profile->jenis_kelamin) && $profile->jenis_kelamin == 'P'); ?> required>
                                <label for="jenis_kelamin_p" class="ml-2 block text-sm text-gray-700">Perempuan</label>
                            </div>
                        </div>
                    </div>

                    <?php if (!$profile_exists): ?>
                    <!-- Kelas (only shown if profile doesn't exist) -->
                    <div class="space-y-2">
                        <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-graduation-cap text-gray-400"></i>
                            </div>
                            <select id="kelas" name="kelas" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-lg py-2">
                                <option value="">Pilih Kelas</option>
                                <?php if (isset($available_classes)): ?>
                                    <?php foreach($available_classes as $kelas): ?>
                                        <option value="<?php echo $kelas->nama_kelas; ?>" <?php echo set_select('kelas', $kelas->nama_kelas); ?>><?php echo $kelas->nama_kelas; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Jurusan (only shown if profile doesn't exist) -->
                    <div class="space-y-2">
                        <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-code-branch text-gray-400"></i>
                            </div>
                            <input type="text" id="jurusan" name="jurusan" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-lg py-2" placeholder="Masukkan jurusan" value="<?php echo set_value('jurusan'); ?>">
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Alamat -->
                    <div class="md:col-span-2 space-y-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat <span class="text-red-500">*</span></label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                            <textarea id="alamat" name="alamat" rows="3" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-lg py-2" placeholder="Masukkan alamat lengkap" required><?php echo set_value('alamat', isset($profile->alamat) ? $profile->alamat : ''); ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 border-t border-gray-200 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fade in main container
        const container = document.querySelector('.transition-opacity');
        if (container) {
            container.classList.add('opacity-100');
        }
        
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
    
    /* Input focus effects */
    input:focus, select:focus, textarea:focus {
        transform: scale(1.01);
        transition: all 0.2s ease;
    }
    
    /* Button hover effects */
    button, a {
        transition: all 0.3s ease;
    }
</style>
