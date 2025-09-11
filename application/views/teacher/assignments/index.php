<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Manajemen Tugas</h1>
                        <p class="text-gray-600">Kelola tugas untuk semua kelas yang Anda ajar</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <span>Total Kelas: <?= count($premium_classes) + count($gratis_classes) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <?php if (empty($premium_classes) && empty($gratis_classes)): ?>
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="text-center py-16 px-6">
                    <div class="mx-auto h-24 w-24 text-gray-400 mb-6">
                        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Kelas</h3>
                    <p class="text-gray-600 mb-6">Anda belum ditugaskan untuk mengajar di kelas manapun.</p>
                    <div class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-blue-700 bg-blue-100 hover:bg-blue-200 transition-colors">
                        Hubungi Admin
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Classes Grid -->
            <div class="grid gap-8">
                <!-- Premium Classes -->
                <?php if (!empty($premium_classes)): ?>
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                            <h3 class="text-xl font-semibold text-white flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Kelas Premium
                            </h3>
                            <p class="text-blue-100 text-sm mt-1">Kelas berbayar dengan fitur lengkap</p>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <?php foreach ($premium_classes as $class): ?>
                                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                                        <div class="flex items-center mb-4">
                                            <div class="bg-blue-600 text-white rounded-lg p-3">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-4 flex-1">
                                                <h4 class="font-bold text-gray-900 text-lg leading-tight"><?= htmlspecialchars($class->nama_kelas ?? 'Kelas Tidak Dikenal', ENT_QUOTES, 'UTF-8'); ?></h4>
                                                <p class="text-sm text-blue-600 font-medium"><?= htmlspecialchars($class->level ?? 'Tidak ditentukan', ENT_QUOTES, 'UTF-8'); ?></p>
                                            </div>
                                        </div>
                                        <div class="space-y-3">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                </svg>
                                                <span>Premium Class</span>
                                            </div>
                                            <a href="<?= site_url('teacher/assignments/view_class/' . $class->id . '/premium'); ?>" class="block w-full text-center bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-4 rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-md hover:shadow-lg">
                                                Kelola Tugas
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Gratis Classes -->
                <?php if (!empty($gratis_classes)): ?>
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-6 py-4">
                            <h3 class="text-xl font-semibold text-white flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Kelas Gratis
                            </h3>
                            <p class="text-green-100 text-sm mt-1">Kelas gratis untuk semua siswa</p>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <?php foreach ($gratis_classes as $class): ?>
                                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200 rounded-xl p-6 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                                        <div class="flex items-center mb-4">
                                            <div class="bg-green-600 text-white rounded-lg p-3">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-4 flex-1">
                                                <h4 class="font-bold text-gray-900 text-lg leading-tight"><?= htmlspecialchars($class->title ?? $class->nama_kelas ?? 'Kelas Tidak Dikenal', ENT_QUOTES, 'UTF-8'); ?></h4>
                                                <p class="text-sm text-green-600 font-medium"><?= htmlspecialchars($class->level ?? 'Tidak ditentukan', ENT_QUOTES, 'UTF-8'); ?></p>
                                            </div>
                                        </div>
                                        <div class="space-y-3">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                </svg>
                                                <span>Free Class</span>
                                            </div>
                                            <a href="<?= site_url('teacher/assignments/view_class/' . $class->id . '/gratis'); ?>" class="block w-full text-center bg-gradient-to-r from-green-600 to-emerald-600 text-white py-3 px-4 rounded-lg font-semibold hover:from-green-700 hover:to-emerald-700 transition-all duration-200 shadow-md hover:shadow-lg">
                                                Kelola Tugas
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
