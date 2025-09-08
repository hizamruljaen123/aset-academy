<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold"><?php echo $kelas->nama_kelas; ?></h1>
                <p class="text-sm opacity-90 mt-1">Level: <?php echo $kelas->level; ?> | <?php echo $kelas->bahasa_program; ?></p>
            </div>
            <a href="<?php echo site_url('teacher/kelas'); ?>" class="hidden sm:inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Student List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar Siswa</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php if (!empty($siswa)): ?>
                                <?php foreach ($siswa as $s): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full object-cover" src="<?php echo base_url('uploads/siswa/' . ($s->foto_profil ?: 'default_avatar.png')); ?>" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900"><?php echo $s->nama_lengkap; ?></div>
                                                    <div class="text-sm text-gray-500"><?php echo $s->nis; ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $s->email; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                <?php echo $s->status; ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="<?php echo site_url('teacher/siswa_detail/' . $s->id); ?>" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada siswa di kelas ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Column: Materials List -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar Materi</h2>
                <div class="space-y-4">
                    <?php if (!empty($materi)): ?>
                        <?php foreach ($materi as $m): ?>
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors">
                                <a href="<?php echo site_url('teacher/materi_detail/' . $m->id); ?>" class="block">
                                    <h4 class="font-semibold text-gray-900"><?php echo $m->judul; ?></h4>
                                    <p class="text-sm text-gray-600 mt-1"><?php echo character_limiter($m->deskripsi, 50); ?></p>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center text-gray-500 py-4">Belum ada materi untuk kelas ini.</p>
                    <?php endif; ?>
                </div>
                <div class="mt-6">
                    <button class="w-full inline-flex items-center justify-center px-4 py-2 bg-cyan-500 hover:bg-cyan-600 text-white font-bold rounded-lg shadow-sm transition-colors">
                        <i class="fas fa-plus mr-2"></i> Tambah Materi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
