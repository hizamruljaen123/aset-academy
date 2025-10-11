<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<footer class="bg-gradient-to-br from-gray-900 via-slate-900 to-gray-900 text-white py-14 border-t-4 border-blue-500">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10">
            <div class="mb-8 md:mb-0">
                <img src="<?= base_url('assets/img/logo-white.png') ?>" alt="ASET Academy" class="h-9 mb-4">
                <p class="text-gray-300 max-w-md text-lg">Platform Pengembangan Skill Digital Untuk Pemula.</p>
            </div>
            
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-12">
            <div>
                <h3 class="text-lg font-black mb-6">Platform</h3>
                <ul class="space-y-3">
                    <li><a href="<?= site_url('home/premium') ?>" class="text-gray-300 hover:text-blue-300 transition-colors">Kelas Premium</a></li>
                    <li><a href="<?= site_url('home/free') ?>" class="text-gray-300 hover:text-green-300 transition-colors">Kelas Gratis</a></li>
                    <li><a href="<?= site_url('workshops') ?>" class="text-gray-300 hover:text-purple-300 transition-colors">Workshop & Seminar</a></li>
                    <li><a href="<?= site_url('forum') ?>" class="text-gray-300 hover:text-white transition-colors">Forum Diskusi</a></li>
                    <li><a href="<?= site_url('home/digital_solutions') ?>" class="text-gray-300 hover:text-emerald-300 transition-colors">Solusi Digital</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-black mb-6">Dukungan</h3>
                <ul class="space-y-3">
                    <li><a href="<?= site_url('home/faq') ?>" class="text-gray-300 hover:text-purple-300 transition-colors">FAQ</a></li>
                    <li><a href="<?= site_url('home/about') ?>" class="text-gray-300 hover:text-blue-300 transition-colors">Tentang Kami</a></li>
                    <li><a href="<?= site_url('home/partnership') ?>" class="text-gray-300 hover:text-purple-300 transition-colors">Kemitraan</a></li>
                    <li><a href="<?= site_url('career') ?>" class="text-gray-300 hover:text-white transition-colors">Karier</a></li>
                    <li><a href="<?= site_url('documentation') ?>" class="text-gray-300 hover:text-blue-300 transition-colors">Dokumentasi</a></li>
                    <li><a href="<?= site_url('contact') ?>" class="text-gray-300 hover:text-green-300 transition-colors">Hubungi Kami</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-black mb-6">Kontak & Komunitas</h3>
                <div class="space-y-2 text-base text-gray-300 mb-6">
                    <div class="flex items-center"><i data-feather="mail" class="w-5 h-5 mr-3 text-blue-400"></i> support@asetacademy.id</div>
                    <div class="flex items-center"><i data-feather="phone" class="w-5 h-5 mr-3 text-green-400"></i> +62 896-7601-8562</div>
                    <div class="flex items-center"><i data-feather="map-pin" class="w-5 h-5 mr-3 text-purple-400"></i> Jl. Teknologi No. 123, Jakarta</div>
                </div>
                <div>
                    <a href="https://t.me/asetacademy" target="_blank" rel="noopener" class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-lg text-white px-5 py-2 rounded-full text-base font-bold shadow transition">Join Komunitas Telegram</a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 pt-6 text-center text-gray-300 text-sm">
            <p>&copy; <?= date('Y') ?> <span class="font-black tracking-wide text-blue-300">ASET Academy</span> · All rights reserved · <span>Karya anak bangsa ❤️</span></p>
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
            color: 0x198aad,
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
