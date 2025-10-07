<div class="p-4 transition-opacity duration-500 opacity-0">
    <div class="max-w-2xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="<?= site_url('student/workshops') ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Workshop
            </a>
        </div>

        <?php if ($workshop): ?>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Success Header -->
            <div class="h-48 bg-gradient-to-r from-green-500 to-emerald-600 flex items-center justify-center">
                <div class="text-center text-white">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check text-4xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold mb-2">Pendaftaran Berhasil!</h1>
                    <p class="text-lg opacity-90">Anda telah terdaftar untuk workshop ini</p>
                </div>
            </div>

            <div class="p-8">
                <!-- Workshop Info Card -->
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">
                        <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                        Detail Workshop
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="font-semibold text-gray-800 text-lg mb-2">
                                <?= $workshop->title ?>
                            </h3>
                            <p class="text-gray-600 mb-4">
                                <?= substr(strip_tags($workshop->description), 0, 150) ?><?= strlen(strip_tags($workshop->description)) > 150 ? '...' : '' ?>
                            </p>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt text-blue-500 mr-3"></i>
                                <div>
                                    <div class="font-semibold text-gray-800">Tanggal</div>
                                    <div class="text-gray-600">
                                        <?= date('l, d F Y', strtotime($workshop->start_datetime)) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <i class="fas fa-clock text-blue-500 mr-3"></i>
                                <div>
                                    <div class="font-semibold text-gray-800">Waktu</div>
                                    <div class="text-gray-600">
                                        <?= date('H:i', strtotime($workshop->start_datetime)) ?> -
                                        <?= date('H:i', strtotime($workshop->end_datetime)) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-blue-500 mr-3"></i>
                                <div>
                                    <div class="font-semibold text-gray-800">Lokasi</div>
                                    <div class="text-gray-600">
                                        <?php if ($participant->district_id): ?>
                                            <?= $participant->district_name ?>, <?= $participant->regency_name ?>, <?= $participant->province_name ?>
                                        <?php else: ?>
                                            <?= $workshop->location ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <?php if ($workshop->price > 0): ?>
                            <div class="flex items-center">
                                <i class="fas fa-tag text-blue-500 mr-3"></i>
                                <div>
                                    <div class="font-semibold text-gray-800">Biaya</div>
                                    <div class="text-gray-600">
                                        Rp <?= number_format($workshop->price, 0, ',', '.') ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Important Notes -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-bold text-blue-800 mb-3">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        Catatan Penting
                    </h3>
                    <ul class="space-y-2 text-blue-700 text-sm">
                        <li>• Pastikan Anda hadir tepat waktu sesuai jadwal yang telah ditentukan</li>
                        <li>• Jika ada perubahan jadwal, informasi akan dikirim melalui email atau WhatsApp</li>
                        <?php if ($workshop->price > 0): ?>
                        <li>• Pembayaran akan diproses sesuai dengan ketentuan yang berlaku</li>
                        <?php endif; ?>
                        <li>• Bawa identitas diri yang valid saat menghadiri workshop</li>
                        <li>• Ikuti aturan dan tata tertib yang berlaku selama workshop berlangsung</li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="<?= site_url('student/workshops') ?>"
                       class="flex-1 py-3 px-6 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all text-center font-semibold">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Workshop
                    </a>

                    <a href="<?= site_url('student/workshops/detail/' . $workshop->id) ?>"
                       class="flex-1 py-3 px-6 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all text-center font-semibold">
                        <i class="fas fa-eye mr-2"></i>
                        Lihat Detail Workshop
                    </a>
                </div>

                <!-- Contact Info -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="text-center text-gray-600 text-sm">
                        <p>Butuh bantuan? Hubungi panitia workshop melalui:</p>
                        <div class="mt-2 flex justify-center space-x-4">
                            <a href="https://wa.me/6281234567890" class="text-green-600 hover:text-green-800">
                                <i class="fab fa-whatsapp mr-1"></i>
                                WhatsApp
                            </a>
                            <a href="mailto:workshop@asetmedia.com" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-envelope mr-1"></i>
                                Email
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="bg-white p-8 rounded-xl shadow-lg text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Workshop Tidak Ditemukan</h3>
            <p class="text-gray-500">Workshop yang Anda cari tidak tersedia.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
// Fade in animation
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        document.querySelector('.p-4').classList.remove('opacity-0');
    }, 100);
});
</script>
