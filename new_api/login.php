<?php

   if($_SERVER['REQUEST_METHOD']=='POST'){
  // echo $_SERVER["DOCUMENT_ROOT"];  // /home1/demonuts/public_html
//including the database connection file
       include_once("config.php");

        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if( $email == '' || $password == '' ){
                echo json_encode(array( "status" => "false","message" => "Parameter missing!") );
        }else{
            $query= "select * from user where email = '$email'";
            $result= mysqli_query($con, $query);
            
            if(mysqli_num_rows($result) > 0){  
                $query= "select * from user where email = '$email' and password = '$password'";
                $result= mysqli_query($con, $query);
                $emparray = array();
                if(mysqli_num_rows($result) > 0){                      
                    while ($row = mysqli_fetch_assoc($result)) {
                                        $emparray[] = $row;
                    }

                    echo json_encode(array( "code" => 200,
                                        "status" => "true",
                                        "message" => "Login successfully!", 
                                        "data" => $emparray) );
                } else {
                    echo json_encode(array( "code" => 401, "status" => "false","message" => "Wrong password!") );
                }
            }else{ 
                echo json_encode(array( "code" => 404, "status" => "false","message" => "User not found!") );
            }
                mysqli_close($con);
        }
    } else{
        echo json_encode(array( "status" => "false","message" => "Error occured, please try again!") );
    }
?>