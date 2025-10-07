<?php $this->load->view('templates/header'); ?>

<div class="p-4 transition-opacity duration-500 opacity-0 workshop-detail-container">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-2xl shadow-xl ring-1 ring-gray-200/50">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-800">Guest Workshop: <?php echo html_escape($workshop->title); ?></h1>
            <p class="text-lg text-gray-500 mt-2">Kelola data tamu workshop ini</p>
        </div>
        <div class="flex space-x-3">
            <a href="<?php echo site_url('admin/workshop-guests/export/' . $workshop->id); ?>" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-xl font-medium text-sm text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:-translate-y-0.5">
                <i class="fas fa-download mr-2"></i>
                Export CSV
            </a>
            <a href="<?php echo site_url('admin/workshop-guests'); ?>" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-xl font-medium text-sm text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 transform hover:-translate-y-0.5">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Workshop Info -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden mb-8">
        <div class="p-6 border-b border-gray-200/50">
            <h2 class="text-2xl font-bold text-gray-800">Informasi Workshop</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="bg-blue-50 rounded-xl p-4">
                        <i class="fas fa-calendar-alt text-blue-600 text-2xl mb-2"></i>
                        <h3 class="font-semibold text-gray-800">Tanggal</h3>
                        <p class="text-sm text-gray-600"><?php echo date('d F Y', strtotime($workshop->start_datetime)); ?></p>
                    </div>
                </div>
                <div class="text-center">
                    <div class="bg-green-50 rounded-xl p-4">
                        <i class="fas fa-clock text-green-600 text-2xl mb-2"></i>
                        <h3 class="font-semibold text-gray-800">Waktu</h3>
                        <p class="text-sm text-gray-600"><?php echo date('H:i', strtotime($workshop->start_datetime)); ?> - <?php echo date('H:i', strtotime($workshop->end_datetime)); ?></p>
                    </div>
                </div>
                <div class="text-center">
                    <div class="bg-purple-50 rounded-xl p-4">
                        <i class="fas fa-map-marker-alt text-purple-600 text-2xl mb-2"></i>
                        <h3 class="font-semibold text-gray-800">Lokasi</h3>
                        <p class="text-sm text-gray-600"><?php echo html_escape($workshop->location); ?></p>
                    </div>
                </div>
                <div class="text-center">
                    <div class="bg-yellow-50 rounded-xl p-4">
                        <i class="fas fa-tag text-yellow-600 text-2xl mb-2"></i>
                        <h3 class="font-semibold text-gray-800">Harga</h3>
                        <p class="text-sm text-gray-600"><?php echo $workshop->price > 0 ? 'Rp ' . number_format($workshop->price) : 'Gratis'; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold"><?php echo $statistics['total_guests']; ?></h3>
                    <p class="text-blue-100">Total Guest</p>
                </div>
                <div class="text-4xl opacity-75">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-2xl shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold">
                        <?php
                        $total_registered = 0;
                        foreach ($statistics['guests_by_job'] as $job) {
                            $total_registered += $job->count;
                        }
                        echo $total_registered;
                        ?>
                    </h3>
                    <p class="text-green-100">Terdaftar</p>
                </div>
                <div class="text-4xl opacity-75">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-2xl shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold">
                        <?php
                        $avg_age = 0;
                        $total_guests = count($guests);
                        if ($total_guests > 0) {
                            foreach ($guests as $guest) {
                                $avg_age += $guest->usia;
                            }
                            $avg_age = round($avg_age / $total_guests);
                        }
                        echo $avg_age;
                        ?>
                    </h3>
                    <p class="text-purple-100">Rata-rata Usia</p>
                </div>
                <div class="text-4xl opacity-75">
                    <i class="fas fa-birthday-cake"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-red-500 to-red-600 text-white p-6 rounded-2xl shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold">
                        <?php
                        $male_count = 0;
                        foreach ($guests as $guest) {
                            // Assuming we can determine gender from name or other field
                            // For now, just show total
                        }
                        echo count($guests);
                        ?>
                    </h3>
                    <p class="text-red-100">Peserta Aktif</p>
                </div>
                <div class="text-4xl opacity-75">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Guest List -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
        <div class="p-6 border-b border-gray-200/50">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Guest (<?php echo count($guests); ?>)</h2>
            <p class="text-gray-500">Data peserta workshop</p>
        </div>
        <div class="p-6">
            <div class="table-responsive">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asal Kampus/Sekolah</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usia</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pekerjaan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. WhatsApp</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($guests)): ?>
                            <?php $no = 1; foreach ($guests as $guest): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $no++; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?php echo html_escape($guest->nama_lengkap); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo html_escape($guest->asal_kampus_sekolah); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            <?php echo $guest->usia; ?> tahun
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                            <?php echo $guest->pekerjaan; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php
                                        $raw_phone_number = preg_replace('/[^0-9]/', '', $guest->no_wa_telegram);
                                        $formatted_phone_number = $raw_phone_number;
                                        if (substr($raw_phone_number, 0, 2) === '08') {
                                            $formatted_phone_number = '62' . substr($raw_phone_number, 1);
                                        }
                                        ?>
                                        <a href="https://wa.me/<?php echo $formatted_phone_number; ?>"
                                           target="_blank" class="text-green-600 hover:text-green-900">
                                            <i class="fab fa-whatsapp mr-1"></i>
                                            <?php echo html_escape($guest->no_wa_telegram); ?>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo date('d/m/Y H:i', strtotime($guest->registered_at)); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                        <button onclick="deleteGuest(<?php echo $guest->id; ?>, '<?php echo html_escape($guest->nama_lengkap); ?>')"
                                                class="text-red-600 hover:text-red-900 p-1 rounded-full hover:bg-red-50">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-users text-4xl text-gray-400 mb-3"></i>
                                        <p class="text-lg font-medium text-gray-900 mb-1">Belum ada guest yang mendaftar</p>
                                        <p class="text-gray-500">Guest workshop akan muncul di sini setelah mendaftar</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom styles for workshop detail page */
.workshop-detail-container {
    max-height: 70vh;
    overflow-y: auto;
    overflow-x: auto;
    scrollbar-width: thin;
    scrollbar-color: #cbd5e0 #f7fafc;
}

.workshop-detail-container::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.workshop-detail-container::-webkit-scrollbar-track {
    background: #f7fafc;
    border-radius: 4px;
}

.workshop-detail-container::-webkit-scrollbar-thumb {
    background: #cbd5e0;
    border-radius: 4px;
}

.workshop-detail-container::-webkit-scrollbar-thumb:hover {
    background: #a0aec0;
}

/* Ensure tables are responsive */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
</style>

<script>
function deleteGuest(guestId, guestName) {
    if (confirm('Apakah Anda yakin ingin menghapus guest "' + guestName + '"?')) {
        fetch('<?php echo site_url('admin/workshop-guests/delete-guest/'); ?>' + guestId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Guest berhasil dihapus');
                location.reload();
            } else {
                alert('Gagal menghapus guest: ' + data.message);
            }
        })
        .catch(error => {
            alert('Terjadi kesalahan saat menghapus guest');
            console.error('Error:', error);
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const workshopDetailPage = document.querySelector('.transition-opacity');
    if (workshopDetailPage) {
        workshopDetailPage.classList.add('opacity-100');
    }

    // Add smooth scrolling for better UX
    const container = document.querySelector('.workshop-detail-container');
    if (container) {
        container.style.scrollBehavior = 'smooth';
    }
});
</script>

<?php $this->load->view('templates/footer'); ?>
