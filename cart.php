<?php
require 'functions.php';
session_start();

// if(!isset($_SESSION["keranjang"])) {
//     echo "keranjang masih kosong";
//     print_r($_SESSION);
// }else{
//     print_r($_SESSION);
// }
if(isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $ambil = mysqli_query($koneksi,"SELECT * FROM tb_cust WHERE email = '$email' AND password_cust='$password' ");

    $akunygcocok = mysqli_num_rows($ambil);

    if($akunygcocok==1){
        $akun=$ambil->fetch_assoc();
        $_SESSION["pelanggan"] = $akun;
        echo "<script>alert('anda login')</script>";
        
    }else{
        echo "<script>alert('anda gagal login')</script>";
        // echo "<script>location='login.php'</script>";
    }
}

if(!isset($_SESSION["keranjang"])) {
    $jumlah_cart = 0;
}else{
    $jumlah_cart = count($_SESSION["keranjang"]);
}



if(isset($_SESSION["pelanggan"])) {
    $id_pl = $_SESSION["pelanggan"]["id"];
  $z_tes = mysqli_query($koneksi,"SELECT * FROM tb_transaksi WHERE id_cust = $id_pl LIMIT 0,3");
  $cek2 = mysqli_num_rows($z_tes);
}

if(isset($_POST["signUp"])) {
    if(registrasi($_POST) > 0 ) {
        echo "<script>alert('akun sudah tersimpan. Silahkan Login!')</script>";
        echo "<script>location='login.php';</script>";
        
        
    }else {
        echo mysqli_error($koneksi);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link class="icon-tab" rel="icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="scss/baner-slide.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <title>cart</title>
    <style>
        .cart-empt {
            text-align: center;
        }

        #div-kosong {
            padding: 40px;
        }

        .div-empt {
            animation: shake 0.5s;
            animation-iteration-count: 5s;
        }

        #div-kosong p {
            font-size: 24px;
        }

        .hapus-cart {
            color: black;
        }


        @keyframes shake {
            0% {
                transform: translate(1px, 1px) rotate(0deg);
            }

            10% {
                transform: translate(-1px, -2px) rotate(-1deg);
            }

            20% {
                transform: translate(-3px, 0px) rotate(1deg);
            }

            30% {
                transform: translate(3px, 2px) rotate(0deg);
            }

            40% {
                transform: translate(1px, -1px) rotate(1deg);
            }

            50% {
                transform: translate(-1px, 2px) rotate(-1deg);
            }

            60% {
                transform: translate(-3px, 1px) rotate(0deg);
            }

            70% {
                transform: translate(3px, 1px) rotate(-1deg);
            }

            80% {
                transform: translate(-1px, -1px) rotate(1deg);
            }

            90% {
                transform: translate(1px, 2px) rotate(0deg);
            }

            100% {
                transform: translate(1px, -2px) rotate(-1deg);
            }
        }
    </style>
</head>

<body>
    <header>
        <nav id="nav-scrl">
            <img src="img/DESPERATE.png" alt="">
            <div id="nyumput">
                <div class="navlink-container">
                    <a href="index.php" class="nav-link">HOME</a>
                    <div class="dropdown">
                        <a href="#" class="nav-link">PRODUK</a>
                        <div class="dropdown-produk">
                            <div class="bungkus-menu">
                                <div class="menu-dropdown"><a href="hoodie.php">HOODIE</a> </div>
                                <div class="menu-dropdown"><a href="tshirt.php">T-Shirt</a> </div>
                                <div class="menu-dropdown"> <a href="hat.php">HAT</a></div>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="nav-link">ABOUT</a>
                    <a href="#" id="HTB" class="nav-link">HOW TO BUY</a>
                    <a href="#" class="nav-link">BLOG</a>
                </div>
            </div>
            <div class="container-burger1" id="satsat">
                <div class="sch-burger1-container">
                    <div class="sch-burger1">
                        <input type="text" class="sch-burger1-txt" name="" placeholder="Type To Search">
                        <a href="#" class="sch-waw"> <i class="fas fa-search"></i> </a>
                    </div>
                </div>
                <div class="sch-container">
                    <div class="sch-box">
                        <input type="text" class="sch-txt" name="" placeholder="Type To Search">
                        <a href="#" class="sch-waw-burger"> <i class="fas fa-search"></i> </a>
                    </div>
                </div>

                <div class="shop-container">
                    <div class="cart-shoping">
                        <a href="#" class="shop-cart">
                            <i class="fa fa-shopping-cart"></i>
                            <div id="jumlah-cart">
                                <p><?= $jumlah_cart;?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="login-container">
                    <div class="login">
                        <input type="checkbox" id="cek-popup" onclick="popLgn();">
                        <a href="#" class="login-icon"><i class="fas fa-user"></i> <span
                                class="tooltiptext">login</span></a>
                    </div>

                </div>
            </div>

            <div class="burger-icon-container">
                <div class="shoplogin-container" id="satsat2">
                    <div class="shop-container-mobile">
                        <div class="cart-shoping">
                            <a href="#" class="shop-cart"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                    <div class="login-container-mobile">
                        <div class="login">
                            <a href="#" class="login-icon"><i class="fas fa-user"></i> <span
                                    class="tooltiptext">login</span></a>
                        </div>
                    </div>
                </div>


                <div class="burger-icon">
                    <input type="checkbox" onclick="myFunction();">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            </div>
        </nav>
    </header>

    <div class="cart-container">
        <div class="cart-box">
            <!-- <table id="customers">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Produk Image</th>
                    <th>Produk Name</th>
                    <th>Size & Color</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                </thead>
                <?php  
                    $urutan = 1;
                    $total_belanja = 0;
                ?>
                <?php if(!isset($_SESSION["keranjang"]) || empty($_SESSION["keranjang"])) : ?>
                <?php $jv_empt = "kosong"; ?>
                <tr padding="4">
                    <td class="cart-empt" colspan="7">
                        <div id="div-kosong">
                            <p>KERANJANG MASIH KOSONG</p>
                        </div>
                    </td>
                </tr>
                <?php else: ?>
                <?php 
                        $jv_empt = "isi";
                        
                    ?>
                <?php foreach($_SESSION["keranjang"] as $id_produk => $jumlah) : ?>
                <?php 
                   $query = "SELECT * FROM katalog_depan WHERE id=$id_produk";
                   
                   $db = query($query);     
                ?>
                <?php foreach($db as $bd):  ?>
                <?php $harga_produk = $bd["harga"]*$jumlah; ?>
                <tr>
                    <td><?= $urutan; ?></td>
                    <td><img src="img/<?= $bd["gambar"]; ?>" alt="" width="100" height="150"></td>
                    <td><?= $bd["nama"];  ?></td>
                    <td>Color: <?= $bd["warna"]; ?> || Size: <?= $bd["size"]; ?></td>
                    <td><?= $jumlah; ?></td>
                    <td>Rp. <?= number_format($harga_produk); ?></td>
                    <td><a class="hapus-cart" href="hapuscart.php?cart=<?= $id_produk; ?>"><i
                                class="far fa-trash-alt"></i></a></td>
                </tr>
                <?php endforeach;?>
                <?php $urutan++; ?>
                <?php $total_belanja += $harga_produk; ?>
                <?php endforeach; ?>
                <?php endif ?>
            </table> -->



            <table class="tab-cart-container">
                <caption>KERANJANG ANDA</caption>
                <thead>
                <?php  
                    $urutannn = 1;
                    $total_belanja = 0;
                ?>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Produk Image</th>
                        <th scope="col">Produk Name</th>
                        <th scope="col">Size & Color</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Price</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php if(!isset($_SESSION["keranjang"]) || empty($_SESSION["keranjang"])) : ?>
                <?php $jv_empt = "kosong"; ?>
                <tr padding="4">
                    <td class="cart-empt" colspan="7">
                        <div id="div-kosong">
                            <p>KERANJANG MASIH KOSONG</p>
                        </div>
                    </td>
                </tr>
                <?php else: ?>
                <?php 
                        $jv_empt = "isi";
                        
                    ?>
                <?php foreach($_SESSION["keranjang"] as $id_produk => $jumlahhh) : ?>
                    <?php 
                   $query = "SELECT * FROM katalog_depan WHERE id=$id_produk";
                   
                   $db = query($query);     
                ?>
                 <?php foreach($db as $bddd):  ?>
                <?php $harga_produk = $bd["harga"]*$jumlahhh; ?>
                    <tr>
                        <td data-label="#"><?= $urutannn; ?></td>
                        <td class="p-img-detail">
                            <div class="p-name-detail">
                            <img src="img/<?= $bddd["gambar"]; ?>" alt="" width="100" height="150">
                                
                            </div>
                        </td>
                        <td data-label="Produk Name">
                                <p class="produk-name"><?= $bddd["nama"];  ?></p>
                        </td>
                        <td data-label="Color & Size">
                            <p>Color: <?= $bddd["warna"]; ?> || Size: <?= $bddd["size"]; ?></p>
                        </td>
                        <td data-label="Qty">
                            <p><?= $jumlahhh; ?></p>
                        </td>
                        <td data-label="Price">
                            <p>Rp. <?= number_format($harga_produk); ?></p>
                        </td>
                        <td >
                        <a class="hapus-cart" href="hapuscart.php?cart=<?= $id_produk; ?>"><i
                                class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                <?php $urutannn++; ?>
                <?php $total_belanja += $harga_produk; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>





            <div class="cekout-box">
                <a id="lanjut-belanja" href="index.php">Lanjut Belanja</a>
                <div class="checkout-total">
                    <div class="checkout-info">
                        <div class="checkout-harga">
                            <p>Subtotal</p>
                        </div>
                        <div class="checkout-harga">
                            <p>Rp. <?= number_format($total_belanja); ?> </p>
                        </div>
                    </div>
                    <button id="btn-cekout" onclick="cekout()" onmousedown="mouseDown()" onmouseup="mouseUp()">Lanjut Ke
                        Checkout</button>
                </div>
            </div>
        </div>

    </div>



    <div id="popup-login">
        <?php if(isset($_SESSION["pelanggan"])): ?>
        <div class="box-login-after">
            <p class="login-cls-after" onclick="clsPops()">X</p>
            <p> <?= $_SESSION["pelanggan"]["nama"]; ?></p>
            <div class="box-info-history">
                <a href="account.php"><button>AKUN SAYA</button></a>
                <?php if($cek2==0): ?>
                <h5>Anda belum mempunyai history transaksi</h5>
                <?php else: ?>
                <p>History Transaksi anda </p>

                <?php foreach($z_tes as $z): ?>
                <p class="history-p"><?= $z["tanggal"]; ?> total Rp.<?= number_format($z["total"]);  ?></p>
                <?php endforeach; ?>
                <a href="#" class="history-btn"><button>HISTORY DETAIL</button></a>
                <?php endif; ?>
            </div>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> logout</a></li>
        </div>
        <?php else: ?>
        <div id="box-login">
            <div class="popup-head-close">
                <h5>LOGIN</h5>
                <div class="span-x">
                    <p onclick="clsPop()">X</p>
                </div>
            </div>
            <form action="" method="post">
                <div>
                    <label for="">EMAIL</label>
                </div>
                <input type="text" placeholder="email" name="email" required>
                <div>
                    <label for="">PASSWORD</label>
                </div>
                <input type="password" placeholder="password" name="pass" required>
                <button type="submit" name="login">LOGIN</button>

                <a href="">forgot your password?</a>
            </form>
            <div class="signup-head">
                <h5>SIGN UP</h5>
                <button onclick="PopSign()">SIGN UP</button>
                <div>
                    <p>or sign up using google</p>
                    <a href=""><img src="img/g-icon.png" alt=""></a>
                </div>
            </div>
        </div>
        <div id="signup-box">
            <div class="popup-head-close">
                <h5>SIGN UP</h5>
                <div class="span-x">
                    <p onclick="clsPop()">X</p>
                </div>
            </div>
            <form action="" method="post">
                <div>
                    <label for="">NAME</label>
                </div>
                <input type="text" placeholder="name" name="nameSign">
                <div>
                    <label for="">EMAIL</label>
                </div>
                <input type="email" placeholder="email" name="email">
                <div>
                    <label for="">PASSWORD</label>
                </div>
                <input type="password" placeholder="password" name="pass">
                <div>
                    <label for="">CONFIRM PASSWORD</label>
                </div>
                <input type="password" placeholder="confirm password" name="passConfirm">
                <button name="signUp">SIGN UP NOW</button>
            </form>

            <div class="sgn-g">
                <p>or sign up using google</p>
                <a href=""><img src="img/g-icon.png" alt=""></a>
            </div>

        </div>
        <?php endif ;?>
    </div>


    <!-- hide body -->
    <div id="hide-konten">


    </div>
    <!-- hide body -->


    <div class="tdp-info-container">
        <div class="ft-info">
            <div class="tdp-info">
                <h3 class="judul-info">THE DESPERATE PROJECT</h3><br>
                <a class="cobain" href="#">
                    <p>About Us</p>
                </a>
                <a class="cobain" href="#">
                    <p>Contact</p>
                </a>
                <a class="cobain" href="#">
                    <p>Store Locations</p>
                </a>
            </div>
            <div class="tdp-help">
                <H3 class="judul-info">HELP</H3><br>
                <a class="cobain" href="#">
                    <p>Order Tracking</p>
                </a>
                <a class="cobain" href="#">
                    <p>FAQ's</p>
                </a>
                <a class="cobain" href="#">
                    <p>Privacy Police</p>
                </a>
                <a class="cobain" href="#">
                    <p>Term & Conditions</p>
                </a>
            </div>

            <div class="tdp-kategori">
                <H3 class="judul-info">CATEGORY</H3><br>
                <a class="cobain" href="#">
                    <p>HOODIE</p>
                </a>
                <a class="cobain" href="#">
                    <p>HAT</p>
                </a>
                <a class="cobain" href="#">
                    <p>T-Shirt</p>
                </a>
            </div>
            <div class="tdp-medsos">
                <h3 class="judul-info">FOLLOW US</h3><br>
                <div class="medsos-icon">
                    <a class="cocobi" href="#">
                        <p><i class="fab fa-instagram"></i></p>
                    </a>
                    <a class="cocobi" href="#">
                        <p><i class="fab fa-facebook-f"></i></p>
                    </a>
                    <a class="cocobi" href="#">
                        <p><i class="fab fa-twitter"></i></p>
                    </a>
                </div>
            </div>


        </div>
    </div>

    <div class="wa-chat">
        <a href=""><img src="img/wa-icon.png" alt=""></a>

    </div>

    <footer>
        <img src="img/logo.png" alt="">
        <p>&copy; Copyright by The Desperate Project | Powered by T.D.P</p>
    </footer>

    <script src="jsnya/script-dsp.js" type="text/javascript"></script>

    <script>
        var buttonx = document.getElementById("btn-cekout");

        var btnCekout = "<?php echo $jv_empt; ?>";
        if (btnCekout === "kosong") {

            function mouseDown() {
                var element = document.getElementById('div-kosong');
                element.classList.add("div-empt");
            }

            function mouseUp() {
                var element = document.getElementById('div-kosong');

                setTimeout(function () {
                    element.classList.remove("div-empt");
                }, 500);
            }

            function cekout() {
                return false;
            }
        } else {

            function cekout() {
                window.location.href = "checkout.php";
            }

            function mouseDown() {
                return false;
            }

            function mouseUp() {
                return false;
            }
        }
        var jumlahCart = "<?= $jumlah_cart;  ?>";

        if (jumlahCart == 0) {
            document.getElementById('jumlah-cart').style.display = "none";
        } else {
            document.getElementById('jumlah-cart').style.display = "table";
        }
    </script>




</body>

</html>