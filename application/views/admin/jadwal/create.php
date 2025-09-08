<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= site_url('admin/jadwal/store'); ?>" method="post">
                <div class="form-group">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-control" required>
                        <option value="">Pilih Kelas</option>
                        <?php foreach ($kelas as $k): ?>
                            <option value="<?= $k->id; ?>"><?= $k->nama_kelas; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="guru_id">Guru</label>
                    <select name="guru_id" id="guru_id" class="form-control" required>
                        <option value="">Pilih Guru</option>
                        <?php foreach ($guru as $g):
                        ?>
                            <option value="<?= $g->id; ?>"><?= $g->nama_lengkap; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pertemuan_ke">Pertemuan Ke</label>
                    <input type="number" name="pertemuan_ke" id="pertemuan_ke" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="judul_pertemuan">Judul Pertemuan</label>
                    <input type="text" name="judul_pertemuan" id="judul_pertemuan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_pertemuan">Tanggal Pertemuan</label>
                    <input type="date" name="tanggal_pertemuan" id="tanggal_pertemuan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="waktu_selesai">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
