<?php
require ('koneksi.php');
$id =$_GET['id_task'];
$hari = $_GET['hari'];
$query = "DELETE FROM college_task WHERE id_task='$id'";
$result = mysqli_query($koneksi, $query)or die (mysql_error());;
header('Location: task.php);
?>