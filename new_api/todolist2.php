<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include_once("config.php");

        if (isset($_POST['uid'])){
            $uid = $_POST['uid'];

            $getData = mysqli_query($con, "SELECT * FROM college_todolist WHERE uid = $uid;");
            $jumlahData = mysqli_num_rows($getData);

            $getDataSelesai = mysqli_query($con, "SELECT * FROM college_todolist WHERE uid = $uid AND status = 1;");
            $jumlahDataSelesai = mysqli_num_rows($getDataSelesai);

            $persentase = $jumlahDataSelesai/$jumlahData*100;

            if ($jumlahData == ""){
                $response = array(
                    'code' => 404,
                    'status' => 'Gagal mengambil data!'
                );
            } else {
                $response = array(
                    'code' => 200,
                    'Jumlah data' => $jumlahData,
                    'Jumlah data selesai' => $jumlahDataSelesai,
                    'Persentase' => $persentase
                );
            }
            print(json_encode($response));
            mysqli_close($con);
        }
    }
?>