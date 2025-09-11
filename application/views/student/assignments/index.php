<div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tugas Saya</h1>
    </div>

    <div class="bg-white shadow-lg rounded-xl p-6">
        <h2 class="text-xl font-semibold mb-4 border-b pb-3">Kelas yang Diikuti</h2>

        <?php if (empty($enrollments)): ?>
            <div class="text-center py-12">
                <p class="text-gray-500">Anda belum terdaftar di kelas manapun.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($enrollments as $class): ?>
                    <div class="rounded-lg p-4 hover:shadow-xl transition-shadow border 
                        <?php if($class->type == 'premium'): ?>
                            bg-blue-50 border-blue-200
                        <?php else: ?>
                            bg-green-50 border-green-200
                        <?php endif; ?>
                    ">
                        <h4 class="font-bold 
                            <?php if($class->type == 'premium'): ?>
                                text-blue-800
                            <?php else: ?>
                                text-green-800
                            <?php endif; ?>
                        ">
                            <?= htmlspecialchars($class->nama_kelas, ENT_QUOTES, 'UTF-8'); ?>
                        </h4>
                        <p class="text-sm text-gray-600 mb-4">Level: <?= htmlspecialchars($class->level, ENT_QUOTES, 'UTF-8'); ?></p>
                        <a href="<?= site_url('student/assignments/view_class/' . $class->id . '/' . $class->type); ?>" class="inline-block text-white px-4 py-2 rounded-md text-sm font-semibold 
                            <?php if($class->type == 'premium'): ?>
                                bg-blue-600 hover:bg-blue-700
                            <?php else: ?>
                                bg-green-600 hover:bg-green-700
                            <?php endif; ?>
                        ">
                            Lihat Tugas
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
