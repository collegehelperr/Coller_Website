<?php

if (isset($_POST['id'])){
    require '../db_conn.php';

    $id_task = $_POST['id'];

    if($id_task == ""){
        echo "Error";
    } else {
        $query = $conn->prepare("SELECT status FROM `college_task` WHERE id_task = ?");
        $query->execute([$id_task]);

        $data = $query->fetch();
        $status = $data['status'];

        $check = $status ? 0 : 1;

        $update = $conn->query("UPDATE `college_task` SET `status` = '$check' WHERE `college_task`.`id_task` = '$id_task';");

        $conn = null;
        exit();
    }
} else {
    header("../Location: index.php?mess=error");
}
// if($status == 0){
//     $query = "UPDATE `college_task` SET `status` = '1' WHERE `college_task`.`id_task` = '$id_task';";
//     $result = mysqli_query($koneksi, $query);
// } else {
//     $query = "UPDATE `college_task` SET `status` = '0' WHERE `college_task`.`id_task` = '$id_task';";
//     $result = mysqli_query($koneksi, $query);
// }
?>