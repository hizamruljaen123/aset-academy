    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="md:col-span-1">
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="<?= base_url('assets/img/logo-white.png') ?>" alt="ASET Academy" class="h-8 w-auto">
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Platform pembelajaran programming terdepan dengan metode belajar interaktif dan kurikulum terkini.
                    </p>
                    <div class="flex space-x-4 mt-6">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="<?= site_url() ?>" class="text-gray-400 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="<?= site_url('home/premium') ?>" class="text-gray-400 hover:text-white transition-colors">Kelas Premium</a></li>
                        <li><a href="<?= site_url('home/free') ?>" class="text-gray-400 hover:text-white transition-colors">Kelas Gratis</a></li>
                        <li><a href="<?= site_url('documentation') ?>" class="text-gray-400 hover:text-white transition-colors">Dokumentasi</a></li>
                        <li><a href="<?= site_url('home/download_app') ?>" class="text-gray-400 hover:text-white transition-colors">Download App</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Support</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="<?= site_url('home/faq') ?>" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="<?= site_url('home/about') ?>" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="mailto:support@asetacademy.id" class="text-gray-400 hover:text-white transition-colors">Kontak Support</a></li>
                        <li><a href="<?= site_url('home/partnership') ?>" class="text-gray-400 hover:text-white transition-colors">Partnership</a></li>
                        <li><a href="<?= site_url('home/digital_solutions') ?>" class="text-gray-400 hover:text-white transition-colors">Solusi Digital</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tetap Terhubung</h3>
                    <p class="text-gray-400 text-sm mb-4">
                        Dapatkan update terbaru dan materi baru dari ASET Academy.
                    </p>
                    <form class="space-y-2">
                        <input type="email" placeholder="Email Anda" class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; 2024 ASET Academy. All rights reserved.</p>
                <div class="flex justify-center space-x-6 mt-4">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-white transition-colors">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg transition-all duration-300 opacity-0 invisible">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script>
        // Initialize Feather Icons
        feather.replace();

        // Initialize AOS
        AOS.init({
            duration: 600,
            once: true,
            offset: 50
        });

        // Back to top button
        const backToTopBtn = document.getElementById('back-to-top');

        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.remove('opacity-0', 'invisible');
                backToTopBtn.classList.add('opacity-100', 'visible');
            } else {
                backToTopBtn.classList.remove('opacity-100', 'visible');
                backToTopBtn.classList.add('opacity-0', 'invisible');
            }
        });

        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Code block copy functionality
        document.querySelectorAll('.code-block').forEach(block => {
            const copyBtn = document.createElement('button');
            copyBtn.innerHTML = '<i class="fas fa-copy"></i>';
            copyBtn.className = 'absolute top-2 right-2 bg-gray-700 hover:bg-gray-600 text-white px-2 py-1 rounded text-sm transition-colors';
            copyBtn.title = 'Copy to clipboard';

            block.style.position = 'relative';
            block.appendChild(copyBtn);

            copyBtn.addEventListener('click', function() {
                const text = block.textContent.replace('Copy', '').trim();
                navigator.clipboard.writeText(text).then(function() {
                    const originalIcon = copyBtn.innerHTML;
                    copyBtn.innerHTML = '<i class="fas fa-check"></i>';
                    setTimeout(() => {
                        copyBtn.innerHTML = originalIcon;
                    }, 2000);
                });
            });
        });

        // Mobile menu improvements
        document.addEventListener('DOMContentLoaded', function() {
            // Close mobile menu on link click
            const mobileLinks = document.querySelectorAll('#mobile-menu a');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');

            mobileLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                    const icon = mobileMenuBtn.querySelector('i');
                    icon.className = 'fas fa-bars text-xl';
                });
            });
        });

        // Reading progress indicator
        window.addEventListener('scroll', function() {
            const documentHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrolled = (window.scrollY / documentHeight) * 100;

            let progressBar = document.getElementById('reading-progress');
            if (!progressBar) {
                progressBar = document.createElement('div');
                progressBar.id = 'reading-progress';
                progressBar.className = 'fixed top-0 left-0 h-1 bg-gradient-to-r from-blue-500 to-purple-500 z-50 transition-all duration-300';
                document.body.appendChild(progressBar);
            }

            progressBar.style.width = scrolled + '%';
        });
    </script>
</body>
</html>
