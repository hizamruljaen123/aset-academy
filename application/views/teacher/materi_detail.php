<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="p-6 bg-gradient-to-r from-cyan-500 to-teal-500 text-white">
            <div class="flex items-center space-x-4">
                <i class="fas fa-book-open fa-2x"></i>
                <div>
                    <h2 class="text-2xl font-bold"><?php echo $materi->judul; ?></h2>
                    <p class="text-sm opacity-90">Kelas: <?php echo $materi->nama_kelas; ?></p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="prose max-w-none">
                <?php echo $materi->deskripsi; ?>
            </div>

            <hr class="my-8">

            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Materi Pembelajaran</h3>
                <?php if (!empty($parts)): ?>
                    <ul class="space-y-4">
                        <?php foreach ($parts as $part): ?>
                            <li class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <h4 class="font-semibold text-gray-900"><?php echo $part->part_title; ?></h4>
                                <div class="prose max-w-none mt-2">
                                    <?php echo $part->part_content; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-gray-500">Belum ada bagian materi yang ditambahkan.</p>
                <?php endif; ?>
            </div>

            <div class="mt-8 text-right">
                <a href="<?php echo site_url('teacher/materi'); ?>" class="inline-flex items-center px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-sm transition-transform transform hover:scale-105">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Materi
                </a>
            </div>
        </div>
    </div>
</div>
