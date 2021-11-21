<?php
    include 'koneksi.php';

    $profile_img=$_GET["profile_img"];
    $sql="delete from user where profile_img=$profile_img";
    $hapus_bank=mysqli_query($koneksi,$sql);

    //menghapus file gambar
    unlink("profile_img/".$profile_img);

    if ($hapus_bank) {
        header("Location:profil_edit.php?hapus=berhasil");
    }
    else {
        header("Location:profil_edit.php?hapus=gagal");

    }
?>