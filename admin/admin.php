<?php
    require 'fungsiadmin.php';

$sapi = query('SELECT COUNT(*) FROM tshirt');
$hoodie_c = query('SELECT COUNT(*) FROM katalog_depan');
$hat_c = query('SELECT COUNT(*) FROM hat');
  
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link class="icon-tab" rel = "icon" href = "../img/logo.png" type = "image/x-icon"> 
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../katalog/style-katalog.css">
    <title>Admin</title>

</head>
<body>
    <header>
        <nav class="nav-admin-container">
            <div class="nav-ac-dalam">
                <div class="admin-j-n" >
                    <h3>T.D.P ADMIN</h3>
                </div>
                <div class="admin-name">
                    <p>Nama Admin</p>
                    <i style="font-size: 20px;" class="ri-user-settings-fill"></i>
                    <input type="checkbox" onclick="klikAdmin();">
                    <div id="opsi-dropdown">
                        <ul>
                            <li>propile</li>
                            <li>wadidaw</li>
                            <li>Log out</li>
                        </ul>
                    </div>
                </div>
                
            </div>
           
        </nav>
    </header>

    <div class="opsi-action">
        <div class="opsi-tambah">
            <button onclick="linkTambah()">Tambah Produk</button>
        </div>
        <div class="opsi-edit">
            <button onclick="linkEdit()">Edit Produk</button>
        </div>
        <div class="opsi-hapus">
            <button>Customer</button>
        </div>
    </div>
    
   <div class="stok-produk-container">
        <h3>STOK PRODUK</h3>
        <div class="info-stok-container">
            <div class="info-stok-tshirt">
                <h3>T-Shirt</h3>
                <?php foreach ($sapi as $hayam): ?>
                <p><?= $hayam['COUNT(*)']; ?></p>
                <?php endforeach;?>
            </div>
            <div class="info-stok-hoodie">
                <h3>Hoodie</h3>
                <?php foreach ($hoodie_c as $hod): ?>
                <p><?= $hod['COUNT(*)']; ?></p>
                <?php endforeach;?>
            </div>
            <div class="info-stok-hat">
                <h3>Hat</h3>
                <?php foreach ($hat_c as $htc): ?>
                <p><?= $htc['COUNT(*)']; ?></p>
                <?php endforeach;?>
            </div>
    
        </div>
   </div>

    <script>
        function klikAdmin() {
            var klikInput =  document.querySelector('.admin-name input');
            var munculDropD = document.getElementById("opsi-dropdown");

            if (klikInput.checked == true) {
                munculDropD.style.height = "90px";
            }else {
                munculDropD.style.height = "0px";
            }
        }

 
function linkTambah() {
  window.open("tambahdata.php","_self");
}
function linkEdit() {
  window.open("admin-aksi.php?sortBy=hoodie","_self");
}
    </script>
</body>
</html>