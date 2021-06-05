<?php
require 'functions.php';
// if ( !isset($_POST["kode"]) ||
// mysqli_error($koneksi)){
//     //redirect
//     header("Location: latihan1.php");
//     exit;
// }
session_start();
    if(!isset($_GET["id"]) || 
        !isset($_GET["kategori"])) {

        header("Location: index.php");
        exit;
    }



    $tampung = $_GET["id"];
    $jenis = $_GET["kategori"];
 

    if($jenis == "T-shirt") {
        $queri = "SELECT * FROM tshirt  where id = '$tampung'";
    }elseif($jenis == "HAT") {
        $queri = "SELECT * FROM hat where id = '$tampung'";
    }else{
        $queri = "SELECT * FROM katalog_depan where id = '$tampung'";
    }
  

    $db = query($queri);

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
    



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link class="icon-tab" rel="icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <link rel="stylesheet" type="text/css" href="katalog/style-katalog.css">
    <link rel="stylesheet" type="text/css" href="scss/baner-slide.css">
    <title>detail produk</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap');
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
                        <a href="cart.php" class="shop-cart">
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


        </nav>
    </header>

    <div class="detail-produk-container">
        <div class="detail-produk">
            <?php foreach($db as $dd) : ?>
            <div class="detail-img">
                <img src="img/<?= $dd["gambar"]; ?>" alt="">
            </div>

            <div id="detail-text">
                <h3><span>NAMA PRODUK:</span><?= $dd["nama"]; ?></h3>

                <p><span>PRODUK TYPE: </span> <?= $dd["kategori"]; ?></p>
                <p class="d-harga">Rp 350.000,00</p>

                <div class="detail-container-sc">
                    <div class="detail-sc">
                        <div class="detail-size">
                            <p><span>SIZE</span> <span class="waduh"><?= $dd["size"]; ?></span></p>
                        </div>

                        <div class="detail-size">
                            <p><span>COLOR</span> <span class="waduh"><?= $dd["warna"]; ?></span></p>
                        </div>
                    </div>

                    <div class="wish-btn">
                        <form action="" method="post">
                            <?php if (isset($_SESSION["pelanggan"])): ?>
                            <input type="hidden" name="id_cust_wish" value="<?= $id_pl;?>">
                            <?php endif; ?>
                            <input type="hidden" name="id_pd_wish" value="<?= $tampung;?>">
                            <button type="submit" name="proses_wish"><i class="fas fa-heart"></i> Tambahkan Ke Wishlist</button>
                        </form>
                    </div>

                <?php 

                    if(isset($_POST["proses_wish"])) {
                        if(!isset($_SESSION["pelanggan"])) {
                            echo "<script>alert('anda harus login dahulu!')</script>";
                        }else {
                            $cek_tb_wish = query("SELECT * FROM tb_wishlist WHERE id_pl = $id_pl AND id_pd = $tampung");

                            if($cek_tb_wish) {
                                echo "<script>alert('produk sudah ada di wishlist')</script>";
                            }else{
    
                            $id_pl_wish = $_POST["id_cust_wish"];
                            $id_pd_wish = $_POST["id_pd_wish"];
    
                            mysqli_query($koneksi, "INSERT INTO tb_wishlist(id_pl,id_pd)
                            VALUES('$id_pl_wish','$id_pd_wish')");
                            }
                        }
                        }

                       
                
                ?>

                </div>
                <div class="add-chart-container">
                    <a href="proses-cart.php?id=<?= $tampung;?>"><button >TAMBAHKAN KE CART</button></a>
                </div>

                <div class="text-info">
                    <div id="info-toggle">
                        <div class="info-anchor">
                            <p>INFO</p>
                        </div>
                        <div class="info-anchor-icon">
                            <p>+</p>
                            <input type="checkbox" onclick="detailInfo();">
                        </div>
                        <div class="text-info-detail">
                            <p>HOODIE ARMY ini bisa digunakan oleh pria atau wanita (unisex). Hoodie ini bisa menarik
                                perhatian dikarenakan dibuat dari bahan-bahan surgawi cocok digunakan oleh orang yang
                                bertujuan untuk menaklukan lawan jenis, kalau anda memakai hoddie ini dijamin lawan
                                jenis akan klepek-klepek tidak berdaya dihadapan anda wahai pelanggan yang terhormat!
                            </p>
                            <div class="detail-bahan-produk">
                                <p>-bahan <?= $dd["bahan"]; ?><br>-object bordel<br>-color green army</p>
                            </div>
                            <div class="detail-ukuran">
                                <p>Lebar / Panjang / Ukuran<br>48 / 71 / S<br>50 / 73 / M<br>52 / 76 / L<br>56 / 77 / XL
                                </p>
                            </div>

                        </div>
                    </div>



                </div>


            </div>
            <?php endforeach; ?>
        </div>
    </div>


    <!-- popup login -->
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
            <form action="">
                <div>
                    <label for="">NAME</label>
                </div>
                <input type="text">
                <div>
                    <label for="">EMAIL</label>
                </div>
                <input type="text">
                <div>
                    <label for="">PASSWORD</label>
                </div>
                <input type="password">
                <button type="submit">SIGN UP NOW</button>
            </form>

            <div class="sgn-g">
                <p>or sign up using google</p>
                <a href=""><img src="img/g-icon.png" alt=""></a>
            </div>

        </div>
        <?php endif ;?>
    </div>

    <!-- popup login end -->


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


    <script src="OwlCarousel2-2.3.4/docs/assets/vendors/jquery.min.js" type="text/javascript"></script>
    <script src="OwlCarousel2-2.3.4/dist/owl.carousel.js" type="text/javascript"></script>
    <script src="jsnya/script-dsp.js" type="text/javascript"></script>
    <script>
        function myFunction() {
            var x = document.getElementById("nyumput");
            var y = document.querySelector('.burger-icon input');
            var z = document.getElementById("satsat");
            var sat2 = document.getElementById("satsat2");
            if (y.checked == true) {
                x.style.transform = "translateX(0)";
                z.style.transform = "translateX(0)";
                sat2.style.transform = "translateX(0)";
            } else {
                x.style.transform = "translateX(100%)";
                z.style.transform = "translateX(110%)";
                sat2.style.transform = "translateX(500%)";
            }
        }

        function detailInfo() {
            var infoToggle = document.getElementById("info-toggle");
            var klik = document.querySelector('.info-anchor-icon input');
            var iconTambah = document.querySelector('.info-anchor-icon p');
            var TinggiDetailText = document.getElementById("detail-text");
            if (klik.checked == true) {
                infoToggle.style.height = "355px";
                iconTambah.style.transform = "rotate(45deg)";
                TinggiDetailText.style.height = "760px";
            } else {
                infoToggle.style.height = "44px";
                iconTambah.style.transform = "rotate(0deg)";
                TinggiDetailText.style.height = "550px";
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