<?php

session_start();

if(!isset($_SESSION['uid'])){
    $_SESSION['msg'] = 'Anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
}
$sesUid = $_SESSION['uid'];

if(isset($_POST['submit'])){
    require '../db_conn.php';

    $nama_todolist = $_POST['nama_todolist'];
    $ses = $_SESSION['uid'];
    if(!empty($nama_todolist)){
        $stmt = $conn->prepare("INSERT INTO `college_todolist`(`id_todolist`, `uid`, `nama_todolist`, `status`) VALUES ('',:uid,'$nama_todolist',0)");
        $stmt->bindValue('uid', $_SESSION['uid']);
        $stmt->execute();
        header("Location: ../todolist.php");
    }else{
        header("Location: ../todolist.php");
    }


} 