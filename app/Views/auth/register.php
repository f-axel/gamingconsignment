<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jual.in | register</title>
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/register.css') ?>">
</head>
<body>
<?= $this->include('layouts/navbar') ?>
<div class="register-container">
    <h2>Register</h2>

    <form class= "register-form" action="/register" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Register</button>
    </form>

    <p>Sudah punya akun? Login <a href="/login">disini</a>!</p>
</div>
</body>
</html>
