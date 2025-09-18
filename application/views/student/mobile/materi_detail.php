<div class="space-y-4">
    <!-- Material Header -->
    <div class="mobile-card">
        <div class="flex items-start justify-between mb-3">
            <div class="flex-1">
                <h2 class="text-xl font-bold text-gray-900 mb-2"><?php echo $materi->judul; ?></h2>
                <p class="text-sm text-gray-500"><?php echo $materi->nama_kelas; ?></p>
            </div>
            <button onclick="location.href='<?= site_url('student_mobile/materi') ?>'" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <i data-feather="x" class="w-5 h-5 text-gray-600"></i>
            </button>
        </div>
        
        <!-- Restricted Access Warning -->
        <?php if (isset($restricted_access) && $restricted_access): ?>
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-3">
            <div class="flex items-start space-x-2">
                <i data-feather="alert-triangle" class="w-4 h-4 text-yellow-600 mt-0.5"></i>
                <div>
                    <p class="text-sm font-medium text-gray-900">Akses Terbatas</p>
                    <p class="text-xs text-gray-600 mt-1">Materi ini hanya untuk kelas <?php echo $material_class; ?>, sedangkan Anda terdaftar di kelas <?php echo $student_class; ?>.</p>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Material Meta -->
        <div class="flex items-center justify-between text-sm text-gray-500">
            <span><i data-feather="calendar" class="w-4 h-4 inline mr-1"></i><?php echo date('d F Y', strtotime($materi->created_at)); ?></span>
            <span><i data-feather="clock" class="w-4 h-4 inline mr-1"></i>Estimasi 30 menit</span>
        </div>
    </div>

    <!-- Material Description -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Deskripsi Materi</h3>
        <div class="prose prose-sm max-w-none">
            <p class="text-gray-700 leading-relaxed"><?php echo nl2br($materi->deskripsi); ?></p>
        </div>
    </div>

    <!-- Learning Objectives -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Tujuan Pembelajaran</h3>
        <div class="space-y-2">
            <div class="flex items-start space-x-2">
                <i data-feather="check-circle" class="w-4 h-4 text-green-600 mt-0.5"></i>
                <p class="text-sm text-gray-700">Memahami konsep dasar <?php echo $materi->judul; ?></p>
            </div>
            <div class="flex items-start space-x-2">
                <i data-feather="check-circle" class="w-4 h-4 text-green-600 mt-0.5"></i>
                <p class="text-sm text-gray-700">Mampu mengimplementasikan <?php echo $materi->judul; ?> dalam praktik</p>
            </div>
            <div class="flex items-start space-x-2">
                <i data-feather="check-circle" class="w-4 h-4 text-green-600 mt-0.5"></i>
                <p class="text-sm text-gray-700">Dapat mengerjakan tugas terkait <?php echo $materi->judul; ?></p>
            </div>
        </div>
    </div>

    <!-- Material Parts/Sections -->
    <?php if (!empty($parts)): ?>
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Isi Materi</h3>
        <div class="space-y-3">
            <?php foreach($parts as $index => $part): ?>
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-2">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 font-bold text-sm">
                            <?php echo $index + 1; ?>
                        </div>
                        <h4 class="text-sm font-bold text-gray-900"><?php echo $part->judul_part; ?></h4>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                        <?php echo $part->durasi_estimasi; ?> menit
                    </span>
                </div>
                <p class="text-xs text-gray-600 mb-3"><?php echo $part->deskripsi_part; ?></p>
                
                <?php if (!empty($part->file_path)): ?>
                <div class="bg-gray-50 rounded-lg p-3 mb-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <i data-feather="file-text" class="w-4 h-4 text-gray-600"></i>
                            <span class="text-sm text-gray-700"><?php echo basename($part->file_path); ?></span>
                        </div>
                        <button class="text-blue-600 text-sm font-medium">
                            <i data-feather="download" class="w-4 h-4 inline mr-1"></i>
                            Unduh
                        </button>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($part->video_url)): ?>
                <div class="bg-gray-900 rounded-lg overflow-hidden mb-3" style="padding-bottom: 56.25%;">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <button class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-opacity-30 transition-colors">
                            <i data-feather="play" class="w-6 h-6 text-white"></i>
                        </button>
                    </div>
                </div>
                <?php endif; ?>
                
                <button class="mobile-btn w-full bg-blue-600 text-white text-sm">
                    <i data-feather="play" class="w-4 h-4 inline mr-2"></i>
                    Mulai Belajar
                </button>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Additional Resources -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Sumber Tambahan</h3>
        <div class="space-y-2">
            <a href="#" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <i data-feather="external-link" class="w-4 h-4 text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Dokumentasi Resmi</p>
                        <p class="text-xs text-gray-500">Referensi lengkap</p>
                    </div>
                </div>
                <i data-feather="chevron-right" class="w-4 h-4 text-gray-400"></i>
            </a>

            <a href="#" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i data-feather="github" class="w-4 h-4 text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Kode Sumber</p>
                        <p class="text-xs text-gray-500">Repository GitHub</p>
                    </div>
                </div>
                <i data-feather="chevron-right" class="w-4 h-4 text-gray-400"></i>
            </a>

            <a href="#" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i data-feather="book" class="w-4 h-4 text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Bacaan Tambahan</p>
                        <p class="text-xs text-gray-500">Artikel terkait</p>
                    </div>
                </div>
                <i data-feather="chevron-right" class="w-4 h-4 text-gray-400"></i>
            </a>
        </div>
    </div>

    <!-- Progress Tracking -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Progress Pembelajaran</h3>
        <div class="space-y-3">
            <div>
                <div class="flex items-center justify-between mb-1">
                    <span class="text-sm text-gray-600">Total Progress</span>
                    <span class="text-sm font-medium text-gray-900">0%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: 0%"></div>
                </div>
            </div>
            
            <div class="grid grid-cols-3 gap-3 text-center">
                <div class="bg-gray-50 rounded-lg p-2">
                    <div class="text-lg font-bold text-gray-900">0</div>
                    <div class="text-xs text-gray-500">Selesai</div>
                </div>
                <div class="bg-gray-50 rounded-lg p-2">
                    <div class="text-lg font-bold text-gray-900">0</div>
                    <div class="text-xs text-gray-500">Dalam Proses</div>
                </div>
                <div class="bg-gray-50 rounded-lg p-2">
                    <div class="text-lg font-bold text-gray-900"><?php echo count($parts); ?></div>
                    <div class="text-xs text-gray-500">Total</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="space-y-3">
        <?php if (!isset($restricted_access) || !$restricted_access): ?>
        <button class="mobile-btn w-full bg-blue-600 text-white">
            <i data-feather="play" class="w-4 h-4 inline mr-2"></i>
            Mulai Belajar
        </button>
        
        <button class="mobile-btn w-full border border-blue-600 text-blue-600">
            <i data-feather="bookmark" class="w-4 h-4 inline mr-2"></i>
            Simpan Materi
        </button>
        <?php else: ?>
        <button class="mobile-btn w-full bg-yellow-600 text-white">
            <i data-feather="mail" class="w-4 h-4 inline mr-2"></i>
            Mintai Akses ke Admin
        </button>
        <?php endif; ?>
        
        <button class="mobile-btn w-full border border-gray-300 text-gray-700">
            <i data-feather="share-2" class="w-4 h-4 inline mr-2"></i>
            Bagikan Materi
        </button>
    </div>

    <!-- Related Materials -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Materi Terkait</h3>
        <div class="space-y-3">
            <div class="border border-gray-100 rounded-lg p-3">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                        <span class="text-xs font-bold text-gray-600">2</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-gray-900">Pendahuluan <?php echo $materi->judul; ?></h4>
                        <p class="text-xs text-gray-500 mt-1">Dasar-dasar yang perlu diketahui</p>
                    </div>
                </div>
            </div>
            
            <div class="border border-gray-100 rounded-lg p-3">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                        <span class="text-xs font-bold text-gray-600">4</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-gray-900">Praktik <?php echo $materi->judul; ?></h4>
                        <p class="text-xs text-gray-500 mt-1">Contoh dan latihan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize Feather Icons
    document.addEventListener('DOMContentLoaded', function() {
        feather.replace();
        
        // Add fade-in animation to cards
        const cards = document.querySelectorAll('.mobile-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Video play button functionality
        const videoButtons = document.querySelectorAll('.bg-gray-900 button');
        videoButtons.forEach(button => {
            button.addEventListener('click', function() {
                showToast('Video player akan segera hadir!');
            });
        });

        // Download button functionality
        const downloadButtons = document.querySelectorAll('.text-blue-600.text-sm.font-medium');
        downloadButtons.forEach(button => {
            if (button.textContent.includes('Unduh')) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    showToast('Mengunduh file...');
                });
            }
        });

        // External link buttons
        const externalLinks = document.querySelectorAll('a[href="#"]');
        externalLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                showToast('Fitur ini akan segera hadir!');
            });
        });
    });
</script>

<style>
    .prose {
        color: #374151;
        line-height: 1.6;
    }
    
    .prose p {
        margin-bottom: 1rem;
    }
    
    .prose:last-child p:last-child {
        margin-bottom: 0;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>