<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gaming.consign | shopping cart</title>
    <link rel="stylesheet" href="<?= base_url('css/cart.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">

</head>
<body>
<?= $this->include('layouts/navbar') ?>
<div class="cart-container">
    <h1>Shopping Cart</h1>

    <!-- Cart Header -->
    <div class="cart-header">
        <div>Gambar</div>
        <div>Produk</div>
        <div>Harga</div>
        <div>Jumlah</div>
        <div>Subtotal</div>
        <div>Aksi</div> <!-- Tambahkan kolom baru -->
    </div>

    <!-- Cart Items -->
    <?php if (!empty($cartItems)): ?>
        <?php foreach ($cartItems as $item): ?>
            <div class="cart-item">
                <img src="<?= base_url('uploads/' . $item['product_image']); ?>" alt="<?= $item['product_name']; ?>">
                <div class="cart-item-details">
                    <div class="cart-item-name"><?= $item['product_name']; ?></div>
                </div>
                <div class="cart-item-price">Rp. <?= number_format($item['product_price'], 0, ',', '.'); ?></div>
                <form method="post" action="<?= base_url('cart/update/' . $item['id']); ?>">
                    <input type="number" name="qty" class="cart-item-quantity" value="<?= $item['qty']; ?>" min="1" required>
                    <button type="submit">Update</button>
                </form>
                <div class="cart-item-subtotal">Rp. <?= number_format($item['subtotal'], 0, ',', '.'); ?></div>
                <div class="cart-item-actions"> <!-- Kolom baru -->
                    <form method="post" action="<?= base_url('cart/remove/' . $item['id']); ?>">
                        <button class="remove-item">Hapus</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Keranjang Anda kosong.</p>
    <?php endif; ?>

    <!-- Total Price -->
    <div class="cart-total">
        Total: Rp. <?= number_format($total, 0, ',', '.'); ?>
    </div>

    <!-- Buttons -->
    <div class="cart-buttons">
        <a href="/"><button class="continue-shopping">Kembali Berbelanja</button></a>
        <a href="/checkout"><button class="checkout">Lakukan Pembayaran</button></a>
    </div>
</div>

</body>
</html>
