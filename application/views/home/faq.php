<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 overflow-hidden" style="background: linear-gradient(135deg, #0e1127 0%, #2e3c73 50%, #198aad 100%);">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/5 w-96 h-96 rounded-full pulse-blob" style="background: rgba(30, 60, 115, 0.2);"></div>
            <div class="absolute -bottom-20 right-[10%] w-[420px] h-[330px] rounded-full pulse-blob" style="background: rgba(25, 138, 173, 0.15); animation-delay: 2.5s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 rounded-full pulse-blob" style="background: rgba(14, 17, 39, 0.1); animation-delay: 4s;"></div>
        </div>
        
        <div class="container mx-auto px-4 text-center relative z-10">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 px-5 py-2 rounded-full mb-6" data-aos="zoom-in">
                <i class="fas fa-question-circle text-white"></i>
                <span class="text-sm font-bold text-white uppercase tracking-wide">Pertanyaan Umum</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6" data-aos="fade-up">
                FAQ - <span class="bg-gradient-to-r from-blue-300 to-purple-300 bg-clip-text text-transparent">Frequently Asked Questions</span>
            </h1>
            <p class="text-xl text-white/80 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Temukan jawaban untuk pertanyaan yang sering diajukan tentang platform pembelajaran kami
            </p>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-gradient-to-br from-slate-50 via-white to-gray-50">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="space-y-6">
                <!-- FAQ Item 1 -->
                <div class="faq-item bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up">
                    <button class="w-full flex justify-between items-center p-6 text-left hover:bg-gray-50 rounded-2xl transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-graduation-cap text-white text-sm"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Apakah saya bisa belajar programming dari nol?</h3>
                        </div>
                        <i class="fas fa-chevron-down w-5 h-5 text-gray-500 transition-transform faq-icon"></i>
                    </button>
                    <div class="faq-content px-6 pb-6">
                        <div class="pl-14">
                            <p class="text-gray-600 leading-relaxed">
                                Tentu saja! Kami memiliki kelas khusus untuk pemula yang dirancang untuk membantu Anda belajar programming dari dasar. Instruktur kami akan memandu Anda step by step dengan bahasa yang mudah dipahami.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="faq-item bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <button class="w-full flex justify-between items-center p-6 text-left hover:bg-gray-50 rounded-2xl transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-clock text-white text-sm"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Berapa lama waktu yang dibutuhkan untuk menyelesaikan satu kelas?</h3>
                        </div>
                        <i class="fas fa-chevron-down w-5 h-5 text-gray-500 transition-transform faq-icon"></i>
                    </button>
                    <div class="faq-content px-6 pb-6">
                        <div class="pl-14">
                            <p class="text-gray-600 leading-relaxed">
                                Waktu penyelesaian tergantung pada kompleksitas kelas dan waktu yang Anda dedikasikan. Rata-rata, siswa menyelesaikan kelas dalam 2-8 minggu dengan belajar 5-10 jam per minggu.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="faq-item bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <button class="w-full flex justify-between items-center p-6 text-left hover:bg-gray-50 rounded-2xl transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-certificate text-white text-sm"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Apakah saya akan mendapat sertifikat setelah menyelesaikan kelas?</h3>
                        </div>
                        <i class="fas fa-chevron-down w-5 h-5 text-gray-500 transition-transform faq-icon"></i>
                    </button>
                    <div class="faq-content px-6 pb-6">
                        <div class="pl-14">
                            <p class="text-gray-600 leading-relaxed">
                                Ya, Anda akan mendapat sertifikat resmi setelah menyelesaikan kelas premium. Sertifikat ini dapat digunakan untuk melamar pekerjaan atau ditampilkan di portofolio Anda.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="faq-item bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                    <button class="w-full flex justify-between items-center p-6 text-left hover:bg-gray-50 rounded-2xl transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-headset text-white text-sm"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Apakah ada dukungan teknis jika saya mengalami kesulitan?</h3>
                        </div>
                        <i class="fas fa-chevron-down w-5 h-5 text-gray-500 transition-transform faq-icon"></i>
                    </button>
                    <div class="faq-content px-6 pb-6">
                        <div class="pl-14">
                            <p class="text-gray-600 leading-relaxed">
                                Ya, kami menyediakan berbagai bentuk dukungan: forum diskusi, email support, dan komunitas siswa aktif. Instruktur juga akan menjawab pertanyaan Anda dalam waktu 24 jam.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="faq-item bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="400">
                    <button class="w-full flex justify-between items-center p-6 text-left hover:bg-gray-50 rounded-2xl transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-laptop text-white text-sm"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Apakah saya bisa mengakses materi kelas kapan saja?</h3>
                        </div>
                        <i class="fas fa-chevron-down w-5 h-5 text-gray-500 transition-transform faq-icon"></i>
                    </button>
                    <div class="faq-content px-6 pb-6">
                        <div class="pl-14">
                            <p class="text-gray-600 leading-relaxed">
                                Ya, semua materi kelas dapat diakses 24/7. Anda bisa belajar sesuai dengan jadwal Anda sendiri tanpa batasan waktu, selama akun Anda masih aktif.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-br from-gray-900 via-slate-900 to-gray-900">
        <div class="container mx-auto px-4 text-center">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-10 md:p-14 text-white relative overflow-hidden" data-aos="zoom-in">
                <!-- Animated Background -->
                <div class="absolute inset-0 overflow-hidden">
                    <div class="absolute top-1/4 left-1/4 w-96 h-96 rounded-full pulse-blob" style="background: rgba(255, 255, 255, 0.1);"></div>
                    <div class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full pulse-blob" style="background: rgba(255, 255, 255, 0.05); animation-delay: 2s;"></div>
                </div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-question-circle text-white text-xl"></i>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold">Masih Punya Pertanyaan?</h2>
                    </div>
                    <p class="text-xl text-white/80 mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                        Tim kami siap membantu menjawab semua pertanyaan Anda
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4" data-aos="fade-up" data-aos-delay="200">
                        <a href="<?= site_url('contact'); ?>" class="px-8 py-4 bg-white/10 backdrop-blur-sm border border-white/30 text-white font-semibold rounded-lg hover:bg-white/20 transition-all duration-200 hover:scale-105">
                            <i class="fas fa-envelope mr-2"></i>Hubungi Kami
                        </a>
                        <a href="<?= site_url('home/about'); ?>" class="px-8 py-4 bg-white/10 backdrop-blur-sm border border-white/30 text-white font-semibold rounded-lg hover:bg-white/20 transition-all duration-200 hover:scale-105">
                            <i class="fas fa-info-circle mr-2"></i>Tentang Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $this->load->view('home/templates/_footer'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const button = item.querySelector('button');
        const content = item.querySelector('.faq-content');
        const icon = item.querySelector('.faq-icon');
        
        // Initially hide all content
        content.style.display = 'none';
        
        button.addEventListener('click', function() {
            const isOpen = content.style.display === 'block';
            
            // Close all other FAQ items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.querySelector('.faq-content').style.display = 'none';
                    otherItem.querySelector('.faq-icon').style.transform = 'rotate(0deg)';
                    otherItem.classList.remove('ring-2', 'ring-blue-500');
                }
            });
            
            // Toggle current item
            if (isOpen) {
                content.style.display = 'none';
                icon.style.transform = 'rotate(0deg)';
                item.classList.remove('ring-2', 'ring-blue-500');
            } else {
                content.style.display = 'block';
                icon.style.transform = 'rotate(180deg)';
                item.classList.add('ring-2', 'ring-blue-500');
            }
        });
    });
});
</script>
