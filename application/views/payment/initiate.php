<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-600 py-4 px-6">
            <h2 class="text-2xl font-bold text-white">Pembayaran Kelas: <?= $class->nama_kelas ?></h2>
        </div>
        
        <div class="p-6">
            <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Detail Pembayaran</h3>
                <div class="flex justify-between">
                    <span class="text-gray-600">Harga Kelas:</span>
                    <span class="font-bold">Rp <?= number_format($class->harga, 0, ',', '.') ?></span>
                </div>
            </div>
            
            <?php if ($this->session->flashdata('error')): ?>
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                    <p><?= $this->session->flashdata('error') ?></p>
                </div>
            <?php endif; ?>
            
            <form action="<?= site_url('payment/process_payment/' . $class->id) ?>" method="POST">
                <!-- CSRF Token -->
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="payment_method">
                        Metode Pembayaran
                    </label>
                    <select name="payment_method" id="payment_method" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="Transfer">Transfer Bank</option>
                        <option value="Cash">Tunai</option>
                        <option value="Other">Lainnya</option>
                    </select>
                </div>

                <!-- Transfer Bank Instructions -->
                <div id="transfer-instructions" class="hidden mb-6">
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-blue-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">
                                    Instruksi Transfer Bank
                                </h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        <li>Pilih bank tujuan dari daftar di bawah</li>
                                        <li>Transfer sesuai nominal yang tertera</li>
                                        <li>Simpan bukti transfer untuk diupload nanti</li>
                                        <li>Upload bukti transfer setelah pembayaran berhasil</li>
                                    </ul>
                                </div>

                                <!-- Daftar Rekening Bank Perusahaan -->
                                <div class="mt-4">
                                    <h4 class="text-sm font-medium text-blue-800 mb-2">Rekening Bank Perusahaan:</h4>
                                    <div class="space-y-2">
                                        <?php foreach ($bank_accounts as $bank): ?>
                                            <div class="bg-white p-3 rounded border border-blue-200">
                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <p class="font-semibold text-gray-800"><?php echo $bank->bank_name; ?></p>
                                                        <p class="text-sm text-gray-600">No. Rek: <?php echo $bank->account_number; ?></p>
                                                        <p class="text-sm text-gray-600">a.n <?php echo $bank->account_holder; ?></p>
                                                    </div>
                                                    <button type="button" class="copy-account-btn bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm" data-account="<?php echo $bank->account_number; ?>">
                                                        <i class="fas fa-copy mr-1"></i>Salin
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <p class="text-xs text-blue-600 mt-2">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Klik tombol "Salin" untuk menyalin nomor rekening
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="bank_select">
                            Pilih Bank Tujuan
                        </label>
                        <select id="bank_select" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Bank</option>
                            <?php foreach ($bank_accounts as $bank): ?>
                            <option value="<?= $bank->id ?>" data-bank-name="<?= $bank->bank_name ?>" data-account-number="<?= $bank->account_number ?>" data-account-holder="<?= $bank->account_holder ?>">
                                <?= $bank->bank_name ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div id="account-info" class="hidden p-4 bg-green-50 border border-green-200 rounded-lg">
                        <h4 class="font-semibold text-green-800 mb-2">Rekening Tujuan:</h4>
                        <p class="text-green-700 font-mono text-lg" id="account-text"></p>
                        <p class="text-green-600 text-sm mt-1">
                            Pastikan transfer tepat sesuai nominal: <strong>Rp <?= number_format($class->harga, 0, ',', '.') ?></strong>
                        </p>
                    </div>

                    <!-- User bank details for transfer -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="user_bank_name">
                            Nama Bank Pengirim
                        </label>
                        <input type="text" name="user_bank_name" id="user_bank_name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: BCA, BRI, Mandiri">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="user_account_holder">
                            Nama Pemilik Rekening
                        </label>
                        <input type="text" name="user_account_holder" id="user_account_holder" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nama lengkap pemilik rekening">
                    </div>
                </div>

                <!-- Cash Instructions -->
                <div id="cash-instructions" class="hidden mb-6">
                    <div class="bg-green-50 border-l-4 border-green-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-money-bill-wave text-green-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-green-800">
                                    Instruksi Pembayaran Tunai
                                </h3>
                                <div class="mt-2 text-sm text-green-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        <li>Bayar langsung ke admin atau kasir</li>
                                        <li>Sebutkan nama kelas yang akan dibeli</li>
                                        <li>Minta tanda terima pembayaran</li>
                                        <li>Upload tanda terima sebagai bukti pembayaran</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Other Payment Instructions -->
                <div id="other-instructions" class="hidden mb-6">
                    <div class="bg-purple-50 border-l-4 border-purple-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-credit-card text-purple-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-purple-800">
                                    Metode Pembayaran Lain
                                </h3>
                                <div class="mt-2 text-sm text-purple-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        <li>E-wallet, kartu kredit, atau metode lainnya</li>
                                        <li>Pastikan pembayaran berhasil</li>
                                        <li>Simpan bukti pembayaran</li>
                                        <li>Upload bukti pembayaran setelah transaksi selesai</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="payment_description">
                        Catatan Pembayaran (Opsional)
                    </label>
                    <textarea name="payment_description" id="payment_description" rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tambahkan catatan atau keterangan pembayaran"></textarea>
                </div>

                <!-- Hidden fields populated via JS -->
                <input type="hidden" name="bank_name" id="bank_name">
                <input type="hidden" name="account_number" id="account_number">
                <input type="hidden" name="bank_account_id" id="bank_account_id">
                <input type="hidden" name="amount" value="<?= $class->harga ?>">

                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Buat Pesanan Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
(function(){
    const paymentMethod = document.getElementById('payment_method');
    const transferInstructions = document.getElementById('transfer-instructions');
    const cashInstructions = document.getElementById('cash-instructions');
    const otherInstructions = document.getElementById('other-instructions');
    const bankSelect = document.getElementById('bank_select');
    const bankNameInput = document.getElementById('bank_name');
    const accNumInput = document.getElementById('account_number');
    const accountInfo = document.getElementById('account-info');
    const accountText = document.getElementById('account-text');

    // Bank accounts data from database options
    const bankAccounts = {};
    <?php foreach ($bank_accounts as $bank): ?>
    bankAccounts[<?= $bank->id ?>] = {
        bank_name: '<?= $bank->bank_name ?>',
        account_number: '<?= $bank->account_number ?>',
        account_holder: '<?= $bank->account_holder ?>'
    };
    <?php endforeach; ?>

    function togglePaymentInstructions(){
        // Hide all instructions first
        transferInstructions.classList.add('hidden');
        cashInstructions.classList.add('hidden');
        otherInstructions.classList.add('hidden');

        // Show relevant instructions based on selected method
        if(paymentMethod.value === 'Transfer'){
            transferInstructions.classList.remove('hidden');
        } else if(paymentMethod.value === 'Cash'){
            cashInstructions.classList.remove('hidden');
        } else if(paymentMethod.value === 'Other'){
            otherInstructions.classList.remove('hidden');
        }

        // Reset bank details if not transfer
        if(paymentMethod.value !== 'Transfer'){
            bankSelect.value = '';
            accountInfo.classList.add('hidden');
            bankNameInput.value = '';
            accNumInput.value = '';
            document.getElementById('bank_account_id').value = '';
        }
    }

    paymentMethod.addEventListener('change', togglePaymentInstructions);
    togglePaymentInstructions();

    bankSelect.addEventListener('change', function(){
        const bankId = this.value;
        const bankAccount = bankAccounts[bankId];

        if(bankAccount){
            bankNameInput.value = bankAccount.bank_name;
            accNumInput.value = bankAccount.account_number;
            document.getElementById('bank_account_id').value = bankId;
            accountText.textContent = `${bankAccount.bank_name} - ${bankAccount.account_number} a.n ${bankAccount.account_holder}`;
            accountInfo.classList.remove('hidden');
        } else {
            accountInfo.classList.add('hidden');
            bankNameInput.value = '';
    }
})();

// Copy account number functionality
document.querySelectorAll('.copy-account-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const accountNumber = this.getAttribute('data-account');
        navigator.clipboard.writeText(accountNumber).then(() => {
            // Show success feedback
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check mr-1"></i>Tersalin!';
            this.classList.remove('bg-blue-500', 'hover:bg-blue-600');
            this.classList.add('bg-green-500', 'hover:bg-green-600');
            
            setTimeout(() => {
                this.innerHTML = originalText;
                this.classList.remove('bg-green-500', 'hover:bg-green-600');
                this.classList.add('bg-blue-500', 'hover:bg-blue-600');
            }, 2000);
        }).catch(err => {
            console.error('Failed to copy: ', err);
            alert('Gagal menyalin nomor rekening');
        });
    });
});
