<div class="min-h-screen bg-gray-50 pb-20">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-4 py-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <button onclick="history.back()" class="mr-3 p-2 rounded-full bg-white/20 hover:bg-white/30 transition-colors">
                    <i data-feather="arrow-left" class="w-5 h-5"></i>
                </button>
                <div>
                    <h1 class="text-xl font-bold"><?php echo $kelas->nama_kelas; ?></h1>
                    <p class="text-blue-100 text-sm">Kelas Premium</p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 -mt-4">
        <!-- Class Thumbnail -->
        <?php if (!empty($kelas->gambar)): ?>
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
                <img src="<?php echo $kelas->gambar; ?>" alt="<?php echo $kelas->nama_kelas; ?>" class="w-full h-48 object-cover">
            </div>
        <?php endif; ?>

        <!-- Class Info -->
        <div class="bg-white rounded-2xl shadow-lg p-4 mb-6">
            <h2 class="text-lg font-bold text-gray-800 mb-3">Tentang Kelas Ini</h2>
            <p class="text-gray-600 mb-4"><?php echo $kelas->deskripsi ?? 'Deskripsi kelas belum tersedia'; ?></p>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i data-feather="users" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo count($materials); ?></p>
                    <p class="text-xs text-gray-500">Materi</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i data-feather="clock" class="w-6 h-6 text-green-600"></i>
                    </div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo $kelas->durasi; ?></p>
                    <p class="text-xs text-gray-500">Jam</p>
                </div>
            </div>

            <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
                <span><i data-feather="code" class="w-4 h-4 inline mr-1"></i><?php echo $kelas->bahasa_program; ?></span>
                <span><i data-feather="trending-up" class="w-4 h-4 inline mr-1"></i><?php echo $kelas->level; ?></span>
            </div>

            <!-- Price Display -->
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-lg p-4 mb-4">
                <div class="text-center">
                    <p class="text-sm text-gray-600 mb-1">Harga Kelas</p>
                    <p class="text-2xl font-bold text-gray-900">Rp <?php echo number_format($kelas->harga, 0, ',', '.'); ?></p>
                    <?php if (isset($kelas->diskon) && $kelas->diskon > 0): ?>
                        <p class="text-sm text-red-600 font-medium mt-1"><?php echo $kelas->diskon; ?>% Diskon</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Enrollment Button -->
            <?php if ($is_enrolled): ?>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                    <div class="flex items-center">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2"></i>
                        <span class="text-green-800 font-medium">Anda sudah terdaftar di kelas ini</span>
                    </div>
                    <a href="<?php echo site_url('student_mobile/my_classes'); ?>" class="mt-3 inline-block w-full text-center px-4 py-2 bg-green-600 text-white rounded-lg font-medium">
                        Lihat Kelas Saya
                    </a>
                </div>
            <?php else: ?>
                <button onclick="purchaseClass(<?php echo $kelas->id; ?>, '<?php echo $kelas->nama_kelas; ?>', <?php echo $kelas->harga; ?>)"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    Beli Kelas Premium
                </button>
            <?php endif; ?>
        </div>

        <!-- Class Materials -->
        <?php if (!empty($materials)): ?>
            <div class="bg-white rounded-2xl shadow-lg p-4 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Materi Pembelajaran</h3>
                <div class="space-y-3">
                    <?php foreach($materials as $index => $material): ?>
                        <div class="flex items-center p-3 border border-gray-200 rounded-lg">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-sm font-bold text-blue-600"><?php echo $index + 1; ?></span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-800"><?php echo $material->judul; ?></h4>
                                <p class="text-sm text-gray-600"><?php echo $material->deskripsi ?? 'Deskripsi materi'; ?></p>
                            </div>
                            <i data-feather="chevron-right" class="w-5 h-5 text-gray-400"></i>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Class Schedule -->
        <?php if (!empty($schedule)): ?>
            <div class="bg-white rounded-2xl shadow-lg p-4 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Jadwal Kelas</h3>
                <div class="space-y-3">
                    <?php foreach($schedule as $item): ?>
                        <div class="flex items-center p-3 border border-gray-200 rounded-lg">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i data-feather="calendar" class="w-5 h-5 text-blue-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800"><?php echo date('d M Y', strtotime($item->tanggal_pertemuan)); ?></p>
                                <p class="text-sm text-gray-600"><?php echo $item->waktu_mulai; ?> - <?php echo $item->waktu_selesai; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Purchase Modal -->
<div id="purchaseModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl p-6 m-4 max-w-sm w-full">
        <div class="text-center mb-4">
            <div class="w-16 h-16 bg-blue-100 rounded-full mx-auto mb-3 flex items-center justify-center">
                <i data-feather="credit-card" class="w-8 h-8 text-blue-600"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Konfirmasi Pembelian</h3>
            <p class="text-sm text-gray-600">Lanjutkan ke pembayaran?</p>
        </div>

        <div class="mb-4">
            <p class="text-sm font-medium text-gray-900 mb-1">Kelas:</p>
            <p class="text-sm text-gray-700" id="className"><?php echo $kelas->nama_kelas; ?></p>
            <p class="text-sm font-bold text-gray-900 mt-2">Rp <span id="classPrice"><?php echo number_format($kelas->harga, 0, ',', '.'); ?></span></p>
        </div>

        <div class="flex space-x-3">
            <button onclick="closePurchaseModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium">
                Batal
            </button>
            <button onclick="confirmPurchase()" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg font-medium">
                Lanjutkan
            </button>
        </div>
    </div>
</div>

<script>
    let selectedClassId = <?php echo $kelas->id; ?>;
    let selectedClassName = '<?php echo $kelas->nama_kelas; ?>';
    let selectedClassPrice = <?php echo $kelas->harga; ?>;

    function purchaseClass(classId, className, price) {
        selectedClassId = classId;
        selectedClassName = className;
        selectedClassPrice = price;
        document.getElementById('className').textContent = className;
        document.getElementById('classPrice').textContent = price.toLocaleString('id-ID');
        document.getElementById('purchaseModal').classList.remove('hidden');
    }

    function closePurchaseModal() {
        document.getElementById('purchaseModal').classList.add('hidden');
    }

    function confirmPurchase() {
        // Show loading
        const button = document.querySelector('#purchaseModal button:last-child');
        const originalText = button.textContent;
        button.textContent = 'Memproses...';
        button.disabled = true;

        // Simulate processing
        setTimeout(() => {
            closePurchaseModal();
            showToast('Mengalihkan ke pembayaran...');

            // Redirect to payment page
            setTimeout(() => {
                location.href = '<?php echo site_url('student_mobile/payment/'); ?>' + selectedClassId;
            }, 1000);
        }, 2000);
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 bg-blue-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        feather.replace();
    });
</script>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
