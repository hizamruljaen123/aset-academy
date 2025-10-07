<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <div class="mb-6">
        <a href="<?= admin_workshop_url($workshop->id) ?>" class="text-blue-600 hover:text-blue-800 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Workshop
        </a>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Peserta Workshop</h1>
                <p class="text-gray-600"><?= $workshop->title ?> - <?= date('d M Y', strtotime($workshop->start_datetime)) ?></p>
            </div>
            <div class="flex gap-2">
                <a href="<?= site_url('admin/workshops/export/' . encrypt_url($workshop->id)) ?>" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2">
                    <i class="fas fa-file-export"></i>
                    Export CSV
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Peserta</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peran</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Registrasi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Domisili</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($participants)): ?>
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-users text-gray-400 text-xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada peserta</h3>
                                    <p class="text-gray-500">Workshop ini belum memiliki peserta</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($participants as $participant): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        <?= $participant->nama_lengkap ?? '-' ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= $participant->email ? $participant->email : '-' ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?php if ($participant->participant_type === 'guest'): ?>
                                            bg-yellow-100 text-yellow-800
                                        <?php else: ?>
                                            bg-blue-100 text-blue-800
                                        <?php endif; ?>">
                                        <?= $participant->participant_type === 'guest' ? 'Tamu' : 'Member' ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?php if ($participant->role === 'student'): ?>
                                            bg-blue-100 text-blue-800
                                        <?php elseif ($participant->role === 'teacher'): ?>
                                            bg-purple-100 text-purple-800
                                        <?php elseif ($participant->role === 'guest'): ?>
                                            bg-yellow-100 text-yellow-800
                                        <?php else: ?>
                                            bg-gray-100 text-gray-800
                                        <?php endif; ?>">
                                        <?= ucfirst($participant->role) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($participant->participant_type === 'guest'): ?>
                                        <span class="text-xs text-gray-500">Tidak dapat diubah</span>
                                    <?php else: ?>
                                        <select class="status-select border border-gray-300 rounded-md text-sm" data-id="<?= $participant->id ?>">
                                            <option value="registered" <?= $participant->status == 'registered' ? 'selected' : '' ?>>Registered</option>
                                            <option value="attended" <?= $participant->status == 'attended' ? 'selected' : '' ?>>Attended</option>
                                            <option value="cancelled" <?= $participant->status == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                        </select>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= date('d M Y H:i', strtotime($participant->registered_at)) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php if ($participant->province_name): ?>
                                        <?= $participant->province_name ?>
                                        <?= $participant->regency_name ? ', ' . $participant->regency_name : '' ?>
                                        <?= $participant->district_name ? ', ' . $participant->district_name : '' ?>
                                        <?= $participant->village_name ? ', ' . $participant->village_name : '' ?>
                                    <?php else: ?>
                                        <span class="text-gray-400">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <?php if ($participant->participant_type === 'guest'): ?>
                                        <button class="text-red-600 hover:text-red-900 delete-guest-btn" data-id="<?= $participant->id ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    <?php else: ?>
                                        <button class="text-red-600 hover:text-red-900 delete-btn" data-id="<?= $participant->id ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Status change handler
    const statusSelects = document.querySelectorAll('.status-select');
    statusSelects.forEach(select => {
        select.addEventListener('change', function() {
            const participantId = this.dataset.id;
            const newStatus = this.value;
            
            // Send AJAX request to update status
            fetch('<?= site_url('admin/workshops/update_participant_status') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `participant_id=${participantId}&status=${newStatus}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success notification
                    alert('Status berhasil diperbarui');
                } else {
                    alert('Gagal memperbarui status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
        });
    });
    
    // Delete button handler
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus peserta ini?')) {
                const participantId = this.dataset.id;
                
                // Redirect to delete URL
                window.location.href = `<?= site_url('admin/workshops/delete_participant/') ?>${participantId}`;
            }
        });
    });

    const deleteGuestButtons = document.querySelectorAll('.delete-guest-btn');
    deleteGuestButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Hapus peserta tamu ini?')) {
                const participantId = this.dataset.id;
                window.location.href = `<?= site_url('admin/workshops/delete_guest/') ?>${participantId}`;
            }
        });
    });
});
</script>
