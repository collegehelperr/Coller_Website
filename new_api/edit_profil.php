<?php

   if($_SERVER['REQUEST_METHOD']=='POST'){
  // echo $_SERVER["DOCUMENT_ROOT"];  // /home1/demonuts/public_html
//including the database connection file
       include_once("config.php");
       
       $uid = $_POST['uid'];
       $password = $_POST['password'];
       $nama = $_POST['nama'];
       $nohp = $_POST['nohp'];
       $profimg = $_POST['profimg'];
       $email = $_POST['email'];
  
	    if($email == '' || $password == '' || $nama == '' || $nohp == ''){
	        echo json_encode(array( "status" => "false","message" => "Parameter missing!") );
	    }else{
			 
	        $query_email= "SELECT * FROM user WHERE email = '$email' AND uid != $uid;";
	        $result_email= mysqli_query($con, $query_email);

			$query_nohp= "SELECT * FROM user WHERE no_hp = '$nohp' AND uid != $uid;";
	        $result_nohp= mysqli_query($con, $query_nohp);
		 
	        if(mysqli_num_rows($result_email) > 0){  
	           echo json_encode(array( "code" => 401, "status" => "false","message" => "email already exist!") );
	        } else if(mysqli_num_rows($result_nohp) > 0){  
				echo json_encode(array( "code" => 402, "status" => "false","message" => "no hp already exist!") );		
			}else{ 
		 	    $query = "UPDATE user SET `email` = '$email', `password` = '$password', `nama_lengkap` = '$nama', `no_hp` = '$nohp', `profile_img` = '$profimg' WHERE `user`.`uid` = $uid;";
			    if(mysqli_query($con,$query)){
                    $query= "SELECT * FROM `user` WHERE email = '$email';";
	                $result= mysqli_query($con, $query);
		             $emparray = array();
	                     if(mysqli_num_rows($result) > 0){  
	                     while ($row = mysqli_fetch_assoc($result)) {
                                     $emparray[] = $row;
                                   }
	                     }
			    echo json_encode(array( "code" => 200, "status" => "true","message" => "data updated!" , "data" => $emparray) );
		 	    }else{
		 		    echo json_encode(array( "status" => "false","message" => "Error update query!") );
		 	    }
	        }
	            mysqli_close($con);
	    }
     } else{
			echo json_encode(array( "status" => "false","message" => "Error occured, please try again!") );
	}
 
 ?>