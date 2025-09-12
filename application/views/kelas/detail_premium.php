
<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-br from-blue-600 to-indigo-700">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="flex items-center mb-6">
                        <div class="flex items-center justify-center h-16 w-16 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-2xl mr-4">
                            <i class="fas fa-code"></i>
                        </div>
                        <div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-500 text-white backdrop-blur-sm">
                                PREMIUM
                            </span>
                            <h1 class="text-4xl md:text-5xl font-bold text-white mt-2"><?php echo $kelas->nama_kelas; ?></h1>
                            <p class="text-white/80 mt-2"><?php echo $kelas->deskripsi; ?></p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-white/10 backdrop-blur-md rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-white"><?php echo $kelas->level; ?></div>
                            <div class="text-white/70 text-sm">Level</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-white"><?php echo $kelas->durasi; ?> Jam</div>
                            <div class="text-white/70 text-sm">Durasi</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-white"><?php echo $enrolled_count; ?></div>
                            <div class="text-white/70 text-sm">Siswa Terdaftar</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-white">Rp <?php echo number_format($kelas->harga, 0, ',', '.'); ?></div>
                            <div class="text-white/70 text-sm">Harga</div>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="<?php echo site_url('payment/initiate/' . $kelas->id); ?>" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition-colors text-center">
                            Daftar Sekarang
                        </a>
                        <a href="<?php echo site_url('home/premium'); ?>" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white/10 transition-colors text-center">
                            Kembali ke Daftar Kelas
                        </a>
                    </div>
                </div>
                
                <div class="relative">
                    <img src="<?php echo $kelas->gambar ? base_url('uploads/kelas/' . $kelas->gambar) : 'http://static.photos/technology/640x360/2'; ?>" alt="<?php echo html_escape($kelas->nama_kelas); ?>" class="w-full rounded-2xl shadow-2xl">
                    <div class="absolute -top-4 -right-4 bg-yellow-400 text-yellow-900 px-4 py-2 rounded-full font-bold text-sm">
                        ⭐ 4.9/5 Rating
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What You'll Learn Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Apa yang Akan Anda Pelajari?</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Dalam kelas premium ini, Anda akan mempelajari konsep-konsep penting dan praktik langsung yang relevan dengan industri
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if (!empty($materi)): ?>
                    <?php foreach ($materi as $index => $materi_item): ?>
                        <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-play-circle text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800"><?php echo html_escape($materi_item['judul']); ?></h3>
                                    <p class="text-sm text-gray-600">Modul <?php echo $index + 1; ?></p>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-4"><?php echo html_escape($materi_item['deskripsi']); ?></p>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-clock mr-2"></i>
                                <span><?php echo count($materi_item['parts']); ?> Sub-materi</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500">Materi kelas sedang dalam proses persiapan</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Schedule Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Jadwal Kelas</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Jadwal pertemuan dan topik yang akan dibahas dalam kelas ini
                </p>
            </div>
            
            <?php if (!empty($jadwal)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach ($jadwal as $j): ?>
                        <div class="bg-white rounded-xl p-6 shadow-md" data-aos="fade-up" data-aos-delay="100">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-800">Pertemuan <?php echo $j['pertemuan_ke']; ?></h3>
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm"><?php echo html_escape($j['judul_pertemuan']); ?></span>
                            </div>
                            <div class="space-y-2 text-gray-600">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt mr-3 text-blue-500"></i>
                                    <span><?php echo date('d M Y', strtotime($j['tanggal_pertemuan'])); ?></span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-3 text-blue-500"></i>
                                    <span><?php echo date('H:i', strtotime($j['waktu_mulai'])); ?> - <?php echo date('H:i', strtotime($j['waktu_selesai'])); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <p class="text-gray-500">Jadwal kelas akan diumumkan segera</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Keuntungan Kelas Premium</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Mengapa memilih kelas premium di Aset Academy?
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-feather="award" class="w-8 h-8 text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Sertifikat Resmi</h3>
                    <p class="text-gray-600">Dapatkan sertifikat resmi yang diakui industri setelah menyelesaikan kelas</p>
                </div>
                
                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-feather="users" class="w-8 h-8 text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Dukungan Mentor</h3>
                    <p class="text-gray-600">Akses langsung ke mentor profesional untuk konsultasi dan bimbingan</p>
                </div>
                
                <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-feather="briefcase" class="w-8 h-8 text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Project Nyata</h3>
                    <p class="text-gray-600">Belajar melalui real-world projects yang relevan dengan kebutuhan industri</p>
                </div>
                
                <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-feather="clock" class="w-8 h-8 text-orange-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Akses Seumur Hidup</h3>
                    <p class="text-gray-600">Akses materi selamanya termasuk update konten terbaru</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Student Progress Preview -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Progress Siswa</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Lihat progress pembelajaran siswa dalam kelas ini
                </p>
            </div>
            
            <?php if (!empty($student_progress)): ?>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-800">Progress Siswa Terbaru</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($student_progress as $student): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $student['nama_lengkap'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $student['nis'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?= ($student['total_materi'] > 0) ? round(($student['completed_materi']/$student['total_materi'])*100) : 0 ?>%"></div>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">
                                                <?= ($student['total_materi'] > 0) ? round(($student['completed_materi']/$student['total_materi'])*100) : 0 ?>% (<?= $student['completed_materi'] ?>/<?= $student['total_materi'] ?>)
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <p class="text-gray-500">Belum ada data progress siswa</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Attendance Statistics -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Statistik Absensi</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Overview kehadiran siswa dalam kelas ini
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="text-center p-6 bg-green-50 rounded-xl">
                    <div class="text-3xl font-bold text-green-600"><?= !empty($attendance_stats['Hadir']) ? $attendance_stats['Hadir'] : 0 ?></div>
                    <div class="text-green-700 font-medium">Hadir</div>
                </div>
                <div class="text-center p-6 bg-yellow-50 rounded-xl">
                    <div class="text-3xl font-bold text-yellow-600"><?= !empty($attendance_stats['Sakit']) ? $attendance_stats['Sakit'] : 0 ?></div>
                    <div class="text-yellow-700 font-medium">Sakit</div>
                </div>
                <div class="text-center p-6 bg-blue-50 rounded-xl">
                    <div class="text-3xl font-bold text-blue-600"><?= !empty($attendance_stats['Izin']) ? $attendance_stats['Izin'] : 0 ?></div>
                    <div class="text-blue-700 font-medium">Izin</div>
                </div>
                <div class="text-center p-6 bg-red-50 rounded-xl">
                    <div class="text-3xl font-bold text-red-600"><?= !empty($attendance_stats['Alpa']) ? $attendance_stats['Alpa'] : 0 ?></div>
                    <div class="text-red-700 font-medium">Alpa</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-700">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6" data-aos="fade-up">
                Siap Memulai Perjalanan Belajar?
            </h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Bergabunglah dengan ribuan siswa lainnya dan mulai belajar programming dengan metode terbaik
            </p>
            <div data-aos="fade-up" data-aos-delay="200">
                <a href="<?php echo site_url('payment/initiate/' . $kelas->id); ?>" class="px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:bg-gray-100 transition-colors">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>