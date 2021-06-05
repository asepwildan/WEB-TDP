<?php
require 'fungsiadmin.php';


if(!isset($_GET['sortBy'])) {

    header("Location: admin.php ");

    exit;

}


if($_GET['sortBy'] == 'hat'){
    $tdata = query("SELECT * FROM hat");
    $wadidi = "hat";
}elseif($_GET['sortBy'] == 'hoodie') {
    $tdata = query("SELECT * FROM katalog_depan");
    $wadidi = "katalog_depan";
}else{
    $tdata = query("SELECT * FROM tshirt");
    $wadidi = "tshirt";

}

// if(isset($_POST['cari']) ){
//     echo $_POST['kataKunci'];
// }



if(isset($_POST['cari']) ){

    $kata_kunci = $_POST['kataKunci'];
    $tdata = query("SELECT * FROM $wadidi WHERE 
    nama LIKE '%$kata_kunci%' OR
    kode LIKE '%$kata_kunci%' OR
    bahan LIKE '%$kata_kunci%' OR
    warna LIKE '%$kata_kunci%' OR
    harga LIKE '$kata_kunci%'
     ");
}






?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

   
    <title>Document</title>
    <style>
        .table-container-admin {
            padding:0 20px;
        }

        .yoyo{
             display:none;
            position: absolute; 
            width: 250px;
          
             margin-left: auto;
            left: 0;
            right: 20px;
            text-align: center;
        }
        .spn-gbr {
            color: black;
            cursor: pointer;
        }
        .spn-gbr:hover{
            color: 	#6495ED;
        }

        .aksi-container {
            display: flex;
            width: 100%;
            padding: 0 20px;
            margin: 20px 0 10px 0;
            text-align: center;
            justify-content: space-between;
            
            align-items: center;
        }

        .aksi-container form {
            display: flex;
            justify-content: space-between;
        }

        .back-link {
            width: 90px;
            
            color: black;
            border: 1px solid black;
            padding: 5px 10px;
            text-decoration: none;
        }

        .back-link:hover {
            background: black;
            color: white;
            text-decoration: none;
        }

    

        #a-link, #b-link, #c-link  {
           display:block;
            width: 90px;
            margin: 0 7px;
            background: transparent;
            border: 1px solid black;
            border-radius: 0px;
            padding: 5px 10px;
            text-decoration: none;
            color: black;
            text-transform: uppercase;
        }


        .back-link:before{
            content: ' \2190';
        }
      
        .aksi-anchor {
            display: flex;
        }


        
        #a-link:hover , #b-link:hover, #c-link:hover {
            
            color: white;
            font-weight: bold;
            background: black;
        }
      
        .j-tab {
            text-transform: uppercase;
            font-size: 24px;
            margin-bottom: 5px;
        }
        .sch-btn{
            border: 1px solid black;
            margin-left: 3px;
            cursor: pointer;
            background: transparent;
        }

        .sch-btn:hover{
            background: black;
            color: white;
        }

        .sch-input{
            border-radius: 1px;
            border: 1px solid black;
            padding: 0 5px;
            outline: none;
        }

      
    </style>
</head>
<body>


    <div class="aksi-container">
    <a href="admin.php" class="back-link">kembali</a>
        <form action="" method="get">
            
            <div class="aksi-anchor">
                <a href="admin-aksi.php?sortBy=hat" id="a-link" >Hat</a>
                <a href="admin-aksi.php?sortBy=hoodie" id="b-link" >Hoodie</a>
                <a href="admin-aksi.php?sortBy=t-shirt" id="c-link" >T-shirt</a>
            </div>
            
        </form>
        <div>
   
        <form action="" method="post" > 
        
            <input class="sch-input" type="text" name="kataKunci" autofocus placeholder="Masukkan kata kunci">
            <button type="submit" name="cari" class="sch-btn"><i style="font-size: 18px;" class="ri-search-line"></i></button>
        </form>
       
        </div>
    </div>

   


<div class="table-container-admin">
    <p class="j-tab"><?= $_GET['sortBy']; ?></p>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Aksi</th>
        <th scope="col">Nama Produk</th>
        <th scope="col">Kode</th>
        <th scope="col">Kategori</th>
        <th scope="col">Bahan</th>
        <th scope="col">Size</th>
        <th scope="col">Color</th>
        <th scope="col">Harga</th>
        <th scope="col">Gambar</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    <?php foreach($tdata as $tampil_data): ?>
        <?php $duit = $tampil_data['harga'];?>
        <tr>
        <th scope="row"><?=$i;?></th>
        <td><a href="edit-produk.php?id=<?= $tampil_data['id']; ?>&produk=<?= $tampil_data['kategori']; ?>">Edit</a> || 
        
        <a href="delete.php?id=<?= $tampil_data['id']; ?>&produk=<?= $tampil_data['kategori']; ?>" onclick="return confirm('Anda akan menghapus <?= $tampil_data['kategori'].' '; echo $tampil_data['nama']; ?> ')">Delete</a></td>
        <td><?= $tampil_data['nama']; ?></td>
        <td><?= $tampil_data['kode']; ?></td>
        <td><?= $tampil_data['kategori']; ?></td>
        <td><?= $tampil_data['bahan']; ?></td>
        <td><?= $tampil_data['size']; ?></td>
        <td><?= $tampil_data['warna']; ?></td>
        <td><?= rupiah($duit); ?></td>
        <td onclick="klikGbr<?=$i;?>()" ><img id="tgbr-<?=$i;?>" class="yoyo" src="../img/<?= $tampil_data['gambar']; ?>" alt=""><span class="spn-gbr">Lihat Gambar</span></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>

</body>

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


<?php $u = 1; ?>
<?php foreach($tdata as $cobaan): ?>
function klikGbr<?=$u;?>(){
    var paramGbr = document.getElementById("tgbr-<?=$u;?>");

    if(paramGbr.style.display = "none") {
        paramGbr.style.display = "block";
    }else {
        paramGbr.style.display = "none";
    }
}


    document.addEventListener('mouseup', function(e) {
    var hideGbr = document.getElementById('tgbr-<?=$u;?>');
    if (!hideGbr.contains(e.target)) {
        hideGbr.style.display = 'none';
    }
    });
        <?php $u++; ?>
        <?php endforeach; ?>


  var maksud = "<?= $_GET['sortBy']; ?>";
  var hodiBg = document.getElementById('b-link');
  var topiBg = document.getElementById('a-link');
  var tshirtBg = document.getElementById('c-link');

  if (maksud === 'hat'){
      topiBg.style.background = "black";
      topiBg.style.color = "white";
  } else if(maksud === 'hoodie'){
    hodiBg.style.background = "black";
    hodiBg.style.color = "white";
  } else if(maksud === 't-shirt'){
    tshirtBg.style.background = "black";
    tshirtBg.style.color = "white";
  } else {
    topiBg.style.background = "transparent";
    hodiBg.style.background = "transparent";
    tshirtBg.style.background = "transparent";
  }



</script>

</html>