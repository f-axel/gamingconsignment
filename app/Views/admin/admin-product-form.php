<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gaming.consign| <?= isset($product['id']) ? 'edit produk' : 'create produk' ?></title>
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/admin-p-form.css') ?>">
</head>
<body>
<?= $this->include('layouts/navbar') ?>

<div class="container">
    <h2><?= isset($product['id']) ? 'Edit Produk' : 'Create Produk' ?></h2>

    <form action="/admin/save-product" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <!-- Field untuk menangani id jika sedang dalam mode edit -->
        <input type="hidden" name="id" value="<?= $product['id'] ?? '' ?>">
        <!-- Field untuk menyimpan gambar saat ini jika dalam mode edit -->
        <input type="hidden" name="current_image" value="<?= $product['image'] ?? '' ?>">

        <div class="form-group">
            <label for="productName">Nama Produk</label>
            <input type="text" id="productName" name="productName" value="<?= $product['title'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label for="category">Kategori</label>
            <select id="category" name="category" required>
                <option value="">Pilih Kategori</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= isset($product['id_category']) && $product['id_category'] == $category['id'] ? 'selected' : '' ?>>
                        <?= $category['title'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" id="price" name="price" value="<?= $product['price'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <select id="stock" name="stock" required>
                <option value="available" <?= isset($product['is_available']) && $product['is_available'] ? 'selected' : '' ?>>Tersedia</option>
                <option value="out_of_stock" <?= isset($product['is_available']) && !$product['is_available'] ? 'selected' : '' ?>>Kosong</option>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Gambar Produk</label>
            <input type="file" id="image" name="image" accept="image/*">
            <?php if (!empty($product['image'])): ?>
                <p>Gambar saat ini: <img src="/uploads/<?= $product['image'] ?>" width="100"></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" id="slug" name="slug" value="<?= $product['slug'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <button type="submit" class="save-btn"><?= isset($product['id']) ? 'Update' : 'Create' ?> Produk</button>
        </div>
    </form>
</div>
<script src="/js/textToSlug.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        generateSlug('productName', 'slug');
    });
</script>
</body>
</html>
