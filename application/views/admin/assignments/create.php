<div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Buat Tugas Baru</h1>

        <?php echo validation_errors('<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert"><p>', '</p></div>'); ?>

        <form action="<?= site_url('admin/assignments/store'); ?>" method="POST">
            <div class="space-y-6">
                <!-- Assignment Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Tugas</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="<?= set_value('title'); ?>" required>
                </div>

                <!-- Assignment Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"><?= set_value('description'); ?></textarea>
                </div>

                <!-- Class Selection -->
                <div>
                    <label for="class_id_type" class="block text-sm font-medium text-gray-700">Pilih Kelas</label>
                    <select name="class_id_type" id="class_id_type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                        <option value="">-- Pilih Kelas --</option>
                        <optgroup label="Kelas Premium">
                            <?php foreach ($premium_classes as $class): ?>
                                <option value="<?= $class->id . '|premium'; ?>"><?= $class->nama_kelas; ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                        <optgroup label="Kelas Gratis">
                            <?php foreach ($free_classes as $class): ?>
                                <option value="<?= $class->id . '|gratis'; ?>"><?= $class->nama_kelas; ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    </select>
                </div>

                <!-- Due Date -->
                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Batas Waktu (Opsional)</label>
                    <input type="datetime-local" name="due_date" id="due_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="<?= set_value('due_date'); ?>">
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-8 pt-5 border-t border-gray-200">
                <div class="flex justify-end">
                    <a href="<?= site_url('admin/assignments'); ?>" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Buat Tugas</button>
                </div>
            </div>
        </form>
    </div>
</div>
