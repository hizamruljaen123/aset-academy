<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

<section class="relative pt-32 pb-24 overflow-hidden" style="background: linear-gradient(135deg, #0e1127 0%, #2e3c73 50%, #198aad 100%);">
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/5 w-96 h-96 rounded-full pulse-blob" style="background: rgba(30, 60, 115, 0.2);"></div>
        <div class="absolute -bottom-20 right-[10%] w-[420px] h-[330px] rounded-full pulse-blob" style="background: rgba(25, 138, 173, 0.15); animation-delay: 2.5s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 rounded-full pulse-blob" style="background: rgba(14, 17, 39, 0.1); animation-delay: 4s;"></div>
    </div>
    
    <div class="relative container mx-auto px-4 text-center text-white z-10">
        <!-- Badge -->
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 px-5 py-2 rounded-full mb-6" data-aos="zoom-in">
            <i class="fas fa-headset text-white"></i>
            <span class="text-sm font-bold text-white uppercase tracking-wide">Dukungan Pelanggan</span>
        </div>

        <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight" data-aos="fade-up">
            Hubungi <span class="bg-gradient-to-r from-blue-300 to-purple-300 bg-clip-text text-transparent">Tim Kami</span>
        </h1>
        
        <p class="text-xl md:text-2xl text-white/80 max-w-3xl mx-auto mb-10 leading-relaxed" data-aos="fade-up" data-aos-delay="100">
            Punya pertanyaan, ingin menjalin <strong class="text-blue-300">kerjasama</strong>, atau membutuhkan bantuan? 
            Tim kami siap membantu Anda dengan <strong class="text-blue-300">solusi terbaik</strong>
        </p>

        <!-- Contact Methods -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/10 transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-envelope text-white text-xl"></i>
                </div>
                <div class="text-white font-semibold text-lg mb-2">Email</div>
                <div class="text-white/70 text-sm">Respon dalam 1x24 jam</div>
            </div>
            <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/10 transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-phone text-white text-xl"></i>
                </div>
                <div class="text-white font-semibold text-lg mb-2">Telepon</div>
                <div class="text-white/70 text-sm">Senin-Jumat 09:00-17:00</div>
            </div>
            <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/10 transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marker-alt text-white text-xl"></i>
                </div>
                <div class="text-white font-semibold text-lg mb-2">Kantor</div>
                <div class="text-white/70 text-sm">Jakarta, Indonesia</div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gradient-to-br from-slate-50 via-white to-gray-50" id="contact-form">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="lg:col-span-1 space-y-6" data-aos="fade-right">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-right" data-aos-delay="100">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-envelope text-white"></i>
                        </div>
                        Kirim Email
                    </h2>
                    <p class="text-gray-600 mb-4">Untuk kebutuhan kerjasama resmi, proposal, atau pertanyaan detail.</p>
                    <a href="mailto:<?= $contact_channels['email']; ?>"
                       class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all duration-200 hover:scale-105">
                        <i class="fas fa-paper-plane mr-3"></i>
                        <?= $contact_channels['email']; ?>
                    </a>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-right" data-aos-delay="200">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-map-marker-alt text-white"></i>
                        </div>
                        Kantor
                    </h2>
                    <p class="text-gray-600 leading-relaxed"><?= $contact_channels['office']; ?></p>
                </div>
            </div>

            <div class="lg:col-span-1" data-aos="fade-left">
                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 hover:shadow-2xl transition-all duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-paper-plane text-white"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Kirim Pesan</h2>
                    </div>

                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="mb-6 px-4 py-3 rounded-lg bg-green-50 text-green-700 border border-green-200 flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <?= $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="mb-6 px-4 py-3 rounded-lg bg-red-50 text-red-700 border border-red-200 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('home/contact-submit'); ?>" method="post" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Nama lengkap Anda" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="nama@domain.com" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="company" class="block text-sm font-semibold text-gray-700 mb-2">Institusi/Perusahaan</label>
                                <input type="text" id="company" name="company" class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Nama institusi atau perusahaan">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="text" id="phone" name="phone" class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Nomor telepon aktif">
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Subjek <span class="text-red-500">*</span></label>
                            <input type="text" id="subject" name="subject" class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Topik pesan" required>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Pesan <span class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="6" class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Tulis kebutuhan, pertanyaan, atau detail kerjasama yang ingin dibahas" required></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Metode Kontak yang Diinginkan <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <label class="group flex items-center rounded-xl border-2 border-gray-200 px-4 py-3 cursor-pointer transition hover:border-blue-400 hover:bg-blue-50">
                                    <input type="radio" name="preferred_contact" value="email" class="sr-only peer" checked>
                                    <span class="text-sm font-medium text-gray-700 transition peer-checked:text-blue-600">Email</span>
                                    <i class="fas fa-envelope ml-auto text-blue-500 opacity-0 transition group-hover:opacity-100 peer-checked:opacity-100"></i>
                                </label>
                                <label class="group flex items-center rounded-xl border-2 border-gray-200 px-4 py-3 cursor-pointer transition hover:border-blue-400 hover:bg-blue-50">
                                    <input type="radio" name="preferred_contact" value="telepon" class="sr-only peer">
                                    <span class="text-sm font-medium text-gray-700 transition peer-checked:text-blue-600">Telepon</span>
                                    <i class="fas fa-phone ml-auto text-indigo-500 opacity-0 transition group-hover:opacity-100 peer-checked:opacity-100"></i>
                                </label>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <p class="text-sm text-gray-500">Dengan mengirimkan formulir ini, Anda menyetujui bahwa data Anda akan digunakan untuk menindaklanjuti permintaan.</p>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-200 hover:scale-105">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gradient-to-br from-gray-900 via-slate-900 to-gray-900">
    <div class="container mx-auto px-4">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-10 md:p-14 text-white relative overflow-hidden" data-aos="zoom-in">
            <!-- Animated Background -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute top-1/4 left-1/4 w-96 h-96 rounded-full pulse-blob" style="background: rgba(255, 255, 255, 0.1);"></div>
                <div class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full pulse-blob" style="background: rgba(255, 255, 255, 0.05); animation-delay: 2s;"></div>
            </div>
            
            <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold">Butuh Jawaban Cepat?</h2>
                    </div>
                    <p class="text-white/80 text-lg max-w-2xl">Tim kami siap membantu kebutuhan Anda. Kami biasanya merespons dalam 1x24 jam di hari kerja.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="mailto:<?= $contact_channels['email']; ?>"
                       class="px-6 py-3 bg-white/10 backdrop-blur-sm border border-white/30 text-white font-semibold rounded-lg hover:bg-white/20 transition-all duration-200 text-center hover:scale-105">
                        <i class="fas fa-envelope mr-2"></i>Kirim Email
                    </a>
                    <a href="tel:+6289676018562"
                       class="px-6 py-3 bg-white/10 backdrop-blur-sm border border-white/30 text-white font-semibold rounded-lg hover:bg-white/20 transition-all duration-200 text-center hover:scale-105">
                        <i class="fas fa-phone mr-2"></i>Hubungi Langsung
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('home/templates/_footer'); ?>
