<div class="p-4 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Header with gradient background -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl text-white">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold"><?php echo $material->title; ?></h1>
            <div class="flex items-center mt-2 text-blue-100">
                <i class="fas fa-graduation-cap mr-2"></i>
                <p><?php echo $enrollment->title; ?></p>
            </div>
        </div>
        <a href="<?php echo site_url('student/free_classes/learn/' . encrypt_url($enrollment->id)); ?>" class="inline-flex items-center px-4 py-2 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Kelas
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Material Navigation -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Navigasi Materi</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-2">
                        <?php foreach ($all_materials as $index => $item): ?>
                            <a href="<?php echo site_url('student/free_classes/material/' . encrypt_url($enrollment->id) . '/' . encrypt_url($item->id)); ?>" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors <?php echo ($item->id == $material->id) ? 'bg-blue-50 border-l-4 border-blue-500' : ''; ?>">
                                <div class="h-6 w-6 rounded-full <?php echo ($progress && $progress->status == 'Completed') ? 'bg-green-600' : (($progress && $progress->status == 'In Progress') ? 'bg-blue-600' : 'bg-gray-300'); ?> flex items-center justify-center text-white text-xs font-medium mr-3">
                                    <?php echo ($progress && $progress->status == 'Completed') ? '<i class="fas fa-check"></i>' : ($index + 1); ?>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium <?php echo ($item->id == $material->id) ? 'text-blue-800' : 'text-gray-800'; ?> line-clamp-1"><?php echo $item->title; ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <!-- Material Progress -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Progress</h2>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-gray-700">Status Materi</span>
                            <span class="text-sm font-medium 
                                <?php 
                                if ($progress && $progress->status == 'Completed') echo 'text-green-600';
                                elseif ($progress && $progress->status == 'In Progress') echo 'text-blue-600';
                                else echo 'text-gray-600';
                                ?>">
                                <?php 
                                if ($progress && $progress->status == 'Completed') echo 'Selesai';
                                elseif ($progress && $progress->status == 'In Progress') echo 'Sedang Dipelajari';
                                else echo 'Belum Dimulai';
                                ?>
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="<?php echo ($progress && $progress->status == 'Completed') ? 'bg-green-600' : 'bg-blue-600'; ?> h-2.5 rounded-full" style="width: <?php echo ($progress && $progress->status == 'Completed') ? '100' : ($progress && $progress->status == 'In Progress' ? '50' : '0'); ?>%"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-gray-700">Progress Keseluruhan</span>
                            <span class="text-sm font-medium text-blue-600"><?php echo $enrollment->progress; ?>%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?php echo $enrollment->progress; ?>%"></div>
                        </div>
                    </div>
                    
                    <?php if ($progress && $progress->last_accessed): ?>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-xs text-gray-500">Terakhir diakses:</p>
                        <p class="text-sm font-medium"><?php echo date('d F Y H:i', strtotime($progress->last_accessed)); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($progress && $progress->status != 'Completed'): ?>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <a href="<?php echo site_url('student/free_classes/complete_material/' . $enrollment->id . '/' . $material->id); ?>" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300 hover:scale-105">
                            <i class="fas fa-check-circle mr-2"></i>
                            Tandai Selesai
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="lg:col-span-3">
            <!-- Material Content -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex items-center">
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-600 text-white text-sm font-medium mr-3">
                            <i class="fas fa-<?php 
                            if ($material->content_type == 'text') echo 'file-alt';
                            elseif ($material->content_type == 'video') echo 'video';
                            elseif ($material->content_type == 'pdf') echo 'file-pdf';
                            else echo 'link';
                            ?>"></i>
                        </span>
                        <h2 class="text-xl font-bold text-gray-800"><?php echo ucfirst($material->content_type); ?></h2>
                    </div>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4"><?php echo $material->title; ?></h3>
                        <div class="prose max-w-none text-gray-600 mb-6">
                            <?php echo render_html_content($material->description); ?>
                        </div>
                    </div>
                    
                    <?php if ($material->content_type == 'text'): ?>
                        <div class="prose max-w-none text-gray-600 bg-gray-50 p-6 rounded-lg">
                            <?php echo render_html_content($material->content); ?>
                        </div>
                    <?php elseif ($material->content_type == 'video'): ?>
                        <div class="relative pt-[56.25%] rounded-xl overflow-hidden shadow-lg mb-4">
                            <?php
                            // Convert YouTube URL to embed format if needed
                            $video_url = $material->content;
                            if (strpos($video_url, 'youtube.com/watch?v=') !== false) {
                                $video_id = substr($video_url, strpos($video_url, 'v=') + 2);
                                if (strpos($video_id, '&') !== false) {
                                    $video_id = substr($video_id, 0, strpos($video_id, '&'));
                                }
                                $video_url = 'https://www.youtube.com/embed/' . $video_id;
                            } elseif (strpos($video_url, 'youtu.be/') !== false) {
                                $video_id = substr($video_url, strpos($video_url, 'youtu.be/') + 9);
                                if (strpos($video_id, '?') !== false) {
                                    $video_id = substr($video_id, 0, strpos($video_id, '?'));
                                }
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
                    <?php elseif ($material->content_type == 'pdf'): ?>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-red-100 p-2 mr-3">
                                        <i class="fas fa-file-pdf text-red-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Dokumen PDF</p>
                                        <p class="text-xs text-gray-500"><?php echo basename($material->content); ?></p>
                                    </div>
                                </div>
                                <a href="<?php echo base_url($material->content); ?>" target="_blank" class="inline-flex items-center px-3 py-1.5 border border-transparent rounded-lg shadow-sm text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                                    <i class="fas fa-download mr-1"></i>
                                    Download
                                </a>
                            </div>
                            <div class="border border-gray-300 rounded-lg overflow-hidden">
                                <iframe src="<?php echo base_url($material->content); ?>" class="w-full h-[600px]"></iframe>
                            </div>
                        </div>
                    <?php elseif ($material->content_type == 'link'): ?>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-blue-100 p-2 mr-3">
                                        <i class="fas fa-link text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Link Eksternal</p>
                                        <p class="text-xs text-gray-500"><?php echo parse_url($material->content, PHP_URL_HOST); ?></p>
                                    </div>
                                </div>
                                <a href="<?php echo $material->content; ?>" target="_blank" class="inline-flex items-center px-3 py-1.5 border border-transparent rounded-lg shadow-sm text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                                    <i class="fas fa-external-link-alt mr-1"></i>
                                    Buka Link
                                </a>
                            </div>
                            <div class="border border-gray-300 rounded-lg p-4">
                                <p class="text-gray-600 mb-2">Link: <a href="<?php echo $material->content; ?>" target="_blank" class="text-blue-600 hover:underline"><?php echo $material->content; ?></a></p>
                                <p class="text-sm text-gray-500">Klik tombol "Buka Link" untuk mengakses konten eksternal.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Navigation -->
            <div class="flex justify-between items-center mb-8 fade-in">
                <?php if ($prev_material): ?>
                    <a href="<?php echo site_url('student/free_classes/material/' . encrypt_url($enrollment->id) . '/' . encrypt_url($prev_material->id)); ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                        <i class="fas fa-chevron-left mr-2"></i>
                        Materi Sebelumnya
                    </a>
                <?php else: ?>
                    <div></div>
                <?php endif; ?>
                
                <?php if ($next_material): ?>
                    <a href="<?php echo site_url('student/free_classes/material/' . encrypt_url($enrollment->id) . '/' . encrypt_url($next_material->id)); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                        Materi Selanjutnya
                        <i class="fas fa-chevron-right ml-2"></i>
                    </a>
                <?php elseif ($progress && $progress->status != 'Completed'): ?>
                    <a href="<?php echo site_url('student/free_classes/complete_material/' . encrypt_url($enrollment->id) . '/' . encrypt_url($material->id)); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300 hover:scale-105">
                        <i class="fas fa-check-circle mr-2"></i>
                        Selesaikan Materi
                    </a>
                <?php else: ?>
                    <a href="<?php echo site_url('student/free_classes/learn/' . encrypt_url($enrollment->id)); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        Kembali ke Kelas
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
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
    
    /* Line clamp for text truncation */
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Prose styling */
    .prose {
        max-width: 65ch;
        color: #374151;
    }
    
    .prose p {
        margin-top: 1.25em;
        margin-bottom: 1.25em;
    }
    
    .prose h1, .prose h2, .prose h3, .prose h4 {
        color: #111827;
        font-weight: 600;
        margin-top: 2em;
        margin-bottom: 1em;
    }
    
    .prose ul, .prose ol {
        margin-top: 1.25em;
        margin-bottom: 1.25em;
        padding-left: 1.625em;
    }
    
    .prose li {
        margin-top: 0.5em;
        margin-bottom: 0.5em;
    }
    
    .prose a {
        color: #2563eb;
        text-decoration: underline;
    }
    
    .prose code {
        color: #111827;
        font-weight: 600;
        font-size: 0.875em;
    }
    
    .prose pre {
        color: #e5e7eb;
        background-color: #1f2937;
        overflow-x: auto;
        font-size: 0.875em;
        line-height: 1.7142857;
        margin-top: 1.7142857em;
        margin-bottom: 1.7142857em;
        border-radius: 0.375rem;
        padding: 0.8571429em 1.1428571em;
    }
</style>
