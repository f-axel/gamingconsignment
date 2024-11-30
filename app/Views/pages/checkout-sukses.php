<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jual.in | checkout sukses</title>
    <link rel="stylesheet" href="<?= base_url('css/checkoutsukses.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">

</head>
<body>
<?= $this->include('layouts/navbar') ?>

<div class="success-container">
    <h1>Checkout Sukses</h1>
    
    <div class="order-number">
        Nomor Order: <strong><?= esc($orderNumber); ?></strong>
    </div>

    <p>Terimakasih sudah berbelanja di jual.in! Pembayaran Anda telah diproses. Silakan ikuti instruksi berikut untuk melanjutkan pembayaran.</p>

    <div class="instructions">
        <p><strong>Instruksi Pembayaran:</strong></p>
        <ul>
            <li>1. Melakukan pembayaran ke rekening BCA dengan no. 14045 a/n Donald Trump</li>
            <li>2. Sertakan keterangan dengan nomor order: <strong><?= esc($orderNumber); ?></strong></li>
            <li>3. Total pembayaran: <strong>Rp. <?= number_format($total, 0, ',', '.'); ?></strong></li>
        </ul>
        <p>Jika sudah, kirim bukti pembayaran di halaman konfirmasi pembayaran atau <a href="/order-confirm/<?= esc($id_order) ?>">klik disini!</a></p>
    </div>

    <button onclick="window.location.href='/'">Kembali ke Beranda</button>
</div>

</body>
</html>
