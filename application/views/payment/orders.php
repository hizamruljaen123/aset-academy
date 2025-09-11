<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Daftar Pemesanan Kelas</h2>

    <?php if (empty($payments)) : ?>
        <div class="p-6 bg-yellow-50 text-yellow-800 rounded-lg">
            Anda belum memiliki pemesanan kelas premium.
        </div>
    <?php else : ?>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-blue-600 text-white text-left">
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Kelas</th>
                        <th class="px-4 py-3">Jumlah</th>
                        <th class="px-4 py-3">Metode</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payments as $p) : ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                <?= date('d-m-Y H:i', strtotime($p->created_at)) ?>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-800">
                                <?= htmlspecialchars($p->class_name) ?>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                Rp <?= number_format($p->amount, 0, ',', '.') ?>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                <?= $p->payment_method ?>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm">
                                <?php if ($p->status === 'Verified') : ?>
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full">Terverifikasi</span>
                                <?php elseif ($p->status === 'Pending') : ?>
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full">Menunggu</span>
                                <?php else : ?>
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full">Ditolak</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm">
                                <a href="<?= site_url('payment/status/' . $p->id) ?>" class="text-blue-600 hover:underline">Lihat</a>
                                <?php if ($p->status === 'Rejected') : ?>
                                    | <a href="<?= site_url('payment/initiate/' . $p->class_id) ?>" class="text-indigo-600 hover:underline">Bayar Lagi</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
