<?php
    if (isset($_POST['btn_simpan'])) {
        include 'koneksi.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $ekstensi_diperbolehkan	= array('png','jpg');
            $user = $_FILES['profile_img']['name'];
            $x = explode('.', $profile_img);
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['profile_img']['tmp_name'];

            if (!empty($profile_img)){
                if (in_array($ekstensi, $ekstensi_diperbolehkan) === true){
    
                    //upload gambar
                    move_uploaded_file($file_tmp, 'profile_img/'.$profile_img);

                    $sql="insert into user values ('$profile_img')";

                    $simpan_bank=mysqli_query($koneksi,$sql);

                    if ($simpan_bank) {
                        header("Location:profil_edit.php?add=berhasil");
                    }
                    else {
                        header("Location:profil_edit.php?add=gagal");
                    }  
                }
            }else {
                $profile_img="bank_default.png";
            }
        }
    }
?>