<div class="teacher-kelas fade-in">
    <!-- Header with Stats -->
    <div class="index-hero bg-gradient-primary">
        <div class="hero-content">
            <div>
                <h1 class="hero-title">Kelas Saya</h1>
                <p class="hero-subtitle"><?php echo count($kelas); ?> kelas yang diampu</p>
            </div>
            <div class="quick-stats">
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <span>Total Siswa</span>
                    <strong>0</strong>
                </div>
                <div class="stat-card">
                    <i class="fas fa-check-circle"></i>
                    <span>Selesai</span>
                    <strong>0</strong>
                </div>
                <div class="stat-card">
                    <i class="fas fa-chart-line"></i>
                    <span>Rata-rata</span>
                    <strong>0%</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Kelas Grid -->
    <div class="section-card fade-in">
        <div class="section-header with-actions">
            <div>
                <h2 class="section-title">Daftar Kelas</h2>
                <div class="section-filters">
                    <div class="dropdown">
                        <button class="btn btn-filter">Filter <i class="fas fa-filter"></i></button>
                        <div class="dropdown-content">
                            <a href="#">Semua</a>
                            <a href="#">Aktif</a>
                            <a href="#">Non-Aktif</a>
                        </div>
                    </div>
                    <div class="search-box">
                        <input type="text" placeholder="Cari kelas...">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
            <?php if (empty($kelas)): ?>
                <div class="empty-state">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h3>Belum ada kelas</h3>
                    <p>Anda belum ditugaskan untuk mengampu kelas</p>
                    <button class="btn btn-primary">Minta Kelas</button>
                </div>
            <?php else: ?>
                <div class="kelas-grid">
                    <?php foreach($kelas as $k): ?>
                        <div class="kelas-card fade-in hover-shadow">
                            <div class="kelas-header bg-gradient-<?php echo ($k->status == 'Aktif') ? 'info' : 'secondary'; ?>">
                                <div class="badges">
                                    <span class="badge badge-light"><?php echo $k->bahasa_program; ?></span>
                                    <span class="badge badge-<?php echo ($k->status == 'Aktif') ? 'success' : 'secondary'; ?>">
                                        <?php echo $k->status; ?>
                                    </span>
                                </div>
                                <div class="quick-actions">
                                    <button class="btn-action"><i class="fas fa-ellipsis-v"></i></button>
                                    <div class="actions-menu">
                                        <a href="#"><i class="fas fa-eye"></i> Lihat</a>
                                        <a href="#"><i class="fas fa-users"></i> Siswa</a>
                                        <a href="#"><i class="fas fa-book"></i> Materi</a>
                                    </div>
                                </div>
                            </div>
                            <div class="kelas-body">
                                <h3><?php echo $k->nama_kelas; ?></h3>
                                <p class="kelas-desc"><?php echo $k->deskripsi; ?></p>
                                <div class="kelas-info">
                                    <div class="info-item">
                                        <i class="fas fa-signal"></i>
                                        <span><?php echo $k->level; ?></span>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-clock"></i>
                                        <span><?php echo $k->durasi; ?> Jam</span>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-money-bill-wave"></i>
                                        <span>Rp <?php echo number_format($k->harga, 0, ',', '.'); ?></span>
                                    </div>
                                </div>
                                <div class="progress-container">
                                    <div class="progress-info">
                                        <span>Progress Kelas</span>
                                        <span>0%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="kelas-footer">
                                <small>Ditugaskan: <?php echo date('d M Y', strtotime($k->assigned_at)); ?></small>
                                <div>
                                    <?php if (!empty($k->online_meet_link)): ?>
                                        <a href="<?php echo $k->online_meet_link; ?>" target="_blank" class="btn btn-sm btn-success">
                                            <i class="fas fa-video mr-1"></i> Join Meeting
                                        </a>
                                    <?php endif; ?>
                                    <a href="#" class="btn btn-sm btn-primary">Kelola</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
