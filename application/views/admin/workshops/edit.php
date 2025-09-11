<div class="max-w-screen-xl mx-auto p-4">
    <div class="mb-6">
        <a href="<?= site_url('admin/workshops') ?>" class="text-blue-600 hover:text-blue-800 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Workshop
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Workshop: <?= $workshop->title ?></h1>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p><?= $this->session->flashdata('success') ?></p>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p><?= $this->session->flashdata('error') ?></p>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Form -->
            <div class="lg:col-span-2">
                <?= form_open_multipart('admin/workshops/edit/'.$workshop->id, ['class' => 'space-y-6']) ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1 md:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Workshop</label>
                            <input type="text" name="title" id="title" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('title', $workshop->title) ?>" required>
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Jenis</label>
                            <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="workshop" <?= $workshop->type == 'workshop' ? 'selected' : '' ?>>Workshop</option>
                                <option value="seminar" <?= $workshop->type == 'seminar' ? 'selected' : '' ?>>Seminar</option>
                            </select>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                            <input type="number" name="price" id="price" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('price', $workshop->price) ?>">
                            <p class="mt-1 text-xs text-gray-500">Masukkan 0 untuk workshop gratis</p>
                        </div>

                        <div>
                            <label for="start_datetime" class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai</label>
                            <input type="datetime-local" name="start_datetime" id="start_datetime" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('start_datetime', date('Y-m-d\TH:i', strtotime($workshop->start_datetime))) ?>" required>
                        </div>

                        <div>
                            <label for="end_datetime" class="block text-sm font-medium text-gray-700 mb-1">Waktu Selesai</label>
                            <input type="datetime-local" name="end_datetime" id="end_datetime" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('end_datetime', date('Y-m-d\TH:i', strtotime($workshop->end_datetime))) ?>" required>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                            <input type="text" name="location" id="location" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('location', $workshop->location) ?>" required>
                        </div>

                        <div>
                            <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-1">Maksimal Peserta</label>
                            <input type="number" name="max_participants" id="max_participants" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('max_participants', $workshop->max_participants) ?>" required>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="description" id="description" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= set_value('description', $workshop->description) ?></textarea>
                        </div>

                        <div>
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">Thumbnail</label>
                            <?php if ($workshop->thumbnail): ?>
                                <div class="mb-2">
                                    <img src="<?= base_url($workshop->thumbnail) ?>" alt="Thumbnail" class="h-32 w-auto object-cover rounded">
                                </div>
                            <?php endif; ?>
                            <input type="file" name="thumbnail" id="thumbnail" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <p class="mt-1 text-xs text-gray-500">Format: JPG, JPEG, PNG. Maks: 2MB</p>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="draft" <?= $workshop->status == 'draft' ? 'selected' : '' ?>>Draft</option>
                                <option value="published" <?= $workshop->status == 'published' ? 'selected' : '' ?>>Published</option>
                                <option value="completed" <?= $workshop->status == 'completed' ? 'selected' : '' ?>>Completed</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-5 border-t border-gray-200">
                        <div class="flex justify-end">
                            <a href="<?= site_url('admin/workshops') ?>" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Batal
                            </a>
                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                <?= form_close() ?>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Materials Section -->
                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Materi Workshop</h2>
                    
                    <?= form_open_multipart('admin/workshops/add_material/'.$workshop->id, ['class' => 'mb-4']) ?>
                        <div class="mb-3">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Materi</label>
                            <input type="text" name="title" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="mb-3">
                            <label for="material_file" class="block text-sm font-medium text-gray-700 mb-1">File</label>
                            <input type="file" name="material_file" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            <p class="mt-1 text-xs text-gray-500">Format: PDF, DOC, PPT, ZIP, dll. Maks: 5MB</p>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Tambah Materi
                        </button>
                    <?= form_close() ?>

                    <div class="divide-y divide-gray-200">
                        <?php if (empty($materials)): ?>
                            <div class="py-3 text-center text-gray-500">Belum ada materi</div>
                        <?php else: ?>
                            <?php foreach ($materials as $material): ?>
                                <div class="py-3 flex justify-between items-center">
                                    <div>
                                        <p class="font-medium text-gray-800"><?= $material->title ?></p>
                                        <p class="text-xs text-gray-500"><?= $material->file_type ?></p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="<?= base_url($material->file_path) ?>" target="_blank" class="text-blue-600 hover:text-blue-800" title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <a href="<?= site_url('admin/workshops/delete_material/'.$material->id) ?>" class="text-red-600 hover:text-red-800" title="Hapus" onclick="return confirm('Yakin ingin menghapus materi ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Participants Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Peserta</h2>
                    
                    <div class="mb-4">
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold"><?= count($participants) ?></span>
                            <span class="text-sm text-gray-500">dari <?= $workshop->max_participants ?> maksimal</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?= min(100, (count($participants) / max(1, $workshop->max_participants)) * 100) ?>%"></div>
                        </div>
                    </div>

                    <a href="<?= site_url('admin/workshops/participants/'.$workshop->id) ?>" class="block w-full bg-white border border-gray-300 text-center py-2 px-4 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Lihat Semua Peserta
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
