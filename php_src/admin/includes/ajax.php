<?php include "db.php" ?>
<?php
if(isset($_SESSION["user_role"]) && isset($_SESSION["user_domain"]) && isset($_SESSION["user_id"]) && isset($_SESSION["user_email"]) && $_SESSION["user_role"] > -1 && !empty($_SESSION["user_domain"]) && !empty($_SESSION["user_email"]))
{
  if(isset($_POST['accept'])){


    $collab_id = $_POST['collab_id'];


    mysqli_query($connection,"UPDATE collaborate SET collab_status=1 WHERE collab_id=$collab_id");



    exit();
  }

   	if (isset($_POST['decline'])) {
  $collab_id = $_POST['collab_id'];


  mysqli_query($connection,"UPDATE collaborate SET collab_status=-1 WHERE collab_id=$collab_id");


   		exit();
   	}    	} ?>
