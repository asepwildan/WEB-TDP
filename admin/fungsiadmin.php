<?php 

$koneksi = mysqli_connect("localhost","root","","project_awal");

function query($tampung_query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $tampung_query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($tampung_query_tambah) {
    global $koneksi;

    $nama = htmlspecialchars($tampung_query_tambah["nama"]);
    $warna = htmlspecialchars($tampung_query_tambah["warna"]);
    $size = htmlspecialchars($tampung_query_tambah["size"]);
    $bahan = htmlspecialchars($tampung_query_tambah["bahan"]);
    $kategori = htmlspecialchars($tampung_query_tambah["kategori"]);
    $harga = htmlspecialchars($tampung_query_tambah["harga"]);
    // $gambar = htmlspecialchars($tampung_query_tambah["gambar"]);
    $kode_produk = htmlspecialchars($tampung_query_tambah["kode"]);

    $gambar = upload();

    if(!$gambar) {
        return false;
    }


    if($tampung_query_tambah["kategori"] == 'HAT'){
    $query_insert = "INSERT INTO hat VALUES
        ('',
        '$kode_produk',
        '$nama',
        '$kategori',
        '$bahan',
        '$size',
        '$warna',
        '$gambar',
        '$harga'
    )";
    }elseif($tampung_query_tambah["kategori"] == 'HOODIE'){
        $query_insert = "INSERT INTO katalog_depan VALUES
        ('',
        '$kode_produk',
        '$nama',
        '$warna',
        '$kategori',
        '$bahan',
        '$size',
        '$gambar',
        '$harga'
        )";
    }else{
        $query_insert = "INSERT INTO tshirt VALUES
        ('',
        '$kode_produk',
        '$nama',
        '$kategori',
        '$bahan',
        '$size',
        '$warna',
        '$gambar',
        '$harga'
        )";
    }

    mysqli_query($koneksi,$query_insert);
    return mysqli_affected_rows($koneksi);
}


function upload(){
   $nama_poto = $_FILES['gambar']['name'];
   $ukuran_poto = $_FILES['gambar']['size'];
   $simpan_tmp = $_FILES['gambar']['tmp_name'];
   $error_poto = $_FILES['gambar']['error'];

        //    cek gambar ada atau tidak
    if($error_poto === 4) {
        echo  "<script>
                    alert('upload poto dahulu kawan!');
   
                </script>";
        return false;
    }

    $ekstensi_poto_cek = ['jpg','jpeg','png'];
    $ekstensi_poto = explode('.',$nama_poto);
    $ekstensi_poto = strtolower(end($ekstensi_poto));


            //    cek ekstensi gambar benar atau tidak
        if(!in_array($ekstensi_poto, $ekstensi_poto_cek)) {
            echo  "<script>
                    alert('upload yang benar kawan!');
       
                    </script>";
            return false;
        }

        //    cek size gambar
        if($ukuran_poto > 3000078) {
            echo  "<script>
                        alert('max size photo 2MB ');
                    </script>";
            return false;
        }

        // handle nama poto yg sama

        $nama_poto_baru = current(explode('.',$nama_poto));
        $nama_poto_baru .= uniqid();
        $nama_poto_baru .= '.';
        $nama_poto_baru .= $ekstensi_poto;

        // lolos pengecekan

        move_uploaded_file($simpan_tmp,'../img/'.$nama_poto_baru);
        return $nama_poto_baru;
}


function hapus($id,$kategori) {
    global $koneksi;

    if($kategori == "HAT") {
        $q_delete = "DELETE FROM hat WHERE id = $id";
    }elseif($kategori == "HOODIE") {
        $q_delete = "DELETE FROM katalog_depan WHERE id = $id";
    }else{
        $q_delete = "DELETE FROM tshirt WHERE id = $id";
    }

    mysqli_query($koneksi,$q_delete);
    return mysqli_affected_rows($koneksi);
}


function edit($tampung_query_edit) {
    global $koneksi;

    $id = $tampung_query_edit["id"];
    $kode = htmlspecialchars($tampung_query_edit["kode"]);
    $nama = htmlspecialchars($tampung_query_edit["nama"]);
    $warna = htmlspecialchars($tampung_query_edit["warna"]);
    $kategori = htmlspecialchars($tampung_query_edit["kategori"]);
    $bahan = htmlspecialchars($tampung_query_edit["bahan"]);
    $ukuran = htmlspecialchars($tampung_query_edit["size"]);
   

    $harga = htmlspecialchars($tampung_query_edit["harga"]);
    $potoLama = htmlspecialchars($tampung_query_edit["potoLama"]);
    
    if($_FILES['gambar']['error'] === 4){
        $gambar = $potoLama;
    }else {
        $gambar = upload();
    }
   


    if($kategori == "HOODIE"){
        $query_insert_edit = "UPDATE katalog_depan SET
        kode = '$kode',
        nama = '$nama',
        warna = '$warna',
        kategori = '$kategori',
        bahan = '$bahan',
        size = '$ukuran',
        gambar = '$gambar',
        harga = '$harga'
        WHERE id = $id ";
    }elseif($kategori == "HAT"){
        $query_insert_edit = "UPDATE hat SET
        kode = '$kode',
        nama = '$nama',
        kategori = '$kategori',
        bahan = '$bahan',
        size = '$ukuran',
        warna = '$warna',
        gambar = '$gambar',
        harga = '$harga'
        WHERE id = $id ";
    }else{
        $query_insert_edit = "UPDATE tshirt SET
        kode = '$kode',
        nama = '$nama',
        kategori = '$kategori',
        bahan = '$bahan',
        size = '$ukuran',
        warna = '$warna',
        gambar = '$gambar',
        harga = '$harga'
        WHERE id = $id ";
    }

    mysqli_query($koneksi,$query_insert_edit);

    return mysqli_affected_rows($koneksi);
}

function rupiah ($ambil_harga) {
    $hasil = 'Rp ' . number_format($ambil_harga, 2, ",", ".");
    return $hasil;
}

// function cari($kata_kunci){
  
//     $produk_anchor = $kata_kunci['wadidas'];
//     if($produk_anchor == "HOODIE"){
//     $query_cari = "SELECT * FROM katalog_depan WHERE 
//     nama LIKE '%$kata_kunci%' OR
//     kode LIKE '%$kata_kunci%' OR
//     bahan LIKE '%$kata_kunci%' OR
//     warna LIKE '%$kata_kunci%' OR
//     harga LIKE '%$kata_kunci%'
//      ";
//     }elseif($produk_anchor == "HAT"){
//         $query_cari = "SELECT * FROM hat WHERE 
//         nama LIKE '%$kata_kunci%' OR
//         kode LIKE '%$kata_kunci%' OR
//         bahan LIKE '%$kata_kunci%' OR
//         warna LIKE '%$kata_kunci%' OR
//         harga LIKE '%$kata_kunci%'
//         ";
//     }else {
//         $query_cari = "SELECT * FROM tshirt WHERE 
//     nama LIKE '%$kata_kunci%' OR
//     kode LIKE '%$kata_kunci%' OR
//     bahan LIKE '%$kata_kunci%' OR
//     warna LIKE '%$kata_kunci%' OR
//     harga LIKE '%$kata_kunci%'
//     ";
//     }
//     return query($query_cari);
// }

// function cari($kata_kunci){
//     $query_cari = "SELECT * FROM katalog_depan WHERE 
//      nama LIKE '%$kata_kunci%' OR
//     kode LIKE '%$kata_kunci%' OR
//      bahan LIKE '%$kata_kunci%' OR
//      warna LIKE '%$kata_kunci%' OR
//      harga LIKE '$kata_kunci%'
//      ";
// return query($query_cari);
// }

function registrasi($data_cust) {
    global $koneksi;

    $name_cust = $data_cust["nameSign"];
    $email_cust = strtolower(stripslashes($data_cust["email"]));
    $password_cust = mysqli_real_escape_string($koneksi,$data_cust["pass"]);
    $password_confirm = mysqli_real_escape_string($koneksi,$data_cust["passConfirm"]);

    if($password_cust !== $password_confirm) {
        echo "<script>alert('konfirmasi password salah')</script>";
        return false;
    }

    // cek email sudah terdaftar atau belum 

    $cek_email = mysqli_query($koneksi,"SELECT email FROM tb_cust WHERE email = '$email_cust'");
     
    if(mysqli_fetch_assoc($cek_email)){
        echo "<script>alert('email sudah terdaftar')</script>";
        return false;
    }

    
    // enkrip pass
    $password_cust = password_hash($password_cust, PASSWORD_DEFAULT);

    // insert user baru

    mysqli_query($koneksi,"INSERT INTO tb_cust VALUES('','$name_cust','$email_cust','$password_cust','','')");
    return mysqli_affected_rows($koneksi);

}


?>