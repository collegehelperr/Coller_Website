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

if(isset($_POST['update'])){

    $pass = $_POST['txt_pass'];

    if($pass != ""){
        $newpass = $_POST['txt_newpass'];
        $confpass = $_POST['txt_confpass'];

        if($newpass == $confpass){
            if($pass == $userPass){
                $query = "UPDATE `user` SET `password` = '$newpass' WHERE `user`.`uid` = $sesUid;";
                $result = mysqli_query($koneksi, $query);
                header('Location: profil_edit.php');
            } else {
                $error = 'Password salah!!'; // jika user atau password salah maka akan muncul alert
                echo "<script type='text/javascript'>alert('$error');</script>";
            }
        } else {
            $error = 'Field password tidak cocok!!'; // jika user atau password salah maka akan muncul alert
            echo "<script type='text/javascript'>alert('$error');</script>";
        }
    } else {
        $userName = $_POST['nama_lengkap'];
        $userMail = $_POST['email'];
        $userNo = $_POST['nomor_telepon'];

        $query = "UPDATE `user` SET `email` = '$userMail', `nama_lengkap` = '$userName', `no_hp` = '$userNo' WHERE `user`.`uid` = $sesUid;";
        $result = mysqli_query($koneksi, $query);
        header('Location: profil_edit.php');
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
    <link rel="stylesheet" href="style/dashboard/dashboard.css">
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
                    <a href="random_picker.php">
                        <span class="material-icons-sharp">pie_chart</span>
                        <h3>Random Picker</h3>
                    </a>
                    <a href="college.php">
                        <span class="material-icons-sharp">school</span>
                        <h3>College Management</h3>
                    </a>
                    <hr>
                    <a href="profil.php" class="active">
                        <span class="material-icons-sharp">settings</span>
                        <h3>Edit Profil</h3>
                    </a>
                    <a href="informasi.html">
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
            <h1>Edit Akun Profil Anda</h1>
            <!-- card 1 - Jadwal -->
            <h3>Foto Profil</h3>
            <div class="row">
                <div class="top-edit d-md-flex justify-content-center">
                <?php
            $sql_kar = mysqli_query($koneksi, "SELECT * FROM user WHERE uid = '$sesUid' ");
            while ($row = mysqli_fetch_array($sql_kar)){
                echo '<div class="image mx-4">
                    <img src="' . $row["profile_img"] . '" alt="image profile ">
                        </div>';   
                    }
                    ?>
                    <form action="simpan_img.php" method="POST" enctype="multipart/form-data" class="align-self-center">
                        <div class="button my-auto mx-2">
                        </div>                 
                            <!-- <input type="file" name="file" value="Ganti Foto" class="btn btn-secondary"></input> -->
                        <input class="form-control form-control-lg my-3 bg-dark link-light" name="file" value="Ganti Foto" type="file">

                        <input type="submit" name="upload" value="Simpan Foto" class="btn btn-primary float-end">
                            <!-- <button class="btn btn-secondary">Hapus Foto</button> -->
                        </div>
                    </form>
                </div>
                <div class="profil-edit">
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
                                    <input type="password" class="form-control" id="passwordLama" name="txt_pass">
                                </div>
                                <div class="mb-4">
                                    <label for="passwordBaru" class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" id="KonfirmasiPasswordBaru" name="txt_newpass">
                                </div>
                                <div class="mb-4">
                                    <label for="konfirmasiPasswordBaru" class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" id="KonfirmasiPasswordBaru" name="txt_confpass">
                                </div>
                            </div>
                        </div>
                        <div class="d-md-flex justify-content-center mt-4">
                            <button class="btn btn-danger mb-sm-3 mx-md-2">Batalkan Perubahan</button>
                            <button class="btn btn-success mx-md-2" name="update" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
                <div class="right">
                    <div class="top">
                        <button id="menu-btn">
                            <span class="material-icons-sharp">menu</span>
                        </button>
                        <?php
                        $today = date(" j F Y ");
                        echo 
                        '<p class="float-end d-md-none">'.$today.'</p>';
                        ?>
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
