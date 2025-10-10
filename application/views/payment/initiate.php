<?php 
$maintenance_mode = get_setting('midtrans_maintenance_mode', 0);
$maintenance_message = get_setting('midtrans_maintenance_message', 'Pembayaran sedang dalam perbaikan. Silakan coba lagi nanti.');
?>

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50">
    <?php if ($maintenance_mode == 1): ?>
    <!-- Maintenance Banner -->
    <div class="bg-yellow-500 text-white py-3 px-4 text-center">
        <div class="container mx-auto flex items-center justify-center">
            <i class="fas fa-tools text-xl mr-2"></i>
            <span class="font-medium"><?php echo $maintenance_message; ?></span>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 rounded-full mb-6">
                <i class="fas fa-credit-card text-4xl"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Pembayaran Kelas Premium</h1>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto">Lengkapi informasi pembayaran untuk mengakses kelas premium berkualitas tinggi</p>
        </div>
    </div>

    <!-- Progress Steps -->
    <div class="container mx-auto px-4 -mt-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center bg-blue-600 text-white rounded-full px-4 py-2">
                        <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-shopping-cart text-sm"></i>
                        </div>
                        <span class="font-medium">Pilih Kelas</span>
                    </div>
                    <div class="flex-1 h-0.5 bg-blue-600 mx-4"></div>
                    <div class="flex items-center bg-blue-600 text-white rounded-full px-4 py-2">
                        <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-money-bill-wave text-sm"></i>
                        </div>
                        <span class="font-medium">Pembayaran</span>
                    </div>
                    <div class="flex-1 h-0.5 bg-gray-300 mx-4"></div>
                    <div class="flex items-center bg-gray-300 text-gray-600 rounded-full px-4 py-2">
                        <div class="w-8 h-8 bg-gray-400 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check-circle text-sm"></i>
                        </div>
                        <span class="font-medium">Selesai</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 pb-16">
        <div class="max-w-6xl mx-auto grid lg:grid-cols-3 gap-8">

            <!-- Main Payment Form -->
            <div class="lg:col-span-2 space-y-6 relative">
                    <?php if ($maintenance_mode): ?>
                    <div class="absolute inset-0 bg-white bg-opacity-70 z-10 flex items-center justify-center rounded-xl">
                        <div class="text-center p-6 max-w-md">
                            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-tools text-yellow-600 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Pembayaran Sementara Tidak Tersedia</h3>
                            <p class="text-gray-600 mb-4"><?php echo $maintenance_message; ?></p>
                            <a href="<?php echo site_url('kelas'); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Kelas
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                <!-- Payment Method Selection -->
                <div class="bg-white rounded-xl shadow-lg p-6 <?php echo $maintenance_mode ? 'opacity-75 pointer-events-none' : ''; ?>">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-wallet text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Metode Pembayaran</h2>
                            <p class="text-gray-600">Pilih metode pembayaran yang Anda inginkan</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="flex items-center p-4 border-2 border-blue-500 bg-blue-50 rounded-xl cursor-pointer">
                            <input type="radio" name="payment_method_display" value="Transfer" class="text-blue-600 mr-4" checked>
                            <div class="flex items-center flex-1">
                                <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-university text-white text-lg"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Transfer Bank</div>
                                    <div class="text-sm text-gray-600">Transfer ke rekening bank perusahaan</div>
                                </div>
                            </div>
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </label>

                        <label class="flex items-center p-4 border-2 <?php echo $maintenance_mode ? 'border-gray-300 bg-gray-50' : 'border-green-500 bg-green-50'; ?> rounded-xl <?php echo $maintenance_mode ? 'cursor-not-allowed' : 'cursor-pointer'; ?>">
                            <input type="radio" name="payment_method_display" value="Midtrans" class="<?php echo $maintenance_mode ? 'text-gray-400' : 'text-green-600'; ?> mr-4" <?php echo $maintenance_mode ? 'disabled' : ''; ?>>
                            <div class="flex items-center flex-1">
                                <div class="w-12 h-12 <?php echo $maintenance_mode ? 'bg-gray-400' : 'bg-green-600'; ?> rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-credit-card text-white text-lg"></i>
                                </div>
                                <div>
                                    <div class="font-semibold <?php echo $maintenance_mode ? 'text-gray-500' : 'text-gray-900'; ?>">
                                        Midtrans Payment Gateway
                                        <?php if ($maintenance_mode): ?>
                                            <span class="ml-2 text-sm font-normal text-yellow-600">(Sementara Tidak Tersedia)</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="text-sm <?php echo $maintenance_mode ? 'text-gray-400' : 'text-gray-600'; ?>">
                                        Bayar dengan kartu kredit, GoPay, ShopeePay, dan lainnya
                                    </div>
                                </div>
                            </div>
                            <i class="fas fa-check-circle text-green-600 text-xl hidden"></i>
                        </label>
                    </div>
                </div>

                <!-- Bank Selection -->
                <div class="bg-white rounded-xl shadow-lg p-6" id="bank-selection-section">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-piggy-bank text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Pilih Rekening Tujuan</h3>
                            <p class="text-gray-600">Klik pada rekening bank yang akan menjadi tujuan transfer</p>
                        </div>
                    </div>

                    <div class="grid gap-4 mb-6">
                        <?php
                        $first_bank = !empty($bank_accounts) ? $bank_accounts[0] : null;
                        foreach ($bank_accounts as $index => $bank):
                        ?>
                            <div class="bank-card bg-white p-5 rounded-xl border-2 border-gray-200 hover:border-blue-300 cursor-pointer transition-all duration-300 relative"
                                 data-bank-id="<?= $bank->id ?>"
                                 data-bank-name="<?= $bank->bank_name ?>"
                                 data-account-number="<?= $bank->account_number ?>"
                                 data-account-holder="<?= $bank->account_holder ?>"
                                 data-selected="<?= $index === 0 ? 'true' : 'false' ?>">

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-university text-blue-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 text-lg"><?= $bank->bank_name ?></h4>
                                            <p class="text-gray-600 font-mono">No. Rek: <?= $bank->account_number ?></p>
                                            <p class="text-sm text-gray-500">a.n <?= $bank->account_holder ?></p>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-3">
                                        <button type="button" class="copy-btn opacity-0 group-hover:opacity-100 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200" data-account="<?= $bank->account_number ?>">
                                            <i class="fas fa-copy mr-2"></i>Salin
                                        </button>
                                        <div class="w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center">
                                            <div class="w-3 h-3 bg-blue-600 rounded-full bank-indicator <?= $index === 0 ? '' : 'hidden' ?>"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Selected overlay -->
                                <div class="absolute inset-0 bg-blue-500 bg-opacity-5 rounded-xl bank-overlay <?= $index === 0 ? '' : 'hidden' ?> pointer-events-none transition-opacity duration-300"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Account Info Display -->
                    <div class="account-info-display p-4 bg-green-50 border border-green-200 rounded-xl">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-green-600 text-xl mr-3"></i>
                            <div>
                                <div class="font-semibold text-green-800">Rekening Tujuan Terpilih:</div>
                                <div class="text-green-700 font-mono text-lg account-details">
                                    <?php if ($first_bank): ?>
                                        <?= $first_bank->bank_name ?> - <?= $first_bank->account_number ?> a.n <?= $first_bank->account_holder ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Midtrans Payment Section -->
                <div class="bg-white rounded-xl shadow-lg p-6 hidden" id="midtrans-section">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-credit-card text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Pembayaran Midtrans</h3>
                            <p class="text-gray-600">Pilih metode pembayaran digital yang tersedia</p>
                        </div>
                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-green-600 mr-3"></i>
                            <div>
                                <p class="text-green-800 font-medium">Metode Pembayaran Tersedia</p>
                                <p class="text-green-700 text-sm">Kartu Kredit, GoPay, ShopeePay, BCA VA, BNI VA, BRI VA, dan lainnya</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="flex items-center justify-center p-4 bg-white border border-gray-200 rounded-lg">
                            <i class="fas fa-credit-card text-2xl text-blue-600"></i>
                        </div>
                        <div class="flex items-center justify-center p-4 bg-white border border-gray-200 rounded-lg">
                            <img src="https://static-src.vocagame.com/gopay/GoPay-Logogram_Blue-1056d-original.png" alt="GoPay" class="h-8">
                        </div>
                        <div class="flex items-center justify-center p-4 bg-white border border-gray-200 rounded-lg">
                            <img src="https://tokpee.co/blog/wp-content/uploads/2025/03/Begini-Cara-Membagikan-Kode-QR-ShopeePay-Biar-Uang-Langsung-Masuk-512x269.webp" alt="ShopeePay" class="h-8">
                        </div>
                        <div class="flex items-center justify-center p-4 bg-white border border-gray-200 rounded-lg">
                            <span class="text-sm font-medium text-gray-600">VA Bank</span>
                        </div>
                    </div>

                    <!-- Midtrans Submit Button -->
                    <button type="button"
                            id="midtrans-submit-btn"
                            class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-4 px-6 rounded-xl text-lg shadow-lg transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-credit-card mr-3"></i>
                        <span>Bayar dengan Midtrans</span>
                    </button>

                    <p class="text-sm text-gray-500 text-center mt-4">
                        <i class="fas fa-shield-alt mr-1"></i>
                        Pembayaran dijamin aman dengan teknologi enkripsi Midtrans
                    </p>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-6" id="user-info-section">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-user-edit text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Informasi Pembayaran</h3>
                            <p class="text-gray-600">Lengkapi informasi rekening pengirim</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Bank Pengirim <span class="text-red-500">*</span>
                            </label>
                            <select id="user_bank_name"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                <option value="">Pilih Bank Pengirim</option>
                                <?php foreach ($sender_banks as $bank): ?>
                                    <option value="<?= $bank->nama_bank ?>" data-kode="<?= $bank->kode_bank ?>">
                                        <?= $bank->nama_bank ?> (<?= $bank->kode_bank ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Pemilik Rekening <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="user_account_holder"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                   placeholder="Nama lengkap pemilik rekening"
                                   required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Catatan Pembayaran (Opsional)
                        </label>
                        <textarea id="payment_description"
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                                  placeholder="Tambahkan catatan khusus atau informasi tambahan untuk pembayaran ini"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="button"
                            id="submit-btn"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 disabled:from-gray-400 disabled:to-gray-500 text-white font-bold py-4 px-6 rounded-xl text-lg shadow-lg disabled:shadow-none transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-paper-plane mr-3"></i>
                        <span>Lengkapi Data Terlebih Dahulu</span>
                    </button>

                    <p class="text-sm text-gray-500 text-center mt-4">
                        <i class="fas fa-shield-alt mr-1"></i>
                        Pembayaran Anda aman dan terlindungi
                    </p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">

                <!-- Class Summary -->
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-graduation-cap text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Ringkasan Kelas</h3>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-code text-white text-xl"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="font-bold text-gray-900 text-lg leading-tight"><?= $class->nama_kelas ?></h4>
                                <p class="text-blue-600 font-medium">Kelas Premium</p>
                                <div class="flex items-center mt-1">
                                    <div class="flex text-yellow-400">
                                        <?php for($i = 0; $i < 5; $i++): ?>
                                            <i class="fas fa-star text-sm"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="text-sm text-gray-600 ml-2">(4.8)</span>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4 space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">Harga Kelas</span>
                                <span class="font-semibold">Rp <?= number_format($class->harga, 0, ',', '.') ?></span>
                            </div>

                            <?php if (isset($class->diskon) && $class->diskon > 0): ?>
                                <div class="flex justify-between items-center text-green-600 text-sm">
                                    <span>Diskon (<?= $class->diskon ?>%)</span>
                                    <span>- Rp <?= number_format($class->harga * $class->diskon / 100, 0, ',', '.') ?></span>
                                </div>
                                <div class="border-t border-gray-200 pt-3">
                                    <div class="flex justify-between items-center text-lg font-bold text-blue-600">
                                        <span>Total Pembayaran</span>
                                        <span>Rp <?= number_format($class->harga - ($class->harga * $class->diskon / 100), 0, ',', '.') ?></span>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="border-t border-gray-200 pt-3">
                                    <div class="flex justify-between items-center text-lg font-bold text-blue-600">
                                        <span>Total Pembayaran</span>
                                        <span>Rp <?= number_format($class->harga, 0, ',', '.') ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Payment Instructions -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-question-circle text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-bold text-blue-900">Panduan Pembayaran</h3>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">1</div>
                            <div>
                                <p class="text-blue-800 font-medium">Pilih Rekening</p>
                                <p class="text-sm text-blue-700">Klik pada kartu bank tujuan transfer</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">2</div>
                            <div>
                                <p class="text-blue-800 font-medium">Isi Data Pengirim</p>
                                <p class="text-sm text-blue-700">Lengkapi nama bank dan pemilik rekening</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">3</div>
                            <div>
                                <p class="text-blue-800 font-medium">Transfer Dana</p>
                                <p class="text-sm text-blue-700">Transfer sesuai nominal yang tertera</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">4</div>
                            <div>
                                <p class="text-blue-800 font-medium">Upload Bukti</p>
                                <p class="text-sm text-blue-700">Upload bukti transfer untuk verifikasi</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-yellow-600 mr-3"></i>
                            <div>
                                <p class="text-yellow-800 font-medium text-sm">Penting!</p>
                                <p class="text-yellow-700 text-sm">Pastikan transfer tepat sesuai nominal untuk mempercepat verifikasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Form for Submission -->
<form id="payment-form" action="<?php echo site_url('payment/process_payment/' . $class->id); ?>" method="POST" class="hidden">
    <!-- CSRF Token -->
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

    <!-- Hidden fields populated by JavaScript -->
    <input type="hidden" name="payment_method" value="Transfer">
    <input type="hidden" name="bank_account_id" id="hidden_bank_account_id">
    <input type="hidden" name="bank_name" id="hidden_bank_name">
    <input type="hidden" name="account_number" id="hidden_account_number">
    <input type="hidden" name="amount" value="<?= $class->harga ?>">

    <!-- User inputs -->
    <input type="hidden" name="user_bank_name" id="hidden_user_bank_name">
    <input type="hidden" name="user_account_holder" id="hidden_user_account_holder">
    <input type="hidden" name="payment_description" id="hidden_payment_description">
</form>

<!-- Midtrans Snap JS -->
<script src="<?php echo $midtrans_config['is_production'] ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js'; ?>" data-client-key="<?php echo $midtrans_config['client_key']; ?>"></script>

<style>
.bank-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.bank-card.selected {
    border-color: #3b82f6;
    background-color: #eff6ff;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
}

.bank-card:hover {
    border-color: #93c5fd;
    transform: translateY(-2px);
}

.copy-btn {
    transition: all 0.2s ease;
}

.submit-btn {
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.submit-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, #2563eb, #1e40af);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
}

.submit-btn:disabled {
    background: #9ca3af;
    cursor: not-allowed;
    transform: none;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}
</style>

<script>
// Modern Payment Form JavaScript
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎯 Modern Payment Form Initialized');
    
    // Disable all form elements if in maintenance mode
    const maintenanceMode = <?php echo $maintenance_mode ? 'true' : 'false'; ?>;
    if (maintenanceMode) {
        const formElements = document.querySelectorAll('input, select, button, .bank-card, .payment-method');
        formElements.forEach(el => {
            if (!el.classList.contains('back-button')) { // Don't disable back button
                el.disabled = true;
            }
        });
    }

    // DOM Elements
    const bankCards = document.querySelectorAll('.bank-card');
    const submitBtn = document.getElementById('submit-btn');
    const midtransSubmitBtn = document.getElementById('midtrans-submit-btn');
    const accountDetails = document.querySelector('.account-details');
    const bankSelectionSection = document.getElementById('bank-selection-section');
    const midtransSection = document.getElementById('midtrans-section');
    const userInfoSection = document.getElementById('user-info-section');

    // Payment method radios
    const paymentMethodRadios = document.querySelectorAll('input[name="payment_method_display"]');

    // Bank accounts data
    const bankAccounts = {};
    <?php foreach ($bank_accounts as $bank): ?>
    bankAccounts[<?= $bank->id ?>] = {
        bank_name: '<?= $bank->bank_name ?>',
        account_number: '<?= $bank->account_number ?>',
        account_holder: '<?= $bank->account_holder ?>'
    };
    <?php endforeach; ?>

    // Initialize first bank as selected
    const firstBankCard = document.querySelector('.bank-card[data-selected="true"]');
    if (firstBankCard) {
        selectBankCard(firstBankCard);
    }

    // Payment method switching
    paymentMethodRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            const method = this.value;

            // Update visual indicators
            document.querySelectorAll('input[name="payment_method_display"]').forEach(r => {
                const label = r.closest('label');
                const checkIcon = label.querySelector('.fas.fa-check-circle');
                if (r === this) {
                    checkIcon.classList.remove('hidden');
                    label.classList.add('border-green-500', 'bg-green-50');
                    label.classList.remove('border-blue-500', 'bg-blue-50');
                } else {
                    checkIcon.classList.add('hidden');
                    label.classList.remove('border-green-500', 'bg-green-50');
                    label.classList.add('border-gray-200', 'bg-white');
                }
            });

            if (method === 'Transfer') {
                bankSelectionSection.classList.remove('hidden');
                userInfoSection.classList.remove('hidden');
                midtransSection.classList.add('hidden');
                submitBtn.style.display = 'flex';
                midtransSubmitBtn.style.display = 'none';
            } else if (method === 'Midtrans') {
                bankSelectionSection.classList.add('hidden');
                userInfoSection.classList.add('hidden');
                midtransSection.classList.remove('hidden');
                submitBtn.style.display = 'none';
                midtransSubmitBtn.style.display = 'flex';
            }
        });
    });

    // Bank Card Selection
    function selectBankCard(cardElement) {
        console.log('🏦 Bank selected:', cardElement.dataset.bankId);

        // Remove selected state from all cards
        document.querySelectorAll('.bank-card').forEach(card => {
            card.classList.remove('selected');
            card.querySelector('.bank-indicator').classList.add('hidden');
            card.querySelector('.bank-overlay').classList.add('hidden');
        });

        // Add selected state to clicked card
        cardElement.classList.add('selected');
        cardElement.querySelector('.bank-indicator').classList.remove('hidden');
        cardElement.querySelector('.bank-overlay').classList.remove('hidden');

        // Update account info display
        const bankId = cardElement.dataset.bankId;
        const bankAccount = bankAccounts[bankId];

        if (bankAccount && accountDetails) {
            accountDetails.textContent = `${bankAccount.bank_name} - ${bankAccount.account_number} a.n ${bankAccount.account_holder}`;

            // Populate hidden form fields
            document.getElementById('hidden_bank_account_id').value = bankId;
            document.getElementById('hidden_bank_name').value = bankAccount.bank_name;
            document.getElementById('hidden_account_number').value = bankAccount.account_number;
        }

        // Update submit button state
        updateSubmitButton();
    }

    // Add click handlers to bank cards
    bankCards.forEach(card => {
        card.addEventListener('click', function() {
            selectBankCard(this);
        });
    });

    // Midtrans payment handler
    midtransSubmitBtn.addEventListener('click', async function(e) {
        e.preventDefault();

        midtransSubmitBtn.disabled = true;
        midtransSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i><span>Mempersiapkan pembayaran...</span>';

        try {
            const formData = new FormData();
            formData.append('payment_method', 'Midtrans');
            formData.append('amount', '<?= $class->harga ?>');
            formData.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');

            const response = await fetch('<?php echo site_url('payment/process_payment/' . $class->id); ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: formData
            });

            const data = await response.json();

            if (data.success && data.token) {
                // Store order_id for use in callbacks
                const orderId = data.order_id;

                // Open Midtrans Snap
                if (window.snap) {
                    window.snap.pay(data.token, {
                        onSuccess: function(result) {
                            console.log('Success:', result);
                            window.location.href = '<?php echo site_url('midtrans_public/success'); ?>?order_id=' + result.order_id;
                        },
                        onPending: function(result) {
                            console.log('Pending:', result);
                            window.location.href = '<?php echo site_url('midtrans_public/success'); ?>?order_id=' + result.order_id;
                        },
                        onError: function(result) {
                            console.error('Error:', result);
                            showErrorToast('Pembayaran gagal. Silakan coba lagi.');
                            midtransSubmitBtn.disabled = false;
                            midtransSubmitBtn.innerHTML = '<i class="fas fa-credit-card mr-3"></i><span>Bayar dengan Midtrans</span>';
                        },
                        onClose: function() {
                            console.log('Snap modal closed');
                            midtransSubmitBtn.disabled = false;
                            midtransSubmitBtn.innerHTML = '<i class="fas fa-credit-card mr-3"></i><span>Bayar dengan Midtrans</span>';

                            // Extract payment_id from order_id (format: PAY-{payment_id}-{timestamp})
                            let paymentId = null;
                            if (orderId) {
                                const orderParts = orderId.split('-');
                                if (orderParts.length >= 2 && orderParts[0] === 'PAY') {
                                    paymentId = orderParts[1];
                                }
                            }

                            // Redirect to payment status page if we have payment_id, otherwise to orders
                            if (paymentId) {
                                // Redirect to payment status page with the extracted payment_id
                                window.location.href = '<?php echo site_url('payment/status'); ?>/' + paymentId;
                            } else {
                                window.location.href = '<?php echo site_url('student/orders'); ?>';
                            }
                        }
                    });
                } else {
                    showErrorToast('Midtrans tidak dapat dimuat. Silakan refresh halaman.');
                    midtransSubmitBtn.disabled = false;
                    midtransSubmitBtn.innerHTML = '<i class="fas fa-credit-card mr-3"></i><span>Bayar dengan Midtrans</span>';
                }
            } else {
                showErrorToast(data.error || 'Gagal memproses pembayaran.');
                midtransSubmitBtn.disabled = false;
                midtransSubmitBtn.innerHTML = '<i class="fas fa-credit-card mr-3"></i><span>Bayar dengan Midtrans</span>';
            }
        } catch (error) {
            console.error('Error:', error);
            showErrorToast('Terjadi kesalahan atau sedang dalam perbaikan sistem. Silakan coba lagi.');
            midtransSubmitBtn.disabled = false;
            midtransSubmitBtn.innerHTML = '<i class="fas fa-credit-card mr-3"></i><span>Bayar dengan Midtrans</span>';
        }
    });

    // Copy account number functionality
    document.querySelectorAll('.copy-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const accountNumber = this.dataset.account;

            navigator.clipboard.writeText(accountNumber).then(() => {
                const originalHTML = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check mr-2"></i>Tersalin!';
                this.classList.remove('bg-green-500', 'hover:bg-green-600');
                this.classList.add('bg-green-700');

                setTimeout(() => {
                    this.innerHTML = originalHTML;
                    this.classList.remove('bg-green-700');
                    this.classList.add('bg-green-500', 'hover:bg-green-600');
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy:', err);
                alert('Gagal menyalin nomor rekening');
            });
        });
    });

    // Form validation and submit button state
    function updateSubmitButton() {
        const bankAccountId = document.getElementById('hidden_bank_account_id').value;
        const userBankName = document.getElementById('user_bank_name').value.trim();
        const userAccountHolder = document.getElementById('user_account_holder').value.trim();

        const isComplete = bankAccountId && userBankName && userAccountHolder;

        submitBtn.disabled = !isComplete;

        if (isComplete) {
            submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-3"></i><span>Buat Pesanan Pembayaran</span><i class="fas fa-arrow-right ml-3"></i>';
        } else {
            submitBtn.innerHTML = '<i class="fas fa-clock mr-3"></i><span>Lengkapi Data Terlebih Dahulu</span>';
        }
    }

    // Real-time form updates
    document.getElementById('user_bank_name').addEventListener('change', function() {
        document.getElementById('hidden_user_bank_name').value = this.value;
        updateSubmitButton();
    });

    document.getElementById('user_account_holder').addEventListener('input', function() {
        document.getElementById('hidden_user_account_holder').value = this.value;
        updateSubmitButton();
    });

    document.getElementById('payment_description').addEventListener('input', function() {
        document.getElementById('hidden_payment_description').value = this.value;
    });

    // Form submission
    submitBtn.addEventListener('click', function(e) {
        e.preventDefault();

        const bankAccountId = document.getElementById('hidden_bank_account_id').value;
        const userBankName = document.getElementById('user_bank_name').value.trim();
        const userAccountHolder = document.getElementById('user_account_holder').value.trim();

        // Validation
        let errors = [];
        if (!bankAccountId) errors.push('Silakan pilih rekening tujuan transfer');
        if (!userBankName) errors.push('Silakan isi nama bank pengirim');
        if (!userAccountHolder) errors.push('Silakan isi nama pemilik rekening');

        if (errors.length > 0) {
            // Show modern error toast
            showErrorToast(errors.join('<br>'));
            return;
        }

        // Submit the hidden form
        document.getElementById('payment-form').submit();
    });

    // Error display function
    function showErrorToast(message) {
        // Create error toast
        const toastDiv = document.createElement('div');
        toastDiv.className = 'fixed top-4 right-4 z-50 max-w-sm animate-fade-in-up';
        toastDiv.innerHTML = `
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-lg">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-circle text-red-600 mr-3 mt-0.5"></i>
                    <div class="flex-1">
                        <h4 class="font-semibold text-red-800 text-sm">Perhatian!</h4>
                        <p class="text-red-700 text-sm mt-1">${message}</p>
                    </div>
                    <button class="text-red-600 hover:text-red-800 ml-3 flex-shrink-0" onclick="this.parentElement.parentElement.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        `;

        document.body.appendChild(toastDiv);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (toastDiv.parentElement) {
                toastDiv.remove();
            }
        }, 5000);
    }

    // Initial button state
    updateSubmitButton();

    console.log('✅ Payment form ready');
});
</script>
