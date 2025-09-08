<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= site_url('admin/jadwal/create'); ?>" class="btn btn-primary">Tambah Jadwal</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kelas</th>
                            <th>Pertemuan Ke</th>
                            <th>Judul Pertemuan</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Guru</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jadwal as $j): ?>
                            <tr>
                                <td><?= $j['nama_kelas']; ?></td>
                                <td><?= $j['pertemuan_ke']; ?></td>
                                <td><?= $j['judul_pertemuan']; ?></td>
                                <td><?= date('d M Y', strtotime($j['tanggal_pertemuan'])); ?></td>
                                <td><?= date('H:i', strtotime($j['waktu_mulai'])); ?> - <?= date('H:i', strtotime($j['waktu_selesai'])); ?></td>
                                <td><?= $j['nama_guru']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
