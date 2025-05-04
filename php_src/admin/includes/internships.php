<?php include "admin_header.php" ?>
<?php include "functions.php" ?>
<?php include "db.php" ?>


<?php
if(isset($_SESSION["user_role"]) && isset($_SESSION["user_domain"]) && isset($_SESSION["user_id"]) && isset($_SESSION["user_email"]) && $_SESSION["user_role"] > -1 && !empty($_SESSION["user_domain"]) && !empty($_SESSION["user_email"]))
{

  $session_email           =          encrypt_decrypt($_SESSION["user_email"], 'decrypt');
  $session_role            =          encrypt_decrypt($_SESSION["user_role"], 'decrypt');
  $session_domain          =          encrypt_decrypt($_SESSION["user_domain"], 'decrypt');
  $session_user_id         =          encrypt_decrypt($_SESSION["user_id"], 'decrypt');
  $session_user_image      =          encrypt_decrypt($_SESSION["user_image"], 'decrypt');
  $session_user_theme_setting  =  encrypt_decrypt($_SESSION["user_theme_setting"], 'decrypt');


$query_message_for_update ="";
$query_message_for_delete =0;
$query_message_for_notification ="";

 ?>

 <?php if (isset($_POST["edit_internship"])) {
$internship_status = null;

     $internship_company          =        escape($_POST["internship_company"]);
     $internship_id               =        escape($_POST["internship_id"]);
     $internship_start_date       =        escape($_POST["internship_start_date"]);
     $internship_end_date         =        escape($_POST["internship_end_date"]);
     $internship_role             =        escape($_POST["internship_role"]);
     $internship_description      =        escape($_POST["internship_description"]);



     if(isset($_POST["post_status_blocked"]) && $_POST["post_status_blocked"] == -2){
       $internship_status =-3;

     }else {
       $internship_status           =        escape($_POST["internship_status"]);

     }

     $edited_internship=mysqli_query($connection,"UPDATE internships SET internship_company='$internship_company'
       , internship_status='$internship_status', internship_start_date='$internship_start_date', internship_end_date='$internship_end_date'
       ,internship_role='$internship_role', internship_description='$internship_description'  WHERE internship_id=$internship_id");
     if (!$edited_internship) {

    
     $query_message_for_update = -1;

     }
     else {

       $query_message_for_update = 1;

       if($internship_status == -2 || $internship_status == -3){

                $notification_date =  date('Y-m-d');
                $notification_content = $internship_company;
                $notification_link ="https://www.coursera.org/specializations/full-stack-mobile-app-development#courses";
                $notification_target = "admin";
                $notification_type = "alert alert-danger";
                $notification_deadline = date('Y-m-d', strtotime("+10 days"));
                $notification_sender = $session_email;

                $query_to_check = "SELECT notification_id FROM notifications WHERE notification_content = '$notification_content' AND notification_target = '$notification_target' AND  notification_sender ='$notification_sender' ";
                $if_already_exsists = mysqli_query($connection,$query_to_check);
                $if_notifacation_exsists = mysqli_num_rows($if_already_exsists);

                if($if_notifacation_exsists == 0){
                            $query = "INSERT INTO notifications (notification_date , notification_content , notification_link , notification_target , notification_type, notification_deadline ,notification_sender)
                                      VALUES ('{$notification_date}','{$notification_content}','{$notification_link}','{$notification_target}','{$notification_type}','{$notification_deadline}','{$notification_sender}' )";

                          $create_notification = mysqli_query($connection , $query);
                          if(!$create_notification){
                              die("notification didnot happen".mysqli_error($connection));
                              $query_message_for_notification = -1;
                          }else {
                            $query_message_for_notification = 1;

                          }



                 }else {
                   $query_message_for_notification = 2;

                 }
       }else {
           $query_message_for_notification ="";
       }



     }


     } ?>

<?php   if (isset($_POST["delete_internship"])) {
      $internship_id=  escape($_POST["internship_id"]);

      $deleted_internship=mysqli_query($connection,"UPDATE internships SET internship_status=-1 WHERE internship_id='$internship_id'");
      if (!$deleted_internship) {
      die("Users total count query failed".mysqli_error($connection));
      $query_message_for_delete = -1;
      }
      else {
$query_message_for_delete = 1;
      }
  } ?>

<?php



$query_message = 0;
 if(isset($_POST["create_internship"]))
{

  $internship_company          =        escape($_POST["internship_company"]);
  $internship_user_email       =        escape($session_email) ;
  $internship_status           =        escape($_POST["internship_status"]);
  $internship_start_date       =        escape($_POST["internship_start_date"]);
  $internship_end_date         =        escape($_POST["internship_end_date"]);
  $internship_role             =        escape($_POST["internship_role"]);
  $internship_description      =        escape($_POST["internship_desc"]);




  $query = "INSERT INTO internships(internship_user_email,internship_role,internship_company,internship_start_date,internship_end_date,
    internship_description,internship_status)
  VALUES ('{$internship_user_email}','{$internship_role}','{$internship_company}','{$internship_start_date}','{$internship_end_date}','{$internship_description}','{$internship_status}' )";

$create_internship = mysqli_query($connection , $query);
if(!$create_internship){
   die("query failed".mysqli_error($connection));
  $query_message =-1;
}else {
  $query_message =1;
}






 } ?>

<?php

$published_internships =0;
$archived_internships=0;
$deleted_internships=0;
$internship_user_email = $session_email;
$query = "SELECT * FROM internships  WHERE internship_user_email = '{$internship_user_email}'  ORDER BY internship_id DESC";
$internship_details = mysqli_query($connection,$query);
if(!$internship_details){
die("query failed".mysqli_error($connection));
}  else{
$record3=array();
$total_internships = mysqli_num_rows($internship_details);

   while ($row = mysqli_fetch_assoc($internship_details)) {

     $record3[]=$row;
     if($row["internship_status"] == 1 ){
         $published_internships++;
     }
     if($row["internship_status"] == 0){
       $archived_internships++;

     }
     if($row["internship_status"] == -1){
       $deleted_internships++;

     }

}

} ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../images/logo.png">
  <title>
CYBERATIC RVITM - Internships
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <style >
  .total_numbers{
    font-size: 30px;
  }

  .edit_modal_content  .modal-header{
    width:700px;
    height:40px;
  }

  .edit_modal_content{
    width:700px;

  }
    .chart-container {
width:  80%;
height: 600px;
margin: 0 auto;
}
  #form_img{
    margin-left:250px;
  }
    @media (max-width:600px) {
    .edit_modal_content  .modal-header{
        width:auto;
      }
      .edit_modal_content{
        width:auto;
      }
      #form_img{
        margin-left:60px;
      }
    }
  </style>
</head>

<body class="<?php if(isset($session_user_theme_setting)){if($session_user_theme_setting == 0){echo "";}else{echo "white-content";}} ?>">

  <div class="wrapper">
    <div class="sidebar">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
    <div class="sidebar-wrapper ps">
      <div class="logo">
        <a href="javascript:void(0)" class="simple-text logo-mini">
 <span  class="pull-left" > <img src="../../images/logo.svg" style ="width:90px;height:40px; " alt="Profile Photo">  </span>
        </a>
        <a href="javascript:void(0)" class="simple-text logo-normal pt-3" >

          Cyberatic
        </a>
      </div>
      <ul class="nav">
        <li>
      <a href="dashboard">
        <i class="tim-icons icon-chart-pie-36"></i>
        <p>Dashboard</p>
      </a>
    </li>
        <li class="active">
          <a href="internships">
            <i class="tim-icons icon-atom"></i>
            <p>Internship Forum</p>
          </a>
        </li>
        <li>
          <a href="posts">
            <i class="tim-icons icon-puzzle-10"></i>
            <p>Posts Forum</p>
          </a>
        </li>
        <li >
          <a href="timeline">
            <i class="tim-icons icon-pin"></i>
            <p>Timeline</p>
          </a>
        </li>
        <li>
          <a href="notifications">
            <i class="tim-icons icon-bell-55"></i>
            <p>Notifications</p>
          </a>
        </li>
        <li>
          <a href="events">
            <i class="tim-icons icon-single-02"></i>
            <p>Events</p>
          </a>
        </li>
       

        <li class="">
          <a href="tests">
            <i class="tim-icons icon-puzzle-10"></i>
            <p> Tests </p>
          </a>
        </li>

        <li>
          <a href="leaderboard">
            <i class="tim-icons icon-align-center"></i>
            <p>LeaderBoard</p>
          </a>
        </li>
        <li>

        </li>
        <li>
          <a href="analysis">
            <i class="tim-icons icon-puzzle-10"></i>
            <p>Analysis</p>
          </a>
        </li>
        <li class="active-pro">

        </li>
      </ul>
    </div>


      </div>
      <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <div class="navbar-toggle d-inline">
                <button type="button" class="navbar-toggler">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </button>
              </div>
              <a class="navbar-brand" href="javascript:void(0)">Internships</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav ml-auto">

                <li class="dropdown nav-item">
                  <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <div class="photo">
                      <img src="../../images/<?php if(isset($session_user_image)){echo $session_user_image;} ?>" alt="Profile Photo">
                    </div>
                    <b class="caret d-none d-lg-block d-xl-block"></b>
                    <p class="d-lg-none">
                      <!-- Log out -->
                    </p>
                  </a>
                  <ul class="dropdown-menu dropdown-navbar">
                    <li class="nav-link"><a href="profile" class="nav-item dropdown-item"> <i class="fas fa-id-card"></i>  Profile</a></li>
                    <!-- <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Settings</a></li> -->
                     <li class="nav-link"><a href="settings" class="nav-item dropdown-item"> <i class="fas fa-id-card"></i> Settings</a></li>

                    <li class="dropdown-divider"></li>
                    <li class="nav-link"><a href="../../logout" class="nav-item dropdown-item"> <i class="fas fa-sign-out-alt"></i> Log out</a></li>
                  </ul>
                </li>
                <li class="separator d-lg-none"></li>
              </ul>
            </div>
          </div>
        </nav>

      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar -->
      <div class="content">

<div class="container">
  <div class="row">
    <div class="col-md-12">
        <?php if($query_message_for_delete == 1){echo ' <div class="alert alert-success">
              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
              <span> <strong><i class="fa fa-smile-o" aria-hidden="true"></i> Success! </strong> Internship Deleted Successfully </span>

            </div>';} if($query_message_for_delete == -1){echo ' <div class="alert alert-danger">
              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
              <span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i> Sorry!   </strong>  project could not be Deleted try again or contact the admin</span>

            </div>';} ?>


      <?php if($query_message_for_update == 1){echo ' <div class="alert alert-success">
        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
          <i class="tim-icons icon-simple-remove"></i>
        </button>
        <span> <strong><i class="fa fa-smile-o" aria-hidden="true"></i> Success! </strong> Internship Updated Successfully </span>

      </div>';} if($query_message_for_update == -1){echo ' <div class="alert alert-danger">
        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
          <i class="tim-icons icon-simple-remove"></i>
        </button>
        <span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i> Sorry!   </strong>  Internship could not be Updated try again or contact the admin</span>

      </div>';} ?>


      <?php if($query_message_for_notification == 1){echo ' <div class="alert alert-success">
        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
          <i class="tim-icons icon-simple-remove"></i>
        </button>
        <span> <strong><i class="fa fa-smile-o" aria-hidden="true"></i> Success! </strong> We are notified about the changes , we will look into it and Unblock it if possible , Stay Tuned !  </span>

      </div>';} if($query_message_for_notification == -1){echo ' <div class="alert alert-danger">
        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
          <i class="tim-icons icon-simple-remove"></i>
        </button>
        <span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i> Sorry!   </strong>  We didnot get notified , Please contact the admin or re-try</span>

      </div>';}
      if($query_message_for_notification == 2){echo ' <div class="alert alert-success">
        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
          <i class="tim-icons icon-simple-remove"></i>
        </button>
        <span> <strong> <i class="fa fa-smile-o fa-3x" aria-hidden="true"> </i> Do not  Worry!   </strong> We are notified again of your changes  ,  we will look into it and do the need full. </span>

      </div>';}


       ?>




      <?php if($query_message == 1){echo ' <div class="alert alert-success">
        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
          <i class="tim-icons icon-simple-remove"></i>
        </button>
        <span> <strong><i class="fa fa-smile-o" aria-hidden="true"></i> Success! </strong> Internship Created Successfully </span>

      </div>';} if($query_message == -1){echo ' <div class="alert alert-danger">
        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
          <i class="tim-icons icon-simple-remove"></i>
        </button>
        <span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i> Sorry!   </strong>  Internship could not be created try again or contact the admin</span>

      </div>';} ?>
    </div>
        <legend><h1 class="text-center text-primary ">Internship Forum</h1></legend>

    <!--<h1 class="text-center text-primary"></h1>-->
    <legend><h3 class="text-center pt-3">Quick  Overview</h3></legend>

    <div class="col-sm-6 col-md-4 mt-3">
        <div class="card">
            <div class="card-body bg-info">
                <div class="row">
                    <div class="col-3">
                      <i class="fa fa-users fa-5x" aria-hidden="true"></i>

                    </div>
                    <div class="col-9">
                       <div class="row">
                         <div class="col-12">
                           <h5 class="pull-right"> Internships</h5>
                             <h5 class="pull-right"> Total - </h5>


                         </div>
                         <div class="col-12">
                           <h6 class="pull-right mt-3 total_numbers">
                               <?php if (isset($total_internships)) {  echo $total_internships; }

                               ?>

                           </h6>
                         </div>
                       </div>
                    </div>
                </div>
            </div>
            <span >
                <div class="card-footer text-primary">
                    <span class="pull-left">Scroll Down</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                    <div class="clearfix"></div>
                </div>
            </span>
        </div>
     </div>

     <div class="col-sm-6 col-md-4 mt-3">
         <div class="card">
             <div class="card-body bg-primary">
                 <div class="row">
                     <div class="col-3">
                       <i class="fa fa-users fa-5x" aria-hidden="true"></i>

                     </div>
                     <div class="col-9">
                        <div class="row">
                          <div class="col-12">
                            <h5 class="pull-right"> Internships </h5>
                              <h5 class="pull-right"> Published  - </h5>


                          </div>
                          <div class="col-12">
                            <h6 class="pull-right mt-3 total_numbers">
                                <?php if (isset($published_internships)) {  echo $published_internships; }

                                ?>

                            </h6>
                          </div>
                        </div>
                     </div>
                 </div>
             </div>
             <span >
                 <div class="card-footer  text-primary">
                     <span class="pull-left">Scroll Down</span>
                     <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                     <div class="clearfix"></div>
                 </div>
             </span>
         </div>
      </div>


                   <div class="col-sm-6 col-md-4 mt-3">
                       <div class="card">
                           <div class="card-body bg-info">
                               <div class="row">
                                   <div class="col-3">
                                     <i class="fa fa-users fa-5x" aria-hidden="true"></i>

                                   </div>
                                   <div class="col-9">
                                      <div class="row">
                                        <div class="col-12">
                                          <h5 class="pull-right"> Internships </h5>
                                            <h5 class="pull-right"> Archived - </h5>


                                        </div>
                                        <div class="col-12">
                                          <h6 class="pull-right mt-3 total_numbers">
                                              <?php if (isset($archived_internships)) {  echo $archived_internships; }

                                              ?>

                                          </h6>
                                        </div>
                                      </div>
                                   </div>
                               </div>
                           </div>
                           <span >
                               <div class="card-footer  text-primary">
                                   <span class="pull-left">Scroll Down</span>
                                   <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                                   <div class="clearfix"></div>
                               </div>
                           </span>
                       </div>
                    </div>


                    <div class="col-sm-6 col-md-4 mt-3">
                        <div class="card">
                            <div class="card-body bg-danger">
                                <div class="row">
                                    <div class="col-3">
                                      <i class="fa fa-users fa-5x" aria-hidden="true"></i>

                                    </div>
                                    <div class="col-9">
                                       <div class="row">
                                         <div class="col-12">
                                           <h5 class="pull-right"> Internships </h5>
                                             <h5 class="pull-right"> Deleted - </h5>


                                         </div>
                                         <div class="col-12">
                                           <h6 class="pull-right mt-3 total_numbers">
                                               <?php if (isset($deleted_internships)) {  echo $deleted_internships; }

                                               ?>

                                           </h6>
                                         </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            <span>
                                <div class="card-footer  text-primary">
                                    <span class="pull-left">Scroll Down</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </span>
                        </div>
                     </div>

  </div>
</div>










                          <legend><h3 class="text-center pt-5">General  Analysis</h3></legend>



                                    <script src="../assets/js/core/jquery.min.js"></script>
                                      <script src="../assets/js/plugins/chartjs.min.js"></script>


                                      <div class="chart-container pb-5">
                                        <canvas id="bar-chartcanvas" style="height:75px;width:150px;"></canvas>

                                      </div>

                                    <script type="text/javascript">
                                      $(document).ready(function () {

                                      var ctx = $("#bar-chartcanvas");

                                      var data = {
                                        labels : ["Total ", "Active ", "Archived ", "Deleted "],
                                        datasets : [

                                          {


                                            label : "Count",
                                            data : [<?php if(isset($total_internships)){ echo $total_internships;} ?>, <?php if(isset($published_internships)){ echo $published_internships;} ?>,<?php if(isset($archived_internships)){ echo $archived_internships;} ?>,
                                               <?php if(isset($deleted_internships)){ echo $deleted_internships;} ?>],
                                            backgroundColor : [
                                              "rgba(50, 150, 250, 0.3)",
                                              "rgba(50, 150, 250, 0.3)",
                                              "rgba(50, 150, 250, 0.3)",
                                              "rgba(50, 150, 250, 0.3)",
                                              "rgba(50, 150, 250, 0.3)"
                                            ],
                                            borderColor : [
                                              "rgba(55, 150, 250, 1)",
                                              "rgba(55, 150, 250, 1)",
                                              "rgba(55, 150, 250, 1)",
                                              "rgba(55, 150, 250, 1)",
                                              "rgba(55, 150, 250, 1)"
                                            ],
                                            borderWidth : 2
                                          }
                                        ]
                                      };

                                      var options = {
                                        responsive:true,
                                        title : {
                                          display : true,
                                          position : "top",
                                          text : "",
                                          fontSize : 18
                                          // fontColor : "#111"
                                        },

                                        legend : {
                                          display : true,
                                          // position : "bottom"
                                        },
                                        scales : {
                                          yAxes : [{
                                            ticks : {
                                              min : 0
                                            }
                                          }]
                                        }
                                      };

                                      var chart = new Chart( ctx, {
                                        type : "bar",
                                        data : data,
                                        options : options
                                      });

                                    });
                                    </script>

        <div class="row pt-5">


          <div class="col-md-12">

            <div class="card card-plain pb-5">
              <div class="card-header">

              </div>

              <div class="card-body">





                <legend><h3 class="text-center pt-5 pb-0">Add Internship</h3></legend>

                          <div class="container">

                            <form class="" enctype="multipart/form-data" action="" method="post">

                        <div class="row gutters">
                              <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                <div class="card h-100">
                                  <div class="card-body">
                                    <!-- <div class="account-settings">
                                      <div class="user-profile">
                                        <div class="user-avatar">
                                          <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Maxwell Admin">
                                        </div>
                                        <h5 class="user-name">Yuki Hayashi</h5>
                                        <h6 class="user-email">yuki@Maxwell.com</h6>
                                      </div>
                                      <div class="about">
                                        <h5 class="mb-2 text-primary">About</h5>
                                        <p>I'm Yuki. Full Stack Designer I enjoy creating user-centric, delightful and human experiences.</p>
                                      </div>
                                    </div> -->
                                    <div class="">
                                      <h5 class="user-name pb-5">YOUR INTERNSHIP :</h5>
                            <img src="../../images/girl.svg" alt="" class="img-responsive img-fluid pt-5">

                                    </div>
                                  </div>
                                </div>
                              </div>



                              <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 pt-3">














                          		<div class="card h-100">
                          			<div class="card-body">

                          				<div class="row gutters">

                          					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                          						<h6 class="mb-3 text-primary">Internship Details</h6>
                          					</div>



                          					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          						<div class="form-group">
                          							<label for="fullName"> Company </label>
                          							<input type="text" class="form-control" id="fullName" name="internship_company" placeholder="Enter Company Name " required>
                          						</div>
                          					</div>


                          					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          						<div class="form-group">
                          							<label for="eMail"> Internship Role</label>
                          							<input type="text" class="form-control" id="eMail" name="internship_role" placeholder="Enter Internship Role " required>
                          						</div>
                          					</div>


                          					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          						<div class="form-group">
                          							<label for="phone">Internship Start Date</label>
                          							  <input type="Date"  class="form-control startDate " name="internship_start_date" onchange="dateFunction()"  id="Date" placeholder="Enter Internship start date" required>
                          						</div>
                          					</div>









                          					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          						<div class="form-group">
                          							<label for="website">Internship End Date </label>
                          						  <input type="Date" class="form-control mb-0 endDate" onchange="dateFunction()" name="internship_end_date"   id="Date" placeholder="" required>
                                        <label for="website" class="warning text-danger pull-right"></label>

                                      </div>
                          					</div>






                          <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                            <p>Internship Status</p>
                            <div class=" form-group">
                                <!-- <label for="">Status</label> -->
                                <select id="" class="form-control browser-default custom-select" name="internship_status" value="">
                                <option value="1" style="color:black;">Publish</option>
                                <option value="0" style="color:black;">Draft</option>

                            </select>
                            </div>
                          </div>

                          <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <label for="eMail"> Work Done</label>
         <textarea  class="form-control limit_description_add" name="internship_desc" rows="11" cols="80"
         maxlength="250" required ></textarea>

                            <!--<textarea class="form-control limit_description_add" name="internship_description " rows="10" cols="80" maxlength="250" required></textarea>-->
                <span class="pull-right " id=""> <span class="characters_limiting_add">250</span> Character(s) Remaining</span>
                            </div>
                          </div>




                        </div>
                        <div class="row gutters">


                          </div>
                        </div>




                          				<div class="row gutters">
                          					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pb-3 pr-4">
                          						<div class="text-right">

                          							<!-- <button type="button" id="submit" name="" class="btn btn-secondary">Cancel</button> -->
                          							<button type="submit" id="submit" name="create_internship" class="btn btn-primary ml-3">Add Internship</button>
                          						</div>
                          					</div>
                          				</div>





                                          </form>
                                        </div>
                                      </div>
                                      </div>
                                      </div>


</div>
  	</div>
    <legend><h3 class="text-center pt-5 pb-0">All Internships</h3></legend>

                        <div class="row ml pb-3 pl-2 pt-3">
                          <div class="col-md-4">
                            <p class="text-primary">  <i class="tim-icons icon-zoom-split " ></i> Search by Internship  Name : </p>
                            <div class="">
                              <div class="form-outline">
                                <input type="text" id="myInput" onkeyup="myFunction()"   class="form-control" >
                              </div>

                            </div>
                          </div>
                          <div class="col-md-8 ">
<a href="analysis#internships_comparision" class="pull-right btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" id="comparitive_analysis">Comparitive Analysis</a>
                          </div>
                        </div>






        </div>


        <div class="col-md-12 pl-3">


                          <table class="table    table-hover pt-5 Muted Text"  id="myTable" >
                            <thead class="thead-light">
                              <tr>
                                <th>S.No</th>
                                <th >Company</th>
                                <th >Role</th>
                                <th >Start Date</th>
                                <th >End Date</th>
                                <th >Description</th>
                                <th>Status</th>


                                <th colspan="2">Options</th>
                                <!-- <th></th> -->
                              </tr>
                            </thead>
                            <tbody class="text-success">


                              <?php

                                 $i =1;


                              // $user_id = $user_final_id;

foreach ($record3 as $rec ) :




                                  $internship_id           =     $rec["internship_id"];
                              $internship_company          =     $rec["internship_company"];

                              $internship_start_date       =     $rec["internship_start_date"];
                              $internship_status           =     $rec["internship_status"];
                              $internship_end_date         =     $rec["internship_end_date"] ;
                              $internship_role             =     $rec["internship_role"];
                              $internship_description      =     $rec["internship_description"];


                                if($internship_status!=-1){
                  ?>
                  <tr style="color:white;">
                  <td><?php echo $i; ?></td>
                  <td><?php echo $internship_company; ?></td>
                  <td><?php echo $internship_role; ?></td>
                  <td><?php echo  date(' d-m-y', strtotime($internship_start_date)) ;?></td>
                  <td><?php echo date(' d-m-y', strtotime($internship_end_date)) ; ?></td>
                  <td style="max-width: 40px; text-overflow: ellipsis;overflow: hidden;"><?php echo substr($internship_description,0,50) ; ?>...</td>
                  <td><?php if (isset($internship_status) ) {
          if ( $internship_status == 1) {
          ?><button  type="button" name="button" class="btn btn-sm btn-link text-primary">Published</button> <?php
          }elseif ( $internship_status == 0) {
          ?><button  name="button" class="btn btn-sm btn-link text-info">Archived</button> <?php
        }elseif ( $internship_status == -2) {
        ?><button  name="button" class="btn btn-sm btn-link text-danger">Blocked</button> <?php
      }elseif ( $internship_status == -3) {
      ?><button  name="button" class="btn btn-sm btn-link text-danger">Under Verification</button> <?php
    }

          } ?></td>

                  <td>


                  <button type="submit" name="edit_internship" data-status="<?php echo $internship_status  ?>"data-id="<?php echo $internship_id  ?>"
                  data-description="<?php echo htmlspecialchars($internship_description) ?>"
                     data-end_date="<?php echo $internship_end_date  ?>" data-start_date="<?php echo $internship_start_date  ?>" data-role="<?php echo $internship_role  ?>"
                     data-company="<?php echo $internship_company  ?>" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"  class="btn btn-success btn-sm">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>


                  </td>
                  <td>
                  <button type="submit" name="delete_internship"  data-id="<?php echo $internship_id; ?>" class="btn btn-danger confirm-delete btn-sm">  <i class="fa fa-trash-o" aria-hidden="true"></i></button>

                </td>

                </tr>

                  <?php
                            $i++; } endforeach;
                              ?>
                  </tbody>
                  </table>
              </div>

                  <div  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div  class="modal-dialog" role="document">
                      <div class="modal-content edit_modal_content">
                        <div class="modal-header " style="background-color:#1e1e2f">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class=" modal-body" style="background-color:#1e1e2f">





                                              <h5 class="user-name text-center"> EDIT INTERNSHIP :</h5>

                                    <div class="container">
                                      <form class="" enctype="multipart/form-data" action="" method="post">

                                    <div class="row gutters">




                                        <div class="card h-100">
                                          <div class="card-body">

                                            <div class="row gutters">

                                              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <h6 class="mb-3 text-primary">Internship Details</h6>
                                              </div>

                                              <input id="form_id" type="hidden" class="form-control" id="fullName" name="internship_id" placeholder="Enter Company Name "  >


                                              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                  <label for="fullName"> Company </label>
                                                  <input id="form_company" type="text" class="form-control" id="fullName" name="internship_company" placeholder="Enter Company Name " required >
                                                </div>
                                              </div>


                                              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                  <label for="eMail"> Internship Role</label>
                                                  <input id="form_role" type="text" class="form-control" id="eMail" name="internship_role" placeholder="Enter Internship Role " required>
                                                </div>
                                              </div>


                                              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                  <label for="phone">Internship Start Date</label>
                                                    <input id="form_start_date" type="Date"  class="form-control startDate" onchange="dateModalFunction()" name="internship_start_date"  id="Date" placeholder="Enter Internship start date" required>
                                                </div>
                                              </div>


                                              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                  <label for="website">Internship End Date </label>
                                                  <input id="form_end_date" type="Date" class="form-control mb-0 endDate" onchange="dateModalFunction()" name="internship_end_date"   id="Date" placeholder="" required>
                                                  <label for="website" class="modal_warning text-danger pull-right"></label>

                                                </div>
                                              </div>



                                              <div class="if_blocked_text pl-3 pb-3 pt-3" style="display:none">
                                                <input type="hidden" name="post_status_blocked" id="post_status_blocked" value="">
                                              <label class="">Internship Status </label>
                                              <p class="text-danger pb-3 action_text_if_blocked">Blocked by Admin</p>
                                              </div>


                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 select_input_block pb-3">

                                        <label for="form_status"> Internship Status</label>
                                      <div class=" form-group">
                                          <!-- <label for="">Status</label> -->
                                          <select id="form_status" class="form-control browser-default custom-select" name="internship_status" value="" required>
                                          <option value="1" style="color:black;">Publish</option>
                                          <option value="0" style="color:black;">Draft</option>

                                      </select>
                                      </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                      <div class="form-group">
                                        <label for="eMail"> Internship Description</label>
                                      <textarea id="form_description" class="form-control limit_description_edit" name="internship_description" rows="11" cols="80" maxlength="250" required></textarea>
                                <span class="pull-right " id="">
                           <span id="length_desc" class="characters_limiting_edit"></span> Character(s) Remaining</span>
                                      </div>
                                    </div>





                                            </div>
                                            <div class="row gutters">


                                              </div>
                                            </div>
                                            <div class="row gutters">
                                              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pb-3 pr-4">
                                                <div class="text-right">
                                                  <!-- <button type="button" id="submit" name="" class="btn btn-secondary">Cancel</button> -->
                                                </div>
                                              </div>
                                            </div>

                                          </div>


                                      </div>
                                    </div>
                                    </div>

                        <div class="modal-footer" style="background-color:#1e1e2f">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" name="edit_internship" class="btn btn-primary">Update Internship</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                  	<div style="background-color:#dc3545" class="modal-header ">
                      <h3 class="" id="myModalLabel">Delete Confirmation</h3>
                  		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                  	</div>
                  	<div class="modal-body">
                  		<p class="modal_content"></p>
                  	</div>
                  	<div class="modal-footer">
                  		<button class="btn mb-3" data-dismiss="modal" aria-hidden="true">Close</button>
                      <form class="" action="" method="post">
                        <input type="hidden" id="internship_id" name="internship_id" value="">
                        <button type="submit" name="delete_internship" class="btn btn-danger">Delete</button>
                      </form>
                  	</div>
                  </div>
                  </div>
                  </div>


            </div>





  <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x fa-spin"> </i>
      </a>
      <ul class="dropdown-menu">
        <li class="header-title"> Sidebar Background</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger background-color">
            <div class="badge-colors text-center">
              <span class="badge filter badge-primary active" data-color="primary"></span>
              <span class="badge filter badge-info" data-color="blue"></span>
              <span class="badge filter badge-success" data-color="green"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="adjustments-line text-center color-change">
          <span class="color-label">LIGHT MODE</span>
          <span class="badge light-badge mr-2"></span>
          <span class="badge dark-badge ml-2"></span>
          <span class="color-label">DARK MODE</span>
        </li>

      </ul>
    </div>
  </div>


  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- Place this tag in your head or just before your close body tag. -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>


   var maxLength_add = 250;
$('.limit_description_add').keyup(function() {
   var textlen_add =0;
   textlen_add = maxLength_add - $(this).val().length;
  
  if(textlen_add < 20){
    $('.characters_limiting_add').addClass('text-danger');
    $('.characters_limiting_add').text(textlen_add);
  }else {
    $('.characters_limiting_add').removeClass('text-danger');
    $('.characters_limiting_add').addClass('text-success');
    $('.characters_limiting_add').text(textlen_add);

  }
textlen_add =0;
});


  var maxLength_edit = 250;
$('.limit_description_edit').keyup(function() {
    var textlen_edit =0;
   textlen_edit = maxLength_edit - $(this).val().length;
  if(textlen_edit < 20){
    $('.characters_limiting_edit').addClass('text-danger');
    $('.characters_limiting_edit').text(textlen_edit);
  }else {
    $('.characters_limiting_edit').removeClass('text-danger');
    $('.characters_limiting_edit').addClass('text-success');
    $('.characters_limiting_edit').text(textlen_edit);

  }
textlen_edit =0;
});



function dateFunction(){
  var startDate = new Date($('.startDate').val());
var endDate = new Date($('.endDate').val());

if (startDate > endDate){
$('.warning').text("*Invalid date range");
$('.endDate').val(null);
}else{
  $('.warning').text("");

}
}
function dateModalFunction(){
  var startDate = new Date($('#form_start_date').val());
var endDate = new Date($('#form_end_date').val());

if (startDate > endDate){
$('.modal_warning').text("*Invalid date range");
$('#form_end_date').val(null);
}else{
  $('.modal_warning').text("");

}
}
  function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }



  if($(window).width() < 767)
  {
    
  $('#myTable').addClass('table-responsive');
    $('#comparitive_analysis').css("display", "none");
    $('#bar-chartcanvas').css("height", "100px");
  $('#bar-chartcanvas').css("width", "50px");

  }




  $('.confirm-delete').on('click', function(e) {
      e.preventDefault();
      var id = $(this).data('id');


      var modal_text= "Do you really want to delete this internship?";
      $('#myModal').data('id', id).modal('show');
      $(".modal-footer #internship_id").val( id );
         $(" .modal_content").text(modal_text);
  });



$('.add_internship').on('click',function(){
  $('#add_internship').css('display','block');
    $('.add_internship').css('display','none');
    $('.remove_internship').css('display','inline');
});


$('.remove_internship').on('click',function(){
    $('.add_internship').css('display','inline');
    $('#add_internship').css('display','none');
      $('.remove_internship').css('display','none');
});





  $('[data-toggle="modal"]').on('click', function(e) {
      e.preventDefault();
      var id =$(this).data('id');
      var end_date = $(this).data('end_date');
      var start_date = $(this).data('start_date');
      var role = $(this).data('role');
      var company = $(this).data('company');
      var description =$(this).data('description');
      var status = $(this).data('status');



      description_length = 250 - description.length;




      $("#form_id").val( id );
         $("#form_company").val( company );
         $("#form_description").val( description );
         $("#form_start_date").val( start_date );

         if(status == -2){
           $('.select_input_block').css("display", "none");
           $('.if_blocked_text').css("display", "inline");
           $("#post_status_blocked").val( -2 );



         }else if (status == -3) {
           $('.select_input_block').css("display", "none");
           $('.if_blocked_text').css("display", "inline");
           $('.action_text_if_blocked').html("Under Verification");
           $("#post_status_blocked").val( status );
         }
         else {
           $('.select_input_block').css("display", "inline");
           $('.if_blocked_text').css("display", "none");

           $("#form_status").val( status );

         }


         $("#form_end_date").val( end_date );
          $("#form_role").val( role );
if(description_length < 20){

 $("#length_desc").text(description_length);
 $('.characters_limiting_edit').addClass('text-danger');

}else{
  $('.characters_limiting_edit').removeClass('text-danger');
  $('.characters_limiting_edit').addClass('text-success');
  $("#length_desc").text(description_length);


}



  });

    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');
        $navbar = $('.navbar');
        $main_panel = $('.main-panel');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;
        white_color = false;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



        $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .background-color span').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data', new_color);
          }

          if ($main_panel.length != 0) {
            $main_panel.attr('data', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data', new_color);
          }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            sidebar_mini_active = false;
            blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
          } else {
            $('body').addClass('sidebar-mini');
            sidebar_mini_active = true;
            blackDashboard.showSidebarMessage('Sidebar mini activated...');
          }

          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);
        });

        $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (white_color == true) {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').removeClass('white-content');
            }, 900);
            white_color = false;
          } else {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').addClass('white-content');
            }, 900);

            white_color = true;
          }


        });

        $('.light-badge').click(function() {
          $('body').addClass('white-content');
        });

        $('.dark-badge').click(function() {
          $('body').removeClass('white-content');
        });
      });
    });
  </script>
 
</body>

</html>
<?php }else {
 include "../../404.html";

} ?>
