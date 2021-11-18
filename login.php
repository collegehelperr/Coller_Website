<?php
require ('koneksi.php');

session_start();

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if(!empty(trim($email)) && !empty(trim($pass))){
        $query = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($koneksi, $query);
        $num = mysqli_num_rows($result);
        
        while($row = mysqli_fetch_array($result)){
            $uid = $row['uid'];
            $userVal =  $row['email'];
            $passVal = $row['password'];
        }

        if ($num != 0){
            if($userVal==$email && $passVal==$pass){
                $_SESSION['uid'] = $uid;
                $_SESSION['name'] = $userName;
                header('Location: home.php?');
            } else {
                $error = 'User atau password salah !!'; // jika user atau password salah maka akan muncul alert
                echo "<script type='text/javascript'>alert('$error');</script>";
            }
        } else {
            $error = 'User tidak ditemukan !!'; // jika user tidak terdaftar pada database maka akan muncul alert
            echo "<script type='text/javascript'>alert('$error');</script>";
        }
    } else {
        $error = 'Data tidak boleh kosong !!'; // jika field tidak di isi atau kosong maka akan muncul alert
        echo "<script type='text/javascript'>alert('$error');</script>";
    }
}
?>

<html>
<head>
    <title>Login Page </title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
</head>
<body>

    <main>
    <div class="container main">
        <div class="row">
            <div class="col left">
                <img src="img/login.png" class="float-end mt-5" alt="login">
            </div>
            <div class="col right p-5">
                <div class="container-fluid">
                    <h1>Selamat Datang!</h1>
                    <p class="sub-title">Masukkan email dan password Anda</p>
                </div>
                <form action="login.php" method="POST" class="container-fluid">
                    <div class="mb-4">
                        <input type="text" name="email" placeholder="Email address" class="form-control">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <p class="register-at-login text-center">Belum memiliki akun? <a href="register.php">Daftar</a></p>
                    <button type="submit" name="submit" class="btn btn-primary container-fluid">Log-in</button>
                </form>
            </div>
        </div>
    </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html> 