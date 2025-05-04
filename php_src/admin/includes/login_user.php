<?php include  "admin_header.php"?>
<?php include "db.php" ?>
<?php include "functions.php" ?>

<?php

if (isset($_POST["user_email"])) {


$user_email = escape(htmlspecialchars($_POST["user_email"]));
$password   = escape(htmlspecialchars($_POST["password"]));


$user_email = trim($user_email);
$password = trim($password);
$user_email = mysqli_real_escape_string($connection,$user_email);
$password= mysqli_real_escape_string($connection,$password);

$after_registration =false;
$whattodo = login_user($user_email,$password,$after_registration);

if($whattodo == "loginnow"){
   echo $whattodo;


}else {
  echo $whattodo;

}

}


 ?>
