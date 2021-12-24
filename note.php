<?php
require ('koneksi.php');
?>


<?php

/** @var Connection $connection */
$connection = require_once 'pdo.php';
$college_notes = $connection->getNotes();

$currentNote = [
    'id_note' => '',
    'judul_note' => '',
    'isi_note' => ''
];
if (isset($_GET['id_note'])) {
    $currentNote = $connection->getNoteById($_GET['id_note']);
}

if(!isset($_SESSION['uid'])){
    $_SESSION['msg'] = 'Anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
}
$sesUid = $_SESSION['uid'];
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
    <link rel="stylesheet" href="style/notes/style_notes.css">

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
                            <li class="breadcrumb-item active" aria-current="page">Notes</li>
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
            <div class="row mt-3" id="myTask">
                <div class="col-md-8">
                <?php foreach ($college_notes as $note): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                                <form action="delete_notes.php" class="float-end" method="post">
                                    <input type="hidden" name="id_note" value="<?php echo $note['id_note'] ?>">
                                    <button class="btn bg-transparant float-end">
                                        <img src="img/Close_square.png" alt="ic_close">
                                    </button>
                                </form>
                                <a href="?id_note=<?php echo $note['id_note'] ?>">
                                    <h5 class="card-title float-none"><?php echo $note['judul_note'] ?></h5>
                                </a><h6><?php echo date('d/m/Y H:i', strtotime($note['tgl_note'])) ?></h6>
                                <p><?php echo $note['isi_note'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-4">
                    <form action="create_notes.php" class="mt-3 position-fixed" method="post">
                        <input type="hidden" name="id_note" value="<?php echo $currentNote['id_note'] ?>">
                        <input type="text" name="judul_note" class="form-control text-secondary" autocomplete="off" value="<?php echo $currentNote['judul_note'] ?>" placeholder="Judul Note">
                        <div class="form-floating mt-3">
                            <textarea name="isi_note" class="form-control form-control-lg text-secondary" placeholder="Leave a comment here" id="floatingTextarea2"><?php echo $currentNote['isi_note'] ?></textarea>
                            <label for="floatingTextarea2" class="text-secondary">Deskripsi Note</label>
                        </div>
                        <button class="btn btn-primary mt-3">
                            <?php if ($currentNote['id_note']): ?>
                                Update
                            <?php else: ?>
                                Buat Note Baru
                            <?php endif ?>
                        </button>
                    </form>
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