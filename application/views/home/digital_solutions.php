<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 overflow-hidden">
        <!-- Background with animated gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-600">
            <div class="absolute inset-0 bg-gradient-to-r from-green-500/20 via-transparent to-blue-500/20 animate-pulse"></div>
            <!-- Floating shapes for modern effect -->
            <div class="absolute top-20 left-10 w-32 h-32 bg-white/5 rounded-full blur-xl animate-bounce" style="animation-delay: 0s;"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-white/5 rounded-full blur-xl animate-bounce" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-white/5 rounded-full blur-xl animate-bounce" style="animation-delay: 2s;"></div>
        </div>

        <div class="relative container mx-auto px-4 text-center z-10">
            <div class="flex justify-center mb-8" data-aos="zoom-in">
                <div class="relative">
                    <div class="w-24 h-24 bg-white/10 backdrop-blur-lg rounded-2xl flex items-center justify-center shadow-2xl border border-white/20">
                        <i data-feather="code" class="w-12 h-12 text-white"></i>
                    </div>
                    <!-- Glow effect -->
                    <div class="absolute inset-0 w-24 h-24 bg-white/20 rounded-2xl blur-lg -z-10"></div>
                </div>
            </div>

            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-tight" data-aos="fade-up">
                Pengembangan Software
                <span class="block bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">
                    untuk UMKM
                </span>
            </h1>

            <p class="text-xl md:text-2xl text-white/90 max-w-4xl mx-auto mb-10 leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                <strong class="text-cyan-300">Software custom</strong> yang disesuaikan dengan kebutuhan bisnis UMKM Anda.
                Dari sistem manajemen, aplikasi kasir, hingga platform digital lengkap untuk meningkatkan produktivitas dan efisiensi operasional.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-6" data-aos="fade-up" data-aos-delay="200">
                <a href="<?php echo base_url('contact'); ?>"
                   class="group px-10 py-5 bg-white text-emerald-600 font-bold rounded-2xl hover:bg-gray-50 hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3 shadow-2xl hover:shadow-white/25">
                    <i data-feather="message-circle" class="w-6 h-6 group-hover:scale-110 transition-transform"></i>
                    Konsultasi Gratis
                </a>
                <a href="#services" class="group px-10 py-5 bg-white/10 backdrop-blur-md border-2 border-white/30 text-white font-bold rounded-2xl hover:bg-white/20 hover:scale-105 transition-all duration-300 shadow-xl">
                    Lihat Layanan
                </a>
            </div>

            <!-- Key Benefits -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                    <div class="w-12 h-12 bg-cyan-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <i data-feather="settings" class="w-6 h-6 text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Custom Development</h3>
                    <p class="text-white/80 text-sm">Software yang dibuat khusus sesuai kebutuhan bisnis Anda</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                    <div class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <i data-feather="trending-up" class="w-6 h-6 text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Tingkatkan Efisiensi</h3>
                    <p class="text-white/80 text-sm">Otomasi proses bisnis menghemat waktu dan biaya operasional</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                    <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <i data-feather="dollar-sign" class="w-6 h-6 text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">ROI Terukur</h3>
                    <p class="text-white/80 text-sm">Investasi software yang memberikan return yang jelas</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-gradient-to-br from-gray-50 via-white to-emerald-50 relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-0">
            <div class="absolute top-20 right-20 w-64 h-64 bg-gradient-to-br from-emerald-200/20 to-teal-200/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-20 w-64 h-64 bg-gradient-to-br from-cyan-200/20 to-blue-200/20 rounded-full blur-3xl"></div>
        </div>

        <div class="relative container mx-auto px-4 z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-100 to-teal-100 px-4 py-2 rounded-full mb-4">
                    <i data-feather="settings" class="w-4 h-4 text-emerald-600"></i>
                    <span class="text-sm font-semibold text-emerald-700">Layanan Unggulan</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Solusi Digital Terintegrasi</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Dari pengembangan website hingga sistem manajemen lengkap, kami siap membantu transformasi digital bisnis Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Website Development -->
                <div class="group bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                            <i data-feather="globe" class="w-10 h-10 text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i data-feather="star" class="w-3 h-3 text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-blue-600 transition-colors">Website Development</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Website responsif dan modern yang meningkatkan kredibilitas bisnis Anda dan menjangkau lebih banyak pelanggan.</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Responsive Design</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">SEO Optimized</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Admin Panel</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Mobile Friendly</span>
                        </li>
                    </ul>
                    <div class="text-center">
                        <a href="<?php echo base_url('contact'); ?>"
                           class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-2xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-center font-medium">
                            Konsultasi Website
                        </a>
                    </div>
                </div>

                <!-- E-commerce Solutions -->
                <div class="group bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                            <i data-feather="shopping-cart" class="w-10 h-10 text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i data-feather="star" class="w-3 h-3 text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-green-600 transition-colors">E-commerce Solutions</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Toko online lengkap dengan sistem pembayaran terintegrasi untuk meningkatkan penjualan bisnis Anda.</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Payment Gateway Integration</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Inventory Management</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Order Tracking</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Multi-channel Sales</span>
                        </li>
                    </ul>
                    <div class="text-center">
                        <a href="<?php echo base_url('contact'); ?>"
                           class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-2xl hover:from-green-600 hover:to-green-700 transition-all duration-300 text-center font-medium">
                            Konsultasi E-commerce
                        </a>
                    </div>
                </div>

                <!-- Digital Marketing -->
                <div class="group bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                            <i data-feather="megaphone" class="w-10 h-10 text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i data-feather="star" class="w-3 h-3 text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-purple-600 transition-colors">Digital Marketing</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Strategi pemasaran digital yang efektif untuk menjangkau target audience dan meningkatkan brand awareness.</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Social Media Marketing</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">SEO Optimization</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Content Marketing</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Analytics & Reporting</span>
                        </li>
                    </ul>
                    <div class="text-center">
                        <a href="<?php echo base_url('contact'); ?>"
                           class="w-full bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-3 rounded-2xl hover:from-purple-600 hover:to-purple-700 transition-all duration-300 text-center font-medium">
                            Konsultasi Marketing
                        </a>
                    </div>
                </div>

                <!-- Business Automation -->
                <div class="group bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="400">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                            <i data-feather="cpu" class="w-10 h-10 text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i data-feather="star" class="w-3 h-3 text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-orange-600 transition-colors">Business Automation</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Otomasi proses bisnis untuk meningkatkan efisiensi operasional dan mengurangi biaya administrasi.</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Workflow Automation</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Customer Management System</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Invoice & Billing System</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Reporting Dashboard</span>
                        </li>
                    </ul>
                    <div class="text-center">
                        <a href="<?php echo base_url('contact'); ?>"
                           class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-3 rounded-2xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 text-center font-medium">
                            Konsultasi Otomasi
                        </a>
                    </div>
                </div>

                <!-- Mobile App Development -->
                <div class="group bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="500">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                            <i data-feather="smartphone" class="w-10 h-10 text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i data-feather="star" class="w-3 h-3 text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-pink-600 transition-colors">Mobile App Development</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Aplikasi mobile yang user-friendly untuk meningkatkan engagement pelanggan dan kemudahan akses layanan.</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">iOS & Android Apps</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">User Experience Design</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Push Notifications</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">App Store Deployment</span>
                        </li>
                    </ul>
                    <div class="text-center">
                        <a href="<?php echo base_url('contact'); ?>"
                           class="w-full bg-gradient-to-r from-pink-500 to-pink-600 text-white px-6 py-3 rounded-2xl hover:from-pink-600 hover:to-pink-700 transition-all duration-300 text-center font-medium">
                            Konsultasi Mobile App
                        </a>
                    </div>
                </div>

                <!-- System Integration -->
                <div class="group bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100/50 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="600">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                            <i data-feather="link" class="w-10 h-10 text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i data-feather="star" class="w-3 h-3 text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-teal-600 transition-colors">System Integration</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Integrasi berbagai sistem digital untuk efisiensi maksimal dan pengalaman pengguna yang seamless.</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">API Development</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Third-party Integrations</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Data Synchronization</span>
                        </li>
                        <li class="flex items-center group/item">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-green-200 transition-colors">
                                <i data-feather="check" class="w-3 h-3 text-green-600"></i>
                            </div>
                            <span class="text-gray-700 group-hover/item:text-gray-900 transition-colors">Cloud Migration</span>
                        </li>
                    </ul>
                    <div class="text-center">
                        <a href="<?php echo base_url('contact'); ?>"
                           class="w-full bg-gradient-to-r from-teal-500 to-teal-600 text-white px-6 py-3 rounded-2xl hover:from-teal-600 hover:to-teal-700 transition-all duration-300 text-center font-medium">
                            Konsultasi Integration
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-20 bg-gradient-to-br from-white via-emerald-50 to-teal-50 relative overflow-hidden">
        <div class="relative container mx-auto px-4 z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-100 to-teal-100 px-4 py-2 rounded-full mb-4">
                    <i data-feather="heart" class="w-4 h-4 text-emerald-600"></i>
                    <span class="text-sm font-semibold text-emerald-700">Mengapa Memilih Kami</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Partner Terpercaya untuk Transformasi Digital</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Kami memahami tantangan UMKM dan individual dalam mengadopsi teknologi digital. Dengan pengalaman dan pendekatan yang tepat, kami siap membantu Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <i data-feather="users" class="w-10 h-10 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Expert Team</h3>
                    <p class="text-gray-600">Tim ahli dengan pengalaman bertahun-tahun dalam pengembangan solusi digital untuk berbagai jenis bisnis.</p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <i data-feather="dollar-sign" class="w-10 h-10 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Harga Terjangkau</h3>
                    <p class="text-gray-600">Solusi digital berkualitas dengan harga yang kompetitif dan sesuai budget UMKM Indonesia.</p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-20 h-20 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <i data-feather="headphones" class="w-10 h-10 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Support Penuh</h3>
                    <p class="text-gray-600">Dukungan teknis dan maintenance berkelanjutan untuk memastikan sistem Anda selalu berjalan optimal.</p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <i data-feather="trending-up" class="w-10 h-10 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">ROI Terukur</h3>
                    <p class="text-gray-600">Setiap solusi dirancang untuk memberikan return on investment yang jelas dan terukur.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-slate-900 via-emerald-900 to-slate-900 relative overflow-hidden">
        <div class="relative container mx-auto px-4 text-center z-10">
            <div class="inline-flex items-center gap-2 bg-gradient-to-r from-yellow-400/20 to-orange-400/20 backdrop-blur-md border border-yellow-400/30 px-4 py-2 rounded-full mb-8" data-aos="fade-down">
                <i data-feather="lightning" class="w-4 h-4 text-yellow-400"></i>
                <span class="text-sm font-semibold text-yellow-300">Transformasi Digital Sekarang</span>
            </div>

            <h2 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight" data-aos="fade-up">
                Siap Tingkatkan
                <span class="block bg-gradient-to-r from-cyan-300 via-teal-300 to-emerald-300 bg-clip-text text-transparent">
                    Bisnis Anda?
                </span>
            </h2>

            <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-4xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                Mulai perjalanan transformasi digital Anda hari ini. Dapatkan konsultasi gratis dan penawaran terbaik untuk solusi digital yang sesuai kebutuhan bisnis Anda.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-6" data-aos="fade-up" data-aos-delay="200">
                <a href="<?php echo base_url('contact'); ?>"
                   class="group px-10 py-5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-2xl hover:from-emerald-600 hover:to-teal-600 hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3 shadow-2xl hover:shadow-emerald/25 text-lg">
                    <i data-feather="zap" class="w-6 h-6 group-hover:scale-110 transition-transform"></i>
                    Mulai Transformasi
                    <i data-feather="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="#services" class="group px-10 py-5 bg-white/10 backdrop-blur-md border-2 border-white/30 text-white font-bold rounded-2xl hover:bg-white/20 hover:scale-105 transition-all duration-300 shadow-xl text-lg">
                    Lihat Semua Layanan
                </a>
            </div>

            <p class="text-white/70 mt-8 text-sm" data-aos="fade-up" data-aos-delay="300">
                🚀 Konsultasi gratis • Implementasi cepat • Support berkelanjutan • ROI terjamin
            </p>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>
