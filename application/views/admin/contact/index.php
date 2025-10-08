<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kotak Masuk Kontak</h1>
            <p class="text-sm text-gray-500">Kelola pesan masuk dari halaman Contact Us</p>
        </div>
        <a href="<?= site_url('admin/contact'); ?>" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-colors">Muat Ulang</a>
    </div>

    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <form method="get" action="<?= site_url('admin/contact'); ?>" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="baru" <?= isset($filters['status']) && $filters['status'] === 'baru' ? 'selected' : ''; ?>>Baru</option>
                    <option value="diproses" <?= isset($filters['status']) && $filters['status'] === 'diproses' ? 'selected' : ''; ?>>Diproses</option>
                    <option value="selesai" <?= isset($filters['status']) && $filters['status'] === 'selesai' ? 'selected' : ''; ?>>Selesai</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pesan</label>
                <select name="message_type" class="form-select">
                    <option value="">Semua Jenis</option>
                    <option value="pertanyaan" <?= isset($filters['message_type']) && $filters['message_type'] === 'pertanyaan' ? 'selected' : ''; ?>>Pertanyaan Umum</option>
                    <option value="kerjasama" <?= isset($filters['message_type']) && $filters['message_type'] === 'kerjasama' ? 'selected' : ''; ?>>Kerjasama</option>
                    <option value="dukungan" <?= isset($filters['message_type']) && $filters['message_type'] === 'dukungan' ? 'selected' : ''; ?>>Dukungan</option>
                    <option value="lainnya" <?= isset($filters['message_type']) && $filters['message_type'] === 'lainnya' ? 'selected' : ''; ?>>Lainnya</option>
                </select>
            </div>
            <div class="md:col-span-2 flex items-end">
                <button type="submit" class="w-full md:w-auto px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">Terapkan Filter</button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengirim</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dikirim</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (empty($messages)): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada pesan kontak.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($messages as $message): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900"><?= html_escape($message->name); ?></div>
                                <div class="text-sm text-gray-500"><?= html_escape($message->company ?: '-'); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <?= ucfirst($message->message_type); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div><?= html_escape($message->email); ?></div>
                                <?php if (!empty($message->whatsapp_number)): ?>
                                    <div class="text-green-600">WA: <?= html_escape($message->whatsapp_number); ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if ($message->status === 'baru'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Baru</span>
                                <?php elseif ($message->status === 'diproses'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Diproses</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Selesai</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= date('d M Y H:i', strtotime($message->created_at)); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="<?= site_url('admin/contact/view/' . $message->id); ?>" class="text-blue-600 hover:text-blue-900">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (!empty($pagination_links)): ?>
        <div class="mt-6">
            <?= $pagination_links; ?>
        </div>
    <?php endif; ?>
</div>
