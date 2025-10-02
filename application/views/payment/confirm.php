<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-600 py-4 px-6">
            <h2 class="text-2xl font-bold text-white">Konfirmasi Pembayaran</h2>
        </div>
        
        <div class="p-6">
            <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Detail Kelas</h3>
                <div class="flex justify-between">
                    <span class="text-gray-600">Nama Kelas:</span>
                    <span class="font-bold"><?= $class->nama_kelas ?></span>
                </div>
                <div class="flex justify-between mt-2">
                    <span class="text-gray-600">Harga:</span>
                    <span class="font-bold">Rp <?= number_format($class->harga, 0, ',', '.') ?></span>
                </div>
            </div>

            <div class="mb-6 p-4 bg-green-50 rounded-lg">
                <h3 class="text-lg font-semibold text-green-800 mb-2">Detail Pembayaran</h3>
                <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-600">Metode Pembayaran:</span>
                    <span class="font-bold"><?= $payment_data['payment_method'] == 'Transfer' ? 'Transfer Bank' : 'Tunai' ?></span>
                </div>
                <?php if ($payment_data['payment_method'] == 'Transfer') { ?>
                <div class="flex justify-between">
                    <span class="text-gray-600">Bank Tujuan:</span>
                    <span class="font-bold"><?= $payment_data['bank_name'] ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Nomor Rekening:</span>
                    <span class="font-bold"><?= $payment_data['account_number'] ?></span>
                </div>
                <?php if (!empty($payment_data['user_bank_name'])) { ?>
                <div class="flex justify-between">
                    <span class="text-gray-600">Bank Pengirim:</span>
                    <span class="font-bold"><?= $payment_data['user_bank_name'] ?></span>
                </div>
                <?php } ?>
                <?php if (!empty($payment_data['user_account_holder'])) { ?>
                <div class="flex justify-between">
                    <span class="text-gray-600">Nama Pemilik Rekening:</span>
                    <span class="font-bold"><?= $payment_data['user_account_holder'] ?></span>
                </div>
                <?php } ?>
                <?php if (!empty($payment_data['payment_description'])) { ?>
                <div class="flex justify-between">
                    <span class="text-gray-600">Keterangan:</span>
                    <span class="font-bold"><?= $payment_data['payment_description'] ?></span>
                </div>
                <?php } ?>
                <?php } ?>
            </div>
            </div>

            <?php if ($payment_data['payment_method'] == 'Transfer') { ?>
            <div class="mb-6 p-4 bg-yellow-50 rounded-lg">
                <h3 class="text-lg font-semibold text-yellow-800 mb-2">Instruksi Transfer</h3>
                <ol class="list-decimal list-inside space-y-2 text-sm text-gray-700">
                    <li>Lakukan transfer ke rekening <?= $payment_data['bank_name'] ?>: <?= $payment_data['account_number'] ?></li>
                    <li>Transfer sesuai dengan jumlah: Rp <?= number_format($class->harga, 0, ',', '.') ?></li>
                    <li>Setelah transfer, unggah bukti pembayaran di form berikut</li>
                </ol>
            </div>
            <?php } ?>
            <form action="<?= site_url('payment/process/' . $class->id) ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <?php if ($payment_data['payment_method'] == 'Transfer') { ?>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="payment_proof">
                        Unggah Bukti Pembayaran
                    </label>
                    <input type="file" name="payment_proof" id="payment_proof" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, atau PDF (max 2MB)</p>
                </div>
                <?php } ?>

                <!-- Hidden fields to preserve payment data -->
                <input type="hidden" name="amount" value="<?= $payment_data['amount'] ?>">
                <input type="hidden" name="payment_method" value="<?= $payment_data['payment_method'] ?>">
                <input type="hidden" name="bank_name" value="<?= $payment_data['bank_name'] ?>">
                <input type="hidden" name="account_number" value="<?= $payment_data['account_number'] ?>">
                <input type="hidden" name="bank_account_id" value="<?= $payment_data['bank_account_id'] ?>">

                <div class="flex space-x-4 mt-6">
                    <a href="<?= site_url('payment/initiate/' . $class->id) ?>" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-4 rounded-lg text-center focus:outline-none focus:shadow-outline">
                        Kembali
                    </a>
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                        Konfirmasi Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>