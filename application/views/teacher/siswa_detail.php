<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold"><?= $title; ?></h1>
            <a href="<?php echo site_url('teacher/siswa'); ?>" class="inline-flex items-center px-4 py-2 bg-white text-indigo-600 font-bold rounded-lg shadow-md hover:bg-gray-100 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar Siswa
            </a>
        </div>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-sm opacity-90">NIS: <?= $siswa->nis; ?></p>
                <p class="text-sm opacity-90">Kelas: <?= $siswa->kelas; ?></p>
            </div>
            <div>
                <p class="text-sm opacity-90">Jurusan: <?= $siswa->jurusan; ?></p>
                <p class="text-sm opacity-90">Status: <?= $siswa->status; ?></p>
            </div>
            <div>
                <p class="text-sm opacity-90">Email: <?= $siswa->email; ?></p>
                <p class="text-sm opacity-90">No. Telepon: <?= $siswa->no_telepon; ?></p>
            </div>
        </div>
    </div>

    <!-- Enrollment in Your Classes -->
    <?php if (!empty($enrollment_data)): ?>
    <div class="bg-white rounded-2xl shadow-md p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            <i class="fas fa-chalkboard-teacher text-indigo-600 mr-2"></i>
            Kelas yang Anda Ajar
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($enrollment_data as $enrollment): ?>
                <div class="p-4 border-l-4 <?php echo $enrollment->class_type == 'Premium' ? 'border-yellow-500 bg-yellow-50' : 'border-green-500 bg-green-50'; ?> rounded-lg">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="font-semibold text-lg text-gray-900"><?php echo $enrollment->class_name; ?></h3>
                            <div class="mt-2 space-y-1">
                                <p class="text-sm text-gray-600">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium <?php echo $enrollment->class_type == 'Premium' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800'; ?>">
                                        <i class="<?php echo $enrollment->class_type == 'Premium' ? 'fas fa-crown' : 'fas fa-gift'; ?> mr-1"></i>
                                        <?php echo $enrollment->class_type == 'Free' ? 'Gratis' : $enrollment->class_type; ?>
                                    </span>
                                </p>
                                <p class="text-sm text-gray-600">
                                    Status: 
                                    <span class="font-medium <?php 
                                        if (in_array($enrollment->enrollment_status, ['Active', 'Enrolled'])) echo 'text-green-600';
                                        elseif ($enrollment->enrollment_status == 'Completed') echo 'text-blue-600';
                                        elseif ($enrollment->enrollment_status == 'Pending') echo 'text-yellow-600';
                                        else echo 'text-gray-600';
                                    ?>">
                                        <?php echo $enrollment->enrollment_status; ?>
                                    </span>
                                </p>
                                <p class="text-sm text-gray-600">
                                    Progress: 
                                    <span class="font-medium text-indigo-600"><?php echo $enrollment->progress_percentage; ?>%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Progress bar -->
                    <div class="mt-3">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full transition-all" style="width: <?php echo $enrollment->progress_percentage; ?>%"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Enrolled Classes -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Programming Classes -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Kelas Programming</h2>
            <?php if (!empty($programming_classes)): ?>
                <div class="space-y-4">
                    <?php foreach ($programming_classes as $class): ?>
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-semibold text-lg"><?= $class['nama_kelas']; ?></h3>
                            <p class="text-sm text-gray-600">Level: <?= $class['level']; ?></p>
                            <p class="text-sm text-gray-600">Bahasa: <?= $class['bahasa_program']; ?></p>
                            <p class="text-sm text-gray-600">Bergabung: <?= date('d M Y', strtotime($class['enrollment_date'])); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center text-gray-500 py-4">Siswa belum terdaftar di kelas programming</p>
            <?php endif; ?>
        </div>

        <!-- Free Classes -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Kelas Gratis</h2>
            <?php if (!empty($free_classes)): ?>
                <div class="space-y-4">
                    <?php foreach ($free_classes as $class): ?>
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-semibold text-lg"><?= $class['title']; ?></h3>
                            <p class="text-sm text-gray-600">Level: <?= $class['level']; ?></p>
                            <p class="text-sm text-gray-600">Kategori: <?= $class['category']; ?></p>
                            <p class="text-sm text-gray-600">Bergabung: <?= date('d M Y', strtotime($class['enrollment_date'])); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center text-gray-500 py-4">Siswa belum terdaftar di kelas gratis</p>
            <?php endif; ?>
        </div>
    </div>
</div>
