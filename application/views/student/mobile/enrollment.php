<div class="space-y-4">
    <!-- Header -->
    <div class="mobile-card">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-900">Daftar Kelas</h2>
            <button onclick="location.href='<?= site_url("student_mobile") ?>'" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <i data-feather="arrow-left" class="w-5 h-5 text-gray-600"></i>
            </button>
        </div>
        
        <!-- Search and Filter -->
        <div class="space-y-3">
            <div class="relative">
                <i data-feather="search" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                <input type="text" placeholder="Cari kelas..." class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="flex space-x-2 overflow-x-auto">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium whitespace-nowrap">Semua</button>
                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium whitespace-nowrap hover:bg-gray-200">Gratis</button>
                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium whitespace-nowrap hover:bg-gray-200">Premium</button>
                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium whitespace-nowrap hover:bg-gray-200">Pemula</button>
                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium whitespace-nowrap hover:bg-gray-200">Menengah</button>
                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium whitespace-nowrap hover:bg-gray-200">Lanjutan</button>
            </div>
        </div>
    </div>

    <!-- Featured Classes -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Kelas Unggulan</h3>
        <div class="space-y-3">
            <?php foreach($featured_classes as $class): ?>
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-1">
                                <h4 class="text-base font-bold text-gray-900"><?php echo $class->nama_kelas; ?></h4>
                                <?php if ($class->harga == 0): ?>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Gratis</span>
                                <?php else: ?>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Premium</span>
                                <?php endif; ?>
                            </div>
                            <p class="text-sm text-gray-600"><?php echo $class->bahasa_program; ?> • <?php echo $class->level; ?></p>
                        </div>
                    </div>
                    
                    <p class="text-sm text-gray-700 mb-3 line-clamp-2"><?php echo $class->deskripsi; ?></p>
                    
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-4 text-xs text-gray-500">
                            <span><i data-feather="users" class="w-3 h-3 inline mr-1"></i><?php echo $class->total_siswa; ?> siswa</span>
                            <span><i data-feather="clock" class="w-3 h-3 inline mr-1"></i><?php echo $class->durasi; ?> jam</span>
                            <span><i data-feather="book" class="w-3 h-3 inline mr-1"></i><?php echo $class->total_materi; ?> materi</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <?php if ($class->harga == 0): ?>
                                <span class="text-lg font-bold text-green-600">Gratis</span>
                            <?php else: ?>
                                <span class="text-lg font-bold text-gray-900">Rp <?php echo number_format($class->harga, 0, ',', '.'); ?></span>
                                <?php if ($class->diskon > 0): ?>
                                    <span class="text-sm text-gray-500 line-through ml-2">Rp <?php echo number_format($class->harga_asli, 0, ',', '.'); ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <button onclick="enrollClass(<?php echo $class->id; ?>, '<?php echo $class->nama_kelas; ?>')" 
                                class="mobile-btn <?php echo $class->harga == 0 ? 'bg-green-600 text-white' : 'bg-blue-600 text-white'; ?>">
                            <?php echo $class->harga == 0 ? 'Daftar Gratis' : 'Beli Sekarang'; ?>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Free Classes Section -->
    <div class="mobile-card">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-900">Kelas Gratis</h3>
            <button class="text-blue-600 text-sm font-medium">Lihat Semua</button>
        </div>
        
        <div class="space-y-3">
            <?php foreach($free_classes as $class): ?>
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <h4 class="text-base font-bold text-gray-900 mb-1"><?php echo $class->nama_kelas; ?></h4>
                            <p class="text-sm text-gray-600"><?php echo $class->bahasa_program; ?> • <?php echo $class->level; ?></p>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Gratis</span>
                    </div>
                    
                    <p class="text-sm text-gray-700 mb-3 line-clamp-2"><?php echo $class->deskripsi; ?></p>
                    
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <i data-feather="users" class="w-3 h-3 inline mr-1"></i><?php echo $class->total_siswa; ?> siswa terdaftar
                        </div>
                        <button onclick="enrollClass(<?php echo $class->id; ?>, '<?php echo $class->nama_kelas; ?>')" 
                                class="mobile-btn bg-green-600 text-white">
                            Daftar Gratis
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Premium Classes Section -->
    <div class="mobile-card">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-900">Kelas Premium</h3>
            <button class="text-blue-600 text-sm font-medium">Lihat Semua</button>
        </div>
        
        <div class="space-y-3">
            <?php foreach($premium_classes as $class): ?>
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-1">
                                <h4 class="text-base font-bold text-gray-900"><?php echo $class->nama_kelas; ?></h4>
                                <i data-feather="crown" class="w-4 h-4 text-yellow-600"></i>
                            </div>
                            <p class="text-sm text-gray-600"><?php echo $class->bahasa_program; ?> • <?php echo $class->level; ?></p>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Premium</span>
                    </div>
                    
                    <p class="text-sm text-gray-700 mb-3 line-clamp-2"><?php echo $class->deskripsi; ?></p>
                    
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-lg p-3 mb-3">
                        <div class="flex items-center justify-between text-sm">
                            <div>
                                <span class="text-gray-600">Harga:</span>
                                <span class="font-bold text-gray-900 ml-1">Rp <?php echo number_format($class->harga, 0, ',', '.'); ?></span>
                            </div>
                            <?php if ($class->diskon > 0): ?>
                                <div class="text-right">
                                    <span class="text-red-600 font-bold">-<?php echo $class->diskon; ?>%</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <i data-feather="star" class="w-3 h-3 inline mr-1"></i><?php echo $class->rating; ?>/5 rating
                        </div>
                        <button onclick="purchaseClass(<?php echo $class->id; ?>, '<?php echo $class->nama_kelas; ?>')" 
                                class="mobile-btn bg-yellow-600 text-white">
                            Beli Premium
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Enrollment Modal -->
    <div id="enrollmentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl p-6 m-4 max-w-sm w-full">
            <div class="text-center mb-4">
                <div class="w-16 h-16 bg-green-100 rounded-full mx-auto mb-3 flex items-center justify-center">
                    <i data-feather="check-circle" class="w-8 h-8 text-green-600"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Konfirmasi Pendaftaran</h3>
                <p class="text-sm text-gray-600">Apakah Anda yakin ingin mendaftar ke kelas ini?</p>
            </div>
            
            <div class="mb-4">
                <p class="text-sm font-medium text-gray-900 mb-1">Kelas:</p>
                <p class="text-sm text-gray-700" id="className">Nama Kelas</p>
            </div>
            
            <div class="flex space-x-3">
                <button onclick="closeEnrollmentModal()" class="mobile-btn flex-1 border border-gray-300 text-gray-700">
                    Batal
                </button>
                <button onclick="confirmEnrollment()" class="mobile-btn flex-1 bg-green-600 text-white">
                    Ya, Daftar
                </button>
            </div>
        </div>
    </div>

    <!-- Purchase Modal -->
    <div id="purchaseModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl p-6 m-4 max-w-sm w-full">
            <div class="text-center mb-4">
                <div class="w-16 h-16 bg-yellow-100 rounded-full mx-auto mb-3 flex items-center justify-center">
                    <i data-feather="crown" class="w-8 h-8 text-yellow-600"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Pembelian Kelas Premium</h3>
                <p class="text-sm text-gray-600">Lanjutkan ke pembayaran?</p>
            </div>
            
            <div class="mb-4">
                <p class="text-sm font-medium text-gray-900 mb-1">Kelas:</p>
                <p class="text-sm text-gray-700" id="purchaseClassName">Nama Kelas</p>
                <p class="text-sm font-bold text-gray-900 mt-2">Rp <span id="purchasePrice">0</span></p>
            </div>
            
            <div class="flex space-x-3">
                <button onclick="closePurchaseModal()" class="mobile-btn flex-1 border border-gray-300 text-gray-700">
                    Batal
                </button>
                <button onclick="confirmPurchase()" class="mobile-btn flex-1 bg-yellow-600 text-white">
                    Lanjutkan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedClassId = null;
    let selectedClassName = null;
    let selectedPrice = null;

    function enrollClass(classId, className) {
        selectedClassId = classId;
        selectedClassName = className;
        document.getElementById('className').textContent = className;
        document.getElementById('enrollmentModal').classList.remove('hidden');
    }

    function closeEnrollmentModal() {
        document.getElementById('enrollmentModal').classList.add('hidden');
        selectedClassId = null;
        selectedClassName = null;
    }

    function confirmEnrollment() {
        // Simulate enrollment process
        showToast('Mendaftar ke ' + selectedClassName + '...');
        
        setTimeout(() => {
            closeEnrollmentModal();
            showToast('Pendaftaran berhasil! Silakan cek kelas Anda.');
        }, 2000);
    }

    function purchaseClass(classId, className, price) {
        selectedClassId = classId;
        selectedClassName = className;
        selectedPrice = price;
        document.getElementById('purchaseClassName').textContent = className;
        document.getElementById('purchasePrice').textContent = price;
        document.getElementById('purchaseModal').classList.remove('hidden');
    }

    function closePurchaseModal() {
        document.getElementById('purchaseModal').classList.add('hidden');
        selectedClassId = null;
        selectedClassName = null;
        selectedPrice = null;
    }

    function confirmPurchase() {
        // Redirect to payment page
        closePurchaseModal();
        location.href = '<?= site_url("payment/initiate/") ?>' + selectedClassId;
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
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