<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gaming.consign | Admin User Form</title>
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/admin-u-form.css') ?>">
</head>
<body>
<?= $this->include('layouts/navbar') ?>

<div class="container">
    <h2><?= isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna' ?></h2>

    <form action="/admin/save-user" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        
        <?php if (isset($user)): ?>
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <?php endif; ?>

        <!-- Nama -->
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" placeholder="Nama Pengguna" value="<?= isset($user) ? esc($user['name']) : '' ?>" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email Pengguna" value="<?= isset($user) ? esc($user['email']) : '' ?>" required>
        </div>

        <!-- Password (optional jika update) -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" <?= isset($user) ? '' : 'required' ?>>
            <?php if (isset($user)): ?>
                <small>Kosongkan jika tidak ingin mengganti password</small>
            <?php endif; ?>
        </div>

        <!-- Role -->
        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="admin" <?= isset($user) && $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="member" <?= isset($user) && $user['role'] == 'member' ? 'selected' : '' ?>>Member</option>
            </select>
        </div>

        <!-- Status -->
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="active" <?= isset($user) && $user['is_active'] ? 'selected' : '' ?>>Aktif</option>
                <option value="inactive" <?= isset($user) && !$user['is_active'] ? 'selected' : '' ?>>Tidak Aktif</option>
            </select>
        </div>

        <!-- Tombol Simpan -->
        <div class="form-group">
            <button type="submit" class="save-btn"><?= isset($user) ? 'Update' : 'Simpan' ?></button>
        </div>
    </form>
</div>

</body>
</html>
