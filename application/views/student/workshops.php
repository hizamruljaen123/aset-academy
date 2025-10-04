<div class="p-4 transition-opacity duration-500 opacity-0">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-xl shadow-lg">
        <ul class="flex space-x-4" id="workshopTabs">
            <li><button data-tab="available" class="tab-link px-4 py-2 rounded-lg bg-blue-600 text-white">Workshop Tersedia</button></li>
            <li><button data-tab="myworkshops" class="tab-link px-4 py-2 rounded-lg bg-gray-100 text-gray-700">Workshop Saya</button></li>
        </ul>
    </div>

    <div class="grid grid-cols-1 gap-8" id="tabPanels">
    <!-- AVAILABLE WORKSHOPS -->
    <div id="panel-available" class="tab-panel">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Workshop & Seminar Tersedia</h2>
        <?php if (!empty($workshops)): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach($workshops as $workshop): ?>
                            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
                                <div class="h-48 bg-gradient-to-r from-green-500 to-teal-600 flex items-center justify-center relative">
                                    <?php if ($workshop->thumbnail): ?>
                                        <img src="<?= base_url($workshop->thumbnail) ?>" alt="<?= $workshop->title ?>" class="h-full w-full object-cover">
                                    <?php else: ?>
                                        <div class="text-white text-5xl">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="absolute top-4 right-4">
                                        <span class="px-2 py-1 bg-white bg-opacity-90 text-gray-800 rounded-full text-xs font-bold">
                                            <?= ucfirst($workshop->type) ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2">
                                        <?= $workshop->title ?>
                                    </h3>
                                    <p class="text-gray-600 mb-3 text-sm line-clamp-2">
                                        <?= substr(strip_tags($workshop->description), 0, 100) ?><?= strlen(strip_tags($workshop->description)) > 100 ? '...' : '' ?>
                                    </p>

                                    <div class="space-y-2 mb-4 text-sm text-gray-600">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                            <span><?= date('d M Y', strtotime($workshop->start_datetime)) ?></span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-clock mr-2 text-gray-400"></i>
                                            <span><?= date('H:i', strtotime($workshop->start_datetime)) ?> - <?= date('H:i', strtotime($workshop->end_datetime)) ?></span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                                            <span><?= $workshop->location ?></span>
                                        </div>
                                        <?php if ($workshop->price > 0): ?>
                                        <div class="flex items-center">
                                            <i class="fas fa-tag mr-2 text-gray-400"></i>
                                            <span>Rp <?= number_format($workshop->price, 0, ',', '.') ?></span>
                                        </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <?php if ($workshop->max_participants > 0): ?>
                                            <?php
                                            $participants = $this->Workshop_model->get_participants($workshop->id);
                                            $remaining_spots = $workshop->max_participants - count($participants);
                                            ?>
                                            <span class="text-sm text-gray-500">
                                                <?= count($participants) ?>/<?= $workshop->max_participants ?> peserta
                                            </span>
                                        <?php else: ?>
                                            <span class="text-sm text-gray-500">Tidak terbatas</span>
                                        <?php endif; ?>

                                        <div class="flex space-x-2">
                                            <a href="<?= site_url('student/workshops/detail/'.$workshop->id) ?>"
                                               class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all text-sm font-medium">
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="bg-white p-8 rounded-xl shadow-lg text-center">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-users text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum ada workshop</h3>
                        <p class="text-gray-500">Workshop dan seminar akan segera ditambahkan.</p>
                    </div>
                <?php endif; ?>
    </div>

    <!-- MY WORKSHOPS -->
    <div id="panel-myworkshops" class="tab-panel hidden">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Workshop yang Saya Ikuti</h2>
        <?php if (!empty($my_workshops)): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach($my_workshops as $workshop): ?>
                            <div class="bg-white rounded-xl shadow-md overflow-hidden border-2 border-blue-100">
                                <div class="h-48 bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center relative">
                                    <?php if ($workshop->thumbnail): ?>
                                        <img src="<?= base_url($workshop->thumbnail) ?>" alt="<?= $workshop->title ?>" class="h-full w-full object-cover">
                                    <?php else: ?>
                                        <div class="text-white text-5xl">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="absolute top-4 right-4">
                                        <span class="px-2 py-1 bg-green-500 text-white rounded-full text-xs font-bold">
                                            Terdaftar
                                        </span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2">
                                        <?= $workshop->title ?>
                                    </h3>
                                    <p class="text-gray-600 mb-3 text-sm line-clamp-2">
                                        <?= substr(strip_tags($workshop->description), 0, 100) ?><?= strlen(strip_tags($workshop->description)) > 100 ? '...' : '' ?>
                                    </p>

                                    <div class="space-y-2 mb-4 text-sm text-gray-600">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-check mr-2 text-green-500"></i>
                                            <span>Terdaftar: <?= date('d M Y', strtotime($workshop->registered_at)) ?></span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                            <span><?= date('d M Y', strtotime($workshop->start_datetime)) ?></span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-clock mr-2 text-gray-400"></i>
                                            <span><?= date('H:i', strtotime($workshop->start_datetime)) ?> - <?= date('H:i', strtotime($workshop->end_datetime)) ?></span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                                            <span><?= $workshop->location ?></span>
                                        </div>
                                    </div>

                                    <div class="flex justify-center">
                                        <a href="<?= site_url('student/workshops/detail/'.$workshop->id) ?>"
                                           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all text-sm font-medium">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="bg-white p-8 rounded-xl shadow-lg text-center">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user-clock text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum ada workshop yang diikuti</h3>
                        <p class="text-gray-500 mb-4">Daftar workshop untuk melihatnya di sini.</p>
                        <button onclick="showTab('available')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all">
                            Lihat Workshop Tersedia
                        </button>
                    </div>
                <?php endif; ?>
    </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabButtons = document.querySelectorAll('.tab-link');
    const tabPanels = document.querySelectorAll('.tab-panel');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');

            // Update buttons
            tabButtons.forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-700');
            });
            this.classList.remove('bg-gray-100', 'text-gray-700');
            this.classList.add('bg-blue-600', 'text-white');

            // Update panels
            tabPanels.forEach(panel => {
                panel.classList.add('hidden');
            });
            document.getElementById(`panel-${targetTab}`).classList.remove('hidden');
        });
    });

    // Fade in animation
    setTimeout(() => {
        document.querySelector('.p-4').classList.remove('opacity-0');
    }, 100);
});

function showTab(tabName) {
    const button = document.querySelector(`[data-tab="${tabName}"]`);
    if (button) button.click();
}
</script>
