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
            
            <form action="<?= site_url('payment/process/' . $class->id) ?>" method="POST" enctype="multipart/form-data">
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
                            <option value="BCA">Bank Central Asia (BCA)</option>
                            <option value="BRI">Bank Rakyat Indonesia (BRI)</option>
                            <option value="BNI">Bank Negara Indonesia (BNI)</option>
                            <option value="Mandiri">Bank Mandiri</option>
                            <option value="CIMB Niaga">CIMB Niaga</option>
                            <option value="BTN">Bank Tabungan Negara (BTN)</option>
                            <option value="Danamon">Bank Danamon</option>
                            <option value="Permata">Bank Permata</option>
                            <option value="Maybank">Maybank Indonesia</option>
                            <option value="OCBC NISP">OCBC NISP</option>
                            <option value="BSI">Bank Syariah Indonesia (BSI)</option>
                            <option value="BTPN">Bank BTPN</option>
                            <option value="BJB">Bank BJB</option>
                            <option value="Bukopin">Bank KB Bukopin</option>
                            <option value="Mega">Bank Mega</option>
                            <option value="Panin">Bank Panin</option>
                            <option value="Citibank">Citibank Indonesia</option>
                            <option value="DBS">Bank DBS Indonesia</option>
                            <option value="HSBC">HSBC Indonesia</option>
                        </select>
                    </div>

                    <div id="account-info" class="hidden p-4 bg-blue-50 rounded-lg text-gray-800">
                        <p class="text-sm">Silakan transfer ke rekening berikut:</p>
                        <p class="font-semibold mt-1" id="account-text"></p>
                    </div>

                    <!-- Hidden fields populated via JS so backend validation tetap jalan -->
                    <input type="hidden" name="bank_name" id="bank_name">
                    <input type="hidden" name="account_number" id="account_number">
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

    const accounts = {
        'BCA' : '1234567890',
        'BRI' : '0234567890',
        'BNI' : '3456789012',
        'Mandiri':'7890123456',
        'CIMB Niaga':'0145678901',
        'BTN':'2222333344',
        'Danamon':'5555666677',
        'Permata':'8888999900',
        'Maybank':'9911223344',
        'OCBC NISP':'7766554433',
        'BSI':'1100110011',
        'BTPN':'6677889900',
        'BJB':'1122334455',
        'Bukopin':'2233445566',
        'Mega':'3344556677',
        'Panin':'4455667788',
        'Citibank':'5566778899',
        'DBS':'6677889911',
        'HSBC':'7788990011'
    };

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
        const bank = this.value;
        if(bank && accounts[bank]){
            bankNameInput.value = bank;
            accNumInput.value = accounts[bank];
            accountText.textContent = `${bank} - ${accounts[bank]} a.n CV ASET MEDIA CEMERLANG`;
            accountInfo.classList.remove('hidden');
        } else {
            accountInfo.classList.add('hidden');
            bankNameInput.value='';
            accNumInput.value='';
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
