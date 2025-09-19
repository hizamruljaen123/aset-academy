<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="flex items-center justify-between px-4 py-3">
            <div class="flex items-center">
                <button onclick="window.history.back()" class="p-2 rounded-full hover:bg-gray-100">
                    <i data-feather="arrow-left" class="w-5 h-5 text-gray-600"></i>
                </button>
                <h1 class="ml-3 text-lg font-bold text-gray-900">Pembayaran Kelas</h1>
            </div>
        </div>
    </div>

    <!-- Class Info Card -->
    <div class="bg-white mx-4 mt-4 rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-4 text-white">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-lg font-bold"><?php echo $class->nama_kelas; ?></h2>
                    <p class="text-sm opacity-90 mt-1"><?php echo $class->bahasa_program; ?></p>
                </div>
                <div class="bg-white/20 px-3 py-1 rounded-full">
                    <span class="text-xs font-medium">Premium</span>
                </div>
            </div>
            <div class="mt-4 space-y-2">
                <div class="flex items-center text-sm">
                    <i data-feather="trending-up" class="w-4 h-4 mr-2"></i>
                    <span><?php echo $class->level; ?></span>
                </div>
                <div class="flex items-center text-sm">
                    <i data-feather="clock" class="w-4 h-4 mr-2"></i>
                    <span><?php echo $class->durasi; ?> Jam</span>
                </div>
                <div class="flex items-center text-sm">
                    <i data-feather="award" class="w-4 h-4 mr-2"></i>
                    <span>Kelas Premium</span>
                </div>
            </div>
        </div>
        
        <div class="p-4">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">Total Pembayaran</span>
                <span class="text-2xl font-bold text-gray-900">Rp <?php echo number_format($class->harga, 0, ',', '.'); ?></span>
            </div>
        </div>
    </div>

    <!-- Payment Methods -->
    <div class="mx-4 mt-4">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Pilih Metode Pembayaran</h3>
        
        <form id="paymentForm" method="post" action="<?php echo site_url('payment/confirm/' . $class->id); ?>" enctype="multipart/form-data">
            <!-- Payment Method Selection -->
            <div class="space-y-3">
                <label class="block">
                    <input type="radio" name="payment_method" value="Transfer" class="sr-only peer" checked>
                    <div class="bg-white border-2 border-gray-200 rounded-lg p-4 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i data-feather="credit-card" class="w-4 h-4 text-blue-600"></i>
                            </div>
                            <div class="ml-3">
                                <span class="font-medium text-gray-900">Transfer Bank</span>
                                <p class="text-sm text-gray-500">Transfer ke rekening perusahaan</p>
                            </div>
                        </div>
                    </div>
                </label>

                <label class="block">
                    <input type="radio" name="payment_method" value="Cash" class="sr-only peer">
                    <div class="bg-white border-2 border-gray-200 rounded-lg p-4 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                <i data-feather="dollar-sign" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <div class="ml-3">
                                <span class="font-medium text-gray-900">Tunai</span>
                                <p class="text-sm text-gray-500">Bayar langsung di tempat</p>
                            </div>
                        </div>
                    </div>
                </label>
            </div>

            <!-- Bank Account Selection -->
            <div id="bankTransferSection" class="mt-4">
                <h4 class="text-sm font-medium text-gray-900 mb-2">Pilih Rekening Tujuan</h4>
                <div class="space-y-2">
                    <?php foreach($bank_accounts as $bank): ?>
                        <label class="block">
                            <input type="radio" name="bank_account_id" value="<?php echo $bank->id; ?>" class="sr-only peer" <?php echo $bank_accounts[0]->id == $bank->id ? 'checked' : ''; ?>>
                            <div class="bg-white border border-gray-200 rounded-lg p-3 peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="font-medium text-gray-900"><?php echo $bank->bank_name; ?></span>
                                        <p class="text-sm text-gray-600"><?php echo $bank->account_number; ?></p>
                                        <p class="text-xs text-gray-500">a.n <?php echo $bank->account_holder; ?></p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-sm font-bold text-gray-900">Rp <?php echo number_format($class->harga, 0, ',', '.'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- User Bank Details -->
            <div id="userBankDetails" class="mt-4">
                <h4 class="text-sm font-medium text-gray-900 mb-2">Data Bank Pengirim</h4>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bank</label>
                        <input type="text" name="bank_name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: BCA, Mandiri, BRI">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label>
                        <input type="text" name="account_number" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="1234567890">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik Rekening</label>
                        <input type="text" name="user_account_holder" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Nama lengkap sesuai rekening">
                    </div>
                </div>
            </div>

            <!-- Payment Proof Upload -->
            <div id="paymentProofSection" class="mt-4">
                <h4 class="text-sm font-medium text-gray-900 mb-2">Upload Bukti Pembayaran</h4>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <i data-feather="upload-cloud" class="w-12 h-12 text-gray-400 mx-auto mb-2"></i>
                    <p class="text-sm text-gray-600 mb-2">Upload bukti transfer</p>
                    <input type="file" name="payment_proof" accept="image/*,.pdf" class="hidden" id="paymentProof" required>
                    <button type="button" onclick="document.getElementById('paymentProof').click()" class="mobile-btn bg-blue-50 text-blue-600 text-sm">
                        <i data-feather="camera" class="w-4 h-4 inline mr-1"></i>
                        Pilih File
                    </button>
                    <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, PDF (max 2MB)</p>
                </div>
                <div id="filePreview" class="mt-3 hidden">
                    <img id="previewImage" class="w-full h-48 object-cover rounded-lg" alt="Preview">
                </div>
            </div>

            <!-- Payment Description -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan (Opsional)</label>
                <textarea name="payment_description" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Catatan tambahan untuk pembayaran"></textarea>
            </div>

            <!-- Hidden Amount -->
            <input type="hidden" name="amount" value="<?php echo $class->harga; ?>">

            <!-- Submit Button -->
            <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-4">
                <button type="submit" class="mobile-btn w-full bg-blue-600 text-white">
                    <i data-feather="check-circle" class="w-5 h-5 inline mr-2"></i>
                    Konfirmasi Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 text-center">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto"></div>
        <p class="mt-2 text-sm text-gray-600">Memproses pembayaran...</p>
    </div>
</div>

<script>
    // File upload preview
    document.getElementById('paymentProof').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('filePreview');
                const previewImage = document.getElementById('previewImage');
                
                if (file.type.includes('image')) {
                    previewImage.src = e.target.result;
                    preview.classList.remove('hidden');
                } else {
                    preview.classList.add('hidden');
                }
            };
            reader.readAsDataURL(file);
        }
    });

    // Form submission
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const loadingOverlay = document.getElementById('loadingOverlay');
        
        // Validate form
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        if (paymentMethod === 'Transfer') {
            const bankName = document.querySelector('input[name="bank_name"]').value;
            const accountNumber = document.querySelector('input[name="account_number"]').value;
            const accountHolder = document.querySelector('input[name="user_account_holder"]').value;
            const paymentProof = document.getElementById('paymentProof').files[0];
            
            if (!bankName || !accountNumber || !accountHolder || !paymentProof) {
                alert('Mohon lengkapi semua data untuk transfer bank');
                return;
            }
        }
        
        // Show loading
        loadingOverlay.classList.remove('hidden');
        
        // Submit form
        this.submit();
    });

    // Payment method toggle
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const bankSection = document.getElementById('userBankDetails');
            const proofSection = document.getElementById('paymentProofSection');
            
            if (this.value === 'Transfer') {
                bankSection.style.display = 'block';
                proofSection.style.display = 'block';
            } else {
                bankSection.style.display = 'none';
                proofSection.style.display = 'none';
            }
        });
    });

    // Initialize
    feather.replace();
</script>

<style>
    .mobile-btn {
        @apply px-4 py-3 rounded-lg font-medium text-sm transition-all duration-200 active:scale-95;
    }
</style>
