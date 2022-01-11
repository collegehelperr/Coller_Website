<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include_once("config.php");

        if (isset($_POST['id_todolist_delete'])){
            $id_todolist = $_POST['id_todolist_delete'];

            $query_delete = "DELETE FROM college_todolist WHERE id_todolist = $id_todolist;";
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
        } elseif (isset($_POST['status'])){
            $id_todolist = $_POST['id_todolist'];
            $status = $_POST['status'];

            $query_update_status = "UPDATE `college_todolist` SET `status` = '$status' WHERE `college_todolist`.`id_todolist` = $id_todolist;";
            if (mysqli_query($con, $query_update_status)) {
                $response = array(
                    'code' => 200,
                    'status' => 'Data terupdate!'
                );
            } else {
                $response = array(
                    'code' => 404,
                    'status' => 'Gagal update status!'
                );
            }
            print(json_encode($response));
            mysqli_close($con);
        } elseif (isset($_POST['id_todolist'])){
            $id_todolist = $_POST['id_todolist'];
            $detail_todolist = $_POST['detail_todolist'];
            $tgl = date("Y-m-d");

            $query_update_task = "UPDATE `college_todolist` SET `nama_todolist` = '$detail_todolist', `tgl_todolist` = '$tgl' WHERE `college_todolist`.`id_todolist` = $id_todolist;";
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
            $detail_todolist = $_POST['detail_todolist'];
            $tgl = date("Y-m-d");
            
            if($uid == '' || $detail_todolist == ''){
                echo json_encode(array( "status" => "false","message" => "Parameter missing!") );
            }else{
                    $query = "INSERT INTO `college_todolist` (`id_todolist`, `uid`, `nama_todolist`, `status`, `tgl_todolist`) VALUES (NULL, '$uid', '$detail_todolist', '0', '$tgl');";
                    if(mysqli_query($con,$query)){
                        echo json_encode(array( "code" => 200, "status" => "true","message" => "Todolist saved!") );
                    }else{
                        echo json_encode(array( "code" => 404, "status" => "false","message" => "Error query!") );
                    }
                    mysqli_close($con);
            }
        }
    
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        include_once("config.php");
        //select spesific user

        $uid = $_GET['uid'];

        $query_update = "SELECT * FROM `college_todolist` WHERE uid = $uid;";
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