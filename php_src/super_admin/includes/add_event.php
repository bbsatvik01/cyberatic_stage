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

  if(isset($session_role) &&  $session_role == 3 || $session_role == 6 ){




 ?>

<?php include "navigation.php"; ?>

<?php





if(isset($_POST["create_post"]))
{

  $event_title            =        escape($_POST["event_title"]);
  $event_date             =        date("d-m-y");
  $event_deadline         =        escape($_POST["event_deadline"]);
  $event_start_date       =        escape($_POST["event_start_date"]);
  $event_caption          =        escape($_POST["event_caption"]);
  $event_image            =        $_FILES['image']['name'];
  $post_image_temp        =        $_FILES['image']['tmp_name'];
  $event_status           =        escape($_POST["event_status"]);
  $event_link             =        escape($_POST["event_link"]);
  $event_domain           =        escape($_POST["event_domain"]);
  $event_created_by       =        $session_email;




  move_uploaded_file($post_image_temp,"../../images/$event_image");

  $query = "INSERT INTO events(event_title,event_date,event_deadline,event_start_date,event_caption,event_image,event_link,event_status,event_domain,event_created_by)
            VALUES ('{$event_title}',now(),'{$event_deadline}','{$event_start_date}','{$event_caption}','{$event_image}' ,'{$event_link}','{$event_status}','{$event_domain}','{$event_created_by}')";

$create_event = mysqli_query($connection , $query);
if(!$create_event){
  // die("query failed".mysqli_error($connection));
  ?><div class="alert alert-danger"> <strong>Failed! </strong>Event Could Not Be Made  Try Again!! Or Contact Admin!!</div> <?php

}else {
  ?><div class="alert alert-success"> <strong>Success! </strong> Event is  Made Successfully</div> <?php

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
            <h2 class="text-center">Add An Event</h2>
        <div class="row jumbotron">
            <div class="col-sm-6 form-group">
                <label for="name-f">Event Title</label>
                <input type="text" class="form-control" name="event_title" id="" placeholder="Event Name" required>
            </div>

            <div class="col-sm-6 form-group">
                <label for="address-1">Event Link</label>
                <input type="text" class="form-control" name="event_link" id="" placeholder=" Form / Website Link" required>
            </div>

            <div class="col-sm-6 form-group">
                <label for="name-l">Last Date to Register</label>
                <input type="Date" class="form-control" name="event_deadline" id="-l" placeholder="Enter last Date to Register" required>
            </div>

            <div class="col-sm-6 form-group">
                <label for="email">Event Start Date</label>
                <input type="Date" class="form-control" name="event_start_date" id="" placeholder="Enter Event Start Date" required>
            </div>

            <div class="form-group col-sm-6">
              <label for="user-image">Event  Image</label>
              <input type="file" name="image" value="" class="form-control" name="image">
            </div>

            <div class="col-sm-6 form-group">
                <label for="">Status</label>
                <select id="" class="form-control browser-default custom-select" name="event_status" value="">
                <option value="0">Publish</option>
                <option value="1">Draft</option>

            </select>
            </div>
            <div class="col-sm-6 form-group">
                <label for="">Domain</label>
                <select id="" class="form-control browser-default custom-select" name="event_domain" value="">
                <option value="Python">Python</option>
                <option value="Web Development">Web Development</option>
                <option value="App Development">App Development</option>
                <option value="Cyber Security">Cyber Security</option>
                <option value="Ethical Hacking">Ethical Hacking</option>

            </select>
            </div>

            <div class="col-sm-6 form-group">
                <label for="name-f">Event Caption</label>

                <textarea class="form-control" name="event_caption" rows="4" cols="50" required></textarea>
            </div>








            <div class="col-sm-12 form-group mb-0">
               <button class="btn btn-primary float-right" name="create_post">Submit</button>
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
