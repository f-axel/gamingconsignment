<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jual.in | admin panel</title>
    <style>
        .admin-section {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/admin-NEL.css') ?>">
</head>
<body>
<?= $this->include('layouts/navbar') ?>

<!-- Admin Panel Layout -->
<div class="admin-panel-container">
    <h1>Admin Panel</h1>

    <!-- Menu Pilihan untuk memilih list yang ditampilkan -->
    <div class="admin-menu">
        <button class="menu-btn" onclick="showSection('category')">Category</button>
        <button class="menu-btn" onclick="showSection('user')">User</button>
        <button class="menu-btn" onclick="showSection('product')">Product</button>
    </div>

    <!-- Admin Category Section -->
    <div id="category" class="admin-section">
        <h2>Menu Category</h2>
        <button class="add-category-btn" onclick="location.href='/admin/category-form'">Tambah Category</button>

        <!-- Category Table -->
        <table>
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= esc($category['title']) ?></td>
                    <td><?= esc($category['slug']) ?></td>
                    <td>
                        <div class="action-buttons">
                            <button class="edit-btn" onclick="location.href='/admin/category-form/<?= esc($category['id']) ?>'">Edit</button>
                            <form action="/admin/category/delete/<?= esc($category['id']) ?>" method="post" style="display:inline;">
                                <button type="submit" class="delete-btn" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Admin Users Section -->
<div id="user" class="admin-section">
    <h2>Menu User</h2>
    <div class="toolbar">
        <button class="add-user-btn" onclick="location.href='/admin/users-form'">Tambah Pengguna</button>
    </div>

    <table class="user-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= esc($user['name']) ?></td>
                    <td><?= esc($user['email']) ?></td>
                    <td><?= esc($user['role']) ?></td>
                    <td><?= $user['is_active'] ? 'Active' : 'Inactive' ?></td>
                    <td class="actions">
                        <button class="edit-btn" onclick="location.href='/admin/users-form/<?= esc($user['id']) ?>'">Edit</button>
                        <form action="/admin/user/delete/<?= esc($user['id']) ?>" method="post" style="display:inline;">
                            <button type="submit" class="delete-btn" onclick="return confirm('Yakin ingin menghapus pengguna ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


    <!-- Admin Product Section -->
    <div id="product" class="admin-section">
        <h2>Menu Product</h2>
        <button class="add-product-btn" onclick="location.href='/admin/product-form'">Tambah Product</button>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Harga</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['title'] ?></td>
                    <td><?= $product['category_title'] ?></td>
                    <td>Rp. <?= number_format($product['price'], 0, ',', '.') ?></td>
                    <td><?= $product['is_available'] ? 'Available' : 'Out of Stock' ?></td>
                    <td>
                        <div class="action-buttons">
                            <button class="edit-btn" onclick="location.href='/admin/product-form/<?= $product['id'] ?>'">Edit</button>
                            <button class="delete-btn" onclick="if(confirm('Yakin ingin menghapus produk ini?')) location.href='/admin/product/delete/<?= $product['id'] ?>'">Delete</button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function showSection(sectionId) {
        // Hide all sections
        document.querySelectorAll('.admin-section').forEach(section => {
            section.style.display = 'none';
        });

        // Show the selected section
        document.getElementById(sectionId).style.display = 'block';
    }
</script>

<script src="/js/panel.js"></script>
</body>
</html>
