<?php

    if($_SERVER['REQUEST_METHOD']=='POST'){
        include_once("config.php");

        if (isset($_POST['id_task_delete'])){
            $id = $_POST['id_task_delete'];

            $query_delete = "DELETE FROM college_task WHERE id_task = $id;";
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
        } else if (isset($_POST['status'])){
            $id_task = $_POST['id_task'];
            $status = $_POST['status'];

            $query_update_status = "UPDATE `college_task` SET `status` = '$status' WHERE `college_task`.`id_task` = $id_task;";
            if (mysqli_query($con, $query_update_status)) {
                $response = array(
                    'code' => 200,
                    'status' => 'Data terupdate!'
                );
            } else {
                $response = array(
                    'code' => 404,
                    'status' => 'Gagal update!'
                );
            }
            print(json_encode($response));
            mysqli_close($con);
        } else if (isset($_POST['id_task'])){
            $id_task = $_POST['id_task'];
            $detail = $_POST['detail_task'];
            $tanggal = $_POST['tanggal'];
            $jenis = $_POST['id_jenis'];

            $query_update_task = "UPDATE `college_task` SET `detail_task` = '$detail', `tgl_ddline` = '$tanggal', `id_jenis` = '$jenis' WHERE `college_task`.`id_task` = $id_task;";
            if (mysqli_query($con, $query_update_task)) {
                $response = array(
                    'code' => 200,
                    'status' => 'Data terupdate!'
                );
            } else {
                $response = array(
                    'code' => 404,
                    'status' => 'Gagal update!'
                );
            }
            print(json_encode($response));
            mysqli_close($con);
        } else {
            $uid = $_POST['uid'];
            $detail_task = $_POST['detail_task'];
            $jenis = $_POST['jenis'];
            $tgl = $_POST['tanggal'];

            if($jenis == '' || $detail_task == ''){
                echo json_encode(array( "status" => "false","message" => "Parameter missing!") );
            }else{
                    $query = "INSERT INTO `college_task` (`id_task`, `uid`, `detail_task`, `tgl_ddline`, `status`, `id_jenis`) VALUES (NULL, '$uid', '$detail_task', '$tgl', '0', '$jenis');";
                    if(mysqli_query($con,$query)){
                        echo json_encode(array( "code" => 200, "status" => "true","message" => "Note saved!") );
                    }else{
                        echo json_encode(array( "code" => 404, "status" => "false","message" => "Error query!") );
                    }
                    mysqli_close($con);
            }
        }

    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
        include_once("config.php");
        //select spesific user

        $uid = $_GET['uid'];

        $query_update = "SELECT * FROM `college_task` WHERE uid = $uid;";
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
?>