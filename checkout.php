<?php 
require 'functions.php';
session_start();
if(!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('anda belum login!');</script>";
    echo "<script>location='login.php';</script>";
}

if(!isset($_SESSION["keranjang"])) {
    echo "<script>alert('keranjang masih kosong');</script>";
    echo "<script>location='index.php';</script>";
}


$ongkir_tarif = query("SELECT * FROM tb_ongkir");


$total_belanja = 0;
$total_kabeh = 0;




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link class="icon-tab" rel="icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Checkout</title>
</head>

<body>
    <!-- pindahkan menjadi file tersendiri -->
    <div class="modal-alamat-container">
        <div class="form-alamat">
            <h3>The Desperate Project</h3>

            <form method="post" action="">
                <input type="hidden" name="id_cust_hidden" value="<?= $_SESSION["pelanggan"]["id"];?>">

                <div class="form-group">
                    <label for="exampleInputEmail1">username</label>
                    <input type="email" class="form-control rounded-0" id="exampleInputEmail1"
                        aria-describedby="emailHelp" value="ujang kobra" disabled>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nama</label>
                    <input type="text" class="form-control rounded-0" id="exampleInputPassword1"
                        placeholder="Nama Pemesan">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Alamat</label>
                    <input type="text" class="form-control rounded-0" id="exampleInputPassword1"
                        placeholder="Jl. Pahlawan No.123">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">No Telephone</label>
                    <input type="text" class="form-control rounded-0" id="exampleInputPassword1"
                        placeholder="0812 xxxx xxxx" value="<?= $_SESSION['pelanggan']['no_telpon']; ?>">
                </div>
                <div class="form-group">
                    <label>Ongkos Kirim</label>
                    <select class="form-control rounded-0" aria-label="Default select example" name="id_ongkir">
                        <option selected>Pilih Ongkir</option>
                        <?php foreach($ongkir_tarif as $tarif): ?>
                        <option value="<?= $tarif["id"];?>"><?= $tarif["nama_kota"]; ?> -
                            Rp.<?= number_format($tarif["tarif"]);?></option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <button type="submit" class="btn btn-dark rounded-0 mt-2" name="proses_pesanan">Proses Pesanan</button>
            </form>
        </div>

        <div class="info-byr">
            <div class="info-byr-box">
                <p class="cek-judul">INFO PEMBAYARAN</p>

                <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) : ?>
                <?php 
                   
                   $query = "SELECT * FROM katalog_depan WHERE id=$id_produk";
                   $db = query($query);     
                ?>
                <?php foreach($db as $bd):  ?>
                <?php $harga_produk = $bd["harga"]*$jumlah; ?>
                <div class="checkout-fnl">
                    <div class="checkout-produk-name">
                        <p><?= $bd["nama"]; ?> x <?= $jumlah; ?></p>
                    </div>
                    <div class="checkout-produk-harga">
                        <p>RP. <?= number_format($harga_produk); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php $total_belanja += $harga_produk; ?>
                <?php endforeach; ?>
                <div class="checkout-fnl">
                    <div class="checkout-produk-name">
                        <p>Berat Produk Total</p>
                    </div>
                    <div class="checkout-produk-harga">
                        <p>1Kg</p>
                    </div>
                </div>


                <div class="checkout-fnl">
                    <div class="checkout-produk-name">
                        <p>subtotal</p>
                    </div>

                    <div class="checkout-produk-harga">
                        <p><span>Rp. <?= number_format($total_belanja); ?></span></p>
                    </div>
                </div>

                <div class="metod-byr">
                    <p>Lakukan pembayaran Anda langsung ke rekening bank kami. Harap gunakan ID Pesanan Anda sebagai
                        referensi pembayaran. Pesanan Anda tidak akan dikirim sampai dana masuk ke akun kami.</p>
                    <div class="img-bca">
                        <img src="img/bca-logo.png" alt="">
                    </div>
                    <div class="acc-bca">
                        <p>Account Name :
                            <span>Wadidaw waWwWw<span></p>
                    </div>
                    <div class="acc-bca">
                        <p>NO Rekening :
                            <span>09218124xxx<span></p>
                    </div>
                </div>
                <div class="regulasi">
                    <p>Data pribadi Anda akan digunakan untuk memproses pesanan Anda, mendukung pengalaman Anda di
                        seluruh situs web ini, dan untuk tujuan lain yang dijelaskan dalam kebijakan privasi.</p>
                    <div class="regulasi-cek">
                        <p><input type="checkbox"> Saya telah membaca dan menyetujui syarat dan ketentuan *</p>
                    </div>

                </div>

                <button>Proses Pesanan</button>
            </div>
        </div>
    </div>
    <!-- end modal container -->

    <!-- proses pesanan -->
    <?php
        if(isset($_POST["proses_pesanan"])) {
            $ongkir = $_POST["id_ongkir"];
            $id_cust = $_POST["id_cust_hidden"];
            $tgl_transaksi = date("Y-m-d");

            $ongkir_db = query("SELECT * FROM tb_ongkir WHERE id = '$ongkir'")[0];
            
            $total_kabeh = $total_belanja += $ongkir_db["tarif"];
            $ongkir_db["tarif"];

            mysqli_query($koneksi,"INSERT INTO tb_transaksi(id_cust,id_ongkir,total,tanggal) 
            VALUES ('$id_cust',
                    '$ongkir',
                    '$total_kabeh',
                    '$tgl_transaksi')"
                    );
        
            $id_transaksi_in = $koneksi->insert_id;

            foreach($_SESSION["keranjang"] as $id_produk => $jumlah) {
            mysqli_query($koneksi,"INSERT INTO tb_pembelian(id_transaksi,id_produk,jumlah)
            VALUES('$id_transaksi_in',
                    '$id_produk',
                    '$jumlah')
                    ");
                }
                unset($_SESSION["keranjang"]);
                echo "<script>alert('pembelian berhasil')</script>";
            echo "<script>location='nota-pembelian.php?id=$id_transaksi_in';</script>";
        }
           
     ?>
        <!-- belum ada notif checkout sukses dan pindah halaman ke nota -->

    <!-- proses pesanan end -->
    <pre>
<?php 

print_r($_SESSION["pelanggan"]);
print_r($_SESSION["keranjang"]);
echo $_SESSION["pelanggan"]["nama"];
echo $total_kabeh;
?>
</pre>
</body>

</html>