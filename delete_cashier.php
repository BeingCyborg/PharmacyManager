<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
$id=$_GET['cashier_id'];
$sql="delete from cashier where cashier_id='$id'";
mysqli_query($con, $sql);
//$rows=mysqli_fetch_assoc($result);
header("location:admin_cashier.php");
?>


