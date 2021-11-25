<?php
require ('koneksi.php');
$id =$_GET['id_schedule'];
$hari = $_GET['hari'];
$query = "DELETE FROM college_schedule WHERE id_schedule='$id'";
$result = mysqli_query($koneksi, $query)or die (mysql_error());;
header('Location: schedule.php?hari='.$hari);
?>