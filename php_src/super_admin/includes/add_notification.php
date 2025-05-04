<?php include 'super_admin_header.php'; ?>
<?php  include '../../includes/db.php'; ?>
<?php include '../../admin/includes/functions.php' ?>

<?php

if(isset($_SESSION["user_role"]) &&  isset($_SESSION["user_id"]) && isset($_SESSION["user_email"]) && isset($_SESSION["user_image"])   && !empty($_SESSION["user_role"]) && !empty($_SESSION["user_email"]) && !empty($_SESSION["user_id"])
        && !empty($_SESSION["user_image"]) )
{




  $session_email           =          encrypt_decrypt($_SESSION["user_email"], 'decrypt');
  $session_role            =          encrypt_decrypt($_SESSION["user_role"], 'decrypt');
  $session_user_id         =          encrypt_decrypt($_SESSION["user_id"], 'decrypt');
  $session_user_image      =          encrypt_decrypt($_SESSION["user_image"], 'decrypt');

  if(isset($session_role) &&  $session_role == 5 || $session_role == 6 ){




 ?>

<?php include "navigation.php"; ?>


<?php





if(isset($_POST["send_notification"]))
{

  $notification_date            =        escape($_POST["notification_date"]);
  $notification_content         =        escape($_POST["notification_content"]);
  $notification_link            =        escape($_POST["notification_link"]);
  $notification_target          =        escape($_POST["notification_target"]);
  $notification_type            =        escape($_POST["notification_type"]);
  $notification_deadline        =        escape($_POST["notification_deadline"]);
  $notification_sender          =        $session_email;










  $query = "INSERT INTO notifications (notification_date , notification_content , notification_link , notification_target , notification_type, notification_deadline,notification_sender)
            VALUES ('{$notification_date}','{$notification_content}','{$notification_link}','{$notification_target}','{$notification_type}','{$notification_deadline}','{$notification_sender}')";

$create_notification = mysqli_query($connection , $query);
if(!$create_notification){
  ?><div class="alert alert-danger"> <strong>Failed! </strong>Notification Could Not Be Sent  Try Again!! Or Contact Admin!!</div> <?php
}else {
  ?><div class="alert alert-success"> <strong>Success! </strong> Notification Sent Successfully</div> <?php
}






 }


  ?>



<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="https://codepen.io/skjha5993/pen/bXqWpR.css">
    <title>Registration Form Using Bootstrap 4</title>
</head>
<body>

    <div class="container">
        <form enctype="multipart/form-data" class="" action="" method="post">
            <h2 class="text-center">Create Notification</h2>
        <div class="row jumbotron">
          <div class="col-sm-6 form-group">
              <label for="">Target Users</label>
              <select id="" class="form-control browser-default custom-select" name="notification_target" value="">


                <option value="all">All Users</option>
                <option value="Web Development">Web Development users</option>
                <option value="App Development">App Development users</option>
                <option value="Python">Python users</option>
                <option value="Cyber Security">Cyber Security users</option>
                <option value="Hackathon">Hackathon</option>


          </select>
          </div>


          <div class="col-sm-6 form-group">
              <label for="">Notification Type</label>
              <select id="" class="form-control browser-default custom-select" name="notification_type" value="">
              <option value="alert alert-info">Normal Notification</option>
              <option value="alert alert-success">Succesful Notification</option>
              <option value="alert alert-danger">Urgent Notification</option>


          </select>
          </div>




            <div class="col-sm-6 form-group">
                <label for="name-l">Notification Date</label>
                <input type="Date" class="form-control" name="notification_date" id="-l" placeholder="Enter date." required>
            </div>

            <div class="col-sm-6 form-group">
                <label for="name-l">Notification Deadline</label>
                <input type="Date" class="form-control" name="notification_deadline" id="-l" placeholder="Enter notification deadline." required>
            </div>

            <div class="col-sm-6 form-group">
                <label for="address-1">Notification link</label>
                <input type="text" class="form-control" name="notification_link" id="" placeholder="Enter notification link." required>
            </div>

            <div class="col-sm-6 form-group">
                <label for="name-f">Notification Content</label>

                <textarea class="form-control" name="notification_content" rows="4" cols="40" required></textarea>
            </div>








            <div class="col-sm-12 form-group mb-0">
               <button class="btn btn-primary float-right" name="send_notification">Send Notification</button>
            </div>

        </div>
        </form>
    </div>


</body>
</html>
<?php
  }else{
      echo " You are not authorized to visit the page";
  }
}else {
  echo "Please go back to login page and return back";
}


 ?>
