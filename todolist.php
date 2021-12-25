<?php
require('koneksi.php');

session_start();

if (!isset($_SESSION['uid'])) {
    $_SESSION['msg'] = 'Anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
}
$sesUid = $_SESSION['uid'];

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
    <title>College Management</title>
    <!--Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- CSS sidebar -->
    <link rel="stylesheet" href="style/dashboard/style.css">
    <!-- CSS profil -->
    <link rel="stylesheet" href="style/todolist/todolist.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-1">
        <aside>
            <div class="pos">
                <div class="top">
                    <?php
                    $sql_kar = mysqli_query($koneksi, "SELECT * FROM user WHERE uid = '$sesUid' ");
                    while ($row = mysqli_fetch_array($sql_kar)) {
                        echo '<div class="profile">
                <img src="' . $row["profile_img"] . '" alt="thumb profile">
                <div class="title align-self-center">
                <h2>' . $row["nama_lengkap"] . '</h2>
                <p>' . $row["email"] . '</p>
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
                    <a href="college.html" class="active">
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
                            <li class="breadcrumb-item active" aria-current="page">To do list</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- section informasi -->


            <!-- section menu -->
            <form class="row my-5" method="POST" action="app/add.php">
                <h3 class="mb-4">Input:</h3>
                <div class="col-9">
                    <input type="text" class="form-control form-control-lg text-secondary" name="nama_todolist" placeholder="Tuliskan to do list di sini ...">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary mb-3" name="submit">Tambahkan</button>
                </div>
            </form>

            <?php
            $todos = $conn->query("SELECT * FROM college_todolist WHERE uid= $sesUid");
            ?>
            <div class="row">
                <h3>Daftar To do List</h3>
                        <div class="card mb-3">
                            <div class="card-body">
                            <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                                <div class="form-check mb-1">
                                <img src="img/Close_square.png" class="float-end" alt="ic_close" id="<?php echo $todo['id_todolist']; ?>">
                                    <?php if ($todo['status']) { ?>
                                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" data-todo-id="<?php echo $todo['id_todolist']; ?>" checked>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <?php echo $todo['nama_todolist'] ?>
                                            </label>
                                    <?php } else { ?>

                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" data-todo-id="<?php echo $todo['id_todolist']; ?>">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?php echo $todo['nama_todolist'] ?>
                                        </label>

                                        <?php } ?>
                                        <?php
                                            $today = date(" j F Y ");
                                            echo 
                                            '<small class="d-block ms-3 mb-4">Created: '.$today.'</small>';
                                        ?>
                                </div>
                                
                        <?php } ?>
                            </div>
                        </div>
                    
            </div>



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

    <script src="js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.float-end').click(function() {
                const id = $(this).attr('id');

                $.post("app/remove.php", {
                        id: id
                    },
                    (data) => {
                        if (data) {
                            $(this).parent().hide(500);
                        }
                    }
                );
            });

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