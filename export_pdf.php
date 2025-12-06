<?php
require_once 'Database.php';       // ganti config.php
require_once 'Produk.php';         // class Produk
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$produk = new Produk();
$data = $produk->getAll();
$dompdf = new Dompdf();

$html = '<h3 style="text-align:center;">Data Produk Toko Elektronik</h3>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Tanggal Dibuat</th>
            <th>Diperbarui</th>
        </tr>
    </thead>
    <tbody>';

foreach ($data as $row) {
    $html .= '
    <tr>
        <td>' . $row['id'] . '</td>
        <td>' . htmlspecialchars($row['nama_produk']) . '</td>
        <td>' . htmlspecialchars($row['deskripsi']) . '</td>
        <td>Rp ' . number_format($row['harga'], 0, ',', '.') . '</td>
        <td>' . $row['stok'] . '</td>
        <td>' . $row['tanggal_dibuat'] . '</td>
        <td>' . $row['tanggal_diperbarui'] . '</td>
    </tr>';
}

$html .= '
    </tbody>
</table>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("data_produk.pdf", ["Attachment" => 0]);
