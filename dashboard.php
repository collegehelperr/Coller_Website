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
// $sesName = $_SESSION['nama_lengkap'];

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
                    <a href="schedule.html">
                        <img src="img/ic_next.png" class="ic-next  float-end" alt="icon next">
                    </a>
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
                        <div class="row">
                            <div class="col">
                                <p>8:00 - 10:00</p>
                            </div>
                            <div class="col col-md-8">
                                <p>Interaksi Manusia & Komputer</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>10:00 - 12:00</p>
                            </div>
                            <div class="col col-md-8">
                                <p>P3L</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>13:00 - 15:00</p>
                            </div>
                            <div class="col col-md-8">
                                <p>Struktur Data</p>
                            </div>
                        </div>
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
                <p class="text-end">13 November 2021</p>
            </div>
            <div class="to-do-list">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Progress</h5>
                        <div class="skill">
                            <div class="outer">
                                <div class="inner">
                                    <div id="number">
                                        65%
                                        <span>
                                            selesai
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="200px" height="200px">
                                    <defs>
                                        <linearGradient id="GradientColor">
                                        <stop offset="0%" stop-color="#e91e63" />
                                        <stop offset="100%" stop-color="#673ab7" />
                                        </linearGradient>
                                    </defs>
                                    <circle cx="100" cy="100" r="90" stroke-linecap="round" />
                                </svg>
                        </div>
                        <h5 class="card-title-2 mt-4">To do list</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Belajar implementasi fragment
                            </label>
                            <hr>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Belajar implementasi stack
                            </label>
                            <hr>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Belajar implementasi linked list 
                            </label>
                            <hr>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Belajar dasar-dasar PHP 
                            </label>
                        </div>
                    </div>
                </div>
                <!-- <h2>Progress</h2>
                <img src="img/progress.png" alt="progress"> -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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

        // progress
        let number = document.getElementById("number");
        let counter = 0;
        setInterval(() => {
            if (counter == 65) {
                clearInterval();
            } else {
                counter += 1;
                number.innerHTML = counter + "%";
            }
        }, 30);
    </script>
</body>

</html>