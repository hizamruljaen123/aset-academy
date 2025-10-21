<div class="p-4 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Header with gradient background -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl text-white">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold"><?php echo $material->judul; ?></h1>
            <div class="flex items-center mt-2 text-blue-100">
                <i class="fas fa-graduation-cap mr-2"></i>
                <p><?php echo $enrollment->nama_kelas; ?></p>
            </div>
        </div>
        <a href="<?php echo site_url('student/premium/learn/' . encrypt_url($enrollment->id)); ?>" class="inline-flex items-center px-4 py-2 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Kelas
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Material Navigation -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Navigasi Materi</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-2">
                        <?php foreach ($all_materials as $index => $item): ?>
                            <?php
                            $item_progress = isset($material_progress_map[$item->id]) ? $material_progress_map[$item->id] : null;
                            ?>
                            <a href="<?php echo site_url('student/premium/material/' . encrypt_url($enrollment->id) . '/' . encrypt_url($item->id)); ?>" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors <?php echo ($item->id == $material->id) ? 'bg-blue-50 border-l-4 border-blue-500' : ''; ?>">
                                <div class="h-6 w-6 rounded-full <?php echo ($item_progress && $item_progress->status == 'Completed') ? 'bg-green-600' : (($item_progress && $item_progress->status == 'In Progress') ? 'bg-blue-600' : 'bg-gray-300'); ?> flex items-center justify-center text-white text-xs font-medium mr-3">
                                    <?php echo ($item_progress && $item_progress->status == 'Completed') ? '<i class="fas fa-check"></i>' : ($index + 1); ?>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium <?php echo ($item->id == $material->id) ? 'text-blue-800' : 'text-gray-800'; ?> line-clamp-1"><?php echo $item->judul; ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Material Progress -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Progress</h2>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-gray-700">Status Materi</span>
                            <span class="text-sm font-medium
                                <?php
                                if ($progress && $progress->status == 'Completed') echo 'text-green-600';
                                elseif ($progress && $progress->status == 'In Progress') echo 'text-blue-600';
                                else echo 'text-gray-600';
                                ?>">
                                <?php
                                if ($progress && $progress->status == 'Completed') echo 'Selesai';
                                elseif ($progress && $progress->status == 'In Progress') echo 'Sedang Dipelajari';
                                else echo 'Belum Dimulai';
                                ?>
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="<?php echo ($progress && $progress->status == 'Completed') ? 'bg-green-600' : 'bg-blue-600'; ?> h-2.5 rounded-full" style="width: <?php echo ($progress && $progress->status == 'Completed') ? '100' : ($progress && $progress->status == 'In Progress' ? '50' : '0'); ?>%"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-gray-700">Progress Keseluruhan</span>
                            <span class="text-sm font-medium text-blue-600"><?php echo $enrollment->progress; ?>%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?php echo $enrollment->progress; ?>%"></div>
                        </div>
                    </div>

                    <?php if ($progress && $progress->last_accessed): ?>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-xs text-gray-500">Terakhir diakses:</p>
                        <p class="text-sm font-medium"><?php echo date('d F Y H:i', strtotime($progress->last_accessed)); ?></p>
                    </div>
                    <?php endif; ?>

                    <?php if ($progress && $progress->status != 'Completed'): ?>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <a href="<?php echo site_url('student/premium/complete_material/' . $enrollment->id . '/' . $material->id); ?>" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300 hover:scale-105">
                            <i class="fas fa-check-circle mr-2"></i>
                            Tandai Selesai
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <!-- Material Content -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex items-center">
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-600 text-white text-sm font-medium mr-3">
                            <i class="fas fa-file-alt"></i>
                        </span>
                        <h2 class="text-xl font-bold text-gray-800">Materi Pembelajaran</h2>
                    </div>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4"><?php echo $material->judul; ?></h3>
                        <div class="prose max-w-none text-gray-600 mb-6">
                            <?php echo $material->deskripsi; ?>
                        </div>
                    </div>

                    <div class="prose max-w-none text-gray-600 bg-gray-50 p-6 rounded-lg">
                        <?php echo $material->deskripsi; ?>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex justify-between items-center">
                <?php if ($prev_material): ?>
                <a href="<?php echo site_url('student/premium/material/' . encrypt_url($enrollment->id) . '/' . encrypt_url($prev_material->id)); ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Materi Sebelumnya
                </a>
                <?php else: ?>
                <div></div>
                <?php endif; ?>

                <?php if ($next_material): ?>
                <a href="<?php echo site_url('student/premium/material/' . encrypt_url($enrollment->id) . '/' . encrypt_url($next_material->id)); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                    Materi Selanjutnya
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <?php else: ?>
                <div></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
    /* Animation styles */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Line clamp for text truncation */
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
