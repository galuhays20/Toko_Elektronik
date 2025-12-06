
<?php
require_once 'Database.php';

class Produk {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll($cari = null) {
        $query = "SELECT * FROM produk";
        if ($cari) {
            $cari = $this->conn->real_escape_string($cari);
            $query .= " WHERE nama_produk LIKE '%$cari%' OR deskripsi LIKE '%$cari%'";
        }
        $query .= " ORDER BY id ASC";
        return $this->conn->query($query);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM produk WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function tambah($nama, $deskripsi, $harga, $stok) {
        $stmt = $this->conn->prepare("INSERT INTO produk (nama_produk, deskripsi, harga, stok) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdi", $nama, $deskripsi, $harga, $stok);
        return $stmt->execute();
    }

    public function update($id, $nama, $deskripsi, $harga, $stok) {
        $stmt = $this->conn->prepare("UPDATE produk SET nama_produk=?, deskripsi=?, harga=?, stok=? WHERE id=?");
        $stmt->bind_param("ssdii", $nama, $deskripsi, $harga, $stok, $id);
        return $stmt->execute();
    }

    public function hapus($id) {
        $stmt = $this->conn->prepare("DELETE FROM produk WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
