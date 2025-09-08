<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Buat Materi Baru</h1>
                <p class="text-sm opacity-90 mt-1">Isi detail materi di bawah ini</p>
            </div>
            <a href="<?php echo site_url('teacher/materi'); ?>" class="hidden sm:inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Create Materi Form -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <?php echo form_open('teacher/create_materi'); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul Materi</label>
                    <input type="text" name="judul" id="judul" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="md:col-span-2">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                </div>
                <div>
                    <label for="kelas_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Pilih Kelas</option>
                        <?php foreach ($kelas_list as $kelas): ?>
                            <option value="<?php echo $kelas->id; ?>"><?php echo $kelas->nama_kelas; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <hr class="my-8">

            <div id="parts-container">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Bagian Materi</h3>
                <!-- Dynamic parts will be added here -->
            </div>

            <button type="button" id="add-part" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-lg shadow-sm transition-colors">
                <i class="fas fa-plus mr-2"></i> Tambah Bagian
            </button>

            <div class="flex justify-end mt-6">
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white font-semibold rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i> Simpan Materi
                </button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let partIndex = 0;
    document.getElementById('add-part').addEventListener('click', function() {
        const container = document.getElementById('parts-container');
        const partHtml = `
            <div class="part-item grid grid-cols-1 md:grid-cols-12 gap-4 mb-4 p-4 border rounded-lg">
                <div class="md:col-span-4">
                    <label class="block text-sm font-medium text-gray-700">Judul Bagian</label>
                    <input type="text" name="parts[${partIndex}][title]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Tipe</label>
                    <select name="parts[${partIndex}][type]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="text">Teks</option>
                        <option value="image">Gambar</option>
                        <option value="video">Video</option>
                        <option value="pdf">PDF</option>
                        <option value="link">Link</option>
                    </select>
                </div>
                <div class="md:col-span-5">
                    <label class="block text-sm font-medium text-gray-700">Konten</label>
                    <input type="text" name="parts[${partIndex}][content]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="md:col-span-1 flex items-end">
                    <button type="button" class="remove-part text-red-500 hover:text-red-700">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <input type="hidden" name="parts[${partIndex}][order]" value="${partIndex}">
            </div>
        `;
        container.insertAdjacentHTML('beforeend', partHtml);
        partIndex++;
    });

    document.getElementById('parts-container').addEventListener('click', function(e) {
        if (e.target.closest('.remove-part')) {
            e.target.closest('.part-item').remove();
        }
    });
});
</script>
