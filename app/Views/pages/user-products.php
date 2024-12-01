<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gaming.consign | list user products</title>
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/user-products.css') ?>">
</head>
<body class="page-user-products">
    <?= $this->include('layouts/navbar') ?>

    <header class="user-products-header">
        <h1 class="user-products-title">Produk Saya</h1>
        <a href="products/form" class="btn-add-product">Tambah Produk</a>
    </header>

    <?php if (session()->getFlashdata('success')): ?>
        <p class="flash-message flash-success"><?= session()->getFlashdata('success') ?></p>
    <?php elseif (session()->getFlashdata('error')): ?>
        <p class="flash-message flash-error"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <table class="products-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $index => $product): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td>
                            <img src="/uploads/<?= $product['image'] ?>" 
                                 alt="Gambar Produk" class="product-image" width="50">
                        </td>
                        <td><?= $product['title'] ?></td>
                        <td><?= $product['category_title'] ?></td>
                        <td>Rp <?= number_format($product['price'], 0, ',', '.') ?></td>
                        <td><?= $product['is_available'] ? 'Tersedia' : 'Habis' ?></td>
                        <td class="action-links">
                            <a href="products/form/<?= $product['id'] ?>" class="btn-edit">Edit</a>
                            <a href="products/delete/<?= $product['id'] ?>" 
                               class="btn-delete" 
                               onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="no-products">Tidak ada produk yang ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
