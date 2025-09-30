<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="flex items-center justify-between px-4 py-3">
            <div class="flex items-center">
                <button onclick="window.history.back()" class="p-2 rounded-full hover:bg-gray-100">
                    <i data-feather="arrow-left" class="w-5 h-5 text-gray-600"></i>
                </button>
                <h1 class="ml-3 text-lg font-bold text-gray-900">Upload Bukti Pembayaran</h1>
            </div>
        </div>
    </div>

    <!-- Payment Info Card -->
    <div class="bg-white mx-4 mt-4 rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h3 class="font-bold text-gray-900"><?php echo $class->nama_kelas; ?></h3>
                    <p class="text-sm text-gray-500"><?php echo $class->bahasa_program; ?> • <?php echo $class->level; ?></p>
                </div>
                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Menunggu</span>
            </div>

            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-gray-600">Total Pembayaran</span>
                <span class="font-bold text-gray-900">Rp <?php echo number_format($payment->amount, 0, ',', '.'); ?></span>
            </div>

            <div class="flex items-center justify-between text-xs text-gray-500">
                <span>No. Invoice</span>
                <span><?php echo $payment->invoice_number; ?></span>
            </div>
        </div>
    </div>

    <!-- Upload Form -->
    <div class="mx-4 mt-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h4 class="text-lg font-bold text-gray-900 mb-4">Upload Bukti Pembayaran</h4>

            <?php if ($this->session->flashdata('success')): ?>
                <div class="mb-4 p-4 rounded-lg bg-green-50 border-l-4 border-green-500 flex items-center">
                    <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-3"></i>
                    <span class="text-green-700"><?php echo $this->session->flashdata('success'); ?></span>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="mb-4 p-4 rounded-lg bg-red-50 border-l-4 border-red-500 flex items-center">
                    <i data-feather="alert-circle" class="w-5 h-5 text-red-600 mr-3"></i>
                    <span class="text-red-700"><?php echo $this->session->flashdata('error'); ?></span>
                </div>
            <?php endif; ?>

            <form id="uploadForm" action="<?php echo site_url('payment/process_payment_proof_upload/' . $payment->id); ?>" method="post" enctype="multipart/form-data">
                <!-- Current Payment Proof -->
                <?php if (!empty($payment->payment_proof)): ?>
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-3"></i>
                            <div>
                                <p class="font-medium text-green-800">Bukti pembayaran sudah diupload</p>
                                <p class="text-sm text-green-600">Mohon tunggu verifikasi dari admin</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- File Upload Section -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih File Bukti Pembayaran</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition-colors">
                        <i data-feather="upload-cloud" class="w-12 h-12 text-gray-400 mx-auto mb-2"></i>
                        <p class="text-sm text-gray-600 mb-2">Upload bukti transfer bank</p>
                        <input type="file" name="payment_proof" id="paymentProof" accept="image/*,.pdf" class="hidden" required>
                        <button type="button" onclick="document.getElementById('paymentProof').click()" class="inline-flex items-center px-4 py-2 border border-blue-500 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors">
                            <i data-feather="camera" class="w-4 h-4 mr-2"></i>
                            Pilih File
                        </button>
                        <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, PDF (max 2MB)</p>
                    </div>

                    <!-- File Preview -->
                    <div id="filePreview" class="mt-4 hidden">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i data-feather="file" class="w-5 h-5 text-gray-600 mr-3"></i>
                                    <div>
                                        <p class="font-medium text-gray-900" id="fileName"></p>
                                        <p class="text-sm text-gray-500" id="fileSize"></p>
                                    </div>
                                </div>
                                <button type="button" onclick="clearFile()" class="text-red-500 hover:text-red-700">
                                    <i data-feather="x" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upload Button -->
                <div class="flex space-x-3">
                    <button type="button" onclick="window.history.back()" class="flex-1 mobile-btn bg-gray-100 text-gray-700">
                        <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                        Kembali
                    </button>
                    <button type="submit" class="flex-1 mobile-btn bg-blue-600 text-white">
                        <i data-feather="upload" class="w-4 h-4 mr-2"></i>
                        Upload Bukti
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Instructions -->
    <div class="mx-4 mt-4 mb-8">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex">
                <i data-feather="info" class="w-5 h-5 text-blue-600 mr-3 mt-0.5"></i>
                <div>
                    <h5 class="font-medium text-blue-900 mb-2">Petunjuk Upload Bukti Pembayaran</h5>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• Pastikan foto/scan bukti transfer jelas terlihat</li>
                        <li>• Format yang didukung: JPG, PNG, PDF</li>
                        <li>• Ukuran maksimal: 2MB</li>
                        <li>• Tunggu verifikasi dari admin setelah upload</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 text-center">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto"></div>
        <p class="mt-2 text-sm text-gray-600">Mengupload bukti pembayaran...</p>
    </div>
</div>

<script>
    // File selection and preview
    document.getElementById('paymentProof').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const fileName = file.name;
            const fileSize = formatFileSize(file.size);

            document.getElementById('fileName').textContent = fileName;
            document.getElementById('fileSize').textContent = fileSize;
            document.getElementById('filePreview').classList.remove('hidden');
        } else {
            clearFile();
        }
    });

    function clearFile() {
        document.getElementById('paymentProof').value = '';
        document.getElementById('filePreview').classList.add('hidden');
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Form submission
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const fileInput = document.getElementById('paymentProof');
        if (!fileInput.files[0]) {
            alert('Mohon pilih file bukti pembayaran terlebih dahulu');
            return;
        }

        // Validate file size (2MB max)
        if (fileInput.files[0].size > 2 * 1024 * 1024) {
            alert('Ukuran file maksimal 2MB');
            return;
        }

        const loadingOverlay = document.getElementById('loadingOverlay');
        loadingOverlay.classList.remove('hidden');

        // Submit form
        this.submit();
    });

    // Initialize Feather icons
    feather.replace();
</script>

<style>
    .mobile-btn {
        @apply px-4 py-3 rounded-lg font-medium text-sm transition-all duration-200 active:scale-95;
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
