<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - <?= $payment->invoice_number ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .company-info {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .invoice-details div {
            flex: 1;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }
        .invoice-table th, .invoice-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .invoice-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .total-section {
            text-align: right;
            margin-top: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .payment-info {
            margin-top: 30px;
            padding: 20px;
            background-color: #f0f8ff;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 12px;
        }
        @media print {
            body { background: white; }
            .invoice-container { box-shadow: none; }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <h1 style="color: #2563eb; margin: 0; font-size: 28px;">INVOICE</h1>
            <p style="margin: 5px 0; color: #666;">CV ASET MEDIA CEMERLANG</p>
        </div>

        <div class="company-info">
            <h2 style="margin: 0; color: #333;">ASET Academy</h2>
            <p style="margin: 5px 0; color: #666;">Jl. Contoh No. 123, Jakarta<br>
            Email: info@asetacademy.com | Telp: (021) 12345678</p>
        </div>

        <div class="invoice-details">
            <div>
                <h3 style="margin: 0 0 10px 0; color: #333;">Bill To:</h3>
                <p style="margin: 0; font-weight: bold;"><?= $user->nama_lengkap ?></p>
                <p style="margin: 5px 0; color: #666;"><?= $user->email ?></p>
            </div>
            <div style="text-align: right;">
                <h3 style="margin: 0 0 10px 0; color: #333;">Invoice Details:</h3>
                <p style="margin: 0;"><strong>Invoice #:</strong> <?= $payment->invoice_number ?></p>
                <p style="margin: 5px 0;"><strong>Date:</strong> <?= date('d F Y', strtotime($payment->invoice_generated_at)) ?></p>
                <p style="margin: 5px 0;"><strong>Status:</strong>
                    <span style="color: <?= $payment->status == 'Verified' ? '#22c55e' : ($payment->status == 'Rejected' ? '#ef4444' : '#f59e0b') ?>;">
                        <?= $payment->status == 'Verified' ? 'Paid' : ($payment->status == 'Rejected' ? 'Rejected' : 'Pending') ?>
                    </span>
                </p>
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong><?= $class->nama_kelas ?></strong><br>
                        <small style="color: #666;">Premium Programming Class</small>
                        <?php if (!empty($payment->payment_description)): ?>
                        <br><small style="color: #666;">Note: <?= $payment->payment_description ?></small>
                        <?php endif; ?>
                    </td>
                    <td>1</td>
                    <td>Rp <?= number_format($class->harga, 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($class->harga, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>

        <div class="total-section">
            <p style="margin: 0; font-size: 18px;"><strong>Total Amount: Rp <?= number_format($class->harga, 0, ',', '.') ?></strong></p>
        </div>

        <?php if ($payment->payment_method == 'Transfer' && $company_bank): ?>
        <div class="payment-info">
            <h3 style="margin: 0 0 15px 0; color: #2563eb;">Payment Information</h3>
            <p style="margin: 0;"><strong>Payment Method:</strong> Bank Transfer</p>
            <p style="margin: 5px 0;"><strong>Bank:</strong> <?= $company_bank->bank_name ?></p>
            <p style="margin: 5px 0;"><strong>Account Number:</strong> <?= $company_bank->account_number ?></p>
            <p style="margin: 5px 0;"><strong>Account Holder:</strong> <?= $company_bank->account_holder ?></p>
            <?php if (!empty($payment->user_bank_name)): ?>
            <p style="margin: 5px 0;"><strong>Sender Bank:</strong> <?= $payment->user_bank_name ?></p>
            <?php endif; ?>
            <?php if (!empty($payment->user_account_holder)): ?>
            <p style="margin: 5px 0;"><strong>Sender Name:</strong> <?= $payment->user_account_holder ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="footer">
            <p>Thank you for choosing ASET Academy!</p>
            <p>This invoice was generated on <?= date('d F Y H:i:s', strtotime($payment->invoice_generated_at)) ?></p>
        </div>
    </div>

    <script>
        // Auto print when loaded
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>