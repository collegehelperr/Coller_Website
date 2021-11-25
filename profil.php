<?php
require ('koneksi.php');
?>

<?php
require ('koneksi.php');
// $email = $_GET['user_fullname'];
session_start();

if(!isset($_SESSION['uid'])){
    $_SESSION['msg'] = 'Anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
}
$sesUid = $_SESSION['uid'];

$sesUid = $_SESSION['uid'];
$query = "SELECT * FROM user WHERE uid='$sesUid'";
$result = mysqli_query($koneksi, $query) or die (mysql_error());
while ($row = mysqli_fetch_array($result)){
    $uid = $row['uid'];
    $userMail = $row['email'];
    $userPass = $row['password'];
    $userName = $row['nama_lengkap'];
    $userNo = $row['no_hp'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <!--Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- CSS sidebar -->
    <link rel="stylesheet" href="style/dashboard/style.css">
    <!-- CSS profil -->
    <link rel="stylesheet" href="style/profil/style_profil.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-1">
        <aside>
            <div class="pos">
                <div class="top">
                <?php
            $sql_kar = mysqli_query($koneksi, "SELECT * FROM user WHERE uid = '$sesUid' ");
            while ($row = mysqli_fetch_array($sql_kar)){
                echo '<div class="profile">
                <img src="' . $row["profile_img"] . '" alt="thumb profile">
                <div class="title align-self-center">
                <h2>'. $row["nama_lengkap"] .'</h2>
                <p>'. $row["email"] .'</p>
                </div>
                <!-- <p>arln_coy@gmail.com</p> -->
            </div>';
            }
            ?>
                    <div class="close" id="close-btn">
                        <span class="material-icons-sharp">close</span>
                    </div>
                </div>
                <div class="sidebar">
                    <a href="dashboard.php">
                        <span class="material-icons-sharp">grid_view</span>
                        <h3>Dashboard</h3>
                    </a>
                    <a href="#">
                        <span class="material-icons-sharp">pie_chart</span>
                        <h3>Wheel Spinner</h3>
                    </a>
                    <a href="college.php">
                        <span class="material-icons-sharp">school</span>
                        <h3>College Management</h3>
                    </a>
                    <hr>
                    <a href="profil.html" class="active">
                        <span class="material-icons-sharp">settings</span>
                        <h3>Edit Profil</h3>
                    </a>
                    <a href="#">
                        <span class="material-icons-sharp">info</span>
                        <h3>Informasi</h3>
                    </a>
                    <a href="logout.php">
                        <span class="material-icons-sharp">transit_enterexit</span>
                        <h3>Keluar</h3>
                    </a>
                </div>
            </div>
        </aside>

        <!-- main content -->
        <main>
            <h1>Overview Profil</h1>
            <!-- card 1 - Jadwal -->
            <div class="card mt-5">
                <div class="card-body">
                <?php
            $sql_kar = mysqli_query($koneksi, "SELECT * FROM user WHERE uid = '$sesUid' ");
            while ($row = mysqli_fetch_array($sql_kar)){
                echo
'                    <img src="'. $row["profile_img"] .'" width="80%" alt="profile">
                    <div class="card-text">
                        <div class="bottom">
                            <p class="profile-title float-start">Nama Lengkap</p>
                            <p class="profile-value float-sm-end">'. $row["nama_lengkap"] .'</p>
                        </div>
                        <hr>

                        <div class="bottom">
                            <p class="profile-title float-start">Email</p>
                            <p class="profile-value float-sm-end">'. $row["email"] .'</p>
                        </div>
                        <hr>

                        <div class="bottom">
                            <p class="profile-title float-start">Nomor Telepon</p>
                            <p class="profile-value float-sm-end">'. $row["no_hp"] .'</p>
                        </div>
                        <hr>

                        <div class="bottom">
                            <p class="profile-title float-start">Password</p>
                            <p class="profile-value float-sm-end" type="hidden">'. $row["password"] .'</p>
                        </div>
                    </div>';
            }
            
                    ?>
                </div>
            </div>
            <a href="profil_edit.php"><button class="btn btn-primary">Edit Profil</button></a>>
            <div class="right">
                <div class="top">
                    <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                    <p class="float-end">13 November 2021</p>
                </div>
            </div>
        </main>
    </div>

    <script>
        const sideMenu = document.querySelector("aside");
        const menuBtn = document.querySelector("#menu-btn");
        const closeBtn = document.querySelector("#close-btn");

        menuBtn.addEventListener('click', () => {
            sideMenu.style.display = 'block';
        })

        closeBtn.addEventListener('click', () => {
            sideMenu.style.display = 'none';
        })
    </script>
</body>

</html>