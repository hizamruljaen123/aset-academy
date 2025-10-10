<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Header with Quick Stats -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-2xl shadow-xl ring-1 ring-gray-200/50 fade-in">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-800 bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Dashboard Siswa</h1>
            <p class="text-lg text-gray-500 mt-2">Selamat datang, <?php echo $this->session->userdata('nama_lengkap'); ?></p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <?php if(isset($total_materi) && $total_materi > 0): ?>
            <div class="flex items-center bg-blue-50/50 px-4 py-2 rounded-xl">
                <i class="fas fa-book text-blue-600 mr-2"></i>
                <span class="font-medium"><?php echo $total_materi; ?> Materi</span>
            </div>
            <?php endif; ?>
            <?php if(isset($total_classmates) && $total_classmates > 0): ?>
            <div class="flex items-center bg-indigo-50/50 px-4 py-2 rounded-xl">
                <i class="fas fa-users text-indigo-600 mr-2"></i>
                <span class="font-medium"><?php echo $total_classmates; ?> Teman</span>
            </div>
            <?php endif; ?>
            <div class="flex items-center text-gray-500">
                <i class="fas fa-calendar-alt mr-2"></i>
                <span><?php echo date('d F Y'); ?></span>
            </div>
        </div>
    </div>
    <!-- Profile Completion Warning Card -->
    <?php if (isset($profile_incomplete) && $profile_incomplete && isset($student_profile) && $student_profile && $student_profile->id): ?>
    <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-2xl p-6 mb-8 ring-1 ring-amber-200/50 fade-in">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="h-12 w-12 rounded-full bg-amber-100 flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-amber-600 text-xl"></i>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-lg font-semibold text-amber-800 mb-2">
                    Lengkapi Data Profil Anda
                </h3>
                <p class="text-amber-700 mb-4">
                    Data profil Anda masih belum lengkap. Lengkapi data berikut untuk pengalaman belajar yang lebih baik:
                </p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <?php
                    $field_names = [
                        'no_telepon' => 'No. Telepon',
                        'kelas' => 'Kelas',
                        'jurusan' => 'Jurusan',
                        'alamat' => 'Alamat',
                        'tanggal_lahir' => 'Tanggal Lahir',
                        'jenis_kelamin' => 'Jenis Kelamin'
                    ];
                    foreach ($incomplete_fields as $field): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-amber-100 text-amber-800">
                            <i class="fas fa-circle text-xs mr-1.5"></i>
                            <?php echo $field_names[$field] ?? $field; ?>
                        </span>
                    <?php endforeach; ?>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-amber-600">
                        <?php echo $incomplete_count; ?> data belum diisi
                    </span>
                    <a href="<?php echo site_url('student/profile/edit'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-transform hover:scale-105">
                        <i class="fas fa-user-edit mr-2"></i>
                        Lengkapi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Student Profile Card -->
    <?php if (isset($student_profile) && $student_profile): ?>
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
        <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Profil Saya</h2>
                <a href="<?php echo site_url('student/profile'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-transform hover:scale-105">
                    <i class="fas fa-user-edit mr-2"></i>
                    Lihat Detail Profil
                </a>
            </div>
        </div>
        <div class="p-6">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                <div class="h-24 w-24 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-3xl shadow-lg">
                    <?php echo strtoupper(substr($student_profile->nama_lengkap, 0, 1)); ?>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-gray-900 mb-2"><?php echo $student_profile->nama_lengkap; ?></h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-2">
                        <div class="flex items-center bg-gray-50 rounded-lg p-3">
                            <div class="rounded-full bg-blue-100 p-2 mr-3">
                                <i class="fas fa-id-card text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">NIS</p>
                                <p class="font-medium"><?php echo $student_profile->nis; ?></p>
                            </div>
                        </div>
                        <div class="flex items-center bg-gray-50 rounded-lg p-3">
                            <div class="rounded-full bg-indigo-100 p-2 mr-3">
                                <i class="fas fa-graduation-cap text-indigo-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Kelas</p>
                                <p class="font-medium"><?php echo $student_profile->kelas; ?></p>
                            </div>
                        </div>
                        <div class="flex items-center bg-gray-50 rounded-lg p-3">
                            <div class="rounded-full bg-purple-100 p-2 mr-3">
                                <i class="fas fa-code-branch text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Jurusan</p>
                                <p class="font-medium"><?php echo $student_profile->jurusan; ?></p>
                            </div>
                        </div>
                        <div class="flex items-center bg-gray-50 rounded-lg p-3">
                            <div class="rounded-full bg-green-100 p-2 mr-3">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Status</p>
                                <p class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium <?php echo ($student_profile->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                    <?php echo $student_profile->status; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Tab Navigation -->
            <div class="flex border-b border-gray-200">
                <button class="py-2 px-4 font-medium text-blue-600 border-b-2 border-blue-600" id="regularClassTab">
                    Kelas Reguler
                </button>
                <button class="py-2 px-4 font-medium text-gray-500 hover:text-blue-600" id="premiumClassTab">
                    Kelas Premium
                </button>
            </div>
            
            <!-- Regular Class Content -->
            <div id="regularClassContent">
                <!-- Current Class Info -->
                <?php if (isset($class_details) && $class_details): ?>
                <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden fade-in">
                    <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl font-bold text-gray-800">Kelas Saya</h2>
                            <span class="px-3 py-1 text-sm font-medium rounded-full <?php echo ($class_details->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; ?>">
                                <?php echo $class_details->status; ?>
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="md:w-1/3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl p-6 text-white shadow-lg">
                                <h3 class="text-xl font-bold mb-2"><?php echo $class_details->nama_kelas; ?></h3>
                                <div class="flex items-center mb-3">
                                    <span class="px-3 py-1 bg-white/20 rounded-full text-sm font-medium">
                                        <?php echo $class_details->bahasa_program; ?>
                                    </span>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <i class="fas fa-signal mr-2"></i>
                                        <span><?php echo $class_details->level; ?></span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-clock mr-2"></i>
                                        <span><?php echo $class_details->durasi; ?> Jam</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-book mr-2"></i>
                                        <span><?php echo $total_materi; ?> Materi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="md:w-2/3">
                                <h3 class="text-lg font-bold text-gray-800 mb-3">Deskripsi Kelas</h3>
                                <p class="text-gray-600 mb-4"><?php echo $class_details->deskripsi; ?></p>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span class="text-sm text-gray-500">Harga Kelas</span>
                                        <p class="text-lg font-bold text-gray-900">Rp <?php echo number_format($class_details->harga, 0, ',', '.'); ?></p>
                                    </div>
                                    <a href="<?php echo site_url('student/materi'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-transform hover:scale-105">
                                        <i class="fas fa-book-open mr-2"></i>
                                        Lihat Semua Materi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <?php endif; ?>
                
                <!-- Recent Materials -->
                <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden fade-in">
                    <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl font-bold text-gray-800">Materi Terbaru</h2>
                            <a href="<?php echo site_url('student/materi'); ?>" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        <?php if (empty($recent_materials)): ?>
                            <div class="text-center py-8">
                                <i class="fas fa-book-open text-5xl text-gray-300 mb-3"></i>
                                <h3 class="text-lg font-medium text-gray-900">Belum ada materi</h3>
                                <p class="text-gray-500">Belum ada materi pembelajaran yang tersedia untuk kelas Anda</p>
                            </div>
                        <?php else: ?>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <?php foreach($recent_materials as $materi): ?>
                                    <div class="p-4 border border-gray-100 rounded-xl hover:shadow-md transition-all duration-300 hover:border-blue-200 fade-in">
                                        <div class="flex items-center mb-3">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                                                <i class="fas fa-book"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900"><?php echo $materi->judul; ?></h4>
                                                <p class="text-xs text-gray-500"><?php echo date('d M Y', strtotime($materi->created_at)); ?></p>
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-600 mb-3"><?php echo substr($materi->deskripsi, 0, 100) . (strlen($materi->deskripsi) > 100 ? '...' : ''); ?></p>
                                        <div class="flex justify-end">
                                            <a href="<?php echo site_url('student/materi_detail/'.$materi->id); ?>" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg text-sm font-medium text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                <i class="fas fa-eye mr-1"></i>
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <br>
                <!-- Available Classes -->
                <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden fade-in">
                    <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                        <h2 class="text-2xl font-bold text-gray-800">Kelas Tersedia</h2>
                        <p class="text-gray-500 mt-1">Kelas programming yang dapat diikuti</p>
                    </div>
                    <div class="p-6">
                        <?php if (empty($available_classes)): ?>
                            <div class="text-center py-8">
                                <i class="fas fa-graduation-cap text-5xl text-gray-300 mb-3"></i>
                                <h3 class="text-lg font-medium text-gray-900">Belum ada kelas</h3>
                                <p class="text-gray-500">Belum ada kelas programming yang tersedia</p>
                            </div>
                        <?php else: ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <?php foreach(array_slice($available_classes, 0, 4) as $kelas): ?>
                                    <div class="border border-gray-200 rounded-xl p-5 hover:shadow-lg transition-all duration-300 hover:border-blue-200 fade-in">
                                        <div class="flex justify-between items-start mb-3">
                                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800"><?php echo $kelas->bahasa_program; ?></span>
                                            <span class="px-3 py-1 text-xs font-medium rounded-full <?php echo ($kelas->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; ?>">
                                                <?php echo $kelas->status; ?>
                                            </span>
                                        </div>
                                        <h4 class="text-lg font-bold text-gray-900 mb-2"><?php echo $kelas->nama_kelas; ?></h4>
                                        <p class="text-sm text-gray-600 mb-4"><?php echo substr($kelas->deskripsi, 0, 120) . (strlen($kelas->deskripsi) > 120 ? '...' : ''); ?></p>
                                        <div class="flex flex-wrap gap-4 mb-3">
                                            <div class="flex items-center text-sm text-gray-500">
                                                <i class="fas fa-signal mr-2"></i>
                                                <span><?php echo $kelas->level; ?></span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-500">
                                                <i class="fas fa-clock mr-2"></i>
                                                <span><?php echo $kelas->durasi; ?> Jam</span>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center mt-4">
                                            <p class="text-lg font-bold text-gray-900">Rp <?php echo number_format($kelas->harga, 0, ',', '.'); ?></p>
                                            <a  class="inline-flex items-center px-3 py-1.5 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                Detail
                                </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Premium Class Content -->
            <div id="premiumClassContent" class="hidden">
                <?php if (!empty($paid_classes) || !empty($available_paid_classes)): ?>
                    <!-- Content same as previously added premium classes section -->
                    <?php if (!empty($paid_classes) || !empty($available_paid_classes)): ?>
                        <!-- Paid Classes Section -->
                        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden fade-in">
                            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                                <h2 class="text-2xl font-bold text-gray-800">Kelas Berbayar</h2>
                                <p class="text-gray-500 mt-1">Kelas premium yang telah dibeli dan tersedia</p>
                            </div>
                            <div class="p-6">
                                <?php if (!empty($paid_classes)): ?>
                                    <h3 class="text-lg font-bold text-gray-800 mb-4">Kelas yang Telah Dibeli</h3>
                                    <div class="grid grid-cols-1 gap-4 mb-6">
                                        <?php foreach($paid_classes as $class): ?>
                                            <?php $premiumClassName = $class->nama_kelas ?? ($class->class_name ?? 'Kelas Premium'); ?>
                                            <div class="border border-green-100 rounded-xl p-4 bg-green-50/50">
                                                <div class="flex justify-between items-start">
                                                    <h4 class="text-lg font-bold text-gray-900"><?php echo $premiumClassName; ?></h4>
                                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                        Sudah Dibeli
                                                    </span>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-3"><?php echo $class->deskripsi; ?></p>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm text-gray-500">Harga: Rp <?php echo number_format($class->harga, 0, ',', '.'); ?></span>
                                                    <a href="<?php echo site_url('kelas/detail/'.$class->class_id); ?>" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                                        Akses Kelas <i class="fas fa-arrow-right ml-1"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($available_paid_classes)): ?>
                                    <h3 class="text-lg font-bold text-gray-800 mb-4">Kelas Berbayar Tersedia</h3>
                                    <div class="grid grid-cols-1 gap-4">
                                        <?php foreach($available_paid_classes as $class): ?>
                                            <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-all duration-300">
                                                <div class="flex justify-between items-start mb-2">
                                                    <h4 class="text-lg font-bold text-gray-900"><?php echo $class->nama_kelas; ?></h4>
                                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                                        Premium
                                                    </span>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-3"><?php echo substr($class->deskripsi, 0, 120) . (strlen($class->deskripsi) > 120 ? '...' : ''); ?></p>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-lg font-bold text-gray-900">Rp <?php echo number_format($class->harga, 0, ',', '.'); ?></span>
                                                    <a href="<?php echo site_url('payment/initiate/'.encrypt_url($class->id)); ?>" class="inline-flex items-center px-3 py-1.5 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                        <i class="fas fa-shopping-cart mr-1"></i>
                                                        Beli Sekarang
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="text-center py-12 bg-white rounded-lg shadow">
                        <i class="fas fa-graduation-cap text-5xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900">Belum ada kelas premium</h3>
                        <p class="text-gray-500 mt-1">Silakan cek kembali nanti untuk kelas premium terbaru</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-8">
            <!-- Class Materials Summary -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-2xl font-bold text-gray-800">Materi Pembelajaran</h2>
                </div>
                <div class="p-6">
                    <?php if (empty($class_materials)): ?>
                        <div class="text-center py-8">
                            <i class="fas fa-book-open text-5xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500">Belum ada materi tersedia</p>
                        </div>
                    <?php else: ?>
                        <div class="flex items-center justify-center mb-6">
                            <div class="h-32 w-32 rounded-full bg-blue-50 border-8 border-blue-100 flex flex-col items-center justify-center">
                                <span class="text-3xl font-bold text-blue-600"><?php echo count($class_materials); ?></span>
                                <span class="text-sm text-gray-500">Total Materi</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <?php foreach(array_slice($class_materials, 0, 5) as $materi): ?>
                                <a href="<?php echo site_url('student/materi_detail/'.$materi->id); ?>" class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition-all duration-300">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white mr-3">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-900"><?php echo $materi->judul; ?></h4>
                                            <p class="text-xs text-gray-500"><?php echo date('d M Y', strtotime($materi->created_at)); ?></p>
                                        </div>
                                    </div>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </a>
                            <?php endforeach; ?>
                            <?php if (count($class_materials) > 5): ?>
                                <div class="text-center pt-2">
                                    <a href="<?php echo site_url('student/materi'); ?>" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                        Lihat <?php echo count($class_materials) - 5; ?> materi lainnya
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Classmates -->
            <?php if (!empty($classmates)): ?>
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-2xl font-bold text-gray-800">Teman Sekelas</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <?php foreach($classmates as $classmate): ?>
                            <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold mr-3">
                                    <?php echo strtoupper(substr($classmate->nama_lengkap, 0, 1)); ?>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900"><?php echo $classmate->nama_lengkap; ?></h4>
                                    <p class="text-xs text-gray-500"><?php echo $classmate->jurusan; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if ($total_classmates > 5): ?>
                            <div class="text-center pt-2">
                                <span class="text-sm text-gray-500">+ <?php echo $total_classmates - 5; ?> teman lainnya</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-2xl font-bold text-gray-800">Aksi Cepat</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <a href="<?php echo site_url('student/profile'); ?>" class="flex flex-col items-center p-4 rounded-xl hover:bg-blue-50 transition-colors text-center group">
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mb-3 group-hover:scale-110 transition-transform">
                                <i class="fas fa-user-circle text-xl"></i>
                            </div>
                            <span class="font-medium text-gray-900">Profil Saya</span>
                        </a>
                        <a href="<?php echo site_url('student/materi'); ?>" class="flex flex-col items-center p-4 rounded-xl hover:bg-indigo-50 transition-colors text-center group">
                            <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mb-3 group-hover:scale-110 transition-transform">
                                <i class="fas fa-book-open text-xl"></i>
                            </div>
                            <span class="font-medium text-gray-900">Materi</span>
                        </a>
                        <a href="<?php echo site_url('student/workshops'); ?>" class="flex flex-col items-center p-4 rounded-xl hover:bg-green-50 transition-colors text-center group">
                            <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 mb-3 group-hover:scale-110 transition-transform">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <span class="font-medium text-gray-900">Workshop</span>
                        </a>
                        <a href="<?php echo site_url('student/free_classes'); ?>" class="flex flex-col items-center p-4 rounded-xl hover:bg-purple-50 transition-colors text-center group">
                            <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 mb-3 group-hover:scale-110 transition-transform">
                                <i class="fas fa-graduation-cap text-xl"></i>
                            </div>
                            <span class="font-medium text-gray-900">Kelas Gratis</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fade in main container
        const dashboard = document.querySelector('.transition-opacity');
        if (dashboard) {
            dashboard.classList.add('opacity-100');
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
            
            fadeElements.forEach(element => {
                observer.observe(element);
            });
        }
        
        // Tab navigation
        const regularClassTab = document.getElementById('regularClassTab');
        const premiumClassTab = document.getElementById('premiumClassTab');
        const regularClassContent = document.getElementById('regularClassContent');
        const premiumClassContent = document.getElementById('premiumClassContent');
        
        if (regularClassTab && premiumClassTab && regularClassContent && premiumClassContent) {
            regularClassTab.addEventListener('click', () => {
                regularClassTab.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                premiumClassTab.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                regularClassContent.classList.remove('hidden');
                premiumClassContent.classList.add('hidden');
            });
            
            premiumClassTab.addEventListener('click', () => {
                premiumClassTab.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                regularClassTab.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                premiumClassContent.classList.remove('hidden');
                regularClassContent.classList.add('hidden');
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
    
    /* Staggered animations */
    .fade-in:nth-child(1) { transition-delay: 0.1s; }
    .fade-in:nth-child(2) { transition-delay: 0.2s; }
    .fade-in:nth-child(3) { transition-delay: 0.3s; }
    .fade-in:nth-child(4) { transition-delay: 0.4s; }
    .fade-in:nth-child(5) { transition-delay: 0.5s; }
    
    /* Button hover effects */
    a, button {
        transition: all 0.3s ease;
    }
    
    a.hover\:scale-105:hover, button.hover\:scale-105:hover {
        transform: scale(1.05);
    }
    
    /* Card hover effects */
    .hover\:shadow-md, .hover\:shadow-lg {
        transition: all 0.3s ease;
    }
</style>
