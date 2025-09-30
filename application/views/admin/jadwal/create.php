<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Tambah Jadwal Kelas</h1>
                <p class="text-sm opacity-90 mt-1">Pilih guru terlebih dahulu untuk melihat kelas yang tersedia</p>
            </div>
            <a href="<?= site_url('admin/jadwal'); ?>" class="inline-flex items-center px-4 py-2 bg-white text-indigo-600 font-bold rounded-lg shadow-md hover:bg-gray-100 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <form action="<?= site_url('admin/jadwal/store'); ?>" method="post" class="space-y-6" id="jadwalForm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="guru_id" class="block text-sm font-medium text-gray-700 mb-1">Guru <span class="text-red-500">*</span></label>
                    <select name="guru_id" id="guru_id" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Guru</option>
                        <?php foreach ($guru as $g): ?>
                            <option value="<?= $g->id; ?>"><?= $g->nama_lengkap; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-1">Kelas <span class="text-red-500">*</span></label>
                    <select name="kelas_id" id="kelas_id" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required disabled>
                        <option value="">Pilih Guru Terlebih Dahulu</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="judul_pertemuan" class="block text-sm font-medium text-gray-700 mb-1">Judul Pertemuan</label>
                <input type="text" name="judul_pertemuan" id="judul_pertemuan" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label for="pertemuan_ke" class="block text-sm font-medium text-gray-700 mb-1">Pertemuan Ke</label>
                    <input type="number" name="pertemuan_ke" id="pertemuan_ke" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="tanggal_pertemuan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal_pertemuan" id="tanggal_pertemuan" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="waktu_mulai" class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="waktu_selesai" class="block text-sm font-medium text-gray-700 mb-1">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-md transition-colors" id="submitBtn" disabled>
                    <i class="fas fa-save mr-2"></i>
                    Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const guruSelect = document.getElementById('guru_id');
    const kelasSelect = document.getElementById('kelas_id');
    const submitBtn = document.getElementById('submitBtn');

    // Enable/disable form submission based on selections
    function checkFormValidity() {
        const guruSelected = guruSelect.value !== '';
        const kelasSelected = kelasSelect.value !== '';

        if (guruSelected && kelasSelected) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    // Load classes when teacher is selected
    guruSelect.addEventListener('change', function() {
        const teacherId = this.value;

        if (teacherId) {
            // Show loading state
            kelasSelect.innerHTML = '<option value="">Memuat kelas...</option>';
            kelasSelect.disabled = true;

            // Fetch classes via AJAX
            fetch('<?= site_url("admin/jadwal/get_classes_by_teacher?teacher_id="); ?>' + teacherId)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        kelasSelect.innerHTML = '<option value="">Error: ' + data.error + '</option>';
                    } else {
                        kelasSelect.innerHTML = data.options;
                        kelasSelect.disabled = false;
                    }
                    checkFormValidity();
                })
                .catch(error => {
                    console.error('Error:', error);
                    kelasSelect.innerHTML = '<option value="">Error loading classes</option>';
                    kelasSelect.disabled = false;
                });
        } else {
            // Reset class selection when no teacher is selected
            kelasSelect.innerHTML = '<option value="">Pilih Guru Terlebih Dahulu</option>';
            kelasSelect.disabled = true;
            checkFormValidity();
        }
    });

    // Check form validity when class selection changes
    kelasSelect.addEventListener('change', checkFormValidity);

    // Initial form validity check
    checkFormValidity();
});
</script>
