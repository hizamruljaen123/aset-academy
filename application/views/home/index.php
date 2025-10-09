<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Hero Section -->
    <section class="pt-20 pb-16 bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 relative overflow-hidden" id="vanta-bg">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-purple-400/20 rounded-full pulse-blob"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-blue-400/20 rounded-full pulse-blob" style="animation-delay: 2s;"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-10 md:mb-0" data-aos="fade-right" data-aos-duration="1000">
                    <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-6">
                        Kelas Coding Murah & Terbaik untuk <span class="text-yellow-300">Belajar Coding Online</span>
                    </h1>
                    <p class="text-xl text-white/90 mb-8">
                        Pelatihan coding profesional dengan kurikulum lengkap, project nyata, dan sertifikat Resmi.
                        Tingkatkan skill programming Anda dengan metode belajar interaktif dari mentor berpengalaman.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="<?= site_url('home/download_app') ?>" class="px-8 py-4 bg-green-500 text-white font-bold rounded-lg hover:bg-green-600 transition-colors text-center flex items-center justify-center">
                            <i class="fas fa-mobile-alt mr-2"></i>Download App
                        </a>
                        <a href="#" class="px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:bg-gray-100 transition-colors text-center">
                            Lihat Kelas Premium
                        </a>
                        <a href="#" class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-lg hover:bg-white/10 transition-colors text-center">
                            Kelas Gratis
                        </a>
                    </div>
                </div>
                
                <div class="md:w-1/2 flex justify-center" data-aos="fade-left" data-aos-duration="1000">
                    <div class="relative">
                        <img src="http://static.photos/technology/640x360/1" alt="Ilustrasi Programming" class="w-full max-w-md floating rounded-xl shadow-2xl">
                        <div class="absolute -top-4 -right-4 bg-yellow-400 text-yellow-900 px-4 py-2 rounded-full font-bold text-sm">
                            ⭐ 4.9/5 Rating
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    

    <!-- Premium Classes Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Kelas Premium</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Akses materi lengkap dengan project nyata dan sertifikat resmi
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($featured_premium as $class): 
                $is_enrolled = isset($user_id) ? $this->db->where(['class_id' => $class->id, 'student_id' => $user_id])->get('free_class_enrollments')->row() : false;
                $payment_status = isset($user_id) ? $this->db->where(['class_id' => $class->id, 'user_id' => $user_id])->order_by('created_at', 'DESC')->get('payments')->row() : false;
                ?>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative overflow-hidden">
                        <div class="w-full h-48">
                            <?php if (!empty($class->gambar)): ?>
                                <img 
                                    src="<?= $class->gambar ?>" 
                                    alt="<?= html_escape($class->nama_kelas) ?>" 
                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >
                                <div class="w-full h-full bg-indigo-100 items-center justify-center" style="display:none;">
                                    <i class="fas fa-laptop-code text-6xl text-indigo-500"></i>
                                </div>
                            <?php else: ?>
                                <div class="w-full h-full bg-indigo-100 flex items-center justify-center">
                                    <i class="fas fa-laptop-code text-6xl text-indigo-500"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="absolute top-4 left-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            Premium
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-gray-800"><?= html_escape($class->nama_kelas) ?></h3>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm"><?= html_escape($class->bahasa_program) ?></span>
                        </div>
                        <?php 
                        $descHtml = html_entity_decode(htmlspecialchars_decode($class->deskripsi, ENT_QUOTES | ENT_HTML5), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                        $descText = strip_tags($descHtml);
                        $shortDesc = mb_strlen($descText) > 250 ? mb_substr($descText, 0, 250) . '...' : $descText;
                        ?>
                        <p class="text-gray-600 mb-4 prose max-w-none"><?= $shortDesc ?></p>
                        <div class="mt-4">
                            <?php if ($class->status == 'Coming Soon'): ?>
                                <button class="w-full text-center bg-gradient-to-r from-gray-400 to-gray-500 text-white px-4 py-2 rounded-lg cursor-not-allowed font-semibold" disabled>
                                    Coming Soon
                                </button>
                            <?php else: ?>
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-blue-600">Rp <?= number_format($class->harga, 0, ',', '.') ?></span>
                                    <div class="flex flex-col space-y-2">
                                        <a href="<?= premium_class_url($class->id) ?>" class="w-full text-center bg-indigo-100 text-indigo-700 px-4 py-2 rounded-lg hover:bg-indigo-200 transition-colors text-sm font-semibold">
                                            Lihat Detail
                                        </a>
                                        <?php if(isset($user_id)): ?>
                                            <?php if($is_enrolled): ?>
                                                <a href="<?= site_url('kelas/detail/' . encrypt_url($class->id)) ?>" class="w-full text-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors text-sm font-semibold">
                                                    Lanjut Belajar
                                                </a>
                                            <?php elseif($payment_status && $payment_status->status == 'Verified'): ?>
                                                <a href="<?= site_url('kelas/enroll/' . encrypt_url($class->id)) ?>" class="w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                                    Akses Kelas
                                                </a>
                                            <?php elseif($payment_status && $payment_status->status == 'Pending'): ?>
                                                <button class="w-full text-center bg-yellow-500 text-white px-4 py-2 rounded-lg cursor-not-allowed text-sm font-semibold">
                                                    Menunggu Verifikasi
                                                </button>
                                            <?php else: ?>
                                                <a href="<?= site_url('payment/initiate/' . encrypt_url($class->id)) ?>" class="w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                                    Daftar Sekarang
                                                </a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <a href="<?= site_url('auth/login?redirect=payment/initiate/' . encrypt_url($class->id)) ?>" class="w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                                Daftar Sekarang
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    

    <!-- Free Classes Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Kelas Coding Gratis</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Mulai perjalanan belajar coding Anda dengan materi dasar berkualitas tanpa biaya. Persiapan terbaik untuk kelas coding premium.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($featured_free as $class): ?>
                <div class="bg-gray-50 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative overflow-hidden">
                        <div class="w-full h-48">
                            <?php if (!empty($class->thumbnail)): ?>
                                <img 
                                    src="<?= $class->thumbnail ?>" 
                                    alt="<?= html_escape($class->title) ?>" 
                                    class="w-full h-full object-cover"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >
                                <div class="w-full h-full bg-green-100 items-center justify-center" style="display:none;">
                                    <i class="fas fa-book-open text-6xl text-green-500"></i>
                                </div>
                            <?php else: ?>
                                <div class="w-full h-full bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-book-open text-6xl text-green-500"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            Gratis
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-gray-800"><?= html_escape($class->title) ?></h3>
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs"><?= html_escape($class->level) ?></span>
                        </div>
                        <?php 
                        $descHtml = html_entity_decode(htmlspecialchars_decode($class->description, ENT_QUOTES | ENT_HTML5), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                        $descText = strip_tags($descHtml);
                        $shortDesc = mb_strlen($descText) > 250 ? mb_substr($descText, 0, 250) . '...' : $descText;
                        ?>
                        <p class="text-gray-600 mb-4 prose max-w-none"><?= $shortDesc ?></p>
                        <div class="mt-4">
                            <?php if ($class->status == 'Coming Soon'): ?>
                                <button class="w-full text-center bg-gradient-to-r from-gray-400 to-gray-500 text-white px-4 py-2 rounded-lg cursor-not-allowed" disabled>
                                    Coming Soon
                                </button>
                            <?php else: ?>
                                <a href="<?= free_class_url($class->id) ?>" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors text-center">
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

     <!-- Workshop & Seminar Section -->
    <?php $this->load->view('home/workshop_section'); ?>

   

    <!-- Features Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Fitur Unggulan</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Mengapa memilih Aset Academy untuk belajar programming?
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg hover:bg-blue-50 transition-colors duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                        <i data-feather="video" class="w-8 h-8 text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Video Berkualitas HD</h3>
                    <p class="text-gray-600">Materi video dengan kualitas HD dan audio yang jernih untuk pengalaman belajar terbaik</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-lg hover:bg-green-50 transition-colors duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                        <i data-feather="code" class="w-8 h-8 text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Praktik Langsung</h3>
                    <p class="text-gray-600">Belajar sambil praktik dengan project nyata dan challenge interaktif</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-lg hover:bg-purple-50 transition-colors duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <i data-feather="users" class="w-8 h-8 text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Komunitas Support</h3>
                    <p class="text-gray-600">Bergabung dengan komunitas developer dan dapatkan bantuan dari mentor</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials Carousel -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Testimonial Peserta Kelas Coding</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Apa kata mereka tentang pengalaman belajar coding di Aset Academy
                </p>
            </div>
            
            <div class="relative">
                <div class="carousel flex overflow-x-auto space-x-6 pb-8 scrollbar-hide">
                    <div class="carousel-item w-80 flex-shrink-0 bg-gray-50 p-6 rounded-xl" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex items-center mb-4">
                            <?php if ($testimonial->photo && file_exists(FCPATH . 'uploads/testimonials/' . $testimonial->photo)): ?>
                                <img src="<?= base_url('uploads/testimonials/' . $testimonial->photo) ?>" alt="<?= html_escape($testimonial->name) ?>" class="w-12 h-12 rounded-full mr-4 object-cover">
                            <?php else: ?>
                                <div class="w-12 h-12 rounded-full mr-4 bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-500 text-xl"></i>
                                </div>
                            <?php endif; ?>
                            <div>
                                <h4 class="font-bold text-gray-800"><?= html_escape($testimonial->name) ?></h4>
                                <p class="text-sm text-gray-600"><?= html_escape($testimonial->position) ?></p>
                            </div>
                        </div>
                        <div class="flex mb-4">
                            <span class="text-yellow-400"><?= str_repeat('★', $testimonial->rating) ?></span>
                        </div>
                        <p class="text-gray-600 italic">
                            "<?= html_escape($testimonial->content) ?>"
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-700">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6" data-aos="fade-up">
                Siap Mulai Belajar Coding Sekarang?
            </h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Bergabung dengan ribuan peserta kelas coding lainnya dan raih karir impian di dunia teknologi
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6" data-aos="fade-up" data-aos-delay="200">
                <a href="#" class="px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:bg-gray-100 transition-colors">
                    Daftar Kelas Coding
                </a>
                <a href="#" class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-lg hover:bg-white/10 transition-colors">
                    Mulai Belajar Coding
                </a>
            </div>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>