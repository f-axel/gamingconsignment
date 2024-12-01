<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gaming.consign | Profil</title>
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/profile.css') ?>">

</head>
<body>
<?= $this->include('layouts/navbar') ?>

    <div class="profile-container">
        <h1>Profil Saya</h1>

        <!-- Info Profil -->
        <div class="profile-info">
            <div>
                <div class="name"><?= esc($user['name']) ?></div>
                <div class="email"><?= esc($user['email']) ?></div>
            </div>
        </div>

        <!-- Tombol Edit Profil -->
        <a href="/profile-update">
            <button class="edit-btn">Edit Profil</button>
        </a>
    </div>

</body>
</html>
