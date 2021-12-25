<?php
require ('koneksi.php');
/** @var Connection $connection */
$connection = require_once 'db_conn.php';
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

if ( isset($_POST['submit']) ){
    $id_jenis = $_POST['id_jenis'];
    $tgl_ddline = $_POST ['tgl_ddline'];
    $detail_task = $_POST ['detail_task'];

    $query = "INSERT INTO `college_task` (`id_task`, `uid`, `detail_task`, `tgl_ddline`, `status`, `id_jenis`) VALUES (NULL, '$sesUid', '$detail_task', '$tgl_ddline', '0', '$id_jenis');";
    $result = mysqli_query($koneksi, $query);
    header('Location: task.php');
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
    <link rel="stylesheet" href="style/dashboard/dashboard.css">
    <!-- CSS profil -->
    <link rel="stylesheet" href="style/task/style_task.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                    <a href="college.php" class="active">
                        <span class="material-icons-sharp">school</span>
                        <h3>College Management</h3>
                    </a>
                    <hr>
                    <a href="profil.php">
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
            <h1 class="main-title">College Management <span>.</span></h1>
            <div class="row">
                <div class="col">
                    <p>Membantumu dalam mengelola urusan perkuliahan</p>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb" class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="college.php">College Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Task</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- section filter -->
            <section class="section-filter text-light row">
                <h5>Cari : </h5>
                <input class="form-control form-control-lg bg-transparent text-secondary border-secondary mt-2" style="height: 50px; border-radius: 8px;" id="myInput" type="text" placeholder="Masukkan kata kunci">
            </section>

            <!-- section menu -->
            <div class="row" id="myTask">
                <div class="col-md-8">            
                            <?php
                                $query_task = $conn->query("SELECT * FROM college_task WHERE uid='$sesUid'");                         
                                while($row = $query_task->fetch(PDO::FETCH_ASSOC)){
                                    $id_jenis = $row['id_jenis'];
                                    if($id_jenis == 1){
                                        $id_jenis = 'Quiz';
                                    } else {
                                        $id_jenis = 'Assignment';
                                    }  
                            ?>                         
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <a href="delete_task.php?id_task=<?php echo $row["id_task"];?>"><img src="img/Close_square.png" class="float-end" alt="ic_close"></a>
                                            <div class="form-check mb-1">
                                                <?php
                                                if ($row["status"]){ 
                                                ?>
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" data-task-id="<?php echo $row["id_task"];?>" checked>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                <?php echo $id_jenis;?>
                                                </label>
                                                <?php
                                                } else { 
                                                ?>
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" data-task-id="<?php echo $row["id_task"];?>">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                <?php echo $id_jenis;?>
                                                </label>
                                                <?php
                                                }
                                                ?>
                                                
                                            </div>
                                            <div class="row m-0">
                                                <div class="col">
                                                    <p class="mt-1 mb-2"><?php echo $row["detail_task"];?></p>
                                                </div>
                                                <div class="col-auto align-self-center">
                                                    <small><?php echo $row['tgl_ddline'];?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }                        
                            ?>                                                    
                </div>

                <div class="col-md-4">
                    <form action="task.php" method="POST" class="mt-3 position-fixed">
                        <h5 class="text-light mb-3">Tambahkan: </h5>
                        <div class="mb-3">
                            <select id="typeTaskSelect" class="form-select text-secondary" name="id_jenis">
                                <option value="1">Quiz</option>
                                <option value="2">Assignment</option>
                            </select>
                        </div>
                        <input type="date" class="form-control text-secondary mb-3" id="task-deadline" name="tgl_ddline">
                        <textarea class="form-control text-secondary" id="task-desc" placeholder="Deskripsi ..."name="detail_task"></textarea>
                        <button type="submit" class="btn btn-secondary mt-3" name="submit">Simpan</button>
                    </form>
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
            $(document).ready(function(){
                $(".form-check-input").click(function(e) {
                    const id = $(this).attr("data-task-id");
                    
                    $.post('app/task_status.php', {
                            id:id
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
                        })
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

            // search
            $(document).ready(function() {
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTask .card").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
</body>
</html>