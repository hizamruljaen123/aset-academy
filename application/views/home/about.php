<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 relative overflow-hidden" style="background: linear-gradient(135deg, #0e1127 0%, #2e3c73 50%, #198aad 100%);">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/5 w-96 h-96 rounded-full pulse-blob" style="background: rgba(30, 60, 115, 0.2);"></div>
            <div class="absolute -bottom-20 right-[10%] w-[420px] h-[330px] rounded-full pulse-blob" style="background: rgba(25, 138, 173, 0.15); animation-delay: 2.5s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 rounded-full pulse-blob" style="background: rgba(14, 17, 39, 0.1); animation-delay: 4s;"></div>
        </div>
        
        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="flex items-center justify-center mb-6" data-aos="fade-up">
                <span class="bg-white/10 text-white px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm border border-white/20">
                    🏢 Tentang Kami
                </span>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6" data-aos="fade-up" data-aos-delay="100">
                Membangun Masa Depan 
                <span class="block" style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Teknologi Indonesia
                </span>
            </h1>
            <p class="text-xl text-white/80 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                Aset Academy berkomitmen untuk mengembangkan generasi developer Indonesia yang kompeten, 
                inovatif, dan siap bersaing di era transformasi digital global.
            </p>
        </div>
    </section>

    <!-- Mission Vision Section -->
    <section class="py-20" style="background: linear-gradient(135deg, #0e1127 0%, #1a1f3a 50%, #2e3c73 100%);">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <div class="flex items-center mb-6">
                        <span class="text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg"
                              style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                            🎯 Visi & Misi
                        </span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Visi Kami</h2>
                    <p class="text-xl text-white/80 mb-8 leading-relaxed">
                        Menjadi platform edukasi teknologi terdepan yang mencetak talenta digital berkualitas tinggi 
                        untuk Indonesia dan dunia, dengan standar internasional dan relevansi industri.
                    </p>
                    <div class="bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/20">
                        <h3 class="text-xl font-bold text-white mb-6">Misi Kami</h3>
                        <ul class="space-y-4 text-white/90">
                            <li class="flex items-start">
                                <div class="w-6 h-6 rounded-full flex items-center justify-center mr-4 mt-1" style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <span>Menyediakan kurikulum programming terkini dan relevan dengan kebutuhan industri global</span>
                            </li>
                            <li class="flex items-start">
                                <div class="w-6 h-6 rounded-full flex items-center justify-center mr-4 mt-1" style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <span>Membangun komunitas developer yang saling mendukung dan berkolaborasi secara global</span>
                            </li>
                            <li class="flex items-start">
                                <div class="w-6 h-6 rounded-full flex items-center justify-center mr-4 mt-1" style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <span>Memberikan akses pendidikan teknologi yang terjangkau dan berkualitas tinggi</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div data-aos="fade-left">
                    <div class="relative">
                        <img src="http://static.photos/technology/640x360/8" alt="Team Collaboration" class="w-full rounded-2xl shadow-2xl floating border border-white/20">
                        <div class="absolute -top-6 -right-6 text-white px-6 py-3 rounded-xl font-semibold text-sm shadow-xl border border-white/20"
                             style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                            <i class="fas fa-users mr-2"></i>
                            Tim Profesional
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-20 bg-gradient-to-br from-slate-50 via-white to-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="flex items-center justify-center mb-6">
                    <span class="text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg"
                          style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                        💎 Nilai-nilai Kami
                    </span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Prinsip yang Menjadi Fondasi</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Nilai-nilai fundamental yang menjadi pedoman dalam setiap langkah kami untuk memberikan 
                    pengalaman pembelajaran teknologi yang terbaik dan bermakna.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-xl text-center hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-20 h-20 rounded-xl flex items-center justify-center mx-auto mb-6 shadow-lg"
                         style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                        <i class="fas fa-award text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Kualitas Terbaik</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Kami selalu berkomitmen memberikan materi pembelajaran dengan standar kualitas tertinggi 
                        dan metodologi yang telah terbukti efektif di industri.
                    </p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-xl text-center hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-20 h-20 rounded-xl flex items-center justify-center mx-auto mb-6 shadow-lg"
                         style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Komunitas Kolaboratif</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Membangun ekosistem belajar yang supportive dan kolaboratif untuk semua anggota, 
                        menciptakan lingkungan yang mendorong pertumbuhan bersama.
                    </p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-xl text-center hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-20 h-20 rounded-xl flex items-center justify-center mx-auto mb-6 shadow-lg"
                         style="background: linear-gradient(90deg, #198aad 0%, #2e3c73 100%);">
                        <i class="fas fa-lightbulb text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Inovasi Berkelanjutan</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Terus berinovasi dalam metode pembelajaran dan teknologi untuk memberikan pengalaman 
                        belajar yang optimal dan sesuai dengan perkembangan zaman.
                    </p>
                </div>
            </div>
        </div>
    </section>

   
    <!-- Stats Section -->
    <section class="py-20 relative overflow-hidden" style="background: linear-gradient(135deg, #0e1127 0%, #2e3c73 50%, #198aad 100%);">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 rounded-full pulse-blob" style="background: rgba(30, 60, 115, 0.1);"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full pulse-blob" style="background: rgba(25, 138, 173, 0.1); animation-delay: 2s;"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="flex items-center justify-center mb-6">
                    <span class="bg-white/10 text-white px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm border border-white/20">
                        📊 Pencapaian Kami
                    </span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Prestasi yang Membanggakan</h2>
                <p class="text-xl text-white/80 max-w-3xl mx-auto leading-relaxed">
                    Bukti nyata komitmen kami dalam mengembangkan talenta teknologi Indonesia melalui 
                    pencapaian-pencapaian yang telah diraih bersama komunitas pembelajaran kami.
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center text-white bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:bg-white/10 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-3xl md:text-4xl font-bold mb-2" style="color: #198aad;">5+</div>
                    <div class="text-lg font-medium">Tahun Berpengalaman</div>
                </div>
                <div class="text-center text-white bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:bg-white/10 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-3xl md:text-4xl font-bold mb-2" style="color: #198aad;">24.700+</div>
                    <div class="text-lg font-medium">Alumni Sukses</div>
                </div>
                <div class="text-center text-white bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:bg-white/10 transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-3xl md:text-4xl font-bold mb-2" style="color: #198aad;">50+</div>
                    <div class="text-lg font-medium">Program Tersedia</div>
                </div>
                <div class="text-center text-white bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:bg-white/10 transition-all duration-300" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-3xl md:text-4xl font-bold mb-2" style="color: #198aad;">4.9/5</div>
                    <div class="text-lg font-medium">Rating Kepuasan</div>
                </div>
            </div>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>