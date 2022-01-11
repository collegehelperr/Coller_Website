<?php  
include_once("config.php");
$target_dir = $_SERVER['DOCUMENT_ROOT'].'/Coller_Website/img/profil/';  
$target_file_name = $target_dir .basename($_FILES["file"]["name"]);  
$response = array();  
  
// Check if image file is an actual image or fake image  
if (isset($_FILES["file"])){
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file_name)){  
        echo json_encode(array( "code" => 200, "status" => "true","message" => "Successfully uploaded!") );
    } else {
        echo json_encode(array( "code" => 404, "status" => "false","message" => "Error uploading!") );
    }  
} else {  
    echo json_encode(array( "status" => "false","message" => "Parameter missing!") );
}
?>  