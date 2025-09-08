<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Card -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Card Header -->
        <div class="p-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h2 class="text-lg font-medium text-gray-900">Data Kelas</h2>
                    <p class="text-sm text-gray-500">Kelola daftar kelas programming yang tersedia</p>
                </div>
                <a href="<?php echo site_url('kelas/create'); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kelas
                </a>
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="p-4">
            <!-- Search Form -->
            <form method="post" action="<?php echo site_url('kelas/search'); ?>" class="mb-4">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="keyword" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Cari kelas berdasarkan nama, level, atau bahasa..." value="<?php echo isset($keyword) ? $keyword : ''; ?>">
                </div>
            </form>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kelas</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bahasa</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (empty($kelas)): ?>
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-code text-4xl text-gray-400 mb-3"></i>
                                        <p class="text-lg font-medium text-gray-900 mb-1">Tidak ada data kelas</p>
                                        <p class="text-sm text-gray-500">Mulai dengan menambahkan kelas baru</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; ?>
                            <?php foreach ($kelas as $k): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $no++; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-blue-600"><?php echo $k->nama_kelas; ?></div>
                                        <div class="text-xs text-gray-500"><?php echo $k->bahasa_program; ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php
                                        $level_bg = '';
                                        if ($k->level == 'Dasar') {
                                            $level_bg = 'bg-green-100 text-green-800';
                                        } elseif ($k->level == 'Menengah') {
                                            $level_bg = 'bg-yellow-100 text-yellow-800';
                                        } else {
                                            $level_bg = 'bg-red-100 text-red-800';
                                        }
                                        ?>
                                        <span class="px-2 py-1 text-xs font-medium rounded <?php echo $level_bg; ?>">
                                            <?php echo $k->level; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $k->bahasa_program; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $k->durasi; ?> jam</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp <?php echo number_format($k->harga, 0, ',', '.'); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded <?php echo ($k->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; ?>">
                                            <?php echo $k->status; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="<?php echo site_url('kelas/detail/'.$k->id); ?>" class="text-blue-600 hover:text-blue-900 p-1 rounded-full hover:bg-blue-50" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?php echo site_url('kelas/edit/'.$k->id); ?>" class="text-indigo-600 hover:text-indigo-900 p-1 rounded-full hover:bg-indigo-50" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?php echo site_url('kelas/delete/'.$k->id); ?>" class="text-red-600 hover:text-red-900 p-1 rounded-full hover:bg-red-50" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kelasPage = document.querySelector('.transition-opacity');
        if (kelasPage) {
            kelasPage.classList.add('opacity-100');
        }
    });
</script>

<?php $this->load->view('templates/footer'); ?>