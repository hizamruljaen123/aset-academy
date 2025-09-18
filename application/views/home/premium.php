<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-br from-blue-600 to-indigo-700">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6" data-aos="fade-up">
                Kelas Premium
            </h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Akses materi lengkap dengan project nyata, sertifikat resmi, dan dukungan mentor profesional
            </p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Temukan Kelas Premium yang Tepat</h2>
                
                <div class="flex flex-wrap justify-center gap-4 mb-8">
                    <button class="filter-btn active px-6 py-2 bg-blue-600 text-white rounded-full font-medium" data-filter="all">
                        Semua Kelas
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
                    <button class="filter-btn px-6 py-2 bg-white text-gray-700 border border-gray-300 rounded-full font-medium" data-filter="cloud">
                        Cloud & DevOps
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Grid -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($premium_classes as $class): ?>
                <div class="course-card bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="100" data-category="<?= strtolower(str_replace(' ', '-', $class->bahasa_program)) ?>">
                    <div class="relative overflow-hidden">
                        <img src="<?= $class->gambar ?>" alt="<?= html_escape($class->nama_kelas) ?>" class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-4 left-4 premium-badge text-white px-3 py-1 rounded-full text-sm font-bold">
                            Premium
                        </div>
                        <div class="absolute top-4 right-4 bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">
                            <?= html_escape($class->bahasa_program) ?>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3"><?= html_escape($class->nama_kelas) ?></h3>
                        <p class="text-gray-600 mb-4"><?= html_escape($class->deskripsi) ?></p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-500"><?= html_escape($class->durasi) ?> Jam</span>
                            <div class="flex items-center">
                                <span class="text-yellow-400 mr-1">★</span>
                                <span class="text-sm text-gray-600">4.9</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-blue-600">Rp <?= number_format($class->harga, 0, ',', '.') ?></span>
                        </div>
                        <a href="<?= premium_class_url($class->id) ?>" class="w-full text-center bg-indigo-100 text-indigo-700 px-4 py-2 rounded-lg hover:bg-indigo-200 transition-colors text-sm font-semibold">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-16 bg-gray-50">
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

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-700">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6" data-aos="fade-up">
                Siap Tingkatkan Skill Programmingmu?
            </h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Bergabung dengan ribuan siswa premium dan raih karir impian di dunia teknologi
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6" data-aos="fade-up" data-aos-delay="200">
                <a href="#" class="px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:bg-gray-100 transition-colors">
                    Daftar Sekarang
                </a>
                <a href="kelas-gratis.html" class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-lg hover:bg-white/10 transition-colors">
                    Lihat Kelas Gratis
                </a>
            </div>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>