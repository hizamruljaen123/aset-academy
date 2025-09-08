<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="teacher-siswa fade-in">
    <!-- Header with Stats -->
    <div class="index-hero bg-gradient-primary">
        <div class="hero-content">
            <div>
                <h1 class="hero-title">Siswa Saya</h1>
                <p class="hero-subtitle"><?php echo count($siswa); ?> siswa di kelas Anda</p>
            </div>
            <div class="quick-stats">
                <div class="stat-card">
                    <i class="fas fa-user-graduate"></i>
                    <span>Total Siswa</span>
                    <strong><?php echo count($siswa); ?></strong>
                </div>
                <div class="stat-card">
                    <i class="fas fa-chart-line"></i>
                    <span>Rata-rata Nilai</span>
                    <strong>0%</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Student List -->
    <div class="section-card fade-in">
        <div class="section-header with-actions">
            <div>
                <h2 class="section-title">Daftar Siswa</h2>
                <div class="section-filters">
                    <div class="search-box">
                        <input type="text" placeholder="Cari siswa..." id="searchInput">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
            <?php if (empty($siswa)): ?>
                <div class="empty-state">
                    <i class="fas fa-user-graduate"></i>
                    <h3>Belum ada siswa</h3>
                    <p>Anda belum memiliki siswa di kelas Anda</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="siswa-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($siswa as $s): ?>
                                <tr class="fade-in">
                                    <td>
                                        <div class="student-info">
                                            <div class="student-avatar">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div>
                                                <strong><?php echo $s->nama_lengkap; ?></strong>
                                                <small><?php echo $s->email; ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo $s->kelas; ?></td>
                                    <td><?php echo $s->jurusan; ?></td>
                                    <td>
                                        <span class="badge badge-<?php echo ($s->status == 'Aktif') ? 'success' : 'secondary'; ?>">
                                            <?php echo $s->status; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn-action" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
        $('.siswa-table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
