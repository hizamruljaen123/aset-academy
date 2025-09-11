<div class="p-4 transition-opacity duration-500 opacity-0">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Class Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold"><?= $class->nama_kelas ?></h1>
                    <p class="mt-2"><?= $class->bahasa_program ?> • <?= $class->level ?></p>
                </div>
                <span class="px-4 py-2 bg-yellow-400 text-yellow-900 rounded-full font-bold">PREMIUM</span>
            </div>
        </div>
        
        <!-- Class Content -->
        <div class="p-6">
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Class Image -->
                <div class="md:w-1/3">
                    <div class="h-48 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                        <?php if ($class->gambar): ?>
                            <img src="<?= base_url('uploads/kelas/'.$class->gambar) ?>" alt="<?= $class->nama_kelas ?>" class="h-full w-full object-cover rounded-lg">
                        <?php else: ?>
                            <i class="fas fa-laptop-code text-white text-5xl"></i>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Class Details -->
                <div class="md:w-2/3">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Deskripsi Kelas</h2>
                    <p class="text-gray-700 mb-6"><?= nl2br($class->deskripsi) ?></p>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-500">Durasi</p>
                            <p class="font-medium"><?= $class->durasi ?> Jam</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Level</p>
                            <p class="font-medium"><?= $class->level ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Bahasa</p>
                            <p class="font-medium"><?= $class->bahasa_program ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Harga</p>
                            <p class="text-xl font-bold text-blue-600">Rp <?= number_format($class->harga, 0, ',', '.') ?></p>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <a href="<?= site_url('student/premium/payment/'.$class->id) ?>" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all transform hover:scale-105 font-medium">
                            Lanjut ke Pembayaran
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('.transition-opacity');
        if (container) container.classList.add('opacity-100');
    });
</script>
