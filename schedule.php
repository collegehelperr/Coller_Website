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

if ( isset($_POST['submit']) ){
    $nama_schedule = $_POST ['txt_jadwal'];
    $hari = $_POST ['hari'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_berakhir'];

    $query = "INSERT INTO college_schedule VALUES ('', '$sesUid','$hari','$waktu_mulai','$waktu_selesai','$nama_schedule')";
    $result = mysqli_query($koneksi, $query);
    header('Location: schedule.php?hari='.$hari);

    

}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Management</title>
    <!--Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- CSS sidebar -->
    <link rel="stylesheet" href="style/dashboard/style.css">
    <!-- CSS profil -->
    <link rel="stylesheet" href="style/schedule/style_schedule.css">

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
                    <a href="college.php" class="active">
                        <span class="material-icons-sharp">school</span>
                        <h3>College Management</h3>
                    </a>
                    <hr>
                    <a href="profil.php">
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
            <h1 class="main-title">College Management <span>.</span></h1>
            <div class="row">
                <div class="col">
                    <p>Membantumu dalam mengelola urusan perkuliahan</p>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb" class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="college.php">College Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Schedule</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <?php
            if ($_GET['hari']== 'Senin'){
                echo '
                <!-- section nav hari -->
                <div class="section-nav-hari">
                    <nav class="nav nav-day my-5">
                        <a class="nav-link active" aria-current="page" href="schedule.php?hari=Senin">Senin</a>
                        <a class="nav-link" href="schedule.php?hari=Selasa">Selasa</a>
                        <a class="nav-link" href="schedule.php?hari=Rabu">Rabu</a>
                        <a class="nav-link" href="schedule.php?hari=Kamis">Kamis</a>
                        <a class="nav-link" href="schedule.php?hari=Jumat">Jumat</a>
                        <a class="nav-link" href="schedule.php?hari=Sabtu">Sabtu</a>
                        <a class="nav-link" href="schedule.php?hari=Minggu">Minggu</a>
                    </nav>
                </div>
                ';
            } elseif ($_GET['hari']== 'Selasa'){
                echo '
                <!-- section nav hari -->
                <div class="section-nav-hari">
                    <nav class="nav nav-day my-5">
                        <a class="nav-link" href="schedule.php?hari=Senin">Senin</a>
                        <a class="nav-link active" aria-current="page" href="schedule.php?hari=Selasa">Selasa</a>
                        <a class="nav-link" href="schedule.php?hari=Rabu">Rabu</a>
                        <a class="nav-link" href="schedule.php?hari=Kamis">Kamis</a>
                        <a class="nav-link" href="schedule.php?hari=Jumat">Jumat</a>
                        <a class="nav-link" href="schedule.php?hari=Sabtu">Sabtu</a>
                        <a class="nav-link" href="schedule.php?hari=Minggu">Minggu</a>
                    </nav>
                </div>
                ';
            }elseif ($_GET['hari']== 'Rabu'){
                echo '
                <!-- section nav hari -->
                <div class="section-nav-hari">
                    <nav class="nav nav-day my-5">
                        <a class="nav-link" href="schedule.php?hari=Senin">Senin</a>
                        <a class="nav-link" href="schedule.php?hari=Selasa">Selasa</a>
                        <a class="nav-link active" aria-current="page" href="schedule.php?hari=Rabu">Rabu</a>
                        <a class="nav-link" href="schedule.php?hari=Kamis">Kamis</a>
                        <a class="nav-link" href="schedule.php?hari=Jumat">Jumat</a>
                        <a class="nav-link" href="schedule.php?hari=Sabtu">Sabtu</a>
                        <a class="nav-link" href="schedule.php?hari=Minggu">Minggu</a>
                    </nav>
                </div>
                ';
            }elseif ($_GET['hari']== 'Kamis'){
                echo '
                <!-- section nav hari -->
                <div class="section-nav-hari">
                    <nav class="nav nav-day my-5">
                        <a class="nav-link" href="schedule.php?hari=Senin">Senin</a>
                        <a class="nav-link" href="schedule.php?hari=Selasa">Selasa</a>
                        <a class="nav-link" href="schedule.php?hari=Rabu">Rabu</a>
                        <a class="nav-link active" aria-current="page" href="schedule.php?hari=Kamis">Kamis</a>
                        <a class="nav-link" href="schedule.php?hari=Jumat">Jumat</a>
                        <a class="nav-link" href="schedule.php?hari=Sabtu">Sabtu</a>
                        <a class="nav-link" href="schedule.php?hari=Minggu">Minggu</a>
                    </nav>
                </div>
                ';
            }elseif ($_GET['hari']== 'Jumat'){
                echo '
                <!-- section nav hari -->
                <div class="section-nav-hari">
                    <nav class="nav nav-day my-5">
                        <a class="nav-link" href="schedule.php?hari=Senin">Senin</a>
                        <a class="nav-link" href="schedule.php?hari=Selasa">Selasa</a>
                        <a class="nav-link" href="schedule.php?hari=Rabu">Rabu</a>
                        <a class="nav-link" href="schedule.php?hari=Kamis">Kamis</a>
                        <a class="nav-link active" aria-current="page" href="schedule.php?hari=Jumat">Jumat</a>
                        <a class="nav-link" href="schedule.php?hari=Sabtu">Sabtu</a>
                        <a class="nav-link" href="schedule.php?hari=Minggu">Minggu</a>
                    </nav>
                </div>
                ';
            }elseif ($_GET['hari']== 'Sabtu'){
                echo '
                <!-- section nav hari -->
                <div class="section-nav-hari">
                    <nav class="nav nav-day my-5">
                        <a class="nav-link" href="schedule.php?hari=Senin">Senin</a>
                        <a class="nav-link" href="schedule.php?hari=Selasa">Selasa</a>
                        <a class="nav-link" href="schedule.php?hari=Rabu">Rabu</a>
                        <a class="nav-link" href="schedule.php?hari=Kamis">Kamis</a>
                        <a class="nav-link" href="schedule.php?hari=Jumat">Jumat</a>
                        <a class="nav-link active" aria-current="page" href="schedule.php?hari=Sabtu">Sabtu</a>
                        <a class="nav-link" href="schedule.php?hari=Minggu">Minggu</a>
                    </nav>
                </div>
                ';
            }elseif ($_GET['hari']== 'Minggu'){
                echo '
                <!-- section nav hari -->
                <div class="section-nav-hari">
                    <nav class="nav nav-day my-5">
                        <a class="nav-link" href="schedule.php?hari=Senin">Senin</a>
                        <a class="nav-link" href="schedule.php?hari=Selasa">Selasa</a>
                        <a class="nav-link" href="schedule.php?hari=Rabu">Rabu</a>
                        <a class="nav-link" href="schedule.php?hari=Kamis">Kamis</a>
                        <a class="nav-link" href="schedule.php?hari=Jumat">Jumat</a>
                        <a class="nav-link" href="schedule.php?hari=Sabtu">Sabtu</a>
                        <a class="nav-link active" aria-current="page" href="schedule.php?hari=Minggu">Minggu</a>
                    </nav>
                </div>
                ';
            }
            ?>


            <!-- section menu -->
            <div class="card mb-5">
                <div class="card-body text-light">
                    <div class="row title-schedule mb-5">
                        <div class="col-4">Waktu</div>
                        <div class="col-6">Jadwal</div>
                        <div class="col-2"></div>
                    </div>
                    <div class="row text-secondary mb-1">
                    <?php
            $hari = $_GET ['hari'];
            $sql_kar = mysqli_query($koneksi, "SELECT * FROM college_schedule WHERE hari = '$hari' ");
            while ($row = mysqli_fetch_array($sql_kar)){
                echo'
                <div class="row text-secondary">
                <div class="col-4">
                    <p>'. $row["waktu_mulai"] .' - '. $row["waktu_berakhir"] .'</p>
                </div>
                <div class="col-6">
                    <p>'. $row["nama_schedule"] .'</p>
                </div>
                
                <div class="col-2">
                <a href="delete_schedule.php?id_schedule='.$row["id_schedule"].'&hari='.$row["hari"].'"><img src="img/Close_square.png" class="float-end" alt="ic_close"></a>
                </div>
            </div>
                ';
                    }
                    ?>
                    </div>

                </div>
            </div>

            <!-- section input -->
            <h2 class="mb-3">Input:</h2>
            <form action="schedule.php" method="POST">
                <div class="row">
                    <div class="col-md">
                        <div class="mb-4">
                            <label for="day" class="text-secondary">Hari</label>
                            <select id="inputHari" class="form-select" name="hari">
                                <option>Senin</option>
                                <option>Selasa</option>
                                <option>Rabu</option>
                                <option>Kamis</option>
                                <option>Jumat</option>
                                <option>Sabtu</option>
                                <option>Minggu</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="namaJadwal" class="text-secondary">Nama Jadwal</label>
                            <input type="text" class="form-control" name="txt_jadwal" placeholder="...">
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="mb-4">
                            <label for="waktuMulai" class="text-secondary">Waktu Mulai</label>
                            <input type="time" class="form-control" id="waktuMulai" name="waktu_mulai">
                        </div>
                        <div class="mb-4">
                            <label for="waktuBerakhir" class="text-secondary">Waktu Berakhir</label>
                            <input type="time" class="form-control" id="waktuBerakhir" name="waktu_berakhir">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary float-end mt-4" name="submit">Simpan</button>
            </form>


            <!-- for mobile -->
            <div class="right">
                <div class="top">
                    <button id="menu-btn">
                        <span class="material-icons-sharp">menu</span>
                    </button>
                    <p class="float-end d-md-none">13 November 2021</p>
                </div>
            </div>
        </main>
    </div>

    <script>
        // for mobile responsive
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