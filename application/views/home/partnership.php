<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600">
        <div class="container mx-auto px-4 text-center">
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center">
                    <i data-feather="handshake" class="w-10 h-10 text-white"></i>
                </div>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6" data-aos="fade-up">
                Partnership & Corporate Training
            </h1>
            <p class="text-xl text-white/90 max-w-3xl mx-auto mb-8" data-aos="fade-up" data-aos-delay="100">
                Transformasi digital perusahaan Anda dengan program pelatihan programming terbaik. 
                Kami menyediakan solusi edukasi khusus untuk korporasi, institusi, dan komunitas.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4" data-aos="fade-up" data-aos-delay="200">
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20program%20partnership%20Aset%20Academy" 
                   class="px-8 py-4 bg-white text-indigo-600 font-bold rounded-lg hover:bg-gray-100 transition-colors flex items-center justify-center gap-2">
                    <i data-feather="message-circle" class="w-5 h-5"></i>
                    Konsultasi via WhatsApp
                </a>
                <a href="#packages" class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-lg hover:bg-white/10 transition-colors">
                    Lihat Paket Partnership
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-3xl md:text-4xl font-bold text-indigo-600 mb-2">50+</div>
                    <div class="text-gray-600">Perusahaan Partner</div>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-3xl md:text-4xl font-bold text-purple-600 mb-2">1000+</div>
                    <div class="text-gray-600">Karyawan Terlatih</div>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-3xl md:text-4xl font-bold text-pink-600 mb-2">95%</div>
                    <div class="text-gray-600">Tingkat Kepuasan</div>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">24/7</div>
                    <div class="text-gray-600">Dukungan Pelanggan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partnership Benefits -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Keuntungan Partnership</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Bergabunglah dengan ratusan perusahaan yang telah mempercayakan transformasi digital kepada kami
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                        <i data-feather="trending-up" class="w-8 h-8 text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Peningkatan Skill Tim</h3>
                    <p class="text-gray-600 mb-4">Tingkatkan kompetensi tim teknis Anda dengan kurikulum terkini dan praktis.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            Customized curriculum
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            Hands-on projects
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            Industry best practices
                        </li>
                    </ul>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <i data-feather="clock" class="w-8 h-8 text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Flexible Schedule</h3>
                    <p class="text-gray-600 mb-4">Pelatihan disesuaikan dengan jadwal perusahaan Anda, baik offline maupun online.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            Weekend classes
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            Evening sessions
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            On-site training
                        </li>
                    </ul>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6">
                        <i data-feather="award" class="w-8 h-8 text-pink-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Sertifikat Resmi</h3>
                    <p class="text-gray-600 mb-4">Dapatkan sertifikat yang diakui industri untuk setiap peserta yang menyelesaikan pelatihan.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            Industry recognized
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            Digital certificates
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            Verification portal
                        </li>
                    </ul>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                        <i data-feather="users" class="w-8 h-8 text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Mentor Expert</h3>
                    <p class="text-gray-600 mb-4">Dibimbing oleh profesional berpengalaman dari perusahaan teknologi ternama.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            Industry experts
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            1:1 mentoring
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            Career guidance
                        </li>
                    </ul>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="500">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                        <i data-feather="dollar-sign" class="w-8 h-8 text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Cost Effective</h3>
                    <p class="text-gray-600 mb-4">Harga kompetitif dengan diskon khusus untuk jumlah peserta yang banyak.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            Volume discounts
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            Payment plans
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            ROI guaranteed
                        </li>
                    </ul>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="600">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-6">
                        <i data-feather="refresh-cw" class="w-8 h-8 text-orange-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Continuous Support</h3>
                    <p class="text-gray-600 mb-4">Dukungan penuh sebelum, selama, dan setelah pelatihan berakhir.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            Post-training support
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            Community access
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                            Update materials
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Partnership Packages -->
    <section id="packages" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Paket Partnership</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Pilih paket yang sesuai dengan kebutuhan perusahaan Anda
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Basic Package -->
                <div class="bg-gray-50 rounded-xl p-8 border-2 border-gray-200 hover:border-indigo-300 transition-colors" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-feather="briefcase" class="w-8 h-8 text-indigo-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Basic</h3>
                        <p class="text-gray-600">Untuk tim kecil dan startup</p>
                    </div>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">Hingga 10 peserta</span>
                        </div>
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">3 bulan akses</span>
                        </div>
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">Basic curriculum</span>
                        </div>
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">Email support</span>
                        </div>
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">Digital certificates</span>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-600 mb-4">Rp 15jt</div>
                        <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20dengan%20paketa%20Basic%20partnership" 
                           class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition-colors">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
                
                <!-- Professional Package -->
                <div class="bg-indigo-50 rounded-xl p-8 border-2 border-indigo-300 transform scale-105 shadow-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-feather="star" class="w-8 h-8 text-white"></i>
                        </div>
                        <div class="bg-indigo-600 text-white text-xs font-semibold px-3 py-1 rounded-full inline-block mb-2">
                            MOST POPULAR
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Professional</h3>
                        <p class="text-gray-600">Untuk perusahaan menengah</p>
                    </div>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">Hingga 25 peserta</span>
                        </div>
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">6 bulan akses</span>
                        </div>
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">Advanced curriculum</span>
                        </div>
                        <div class="flex items-center">
                            <i data-feather="check" w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">Priority support</span>
                        </div>
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">1:1 mentoring</span>
                        </div>
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">Custom projects</span>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-600 mb-4">Rp 35jt</div>
                        <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20dengan%20paketa%20Professional%20partnership" 
                           class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition-colors">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
                
                <!-- Enterprise Package -->
                <div class="bg-gray-50 rounded-xl p-8 border-2 border-gray-200 hover:border-indigo-300 transition-colors" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-feather="building" class="w-8 h-8 text-purple-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Enterprise</h3>
                        <p class="text-gray-600">Untuk korporasi besar</p>
                    </div>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">Unlimited peserta</span>
                        </div>
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">12 bulan akses</span>
                        </div>
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">Custom curriculum</span>
                        </div>
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">24/7 dedicated support</span>
                        </div>
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">On-site training</span>
                        </div>
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">Progress tracking</span>
                        </div>
                        <div class="flex items-center">
                            <i data-feather="check" class="w-5 h-5 text-green-500 mr-3"></i>
                            <span class="text-gray-700">Custom reporting</span>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-600 mb-4">Custom</div>
                        <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20dengan%20paketa%20Enterprise%20partnership" 
                           class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition-colors">
                            Konsultasi Gratis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Success Stories</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Perusahaan-perusahaan yang telah bertransformasi bersama kami
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl shadow-lg p-8" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <i data-feather="building-2" class="w-6 h-6 text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">TechCorp Indonesia</h3>
                            <p class="text-gray-600">Perusahaan Teknologi</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">
                        "Setelah mengikuti program partnership dengan Aset Academy, produktivitas tim developer kami meningkat 40%. 
                        Materi yang disesuaikan dengan kebutuhan perusahaan sangat membantu."
                    </p>
                    <div class="flex items-center text-sm text-gray-500">
                        <i data-feather="users" class="w-4 h-4 mr-2"></i>
                        <span>25 karyawan terlatih</span>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <i data-feather="building-2" class="w-6 h-6 text-green-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">FinTech Solutions</h3>
                            <p class="text-gray-600">Startup Fintech</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">
                        "Program pelatihan dari Aset Academy sangat relevan dengan kebutuhan industri fintech. 
                        Tim kami sekarang lebih siap untuk menghadapi tantangan teknologi terkini."
                    </p>
                    <div class="flex items-center text-sm text-gray-500">
                        <i data-feather="users" class="w-4 h-4 mr-2"></i>
                        <span>15 karyawan terlatih</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Hubungi Kami Sekarang</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Siap untuk memulai transformasi digital perusahaan Anda?
                    </p>
                </div>
                
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl p-8 text-white" data-aos="fade-up" data-aos-delay="100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-2xl font-bold mb-6">Konsultasi Gratis</h3>
                            <p class="mb-6">Tim kami siap membantu Anda menentukan program pelatihan yang paling sesuai dengan kebutuhan perusahaan.</p>
                            
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <i data-feather="phone" class="w-5 h-5 mr-3"></i>
                                    <span>+62 812-3456-7890</span>
                                </div>
                                <div class="flex items-center">
                                    <i data-feather="mail" class="w-5 h-5 mr-3"></i>
                                    <span>partnership@asetacademy.com</span>
                                </div>
                                <div class="flex items-center">
                                    <i data-feather="map-pin" class="w-5 h-5 mr-3"></i>
                                    <span>Jakarta, Indonesia</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <div class="bg-white/20 backdrop-blur-md rounded-xl p-6 mb-6">
                                <i data-feather="message-circle" class="w-12 h-12 mx-auto mb-4"></i>
                                <h4 class="text-lg font-semibold mb-2">WhatsApp Konsultasi</h4>
                                <p class="text-sm mb-4">Klik tombol di bawah untuk langsung chat dengan tim partnership kami</p>
                                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20program%20partnership%20Aset%20Academy" 
                                   class="inline-flex items-center gap-2 bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                                    <i data-feather="message-circle" class="w-5 h-5"></i>
                                    Chat via WhatsApp
                                </a>
                            </div>
                            
                            <div class="text-sm opacity-90">
                                <p>Respon dalam 5 menit pada jam kerja</p>
                                <p>Senin - Jumat, 09:00 - 18:00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-indigo-600 to-purple-600">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6" data-aos="fade-up">
                Siap Memulai Transformasi Digital Perusahaan Anda?
            </h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Bergabunglah dengan ratusan perusahaan yang telah mempercayakan pengembangan skill tim teknis kepada Aset Academy
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4" data-aos="fade-up" data-aos-delay="200">
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20program%20partnership%20Aset%20Academy" 
                   class="px-8 py-4 bg-white text-indigo-600 font-bold rounded-lg hover:bg-gray-100 transition-colors flex items-center justify-center gap-2">
                    <i data-feather="message-circle" class="w-5 h-5"></i>
                    Konsultasi Sekarang
                </a>
                <a href="#packages" class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-lg hover:bg-white/10 transition-colors">
                    Lihat Paket Lengkap
                </a>
            </div>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>