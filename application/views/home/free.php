<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Hero Section -->
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
                    🎁 Program Gratis
                </span>
            </div>

            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight" data-aos="fade-up">
                Kelas 
                <span class="block" style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Gratis
                </span>
            </h1>
            
            <p class="text-xl text-white/80 max-w-3xl mx-auto mb-10 leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                Mulai perjalanan pembelajaran teknologi tanpa biaya dengan materi berkualitas 
                dari instruktur profesional dan komunitas pembelajaran yang aktif.
            </p>

            
        </div>
    </section>

    
    <!-- Courses Grid -->
    <section class="py-20 bg-gradient-to-br from-slate-50 via-white to-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-14" data-aos="fade-up">
                <div class="flex items-center justify-center mb-6">
                    <span class="text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg"
                          style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                        📚 Program Unggulan
                    </span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Program Gratis Pilihan</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Program pembelajaran teknologi gratis yang dirancang untuk mengembangkan kompetensi dasar Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($free_classes as $class): ?>
                <div class="course-card group bg-white rounded-2xl shadow-xl hover:shadow-2xl overflow-hidden border border-gray-100 hover:border-indigo-300 transition-all duration-500 hover:-translate-y-2 flex flex-col" data-aos="fade-up" data-aos-delay="100" data-category="<?= strtolower(str_replace(' ', '-', $class->category)) ?> <?= strtolower($class->level) ?>">
                <div class="relative overflow-hidden">
                    <div class="w-full h-48">
                            <?php if (!empty($class->thumbnail)): ?>
                                <img 
                                    src="<?= $class->thumbnail ?>" 
                                    alt="<?= html_escape($class->title) ?>" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >
                                <div class="w-full h-full bg-gradient-to-br from-indigo-100 to-purple-100 items-center justify-center" style="display:none;">
                                    <i class="fas fa-book-open text-6xl text-indigo-600"></i>
                                </div>
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center">
                                    <i class="fas fa-book-open text-6xl text-indigo-600"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="absolute top-4 left-4 text-white px-3 py-1 rounded-xl text-sm font-semibold shadow-lg"
                             style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                            🎁 Gratis
                        </div>
                    </div>   
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3"><?= html_escape($class->title) ?></h3>
                        <?php 
                        $descHtml = html_entity_decode(htmlspecialchars_decode($class->description, ENT_QUOTES | ENT_HTML5), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                        $descText = strip_tags($descHtml);
                        $shortDesc = mb_strlen($descText) > 250 ? mb_substr($descText, 0, 250) . '...' : $descText;
                        ?>
                        <p class="text-gray-600 mb-4 prose max-w-none"><?= $shortDesc ?></p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-500"><?= html_escape($class->material_count) ?> Modul • <?= html_escape($class->duration) ?> Jam</span>
                            <div class="flex items-center">
                                <span class="text-yellow-400 mr-1">★</span>
                                <span class="text-sm text-gray-600">4.8</span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <?php if ($class->status == 'Coming Soon'): ?>
                                <button class="w-full text-center bg-gradient-to-r from-gray-400 to-gray-500 text-white px-4 py-3 rounded-xl cursor-not-allowed font-semibold shadow-lg" disabled>
                                    Segera Hadir
                                </button>
                            <?php else: ?>
                                <a href="<?= free_class_url($class->id) ?>" class="w-full text-white px-4 py-3 rounded-xl transition-colors text-center font-semibold shadow-lg"
                                   style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    Mulai Belajar
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
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
                    🎁 Mulai Pembelajaran Gratis
                </span>
            </div>

            <h2 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight" data-aos="fade-up">
                Siap Memulai
                <span class="block" style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Perjalanan Belajar?
                </span>
            </h2>
            
            <p class="text-xl text-white/80 mb-12 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                Akses semua program pembelajaran gratis tanpa biaya dan mulai kembangkan kompetensi teknologi Anda
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-6" data-aos="fade-up" data-aos-delay="200">
                <a href="<?= site_url('auth/register') ?>" class="group px-10 py-5 text-white font-bold rounded-2xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3 shadow-2xl text-lg"
                   style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                    <i class="fas fa-user-plus group-hover:scale-110 transition-transform"></i>
                    Daftar Gratis
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="<?= site_url('home/premium') ?>" class="group px-10 py-5 bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white font-bold rounded-2xl hover:bg-white/20 hover:scale-105 transition-all duration-300 shadow-xl text-lg">
                    <i class="fas fa-crown mr-2"></i>Lihat Program Profesional
                </a>
            </div>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>