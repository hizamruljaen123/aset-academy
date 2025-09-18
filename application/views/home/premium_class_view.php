<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-600 to-indigo-800 text-white py-20 md:py-32">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6"><?= $kelas->nama_kelas ?></h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-8"><?= isset($kelas->deskripsi_singkat) ? $kelas->deskripsi_singkat : substr($kelas->deskripsi, 0, 100) . '...' ?></p>
            <div class="flex flex-wrap justify-center gap-4">
                <span class="px-4 py-2 bg-white/20 rounded-full text-sm font-medium">
                    <i class="fas fa-tag mr-2"></i> Level: <?= $kelas->level ?>
                </span>
                <span class="px-4 py-2 bg-white/20 rounded-full text-sm font-medium">
                    <i class="fas fa-code mr-2"></i> <?= $kelas->bahasa_program ?>
                </span>
                <span class="px-4 py-2 bg-white/20 rounded-full text-sm font-medium">
                    <i class="fas fa-clock mr-2"></i> <?= $kelas->durasi ?> Jam
                </span>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
</section>

<!-- Course Details -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Main Content -->
            <div class="lg:w-2/3">
                <!-- Course Overview -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Overview Kelas</h2>
                    <div class="prose max-w-none">
                        <?= $kelas->deskripsi ?>
                    </div>
                </div>

                <!-- Curriculum -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Materi Pembelajaran</h2>
                    <div class="space-y-4">
                        <?php if (!empty($materi)): ?>
                            <?php foreach ($materi as $index => $m): ?>
                                <div class="border border-gray-200 rounded-lg overflow-hidden">
                                    <div class="bg-gray-50 px-4 py-3 flex justify-between items-center">
                                        <h3 class="font-medium text-gray-800"><?= $m->judul_materi ?></h3>
                                        <span class="text-sm text-gray-500"><?= $m->durasi ?> menit</span>
                                    </div>
                                    <div class="p-4">
                                        <p class="text-gray-600"><?= $m->deskripsi ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-gray-500">Materi belum tersedia.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Instructor -->
                <?php if (!empty($instruktur)): ?>
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tentang Instruktur</h2>
                    <div class="flex items-start space-x-4">
                        <img src="<?= base_url('assets/img/instructors/' . $instruktur->foto) ?>" 
                             alt="<?= $instruktur->nama ?>" 
                             class="w-20 h-20 rounded-full object-cover">
                        <div>
                            <h3 class="text-xl font-semibold"><?= $instruktur->nama ?></h3>
                            <p class="text-blue-600 mb-2"><?= $instruktur->jabatan ?></p>
                            <p class="text-gray-600"><?= $instruktur->bio ?></p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <div class="sticky top-6 space-y-6">
                    <!-- Price Box -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <?php if (isset($kelas->diskon) && $kelas->diskon > 0): ?>
                            <div class="bg-red-600 text-white text-center py-1 text-sm font-medium">
                                Diskon <?= $kelas->diskon ?>% Off
                            </div>
                        <?php endif; ?>
                        
                        <div class="p-6">
                            <div class="flex items-baseline mb-4">
                                <?php if (isset($kelas->diskon) && $kelas->diskon > 0): ?>
                                    <span class="text-4xl font-bold text-gray-900">Rp <?= number_format($kelas->harga - ($kelas->harga * $kelas->diskon / 100), 0, ',', '.') ?></span>
                                    <span class="ml-2 text-lg text-gray-500 line-through">Rp <?= number_format($kelas->harga, 0, ',', '.') ?></span>
                                <?php else: ?>
                                    <span class="text-4xl font-bold text-gray-900">Rp <?= number_format($kelas->harga, 0, ',', '.') ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <ul class="space-y-3 mb-6">
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Kelas Online Interaktif</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Konsultasi dengan Mentor</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Sertifikat Kelulusan</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Akses Materi Selamanya</span>
                                </li>
                            </ul>
                            
                            <?php if ($this->session->userdata('logged_in')): ?>
                                <?php if ($sudah_bergabung): ?>
                                    <a href="<?= site_url('kelas/saya') ?>" class="block w-full bg-green-600 hover:bg-green-700 text-white text-center font-medium py-3 px-6 rounded-lg transition-colors">
                                        Lanjutkan Belajar
                                    </a>
                                <?php else: ?>
                                    <a href="<?= site_url('checkout/process/' . $kelas->id) ?>" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-medium py-3 px-6 rounded-lg transition-colors">
                                        Daftar Sekarang
                                    </a>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="<?= site_url('auth/register?redirect=kelas/' . $kelas->id) ?>" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-medium py-3 px-6 rounded-lg transition-colors">
                                    Daftar Sekarang
                                </a>
                                <p class="text-sm text-gray-500 text-center mt-2">Sudah punya akun? <a href="<?= site_url('auth/login?redirect=kelas/' . $kelas->id) ?>" class="text-blue-600 hover:underline">Masuk</a></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Course Info -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="font-bold text-lg mb-4">Informasi Kelas</h3>
                        <ul class="space-y-3">
                            <li class="flex justify-between">
                                <span class="text-gray-600">Level</span>
                                <span class="font-medium"><?= $kelas->level ?></span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Durasi</span>
                                <span class="font-medium"><?= $kelas->durasi ?> Jam</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Bahasa</span>
                                <span class="font-medium"><?= $kelas->bahasa_program ?></span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Siswa</span>
                                <span class="font-medium"><?= number_format($total_siswa) ?>+</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Rating</span>
                                <div class="flex items-center">
                                    <span class="text-yellow-400 mr-1">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= floor($avg_rating)): ?>
                                                <i class="fas fa-star"></i>
                                            <?php elseif($i == ceil($avg_rating) && $avg_rating - floor($avg_rating) >= 0.5): ?>
                                                <i class="fas fa-star-half-alt"></i>
                                            <?php else: ?>
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </span>
                                    <span class="text-gray-700">(<?= number_format($avg_rating, 1) ?>)</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<?php if (!empty($testimonials)): ?>
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Apa Kata Mereka?</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($testimonials as $testi): ?>
                <div class="bg-gray-50 rounded-xl p-6">
                    <div class="flex items-center mb-4">
                        <?php if (!empty($testi->photo)): ?>
                            <img src="<?= base_url('assets/img/avatars/' . $testi->photo) ?>" 
                                 alt="<?= html_escape($testi->name) ?>" 
                                 class="w-12 h-12 rounded-full object-cover">
                        <?php endif; ?>
                        <div class="ml-4">
                            <h4 class="font-semibold"><?= html_escape($testi->name) ?></h4>
                            <p class="text-sm text-gray-500"><?= html_escape($testi->position) ?></p>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-3">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <?= $i <= $testi->rating ? '★' : '☆' ?>
                        <?php endfor; ?>
                    </div>
                    <p class="text-gray-600">"<?= html_escape($testi->content) ?>"</p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Siap Mengasah Skill Programming Anda?</h2>
        <p class="text-xl text-blue-100 mb-8 max-w-3xl mx-auto">Bergabunglah dengan <?= $total_siswa ?>+ siswa lainnya yang telah memulai perjalanan mereka di ASET Academy</p>
        <a href="#" class="inline-block bg-white text-blue-600 hover:bg-blue-50 font-medium py-3 px-8 rounded-lg transition-colors">
            Daftar Sekarang
        </a>
    </div>
</section>

<?php $this->load->view('home/templates/_footer'); ?>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggers = document.querySelectorAll('[data-tooltip]');
        
        tooltipTriggers.forEach(trigger => {
            const tooltip = document.createElement('div');
            tooltip.className = 'hidden absolute z-10 py-1 px-2 bg-gray-900 text-white text-xs rounded whitespace-nowrap';
            tooltip.textContent = trigger.getAttribute('data-tooltip');
            document.body.appendChild(tooltip);
            
            trigger.addEventListener('mouseenter', (e) => {
                const rect = trigger.getBoundingClientRect();
                tooltip.style.top = `${rect.top - 30}px`;
                tooltip.style.left = `${rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2)}px`;
                tooltip.classList.remove('hidden');
            });
            
            trigger.addEventListener('mouseleave', () => {
                tooltip.classList.add('hidden');
            });
        });
    });
</script>
