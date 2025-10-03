<div class="p-4 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Header with gradient background -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl text-white">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold">Edit Profil</h1>
            <p class="text-blue-100 mt-2">Lengkapi informasi profil Anda</p>
        </div>
        <a href="<?php echo site_url('student/profile'); ?>" class="inline-flex items-center px-4 py-2 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Profil
        </a>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="mb-6 p-4 rounded-lg bg-green-50 border-l-4 border-green-500 flex items-center fade-in">
            <div class="rounded-full bg-green-100 p-2 mr-3">
                <i class="fas fa-check-circle text-green-600"></i>
            </div>
            <div class="flex-1 text-green-700">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="mb-6 p-4 rounded-lg bg-red-50 border-l-4 border-red-500 flex items-center fade-in">
            <div class="rounded-full bg-red-100 p-2 mr-3">
                <i class="fas fa-exclamation-circle text-red-600"></i>
            </div>
            <div class="flex-1 text-red-700">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                <h2 class="text-2xl font-bold text-gray-800">Form Edit Profil</h2>
                <p class="text-gray-500 mt-1">Lengkapi semua informasi yang diperlukan</p>
            </div>

            <div class="p-6">
                <?php echo form_open('student/profile/update', ['class' => 'space-y-8']); ?>

                <!-- Informasi Pribadi -->
                <div class="border-b border-gray-200 pb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-user mr-2 text-blue-600"></i>
                        Informasi Pribadi
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Lengkap -->
                        <div class="space-y-2">
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" id="nama_lengkap" name="nama_lengkap"
                                       value="<?php echo isset($student->nama_lengkap) ? $student->nama_lengkap : ''; ?>"
                                       class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 sm:text-sm border-gray-300 rounded-lg py-3"
                                       placeholder="Masukkan nama lengkap" required>
                            </div>
                            <?php echo form_error('nama_lengkap', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                        </div>

                        <!-- NIS (Disabled) -->
                        <div class="space-y-2">
                            <label for="nis" class="block text-sm font-medium text-gray-700">
                                NIS (Nomor Induk Siswa) <span class="text-xs text-gray-500 font-normal">(Tidak dapat diubah)</span>
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-id-card text-gray-400"></i>
                                </div>
                                <input type="text" id="nis" name="nis"
                                       value="<?php echo isset($student->nis) ? $student->nis : ''; ?>"
                                       class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 sm:text-sm border-gray-300 rounded-lg py-3 bg-gray-100 text-gray-500 cursor-not-allowed"
                                       placeholder="Masukkan NIS" readonly disabled>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">NIS dikelola oleh sistem dan tidak dapat diubah oleh siswa</p>
                            <input type="hidden" name="nis" value="<?php echo isset($student->nis) ? $student->nis : ''; ?>">
                        </div>

                        <!-- Email (Readonly) -->
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input type="email" id="email" name="email"
                                       value="<?php echo isset($student->email) ? $student->email : ''; ?>"
                                       class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 sm:text-sm border-gray-300 rounded-lg py-3"
                                       placeholder="Masukkan email" readonly>
                                <p class="mt-1 text-xs text-gray-500">Email tidak dapat diubah</p>
                            </div>
                        </div>

                        <!-- No Telepon -->
                        <div class="space-y-2">
                            <label for="no_telepon" class="block text-sm font-medium text-gray-700">
                                No. Telepon
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone text-gray-400"></i>
                                </div>
                                <input type="text" id="no_telepon" name="no_telepon"
                                       value="<?php echo isset($student->no_telepon) ? $student->no_telepon : ''; ?>"
                                       class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 sm:text-sm border-gray-300 rounded-lg py-3"
                                       placeholder="Masukkan no telepon">
                            </div>
                            <?php echo form_error('no_telepon', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="space-y-2">
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">
                                Tanggal Lahir
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar-alt text-gray-400"></i>
                                </div>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                       value="<?php echo isset($student->tanggal_lahir) ? $student->tanggal_lahir : ''; ?>"
                                       class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 sm:text-sm border-gray-300 rounded-lg py-3">
                            </div>
                            <?php echo form_error('tanggal_lahir', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="space-y-2">
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">
                                Jenis Kelamin
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <select id="jenis_kelamin" name="jenis_kelamin"
                                        class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 pr-10 py-3 text-sm border-gray-300 rounded-lg">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="L" <?php echo (isset($student->jenis_kelamin) && $student->jenis_kelamin == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="P" <?php echo (isset($student->jenis_kelamin) && $student->jenis_kelamin == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                            <?php echo form_error('jenis_kelamin', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                        </div>
                    </div>

                <!-- Informasi Akademik -->
                <div class="border-b border-gray-200 pb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-graduation-cap mr-2 text-green-600"></i>
                        Informasi Akademik
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kelas -->
                        <div class="space-y-2">
                            <label for="kelas" class="block text-sm font-medium text-gray-700">
                                Kelas/Semester ke
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-school text-gray-400"></i>
                                </div>
                                <input type="text" id="kelas" name="kelas"
                                       value="<?php echo isset($student->kelas) ? $student->kelas : ''; ?>"
                                       class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 sm:text-sm border-gray-300 rounded-lg py-3"
                                       placeholder="Contoh: XII RPL 1">
                            </div>
                            <?php echo form_error('kelas', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                        </div>

                        <!-- Jurusan -->
                        <div class="space-y-2">
                            <label for="jurusan" class="block text-sm font-medium text-gray-700">
                                Jurusan/ Prodi
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-code-branch text-gray-400"></i>
                                </div>
                                <input type="text" id="jurusan" name="jurusan"
                                       value="<?php echo isset($student->jurusan) ? $student->jurusan : ''; ?>"
                                       class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 sm:text-sm border-gray-300 rounded-lg py-3"
                                       placeholder="Contoh: Rekayasa Perangkat Lunak">
                            </div>
                            <?php echo form_error('jurusan', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div class="pb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-purple-600"></i>
                        Informasi Tambahan
                    </h3>

                    <div class="space-y-6">
                        <!-- Alamat -->
                        <div class="space-y-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-700">
                                Alamat Lengkap
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute top-3 left-3 pointer-events-none">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                </div>
                                <textarea id="alamat" name="alamat" rows="4"
                                          class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 sm:text-sm border-gray-300 rounded-lg py-3"
                                          placeholder="Masukkan alamat lengkap"><?php echo isset($student->alamat) ? $student->alamat : ''; ?></textarea>
                            </div>
                            <?php echo form_error('alamat', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                    <a href="<?php echo site_url('student/profile'); ?>"
                       class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fade in main container
        const profileContainer = document.querySelector('.transition-opacity');
        if (profileContainer) {
            profileContainer.classList.add('opacity-100');
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

        // Add hover effects to input fields
        const inputs = document.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-blue-500', 'ring-opacity-50');
            });
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-blue-500', 'ring-opacity-50');
            });
        });
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

    /* Focus effects */
    .ring-2.ring-blue-500.ring-opacity-50 {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Button hover effects */
    button, a {
        transition: all 0.3s ease;
    }

    /* Custom scrollbar for textarea */
    textarea::-webkit-scrollbar {
        width: 6px;
    }

    textarea::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }

    textarea::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    textarea::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
