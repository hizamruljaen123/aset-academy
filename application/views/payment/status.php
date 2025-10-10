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

                    <?php if (!empty($payment->invoice_number)): ?>
                    <div>
                        <p class="text-gray-600">Nomor Invoice:</p>
                        <p class="font-bold text-blue-600"><?= $payment->invoice_number ?></p>
                    </div>
                    <?php endif; ?>
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

                        <?php if (!empty($payment->user_bank_name)): ?>
                        <div>
                            <p class="text-gray-600">Bank Pengirim:</p>
                            <p class="font-bold"><?= $payment->user_bank_name ?></p>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($payment->user_account_holder)): ?>
                        <div>
                            <p class="text-gray-600">Nama Pemilik Rekening:</p>
                            <p class="font-bold"><?= $payment->user_account_holder ?></p>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($payment->payment_description)): ?>
                        <div class="md:col-span-2">
                            <p class="text-gray-600">Keterangan Pembayaran:</p>
                            <p class="font-bold bg-gray-50 p-2 rounded"><?= nl2br($payment->payment_description) ?></p>
                        </div>
                        <?php endif; ?>

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
            <?php elseif ($payment->payment_method == 'Midtrans'): ?>
                <?php
                // Load Midtrans model to get transaction details
                $this->load->model('Midtrans_model');
                
                // Extract order_id from payment_description (format: "Midtrans Order ID: PAY-30-1760112785")
                $order_id = null;
                if (preg_match('/Midtrans Order ID:\s*([^\s]+)/', $payment->payment_description, $matches)) {
                    $order_id = $matches[1];
                } else {
                    // Fallback: use payment_description directly if it contains order_id
                    $order_id = trim($payment->payment_description);
                }
                
                $midtrans_transaction = $this->Midtrans_model->get_transaction_by_order_id($order_id);
                ?>
                <div class="mb-6 p-4 bg-green-50 rounded-lg">
                    <h3 class="text-lg font-semibold text-green-800 mb-2">Detail Pembayaran Midtrans</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php if ($midtrans_transaction): ?>
                        <div>
                            <p class="text-gray-600">Order ID:</p>
                            <p class="font-bold font-mono text-sm bg-white px-2 py-1 rounded border"><?= htmlspecialchars($midtrans_transaction->order_id) ?></p>
                        </div>

                        <div>
                            <p class="text-gray-600">Transaction ID:</p>
                            <p class="font-bold font-mono text-sm bg-white px-2 py-1 rounded border"><?= htmlspecialchars($midtrans_transaction->transaction_id ?? 'Belum tersedia') ?></p>
                        </div>

                        <div>
                            <p class="text-gray-600">Metode Pembayaran:</p>
                            <p class="font-bold"><?= htmlspecialchars($midtrans_transaction->payment_type ?? 'Belum dipilih') ?></p>
                        </div>

                        <div>
                            <p class="text-gray-600">Status Transaksi:</p>
                            <span class="px-2 py-1 rounded-full text-sm font-medium
                                <?php
                                switch($midtrans_transaction->transaction_status) {
                                    case 'settlement':
                                    case 'capture':
                                        echo 'bg-green-100 text-green-800';
                                        break;
                                    case 'pending':
                                        echo 'bg-yellow-100 text-yellow-800';
                                        break;
                                    case 'deny':
                                    case 'cancel':
                                    case 'expire':
                                    case 'failure':
                                        echo 'bg-red-100 text-red-800';
                                        break;
                                    default:
                                        echo 'bg-gray-100 text-gray-800';
                                }
                                ?>">
                                <?php echo ucfirst($midtrans_transaction->transaction_status ?? 'unknown'); ?>
                            </span>
                        </div>

                        <div>
                            <p class="text-gray-600">Tanggal Transaksi:</p>
                            <p class="font-bold"><?= date('d M Y H:i', strtotime($midtrans_transaction->created_at)) ?></p>
                        </div>

                       
                        <?php else: ?>
                        <div class="md:col-span-2">
                            <p class="text-gray-600">Status:</p>
                            <p class="font-bold text-orange-600">Transaksi Midtrans sedang diproses...</p>
                            <p class="text-sm text-gray-500 mt-1">Detail pembayaran akan muncul setelah transaksi selesai diproses.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if ($payment->status == 'Pending' && empty($payment->payment_proof) && $payment->payment_method == 'Transfer'): ?>
                <div class="mb-6 p-4 bg-orange-50 border-l-4 border-orange-400 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-upload text-orange-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-orange-800">
                                Upload Bukti Pembayaran
                            </h3>
                            <div class="mt-2 text-sm text-orange-700">
                                <p>Silakan upload bukti pembayaran Anda untuk diverifikasi admin.</p>
                            </div>
                            <div class="mt-3">
                                <a href="<?= site_url('payment/upload_payment_proof/' . $payment->id) ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                    <i class="fas fa-upload mr-2"></i>
                                    Upload Bukti Pembayaran
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($payment->status == 'Pending' && $payment->payment_method == 'Midtrans'): ?>
                <?php
                // Load Midtrans model to get transaction details
                $this->load->model('Midtrans_model');
                
                // Extract order_id from payment_description (format: "Midtrans Order ID: PAY-30-1760112785")
                $order_id = null;
                if (preg_match('/Midtrans Order ID:\s*([^\s]+)/', $payment->payment_description, $matches)) {
                    $order_id = $matches[1];
                } else {
                    // Fallback: use payment_description directly if it contains order_id
                    $order_id = trim($payment->payment_description);
                }
                
                $midtrans_transaction = $this->Midtrans_model->get_transaction_by_order_id($order_id);
                ?>
                <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-400 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-clock text-blue-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">
                                Pembayaran Belum Selesai
                            </h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <p>Silakan lanjutkan pembayaran menggunakan link di bawah ini:</p>
                                <?php if ($midtrans_transaction && !empty($midtrans_transaction->redirect_url)): ?>
                                <div class="mt-3">
                                    <a href="<?= $midtrans_transaction->redirect_url ?>" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="fas fa-external-link-alt mr-2"></i>
                                        Lanjutkan Pembayaran Midtrans
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                                <p class="mt-2 text-xs text-blue-600">
                                    Link ini akan mengarahkan Anda ke halaman pembayaran Midtrans
                                </p>
                                <?php else: ?>
                                <p class="mt-2 text-orange-600">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    Link pembayaran sedang dipersiapkan. Silakan refresh halaman ini dalam beberapa saat.
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($payment->status == 'Verified'): ?>
                <div class="text-center mt-6 space-y-3">
                    <a href="<?= isset($enrollment) && $enrollment ? site_url('student/premium/learn/' . $enrollment->id) : site_url('kelas/enroll/' . $payment->class_id) ?>" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline">
                        Akses Kelas Sekarang
                    </a>
                    <?php if (!empty($payment->invoice_number)): ?>
                    <br>
                    <a href="<?= site_url('payment/invoice/' . $payment->id) ?>" target="_blank" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline text-sm">
                        <i class="fas fa-download mr-2"></i>Download Invoice
                    </a>
                    <?php endif; ?>
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
