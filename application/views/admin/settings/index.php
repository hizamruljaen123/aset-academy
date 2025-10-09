<div class="p-4 transition-opacity duration-500 opacity-0 h-full flex flex-col">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white p-6 rounded-2xl shadow-xl ring-1 ring-gray-200/50">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-800">Pengaturan Sistem</h1>
            <p class="text-lg text-gray-500 mt-2">Kelola pengaturan website dan sistem</p>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="mb-6 p-4 border-l-4 border-green-500 bg-green-50 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                <p class="text-green-800"><?php echo $this->session->flashdata('success'); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="mb-6 p-4 border-l-4 border-red-500 bg-red-50 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
                <p class="text-red-800"><?php echo $this->session->flashdata('error'); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Settings Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Maintenance Mode Card -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 p-6">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-orange-100 text-orange-600 mr-4">
                        <i class="fas fa-tools text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Mode Maintenance</h3>
                        <p class="text-gray-500">Aktifkan mode maintenance website</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="text-sm font-medium mr-3 <?php echo (isset($settings['maintenance_mode']['value']) && $settings['maintenance_mode']['value']) ? 'text-red-600' : 'text-green-600'; ?>">
                        <?php echo (isset($settings['maintenance_mode']['value']) && $settings['maintenance_mode']['value']) ? 'AKTIF' : 'NONAKTIF'; ?>
                    </span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox"
                               id="maintenance-toggle"
                               <?php echo (isset($settings['maintenance_mode']['value']) && $settings['maintenance_mode']['value']) ? 'checked' : ''; ?>
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>

            <form id="maintenance-form" action="<?php echo site_url('admin/settings/maintenance_mode'); ?>" method="post" class="space-y-4">
                <div>
                    <label for="maintenance_message" class="block text-sm font-medium text-gray-700 mb-2">
                        Pesan Maintenance
                    </label>
                    <textarea name="maintenance_message"
                              id="maintenance_message"
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                              placeholder="Masukkan pesan yang akan ditampilkan saat maintenance"><?php echo isset($settings['maintenance_message']['value']) ? htmlspecialchars($settings['maintenance_message']['value']) : ''; ?></textarea>
                    <p class="text-xs text-gray-500 mt-1">Pesan ini akan ditampilkan kepada pengguna saat website dalam mode maintenance.</p>
                </div>

                <input type="hidden" name="maintenance_mode" id="maintenance_mode_input" value="<?php echo (isset($settings['maintenance_mode']['value']) && $settings['maintenance_mode']['value']) ? 'true' : 'false'; ?>">

                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Pengaturan
                </button>
            </form>

            <!-- Quick Actions -->
            <div class="mt-4 pt-4 border-t border-gray-200">
                <p class="text-sm font-medium text-gray-700 mb-3">Aksi Cepat:</p>
                <div class="flex flex-col sm:flex-row gap-2">
                    <a href="<?php echo site_url(); ?>" target="_blank" class="inline-flex items-center justify-center px-3 py-2 bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-lg font-medium text-sm text-gray-700 transition-colors">
                        <i class="fas fa-external-link-alt mr-2"></i>
                        Lihat Website
                    </a>
                    <a href="<?php echo site_url('home/maintenance'); ?>" target="_blank" class="inline-flex items-center justify-center px-3 py-2 bg-orange-100 hover:bg-orange-200 border border-orange-300 rounded-lg font-medium text-sm text-orange-700 transition-colors">
                        <i class="fas fa-tools mr-2"></i>
                        Pratinjau Maintenance
                    </a>
                </div>
            </div>
        </div>

        <!-- System Information Card -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 p-6">
            <div class="flex items-center mb-6">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <i class="fas fa-info-circle text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Informasi Sistem</h3>
                    <p class="text-gray-500">Status dan informasi sistem</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600">Status Maintenance</span>
                    <span class="font-medium <?php echo (isset($settings['maintenance_mode']['value']) && $settings['maintenance_mode']['value']) ? 'text-red-600' : 'text-green-600'; ?>">
                        <?php echo (isset($settings['maintenance_mode']['value']) && $settings['maintenance_mode']['value']) ? 'Aktif' : 'Nonaktif'; ?>
                    </span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600">Total Pengaturan</span>
                    <span class="font-medium text-gray-800"><?php echo count($settings); ?></span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600">Terakhir Update</span>
                    <span class="font-medium text-gray-800">
                        <?php
                        $last_update = 'Belum pernah';
                        foreach ($settings as $setting) {
                            if (isset($setting['updated_at']) && $setting['updated_at'] > $last_update) {
                                $last_update = $setting['updated_at'];
                            }
                        }
                        echo $last_update !== 'Belum pernah' ? date('d M Y H:i', strtotime($last_update)) : $last_update;
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- All Settings List -->
    <div class="mt-8 bg-white rounded-2xl shadow-xl ring-1 ring-gray-200/50 p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Semua Pengaturan</h3>

        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-3 font-semibold text-gray-800">Pengaturan</th>
                        <th class="pb-3 font-semibold text-gray-800">Nilai</th>
                        <th class="pb-3 font-semibold text-gray-800">Tipe</th>
                        <th class="pb-3 font-semibold text-gray-800">Terakhir Update</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($settings as $key => $setting): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3">
                                <div>
                                    <div class="font-medium text-gray-800"><?php echo htmlspecialchars($key); ?></div>
                                    <?php if (isset($setting['description'])): ?>
                                        <div class="text-sm text-gray-500"><?php echo htmlspecialchars($setting['description']); ?></div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="font-mono text-sm text-gray-700">
                                    <?php
                                    if ($setting['type'] === 'boolean') {
                                        echo $setting['value'] ? '<span class="text-green-600">true</span>' : '<span class="text-red-600">false</span>';
                                    } else {
                                        echo htmlspecialchars(substr($setting['value'], 0, 50));
                                        if (strlen($setting['value']) > 50) echo '...';
                                    }
                                    ?>
                                </span>
                            </td>
                            <td class="py-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <?php echo htmlspecialchars($setting['type']); ?>
                                </span>
                            </td>
                            <td class="py-3 text-sm text-gray-500">
                                <?php echo isset($setting['updated_at']) ? date('d M Y H:i', strtotime($setting['updated_at'])) : '-'; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Toggle maintenance mode
document.getElementById('maintenance-toggle').addEventListener('change', function() {
    const isChecked = this.checked;
    document.getElementById('maintenance_mode_input').value = isChecked ? 'true' : 'false';

    // Optional: Auto-submit form or show confirmation
    if (confirm('Apakah Anda yakin ingin ' + (isChecked ? 'mengaktifkan' : 'menonaktifkan') + ' mode maintenance?')) {
        document.getElementById('maintenance-form').submit();
    } else {
        // Revert toggle if cancelled
        this.checked = !isChecked;
        document.getElementById('maintenance_mode_input').value = !isChecked ? 'true' : 'false';
    }
});
</script>
