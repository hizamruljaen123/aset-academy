<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-br from-green-500 to-emerald-600">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6" data-aos="fade-up">
                Kelas Gratis
            </h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Mulai perjalanan programmingmu tanpa biaya dengan materi berkualitas dari instruktur profesional
            </p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Temukan Kelas yang Tepat untuk Anda</h2>
                
                <div class="flex flex-wrap justify-center gap-4 mb-8">
                    <button class="filter-btn active px-6 py-2 bg-blue-600 text-white rounded-full font-medium" data-filter="all">
                        Semua Kelas
                    </button>
                    <button class="filter-btn px-6 py-2 bg-white text-gray-700 border border-gray-300 rounded-full font-medium" data-filter="pemula">
                        Pemula
                    </button>
                    <button class="filter-btn px-6 py-2 bg-white text-gray-700 border border-gray-300 rounded-full font-medium" data-filter="menengah">
                        Menengah
                    </button>
                    <button class="filter-btn px-6 py-2 bg-white text-gray-700 border border-gray-300 rounded-full font-medium" data-filter="web">
                        Web Development
                    </button>
                    <button class="filter-btn px-6 py-2 bg-white text-gray-700 border border-gray-300 rounded-full font-medium" data-filter="mobile">
                        Mobile Development
                    </button>
                    <button class="filter-btn px-6 py-2 bg-white text-gray-700 border border-gray-300 rounded-full font-medium" data-filter="data">
                        Data Science
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Grid -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($free_classes as $class): ?>
                <div class="course-card bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="100" data-category="<?= strtolower(str_replace(' ', '-', $class->category)) ?> <?= strtolower($class->level) ?>">
                    <div class="relative overflow-hidden">
                        <img src="<?= $class->thumbnail ?>" alt="<?= html_escape($class->title) ?>" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            Gratis
                        </div>
                        <div class="absolute top-4 right-4 bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">
                            <?= html_escape($class->level) ?>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3"><?= html_escape($class->title) ?></h3>
                        <p class="text-gray-600 mb-4"><?= html_escape($class->description) ?></p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-500"><?= html_escape($class->material_count) ?> Modul • <?= html_escape($class->duration) ?> Jam</span>
                            <div class="flex items-center">
                                <span class="text-yellow-400 mr-1">★</span>
                                <span class="text-sm text-gray-600">4.8</span>
                            </div>
                        </div>
                        <a href="<?= site_url('home/view_free_class/' . $class->id) ?>" class="w-full block bg-green-600 text-white px-4 py-3 rounded-lg hover:bg-green-700 transition-colors text-center font-medium">
                            Mulai Belajar Sekarang
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-green-500 to-emerald-600">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6" data-aos="fade-up">
                Siap Memulai Perjalanan Programming?
            </h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Akses semua kelas gratis ini tanpa biaya dan mulai bangun karir di dunia teknologi
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6" data-aos="fade-up" data-aos-delay="200">
                <a href="#" class="px-8 py-4 bg-white text-green-600 font-bold rounded-lg hover:bg-gray-100 transition-colors">
                    Daftar Sekarang
                </a>
                <a href="index.html#premium-classes" class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-lg hover:bg-white/10 transition-colors">
                    Lihat Kelas Premium
                </a>
            </div>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>