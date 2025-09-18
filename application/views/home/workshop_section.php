<?php if (!empty($upcoming_workshops)): ?>
<section class="py-12 bg-gray-50">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold">Workshop & Seminar Mendatang</h2>
            <a href="<?= site_url('workshops') ?>" class="text-blue-500 hover:underline">Lihat Semua</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php foreach ($upcoming_workshops as $workshop): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-48 bg-gray-200 overflow-hidden">
                    <?php if ($workshop->thumbnail): ?>
                    <img src="<?= base_url($workshop->thumbnail) ?>" alt="<?= $workshop->title ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-chalkboard-teacher text-gray-400 text-3xl"></i>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-lg"><?= $workshop->title ?></h3>
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                            <?= $workshop->type == 'workshop' ? 'Workshop' : 'Seminar' ?>
                        </span>
                    </div>
                    
                    <div class="flex items-center text-sm text-gray-600 mb-2">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span><?= date('d M Y', strtotime($workshop->start_datetime)) ?></span>
                    </div>
                    
                    <div class="flex items-center text-sm text-gray-600 mb-3">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span><?= $workshop->location ?></span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-lg"><?= $workshop->price > 0 ? 'Rp' . number_format($workshop->price) : 'Gratis' ?></span>
                        <a href="<?= workshop_detail_url($workshop->id) ?>" class="text-blue-500 hover:underline">Detail</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
