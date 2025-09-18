<div class="space-y-4">
    <!-- Profile Header -->
    <div class="mobile-card">
        <div class="flex flex-col items-center text-center py-4">
            <div class="mobile-avatar mb-3">
                <?php if (isset($student->nama_lengkap)): ?>
                    <?php echo strtoupper(substr($student->nama_lengkap, 0, 1)); ?>
                <?php else: ?>
                    U
                <?php endif; ?>
            </div>
            <h2 class="text-xl font-bold text-gray-900"><?php echo isset($student->nama_lengkap) ? $student->nama_lengkap : 'Nama Siswa'; ?></h2>
            <p class="text-sm text-gray-500"><?php echo isset($student->email) ? $student->email : 'email@example.com'; ?></p>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?php echo isset($student->status) && $student->status == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                <?php echo isset($student->status) ? $student->status : 'Aktif'; ?>
            </span>
        </div>
    </div>

    <!-- Profile Information -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Profil</h3>
        
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i data-feather="id-card" class="w-5 h-5 text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">NIS</p>
                        <p class="text-base font-medium text-gray-900"><?php echo isset($student->nis) ? $student->nis : 'Belum terdaftar'; ?></p>
                    </div>
                </div>
                <button class="text-blue-600">
                    <i data-feather="edit-2" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <i data-feather="users" class="w-5 h-5 text-indigo-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Kelas</p>
                        <p class="text-base font-medium text-gray-900"><?php echo isset($student->kelas) ? $student->kelas : 'Belum terdaftar'; ?></p>
                    </div>
                </div>
                <button class="text-blue-600">
                    <i data-feather="edit-2" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i data-feather="briefcase" class="w-5 h-5 text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jurusan</p>
                        <p class="text-base font-medium text-gray-900"><?php echo isset($student->jurusan) ? $student->jurusan : 'Belum terdaftar'; ?></p>
                    </div>
                </div>
                <button class="text-blue-600">
                    <i data-feather="edit-2" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <i data-feather="phone" class="w-5 h-5 text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">No. Telepon</p>
                        <p class="text-base font-medium text-gray-900"><?php echo isset($student->no_telepon) ? $student->no_telepon : '-'; ?></p>
                    </div>
                </div>
                <button class="text-blue-600">
                    <i data-feather="edit-2" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i data-feather="map-pin" class="w-5 h-5 text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Alamat</p>
                        <p class="text-base font-medium text-gray-900"><?php echo isset($student->alamat) ? $student->alamat : '-'; ?></p>
                    </div>
                </div>
                <button class="text-blue-600">
                    <i data-feather="edit-2" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <i data-feather="calendar" class="w-5 h-5 text-red-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Lahir</p>
                        <p class="text-base font-medium text-gray-900"><?php echo isset($student->tanggal_lahir) ? date('d F Y', strtotime($student->tanggal_lahir)) : '-'; ?></p>
                    </div>
                </div>
                <button class="text-blue-600">
                    <i data-feather="edit-2" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center">
                        <i data-feather="user" class="w-5 h-5 text-pink-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jenis Kelamin</p>
                        <p class="text-base font-medium text-gray-900"><?php echo isset($student->jenis_kelamin) ? $student->jenis_kelamin : '-'; ?></p>
                    </div>
                </div>
                <button class="text-blue-600">
                    <i data-feather="edit-2" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Account Settings -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Pengaturan Akun</h3>
        
        <div class="space-y-3">
            <button class="w-full flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i data-feather="lock" class="w-4 h-4 text-blue-600"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Ganti Password</span>
                </div>
                <i data-feather="chevron-right" class="w-4 h-4 text-gray-400"></i>
            </button>

            <button class="w-full flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <i data-feather="bell" class="w-4 h-4 text-indigo-600"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Notifikasi</span>
                </div>
                <i data-feather="chevron-right" class="w-4 h-4 text-gray-400"></i>
            </button>

            <button class="w-full flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i data-feather="shield" class="w-4 h-4 text-purple-600"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Privasi</span>
                </div>
                <i data-feather="chevron-right" class="w-4 h-4 text-gray-400"></i>
            </button>
        </div>
    </div>

    <!-- Profile Completion Status -->
    <?php if (isset($profile_exists) && !$profile_exists): ?>
    <div class="mobile-card bg-yellow-50 border border-yellow-200">
        <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <i data-feather="alert-circle" class="w-4 h-4 text-yellow-600"></i>
            </div>
            <div class="flex-1">
                <h4 class="text-sm font-medium text-gray-900 mb-1">Profil Belum Lengkap</h4>
                <p class="text-xs text-gray-600 mb-3">Silakan lengkapi informasi profil Anda untuk mendapatkan pengalaman belajar yang lebih baik.</p>
                <button onclick="location.href='<?= site_url('profile/update_student_profile') ?>'" class="mobile-btn bg-yellow-600 text-white text-sm">
                    Lengkapi Profil
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Action Buttons -->
    <div class="space-y-3">
        <button class="mobile-btn w-full bg-blue-600 text-white">
            <i data-feather="save" class="w-4 h-4 inline mr-2"></i>
            Simpan Perubahan
        </button>
        
        <button onclick="if(confirm('Apakah Anda yakin ingin keluar?')) { location.href='<?= site_url('auth/logout') ?>'; }" class="mobile-btn w-full border border-red-600 text-red-600">
            <i data-feather="log-out" class="w-4 h-4 inline mr-2"></i>
            Keluar
        </button>
    </div>

    <!-- Help Section -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Bantuan</h3>
        <div class="space-y-2">
            <button class="w-full flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <i data-feather="help-circle" class="w-4 h-4 text-green-600"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Pusat Bantuan</span>
                </div>
                <i data-feather="external-link" class="w-4 h-4 text-gray-400"></i>
            </button>

            <button class="w-full flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i data-feather="message-circle" class="w-4 h-4 text-blue-600"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Hubungi Kami</span>
                </div>
                <i data-feather="external-link" class="w-4 h-4 text-gray-400"></i>
            </button>
        </div>
    </div>
</div>

<script>
    // Initialize Feather Icons
    document.addEventListener('DOMContentLoaded', function() {
        feather.replace();
        
        // Add fade-in animation to cards
        const cards = document.querySelectorAll('.mobile-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>