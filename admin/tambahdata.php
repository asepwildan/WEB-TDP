<?php

require 'fungsiadmin.php';

if(isset($_POST['submit'])) {

    if(tambah($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil ditambahkan');
            document.location.href = 'admin.php';
        </script>";
    }else {
        echo "
        <script>
            alert('data gagal ditambahkan');
            document.location.href = 'admin.php';
        </script>";
    }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style-edit.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Tambah Produk</title>
</head>

<body>
    <header>TAMBAH PRODUK</header>
    <div class="edit">

        <div class="sample-edit-tambah" id="containerPreview">
            <div class="sample-edit-box-tambah" id="sampleEditBoxTambah">
                <img src="" alt="" id="gambar-preview">
            </div>
            <div id="preview-img-text">
                <p>PREVIEW<br>IMAGE</p>
            </div>
            <p></p>
        </div>

        <div class="form-edit">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="input-field">
                    <label for="kategori">Kategori Produk</label>
                    <select id="kategori" name="kategori" required>
                        <option value="">Pilih Kategori</option>
                        <option value="HOODIE">HOODIE</option>
                        <option value="HAT">HAT</option>
                        <option value="T-shirt">T-shirt</option>
                    </select>
                </div>



                <div class="input-field">
                    <label for="nama">Nama produk </label>
                    <input type="text" name="nama" id="nama" required>
                </div>

                <div class="input-field">
                    <label for="kode_produk">Kode Produk</label>
                    <input type="text" name="kode" id="kode_produk" placeholder="example: HB1 (hoodie black)">
                </div>

                <div class="input-field">
                    <label>Ukuran produk </label>
                    <div class="cek">
                        <div class="cek-btn">
                            <input type="checkbox" id="small" value="S" name="size">
                            <label for="small">Small</label>
                        </div>
                        <div class="cek-btn">
                            <input type="checkbox" name="size" id="medium" value="M">
                            <label for="medium">Medium</label>
                        </div>

                        <div class="cek-btn">
                            <input type="checkbox" name="size" id="large" value="L">
                            <label for="large">Large</label>
                        </div>
                    </div>
                </div>

                <div class="input-field">
                    <label for="bahan_produk">Bahan produk </label>
                    <input type="text" name="bahan" id="bahan_produk" placeholder="combet 3s">
                </div>

                <div class="input-field">
                    <label for="warna">Warna produk </label>
                    <input type="text" name="warna" id="warna" placeholder="Hitam Kelam" required>
                </div>

                <div class="input-field">
                    <label for="gambar">Gambar produk </label>
                    <input type="file" name="gambar" id="gambar">
                </div>

                <div class="input-field">
                    <label for="harga">Harga produk </label>
                    <input type="text" name="harga" id="harga" placeholder="Rp.350.000,00-">
                </div>


                <div class="input-deskripsi">
                    <label for="deskripsi">Deskripsi produk </label>
                    <input type="text" name="deskripsi" id="deskripsi"
                        placeholder="Sering digunakan oleh penakluk wanita">
                </div>

                <button type="submit" name="submit">SAVE</button>

            </form>

        </div>


    </div>


    <script>
        $(document).on('click', 'input[type="checkbox"]', function () {
            $('input[type="checkbox"]').not(this).prop('checked', false);
        });

        const inputGbr = document.getElementById("gambar");
        const containerPrev = document.getElementById("containerPreview");
        const previewContainer = document.getElementById("sampleEditBoxTambah");
        const previewImage = document.getElementById("gambar-preview");
        const previewDefaultText = document.getElementById("preview-img-text");

        inputGbr.addEventListener("change", function(){
            const filePrevGbr = this.files[0];

            if(filePrevGbr) {
                const readerGbr = new FileReader();

                previewDefaultText.style.display = "none";
                previewContainer.style.display = "block";
                containerPrev.style.border = "2px solid rgba(104, 104, 104,0.0)";

                readerGbr.addEventListener("load", function(){
                   
                    previewImage.setAttribute("src", this.result);

                });
                    readerGbr.readAsDataURL(filePrevGbr);
            }else{
                previewDefaultText.style.display = "block";
                previewContainer.style.display = "none";
                containerPrev.style.border = "2px solid rgb(104, 104, 104)";
                previewImage.setAttribute("src", "");
            }
        });

    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

</body>

</html>