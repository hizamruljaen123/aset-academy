<div class="bg-gray-100 py-12">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-8">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Midtrans Payment Testing</h1>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <p class="text-sm text-blue-800">
                Halaman ini digunakan untuk menguji integrasi Midtrans Snap menggunakan kredensial sandbox.
                Jangan gunakan data pribadi atau pembayaran nyata ketika berada di mode sandbox.
            </p>
        </div>

        <form id="midtrans-test-form" class="space-y-5">
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
            </div>

            <div class="flex items-center space-x-3">
                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Buat Transaksi &amp; Buka Snap
                </button>
                <span id="midtrans-status" class="text-sm text-gray-500"></span>
            </div>
        </form>

        <div id="midtrans-result" class="mt-6 hidden">
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Hasil Transaksi</h2>
            <pre class="bg-gray-900 text-green-200 rounded-lg p-4 overflow-auto text-xs"></pre>
        </div>
    </div>
</div>

<script src="<?= $snap_js_url ?>" data-client-key="<?= $client_key ?>"></script>
<script>
(function() {
    const form = document.getElementById('midtrans-test-form');
    const statusEl = document.getElementById('midtrans-status');
    const resultWrapper = document.getElementById('midtrans-result');
    const resultPre = resultWrapper.querySelector('pre');

    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        statusEl.textContent = 'Membuat transaksi...';
        statusEl.classList.remove('text-red-500');
        statusEl.classList.add('text-gray-500');
        resultWrapper.classList.add('hidden');

        const formData = new FormData(form);
        const payload = new URLSearchParams();
        for (const [key, value] of formData.entries()) {
            payload.append(key, value);
        }

        try {
            const response = await fetch('<?= site_url('midtrans_test/create_transaction') ?>', {
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

            resultPre.textContent = JSON.stringify(data, null, 2);
            resultWrapper.classList.remove('hidden');

            if (window.snap && data.token) {
                window.snap.pay(data.token, {
                    onSuccess: function(result) {
                        alert('Pembayaran berhasil!');
                        console.log('Success result:', result);
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
