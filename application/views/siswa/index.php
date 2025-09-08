<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Hero Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-lg shadow">
        <div class="mb-4 md:mb-0">
            <h1 class="text-2xl font-bold text-gray-800">Data Siswa</h1>
            <p class="text-gray-600 mt-1">Kelola data siswa dengan mudah dan efisien</p>
        </div>
        <a href="<?php echo site_url('siswa/create'); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition">
            <i class="fas fa-plus mr-2"></i> Tambah Siswa
        </a>
    </div>

    <!-- Search and Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Daftar Siswa</h2>
            <p class="text-sm text-gray-500">Semua siswa yang terdaftar</p>
        </div>
        <div class="p-4">
            <form method="post" action="<?php echo site_url('siswa/search'); ?>" class="mb-4">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="keyword" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Cari siswa berdasarkan nama, NIS, kelas, atau jurusan..." value="<?php echo isset($keyword) ? $keyword : ''; ?>">
                </div>
            </form>

            <?php if (empty($siswa)): ?>
                <div class="text-center py-8">
                    <i class="fas fa-users text-4xl text-gray-400 mb-2"></i>
                    <h3 class="text-lg font-medium text-gray-900">Tidak ada data siswa</h3>
                    <p class="text-gray-500">Mulai dengan menambahkan siswa baru untuk kelas ini</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $no = 1; foreach ($siswa as $s): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $no++; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600"><?php echo $s->nis; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold mr-3">
                                                <?php echo strtoupper(substr($s->nama_lengkap, 0, 1)); ?>
                                            </div>
                                            <div class="text-sm font-medium text-gray-900"><?php echo $s->nama_lengkap; ?></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $s->email; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded bg-blue-100 text-blue-800"><?php echo $s->kelas; ?></span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $s->jurusan; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded <?php echo ($s->status == 'Aktif') ? 'bg-green-100 text-green-800' : (($s->status == 'Tidak Aktif') ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800'); ?>">
                                            <?php echo $s->status; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                        <div class="flex justify-center space-x-2">
                                            <?php 
                                                $kelas_detail = $this->db->get_where('kelas_programming', ['nama_kelas' => $s->kelas])->row();
                                                if ($kelas_detail && !empty($kelas_detail->online_meet_link)): 
                                            ?>
                                                <a href="<?php echo $kelas_detail->online_meet_link; ?>" target="_blank" class="text-green-600 hover:text-green-900 p-1 rounded-full hover:bg-green-50" title="Join Meeting">
                                                    <i class="fas fa-video"></i>
                                                </a>
                                            <?php endif; ?>
                                            <a href="<?php echo site_url('siswa/detail/'.$s->id); ?>" class="text-blue-600 hover:text-blue-900 p-1 rounded-full hover:bg-blue-50" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?php echo site_url('siswa/edit/'.$s->id); ?>" class="text-indigo-600 hover:text-indigo-900 p-1 rounded-full hover:bg-indigo-50" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?php echo site_url('siswa/delete/'.$s->id); ?>" class="text-red-600 hover:text-red-900 p-1 rounded-full hover:bg-red-50" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const siswaPage = document.querySelector('.transition-opacity');
        if (siswaPage) {
            siswaPage.classList.add('opacity-100');
        }
    });
</script>

<?php $this->load->view('templates/footer'); ?>