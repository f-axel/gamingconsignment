<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gaming.consign| login</title>
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
</head>
<body>
<?= $this->include('layouts/navbar') ?>
<div class="login-container">
    <h2>Login</h2>
    <form class="login-form" action="/login" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="checkbox" class="form-check-input" name="remember_me" id="remember_me">
        <label class="form-check-label" for="remember_me">Ingatkan saya / Remember me</label><br>

        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? Segera <a href="/register">daftar</a>!</p>
</div>
</body>
</html>
