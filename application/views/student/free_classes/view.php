<div class="p-4 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Header with gradient background -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl text-white">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold"><?php echo $free_class->title; ?></h1>
            <div class="flex items-center mt-2 text-blue-100">
                <i class="fas fa-graduation-cap mr-2"></i>
                <p><?php echo $free_class->category; ?> - <?php echo $free_class->level; ?></p>
            </div>
        </div>
        <a href="<?php echo site_url('student/free_classes/browse'); ?>" class="inline-flex items-center px-4 py-2 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar Kelas
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Class Preview -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="h-64 bg-gray-200 relative">
                    <?php if (!empty($free_class->thumbnail)): ?>
                        <?php $thumbnailUrl = filter_var($free_class->thumbnail, FILTER_VALIDATE_URL) ? $free_class->thumbnail : base_url($free_class->thumbnail); ?>
                        <img src="<?php echo $thumbnailUrl; ?>" alt="<?php echo $free_class->title; ?>" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center hidden">
                            <i class="fas fa-graduation-cap text-white text-6xl"></i>
                        </div>
                    <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-6xl"></i>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Deskripsi Kelas</h2>
                    <div class="prose max-w-none text-gray-600">
                        <?php echo $free_class->description; ?>
                    </div>
                </div>
            </div>

            <!-- Materials Preview -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Materi Pembelajaran</h2>
                </div>
                <div class="p-6">
                    <?php if (empty($materials)): ?>
                        <div class="text-center py-8">
                            <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                                <i class="fas fa-book text-blue-600 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Belum Ada Materi</h3>
                            <p class="text-gray-500 max-w-md mx-auto">Materi pembelajaran untuk kelas ini akan segera tersedia.</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php foreach ($materials as $index => $material): ?>
                                <div class="border border-gray-200 rounded-lg overflow-hidden">
                                    <div class="flex items-center justify-between p-4 bg-gray-50">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-medium mr-3">
                                                <?php echo $index + 1; ?>
                                            </div>
                                            <h4 class="font-medium text-gray-800"><?php echo $material->title; ?></h4>
                                        </div>
                                        <div>
                                            <?php if ($is_enrolled): ?>
                                                <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-800">
                                                    <i class="fas fa-unlock mr-1"></i> Tersedia
                                                </span>
                                            <?php else: ?>
                                                <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-800">
                                                    <i class="fas fa-lock mr-1"></i> Terkunci
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ($is_enrolled): ?>
                                        <div class="p-4 bg-white">
                                            <p class="text-sm text-gray-600 mb-2"><?php echo substr(strip_tags($material->description), 0, 100) . '...'; ?></p>
                                            <div class="flex items-center text-xs text-gray-500">
                                                <span class="mr-3">
                                                    <i class="fas fa-<?php 
                                                    if ($material->content_type == 'text') echo 'file-alt';
                                                    elseif ($material->content_type == 'video') echo 'video';
                                                    elseif ($material->content_type == 'pdf') echo 'file-pdf';
                                                    else echo 'link';
                                                    ?> mr-1"></i>
                                                    <?php echo ucfirst($material->content_type); ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Discussions -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Diskusi</h2>
                </div>
                <div class="p-6">
                    <?php if (isset($discussions) && !empty($discussions)): ?>
                        <div class="space-y-6">
                            <?php foreach ($discussions as $discussion): ?>
                                <?php if ($discussion->parent_id === null): ?>
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <div class="p-4 bg-gray-50">
                                            <div class="flex items-start">
                                                <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-medium mr-3">
                                                    <?php echo strtoupper(substr($discussion->nama_lengkap, 0, 1)); ?>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="flex justify-between items-center mb-1">
                                                        <h4 class="font-medium text-gray-800"><?php echo $discussion->nama_lengkap; ?></h4>
                                                        <span class="text-xs text-gray-500"><?php echo date('d M Y H:i', strtotime($discussion->created_at)); ?></span>
                                                    </div>
                                                    <p class="text-gray-600"><?php echo $discussion->message; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php 
                                        // Find replies
                                        $replies = array_filter($discussions, function($reply) use ($discussion) {
                                            return $reply->parent_id == $discussion->id;
                                        });
                                        
                                        if (!empty($replies)):
                                        ?>
                                            <div class="border-t border-gray-200">
                                                <div class="p-4 pl-12">
                                                    <?php foreach ($replies as $reply): ?>
                                                        <div class="mb-4 last:mb-0">
                                                            <div class="flex items-start">
                                                                <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white font-medium mr-3">
                                                                    <?php echo strtoupper(substr($reply->nama_lengkap, 0, 1)); ?>
                                                                </div>
                                                                <div class="flex-1">
                                                                    <div class="flex justify-between items-center mb-1">
                                                                        <h5 class="font-medium text-gray-800"><?php echo $reply->nama_lengkap; ?></h5>
                                                                        <span class="text-xs text-gray-500"><?php echo date('d M Y H:i', strtotime($reply->created_at)); ?></span>
                                                                    </div>
                                                                    <p class="text-gray-600"><?php echo $reply->message; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if ($is_enrolled): ?>
                                            <div class="border-t border-gray-200">
                                                <div class="p-4 pl-12">
                                                    <form action="<?php echo site_url('student/free_classes/post_discussion'); ?>" method="post">
                                                        <input type="hidden" name="enrollment_id" value="<?php echo $enrollment->id; ?>">
                                                        <input type="hidden" name="parent_id" value="<?php echo $discussion->id; ?>">
                                                        <div class="flex">
                                                            <textarea name="message" rows="1" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg mr-2" placeholder="Balas diskusi..."></textarea>
                                                            <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                                                <i class="fas fa-paper-plane"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                                <i class="fas fa-comments text-blue-600 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Belum Ada Diskusi</h3>
                            <p class="text-gray-500 max-w-md mx-auto">Jadilah yang pertama memulai diskusi tentang kelas ini.</p>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($is_enrolled): ?>
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <form action="<?php echo site_url('student/free_classes/post_discussion'); ?>" method="post">
                                <input type="hidden" name="enrollment_id" value="<?php echo $enrollment->id; ?>">
                                <div class="space-y-4">
                                    <textarea name="message" rows="3" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg" placeholder="Tulis pertanyaan atau diskusi Anda..."></textarea>
                                    <div class="flex justify-end">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                                            <i class="fas fa-paper-plane mr-2"></i>
                                            Kirim Diskusi
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Class Info -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Informasi Kelas</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="rounded-full bg-blue-100 p-2 mr-3">
                                <i class="fas fa-user-tie text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Mentor</p>
                                <p class="font-medium"><?php echo $free_class->mentor_name; ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="rounded-full bg-indigo-100 p-2 mr-3">
                                <i class="fas fa-layer-group text-indigo-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Level</p>
                                <p class="font-medium"><?php echo $free_class->level; ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="rounded-full bg-purple-100 p-2 mr-3">
                                <i class="fas fa-tag text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Kategori</p>
                                <p class="font-medium"><?php echo $free_class->category; ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="rounded-full bg-green-100 p-2 mr-3">
                                <i class="fas fa-clock text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Durasi</p>
                                <p class="font-medium"><?php echo $free_class->duration; ?> jam</p>
                            </div>
                        </div>
                        
                        <?php if (!empty($free_class->online_meet_link)): ?>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <a href="<?php echo $free_class->online_meet_link; ?>" target="_blank" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300">
                                <i class="fas fa-video mr-2"></i>
                                Join Meeting Online
                            </a>
                        </div>
                        <?php endif; ?>
                        
                        <div class="flex items-center">
                            <div class="rounded-full bg-yellow-100 p-2 mr-3">
                                <i class="fas fa-users text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Siswa Terdaftar</p>
                                <p class="font-medium">
                                    <?php echo $enrolled_count; ?>
                                    <?php if ($free_class->max_students): ?>
                                        <span class="text-gray-500">dari <?php echo $free_class->max_students; ?></span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        
                        <?php if ($free_class->start_date): ?>
                        <div class="flex items-center">
                            <div class="rounded-full bg-red-100 p-2 mr-3">
                                <i class="fas fa-calendar-alt text-red-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Tanggal Mulai</p>
                                <p class="font-medium"><?php echo date('d F Y', strtotime($free_class->start_date)); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($free_class->end_date): ?>
                        <div class="flex items-center">
                            <div class="rounded-full bg-orange-100 p-2 mr-3">
                                <i class="fas fa-calendar-check text-orange-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Tanggal Selesai</p>
                                <p class="font-medium"><?php echo date('d F Y', strtotime($free_class->end_date)); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <?php if ($is_enrolled): ?>
                            <a href="<?php echo site_url('student/free_classes/learn/' . encrypt_url($enrollment->id)); ?>" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                                <i class="fas fa-book-open mr-2"></i>
                                Mulai Belajar
                            </a>
                        <?php else: ?>
                            <?php if ($is_full): ?>
                                <button disabled class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gray-400 cursor-not-allowed">
                                    <i class="fas fa-users-slash mr-2"></i>
                                    Kelas Penuh
                                </button>
                            <?php else: ?>
                                <a href="<?php echo site_url('student/free_classes/enroll/' . $free_class->id); ?>" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Daftar Kelas
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Jadwal Kelas -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Jadwal Kelas</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <?php if (!empty($jadwal)):
                            foreach ($jadwal as $j):
                        ?>
                            <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <p class="font-semibold text-gray-800">Pertemuan <?php echo $j->pertemuan_ke; ?>: <?php echo $j->judul_pertemuan; ?></p>
                                <p class="text-sm text-gray-600 mt-1"><?php echo date('d M Y', strtotime($j->tanggal_pertemuan)); ?> | <?php echo date('H:i', strtotime($j->waktu_mulai)); ?> - <?php echo date('H:i', strtotime($j->waktu_selesai)); ?></p>
                            </div>
                        <?php 
                            endforeach;
                        else:
                        ?>
                            <p class="text-center text-gray-500 py-4">Belum ada jadwal untuk kelas ini.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Enrolled Students -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Siswa Terdaftar</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <?php if (empty($enrolled_students)): ?>
                            <p class="text-center text-gray-500">Belum ada siswa yang terdaftar.</p>
                        <?php else: ?>
                            <?php foreach ($enrolled_students as $student): ?>
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-medium mr-3">
                                        <?php echo strtoupper(substr($student->nama_lengkap, 0, 1)); ?>
                                    </div>
                                    <div>
                                        <p class="font-medium"><?php echo $student->nama_lengkap; ?></p>
                                        <p class="text-xs text-gray-500">@<?php echo $student->username; ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Share -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Bagikan</h2>
                </div>
                <div class="p-6">
                    <div class="flex justify-center space-x-4">
                        <button id="copyLinkBtn" class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 transition-colors" title="Salin Link">
                            <i class="fas fa-link"></i>
                        </button>
                        <a href="https://wa.me/?text=<?php echo urlencode('Kelas gratis: ' . $free_class->title . ' - ' . site_url('student/free_classes/view/' . $free_class->id)); ?>" target="_blank" class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 hover:bg-green-200 transition-colors" title="Bagikan ke WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(site_url('student/free_classes/view/' . $free_class->id)); ?>" target="_blank" class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-200 transition-colors" title="Bagikan ke Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode('Kelas gratis: ' . $free_class->title); ?>&url=<?php echo urlencode(site_url('student/free_classes/view/' . $free_class->id)); ?>" target="_blank" class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-400 hover:bg-blue-200 transition-colors" title="Bagikan ke Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
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
        
        // Copy link button
        const copyLinkBtn = document.getElementById('copyLinkBtn');
        if (copyLinkBtn) {
            copyLinkBtn.addEventListener('click', function() {
                const tempInput = document.createElement('input');
                tempInput.value = '<?php echo site_url('student/free_classes/view/' . $free_class->id); ?>';
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                
                // Show tooltip
                const tooltip = document.createElement('div');
                tooltip.className = 'absolute -top-10 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded';
                tooltip.textContent = 'Link disalin!';
                this.style.position = 'relative';
                this.appendChild(tooltip);
                
                setTimeout(() => {
                    tooltip.remove();
                }, 2000);
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
</style>
