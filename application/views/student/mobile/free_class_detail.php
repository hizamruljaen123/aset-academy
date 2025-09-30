<div class="min-h-screen bg-gray-50 pb-20">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-emerald-700 text-white px-4 py-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <button onclick="history.back()" class="mr-3 p-2 rounded-full bg-white/20 hover:bg-white/30 transition-colors">
                    <i data-feather="arrow-left" class="w-5 h-5"></i>
                </button>
                <div>
                    <h1 class="text-xl font-bold"><?php echo $free_class->title; ?></h1>
                    <p class="text-green-100 text-sm">Kelas Gratis</p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 -mt-4">
        <!-- Class Thumbnail -->
        <?php if (!empty($free_class->thumbnail)): ?>
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
                <img src="<?php echo $free_class->thumbnail; ?>" alt="<?php echo $free_class->title; ?>" class="w-full h-48 object-cover">
            </div>
        <?php endif; ?>

        <!-- Class Info -->
        <div class="bg-white rounded-2xl shadow-lg p-4 mb-6">
            <h2 class="text-lg font-bold text-gray-800 mb-3">Tentang Kelas Ini</h2>
            <p class="text-gray-600 mb-4"><?php echo $free_class->description ?? 'Deskripsi kelas belum tersedia'; ?></p>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i data-feather="users" class="w-6 h-6 text-green-600"></i>
                    </div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo $enrolled_count ?? 0; ?></p>
                    <p class="text-xs text-gray-500">Peserta</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i data-feather="book-open" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo count($materials); ?></p>
                    <p class="text-xs text-gray-500">Materi</p>
                </div>
            </div>

            <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
                <span><i data-feather="user" class="w-4 h-4 inline mr-1"></i><?php echo $free_class->mentor_name ?? 'Mentor'; ?></span>
                <span><i data-feather="trending-up" class="w-4 h-4 inline mr-1"></i><?php echo $free_class->level ?? 'Dasar'; ?></span>
            </div>

            <?php if ($free_class->max_students): ?>
                <div class="mb-4">
                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                        <span>Kuota Kelas</span>
                        <span><?php echo $enrolled_count; ?>/<?php echo $free_class->max_students; ?></span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: <?php echo ($enrolled_count / $free_class->max_students) * 100; ?>%"></div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Enrollment Button -->
            <?php if ($is_enrolled): ?>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                    <div class="flex items-center">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2"></i>
                        <span class="text-green-800 font-medium">Anda sudah terdaftar di kelas ini</span>
                    </div>
                    <a href="<?php echo site_url('student_mobile/my_classes'); ?>" class="mt-3 inline-block w-full text-center px-4 py-2 bg-green-600 text-white rounded-lg font-medium">
                        Lihat Kelas Saya
                    </a>
                </div>
            <?php elseif ($is_full): ?>
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                    <div class="flex items-center">
                        <i data-feather="x-circle" class="w-5 h-5 text-red-600 mr-2"></i>
                        <span class="text-red-800 font-medium">Kelas sudah penuh</span>
                    </div>
                </div>
            <?php else: ?>
                <button onclick="enrollClass(<?php echo $free_class->id; ?>, '<?php echo $free_class->title; ?>')"
                        class="w-full bg-green-600 text-white py-3 rounded-lg font-medium hover:bg-green-700 transition-colors">
                    Daftar Kelas Gratis
                </button>
            <?php endif; ?>
        </div>

        <!-- Class Materials -->
        <?php if (!empty($materials)): ?>
            <div class="bg-white rounded-2xl shadow-lg p-4 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Materi Pembelajaran</h3>
                <div class="space-y-3">
                    <?php foreach($materials as $index => $material): ?>
                        <div class="flex items-center p-3 border border-gray-200 rounded-lg">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-sm font-bold text-green-600"><?php echo $index + 1; ?></span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-800"><?php echo $material->title; ?></h4>
                                <p class="text-sm text-gray-600"><?php echo $material->description ?? 'Deskripsi materi'; ?></p>
                            </div>
                            <i data-feather="chevron-right" class="w-5 h-5 text-gray-400"></i>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Class Schedule -->
        <?php if (!empty($jadwal)): ?>
            <div class="bg-white rounded-2xl shadow-lg p-4 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Jadwal Kelas</h3>
                <div class="space-y-3">
                    <?php foreach($jadwal as $schedule): ?>
                        <div class="flex items-center p-3 border border-gray-200 rounded-lg">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i data-feather="calendar" class="w-5 h-5 text-blue-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800"><?php echo date('d M Y', strtotime($schedule->tanggal_pertemuan)); ?></p>
                                <p class="text-sm text-gray-600"><?php echo $schedule->waktu_mulai; ?> - <?php echo $schedule->waktu_selesai; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Enrolled Students -->
        <?php if (!empty($enrolled_students)): ?>
            <div class="bg-white rounded-2xl shadow-lg p-4 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Peserta Kelas (<?php echo count($enrolled_students); ?>)</h3>
                <div class="flex flex-wrap gap-2">
                    <?php foreach($enrolled_students as $student): ?>
                        <div class="flex items-center bg-gray-100 rounded-full px-3 py-2">
                            <div class="w-6 h-6 bg-gray-300 rounded-full flex items-center justify-center mr-2">
                                <span class="text-xs font-medium text-gray-600"><?php echo substr($student->nama_lengkap, 0, 1); ?></span>
                            </div>
                            <span class="text-sm text-gray-700"><?php echo $student->nama_lengkap; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Enrollment Modal -->
<div id="enrollmentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl p-6 m-4 max-w-sm w-full">
        <div class="text-center mb-4">
            <div class="w-16 h-16 bg-green-100 rounded-full mx-auto mb-3 flex items-center justify-center">
                <i data-feather="check-circle" class="w-8 h-8 text-green-600"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Konfirmasi Pendaftaran</h3>
            <p class="text-sm text-gray-600">Apakah Anda yakin ingin mendaftar ke kelas ini?</p>
        </div>

        <div class="mb-4">
            <p class="text-sm font-medium text-gray-900 mb-1">Kelas:</p>
            <p class="text-sm text-gray-700" id="className"><?php echo $free_class->title; ?></p>
        </div>

        <div class="flex space-x-3">
            <button onclick="closeEnrollmentModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium">
                Batal
            </button>
            <button onclick="confirmEnrollment()" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg font-medium">
                Ya, Daftar
            </button>
        </div>
    </div>
</div>

<script>
    let selectedClassId = <?php echo $free_class->id; ?>;
    let selectedClassName = '<?php echo $free_class->title; ?>';

    function enrollClass(classId, className) {
        selectedClassId = classId;
        selectedClassName = className;
        document.getElementById('className').textContent = className;
        document.getElementById('enrollmentModal').classList.remove('hidden');
    }

    function closeEnrollmentModal() {
        document.getElementById('enrollmentModal').classList.add('hidden');
    }

    function confirmEnrollment() {
        // Show loading
        const button = document.querySelector('#enrollmentModal button:last-child');
        const originalText = button.textContent;
        button.textContent = 'Mendaftar...';
        button.disabled = true;

        // Simulate enrollment process
        setTimeout(() => {
            closeEnrollmentModal();
            showToast('Pendaftaran berhasil! Mengalihkan...');

            // Redirect to enrollment endpoint
            setTimeout(() => {
                location.href = '<?php echo site_url('student_mobile/enroll_free_class/'); ?>' + selectedClassId;
            }, 1000);
        }, 2000);
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        feather.replace();
    });
</script>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
