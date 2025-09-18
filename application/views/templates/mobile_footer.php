    </main>

    <!-- Mobile Navigation -->
    <nav class="mobile-nav">
        <div class="flex">
            <a href="<?= site_url('student_mobile') ?>" class="mobile-nav-item active">
                <i data-feather="home" class="w-5 h-5 mx-auto mb-1"></i>
                <span class="text-xs">Beranda</span>
            </a>
            <a href="<?= site_url('student_mobile/materi') ?>" class="mobile-nav-item">
                <i data-feather="book" class="w-5 h-5 mx-auto mb-1"></i>
                <span class="text-xs">Materi</span>
            </a>
            <a href="<?= site_url('student_mobile/jadwal') ?>" class="mobile-nav-item <?= strpos(current_url(), 'jadwal') !== false ? 'active' : '' ?>">
                <i data-feather="calendar" class="w-5 h-5 mx-auto mb-1"></i>
                <span class="text-xs">Jadwal</span>
            </a>
            <a href="<?= site_url('student_mobile/forum') ?>" class="mobile-nav-item <?= strpos(uri_string(), 'forum') !== false ? 'active' : '' ?>">
                <i data-feather="message-circle" class="w-5 h-5 mx-auto mb-1"></i>
                <span class="text-xs">Forum</span>
            </a>
            <a href="<?= site_url('student_mobile/profile') ?>" class="mobile-nav-item">
                <i data-feather="user" class="w-5 h-5 mx-auto mb-1"></i>
                <span class="text-xs">Profil</span>
            </a>
        </div>
    </nav>

    <!-- Mobile Bottom Sheet Container -->
    <div id="mobile-bottom-sheet" class="fixed inset-x-0 bottom-0 bg-white rounded-t-3xl shadow-2xl transform translate-y-full transition-transform duration-300 z-50 max-h-96 overflow-y-auto">
        <div class="w-12 h-1 bg-gray-300 rounded-full mx-auto mt-3 mb-4"></div>
        <div class="px-4 pb-6">
            <!-- Bottom sheet content will be loaded here -->
        </div>
    </div>

    <!-- Forum FAB -->
    <?php $this->load->view('templates/forum_fab'); ?>

    <!-- Mobile Toast Notification -->
    <div id="mobile-toast" class="fixed top-20 left-4 right-4 bg-gray-900 text-white px-4 py-3 rounded-lg shadow-lg transform translate-y-full transition-transform duration-300 z-50">
        <div class="flex items-center">
            <i data-feather="info" class="w-5 h-5 mr-3"></i>
            <span id="mobile-toast-message">Notification message</span>
        </div>
    </div>

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
        
        // Mobile toast notification
        function showToast(message, duration = 3000) {
            const toast = document.getElementById('mobile-toast');
            const toastMessage = document.getElementById('mobile-toast-message');
            
            toastMessage.textContent = message;
            toast.classList.remove('translate-y-full');
            
            setTimeout(() => {
                toast.classList.add('translate-y-full');
            }, duration);
        }
        
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
                showToast('Memperbarui data...');
                
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
            showToast('Fitur ini akan segera hadir!');
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