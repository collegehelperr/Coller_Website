<?php
require ('koneksi.php');
date_default_timezone_set("Asia/Kolkata"); 
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
// $sesName = $_SESSION['nama_lengkap'];

$hari = date('l');
$hari_indo = array('Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu');
$sql_kar = mysqli_query($koneksi, "SELECT * FROM college_schedule WHERE hari = '$hari_indo[$hari]' AND uid='$sesUid' ");

$query_tdl = "SELECT * FROM college_todolist WHERE uid='$sesUid'";
$result_tdl = mysqli_query($koneksi, $query_tdl);
$total_schedule = mysqli_num_rows($result_tdl);

$query_tdl2 = "SELECT * FROM college_todolist WHERE uid='$sesUid' AND status = 1 ";
$result_tdl2 = mysqli_query($koneksi, $query_tdl2);
$total_schedule2 = mysqli_num_rows($result_tdl2);

$persentase_bar = ($total_schedule2/$total_schedule) * 100;
?>

<?php

/** @var Connection $connection */
$connection = require_once 'db_conn.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!--Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="style/dashboard/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- progress bar -->
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="Dynamic-Circular-Progress-Bar-with-jQuery-CSS3/jQuery-plugin-progressbar.css">
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
                    <a href="dashboard.php" class="active">
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
            <h1>Dashboard</h1>
            <!-- card 1 - Jadwal -->
            <div class="card mt-5">
                <div class="card-body">
                    <h5 class="card-title">Jadwalmu hari ini</h5>
                    <?php
                    echo '<a href="schedule.php?hari='.$hari_indo[$hari].'">
                    <img src="img/ic_next.png" class="ic-next  float-end" alt="icon next">
                    </a>
                    
                    ';
                
                    ?>

                    <hr>
                    <div class="card-text">
                        <div class="row">
                            <div class="col col-sm">
                                <h6>Waktu</h6>
                            </div>
                            <div class="col col-md-8">
                                <h6>Mata Kuliah</h6>
                            </div>
                        </div>
                        <?php
                        $sql_kar = mysqli_query($koneksi, "SELECT * FROM college_schedule WHERE hari = '$hari_indo[$hari]' AND uid='$sesUid' ");
                        while ($row = mysqli_fetch_array($sql_kar)){
                            $waktu_berakhir = $row["waktu_berakhir"];
                            $waktu_mulai = $row["waktu_mulai"];
                            $new_wmulai =  mb_strimwidth($waktu_mulai, 0, 5);
                            $new_wberakhir =  mb_strimwidth($waktu_berakhir, 0, 5);
                            echo 
                            '<div class="row">
                                <div class="col">
                                    <p>' .$new_wmulai. ' - '. $new_wberakhir .'</p>
                                </div>
                                <div class="col col-md-8">
                                    <p>'. $row["nama_schedule"] .'</p>
                                </div>
                            </div>';
                        }
                    ?>
                    </div>
                </div>
            </div>

            <!-- card 2 - Task -->
            <div class="card mt-4 mb-5">
                <div class="card-body">
                    <h5 class="card-title">Task terdekatmu</h5>
                    <a href="#">
                        <img src="img/ic_next.png" class="ic-next  float-end" alt="icon next">
                    </a>
                    <hr>
                    <div class="card-text">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Assignment
                            </label>
                            <div class="bottom">
                                <p class="name-task float-start">Laporan praktikum Workshop mobile</p>
                                <p class="deadline float-sm-end">Dec 18, 2021</p>
                            </div>
                            <hr>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Assignment
                            </label>
                            <div class="bottom">
                                <p class="name-task float-start">Laporan praktikum Workshop mobile</p>
                                <p class="deadline float-sm-end">Dec 18, 2021</p>
                            </div>
                            <hr>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Assignment
                            </label>
                            <div class="bottom">
                                <p class="name-task float-start">Laporan praktikum Workshop mobile</p>
                                <p class="deadline float-sm-end">Dec 18, 2021</p>
                            </div>
                            <hr>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Assignment
                            </label>
                            <div class="bottom">
                                <p class="name-task float-start">Laporan praktikum Workshop mobile</p>
                                <p class="deadline float-sm-end">Dec 18, 2021</p>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- right -->
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <?php
                $today = date(" j F Y ");
                echo 
                '<p class="text-end">'.$today.'</p>';
                ?>
            </div>
            <div class="to-do-list">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Progress</h5>

                        <!-- 
                            Progress Bar 
                            "data-percent" bisa dibuat dinamis dengan php
                        -->
                        <div class="progress-bar mx-auto" data-percent="<?php  echo $persentase_bar; ?>" data-duration="1000" data-color="#ccc,#C957FF"></div>
                        
                        <h5 class="card-title-2 mt-4">To do list</h5>
                        <?php
            $todos = $conn->query("SELECT * FROM college_todolist WHERE uid= $sesUid");
            ?>
                <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                        <?php if ($todo['status']) { ?>
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="reload()" data-todo-id="<?php echo $todo['id_todolist']; ?>" checked>
                            <label class="form-check-label" for="flexCheckDefault">
                            <?php echo $todo['nama_todolist'] ?>
                            </label>
                            <hr>
                        </div>
                        <?php } else { ?>
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="reload()" data-todo-id="<?php echo $todo['id_todolist']; ?>">
                            <label class="form-check-label" for="flexCheckDefault">
                            <?php echo $todo['nama_todolist'] ?>
                            </label>
                            <hr>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <!-- <h2>Progress</h2>
                <img src="img/progress.png" alt="progress"> -->
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="Dynamic-Circular-Progress-Bar-with-jQuery-CSS3/jQuery-plugin-progressbar.js"></script>
    <script>
        const sideMenu = document.querySelector("aside");
        const menuBtn = document.querySelector("#menu-btn");
        const closeBtn = document.querySelector("#close-btn");

        function reload(){
            location.reload();
        }

        menuBtn.addEventListener('click', () => {
            sideMenu.style.display = 'block';
        })

        closeBtn.addEventListener('click', () => {
            sideMenu.style.display = 'none';
        })

        // progress
        $(".progress-bar").loading();

        $(document).ready(function() {
        $(".form-check-input").click(function(e) {
                const id = $(this).attr('data-todo-id');

                $.post('app/check.php', {
                        id: id
                    },
                    (data) => {
                        if (data != 'error') {
                            const h2 = $(this).next();
                            if (data === '1') {
                                h2.removeClass('checked');
                            } else {
                                h2.addClass('checked');
                            }
                        }
                    }
                );
            });
         });
    </script>
</body>

</html>