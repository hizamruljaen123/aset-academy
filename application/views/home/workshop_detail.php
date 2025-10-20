<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Workshop Detail Hero Section -->
    <section class="pt-20 pb-16 relative overflow-hidden" style="background: linear-gradient(135deg, #0e1127 0%, #2e3c73 50%, #198aad 100%);">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 rounded-full pulse-blob" style="background: rgba(30, 60, 115, 0.2);"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full pulse-blob" style="background: rgba(25, 138, 173, 0.15); animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 rounded-full pulse-blob" style="background: rgba(14, 17, 39, 0.1); animation-delay: 4s;"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="lg:w-1/2" data-aos="fade-right" data-aos-duration="1000">
                    <!-- Badge -->
                    <div class="flex items-center mb-6">
                        <span class="bg-white/10 text-white px-4 py-2 rounded-xl text-sm font-semibold backdrop-blur-sm border border-white/20"
                              style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                            <?= $workshop->type == 'workshop' ? '🎯 Workshop' : '📢 Seminar' ?>
                        </span>
                        <?php if ($workshop->price > 0): ?>
                            <span class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-4 py-2 rounded-xl text-sm font-semibold ml-3 shadow-lg">
                                💰 Rp <?= number_format($workshop->price, 0, ',', '.') ?>
                            </span>
                        <?php else: ?>
                            <span class="text-white px-4 py-2 rounded-xl text-sm font-semibold ml-3 shadow-lg"
                                  style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                🎁 Gratis
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight mb-6">
                        <?= html_escape($workshop->title) ?>
                    </h1>

                    <!-- Workshop Info -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <div class="bg-white/5 backdrop-blur-sm rounded-xl p-4 border border-white/10">
                            <div class="flex items-center text-white/90 mb-2">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3"
                                     style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <i class="fas fa-calendar-alt text-white text-sm"></i>
                                </div>
                                <span class="font-semibold">Tanggal</span>
                            </div>
                            <p class="text-white text-sm"><?= date('d F Y', strtotime($workshop->start_datetime)) ?></p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-xl p-4 border border-white/10">
                            <div class="flex items-center text-white/90 mb-2">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3"
                                     style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <i class="fas fa-clock text-white text-sm"></i>
                                </div>
                                <span class="font-semibold">Waktu</span>
                            </div>
                            <p class="text-white text-sm">
                                <?= date('H:i', strtotime($workshop->start_datetime)) ?> -
                                <?= date('H:i', strtotime($workshop->end_datetime)) ?>
                            </p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-xl p-4 border border-white/10">
                            <div class="flex items-center text-white/90 mb-2">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3"
                                     style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <i class="fas fa-map-marker-alt text-white text-sm"></i>
                                </div>
                                <span class="font-semibold">Lokasi</span>
                            </div>
                            <p class="text-white text-sm"><?= html_escape($workshop->location) ?></p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-6">
                        <?php if ($is_registered): ?>
                            <div class="text-white px-8 py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105"
                                 style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                <i class="fas fa-check-circle mr-2"></i>
                                Sudah Terdaftar
                            </div>
                        <?php elseif ($this->session->userdata('user_id')): ?>
                            <?php if ($max_participants == 0 || $participant_count < $max_participants): ?>
                                <a href="<?= workshop_register_url($workshop->id) ?>"
                                   class="text-white px-8 py-4 rounded-xl transition-all duration-300 font-semibold shadow-lg hover:shadow-xl hover:scale-105 inline-flex items-center"
                                   style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Daftar Sekarang
                                </a>
                            <?php else: ?>
                                <div class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-8 py-4 rounded-xl font-semibold shadow-lg cursor-not-allowed">
                                    <i class="fas fa-users mr-2"></i>
                                    Kuota Penuh
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                                <a href="<?= site_url('auth/login?redirect=' . urlencode(workshop_detail_url($workshop->id))) ?>"
                                   class="text-white px-8 py-4 rounded-xl transition-all duration-300 font-semibold shadow-lg hover:shadow-xl hover:scale-105 inline-flex items-center"
                                   style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Login & Daftar sebagai Member
                                </a>

                                <button type="button" onclick="openGuestModal()"
                                        class="text-white px-8 py-4 rounded-xl transition-all duration-300 font-semibold shadow-lg hover:shadow-xl hover:scale-105 inline-flex items-center"
                                        style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Daftar sebagai Tamu
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Participant Count -->
                    <div class="flex items-center text-white/90 bg-white/5 backdrop-blur-sm rounded-xl p-4 border border-white/10 w-fit">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3"
                             style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                            <i class="fas fa-users text-white text-sm"></i>
                        </div>
                        <span class="font-semibold">
                            <?php if ($max_participants > 0): ?>
                                <?= $participant_count ?>/<?= $max_participants ?> Peserta
                            <?php else: ?>
                                <?= $participant_count ?> Peserta
                            <?php endif; ?>
                        </span>
                    </div>
                </div>

                <div class="lg:w-1/2 flex justify-center" data-aos="fade-left" data-aos-duration="1000">
                    <div class="relative group">
                        <?php if ($workshop->thumbnail): ?>
                            <img src="<?= $workshop->thumbnail ?>" alt="<?= html_escape($workshop->title) ?>"
                                 class="w-full max-w-md rounded-2xl shadow-2xl group-hover:scale-105 transition-transform duration-500">
                        <?php else: ?>
                            <div class="w-full max-w-md h-80 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-2xl shadow-2xl flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                                <div class="text-center">
                                    <i class="fas fa-chalkboard-teacher text-indigo-600 text-6xl mb-4"></i>
                                    <p class="text-indigo-600 font-semibold">Workshop Image</p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- Decorative elements -->
                        <div class="absolute -top-4 -right-4 w-8 h-8 rounded-full opacity-80"
                             style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);"></div>
                        <div class="absolute -bottom-4 -left-4 w-6 h-6 rounded-full opacity-80"
                             style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Workshop Details Section -->
    <section class="py-16 bg-gradient-to-br from-slate-50 via-white to-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Description Card -->
                    <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500" data-aos="fade-up" data-aos-duration="1000">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center mr-4"
                                 style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                <i class="fas fa-info-circle text-white text-xl"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Deskripsi Workshop</h2>
                        </div>
                        <div class="prose max-w-none text-gray-700 leading-relaxed">
                            <?= nl2br(html_escape($workshop->description)) ?>
                        </div>
                    </div>

                    <!-- Materials Section -->
                    <?php if (!empty($materials)): ?>
                    <div class="bg-white rounded-2xl p-8 mt-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center mr-4"
                                 style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                <i class="fas fa-book text-white text-xl"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Materi Yang Akan Dipelajari</h2>
                        </div>
                        <div class="space-y-4">
                            <?php foreach ($materials as $index => $material): ?>
                            <div class="flex items-center p-6 bg-gradient-to-r from-gray-50 to-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105 border border-gray-100">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-xl flex items-center justify-center">
                                        <?php if ($material->file_type == 'pdf'): ?>
                                            <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-600 rounded-xl flex items-center justify-center">
                                                <i class="fas fa-file-pdf text-white text-xl"></i>
                                            </div>
                                        <?php elseif ($material->file_type == 'video'): ?>
                                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                                <i class="fas fa-video text-white text-xl"></i>
                                            </div>
                                        <?php elseif ($material->file_type == 'link'): ?>
                                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                                                <i class="fas fa-link text-white text-xl"></i>
                                            </div>
                                        <?php else: ?>
                                            <div class="w-12 h-12 bg-gradient-to-r from-gray-500 to-gray-600 rounded-xl flex items-center justify-center">
                                                <i class="fas fa-file text-white text-xl"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="font-semibold text-gray-800 text-lg"><?= html_escape($material->title) ?></h3>
                                    <?php if ($material->description): ?>
                                        <p class="text-sm text-gray-600 mt-2"><?= html_escape($material->description) ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= $index + 1 ?>
                                    </span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Workshop Info Card -->
                    <div class="bg-white rounded-2xl p-6 mb-6 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500" data-aos="fade-left" data-aos-duration="1000">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center mr-3"
                                 style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                <i class="fas fa-info-circle text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Informasi Workshop</h3>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3"
                                     style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <i class="fas fa-calendar-alt text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Tanggal</p>
                                    <p class="text-sm text-gray-800 font-semibold">
                                        <?= date('d F Y', strtotime($workshop->start_datetime)) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3"
                                     style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <i class="fas fa-clock text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Waktu</p>
                                    <p class="text-sm text-gray-800 font-semibold">
                                        <?= date('H:i', strtotime($workshop->start_datetime)) ?> -
                                        <?= date('H:i', strtotime($workshop->end_datetime)) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3"
                                     style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <i class="fas fa-map-marker-alt text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Lokasi</p>
                                    <p class="text-sm text-gray-800 font-semibold">
                                        <?= html_escape($workshop->location) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-gradient-to-r from-orange-50 to-yellow-50 rounded-xl">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3"
                                     style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <i class="fas fa-users text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Peserta</p>
                                    <p class="text-sm text-gray-800 font-semibold">
                                        <?php if ($max_participants > 0): ?>
                                            <?= $participant_count ?>/<?= $max_participants ?>
                                        <?php else: ?>
                                            <?= $participant_count ?> Peserta
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-gradient-to-r from-red-50 to-pink-50 rounded-xl">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3"
                                     style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <i class="fas fa-tag text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Harga</p>
                                    <p class="text-sm text-gray-800 font-semibold">
                                        <?php if ($workshop->price > 0): ?>
                                            Rp <?= number_format($workshop->price, 0, ',', '.') ?>
                                        <?php else: ?>
                                            Gratis
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Registration Card -->
                    <div class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 rounded-2xl p-6 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center mr-3"
                                 style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                <i class="fas fa-user-plus text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Pendaftaran</h3>
                        </div>
                        <?php if ($is_registered): ?>
                            <div class="text-center">
                                <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg"
                                     style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <i class="fas fa-check-circle text-white text-2xl"></i>
                                </div>
                                <p class="text-green-700 font-bold text-lg">Anda sudah terdaftar!</p>
                                <p class="text-sm text-gray-600 mt-2">
                                    Simpan tanggal workshop ini di kalender Anda
                                </p>
                            </div>
                        <?php elseif ($this->session->userdata('user_id')): ?>
                            <?php if ($max_participants == 0 || $participant_count < $max_participants): ?>
                                <div class="text-center">
                                    <a href="<?= workshop_register_url($workshop->id) ?>"
                                       class="w-full text-white px-6 py-4 rounded-xl transition-all duration-300 font-semibold inline-block shadow-lg hover:shadow-xl hover:scale-105"
                                       style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                        <i class="fas fa-user-plus mr-2"></i>
                                        Daftar Sekarang
                                    </a>
                                    <p class="text-sm text-gray-600 mt-3 bg-white/50 rounded-lg p-2">
                                        Kuota tersedia: <?php if ($max_participants > 0) echo $max_participants - $participant_count; else echo 'Unlimited'; ?>
                                    </p>
                                </div>
                            <?php else: ?>
                                <div class="text-center">
                                    <div class="w-20 h-20 bg-gradient-to-r from-red-400 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                        <i class="fas fa-users text-white text-2xl"></i>
                                    </div>
                                    <p class="text-red-700 font-bold text-lg">Kuota Penuh</p>
                                    <p class="text-sm text-gray-600 mt-2">
                                        Maaf, workshop ini sudah mencapai batas maksimal peserta
                                    </p>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="text-center space-y-3">
                                <!-- Register as Member Button -->
                                <a href="<?= site_url('auth/login?redirect=' . urlencode(workshop_detail_url($workshop->id))) ?>"
                                   class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-6 py-4 rounded-xl hover:from-blue-700 hover:to-indigo-800 transition-all duration-300 font-semibold inline-block shadow-lg hover:shadow-xl hover:scale-105">
                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Login & Daftar sebagai Member
                                </a>

                                <!-- Register as Guest Button -->
                                <button onclick="openGuestModal()"
                                        class="w-full bg-gradient-to-r from-green-600 to-emerald-700 text-white px-6 py-4 rounded-xl hover:from-green-700 hover:to-emerald-800 transition-all duration-300 font-semibold inline-block shadow-lg hover:shadow-xl hover:scale-105">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Daftar sebagai Tamu
                                </button>

                                <p class="text-sm text-gray-600 bg-white/50 rounded-lg p-2">
                                    Daftar sebagai tamu tanpa perlu login
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Related Workshops Section -->
    <section class="py-16 bg-gradient-to-br from-slate-900 via-purple-900 to-indigo-900 relative overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-purple-400/10 rounded-full pulse-blob"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-blue-400/10 rounded-full pulse-blob" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-indigo-400/10 rounded-full pulse-blob" style="animation-delay: 4s;"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="1000">
                <div class="flex items-center justify-center mb-4">
                    <span class="bg-white/20 text-white px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm border border-white/30">
                        🎯 Explore More
                    </span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Workshop & Seminar Lainnya
                </h2>
                <p class="text-xl text-white/80 max-w-2xl mx-auto">
                    Jelajahi workshop dan seminar menarik lainnya yang bisa meningkatkan skill dan pengetahuan Anda
                </p>
            </div>

            <div class="text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <a href="<?= site_url('workshops') ?>" 
                   class="bg-gradient-to-r from-purple-600 to-indigo-700 text-white px-8 py-4 rounded-xl hover:from-purple-700 hover:to-indigo-800 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl hover:scale-105 inline-flex items-center">
                    <i class="fas fa-search mr-2"></i>
                    Lihat Semua Workshop & Seminar
                </a>
            </div>
        </div>
    </section>

    <!-- Guest Registration Modal -->
    <div id="guestModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-2xl rounded-2xl bg-white">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-user-plus text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Daftar sebagai Tamu</h3>
                    </div>
                    <button onclick="closeGuestModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="mb-6">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r-xl">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-info-circle text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700 font-medium">
                                    Daftar sebagai tamu untuk workshop <strong>"<?= html_escape($workshop->title) ?>"</strong>.
                                    Isi form di bawah ini dengan data yang benar.
                                </p>
                            </div>
                        </div>
                    </div>

                    <form id="guestForm" action="<?= workshop_register_guest_url($workshop->id) ?>" method="POST">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Lengkap -->
                            <div>
                                <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 bg-white"
                                       placeholder="Masukkan nama lengkap Anda" required>
                            </div>

                            <!-- Asal Kampus/Sekolah -->
                            <div>
                                <label for="asal_kampus_sekolah" class="block text-sm font-medium text-gray-700 mb-2">
                                    Asal Kampus/Sekolah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="asal_kampus_sekolah" name="asal_kampus_sekolah"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 bg-white"
                                       placeholder="Contoh: Universitas Indonesia" required>
                            </div>

                            <div>
                                <label for="province_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Provinsi
                                </label>
                                <select id="province_id" name="province_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 bg-white">
                                    <option value="">Pilih Provinsi</option>
                                </select>
                            </div> -->

                            <div>
                                <label for="regency_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kabupaten/Kota
                                </label>
                                <select id="regency_id" name="regency_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 bg-white" disabled>
                                    <option value="">Pilih Kabupaten/Kota</option>
                                </select>
                            </div>

                            <div>
                                <label for="district_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kecamatan
                                </label>
                                <select id="district_id" name="district_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 bg-white" disabled>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>

                            <div>
                                <label for="village_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kelurahan/Desa
                                </label>
                                <select id="village_id" name="village_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 bg-white" disabled>
                                    <option value="">Pilih Kelurahan/Desa</option>
                                </select>
                            </div>

                            <!-- Usia -->
                            <div>
                                <label for="usia" class="block text-sm font-medium text-gray-700 mb-2">
                                    Usia <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="usia" name="usia" min="10" max="99"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 bg-white"
                                       placeholder="20" required>
                            </div>

                            <!-- Pekerjaan -->
                            <div>
                                <label for="pekerjaan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pekerjaan <span class="text-red-500">*</span>
                                </label>
                                <select id="pekerjaan" name="pekerjaan"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 bg-white" required>
                                    <option value="">Pilih Pekerjaan</option>
                                    <option value="Pelajar">Pelajar</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Karyawan">Karyawan</option>
                                    <option value="Wirausaha">Wirausaha</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Guru/Dosen">Guru/Dosen</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <!-- No. WhatsApp/Telegram -->
                            <div class="md:col-span-2">
                                <label for="no_wa_telegram" class="block text-sm font-medium text-gray-700 mb-2">
                                    No. WhatsApp/Telegram <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="no_wa_telegram" name="no_wa_telegram"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 bg-white"
                                       placeholder="081234567890" required>
                                <p class="text-sm text-gray-500 mt-1">
                                    Masukkan nomor WhatsApp atau Telegram untuk komunikasi dan informasi workshop
                                </p>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="flex justify-end space-x-4 mt-8">
                            <button type="button" onclick="closeGuestModal()"
                                    class="px-6 py-3 bg-gray-300 text-gray-700 rounded-xl hover:bg-gray-400 transition-all duration-300 font-semibold">
                                Batal
                            </button>
                            <button type="submit"
                                    class="px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-700 text-white rounded-xl hover:from-green-700 hover:to-emerald-800 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl">
                                <i class="fas fa-user-plus mr-2"></i>
                                Daftar Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openGuestModal() {
            document.getElementById('guestModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            loadProvinces();
        }

        function closeGuestModal() {
            document.getElementById('guestModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('guestModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeGuestModal();
            }
        });

        // Handle form validation
        document.getElementById('guestForm').addEventListener('submit', function(e) {
            const namaLengkap = document.getElementById('nama_lengkap').value.trim();
            const asalKampus = document.getElementById('asal_kampus_sekolah').value.trim();
            const usia = document.getElementById('usia').value;
            const pekerjaan = document.getElementById('pekerjaan').value;
            const noWa = document.getElementById('no_wa_telegram').value.trim();
            const provinceId = document.getElementById('province_id').value;
            const regencyId = document.getElementById('regency_id').value;
            const districtId = document.getElementById('district_id').value;
            const villageId = document.getElementById('village_id').value;

            if (!namaLengkap || !asalKampus || !usia || !pekerjaan || !noWa) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi.');
                return false;
            }

            if (usia < 10 || usia > 99) {
                e.preventDefault();
                alert('Usia harus antara 10-99 tahun.');
                return false;
            }

            // Optional: Add validation for location fields if they become mandatory
            // if (provinceId && (!regencyId || !districtId || !villageId)) {
            //     e.preventDefault();
            //     alert('Mohon lengkapi semua pilihan lokasi.');
            //     return false;
            // }
        });

        // Load provinces on modal open
        function loadProvinces() {
            fetch('<?= site_url('workshops/get_provinces') ?>')
                .then(response => response.json())
                .then(data => {
                    const provinceSelect = document.getElementById('province_id');
                    provinceSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
                    data.forEach(province => {
                        provinceSelect.innerHTML += `<option value="${province.id}">${province.name}</option>`;
                    });
                })
                .catch(error => console.error('Error loading provinces:', error));
        }

        // Load regencies based on selected province
        document.getElementById('province_id').addEventListener('change', function() {
            const provinceId = this.value;
            const regencySelect = document.getElementById('regency_id');
            const districtSelect = document.getElementById('district_id');
            const villageSelect = document.getElementById('village_id');

            if (provinceId) {
                fetch('<?= site_url('workshops/get_regencies') ?>/' + provinceId)
                    .then(response => response.json())
                    .then(data => {
                        regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                        data.forEach(regency => {
                            regencySelect.innerHTML += `<option value="${regency.id}">${regency.name}</option>`;
                        });
                        regencySelect.disabled = false;
                        districtSelect.disabled = true;
                        villageSelect.disabled = true;
                        districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        villageSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                    })
                    .catch(error => console.error('Error loading regencies:', error));
            } else {
                regencySelect.disabled = true;
                districtSelect.disabled = true;
                villageSelect.disabled = true;
                regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                villageSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
            }
        });

        // Load districts based on selected regency
        document.getElementById('regency_id').addEventListener('change', function() {
            const regencyId = this.value;
            const districtSelect = document.getElementById('district_id');
            const villageSelect = document.getElementById('village_id');

            if (regencyId) {
                fetch('<?= site_url('workshops/get_districts') ?>/' + regencyId)
                    .then(response => response.json())
                    .then(data => {
                        districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        data.forEach(district => {
                            districtSelect.innerHTML += `<option value="${district.id}">${district.name}</option>`;
                        });
                        districtSelect.disabled = false;
                        villageSelect.disabled = true;
                        villageSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                    })
                    .catch(error => console.error('Error loading districts:', error));
            } else {
                districtSelect.disabled = true;
                villageSelect.disabled = true;
                districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                villageSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
            }
        });

        // Load villages based on selected district
        document.getElementById('district_id').addEventListener('change', function() {
            const districtId = this.value;
            const villageSelect = document.getElementById('village_id');

            if (districtId) {
                fetch('<?= site_url('workshops/get_villages') ?>/' + districtId)
                    .then(response => response.json())
                    .then(data => {
                        villageSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                        data.forEach(village => {
                            villageSelect.innerHTML += `<option value="${village.id}">${village.name}</option>`;
                        });
                        villageSelect.disabled = false;
                    })
                    .catch(error => console.error('Error loading villages:', error));
            } else {
                villageSelect.disabled = true;
                villageSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
            }
        });

        // Auto-scroll to form if there's an error
        <?php if ($this->session->flashdata('error')): ?>
            document.addEventListener('DOMContentLoaded', function() {
                if (window.location.hash === '#guest-registration') {
                    openGuestModal();
                    loadProvinces();
                }
            });
        <?php endif; ?>

        // Handle member registration form regional dropdowns
        document.addEventListener('DOMContentLoaded', function() {
            const provinceSelect = document.getElementById('province_id');
            const regencySelect = document.getElementById('regency_id');
            const districtSelect = document.getElementById('district_id');
            const villageSelect = document.getElementById('village_id');

            // Load regencies when province changes
            provinceSelect.addEventListener('change', function() {
                const provinceId = this.value;
                regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                villageSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                districtSelect.disabled = true;
                villageSelect.disabled = true;

                if (provinceId) {
                    regencySelect.disabled = false;
                    // Load regencies via AJAX
                    fetch('<?= site_url('workshops/get_regencies/') ?>' + provinceId)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(regency => {
                                const option = document.createElement('option');
                                option.value = regency.id;
                                option.textContent = regency.name;
                                regencySelect.appendChild(option);
                            });
                        });
                } else {
                    regencySelect.disabled = true;
                }
            });

            // Load districts when regency changes
            regencySelect.addEventListener('change', function() {
                const regencyId = this.value;
                districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                villageSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                villageSelect.disabled = true;

                if (regencyId) {
                    districtSelect.disabled = false;
                    // Load districts via AJAX
                    fetch('<?= site_url('workshops/get_districts/') ?>' + regencyId)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(district => {
                                const option = document.createElement('option');
                                option.value = district.id;
                                option.textContent = district.name;
                                districtSelect.appendChild(option);
                            });
                        });
                } else {
                    districtSelect.disabled = true;
                }
            });

            // Load villages when district changes
            districtSelect.addEventListener('change', function() {
                const districtId = this.value;
                villageSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';

                if (districtId) {
                    villageSelect.disabled = false;
                    // Load villages via AJAX
                    fetch('<?= site_url('workshops/get_villages/') ?>' + districtId)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(village => {
                                const option = document.createElement('option');
                                option.value = village.id;
                                option.textContent = village.name;
                                villageSelect.appendChild(option);
                            });
                        });
                } else {
                    villageSelect.disabled = true;
                }
            });

            // Handle form submission
            document.getElementById('member-register-form').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validate required fields
                const provinceId = document.getElementById('province_id').value;
                const regencyId = document.getElementById('regency_id').value;
                const districtId = document.getElementById('district_id').value;
                const villageId = document.getElementById('village_id').value;

                if (!provinceId || !regencyId || !districtId || !villageId) {
                    alert('Silakan lengkapkan semua informasi regional (Provinsi, Kabupaten/Kota, Kecamatan, Desa/Kelurahan)');
                    return;
                }

                this.submit();
            });
        });
    </script>

<?php $this->load->view('home/templates/_footer'); ?>
