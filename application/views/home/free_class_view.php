
<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-br from-green-500 to-emerald-600">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="flex items-center mb-6">
                        <div class="flex items-center justify-center h-16 w-16 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-2xl mr-4">
                            <i data-feather="check-circle" class="w-8 h-8"></i>
                        </div>
                        <div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-500 text-white backdrop-blur-sm">
                                GRATIS
                            </span>
                            <h1 class="text-4xl md:text-5xl font-bold text-white mt-2"><?= html_escape($free_class->title) ?></h1>
                            <p class="text-white/80 mt-2"><?= html_escape($free_class->description) ?></p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-white/10 backdrop-blur-md rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-white"><?= html_escape($free_class->level) ?></div>
                            <div class="text-white/70 text-sm">Level</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-white"><?= html_escape($free_class->duration) ?> Jam</div>
                            <div class="text-white/70 text-sm">Durasi</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-white"><?= html_escape($enrolled_count) ?></div>
                            <div class="text-white/70 text-sm">Siswa Terdaftar</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-white">Rp 0</div>
                            <div class="text-white/70 text-sm">Harga</div>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="<?= site_url('auth/login?redirect=home/view_free_class/' . $free_class->id) ?>" class="bg-white text-green-600 px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition-colors text-center">
                            Mulai Belajar Sekarang
                        </a>
                        <a href="<?= site_url('home/free') ?>" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white/10 transition-colors text-center">
                            Kembali ke Daftar Kelas
                        </a>
                    </div>
                </div>
                
                <div class="relative">
                    <img src="<?= $free_class->thumbnail ? base_url('uploads/free_class/' . $free_class->thumbnail) : 'http://static.photos/technology/640x360/5' ?>" alt="<?= html_escape($free_class->title) ?>" class="w-full rounded-2xl shadow-2xl">
                    <div class="absolute -top-4 -right-4 bg-green-400 text-green-900 px-4 py-2 rounded-full font-bold text-sm">
                        ⭐ 4.8/5 Rating
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
                    Dalam kelas gratis ini, Anda akan mempelajari konsep-konsep penting dan praktik langsung yang relevan dengan industri
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if (!empty($materials)): ?>
                    <?php foreach ($materials as $index => $material): ?>
                        <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                    <i data-feather="play-circle" class="w-6 h-6 text-green-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800"><?= html_escape($material->title) ?></h3>
                                    <p class="text-sm text-gray-600">Modul <?php echo $index + 1; ?></p>
                                </div>
                            </div>
                            <?php if ($material->description): ?>
                                <p class="text-gray-600 mb-4"><?= html_escape($material->description) ?></p>
                            <?php endif; ?>
                            <div class="flex items-center text-sm text-gray-500">
                                <i data-feather="file-text" class="w-4 h-4 mr-2"></i>
                                <span><?= html_escape(ucfirst($material->content_type)) ?></span>
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

    <!-- About Mentor Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Tentang Mentor</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Kenali mentor yang akan membimbing Anda dalam perjalanan belajar
                </p>
            </div>
            
            <div class="max-w-4xl mx-auto" data-aos="fade-up">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <div class="flex items-center space-x-6">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center">
                            <i data-feather="user" class="w-10 h-10 text-green-600"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2"><?= html_escape($free_class->mentor_name) ?></h3>
                            <p class="text-gray-600 mb-4">Mentor profesional dengan pengalaman dalam bidang <?= html_escape($free_class->category) ?></p>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <div class="flex items-center">
                                    <i data-feather="briefcase" class="w-4 h-4 mr-2"></i>
                                    <span>Expert di <?= html_escape($free_class->category) ?></span>
                                </div>
                                <div class="flex items-center">
                                    <i data-feather="users" class="w-4 h-4 mr-2"></i>
                                    <span>+500 siswa diajar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Class Schedule Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Jadwal Kelas</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Jadwal pembelajaran dan topik yang akan dibahas dalam kelas ini
                </p>
            </div>
            
            <?php if ($free_class->start_date && $free_class->end_date): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                    <div class="bg-gray-50 rounded-xl p-6 text-center" data-aos="fade-up">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-feather="calendar" class="w-8 h-8 text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Tanggal Mulai</h3>
                        <p class="text-2xl font-bold text-green-600"><?= date('d M Y', strtotime($free_class->start_date)) ?></p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-6 text-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-feather="calendar" class="w-8 h-8 text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Tanggal Selesai</h3>
                        <p class="text-2xl font-bold text-blue-600"><?= date('d M Y', strtotime($free_class->end_date)) ?></p>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <p class="text-gray-500">Kelas tersedia segera, mulai belajar kapan saja</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Keuntungan Kelas Gratis</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Mengapa memilih kelas gratis di Aset Academy?
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-feather="dollar-sign" class="w-8 h-8 text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Gratis 100%</h3>
                    <p class="text-gray-600">Akses lengkap materi tanpa biaya apapun</p>
                </div>
                
                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-feather="clock" class="w-8 h-8 text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Flexible Learning</h3>
                    <p class="text-gray-600">Belajar sesuai jadwal Anda sendiri</p>
                </div>
                
                <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-feather="refresh-cw" class="w-8 h-8 text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Update Konten</h3>
                    <p class="text-gray-600">Materi selalu diperbarui dengan teknologi terkini</p>
                </div>
                
                <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-feather="users" class="w-8 h-8 text-orange-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Community Support</h3>
                    <p class="text-gray-600">Bergabung dengan komunitas pembelajar</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Requirements Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Persyaratan</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Persiapan yang dibutuhkan sebelum memulai kelas
                </p>
            </div>
            
            <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-50 rounded-xl p-8" data-aos="fade-up">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Persyaratan Utama</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-0.5">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Koneksi Internet Stabil</h4>
                                <p class="text-gray-600 text-sm">Pastikan koneksi internet Anda cukup untuk streaming video</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-0.5">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Perangkat Komputer/Laptop</h4>
                                <p class="text-gray-600 text-sm">PC atau laptop dengan spesifikasi minimal</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-0.5">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Minimalkan Pemahaman Dasar</h4>
                                <p class="text-gray-600 text-sm">Pemahaman dasar programming akan membantu</p>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <div class="bg-gray-50 rounded-xl p-8" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Rekomendasi</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mr-4 mt-0.5">
                                <i data-feather="star" class="w-4 h-4 text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Headphone/Earphone</h4>
                                <p class="text-gray-600 text-sm">Untuk pengalaman belajar yang lebih fokus</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mr-4 mt-0.5">
                                <i data-feather="star" class="w-4 h-4 text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Catatan Digital</h4>
                                <p class="text-gray-600 text-sm">Siapkan aplikasi catatan untuk menyimpan poin penting</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mr-4 mt-0.5">
                                <i data-feather="star" class="w-4 h-4 text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Dedikasi Waktu</h4>
                                <p class="text-gray-600 text-sm">Alokasikan waktu minimal 2 jam per minggu</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Classes -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Kelas Lainnya</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Jelajahi kelas gratis lainnya yang mungkin Anda minati
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php 
                $related_classes = $this->Free_class_model->get_recent_free_classes(3);
                foreach ($related_classes as $related_class): 
                    if ($related_class->id != $free_class->id): 
                ?>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative overflow-hidden">
                        <img src="<?= $related_class->thumbnail ? base_url('uploads/free_class/' . $related_class->thumbnail) : 'http://static.photos/technology/640x360/5' ?>" alt="<?= html_escape($related_class->title) ?>" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            Gratis
                        </div>
                        <div class="absolute top-4 right-4 bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">
                            <?= html_escape($related_class->level) ?>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3"><?= html_escape($related_class->title) ?></h3>
                        <p class="text-gray-600 mb-4"><?= html_escape($related_class->description) ?></p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-500"><?= html_escape($related_class->duration) ?> Jam</span>
                            <div class="flex items-center">
                                <span class="text-yellow-400 mr-1">★</span>
                                <span class="text-sm text-gray-600">4.8</span>
                            </div>
                        </div>
                        <a href="<?= site_url('home/view_free_class/' . $related_class->id) ?>" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors text-center">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                <?php 
                    endif;
                endforeach; 
                ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-green-500 to-emerald-600">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6" data-aos="fade-up">
                Siap Memulai Perjalanan Belajar?
            </h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Bergabunglah dengan ribuan siswa lainnya dan mulai belajar programming dengan metode terbaik tanpa biaya
            </p>
            <div data-aos="fade-up" data-aos-delay="200">
                <a href="<?= site_url('auth/login?redirect=home/view_free_class/' . $free_class->id) ?>" class="px-8 py-4 bg-white text-green-600 font-bold rounded-lg hover:bg-gray-100 transition-colors">
                    Mulai Belajar Sekarang
                </a>
            </div>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>