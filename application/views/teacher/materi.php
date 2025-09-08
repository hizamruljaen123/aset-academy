<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="teacher-materi fade-in">
    <!-- Header with Stats -->
    <div class="index-hero bg-gradient-primary">
        <div class="hero-content">
            <div>
                <h1 class="hero-title">Materi Saya</h1>
                <p class="hero-subtitle"><?php echo count($materi); ?> materi yang Anda buat</p>
            </div>
            <div class="quick-stats">
                <div class="stat-card">
                    <i class="fas fa-book"></i>
                    <span>Total Materi</span>
                    <strong><?php echo count($materi); ?></strong>
                </div>
                <div class="stat-card">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Untuk Kelas</span>
                    <strong><?php echo count($kelas); ?></strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Materi List -->
    <div class="section-card fade-in">
        <div class="section-header with-actions">
            <div>
                <h2 class="section-title">Daftar Materi</h2>
                <div class="section-filters">
                    <div class="dropdown">
                        <button class="btn btn-filter">Filter <i class="fas fa-filter"></i></button>
                        <div class="dropdown-content">
                            <a href="#" class="filter-link" data-filter="all">Semua</a>
                            <a href="#" class="filter-link" data-filter="kelas">Berdasarkan Kelas</a>
                        </div>
                    </div>
                    <div class="search-box">
                        <input type="text" placeholder="Cari materi..." id="searchInput">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i> Materi Baru
            </a>
        </div>
        <div class="section-body">
            <?php if (empty($materi)): ?>
                <div class="empty-state">
                    <i class="fas fa-book-open"></i>
                    <h3>Belum ada materi</h3>
                    <p>Anda belum membuat materi pembelajaran</p>
                    <a href="#" class="btn btn-primary mt-3">Buat Materi Pertama</a>
                </div>
            <?php else: ?>
                <div class="materi-grid">
                    <?php foreach($materi as $m): ?>
                        <div class="materi-card fade-in hover-shadow">
                            <div class="materi-header bg-gradient-info">
                                <div class="badges">
                                    <span class="badge badge-light"><?php echo $m->nama_kelas; ?></span>
                                </div>
                                <div class="quick-actions">
                                    <button class="btn-action"><i class="fas fa-ellipsis-v"></i></button>
                                    <div class="actions-menu">
                                        <a href="<?php echo site_url('teacher/materi_detail/'.$m->id); ?>"><i class="fas fa-eye"></i> Lihat</a>
                                        <a href="#"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="#" class="text-danger"><i class="fas fa-trash"></i> Hapus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="materi-body">
                                <h3><?php echo $m->judul; ?></h3>
                                <p class="materi-desc"><?php echo character_limiter($m->deskripsi, 100); ?></p>
                                <div class="materi-info">
                                    <div class="info-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span><?php echo date('d M Y', strtotime($m->created_at)); ?></span>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-file-alt"></i>
                                        <span><?php echo $m->jumlah_part; ?> Part</span>
                                    </div>
                                </div>
                            </div>
                            <div class="materi-footer">
                                <small>Terakhir diupdate: <?php echo date('d M Y', strtotime($m->updated_at)); ?></small>
                                <a href="<?php echo site_url('teacher/materi_detail/'.$m->id); ?>" class="btn btn-sm btn-primary">Detail</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Search functionality
    $('#searchInput').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('.materi-grid .materi-card').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    
    // Filter functionality
    $('.filter-link').on('click', function(e) {
        e.preventDefault();
        const filter = $(this).data('filter');
        // Implement filter logic here
    });
});
</script>
