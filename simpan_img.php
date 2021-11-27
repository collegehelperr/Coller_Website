<?php

require ('koneksi.php');
session_start();

if(!isset($_SESSION['uid'])){
    $_SESSION['msg'] = 'Anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
}
$sesUid = $_SESSION['uid'];

if(isset($_POST['upload'])){ 
    $img = $_FILES['file']['name'];
    $target_dir = "img/profil/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $extensions_arr = array("jpg","jpeg","png","gif");   

    if( in_array($imageFileType,$extensions_arr) ){
        if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$img)){
          $query = "UPDATE `user` SET `profile_img` = '$target_file' WHERE `user`.`uid` = $sesUid;";
          $result = mysqli_query($koneksi, $query);
          header('Location: profil_edit.php');
        } else {
            echo "Error upload";
        }
    } else {
        echo "Error in array";
    }
}
?>