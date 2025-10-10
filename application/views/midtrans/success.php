<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - ASET Academy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .success-animation {
            animation: checkmark 0.8s ease-in-out;
        }

        @keyframes checkmark {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.2); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }

        .fade-in {
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 to-emerald-100 min-h-screen">
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-2xl mx-auto">
            <?php if(isset($error)): ?>
                <!-- Error State -->
                <div class="bg-white rounded-2xl shadow-2xl p-8 text-center fade-in">
                    <div class="w-20 h-20 mx-auto mb-6 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-3xl text-red-600"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">Pembayaran Tidak Ditemukan</h1>
                    <p class="text-gray-600 mb-6"><?php echo $error; ?></p>
                    <p class="text-sm text-gray-500">Order ID: <span class="font-mono bg-gray-100 px-2 py-1 rounded"><?php echo htmlspecialchars($order_id); ?></span></p>
                </div>
            <?php else: ?>
                <!-- Success State -->
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden fade-in">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-6 text-white">
                        <div class="flex items-center justify-center mb-4">
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center success-animation">
                                <i class="fas fa-check text-2xl"></i>
                            </div>
                        </div>
                        <h1 class="text-2xl font-bold text-center mb-2"><?php echo $title; ?></h1>
                        <p class="text-center text-green-100"><?php echo $status_message; ?></p>
                    </div>

                    <!-- Content -->
                    <div class="px-8 py-8">
                        <!-- Transaction Details -->
                        <div class="bg-gray-50 rounded-xl p-6 mb-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-receipt text-green-600 mr-2"></i>
                                Detail Transaksi
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Order ID</p>
                                    <p class="font-mono text-sm bg-white px-3 py-2 rounded border"><?php echo htmlspecialchars($transaction->order_id); ?></p>
                                </div>

                                <?php if($transaction->transaction_id): ?>
                                <div>
                                    <p class="text-sm text-gray-600">Transaction ID</p>
                                    <p class="font-mono text-sm bg-white px-3 py-2 rounded border"><?php echo htmlspecialchars($transaction->transaction_id); ?></p>
                                </div>
                                <?php endif; ?>

                                <div>
                                    <p class="text-sm text-gray-600">Jumlah Pembayaran</p>
                                    <p class="text-lg font-bold text-green-600">Rp <?php echo number_format($transaction->gross_amount, 0, ',', '.'); ?></p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-600">Metode Pembayaran</p>
                                    <p class="text-sm font-medium"><?php echo htmlspecialchars($transaction->payment_type ?? 'Tidak tersedia'); ?></p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-600">Status</p>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        <?php
                                        switch($transaction->transaction_status) {
                                            case 'settlement':
                                            case 'capture':
                                                echo 'bg-green-100 text-green-800';
                                                break;
                                            case 'pending':
                                                echo 'bg-yellow-100 text-yellow-800';
                                                break;
                                            case 'deny':
                                            case 'cancel':
                                            case 'expire':
                                            case 'failure':
                                                echo 'bg-red-100 text-red-800';
                                                break;
                                            default:
                                                echo 'bg-gray-100 text-gray-800';
                                        }
                                        ?>">
                                        <i class="fas fa-circle text-xs mr-1"></i>
                                        <?php echo ucfirst($transaction->transaction_status); ?>
                                    </span>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-600">Tanggal Transaksi</p>
                                    <p class="text-sm"><?php echo date('d M Y H:i', strtotime($transaction->created_at)); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Details -->
                        <?php if($transaction->customer_details): ?>
                        <?php $customer = json_decode($transaction->customer_details, true); ?>
                        <div class="bg-blue-50 rounded-xl p-6 mb-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-user text-blue-600 mr-2"></i>
                                Informasi Pelanggan
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <?php if(isset($customer['first_name'])): ?>
                                <div>
                                    <p class="text-sm text-gray-600">Nama</p>
                                    <p class="font-medium"><?php echo htmlspecialchars($customer['first_name']); ?></p>
                                </div>
                                <?php endif; ?>

                                <?php if(isset($customer['email'])): ?>
                                <div>
                                    <p class="text-sm text-gray-600">Email</p>
                                    <p class="text-sm"><?php echo htmlspecialchars($customer['email']); ?></p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="<?php echo base_url(); ?>" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-home mr-2"></i>
                                Kembali ke Beranda
                            </a>

                            <?php if($transaction->user_id): ?>
                            <a href="<?php echo base_url('student/dashboard'); ?>" class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Dashboard Siswa
                            </a>
                            <?php endif; ?>

                            <button onclick="window.print()" class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors">
                                <i class="fas fa-print mr-2"></i>
                                Cetak Bukti
                            </button>
                        </div>

                        <!-- Additional Info -->
                        <div class="mt-8 text-center">
                            <p class="text-sm text-gray-500 mb-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Bukti pembayaran ini telah disimpan dalam sistem kami
                            </p>
                            <p class="text-xs text-gray-400">
                                Jika ada pertanyaan, silakan hubungi customer service kami
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Auto refresh untuk status pending
        <?php if(isset($transaction) && in_array($transaction->transaction_status, ['pending'])): ?>
        setTimeout(function() {
            window.location.reload();
        }, 10000); // Refresh setiap 10 detik untuk status pending
        <?php endif; ?>

        // Print functionality
        function printReceipt() {
            window.print();
        }
    </script>
</body>
</html>
