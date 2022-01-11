<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    // echo $_SERVER["DOCUMENT_ROOT"];  // /home1/demonuts/public_html
//including the database connection file 
    include_once("config.php");
    if (isset($_POST['id_schedule_delete'])){
        $id = $_POST['id_schedule_delete'];

        $query_delete = "DELETE FROM college_schedule WHERE id_schedule = $id";
        if (mysqli_query($con, $query_delete)) {
            $response = array(
                'code' => 200,
                'status' => 'Data terhapus!'
            );
        } else {
            $response = array(
                'code' => 404,
                'status' => 'Gagal dihapus!'
            );
        }
        print(json_encode($response));
        mysqli_close($con);
    } elseif (isset($_POST['id_schedule'])){
        $id_schedule = $_POST['id_schedule'];
        $hari = $_POST['hari'];
        $jamMulai = $_POST['jam_mulai'];
        $jamBerakhir = $_POST['jam_berakhir'];
        $nama = $_POST['nama_schedule'];
    
        $query = "UPDATE `college_schedule` SET `hari` = '$hari', `waktu_mulai` = '$jamMulai:00', `waktu_berakhir` = '$jamBerakhir:00', `nama_schedule` = '$nama' WHERE `college_schedule`.`id_schedule` = $id_schedule;";
        if(mysqli_query($con,$query)){
            echo json_encode(array( "code" => 200, "status" => "true","message" => "Schedule updated!") );
        }else{
            echo json_encode(array( "code" => 404, "status" => "false","message" => "Error query!") );
        }
        mysqli_close($con);
    } else {

        $uid = $_POST['uid'];
        $hari = $_POST['hari'];
        $jamMulai = $_POST['jam_mulai'];
        $jamBerakhir = $_POST['jam_berakhir'];
        $nama = $_POST['nama_schedule'];

        $query = "INSERT INTO `college_schedule` (`id_schedule`, `uid`, `hari`, `waktu_mulai`, `waktu_berakhir`, `nama_schedule`) VALUES (NULL, '$uid', '$hari', '$jamMulai:00', '$jamBerakhir:00', '$nama');";
        if(mysqli_query($con,$query)){
            echo json_encode(array( "code" => 200, "status" => "true","message" => "Schedule saved!") );
        }else{
            echo json_encode(array( "code" => 404, "status" => "false","message" => "Error query!") );
        }
        mysqli_close($con);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
        include_once("config.php");
        //select spesific user

        $uid = $_GET['uid'];
        $hari = $_GET['hari'];

        $query_update = "SELECT * FROM `college_schedule` WHERE hari = '$hari' AND uid = $uid;";
        $result = mysqli_fetch_array(mysqli_query($con, $query_update)); 
        $json_array = array();
        $response = "";

        if (isset($result)) {
            $data = mysqli_query($con, $query_update);
            while ($row = mysqli_fetch_object($data)) {
                $json_array[] = $row;
            }
            $response = $json_array;
        } else {
            $response = $json_array;
        }
        print(json_encode($response));
        mysqli_close($con);

    }