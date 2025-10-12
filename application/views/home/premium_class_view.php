
<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Hero Section - Udemy Style -->
    <section class="pt-24 pb-12 bg-white border-b">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <!-- Breadcrumb -->
                <nav class="flex mb-8 text-sm text-gray-500">
                    <a href="<?= site_url('home') ?>" class="hover:text-gray-700">Home</a>
                    <span class="mx-2">/</span>
                    <a href="<?= site_url('home/premium') ?>" class="hover:text-gray-700">Kelas Premium</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-900 font-medium"><?= html_entity_decode($kelas->nama_kelas) ?></span>
                </nav>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <!-- Main Content -->
                    <div class="lg:col-span-2">
                        <!-- Title and Badge -->
                        <div class="flex items-center gap-3 mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                <i data-feather="award" class="w-4 h-4 mr-1"></i>
                                Premium
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <i data-feather="users" class="w-4 h-4 mr-1"></i>
                                <?= number_format($total_siswa) ?> siswa
                            </span>
                            <?php if (isset($kelas->diskon) && $kelas->diskon > 0): ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <i data-feather="tag" class="w-4 h-4 mr-1"></i>
                                Diskon <?= $kelas->diskon ?>%
                            </span>
                            <?php endif; ?>
                        </div>

                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                            <?= html_entity_decode($kelas->nama_kelas) ?>
                        </h1>

                        <!-- Short Description -->
                        <div class="text-lg text-gray-700 mb-6 leading-relaxed">
                            <?php
                            $short_desc = isset($kelas->deskripsi_singkat) && !empty($kelas->deskripsi_singkat) 
                                ? $kelas->deskripsi_singkat 
                                : word_limiter($kelas->deskripsi, 100);
                            echo decode_html_entities($short_desc);
                            ?>
                        </div>

                        <!-- Meta Information -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900 mb-1">
                                    <?php
                                    $level_badges = [
                                        'Pemula' => 'bg-green-100 text-green-800',
                                        'Menengah' => 'bg-yellow-100 text-yellow-800',
                                        'Lanjutan' => 'bg-red-100 text-red-800'
                                    ];
                                    $level_class = $level_badges[$kelas->level] ?? 'bg-gray-100 text-gray-800';
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium <?= $level_class ?>">
                                        <?= html_entity_decode($kelas->level) ?>
                                    </span>
                                </div>
                                <div class="text-sm text-gray-500">Tingkat Kesulitan</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900 mb-1">
                                    <i data-feather="clock" class="w-5 h-5 inline mr-1"></i>
                                    <?= html_entity_decode($kelas->durasi) ?> Jam
                                </div>
                                <div class="text-sm text-gray-500">Total Durasi</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900 mb-1">
                                    <i data-feather="monitor" class="w-5 h-5 inline mr-1"></i>
                                    <?= count($materi ?? []) ?>
                                </div>
                                <div class="text-sm text-gray-500">Sesi Live</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900 mb-1">
                                    <i data-feather="code" class="w-5 h-5 inline mr-1"></i>
                                    <?= html_entity_decode($kelas->bahasa_program) ?>
                                </div>
                                <div class="text-sm text-gray-500">Bahasa</div>
                            </div>
                        </div>

                        
                    </div>

                    <!-- Sidebar - Course Preview -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-8">
                            <!-- Course Preview Card -->
                            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                                <!-- Preview Image -->
                                <div class="relative aspect-video">
                                    <img src="<?= isset($kelas->gambar) ? $kelas->gambar : base_url('assets/img/default-course.png') ?>" 
                                         alt="<?= html_entity_decode($kelas->nama_kelas) ?>"
                                         class="w-full h-full object-cover">
                                    <!-- Live Class Badge -->
                                    <div class="absolute top-4 right-4 bg-red-600 text-white px-3 py-1 rounded-full text-sm font-medium flex items-center">
                                        <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                                        Kelas Live
                                    </div>
                                </div>

                                <!-- Course Info -->
                                <div class="p-6">
                                    <!-- Price -->
                                    <div class="text-center mb-4">
                                        <?php if (isset($kelas->diskon) && $kelas->diskon > 0): ?>
                                            <div class="text-3xl font-bold text-gray-900 mb-1">
                                                Rp <?= number_format($kelas->harga - ($kelas->harga * $kelas->diskon / 100), 0, ',', '.') ?>
                                            </div>
                                            <div class="text-sm text-gray-500 line-through">Rp <?= number_format($kelas->harga, 0, ',', '.') ?></div>
                                        <?php else: ?>
                                            <div class="text-3xl font-bold text-gray-900 mb-1">
                                                Rp <?= number_format($kelas->harga, 0, ',', '.') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Key Features -->
                                    <div class="space-y-3 mb-6">
                                        
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i data-feather="check-circle" class="w-4 h-4 text-green-500 mr-2"></i>
                                            <span>Sertifikat penyelesaian</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i data-feather="check-circle" class="w-4 h-4 text-green-500 mr-2"></i>
                                            <span>Dukungan komunitas</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i data-feather="check-circle" class="w-4 h-4 text-green-500 mr-2"></i>
                                            <span>Konsultasi dengan mentor</span>
                                        </div>
                                    </div>

                                    <!-- CTA Button -->
                                    <?php if ($this->session->userdata('logged_in')): ?>
                                        <?php if ($sudah_bergabung): ?>
                                            <a href="<?= site_url('kelas/saya') ?>"
                                               class="w-full inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors">
                                                <i data-feather="play-circle" class="w-5 h-5 mr-2"></i>
                                                Lanjutkan Belajar
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= site_url('checkout/process/' . $kelas->id) ?>"
                                               class="w-full inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                                                <i data-feather="shopping-cart" class="w-5 h-5 mr-2"></i>
                                                Daftar Sekarang
                                            </a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="<?= site_url('auth/register?redirect=kelas/' . $kelas->id) ?>"
                                           class="w-full inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                                            <i data-feather="user-plus" class="w-5 h-5 mr-2"></i>
                                            Daftar Sekarang
                                        </a>
                                        <p class="text-sm text-gray-500 text-center mt-3">
                                            Sudah punya akun? 
                                            <a href="<?= site_url('auth/login?redirect=kelas/' . $kelas->id) ?>" class="text-blue-600 hover:underline">Masuk</a>
                                        </p>
                                    <?php endif; ?>
                                    <br>
                                    <div class="text-sm text-gray-600 text-center">
                                        <i data-feather="users" class="w-4 h-4 inline mr-1"></i>
                                        <?= number_format($total_siswa) ?> siswa terdaftar
                                    </div>

                                    
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Description & Curriculum -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Course Description -->
                        <div class="bg-white rounded-xl shadow-sm p-8">
                            <!-- Live Class Info Banner -->
                            <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <i data-feather="monitor" class="w-6 h-6 text-blue-500"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-semibold text-blue-900 mb-1">Kelas Live Online dengan Mentor</h3>
                                        <p class="text-sm text-blue-700">
                                            Kelas ini diajarkan secara langsung oleh mentor profesional melalui platform online. 
                                            Anda dapat berinteraksi langsung, bertanya, dan berdiskusi selama sesi pembelajaran.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Tentang Kelas Ini</h2>
                            <div class="prose prose-lg max-w-none text-gray-700">
                                <?php
                                // Decode HTML entities and render clean HTML
                                echo decode_html_entities($kelas->deskripsi, true);
                                ?>
                            </div>

                            
                        </div>

                        <!-- Curriculum Section -->
                        <div class="bg-white rounded-xl shadow-sm p-8">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-gray-900">Jadwal Sesi Live</h2>
                                <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                                    <?php echo count($materi ?? []); ?> sesi • <?php echo html_entity_decode($kelas->durasi); ?> jam
                                </span>
                            </div>

                            <?php if (!empty($materi)): ?>
                                <div class="space-y-4">
                                    <?php foreach ($materi as $index => $material): ?>
                                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                        <span class="text-sm font-semibold text-blue-800"><?php echo $index + 1; ?></span>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-lg font-semibold text-gray-900">
                                                            <?php echo html_entity_decode(isset($material->judul) ? character_limiter($material->judul, 60) : 'Materi ' . ($index + 1)); ?>
                                                        </h3>
                                                        <?php if (isset($material->deskripsi) && $material->deskripsi): ?>
                                                            <p class="text-gray-600 mt-1">
                                                                <?php echo html_entity_decode(character_limiter($material->deskripsi, 100)); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="flex items-center space-x-2 text-sm text-gray-500">
                                                    <i data-feather="monitor" class="w-4 h-4"></i>
                                                    <span>Sesi Live</span>
                                                    <span class="text-gray-300">•</span>
                                                    <i data-feather="clock" class="w-4 h-4"></i>
                                                    <span>60 menit</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-12">
                                    <i data-feather="calendar" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Jadwal Akan Segera Diumumkan</h3>
                                    <p class="text-gray-500">Jadwal sesi live untuk kelas ini akan segera diumumkan. Daftarkan diri Anda sekarang untuk mendapatkan notifikasi.</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Instructor Section -->
                        <?php if (!empty($instruktur)): ?>
                        <div class="bg-white rounded-xl shadow-sm p-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Tentang Instruktur</h2>
                            <div class="flex items-start space-x-6">
                                <img src="<?= base_url('assets/img/instructors/' . (isset($instruktur->foto_profil) ? $instruktur->foto_profil : 'default.jpg')) ?>" 
                                     alt="<?= isset($instruktur->nama_lengkap) ? html_entity_decode($instruktur->nama_lengkap) : 'Instruktur' ?>" 
                                     class="w-24 h-24 rounded-full object-cover border-4 border-blue-100">
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900"><?= isset($instruktur->nama_lengkap) ? html_entity_decode($instruktur->nama_lengkap) : 'Nama Instruktur' ?></h3>
                                    <p class="text-blue-600 font-medium mb-3"><?= isset($instruktur->role) ? html_entity_decode(ucfirst($instruktur->role)) : 'Instruktur' ?></p>
                                    <p class="text-gray-600 leading-relaxed">
                                        Instruktur profesional di bidang programming dengan pengalaman mengajar yang luas dan telah membantu ratusan siswa mencapai tujuan karir mereka.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Course Includes -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Kelas Ini Termasuk</h3>
                            <div class="space-y-3">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i data-feather="monitor" class="w-5 h-5 text-green-500 mr-3"></i>
                                    <span>Kelas live online dengan mentor</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i data-feather="message-circle" class="w-5 h-5 text-green-500 mr-3"></i>
                                    <span>Tanya jawab langsung dengan mentor</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i data-feather="download" class="w-5 h-5 text-green-500 mr-3"></i>
                                    <span>Materi pembelajaran untuk download</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i data-feather="award" class="w-5 h-5 text-green-500 mr-3"></i>
                                    <span>Sertifikat penyelesaian</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i data-feather="users" class="w-5 h-5 text-green-500 mr-3"></i>
                                    <span>Akses ke komunitas siswa</span>
                                </div>
                            </div>
                        </div>

                        <!-- Prerequisites -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Persyaratan</h3>
                            <div class="space-y-3 text-sm text-gray-600">
                                <div class="flex items-start">
                                    <i data-feather="check-circle" class="w-4 h-4 text-green-500 mr-3 mt-0.5 flex-shrink-0"></i>
                                    <span><?= $kelas->level == 'Pemula' ? 'Tidak ada persyaratan khusus - cocok untuk pemula' : 'Pengetahuan dasar programming direkomendasikan' ?></span>
                                </div>
                                <div class="flex items-start">
                                    <i data-feather="check-circle" class="w-4 h-4 text-green-500 mr-3 mt-0.5 flex-shrink-0"></i>
                                    <span>Koneksi internet stabil</span>
                                </div>
                                <div class="flex items-start">
                                    <i data-feather="check-circle" class="w-4 h-4 text-green-500 mr-3 mt-0.5 flex-shrink-0"></i>
                                    <span>Komputer atau laptop</span>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <?php if (!empty($testimonials)): ?>
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Apa Kata Mereka?</h2>
                    <p class="text-lg text-gray-600">Testimoni dari siswa yang telah mengikuti kelas ini</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($testimonials as $testi): ?>
                        <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition-shadow">
                            <div class="flex items-center mb-4">
                                <?php if (!empty($testi->photo)): ?>
                                    <img src="<?= base_url('assets/img/avatars/' . $testi->photo) ?>" 
                                         alt="<?= html_entity_decode($testi->name) ?>" 
                                         class="w-12 h-12 rounded-full object-cover">
                                <?php else: ?>
                                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                        <i data-feather="user" class="w-6 h-6 text-blue-600"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-900"><?= html_entity_decode($testi->name) ?></h4>
                                    <p class="text-sm text-gray-500"><?= html_entity_decode($testi->position) ?></p>
                                </div>
                            </div>
                            <div class="flex text-yellow-400 mb-3">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <i data-feather="star" class="w-4 h-4 <?= $i <= $testi->rating ? 'fill-current' : '' ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="text-gray-600">"<?= html_entity_decode($testi->content) ?>"</p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- FAQ Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Pertanyaan Umum</h2>
                    <p class="text-lg text-gray-600">Jawaban atas pertanyaan yang sering ditanyakan siswa</p>
                </div>

                <div class="space-y-4">
                    <?php
                    $faqs = [
                        [
                            'question' => 'Bagaimana cara pembayaran kelas ini?',
                            'answer' => word_wrap('Kami menerima berbagai metode pembayaran termasuk transfer bank, e-wallet, dan kartu kredit. Setelah pembayaran dikonfirmasi, Anda akan langsung mendapatkan akses ke kelas.', 70)
                        ],
                        [
                            'question' => 'Bagaimana format kelas ini?',
                            'answer' => word_wrap('Kelas ini diajarkan secara live online oleh mentor profesional. Anda akan mengikuti sesi pembelajaran interaktif dimana Anda bisa bertanya dan berdiskusi langsung.', 70)
                        ],
                        [
                            'question' => 'Apakah ada sertifikat setelah menyelesaikan kelas?',
                            'answer' => word_wrap('Ya, setiap siswa yang menyelesaikan semua sesi pembelajaran akan mendapatkan sertifikat penyelesaian resmi dari Aset Academy.', 70)
                        ],
                        [
                            'question' => 'Apakah saya bisa bertanya ke mentor?',
                            'answer' => word_wrap('Tentu! Karena ini kelas live online, Anda bisa langsung bertanya kepada mentor selama sesi pembelajaran berlangsung.', 70)
                        ],
                        [
                            'question' => 'Apakah ada garansi uang kembali?',
                            'answer' => word_wrap('Ya, kami memberikan garansi uang kembali 30 hari jika Anda tidak puas dengan kelas ini. Hubungi tim support kami untuk proses refund.', 70)
                        ]
                    ];

                    foreach($faqs as $index => $faq): ?>
                        <div class="bg-white rounded-lg shadow-sm">
                            <button class="w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-lg"
                                    onclick="toggleFaq(<?php echo $index; ?>)">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        <?php echo html_entity_decode(character_limiter($faq['question'], 80)); ?>
                                    </h3>
                                    <i data-feather="chevron-down" class="w-5 h-5 text-gray-500 transform transition-transform faq-icon-<?php echo $index; ?>"></i>
                                </div>
                            </button>
                            <div class="px-6 pb-4 faq-content-<?php echo $index; ?> hidden">
                                <p class="text-gray-700 leading-relaxed">
                                    <?php echo nl2br(html_entity_decode($faq['answer'])); ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Siap Mengasah Skill Programming Anda?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-3xl mx-auto">
                Bergabunglah dengan <?= number_format($total_siswa) ?>+ siswa lainnya yang telah memulai perjalanan mereka di ASET Academy
            </p>
            <?php if (!$this->session->userdata('logged_in')): ?>
                <a href="<?= site_url('auth/register?redirect=kelas/' . $kelas->id) ?>" 
                   class="inline-flex items-center justify-center bg-white text-blue-600 hover:bg-blue-50 font-semibold py-3 px-8 rounded-lg transition-colors">
                    <i data-feather="user-plus" class="w-5 h-5 mr-2"></i>
                    Daftar Sekarang
                </a>
            <?php elseif (!$sudah_bergabung): ?>
                <a href="<?= site_url('checkout/process/' . $kelas->id) ?>" 
                   class="inline-flex items-center justify-center bg-white text-blue-600 hover:bg-blue-50 font-semibold py-3 px-8 rounded-lg transition-colors">
                    <i data-feather="shopping-cart" class="w-5 h-5 mr-2"></i>
                    Daftar Sekarang
                </a>
            <?php endif; ?>
        </div>
    </section>

    <!-- FAQ Toggle Script -->
    <script>
        function toggleFaq(index) {
            const content = document.querySelector(`.faq-content-${index}`);
            const icon = document.querySelector(`.faq-icon-${index}`);

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>

<?php $this->load->view('home/templates/_footer'); ?>
