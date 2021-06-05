<?php

require("functions.php");
$ambil_id = $_GET["id"];

$tampil_data_query = query("SELECT * FROM katalog_depan WHERE id = $ambil_id")[0];

if(isset ($_POST["submit"]) ) {

    if(edit($_POST) > 0) {
        echo "<script>
                alert('produk berhasil diedit!');
                document.location.href = 'index.php';
        
            </script>";
    }else {
       echo "<script>
                alert('produk gagal di edit!');
                
        
            </script>";
        
    }

};


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style-edit.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>edit katalog depan</title>
</head>
<body>
<header>EDIT PRODUK</header>
<div class="edit">
    <div class="sample-edit">
        <img src="img/<?= $tampil_data_query["gambar"]; ?>" alt="">
        <p><?= $tampil_data_query["nama"]; ?></p>
        
    </div>
    <div class="form-edit">
     <form action="" method="post">
     <input type="hidden" name="id" value ="<?= $tampil_data_query["id"]; ?>" >

        <div class="input-field">
        <label for="nama">Nama produk </label>
        <input type="text" name="nama" id="nama" value="<?= $tampil_data_query["nama"]; ?>" required>
        </div>

        <div class="input-field">
        <label>Ukuran produk </label>
        <div class="cek">

        <div class="cek-btn">
         <input type="checkbox" id = "small" name="ukuran" value="Small" >
        <label for="hoodie">Small</label>
         </div>
         <div class="cek-btn">
         <input type="checkbox" name="ukuran" value="medium" id="medium" value="Medium" >
        <label for="JAKET">Medium</label>
       </div>

       <div class="cek-btn">
         <input type="checkbox" name="ukuran" value="large" id="large" value="Large" >
        <label for="JAKET">Large</label>
       </div>

    
        </div>
        </div>

        <div class="input-field">
        <label>Bahan produk </label>

        <div class="cek">

<div class="cek-btn">
<input type="checkbox" id = "polyester" name="bahan" value="polyester" >
<label for="polyester">polyester</label>
</div>
<div class="cek-btn">
<input type="checkbox" name="bahan" value="parasit" id="parasit" value="parasit" >
<label for="parasit">Parasit</label>
</div>

<div class="cek-btn">
<input type="checkbox" name="bahan" value="babyterry" id="babyterry" value="babyterry" >
<label for="babyterry">babyterry</label>
</div>


</div>
       
        </div>

        <div class="input-field">
        <label for="warna">Warna produk </label>
        <input type="text" name="warna" id="warna" value="<?= $tampil_data_query["warna"]; ?>" placeholder="Hitam Kelam" required>
        </div>


        <div class="input-field kategori">
        <label>Kategori produk </label>

        <div class="cek">

        <?php if($ambil_id == 2) : ?>
        <div class="cek-btn">
         <input type="checkbox" id = "hoodie" name="jenis" value="HOODIE" >
        <label for="hoodie">HOODIE</label>
         </div>
         <div class="cek-btn">
         <input type="checkbox" name="jenis" id="jaket" value="JAKET" checked='true' >
        <label for="JAKET">JAKET</label>
       </div>

       <?php else : ?>
        <div class="cek-btn">
         <input type="checkbox" id = "hoodie" name="jenis" value="HOODIE" checked='true' >
        <label for="hoodie">HOODIE</label>
         </div>
         <div class="cek-btn">
         <input type="checkbox" name="jenis"  id="jaket" value="JAKET" >
        <label for="JAKET">JAKET</label>
       </div>
       <?php endif; ?>


        </div>
        </div>

        <div class="input-field">
        <label for="gambar">Gambar produk </label>
        <input type="text" name="gambar" id="gambar" value="<?= $tampil_data_query["gambar"];?>" placeholder="belum nemu caranya :)" required>
        </div>

        <!-- belum dibuat -->
        <div class="input-field">
        <label for="berat">Berat produk </label>
        <input type="text" name="berat" id="berat" value="" placeholder="300gr">
        </div>

        <div class="input-field">
        <label for="stok">Stok Produk</label>
        <input type="text" name="stok" id="stok" value="" placeholder="50">
        </div>

        <div class="input-field">
        <label for="harga">Harga produk </label>
        <input type="text" name="harga" id="harga" value="" placeholder="Rp.350.000,00-">
        </div>

        <div class="input-field">
        <label for="diskon">Diskon produk </label>
        <input type="text" name="diskon" id="diskon" value="" placeholder="Rp.50.000,00-">
        </div>

        

        <div class="input-deskripsi">
        <label for="deskripsi">Deskripsi produk </label>
        <input type="text" name="deskripsi" id="deskripsi" value="" placeholder="Sering digunakan oleh penakluk wanita">
        </div>

        
        

        <button type="submit" name="submit">SAVE</button>
        </form>
       
    </div>

    
    </div>
    
  
    <script>
    var allIds = [ "hoodie", "jaket" ];
function uncheck( event ) 
{
   var id = event.target.id;
   allIds.forEach( function( id ){
      if ( id != event.target.id )
      {
         document.getElementById( id ).checked = false;
      }
   });
}

jQuery("#hoodie").click(uncheck);
jQuery("#jaket").click(uncheck);



</script>




</body>
</html>