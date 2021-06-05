<?php 

require 'functions.php';

session_start();

$db = query("SELECT * FROM katalog_depan LIMIT 0,4");

if(isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $ambil = mysqli_query($koneksi,"SELECT * FROM tb_cust WHERE email = '$email'");

    $akunygcocok = mysqli_num_rows($ambil);

    if($akunygcocok===1){
        $akun=$ambil->fetch_assoc();

        if(password_verify($password, $akun["password_cust"]) ) {
        $_SESSION["pelanggan"] = $akun;
        echo "<script>alert('anda login')</script>";
        
        exit;
        }else{
            echo "<script>alert('Email/Password salah!')</script>";
            // echo "<script>location='login.php'</script>";
        }
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROJECT</title>

    <link class="icon-tab" rel="icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="scss/baner-slide.css">
    <link rel="stylesheet" type="text/css" href="OwlCarousel2-2.3.4/dist/assets/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>

<body>
    <header>
        <nav id="nav-scrl">
            <img src="img/DESPERATE.png" alt="">
            <div id="nyumput">
                <div class="navlink-container">
                    <a href="#" class="nav-link">HOME</a>
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
                            <a href="cart.php" class="shop-cart"><i class="fa fa-shopping-cart"></i></a>
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



    <div class="owl-carousel">
        <div class="post-content-parent">
            <div class="c--post-content-image-wrapper slider-image-2"></div>

        </div>
        <div class="post-content-parent">
            <div class="c--post-content-image-wrapper"></div>

        </div>
        <div class="post-content-parent">
            <div class="c--post-content-image-wrapper2"></div>

        </div>
        <div class="post-content-parent">
            <div class="c--post-content-image-wrapper3"></div>

        </div>
    </div>





    <div class="box">
        <div class="new-c">
            <h1>new collection</h1>

        </div>

        <?php foreach($db as $sample) : ?>

        <form class="box-sample" action="detail.php?id=<?= $sample["id"];?>&kategori=<?= $sample["kategori"]; ?>"
            method="post">
            <img src="img/<?= $sample["gambar"]; ?>" alt="">
            <p name="nama"><?= $sample["nama"]; ?></p>
            <input type="submit" name="submit" value="DETAIL">
            <div class="edit-link">
                <a href="edit.php?id=<?= $sample["id"]; ?>">EDIT</a> | <a
                    href="delete.php?=<?= $sample["id"]; ?>">DELETE</a>
            </div>
        </form>
        <?php endforeach ?>
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


    <div class="box-dua">

        <div class="box-dua-judul">
            <h2>SKATE<BR> COLLECTION</h2>
            <P>Setelan yang biasa dipakai untuk skateboard mulai dari topi, t-shirt, celana, sepatu dan papan saketnya.
            </P>
            <a href="">MORE...</a>
        </div>

        <div class="box-dua-depan">
            <img src="img/img-2-depan1.jpg" alt="">
        </div>

        <div class="box-dua-depan">
            <img src="img/img-2-depan2.jpg" alt="">
        </div>
    </div>


    <div class="hat-container">

        <div class="judul-hat">
            <div class="judul-hat2">
                <h2>HAT COLLECTION</h2>
            </div>
            <div class="katalog-lkp">
                <a href="hat.php">MORE...</a>
            </div>

        </div>


        <div class="hat-item">
            <img src="img/hat/hat1.jpg" alt="" onclick="linkTopi();">
            <p><span>TREFOIL BASEBALL CAP</span><br>Rp.250.000,00-</p>
        </div>
        <div class="hat-item">
            <img src="img/hat/hat2edit.jpg" alt="">
            <p><span>TREFOIL BUCKET HAT</span><br>Rp.250.000,00-</p>
        </div>
        <div class="hat-item">
            <img src="img/hat/hat3.jpg" alt="">
            <p><span>ADICOLOR SUEDE CAP</span><br>Rp.250.000,00-</p>
        </div>
        <div class="hat-item">
            <img src="img/hat/hat4.jpg" alt="">
            <p><span>TREFOIL BASEBALL HAT</span><br>Rp.250.000,00-</p>
        </div>



    </div>

    <div class="hat-container">


        <div class="judul-hat">
            <div class="judul-hat2">
                <h2>T-SHIRT COLLECTION</h2>
            </div>
            <div class="katalog-lkp">
                <a href="tshirt.php">MORE...</a>
            </div>

        </div>

        <div class="hat-item">
            <img src="img/hat/shirt1.jpg" alt="">
            <p><span>THE BEATLES</span><br>Rp.250.000,00-</p>
        </div>
        <div class="hat-item">
            <img src="img/hat/shirt2.jpg" alt="">
            <p><span>SLAYER</span><br>Rp.250.000,00-</p>
        </div>
        <div class="hat-item">
            <img src="img/hat/shirt3.jpg" alt="">
            <p><span>PINK FLOYD</span><br>Rp.250.000,00-</p>
        </div>
        <div class="hat-item">
            <img src="img/hat/shirt4.jpg" alt="">
            <p><span>PAYUNG TEDUH</span><br>Rp.250.000,00-</p>
        </div>

    </div>

    <div class="sign-container">
        <div class="sign-content">
            <div class="sign-text">
                SIGN UP to receive updates and special offers.
            </div>
            <form action="" id="sign-input">
                <input type="email" class="form-input" placeholder="EMAIL ANDA">
                <div class="form-btn">

                    <button type="submit" class="btn">SIGN UP</button>
                </div>

            </form>
        </div>
    </div>

    <div class="box-store">
        <h3>T.D.P STORES & DEALERS</h3>
        <div class="loc-1">
            <img src="img/logo.png" alt="">
            <div class="alamat">
                <a class="alamat-detail" href="https://goo.gl/maps/ZYdQBsBNMLKtCahP6"><span>25°N 71°W 25°N
                        71°W</span><br>Bermuda Triangle</a>
            </div>

        </div>

        <div class="loc-2">
            <div class="online-store">
                <a href="https://shopee.co.id/">T.D.P Official Shop at Shopee Mall Indonesia</a>
            </div>

            <div class="online-store">
                <a href="https://www.tokopedia.com/">T.D.P Store at Tokopedia</a>
            </div>

        </div>

        <div class="loc-1">
            <img src="img/f-logo.jpg" alt="">
            <div class="alamat">
                <a class="alamat-detail" href="https://goo.gl/maps/bYUCaWLcrPKui1Qc6"><span>63°38'17.2"S
                        57°38'12.6"W</span><br>Antartika</a>
            </div>

        </div>

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




    <script src="OwlCarousel2-2.3.4/docs/assets/vendors/jquery.min.js" type="text/javascript"></script>
    <script src="OwlCarousel2-2.3.4/dist/owl.carousel.js" type="text/javascript"></script>
    <script src="jsnya/script-dsp.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel();
        });

        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true,
            animateOut: 'fadeOut',
            dots: false,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })

        var jumlahCart = "<?= $jumlah_cart;  ?>";

        if (jumlahCart == 0) {
            document.getElementById('jumlah-cart').style.display = "none";
        } else {
            document.getElementById('jumlah-cart').style.display = "table";

        }
    </script>

</body>

</html>