<div class="p-4 transition-opacity duration-500 opacity-0 fade-in">
    <!-- Header with gradient background -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl text-white">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold"><?php echo $enrollment->title; ?></h1>
            <div class="flex items-center mt-2 text-blue-100">
                <i class="fas fa-graduation-cap mr-2"></i>
                <p><?php echo $enrollment->category; ?> - <?php echo $enrollment->level; ?></p>
            </div>
        </div>
        <div class="flex space-x-3">
            <a href="<?php echo site_url('student/free_classes/view/' . $enrollment->class_id); ?>" class="inline-flex items-center px-4 py-2 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Detail Kelas
            </a>
            <a href="<?php echo site_url('student/free_classes/my_classes'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 transition-all duration-300 hover:scale-105">
                <i class="fas fa-book-open mr-2"></i>
                Kelas Saya
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Progress Card -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Progress Belajar</h2>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-gray-700">Progress Keseluruhan</span>
                            <span class="text-sm font-medium text-blue-600"><?php echo $enrollment->progress; ?>%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?php echo $enrollment->progress; ?>%"></div>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">Materi</h3>
                        <div class="space-y-2">
                            <?php foreach ($progress as $index => $item): ?>
                                <a href="<?php echo site_url('student/free_classes/material/' . $enrollment->id . '/' . $item->material_id); ?>" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors <?php echo ($item->status == 'Completed') ? 'bg-green-50' : ''; ?>">
                                    <div class="h-6 w-6 rounded-full <?php echo ($item->status == 'Completed') ? 'bg-green-600' : (($item->status == 'In Progress') ? 'bg-blue-600' : 'bg-gray-300'); ?> flex items-center justify-center text-white text-xs font-medium mr-3">
                                        <?php echo ($item->status == 'Completed') ? '<i class="fas fa-check"></i>' : ($index + 1); ?>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800 line-clamp-1"><?php echo $item->title; ?></p>
                                        <p class="text-xs text-gray-500">
                                            <?php 
                                            if ($item->status == 'Completed') echo '<i class="fas fa-check-circle text-green-600 mr-1"></i> Selesai';
                                            elseif ($item->status == 'In Progress') echo '<i class="fas fa-spinner text-blue-600 mr-1"></i> Sedang Dipelajari';
                                            else echo '<i class="fas fa-circle text-gray-400 mr-1"></i> Belum Dimulai';
                                            ?>
                                        </p>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Class Info -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Informasi Kelas</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="rounded-full bg-blue-100 p-2 mr-3">
                                <i class="fas fa-user-tie text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Mentor</p>
                                <p class="font-medium"><?php echo $enrollment->mentor_name; ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="rounded-full bg-indigo-100 p-2 mr-3">
                                <i class="fas fa-calendar-alt text-indigo-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Tanggal Daftar</p>
                                <p class="font-medium"><?php echo date('d F Y', strtotime($enrollment->enrollment_date)); ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="rounded-full bg-green-100 p-2 mr-3">
                                <i class="fas fa-clock text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Durasi</p>
                                <p class="font-medium"><?php echo $enrollment->duration; ?> jam</p>
                            </div>
                        </div>
                        
                        <?php if (!empty($enrollment->online_meet_link)): ?>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <a href="<?php echo $enrollment->online_meet_link; ?>" target="_blank" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300">
                                <i class="fas fa-video mr-2"></i>
                                Join Meeting Online
                            </a>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($enrollment->status == 'Completed'): ?>
                        <div class="flex items-center">
                            <div class="rounded-full bg-green-100 p-2 mr-3">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Tanggal Selesai</p>
                                <p class="font-medium"><?php echo date('d F Y', strtotime($enrollment->completion_date)); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Jadwal Kelas -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Jadwal Kelas</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <?php if (!empty($jadwal)):
                            foreach ($jadwal as $j):
                        ?>
                            <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <p class="font-semibold text-gray-800">Pertemuan <?php echo $j->pertemuan_ke; ?>: <?php echo $j->judul_pertemuan; ?></p>
                                <p class="text-sm text-gray-600 mt-1"><?php echo date('d M Y', strtotime($j->tanggal_pertemuan)); ?> | <?php echo date('H:i', strtotime($j->waktu_mulai)); ?> - <?php echo date('H:i', strtotime($j->waktu_selesai)); ?></p>
                            </div>
                        <?php 
                            endforeach;
                        else:
                        ?>
                            <p class="text-center text-gray-500 py-4">Belum ada jadwal untuk kelas ini.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="lg:col-span-3">
            <!-- Welcome Card -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Selamat Datang di Kelas</h2>
                    <div class="prose max-w-none text-gray-600">
                        <?php echo $enrollment->description; ?>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500">Status Kelas:</p>
                                <p class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium 
                                    <?php 
                                    if ($enrollment->status == 'Completed') echo 'bg-green-100 text-green-800';
                                    elseif ($enrollment->status == 'Enrolled') echo 'bg-blue-100 text-blue-800';
                                    else echo 'bg-red-100 text-red-800';
                                    ?>">
                                    <?php 
                                    if ($enrollment->status == 'Completed') echo 'Selesai';
                                    elseif ($enrollment->status == 'Enrolled') echo 'Sedang Berjalan';
                                    else echo 'Keluar';
                                    ?>
                                </p>
                            </div>
                            
                            <?php if (!empty($progress) && $enrollment->status != 'Completed'): ?>
                                <?php 
                                // Find first incomplete material
                                $next_material = null;
                                foreach ($progress as $item) {
                                    if ($item->status != 'Completed') {
                                        $next_material = $item;
                                        break;
                                    }
                                }
                                ?>
                                <?php if ($next_material): ?>
                                    <a href="<?php echo site_url('student/free_classes/material/' . $enrollment->id . '/' . $next_material->material_id); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                                        <i class="fas fa-play-circle mr-2"></i>
                                        <?php echo ($next_material->status == 'In Progress') ? 'Lanjutkan Belajar' : 'Mulai Belajar'; ?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Attendance Section -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Absensi Kelas</h2>
                </div>
                <div class="p-6">
                    <?php if (!empty($jadwal)): ?>
                        <div class="space-y-4">
                            <?php foreach ($jadwal as $j): ?>
                                <?php 
                                $attendance = isset($attendance_status[$j->id]) ? $attendance_status[$j->id] : null;
                                ?>
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Pertemuan <?php echo $j->pertemuan_ke; ?>: <?php echo $j->judul_pertemuan; ?></h4>
                                            <p class="text-sm text-gray-600 mt-1">
                                                <?php echo date('d M Y', strtotime($j->tanggal_pertemuan)); ?> | 
                                                <?php echo date('H:i', strtotime($j->waktu_mulai)); ?> - <?php echo date('H:i', strtotime($j->waktu_selesai)); ?>
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <?php if ($attendance && $attendance['status'] !== 'not_attended'): ?>
                                                <!-- Already attended -->
                                                <div class="text-center">
                                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-check-circle mr-2"></i>
                                                        Hadir
                                                    </div>
                                                    <p class="text-xs text-gray-500 mt-1">
                                                        <?php echo isset($attendance['waktu_absen']) ? date('d M Y H:i', strtotime($attendance['waktu_absen'])) : ''; ?>
                                                    </p>
                                                </div>
                                            <?php elseif ($attendance && $attendance['can_attend']): ?>
                                                <!-- Can attend now -->
                                                <button onclick="submitAttendance(<?php echo $j->id; ?>, <?php echo $enrollment->id; ?>)" 
                                                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300">
                                                    <i class="fas fa-user-check mr-2"></i>
                                                    Isi Absen
                                                </button>
                                            <?php elseif ($attendance && $attendance['attendance_status'] === 'early'): ?>
                                                <!-- Too early -->
                                                <div class="text-center">
                                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                        <i class="fas fa-clock mr-2"></i>
                                                        Belum Waktunya
                                                    </div>
                                                </div>
                                            <?php elseif ($attendance && $attendance['attendance_status'] === 'late'): ?>
                                                <!-- Too late -->
                                                <div class="text-center">
                                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                        <i class="fas fa-times-circle mr-2"></i>
                                                        Terlambat
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <!-- Not attended, outside window -->
                                                <div class="text-center">
                                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                                        <i class="fas fa-minus-circle mr-2"></i>
                                                        Belum Absen
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                                <i class="fas fa-calendar-times text-blue-600 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Belum Ada Jadwal</h3>
                            <p class="text-gray-500 max-w-md mx-auto">Jadwal pertemuan untuk kelas ini belum tersedia.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Materials List -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Daftar Materi</h2>
                </div>
                <div class="p-6">
                    <?php if (empty($materials)): ?>
                        <div class="text-center py-8">
                            <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                                <i class="fas fa-book text-blue-600 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Belum Ada Materi</h3>
                            <p class="text-gray-500 max-w-md mx-auto">Materi pembelajaran untuk kelas ini akan segera tersedia.</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php foreach ($materials as $index => $material): ?>
                                <?php 
                                // Find progress for this material
                                $material_progress = null;
                                foreach ($progress as $p) {
                                    if ($p->material_id == $material->id) {
                                        $material_progress = $p;
                                        break;
                                    }
                                }
                                ?>
                                <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between p-4 <?php echo ($material_progress && $material_progress->status == 'Completed') ? 'bg-green-50' : 'bg-gray-50'; ?>">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full <?php echo ($material_progress && $material_progress->status == 'Completed') ? 'bg-green-600' : (($material_progress && $material_progress->status == 'In Progress') ? 'bg-blue-600' : 'bg-gray-300'); ?> flex items-center justify-center text-white font-medium mr-3">
                                                <?php echo ($material_progress && $material_progress->status == 'Completed') ? '<i class="fas fa-check"></i>' : ($index + 1); ?>
                                            </div>
                                            <h4 class="font-medium text-gray-800"><?php echo $material->title; ?></h4>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="text-xs px-2 py-1 rounded-full mr-3
                                                <?php 
                                                if ($material_progress && $material_progress->status == 'Completed') echo 'bg-green-100 text-green-800';
                                                elseif ($material_progress && $material_progress->status == 'In Progress') echo 'bg-blue-100 text-blue-800';
                                                else echo 'bg-gray-100 text-gray-800';
                                                ?>">
                                                <?php 
                                                if ($material_progress && $material_progress->status == 'Completed') echo 'Selesai';
                                                elseif ($material_progress && $material_progress->status == 'In Progress') echo 'Sedang Dipelajari';
                                                else echo 'Belum Dimulai';
                                                ?>
                                            </span>
                                            <a href="<?php echo site_url('student/free_classes/material/' . $enrollment->id . '/' . $material->id); ?>" class="inline-flex items-center px-3 py-1 border border-transparent rounded-lg shadow-sm text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                                <?php echo ($material_progress && $material_progress->status != 'Not Started') ? 'Lanjutkan' : 'Mulai'; ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="p-4 bg-white">
                                        <p class="text-sm text-gray-600 mb-2"><?php echo substr(strip_tags($material->description), 0, 100) . '...'; ?></p>
                                        <div class="flex items-center text-xs text-gray-500">
                                            <span class="mr-3">
                                                <i class="fas fa-<?php 
                                                if ($material->content_type == 'text') echo 'file-alt';
                                                elseif ($material->content_type == 'video') echo 'video';
                                                elseif ($material->content_type == 'pdf') echo 'file-pdf';
                                                else echo 'link';
                                                ?> mr-1"></i>
                                                <?php echo ucfirst($material->content_type); ?>
                                            </span>
                                            <?php if ($material_progress && $material_progress->last_accessed): ?>
                                                <span>
                                                    <i class="fas fa-clock mr-1"></i>
                                                    Terakhir diakses: <?php echo date('d M Y H:i', strtotime($material_progress->last_accessed)); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Discussions -->
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8 fade-in">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800">Diskusi</h2>
                </div>
                <div class="p-6">
                    <?php if (isset($discussions) && !empty($discussions)): ?>
                        <div class="space-y-6">
                            <?php foreach ($discussions as $discussion): ?>
                                <?php if ($discussion->parent_id === null): ?>
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <div class="p-4 bg-gray-50">
                                            <div class="flex items-start">
                                                <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-medium mr-3">
                                                    <?php echo strtoupper(substr($discussion->nama_lengkap, 0, 1)); ?>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="flex justify-between items-center mb-1">
                                                        <h4 class="font-medium text-gray-800"><?php echo $discussion->nama_lengkap; ?></h4>
                                                        <span class="text-xs text-gray-500"><?php echo date('d M Y H:i', strtotime($discussion->created_at)); ?></span>
                                                    </div>
                                                    <p class="text-gray-600"><?php echo $discussion->message; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php 
                                        // Find replies
                                        $replies = array_filter($discussions, function($reply) use ($discussion) {
                                            return $reply->parent_id == $discussion->id;
                                        });
                                        
                                        if (!empty($replies)):
                                        ?>
                                            <div class="border-t border-gray-200">
                                                <div class="p-4 pl-12">
                                                    <?php foreach ($replies as $reply): ?>
                                                        <div class="mb-4 last:mb-0">
                                                            <div class="flex items-start">
                                                                <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white font-medium mr-3">
                                                                    <?php echo strtoupper(substr($reply->nama_lengkap, 0, 1)); ?>
                                                                </div>
                                                                <div class="flex-1">
                                                                    <div class="flex justify-between items-center mb-1">
                                                                        <h5 class="font-medium text-gray-800"><?php echo $reply->nama_lengkap; ?></h5>
                                                                        <span class="text-xs text-gray-500"><?php echo date('d M Y H:i', strtotime($reply->created_at)); ?></span>
                                                                    </div>
                                                                    <p class="text-gray-600"><?php echo $reply->message; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="border-t border-gray-200">
                                            <div class="p-4 pl-12">
                                                <form action="<?php echo site_url('student/free_classes/post_discussion'); ?>" method="post">
                                                    <input type="hidden" name="enrollment_id" value="<?php echo $enrollment->id; ?>">
                                                    <input type="hidden" name="parent_id" value="<?php echo $discussion->id; ?>">
                                                    <div class="flex">
                                                        <textarea name="message" rows="1" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg mr-2" placeholder="Balas diskusi..."></textarea>
                                                        <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                                            <i class="fas fa-paper-plane"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                                <i class="fas fa-comments text-blue-600 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Belum Ada Diskusi</h3>
                            <p class="text-gray-500 max-w-md mx-auto">Jadilah yang pertama memulai diskusi tentang kelas ini.</p>
                        </div>
                    <?php endif; ?>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <form action="<?php echo site_url('student/free_classes/post_discussion'); ?>" method="post">
                            <input type="hidden" name="enrollment_id" value="<?php echo $enrollment->id; ?>">
                            <div class="space-y-4">
                                <textarea name="message" rows="3" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg" placeholder="Tulis pertanyaan atau diskusi Anda..."></textarea>
                                <div class="flex justify-end">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
                                        <i class="fas fa-paper-plane mr-2"></i>
                                        Kirim Diskusi
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Timezone Settings Modal -->
<div id="timezoneModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Pengaturan Zona Waktu</h3>
                <button onclick="closeTimezoneModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="timezoneForm">
                <div class="mb-4">
                    <label for="timezone_select" class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Zona Waktu Anda
                    </label>
                    <select id="timezone_select" name="timezone" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Zona Waktu</option>
                        <option value="Asia/Jakarta">WIB (UTC+7) - Indonesia</option>
                        <option value="Asia/Makassar">WITA (UTC+8) - Indonesia Timur</option>
                        <option value="Asia/Jayapura">WIT (UTC+9) - Papua</option>
                        <option value="UTC">UTC (Universal Time)</option>
                        <option value="America/New_York">EST (UTC-5) - New York</option>
                        <option value="Europe/London">GMT (UTC+0) - London</option>
                        <option value="Asia/Tokyo">JST (UTC+9) - Tokyo</option>
                        <option value="Australia/Sydney">AEDT (UTC+10) - Sydney</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeTimezoneModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fade in main container
        const container = document.querySelector('.transition-opacity');
        if (container) {
            container.classList.add('opacity-100');
        }
        
        // Initialize intersection observer for fade-in elements
        const fadeElements = document.querySelectorAll('.fade-in');
        
        if (fadeElements.length > 0) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('visible');
                        }, 100);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            fadeElements.forEach((element, index) => {
                // Add staggered delay based on element index
                element.style.transitionDelay = `${index * 0.1}s`;
                observer.observe(element);
            });
        }

        // Timezone form submission
        document.getElementById('timezoneForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const timezone = document.getElementById('timezone_select').value;

            if (!timezone) {
                alert('Silakan pilih zona waktu');
                return;
            }

            // Submit timezone setting via AJAX
            submitTimezone(timezone);
        });

        // Add timezone button to header
        addTimezoneButtonToHeader();
    });

    // Global functions
    function submitAttendance(jadwalId, enrollmentId) {
        if (!confirm('Apakah Anda yakin ingin mengisi absensi untuk pertemuan ini?')) {
            return;
        }

        // Disable button
        const button = event.target;
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';

        // Submit attendance via AJAX
        fetch('<?php echo site_url("student/free_classes/submit_attendance"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'jadwal_id=' + jadwalId + '&enrollment_id=' + enrollmentId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Absensi berhasil dicatat pada ' + data.attendance_time);
                location.reload(); // Reload to update attendance status
            } else {
                alert('Gagal mengisi absensi: ' + data.message);
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-user-check mr-2"></i>Isi Absen';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengisi absensi');
            button.disabled = false;
            button.innerHTML = '<i class="fas fa-user-check mr-2"></i>Isi Absen';
        });
    }

    function submitTimezone(timezone) {
        fetch('<?php echo site_url("student/set_timezone"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'timezone=' + encodeURIComponent(timezone)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeTimezoneModal();
                location.reload(); // Reload to update time displays
            } else {
                alert('Gagal menyimpan zona waktu: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan zona waktu');
        });
    }

    function openTimezoneModal() {
        document.getElementById('timezoneModal').classList.remove('hidden');
    }

    function closeTimezoneModal() {
        document.getElementById('timezoneModal').classList.add('hidden');
    }

    function addTimezoneButtonToHeader() {
        // Add timezone button to header
        const header = document.querySelector('.bg-gradient-to-r');
        if (header) {
            const timezoneBtn = document.createElement('button');
            timezoneBtn.onclick = openTimezoneModal;
            timezoneBtn.className = 'inline-flex items-center px-3 py-1 border border-white/30 rounded-lg text-sm font-medium text-white bg-white/10 hover:bg-white/20 transition-all duration-300 ml-4';
            timezoneBtn.innerHTML = '<i class="fas fa-globe mr-2"></i>Zona Waktu';
            header.appendChild(timezoneBtn);
        }
    }
</script>

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
