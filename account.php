<?php
   require 'functions.php';
    session_start();
    if(!isset($_SESSION["pelanggan"])) {
      echo "<script>alert('anda belum login!');</script>";
      echo "<script>location='index.php';</script>";
  }

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



  if(isset($_SESSION["pelanggan"])) {
    $id_pl = $_SESSION["pelanggan"]["id"];
  $z_tes = mysqli_query($koneksi,"SELECT * FROM tb_transaksi WHERE id_cust = $id_pl LIMIT 0,3");
  $cek2 = mysqli_num_rows($z_tes);
}






    $nama_cust = $_SESSION["pelanggan"]["nama"];
   $wadidaw = query("SELECT * FROM tb_transaksi INNER JOIN tb_cust ON tb_transaksi.id_cust = tb_cust.id WHERE nama = '$nama_cust' ORDER BY tanggal DESC");
   $alamat_db = query("SELECT * FROM tb_cust WHERE id = $id_pl");
   if(!isset($_SESSION["keranjang"])) {
    $jumlah_cart = 0;
}else{
    $jumlah_cart = count($_SESSION["keranjang"]);
}

$urutan_nota = 1;

$set_alamat = mysqli_query($koneksi,"SELECT * FROM tb_cust WHERE alamat != '' and id = $id_pl");
$cek_alamat = mysqli_num_rows($set_alamat);

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

  <title>NOTA</title>
  <style>
    #div-kosong {
      padding: 40px;
      text-align: center;
      font-size: 24px;
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
            <a href="#" class="login-icon"><i class="fas fa-user"></i> <span class="tooltiptext">login</span></a>
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
              <a href="#" class="login-icon"><i class="fas fa-user"></i> <span class="tooltiptext">login</span></a>
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

  <div id="popup-login">
    <?php if(isset($_SESSION["pelanggan"])): ?>
    <div class="box-login-after">
      <p class="login-cls-after" onclick="clsPops()">X</p>
      <p> <?= $_SESSION["pelanggan"]["nama"]; ?></p>
      <div class="box-info-history">
        <a href="#"><button>AKUN SAYA</button></a>
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

  <div class="acc-container">
    <h2 class="judul-nota">Akun <?= $_SESSION["pelanggan"]["nama"]; ?></h2>

    <div class="acc-aksi">
      <button id="hstr" onclick="htr();">HISTORY</button>
      <button id="dtl-akun" onclick="akun();">DETAIL AKUN</button>
    </div>
    <div class="tab-nota-container" id="tab-history">
      <?php if($cek2==0): ?>
      <div id="div-kosong">
        <p>BELUM ADA HISTORY TRANSAKSI</p>
      </div>
      <?php else: ?>
      <ul class="responsive-nota-table">
        <li class="table-nota-header">
          <div class="col col-1">#</div>
          <div class="col col-2">Nama Customer</div>
          <div class="col col-3">Total</div>
          <div class="col col-4">Tanggal</div>
          <div class="col col-4">Detail</div>
        </li>
        <?php foreach($wadidaw as $wadi): ?>
        <li class="table-nota-row">
          <div class="col col-1" data-label="#"><?= $urutan_nota; ?></div>
          <div class="col col-2" data-label="Nama Customer"><?= $wadi["nama"];?></div>
          <div class="col col-3" data-label="Total">Rp. <?= number_format($wadi["total"]);?></div>
          <div class="col col-4" data-label="Tanggal"><?= $wadi["tanggal"];?></div>
          <div class="col col-4" id="detail-nota-<?= $wadi["id_trans"]; ?>" data-label="Detail"><a
              href="detail-nota.php?trans=<?= $wadi["id_trans"];?>">Lihat Detail</a></div>
        </li>
        <?php $urutan_nota++; ?>
        <?php endforeach; ?>

      </ul>
      <?php endif; ?>
    </div>

    <div class="akun-detail" id="akundetail-id">

          <?php foreach($alamat_db as $info_cust): ?>
      <p>Nama</p>
      <div class="akun-detail-box"><?= $info_cust["nama"]; ?></div>
      <p>Email</p>
      <div class="akun-detail-box"><?= $info_cust["email"]; ?></div>
      <p>Kontak</p>
      <div class="akun-detail-box"><?= $info_cust["no_telpon"]; ?></div>
      <?php endforeach; ?>
      <p>Alamat</p>
      <?php if($cek_alamat==0): ?>
        <div class="akun-detail-box">



        <button id="btn-set-alamat" onclick="setAlamat();">Alamat belum di set</button>

        <form action="" method="post" id="form-set-alamat">

          <input type="text" required placeholder="contoh : Jl.pahlawan no 123 Garut. jawa barat" name="alamat">
          <button type="submit" name="set_alamat">simpan</button>
        </form>

      </div>
      <?php else: ?>
        <?php foreach($alamat_db as $almt): ?>
      <div class="akun-detail-box"><?= $almt["alamat"]; ?></div>
      <?php endforeach; ?>
      <?php endif; ?>

    </div>

  </div>

  <?php 
    if(isset($_POST["set_alamat"])) {
      $alamat = $_POST["alamat"];

      mysqli_query($koneksi,"UPDATE tb_cust SET alamat = '$alamat' WHERE id = $id_pl");
      echo "<script>alert('alamat di simpan')</script>";
      echo "<script>location='account.php';</script>";
    }
  
  
  
  ?>

<div id="hide-konten">


</div>




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
    var jumlahCart = "<?= $jumlah_cart;  ?>";

    if (jumlahCart == 0) {
      document.getElementById('jumlah-cart').style.display = "none";
    } else {
      document.getElementById('jumlah-cart').style.display = "table";
    }

    function htr() {
      var histr = document.getElementById('dtl-akun');
      var akunDetail = document.getElementById('hstr');
      var tabHistr = document.getElementById('tab-history');
      var akunDetailBox = document.getElementById('akundetail-id');

      akunDetailBox.style.display = "none";
      tabHistr.style.display = "block";

      histr.style.color = "rgb(83, 83, 83)";
      akunDetail.style.color = "black";

      histr.style.borderTop = "none";
      histr.style.borderRight = "none";
      histr.style.borderLeft = "none";
      histr.style.borderBottom = "1px solid rgb(83, 83, 83)";

      akunDetail.style.borderTop = "1px solid rgb(83, 83, 83)";
      akunDetail.style.borderRight = "1px solid rgb(83, 83, 83)";
      akunDetail.style.borderLeft = "1px solid rgb(83, 83, 83)";
      akunDetail.style.borderBottom = "1px solid white";
    }

    function akun() {
      var akunDetail = document.getElementById('hstr');
      var histr = document.getElementById('dtl-akun');

      var tabHistr = document.getElementById('tab-history');
      var akunDetailBox = document.getElementById('akundetail-id');

      akunDetailBox.style.display = "block";
      tabHistr.style.display = "none";

      histr.style.color = "black";
      akunDetail.style.color = "rgb(83, 83, 83)";



      akunDetail.style.borderTop = "none";
      akunDetail.style.borderRight = "none";
      akunDetail.style.borderLeft = "none";
      akunDetail.style.borderBottom = "1px solid rgb(83, 83, 83)";

      histr.style.borderTop = "1px solid rgb(83, 83, 83)";
      histr.style.borderRight = "1px solid rgb(83, 83, 83)";
      histr.style.borderLeft = "1px solid rgb(83, 83, 83)";
      histr.style.borderBottom = "1px solid white";
    }

    window.onload = function htr() {
      var histr = document.getElementById('dtl-akun');
      var akunDetail = document.getElementById('hstr');
      var tabHistr = document.getElementById('tab-history');
      var akunDetailBox = document.getElementById('akundetail-id');

      akunDetailBox.style.display = "none";
      tabHistr.style.display = "block";

      histr.style.color = "rgb(83, 83, 83)";
      akunDetail.style.display = "black";

      histr.style.borderTop = "none";
      histr.style.borderRight = "none";
      histr.style.borderLeft = "none";
      histr.style.borderBottom = "1px solid rgb(83, 83, 83)";

      akunDetail.style.borderTop = "1px solid rgb(83, 83, 83)";
      akunDetail.style.borderRight = "1px solid rgb(83, 83, 83)";
      akunDetail.style.borderLeft = "1px solid rgb(83, 83, 83)";
      akunDetail.style.borderBottom = "1px solid white";
    }

    function setAlamat() {
      var btnSetAlamat = document.getElementById('btn-set-alamat');
      var formSetAlamat = document.getElementById('form-set-alamat');

      formSetAlamat.style.display = "block";
      btnSetAlamat.style.display = "none";

    }
  </script>

</body>

</html>