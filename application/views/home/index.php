<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Hero Section -->
    <section class="pt-24 pb-32 relative overflow-hidden" id="vanta-bg" style="background: linear-gradient(135deg, #0e1127 0%, #2e3c73 50%, #198aad 100%);">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/5 w-96 h-96 rounded-full pulse-blob" style="background: rgba(30, 60, 115, 0.2);"></div>
            <div class="absolute -bottom-20 right-[10%] w-[420px] h-[330px] rounded-full pulse-blob" style="background: rgba(25, 138, 173, 0.15); animation-delay: 2.5s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 rounded-full pulse-blob" style="background: rgba(14, 17, 39, 0.1); animation-delay: 4s;"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-y-12">
                <div class="md:w-7/12" data-aos="fade-right">
                    <!-- Badge -->
                    <div class="flex items-center mb-6">
                        <span class="bg-white/10 text-white px-4 py-2 rounded-full text-sm font-medium backdrop-blur-sm border border-white/20">
                            🎓 Platform Pembelajaran Teknologi
                        </span>
                    </div>
                    
                    <!-- Main Heading -->
                    <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-6">
                        Mengembangkan Keahlian Digital untuk 
                        <span class="block" style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            Masa Depan yang Berkelanjutan
                        </span>
                    </h1>
                    
                    <!-- Description -->
                    <p class="text-xl text-white/80 mb-10 max-w-2xl leading-relaxed">
                        Bergabunglah dengan komunitas profesional yang telah mempercayai 
                        <span class="font-semibold text-white">kurikulum berbasis industri, 
                        proyek nyata, dan dukungan mentor berpengalaman</span> untuk mengembangkan karir teknologi Anda.
                    </p>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-8">
                        <a href="<?= site_url('auth/register') ?>" 
                           class="px-8 py-4 text-white font-semibold rounded-xl shadow-lg text-lg flex items-center justify-center transition-all duration-300 hover:scale-105"
                           style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                            Mulai Perjalanan Belajar
                        </a>
                        <a href="<?= site_url('home/download_app') ?>" 
                           class="px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/20 shadow-lg text-lg flex items-center justify-center border border-white/30 transition-all duration-300">
                            <i class="fas fa-mobile-alt mr-2"></i>Unduh Aplikasi
                        </a>
                    </div>
                    
                   
                </div>
                
                <div class="md:w-5/12 flex justify-center relative" data-aos="fade-left">
                    <div class="relative w-[350px] max-w-full">
                        <img src="https://is3.cloudhost.id/pantaoumedia/asset_academy/assets/images" alt="Developer Belajar Coding" 
                             class="w-full floating rounded-2xl shadow-2xl border border-white/20 bg-white/5 backdrop-blur-sm">
                        
                        
                        
                        
                    </div>
                </div>
            </div>
            
            
        </div>
        
        <!-- SVG wave bottom decor -->
        <div class="absolute left-0 right-0 bottom-0" style="line-height:0;">
            <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-opacity=".1" fill="#fff" d="M0,32 C250,120 750,0 1440,80 L1440,00 L0,0 Z"></path>
            </svg>
        </div>
    </section>

    

    

    <!-- Premium Classes Section -->
    <section class="py-20" style="background: linear-gradient(135deg, #0e1127 0%, #1a1f3a 50%, #2e3c73 100%);">
        <div class="container mx-auto px-4">
            <div class="text-center mb-14" data-aos="fade-up">
                <div class="flex items-center justify-center mb-4">
                    <span class="text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg"
                          style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                        💎 Program Unggulan
                    </span>
                </div>
                <h2 class="text-4xl font-bold text-white mb-4">
                    Kelas Profesional Berbasis Industri
                </h2>
                <p class="text-xl text-white/80 max-w-3xl mx-auto leading-relaxed">
                    Program pembelajaran mendalam dengan mentor berpengalaman industri, dilengkapi proyek nyata dan sertifikasi resmi untuk mengembangkan kompetensi profesional Anda.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($featured_premium as $class): 
                $is_enrolled = isset($user_id) ? $this->db->where(['class_id' => $class->id, 'student_id' => $user_id])->get('free_class_enrollments')->row() : false;
                $payment_status = isset($user_id) ? $this->db->where(['class_id' => $class->id, 'user_id' => $user_id])->order_by('created_at', 'DESC')->get('payments')->row() : false;?>
                <div class="group bg-white/10 backdrop-blur-sm rounded-2xl shadow-xl hover:shadow-2xl overflow-hidden border border-white/20 hover:border-white/40 transition-all duration-500 relative flex flex-col hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative w-full h-52 overflow-hidden">
                        <?php if (!empty($class->gambar)): ?>
                        <img src="<?= $class->gambar ?>" alt="<?= html_escape($class->nama_kelas) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center">
                            <i class="fas fa-laptop-code text-7xl text-indigo-500"></i>
                        </div>
                        <?php endif; ?>
                        <span class="absolute top-4 left-4 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow-lg"
                              style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                            💎 Premium
                        </span>
                        <?php if ($class->status == 'Coming Soon'): ?>
                        <span class="absolute top-4 right-4 bg-gray-500 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow-lg">Segera Hadir</span>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1 flex flex-col p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-white group-hover:text-blue-300 transition-colors duration-300"> <?= html_escape($class->nama_kelas) ?> </h3>
                            <span class="bg-white/20 text-white px-3 py-1 rounded-xl text-xs font-semibold"> <?= html_escape($class->bahasa_program) ?> </span>
                        </div>
                        <?php 
                        $descHtml = html_entity_decode(htmlspecialchars_decode($class->deskripsi, ENT_QUOTES | ENT_HTML5), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                        $descText = strip_tags($descHtml);
                        $shortDesc = mb_strlen($descText) > 120 ? mb_substr($descText, 0, 120) . '...' : $descText;
                        ?>
                        <p class="text-white/80 mb-5 leading-relaxed"> <?= $shortDesc ?> </p>
                        
                        <div class="mt-auto">
                            <?php if ($class->status == 'Coming Soon'): ?>
                                <button class="w-full bg-gradient-to-r from-gray-400 to-gray-500 text-white px-4 py-3 rounded-xl font-semibold cursor-not-allowed shadow-lg" disabled>
                                    Segera Hadir
                                </button>
                            <?php else: ?>
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-2xl font-bold text-white">Rp <?= number_format($class->harga, 0, ',', '.') ?></span>
                                </div>
                                <?php if(isset($user_id)): ?>
                                    <?php if($is_enrolled): ?>
                                        <a href="<?= site_url('kelas/detail/' . encrypt_url($class->id)) ?>" class="w-full text-center text-white px-4 py-3 rounded-xl transition-all duration-300 text-sm font-semibold shadow-lg hover:shadow-xl"
                                           style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                            Lanjutkan Pembelajaran
                                        </a>
                                    <?php elseif($payment_status && $payment_status->status == 'Verified'): ?>
                                        <a href="<?= site_url('kelas/enroll/' . encrypt_url($class->id)) ?>" class="w-full text-center text-white px-4 py-3 rounded-xl transition-all duration-300 text-sm font-semibold shadow-lg hover:shadow-xl"
                                           style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                            Akses Kelas
                                        </a>
                                    <?php elseif($payment_status && $payment_status->status == 'Pending'): ?>
                                        <button class="w-full text-center bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-4 py-3 rounded-xl font-semibold cursor-not-allowed shadow-lg">
                                            Menunggu Verifikasi
                                        </button>
                                    <?php else: ?>
                                        <a href="<?= site_url('payment/initiate/' . encrypt_url($class->id)) ?>" class="w-full text-center text-white px-4 py-3 rounded-xl transition-all duration-300 text-sm font-semibold shadow-lg hover:shadow-xl"
                                           style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                            Daftar Program
                                        </a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <a href="<?= site_url('auth/login?redirect=payment/initiate/' . encrypt_url($class->id)) ?>" class="w-full text-center text-white px-4 py-3 rounded-xl transition-all duration-300 text-sm font-semibold shadow-lg hover:shadow-xl"
                                       style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                        Daftar & Bayar
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Free Classes Section -->
    <section class="py-20 bg-gradient-to-br from-slate-50 via-white to-emerald-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-14" data-aos="fade-up">
                <div class="flex items-center justify-center mb-4">
                    <span class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                        🆓 Akses Gratis
                    </span>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 mb-4">
                    Program Pembelajaran Dasar
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Program pembelajaran fundamental untuk mengembangkan dasar-dasar pemrograman dan teknologi, 
                    dirancang khusus untuk pemula yang ingin memulai perjalanan di dunia teknologi.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($featured_free as $class): ?>
                <div class="group bg-white rounded-2xl shadow-xl hover:shadow-2xl hover:border-emerald-300 transition-all duration-500 overflow-hidden border border-gray-100 flex flex-col hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative w-full h-52 overflow-hidden">
                        <?php if (!empty($class->thumbnail)): ?>
                        <img src="<?= $class->thumbnail ?>" alt="<?= html_escape($class->title) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                            <i class="fas fa-book-open text-7xl text-emerald-500"></i>
                        </div>
                        <?php endif; ?>
                        <span class="absolute top-4 left-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow-lg">
                            🆓 Gratis
                        </span>
                        <?php if ($class->status == 'Coming Soon'): ?>
                        <span class="absolute top-4 right-4 bg-gray-500 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow-lg">Segera Hadir</span>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1 flex flex-col p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-800 group-hover:text-emerald-700 transition-colors duration-300"> <?= html_escape($class->title) ?> </h3>
                            <span class="bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800 px-3 py-1 rounded-xl text-xs font-semibold"> <?= html_escape($class->level) ?> </span>
                        </div>
                        <?php 
                        $descHtml = html_entity_decode(htmlspecialchars_decode($class->description, ENT_QUOTES | ENT_HTML5), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                        $descText = strip_tags($descHtml);
                        $shortDesc = mb_strlen($descText) > 100 ? mb_substr($descText, 0, 100) . '...' : $descText;
                        ?>
                        <p class="text-gray-600 mb-5 leading-relaxed"> <?= $shortDesc ?> </p>
                        <div class="flex items-center gap-2 flex-wrap mb-6">
                            <span class="inline-flex items-center gap-1 bg-gradient-to-r from-yellow-50 to-orange-50 text-yellow-700 px-3 py-1 rounded-lg text-xs font-medium border border-yellow-200">
                                <i class="fas fa-star"></i> Materi Berkualitas
                            </span>
                            <span class="inline-flex items-center gap-1 bg-gradient-to-r from-gray-50 to-slate-50 text-gray-700 px-3 py-1 rounded-lg text-xs font-medium border border-gray-200">
                                <i class="fas fa-users"></i> Komunitas Aktif
                            </span>
                        </div>
                        <div class="mt-auto">
                            <?php if ($class->status == 'Coming Soon'): ?>
                                <button class="w-full bg-gradient-to-r from-gray-400 to-gray-500 text-white px-4 py-3 rounded-xl font-semibold cursor-not-allowed shadow-lg" disabled>Segera Hadir</button>
                            <?php else: ?>
                                <a href="<?= free_class_url($class->id) ?>" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-4 py-3 rounded-xl hover:from-emerald-700 hover:to-teal-700 transition-all duration-300 text-center font-semibold text-sm shadow-lg hover:shadow-xl">
                                    Mulai Pembelajaran
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

     <!-- Workshop & Seminar Section -->
    <?php $this->load->view('home/workshop_section'); ?>

   

    <!-- Features Section -->
    <section class="py-24 bg-gradient-to-br from-slate-50 via-white to-indigo-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-14" data-aos="fade-up">
                <div class="flex items-center justify-center mb-4">
                    <span class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                        ⭐ Keunggulan Platform
                    </span>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 mb-4">
                    Mengapa Memilih Aset Academy?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Platform pembelajaran teknologi yang dirancang untuk memberikan pengalaman belajar yang komprehensif, 
                    efektif, dan sesuai dengan kebutuhan industri digital masa kini.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 relative border border-gray-100 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-video text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Konten Berkualitas Tinggi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Materi pembelajaran yang disusun oleh praktisi berpengalaman, dilengkapi dengan video berkualitas tinggi 
                        dan proyek praktis untuk mengasah kemampuan teknis Anda.
                    </p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 relative border border-gray-100 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Dukungan Mentor Berpengalaman</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Akses langsung ke mentor yang memiliki pengalaman industri nyata, dengan sistem konsultasi 
                        dan diskusi yang memfasilitasi pembelajaran yang efektif dan terarah.
                    </p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 relative border border-gray-100 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-certificate text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Sertifikasi Resmi & Kompetitif</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Program sertifikasi resmi yang diakui secara nasional, memberikan nilai tambah 
                        untuk meningkatkan daya saing profesional di pasar kerja teknologi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Carousel -->
    <section class="py-24 bg-gradient-to-br from-gray-50 via-white to-slate-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-14" data-aos="fade-up">
                <div class="flex items-center justify-center mb-4">
                    <span class="bg-gradient-to-r from-amber-500 to-orange-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                        💬 Testimoni Alumni
                    </span>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 mb-4">
                    Pengalaman Alumni Kami
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Cerita sukses dan pengalaman pembelajaran dari alumni yang telah mengembangkan karir mereka 
                    melalui program-program yang kami tawarkan.
                </p>
            </div>
            <div class="relative max-w-5xl mx-auto">
                <div class="carousel flex overflow-x-auto gap-9 pb-8 px-4 scrollbar-hide snap-x" style="scroll-snap-type:x mandatory;">
                    <?php foreach ($testimonials as $testimonial): ?>
                    <div class="carousel-item w-96 min-w-[22rem] flex-shrink-0 bg-white p-8 rounded-2xl shadow-xl border border-gray-100 relative hover:shadow-2xl transition-all duration-300 snap-start hover:-translate-y-1" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex items-center mb-6">
                            <?php if ($testimonial->photo && file_exists(FCPATH . 'uploads/testimonials/' . $testimonial->photo)): ?>
                                <img src="<?= base_url('uploads/testimonials/' . $testimonial->photo) ?>" alt="<?= html_escape($testimonial->name) ?>" class="w-16 h-16 rounded-full mr-4 border-4 border-indigo-200 object-cover shadow-lg">
                            <?php else: ?>
                                <div class="w-16 h-16 rounded-full mr-4 bg-gradient-to-r from-indigo-100 to-purple-100 flex items-center justify-center shadow-lg">
                                    <i class="fas fa-user text-indigo-600 text-xl"></i>
                                </div>
                            <?php endif; ?>
                            <div>
                                <h4 class="font-bold text-gray-800 text-lg"><?= html_escape($testimonial->name) ?></h4>
                                <p class="text-sm text-gray-600"><?= html_escape($testimonial->position) ?></p>
                            </div>
                        </div>
                        <div class="flex mb-4 items-center">
                            <span class="text-yellow-400 text-lg mr-2"><?= str_repeat('★', $testimonial->rating) ?></span>
                            <span class="text-gray-500 text-sm font-medium">(<?= number_format($testimonial->rating,1) ?>/5)</span>
                        </div>
                        <p class="text-gray-700 italic mb-6 leading-relaxed">
                            "<?= html_escape($testimonial->content) ?>"
                        </p>
                        <div class="absolute bottom-6 right-7 bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 font-semibold px-4 py-2 rounded-xl text-xs shadow-lg">
                            Alumni
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
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
        
        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="flex items-center justify-center mb-6" data-aos="fade-up">
                <span class="bg-white/10 text-white px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm border border-white/20">
                    🚀 Mulai Perjalanan Anda
                </span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6" data-aos="fade-up" data-aos-delay="100">
                Siap Mengembangkan Karir Teknologi Anda?
            </h2>
            <p class="text-xl text-white/80 mb-10 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                Bergabunglah dengan ribuan profesional yang telah mempercayai Aset Academy untuk mengembangkan 
                kompetensi teknologi mereka dari dasar hingga tingkat profesional.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6 mb-8" data-aos="fade-up" data-aos-delay="300">
                <a href="<?= site_url('auth/register') ?>" 
                   class="px-10 py-5 text-white font-semibold rounded-xl shadow-xl text-xl transition-all duration-300 hover:scale-105"
                   style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                    Mulai Pembelajaran Gratis
                </a>
                <a href="<?= site_url('home/premium') ?>" 
                   class="px-10 py-5 bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/20 shadow-xl text-xl transition-all duration-300">
                    Jelajahi Program Lengkap
                </a>
            </div>
        </div>
        
        <!-- SVG wave bottom decor -->
        <div class="absolute left-0 right-0 bottom-0" style="line-height:0;">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-opacity=".1" fill="#FFF" d="M0,60 C600,10 750,80 1440,0 L1440,00 L0,0 Z"></path>
            </svg>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>