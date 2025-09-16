<div class="max-w-screen-2xl mx-auto p-6">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Verifikasi Pembayaran</h1>
        <p class="text-gray-600">Daftar pembayaran yang menunggu verifikasi</p>
    </div>

    <?php if (empty($payments)): ?>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
            <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada pembayaran yang menunggu verifikasi</h3>
            <p class="text-gray-500">Semua pembayaran telah diverifikasi</p>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($payments as $payment): ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <i class="fas fa-user text-blue-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><?= $payment->user_name ?></div>
                                        <div class="text-sm text-gray-500"><?= isset($payment->user_email) ? $payment->user_email : '' ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?= $payment->class_name ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">Rp <?= number_format($payment->amount, 0, ',', '.') ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?= date('d M Y', strtotime($payment->created_at)) ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                    Menunggu
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <button onclick="showDetailModal(<?= $payment->id ?>)" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye mr-1"></i> Detail
                                    </button>
                                    <button onclick="showVerifyModal(<?= $payment->id ?>)" class="text-green-600 hover:text-green-900">
                                        <i class="fas fa-check mr-1"></i> Verifikasi
                                    </button>
                                    <button onclick="showRejectModal(<?= $payment->id ?>)" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-times mr-1"></i> Tolak
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Verification Modal -->
<div id="verifyModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Verifikasi Pembayaran</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">Apakah Anda yakin ingin memverifikasi pembayaran ini?</p>
            </div>
            <form id="verifyForm" method="POST" action="">
                <input type="hidden" name="action" value="verify">
                <input type="hidden" name="payment_id" id="verify_payment_id" value="">
                <div class="mb-4">
                    <label for="notes" class="block text-sm font-medium text-gray-700">Catatan (opsional)</label>
                    <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"></textarea>
                </div>
                <div class="items-center px-4 py-3">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">
                        Verifikasi
                    </button>
                    <button type="button" data-close-modal="verify" class="ml-3 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Rejection Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Tolak Pembayaran</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">Apakah Anda yakin ingin menolak pembayaran ini?</p>
            </div>
            <form id="rejectForm" method="POST" action="">
                <input type="hidden" name="action" value="reject">
                <input type="hidden" name="payment_id" id="reject_payment_id" value="">
                <div class="mb-4">
                    <label for="rejectNotes" class="block text-sm font-medium text-gray-700">Alasan Penolakan</label>
                    <textarea name="notes" id="rejectNotes" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required></textarea>
                </div>
                <div class="items-center px-4 py-3">
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Tolak
                    </button>
                    <button type="button" data-close-modal="reject" class="ml-3 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center border-b pb-4 mb-4">
                <h3 class="text-xl font-bold text-gray-800">Detail Pembayaran</h3>
                <button type="button" data-close-modal="detail" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                    Tutup
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Nama Siswa</h4>
                    <p id="detailStudent" class="text-gray-900 mt-1"></p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Kelas</h4>
                    <p id="detailClass" class="text-gray-900 mt-1"></p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Jumlah</h4>
                    <p id="detailAmount" class="text-gray-900 mt-1"></p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Metode Pembayaran</h4>
                    <p id="detailMethod" class="text-gray-900 mt-1"></p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Tanggal</h4>
                    <p id="detailDate" class="text-gray-900 mt-1"></p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Status</h4>
                    <p id="detailStatus" class="text-gray-900 mt-1"></p>
                </div>
            </div>
            
            <div class="mt-6">
                <h4 class="text-sm font-medium text-gray-500 mb-2">Bukti Pembayaran</h4>
                <div class="bg-gray-100 rounded-lg p-4 flex justify-center">
                    <img id="detailProof" src="" alt="Bukti Pembayaran" class="max-h-64">
                </div>
            </div>
            
            <?php if ($payment->payment_proof): ?>
                <div class="mt-4">
                    <p class="text-sm text-gray-500 mb-2">Bukti Pembayaran</p>
                    <div class="payment-proof">
                        <a href="<?= base_url('uploads/payments/' . $payment->payment_proof) ?>" target="_blank">
                            <img src="<?= base_url('uploads/payments/' . $payment->payment_proof) ?>" alt="Bukti Pembayaran">
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="mt-6 pt-4 border-t flex justify-end">
                <button type="button" data-close-modal="detail" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script id="paymentsData" type="application/json">
<?= json_encode($payments) ?>
</script>
<script src="<?= base_url('assets/js/admin-payment.js?v=' . time()) ?>"></script>
