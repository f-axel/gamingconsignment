<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jual.in | User Product Form</title>
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/user-product-form.css') ?>">
</head>
<body class="page-product-form">
    <?= $this->include('layouts/navbar') ?>

    <header class="form-header">
        <h1 class="form-title"><?= isset($product) ? 'Edit Produk' : 'Tambah Produk' ?></h1>
    </header>

    <form action="<?= base_url('products/save') ?>" method="post" enctype="multipart/form-data" class="product-form">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= isset($product) ? $product['id'] : '' ?>">

        <div class="form-group">
            <label for="category" class="form-label">Kategori</label>
            <select name="category" id="category" class="form-input" required>
                <option value="">Pilih Kategori</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" 
                        <?= isset($product) && $product['id_category'] == $category['id'] ? 'selected' : '' ?>>
                        <?= $category['title'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="productName" class="form-label">Nama Produk</label>
            <input type="text" name="productName" id="productName" 
                class="form-input" value="<?= isset($product) ? $product['title'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" id="slug" 
                class="form-input" value="<?= isset($product) ? $product['slug'] : '' ?>" readonly required>
        </div>

        <div class="form-group">
            <label for="desc" class="form-label">Deskripsi</label>
            <textarea name="desc" id="desc" class="form-input" required><?= isset($product) ? $product['desc'] : '' ?></textarea>
        </div>

        <div class="form-group">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" id="price" 
                class="form-input" value="<?= isset($product) ? $product['price'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="stock" class="form-label">Status Stok</label>
            <select name="stock" id="stock" class="form-input">
                <option value="available" <?= isset($product) && $product['is_available'] ? 'selected' : '' ?>>Tersedia</option>
                <option value="unavailable" <?= isset($product) && !$product['is_available'] ? 'selected' : '' ?>>Habis</option>
            </select>
        </div>

        <div class="form-group">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" name="image" id="image" class="form-input">
            <?php if (isset($product) && $product['image']): ?>
                <img src="/uploads/<?= $product['image'] ?>" alt="Gambar Produk" class="product-image">
                <input type="hidden" name="current_image" value="<?= $product['image'] ?>">
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Simpan</button>
            <a href="/products" class="btn-back">Kembali</a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            generateSlug('productName', 'slug');
        });
    </script>
    <script src="/js/textToSlug.js"></script>
</body>
</html>
