<?php if (!empty($upcoming_workshops)): ?>
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Workshop & Seminar</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Tingkatkan keahlianmu melalui sesi interaktif bersama para ahli di bidangnya.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($upcoming_workshops as $workshop): ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 border border-transparent hover:border-indigo-500" data-aos="fade-up" data-aos-delay="100">
                <div class="relative h-48 overflow-hidden">
                    <?php if ($workshop->thumbnail): ?>
                        <img src="<?= base_url($workshop->thumbnail) ?>" alt="<?= html_escape($workshop->title) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <?php else: ?>
                        <div class="w-full h-full bg-indigo-100 flex items-center justify-center">
                            <i class="fas fa-chalkboard-teacher text-indigo-400 text-5xl"></i>
                        </div>
                    <?php endif; ?>
                    <div class="absolute top-4 right-4 bg-indigo-600 text-white px-3 py-1 rounded-full text-sm font-bold shadow-md">
                        <?= ucfirst($workshop->type) ?>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3 truncate" title="<?= html_escape($workshop->title) ?>"><?= html_escape($workshop->title) ?></h3>
                    
                    

                    <div class="space-y-3 text-gray-600">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt w-5 mr-2 text-indigo-500"></i>
                            <span><?= date('d F Y, H:i', strtotime($workshop->start_datetime)) ?> WIB</span>
                        </div>
                        
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt w-5 mr-2 text-indigo-500"></i>
                            <span><?= html_escape($workshop->location) ?></span>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <?php if ($workshop->status == 'coming soon'): ?>
                            <button class="w-full text-center bg-gradient-to-r from-gray-400 to-gray-500 text-white px-5 py-2 rounded-lg cursor-not-allowed font-semibold text-sm" disabled>
                                Coming Soon
                            </button>
                        <?php else: ?>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-indigo-600"><?= $workshop->price > 0 ? 'Rp ' . number_format($workshop->price, 0, ',', '.') : 'Gratis' ?></span>
                                <a href="<?= workshop_detail_url($workshop->id) ?>" class="bg-indigo-500 text-white px-5 py-2 rounded-lg hover:bg-indigo-600 transition-colors font-semibold text-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-12">
            <a href="<?= site_url('workshops') ?>" class="text-indigo-600 font-semibold hover:underline">
                Lihat Semua Workshop & Seminar <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>
