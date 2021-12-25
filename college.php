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

$hari = date('l');
$hari_indo = array('Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu');
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
    <link rel="stylesheet" href="style/dashboard/dashboard.css">
    <!-- CSS profil -->
    <link rel="stylesheet" href="style/college/style_college.css">

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
            <p>Membantumu dalam mengelola urusan perkuliahan</p>

            <!-- section informasi -->
            <div class="row mt-5">
                <div class="col">
                    <a href="task.php">
                        <div class="card card-1">
                            <div class="row card-body">
                                <h1 class="col-3 card-title">
                                <?php
                                $query = "SELECT * FROM college_task WHERE uid = '$sesUid' and status = 0";
                                $result = mysqli_query($koneksi, $query) or die (mysql_error());
                                $total_schedule = mysqli_num_rows($result);
                                echo $total_schedule;
                                    ?>
                                    </h5>
                                    <div class="col card-content my-auto">
                                        <h3>Task</h3>
                                        <p>Belum terselesaikan</p>
                                    </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                <?php
                    echo '<a href="schedule.php?hari='.$hari_indo[$hari].'">'
                    ?>
                        <div class="card card-2">
                            <div class="row card-body">
                                <h1 class="col-3 card-title">
                                    <?php
                                $query = "SELECT * FROM college_schedule WHERE hari = '$hari_indo[$hari]' AND uid='$sesUid' ";
                                $result = mysqli_query($koneksi, $query) or die (mysql_error());
                                $total_schedule = mysqli_num_rows($result);
                                echo $total_schedule;
                                    ?>
                                </h5>
                                    <div class="col card-content my-auto">
                                        <h3>Schedule</h3>
                                        <p>Untuk hari ini</p>
                                    </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="todolist.php">
                        <div class="card card-3">
                            <div class="row card-body">
                            <h1 class="col-3 card-title">
                                    <?php
                                $query = "SELECT * FROM college_todolist WHERE uid='$sesUid' AND status = 0";
                                $result = mysqli_query($koneksi, $query) or die (mysql_error());
                                $total_schedule = mysqli_num_rows($result);
                                echo $total_schedule;
                                    ?>
                                </h5>
                                    <div class="col card-content my-auto">
                                        <h3>To do list</h3>
                                        <p>Belum terselesaikan</p>
                                    </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- section menu -->
            <div class="section-menu">

                <div class="on-default">
                    <h1 class="mt-5">Menu</h1>
                    <div class="row">
                        <div class="col">
                            <a href="note.php">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="img/ic_note.png" alt="ic_note">
                                        <h5 class="card-title">Notes</h5>
                                        <p>Catatan penting</p>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="schedule.php?hari=Senin">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="img/ic_schedule.png" alt="ic_note">
                                        <h5 class="card-title">Schedule</h5>
                                        <p>Jadwal perkuliahan</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row mt-md-3">
                        <div class="col">
                            <a href="task.php">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="img/ic_task.png" alt="ic_note">
                                        <h5 class="card-title">Task</h5>
                                        <p>Daftar kuis, tugas, dan lain-lain</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="todolist.php">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="img/ic_todolist.png" alt="ic_note">
                                        <h5 class="card-title">To do list</h5>
                                        <p>Daftar yang harus dilakukan</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="on-mobile d-md-none mt-5">
                    <div class="row">
                        <div class="col text-center">
                            <a href="note.php">
                                <p>Notes</p>
                                <img src="img/ic_notes_mobile.png" class="mx-auto" alt="notes">

                            </a>
                        </div>
                        <div class="col text-center">
                            <a href="schedule.php?hari=Senin">
                                <p>Schedule</p>
                                <img src="img/ic_schedule_mobile.png" class="mx-auto" alt="schedule">
                            </a>
                        </div>
                        <div class="col text-center">
                            <a href="task.html">
                                <p>Task</p>
                                <img src="img/ic_task_mobile.png" class="mx-auto" alt="task">
                            </a>
                        </div>
                        <div class="col text-center">
                            <a href="todolist.php">
                                <p>To do list</p>
                                <img src="img/ic_todolist_mobile.png" class="mx-auto" alt="todolist">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- for mobile -->
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