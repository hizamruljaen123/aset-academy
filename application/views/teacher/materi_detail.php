<style>
    .part-card {
        transition: all 0.3s ease;
    }

    .part-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .badge-part-type {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .prose {
        max-width: none;
    }

    .prose img {
        border-radius: 0.5rem;
        margin: 1rem 0;
    }

    .prose pre {
        background: #1e293b;
        color: #e2e8f0;
        padding: 1rem;
        border-radius: 0.5rem;
        overflow-x: auto;
    }

    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out;
    }
</style>

<div class="container mx-auto px-4 py-8 max-w-8xl">
    <!-- Flash Messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-lg shadow-md mb-6 animate-fade-in-up">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <span class="font-medium"><?php echo $this->session->flashdata('success'); ?></span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-cyan-500 to-teal-500 rounded-2xl shadow-2xl overflow-hidden mb-8 animate-fade-in-up">
        <div class="p-8">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center space-x-4">
                    <div class="bg-white/20 p-4 rounded-xl backdrop-blur-sm">
                        <i class="fas fa-book-open fa-3x text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2"><?php echo decode_html_entities($materi->judul); ?></h1>
                        <p class="text-sm text-white/90 flex items-center">
                            <i class="fas fa-graduation-cap mr-2"></i>
                            Kelas: <?php echo decode_html_entities($materi->nama_kelas); ?>
                        </p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="<?php echo site_url('teacher/edit_materi/' . $materi->id); ?>" 
                       class="bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-lg font-semibold transition-all backdrop-blur-sm hover:scale-105 transform shadow-lg">
                        <i class="fas fa-edit mr-2"></i>Edit Materi
                    </a>
                    <a href="<?php echo site_url('teacher/materi'); ?>" 
                       class="bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-lg font-semibold transition-all backdrop-blur-sm hover:scale-105 transform shadow-lg">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="bg-white/10 backdrop-blur-sm px-8 py-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-white">
                <div class="flex items-center space-x-3">
                    <div class="bg-white/20 p-3 rounded-lg">
                        <i class="fas fa-puzzle-piece fa-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Total Bagian</p>
                        <p class="text-2xl font-bold"><?php echo count($parts); ?></p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="bg-white/20 p-3 rounded-lg">
                        <i class="fas fa-calendar fa-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Dibuat</p>
                        <p class="text-lg font-semibold"><?php echo date('d M Y', strtotime($materi->created_at)); ?></p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="bg-white/20 p-3 rounded-lg">
                        <i class="fas fa-clock fa-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Terakhir Update</p>
                        <p class="text-lg font-semibold"><?php echo date('d M Y', strtotime($materi->updated_at)); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-4 animate-fade-in-up">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-cyan-500"></i>
                    Informasi
                </h3>
                
                <div class="space-y-4">
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-4 rounded-lg border border-blue-200">
                        <p class="text-xs font-semibold text-blue-600 mb-1">STATUS</p>
                        <p class="text-sm font-bold text-blue-800">
                            <i class="fas fa-check-circle mr-1"></i>Aktif
                        </p>
                    </div>

                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-4 rounded-lg border border-purple-200">
                        <p class="text-xs font-semibold text-purple-600 mb-1">ID MATERI</p>
                        <p class="text-sm font-bold text-purple-800">#<?php echo str_pad($materi->id, 5, '0', STR_PAD_LEFT); ?></p>
                    </div>
                </div>

                <hr class="my-6 border-gray-200">

                <div class="space-y-3">
                    <a href="<?php echo site_url('teacher/edit_materi/' . $materi->id); ?>" 
                       class="block w-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-3 rounded-lg font-semibold text-center hover:from-blue-600 hover:to-cyan-600 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                        <i class="fas fa-pencil-alt mr-2"></i>Edit Materi
                    </a>
                    
                    <a href="<?php echo site_url('teacher/manage_kelas/' . $materi->kelas_id); ?>" 
                       class="block w-full bg-gradient-to-r from-gray-500 to-gray-600 text-white py-3 rounded-lg font-semibold text-center hover:from-gray-600 hover:to-gray-700 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                        <i class="fas fa-chalkboard mr-2"></i>Lihat Kelas
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="lg:col-span-3 space-y-8">
            <!-- Deskripsi -->
            <div class="bg-white rounded-2xl shadow-xl p-6 animate-fade-in-up">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-align-left mr-2 text-cyan-500"></i>
                    Deskripsi Materi
                </h3>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <?php echo decode_html_entities($materi->deskripsi); ?>
                </div>
            </div>

            <!-- Bagian Materi -->
            <div class="bg-white rounded-2xl shadow-xl p-6 animate-fade-in-up">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-puzzle-piece mr-2 text-cyan-500"></i>
                        Bagian Materi
                        <span class="ml-3 bg-cyan-100 text-cyan-600 px-3 py-1 rounded-full text-sm font-semibold">
                            <?php echo count($parts); ?> Bagian
                        </span>
                    </h3>
                    <a href="<?php echo site_url('teacher/edit_materi/' . $materi->id); ?>" 
                       class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-2 rounded-lg font-semibold hover:from-green-600 hover:to-emerald-600 transition-all shadow-md hover:shadow-lg transform hover:scale-105 text-sm">
                        <i class="fas fa-plus-circle mr-2"></i>Tambah Bagian
                    </a>
                </div>

                <?php if (!empty($parts)): ?>
                    <div class="space-y-4">
                        <?php foreach ($parts as $index => $part): ?>
                            <div class="part-card bg-gradient-to-br from-white to-gray-50 rounded-xl border-2 border-gray-200 shadow-md overflow-hidden">
                                <!-- Part Header -->
                                <div class="bg-gradient-to-r from-cyan-50 to-teal-50 px-6 py-4 border-b-2 border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="bg-gradient-to-br from-cyan-500 to-teal-500 text-white rounded-lg px-3 py-2 font-bold text-sm">
                                                #<?php echo $index + 1; ?>
                                            </div>
                                            <div>
                                                <h4 class="text-lg font-bold text-gray-800">
                                                    <?php echo htmlspecialchars($part->part_title); ?>
                                                </h4>
                                            </div>
                                        </div>
                                        <span class="badge-part-type <?php 
                                            echo $part->part_type == 'video' ? 'bg-red-100 text-red-600' : 
                                                 ($part->part_type == 'text' ? 'bg-blue-100 text-blue-600' : 
                                                  'bg-purple-100 text-purple-600'); 
                                        ?>">
                                            <i class="fas fa-<?php 
                                                echo $part->part_type == 'video' ? 'video' : 
                                                     ($part->part_type == 'text' ? 'file-alt' : 
                                                      'code'); 
                                            ?>"></i>
                                            <?php echo ucfirst($part->part_type); ?>
                                        </span>
                                    </div>
                                </div>

                                <!-- Part Content -->
                                <div class="px-6 py-5">
                                    <div class="prose prose-sm max-w-none text-gray-700">
                                        <?php echo $part->part_content; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-16 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border-2 border-dashed border-gray-300">
                        <div class="inline-block bg-white p-6 rounded-full shadow-lg mb-4">
                            <i class="fas fa-inbox fa-4x text-gray-300"></i>
                        </div>
                        <p class="text-gray-600 font-semibold text-lg mb-2">Belum Ada Bagian Materi</p>
                        <p class="text-sm text-gray-500 mb-6">Mulai tambahkan bagian materi untuk melengkapi pembelajaran</p>
                        <a href="<?php echo site_url('teacher/edit_materi/' . $materi->id); ?>" 
                           class="inline-flex items-center bg-gradient-to-r from-cyan-500 to-teal-500 text-white px-8 py-3 rounded-lg font-semibold hover:from-cyan-600 hover:to-teal-600 transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-plus-circle mr-2"></i>Tambah Bagian Pertama
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
// Add smooth scroll animation
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.animate-fade-in-up');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, { threshold: 0.1 });
    
    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.5s ease-out';
        observer.observe(card);
    });
});
</script>
