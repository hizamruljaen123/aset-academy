<div class="max-w-screen-xl mx-auto p-4">
    <div class="mb-6">
        <a href="<?= site_url('admin/workshops') ?>" class="text-blue-600 hover:text-blue-800 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Workshop
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Buat Workshop/Seminar Baru</h1>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p><?= $this->session->flashdata('error') ?></p>
            </div>
        <?php endif; ?>

        <?= form_open_multipart('admin/workshops/create', ['class' => 'space-y-6']) ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1 md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Workshop</label>
                    <input type="text" name="title" id="title" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('title') ?>" required>
                    <?= form_error('title', '<p class="mt-1 text-sm text-red-600">', '</p>') ?>
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Jenis</label>
                    <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="workshop" <?= set_select('type', 'workshop', true) ?>>Workshop</option>
                        <option value="seminar" <?= set_select('type', 'seminar') ?>>Seminar</option>
                    </select>
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                    <input type="number" name="price" id="price" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('price', '0') ?>">
                    <p class="mt-1 text-xs text-gray-500">Masukkan 0 untuk workshop gratis</p>
                </div>

                <div>
                    <label for="start_datetime" class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai</label>
                    <input type="datetime-local" name="start_datetime" id="start_datetime" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('start_datetime') ?>" required>
                    <?= form_error('start_datetime', '<p class="mt-1 text-sm text-red-600">', '</p>') ?>
                </div>

                <div>
                    <label for="end_datetime" class="block text-sm font-medium text-gray-700 mb-1">Waktu Selesai</label>
                    <input type="datetime-local" name="end_datetime" id="end_datetime" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('end_datetime') ?>" required>
                    <?= form_error('end_datetime', '<p class="mt-1 text-sm text-red-600">', '</p>') ?>
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <input type="text" name="location" id="location" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('location') ?>" required>
                    <?= form_error('location', '<p class="mt-1 text-sm text-red-600">', '</p>') ?>
                </div>

                <div>
                    <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-1">Maksimal Peserta</label>
                    <input type="number" name="max_participants" id="max_participants" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= set_value('max_participants', '30') ?>" required>
                    <?= form_error('max_participants', '<p class="mt-1 text-sm text-red-600">', '</p>') ?>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= set_value('description') ?></textarea>
                    <?= form_error('description', '<p class="mt-1 text-sm text-red-600">', '</p>') ?>
                </div>

                <div>
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-xs text-gray-500">Format: JPG, JPEG, PNG. Maks: 2MB</p>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="draft" <?= set_select('status', 'draft', true) ?>>Draft</option>
                        <option value="published" <?= set_select('status', 'published') ?>>Published</option>
                    </select>
                </div>
            </div>

            <div class="pt-5 border-t border-gray-200">
                <div class="flex justify-end">
                    <a href="<?= site_url('admin/workshops') ?>" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </a>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan Workshop
                    </button>
                </div>
            </div>
        <?= form_close() ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const descriptionField = document.getElementById('description');
    
    // Initialize a simple WYSIWYG editor if available
    if (typeof ClassicEditor !== 'undefined') {
        ClassicEditor
            .create(descriptionField)
            .catch(error => {
                console.error(error);
            });
    }
});
</script>
