<?php
require_once 'Produk.php';
$produk = new Produk();
$cari = $_GET['cari'] ?? null;
$data = $produk->getAll($cari);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Manajemen Produk Toko Elektronik</h2>
    <div class="row mb-3">
        <div class="col-auto">
            <a href="export_pdf.php" class="btn btn-danger btn-sm">Export PDF</a>
        </div>
        <div class="col-auto">
            <a href="tambah.php" class="btn btn-primary btn-sm">+ Tambah Produk</a>
        </div>
        <div class="col">
            <form method="GET" class="d-flex" role="search" style="max-width: 300px;">
                <input class="form-control form-control-sm me-2" type="search" name="cari" placeholder="Cari produk..." value="<?= htmlspecialchars($cari ?? '') ?>">
                <button class="btn btn-outline-primary btn-sm" type="submit">Cari</button>
            </form>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
<tr>
    <th>No</th><th>Nama Produk</th><th>Deskripsi</th><th>Harga</th><th>Stok</th><th>Tanggal Dibuat</th><th>Terakhir Diperbarui</th><th>Aksi</th>
</tr>
        </thead>
        <tbody>
        <?php 
        $no = 1; // Mulai nomor urut dari 1
        while ($row = $data->fetch_assoc()): 
        ?>
            <tr>
                <td><?= $no++ ?></td> <!-- nomor urut manual -->
                <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                <td>Rp<?= number_format($row['harga'], 2, ',', '.') ?></td>
                <td><?= $row['stok'] ?></td>
                <td><?= $row['tanggal_dibuat'] ?></td>
                <td><?= $row['tanggal_diperbarui'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>

    </table>
</div>
</body>
</html>