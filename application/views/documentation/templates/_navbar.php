<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<nav class="fixed w-full bg-white/95 backdrop-blur-md shadow-lg z-50 transition-all duration-300 border-b border-gray-100">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <!-- Logo and Brand -->
            <div class="flex items-center space-x-3">
                <a href="<?= site_url() ?>" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                    <img src="<?= base_url('assets/img/logo.png') ?>" alt="ASET Academy" class="h-8 w-auto">
                    <span class="text-lg font-bold text-gray-900 hidden sm:block">ASET Academy</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-1">
                <!-- Beranda -->
                <a href="<?= site_url() ?>" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors rounded-lg hover:bg-blue-50">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>

                <!-- Kelas Dropdown -->
                <div class="relative group">
                    <button class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors rounded-lg hover:bg-blue-50 flex items-center">
                        <i class="fas fa-graduation-cap mr-2"></i>Kelas
                        <i class="fas fa-chevron-down ml-2 text-sm transition-transform group-hover:rotate-180"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <div class="p-2">
                            <a href="<?= site_url('home/premium') ?>" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                                <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-crown text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium">Kelas Premium</div>
                                    <div class="text-sm text-gray-500">Akses penuh dengan sertifikat</div>
                                </div>
                            </a>
                            <a href="<?= site_url('home/free') ?>" class="flex items-center px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-colors">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-blue-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-leaf text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium">Kelas Gratis</div>
                                    <div class="text-sm text-gray-500">Belajar tanpa biaya</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Dokumentasi Dropdown -->
                <div class="relative group">
                    <button class="px-4 py-2 text-blue-600 font-medium transition-colors rounded-lg bg-blue-50 flex items-center">
                        <i class="fas fa-book mr-2"></i>Dokumentasi
                        <i class="fas fa-chevron-down ml-2 text-sm transition-transform group-hover:rotate-180"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <div class="p-3">
                            <div class="mb-3">
                                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Panduan Utama</div>
                                <a href="<?= site_url('documentation') ?>" class="flex items-center px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                                    <i class="fas fa-home mr-3 text-blue-500"></i>
                                    <span class="font-medium">Beranda Dokumentasi</span>
                                </a>
                            </div>
                            <div class="border-t border-gray-100 pt-3">
                                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Bab Materi</div>
                                <div class="grid grid-cols-2 gap-1">
                                    <?php for($i = 1; $i <= 10; $i++): ?>
                                    <a href="<?= site_url('documentation/chapter'.$i) ?>" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-lg transition-colors">
                                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs font-medium mr-2"><?php echo $i; ?></span>
                                        <span>Bab <?php echo $i; ?></span>
                                    </a>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Layanan Dropdown -->
                <div class="relative group">
                    <button class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors rounded-lg hover:bg-blue-50 flex items-center">
                        <i class="fas fa-cogs mr-2"></i>Layanan
                        <i class="fas fa-chevron-down ml-2 text-sm transition-transform group-hover:rotate-180"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <div class="p-2">
                            <a href="<?= site_url('home/digital_solutions') ?>" class="flex items-center px-4 py-3 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg transition-colors">
                                <div class="w-10 h-10 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-laptop-code text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium">Solusi Digital</div>
                                    <div class="text-sm text-gray-500">Layanan teknologi</div>
                                </div>
                            </a>
                            <a href="<?= site_url('home/partnership') ?>" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg transition-colors">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-handshake text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium">Partnership</div>
                                    <div class="text-sm text-gray-500">Kolaborasi bisnis</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tentang Kami -->
                <a href="<?= site_url('home/about') ?>" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors rounded-lg hover:bg-blue-50">
                    <i class="fas fa-info-circle mr-2"></i>Tentang
                </a>

                <!-- Download App -->
                <a href="<?= site_url('home/download_app') ?>" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                    <i class="fas fa-mobile-alt mr-2"></i>Download App
                </a>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden lg:flex items-center space-x-3">
                <a href="<?= site_url('auth/login') ?>" class="px-4 py-2 text-blue-600 font-medium hover:text-blue-700 transition-colors">
                    Masuk
                </a>
                <a href="<?= site_url('auth/register') ?>" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-lg hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                    Daftar
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden p-2 text-gray-700 hover:text-blue-600 transition-colors">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden mt-4 pb-4 border-t border-gray-100 hidden">
            <div class="pt-4 space-y-2">
                <!-- Mobile Menu Items -->
                <a href="<?= site_url() ?>" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                    <i class="fas fa-home mr-3"></i>Beranda
                </a>

                <!-- Mobile Kelas Section -->
                <div class="px-4 py-2">
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Kelas</div>
                    <a href="<?= site_url('home/premium') ?>" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <i class="fas fa-crown mr-3 text-yellow-500"></i>Kelas Premium
                    </a>
                    <a href="<?= site_url('home/free') ?>" class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-colors">
                        <i class="fas fa-leaf mr-3 text-green-500"></i>Kelas Gratis
                    </a>
                </div>

                <!-- Mobile Dokumentasi Section -->
                <div class="px-4 py-2">
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Dokumentasi</div>
                    <a href="<?= site_url('documentation') ?>" class="flex items-center px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                        <i class="fas fa-book mr-3"></i>Beranda Dokumentasi
                    </a>
                    <div class="ml-7 mt-2 grid grid-cols-2 gap-1">
                        <?php for($i = 1; $i <= 10; $i++): ?>
                        <a href="<?= site_url('documentation/chapter'.$i) ?>" class="px-3 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded transition-colors">
                            Bab <?php echo $i; ?>
                        </a>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- Mobile Layanan Section -->
                <div class="px-4 py-2">
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Layanan</div>
                    <a href="<?= site_url('home/digital_solutions') ?>" class="flex items-center px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg transition-colors">
                        <i class="fas fa-laptop-code mr-3 text-emerald-500"></i>Solusi Digital
                    </a>
                    <a href="<?= site_url('home/partnership') ?>" class="flex items-center px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg transition-colors">
                        <i class="fas fa-handshake mr-3 text-purple-500"></i>Partnership
                    </a>
                </div>

                <!-- Mobile Other Links -->
                <a href="<?= site_url('home/about') ?>" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                    <i class="fas fa-info-circle mr-3"></i>Tentang Kami
                </a>
                <a href="<?= site_url('home/download_app') ?>" class="flex items-center px-4 py-3 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                    <i class="fas fa-mobile-alt mr-3"></i>Download App
                </a>

                <!-- Mobile Auth Buttons -->
                <div class="px-4 pt-4 border-t border-gray-100 mt-4 space-y-2">
                    <a href="<?= site_url('auth/login') ?>" class="block w-full px-4 py-3 text-center text-blue-600 font-medium border border-blue-600 rounded-lg hover:bg-blue-50 transition-colors">
                        Masuk
                    </a>
                    <a href="<?= site_url('auth/register') ?>" class="block w-full px-4 py-3 text-center bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-lg hover:shadow-lg transition-all duration-200">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Menu JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuBtn.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');

        // Toggle icon
        const icon = mobileMenuBtn.querySelector('i');
        if (mobileMenu.classList.contains('hidden')) {
            icon.className = 'fas fa-bars text-xl';
        } else {
            icon.className = 'fas fa-times text-xl';
        }
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!mobileMenuBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
            mobileMenu.classList.add('hidden');
            const icon = mobileMenuBtn.querySelector('i');
            icon.className = 'fas fa-bars text-xl';
        }
    });
});
</script>
