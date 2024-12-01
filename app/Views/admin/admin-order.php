<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gaming.consign | admin order menu</title>
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/admin-order.css') ?>">
</head>
<body>
<?= $this->include('layouts/navbar') ?>
<div class="container">
    <div class="header">
        <h2>Menu Order</h2>
    </div>

    <!-- Order Table -->
    <table>
        <thead>
            <tr>
                <th>Nomor Order</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders) && is_array($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><a href="/admin/order-details/<?= esc($order['id']); ?>"><?= esc($order['invoice']); ?></a></td>
                        <td><?= esc($order['date']); ?></td>
                        <td>Rp. <?= number_format($order['total'], 0, ',', '.'); ?></td>
                        <td class="status-<?= strtolower($order['status']); ?>"><?= esc(ucfirst($order['status'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Tidak ada data pesanan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
