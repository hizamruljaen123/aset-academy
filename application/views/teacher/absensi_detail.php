<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-500 to-teal-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold"><?= $title; ?></h1>
                <p class="text-sm opacity-90 mt-1">Pertemuan: <?= $jadwal->judul_pertemuan; ?> (<?= date('d M Y', strtotime($jadwal->tanggal_pertemuan)); ?>)</p>
                <div class="flex items-center mt-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        <?php
                        switch($jadwal->status) {
                            case 'Selesai':
                                echo 'bg-green-100 text-green-800';
                                break;
                            case 'Proses':
                                echo 'bg-blue-100 text-blue-800';
                                break;
                            case 'Ditunda':
                                echo 'bg-yellow-100 text-yellow-800';
                                break;
                            case 'Dibatalkan':
                                echo 'bg-red-100 text-red-800';
                                break;
                            default:
                                echo 'bg-gray-100 text-gray-800';
                        }
                        ?>">
                        <i class="fas fa-circle mr-1 text-xs"></i>
                        <?= $jadwal->status; ?>
                    </span>
                </div>
            </div>
            <div class="flex space-x-3">
                <?php
                $today = date('Y-m-d');
                $meeting_date = date('Y-m-d', strtotime($jadwal->tanggal_pertemuan));
                $can_end_meeting = ($jadwal->status !== 'Selesai') && ($today >= $meeting_date);
                ?>
                <?php if ($can_end_meeting): ?>
                <button onclick="akhiriPertemuan(<?= $jadwal->id; ?>, <?= $jadwal->kelas_id; ?>, '<?= $jadwal->class_type; ?>')"
                        class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-bold rounded-lg shadow-md hover:bg-red-700 transition-colors">
                    <i class="fas fa-stop-circle mr-2"></i>
                    Akhiri Pertemuan
                </button>
                <?php else: ?>
                <div class="inline-flex items-center px-6 py-3 bg-green-100 text-green-800 font-bold rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>
                    <?php if ($jadwal->status === 'Selesai'): ?>
                        Pertemuan Selesai
                    <?php else: ?>
                        Belum Waktunya Mengakhiri Pertemuan
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <a href="<?= site_url('teacher/manage_kelas/' . $jadwal->kelas_id); ?>" class="inline-flex items-center px-4 py-2 bg-white text-teal-600 font-bold rounded-lg shadow-md hover:bg-gray-100 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Kelas
                </a>
            </div>
        </div>
    </div>

    <!-- Attendance Table -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Detail Absensi Siswa</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($absensi)): ?>
                        <?php foreach ($absensi as $absen): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $absen['nis']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $absen['nama_lengkap']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <?php 
                                        $status_classes = [
                                            'Hadir' => 'bg-green-100 text-green-800',
                                            'Sakit' => 'bg-yellow-100 text-yellow-800',
                                            'Izin' => 'bg-blue-100 text-blue-800',
                                            'Alpa' => 'bg-red-100 text-red-800',
                                        ];
                                        $class = $status_classes[$absen['status']] ?? 'bg-gray-100 text-gray-800';
                                    ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $class; ?>">
                                        <?= $absen['status']; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $absen['catatan'] ?: '-'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data absensi untuk pertemuan ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Akhiri Pertemuan Modal -->
<div id="akhiriPertemuanModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Akhiri Pertemuan</h3>
                <button onclick="closeAkhiriModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div id="modalContent">
                <div class="text-center py-8">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mx-auto"></div>
                    <p class="mt-4 text-gray-600">Memproses akhir pertemuan...</p>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button id="closeButton" onclick="closeAkhiriModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 hidden">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Global functions
function akhiriPertemuan(jadwalId, kelasId, classType) {
    if (!confirm('Apakah Anda yakin ingin mengakhiri pertemuan ini? Siswa yang belum mengisi absensi akan otomatis ditandai sebagai "Tidak Hadir".')) {
        return;
    }

    // Show modal
    document.getElementById('akhiriPertemuanModal').classList.remove('hidden');
    document.getElementById('closeButton').classList.add('hidden');

    // Submit request
    fetch('<?php echo site_url("teacher/akhiri_pertemuan"); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'jadwal_id=' + jadwalId + '&kelas_id=' + kelasId + '&class_type=' + classType + '&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message and summary
            showSummary(data.summary);
        } else {
            alert('Gagal mengakhiri pertemuan: ' + data.message);
            closeAkhiriModal();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengakhiri pertemuan');
        closeAkhiriModal();
    });
}

function showSummary(summary) {
    const modalContent = document.getElementById('modalContent');

    let html = `
        <div class="text-center mb-6">
            <div class="mx-auto w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mb-4">
                <i class="fas fa-check-circle text-green-600 text-2xl"></i>
            </div>
            <h4 class="text-lg font-medium text-gray-900 mb-2">Pertemuan Berhasil Diakhiri</h4>
            <p class="text-gray-600">${summary.absent_count} siswa otomatis ditandai tidak hadir</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-blue-50 p-4 rounded-lg text-center">
                <div class="text-2xl font-bold text-blue-600">${summary.total_students}</div>
                <div class="text-sm text-blue-800">Total Siswa</div>
            </div>
            <div class="bg-green-50 p-4 rounded-lg text-center">
                <div class="text-2xl font-bold text-green-600">${summary.present_count}</div>
                <div class="text-sm text-green-800">Sudah Absen</div>
            </div>
            <div class="bg-red-50 p-4 rounded-lg text-center">
                <div class="text-2xl font-bold text-red-600">${summary.absent_count}</div>
                <div class="text-sm text-red-800">Tidak Hadir</div>
            </div>
        </div>
    `;

    if (summary.absent_students.length > 0) {
        html += `
            <div class="mb-4">
                <h5 class="font-medium text-gray-900 mb-2">Siswa yang Ditandai Tidak Hadir:</h5>
                <div class="max-h-32 overflow-y-auto bg-gray-50 rounded p-3">
                    <ul class="space-y-1">`;
        summary.absent_students.forEach(student => {
            html += `<li class="text-sm text-gray-700">• ${student.nama_lengkap} (${student.nis})</li>`;
        });
        html += `
                    </ul>
                </div>
            </div>
        `;
    }

    if (summary.present_students.length > 0) {
        html += `
            <div class="mb-4">
                <h5 class="font-medium text-gray-900 mb-2">Siswa yang Sudah Absen:</h5>
                <div class="max-h-32 overflow-y-auto bg-gray-50 rounded p-3">
                    <ul class="space-y-1">`;
        summary.present_students.forEach(student => {
            html += `<li class="text-sm text-gray-700">• ${student.nama_lengkap} (${student.nis})</li>`;
        });
        html += `
                    </ul>
                </div>
            </div>
        `;
    }

    modalContent.innerHTML = html;
    document.getElementById('closeButton').classList.remove('hidden');
}

function closeAkhiriModal() {
    document.getElementById('akhiriPertemuanModal').classList.add('hidden');
    // Reload page to show updated attendance
    location.reload();
}
</script>
