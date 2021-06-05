<?php 

$koneksi = mysqli_connect("localhost","root","","project_awal");

function query($tampungquery){
    global $koneksi;
    $panggil_datadb = mysqli_query($koneksi,$tampungquery);
    $query_hasil_tampung = [];

    while($tampil_data = mysqli_fetch_assoc($panggil_datadb)) {

        $query_hasil_tampung[] = $tampil_data;
    }

    return $query_hasil_tampung;
}






function edit($tampung_query_edit) {
    global $koneksi;

    $id = $tampung_query_edit["id"];
    $nama = htmlspecialchars($tampung_query_edit["nama"]);
    $warna = htmlspecialchars($tampung_query_edit["warna"]);
    $kategori = htmlspecialchars($tampung_query_edit["jenis"]);
    $bahan = htmlspecialchars($tampung_query_edit["bahan"]);
    $ukuran = htmlspecialchars($tampung_query_edit["ukuran"]);
    $gambar = htmlspecialchars($tampung_query_edit["gambar"]);

    $query_insert_edit = "UPDATE katalog_depan SET
    nama = '$nama',
    warna = '$warna',
    jenis = '$kategori',
    bahan = '$bahan',
    ukuran = '$ukuran',
    gambar = '$gambar'
    WHERE id = $id    ";

    mysqli_query($koneksi,$query_insert_edit);

    return mysqli_affected_rows($koneksi);
}

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