<?php 

require 'admin/fungsiadmin.php';

if(isset($_POST["signUp"])) {
    if(registrasi($_POST) > 0 ) {
        echo "<script>alert('akun sudah tersimpan. Silahkan Login!')</script>";
        echo "<script>location='login.php'</script>";
        
    }else {
        echo mysqli_error($koneksi);
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <h2>T.D.P SIGN UP</h2>
                <div class="garis"></div>
                <div class="text-box">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="name" name="nameSign">
                    </div>
                    <div class="text-box">
                    <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="email" name="email">
                    </div>

                <div class="text-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="password" name="pass">
                </div>
                <div class="text-box">
                <span style="font-size: 18px;">
                <i class="fas fa-check-square"></i>
                </span>
                    <input type="password" placeholder="confirm password" name="passConfirm">
                </div>

                <div class="btn">
                    <button name="signUp">Sign Up</button>
                    <button  id="closeform">close</button>
                </div>
            </div>
        </form>
        
    </div>
</body>
</html>