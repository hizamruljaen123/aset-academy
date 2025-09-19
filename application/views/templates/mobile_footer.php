    </main>

    <!-- Mobile Navigation -->
    <nav class="mobile-nav">
        <div class="flex items-center">
            <a href="<?= site_url('student_mobile') ?>" class="mobile-nav-item <?= strpos(uri_string(), 'student_mobile') !== false && !strpos(uri_string(), 'orders') && !strpos(uri_string(), 'jadwal') && !strpos(uri_string(), 'forum') && !strpos(uri_string(), 'profile') ? 'active' : '' ?>">
                <i data-feather="home" class="w-8 h-8 mx-auto"></i>
                <span class="text-xs font-semibold mt-1">Beranda</span>
            </a>
            <a href="<?= site_url('student_mobile/orders') ?>" class="mobile-nav-item <?= strpos(uri_string(), 'orders') !== false ? 'active' : '' ?>">
                <i data-feather="shopping-bag" class="w-8 h-8 mx-auto"></i>
                <span class="text-xs font-semibold mt-1">Pesanan</span>
            </a>
            
            <!-- Central Menu Button -->
            <button onclick="toggleMenu()" class="mobile-nav-item bg-blue-700 text-white rounded-full w-14 h-14 flex items-center justify-center mx-2 shadow-lg transform transition-transform duration-200 hover:scale-110 active:scale-95">
                <i data-feather="grid" class="w-8 h-8"></i>
            </button>
            
            <a href="<?= site_url('student_mobile/jadwal') ?>" class="mobile-nav-item <?= strpos(current_url(), 'jadwal') !== false ? 'active' : '' ?>">
                <i data-feather="calendar" class="w-8 h-8 mx-auto"></i>
                <span class="text-xs font-semibold mt-1">Jadwal</span>
            </a>
            <a href="<?= site_url('student_mobile/forum') ?>" class="mobile-nav-item <?= strpos(uri_string(), 'forum') !== false ? 'active' : '' ?>">
                <i data-feather="message-circle" class="w-8 h-8 mx-auto"></i>
                <span class="text-xs font-semibold mt-1">Forum</span>
            </a>
        </div>
    </nav>

    <!-- Menu Modal -->
    <div id="menuModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden" onclick="toggleMenu()">
        <div class="absolute inset-0 flex items-center justify-center p-4" onclick="event.stopPropagation()">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xs p-4 transform transition-transform duration-300 scale-95" id="menuContent">
                <h3 class="text-lg font-bold text-center mb-4 text-gray-900">Menu Navigasi</h3>
                <div class="grid grid-cols-3 gap-3">
                    <!-- Home -->
                    <a href="<?= site_url('student_mobile') ?>" onclick="toggleMenu()" class="flex flex-col items-center p-3 rounded-xl hover:bg-blue-50 transition-colors">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                            <i data-feather="home" class="w-6 h-6 text-blue-600"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Beranda</span>
                    </a>
                    
                    <!-- Orders -->
                    <a href="<?= site_url('student_mobile/orders') ?>" onclick="toggleMenu()" class="flex flex-col items-center p-3 rounded-xl hover:bg-green-50 transition-colors">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-2">
                            <i data-feather="shopping-bag" class="w-6 h-6 text-green-600"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Pesanan</span>
                    </a>
                    
                    <!-- Schedule -->
                    <a href="<?= site_url('student_mobile/jadwal') ?>" onclick="toggleMenu()" class="flex flex-col items-center p-3 rounded-xl hover:bg-purple-50 transition-colors">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-2">
                            <i data-feather="calendar" class="w-6 h-6 text-purple-600"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Jadwal</span>
                    </a>
                    
                    <!-- Forum -->
                    <a href="<?= site_url('student_mobile/forum') ?>" onclick="toggleMenu()" class="flex flex-col items-center p-3 rounded-xl hover:bg-orange-50 transition-colors">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mb-2">
                            <i data-feather="message-circle" class="w-6 h-6 text-orange-600"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Forum</span>
                    </a>
                    
                    <!-- Profile -->
                    <a href="<?= site_url('student_mobile/profile') ?>" onclick="toggleMenu()" class="flex flex-col items-center p-3 rounded-xl hover:bg-indigo-50 transition-colors">
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mb-2">
                            <i data-feather="user" class="w-6 h-6 text-indigo-600"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Profil</span>
                    </a>
                    
                    <!-- Materi -->
                    <a href="<?= site_url('student_mobile/materi') ?>" onclick="toggleMenu()" class="flex flex-col items-center p-3 rounded-xl hover:bg-red-50 transition-colors">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-2">
                            <i data-feather="book" class="w-6 h-6 text-red-600"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Materi</span>
                    </a>
                    
                    <!-- Payment Status -->
                    <a href="<?= site_url('payment/orders') ?>" onclick="toggleMenu()" class="flex flex-col items-center p-3 rounded-xl hover:bg-pink-50 transition-colors">
                        <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center mb-2">
                            <i data-feather="credit-card" class="w-6 h-6 text-pink-600"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Status</span>
                    </a>
                    
                    <!-- Kelas Saya -->
                    <a href="<?= site_url('student_mobile/my_classes') ?>" onclick="toggleMenu()" class="flex flex-col items-center p-3 rounded-xl hover:bg-teal-50 transition-colors">
                        <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center mb-2">
                            <i data-feather="book-open" class="w-6 h-6 text-teal-600"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Kelas Saya</span>
                    </a>
                    
                    <!-- Jelajahi Kelas -->
                    <a href="<?= site_url('student_mobile/browse_classes') ?>" onclick="toggleMenu()" class="flex flex-col items-center p-3 rounded-xl hover:bg-purple-50 transition-colors">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-2">
                            <i data-feather="search" class="w-6 h-6 text-purple-600"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Jelajahi Kelas</span>
                    </a>

                    <!-- Absensi -->
                    <a href="<?= site_url('student_mobile/absensi') ?>" onclick="toggleMenu()" class="flex flex-col items-center p-3 rounded-xl hover:bg-cyan-50 transition-colors">
                        <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center mb-2">
                            <i data-feather="clipboard" class="w-6 h-6 text-cyan-600"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Absensi</span>
                    </a>
                    
                    <!-- Settings -->
                    <a href="<?= site_url('student_mobile/settings') ?>" onclick="toggleMenu()" class="flex flex-col items-center p-3 rounded-xl hover:bg-gray-50 transition-colors">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-2">
                            <i data-feather="settings" class="w-6 h-6 text-gray-600"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Setting</span>
                    </a>
                </div>
                
                <button onclick="toggleMenu()" class="w-full mt-4 py-3 bg-gray-100 text-gray-700 rounded-xl font-medium">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Forum FAB -->
    <?php $this->load->view('templates/forum_fab'); ?>

    <!-- Mobile Bottom Sheet Container -->
    <div id="mobile-bottom-sheet" class="fixed inset-x-0 bottom-0 bg-white rounded-t-3xl shadow-2xl transform translate-y-full transition-transform duration-300 z-50 max-h-96 overflow-y-auto">
        <div class="w-12 h-1 bg-gray-300 rounded-full mx-auto mt-3 mb-4"></div>
        <div class="px-4 pb-6">
            <!-- Bottom sheet content will be loaded here -->
        </div>
    </div>

    <script>
        // Menu modal functionality
        function toggleMenu() {
            const modal = document.getElementById('menuModal');
            const content = document.getElementById('menuContent');
            
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    content.classList.remove('scale-95');
                    content.classList.add('scale-100');
                }, 10);
            } else {
                content.classList.remove('scale-100');
                content.classList.add('scale-95');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        }

        // Close menu when clicking outside
        document.getElementById('menuModal').addEventListener('click', function(e) {
            if (e.target === this) {
                toggleMenu();
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('menuModal');
                if (!modal.classList.contains('hidden')) {
                    toggleMenu();
                }
            }
        });

        // Initialize Feather Icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>

    <style>
        /* Enhanced mobile navigation */
        .mobile-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #3b82f6;
            border-top: 1px solid #2563eb;
            padding: 8px 0;
            z-index: 40;
            box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .mobile-nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 8px 2px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .mobile-nav-item i {
            width: 32px;
            height: 32px;
            stroke-width: 2.5;
        }
        
        .mobile-nav-item.active {
            color: white;
            background-color: #1d4ed8;
            border-radius: 12px;
            margin: 0 4px;
            transform: scale(1.05);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        
        .mobile-nav-item span {
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 4px;
        }
        
        /* Central Menu Button */
        .mobile-nav-item button {
            background-color: #1e40af !important;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        
        .mobile-nav-item button:hover {
            transform: scale(1.1);
        }
        
        .mobile-nav-item button i {
            width: 28px;
            height: 28px;
        }
        
        /* Menu modal styles */
        #menuModal {
            backdrop-filter: blur(4px);
        }
        
        #menuContent {
            max-height: 80vh;
            overflow-y: auto;
        }
        
        /* Add padding to body when nav is visible */
        body {
            padding-bottom: 70px;
        }
    </style>

    <!-- Mobile Loading Overlay -->
    <div id="mobile-loading" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="mobile-spinner"></div>
    </div>

    <script>
        // Initialize Feather Icons
        feather.replace();
        
        // Initialize AOS
        AOS.init({
            duration: 600,
            once: true,
            offset: 50
        });
        
        // Mobile navigation active state
        document.addEventListener('DOMContentLoaded', function() {
            const navItems = document.querySelectorAll('.mobile-nav-item');
            const currentPath = window.location.pathname;
            
            navItems.forEach(item => {
                const href = item.getAttribute('href');
                if (currentPath === href || currentPath.startsWith(href + '/')) {
                    item.classList.add('active');
                }
            });
        });
        
        // Mobile bottom sheet
        function showBottomSheet(content) {
            const bottomSheet = document.getElementById('mobile-bottom-sheet');
            const bottomSheetContent = bottomSheet.querySelector('.px-4');
            
            bottomSheetContent.innerHTML = content;
            bottomSheet.classList.remove('translate-y-full');
            
            // Close button
            const closeButton = bottomSheetContent.querySelector('.close-bottom-sheet');
            if (closeButton) {
                closeButton.addEventListener('click', hideBottomSheet);
            }
        }
        
        function hideBottomSheet() {
            const bottomSheet = document.getElementById('mobile-bottom-sheet');
            bottomSheet.classList.add('translate-y-full');
        }
        
        // Mobile loading
        function showLoading() {
            document.getElementById('mobile-loading').classList.remove('hidden');
        }
        
        function hideLoading() {
            document.getElementById('mobile-loading').classList.add('hidden');
        }
        
        // Pull to refresh functionality
        let isPulling = false;
        let startY = 0;
        let currentY = 0;
        
        const mainContent = document.querySelector('main');
        
        mainContent.addEventListener('touchstart', function(e) {
            if (window.scrollY === 0) {
                startY = e.touches[0].clientY;
                isPulling = true;
            }
        });
        
        mainContent.addEventListener('touchmove', function(e) {
            if (!isPulling) return;
            
            currentY = e.touches[0].clientY;
            const pullDistance = currentY - startY;
            
            if (pullDistance > 0) {
                e.preventDefault();
                mainContent.style.transform = `translateY(${pullDistance * 0.5}px)`;
            }
        });
        
        mainContent.addEventListener('touchend', function(e) {
            if (!isPulling) return;
            
            const pullDistance = currentY - startY;
            
            if (pullDistance > 100) {
                // Trigger refresh
                mainContent.style.transform = 'translateY(0)';
                
                // Reload the page after a short delay
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                mainContent.style.transform = 'translateY(0)';
            }
            
            isPulling = false;
        });
        
        // Mobile FAB functionality
        document.getElementById('mobile-fab').addEventListener('click', function() {
            // Fitur ini akan segera hadir
        });
        
        // Handle back button for mobile
        window.addEventListener('popstate', function(e) {
            // Handle back navigation if needed
        });
        
        // Prevent double-tap zoom on mobile
        let lastTouchEnd = 0;
        document.addEventListener('touchend', function(event) {
            const now = Date.now();
            if (now - lastTouchEnd <= 300) {
                event.preventDefault();
            }
            lastTouchEnd = now;
        }, false);
        
        // Add swipe gestures for navigation
        let touchStartX = 0;
        let touchEndX = 0;
        
        document.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        });
        
        document.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });
        
        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;
            
            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swipe left - could navigate forward
                    console.log('Swipe left detected');
                } else {
                    // Swipe right - could navigate back
                    console.log('Swipe right detected');
                }
            }
        }
    </script>
</body>
</html>