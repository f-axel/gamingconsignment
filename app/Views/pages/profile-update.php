<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gaming.consign | edit profile</title>
    <link rel="stylesheet" href="<?= base_url('css/profileupdate.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
</head>
<body>
<?= $this->include('layouts/navbar') ?>
    <h2>Edit Your Profile</h2>

    <form action="/profile-update" method="POST">
        <?= csrf_field() ?>

        <label for="name">Name</label>
        <input type="text" name="name" value="<?= esc($user['name']) ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?= esc($user['email']) ?>" required>

        <label for="password">Password (kosongkan jika tidak mau diubah)</label>
        <input type="password" name="password">

        <button type="submit">Save</button>
    </form>
</body>
</html>
