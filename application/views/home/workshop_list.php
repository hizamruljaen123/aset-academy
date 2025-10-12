<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Workshop List Hero Section -->
    <section class="relative pt-32 pb-24 overflow-hidden" style="background: linear-gradient(135deg, #0e1127 0%, #2e3c73 50%, #198aad 100%);">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/5 w-96 h-96 rounded-full pulse-blob" style="background: rgba(30, 60, 115, 0.2);"></div>
            <div class="absolute -bottom-20 right-[10%] w-[420px] h-[330px] rounded-full pulse-blob" style="background: rgba(25, 138, 173, 0.15); animation-delay: 2.5s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 rounded-full pulse-blob" style="background: rgba(14, 17, 39, 0.1); animation-delay: 4s;"></div>
        </div>

        <div class="relative container mx-auto px-4 text-center z-10">
            <!-- Badge -->
            <div class="flex items-center justify-center mb-6" data-aos="zoom-in">
                <span class="bg-white/10 text-white px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm border border-white/20">
                    🎯 Workshop & Seminar
                </span>
            </div>

            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight" data-aos="fade-up">
                Workshop & 
                <span class="block" style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Seminar
                </span>
            </h1>
            
            <p class="text-xl text-white/80 max-w-3xl mx-auto mb-10 leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                Tingkatkan kemampuan teknologi dengan workshop intensif dan seminar berkualitas 
                dari para ahli berpengalaman di industri teknologi.
            </p>

           
        </div>
    </section>

    <!-- Workshop List Section -->
    <section class="py-20 bg-gradient-to-br from-slate-50 via-white to-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-14" data-aos="fade-up">
                <div class="flex items-center justify-center mb-6">
                    <span class="text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg"
                          style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                        📅 Workshop Tersedia
                    </span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Workshop & Seminar Mendatang</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Daftarkan diri Anda untuk mengikuti workshop dan seminar teknologi yang akan datang
                </p>
            </div>

            <?php if (!empty($workshops)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($workshops as $workshop): ?>
                    <div class="group bg-white rounded-2xl shadow-xl hover:shadow-2xl overflow-hidden border border-gray-100 hover:border-indigo-300 transition-all duration-500 hover:-translate-y-2" data-aos="fade-up">
                        <div class="relative overflow-hidden">
                            <?php if ($workshop->thumbnail): ?>
                                <img src="<?= $workshop->thumbnail ?>" alt="<?= html_escape($workshop->title) ?>" class="w-full h-52 object-cover group-hover:scale-110 transition-transform duration-500">
                            <?php else: ?>
                                <div class="w-full h-52 bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center">
                                    <i class="fas fa-chalkboard-teacher text-indigo-600 text-5xl"></i>
                                </div>
                            <?php endif; ?>

                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                            <div class="absolute top-4 left-4">
                                <span class="text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-lg"
                                      style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <?= $workshop->type == 'workshop' ? '🎯 Workshop' : '📢 Seminar' ?>
                                </span>
                            </div>

                            <div class="absolute top-4 right-4">
                                <?php if ($workshop->price > 0): ?>
                                    <span class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-lg">
                                        💰 Rp <?= number_format($workshop->price, 0, ',', '.') ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-lg"
                                          style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                        🎁 Gratis
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-1">
                            <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-indigo-600 transition-colors">
                                <?= html_escape($workshop->title) ?>
                            </h3>

                            <p class="text-gray-600 mb-5 line-clamp-3 leading-relaxed">
                                <?= html_escape($workshop->description) ?>
                            </p>

                            <div class="space-y-3 mb-6">
                                <div class="flex items-center text-sm text-gray-700">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-calendar-alt text-blue-600"></i>
                                    </div>
                                    <span class="font-medium"><?= date('d F Y', strtotime($workshop->start_datetime)) ?></span>
                                </div>

                                <div class="flex items-center text-sm text-gray-700">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-clock text-purple-600"></i>
                                    </div>
                                    <span class="font-medium">
                                        <?= date('H:i', strtotime($workshop->start_datetime)) ?> -
                                        <?= date('H:i', strtotime($workshop->end_datetime)) ?> WIB
                                    </span>
                                </div>

                                <div class="flex items-center text-sm text-gray-700">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-map-marker-alt text-green-600"></i>
                                    </div>
                                    <span class="truncate font-medium"><?= html_escape($workshop->location) ?></span>
                                </div>
                            </div>

                            <div class="mt-auto pt-4 border-t border-gray-100">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-sm">
                                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-2">
                                            <i class="fas fa-users text-orange-600"></i>
                                        </div>
                                        <span class="text-gray-700 font-medium">
                                            <?php if ($workshop->max_participants > 0): ?>
                                                <?= $workshop->participant_count; ?>/<?= $workshop->max_participants; ?>
                                            <?php else: ?>
                                                <?= $workshop->participant_count; ?>+
                                            <?php endif; ?>
                                        </span>
                                    </div>

                                    <a href="<?= site_url('workshops/detail/' . encrypt_url($workshop->id)) ?>" class="group/btn text-white px-6 py-2.5 rounded-xl transition-all duration-300 text-sm font-semibold shadow-lg hover:shadow-xl flex items-center gap-2"
                                       style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                        Detail
                                        <i class="fas fa-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-20" data-aos="fade-up">
                    <div class="w-32 h-32 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="fas fa-chalkboard-teacher text-indigo-600 text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum Ada Workshop atau Seminar</h3>
                    <p class="text-lg text-gray-600 mb-6 max-w-md mx-auto">
                        Workshop dan seminar akan segera tersedia. Silakan kembali lagi nanti atau hubungi kami untuk informasi lebih lanjut.
                    </p>
                    <a href="<?= site_url('contact') ?>" class="inline-flex items-center gap-2 px-8 py-3 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg"
                       style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                        <i class="fas fa-envelope"></i>
                        Hubungi Kami
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 relative overflow-hidden" style="background: linear-gradient(135deg, #0e1127 0%, #2e3c73 50%, #198aad 100%);">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 rounded-full pulse-blob" style="background: rgba(30, 60, 115, 0.1);"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full pulse-blob" style="background: rgba(25, 138, 173, 0.1); animation-delay: 2s;"></div>
        </div>

        <div class="relative container mx-auto px-4 text-center z-10">
            <!-- Badge -->
            <div class="flex items-center justify-center mb-8" data-aos="fade-down">
                <span class="bg-white/10 text-white px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm border border-white/20">
                    🎯 Mulai Perjalanan Belajar
                </span>
            </div>

            <h2 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight" data-aos="fade-up">
                Tertarik Mengikuti
                <span class="block" style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Workshop atau Seminar?
                </span>
            </h2>
            
            <p class="text-xl text-white/80 mb-12 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                Daftar sekarang dan dapatkan pengetahuan baru dari para ahli berpengalaman di industri teknologi
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-6" data-aos="fade-up" data-aos-delay="200">
                <?php if ($this->session->userdata('user_id')): ?>
                    <a href="#workshops" class="group px-10 py-5 text-white font-bold rounded-2xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3 shadow-2xl text-lg"
                       style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                        <i class="fas fa-search group-hover:scale-110 transition-transform"></i>
                        Jelajahi Workshop
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                <?php else: ?>
                    <a href="<?= site_url('auth/login') ?>" class="group px-10 py-5 text-white font-bold rounded-2xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3 shadow-2xl text-lg"
                       style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                        <i class="fas fa-sign-in-alt group-hover:scale-110 transition-transform"></i>
                        Login untuk Mendaftar
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                <?php endif; ?>
                <a href="<?= site_url('home') ?>" class="group px-10 py-5 bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white font-bold rounded-2xl hover:bg-white/20 hover:scale-105 transition-all duration-300 shadow-xl text-lg">
                    <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>
