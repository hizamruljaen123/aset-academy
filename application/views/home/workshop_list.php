<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Workshop List Hero Section -->
    <section class="pt-20 pb-16 bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-purple-400/20 rounded-full pulse-blob"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-blue-400/20 rounded-full pulse-blob" style="animation-delay: 2s;"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-6">
                Workshop & Seminar
            </h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto">
                Tingkatkan kemampuan programming Anda dengan workshop dan seminar berkualitas dari para ahli di bidangnya
            </p>
        </div>
    </section>

    <!-- Workshop List Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <?php if (!empty($workshops)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($workshops as $workshop): ?>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300" data-aos="fade-up">
                        <div class="relative overflow-hidden">
                            <?php if ($workshop->thumbnail): ?>
                                <img src="<?= base_url($workshop->thumbnail) ?>" alt="<?= html_escape($workshop->title) ?>" class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                            <?php else: ?>
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-chalkboard-teacher text-gray-400 text-3xl"></i>
                                </div>
                            <?php endif; ?>

                            <div class="absolute top-4 left-4">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-bold">
                                    <?= $workshop->type == 'workshop' ? 'Workshop' : 'Seminar' ?>
                                </span>
                            </div>

                            <div class="absolute top-4 right-4">
                                <?php if ($workshop->price > 0): ?>
                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                        Rp <?= number_format($workshop->price, 0, ',', '.') ?>
                                    </span>
                                <?php else: ?>
                                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                        Gratis
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">
                                <?= html_escape($workshop->title) ?>
                            </h3>

                            <p class="text-gray-600 mb-4 line-clamp-3">
                                <?= html_escape($workshop->description) ?>
                            </p>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-calendar-alt mr-2 text-blue-500"></i>
                                    <span><?= date('d F Y', strtotime($workshop->start_datetime)) ?></span>
                                </div>

                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-clock mr-2 text-blue-500"></i>
                                    <span>
                                        <?= date('H:i', strtotime($workshop->start_datetime)) ?> -
                                        <?= date('H:i', strtotime($workshop->end_datetime)) ?>
                                    </span>
                                </div>

                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                                    <span class="truncate"><?= html_escape($workshop->location) ?></span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-600">
                                    <?php
                                    $participant_count = $this->db->where('workshop_id', $workshop->id)->count_all_results('workshop_participants');
                                    if ($workshop->max_participants > 0) {
                                        echo $participant_count . '/' . $workshop->max_participants . ' Peserta';
                                    } else {
                                        echo $participant_count . ' Peserta';
                                    }
                                    ?>
                                </div>

                                <a href="<?= site_url('workshops/detail/' . $workshop->id) ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-chalkboard-teacher text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada Workshop atau Seminar</h3>
                    <p class="text-gray-600">
                        Workshop dan seminar akan segera tersedia. Silakan kembali lagi nanti.
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-700">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6" data-aos="fade-up">
                Tertarik Mengikuti Workshop atau Seminar?
            </h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Daftar sekarang dan dapatkan pengetahuan baru dari para ahli di bidang programming
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6" data-aos="fade-up" data-aos-delay="200">
                <?php if ($this->session->userdata('user_id')): ?>
                    <a href="#workshops" class="px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:bg-gray-100 transition-colors">
                        Jelajahi Workshop
                    </a>
                <?php else: ?>
                    <a href="<?= site_url('auth/login') ?>" class="px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:bg-gray-100 transition-colors">
                        Login untuk Mendaftar
                    </a>
                <?php endif; ?>
                <a href="<?= site_url('home') ?>" class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-lg hover:bg-white/10 transition-colors">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>
