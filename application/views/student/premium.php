<div class="p-4 transition-opacity duration-500 opacity-0">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-xl shadow-lg">
        <ul class="flex space-x-4" id="premiumTabs">
            <li><button data-tab="available" class="tab-link px-4 py-2 rounded-lg bg-blue-600 text-white">Kelas Tersedia</button></li>
            <li><button data-tab="orders" class="tab-link px-4 py-2 rounded-lg bg-gray-100 text-gray-700">Pesanan Saya</button></li>
            <li><button data-tab="myclasses" class="tab-link px-4 py-2 rounded-lg bg-gray-100 text-gray-700">Kelas Saya</button></li>
        </ul>
    </div>
    
    <div class="grid grid-cols-1 gap-8" id="tabPanels">
    <!-- AVAILABLE CLASSES -->
    <div id="panel-available" class="tab-panel">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Kelas Tersedia</h2>
        <?php if (!empty($premium_classes)): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php foreach($premium_classes as $class): ?>
                            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
                                <div class="h-48 bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center">
                                    <?php if ($class->gambar): ?>
                                        <img src="<?= $class->gambar ?>" alt="<?= $class->nama_kelas ?>" class="h-full w-full object-cover">
                                    <?php else: ?>
                                        <div class="text-white text-5xl">
                                            <i class="fas fa-laptop-code"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-lg font-bold text-gray-800"><?= $class->nama_kelas ?></h3>
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold">PREMIUM</span>
                                    </div>
                                    <p class="text-gray-600 mb-4 text-sm"><?= substr($class->deskripsi, 0, 120) ?><?= strlen($class->deskripsi) > 120 ? '...' : '' ?></p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold text-blue-600">Rp <?= number_format($class->harga, 0, ',', '.') ?></span>
                                        <div class="flex space-x-2">
                                            <a href="<?= site_url('kelas/detail/'.encrypt_url($class->id)) ?>" class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all text-sm font-medium">
                                                Lihat Detail
                                            </a>
                                            <a href="<?= site_url('student/premium/buy/'.encrypt_url($class->id)) ?>" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all transform hover:scale-105 text-sm font-medium">
                                                Beli Sekarang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="bg-white p-8 rounded-xl shadow-lg text-center">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-graduation-cap text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada kelas premium tersedia</h3>
                        <p class="text-gray-500">Kami akan segera menambahkan kelas premium baru</p>
                    </div>
                <?php endif; ?>
    </div>

        <!-- ORDERS PANEL -->
    <div id="panel-orders" class="tab-panel hidden">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Pesanan Saya</h2>
        <?php if (!empty($orders)): ?>
            <div class="overflow-x-auto bg-white rounded-xl shadow">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-blue-600 text-white text-left">
                            <th class="px-4 py-3 text-sm">Tanggal</th>
                            <th class="px-4 py-3 text-sm">Kelas</th>
                            <th class="px-4 py-3 text-sm">Jumlah</th>
                            <th class="px-4 py-3 text-sm">Invoice</th>
                            <th class="px-4 py-3 text-sm">Status</th>
                            <th class="px-4 py-3 text-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $o): ?>
                        <tr class="border-b hover:bg-gray-50 text-sm">
                            <td class="px-4 py-3 whitespace-nowrap"><?= date('d-m-Y H:i', strtotime($o->created_at)) ?></td>
                            <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-800"><?= $o->class_name ?></td>
                            <td class="px-4 py-3 whitespace-nowrap">Rp <?= number_format($o->amount,0,',','.') ?></td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <?php if(!empty($o->invoice_number)): ?>
                                    <a href="<?= site_url('payment/invoice/'.encrypt_url($o->id)) ?>" target="_blank" class="text-blue-600 hover:underline text-xs">
                                        <?= $o->invoice_number ?>
                                    </a>
                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <?php if($o->status==='Verified'): ?>
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full">Terverifikasi</span>
                                <?php elseif($o->status==='Pending'): ?>
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full">Menunggu</span>
                                <?php else: ?>
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full">Ditolak</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <?php 
                                $encrypted_id = $this->encryption_url->encode($o->id);
                                $url_safe_id = str_replace(['+', '/'], ['-', '_'], $encrypted_id);
                                ?>
                                <a href="<?= site_url('payment/status/'.$url_safe_id) ?>" class="text-blue-600 hover:underline">Lihat</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="bg-white p-6 rounded-xl shadow text-center text-gray-600">Belum ada pesanan.</div>
        <?php endif; ?>
    </div>

    <!-- MY CLASSES PANEL (reuse paid_classes) -->
    <div id="panel-myclasses" class="tab-panel hidden">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Kelas Saya</h2>
        <?php if(!empty($paid_classes)): ?>
            <div class="space-y-4">
                <?php foreach($paid_classes as $c): ?>
                    <div class="bg-white rounded-lg shadow p-4 flex justify-between items-center">
                        <div>
                            <h4 class="font-medium text-gray-800"><?= $c->class_name ?></h4>
                            <p class="text-sm text-gray-500">Rp <?= number_format($c->amount,0,',','.') ?></p>
                        </div>
                        <a href="<?= site_url('kelas/detail/'.encrypt_url($c->class_id)) ?>" class="text-sm text-blue-600 hover:underline">Akses</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="bg-white p-6 rounded-xl shadow text-center text-gray-600">Belum ada kelas aktif.</div>
        <?php endif; ?>
    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('.transition-opacity');
        if (container) container.classList.add('opacity-100');

        const tabLinks = document.querySelectorAll('.tab-link');
        const panels   = document.querySelectorAll('.tab-panel');
        function show(tab){
            panels.forEach(p=>p.classList.add('hidden'));
            document.getElementById('panel-'+tab).classList.remove('hidden');
            tabLinks.forEach(l=>{l.classList.remove('bg-blue-600','text-white');l.classList.add('bg-gray-100','text-gray-700');});
            document.querySelector(`.tab-link[data-tab="${tab}"]`).classList.remove('bg-gray-100','text-gray-700');
            document.querySelector(`.tab-link[data-tab="${tab}"]`).classList.add('bg-blue-600','text-white');
        }
        tabLinks.forEach(l=>l.addEventListener('click',()=>show(l.dataset.tab)));
        // default
        show('available');
    });
</script>
