<div class="bg-gray-100 py-12">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-8">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Midtrans Payment Testing</h1>
                <p class="text-gray-600 mt-1">Test integrasi pembayaran Midtrans di environment <?php echo $is_production ? 'Production' : 'Sandbox'; ?></p>
            </div>
            <a href="<?php echo base_url('admin/midtrans'); ?>" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <p class="text-sm text-blue-800">
                Halaman ini digunakan untuk menguji integrasi Midtrans Snap di admin panel.
                Pastikan kredensial sudah dikonfigurasi dengan benar di file <code>application/config/midtrans.php</code>.
            </p>
        </div>

        <form id="midtrans-test-form" class="space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700" for="customer_name">Nama Customer</label>
                    <input
                        type="text"
                        name="customer_name"
                        id="customer_name"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Mis. John Doe"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700" for="customer_email">Email Customer</label>
                    <input
                        type="email"
                        name="customer_email"
                        id="customer_email"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="test@example.com"
                    />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700" for="class_select">Pilih Kelas <span class="text-gray-500">(Opsional)</span></label>
                    <select
                        name="class_select"
                        id="class_select"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    >
                        <option value="">-- Pilih Kelas atau Masukkan Manual --</option>
                        <?php foreach ($classes as $class): ?>
                        <option value="<?php echo $class->id; ?>" data-price="<?php echo $class->harga; ?>" data-name="<?php echo htmlspecialchars($class->nama_kelas); ?>">
                            <?php echo htmlspecialchars($class->nama_kelas); ?> - Rp <?php echo number_format($class->harga, 0, ',', '.'); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="mt-1 text-xs text-gray-500">Pilih kelas untuk auto-fill harga, atau kosongkan untuk manual</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700" for="amount">Jumlah Pembayaran (IDR)</label>
                    <input
                        type="number"
                        name="amount"
                        id="amount"
                        min="1000"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="50000"
                        required
                    />
                    <p class="mt-1 text-xs text-gray-500">Harga akan terisi otomatis saat memilih kelas</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    <i class="fas fa-play mr-2"></i>
                    Buat Transaksi & Buka Snap
                </button>
                <span id="midtrans-status" class="text-sm text-gray-500"></span>
            </div>
        </form>

        <div id="midtrans-result" class="mt-6 hidden">
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Hasil Transaksi</h2>
            <div class="bg-gray-900 text-green-200 rounded-lg p-4 overflow-auto text-xs">
                <pre id="result-json"></pre>
            </div>
        </div>

        <!-- Success URL Info -->
        <div class="mt-8 bg-green-50 border border-green-200 rounded-lg p-4">
            <h3 class="text-sm font-medium text-green-800 mb-2 flex items-center">
                <i class="fas fa-info-circle mr-2"></i>
                URL Success Page
            </h3>
            <p class="text-sm text-green-700">
                Setelah pembayaran berhasil, customer akan diarahkan ke:
            </p>
            <code class="block mt-2 bg-white px-3 py-2 rounded text-sm text-gray-800 border">
                <?php echo base_url('midtrans_public/success'); ?>?order_id={ORDER_ID}
            </code>
        </div>
    </div>
</div>

<script src="<?= $snap_js_url ?>" data-client-key="<?= $client_key ?>"></script>
<script>
(function() {
    const form = document.getElementById('midtrans-test-form');
    const statusEl = document.getElementById('midtrans-status');
    const resultWrapper = document.getElementById('midtrans-result');
    const resultJson = document.getElementById('result-json');
    const classSelect = document.getElementById('class_select');
    const amountInput = document.getElementById('amount');

    // Handle class selection change
    classSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        const className = selectedOption.getAttribute('data-name');

        if (price && price !== '') {
            amountInput.value = price;
            // Auto-fill customer name with class name if empty
            const customerNameInput = document.getElementById('customer_name');
            if (customerNameInput.value === '') {
                customerNameInput.value = 'Test User - ' + className;
            }
        }
    });

    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        statusEl.textContent = 'Membuat transaksi...';
        statusEl.classList.remove('text-red-500');
        statusEl.classList.add('text-gray-500');
        resultWrapper.classList.add('hidden');

        const formData = new FormData(form);
        const payload = new URLSearchParams();

        // Add class_id from selected class if any
        const selectedClassId = classSelect.value;
        if (selectedClassId) {
            payload.append('class_id', selectedClassId);
        }

        for (const [key, value] of formData.entries()) {
            if (value.trim() !== '') {
                payload.append(key, value);
            }
        }

        // Add CSRF token
        payload.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');

        try {
            const response = await fetch('<?php echo base_url('admin/midtrans/create_transaction'); ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: payload.toString(),
            });

            const data = await response.json();

            if (!response.ok) {
                const message = data.error || 'Gagal membuat transaksi.';
                statusEl.textContent = message;
                statusEl.classList.remove('text-gray-500');
                statusEl.classList.add('text-red-500');
                return;
            }

            statusEl.textContent = 'Token diterima. Membuka Snap...';
            statusEl.classList.remove('text-red-500');
            statusEl.classList.add('text-green-600');

            resultJson.textContent = JSON.stringify(data, null, 2);
            resultWrapper.classList.remove('hidden');

            if (window.snap && data.token) {
                window.snap.pay(data.token, {
                    onSuccess: function(result) {
                        alert('Pembayaran berhasil!');
                        console.log('Success result:', result);
                        // Redirect to success page
                        window.open('<?php echo base_url('midtrans_public/success'); ?>?order_id=' + result.order_id, '_blank');
                    },
                    onPending: function(result) {
                        alert('Pembayaran pending.');
                        console.log('Pending result:', result);
                    },
                    onError: function(result) {
                        alert('Terjadi kesalahan pada pembayaran.');
                        console.error('Error result:', result);
                    },
                    onClose: function() {
                        console.log('Snap modal closed');
                        // Refresh page to see updated transaction
                        window.location.reload();
                    }
                });
            } else {
                statusEl.textContent = 'Token diterima, namun Snap JS belum siap.';
                statusEl.classList.remove('text-green-600');
                statusEl.classList.add('text-red-500');
            }
        } catch (error) {
            console.error(error);
            statusEl.textContent = 'Terjadi kesalahan saat menghubungi server.';
            statusEl.classList.remove('text-gray-500');
            statusEl.classList.add('text-red-500');
        }
    });
})();
</script>
