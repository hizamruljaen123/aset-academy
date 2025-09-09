<div class="p-4 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Header with gradient background -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl text-white">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold"><?php echo isset($materi) ? $materi->judul : 'Detail Materi'; ?></h1>
            <?php if (isset($materi)): ?>
                <div class="flex items-center mt-2 text-blue-100">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    <p><?php echo $materi->nama_kelas; ?></p>
                </div>
            <?php endif; ?>
        </div>
        <a href="<?php echo site_url('student/materi'); ?>" class="inline-flex items-center px-4 py-2 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Materi
        </a>
    </div>

    <?php if (isset($materi) && $materi): ?>
        <!-- Material Info Card -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
            <!-- Material Meta Information -->
            <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center bg-blue-50 px-4 py-2 rounded-xl">
                        <div class="rounded-full bg-blue-100 p-2 mr-2">
                            <i class="fas fa-layer-group text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Kelas</p>
                            <p class="font-medium"><?php echo $materi->nama_kelas; ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-center bg-indigo-50 px-4 py-2 rounded-xl">
                        <div class="rounded-full bg-indigo-100 p-2 mr-2">
                            <i class="fas fa-calendar-alt text-indigo-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Tanggal</p>
                            <p class="font-medium"><?php echo date('d F Y', strtotime($materi->created_at)); ?></p>
                        </div>
                    </div>
                    
                    <?php if (isset($total_parts) && $total_parts > 0): ?>
                    <div class="flex items-center bg-purple-50 px-4 py-2 rounded-xl">
                        <div class="rounded-full bg-purple-100 p-2 mr-2">
                            <i class="fas fa-list text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Bagian</p>
                            <p class="font-medium"><?php echo $total_parts; ?> Bagian</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Material Description -->
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Deskripsi Materi</h3>
                <div class="prose max-w-none text-gray-600">
                    <?php echo $materi->deskripsi; ?>
                </div>
            </div>
        </div>

        <!-- Material Parts -->
        <?php if (isset($materi_parts) && !empty($materi_parts)): ?>
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Bagian Materi</h2>
                            <p class="text-gray-500 mt-1"><?php echo count($materi_parts); ?> bagian tersedia</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button id="expandAllBtn" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <i class="fas fa-expand-alt mr-1"></i> Buka Semua
                            </button>
                            <button id="collapseAllBtn" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <i class="fas fa-compress-alt mr-1"></i> Tutup Semua
                            </button>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <?php foreach($materi_parts as $index => $part): ?>
                            <div class="part-item border border-gray-200 rounded-xl overflow-hidden fade-in" data-part-index="<?php echo $index; ?>">
                                <!-- Part Header -->
                                <div class="flex items-center justify-between p-4 bg-gray-50 cursor-pointer part-header" onclick="togglePart(<?php echo $index; ?>)">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-medium mr-3">
                                            <?php echo $index + 1; ?>
                                        </div>
                                        <h4 class="text-lg font-bold text-gray-800"><?php echo $part->judul; ?></h4>
                                    </div>
                                    <button class="h-8 w-8 rounded-full bg-white flex items-center justify-center text-gray-500 hover:bg-gray-100 transition-colors focus:outline-none">
                                        <i class="fas fa-chevron-down part-toggle-icon"></i>
                                    </button>
                                </div>
                                
                                <!-- Part Content (Hidden by default) -->
                                <div class="part-content p-6 border-t border-gray-200 bg-white hidden">
                                    <!-- Text Content -->
                                    <div class="prose max-w-none text-gray-600 mb-6 part-description">
                                        <?php echo $part->konten; ?>
                                    </div>
                                    
                                    <!-- Video Content -->
                                    <?php if (!empty($part->video_url)): ?>
                                        <div class="mt-6 pt-6 border-t border-gray-100">
                                            <h5 class="flex items-center text-lg font-bold text-gray-800 mb-4">
                                                <div class="rounded-full bg-red-100 p-2 mr-2">
                                                    <i class="fas fa-play-circle text-red-600"></i>
                                                </div>
                                                Video Pembelajaran
                                            </h5>
                                            <div class="relative pt-[56.25%] rounded-xl overflow-hidden shadow-lg">
                                                <?php
                                                // Convert YouTube URL to embed format
                                                $video_url = $part->video_url;
                                                if (strpos($video_url, 'youtube.com/watch?v=') !== false) {
                                                    $video_id = substr($video_url, strpos($video_url, 'v=') + 2);
                                                    $video_url = 'https://www.youtube.com/embed/' . $video_id;
                                                } elseif (strpos($video_url, 'youtu.be/') !== false) {
                                                    $video_id = substr($video_url, strpos($video_url, 'youtu.be/') + 9);
                                                    $video_url = 'https://www.youtube.com/embed/' . $video_id;
                                                }
                                                ?>
                                                <iframe 
                                                    class="absolute top-0 left-0 w-full h-full" 
                                                    src="<?php echo $video_url; ?>" 
                                                    frameborder="0" 
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                    allowfullscreen>
                                                </iframe>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-16 flex flex-col items-center justify-center text-center">
                    <div class="rounded-full bg-blue-100 p-6 mb-4">
                        <i class="fas fa-file-alt text-4xl text-blue-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Bagian Materi</h3>
                    <p class="text-gray-500 max-w-md">Bagian materi untuk pembelajaran ini belum tersedia. Silakan periksa kembali nanti.</p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Navigation -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
            <div class="p-6">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <a href="<?php echo site_url('student/materi'); ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                        <i class="fas fa-list mr-2"></i>
                        Semua Materi
                    </a>
                    <div class="flex items-center gap-3">
                        <button id="shareBtn" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                            <i class="fas fa-share-alt mr-2"></i>
                            Bagikan
                        </button>
                        <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105" onclick="window.print()">
                            <i class="fas fa-print mr-2"></i>
                            Cetak Materi
                        </button>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
            <div class="p-16 flex flex-col items-center justify-center text-center">
                <div class="rounded-full bg-yellow-100 p-6 mb-4">
                    <i class="fas fa-exclamation-triangle text-4xl text-yellow-500"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Materi Tidak Ditemukan</h3>
                <p class="text-gray-500 max-w-md mb-6">Materi yang Anda cari tidak dapat ditemukan atau tidak tersedia. Silakan kembali ke daftar materi.</p>
                <a href="<?php echo site_url('student/materi'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Daftar Materi
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
// Toggle part visibility
function togglePart(index) {
    const partItem = document.querySelectorAll('.part-item')[index];
    const content = partItem.querySelector('.part-content');
    const icon = partItem.querySelector('.part-toggle-icon');
    
    if (content.classList.contains('hidden')) {
        // Show content
        content.classList.remove('hidden');
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
        
        // Add animation
        content.style.maxHeight = '0px';
        content.style.opacity = '0';
        setTimeout(() => {
            content.style.maxHeight = content.scrollHeight + 'px';
            content.style.opacity = '1';
        }, 10);
    } else {
        // Hide content with animation
        content.style.maxHeight = '0px';
        content.style.opacity = '0';
        
        setTimeout(() => {
            content.classList.add('hidden');
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }, 300);
    }
}

// Initialize animations and event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Fade in main container
    const container = document.querySelector('.transition-opacity');
    if (container) {
        container.classList.add('opacity-100');
    }
    
    // Initialize intersection observer for fade-in elements
    const fadeElements = document.querySelectorAll('.fade-in');
    
    if (fadeElements.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, 100);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        fadeElements.forEach((element, index) => {
            // Add staggered delay based on element index
            element.style.transitionDelay = `${index * 0.1}s`;
            observer.observe(element);
        });
    }
    
    // Expand/Collapse all buttons
    const expandAllBtn = document.getElementById('expandAllBtn');
    const collapseAllBtn = document.getElementById('collapseAllBtn');
    
    if (expandAllBtn) {
        expandAllBtn.addEventListener('click', function() {
            const partItems = document.querySelectorAll('.part-item');
            partItems.forEach((item, index) => {
                const content = item.querySelector('.part-content');
                if (content.classList.contains('hidden')) {
                    togglePart(index);
                }
            });
        });
    }
    
    if (collapseAllBtn) {
        collapseAllBtn.addEventListener('click', function() {
            const partItems = document.querySelectorAll('.part-item');
            partItems.forEach((item, index) => {
                const content = item.querySelector('.part-content');
                if (!content.classList.contains('hidden')) {
                    togglePart(index);
                }
            });
        });
    }
    
    // Share button functionality
    const shareBtn = document.getElementById('shareBtn');
    if (shareBtn) {
        shareBtn.addEventListener('click', function() {
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    url: window.location.href
                }).catch(console.error);
            } else {
                // Fallback - copy to clipboard
                const tempInput = document.createElement('input');
                tempInput.value = window.location.href;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                
                alert('URL copied to clipboard!');
            }
        });
    }
});

// Initialize Quill to display content only
const quill = new Quill('#content-viewer', {
    readOnly: true,
    theme: 'bubble'
});

// Mark as complete functionality
document.querySelector('.mark-complete')?.addEventListener('click', function() {
    const materiId = this.dataset.materiId;
    // AJAX call to mark as complete
});
</script>

<style>
    /* Animation styles */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Part content animations */
    .part-content {
        transition: max-height 0.3s ease-out, opacity 0.3s ease-out;
        overflow: hidden;
    }
    
    /* Print styles */
    @media print {
        .part-content {
            display: block !important;
            max-height: none !important;
            opacity: 1 !important;
        }
        
        .part-header button,
        #expandAllBtn,
        #collapseAllBtn,
        #shareBtn,
        button[onclick="window.print()"] {
            display: none !important;
        }
    }
    
    .ql-editor {
        padding: 0;
        font-family: inherit;
    }
    
    .ql-editor img {
        max-width: 100%;
        height: auto;
    }
</style>
