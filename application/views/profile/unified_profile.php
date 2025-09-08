<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="p-4 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Header with gradient background -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl text-white">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold">Profil <?php echo ($this->permission->is_student()) ? 'Siswa' : ($this->permission->is_teacher() ? 'Guru' : 'Admin'); ?></h1>
            <p class="text-blue-100 mt-2">Kelola informasi profil dan akun Anda</p>
        </div>
        <a href="<?php echo site_url($this->permission->is_student() ? 'student' : ($this->permission->is_teacher() ? 'teacher' : 'dashboard')); ?>" class="inline-flex items-center px-4 py-2 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Dashboard
        </a>
    </div>

    <!-- Alert Messages -->
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Card -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold text-gray-800">Informasi Pribadi</h2>
                        <a href="<?php echo site_url('profile/update'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-transform hover:scale-105">
                            <i class="fas fa-user-edit mr-2"></i>
                            Edit Profil
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                        <div class="h-24 w-24 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-3xl shadow-lg">
                            <?php echo !empty($user->nama_lengkap) ? strtoupper(substr($user->nama_lengkap, 0, 1)) : 'U'; ?>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 mb-2"><?php echo $user->nama_lengkap; ?></h3>
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mb-4">
                                <?php echo $user->email; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                        <!-- Common Fields -->
                        <div class="flex items-center bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:bg-gray-100">
                            <div class="rounded-full bg-blue-100 p-2 mr-3">
                                <i class="fas fa-id-card text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Nama Lengkap</p>
                                <p class="font-medium"><?php echo $user->nama_lengkap; ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-center bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:bg-gray-100">
                            <div class="rounded-full bg-indigo-100 p-2 mr-3">
                                <i class="fas fa-envelope text-indigo-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Email</p>
                                <p class="font-medium"><?php echo $user->email; ?></p>
                            </div>
                        </div>
                        
                        <!-- Student Specific Fields -->
                        <?php if ($this->permission->is_student() && isset($profile)): ?>
                            <div class="flex items-center bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:bg-gray-100">
                                <div class="rounded-full bg-purple-100 p-2 mr-3">
                                    <i class="fas fa-graduation-cap text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Kelas</p>
                                    <p class="font-medium"><?php echo isset($profile->kelas) ? $profile->kelas : 'Belum terdaftar'; ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-center bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:bg-gray-100">
                                <div class="rounded-full bg-green-100 p-2 mr-3">
                                    <i class="fas fa-code-branch text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Jurusan</p>
                                    <p class="font-medium"><?php echo isset($profile->jurusan) ? $profile->jurusan : 'Belum terdaftar'; ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Teacher Specific Fields -->
                        <?php if ($this->permission->is_teacher()): ?>
                            <div class="flex items-center bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:bg-gray-100">
                                <div class="rounded-full bg-yellow-100 p-2 mr-3">
                                    <i class="fas fa-chalkboard-teacher text-yellow-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Kelas Diampu</p>
                                    <p class="font-medium"><?php echo isset($kelas_count) ? $kelas_count : '0'; ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Admin Specific Fields -->
                        <?php if ($this->permission->is_admin()): ?>
                            <div class="flex items-center bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:bg-gray-100">
                                <div class="rounded-full bg-red-100 p-2 mr-3">
                                    <i class="fas fa-user-shield text-red-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Level Akses</p>
                                    <p class="font-medium"><?php echo isset($user->level) ? 'Level ' . $user->level : 'Super Admin'; ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Common Status Field -->
                        <div class="flex items-center bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:bg-gray-100">
                            <div class="rounded-full bg-green-100 p-2 mr-3">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Status</p>
                                <p class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium <?php echo ($user->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                    <?php echo $user->status; ?>
                                </p>
                            </div>
                        </div>
                    </div>
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
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg transition-all duration-300 hover:bg-gray-100">
                            <div class="flex items-center">
                                <div class="rounded-full bg-blue-100 p-2 mr-3">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Username</p>
                                    <p class="font-medium"><?php echo $user->username; ?></p>
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
                                        <?php echo ucfirst($user->role); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <?php if (isset($user->level)): ?>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg transition-all duration-300 hover:bg-gray-100">
                            <div class="flex items-center">
                                <div class="rounded-full bg-purple-100 p-2 mr-3">
                                    <i class="fas fa-layer-group text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Level</p>
                                    <p class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                        Level <?php echo $user->level; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg transition-all duration-300 hover:bg-gray-100">
                            <div class="flex items-center">
                                <div class="rounded-full bg-blue-100 p-2 mr-3">
                                    <i class="fas fa-clock text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Login Terakhir</p>
                                    <p class="font-medium">
                                        <?php 
                                        if (isset($user->last_login) && $user->last_login) {
                                            echo date('d F Y H:i', strtotime($user->last_login));
                                        } else {
                                            echo 'Belum pernah login';
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change Password -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-2xl font-bold text-gray-800">Ubah Password</h2>
                </div>
                <div class="p-6">
                    <?php echo form_open('profile/change_password', ['class' => 'space-y-4']); ?>
                        <div class="space-y-2">
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" id="current_password" name="current_password" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-lg py-2" placeholder="Masukkan password saat ini" required>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="new_password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-key text-gray-400"></i>
                                </div>
                                <input type="password" id="new_password" name="new_password" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-lg py-2" placeholder="Masukkan password baru" required>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="confirm_password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-check-circle text-gray-400"></i>
                                </div>
                                <input type="password" id="confirm_password" name="confirm_password" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-lg py-2" placeholder="Konfirmasi password baru" required>
                            </div>
                        </div>
                        
                        <div class="pt-4">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
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
