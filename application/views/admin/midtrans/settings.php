<div class="bg-gray-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Midtrans Settings</h1>
            <p class="mt-2 text-gray-600">Konfigurasi kredensial dan pengaturan Midtrans</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Environment Settings</h2>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <i class="fas fa-exclamation-triangle text-yellow-400 mt-0.5 mr-3"></i>
                        <div>
                            <h4 class="text-sm font-medium text-yellow-800">Environment Configuration</h4>
                            <p class="mt-1 text-sm text-yellow-700">
                                Gunakan environment variables atau edit file <code class="bg-yellow-100 px-1 rounded">application/config/midtrans.php</code> secara manual untuk mengubah kredensial.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <form class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Environment</label>
                        <div class="mt-2">
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="environment" value="sandbox" <?php echo !$config['is_production'] ? 'checked' : ''; ?> class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Sandbox (Testing)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="environment" value="production" <?php echo $config['is_production'] ? 'checked' : ''; ?> class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Production</span>
                                </label>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Current: <strong><?php echo $config['is_production'] ? 'Production' : 'Sandbox'; ?></strong></p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Merchant ID</label>
                        <input type="text" value="<?php echo htmlspecialchars($config['merchant_id']); ?>" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-50 text-gray-500">
                        <p class="mt-1 text-xs text-gray-500">Merchant ID dari dashboard Midtrans</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Server Key</label>
                        <input type="password" value="<?php echo htmlspecialchars($config['server_key']); ?>" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-50 text-gray-500">
                        <p class="mt-1 text-xs text-gray-500">Server Key untuk autentikasi API</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Client Key</label>
                        <input type="password" value="<?php echo htmlspecialchars($config['client_key']); ?>" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-50 text-gray-500">
                        <p class="mt-1 text-xs text-gray-500">Client Key untuk Snap.js</p>
                    </div>
                </div>

                <div class="border-t pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Konfigurasi Environment Variables</h3>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <p class="text-sm text-blue-700 mb-3">Untuk mengubah environment, set environment variables berikut:</p>
                        <div class="bg-white rounded p-3 font-mono text-sm">
                            <div class="mb-2"># Untuk Sandbox (Testing)</div>
                            <div>MIDTRANS_IS_PRODUCTION=false</div>
                            <div>MIDTRANS_SERVER_KEY=Mid-server-KXtae-QeXAJ737ZpyqRAzsNO</div>
                            <div>MIDTRANS_CLIENT_KEY=Mid-client-AtOLqdbsCvYgyBse</div>
                            <div>MIDTRANS_MERCHANT_ID=G457493821</div>
                        </div>
                        <div class="bg-white rounded p-3 font-mono text-sm mt-3">
                            <div class="mb-2"># Untuk Production</div>
                            <div>MIDTRANS_IS_PRODUCTION=true</div>
                            <div>MIDTRANS_SERVER_KEY=Mid-server-l5jfjrzDD0CpjCGHOpW6dwqE</div>
                            <div>MIDTRANS_CLIENT_KEY=Mid-client-ZkemQ2DEq8JSJOOz</div>
                            <div>MIDTRANS_MERCHANT_ID=G457493821</div>
                        </div>
                        <p class="text-xs text-blue-600 mt-2">Set environment variables di server atau file .env</p>
                    </div>
                </div>

                <div class="border-t pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Testing Pembayaran</h3>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-sm text-green-700 mb-3">Untuk test pembayaran:</p>
                        <ul class="text-sm text-green-700 space-y-1">
                            <li>• <strong>Sandbox:</strong> Gunakan kartu test 4811 1111 1111 1114</li>
                            <li>• <strong>Production:</strong> Gunakan kartu atau metode pembayaran real</li>
                            <li>• <a href="<?php echo base_url('admin/midtrans/test'); ?>" class="text-green-600 hover:text-green-800 underline">Test di halaman Midtrans Test</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Maintenance Mode</h3>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-medium text-yellow-800">Mode Maintenance</h4>
                                <p class="text-sm text-yellow-700">Aktifkan untuk menonaktifkan sementara pembayaran via Midtrans</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="maintenance_mode" class="sr-only peer" <?php echo get_setting('midtrans_maintenance_mode') == '1' ? 'checked' : ''; ?>>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-700">
                                    <?php echo get_setting('midtrans_maintenance_mode') == '1' ? 'Aktif' : 'Nonaktif'; ?>
                                </span>
                            </label>
                        </div>
                        <div id="maintenance_message_container" class="mt-4 <?php echo get_setting('midtrans_maintenance_mode') == '1' ? '' : 'hidden'; ?>">
                            <label for="maintenance_message" class="block text-sm font-medium text-gray-700 mb-1">Pesan Maintenance</label>
                            <textarea id="maintenance_message" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"><?php echo get_setting('midtrans_maintenance_message', 'Pembayaran sedang dalam perbaikan. Silakan coba lagi nanti.'); ?></textarea>
                            <p class="mt-1 text-xs text-gray-500">Pesan yang akan ditampilkan saat mode maintenance aktif</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between pt-6">
                    <button type="button" id="save_maintenance" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Pengaturan
                    </button>
                    <a href="<?php echo base_url('admin/midtrans'); ?>" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
        </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const maintenanceCheckbox = document.getElementById('maintenance_mode');
    const maintenanceContainer = document.getElementById('maintenance_message_container');
    const saveButton = document.getElementById('save_maintenance');
    
    // Toggle maintenance message field
    maintenanceCheckbox.addEventListener('change', function() {
        const statusSpan = maintenanceCheckbox.parentElement.querySelector('span.text-gray-700');
        if (this.checked) {
            maintenanceContainer.classList.remove('hidden');
            if (statusSpan) statusSpan.textContent = 'Aktif';
        } else {
            maintenanceContainer.classList.add('hidden');
            if (statusSpan) statusSpan.textContent = 'Nonaktif';
        }
    });
    
    // Save maintenance settings
    saveButton.addEventListener('click', function() {
        const isMaintenance = maintenanceCheckbox.checked ? '1' : '0';
        const maintenanceMessage = document.getElementById('maintenance_message').value;
        
        // Show loading state
        const originalText = saveButton.innerHTML;
        saveButton.disabled = true;
        saveButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
        
        // Send AJAX request
        fetch('<?php echo base_url("admin/midtrans/save_maintenance"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: `maintenance_mode=${isMaintenance}&maintenance_message=${encodeURIComponent(maintenanceMessage)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showToast('success', 'Pengaturan berhasil disimpan');
            } else {
                throw new Error(data.message || 'Gagal menyimpan pengaturan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', error.message || 'Terjadi kesalahan saat menyimpan pengaturan');
        })
        .finally(() => {
            saveButton.disabled = false;
            saveButton.innerHTML = originalText;
        });
    });
    
    function showToast(type, message) {
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        toast.textContent = message;
        
        // Add to body
        document.body.appendChild(toast);
        
        // Remove after 3 seconds
        setTimeout(() => {
            toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }
});
</script>
