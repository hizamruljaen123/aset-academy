<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-cyan-500 to-teal-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Kelas Saya</h1>
                <p class="text-sm opacity-90 mt-1"><?php echo count($premium_kelas) + count($gratis_kelas); ?> kelas yang diampu</p>
            </div>
            <div class="hidden sm:flex space-x-4">
                <div class="text-center">
                    <div class="text-3xl font-bold"><?php echo count($premium_kelas); ?></div>
                    <div class="text-xs opacity-80">Premium</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold"><?php echo count($gratis_kelas); ?></div>
                    <div class="text-xs opacity-80">Gratis</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold">0%</div>
                    <div class="text-xs opacity-80">Rata-rata</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Kelas</h2>
        <div class="flex items-center gap-4 w-full sm:w-auto">
            <div class="relative w-full sm:w-auto">
                <select class="appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    <option>Semua Tipe</option>
                    <option>Premium</option>
                    <option>Gratis</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>
            <div class="relative w-full sm:w-auto">
                <input type="text" placeholder="Cari kelas..." class="w-full bg-white border border-gray-300 rounded-lg shadow-sm px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Premium Classes Section -->
    <?php if (!empty($premium_kelas)): ?>
        <div class="mb-8">
            <div class="flex items-center mb-6">
                <i class="fas fa-crown text-yellow-500 mr-3 text-xl"></i>
                <h3 class="text-xl font-bold text-gray-800">Kelas Premium</h3>
                <span class="ml-2 bg-yellow-100 text-yellow-800 text-sm font-medium px-2.5 py-0.5 rounded-full"><?php echo count($premium_kelas); ?> kelas</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($premium_kelas as $k): ?>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-1 transition-all duration-300">
                        <div class="h-40 bg-gradient-to-br from-yellow-400 to-orange-500 flex flex-col justify-between p-5 text-white">
                            <div>
                                <span class="text-xs font-semibold bg-white/20 text-white px-3 py-1 rounded-full"><?php echo $k->bahasa_program; ?></span>
                            </div>
                            <h3 class="text-xl font-bold"><?php echo $k->nama_kelas; ?></h3>
                        </div>
                        <div class="p-5">
                            <p class="text-gray-600 text-sm mb-4 h-10 overflow-hidden"><?php echo $k->deskripsi; ?></p>
                            <div class="flex justify-between text-sm text-gray-600 mb-4">
                                <span class="flex items-center"><i class="fas fa-signal mr-2 text-cyan-500"></i><?php echo $k->level; ?></span>
                                <span class="flex items-center"><i class="fas fa-clock mr-2 text-teal-500"></i><?php echo $k->durasi; ?> Jam</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                                <div class="bg-gradient-to-r from-cyan-400 to-teal-500 h-2.5 rounded-full" style="width: 45%"></div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="text-xs text-gray-500">Ditugaskan: <?php echo date('d M Y', strtotime($k->assigned_at)); ?></div>
                                <div class="flex items-center space-x-2">
                                    <?php if (!empty($k->online_meet_link)): ?>
                                        <a href="<?php echo $k->online_meet_link; ?>" target="_blank" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-green-500 hover:bg-green-600 rounded-lg transition-colors" title="Join Meeting">
                                            <i class="fas fa-video mr-1"></i>
                                            Join
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?php echo site_url('teacher/manage_kelas/' . $k->id); ?>" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-white bg-cyan-500 hover:bg-cyan-600 rounded-lg transition-all" title="Kelola Kelas">
                                        <i class="fas fa-cog mr-1"></i>
                                        Kelola
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Free Classes Section -->
    <?php if (!empty($gratis_kelas)): ?>
        <div class="mb-8">
            <div class="flex items-center mb-6">
                <i class="fas fa-gift text-green-500 mr-3 text-xl"></i>
                <h3 class="text-xl font-bold text-gray-800">Kelas Gratis</h3>
                <span class="ml-2 bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full"><?php echo count($gratis_kelas); ?> kelas</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($gratis_kelas as $k): ?>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-1 transition-all duration-300">
                        <div class="h-40 bg-gradient-to-br from-green-400 to-emerald-500 flex flex-col justify-between p-5 text-white">
                            <div>
                                <span class="text-xs font-semibold bg-white/20 text-white px-3 py-1 rounded-full"><?php echo isset($k->category) ? $k->category : 'Web Development'; ?></span>
                            </div>
                            <h3 class="text-xl font-bold"><?php echo isset($k->title) ? $k->title : 'Kelas Gratis'; ?></h3>
                        </div>
                        <div class="p-5">
                            <p class="text-gray-600 text-sm mb-4 h-10 overflow-hidden"><?php echo isset($k->description) ? $k->description : 'Deskripsi kelas belum tersedia.'; ?></p>
                            <div class="flex justify-between text-sm text-gray-600 mb-4">
                                <span class="flex items-center"><i class="fas fa-signal mr-2 text-green-500"></i><?php echo isset($k->level) ? $k->level : 'Dasar'; ?></span>
                                <span class="flex items-center"><i class="fas fa-clock mr-2 text-emerald-500"></i><?php echo isset($k->duration) && $k->duration ? $k->duration : '-'; ?> Jam</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                                <div class="bg-gradient-to-r from-green-400 to-emerald-500 h-2.5 rounded-full" style="width: 45%"></div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="text-xs text-gray-500">Ditugaskan sebagai mentor</div>
                                <div class="flex items-center space-x-2">
                                    <?php if (!empty($k->online_meet_link)): ?>
                                        <a href="<?php echo $k->online_meet_link; ?>" target="_blank" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-green-500 hover:bg-green-600 rounded-lg transition-colors" title="Join Meeting">
                                            <i class="fas fa-video mr-1"></i>
                                            Join
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?php echo site_url('teacher/manage_kelas/' . $k->id); ?>" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-white bg-emerald-500 hover:bg-emerald-600 rounded-lg transition-all" title="Kelola Kelas">
                                        <i class="fas fa-cog mr-1"></i>
                                        Kelola
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Empty State -->
    <?php if (empty($premium_kelas) && empty($gratis_kelas)): ?>
        <div class="text-center py-16 bg-white rounded-2xl shadow-md">
            <div class="mx-auto w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center mb-6">
                <i class="fas fa-chalkboard-teacher text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Anda Belum Mengampu Kelas</h3>
            <p class="text-gray-500">Saat ini Anda belum ditugaskan untuk mengajar di kelas manapun. Silakan menunggu penugasan dari admin.</p>
        </div>
    <?php endif; ?>
</div>
