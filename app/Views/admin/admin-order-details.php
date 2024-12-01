<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gaming.consign| admin order detail menu</title>
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/admin-order-detail.css') ?>">
</head>
<body>
<?= $this->include('layouts/navbar') ?>
<div class="container">
    <h2>Detail Order</h2>
    
    <!-- Order Information -->
    <div class="order-info">
        <p><strong>Nomor Order:</strong> <?= esc($order['invoice']); ?></p>
        <p><strong>Nama Pembeli:</strong> <?= esc($order['name']); ?></p>
        <p><strong>Alamat Pengiriman:</strong> <?= esc($order['address']); ?></p>
        <p><strong>Telepon:</strong> <?= esc($order['phone']); ?></p>
    </div>

    <!-- Product List -->
    <div class="product-list">
        <h3>Daftar Produk</h3>
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orderDetails) && is_array($orderDetails)): ?>
                    <?php foreach ($orderDetails as $detail): ?>
                        <tr>
                            <td><?= esc($detail['product_name']); // Anda bisa mengganti dengan nama produk jika ada relasi ?></td>
                            <td>Rp <?= number_format($detail['subtotal'] / $detail['qty'], 0, ',', '.'); ?></td>
                            <td><?= esc($detail['qty']); ?></td>
                            <td>Rp <?= number_format($detail['subtotal'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Tidak ada data produk.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="total-price">
            Total: Rp <?= number_format($order['total'], 0, ',', '.'); ?>
        </div>
    </div>

    <!-- Payment Information -->
    <?php if ($orderConfirm): ?>
    <div class="payment-info">
        <h3>Bukti Transfer</h3>
        <p><strong>Dari Rekening a/n:</strong> <?= esc($orderConfirm['account_name']); ?></p>
        <p><strong>Nomor Rekening:</strong> <?= esc($orderConfirm['account_number']); ?></p>
        <p><strong>Jumlah Transfer:</strong> Rp <?= number_format($orderConfirm['nominal'], 0, ',', '.'); ?></p>
        <p><strong>Catatan:</strong> <?= esc($orderConfirm['note']); ?></p>
        <div class="payment-proof">
            <p><strong>Foto Bukti Transfer:</strong></p>
            <img src="/uploads/<?= esc($orderConfirm['image']); ?>" alt="Bukti Transfer" style="max-width:300px;">
        </div>
    </div>
    <?php endif; ?>

    <!-- Order Status Update -->
    <div class="status-update">
        <h3>Update Status Order</h3>
        <form action="/admin/update-order-status/<?= $order['id']; ?>" method="post">
            <select name="order_status" id="order_status">
                <option value="waiting" <?= $order['status'] === 'waiting' ? 'selected' : ''; ?>>Waiting</option>
                <option value="paid" <?= $order['status'] === 'paid' ? 'selected' : ''; ?>>Paid</option>
                <option value="delivered" <?= $order['status'] === 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
            </select>
            <button type="submit" class="btn-save">Simpan</button>
        </form>
    </div>
</div>
</body>
</html>
