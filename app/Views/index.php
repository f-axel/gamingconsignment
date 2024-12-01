<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gaming.consign | beranda</title>
    <link rel="stylesheet" href="<?= base_url('css/home.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?= $this->include('layouts/navbar') ?>
<div class="hero-text">
    <h1 id="animatedText"></h1>
</div>

<h2>Products</h2>

<!-- Filter dan opsi sort -->
<div class="filter-bar">
    <div class="filter-options">
        <!-- Menu pencarian -->
        <div class="search-section">
            <label for="searchProduct">Search produk</label>
            <input type="text" id="searchProduct" placeholder="Cari produk...">
        </div>
        
        <!-- Dropdown untuk memilih kategori -->
        <div class="category-select">
            <label for="filterCategory">Pilih Kategori: </label>
            <select id="filterCategory">
                <option value="all">Semua Kategori</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= esc($category['title']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Dropdown untuk sort berdasarkan harga -->
        <div class="sort-select">
            <label for="sortPrice">Urutkan berdasarkan harga: </label>
            <select id="sortPrice">
                <option value="asc">Termurah</option>
                <option value="desc">Termahal</option>
            </select>
        </div>
    </div>
</div>
<!-- Daftar Produk -->
<div class="container">
    <div class="product-list">
        <?php foreach ($products as $product): ?>
            <a href="<?= base_url('product/' . $product['category_slug'] . '/' . $product['slug']); ?>" class="product-item-link">
                <div class="product-item" data-price="<?= $product['price'] ?>" data-category="<?= $product['id_category'] ?>">
                    <img src="/uploads/<?= $product['image'] ?>" alt="<?= $product['title'] ?>" style="max-width: 100%; height: auto;">
                    <h3><?= $product['title'] ?></h3>
                    <p>dalam <?= $product['category_title'] ?></p>
                    <p><strong>Rp. <?= number_format($product['price'], 0, ',', '.') ?></strong></p>
                    <p>Status: <?= $product['is_available'] ? 'Tersedia' : 'Stok habis' ?></p>
                    <p>Dijual <strong><?= $product['user_name']?></strong></p>
                </div>
            </a>
        <?php endforeach; ?>
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

<button id="scrollToTopBtn" title="Back to top">↑</button>
<script src="js/index.js"></script> <!-- External JS file -->

</body>
</html>
