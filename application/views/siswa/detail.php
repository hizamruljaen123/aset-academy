<div class="p-4 transition-opacity duration-500 opacity-0">
    <!-- Hero Banner -->
    <div class="relative rounded-2xl overflow-hidden mb-8 h-64 bg-gradient-to-r from-blue-600 to-indigo-700">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute inset-0 flex items-center p-8 z-10">
            <div class="flex flex-col md:flex-row items-start md:items-center w-full">
                <div class="flex items-center mb-6 md:mb-0 md:mr-8">
                    <div class="flex items-center justify-center h-20 w-20 rounded-full bg-white/10 backdrop-blur-md border-2 border-white/20 text-white text-4xl font-bold">
                        <?php echo strtoupper(substr($siswa->nama_lengkap, 0, 1)); ?>
                    </div>
                    <div class="ml-6">
                        <h1 class="text-3xl md:text-4xl font-bold text-white"><?php echo $siswa->nama_lengkap; ?></h1>
                        <p class="text-white/80 mt-1">
                            <?php echo $siswa->nis; ?> • <?php echo $siswa->kelas; ?>
                            <?php if($siswa->jurusan): ?> • <?php echo $siswa->jurusan; ?><?php endif; ?>
                        </p>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 ml-auto">
                    <a href="<?php echo site_url('siswa/edit/'.$siswa->id); ?>" 
                       class="inline-flex items-center px-5 py-2.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl text-white font-medium hover:bg-white/20 transition-all duration-300">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                    <a href="<?php echo site_url('siswa'); ?>" 
                       class="inline-flex items-center px-5 py-2.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl text-white font-medium hover:bg-white/20 transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Personal Info -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex items-center">
                        <i class="fas fa-user-circle text-blue-600 text-xl mr-3"></i>
                        <h3 class="text-xl font-bold text-gray-800">Informasi Pribadi</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">NIS</p>
                            <p class="text-lg font-mono font-medium text-gray-900"><?php echo $siswa->nis; ?></p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                            <p class="text-lg font-medium text-gray-900"><?php echo $siswa->nama_lengkap; ?></p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p class="text-lg font-medium text-gray-900"><?php echo $siswa->email; ?></p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">No Telepon</p>
                            <p class="text-lg font-medium text-gray-900"><?php echo $siswa->no_telepon; ?></p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Tanggal Lahir</p>
                            <p class="text-lg font-medium text-gray-900"><?php echo date('d F Y', strtotime($siswa->tanggal_lahir)); ?></p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Jenis Kelamin</p>
                            <p class="text-lg font-medium text-gray-900"><?php echo ($siswa->jenis_kelamin == 'L') ? 'Laki-laki' : 'Perempuan'; ?></p>
                        </div>
                        <div class="md:col-span-2 space-y-1">
                            <p class="text-sm font-medium text-gray-500">Alamat</p>
                            <p class="text-gray-900"><?php echo $siswa->alamat; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Info -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 overflow-hidden">
                <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex items-center">
                        <i class="fas fa-graduation-cap text-blue-600 text-xl mr-3"></i>
                        <h3 class="text-xl font-bold text-gray-800">Informasi Akademik</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Kelas Programming</p>
                            <p class="text-lg font-medium text-gray-900"><?php echo $siswa->kelas; ?></p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Jurusan</p>
                            <p class="text-lg font-medium text-gray-900"><?php echo $siswa->jurusan; ?></p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Status</p>
                            <span class="px-3 py-1 text-sm font-medium rounded-full <?php 
                                echo ($siswa->status == 'Aktif') ? 'bg-green-100 text-green-800' : 
                                (($siswa->status == 'Tidak Aktif') ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800'); 
                            ?>">
                                <?php echo $siswa->status; ?>
                            </span>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Dibuat</p>
                            <p class="text-sm text-gray-500"><?php echo date('d F Y, H:i', strtotime($siswa->created_at)); ?></p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Terakhir Update</p>
                            <p class="text-sm text-gray-500"><?php echo date('d F Y, H:i', strtotime($siswa->updated_at)); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const page = document.querySelector('.transition-opacity');
    if (page) page.classList.add('opacity-100');
});
</script>

<?php $this->load->view('templates/footer'); ?>