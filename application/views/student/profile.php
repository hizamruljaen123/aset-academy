<div class="p-4 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Header with gradient background -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl text-white">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold">Profil Siswa</h1>
            <p class="text-blue-100 mt-2">Kelola informasi profil dan akun Anda</p>
        </div>
        <a href="<?php echo site_url('student'); ?>" class="inline-flex items-center px-4 py-2 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Dashboard
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
    
    <?php if (isset($profile_exists) && !$profile_exists): ?>
        <div class="mb-6 p-4 rounded-lg bg-yellow-50 border-l-4 border-yellow-500 flex items-center fade-in">
            <div class="rounded-full bg-yellow-100 p-2 mr-3">
                <i class="fas fa-exclamation-triangle text-yellow-600"></i>
            </div>
            <div class="flex-1 text-yellow-700">
                <p class="font-bold">Profil Belum Lengkap!</p>
                <p>Data siswa Anda belum terdaftar dalam sistem. Silakan hubungi administrator untuk melengkapi profil Anda.</p>
            </div>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Card -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-2xl font-bold text-gray-800">Informasi Pribadi</h2>
                </div>
                <div class="p-6">
                    <?php if (isset($student) && $student): ?>
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                            <div class="h-24 w-24 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-3xl shadow-lg">
                                <?php echo !empty($student->nama_lengkap) ? strtoupper(substr($student->nama_lengkap, 0, 1)) : 'S'; ?>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900 mb-2"><?php echo $student->nama_lengkap; ?></h3>
                                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mb-4">
                                    <?php echo $student->email; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                            <div class="flex items-center bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:bg-gray-100">
                                <div class="rounded-full bg-blue-100 p-2 mr-3">
                                    <i class="fas fa-id-card text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">NIS</p>
                                    <p class="font-medium"><?php echo $student->nis; ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-center bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:bg-gray-100">
                                <div class="rounded-full bg-indigo-100 p-2 mr-3">
                                    <i class="fas fa-graduation-cap text-indigo-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Kelas</p>
                                    <p class="font-medium"><?php echo $student->kelas; ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-center bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:bg-gray-100">
                                <div class="rounded-full bg-purple-100 p-2 mr-3">
                                    <i class="fas fa-code-branch text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Jurusan</p>
                                    <p class="font-medium"><?php echo $student->jurusan; ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-center bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:bg-gray-100">
                                <div class="rounded-full bg-green-100 p-2 mr-3">
                                    <i class="fas fa-check-circle text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Status</p>
                                    <p class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium <?php echo ($student->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                        <?php echo $student->status; ?>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-center bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:bg-gray-100">
                                <div class="rounded-full bg-blue-100 p-2 mr-3">
                                    <i class="fas fa-calendar-alt text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Tanggal Daftar</p>
                                    <p class="font-medium">
                                        <?php 
                                        if (!empty($student->created_at)) {
                                            echo date('d F Y', strtotime($student->created_at));
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            
                            <?php if (isset($profile_exists) && !$profile_exists): ?>
                            <div class="sm:col-span-2 flex items-center justify-center p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                                <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-transform hover:scale-105">
                                    <i class="fas fa-user-edit mr-2"></i>
                                    Lengkapi Profil
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="flex flex-col items-center justify-center py-12">
                            <div class="rounded-full bg-gray-100 p-6 mb-4">
                                <i class="fas fa-user-slash text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-900 mb-1">Data tidak ditemukan</h3>
                            <p class="text-gray-500">Profil siswa tidak dapat ditemukan</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Account Information -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-2xl font-bold text-gray-800">Informasi Akun</h2>
                </div>
                <div class="p-6">
                    <?php if (isset($student) && $student): ?>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg transition-all duration-300 hover:bg-gray-100">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-blue-100 p-2 mr-3">
                                        <i class="fas fa-user text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Username</p>
                                        <p class="font-medium"><?php echo isset($student->username) ? $student->username : '-'; ?></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg transition-all duration-300 hover:bg-gray-100">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-indigo-100 p-2 mr-3">
                                        <i class="fas fa-user-tag text-indigo-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Role</p>
                                        <p class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                            <?php echo isset($student->role) ? ucfirst($student->role) : 'Siswa'; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if (isset($student->level)): ?>
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg transition-all duration-300 hover:bg-gray-100">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-purple-100 p-2 mr-3">
                                        <i class="fas fa-layer-group text-purple-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Level</p>
                                        <p class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                            Level <?php echo $student->level; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg transition-all duration-300 hover:bg-gray-100">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-green-100 p-2 mr-3">
                                        <i class="fas fa-shield-alt text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Status Akun</p>
                                        <p class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium <?php echo (isset($student->status) && $student->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                            <?php echo isset($student->status) ? $student->status : 'Tidak Aktif'; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg transition-all duration-300 hover:bg-gray-100">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-blue-100 p-2 mr-3">
                                        <i class="fas fa-clock text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Login Terakhir</p>
                                        <p class="font-medium">
                                            <?php 
                                            if (isset($student->last_login) && $student->last_login) {
                                                echo date('d F Y H:i', strtotime($student->last_login));
                                            } else {
                                                echo 'Belum pernah login';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="flex flex-col items-center justify-center py-12">
                            <div class="rounded-full bg-gray-100 p-6 mb-4">
                                <i class="fas fa-user-slash text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-900 mb-1">Data tidak ditemukan</h3>
                            <p class="text-gray-500">Informasi akun tidak dapat ditemukan</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Change Password -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-2xl font-bold text-gray-800">Ubah Password</h2>
                    <p class="text-gray-500 mt-1">Untuk keamanan akun Anda</p>
                </div>
                <div class="p-6">
                    <?php echo form_open('student/change_password', ['class' => 'space-y-6']); ?>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label for="current_password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input type="password" id="current_password" name="current_password" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-lg py-3" placeholder="Masukkan password saat ini" required>
                                </div>
                                <?php echo form_error('current_password', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                            </div>
                            
                            <div class="space-y-2">
                                <label for="new_password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-key text-gray-400"></i>
                                    </div>
                                    <input type="password" id="new_password" name="new_password" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-lg py-3" placeholder="Masukkan password baru" required>
                                </div>
                                <?php echo form_error('new_password', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                            </div>
                            
                            <div class="space-y-2">
                                <label for="confirm_password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-check-circle text-gray-400"></i>
                                    </div>
                                    <input type="password" id="confirm_password" name="confirm_password" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-lg py-3" placeholder="Konfirmasi password baru" required>
                                </div>
                                <?php echo form_error('confirm_password', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                            </div>
                        </div>
                        
                        <div class="pt-4 border-t border-gray-200 flex justify-end space-x-3">
                            <button type="reset" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                <i class="fas fa-undo mr-2"></i>
                                Reset
                            </button>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                                <i class="fas fa-save mr-2"></i>
                                Ubah Password
                            </button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
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
        
        // Add hover effects to cards
        const cards = document.querySelectorAll('.bg-gray-50');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.classList.add('shadow-md');
            });
            card.addEventListener('mouseleave', function() {
                this.classList.remove('shadow-md');
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
    
    /* Card hover effects */
    .bg-gray-50 {
        transition: all 0.3s ease;
    }
    
    /* Button hover effects */
    button, a {
        transition: all 0.3s ease;
    }
    
    /* Input focus effects */
    input:focus {
        transform: scale(1.01);
        transition: all 0.2s ease;
    }
</style>
