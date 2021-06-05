<?php 

require 'fungsiadmin.php';

$id = $_GET["id"];
$kategori = $_GET['produk'];

$kategori_lower = strtolower($kategori);


if(hapus($id,$kategori) > 0) {
    echo "
    <script>
        alert('data berhasil dihapus');
        document.location.href = 'admin-aksi.php?sortBy=$kategori_lower';
    </script>";
}else {
    echo "
    <script>
        alert('data gagal dihapus');
        document.location.href = 'admin-aksi.php?sortBy=$kategori_lower';
    </script>";
}

?>