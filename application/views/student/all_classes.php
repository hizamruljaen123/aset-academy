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
                            <a href="<?= site_url('student/premium/learn/' . $class->id); ?>" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                                Lanjutkan Belajar
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-10 text-gray-500">
                Belum ada kelas premium yang aktif.
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
                            <a href="<?= site_url('student/free_classes/view/' . $free->id); ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-blue-600">
                                Lihat Detail
                            </a>
                            <a href="<?= site_url('student/free_classes/learn/' . $free->id); ?>" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
                                Lanjutkan Belajar
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-10 text-gray-500">
                Belum ada kelas gratis yang diikuti.
            </div>
        <?php endif; ?>
    </section>
</div>
