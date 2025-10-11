<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

<section class="relative overflow-hidden bg-gradient-to-br from-gray-900 via-slate-900 to-gray-900 pt-32 pb-24 text-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 items-center gap-8 lg:grid-cols-2">
            <div data-aos="fade-right">
                <span class="rounded-full bg-white/10 backdrop-blur-sm px-4 py-1 text-sm uppercase tracking-[0.25rem]">Karier di ASET Academy</span>
                <h1 class="mt-6 text-4xl font-extrabold leading-tight md:text-5xl lg:text-6xl bg-gradient-to-r from-blue-300 to-purple-300 bg-clip-text text-transparent">
                    Jadi Bagian dari Tim Pembelajaran Digital Masa Depan
                </h1>
                <p class="mt-6 text-lg text-white/80 md:text-xl">
                    Bergabunglah bersama talenta terbaik untuk membangun solusi pendidikan teknologi yang berdampak bagi ribuan pelajar di Indonesia.
                </p>
                <div class="mt-10 flex flex-wrap items-center gap-4">
                    <a href="#job-openings" class="rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-3 text-base font-semibold text-white shadow-lg transition hover:-translate-y-0.5 hover:shadow-xl">
                        Lihat Lowongan Tersedia
                    </a>
                    <a href="#life-at-aset" class="inline-flex items-center gap-2 text-base hover:text-blue-300 transition-colors" aria-label="Pelajari budaya kerja di ASET Academy">
                        <i class="fas fa-play-circle text-2xl"></i>
                        Pelajari Budaya Kami
                    </a>
                </div>
            </div>
            <div class="relative" data-aos="fade-left">
                <div class="absolute -right-10 -top-10 h-64 w-64 rounded-full bg-blue-500/20 blur-3xl"></div>
                <div class="absolute -left-10 -bottom-10 h-48 w-48 rounded-full bg-purple-500/20 blur-3xl"></div>
                <div class="relative rounded-3xl bg-white/5 backdrop-blur-sm p-8 shadow-2xl border border-white/10">
                    <div class="grid grid-cols-2 gap-5">
                        <div class="rounded-2xl border border-white/20 bg-white/5 backdrop-blur-sm p-5">
                            <p class="text-sm text-white/70">Total Lowongan</p>
                            <p class="mt-3 text-3xl font-bold text-blue-300"><?= (int) ($stats['total_positions'] ?? count($positions)); ?></p>
                        </div>
                        <div class="rounded-2xl border border-white/20 bg-white/5 backdrop-blur-sm p-5">
                            <p class="text-sm text-white/70">Tim & Divisi</p>
                            <p class="mt-3 text-3xl font-bold text-purple-300"><?= count($departments); ?>+</p>
                        </div>
                        <div class="rounded-2xl border border-white/20 bg-white/5 backdrop-blur-sm p-5">
                            <p class="text-sm text-white/70">Karyawan</p>
                            <p class="mt-3 text-3xl font-bold text-green-300">120+</p>
                        </div>
                        <div class="rounded-2xl border border-white/20 bg-white/5 backdrop-blur-sm p-5">
                            <p class="text-sm text-white/70">Tipe Kerja</p>
                            <p class="mt-3 text-3xl font-bold text-yellow-300">Hybrid</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="life-at-aset" class="bg-gradient-to-br from-slate-50 via-white to-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-3">
            <div class="space-y-4" data-aos="fade-up">
                <span class="text-sm font-semibold uppercase tracking-[0.4rem] bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Budaya</span>
                <h2 class="text-3xl font-bold text-gray-900">Bekerja di ASET Academy</h2>
                <p class="text-gray-600">Kami percaya pada budaya kolaboratif, pembelajaran berkelanjutan, dan dampak nyata terhadap dunia pendidikan teknologi. Tim kami terdiri dari edukator, engineer, designer, dan growth specialist dengan passion yang sama.</p>
            </div>
            <div class="flex flex-col gap-4" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-start gap-4 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm hover:shadow-md transition-shadow">
                    <div class="rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 p-3 text-white"><i class="fas fa-lightbulb text-xl"></i></div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Inovasi Tanpa Batas</h3>
                        <p class="mt-2 text-sm text-gray-600">Riset dan pengembangan teknologi pembelajaran adalah fokus utama kami. Kamu akan terlibat dalam produk berdampak luas.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm hover:shadow-md transition-shadow">
                    <div class="rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 p-3 text-white"><i class="fas fa-graduation-cap text-xl"></i></div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Pertumbuhan Karier</h3>
                        <p class="mt-2 text-sm text-gray-600">Setiap anggota tim mendapatkan akses mentoring, pelatihan internal, dan program sertifikasi untuk level up skill.</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-4" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-start gap-4 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm hover:shadow-md transition-shadow">
                    <div class="rounded-xl bg-gradient-to-br from-green-500 to-emerald-500 p-3 text-white"><i class="fas fa-people-carry text-xl"></i></div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Kolaborasi Lintas Tim</h3>
                        <p class="mt-2 text-sm text-gray-600">Kami mengedepankan komunikasi terbuka, stand-up harian, dan review rutin untuk memastikan setiap suara didengar.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm hover:shadow-md transition-shadow">
                    <div class="rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 p-3 text-white"><i class="fas fa-heart text-xl"></i></div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Work-Life Balance</h3>
                        <p class="mt-2 text-sm text-gray-600">Jam kerja fleksibel, opsi remote, dan dukungan kesehatan mental untuk menjaga keseimbangan hidup kamu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="job-openings" class="bg-gradient-to-br from-slate-50 via-white to-gray-50 py-16">
    <div class="container mx-auto px-4 space-y-10">
        <div class="text-center" data-aos="fade-up">
            <span class="text-sm font-semibold uppercase tracking-[0.4rem] bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Lowongan Terbuka</span>
            <h2 class="mt-3 text-3xl font-bold text-gray-900 md:text-4xl">Temukan Peran yang Tepat untuk Kamu</h2>
            <p class="mt-4 text-lg text-gray-600">Gunakan filter untuk menemukan posisi sesuai minat, pengalaman, dan lokasi kerja.</p>
        </div>

        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-delay="50">
            <form method="get" class="grid grid-cols-1 gap-4 lg:grid-cols-5">
                <div class="lg:col-span-2">
                    <label class="mb-1 block text-sm font-medium text-gray-700">Cari Pekerjaan</label>
                    <div class="relative">
                        <input type="text" name="q" value="<?= html_escape($filters['search'] ?? ''); ?>" class="form-input pl-11 border-gray-200 focus:border-blue-500 focus:ring-blue-500" placeholder="Judul, kata kunci, lokasi">
                        <span class="pointer-events-none absolute left-3 top-3 text-gray-400"><i class="fas fa-search"></i></span>
                    </div>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Departemen</label>
                    <select name="department" class="form-select border-gray-200 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Departemen</option>
                        <?php foreach ($departments as $department): ?>
                            <option value="<?= html_escape($department); ?>" <?= (($filters['department'] ?? '') === $department) ? 'selected' : ''; ?>><?= html_escape($department); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Jenis Pekerjaan</label>
                    <select name="employment_type" class="form-select border-gray-200 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua</option>
                        <?php foreach (['Full-time','Part-time','Contract','Internship','Freelance'] as $type): ?>
                            <option value="<?= $type; ?>" <?= (($filters['employment_type'] ?? '') === $type) ? 'selected' : ''; ?>><?= $type; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" name="location" value="<?= html_escape($filters['location'] ?? ''); ?>" class="form-input border-gray-200 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Jakarta / Remote">
                </div>
                <div class="lg:col-span-5 flex flex-wrap items-end gap-3">
                    <button type="submit" class="rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 px-4 py-2 text-sm font-semibold text-white hover:shadow-lg transition-all">Terapkan Filter</button>
                    <a href="<?= site_url('career'); ?>" class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 transition-colors">Reset</a>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 gap-6" data-aos="fade-up" data-aos-delay="100">
            <?php if (empty($positions)): ?>
                <div class="rounded-2xl border border-dashed border-gray-200 bg-white p-12 text-center shadow-sm">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-blue-100 to-purple-100 text-3xl text-blue-500">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="mt-6 text-xl font-semibold text-gray-900">Belum ada lowongan yang dipublikasikan</h3>
                    <p class="mt-3 text-gray-600">
                        Kami sedang menyiapkan peluang karier menarik lainnya. Ikuti kanal media sosial ASET Academy untuk update terbaru.
                    </p>
                </div>
            <?php else: ?>
                <?php foreach ($positions as $position): ?>
                    <?php $encryptedId = $this->encryption_url->encode($position->id); ?>
                    <article class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-blue-200">
                        <div class="flex flex-col gap-6 md:flex-row md:items-start md:justify-between">
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-3">
                                    <h3 class="text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors"><?= html_escape($position->title); ?></h3>
                                    <?php if ((int) ($position->is_featured ?? 0) === 1): ?>
                                        <span class="rounded-full bg-gradient-to-r from-amber-500 to-orange-500 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-white">Featured</span>
                                    <?php endif; ?>
                                    <span class="rounded-full bg-gradient-to-r from-blue-500 to-purple-500 px-3 py-1 text-xs font-semibold text-white"><?= html_escape($position->employment_type); ?></span>
                                </div>
                                <p class="mt-3 text-sm font-medium text-gray-600">Departemen: <?= html_escape($position->department); ?></p>
                                <div class="mt-4 flex flex-wrap items-center gap-4 text-sm text-gray-500">
                                    <span><i class="fas fa-map-marker-alt mr-2 text-blue-500"></i><?= html_escape($position->location ?? 'Flexible / Remote'); ?></span>
                                    <span><i class="fas fa-briefcase mr-2 text-purple-500"></i><?= html_escape($position->experience_level); ?></span>
                                    <span><i class="fas fa-clock mr-2 text-green-500"></i><?= $position->application_deadline ? 'Deadline: ' . date('d M Y', strtotime($position->application_deadline)) : 'Tanpa deadline'; ?></span>
                                </div>
                                <?php if (!empty($position->salary_range)): ?>
                                    <p class="mt-4 inline-flex items-center rounded-lg bg-gradient-to-r from-emerald-50 to-green-50 px-3 py-1 text-sm font-semibold text-emerald-600">
                                        <i class="fas fa-money-bill-wave mr-2"></i><?= html_escape($position->salary_range); ?>
                                    </p>
                                <?php endif; ?>
                                <p class="mt-5 text-base text-gray-600 line-clamp-3">
                                    <?= substr(strip_tags((string) $position->description), 0, 220) . (strlen(strip_tags((string) $position->description)) > 220 ? '...' : ''); ?>
                                </p>
                            </div>
                            <div class="flex flex-col items-end gap-3">
                                <div class="rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 px-4 py-3 text-right">
                                    <p class="text-xs uppercase tracking-wide text-gray-400">Total Pelamar</p>
                                    <p class="text-xl font-semibold text-gray-900"><?= (int) ($position->total_applications ?? 0); ?></p>
                                    <p class="text-xs text-gray-500">Dalam proses: <?= (int) ($position->active_applications ?? 0); ?></p>
                                </div>
                                <a href="<?= site_url('career/detail/' . $encryptedId); ?>" class="inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 px-5 py-2 text-sm font-semibold text-white transition group-hover:shadow-lg hover:scale-105">
                                    Lihat Detail & Lamar
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="bg-gradient-to-br from-slate-50 via-white to-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 gap-10 rounded-3xl bg-gradient-to-br from-gray-900 via-slate-900 to-gray-900 p-10 text-white lg:grid-cols-3">
            <div data-aos="fade-up">
                <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-300 to-purple-300 bg-clip-text text-transparent">Proses Rekrutmen Kami</h2>
                <p class="mt-4 text-white/80">Kami merancang proses seleksi yang transparan, cepat, dan memastikan kandidat dapat menunjukkan keunggulan terbaiknya.</p>
            </div>
            <div class="space-y-6" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-start gap-4">
                    <div class="rounded-full bg-gradient-to-r from-blue-500 to-purple-500 px-4 py-2 text-lg font-semibold">1</div>
                    <div>
                        <h3 class="text-xl font-semibold">Screening CV & Portfolio</h3>
                        <p class="mt-2 text-sm text-white/80">Tim talent acquisition akan mengevaluasi CV, pengalaman, dan kesesuaian nilai kamu.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="rounded-full bg-gradient-to-r from-purple-500 to-pink-500 px-4 py-2 text-lg font-semibold">2</div>
                    <div>
                        <h3 class="text-xl font-semibold">Interview Kompetensi</h3>
                        <p class="mt-2 text-sm text-white/80">Ngobrol langsung dengan hiring manager untuk mengetahui potensi kontribusi kamu.</p>
                    </div>
                </div>
            </div>
            <div class="space-y-6" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-start gap-4">
                    <div class="rounded-full bg-gradient-to-r from-pink-500 to-red-500 px-4 py-2 text-lg font-semibold">3</div>
                    <div>
                        <h3 class="text-xl font-semibold">Studi Kasus / Tes Teknis</h3>
                        <p class="mt-2 text-sm text-white/80">Tunjukkan kemampuanmu melalui challenge yang relevan dengan posisi.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="rounded-full bg-gradient-to-r from-red-500 to-orange-500 px-4 py-2 text-lg font-semibold">4</div>
                    <div>
                        <h3 class="text-xl font-semibold">Final Interview & Offer</h3>
                        <p class="mt-2 text-sm text-white/80">Diskusi akhir untuk memastikan kecocokan budaya dan ekspektasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-gradient-to-br from-slate-50 via-white to-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="rounded-3xl bg-white p-10 shadow-xl hover:shadow-2xl transition-shadow">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-2">
                <div data-aos="fade-right">
                    <h2 class="text-3xl font-bold text-gray-900">Belum Menemukan Posisi yang Tepat?</h2>
                    <p class="mt-4 text-lg text-gray-600">Kirim CV terbaikmu melalui talent pool kami dan dapatkan informasi terbaru ketika ada lowongan yang sesuai.</p>
                    <a href="mailto:talent@asetacademy.id" class="mt-6 inline-flex items-center rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 px-5 py-3 text-sm font-semibold text-white hover:shadow-lg transition-all">
                        <i class="fas fa-paper-plane mr-2"></i>talent@asetacademy.id
                    </a>
                </div>
                <div class="space-y-5" data-aos="fade-left">
                    <div class="rounded-2xl border border-gray-100 bg-gradient-to-br from-gray-50 to-gray-100 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="rounded-full bg-gradient-to-br from-blue-500 to-blue-600 p-3 text-white"><i class="fas fa-headset text-xl"></i></div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Hubungi Talent Team</h3>
                                <p class="text-sm text-gray-600">Hari kerja: Senin - Jumat (09.00 - 17.00 WIB)</p>
                                <p class="text-sm text-gray-600">WhatsApp: +62 896-7601-8562</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-gradient-to-br from-gray-50 to-gray-100 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="rounded-full bg-gradient-to-br from-purple-500 to-pink-500 p-3 text-white"><i class="fas fa-share-alt text-xl"></i></div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Ikuti Sosial Media Kami</h3>
                                <p class="text-sm text-gray-600">Dapatkan info karier terbaru di LinkedIn & Instagram.</p>
                            </div>
                        </div>
                        <div class="mt-4 flex gap-3">
                            <a href="https://www.linkedin.com/company/aset-academy" target="_blank" class="rounded-full bg-gradient-to-br from-blue-50 to-blue-100 p-3 hover:shadow-md transition-all text-blue-600" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://www.instagram.com/asetacademy.id" target="_blank" class="rounded-full bg-gradient-to-br from-pink-50 to-pink-100 p-3 hover:shadow-md transition-all text-pink-600" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.youtube.com/@asetacademy" target="_blank" class="rounded-full bg-gradient-to-br from-red-50 to-red-100 p-3 hover:shadow-md transition-all text-red-600" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('home/templates/_footer'); ?>
