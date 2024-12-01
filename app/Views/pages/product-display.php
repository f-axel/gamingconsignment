<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($product['title']) ?> - gaming.consign</title>
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/product-display.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?= $this->include('layouts/navbar') ?>
    
    <div class="product-page">
        <div class="product-container">
            <!-- Gambar Produk -->
            <div class="product-image">
                <img src="/uploads/<?= esc($product['image']) ?>" alt="<?= esc($product['title']) ?>" class="product-img">
            </div>

            <!-- Data Produk -->
             
            <div class="product-info">
                <h1 class="product-title"><?= esc($product['title']) ?></h1>
                <p class="product-price">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
            <form method="post" action="<?= base_url('cart/add'); ?>" class="add-to-cart-form">
                <input type="hidden" name="id_product" value="<?= $product['id']; ?>">

                <div class="qty-container">
                    <button type="button" class="qty-btn minus" onclick="changeQuantity(-1)">-</button>
                    <input type="number" name="qty" class="qty-input" value="1" min="1">
                    <button type="button" class="qty-btn plus" onclick="changeQuantity(1)">+</button>
                </div>
                
                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
            </form>
                <div class="product-extra-info">
                    <p class="product-desc"><?= esc($product['desc']) ?></p>
                    <p class="product-seller">Dijual oleh <?= esc($product['user_name']) ?></p>
                </div>
            </div>

        </div>

        <a href="/" class="back-home-link">Kembali ke Home</a>

        <h2>Komentar</h2>

        <div class="comments-container">
            <?php if (!empty($comments)): ?>
                <div class="comments-list">
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment-item">
                            <p><strong><?= esc($comment['user_name']); ?></strong>: <?= esc($comment['comment']); ?></p>
                            <small><?= date('d M Y H:i', strtotime($comment['created_at'])); ?></small>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Belum ada komentar.</p>
            <?php endif; ?>

            <?php if ($isPurchased): ?>
                <h3>Tambahkan Komentar</h3>
                <form method="post" action="<?= base_url('products/addComment'); ?>" class="comment-form">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_product" value="<?= $product['id']; ?>">
                    <textarea name="comment" rows="3" class="comment-input" required></textarea>
                    <button type="submit" class="comment-btn">Kirim</button>
                </form>
            <?php else: ?>
                <p>Anda harus membeli produk ini untuk memberikan komentar.</p>
            <?php endif; ?>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        <?php if (session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= session('success'); ?>',
                confirmButtonText: 'OK',
            });
        <?php elseif (session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?= session('error'); ?>',
                confirmButtonText: 'Coba Lagi',
            });
        <?php endif; ?>
    });
    </script>
    <script>
        function changeQuantity(amount) {
    const input = document.querySelector('.qty-input');
    let value = parseInt(input.value);

    if (!isNaN(value)) {
        value += amount;
        if (value < 1) value = 1; // Minimum value is 1
        input.value = value;
    }
}
    </script>
    <script src="js/index.js"></script> 
</body>
</html>
