<?php
    session_start();

    $produk_delete = $_GET["cart"];
    unset($_SESSION["keranjang"][$produk_delete]);

    echo "<script>alert('produk sudah dihapus dari keranjang');</script>";
    echo "<script>location='cart.php';</script>";
?>