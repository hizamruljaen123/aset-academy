<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
            <h2 class="text-3xl font-bold">Pesanan Kelas Premium Saya</h2>
            <p class="text-sm opacity-90 mt-1">Lihat riwayat pemesanan dan status pembayaran kelas premium Anda.</p>
        </div>

        <?php if (empty($payments)) : ?>
            <div class="p-8 bg-yellow-50 text-yellow-800 rounded-lg border border-yellow-200">
                <div class="flex items-center">
                    <i class="fas fa-shopping-cart text-yellow-600 text-3xl mr-4"></i>
                    <div>
                        <h3 class="text-lg font-semibold">Belum Ada Pesanan</h3>
                        <p class="mt-1">Anda belum memiliki pesanan kelas premium. Mulai belajar dengan mendaftar kelas premium kami.</p>
                        <a href="<?php echo site_url('student/premium'); ?>" class="inline-flex items-center mt-3 px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors">
                            <i class="fas fa-crown mr-2"></i>
                            Jelajahi Kelas Premium
                        </a>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Daftar Pesanan</h3>
                            <p class="text-sm text-gray-600">Total <?php echo count($payments); ?> pesanan</p>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-500">Status Pembayaran</div>
                            <div class="flex space-x-2 mt-1">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>Terverifikasi
                                </span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>Menunggu
                                </span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i>Ditolak
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-blue-600 text-white text-left">
                                <th class="px-6 py-4 font-semibold">No</th>
                                <th class="px-6 py-4 font-semibold">Tanggal Pesan</th>
                                <th class="px-6 py-4 font-semibold">Kelas</th>
                                <th class="px-6 py-4 font-semibold">Jumlah</th>
                                <th class="px-6 py-4 font-semibold">Metode</th>
                                <th class="px-6 py-4 font-semibold">Status</th>
                                <th class="px-6 py-4 font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($payments as $p) : ?>
                                <tr class="border-b hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $no++; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex flex-col">
                                            <span><?php echo date('d M Y', strtotime($p->created_at)); ?></span>
                                            <span class="text-xs text-gray-500"><?php echo date('H:i', strtotime($p->created_at)); ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                        <?php echo htmlspecialchars($p->class_name); ?>
                                        <?php if (!empty($p->invoice_number)): ?>
                                            <div class="text-xs text-blue-600 mt-1">
                                                Invoice: <?php echo $p->invoice_number; ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">
                                        Rp <?php echo number_format($p->amount, 0, ',', '.'); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="inline-flex items-center">
                                            <i class="fas fa-<?php echo ($p->payment_method == 'Transfer') ? 'university' : (($p->payment_method == 'Cash') ? 'money-bill-wave' : 'credit-card'); ?> mr-2 text-gray-400"></i>
                                            <?php echo $p->payment_method; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if ($p->status === 'Verified') : ?>
                                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium inline-flex items-center">
                                                <i class="fas fa-check-circle mr-1"></i>Terverifikasi
                                            </span>
                                        <?php elseif ($p->status === 'Pending') : ?>
                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium inline-flex items-center">
                                                <i class="fas fa-clock mr-1"></i>Menunggu Verifikasi
                                            </span>
                                        <?php else : ?>
                                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium inline-flex items-center">
                                                <i class="fas fa-times-circle mr-1"></i>Ditolak
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex space-x-2">
                                            <a href="<?php echo site_url('payment/status/' . $p->id); ?>"
                                               class="inline-flex items-center px-3 py-1 bg-blue-100 hover:bg-blue-200 text-blue-800 rounded-lg text-xs font-medium transition-colors">
                                                <i class="fas fa-eye mr-1"></i>Lihat Detail
                                            </a>
                                            <?php if ($p->status === 'Rejected') : ?>
                                                <a href="<?php echo site_url('payment/initiate/' . $p->class_id); ?>"
                                                   class="inline-flex items-center px-3 py-1 bg-indigo-100 hover:bg-indigo-200 text-indigo-800 rounded-lg text-xs font-medium transition-colors">
                                                    <i class="fas fa-redo mr-1"></i>Bayar Lagi
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Summary Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-info-circle mr-1"></i>
                            Total pesanan Anda: <strong><?php echo count($payments); ?></strong>
                        </div>
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-question-circle mr-1"></i>
                            Butuh bantuan? <a href="<?php echo site_url('forum'); ?>" class="text-blue-600 hover:underline">Hubungi Admin</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
