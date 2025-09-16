<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Enhanced Hero Banner with Modern Design -->
    <div class="relative rounded-3xl overflow-hidden mb-8 h-80 shadow-2xl">
        <!-- Background with animated gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-800 opacity-95 animate-gradient-x"></div>

        <!-- Animated background pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full animate-pulse"></div>
            <div class="absolute top-20 right-20 w-24 h-24 bg-white rounded-full animate-pulse delay-1000"></div>
            <div class="absolute bottom-10 left-1/3 w-20 h-20 bg-white rounded-full animate-pulse delay-2000"></div>
        </div>

        <div class="absolute inset-0 flex items-center p-8 z-10">
            <div class="flex flex-col md:flex-row items-start md:items-center w-full">
                <div class="flex items-center mb-6 md:mb-0 md:mr-8">
                    <!-- Enhanced icon with glow effect -->
                    <div class="relative">
                        <div class="flex items-center justify-center h-24 w-24 rounded-full bg-white/20 backdrop-blur-lg border-2 border-white/30 text-white text-4xl shadow-2xl animate-bounce-gentle">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="absolute -inset-1 bg-white/20 rounded-full blur-lg animate-pulse"></div>
                    </div>
                    <div class="ml-6">
                        <!-- Enhanced badge with animation -->
                        <span class="inline-flex items-center px-4 py-2 text-sm font-bold rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-star mr-2 animate-spin-slow"></i>
                            <?php echo $kelas->bahasa_program; ?>
                        </span>
                        <h1 class="text-4xl md:text-5xl font-black text-white mt-3 mb-2 drop-shadow-lg">
                            <?php echo $kelas->nama_kelas; ?>
                        </h1>
                        <p class="text-white/90 mt-2 max-w-2xl text-lg leading-relaxed drop-shadow-md">
                            <?php echo $kelas->deskripsi; ?>
                        </p>
                        <!-- Status indicator -->
                        <div class="flex items-center mt-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-white/80 text-sm font-medium">Kelas <?php echo $kelas->status; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 ml-auto">
                    <?php if (!empty($kelas->online_meet_link)): ?>
                        <a href="<?php echo $kelas->online_meet_link; ?>" target="_blank"
                           class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 border border-transparent rounded-2xl font-bold text-white shadow-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                            <i class="fas fa-video mr-3 group-hover:animate-bounce"></i>
                            <span>Join Meeting</span>
                            <i class="fas fa-external-link-alt ml-2 text-xs opacity-70"></i>
                        </a>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('role') === 'admin'): ?>
                    <a href="<?php echo site_url('kelas/edit/'.$kelas->id); ?>"
                       class="group inline-flex items-center px-6 py-3 bg-white/15 backdrop-blur-lg border-2 border-white/30 rounded-2xl text-white font-bold hover:bg-white/25 transition-all duration-300 transform hover:scale-105 shadow-xl">
                        <i class="fas fa-edit mr-3 group-hover:rotate-12 transition-transform duration-300"></i>
                        <span>Edit Kelas</span>
                    </a>
                    <?php endif; ?>
                    <a href="<?php echo site_url('kelas'); ?>"
                       class="group inline-flex items-center px-6 py-3 bg-white/10 backdrop-blur-lg border-2 border-white/20 rounded-2xl text-white font-bold hover:bg-white/20 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-arrow-left mr-3 group-hover:-translate-x-1 transition-transform duration-300"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Stats Cards with Modern Design -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Level Card -->
        <div class="group bg-white/90 backdrop-blur-xl rounded-3xl p-6 shadow-2xl ring-1 ring-gray-200/50 hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 border border-white/20">
            <div class="flex items-center">
                <div class="relative p-4 rounded-2xl bg-gradient-to-br from-blue-100 via-blue-200 to-indigo-200 text-blue-700 mr-5 shadow-xl group-hover:shadow-2xl transition-all duration-300">
                    <i class="fas fa-layer-group text-2xl"></i>
                    <div class="absolute -inset-1 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-2xl blur opacity-25 group-hover:opacity-40 transition-opacity duration-300"></div>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-gray-800 mb-1 group-hover:text-blue-700 transition-colors duration-300">
                        <?php echo $kelas->level; ?>
                    </h3>
                    <p class="text-gray-500 font-semibold text-sm uppercase tracking-wide">Level</p>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <div class="flex-1 bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full transition-all duration-1000 ease-out" style="width: 100%"></div>
                </div>
            </div>
        </div>

        <!-- Duration Card -->
        <div class="group bg-white/90 backdrop-blur-xl rounded-3xl p-6 shadow-2xl ring-1 ring-gray-200/50 hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 border border-white/20">
            <div class="flex items-center">
                <div class="relative p-4 rounded-2xl bg-gradient-to-br from-yellow-100 via-orange-100 to-yellow-200 text-yellow-700 mr-5 shadow-xl group-hover:shadow-2xl transition-all duration-300">
                    <i class="fas fa-clock text-2xl"></i>
                    <div class="absolute -inset-1 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl blur opacity-25 group-hover:opacity-40 transition-opacity duration-300"></div>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-gray-800 mb-1 group-hover:text-yellow-700 transition-colors duration-300">
                        <?php echo $kelas->durasi; ?> <span class="text-lg font-bold">Jam</span>
                    </h3>
                    <p class="text-gray-500 font-semibold text-sm uppercase tracking-wide">Durasi</p>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <div class="flex-1 bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-yellow-500 to-orange-600 h-2 rounded-full transition-all duration-1000 ease-out" style="width: 85%"></div>
                </div>
            </div>
        </div>

        <!-- Price Card -->
        <div class="group bg-white/90 backdrop-blur-xl rounded-3xl p-6 shadow-2xl ring-1 ring-gray-200/50 hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 border border-white/20">
            <div class="flex items-center">
                <div class="relative p-4 rounded-2xl bg-gradient-to-br from-green-100 via-emerald-100 to-green-200 text-green-700 mr-5 shadow-xl group-hover:shadow-2xl transition-all duration-300">
                    <i class="fas fa-dollar-sign text-2xl"></i>
                    <div class="absolute -inset-1 bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl blur opacity-25 group-hover:opacity-40 transition-opacity duration-300"></div>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-gray-800 mb-1 group-hover:text-green-700 transition-colors duration-300">
                        Rp <?php echo number_format($kelas->harga, 0, ',', '.'); ?>
                    </h3>
                    <p class="text-gray-500 font-semibold text-sm uppercase tracking-wide">Harga</p>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <div class="flex-1 bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-2 rounded-full transition-all duration-1000 ease-out" style="width: 90%"></div>
                </div>
            </div>
        </div>

        <!-- Status Card -->
        <div class="group bg-white/90 backdrop-blur-xl rounded-3xl p-6 shadow-2xl ring-1 ring-gray-200/50 hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 border border-white/20">
            <div class="flex items-center">
                <div class="relative p-4 rounded-2xl bg-gradient-to-br from-purple-100 via-pink-100 to-purple-200 text-purple-700 mr-5 shadow-xl group-hover:shadow-2xl transition-all duration-300">
                    <i class="fas fa-signal text-2xl"></i>
                    <div class="absolute -inset-1 bg-gradient-to-br from-purple-400 to-pink-500 rounded-2xl blur opacity-25 group-hover:opacity-40 transition-opacity duration-300"></div>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-gray-800 mb-1 group-hover:text-purple-700 transition-colors duration-300">
                        <?php echo $kelas->status; ?>
                    </h3>
                    <p class="text-gray-500 font-semibold text-sm uppercase tracking-wide">Status</p>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <div class="flex-1 bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-600 h-2 rounded-full transition-all duration-1000 ease-out" style="width: 95%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Statistics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Attendance Statistics -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl ring-1 ring-gray-200/50 overflow-hidden hover-lift border border-white/20">
            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-blue-50/80 via-indigo-50/80 to-purple-50/80">
                <div class="flex items-center">
                    <div class="p-3 rounded-2xl bg-gradient-to-br from-blue-100 to-indigo-200 text-blue-700 mr-4 shadow-xl">
                        <i class="fas fa-chart-pie text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-800">Statistik Absensi</h2>
                        <p class="text-gray-600 text-sm">Data kehadiran siswa</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="h-64 mb-6">
                    <canvas id="attendanceChart"></canvas>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="group text-center p-4 rounded-2xl bg-gradient-to-br from-green-100 to-emerald-200 text-green-800 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="text-3xl font-black mb-1 group-hover:animate-bounce"><?= $attendance_stats['Hadir'] ?></div>
                        <div class="text-sm font-semibold uppercase tracking-wide">Hadir</div>
                        <div class="w-full bg-green-300 rounded-full h-1 mt-2">
                            <div class="bg-green-600 h-1 rounded-full transition-all duration-1000" style="width: 100%"></div>
                        </div>
                    </div>
                    <div class="group text-center p-4 rounded-2xl bg-gradient-to-br from-yellow-100 to-orange-200 text-yellow-800 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="text-3xl font-black mb-1 group-hover:animate-bounce"><?= $attendance_stats['Sakit'] ?></div>
                        <div class="text-sm font-semibold uppercase tracking-wide">Sakit</div>
                        <div class="w-full bg-yellow-300 rounded-full h-1 mt-2">
                            <div class="bg-yellow-600 h-1 rounded-full transition-all duration-1000" style="width: 75%"></div>
                        </div>
                    </div>
                    <div class="group text-center p-4 rounded-2xl bg-gradient-to-br from-blue-100 to-indigo-200 text-blue-800 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="text-3xl font-black mb-1 group-hover:animate-bounce"><?= $attendance_stats['Izin'] ?></div>
                        <div class="text-sm font-semibold uppercase tracking-wide">Izin</div>
                        <div class="w-full bg-blue-300 rounded-full h-1 mt-2">
                            <div class="bg-blue-600 h-1 rounded-full transition-all duration-1000" style="width: 60%"></div>
                        </div>
                    </div>
                    <div class="group text-center p-4 rounded-2xl bg-gradient-to-br from-red-100 to-pink-200 text-red-800 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="text-3xl font-black mb-1 group-hover:animate-bounce"><?= $attendance_stats['Alpa'] ?></div>
                        <div class="text-sm font-semibold uppercase tracking-wide">Alpa</div>
                        <div class="w-full bg-red-300 rounded-full h-1 mt-2">
                            <div class="bg-red-600 h-1 rounded-full transition-all duration-1000" style="width: 25%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Student Progress -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl ring-1 ring-gray-200/50 overflow-hidden hover-lift border border-white/20">
            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-emerald-50/80 via-green-50/80 to-teal-50/80">
                <div class="flex items-center">
                    <div class="p-3 rounded-2xl bg-gradient-to-br from-emerald-100 to-green-200 text-emerald-700 mr-4 shadow-xl">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-800">Progress Siswa</h2>
                        <p class="text-gray-600 text-sm">Pantau perkembangan pembelajaran siswa</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <?php if (!empty($student_progress)): ?>
                    <div class="space-y-4">
                        <?php foreach ($student_progress as $index => $student): ?>
                            <div class="group bg-gradient-to-r from-gray-50 to-white rounded-2xl p-5 border border-gray-200/50 hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]"
                                 style="animation-delay: <?= $index * 0.1 ?>s">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-100 to-indigo-200 flex items-center justify-center text-blue-700 font-bold mr-4 shadow-lg">
                                            <?= strtoupper(substr($student['nama_lengkap'], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 group-hover:text-blue-700 transition-colors duration-300">
                                                <?= $student['nama_lengkap'] ?>
                                            </h4>
                                            <p class="text-sm text-gray-500">NIS: <?= $student['nis'] ?></p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-2xl font-black text-gray-800">
                                            <?= ($student['total_materi'] > 0) ? round(($student['completed_materi']/$student['total_materi'])*100) : 0 ?>%
                                        </div>
                                        <div class="text-xs text-gray-500 uppercase tracking-wide">
                                            Progress
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Materi Selesai</span>
                                        <span class="font-semibold text-gray-800">
                                            <?= $student['completed_materi'] ?>/<?= $student['total_materi'] ?> materi
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                        <div class="bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-600 h-3 rounded-full transition-all duration-1000 ease-out shadow-inner"
                                             style="width: <?= ($student['total_materi'] > 0) ? round(($student['completed_materi']/$student['total_materi'])*100) : 0 ?>%">
                                            <div class="h-full bg-white/20 animate-pulse"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-16">
                        <div class="mx-auto h-24 w-24 flex items-center justify-center rounded-full bg-gradient-to-br from-gray-100 to-gray-200 text-gray-400 shadow-inner mb-6">
                            <i class="fas fa-chart-line text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-700 mb-3">Belum Ada Data Progress</h3>
                        <p class="text-gray-500 max-w-md mx-auto">Data progress siswa akan muncul setelah ada aktivitas pembelajaran</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Jadwal Section -->
    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8">
        <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50/80 to-white/80">
            <h2 class="text-2xl font-bold text-gray-800">Jadwal Kelas</h2>
        </div>
        <div class="p-6">
            <?php if (!empty($jadwal)):
                foreach ($jadwal as $j):
            ?>
                <div class="p-4 mb-4 bg-gray-50 rounded-lg border border-gray-200">
                    <h4 class="font-semibold text-gray-900">Pertemuan <?php echo $j['pertemuan_ke']; ?>: <?php echo $j['judul_pertemuan']; ?></h4>
                    <p class="text-sm text-gray-600 mt-1"><?php echo date('d M Y', strtotime($j['tanggal_pertemuan'])); ?> | <?php echo date('H:i', strtotime($j['waktu_mulai'])); ?> - <?php echo date('H:i', strtotime($j['waktu_selesai'])); ?></p>
                </div>
            <?php 
                endforeach;
            else:
            ?>
                <p class="text-center text-gray-500 py-4">Belum ada jadwal untuk kelas ini.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Enhanced Materi Section -->
    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl ring-1 ring-gray-200/50 overflow-hidden mb-8 hover-lift border border-white/20">
        <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-violet-50/80 via-purple-50/80 to-pink-50/80">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div class="flex items-center">
                    <div class="p-3 rounded-2xl bg-gradient-to-br from-violet-100 to-purple-200 text-violet-700 mr-4 shadow-xl">
                        <i class="fas fa-book-open text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-800">Daftar Materi</h2>
                        <p class="text-gray-600 text-sm">Koleksi lengkap materi pembelajaran</p>
                    </div>
                </div>
                <?php if ($this->session->userdata('role') === 'admin'): ?>
                <a href="<?php echo site_url('materi/index/' . $kelas->id); ?>"
                   class="mt-4 sm:mt-0 group inline-flex items-center px-6 py-3 bg-gradient-to-r from-violet-500 to-purple-600 border border-transparent rounded-2xl font-bold text-white shadow-xl hover:from-violet-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                    <i class="fas fa-plus mr-3 group-hover:rotate-90 transition-transform duration-300"></i>
                    <span>Tambah Materi</span>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="p-6">
            <?php if (empty($materi)): ?>
                <div class="text-center py-20">
                    <div class="relative mx-auto h-32 w-32 mb-8">
                        <div class="absolute inset-0 bg-gradient-to-br from-violet-100 to-purple-200 rounded-full animate-pulse"></div>
                        <div class="relative flex items-center justify-center h-full w-full rounded-full bg-gradient-to-br from-gray-100 to-gray-200 text-gray-400 shadow-2xl">
                            <i class="fas fa-book-open text-5xl"></i>
                        </div>
                    </div>
                    <h3 class="text-3xl font-black text-gray-700 mb-4">Belum Ada Materi</h3>
                    <p class="text-gray-500 max-w-md mx-auto mb-8 text-lg">Mulai dengan membuat materi pertama untuk kelas ini dan berikan pengalaman belajar yang luar biasa</p>
                    <a href="<?php echo site_url('materi/create/' . $kelas->id); ?>"
                       class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-violet-500 to-purple-600 rounded-2xl text-white font-bold text-lg hover:from-violet-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                        <i class="fas fa-plus mr-3 group-hover:rotate-90 transition-transform duration-300"></i>
                        <span>Buat Materi Pertama</span>
                        <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($materi as $index => $item): ?>
                        <div class="group bg-gradient-to-br from-white to-gray-50/50 rounded-3xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 border border-white/20"
                             style="animation-delay: <?= $index * 0.1 ?>s">
                            <!-- Card Header with Gradient -->
                            <div class="h-2 bg-gradient-to-r from-violet-500 via-purple-600 to-pink-600"></div>

                            <div class="p-6">
                                <!-- Materi Icon -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="p-3 rounded-2xl bg-gradient-to-br from-violet-100 to-purple-200 text-violet-700 shadow-lg group-hover:shadow-xl transition-all duration-300">
                                        <i class="fas fa-book text-xl"></i>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                        <span class="text-xs text-gray-500 font-medium">Aktif</span>
                                    </div>
                                </div>

                                <!-- Materi Title -->
                                <h3 class="text-xl font-black text-gray-800 group-hover:text-violet-700 transition-colors duration-300 mb-3 leading-tight">
                                    <?php echo $item['judul']; ?>
                                </h3>

                                <!-- Materi Description -->
                                <p class="text-gray-600 line-clamp-2 mb-6 text-sm leading-relaxed">
                                    <?php echo $item['deskripsi']; ?>
                                </p>

                                <!-- Action Buttons -->
                                <div class="flex flex-col space-y-3">
                                    <button class="group/btn inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white text-sm font-bold rounded-2xl hover:from-indigo-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl"
                                            onclick="viewParts(<?php echo json_encode($item['parts']); ?>, '<?php echo addslashes($item['judul']); ?>')">
                                        <i class="fas fa-list-ul mr-2 group-hover/btn:animate-bounce"></i>
                                        <span>Lihat Parts</span>
                                    </button>
                                    <a href="<?php echo site_url('materi/detail/' . $item['id']); ?>"
                                       class="group/btn inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-violet-500 to-purple-600 text-white text-sm font-bold rounded-2xl hover:from-violet-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        <i class="fas fa-cog mr-2 group-hover/btn:rotate-90 transition-transform duration-300"></i>
                                        <span>Kelola Materi</span>
                                    </a>
                                </div>

                                <!-- Progress Indicator -->
                                <div class="mt-4 pt-4 border-t border-gray-200/50">
                                    <div class="flex items-center justify-between text-xs text-gray-500 mb-2">
                                        <span>Parts Tersedia</span>
                                        <span class="font-bold"><?php echo count($item['parts']); ?> parts</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-violet-500 to-purple-600 h-2 rounded-full transition-all duration-1000 ease-out"
                                             style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Enhanced Modal -->
<div id="parts-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/60 backdrop-blur-md animate-fade-in" onclick="closeModal()"></div>
    <div class="relative bg-white/95 backdrop-blur-xl rounded-3xl shadow-3xl w-full max-w-lg max-h-[90vh] overflow-auto z-10 border border-white/20 animate-scale-in">
        <!-- Modal Header with Gradient -->
        <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-violet-50/80 via-purple-50/80 to-pink-50/80 rounded-t-3xl">
            <div class="flex items-center">
                <div class="p-3 rounded-2xl bg-gradient-to-br from-violet-100 to-purple-200 text-violet-700 mr-4 shadow-xl">
                    <i class="fas fa-list-ul text-xl"></i>
                </div>
                <div>
                    <h3 id="modal-title" class="text-xl font-black text-gray-800"></h3>
                    <p class="text-sm text-gray-600">Detail lampiran materi</p>
                </div>
            </div>
            <button onclick="closeModal()"
                    class="absolute top-4 right-4 p-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-400 hover:text-gray-600 transition-all duration-300 transform hover:scale-110">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <div id="modal-body" class="p-6">
            <!-- Content will be injected here -->
        </div>
    </div>
</div>

<style>
/* Custom animations for enhanced modern look */
@keyframes gradient-x {
    0%, 100% {
        background-size: 200% 200%;
        background-position: left center;
    }
    50% {
        background-size: 200% 200%;
        background-position: right center;
    }
}

@keyframes bounce-gentle {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-5px);
    }
}

@keyframes spin-slow {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes scale-in {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.5s ease-out;
}

.animate-scale-in {
    animation: scale-in 0.3s ease-out;
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out;
}

.animate-gradient-x {
    animation: gradient-x 15s ease infinite;
}

.animate-bounce-gentle {
    animation: bounce-gentle 2s ease-in-out infinite;
}

.animate-spin-slow {
    animation: spin-slow 3s linear infinite;
}

/* Enhanced hover effects */
.hover-lift:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

.hover-glow:hover {
    box-shadow: 0 0 30px rgba(59, 130, 246, 0.3);
}

/* Smooth transitions for all elements */
* {
    transition: all 0.3s ease;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(45deg, #2563eb, #7c3aed);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const page = document.querySelector('.transition-opacity');
    if (page) page.classList.add('opacity-100');

    // Add intersection observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);

    // Observe all major sections
    document.querySelectorAll('.bg-white\\/90, .bg-white\\/80').forEach(section => {
        observer.observe(section);
    });

    // Add loading animation for stats cards
    const statsCards = document.querySelectorAll('[class*="group bg-white"]');
    statsCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('animate-fade-in-up');
    });

    const modal = document.getElementById('parts-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalBody = document.getElementById('modal-body');

    // Enhanced parts viewing function
    window.viewParts = function(partsData, judul) {
        const parts = partsData;
            
            modalTitle.textContent = 'Lampiran untuk: ' + judul;
            
            if (parts.length > 0) {
                let content = '<div class="space-y-3">';
                parts.forEach(part => {
                    let icon = '';
                    let color = '';
                    switch(part.part_type) {
                        case 'video': 
                            icon = 'fa-video';
                            color = 'bg-red-100 text-red-600';
                            break;
                        case 'image': 
                            icon = 'fa-image';
                            color = 'bg-blue-100 text-blue-600';
                            break;
                        case 'pdf': 
                            icon = 'fa-file-pdf';
                            color = 'bg-purple-100 text-purple-600';
                            break;
                        case 'link': 
                            icon = 'fa-link';
                            color = 'bg-green-100 text-green-600';
                            break;
                    }
                    
                    content += `
                        <div class="flex items-center p-3 rounded-lg ${color} bg-opacity-50">
                            <i class="fas ${icon} mr-3 text-lg"></i>
                            <div>
                                <h4 class="font-medium">${part.part_title}</h4>
                                <p class="text-xs text-gray-500">${part.part_type}</p>
                            </div>
                        </div>
                    `;
                });
                content += '</div>';
                modalBody.innerHTML = content;
            } else {
                modalBody.innerHTML = '<p class="text-center text-gray-500 py-8">Tidak ada lampiran untuk materi ini.</p>';
            }
            
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });

    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    window.closeModal = closeModal;
});

// Attendance Chart - with error handling
try {
    const attendanceChartElement = document.getElementById('attendanceChart');
    if (attendanceChartElement) {
        const ctx = attendanceChartElement.getContext('2d');
        const attendanceChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Hadir', 'Sakit', 'Izin', 'Alpa'],
                datasets: [{
                    data: [
                        <?= $attendance_stats['Hadir'] ?>,
                        <?= $attendance_stats['Sakit'] ?>,
                        <?= $attendance_stats['Izin'] ?>,
                        <?= $attendance_stats['Alpa'] ?>
                    ],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
} catch (error) {
    console.warn('Chart.js initialization failed:', error);
}
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0?v=1"></script>

<?php $this->load->view('templates/footer'); ?>