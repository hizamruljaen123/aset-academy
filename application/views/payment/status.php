<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="py-4 px-6 <?= 
            $payment->status == 'Verified' ? 'bg-green-600' : 
            ($payment->status == 'Rejected' ? 'bg-red-600' : 'bg-yellow-600') 
        ?>">
            <h2 class="text-2xl font-bold text-white">Status Pembayaran</h2>
        </div>
        
        <div class="p-6">
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Detail Pembayaran</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Kelas:</p>
                        <p class="font-bold"><?= $class->nama_kelas ?></p>
                    </div>
                    
                    <div>
                        <p class="text-gray-600">Jumlah:</p>
                        <p class="font-bold">Rp <?= number_format($payment->amount, 0, ',', '.') ?></p>
                    </div>
                    
                    <div>
                        <p class="text-gray-600">Metode Pembayaran:</p>
                        <p class="font-bold"><?= $payment->payment_method ?></p>
                    </div>
                    
                    <div>
                        <p class="text-gray-600">Status:</p>
                        <p class="font-bold">
                            <span class="px-2 py-1 rounded-full text-sm <?= 
                                $payment->status == 'Verified' ? 'bg-green-100 text-green-800' : 
                                ($payment->status == 'Rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')
                            ?>">
                                <?= $payment->status == 'Verified' ? 'Terverifikasi' : 
                                   ($payment->status == 'Rejected' ? 'Ditolak' : 'Menunggu Verifikasi') ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            
            <?php if ($payment->payment_method == 'Transfer'): ?>
                <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                    <h3 class="text-lg font-semibold text-blue-800 mb-2">Detail Transfer</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600">Bank:</p>
                            <p class="font-bold"><?= $payment->bank_name ?></p>
                        </div>
                        
                        <div>
                            <p class="text-gray-600">Nomor Rekening:</p>
                            <p class="font-bold"><?= $payment->account_number ?></p>
                        </div>
                        
                        <?php if ($payment->payment_proof): ?>
                            <div class="md:col-span-2">
                                <p class="text-gray-600">Bukti Transfer:</p>
                                <a href="<?= base_url('uploads/payments/' . $payment->payment_proof) ?>" target="_blank" class="text-blue-600 hover:underline">
                                    Lihat Bukti Transfer
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if ($payment->status == 'Verified'): ?>
                <div class="text-center mt-6">
                    <a href="<?= site_url('kelas/enroll/' . $payment->class_id) ?>" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline">
                        Akses Kelas Sekarang
                    </a>
                </div>
            <?php elseif ($payment->status == 'Rejected' && $payment->notes): ?>
                <div class="mb-6 p-4 bg-red-50 rounded-lg">
                    <h3 class="text-lg font-semibold text-red-800 mb-2">Catatan Admin</h3>
                    <p class="text-gray-700"><?= $payment->notes ?></p>
                </div>
                
                <div class="text-center mt-6">
                    <a href="<?= site_url('payment/initiate/' . $payment->class_id) ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline">
                        Ajukan Pembayaran Ulang
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
