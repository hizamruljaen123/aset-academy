<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="flex items-center justify-between px-4 py-3">
            <div class="flex items-center">
                <button onclick="window.history.back()" class="p-2 rounded-full hover:bg-gray-100">
                    <i data-feather="arrow-left" class="w-5 h-5 text-gray-600"></i>
                </button>
                <h1 class="ml-3 text-lg font-bold text-gray-900">Daftar Pemesanan</h1>
            </div>
            <button onclick="location.href='<?= site_url('student_mobile') ?>'" class="p-2 rounded-full hover:bg-gray-100">
                <i data-feather="home" class="w-5 h-5 text-gray-600"></i>
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 gap-3 mx-4 mt-4">
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600"><?php echo count($pending_payments); ?></div>
                <div class="text-xs text-gray-500">Menunggu</div>
            </div>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600"><?php echo count($paid_payments); ?></div>
                <div class="text-xs text-gray-500">Selesai</div>
            </div>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="mx-4 mt-4">
        <div class="mobile-tabs">
            <button class="mobile-tab active" onclick="switchTab('all')">
                Semua
            </button>
            <button class="mobile-tab" onclick="switchTab('pending')">
                Belum Bayar
            </button>
            <button class="mobile-tab" onclick="switchTab('paid')">
                Sudah Bayar
            </button>
        </div>
    </div>

    <!-- Orders List -->
    <div class="mx-4 mt-4 pb-20">
        <!-- All Orders -->
        <div id="allOrders" class="space-y-3">
            <?php if (empty($all_payments)): ?>
                <div class="bg-white rounded-lg p-8 text-center shadow-sm border border-gray-200">
                    <i data-feather="shopping-bag" class="w-12 h-12 text-gray-300 mx-auto mb-3"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pesanan</h3>
                    <p class="text-sm text-gray-500">Mulai belajar dengan kelas premium sekarang!</p>
                    <button onclick="location.href='<?= site_url('student_mobile') ?>'" class="mobile-btn mt-4 bg-blue-600 text-white">
                        Lihat Kelas
                    </button>
                </div>
            <?php else: ?>
                <?php foreach($all_payments as $payment): ?>
                    <?php $class = $payment->class; ?>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h3 class="font-bold text-gray-900"><?php echo $class->nama_kelas; ?></h3>
                                    <p class="text-sm text-gray-500"><?php echo $class->bahasa_program; ?></p>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full <?php 
                                    echo ($payment->status === 'Pending') ? 'bg-yellow-100 text-yellow-800' : 
                                        (($payment->status === 'Verified') ? 'bg-green-100 text-green-800' : 
                                        'bg-gray-100 text-gray-800'); 
                                ?>">
                                    <?php echo ($payment->status === 'Pending') ? 'Menunggu' : 
                                           (($payment->status === 'Verified') ? 'Selesai' : $payment->status); ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm text-gray-600">Total</span>
                                <span class="font-bold text-gray-900">Rp <?php echo number_format($payment->amount, 0, ',', '.'); ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                                <span>No. Invoice</span>
                                <span><?php echo $payment->invoice_number; ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>Tanggal</span>
                                <span><?php echo date('d M Y', strtotime($payment->created_at)); ?></span>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-100 p-3">
                            <div class="flex space-x-2">
                                <?php 
                                $encrypted_id = $this->encryption_url->encode($payment->id);
                                $url_safe_id = str_replace(['+', '/'], ['-', '_'], $encrypted_id);
                                ?>
                                <?php if($payment->status === 'Pending'): ?>
                                    <button onclick="location.href='<?= site_url('payment/status/' . $url_safe_id) ?>'" class="flex-1 mobile-btn bg-blue-600 text-white text-sm">
                                        <i data-feather="credit-card" class="w-3 h-3 inline mr-1"></i>
                                        Bayar Sekarang
                                    </button>
                                <?php else: ?>
                                    <button onclick="location.href='<?= site_url('payment/status/' . $url_safe_id) ?>'" class="flex-1 mobile-btn bg-gray-100 text-gray-700 text-sm">
                                        <i data-feather="eye" class="w-3 h-3 inline mr-1"></i>
                                        Lihat Detail
                                    </button>
                                    <button onclick="location.href='<?= site_url('payment/invoice/' . $payment->id) ?>'" class="flex-1 mobile-btn bg-blue-50 text-blue-600 text-sm">
                                        <i data-feather="download" class="w-3 h-3 inline mr-1"></i>
                                        Invoice
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Pending Orders -->
        <div id="pendingOrders" class="space-y-3 hidden">
            <?php if (empty($pending_payments)): ?>
                <div class="bg-white rounded-lg p-8 text-center shadow-sm border border-gray-200">
                    <i data-feather="clock" class="w-12 h-12 text-yellow-300 mx-auto mb-3"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada pesanan menunggu</h3>
                    <p class="text-sm text-gray-500">Semua pesanan sudah dibayar atau tidak ada pesanan baru.</p>
                </div>
            <?php else: ?>
                <?php foreach($pending_payments as $payment): ?>
                    <?php $class = $payment->class; ?>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h3 class="font-bold text-gray-900"><?php echo $class->nama_kelas; ?></h3>
                                    <p class="text-sm text-gray-500"><?php echo $class->bahasa_program; ?></p>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                    Menunggu
                                </span>
                            </div>
                            
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm text-gray-600">Total</span>
                                <span class="font-bold text-gray-900">Rp <?php echo number_format($payment->amount, 0, ',', '.'); ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                                <span>No. Invoice</span>
                                <span><?php echo $payment->invoice_number; ?></span>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-100 p-3">
                            <?php 
                            $encrypted_id = $this->encryption_url->encode($payment->id);
                            $url_safe_id = str_replace(['+', '/'], ['-', '_'], $encrypted_id);
                            ?>
                            <button onclick="location.href='<?= site_url('payment/status/' . $url_safe_id) ?>'" class="w-full mobile-btn bg-yellow-600 text-white text-sm">
                                <i data-feather="credit-card" class="w-3 h-3 inline mr-1"></i>
                                Lanjutkan Pembayaran
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Paid Orders -->
        <div id="paidOrders" class="space-y-3 hidden">
            <?php if (empty($paid_payments)): ?>
                <div class="bg-white rounded-lg p-8 text-center shadow-sm border border-gray-200">
                    <i data-feather="check-circle" class="w-12 h-12 text-green-300 mx-auto mb-3"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pesanan selesai</h3>
                    <p class="text-sm text-gray-500">Selesaikan pembayaran untuk melihat pesanan di sini.</p>
                </div>
            <?php else: ?>
                <?php foreach($paid_payments as $payment): ?>
                    <?php $class = $payment->class; ?>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h3 class="font-bold text-gray-900"><?php echo $class->nama_kelas; ?></h3>
                                    <p class="text-sm text-gray-500"><?php echo $class->bahasa_program; ?></p>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                    Selesai
                                </span>
                            </div>
                            
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm text-gray-600">Total</span>
                                <span class="font-bold text-gray-900">Rp <?php echo number_format($payment->amount, 0, ',', '.'); ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                                <span>No. Invoice</span>
                                <span><?php echo $payment->invoice_number; ?></span>
                            </div>
                        </div>
                        
                        <?php 
                        $encrypted_id = $this->encryption_url->encode($payment->id);
                        $url_safe_id = str_replace(['+', '/'], ['-', '_'], $encrypted_id);
                        ?>
                        <div class="border-t border-gray-100 p-3">
                            <div class="flex space-x-2">
                                <button onclick="location.href='<?= site_url('payment/status/' . $url_safe_id) ?>'" class="flex-1 mobile-btn bg-gray-100 text-gray-700 text-sm">
                                    <i data-feather="eye" class="w-3 h-3 inline mr-1"></i>
                                    Detail
                                </button>
                                <button onclick="location.href='<?= site_url('payment/invoice/' . $url_safe_id) ?>'" class="flex-1 mobile-btn bg-blue-50 text-blue-600 text-sm">
                                    <i data-feather="download" class="w-3 h-3 inline mr-1"></i>
                                    Invoice
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Tab switching functionality
    function switchTab(tab) {
        const tabs = document.querySelectorAll('.mobile-tab');
        const contents = ['allOrders', 'pendingOrders', 'paidOrders'];
        
        // Update tab active state
        tabs.forEach((tabElement, index) => {
            tabElement.classList.toggle('active', 
                (tab === 'all' && index === 0) || 
                (tab === 'pending' && index === 1) || 
                (tab === 'paid' && index === 2)
            );
        });
        
        // Show/hide content
        contents.forEach(contentId => {
            const element = document.getElementById(contentId);
            if (element) {
                element.classList.toggle('hidden', 
                    (tab === 'all' && contentId !== 'allOrders') ||
                    (tab === 'pending' && contentId !== 'pendingOrders') ||
                    (tab === 'paid' && contentId !== 'paidOrders')
                );
            }
        });
    }

    // Initialize
    feather.replace();
</script>

<style>
    .mobile-tabs {
        display: flex;
        background: white;
        border-radius: 12px;
        padding: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .mobile-tab {
        flex: 1;
        padding: 8px 12px;
        text-align: center;
        font-size: 12px;
        font-weight: 500;
        color: #6b7280;
        border-radius: 8px;
        transition: all 0.2s;
    }
    
    .mobile-tab.active {
        background: #3b82f6;
        color: white;
    }
</style>
