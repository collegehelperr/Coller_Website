<?php
require('koneksi.php');

if ( isset($_POST['register']) ){
    $userMail = $_POST['email'];
    $userPass = $_POST['password'];
    $userConPass = $_POST['conpass'];
    $userName = $_POST['nama_lengkap'];
    $userNo = $_POST['nomor_telepon'];

    if($userPass == $userConPass){
    $query = "INSERT INTO user VALUES ('', '$userMail', '$userPass', '$userName', '$userNo','https://i0.wp.com/lia-martadinata.com/wp-content/uploads/2019/11/iconfinder-8-avatar-2754583_120515.png?ssl=1')";
    $result = mysqli_query($koneksi, $query);
    if($result){
            echo "<script>alert('Berhasil Mendaftar.')</script>";
    header('Location: login.php');
    }
    }else{
        echo "<script>alert('Password tidak cocok.')</script>";
    }
}
?>

<html>

<head>
    <title>Register Page </title>
    <link rel="stylesheet" href="style/login-register/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
</head>

<body>
    <main>
        <div class="row">
            <div class="col register-left">
                <div class="title">
                    <h1>Yuk gabung & <br>
                        buat akun baru!
                    </h1>
                    <p>Kami hadir untuk membantumu di kehidupan perkuliahan</p>
                    <div class="register">
                        <img src="img/register.png" alt="register">
                    </div>
                    <div class="flower bottom-0 start-0">
                        <img src="img/flower-register.png" alt="flower">
                    </div>
                </div>
            </div>
            <div class="col register-right position-relative">
                <form action="register.php" method="POST" class="box">
                    <div class="mb-4">
                        <input type="email" id="email" name="email" required class="form-control text-light" placeholder="Email">
                    </div>
                    <div class="mb-4">
                        <input type="password" name="password" required class="form-control text-light" placeholder="Password">
                    </div>
                    <div class="mb-4">
                        <input type="password" name="conpass" required class="form-control text-light" placeholder="Konfirmasi Password">
                    </div>
                    <div><center>tentang kamu</center></div>
                    <p></p>
                    <div class="mb-4">
                        <input type="text" name="nama_lengkap" required class="form-control text-light" placeholder="Nama Lengkap">
                    </div>
                    <div class="mb-4">
                        <input type="text" name="nomor_telepon" required class="form-control text-light" placeholder="No Telepon">
                    </div>
                    <p class="login-at-register text-center">Sudah memiliki akun? <a href="login.php">Masuk</a></p>
                    <button type="submit" name="register" class="btn btn-primary container-fluid">Daftar</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>