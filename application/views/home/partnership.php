<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 overflow-hidden">
        <!-- Background with animated gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 via-transparent to-purple-500/20 animate-pulse"></div>
            <!-- Floating shapes for modern effect -->
            <div class="absolute top-20 left-10 w-32 h-32 bg-white/5 rounded-full blur-xl animate-bounce" style="animation-delay: 0s;"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-white/5 rounded-full blur-xl animate-bounce" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-white/5 rounded-full blur-xl animate-bounce" style="animation-delay: 2s;"></div>
        </div>

        <div class="relative container mx-auto px-4 text-center z-10">
            <div class="flex justify-center mb-8" data-aos="zoom-in">
                <div class="relative">
                    <div class="w-24 h-24 bg-white/10 backdrop-blur-lg rounded-2xl flex items-center justify-center shadow-2xl border border-white/20">
                        <i data-feather="handshake" class="w-12 h-12 text-white"></i>
                    </div>
                    <!-- Glow effect -->
                    <div class="absolute inset-0 w-24 h-24 bg-white/20 rounded-2xl blur-lg -z-10"></div>
                </div>
            </div>

            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-tight" data-aos="fade-up">
                Partnership &
                <span class="block bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">
                    Corporate Training
                </span>
            </h1>

            <p class="text-xl md:text-2xl text-white/90 max-w-4xl mx-auto mb-10 leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                Transformasi digital perusahaan Anda dengan program pelatihan programming terbaik.
                Kami menyediakan solusi edukasi khusus untuk korporasi, institusi, dan komunitas.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-6" data-aos="fade-up" data-aos-delay="200">
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20program%20partnership%20Aset%20Academy"
                   class="group px-10 py-5 bg-white text-indigo-600 font-bold rounded-2xl hover:bg-gray-50 hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3 shadow-2xl hover:shadow-white/25">
                    <i data-feather="message-circle" class="w-6 h-6 group-hover:scale-110 transition-transform"></i>
                    Konsultasi via WhatsApp
                </a>
                <a href="#packages" class="group px-10 py-5 bg-white/10 backdrop-blur-md border-2 border-white/30 text-white font-bold rounded-2xl hover:bg-white/20 hover:scale-105 transition-all duration-300 shadow-xl">
                    Lihat Paket Partnership
                </a>
            </div>

            <!-- Scroll indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                <div class="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center">
                    <div class="w-1 h-3 bg-white/50 rounded-full mt-2 animate-pulse"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
        <!-- Background pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, #6366f1 2px, transparent 2px), radial-gradient(circle at 75% 75%, #8b5cf6 2px, transparent 2px); background-size: 50px 50px;"></div>
        </div>

        <div class="relative container mx-auto px-4 z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Pencapaian Kami</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Angka-angka yang menunjukkan kepercayaan perusahaan terhadap layanan kami</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="group text-center bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i data-feather="building" class="w-8 h-8 text-white"></i>
                    </div>
                    <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-2">50+</div>
                    <div class="text-gray-600 font-medium">Perusahaan Partner</div>
                    <div class="w-12 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>

                <div class="group text-center bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i data-feather="users" class="w-8 h-8 text-white"></i>
                    </div>
                    <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">1000+</div>
                    <div class="text-gray-600 font-medium">Karyawan Terlatih</div>
                    <div class="w-12 h-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>

                <div class="group text-center bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-100" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i data-feather="trending-up" class="w-8 h-8 text-white"></i>
                    </div>
                    <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-pink-600 to-red-600 bg-clip-text text-transparent mb-2">95%</div>
                    <div class="text-gray-600 font-medium">Tingkat Kepuasan</div>
                    <div class="w-12 h-1 bg-gradient-to-r from-pink-500 to-red-500 rounded-full mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>

                <div class="group text-center bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-100" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i data-feather="clock" class="w-8 h-8 text-white"></i>
                    </div>
                    <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent mb-2">24/7</div>
                    <div class="text-gray-600 font-medium">Dukungan Pelanggan</div>
                    <div class="w-12 h-1 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partnership Benefits -->
    <section class="py-20 bg-gradient-to-br from-slate-50 via-white to-blue-50 relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-200/30 to-purple-200/30 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-purple-200/30 to-pink-200/30 rounded-full blur-3xl"></div>
        </div>

        <div class="relative container mx-auto px-4 z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-100 to-purple-100 px-4 py-2 rounded-full mb-4">
                    <i data-feather="star" class="w-4 h-4 text-indigo-600"></i>
                    <span class="text-sm font-semibold text-indigo-700">Keuntungan Utama</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Mengapa Memilih Partnership Kami?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Bergabunglah dengan ratusan perusahaan yang telah mempercayakan transformasi digital kepada kami
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Enhanced Benefit Cards -->
                <div class="group bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                            <i data-feather="trending-up" class="w-10 h-10 text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i data-feather="zap" class="w-3 h-3 text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-indigo-600 transition-colors">Peningkatan Skill Tim</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Tingkatkan kompetensi tim teknis Anda dengan kurikulum terkini dan praktis yang disesuaikan kebutuhan perusahaan.</p>
                    <ul class="space-y-3">
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Customized curriculum</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Hands-on projects</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Industry best practices</span>
                        </li>
                    </ul>
                </div>

                <div class="group bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                            <i data-feather="clock" class="w-10 h-10 text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i data-feather="zap" class="w-3 h-3 text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-purple-600 transition-colors">Flexible Schedule</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Pelatihan disesuaikan dengan jadwal perusahaan Anda, baik offline maupun online sesuai kebutuhan.</p>
                    <ul class="space-y-3">
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Weekend classes</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Evening sessions</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">On-site training</span>
                        </li>
                    </ul>
                </div>

                <div class="group bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                            <i data-feather="award" class="w-10 h-10 text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i data-feather="zap" class="w-3 h-3 text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-pink-600 transition-colors">Sertifikat Resmi</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Dapatkan sertifikat yang diakui industri untuk setiap peserta yang menyelesaikan pelatihan.</p>
                    <ul class="space-y-3">
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Industry recognized</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Digital certificates</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Verification portal</span>
                        </li>
                    </ul>
                </div>

                <div class="group bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="400">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                            <i data-feather="users" class="w-10 h-10 text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i data-feather="zap" class="w-3 h-3 text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-blue-600 transition-colors">Mentor Expert</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Dibimbing oleh profesional berpengalaman dari perusahaan teknologi ternama dunia.</p>
                    <ul class="space-y-3">
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Industry experts</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">1:1 mentoring</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Career guidance</span>
                        </li>
                    </ul>
                </div>

                <div class="group bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="500">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                            <i data-feather="dollar-sign" class="w-10 h-10 text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i data-feather="zap" class="w-3 h-3 text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-green-600 transition-colors">Cost Effective</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Harga kompetitif dengan diskon khusus untuk jumlah peserta yang banyak dan ROI terjamin.</p>
                    <ul class="space-y-3">
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Volume discounts</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Payment plans</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">ROI guaranteed</span>
                        </li>
                    </ul>
                </div>

                <div class="group bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="600">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                            <i data-feather="refresh-cw" class="w-10 h-10 text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i data-feather="zap" class="w-3 h-3 text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-orange-600 transition-colors">Continuous Support</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Dukungan penuh sebelum, selama, dan setelah pelatihan berakhir dengan akses komunitas eksklusif.</p>
                    <ul class="space-y-3">
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Post-training support</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Community access</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Update materials</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Partnership Packages -->
    <section id="packages" class="py-20 bg-gradient-to-br from-gray-50 via-white to-indigo-50 relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-0">
            <div class="absolute top-20 right-20 w-64 h-64 bg-gradient-to-br from-indigo-200/20 to-purple-200/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-20 w-64 h-64 bg-gradient-to-br from-purple-200/20 to-pink-200/20 rounded-full blur-3xl"></div>
        </div>

        <div class="relative container mx-auto px-4 z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-100 to-purple-100 px-4 py-2 rounded-full mb-4">
                    <i data-feather="package" class="w-4 h-4 text-indigo-600"></i>
                    <span class="text-sm font-semibold text-indigo-700">Paket Lengkap</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Pilih Paket Partnership Terbaik</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Pilih paket yang sesuai dengan kebutuhan perusahaan Anda. Semua paket sudah termasuk sertifikat resmi dan dukungan penuh.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto">
                <!-- Basic Package -->
                <div class="group bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center mb-8">
                        <div class="relative">
                            <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                                <i data-feather="briefcase" class="w-10 h-10 text-white"></i>
                            </div>
                            <div class="absolute -top-3 -right-3 w-8 h-8 bg-gradient-to-r from-blue-400 to-blue-500 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                <i data-feather="star" class="w-4 h-4 text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-2">Basic</h3>
                        <p class="text-gray-600 mb-6">Untuk tim kecil dan startup</p>

                        <!-- Pricing -->
                        <div class="mb-8">
                            <div class="flex items-baseline justify-center">
                                <span class="text-5xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">15</span>
                                <span class="text-2xl font-bold text-gray-600 ml-1">jt</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Harga kompetitif untuk tim kecil</p>
                        </div>
                    </div>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Hingga 10 peserta</span>
                        </div>
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">3 bulan akses penuh</span>
                        </div>
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Basic curriculum</span>
                        </div>
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Email support</span>
                        </div>
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Digital certificates</span>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20dengan%20paket%20Basic%20partnership"
                           class="group/btn w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 px-8 rounded-2xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 flex items-center justify-center gap-3 shadow-lg hover:shadow-xl hover:scale-105">
                            <i data-feather="message-circle" class="w-5 h-5 group-hover/btn:scale-110 transition-transform"></i>
                            Hubungi Kami
                        </a>
                    </div>
                </div>

                <!-- Professional Package -->
                <div class="group bg-gradient-to-br from-indigo-50 to-purple-50 rounded-3xl p-8 shadow-2xl hover:shadow-3xl transition-all duration-500 hover:-translate-y-4 border-2 border-indigo-200 transform scale-105 relative" data-aos="fade-up" data-aos-delay="200">
                    <!-- Popular Badge -->
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <div class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-sm font-bold px-6 py-2 rounded-full shadow-lg">
                            ⭐ MOST POPULAR
                        </div>
                    </div>

                    <div class="text-center mb-8">
                        <div class="relative">
                            <div class="w-20 h-20 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                                <i data-feather="star" class="w-10 h-10 text-white"></i>
                            </div>
                            <div class="absolute -top-3 -right-3 w-8 h-8 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center shadow-lg">
                                <i data-feather="crown" class="w-4 h-4 text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-2">Professional</h3>
                        <p class="text-gray-600 mb-6">Untuk perusahaan menengah</p>

                        <!-- Pricing -->
                        <div class="mb-8">
                            <div class="flex items-baseline justify-center">
                                <span class="text-5xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">35</span>
                                <span class="text-2xl font-bold text-gray-600 ml-1">jt</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Investasi terbaik untuk pertumbuhan</p>
                        </div>
                    </div>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Hingga 25 peserta</span>
                        </div>
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">6 bulan akses penuh</span>
                        </div>
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Advanced curriculum</span>
                        </div>
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Priority support</span>
                        </div>
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">1:1 mentoring</span>
                        </div>
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Custom projects</span>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20dengan%20paket%20Professional%20partnership"
                           class="group/btn w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 px-8 rounded-2xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 flex items-center justify-center gap-3 shadow-lg hover:shadow-xl hover:scale-105">
                            <i data-feather="message-circle" class="w-5 h-5 group-hover/btn:scale-110 transition-transform"></i>
                            Hubungi Kami
                        </a>
                    </div>
                </div>

                <!-- Enterprise Package -->
                <div class="group bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center mb-8">
                        <div class="relative">
                            <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                                <i data-feather="building" class="w-10 h-10 text-white"></i>
                            </div>
                            <div class="absolute -top-3 -right-3 w-8 h-8 bg-gradient-to-r from-purple-400 to-purple-500 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                <i data-feather="gem" class="w-4 h-4 text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-2">Enterprise</h3>
                        <p class="text-gray-600 mb-6">Untuk korporasi besar</p>

                        <!-- Pricing -->
                        <div class="mb-8">
                            <div class="flex items-baseline justify-center">
                                <span class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">Custom</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Harga disesuaikan kebutuhan</p>
                        </div>
                    </div>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Unlimited peserta</span>
                        </div>
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">12 bulan akses penuh</span>
                        </div>
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Custom curriculum</span>
                        </div>
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">24/7 dedicated support</span>
                        </div>
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">On-site training</span>
                        </div>
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Progress tracking</span>
                        </div>
                        <div class="flex items-center group/item">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Custom reporting</span>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20dengan%20paket%20Enterprise%20partnership"
                           class="group/btn w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white py-4 px-8 rounded-2xl hover:from-purple-700 hover:to-pink-700 transition-all duration-300 flex items-center justify-center gap-3 shadow-lg hover:shadow-xl hover:scale-105">
                            <i data-feather="message-circle" class="w-5 h-5 group-hover/btn:scale-110 transition-transform"></i>
                            Konsultasi Gratis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories -->
    <section class="py-20 bg-gradient-to-br from-white via-gray-50 to-indigo-50 relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-32 h-32 bg-gradient-to-br from-blue-200/20 to-indigo-200/20 rounded-full blur-2xl"></div>
            <div class="absolute bottom-10 right-10 w-40 h-40 bg-gradient-to-br from-purple-200/20 to-pink-200/20 rounded-full blur-2xl"></div>
        </div>

        <div class="relative container mx-auto px-4 z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 bg-gradient-to-r from-green-100 to-emerald-100 px-4 py-2 rounded-full mb-4">
                    <i data-feather="heart" class="w-4 h-4 text-green-600"></i>
                    <span class="text-sm font-semibold text-green-700">Testimoni Klien</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Success Stories</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Perusahaan-perusahaan yang telah bertransformasi bersama kami dan mencapai kesuksesan luar biasa
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
                <!-- Testimonial 1 -->
                <div class="group bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 p-8 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="100">
                    <!-- Quote mark -->
                    <div class="relative mb-6">
                        <div class="text-6xl text-indigo-100 font-serif leading-none">"</div>
                        <div class="absolute top-2 left-4 text-4xl text-indigo-200 font-serif leading-none">"</div>
                    </div>

                    <p class="text-gray-700 text-lg leading-relaxed mb-8 italic">
                        "Setelah mengikuti program partnership dengan Aset Academy, produktivitas tim developer kami meningkat 40%.
                        Materi yang disesuaikan dengan kebutuhan perusahaan sangat membantu dalam mengembangkan skill tim kami."
                    </p>

                    <!-- Company info -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                <i data-feather="building-2" class="w-7 h-7 text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-800">TechCorp Indonesia</h4>
                                <p class="text-gray-600">Perusahaan Teknologi</p>
                            </div>
                        </div>

                        <!-- Stats badge -->
                        <div class="bg-gradient-to-r from-blue-100 to-indigo-100 px-4 py-2 rounded-full">
                            <div class="flex items-center text-sm font-semibold text-blue-700">
                                <i data-feather="users" class="w-4 h-4 mr-2"></i>
                                25 karyawan
                            </div>
                        </div>
                    </div>

                    <!-- Star rating -->
                    <div class="flex items-center mt-6">
                        <div class="flex text-yellow-400">
                            <i data-feather="star" class="w-5 h-5 fill-current"></i>
                            <i data-feather="star" class="w-5 h-5 fill-current"></i>
                            <i data-feather="star" class="w-5 h-5 fill-current"></i>
                            <i data-feather="star" class="w-5 h-5 fill-current"></i>
                            <i data-feather="star" class="w-5 h-5 fill-current"></i>
                        </div>
                        <span class="ml-2 text-sm text-gray-600 font-medium">5.0 / 5.0</span>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="group bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 p-8 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="200">
                    <!-- Quote mark -->
                    <div class="relative mb-6">
                        <div class="text-6xl text-green-100 font-serif leading-none">"</div>
                        <div class="absolute top-2 left-4 text-4xl text-green-200 font-serif leading-none">"</div>
                    </div>

                    <p class="text-gray-700 text-lg leading-relaxed mb-8 italic">
                        "Program pelatihan dari Aset Academy sangat relevan dengan kebutuhan industri fintech.
                        Tim kami sekarang lebih siap untuk menghadapi tantangan teknologi terkini dan berkembang pesat."
                    </p>

                    <!-- Company info -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                <i data-feather="trending-up" class="w-7 h-7 text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-800">FinTech Solutions</h4>
                                <p class="text-gray-600">Startup Fintech</p>
                            </div>
                        </div>

                        <!-- Stats badge -->
                        <div class="bg-gradient-to-r from-green-100 to-emerald-100 px-4 py-2 rounded-full">
                            <div class="flex items-center text-sm font-semibold text-green-700">
                                <i data-feather="users" class="w-4 h-4 mr-2"></i>
                                15 karyawan
                            </div>
                        </div>
                    </div>

                    <!-- Star rating -->
                    <div class="flex items-center mt-6">
                        <div class="flex text-yellow-400">
                            <i data-feather="star" class="w-5 h-5 fill-current"></i>
                            <i data-feather="star" class="w-5 h-5 fill-current"></i>
                            <i data-feather="star" class="w-5 h-5 fill-current"></i>
                            <i data-feather="star" class="w-5 h-5 fill-current"></i>
                            <i data-feather="star" class="w-5 h-5 fill-current"></i>
                        </div>
                        <span class="ml-2 text-sm text-gray-600 font-medium">5.0 / 5.0</span>
                    </div>
                </div>
            </div>

            <!-- Trust indicators -->
            <div class="text-center mt-16" data-aos="fade-up" data-aos-delay="300">
                <p class="text-gray-600 mb-8">Dipercaya oleh perusahaan terkemuka di Indonesia</p>
                <div class="flex flex-wrap justify-center items-center gap-8 opacity-60">
                    <div class="bg-white/50 backdrop-blur-sm px-6 py-3 rounded-2xl shadow-lg">
                        <span class="text-lg font-bold text-gray-700">TechCorp</span>
                    </div>
                    <div class="bg-white/50 backdrop-blur-sm px-6 py-3 rounded-2xl shadow-lg">
                        <span class="text-lg font-bold text-gray-700">FinTech Solutions</span>
                    </div>
                    <div class="bg-white/50 backdrop-blur-sm px-6 py-3 rounded-2xl shadow-lg">
                        <span class="text-lg font-bold text-gray-700">Dan 50+ lainnya</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 bg-gradient-to-br from-white via-indigo-50 to-purple-50 relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-indigo-200/30 to-purple-200/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-br from-purple-200/30 to-pink-200/30 rounded-full blur-3xl"></div>
        </div>

        <div class="relative container mx-auto px-4 z-10">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16" data-aos="fade-up">
                    <div class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-100 to-purple-100 px-4 py-2 rounded-full mb-4">
                        <i data-feather="phone" class="w-4 h-4 text-indigo-600"></i>
                        <span class="text-sm font-semibold text-indigo-700">Hubungi Kami</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Siap Memulai Transformasi?</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Konsultasikan kebutuhan pelatihan perusahaan Anda dengan tim expert kami. Kami siap membantu Anda mencapai kesuksesan.
                    </p>
                </div>

                <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-3xl p-8 md:p-12 text-white shadow-2xl relative overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <!-- Background pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, white 2px, transparent 2px), radial-gradient(circle at 75% 75%, white 2px, transparent 2px); background-size: 40px 40px;"></div>
                    </div>

                    <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-12 z-10">
                        <!-- Left side - Contact Info -->
                        <div class="space-y-8">
                            <div>
                                <h3 class="text-3xl md:text-4xl font-bold mb-6">Konsultasi Gratis</h3>
                                <p class="text-lg opacity-90 leading-relaxed">Tim ahli kami siap membantu Anda menentukan program pelatihan yang paling sesuai dengan kebutuhan perusahaan Anda.</p>
                            </div>

                            <div class="space-y-6">
                                <!-- Contact items -->
                                <div class="group flex items-center p-4 bg-white/10 backdrop-blur-md rounded-2xl hover:bg-white/20 transition-all duration-300">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                        <i data-feather="phone" class="w-6 h-6"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm opacity-75">Telepon</p>
                                        <p class="text-lg font-semibold">+62 812-3456-7890</p>
                                    </div>
                                </div>

                                <div class="group flex items-center p-4 bg-white/10 backdrop-blur-md rounded-2xl hover:bg-white/20 transition-all duration-300">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                        <i data-feather="mail" class="w-6 h-6"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm opacity-75">Email</p>
                                        <p class="text-lg font-semibold">partnership@asetacademy.com</p>
                                    </div>
                                </div>

                                <div class="group flex items-center p-4 bg-white/10 backdrop-blur-md rounded-2xl hover:bg-white/20 transition-all duration-300">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                        <i data-feather="map-pin" class="w-6 h-6"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm opacity-75">Lokasi</p>
                                        <p class="text-lg font-semibold">Jakarta, Indonesia</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Working hours -->
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6">
                                <h4 class="text-lg font-semibold mb-3">Jam Kerja</h4>
                                <div class="space-y-2 text-sm">
                                    <p><span class="font-medium">Senin - Jumat:</span> 09:00 - 18:00 WIB</p>
                                    <p><span class="font-medium">Sabtu:</span> 09:00 - 15:00 WIB</p>
                                    <p><span class="font-medium">Minggu:</span> Tutup</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right side - WhatsApp CTA -->
                        <div class="flex flex-col justify-center">
                            <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 text-center shadow-2xl border border-white/20">
                                <!-- Animated icon -->
                                <div class="relative mb-6">
                                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                        <i data-feather="message-circle" class="w-10 h-10"></i>
                                    </div>
                                    <!-- Pulse animation -->
                                    <div class="absolute inset-0 w-20 h-20 bg-white/30 rounded-2xl animate-ping"></div>
                                </div>

                                <h4 class="text-2xl font-bold mb-4">WhatsApp Konsultasi</h4>
                                <p class="text-lg opacity-90 mb-8 leading-relaxed">Klik tombol di bawah untuk langsung chat dengan tim partnership kami. Respon cepat dalam 5 menit!</p>

                                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20program%20partnership%20Aset%20Academy"
                                   class="group inline-flex items-center gap-3 bg-white text-indigo-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-50 hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                                    <i data-feather="message-circle" class="w-6 h-6 group-hover:scale-110 transition-transform"></i>
                                    Chat via WhatsApp
                                    <i data-feather="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                                </a>

                                <div class="mt-6 flex items-center justify-center gap-2 text-sm opacity-90">
                                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                    <span>Online sekarang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-slate-900 via-purple-900 to-slate-900 relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-full blur-3xl"></div>
            <!-- Stars effect -->
            <div class="absolute inset-0">
                <div class="absolute top-20 left-20 w-2 h-2 bg-white/30 rounded-full animate-pulse"></div>
                <div class="absolute top-40 right-32 w-1 h-1 bg-white/40 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
                <div class="absolute bottom-32 left-1/3 w-1.5 h-1.5 bg-white/20 rounded-full animate-pulse" style="animation-delay: 2s;"></div>
                <div class="absolute top-1/3 right-20 w-1 h-1 bg-white/50 rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
            </div>
        </div>

        <div class="relative container mx-auto px-4 text-center z-10">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 bg-gradient-to-r from-yellow-400/20 to-orange-400/20 backdrop-blur-md border border-yellow-400/30 px-4 py-2 rounded-full mb-8" data-aos="fade-down">
                <i data-feather="zap" class="w-4 h-4 text-yellow-400"></i>
                <span class="text-sm font-semibold text-yellow-300">Limited Time Offer</span>
            </div>

            <h2 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight" data-aos="fade-up">
                Siap Memulai
                <span class="block bg-gradient-to-r from-yellow-300 via-orange-300 to-red-300 bg-clip-text text-transparent">
                    Transformasi Digital?
                </span>
            </h2>

            <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-4xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                Bergabunglah dengan ratusan perusahaan yang telah mempercayakan pengembangan skill tim teknis kepada Aset Academy.
                Mulai perjalanan transformasi digital Anda hari ini!
            </p>

            <!-- Social proof -->
            <div class="flex flex-wrap justify-center items-center gap-6 mb-12 opacity-80" data-aos="fade-up" data-aos-delay="150">
                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full">
                    <i data-feather="users" class="w-4 h-4 text-green-400"></i>
                    <span class="text-sm font-medium text-white">50+ Perusahaan</span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full">
                    <i data-feather="star" class="w-4 h-4 text-yellow-400"></i>
                    <span class="text-sm font-medium text-white">4.9/5 Rating</span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full">
                    <i data-feather="clock" class="w-4 h-4 text-blue-400"></i>
                    <span class="text-sm font-medium text-white">24/7 Support</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-center gap-6" data-aos="fade-up" data-aos-delay="200">
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20program%20partnership%20Aset%20Academy"
                   class="group px-10 py-5 bg-gradient-to-r from-yellow-400 to-orange-500 text-slate-900 font-bold rounded-2xl hover:from-yellow-300 hover:to-orange-400 hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3 shadow-2xl hover:shadow-yellow-400/25 text-lg">
                    <i data-feather="message-circle" class="w-6 h-6 group-hover:scale-110 transition-transform"></i>
                    Konsultasi Sekarang
                    <i data-feather="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="#packages" class="group px-10 py-5 bg-white/10 backdrop-blur-md border-2 border-white/30 text-white font-bold rounded-2xl hover:bg-white/20 hover:scale-105 transition-all duration-300 shadow-xl text-lg">
                    Lihat Paket Lengkap
                </a>
            </div>

            <!-- Urgency text -->
            <p class="text-white/70 mt-8 text-sm" data-aos="fade-up" data-aos-delay="300">
                🎯 Konsultasi gratis • Tidak ada biaya tersembunyi • Mulai dalam 24 jam
            </p>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>