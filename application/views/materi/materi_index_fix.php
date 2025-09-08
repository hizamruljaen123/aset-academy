<div class="card fade-in">
    <div class="card-header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div>
                <h2 class="card-title">Materi Kelas: <?php echo $kelas->nama_kelas; ?></h2>
                <p class="card-subtitle">Kelola materi untuk kelas ini.</p>
            </div>
            <div class="flex items-center space-x-2">
                <a href="<?php echo site_url('materi/create/' . $kelas->id); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Materi
                </a>
                <a href="<?php echo site_url('kelas/detail/' . $kelas->id); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Kelas
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Materi</th>
                        <th>Deskripsi</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($materi)): ?>
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 3rem;">
                                <div style="display: flex; flex-direction: column; align-items: center;">
                                    <i class="fas fa-book-open" style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem;"></i>
                                    <p style="font-size: 1.125rem; font-weight: 500; color: #6b7280; margin-bottom: 0.5rem;">Belum ada materi</p>
                                    <p style="font-size: 0.875rem; color: #9ca3af;">Mulai dengan menambahkan materi baru untuk kelas ini.</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; ?>
                        <?php foreach ($materi as $m): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo $m->judul; ?></strong></td>
                                <td><?php echo $m->deskripsi; ?></td>
                                <td>
                                    <div class="action-buttons" style="justify-content: center;">
                                        <a href="<?php echo site_url('materi/edit/'.$m->id); ?>" class="action-btn action-btn-edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?php echo site_url('materi/delete/'.$m->id); ?>" class="action-btn action-btn-delete" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
