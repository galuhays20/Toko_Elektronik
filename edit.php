<?php
require_once 'Produk.php';
$produk = new Produk();
$id = $_GET['id'];
$data = $produk->getById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $harga = str_replace('.', '', $_POST['harga']);
    $produk->update($id, $_POST['nama'], $_POST['deskripsi'], $harga, $_POST['stok']);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Edit Produk</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" class="form-control" name="nama" value="<?= $data['nama_produk'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" required><?= $data['deskripsi'] ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="text" class="form-control" name="harga" value="<?= $data['harga'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" class="form-control" name="stok" value="<?= $data['stok'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
