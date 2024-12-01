<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('css/navbar.css') ?>">
<nav class="navbar-utama">
<a class="navbar-logo" href="/">
    <img src="/uploads/logo.png" alt="Home" style="height: 50px;">
</a>
<div class="navbar-isi">
    <ul class="navbar-buttons">
        <?php if (session()->get('user')): ?>
            <li class="navbar-item"><a class="nav-link" href="/cart">Cart</a></li>
            <li class="navbar-item"><a class="nav-link" href="/orders">Orders</a></li>
            <li class="navbar-item"><a class="nav-link" href="/profile">Profile</a></li>
        <?php else: ?>
            <li class="navbar-item"><a class="nav-link" href="/login">Login</a></li>
            <li class="navbar-item"><a class="nav-link" href="/register">Register</a></li>
        <?php endif; ?>

        <!-- Dropdown untuk Admin -->
        <?php if (session()->get('role') == 'admin'): ?>
            <li class="navbar-item admin-dropdown">
                <a class="admin-btn">Admin</a>
                <div class="dropdown-content">
                    <a href="/admin/panel">Panel</a>
                    <a href="/admin/orders">Orders</a>
                    <a href="/logout">Logout</a>
                </div>
            </li>
        <!-- Dropdown untuk User -->
        <?php elseif (session()->get('role') == 'member'): ?>
            <li class="navbar-item admin-dropdown">
                <a class="admin-btn">Hai, <?= session()->get('name') ?></a>
                <div class="dropdown-content">
                    <a href="/products">Products</a>
                    <a href="/products/sales">Sales</a>
                    <a href="/logout">Logout</a>
                </div>
            </li>
        <?php endif; ?>
    </ul>
</div>

</nav>