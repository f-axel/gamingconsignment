<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gaming.consign | penjualan saya</title>
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/sales.css') ?>">
</head>
<body class="page-sales">
<?= $this->include('layouts/navbar') ?>

    <header class="sales-header">
        <h1 class="sales-title">Barang yang Terjual</h1>
    </header>

    <main class="sales-content">
        <?php if (!empty($salesData)): ?>
            <div class="table-container">
                <table class="sales-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($salesData as $index => $data): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $data['title'] ?></td>
                                <td><?= $data['total_sold'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="no-sales-message">Belum ada barang yang terjual.</p>
        <?php endif; ?>
    </main>
</body>
</html>
