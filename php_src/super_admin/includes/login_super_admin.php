<?php include "super_admin_header.php" ?>
<?php  include '../../includes/db.php'; ?>
<?php include '../../admin/includes/functions.php' ?>

<?php

if (isset($_POST["user_email"]) && isset($_POST["password"]) && isset($_POST["security_key"])) {


$user_email = $_POST["user_email"];
$password   = $_POST["password"];
$security_key   = $_POST["security_key"];


$user_email = trim($user_email);
$password = trim($password);
$security_key = trim($security_key);


$user_email = mysqli_real_escape_string($connection,$user_email);
$password= mysqli_real_escape_string($connection,$password);
$security_key = mysqli_real_escape_string($connection,$security_key);



$whattodo = login_super_admin($user_email,$password,$security_key);

if($whattodo == "login_super_admin"){
    // echo $whattodo;
?><script> window.location.replace("includes/dashboard");</script><?php

}else {
  echo $whattodo;

}

}


 ?>
