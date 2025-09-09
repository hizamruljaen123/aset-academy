<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <h1 class="text-3xl font-bold"><?= $title; ?></h1>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-sm opacity-90">NIS: <?= $siswa->nis; ?></p>
                <p class="text-sm opacity-90">Kelas: <?= $siswa->kelas; ?></p>
            </div>
            <div>
                <p class="text-sm opacity-90">Jurusan: <?= $siswa->jurusan; ?></p>
                <p class="text-sm opacity-90">Status: <?= $siswa->status; ?></p>
            </div>
            <div>
                <p class="text-sm opacity-90">Email: <?= $siswa->email; ?></p>
                <p class="text-sm opacity-90">No. Telepon: <?= $siswa->no_telepon; ?></p>
            </div>
        </div>
    </div>

    <!-- Enrolled Classes -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Programming Classes -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Kelas Programming</h2>
            <?php if (!empty($programming_classes)): ?>
                <div class="space-y-4">
                    <?php foreach ($programming_classes as $class): ?>
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-semibold text-lg"><?= $class['nama_kelas']; ?></h3>
                            <p class="text-sm text-gray-600">Level: <?= $class['level']; ?></p>
                            <p class="text-sm text-gray-600">Bahasa: <?= $class['bahasa_program']; ?></p>
                            <p class="text-sm text-gray-600">Bergabung: <?= date('d M Y', strtotime($class['enrollment_date'])); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center text-gray-500 py-4">Siswa belum terdaftar di kelas programming</p>
            <?php endif; ?>
        </div>

        <!-- Free Classes -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Kelas Gratis</h2>
            <?php if (!empty($free_classes)): ?>
                <div class="space-y-4">
                    <?php foreach ($free_classes as $class): ?>
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-semibold text-lg"><?= $class['title']; ?></h3>
                            <p class="text-sm text-gray-600">Level: <?= $class['level']; ?></p>
                            <p class="text-sm text-gray-600">Kategori: <?= $class['category']; ?></p>
                            <p class="text-sm text-gray-600">Bergabung: <?= date('d M Y', strtotime($class['enrollment_date'])); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center text-gray-500 py-4">Siswa belum terdaftar di kelas gratis</p>
            <?php endif; ?>
        </div>
    </div>
</div>
