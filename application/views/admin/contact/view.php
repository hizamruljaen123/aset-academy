<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Pesan Kontak</h1>
            <p class="text-sm text-gray-500">Periksa detail pesan dan tindak lanjut</p>
        </div>
        <div class="flex gap-3">
            <a href="<?= site_url('admin/contact'); ?>" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-colors">Kembali</a>
            <form action="<?= site_url('admin/contact/delete/' . $message->id); ?>" method="post" onsubmit="return confirm('Hapus pesan ini?');">
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Hapus</button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pengirim</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <div class="text-gray-500">Nama Lengkap</div>
                        <div class="font-medium text-gray-800"><?= html_escape($message->name); ?></div>
                    </div>
                    <div>
                        <div class="text-gray-500">Email</div>
                        <div class="font-medium text-gray-800"><?= html_escape($message->email); ?></div>
                    </div>
                    <div>
                        <div class="text-gray-500">Perusahaan/Institusi</div>
                        <div class="font-medium text-gray-800"><?= html_escape($message->company ?: '-'); ?></div>
                    </div>
                    <div>
                        <div class="text-gray-500">Nomor Telepon</div>
                        <div class="font-medium text-gray-800"><?= html_escape($message->phone ?: '-'); ?></div>
                    </div>
                    <div>
                        <div class="text-gray-500">Nomor WhatsApp</div>
                        <div class="font-medium text-gray-800"><?= html_escape($message->whatsapp_number ?: '-'); ?></div>
                    </div>
                    <div>
                        <div class="text-gray-500">Metode Kontak Favorit</div>
                        <div class="font-medium text-gray-800"><?= ucfirst($message->preferred_contact); ?></div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Detail Pesan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-4">
                    <div>
                        <div class="text-gray-500">Jenis Pesan</div>
                        <div class="font-medium text-gray-800">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <?= ucfirst($message->message_type); ?>
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="text-gray-500">Dikirim</div>
                        <div class="font-medium text-gray-800"><?= date('d M Y H:i', strtotime($message->created_at)); ?></div>
                    </div>
                    <div>
                        <div class="text-gray-500">Subjek</div>
                        <div class="font-medium text-gray-800"><?= html_escape($message->subject); ?></div>
                    </div>
                    <div>
                        <div class="text-gray-500">Status</div>
                        <div class="font-medium text-gray-800">
                            <?php if ($message->status === 'baru'): ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Baru</span>
                            <?php elseif ($message->status === 'diproses'): ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Diproses</span>
                            <?php else: ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Selesai</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="text-sm text-gray-700 leading-relaxed whitespace-pre-line border-t border-gray-200 pt-4">
                    <?= nl2br(html_escape($message->message)); ?>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Tindak Lanjut</h2>
                <form action="<?= site_url('admin/contact/update_status/' . $message->id); ?>" method="post" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Pesan</label>
                        <select name="status" class="form-select">
                            <option value="baru" <?= $message->status === 'baru' ? 'selected' : ''; ?>>Baru</option>
                            <option value="diproses" <?= $message->status === 'diproses' ? 'selected' : ''; ?>>Diproses</option>
                            <option value="selesai" <?= $message->status === 'selesai' ? 'selected' : ''; ?>>Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Simpan Status</button>
                </form>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Kontak Cepat</h2>
                <div class="space-y-4 text-sm">
                    <a href="mailto:<?= html_escape($message->email); ?>" class="flex items-center px-4 py-3 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                        <i class="fas fa-envelope mr-3"></i>
                        Kirim Email Balasan
                    </a>
                    <?php if (!empty($message->whatsapp_number)): ?>
                        <a href="https://wa.me/<?= urlencode($message->whatsapp_number); ?>" class="flex items-center px-4 py-3 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition-colors">
                            <i class="fab fa-whatsapp mr-3"></i>
                            Balas via WhatsApp
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
