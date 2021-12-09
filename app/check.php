<?php

if(isset($_POST['id'])){
    require '../db_conn.php';

    $id = $_POST['id'];

    if(empty($id)){
       echo 'error';
    }else {
        $todos = $conn->prepare("SELECT `id_todolist`,`status` FROM `college_todolist` WHERE id_todolist=?");
        $todos->execute([$id]);

        $todo = $todos->fetch();
        $uId = $todo['id_todolist'];
        $checked = $todo['status'];

        $uChecked = $checked ? 0 : 1;

        $res = $conn->query("UPDATE `college_todolist` SET `status`= '$uChecked' WHERE `id_todolist` = '$uId' ");

        if($res){
            echo $checked;
        }else {
            echo "error";
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}