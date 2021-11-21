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

if(isset($_POST['update'])){
    $userName = $_POST['nama_lengkap'];
    $userMail = $_POST['email'];
    $userNo = $_POST['nomor_telepon'];
    $userPass = $_POST['password'];

    $query = "UPDATE `user` SET `email` = '$userMail', `nama_lengkap` = '$userName', `nomor_telepon` = '$userNo' WHERE `user`.`uid` = $sesUid;";
    $result = mysqli_query($koneksi, $query);
    header('Location: profil_edit.php');
}

$sesUid = $_SESSION['uid'];
$query = "SELECT * FROM user WHERE uid='$sesUid'";
$result = mysqli_query($koneksi, $query) or die (mysql_error());
while ($row = mysqli_fetch_array($result)){
    $uid = $row['uid'];
    $userMail = $row['email'];
    $userPass = $row['password'];
    $userName = $row['nama_lengkap'];
    $userNo = $row['nomor_telepon'];
}

if(isset($_POST['update'])){
    $userPass = $_POST['password'];
    $newPasssword = $_POST['newpassword'];

    if($userPass == $userPass){
        $query = "UPDATE `user` SET `password` = '$newpassword' WHERE `user`.`uid` = $sesUid;";
        $result = mysqli_query($koneksi, $query);
        $num = mysqli_num_rows($result);
        
        while($row = mysqli_fetch_array($result)){
            $newPasssword = $row['password'];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <!--Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- CSS sidebar -->
    <link rel="stylesheet" href="style/dashboard/style.css">
    <!-- CSS profil -->
    <link rel="stylesheet" href="style/profil-edit/style_profil_edit.css">

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
                    <a href="#">
                        <span class="material-icons-sharp">school</span>
                        <h3>College Management</h3>
                    </a>
                    <hr>
                    <a href="#" class="active">
                        <span class="material-icons-sharp">settings</span>
                        <h3>Edit Profil</h3>
                    </a>
                    <a href="#">
                        <span class="material-icons-sharp">info</span>
                        <h3>Informasi</h3>
                    </a>
                    <a href="login.php">
                        <span class="material-icons-sharp">transit_enterexit</span>
                        <h3>Keluar</h3>
                    </a>
                </div>
            </div>
        </aside>

        <!-- main content -->
        <main>
            <h1>Edit Akun Profil Anda</h1>
            <!-- card 1 - Jadwal -->
            <h3>Foto Profil</h3>
            <div class="row">
                <!-- <div class="col">
                    <img src="img/thumb_profile.png" alt="image profile">
                </div>
                <div class="col">
                    <div class="">
                        <button class="btn btn-primary">Ganti Foto</button>
                        <br>
                        <button class="btn btn-secondary">Hapus Foto</button>
                    </div>
                </div>
            </div> -->
                <div class="top-edit d-md-flex justify-content-center">
                <?php
            $sql_kar = mysqli_query($koneksi, "SELECT * FROM user WHERE uid = '$sesUid' ");
            while ($row = mysqli_fetch_array($sql_kar)){
                echo '<div class="image mx-4">
                    <img src="' . $row["profile_img"] . '" alt="image profile ">
                        </div>';   }
                    ?>
                    <div class="button my-auto mx-2">                 
                        <button class="btn btn-primary" >Ganti Foto</button>
                        <br>
                        <button class="btn btn-secondary">Hapus Foto</button>
                    </div>
                </div>
                <form action="profil_edit.php" method="POST">
                    <div class="row">
                        <div class="col-md">
                            <h3>Data Diri</h3>
                            <div class="mb-4">
                                <label for="inputNama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $userName; ?>">
                            </div>
                            <div class="mb-4">
                                <label for="inputEmail" required class="form-label">Email</label>
                                <input type="text" name="email" required class="form-control"  value="<?php echo $userMail; ?>">
                            </div>
                            <div class="mb-4">
                                <label for="inputTelepon" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="inputTelepon" name="nomor_telepon" value="<?php echo $userNo; ?>">
                            </div>
                        </div>
                        <div class="col-md">
                            <h3>Ganti Password</h3>
                            <div class="mb-4">
                                <label for="passwordLama" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passwordLama" name="password">
                            </div>
                            <div class="mb-4">
                                <label for="passwordBaru" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="KonfirmasiPasswordBaru" name="newpassword">
                            </div>
                            <div class="mb-4">
                                <label for="konfirmasiPasswordBaru" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="KonfirmasiPasswordBaru" new="newpassword">
                            </div>
                        </div>
                    </div>
                    <div class="d-md-flex justify-content-center mt-4">
                        <button class="btn btn-danger mb-sm-3 mx-md-2">Batalkan Perubahan</button>
                        <button class="btn btn-success mx-md-2" name="update" type="submit">Simpan Perubahan</button>
                    </div>
                    <!-- <div class="row">
                    <div class="col"><button class="btn btn-danger float-md-end float-sm-start mb-sm">Batalkan Perubahan</button></div>
                    <div class="col"><button class="btn btn-success">Simpan Perubahan</button></div>
                </div> -->
                </form>

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
