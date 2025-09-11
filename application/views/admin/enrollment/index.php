<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-lg shadow">
        <div class="mb-4 md:mb-0">
            <h1 class="text-2xl font-bold text-gray-800">Kelola Akses Kelas Premium</h1>
            <p class="text-gray-600 mt-1">Kontrol akses siswa ke kelas premium setelah pembayaran</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-gray-800"><?= count($pending_enrollments) ?></h4>
                    <p class="text-gray-600">Menunggu Aktivasi</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-gray-800"><?= count(array_filter($enrollments, function($e) { return $e->status == 'Active'; })) ?></h4>
                    <p class="text-gray-600">Aktif</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                    <i class="fas fa-ban"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-gray-800"><?= count(array_filter($enrollments, function($e) { return $e->status == 'Suspended'; })) ?></h4>
                    <p class="text-gray-600">Ditangguhkan</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-gray-800"><?= count($enrollments) ?></h4>
                    <p class="text-gray-600">Total Enrollment</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Enrollments -->
    <?php if (!empty($pending_enrollments)): ?>
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Menunggu Aktivasi</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pembayaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach($pending_enrollments as $enrollment): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900"><?= $enrollment->student_name ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?= $enrollment->class_name ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Rp <?= number_format($enrollment->amount, 0, ',', '.') ?></div>
                            <div class="text-sm text-gray-500"><?= $enrollment->payment_method ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?= date('d M Y', strtotime($enrollment->created_at)) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="<?= site_url('admin/enrollment/grant_access/'.$enrollment->id) ?>" 
                               class="text-green-600 hover:text-green-900 mr-3"
                               onclick="return confirm('Berikan akses kelas untuk siswa ini?')">
                                <i class="fas fa-check"></i> Aktivasi
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <!-- All Enrollments -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Semua Enrollment</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pembayaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach($enrollments as $enrollment): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900"><?= $enrollment->student_name ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?= $enrollment->class_name ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php
                            $status_colors = [
                                'Pending' => 'bg-yellow-100 text-yellow-800',
                                'Active' => 'bg-green-100 text-green-800',
                                'Suspended' => 'bg-red-100 text-red-800',
                                'Completed' => 'bg-blue-100 text-blue-800',
                                'Cancelled' => 'bg-gray-100 text-gray-800'
                            ];
                            ?>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $status_colors[$enrollment->status] ?>">
                                <?= $enrollment->status ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Rp <?= number_format($enrollment->amount, 0, ',', '.') ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?= date('d M Y', strtotime($enrollment->created_at)) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <?php if ($enrollment->status == 'Active'): ?>
                                <a href="<?= site_url('admin/enrollment/revoke_access/'.$enrollment->id) ?>" 
                                   class="text-red-600 hover:text-red-900"
                                   onclick="return confirm('Cabut akses kelas untuk siswa ini?')">
                                    <i class="fas fa-ban"></i> Cabut Akses
                                </a>
                            <?php elseif ($enrollment->status == 'Suspended'): ?>
                                <a href="<?= site_url('admin/enrollment/grant_access/'.$enrollment->id) ?>" 
                                   class="text-green-600 hover:text-green-900"
                                   onclick="return confirm('Berikan kembali akses kelas untuk siswa ini?')">
                                    <i class="fas fa-check"></i> Aktifkan
                                </a>
                            <?php elseif ($enrollment->status == 'Pending'): ?>
                                <a href="<?= site_url('admin/enrollment/grant_access/'.$enrollment->id) ?>" 
                                   class="text-green-600 hover:text-green-900"
                                   onclick="return confirm('Berikan akses kelas untuk siswa ini?')">
                                    <i class="fas fa-check"></i> Aktivasi
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.transition-opacity');
    if (container) container.classList.add('opacity-100');
});
</script>
