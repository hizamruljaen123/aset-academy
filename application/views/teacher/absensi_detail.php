<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Absensi untuk Pertemuan: <?= $jadwal['judul_pertemuan']; ?> (<?= date('d M Y', strtotime($jadwal['tanggal_pertemuan'])); ?>)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Status</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($absensi as $absen): ?>
                            <tr>
                                <td><?= $absen['nis']; ?></td>
                                <td><?= $absen['nama_lengkap']; ?></td>
                                <td><?= $absen['status']; ?></td>
                                <td><?= $absen['catatan']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
