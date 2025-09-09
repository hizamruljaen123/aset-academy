<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-br from-blue-600 to-indigo-700">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6" data-aos="fade-up">
                Pertanyaan Umum (FAQ)
            </h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Temukan jawaban untuk pertanyaan yang sering diajukan tentang Aset Academy
            </p>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 max-w-3xl">
            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="faq-item bg-white rounded-xl shadow-md" data-aos="fade-up">
                    <button class="w-full flex justify-between items-center p-6 text-left">
                        <h3 class="text-lg font-bold text-gray-800">Apakah saya bisa belajar programming dari nol?</h3>
                        <i data-feather="chevron-down" class="w-6 h-6 text-gray-500 transition-transform"></i>
                    </button>
                    <div class="faq-content px-6">
                        <p class="pb-6 text-gray-600">
                            Tentu saja! Kami memiliki kelas khusus untuk pemula yang dirancang untuk membantu Anda belajar programming dari dasar. Instruktur kami akan memandu Anda step by step dengan bahasa yang mudah dipahami.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="faq-item bg-white rounded-xl shadow-md" data-aos="fade-up">
                    <button class="w-full flex justify-between items-center p-6 text-left">
                        <h3 class="text-lg font-bold text-gray-800">Berapa lama waktu yang dibutuhkan untuk menyelesaikan satu kelas?</h3>
                        <i data-feather="chevron-down" class="w-6 h-6 text-gray-500 transition-transform"></i>
                    </button>
                    <div class="faq-content px-6">
                        <p class="pb-6 text-gray-600">
                            Waktu penyelesaian tergantung pada kompleksitas kelas dan waktu yang Anda dedikasikan. Rata-rata, siswa menyelesaikan kelas dalam 2-8 minggu dengan belajar 5-10 jam per minggu.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="faq-item bg-white rounded-xl shadow-md" data-aos="fade-up">
                    <button class="w-full flex justify-between items-center p-6 text-left">
                        <h3 class="text-lg font-bold text-gray-800">Apakah saya akan mendapat sertifikat setelah menyelesaikan kelas?</h3>
                        <i data-feather="chevron-down" class="w-6 h-6 text-gray-500 transition-transform"></i>
                    </button>
                    <div class="faq-content px-6">
                        <p class="pb-6 text-gray-600">
                            Ya, Anda akan mendapat sertifikat resmi setelah menyelesaikan kelas premium. Sertifikat ini dapat digunakan untuk melamar pekerjaan atau ditampilkan di portofolio Anda.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="faq-item bg-white rounded-xl shadow-md" data-aos="fade-up">
                    <button class="w-full flex justify-between items-center p-6 text-left">
                        <h3 class="text-lg font-bold text-gray-800">Apakah ada dukungan teknis jika saya mengalami kesulitan?</h3>
                        <i data-feather="chevron-down" class="w-6 h-6 text-gray-500 transition-transform"></i>
                    </button>
                    <div class="faq-content px-6">
                        <p class="pb-6 text-gray-600">
                            Ya, kami menyediakan berbagai bentuk dukungan: forum diskusi, email support, dan komunitas siswa aktif. Instruktur juga akan menjawab pertanyaan Anda dalam waktu 24 jam.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="faq-item bg-white rounded-xl shadow-md" data-aos="fade-up">
                    <button class="w-full flex justify-between items-center p-6 text-left">
                        <h3 class="text-lg font-bold text-gray-800">Apakah saya bisa mengakses materi kelas kapan saja?</h3>
                        <i data-feather="chevron-down" class="w-6 h-6 text-gray-500 transition-transform"></i>
                    </button>
                    <div class="faq-content px-6">
                        <p class="pb-6 text-gray-600">
                            Ya, semua materi kelas dapat diakses 24/7. Anda bisa belajar sesuai dengan jadwal Anda sendiri tanpa batasan waktu, selama akun Anda masih aktif.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-700">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6" data-aos="fade-up">
                Masih Punya Pertanyaan?
            </h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Tim kami siap membantu menjawab semua pertanyaan Anda
            </p>
            <div data-aos="fade-up" data-aos-delay="200">
                <a href="#" class="px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:bg-gray-100 transition-colors">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>
