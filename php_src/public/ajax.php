<?php include "../admin/includes/admin_header.php" ?>
<?php include "../admin/includes/db.php" ?>
<?php include "../admin/includes/functions.php" ?>



<?php if(isset($_POST['collab'])){

  $content = escape($_POST['content']);
  $sender_email = escape($_POST['sender_email']);
  $reciever_email= escape($_POST['reciever_email']);

$record = mysqli_query($connection,"SELECT * FROM  collaborate WHERE collab_sender_email='$sender_email' AND collab_receiver_email='$reciever_email' ");


if(mysqli_num_rows($record)){
    
$collab_status =0;
  $done=mysqli_query($connection,"UPDATE collaborate SET collab_description='$content' , collab_status ='{$collab_status}' WHERE collab_sender_email='$sender_email' AND collab_receiver_email='$reciever_email'");
  if(!$done){

    echo "fail";
  }
  else{

    echo "success";
  }
}
else{
  $done=  mysqli_query($connection,"INSERT INTO collaborate (collab_sender_email, collab_receiver_email,collab_description) VALUES ('$sender_email', '$reciever_email','$content')");
  if(!$done){

    echo "fail";
  }
  else{

    echo "success";
  }

}


  exit();
}
