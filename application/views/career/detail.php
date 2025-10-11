<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

<section class="relative overflow-hidden bg-gradient-to-br from-gray-900 via-slate-900 to-gray-900 pt-32 pb-16 text-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 items-center gap-8 lg:grid-cols-2">
            <div data-aos="fade-right">
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="rounded-full bg-white/10 backdrop-blur-sm px-4 py-1 text-sm uppercase tracking-[0.25rem]"><?= html_escape($position->department); ?></span>
                    <?php if ((int) ($position->is_featured ?? 0) === 1): ?>
                        <span class="rounded-full bg-gradient-to-r from-amber-500 to-orange-500 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-white">Featured</span>
                    <?php endif; ?>
                    <span class="rounded-full bg-gradient-to-r from-blue-500 to-purple-500 px-3 py-1 text-xs font-semibold text-white"><?= html_escape($position->employment_type); ?></span>
                </div>
                <h1 class="text-4xl font-extrabold leading-tight md:text-5xl lg:text-6xl bg-gradient-to-r from-blue-300 to-purple-300 bg-clip-text text-transparent">
                    <?= html_escape($position->title); ?>
                </h1>
                <div class="mt-6 flex flex-wrap items-center gap-4 text-sm text-white/80">
                    <span><i class="fas fa-map-marker-alt mr-2 text-blue-400"></i><?= html_escape($position->location ?? 'Flexible / Remote'); ?></span>
                    <span><i class="fas fa-briefcase mr-2 text-purple-400"></i><?= html_escape($position->experience_level); ?></span>
                    <span><i class="fas fa-clock mr-2 text-green-400"></i><?= $position->application_deadline ? 'Deadline: ' . date('d M Y', strtotime($position->application_deadline)) : 'Tanpa deadline'; ?></span>
                </div>
                <?php if (!empty($position->salary_range)): ?>
                    <p class="mt-4 inline-flex items-center rounded-lg bg-gradient-to-r from-emerald-50 to-green-50 px-3 py-1 text-sm font-semibold text-emerald-600">
                        <i class="fas fa-money-bill-wave mr-2"></i><?= html_escape($position->salary_range); ?>
                    </p>
                <?php endif; ?>
            </div>
            <div class="relative" data-aos="fade-left">
                <div class="absolute -right-10 -top-10 h-64 w-64 rounded-full bg-blue-500/20 blur-3xl"></div>
                <div class="absolute -left-10 -bottom-10 h-48 w-48 rounded-full bg-purple-500/20 blur-3xl"></div>
                <div class="relative rounded-3xl bg-white/5 backdrop-blur-sm p-8 shadow-2xl border border-white/10">
                    <div class="text-center">
                        <div class="rounded-full bg-gradient-to-r from-blue-500 to-purple-500 w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-briefcase text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Bergabung dengan Tim Kami</h3>
                        <p class="text-white/70 text-sm mb-6">Kirim aplikasi Anda dan mulai perjalanan karier di ASET Academy</p>
                        <a href="#apply-form" class="inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-3 text-base font-semibold text-white shadow-lg transition hover:-translate-y-0.5 hover:shadow-xl">
                            Lamar Sekarang
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-gradient-to-br from-slate-50 via-white to-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-3">
            <div class="lg:col-span-2" data-aos="fade-up">
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Deskripsi Pekerjaan</h2>
                    <div class="prose prose-gray max-w-none text-gray-600">
                        <?= $position->description; ?>
                    </div>
                </div>

                <?php if (!empty($position->requirements)): ?>
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 mt-8" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Persyaratan</h2>
                    <div class="prose prose-gray max-w-none text-gray-600">
                        <?= $position->requirements; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($position->benefits)): ?>
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 mt-8" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Benefit & Fasilitas</h2>
                    <div class="prose prose-gray max-w-none text-gray-600">
                        <?= $position->benefits; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="lg:col-span-1" data-aos="fade-left">
                <div class="sticky top-8">
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Posisi</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Departemen</span>
                                <span class="font-semibold text-gray-900"><?= html_escape($position->department); ?></span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Jenis Kerja</span>
                                <span class="font-semibold text-gray-900"><?= html_escape($position->employment_type); ?></span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Lokasi</span>
                                <span class="font-semibold text-gray-900"><?= html_escape($position->location ?? 'Flexible'); ?></span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Level</span>
                                <span class="font-semibold text-gray-900"><?= html_escape($position->experience_level); ?></span>
                            </div>
                            <?php if (!empty($position->salary_range)): ?>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Gaji</span>
                                <span class="font-semibold text-emerald-600"><?= html_escape($position->salary_range); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if ($position->application_deadline): ?>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Deadline</span>
                                <span class="font-semibold text-red-600"><?= date('d M Y', strtotime($position->application_deadline)); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 border border-blue-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Cara Melamar</h3>
                        <div class="space-y-3 text-sm text-gray-600">
                            <div class="flex items-start gap-3">
                                <div class="rounded-full bg-blue-500 text-white w-6 h-6 flex items-center justify-center text-xs font-bold">1</div>
                                <span>Klik tombol "Lamar Sekarang" di bawah</span>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="rounded-full bg-blue-500 text-white w-6 h-6 flex items-center justify-center text-xs font-bold">2</div>
                                <span>Isi formulir aplikasi dengan lengkap</span>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="rounded-full bg-blue-500 text-white w-6 h-6 flex items-center justify-center text-xs font-bold">3</div>
                                <span>Upload CV dan dokumen pendukung</span>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="rounded-full bg-blue-500 text-white w-6 h-6 flex items-center justify-center text-xs font-bold">4</div>
                                <span>Tunggu konfirmasi dari tim HR</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="apply-form" class="bg-gradient-to-br from-gray-900 via-slate-900 to-gray-900 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-white mb-4">Lamar Posisi Ini</h2>
            <p class="text-white/80 mb-8">Kirim aplikasi Anda untuk bergabung dengan tim ASET Academy sebagai <?= html_escape($position->title); ?></p>
            
            <?php if ($this->session->flashdata('success')): ?>
                <div class="mb-6 rounded-lg bg-green-500/20 border border-green-500/30 p-4 text-green-300">
                    <i class="fas fa-check-circle mr-2"></i><?= $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($this->session->flashdata('error')): ?>
                <div class="mb-6 rounded-lg bg-red-500/20 border border-red-500/30 p-4 text-red-300">
                    <i class="fas fa-exclamation-circle mr-2"></i><?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>
            
            <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10">
                <form action="<?= site_url('career/apply/' . $encryptedId); ?>" method="post" enctype="multipart/form-data" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Nama Lengkap *</label>
                            <input type="text" name="full_name" required class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Email *</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Nomor Telepon *</label>
                            <input type="tel" name="phone" required class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">LinkedIn Profile</label>
                            <input type="url" name="linkedin" class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">CV/Resume *</label>
                        <input type="file" name="cv" required accept=".pdf,.doc,.docx" class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white file:bg-white/20 file:border-0 file:rounded-lg file:px-4 file:py-2 file:text-white file:mr-4">
                        <p class="text-white/60 text-sm mt-2">Format yang diterima: PDF, DOC, DOCX (Maksimal 5MB)</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Portfolio/GitHub (Opsional)</label>
                        <input type="url" name="portfolio" class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Cover Letter *</label>
                        <textarea name="cover_letter" rows="6" required class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20" placeholder="Ceritakan mengapa Anda tertarik dengan posisi ini dan bagaimana Anda dapat berkontribusi..."></textarea>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <input type="checkbox" name="agree_terms" required class="mt-1 rounded border-white/20 bg-white/10 text-blue-500 focus:ring-blue-400">
                        <label class="text-sm text-white/80">Saya setuju dengan <a href="#" class="text-blue-300 hover:text-blue-200">syarat dan ketentuan</a> serta <a href="#" class="text-blue-300 hover:text-blue-200">kebijakan privasi</a> ASET Academy</label>
                    </div>
                    
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-3 px-6 rounded-lg hover:shadow-lg transition-all duration-200 hover:scale-105">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Aplikasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="bg-gradient-to-br from-slate-50 via-white to-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="text-center" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Posisi Lainnya</h2>
            <p class="text-gray-600 mb-8">Jelajahi peluang karier lainnya di ASET Academy</p>
            <a href="<?= site_url('career'); ?>" class="inline-flex items-center rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-3 text-base font-semibold text-white shadow-lg transition hover:-translate-y-0.5 hover:shadow-xl">
                Lihat Semua Lowongan
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<?php $this->load->view('home/templates/_footer'); ?>
