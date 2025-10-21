<div class="space-y-8">
    <section class="bg-white rounded-2xl shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">Kelas Premium</h2>
            <a href="<?= site_url('student/premium'); ?>" class="text-sm text-blue-600 hover:underline">Kelola Kelas Premium</a>
        </div>

        <?php if (!empty($premium_classes)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($premium_classes as $class): ?>
                    <div class="border border-gray-200 rounded-xl p-5 flex flex-col gap-3 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">
                                <?= $class->class_name ?? 'Kelas Premium'; ?>
                            </h3>
                            <span class="px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded-full">PREMIUM</span>
                        </div>
                        <p class="text-sm text-gray-500">
                            <?php
                                $premiumDescription = $class->deskripsi ? strip_tags($class->deskripsi) : '';
                                if ($premiumDescription !== '') {
                                    if (function_exists('mb_strlen')) {
                                        if (mb_strlen($premiumDescription) > 120) {
                                            $premiumDescription = rtrim(mb_substr($premiumDescription, 0, 117)) . '...';
                                        }
                                    } else {
                                        if (strlen($premiumDescription) > 120) {
                                            $premiumDescription = rtrim(substr($premiumDescription, 0, 117)) . '...';
                                        }
                                    }
                                    echo $premiumDescription;
                                } else {
                                    echo 'Kelas premium dengan konten eksklusif.';
                                }
                            ?>
                        </p>
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span>Status: <span class="font-medium text-gray-800"><?= $class->status ?? 'Active'; ?></span></span>
                            <?php if (isset($class->amount)): ?>
                                <span class="font-semibold text-blue-600">Rp <?= number_format((float)$class->amount, 0, ',', '.'); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="flex items-center justify-end gap-3">
                            <a href="<?= site_url('kelas/detail/' . $class->class_id); ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-blue-600">
                                Lihat Detail
                            </a>
                            <a href="<?= site_url('student/premium/learn/' . encrypt_url($class->id)); ?>" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                                Lanjutkan Belajar
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Banner untuk menambah kelas premium -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-dashed border-blue-200 rounded-2xl p-8 text-center">
                <div class="max-w-md mx-auto">
                    <div class="h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-crown text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Kelas Premium</h3>
                    <p class="text-gray-600 mb-6">Mulai perjalanan belajar Anda dengan kelas premium berkualitas tinggi. Dapatkan akses ke materi eksklusif dan sertifikat resmi.</p>
                    <a href="<?= site_url('student/premium'); ?>" class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Kelas Premium
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </section>

    <section class="bg-white rounded-2xl shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">Kelas Gratis</h2>
            <a href="<?= site_url('student/free_classes/my_classes'); ?>" class="text-sm text-blue-600 hover:underline">Kelola Kelas Gratis</a>
        </div>

        <?php if (!empty($free_classes)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($free_classes as $free): ?>
                    <div class="border border-gray-200 rounded-xl p-5 flex flex-col gap-3 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">
                                <?= $free->title ?? 'Kelas Gratis'; ?>
                            </h3>
                            <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">GRATIS</span>
                        </div>
                        <p class="text-sm text-gray-500">
                            Level: <span class="font-medium text-gray-800"><?= $free->level ?? '-'; ?></span> · Kategori: <span class="font-medium text-gray-800"><?= $free->category ?? '-'; ?></span>
                        </p>
                        <div class="text-sm text-gray-600">
                            Status: <span class="font-medium text-gray-800"><?= $free->status ?? 'Enrolled'; ?></span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span>Progress</span>
                            <span class="font-semibold text-blue-600"><?= isset($free->progress) ? (int)$free->progress : 0; ?>%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                            <div class="bg-blue-500 h-2" style="width: <?= isset($free->progress) ? (int)$free->progress : 0; ?>%"></div>
                        </div>
                        <div class="flex items-center justify-end gap-3">
                            <a href="<?= site_url('student/free_classes/view/' . $free->class_id); ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-blue-600">
                                Lihat Detail
                            </a>
                            <a href="<?= site_url('student/free_classes/learn/' . encrypt_url($free->id)); ?>" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
                                Lanjutkan Belajar
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Banner untuk menambah kelas gratis -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-dashed border-green-200 rounded-2xl p-8 text-center">
                <div class="max-w-md mx-auto">
                    <div class="h-16 w-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-graduation-cap text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Kelas Gratis</h3>
                    <p class="text-gray-600 mb-6">Jelajahi berbagai kelas gratis untuk meningkatkan pengetahuan Anda. Belajar kapan saja dan di mana saja tanpa biaya.</p>
                    <a href="<?= site_url('student/free_classes'); ?>" class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>
                        Jelajahi Kelas Gratis
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </section>
</div>
