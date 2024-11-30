<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jual.in | checkout</title>
    <link rel="stylesheet" href="<?= base_url('css/checkout.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">

</head>
<body>
<?= $this->include('layouts/navbar') ?>

<div class="checkout-container">
    <!-- Checkout Form -->
    <div class="checkout-form">
        <h2>Checkout</h2>
        <form action="<?= base_url('/checkout-confirm'); ?>" method="post">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" required placeholder="Masukkan nama lengkap">

            <label for="address">Alamat Pengiriman</label>
            <input type="text" id="address" name="address" required placeholder="Masukkan alamat pengiriman">

            <label for="phone">Nomor Telepon</label>
            <input type="tel" id="phone" name="phone" required placeholder="Masukkan nomor telepon" pattern="[0-9]{10,15}">

            <button type="submit">Lakukan Pembayaran</button>
        </form>
    </div>

    <!-- Cart Summary -->
    <div class="cart-summary">
        <h3>Rincian Belanja</h3>
        <div class="cart-header">
            <div>Produk</div>
            <div>Qty</div>
            <div>Subtotal</div>
        </div>

        <!-- Cart Items -->
        <?php if (!empty($cartItems)): ?>
            <?php foreach ($cartItems as $item): ?>
                <div class="cart-item">
                    <div><?= esc($item['product_name']); ?></div>
                    <div><?= esc($item['qty']); ?></div>
                    <div>Rp. <?= number_format($item['subtotal'], 0, ',', '.'); ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Keranjang Anda kosong.</p>
        <?php endif; ?>

        <!-- Total Price -->
        <div class="cart-item-total">
            Total: Rp. <?= number_format($total, 0, ',', '.'); ?>
        </div>
    </div>
</div>

</body>
</html>
