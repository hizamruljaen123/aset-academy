<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <div class="mb-6 md:mb-0">
                <img src="<?= base_url('assets/img/logo-white.png') ?>" alt="ASET Academy" class="h-8 mb-4">
                <p class="text-gray-400 max-w-md">Platform pembelajaran programming terbaik untuk mengembangkan skill digital masa depan.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-6">Platform</h3>
                    <ul class="space-y-3">
                        <li><a href="<?= site_url('home/premium') ?>" class="text-gray-400 hover:text-white transition-colors">Kelas Premium</a></li>
                        <li><a href="<?= site_url('home/free') ?>" class="text-gray-400 hover:text-white transition-colors">Kelas Gratis</a></li>
                        <li><a href="<?= site_url('workshops') ?>" class="text-gray-400 hover:text-white transition-colors">Workshop & Seminar</a></li>
                        <li><a href="<?= site_url('forum') ?>" class="text-gray-400 hover:text-white transition-colors">Forum Diskusi</a></li>
                        <li><a href="<?= site_url('home/digital_solutions') ?>" class="text-gray-400 hover:text-white transition-colors">Solusi Digital</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-6">Dukungan</h3>
                    <ul class="space-y-3">
                        <li><a href="<?= site_url('home/faq') ?>" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="<?= site_url('home/about') ?>" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="<?= site_url('home/partnership') ?>" class="text-gray-400 hover:text-white transition-colors">Kemitraan</a></li>
                        <li><a href="<?= site_url('documentation') ?>" class="text-gray-400 hover:text-white transition-colors">Dokumentasi</a></li>
                        <li><a href="<?= site_url('sitemap.xml') ?>" class="text-gray-400 hover:text-white transition-colors">Sitemap</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-6">Kontak</h3>
                    <div class="space-y-3 text-gray-400">
                        <p class="flex items-center"><i data-feather="mail" class="w-5 h-5 mr-3"></i> hello@asetacademy.com</p>
                        <p class="flex items-center"><i data-feather="phone" class="w-5 h-5 mr-3"></i> +62 812 3456 7890</p>
                        <p class="flex items-center"><i data-feather="map-pin" class="w-5 h-5 mr-3"></i> Jakarta, Indonesia</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-800 pt-8 text-center text-gray-400 text-sm">
            <p>&copy; <?= date('Y') ?> ASET Academy. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
    AOS.init({
        duration: 1000,
        once: true
    });
    
    feather.replace();

    // Vanta.js initialization for specific pages
    if (document.getElementById('vanta-bg')) {
        VANTA.GLOBE({
            el: "#vanta-bg",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00,
            color: 0x3b82f6,
            backgroundColor: 0x0,
            size: 0.8
        });
    }

    // FAQ Accordion for specific pages
    if (document.querySelector('.faq-item')) {
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            const button = item.querySelector('button');
            const content = item.querySelector('.faq-content');
            const icon = button.querySelector('i');

            button.addEventListener('click', () => {
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                    icon.style.transform = 'rotate(0deg)';
                } else {
                    content.style.maxHeight = content.scrollHeight + 'px';
                    icon.style.transform = 'rotate(180deg)';
                }
            });
        });
    }
</script>
</body>
</html>
