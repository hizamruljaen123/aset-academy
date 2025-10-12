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
                    💎 Program Profesional
                </span>
            </div>

            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight" data-aos="fade-up">
                Kelas 
                <span class="block" style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Profesional
                </span>
            </h1>
            
            <p class="text-xl text-white/80 max-w-3xl mx-auto mb-10 leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                Program pembelajaran mendalam dengan materi lengkap, proyek nyata, sertifikat resmi, 
                dan dukungan mentor berpengalaman dari industri teknologi.
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
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Program Profesional Pilihan</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Program pembelajaran teknologi yang dirancang untuk mengembangkan kompetensi profesional Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($premium_classes as $class): ?>
                <div class="course-card group bg-white rounded-2xl shadow-xl hover:shadow-2xl overflow-hidden border border-gray-100 hover:border-indigo-300 transition-all duration-500 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative overflow-hidden">
                        <div class="w-full h-52">
                            <?php if (!empty($class->gambar)): ?>
                                <img
                                    src="<?= $class->gambar ?>"
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
                            💎 Profesional
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3"><?= html_escape($class->nama_kelas) ?></h3>
                        <?php
                        $descHtml = html_entity_decode(htmlspecialchars_decode($class->deskripsi, ENT_QUOTES | ENT_HTML5), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                        $descText = strip_tags($descHtml);
                        $shortDesc = mb_strlen($descText) > 250 ? mb_substr($descText, 0, 250) . '...' : $descText;
                        ?>
                        <p class="text-gray-600 mb-4 prose max-w-none"><?= $shortDesc ?></p>
                        <div class="mt-4">
                            <?php if ($class->status == 'Coming Soon'): ?>
                                <button class="w-full text-center bg-gradient-to-r from-gray-400 to-gray-500 text-white px-4 py-3 rounded-xl cursor-not-allowed font-semibold shadow-lg" disabled>
                                    Segera Hadir
                                </button>
                             <?php else: ?>
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-2xl font-bold text-indigo-600">Rp <?= number_format($class->harga, 0, ',', '.') ?></span>
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <a href="<?= premium_class_url($class->id) ?>" class="w-full text-center bg-gray-100 text-gray-700 px-4 py-3 rounded-xl hover:bg-gray-200 transition-colors text-sm font-semibold">
                                        Lihat Detail
                                    </a>
                                    <?php if(isset($user_id)): ?>
                                        <?php if($is_enrolled): ?>
                                            <a href="<?= site_url('kelas/detail/' . encrypt_url($class->id)) ?>" class="w-full text-center text-white px-4 py-3 rounded-xl transition-colors text-sm font-semibold shadow-lg"
                                               style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                                Lanjutkan Pembelajaran
                                            </a>
                                        <?php elseif($payment_status && $payment_status->status == 'Verified'): ?>
                                            <a href="<?= site_url('kelas/enroll/' . encrypt_url($class->id)) ?>" class="w-full text-center text-white px-4 py-3 rounded-xl transition-colors text-sm font-semibold shadow-lg"
                                               style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                                Akses Kelas
                                            </a>
                                        <?php elseif($payment_status && $payment_status->status == 'Pending'): ?>
                                            <button class="w-full text-center bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-4 py-3 rounded-xl cursor-not-allowed text-sm font-semibold shadow-lg">
                                                Menunggu Verifikasi
                                            </button>
                                        <?php else: ?>
                                            <a href="<?= site_url('payment/initiate/' . encrypt_url($class->id)) ?>" class="w-full text-center text-white px-4 py-3 rounded-xl transition-colors text-sm font-semibold shadow-lg"
                                               style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                                Daftar Program
                                            </a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="<?= site_url('auth/login?redirect=payment/initiate/' . encrypt_url($class->id)) ?>" class="w-full text-center text-white px-4 py-3 rounded-xl transition-colors text-sm font-semibold shadow-lg"
                                           style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                            Daftar Program
                                        </a>
                                    <?php endif; ?>
                                </div>
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
                    🚀 Mulai Perjalanan Belajar
                </span>
            </div>

            <h2 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight" data-aos="fade-up">
                Siap Mengembangkan
                <span class="block" style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Kompetensi Teknologi?
                </span>
            </h2>
            
            <p class="text-xl text-white/80 mb-12 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                Bergabung dengan komunitas pembelajaran teknologi profesional dan kembangkan karir Anda di industri digital
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-6" data-aos="fade-up" data-aos-delay="200">
                <a href="<?= site_url('auth/register') ?>" class="group px-10 py-5 text-white font-bold rounded-2xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3 shadow-2xl text-lg"
                   style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                    <i class="fas fa-user-plus group-hover:scale-110 transition-transform"></i>
                    Daftar Program
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="<?= site_url('home/free') ?>" class="group px-10 py-5 bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white font-bold rounded-2xl hover:bg-white/20 hover:scale-105 transition-all duration-300 shadow-xl text-lg">
                    <i class="fas fa-gift mr-2"></i>Coba Kelas Gratis
                </a>
            </div>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>