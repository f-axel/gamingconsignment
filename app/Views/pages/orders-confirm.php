<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gaming.consign | confirm payment</title>
    <link rel="stylesheet" href="<?= base_url('css/ordersconfirm.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">


</head>
<body>
<?= $this->include('layouts/navbar') ?>

    <div class="order-confirm-container">
        <h1>Konfirmasi Pembayaran</h1>

        <!-- Order Info -->
        <div class="order-info">
            <div>Rekening Tujuan: 14045 a.n Donald Trump</div>
            <div>Nomor Order: <span><?= esc($order['invoice']) ?></span></div>
            <div>Status Order: <span class="status waiting">Waiting</span></div>
            <div>ID Order: <span><?= esc($order['id']) ?></span></div>
        </div>

        <!-- Payment Confirmation Form -->
        <form action="/order-confirm/<?= esc($order['id']) ?>" method="POST" enctype="multipart/form-data" class="confirm-form">
            <?= csrf_field() ?>
            <div>
                <label for="account_name">Dari Rekening a/n</label>
                <input type="text" id="account_name" name="account_name" required>
            </div>
            <div>
                <label for="amount">Sebesar</label>
                <input type="number" id="amount" name="amount" required>
            </div>
            <div>
                <label for="notes">Catatan</label>
                <textarea id="notes" name="notes"></textarea>
            </div>
            <div>
                <label for="proof_image">Upload Bukti Transfer</label>
                <input type="file" id="proof_image" name="proof_image" accept="image/*" required>
            </div>
            <div>
                <button type="submit" class="submit-btn">Submit Konfirmasi Pembayaran</button>
            </div>
        </form>

    </div>

</body>
</html>
