<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gaming.consign| list orders</title>
    <link rel="stylesheet" href="<?= base_url('css/orders.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">

</head>
<body>
<?= $this->include('layouts/navbar') ?>

    <div class="orders-container">
        <h1>Daftar Pesanan</h1>

        <?php if (!empty($orders)): ?>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Nomor Order</th>
                        <th>Tanggal Order</th>
                        <th>Total Harga</th>
                        <th>Status Order</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><a href="/order-detail/<?= $order['id']; ?>"><?= esc($order['invoice']); ?></a></td>
                            <td><?= date('Y-m-d', strtotime($order['date'])); ?></td>
                            <td>Rp. <?= number_format($order['total'], 0, ',', '.'); ?></td>
                            <td class="status <?= strtolower($order['status']); ?>"><?= esc($order['status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada pesanan yang ditemukan.</p>
        <?php endif; ?>
    </div>

</body>
</html>
