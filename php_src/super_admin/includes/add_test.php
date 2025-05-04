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

  if(isset($session_role) &&  $session_role == 4 || $session_role == 6 ){




 ?>

<?php include "navigation.php"; ?>

<?php





if(isset($_POST["add_test"]))
{

$test_created_by = $session_email;

$test_exists=0;
 $if_users_added=0;
  $test_name            =        $_POST["test_name"];

  $query = "SELECT * FROM tests";
  $test_details = mysqli_query($connection,$query);
  if(!$test_details){
  die("query failed".mysqli_error($connection));
  }

  while ($row = mysqli_fetch_assoc($test_details)) {

    if($test_name==$row["test_name"]){
      $test_exists=1;
      ?><div class="alert alert-danger"> <strong>Failed! </strong> Test Name Already Exists</div> <?php

    }
  }
  if(!$test_exists){
  $filename = $_FILES['test_file']['name'];

     // destination of the file on the server
     $destination = '../../file-upload-download/uploads/' . $filename;

     // get the file extension
     $extension = pathinfo($filename, PATHINFO_EXTENSION);

     // the physical file on a temporary uploads directory on the server
     $file = $_FILES['test_file']['tmp_name'];
     $size = $_FILES['test_file']['size'];

     if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
              ?><div class="alert alert-danger"> <strong>Failed! </strong>You file extension must be .zip, .pdf or .docx</div> <?php

     } elseif ($_FILES['test_file']['size'] > 40000000) { // file shouldn't be larger than 1Megabyte
               ?><div class="alert alert-danger"> <strong>Failed! </strong> File too large</div> <?php

     } else {
         // move the uploaded (temporary) file to the specified destination
         $if_users_added=0;
         if (move_uploaded_file($file, $destination)) {
           $users_query = "SELECT * FROM users";
           $total_users = mysqli_query($connection,$users_query);
           if (!$total_users) {
               die("Users total count query failed".mysqli_error($connection));
               }
           $total_users_count = mysqli_num_rows($total_users);
           echo $total_users_count;
             $file_query = "INSERT INTO tests (test_name,test_file, test_file_size,test_users_count,test_created_by ) VALUES ('{$test_name}','{$filename}', '{$size}','{$total_users_count}','{$test_created_by}')";
             if (mysqli_query($connection, $file_query)) {
               ?><div class="alert alert-success"> <strong>Success! </strong> Test Added Succesfully</div> <?php


                 while ($row = mysqli_fetch_assoc($total_users)) {

                   $user_email             =     $row["user_email"];
                   $user_email             =     strval($user_email);




                 $score_query="INSERT INTO score (score_test_name , score_user_email )
                                 VALUES ('{$test_name}','{$user_email}')";

                 $create_score = mysqli_query($connection , $score_query);

                 if($create_score){

                  $if_users_added=1;
                   }
                  }
             }
         } else {
           die("query failed".mysqli_error($connection));
         }
     }



    }

if($if_users_added){
  ?><div class="alert alert-success"> <strong>Success! </strong> Test Users Added Succesfully</div> <?php

}
else{
  ?><div class="alert alert-danger"> <strong>Failed! </strong> Test Users Could Not Be Added. Try Again!! Contact Admin!!</div> <?php

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
            <h2 class="text-center">Create Test</h2>
        <div class="row jumbotron">


            <div class="col-sm-6 form-group">
                <label for="address-1">Test Name</label>
                <input type="text" class="form-control" name="test_name" id="" placeholder="Enter Test Name." required>
            </div>

            <div class="col-sm-6 form-group">
                <label for="name-f">File</label>
                <input type="file" class="form-control" name="test_file" id="" placeholder="Enter Test file." required>

            </div>








            <div class="col-sm-12 form-group mb-0">
               <button class="btn btn-primary float-right" name="add_test">Add Test</button>
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
