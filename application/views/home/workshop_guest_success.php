<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Success Section -->
    <section class="pt-20 pb-16 bg-gradient-to-br from-green-600 via-green-700 to-emerald-700 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-green-400/20 rounded-full pulse-blob"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-emerald-400/20 rounded-full pulse-blob" style="animation-delay: 2s;"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-2xl mx-auto text-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-8">
                    <i class="fas fa-check-circle text-green-600 text-4xl"></i>
                </div>

                <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-4">
                    Pendaftaran Berhasil!
                </h1>

                <p class="text-xl text-white/90 mb-8">
                    Selamat <strong><?= html_escape($guest->nama_lengkap) ?></strong>! Anda telah berhasil mendaftar untuk workshop
                    <strong>"<?= html_escape($workshop->title) ?>"</strong>
                </p>

                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 mb-8">
                    <h3 class="text-lg font-semibold text-white mb-4">Detail Pendaftaran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                        <div>
                            <p class="text-white/80 text-sm">Nama Lengkap</p>
                            <p class="text-white font-medium"><?= html_escape($guest->nama_lengkap) ?></p>
                        </div>
                        <div>
                            <p class="text-white/80 text-sm">Asal Kampus/Sekolah</p>
                            <p class="text-white font-medium"><?= html_escape($guest->asal_kampus_sekolah) ?></p>
                        </div>
                        <div>
                            <p class="text-white/80 text-sm">Usia</p>
                            <p class="text-white font-medium"><?= $guest->usia ?> tahun</p>
                        </div>
                        <div>
                            <p class="text-white/80 text-sm">Pekerjaan</p>
                            <p class="text-white font-medium"><?= $guest->pekerjaan ?></p>
                        </div>
                        <div>
                            <p class="text-white/80 text-sm">Provinsi</p>
                            <p class="text-white font-medium"><?= $guest->province_name ?: 'Tidak diisi' ?></p>
                        </div>
                        <div>
                            <p class="text-white/80 text-sm">Kabupaten/Kota</p>
                            <p class="text-white font-medium"><?= $guest->regency_name ?: 'Tidak diisi' ?></p>
                        </div>
                        <div>
                            <p class="text-white/80 text-sm">Kecamatan</p>
                            <p class="text-white font-medium"><?= $guest->district_name ?: 'Tidak diisi' ?></p>
                        </div>
                        <div>
                            <p class="text-white/80 text-sm">No. WhatsApp/Telegram</p>
                            <p class="text-white font-medium"><?= html_escape($guest->no_wa_telegram) ?></p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-white/80 text-sm">Workshop</p>
                            <p class="text-white font-medium"><?= html_escape($workshop->title) ?></p>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-400/20 backdrop-blur-sm rounded-xl p-6 mb-8">
                    <h3 class="text-lg font-semibold text-white mb-2">📅 Simpan Tanggal Workshop</h3>
                    <p class="text-white/90">
                        <strong>Tanggal:</strong> <?= date('d F Y', strtotime($workshop->start_datetime)) ?><br>
                        <strong>Waktu:</strong> <?= date('H:i', strtotime($workshop->start_datetime)) ?> - <?= date('H:i', strtotime($workshop->end_datetime)) ?><br>
                        <strong>Lokasi:</strong> <?= html_escape($workshop->location) ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Group Join Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Bergabung dengan Komunitas</h2>
                <p class="text-xl text-gray-600 mb-12">
                    Untuk mendapatkan informasi terbaru dan berkomunikasi dengan peserta lainnya
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- WhatsApp Group -->
                    <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fab fa-whatsapp text-green-600 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Grup WhatsApp</h3>
                        <p class="text-gray-600 mb-6">
                            Bergabung dengan grup WhatsApp untuk diskusi, pertanyaan, dan update workshop
                        </p>
                        <a href="https://wa.me/6281234567890?text=Halo%20saya%20<?= urlencode($guest->nama_lengkap) ?>%20yang%20sudah%20mendaftar%20workshop%20<?= urlencode($workshop->title) ?>"
                           target="_blank"
                           class="w-full bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-semibold inline-flex items-center justify-center">
                            <i class="fab fa-whatsapp mr-2"></i>
                            Gabung Grup WhatsApp
                        </a>
                    </div>

                    <!-- Telegram Group -->
                    <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fab fa-telegram text-blue-600 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Grup Telegram</h3>
                        <p class="text-gray-600 mb-6">
                            Alternatif komunikasi via Telegram untuk update dan diskusi workshop
                        </p>
                        <a href="https://t.me/joinchat/AAAAAE1234567890"
                           target="_blank"
                           class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold inline-flex items-center justify-center">
                            <i class="fab fa-telegram mr-2"></i>
                            Gabung Grup Telegram
                        </a>
                    </div>
                </div>

                <div class="mt-12">
                    <a href="<?= site_url('workshops') ?>" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Workshop
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>
