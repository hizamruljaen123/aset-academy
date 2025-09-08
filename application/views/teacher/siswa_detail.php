<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Detail Siswa</h1>
                <p class="text-sm opacity-90 mt-1"><?php echo $siswa->nama_lengkap; ?></p>
            </div>
            <a href="<?php echo site_url('teacher/manage_kelas/' . $this->db->get_where('kelas_programming', ['nama_kelas' => $siswa->kelas])->row('id')); ?>" class="hidden sm:inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Kelas
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Profile -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-md p-6 text-center">
                <img class="h-32 w-32 rounded-full object-cover mx-auto mb-4" src="<?php echo base_url('uploads/siswa/' . ($siswa->foto_profil ?: 'default_avatar.png')); ?>" alt="Foto profil <?php echo $siswa->nama_lengkap; ?>">
                <h2 class="text-xl font-bold text-gray-800"><?php echo $siswa->nama_lengkap; ?></h2>
                <p class="text-sm text-gray-500"><?php echo $siswa->nis; ?></p>
                <div class="mt-4 pt-4 border-t">
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full <?php echo ($siswa->status == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                        <?php echo $siswa->status; ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Right Column: Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Email</h3>
                        <p class="mt-1 text-sm text-gray-900"><?php echo $siswa->email; ?></p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">No Telepon</h3>
                        <p class="mt-1 text-sm text-gray-900"><?php echo $siswa->no_telepon; ?></p>
                    </div>
                    <div class="md:col-span-2">
                        <h3 class="text-sm font-medium text-gray-500">Alamat</h3>
                        <p class="mt-1 text-sm text-gray-900"><?php echo $siswa->alamat; ?></p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Tanggal Lahir</h3>
                        <p class="mt-1 text-sm text-gray-900"><?php echo date('d M Y', strtotime($siswa->tanggal_lahir)); ?></p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Jenis Kelamin</h3>
                        <p class="mt-1 text-sm text-gray-900"><?php echo ($siswa->jenis_kelamin == 'L') ? 'Laki-laki' : 'Perempuan'; ?></p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Kelas</h3>
                        <p class="mt-1 text-sm text-gray-900"><?php echo $siswa->kelas; ?></p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Jurusan</h3>
                        <p class="mt-1 text-sm text-gray-900"><?php echo $siswa->jurusan; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
