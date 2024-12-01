<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gaming.consign | admin category form</title>
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/admin-c-form.css') ?>">
</head>
<body>
<?= $this->include('layouts/navbar') ?>

<div class="container">
    <h2><?= isset($category) ? 'Edit' : 'Create' ?> Kategori</h2>

    <form action="/admin/save-category" method="POST">
        <!-- CSRF Token -->
        <?= csrf_field() ?>

        <!-- Hidden ID (hanya muncul saat edit) -->
        <?php if (isset($category)): ?>
            <input type="hidden" name="id" value="<?= $category['id'] ?>">
        <?php endif; ?>

        <!-- Nama Kategori -->
        <div class="form-group">
            <label for="title">Nama Kategori</label>
            <input type="text" id="title" name="title" placeholder="Nama Kategori" 
                   value="<?= isset($category) ? esc($category['title']) : '' ?>" required>
        </div>

        <!-- Slug -->
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" id="slug" name="slug" placeholder="Slug" 
                   value="<?= isset($category) ? esc($category['slug']) : '' ?>" readonly required>
        </div>

        <!-- Tombol Simpan -->
        <div class="form-group">
            <button type="submit" class="save-btn"><?= isset($category) ? 'Update' : 'Create' ?></button>
        </div>
    </form>
</div>

<script src="/js/textToSlug.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        generateSlug('title', 'slug');
    });
</script>
</body>
</html>
