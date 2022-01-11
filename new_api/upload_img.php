<?php
    include_once("config.php");

    $dir = $_SERVER['DOCUMENT_ROOT'].'/Coller_Website/img/profil/';
    $file_name = $_FILES['file']['name'];
    
    if (move_uploaded_file($_FILES['file']['tmp_name'],$dir.$file_name)){
        $response = array(
            'code' => 200,
            'status' => 'Upload successful'
        );
    } else {
        $response = array(
            'code' => 404,
            'status' => 'Error uploading file!'
        );
    }
    print(json_encode($response));
    mysqli_close($con);
?>