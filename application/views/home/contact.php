<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

<section class="pt-28 pb-16 bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-10 left-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-72 h-72 bg-white/5 rounded-full blur-2xl"></div>
    </div>
    <div class="relative container mx-auto px-4 text-center text-white" data-aos="fade-up">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Hubungi Tim Aset Academy</h1>
        <p class="text-lg md:text-xl text-white/85 max-w-2xl mx-auto">
            Punya pertanyaan, ingin menjalin kerjasama, atau membutuhkan bantuan? Silakan hubungi kami melalui WhatsApp, email, atau isi formulir di bawah ini.
        </p>
    </div>
</section>

<section class="py-16 bg-gray-50" id="contact-form">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 space-y-6" data-aos="fade-right">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <span class="w-10 h-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mr-3">
                            <i class="fab fa-whatsapp"></i>
                        </span>
                        Hubungi via WhatsApp
                    </h2>
                    <p class="text-gray-600 mb-4">Respons cepat dalam jam kerja Senin - Jumat 09:00 - 17:00 WIB.</p>
                    <a href="https://wa.me/<?= $contact_channels['whatsapp']['number']; ?>?text=<?= $contact_channels['whatsapp']['message']; ?>"
                       class="inline-flex items-center px-5 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors shadow">
                        <i class="fab fa-whatsapp mr-3"></i>
                        <?= $contact_channels['whatsapp']['display']; ?>
                    </a>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100" data-aos="fade-right" data-aos-delay="100">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <span class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-envelope"></i>
                        </span>
                        Kirim Email
                    </h2>
                    <p class="text-gray-600">Untuk kebutuhan kerjasama resmi, proposal, atau pertanyaan detail.</p>
                    <a href="mailto:<?= $contact_channels['email']; ?>"
                       class="inline-flex items-center mt-4 px-5 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow">
                        <i class="fas fa-paper-plane mr-3"></i>
                        <?= $contact_channels['email']; ?>
                    </a>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100" data-aos="fade-right" data-aos-delay="200">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <span class="w-10 h-10 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        Kantor
                    </h2>
                    <p class="text-gray-600 leading-relaxed"><?= $contact_channels['office']; ?></p>
                </div>
            </div>

            <div class="lg:col-span-2" data-aos="fade-left">
                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Kirim Pesan</h2>

                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="mb-6 px-4 py-3 rounded-lg bg-green-100 text-green-700 border border-green-200">
                            <?= $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="mb-6 px-4 py-3 rounded-lg bg-red-100 text-red-700 border border-red-200">
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

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="whatsapp_number" class="block text-sm font-semibold text-gray-700 mb-2">Nomor WhatsApp</label>
                                <input type="text" id="whatsapp_number" name="whatsapp_number" class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Contoh: 6281234567890">
                            </div>
                            <div>
                                <label for="message_type" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Pesan <span class="text-red-500">*</span></label>
                                <select id="message_type" name="message_type" class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
                                    <option value="pertanyaan">Pertanyaan Umum</option>
                                    <option value="kerjasama">Kerjasama/Partnership</option>
                                    <option value="dukungan">Dukungan Teknis</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
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
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <label class="group flex items-center rounded-xl border-2 border-gray-200 px-4 py-3 cursor-pointer transition hover:border-blue-400">
                                    <input type="radio" name="preferred_contact" value="whatsapp" class="sr-only peer" checked>
                                    <span class="text-sm font-medium text-gray-700 transition peer-checked:text-blue-600">WhatsApp</span>
                                    <i class="fab fa-whatsapp ml-auto text-green-500 opacity-0 transition group-hover:opacity-100 peer-checked:opacity-100"></i>
                                </label>
                                <label class="group flex items-center rounded-xl border-2 border-gray-200 px-4 py-3 cursor-pointer transition hover:border-blue-400">
                                    <input type="radio" name="preferred_contact" value="email" class="sr-only peer">
                                    <span class="text-sm font-medium text-gray-700 transition peer-checked:text-blue-600">Email</span>
                                    <i class="fas fa-envelope ml-auto text-blue-500 opacity-0 transition group-hover:opacity-100 peer-checked:opacity-100"></i>
                                </label>
                                <label class="group flex items-center rounded-xl border-2 border-gray-200 px-4 py-3 cursor-pointer transition hover:border-blue-400">
                                    <input type="radio" name="preferred_contact" value="telepon" class="sr-only peer">
                                    <span class="text-sm font-medium text-gray-700 transition peer-checked:text-blue-600">Telepon</span>
                                    <i class="fas fa-phone ml-auto text-indigo-500 opacity-0 transition group-hover:opacity-100 peer-checked:opacity-100"></i>
                                </label>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <p class="text-sm text-gray-500">Dengan mengirimkan formulir ini, Anda menyetujui bahwa data Anda akan digunakan untuk menindaklanjuti permintaan.</p>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg transition-all">
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

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-10 md:p-14 text-white" data-aos="zoom-in">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8">
                <div>
                    <h2 class="text-3xl font-bold mb-3">Butuh jawaban cepat?</h2>
                    <p class="text-white/80 text-lg max-w-2xl">Tim kami siap membantu kebutuhan Anda. Kami biasanya merespons dalam 1x24 jam di hari kerja.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="https://wa.me/<?= $contact_channels['whatsapp']['number']; ?>?text=<?= $contact_channels['whatsapp']['message']; ?>"
                       class="px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors text-center">
                        Chat WhatsApp
                    </a>
                    <a href="mailto:<?= $contact_channels['email']; ?>"
                       class="px-6 py-3 border border-white/80 text-white font-semibold rounded-lg hover:bg-white/10 transition-colors text-center">
                        Kirim Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('home/templates/_footer'); ?>
