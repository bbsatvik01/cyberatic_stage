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


?>


<?php
if(isset($_POST["delete_collab"])){

  $delete_collab_id= $_POST["delete_collab_id"];
  $edited_collab_status=mysqli_query($connection,"UPDATE collaborate SET collab_status=-1 WHERE collab_id='$delete_collab_id'");
  if (!$edited_collab_status) {
    // die("query failed yooo".mysqli_error($connection));
    $notification_update_message = ' <div class="alert alert-danger">  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">    <i class="tim-icons icon-simple-remove"></i>  </button> '.
    '  <span> <strong><i class="fa fa-smile-o" aria-hidden="true"></i> Failed! </strong>  Could Not Uncollaborate , some error Please Contact Admin .</span>  </div>';
  }else{
    $notification_update_message = ' <div class="alert alert-success">  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">    <i class="tim-icons icon-simple-remove"></i>  </button> '.
    '  <span> <strong><i class="fa fa-smile-o" aria-hidden="true"></i> Success! </strong> Uncollaborated Successfully! </span>  </div>';


  }
}



$user_session_email=$session_email;
$total_sent_collaborations = 0;
$total_successful_collaborations =0;
$total_received_collaborations=0;
$total_rejected_collaborations =0;

$query = "SELECT * FROM collaborate WHERE collab_sender_email='$user_session_email' OR collab_receiver_email='$user_session_email'  " ;
$collab_details = mysqli_query($connection,$query);
if(!$collab_details){
die("query failed".mysqli_error($connection));
}else {
$record = array();
$total_collaboration = mysqli_num_rows($collab_details);
while ($row = mysqli_fetch_assoc($collab_details)) {
 $record[] = $row;

 if($row["collab_status"] == 1){
 $total_successful_collaborations++;
 }

 if($row["collab_status"] == -1){
$total_rejected_collaborations++;
 }

 if($row["collab_sender_email"] == $user_session_email){
    $total_sent_collaborations++;
 }
 if($row["collab_receiver_email"] == $user_session_email){
    $total_received_collaborations++;
 }



}


}

 ?>


<?php
if (isset($_POST["notification_target"]) || $session_domain ) {


$notification_target =$session_domain;
$todays_notification_count = 0;
$today = date("Y-m-d");
$query = "SELECT * FROM notifications WHERE  (notification_target = '$notification_target' OR notification_target = 'all' OR notification_target = '$session_email') AND notification_date <= CURRENT_DATE AND notification_deadline > CURRENT_DATE  ORDER BY  notification_id  DESC ";
$notification_details_display = mysqli_query($connection,$query);
if(!$notification_details_display){
die("query failed".mysqli_error($connection));
}else {
      $notification_record = array();
      while ($row5 = mysqli_fetch_assoc($notification_details_display)) {

           $notification_record[] = $row5;
           if($row5["notification_date"] == $today){
          

              $todays_notification_count++;
          }
      }
}



}
 ?>







<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../images/logo.png">
  <title>
CYBERATIC RVITM - Notifications
  </title>

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <style media="screen">
  .total_numbers{
    font-size: 30px;
  }
    .chart-container {
width:  80%;
height: 600px;
margin: 0 auto;
}
  </style>
</head>

<body class="<?php if(isset($session_user_theme_setting)){if($session_user_theme_setting == 0){echo "";}else{echo "white-content";}} ?>">

  <div class="wrapper">
    <div class="sidebar">
     
    <div class="sidebar-wrapper ps">
          <div class="logo">
        <a href="javascript:void(0)" class="simple-text logo-mini">
 <span  class="pull-left" > <img src="../../images/logo.svg" style ="width:40px;height:40px; " alt="Profile Photo">  </span>
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
        <li>
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
        <li>
          <a href="timeline">
            <i class="tim-icons icon-pin"></i>
            <p>Timeline</p>
          </a>
        </li>
        <li class="active">
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
              <a class="navbar-brand" href="javascript:void(0)">Notifications</a>
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
                    </p>
                  </a>
                  <ul class="dropdown-menu dropdown-navbar">
                    <li class="nav-link"><a href="profile" class="nav-item dropdown-item"> <i class="fas fa-id-card"></i> Profile</a></li>
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











        <?php if(isset($notification_update_message)){
          echo $notification_update_message;
        }  ?>
         <legend><h1 class="text-center text-primary pt-2 pb-5">Notifications </h1></legend>


        <div class="row">

<div class="col-md-1">

</div>
          <div class="col-md-10">
            <legend><h4 class=" text-info pt-2 ">NOTIFICATIONS </h4></legend>

            <div class="card card-tasks">
              <div class="table-full-width table-responsive">

                <div class="card-header ">
                  <h6 class="title d-inline">Notifications</h6>
                  <p class="card-category d-inline">today</p>
                 
                </div>
              <div class="card-body">
                <?php






 foreach ($notification_record as $row5):






                  $notification_id              =       $row5["notification_id"];
                  $notification_date            =       $row5["notification_date"];
                  $notification_content         =       $row5["notification_content"];
                  $notification_link            =       $row5["notification_link"];
                  $notification_target          =       $row5["notification_target"];
                  $notification_type            =       $row5["notification_type"];

                ?>

                <?php
                           if($notification_type == "post_block" || $notification_type == "internship_block" || $notification_type == "post_delete" || $notification_type == "internship_delete" && $notification_target == $session_email ){
                             $notification_type_for_div = "alert alert-danger";
                           }elseif ($notification_type == "post_unblock" ||  $notification_type == "internship_unblock" ) {
                             $notification_type_for_div = "alert alert-success";
                           }
                           else {
                             $notification_type_for_div = $notification_type;
                           }


                 ?>

                <div class="<?php echo $notification_type_for_div; ?>">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times" style="font-size:20px;"></i>
                  </button>

                  <span>


                     <?php
                     // $blocked_post_internship ="";
                     if($notification_target == $session_email  ){
                       if($notification_type == "post_block"){
                         $blocked_post_internship = "Your Post  <strong>" . $notification_content ."</strong> has been  <strong>Blocked</strong> by admin as it violated our community rules , please change it or it would be deleted soon";

                       }elseif ($notification_type == "post_unblock") {
                         $blocked_post_internship = "Your Post   <strong>" . $notification_content ."</strong> has been  <strong> Un Blocked</strong> by admin as it met our community rules";

                       }elseif ($notification_type == "internship_block") {
                         $blocked_post_internship = "Your internship at  <strong>" . $notification_content ."</strong> has been  <strong>Blocked</strong> by admin as it violated our community rules , please change it or it would be deleted soon";

                       }
                       elseif ($notification_type == "internship_unblock") {
                         $blocked_post_internship = "Your internship at  <strong>" . $notification_content ."</strong> has been  <strong> Un Blocked</strong> by admin as it met our community rules";

                       }
                       elseif ($notification_type == "post_delete") {
                         $blocked_post_internship = "Your Post  <strong>" . $notification_content ."</strong> has been  <strong>Deleted</strong> by admin as it violated our community rules";

                       }
                       elseif ($notification_type == "internship_delete") {
                         $blocked_post_internship = "Your internship at  <strong>" . $notification_content ."</strong> has been  <strong>Deleted</strong> by admin as it violated our community rules";

                       }

                       echo $blocked_post_internship;
                     }else {
                          echo $notification_content;
                     }



                      ?>


                   </span>
                  <span class="pull-righ"> <a target="_blank" href="<?php echo $notification_link; ?>" class="btn btn-sm btn-primary t">Link</a> </span>
                </div>

                <?php


endforeach;


                 ?>
              </div>
            </div>
              </div>
          </div>
          <div class="col-md-1">

          </div>

          <div class="col-md-1">

          </div>

          <div class="col-md-10 pt-5">
            <legend><h4 class=" text-info pt-2 ">COLLABORATION REQUESTS </h4></legend>


            <div class="card card-tasks">
              <div class="table-full-width table-responsive">


                <div class="card-header ">
                  <h6 class="title d-inline">Colaboration Requests</h6>
                  <p class="card-category d-inline">Pending</p>
                 
                </div>

              <div class="card-body">

                <?php foreach ($record as $rec):

                if ($rec['collab_receiver_email']==$user_session_email && $rec['collab_status']==0  && $rec['collab_status']!=-1 ) {   ?>











            <div class="alert alert-info">
              <span>  <?php echo $rec['collab_sender_email']; ?> <span class="text-muted font-italic">wants to Collaborate with you!</span>
              <button type="submit" class=" accept btn btn-sm mt-0 btn-secondary pull-right"  data-emailid="<?php echo $rec['collab_sender_email']; ?>" data-collab_description ="<?php echo $rec['collab_description'];  ?>"
                 data-id="<?php echo $rec['collab_id']; ?>" ><i class="fa fa-check text-success"
              aria-hidden="true"></i></button>
              <button type=" submit" class="decline btn mt-0  btn-sm  pull-right" data-id="<?php echo $rec['collab_id']; ?>" ><i class="fa fa-times text-warning" aria-hidden="true"></i></button>


             <button style="display:none"  type=" submit" class="collaborated btn-sm mt-0 alert alert-success pull-right confirm-delete" data-email="<?php echo $rec['collab_sender_email']; ?>"
               data-collab_description ="<?php echo $rec['collab_description'];  ?>" data-id="<?php echo $rec['collab_id'] ?>">Collaborated</button>
              <button style="display:none"  type=" submit" class="declined  btn-sm mt-0 alert alert-warning pull-right" data-id="<?php echo $rec['collab_id']; ?>" >Cancelled</button>
            <p>Description : <span> <?php echo $rec['collab_description']; ?> </span>


             </p>


          </span>
            </div>

<?php } ?>
<?php endforeach; ?>
</div>

      </div>

</div>

</div>
<div class="col-md-1">

</div>
  </div>








  <div class="row pb-5 pt-5">

    <legend><h3 class="text-center pt-3">Quick  Overview</h3></legend>


    <div class="col-sm-6 col-md-4 mt-3">
        <div class="card ">
            <div class="card-body bg-info">
                <div class="row">
                    <div class="col-3">
                      <i class="fa fa-users fa-5x" aria-hidden="true"></i>

                    </div>
                    <div class="col-9">
                       <div class="row">
                         <div class="col-12">
                           <h5 class="pull-right"> Colaborations </h5>
                             <h5 class="pull-right"> Total - </h5>


                         </div>
                         <div class="col-12">
                           <h6 class="pull-right mt-3 total_numbers">
                               <?php if (isset($total_collaboration)) {  echo $total_collaboration; }

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
                             <h5 class="pull-right"> Colaborations </h5>
                               <h5 class="pull-right"> Recieved - </h5>


                           </div>
                           <div class="col-12">
                             <h6 class="pull-right mt-3 total_numbers">
                                 <?php if (isset($total_received_collaborations)) {  echo $total_received_collaborations; }

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




       <div class="col-sm-6 col-md-4 mt-3">
           <div class="card">
               <div class="card-body bg-warning">
                   <div class="row">
                       <div class="col-3">
                         <i class="fa fa-users fa-5x" aria-hidden="true"></i>

                       </div>
                       <div class="col-9">
                          <div class="row">
                            <div class="col-12">
                              <h5 class="pull-right"> Colaborations </h5>
                                <h5 class="pull-right"> Sent - </h5>


                            </div>
                            <div class="col-12">
                              <h6 class="pull-right mt-3 total_numbers">
                                  <?php if (isset($total_sent_collaborations)) {  echo $total_sent_collaborations; }

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



        <div class="col-sm-6 col-md-4 mt-3">
            <div class="card">
                <div class="card-body bg-warning">
                    <div class="row">
                        <div class="col-3">
                          <i class="fa fa-users fa-5x" aria-hidden="true"></i>

                        </div>
                        <div class="col-9">
                           <div class="row">
                             <div class="col-12">
                               <h5 class="pull-right"> Colaborations </h5>
                                 <h5 class="pull-right"> Accepted - </h5>


                             </div>
                             <div class="col-12">
                               <h6 class="pull-right mt-3 total_numbers">
                                   <?php if (isset($total_successful_collaborations)) {  echo $total_successful_collaborations; }

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
                                <h5 class="pull-right"> Colaborations </h5>
                                  <h5 class="pull-right"> Rejected - </h5>


                              </div>
                              <div class="col-12">
                                <h6 class="pull-right mt-3 total_numbers">
                                    <?php if (isset($total_rejected_collaborations)) {  echo $total_rejected_collaborations; }

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
                                 <h5 class="pull-right"> Notifications </h5>
                                   <h5 class="pull-right"> Today's - </h5>


                               </div>
                               <div class="col-12">
                                 <h6 class="pull-right mt-3 total_numbers">
                                     <?php if (isset($todays_notification_count)) {  echo $todays_notification_count; }

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




  <legend><h3 class="text-center pt-5">General  Analysis</h3></legend>







          <script src="../assets/js/core/jquery.min.js"></script>
                          <script src="../assets/js/plugins/chartjs.min.js"></script>


                          <div class="chart-container">
                            <canvas id="bar-chartcanvas" style="height:75px;width:150px;"></canvas>

                        	</div>

                        <script type="text/javascript">
                          $(document).ready(function () {

                        	var ctx = $("#bar-chartcanvas");

                        	var data = {
                        		labels : ["Total ", "Recieved ", "Sent ", "Accepted ", "Rejected"],
                        		datasets : [

                        			{


                        				label : "Count",
                        				data : [<?php if(isset($total_collaboration)){ echo $total_collaboration;} ?>, <?php if(isset($total_received_collaborations)){ echo $total_received_collaborations;} ?>, <?php if(isset($total_sent_collaborations)){ echo $total_sent_collaborations;} ?>, <?php if(isset($total_successful_collaborations)){ echo $total_successful_collaborations;} ?>, <?php if(isset($total_rejected_collaborations)){ echo $total_rejected_collaborations;} ?>],
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


























  <h3 class="text-center pt-3">Collaborations</h3>
<div class="row ">
  <div class="col-md-12  ">
    <div class=" ">



<div class="row ">


  <div class="col-md-12 pt-5  pb-5 ">

      <h4 class="card-title"> Requests Recieved</h4>

    <table class="table    table-hover  Muted Text   Muted Text myTable"   >
      <thead class="thead-light">
        <tr>
          <th style="width:1%">S.No</th>
          <th style="width:3%">Sender Email</th>
          <th style="width:90%">Description</th>
          <th style="width:3%">Status</th>


          <!-- <th></th> -->
        </tr>
      </thead>
      <tbody class="table-received">


        <?php
           $i =1;


             foreach ($record as $rec):

              if ($rec['collab_receiver_email']==$user_session_email &&  $rec['collab_status']==1 && $rec['collab_status']!=-1 ) {?>



<tr style="color:white;">
<td><?php echo $i; ?></td>
<td><?php echo $rec['collab_sender_email']; ?></td>
<td style="font-size:13px;"><?php echo $rec['collab_description']; ?></td>

<td>              <button   type=" submit" class="collaborated btn-sm  mb-0 alert alert-success confirm-delete" data-email="<?php echo $rec['collab_sender_email']; ?>" data-id="<?php echo $rec['collab_id'] ?>">Collaborated</button>
</td>

<?php   $i++;  }endforeach; ?>



</tr>



</tbody>
</table>
  </div>
  <div class="col-md-12    pt-5">

      <h4 class="card-title">Requests Sent</h4>

    <table class="table    table-hover  Muted Text float-right  myTable"  >
      <thead class="thead-light">
        <tr>
          <th>S.No</th>
          <th >Receiver Email</th>
          <th>Description</th>

          <th >Status</th>


          <!-- <th></th> -->
        </tr>
      </thead>
      <tbody>


        <?php
           $j =1;


             foreach ($record as $rec):

                if ($rec['collab_sender_email']==$user_session_email  && $rec['collab_status']!=-1   ){ ?>



<tr style="color:white;">
<td><?php echo $j; ?></td>
<td><?php echo $rec['collab_receiver_email']; ?></td>
<td style="font-size:13px;"><?php echo $rec['collab_description']; ?></td>


<td>            <?php if($rec['collab_status']==1) {?>

 <button   type=" submit" class="collaborated btn-sm  mb-0 alert alert-success confirm-delete " data-email="<?php  echo $rec['collab_receiver_email']; ?>" data-id="<?php echo $rec['collab_id'] ?>">Collaborated</button>
<?php }

elseif ($rec['collab_status']==0) {?>
  <button   type=" submit" class="collaborated btn-sm  mb-0 alert alert-primary confirm-cancel "  data-email="<?php  echo $rec['collab_receiver_email']; ?>" data-id="<?php echo $rec['collab_id'] ?>">Pending</button>
<?php  }?>

</td>

<?php  $j++;    }endforeach; ?>



</tr>



</tbody>
</table>
  </div>
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
        <input type="hidden" id="post_id" name="delete_collab_id" value="">
        <button type="submit" name="delete_collab" class="btn btn-danger">Delete</button>
      </form>
    </div>
  </div>
  </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script>
  <script src="../assets/demo/demo.js"></script>

  <script>
    if($(window).width() < 767)
  {

  $('#bar-chartcanvas').css("height", "100px");
  $('#bar-chartcanvas').css("width", "50px");
  $('.myTable').addClass('table-responsive');

  }

    $(document).ready(function() {
        
   var todays_notifications = <?php echo $todays_notification_count; ?>;
      if(todays_notifications > 0){
        showNotification('top','center',1)
      }
      function showNotification(from, align,type) {
        var show_message ="You have <b>" + todays_notifications + "</b> notifications for today";
        var   color = "primary";


       $.notify({
         icon: "tim-icons icon-bell-55",
         message :show_message

       }, {
         type: color,
         timer: 1000,
         placement: {
           from: from,
           align: align
         }
       });
      }

      $('.confirm-delete').on('click', function(e) {
          e.preventDefault();
          var id = $(this).data('id');

          var email = $(this).data('email');
          var modal_text= "Do you really want to cancel your collaboration with "+email+"?";
          $('#myModal').data('id', id).modal('show');
          $(".modal-footer #post_id").val( id );
             $(" .modal_content").text(modal_text);
      });

      $('.confirm-cancel').on('click', function(e) {
          e.preventDefault();
          var id = $(this).data('id');

          var email = $(this).data('email');
          var modal_text= "Do you really want to cancel your collaboration request with "+email+"?";
          $('#myModal').data('id', id).modal('show');
          $(".modal-footer #post_id").val( id );
             $(" .modal_content").text(modal_text);
      });


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




var slno= <?php echo $i; ?>;



          $('.accept').on('click', function(){
            var sessionEmail = $(this).data('user_session_email');
            var userEmail = $(this).data('emailid');
            var id = $(this).data('id');
            var collab_description = $(this).data('collab_description');





                $post = $(this);


            $.ajax({
              url: 'ajax',
              type: 'post',
              data: {
                'accept': 1,

                'collab_id':id

              },
              success: function(response){

               $('[data-id='+id+']').filter('.accept').css('display', 'none');
                $('[data-id='+id+']').filter('.decline').css('display', 'none');
               $('[data-id='+id+']').filter('.collaborated').css('display', 'inline');

          var markup = "<tr><td>"+slno+"</td> <td>"+userEmail+  "</td> <td>"+collab_description+  "</td>   <td>"+' <button  type="submit" class="collaborated btn-sm  mb-0 alert alert-success confirm-delete" data-email="'+userEmail+'" data-id=" '+id+'">Collaborated</button>  '+"    </td></tr>";





                               tableBody = $("table tbody").filter(".table-received");
                               tableBody.append(markup);

slno++;

              }
            });
          });

          // when the user clicks on unlike
          $('.decline').on('click', function(){
            var sessionEmail = $(this).data('user_session_email');
            var userEmail = $(this).data('user_email');
            var id = $(this).data('id');
            var collab_description = $(this).data('collab_description');

                $post = $(this);


            $.ajax({
              url: 'ajax',
              type: 'post',
              data: {
                'decline': 1,
                'collab_id':id

              },
              success: function(response){

               $('[data-id='+id+']').filter('.decline').css('display', 'none');
               $('[data-id='+id+']').filter('.accept').css('display', 'none');

               $('[data-id='+id+']').filter('.declined').css('display', 'inline');





              }
            });
          });
    });


  </script>
 
</body>

</html>

<?php }else {
  echo "Please go back to login page and return back";
} ?>
