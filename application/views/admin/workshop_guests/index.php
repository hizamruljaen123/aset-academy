<?php $this->load->view('templates/header'); ?>

<div class="p-4 transition-opacity duration-500 opacity-0 workshop-guests-container">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-2xl shadow-xl ring-1 ring-gray-200/50">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-800">Workshop Guest Management</h1>
            <p class="text-lg text-gray-500 mt-2">Kelola data tamu workshop dan seminar</p>
        </div>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="mb-6 p-4 border-l-4 border-green-500 bg-green-50 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                <p class="text-green-800"><?php echo $this->session->flashdata('success'); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold"><?php echo count($workshops); ?></h3>
                    <p class="text-blue-100">Total Workshop</p>
                </div>
                <div class="text-4xl opacity-75">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-2xl shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold"><?php echo $total_guests; ?></h3>
                    <p class="text-green-100">Total Guest</p>
                </div>
                <div class="text-4xl opacity-75">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-2xl shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold">
                        <?php
                        $published_count = 0;
                        foreach ($workshops as $workshop) {
                            if ($workshop->status == 'published') $published_count++;
                        }
                        echo $published_count;
                        ?>
                    </h3>
                    <p class="text-purple-100">Workshop Aktif</p>
                </div>
                <div class="text-4xl opacity-75">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Workshop List -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
        <div class="p-6 border-b border-gray-200/50">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Workshop</h2>
            <p class="text-gray-500">Kelola workshop dan lihat data guest</p>
        </div>
        <div class="p-6">
            <div class="table-responsive">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Workshop</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Guest</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($workshops)): ?>
                            <?php foreach ($workshops as $workshop): ?>
                                <?php
                                // Count guests for this workshop
                                $this->db->where('workshop_id', $workshop->id);
                                $guest_count = $this->db->count_all_results('workshop_guests');
                                ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $workshop->id; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?php echo html_escape($workshop->title); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full <?php echo ($workshop->type == 'workshop') ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'; ?>">
                                            <?php echo ucfirst($workshop->type); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full <?php echo ($workshop->status == 'published') ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                            <?php echo ucfirst($workshop->status); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo date('d/m/Y', strtotime($workshop->start_datetime)); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                            <?php echo $guest_count; ?> Guest
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                        <a href="<?php echo site_url('admin/workshop-guests/workshop/' . $workshop->id); ?>"
                                           class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                            <i class="fas fa-users mr-1"></i>
                                            Lihat Guest
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-chalkboard-teacher text-4xl text-gray-400 mb-3"></i>
                                        <p class="text-lg font-medium text-gray-900 mb-1">Belum ada workshop</p>
                                        <p class="text-gray-500">Workshop akan muncul di sini setelah dibuat</p>
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
/* Custom styles for workshop guests page */
.workshop-guests-container {
    max-height: 70vh;
    overflow-y: auto;
    overflow-x: auto;
    scrollbar-width: thin;
    scrollbar-color: #cbd5e0 #f7fafc;
}

.workshop-guests-container::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.workshop-guests-container::-webkit-scrollbar-track {
    background: #f7fafc;
    border-radius: 4px;
}

.workshop-guests-container::-webkit-scrollbar-thumb {
    background: #cbd5e0;
    border-radius: 4px;
}

.workshop-guests-container::-webkit-scrollbar-thumb:hover {
    background: #a0aec0;
}

/* Ensure tables are responsive */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const workshopGuestsPage = document.querySelector('.transition-opacity');
    if (workshopGuestsPage) {
        workshopGuestsPage.classList.add('opacity-100');
    }

    // Add smooth scrolling for better UX
    const container = document.querySelector('.workshop-guests-container');
    if (container) {
        container.style.scrollBehavior = 'smooth';
    }
});
</script>

<?php $this->load->view('templates/footer'); ?>
