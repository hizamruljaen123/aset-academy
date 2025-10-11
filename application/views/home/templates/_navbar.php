<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<nav class="fixed w-full bg-gray-900/95 backdrop-blur-md shadow-lg z-50 transition-all duration-300 border-b border-gray-700">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <!-- Logo and Brand -->
            <div class="flex items-center space-x-3">
                <a href="<?= site_url() ?>" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                    <img src="<?= base_url('assets/img/logo-white.png') ?>" alt="ASET Academy" class="h-8 w-auto">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-1">
                <!-- Beranda -->
                <a href="<?= site_url() ?>" class="px-4 py-2 text-white hover:text-blue-300 font-medium transition-colors rounded-lg hover:bg-white/10">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>

                <!-- Kelas Dropdown -->
                <div class="relative group">
                    <button class="px-4 py-2 text-white hover:text-blue-300 font-medium transition-colors rounded-lg hover:bg-white/10 flex items-center">
                        <i class="fas fa-graduation-cap mr-2"></i>Kelas
                        <i class="fas fa-chevron-down ml-2 text-sm transition-transform group-hover:rotate-180"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-64 bg-gray-800/95 backdrop-blur-md rounded-xl shadow-xl border border-gray-600 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <div class="p-2">
                            <a href="<?= site_url('home/premium') ?>" class="flex items-center px-4 py-3 text-white hover:bg-white/10 hover:text-blue-300 rounded-lg transition-colors">
                                <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-crown text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium">Kelas Premium</div>
                                    <div class="text-sm text-gray-400">Akses penuh dengan sertifikat</div>
                                </div>
                            </a>
                            <a href="<?= site_url('home/free') ?>" class="flex items-center px-4 py-3 text-white hover:bg-white/10 hover:text-green-300 rounded-lg transition-colors">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-blue-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-leaf text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium">Kelas Gratis</div>
                                    <div class="text-sm text-gray-400">Belajar tanpa biaya</div>
                                </div>
                            </a>
                            <a href="<?= site_url('workshops') ?>" class="flex items-center px-4 py-3 text-white hover:bg-white/10 hover:text-purple-300 rounded-lg transition-colors">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-indigo-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-chalkboard-teacher text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium">Workshop & Seminar</div>
                                    <div class="text-sm text-gray-400">Pelatihan intensif</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Dokumentasi (Simple Link) -->
                <a href="<?= site_url('documentation') ?>" class="px-4 py-2 text-blue-300 font-medium transition-colors rounded-lg bg-blue-500/20 flex items-center">
                    <i class="fas fa-book mr-2"></i>Dokumentasi
                </a>

                <!-- Layanan Dropdown -->
                <div class="relative group">
                    <button class="px-4 py-2 text-white hover:text-blue-300 font-medium transition-colors rounded-lg hover:bg-white/10 flex items-center">
                        <i class="fas fa-cogs mr-2"></i>Layanan
                        <i class="fas fa-chevron-down ml-2 text-sm transition-transform group-hover:rotate-180"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-64 bg-gray-800/95 backdrop-blur-md rounded-xl shadow-xl border border-gray-600 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <div class="p-2">
                            <a href="<?= site_url('home/digital_solutions') ?>" class="flex items-center px-4 py-3 text-white hover:bg-white/10 hover:text-emerald-300 rounded-lg transition-colors">
                                <div class="w-10 h-10 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-laptop-code text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium">Solusi Digital</div>
                                    <div class="text-sm text-gray-400">Layanan teknologi</div>
                                </div>
                            </a>
                            <a href="<?= site_url('home/partnership') ?>" class="flex items-center px-4 py-3 text-white hover:bg-white/10 hover:text-purple-300 rounded-lg transition-colors">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-handshake text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium">Partnership</div>
                                    <div class="text-sm text-gray-400">Kolaborasi bisnis</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tentang & Support -->
                <div class="relative group">
                    <button class="px-4 py-2 text-white hover:text-blue-300 font-medium transition-colors rounded-lg hover:bg-white/10 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>Info
                        <i class="fas fa-chevron-down ml-2 text-sm transition-transform group-hover:rotate-180"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-56 bg-gray-800/95 backdrop-blur-md rounded-xl shadow-xl border border-gray-600 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <div class="p-2">
                            <a href="<?= site_url('home/about') ?>" class="flex items-center px-4 py-3 text-white hover:bg-white/10 hover:text-blue-300 rounded-lg transition-colors">
                                <i class="fas fa-building mr-3 text-blue-400"></i>
                                <span>Tentang Kami</span>
                            </a>
                            <a href="<?= site_url('home/faq') ?>" class="flex items-center px-4 py-3 text-white hover:bg-white/10 hover:text-purple-300 rounded-lg transition-colors">
                                <i class="fas fa-question-circle mr-3 text-purple-400"></i>
                                <span>FAQ</span>
                            </a>
                            <a href="<?= site_url('contact') ?>" class="flex items-center px-4 py-3 text-white hover:bg-white/10 hover:text-green-300 rounded-lg transition-colors">
                                <i class="fas fa-headset mr-3 text-green-400"></i>
                                <span>Hubungi Kami</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Download App -->
                <a href="<?= site_url('home/download_app') ?>" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-200 flex items-center">
                    <i class="fas fa-mobile-alt mr-2"></i>Download App
                </a>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden lg:flex items-center space-x-3">
                <a href="<?= site_url('auth/login') ?>" class="px-4 py-2 text-blue-300 font-medium hover:text-blue-200 transition-colors">
                    Masuk
                </a>
                <a href="<?= site_url('auth/register') ?>" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-lg hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                    Daftar
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden p-2 text-white hover:text-blue-300 transition-colors">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden mt-4 pb-4 border-t border-gray-600 hidden">
            <div class="pt-4 space-y-2">
                <!-- Mobile Menu Items -->
                <a href="<?= site_url() ?>" class="flex items-center px-4 py-3 text-white hover:bg-white/10 hover:text-blue-300 rounded-lg transition-colors">
                    <i class="fas fa-home mr-3"></i>Beranda
                </a>

                <!-- Mobile Kelas Section -->
                <div class="px-4 py-2">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Kelas</div>
                    <a href="<?= site_url('home/premium') ?>" class="flex items-center px-4 py-2 text-white hover:bg-white/10 hover:text-blue-300 rounded-lg transition-colors">
                        <i class="fas fa-crown mr-3 text-yellow-400"></i>Kelas Premium
                    </a>
                    <a href="<?= site_url('home/free') ?>" class="flex items-center px-4 py-2 text-white hover:bg-white/10 hover:text-green-300 rounded-lg transition-colors">
                        <i class="fas fa-leaf mr-3 text-green-400"></i>Kelas Gratis
                    </a>
                    <a href="<?= site_url('workshops') ?>" class="flex items-center px-4 py-2 text-white hover:bg-white/10 hover:text-purple-300 rounded-lg transition-colors">
                        <i class="fas fa-chalkboard-teacher mr-3 text-purple-400"></i>Workshop & Seminar
                    </a>
                </div>

                <!-- Mobile Other Links -->
                <a href="<?= site_url('documentation') ?>" class="flex items-center px-4 py-3 text-blue-300 hover:bg-white/10 rounded-lg transition-colors">
                    <i class="fas fa-book mr-3"></i>Dokumentasi
                </a>
                <a href="<?= site_url('home/digital_solutions') ?>" class="flex items-center px-4 py-3 text-white hover:bg-white/10 hover:text-emerald-300 rounded-lg transition-colors">
                    <i class="fas fa-laptop-code mr-3 text-emerald-400"></i>Solusi Digital
                </a>
                <a href="<?= site_url('home/partnership') ?>" class="flex items-center px-4 py-3 text-white hover:bg-white/10 hover:text-purple-300 rounded-lg transition-colors">
                    <i class="fas fa-handshake mr-3 text-purple-400"></i>Partnership
                </a>

                <!-- Mobile Info Section -->
                <div class="px-4 py-2">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Info & Support</div>
                    <a href="<?= site_url('home/about') ?>" class="flex items-center px-4 py-2 text-white hover:bg-white/10 hover:text-blue-300 rounded-lg transition-colors">
                        <i class="fas fa-building mr-3 text-blue-400"></i>Tentang Kami
                    </a>
                    <a href="<?= site_url('home/faq') ?>" class="flex items-center px-4 py-2 text-white hover:bg-white/10 hover:text-purple-300 rounded-lg transition-colors">
                        <i class="fas fa-question-circle mr-3 text-purple-400"></i>FAQ
                    </a>
                    <a href="<?= site_url('contact') ?>" class="flex items-center px-4 py-2 text-white hover:bg-white/10 hover:text-green-300 rounded-lg transition-colors">
                        <i class="fas fa-headset mr-3 text-green-400"></i>Hubungi Kami
                    </a>
                </div>

                <a href="<?= site_url('home/download_app') ?>" class="flex items-center px-4 py-3 text-blue-300 hover:bg-white/10 rounded-lg transition-colors">
                    <i class="fas fa-mobile-alt mr-3"></i>Download App
                </a>

                <!-- Mobile Auth Buttons -->
                <div class="px-4 pt-4 border-t border-gray-600 mt-4 space-y-2">
                    <a href="<?= site_url('auth/login') ?>" class="block w-full px-4 py-3 text-center text-blue-300 font-medium border border-blue-500 rounded-lg hover:bg-white/10 transition-colors">
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
