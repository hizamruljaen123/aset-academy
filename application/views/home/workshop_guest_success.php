<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                window.location.href = 'https://chat.whatsapp.com/HdrSw3afOkk9D7dg3dQHQe?mode=ems_copy_t';
            }, 3000);
        });
    </script>

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
                            <p class="text-white font-medium"><?php echo (isset($guest->province_name) && $guest->province_name) ? html_escape($guest->province_name) : 'Tidak diisi'; ?></p>
                        </div>
                        <div>
                            <p class="text-white/80 text-sm">Kabupaten/Kota</p>
                            <p class="text-white font-medium"><?php echo (isset($guest->regency_name) && $guest->regency_name) ? html_escape($guest->regency_name) : 'Tidak diisi'; ?></p>
                        </div>
                        <div>
                            <p class="text-white/80 text-sm">Kecamatan</p>
                            <p class="text-white font-medium"><?php echo (isset($guest->district_name) && $guest->district_name) ? html_escape($guest->district_name) : 'Tidak diisi'; ?></p>
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

   

<?php $this->load->view('home/templates/_footer'); ?>
