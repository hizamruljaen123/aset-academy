<div class="max-w-screen-xl mx-auto p-4">
    <div class="mb-6">
        <a href="<?= site_url('admin/workshops') ?>" class="text-blue-600 hover:text-blue-800 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Workshop
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-start mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Detail Workshop: <?= $workshop->title ?></h1>
            <div class="flex space-x-2">
                <a href="<?= site_url('admin/workshops/edit/' . encrypt_url($workshop->id)) ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="<?= admin_workshop_participants_url($workshop->id) ?>" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors flex items-center">
                    <i class="fas fa-users mr-2"></i> Peserta
                </a>
            </div>
        </div>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p><?= $this->session->flashdata('success') ?></p>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p><?= $this->session->flashdata('error') ?></p>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Workshop</label>
                                <p class="text-gray-900 font-medium"><?= $workshop->title ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    <?= $workshop->type == 'workshop' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' ?>">
                                    <?= ucfirst($workshop->type) ?>
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                                <p class="text-gray-900">
                                    <?php if ($workshop->price > 0): ?>
                                        <span class="font-bold text-green-600">Rp <?= number_format($workshop->price, 0, ',', '.') ?></span>
                                    <?php else: ?>
                                        <span class="text-green-600 font-medium">Gratis</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    <?php if ($workshop->status == 'published'): ?>
                                        bg-green-100 text-green-800
                                    <?php elseif ($workshop->status == 'draft'): ?>
                                        bg-yellow-100 text-yellow-800
                                    <?php else: ?>
                                        bg-gray-100 text-gray-800
                                    <?php endif; ?>">
                                    <?= ucfirst($workshop->status) ?>
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai</label>
                                <p class="text-gray-900">
                                    <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                    <?= date('d M Y H:i', strtotime($workshop->start_datetime)) ?>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Selesai</label>
                                <p class="text-gray-900">
                                    <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                    <?= date('d M Y H:i', strtotime($workshop->end_datetime)) ?>
                                </p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                                <p class="text-gray-900">
                                    <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                                    <?= $workshop->location ?>
                                </p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Link Online Meeting</label>
                                <?php if ($workshop->online_meet): ?>
                                    <a href="<?= $workshop->online_meet ?>" target="_blank"
                                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        <i class="fas fa-video mr-2"></i>
                                        Join Meeting
                                        <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                                    </a>
                                    <p class="mt-2 text-xs text-gray-500 break-all">
                                        <i class="fas fa-link mr-1"></i>
                                        <?= $workshop->online_meet ?>
                                    </p>
                                <?php else: ?>
                                    <div class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-gray-50 cursor-not-allowed">
                                        <i class="fas fa-video-slash mr-2"></i>
                                        Tidak Ada Link Meeting
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Maksimal Peserta</label>
                                <p class="text-gray-900 font-medium"><?= $workshop->max_participants ?> orang</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Peserta Terdaftar</label>
                                <p class="text-gray-900 font-medium"><?= count($participants) ?> orang</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi Workshop</h2>
                        <div class="prose max-w-none text-gray-700">
                            <?= $workshop->description ?>
                        </div>
                    </div>

                    <!-- Poster -->
                    <?php if ($workshop->thumbnail): ?>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Poster Workshop</h2>
                        <div class="flex justify-center">
                            <img src="<?= base_url($workshop->thumbnail) ?>" alt="Poster <?= $workshop->title ?>"
                                 class="max-w-full max-h-96 rounded-lg shadow-lg"
                                 onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="max-w-full max-h-96 flex items-center justify-center" style="display: none;">
                                <div class="text-center text-gray-500">
                                    <i class="fas fa-chalkboard-teacher text-6xl mb-4"></i>
                                    <p class="text-lg font-medium">Poster Error</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Materials Section -->
                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Materi Workshop</h2>

                    <?php if (empty($materials)): ?>
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-file-alt text-3xl mb-2"></i>
                            <p>Belum ada materi</p>
                        </div>
                    <?php else: ?>
                        <div class="divide-y divide-gray-200">
                            <?php foreach ($materials as $material): ?>
                                <div class="py-3 flex justify-between items-center">
                                    <div class="flex-1 min-w-0">
                                        <p class="font-medium text-gray-800 truncate" title="<?= $material->title ?>"><?= $material->title ?></p>
                                        <p class="text-xs text-gray-500 uppercase"><?= $material->file_type ?></p>
                                    </div>
                                    <div class="flex space-x-2 ml-2">
                                        <a href="<?= base_url($material->file_path) ?>" target="_blank"
                                           class="text-blue-600 hover:text-blue-800 p-1" title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-4 text-center">
                            <a href="<?= site_url('admin/workshops/manage_materials/' . encrypt_url($workshop->id)) ?>"
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Kelola Materi <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Participants Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Peserta Terdaftar</h2>

                    <div class="mb-4">
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-blue-600"><?= count($participants) ?></span>
                            <span class="text-sm text-gray-500">dari <?= $workshop->max_participants ?> maksimal</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?= min(100, (count($participants) / max(1, $workshop->max_participants)) * 100) ?>%"></div>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">
                            <?php
                            $percentage = $workshop->max_participants > 0 ? (count($participants) / $workshop->max_participants) * 100 : 0;
                            echo round($percentage, 1) . '% terisi';
                            ?>
                        </div>
                    </div>

                    <?php if (!empty($participants)): ?>
                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-900 mb-2">Peserta Terbaru</h3>
                            <div class="space-y-2">
                                <?php foreach (array_slice($participants, 0, 3) as $participant): ?>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600 text-xs"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                <?= $participant->user_id ? $participant->nama_lengkap : $participant->external_name ?>
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                <?= date('d M Y', strtotime($participant->registered_at)) ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <a href="<?= admin_workshop_participants_url($workshop->id) ?>"
                       class="block w-full bg-blue-600 text-white text-center py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
                        <i class="fas fa-users mr-2"></i>
                        Lihat Semua Peserta
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
