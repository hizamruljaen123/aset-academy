<div class="space-y-4">
    <!-- Header -->
    <div class="mobile-card">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-900">Jadwal Kelas</h2>
            <button onclick="location.href='<?= site_url("student_mobile") ?>'" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <i data-feather="arrow-left" class="w-5 h-5 text-gray-600"></i>
            </button>
        </div>
        
        <!-- Week Navigation -->
        <div class="flex items-center justify-between mb-4">
            <button onclick="changeWeek(-1)" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <i data-feather="chevron-left" class="w-5 h-5 text-gray-600"></i>
            </button>
            <h3 class="text-lg font-semibold text-gray-900" id="currentWeek">Minggu Ini</h3>
            <button onclick="changeWeek(1)" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <i data-feather="chevron-right" class="w-5 h-5 text-gray-600"></i>
            </button>
        </div>
        
        <!-- Today Highlight -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-600 font-medium">Hari Ini</p>
                    <p class="text-lg font-bold text-blue-900"><?php echo date('d F Y'); ?></p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-blue-600">Jadwal</p>
                    <p class="text-lg font-bold text-blue-900"><?php echo count($today_schedule); ?> kelas</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule by Day -->
    <div class="space-y-4">
        <?php 
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $day_classes = array_chunk($schedule, 7); // Group by day
        ?>
        
        <?php foreach($day_classes as $day_index => $day_schedules): ?>
            <?php if (!empty($day_schedules)): ?>
                <div class="mobile-card">
                    <h3 class="text-lg font-bold text-gray-900 mb-3"><?php echo $days[$day_index]; ?></h3>
                    <div class="space-y-3">
                        <?php foreach($day_schedules as $schedule_item): ?>
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex-1">
                                        <h4 class="text-sm font-bold text-gray-900 mb-1"><?php echo $schedule_item->judul_pertemuan; ?></h4>
                                        <p class="text-xs text-gray-500"><?php echo $schedule_item->nama_kelas; ?></p>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full <?php
                                        echo ($schedule_item->status == 'Selesai') ? 'bg-green-100 text-green-800' :
                                             (($schedule_item->status == 'Dalam Proses') ? 'bg-blue-100 text-blue-800' :
                                             'bg-gray-100 text-gray-800');
                                    ?>">
                                        <?php echo $schedule_item->status; ?>
                                    </span>
                                </div>
                                
                                <div class="flex items-center justify-between text-xs text-gray-600 mb-3">
                                    <div class="flex items-center space-x-4">
                                        <span><i data-feather="clock" class="w-3 h-3 inline mr-1"></i><?php echo date('H:i', strtotime($schedule_item->waktu_mulai)); ?> - <?php echo date('H:i', strtotime($schedule_item->waktu_selesai)); ?></span>
                                        <span><i data-feather="map-pin" class="w-3 h-3 inline mr-1"></i><?php echo $schedule_item->lokasi; ?></span>
                                    </div>
                                </div>
                                
                                <?php if ($schedule_item->status == 'Dalam Proses'): ?>
                                    <button class="w-full mobile-btn bg-green-600 text-white text-sm">
                                        <i data-feather="play" class="w-4 h-4 inline mr-1"></i>
                                        Join Kelas
                                    </button>
                                <?php elseif ($schedule_item->status == 'Belum Dimulai'): ?>
                                    <button class="w-full mobile-btn border border-gray-300 text-gray-700 text-sm">
                                        <i data-feather="bell" class="w-4 h-4 inline mr-1"></i>
                                        Set Pengingat
                                    </button>
                                <?php else: ?>
                                    <button class="w-full mobile-btn border border-gray-300 text-gray-700 text-sm">
                                        <i data-feather="eye" class="w-4 h-4 inline mr-1"></i>
                                        Lihat Rekaman
                                    </button>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <!-- Upcoming Classes -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Kelas Mendatang</h3>
        <div class="space-y-3">
            <?php if (empty($upcoming_classes)): ?>
                <div class="text-center py-6">
                    <i data-feather="calendar" class="w-12 h-12 text-gray-300 mx-auto mb-2"></i>
                    <p class="text-sm text-gray-500">Tidak ada kelas mendatang</p>
                </div>
            <?php else: ?>
                <?php foreach($upcoming_classes as $class): ?>
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i data-feather="video" class="w-5 h-5 text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-900"><?php echo $class->nama_kelas; ?></h4>
                                <p class="text-xs text-gray-500"><?php echo date('d M Y, H:i', strtotime($class->tanggal_pertemuan . ' ' . $class->waktu_mulai)); ?></p>
                            </div>
                        </div>
                        <button class="text-blue-600 text-sm font-medium">
                            Detail
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Calendar View -->
    <div class="mobile-card">
        <h3 class="text-lg font-bold text-gray-900 mb-3">Kalender Bulanan</h3>
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="grid grid-cols-7 gap-1 text-center text-xs mb-2">
                <div class="text-gray-500 font-medium">Min</div>
                <div class="text-gray-500 font-medium">Sen</div>
                <div class="text-gray-500 font-medium">Sel</div>
                <div class="text-gray-500 font-medium">Rab</div>
                <div class="text-gray-500 font-medium">Kam</div>
                <div class="text-gray-500 font-medium">Jum</div>
                <div class="text-gray-500 font-medium">Sab</div>
            </div>
            <div class="grid grid-cols-7 gap-1 text-center text-xs">
                <?php for($i = 1; $i <= 31; $i++): ?>
                    <?php 
                    $has_class = isset($calendar_classes[$i]) && !empty($calendar_classes[$i]);
                    $is_today = $i == date('d');
                    ?>
                    <div class="aspect-square flex items-center justify-center rounded-lg <?php 
                        echo $is_today ? 'bg-blue-600 text-white' : 
                               ($has_class ? 'bg-blue-100 text-blue-800' : 'text-gray-600'); 
                    ?>">
                        <?php echo $i; ?>
                        <?php if ($has_class): ?>
                            <div class="absolute bottom-0 w-1 h-1 bg-blue-600 rounded-full"></div>
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>

<script>
    let currentWeekOffset = 0;
    
    function changeWeek(direction) {
        currentWeekOffset += direction;
        updateWeekDisplay();
    }
    
    function updateWeekDisplay() {
        const today = new Date();
        const startOfWeek = new Date(today);
        startOfWeek.setDate(today.getDate() - today.getDay() + (currentWeekOffset * 7));
        
        const endOfWeek = new Date(startOfWeek);
        endOfWeek.setDate(startOfWeek.getDate() + 6);
        
        const options = { month: 'long', day: 'numeric' };
        const startStr = startOfWeek.toLocaleDateString('id-ID', options);
        const endStr = endOfWeek.toLocaleDateString('id-ID', options);
        
        document.getElementById('currentWeek').textContent = 
            currentWeekOffset === 0 ? 'Minggu Ini' : `${startStr} - ${endStr}`;
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        feather.replace();
        updateWeekDisplay();
    });
</script>