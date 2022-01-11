<?php

   if($_SERVER['REQUEST_METHOD']=='POST'){
  // echo $_SERVER["DOCUMENT_ROOT"];  // /home1/demonuts/public_html
//including the database connection file 
        include_once("config.php");

        if (isset($_POST['id_note_delete'])){
            $id = $_POST['id_note_delete'];

            $query_delete = "DELETE FROM college_notes WHERE id_note = $id";
            if (mysqli_query($con, $query_delete)) {
                $response = array(
                    'code' => 200,
                    'status' => 'Data terhapus!'
                );
            } else {
                $response = array(
                    'code' => 304,
                    'status' => 'Gagal dihapus!'
                );
            }
            print(json_encode($response));
            mysqli_close($con);
        } elseif (isset($_POST['id_note'])){
            $id_note = $_POST['id_note'];
            $judul = $_POST['judul'];
            $content = $_POST['note'];
            $tgl = date("Y-m-d");
        
                if($judul == '' || $content == ''){
                    echo json_encode(array( "status" => "false","message" => "Parameter missing!") );
                }else{
                        $query = "UPDATE `college_notes` SET `judul_note` = '$judul', `tgl_note` = '$tgl', `isi_note` = '$content' WHERE `college_notes`.`id_note` = $id_note;";
                        if(mysqli_query($con,$query)){
                            echo json_encode(array( "code" => 200, "status" => "true","message" => "Note updated!") );
                        }else{
                            echo json_encode(array( "code" => 304, "status" => "false","message" => "Error update note!") );
                        }
                        mysqli_close($con);
                }
        } else {
            $uid = $_POST['uid'];
            $judul = $_POST['judul'];
            $content = $_POST['note'];
            $tgl = date("Y-m-d");
        
                if($judul == '' || $content == ''){
                    echo json_encode(array( "status" => "false","message" => "Parameter missing!") );
                }else{
                        $query = "INSERT INTO `college_notes` (`id_note`, `uid`, `judul_note`, `tgl_note`, `isi_note`) VALUES (NULL, '$uid', '$judul', '$tgl', '$content');";
                        if(mysqli_query($con,$query)){
                            echo json_encode(array( "code" => 200, "status" => "true","message" => "Note saved!") );
                        }else{
                            echo json_encode(array( "code" => 304, "status" => "false","message" => "Error save note!") );
                        }
                        mysqli_close($con);
                }
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
        include_once("config.php");
        //select spesific user

        $uid = $_GET['uid'];

        $query_update = "SELECT * FROM `college_notes` WHERE uid = $uid;";
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
	
	} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        //delete spesific user
        include_once("config.php");

        $id = $_POST['id_note'];

        $query_delete = "DELETE FROM college_notes WHERE id_note = $id";
        if (mysqli_query($con, $query_delete)) {
            $response = array(
                'code' => 200,
                'status' => 'Data terhapus!'
            );
        } else {
            $response = array(
                'code' => 304,
                'status' => 'Gagal dihapus!'
            );
        }
        print(json_encode($response));
        mysqli_close($con);
    }
 
 ?>