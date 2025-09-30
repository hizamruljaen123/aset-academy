<div class="max-w-screen-1xl mx-auto p-4 sm:p-6 lg:p-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Manajemen Tugas</h1>
                <p class="text-gray-600">Kelola semua tugas siswa dan pantau progres pengumpulan</p>
            </div>
            <div class="flex gap-3">
                <a href="<?= site_url('admin/assignments/create'); ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Buat Tugas Baru
                </a>
                <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors flex items-center gap-2">
                    <i class="fas fa-filter"></i>
                    Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Total Tugas</p>
                    <p class="text-2xl font-bold"><?= count($assignments) ?></p>
                </div>
                <div class="bg-blue-400 bg-opacity-50 p-3 rounded-lg">
                    <i class="fas fa-tasks text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm">Sudah Dinilai</p>
                    <p class="text-2xl font-bold"><?= $stats['graded_submissions'] ?? 0 ?></p>
                </div>
                <div class="bg-green-400 bg-opacity-50 p-3 rounded-lg">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-sm">Belum Dinilai</p>
                    <p class="text-2xl font-bold"><?= $stats['ungraded_submissions'] ?? 0 ?></p>
                </div>
                <div class="bg-yellow-400 bg-opacity-50 p-3 rounded-lg">
                    <i class="fas fa-clock text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm">Rata-rata Nilai</p>
                    <p class="text-2xl font-bold"><?= $stats['average_score'] ?? 0 ?></p>
                </div>
                <div class="bg-purple-400 bg-opacity-50 p-3 rounded-lg">
                    <i class="fas fa-star text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Bar -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
        <div class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" placeholder="Cari tugas..." class="form-search w-full">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            <div class="flex gap-3">
                <select class="form-select">
                    <option>Semua Kelas</option>
                    <?php foreach ($classes as $class): ?>
                        <option value="<?= $class['id'] ?>-<?= $class['type'] ?>"><?= htmlspecialchars($class['name'], ENT_QUOTES, 'UTF-8'); ?> (<?= ucfirst($class['type']) ?>)</option>
                    <?php endforeach; ?>
                </select>
                <select class="form-select">
                    <option>Semua Guru</option>
                    <?php foreach ($teachers as $teacher): ?>
                        <option value="<?= $teacher->id ?>"><?= htmlspecialchars($teacher->nama_lengkap, ENT_QUOTES, 'UTF-8'); ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="form-select">
                    <option>Semua Status</option>
                    <option>Aktif</option>
                    <option>Selesai</option>
                    <option>Draft</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Assignments Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <?php if (empty($assignments)): ?>
            <div class="col-span-full">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-tasks text-gray-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada tugas</h3>
                    <p class="text-gray-500 mb-4">Mulai buat tugas pertama untuk siswa Anda</p>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Buat Tugas Baru
                    </button>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($assignments as $assignment): ?>
                <?php
                // Calculate submission stats for this assignment
                $submissions = $this->assignment->get_submissions($assignment->id);
                $total_submissions = count($submissions);
                $graded_submissions = 0;
                foreach ($submissions as $submission) {
                    if ($submission->status == 'graded' && $submission->grade !== null) {
                        $graded_submissions++;
                    }
                }
                $progress_percentage = $total_submissions > 0 ? round(($graded_submissions / $total_submissions) * 100) : 0;
                
                // Get total students in the class
                $total_students = $this->assignment->get_class_student_count($assignment->class_id, $assignment->class_type);
                ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                    <?= htmlspecialchars($assignment->title, ENT_QUOTES, 'UTF-8'); ?>
                                </h3>
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                        <?= htmlspecialchars($assignment->class_name, ENT_QUOTES, 'UTF-8'); ?>
                                    </span>
                                    <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs">
                                        <?= ucfirst($assignment->class_type); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-sm"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="space-y-3 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-user-tie mr-2 w-4"></i>
                                <span><?= htmlspecialchars($assignment->teacher_name, ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-calendar-alt mr-2 w-4"></i>
                                <span><?= $assignment->due_date ? date('d M Y, H:i', strtotime($assignment->due_date)) : 'Tidak ada batas'; ?></span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-users mr-2 w-4"></i>
                                <span><?= $total_submissions ?>/<?= $total_students ?> siswa mengumpulkan</span>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Progres Penilaian</span>
                                <span><?= $graded_submissions ?>/<?= $total_submissions ?> (<?= $progress_percentage ?>%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: <?= $progress_percentage ?>%"></div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="<?= site_url('admin/assignments/submissions/' . $assignment->id); ?>" class="flex-1 bg-blue-600 text-white text-center py-2 px-3 rounded-lg hover:bg-blue-700 transition-colors text-sm">
                                <i class="fas fa-eye mr-1"></i>Lihat Pengumpulan
                            </a>
                            <button class="bg-gray-100 text-gray-700 py-2 px-3 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="bg-gray-100 text-gray-700 py-2 px-3 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
