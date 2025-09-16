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
            
            <form action="<?= site_url('payment/confirm/' . $class->id) ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="payment_method">
                        Metode Pembayaran
                    </label>
                    <select name="payment_method" id="payment_method" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="Transfer">Transfer Bank</option>
                        <option value="Cash">Tunai</option>
                    </select>
                </div>
                
                <div id="bank-details" class="hidden mb-4">
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

                    <div id="account-info" class="hidden p-4 bg-blue-50 rounded-lg text-gray-800">
                        <p class="text-sm">Silakan transfer ke rekening berikut:</p>
                        <p class="font-semibold mt-1" id="account-text"></p>
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

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="payment_description">
                            Keterangan Pembayaran
                        </label>
                        <textarea name="payment_description" id="payment_description" rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tambahkan catatan atau keterangan pembayaran (opsional)"></textarea>
                    </div>

                    <!-- Hidden fields populated via JS so backend validation tetap jalan -->
                    <input type="hidden" name="bank_name" id="bank_name">
                    <input type="hidden" name="account_number" id="account_number">
                    <input type="hidden" name="bank_account_id" id="bank_account_id">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="payment_proof">
                        Bukti Pembayaran (untuk transfer)
                    </label>
                    <input type="file" name="payment_proof" id="payment_proof" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, atau PDF (max 2MB)</p>
                </div>
                
                <input type="hidden" name="amount" value="<?= $class->harga ?>">
                
                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                        Ajukan Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
(function(){
    const paymentMethod = document.getElementById('payment_method');
    const bankDetails   = document.getElementById('bank-details');
    const bankSelect    = document.getElementById('bank_select');
    const bankNameInput = document.getElementById('bank_name');
    const accNumInput   = document.getElementById('account_number');
    const accountInfo   = document.getElementById('account-info');
    const accountText   = document.getElementById('account-text');

    // Bank accounts data from database options
    const bankAccounts = {};
    <?php foreach ($bank_accounts as $bank): ?>
    bankAccounts[<?= $bank->id ?>] = {
        bank_name: '<?= $bank->bank_name ?>',
        account_number: '<?= $bank->account_number ?>',
        account_holder: '<?= $bank->account_holder ?>'
    };
    <?php endforeach; ?>

    function toggleBankDetails(){
        if(paymentMethod.value === 'Transfer'){
            bankDetails.classList.remove('hidden');
        }else{
            bankDetails.classList.add('hidden');
            // reset
            bankSelect.value = '';
            accountInfo.classList.add('hidden');
            bankNameInput.value='';
            accNumInput.value='';
        }
    }

    paymentMethod.addEventListener('change', toggleBankDetails);
    toggleBankDetails();

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
            bankNameInput.value='';
            accNumInput.value='';
            document.getElementById('bank_account_id').value='';
        }
    });
})();
</script>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
(function(){
    const form = document.querySelector('form[action^="<?= site_url('payment/process/') ?>"]');
    if(!form) return;

    form.addEventListener('submit', function(e){
        e.preventDefault();
        const formData = new FormData(form);
        Swal.fire({
            title: 'Mengirim Bukti Pembayaran...',
            html: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch(form.getAttribute('action'), {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(r => r.json())
        .then(res => {
            if(res.success){
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Dikirim',
                    text: 'Pembayaran berhasil diajukan. Menunggu verifikasi admin.'
                }).then(()=>{
                    window.location.href = res.redirect;
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: res.message || 'Terjadi kesalahan. Coba lagi.'
                });
            }
        }).catch(() => {
            Swal.fire({ icon:'error', title:'Gagal', text:'Terjadi kesalahan jaringan.' });
        });
    });
})();
</script>
