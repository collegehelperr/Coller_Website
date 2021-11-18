<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "coller"; // $db = "(nama database)"
$koneksi = mysqli_connect($server, $username, $password, $db);

if(mysqli_connect_errno()){
    echo "Koneksi Gagal : ".mysqli_connect_error();
} else{
    // echo "Koneksi Berhasil";
}
?>