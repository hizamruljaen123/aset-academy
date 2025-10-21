<div class="p-4 sm:p-6 lg:p-8">
    <div class="bg-white rounded-2xl shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Jadwal Kelas</h1>
        <form action="<?= site_url('admin/jadwal/update/' . encrypt_url($jadwal->id)); ?>" method="post">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="kelas_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">Pilih Kelas</option>

                        <!-- Premium Classes -->
                        <?php if (!empty($premium_kelas)): ?>
                            <optgroup label="🏆 Kelas Premium">
                                <?php foreach ($premium_kelas as $k): ?>
                                    <?php
                                    $value = 'premium_' . $k->id;
                                    $selected = ($jadwal->kelas_id == $k->id && $jadwal->class_type == 'premium') ? 'selected' : '';
                                    ?>
                                    <option value="<?= $value; ?>" <?= $selected; ?>><?= $k->nama_kelas; ?> (Premium)</option>
                                <?php endforeach; ?>
                            </optgroup>
                        <?php endif; ?>

                        <!-- Free Classes -->
                        <?php if (!empty($gratis_kelas)): ?>
                            <optgroup label="🎁 Kelas Gratis">
                                <?php foreach ($gratis_kelas as $k): ?>
                                    <?php
                                    $value = 'gratis_' . $k->id;
                                    $selected = ($jadwal->kelas_id == $k->id && $jadwal->class_type == 'gratis') ? 'selected' : '';
                                    ?>
                                    <option value="<?= $value; ?>" <?= $selected; ?>><?= $k->title; ?> (Gratis)</option>
                                <?php endforeach; ?>
                            </optgroup>
                        <?php endif; ?>
                    </select>
                </div>
                <div>
                    <label for="guru_id" class="block text-sm font-medium text-gray-700">Guru</label>
                    <select name="guru_id" id="guru_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <?php foreach ($guru as $g): ?>
                            <option value="<?= $g->id; ?>" <?= ($g->id == $jadwal->guru_id) ? 'selected' : ''; ?>><?= $g->nama_lengkap; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="pertemuan_ke" class="block text-sm font-medium text-gray-700">Pertemuan Ke</label>
                    <input type="number" name="pertemuan_ke" id="pertemuan_ke" value="<?= $jadwal->pertemuan_ke; ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="judul_pertemuan" class="block text-sm font-medium text-gray-700">Judul Pertemuan</label>
                    <input type="text" name="judul_pertemuan" id="judul_pertemuan" value="<?= $jadwal->judul_pertemuan; ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="tanggal_pertemuan" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" name="tanggal_pertemuan" id="tanggal_pertemuan" value="<?= $jadwal->tanggal_pertemuan; ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" value="<?= $jadwal->waktu_mulai; ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" value="<?= $jadwal->waktu_selesai; ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Simpan</button>
                <a href="<?= site_url('admin/jadwal'); ?>" class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
            </div>
        </form>
    </div>
</div>
