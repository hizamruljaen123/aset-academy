<div class="p-4 transition-opacity duration-500 opacity-0">
    <div class="max-w-7xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="<?= site_url('student/workshops') ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Workshop
            </a>
        </div>

        <?php if (isset($workshop) && $workshop): ?>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Workshop Header -->
            <div class="h-64 bg-gradient-to-r from-green-500 to-teal-600 flex items-center justify-center relative">
                <?php if ($workshop->thumbnail): ?>
                    <img src="<?= base_url($workshop->thumbnail) ?>" alt="<?= $workshop->title ?>" class="h-full w-full object-cover">
                <?php else: ?>
                    <div class="text-white text-7xl">
                        <i class="fas fa-users"></i>
                    </div>
                <?php endif; ?>

                <!-- Workshop Type Badge -->
                <div class="absolute top-6 left-6">
                    <span class="px-3 py-1 bg-white bg-opacity-90 text-gray-800 rounded-full text-sm font-bold">
                        <?= ucfirst($workshop->type) ?>
                    </span>
                </div>

                <!-- Status Badge -->
                <div class="absolute top-6 right-6">
                    <?php if ($workshop->status == 'published'): ?>
                        <span class="px-3 py-1 bg-green-500 text-white rounded-full text-sm font-bold">
                            <i class="fas fa-check-circle mr-1"></i>
                            Aktif
                        </span>
                    <?php else: ?>
                        <span class="px-3 py-1 bg-gray-500 text-white rounded-full text-sm font-bold">
                            <i class="fas fa-clock mr-1"></i>
                            Draft
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="p-8">
                <!-- Workshop Info -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-6">
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">
                            <?= $workshop->title ?>
                        </h1>

                        <div class="prose max-w-none mb-6">
                            <div class="text-gray-700 leading-relaxed">
                                <?= nl2br(htmlspecialchars($workshop->description)) ?>
                            </div>
                        </div>

                       
                    </div>
                    

                    <!-- Registration Card -->
                    <div class="lg:col-span-6">
                        <div class="bg-gray-50 rounded-lg p-6 sticky top-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">
                                <?php if ($is_registered): ?>
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    Sudah Terdaftar
                                <?php else: ?>
                                    <i class="fas fa-user-plus text-blue-500 mr-2"></i>
                                    Daftar Workshop
                                <?php endif; ?>
                            </h3>

                            <?php if ($is_registered): ?>
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-check text-green-600 text-2xl"></i>
                                    </div>
                                    <p class="text-green-700 font-semibold mb-4">
                                        Anda telah terdaftar untuk workshop ini!
                                    </p>
                                    <div class="space-y-2 text-sm text-gray-600">
                                        <p><strong>Tanggal Daftar:</strong><br>
                                           <?= date('d M Y H:i', strtotime($is_registered->registered_at)) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php if ($workshop->max_participants == 0 || $remaining_spots > 0): ?>
                                    <p class="text-gray-600 mb-4">
                                        Daftarkan diri Anda untuk mengikuti workshop ini.
                                    </p>

                                    <?php if ($workshop->price > 0): ?>
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
                                        <div class="flex items-center">
                                            <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
                                            <span class="text-yellow-800 text-sm font-medium">
                                                Biaya workshop: Rp <?= number_format($workshop->price, 0, ',', '.') ?>
                                            </span>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <button onclick="registerWorkshop(<?= $workshop->id ?>)"
                                            class="w-full py-3 px-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all transform hover:scale-105 font-semibold">
                                        <i class="fas fa-user-plus mr-2"></i>
                                        Daftar Sekarang
                                    </button>
                                <?php else: ?>
                                    <div class="text-center">
                                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <i class="fas fa-times text-red-600 text-2xl"></i>
                                        </div>
                                        <p class="text-red-700 font-semibold mb-2">
                                            Workshop Penuh
                                        </p>
                                        <p class="text-gray-600 text-sm">
                                            Workshop ini telah mencapai kapasitas maksimal.
                                        </p>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <br>
                         <!-- Workshop Details -->
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-4">
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <i class="fas fa-calendar-alt text-blue-500 mr-3 text-lg"></i>
                                    <div>
                                        <div class="font-semibold text-gray-800">Tanggal</div>
                                        <div class="text-gray-600">
                                            <?= date('l, d F Y', strtotime($workshop->start_datetime)) ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <i class="fas fa-clock text-blue-500 mr-3 text-lg"></i>
                                    <div>
                                        <div class="font-semibold text-gray-800">Waktu</div>
                                        <div class="text-gray-600">
                                            <?= date('H:i', strtotime($workshop->start_datetime)) ?> -
                                            <?= date('H:i', strtotime($workshop->end_datetime)) ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <i class="fas fa-map-marker-alt text-blue-500 mr-3 text-lg"></i>
                                    <div>
                                        <div class="font-semibold text-gray-800">Lokasi</div>
                                        <div class="text-gray-600">
                                            <?= $workshop->location ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <i class="fas fa-link text-blue-500 mr-3 text-lg"></i>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-800 mb-2">Link Online Meeting</div>
                                        <?php if ($workshop->online_meet): ?>
                                            <a href="<?= $workshop->online_meet ?>" target="_blank"
                                               class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                                <i class="fas fa-video mr-2"></i>
                                                Join Meeting
                                                <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                                            </a>
                                            <p class="mt-2 text-xs text-gray-500 break-all">
                                                <i class="fas fa-link mr-1"></i>
                                                <?= $workshop->online_meet ?>
                                            </p>
                                        <?php else: ?>
                                            <div class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-gray-50 cursor-not-allowed">
                                                <i class="fas fa-video-slash mr-2"></i>
                                                Tidak Ada Link Meeting
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <i class="fas fa-tag text-blue-500 mr-3 text-lg"></i>
                                    <div>
                                        <div class="font-semibold text-gray-800">Biaya</div>
                                        <div class="text-gray-600">
                                            <?php if ($workshop->price > 0): ?>
                                                Rp <?= number_format($workshop->price, 0, ',', '.') ?>
                                            <?php else: ?>
                                                <span class="text-green-600 font-semibold">Gratis</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Info Column -->
                            <div class="space-y-4">
                                <!-- Capacity Info -->
                                <?php if ($workshop->max_participants > 0): ?>
                                <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                                    <i class="fas fa-users text-blue-500 mr-3 text-lg"></i>
                                    <div>
                                        <div class="font-semibold text-gray-800">Kapasitas</div>
                                        <?php
                                        $participants = $this->Workshop_model->get_participants($workshop->id);
                                        $remaining_spots = $workshop->max_participants - count($participants);
                                        ?>
                                        <div class="text-gray-600">
                                            <?= count($participants) ?>/<?= $workshop->max_participants ?> peserta terdaftar
                                            <?php if ($remaining_spots > 0): ?>
                                                <span class="text-green-600 font-semibold">(<?= $remaining_spots ?> slot tersisa)</span>
                                            <?php else: ?>
                                                <span class="text-red-600 font-semibold">(Penuh)</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <!-- Workshop Type -->
                                <div class="flex items-center p-3 bg-purple-50 rounded-lg">
                                    <i class="fas fa-tag text-purple-500 mr-3 text-lg"></i>
                                    <div>
                                        <div class="font-semibold text-gray-800">Jenis Workshop</div>
                                        <div class="text-gray-600">
                                            <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-bold">
                                                <?= ucfirst($workshop->type) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                    <i class="fas fa-info-circle text-green-500 mr-3 text-lg"></i>
                                    <div>
                                        <div class="font-semibold text-gray-800">Status</div>
                                        <div class="text-gray-600">
                                            <?php if ($workshop->status == 'published'): ?>
                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                                                    <i class="fas fa-check-circle mr-1"></i>
                                                    Aktif
                                                </span>
                                            <?php else: ?>
                                                <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-bold">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    Draft
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="bg-white p-8 rounded-xl shadow-lg text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Workshop Tidak Ditemukan</h3>
            <p class="text-gray-500">Workshop yang Anda cari tidak tersedia atau sudah tidak aktif.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
function registerWorkshop(workshopId) {
    if (confirm('Apakah Anda yakin ingin mendaftar workshop ini?')) {
        window.location.href = '<?= site_url("student/workshops/register/") ?>' + workshopId;
    }
}

// Fade in animation
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        document.querySelector('.p-4').classList.remove('opacity-0');
    }, 100);
});
</script>
