<div class="min-h-screen bg-gray-50 pb-20">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-4 py-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <button onclick="history.back()" class="mr-3 p-2 rounded-full bg-white/20 hover:bg-white/30 transition-colors">
                    <i data-feather="arrow-left" class="w-5 h-5"></i>
                </button>
                <div>
                    <h1 class="text-xl font-bold">Jelajahi Kelas</h1>
                    <p class="text-blue-100 text-sm">Temukan kelas yang sesuai untuk Anda</p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 -mt-4">
        <!-- Class Type Tabs -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6" x-data="{ tab: 'free' }">
            <div class="border-b border-gray-200">
                <nav class="flex">
                    <button @click="tab = 'free'" :class="{ 'border-blue-500 text-blue-600': tab === 'free', 'border-transparent text-gray-500': tab !== 'free' }"
                            class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm transition-colors">
                        Kelas Gratis
                    </button>
                    <button @click="tab = 'premium'" :class="{ 'border-blue-500 text-blue-600': tab === 'premium', 'border-transparent text-gray-500': tab !== 'premium' }"
                            class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm transition-colors">
                        Kelas Premium
                    </button>
                </nav>
            </div>

            <div class="p-4">
                <!-- Free Classes Tab -->
                <div x-show="tab === 'free'" x-transition>
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-800 mb-2">Kelas Gratis</h2>
                        <p class="text-sm text-gray-600">Pelajari berbagai materi programming secara gratis</p>
                    </div>

                    <?php if (empty($free_classes)): ?>
                        <div class="text-center py-8">
                            <div class="mx-auto w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mb-4">
                                <i data-feather="book-open" class="w-8 h-8 text-green-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Kelas Gratis</h3>
                            <p class="text-gray-500 text-sm">Kelas gratis akan segera tersedia.</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php foreach($free_classes as $class): ?>
                                <div class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200 hover:shadow-md transition-all duration-300">
                                    <div class="h-32 bg-gray-200 relative">
                                        <?php if (!empty($class->thumbnail)): ?>
                                            <img src="<?php echo $class->thumbnail; ?>" alt="<?php echo $class->title; ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div class="w-full h-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                                                <i data-feather="book-open" class="w-12 h-12 text-white"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="absolute top-2 right-2">
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-600 text-white">Gratis</span>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-bold text-gray-800 mb-2 text-sm line-clamp-2"><?php echo $class->title; ?></h3>
                                        <div class="flex items-center text-xs text-gray-600 mb-2">
                                            <i data-feather="user" class="w-3 h-3 mr-1"></i>
                                            <span><?php echo $class->mentor_name ?? 'Mentor'; ?></span>
                                        </div>
                                        <p class="text-xs text-gray-600 mb-3 line-clamp-2"><?php echo $class->description ?? 'Deskripsi kelas'; ?></p>
                                        <div class="grid grid-cols-2 gap-2 text-xs text-gray-500 mb-4">
                                            <div>
                                                <i data-feather="trending-up" class="w-3 h-3 inline mr-1"></i>
                                                Level: <?php echo $class->level ?? 'Dasar'; ?>
                                            </div>
                                            <div class="col-span-2">
                                                <i data-feather="users" class="w-3 h-3 inline mr-1"></i>
                                                <?php echo $class->enrollment_count ?? 0; ?> siswa
                                            </div>
                                        </div>
                                        <a href="<?php echo site_url('student/free_classes/view/' . $class->id); ?>" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 transition-colors">
                                            Lihat Detail & Daftar
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Premium Classes Tab -->
                <div x-show="tab === 'premium'" x-transition x-cloak>
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-800 mb-2">Kelas Premium</h2>
                        <p class="text-sm text-gray-600">Akses materi lengkap dengan sertifikat dan dukungan mentor</p>
                    </div>

                    <?php if (empty($premium_classes)): ?>
                        <div class="text-center py-8">
                            <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                                <i data-feather="star" class="w-8 h-8 text-blue-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Kelas Premium</h3>
                            <p class="text-gray-500 text-sm">Kelas premium akan segera tersedia.</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php foreach($premium_classes as $class): ?>
                                <div class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200 hover:shadow-md transition-all duration-300">
                                    <div class="h-32 bg-gray-200 relative">
                                        <?php if (!empty($class->gambar)): ?>
                                            <img src="<?php echo $class->gambar; ?>" alt="<?php echo $class->nama_kelas; ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                                <i data-feather="code" class="w-12 h-12 text-white"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="absolute top-2 right-2">
                                            <span class="px-2 py-1 text-xs rounded-full bg-blue-600 text-white">Premium</span>
                                        </div>
                                        <div class="absolute top-2 left-2">
                                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-500 text-white font-semibold">
                                                Rp <?php echo number_format($class->harga, 0, ',', '.'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-bold text-gray-800 mb-2 text-sm line-clamp-2"><?php echo $class->nama_kelas; ?></h3>
                                        <div class="flex items-center justify-between text-xs text-gray-600 mb-2">
                                            <div class="flex items-center">
                                                <i data-feather="code" class="w-3 h-3 mr-1"></i>
                                                <span><?php echo $class->bahasa_program ?? 'Programming'; ?></span>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-feather="trending-up" class="w-3 h-3 mr-1"></i>
                                                <span><?php echo $class->level; ?></span>
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-600 mb-3 line-clamp-2"><?php echo $class->deskripsi ?? 'Deskripsi kelas premium'; ?></p>
                                        <div class="grid grid-cols-2 gap-2 text-xs text-gray-500 mb-4">
                                            <div>
                                                <i data-feather="clock" class="w-3 h-3 inline mr-1"></i>
                                                Durasi: <?php echo $class->durasi; ?> jam
                                            </div>
                                            <div>
                                                <i data-feather="trending-up" class="w-3 h-3 inline mr-1"></i>
                                                <?php echo $class->level; ?>
                                            </div>
                                            <div class="col-span-2">
                                                <i data-feather="users" class="w-3 h-3 inline mr-1"></i>
                                                <?php echo $class->enrollment_count ?? 0; ?> siswa
                                            </div>
                                        </div>
                                        <a href="<?php echo site_url('student_mobile/premium_detail/' . $class->id); ?>" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                                            Lihat Detail & Daftar
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white rounded-2xl shadow-lg p-4 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Kelas</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i data-feather="book-open" class="w-6 h-6 text-green-600"></i>
                    </div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo count($free_classes); ?></p>
                    <p class="text-xs text-gray-500">Kelas Gratis</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i data-feather="star" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo count($premium_classes); ?></p>
                    <p class="text-xs text-gray-500">Kelas Premium</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize Feather Icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
</script>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    [x-cloak] {
        display: none !important;
    }
</style>
