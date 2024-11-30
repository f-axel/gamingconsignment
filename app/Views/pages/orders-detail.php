<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jual.in | order detail</title>
    <link rel="stylesheet" href="<?= base_url('css/ordersdetail.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">

</head>
<body>
<?= $this->include('layouts/navbar') ?>

    <div class="order-detail-container">
        <h1>Detail Pesanan</h1>

        <!-- Order Info -->
        <div class="order-info">
            <div>Nomor Order: <?= esc($order['invoice']) ?></div>
            <div>Status Order: 
                <span class="status <?= strtolower(esc($order['status'])) ?>">
                    <?= esc($order['status']) ?>
                </span>
            </div>
            <div>Nama Pembeli: <?= esc($order['name']) ?></div>
            <div>Nomor Telepon: <?= esc($order['phone']) ?></div>
            <div>Alamat Pengiriman: <?= esc($order['address']) ?></div>
        </div>

        <!-- Products List -->
        <table class="order-products">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderDetails as $detail): ?>
                    <tr>
                        <td><?= esc($detail['product_name']) ?></td>
                        <td>Rp. <?= number_format($detail['product_price'], 0, ',', '.') ?></td>
                        <td><?= esc($detail['qty']) ?></td>
                        <td>Rp. <?= number_format($detail['subtotal'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Total Price -->
        <div class="order-total">
            Total Harga: Rp. <?= number_format($order['total'], 0, ',', '.') ?>
        </div>

        <!-- Buttons -->
        <div class="order-buttons">
            <a href="/orders" class="btn">Kembali ke Daftar Pesanan</a>
            <?php if (strtolower($order['status']) === 'waiting'): ?>
                <button class="btn">
                    <a href="/order-confirm/<?= esc($order['id']) ?>">Konfirmasi Pembayaran</a>
                </button>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
