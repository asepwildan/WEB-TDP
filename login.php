<?php
session_start();
$koneksi = mysqli_connect("localhost", "root","","project_awal");

if (isset($_SESSION["pelanggan"])) {
    
    header("Location: index.php");
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link class="icon-tab" rel = "icon" href = "img/logo.png" type = "image/x-icon"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T.D.P LOGIN</title>
    <style>
        @import "https://use.fontawesome.com/releases/v5.5.0/css/all.css";

h1 {
    color: red;
    font-size: 90px;
}
body {
   margin: 0;
   padding: 0;
  font-family: sans-serif;
  
  background-size: cover;
   
}

.icon-tab {
    width: 25px;
    height: 25px;
}

.login-box{
    display: block;
    width: 450px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    color: white;
    cursor: pointer;
    text-align: center;
}

.login-box img {
    width: 400px;
}

.login-box img:active {
    
   
    transform: translateY(4px);
}

.login-form {
    
    width: 280px;
    
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    color: white;
   
    text-align: center;
}

.login-form h2 {
    
   
    font-size: 40px;
   color: black;
    padding: 13px 0;
}

.garis {
    width: 180px;
   border-bottom: 6px solid rgb(0, 0, 0);
    margin: 0 auto;
    margin-top: -35px;
    margin-bottom: 30px;
}

.text-box {
    
    width: 100%;
    overflow: hidden;
    border-bottom: 1px solid rgb(0, 0, 0);
    margin-bottom: 10px;
    padding-bottom: 5px;
}

.btn {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 25px;
}

.btn button {
    border: 1px solid rgb(0, 0, 0);
    background: none;
    color: black;
    font-size: 20px;
    padding: 9px;
    width: 100px;
    cursor: pointer;
    outline: none;
}
.btn button:hover {
 font-weight: bold;
    
}


.text-box i {
    width: 26px;
   border-style: solid white;
    text-align: center;
    margin-left: -13px;
    color: black;
}

.text-box input {
    border: none;
    outline: none;
    background: none;
    color: black;
    font-size: 18px;
    margin: 5px 10px;
    
}



    </style>
</head>
<body>
    <div class="login-container">
        <form action="" method="post">
            <div class="login-form" id="log-form">
                <h2>T.D.P LOGIN</h2>
                <div class="garis"></div>
                    <div class="text-box">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="email" name="email">
                    </div>

                <div class="text-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="password" name="pass">
                </div>

                <div class="btn">
                    <button name="login">sign In</button>
                    <button  id="closeform" name="closLog">close</button>
                </div>
            </div>
        </form>
        
    </div>

<?php 
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
            echo "<script>location='checkout.php'</script>";
            exit;
            }else{
                echo "<script>alert('Email/Password salah!')</script>";
                // echo "<script>location='login.php'</script>";
            }
        }
    }

    if(isset($_POST["closLog"])) {
        header("Location: index.php");
    }


?>




</body>
</html>