<?php include "admin_header.php" ?>

<?php include "db.php" ?>

<?php include "functions.php" ?>

<?php




if(isset($_SESSION["user_role"]) && isset($_SESSION["user_domain"]) && isset($_SESSION["user_id"]) && isset($_SESSION["user_email"]) && $_SESSION["user_role"] > -1 && !empty($_SESSION["user_domain"]) && !empty($_SESSION["user_email"]))
{



  $session_email =  encrypt_decrypt($_SESSION["user_email"], 'decrypt');
  $session_role =  encrypt_decrypt($_SESSION["user_role"], 'decrypt');
  $session_domain =  encrypt_decrypt($_SESSION["user_domain"], 'decrypt');
  $session_user_id =  encrypt_decrypt($_SESSION["user_id"], 'decrypt');
  $session_user_image =  encrypt_decrypt($_SESSION["user_image"], 'decrypt');
    $session_user_theme_setting  =  encrypt_decrypt($_SESSION["user_theme_setting"], 'decrypt');





 ?>


<?php
$query_message = 0;

if (isset($_POST["delete_post"])){

$delete_post_id=$_POST["delete_post_id"];
$edited_post_status=mysqli_query($connection,"UPDATE posts SET post_status=-1 WHERE post_id='$delete_post_id'");
if (!$edited_post_status) {
  // die("query failed yooo".mysqli_error($connection));
$query_message =-1;
}else {
  $query_message = 1;
}


}










if (isset($_POST["Registration_user_email"])) {




$user_session_email =  $_POST["user_email_after_registration"];

 $query = "SELECT user_id FROM users  WHERE user_email = '{$user_session_email}'";
 $found_user_id =  mysqli_query($connection,$query);
 if (!$found_user_id) {
   die("query failed yooo".mysqli_error($connection));
 }
 $my_id_array=mysqli_fetch_assoc($found_user_id);
$user_final_id=$my_id_array['user_id'];


}





if (isset($session_email) ) {

  $user_session_email = $session_email;

   $query = "SELECT user_id FROM users  WHERE user_email = '{$user_session_email}'";
   $found_user_id =  mysqli_query($connection,$query);
   if (!$found_user_id) {
     die("query failed yooo".mysqli_error($connection));
   }
   $my_id_array=mysqli_fetch_assoc($found_user_id);
  $user_final_id=$my_id_array['user_id'];
}


if (isset($session_user_id)) {
$user_final_id =$session_user_id;
}


  $user_session_email =$session_email;
$query = "SELECT * FROM users WHERE user_id = $user_final_id";
$user_details = mysqli_query($connection,$query);
if(!$user_details){
die("query failed ,yeah".mysqli_error($connection));
}else {

while ($row = mysqli_fetch_assoc($user_details)) {

$user_id                =     $row["user_id"];
$user_email             =     $row["user_email"];
$user_first_name        =     $row["user_first_name"];
$user_last_name         =     $row["user_last_name"];
$user_branch            =     $row["user_branch"];
$user_semester          =     $row["user_semester"];
$user_description       =     $row["user_description"];
$user_image             =     $row["user_image"];
$user_domain            =     $row["user_domain"];
$user_skills            =     $row["user_skills"];
$user_gender            =     $row["user_gender"];
$user_dob               =     $row["user_dob"];
$user_score             =     $row["user_score"];



}


}





 ?>







<?php

$total_sent_collaborations=0;
$total_received_collaborations=0;
$total_successful_collaborations =0;
$query = "SELECT  collab_status  FROM collaborate WHERE collab_sender_email='$user_session_email' OR collab_receiver_email='$user_session_email'" ;
$collab_details = mysqli_query($connection,$query);
if(!$collab_details){
die("query failed".mysqli_error($connection));
}else {
$record2 = array();
$total_collaboration = mysqli_num_rows($collab_details);
while ($row2 = mysqli_fetch_assoc($collab_details)) {
 $record2[] = $row2;


if($row2["collab_status"] == 1){
$total_successful_collaborations++;
}




}
}


 ?>







<?php



$query2="SELECT test_id FROM tests";
$test_details = mysqli_query($connection,$query2);
if(!$test_details){
die("query failed ,yeah".mysqli_error($connection));
}else {
$total_tests = mysqli_num_rows($test_details);


}

 ?>




<?php
$todays_notifications =0;
$query = "SELECT * FROM notifications WHERE  (notification_target = '$user_domain' OR notification_target = 'all' OR notification_target = '$session_email') AND notification_date = CURRENT_DATE AND notification_deadline > CURRENT_DATE ";
$notification_details_display = mysqli_query($connection,$query);
if(!$notification_details_display){
die("query failed".mysqli_error($connection));
}else {
  $todays_notifications = mysqli_num_rows($notification_details_display);
}


$published_internships =0;
$archived_internships=0;
$deleted_internships=0;
$internship_user_email = $session_email;
$query = "SELECT * FROM internships  WHERE internship_user_email = '{$internship_user_email}' ";
$internship_details = mysqli_query($connection,$query);

if(!$internship_details){
die("query failed".mysqli_error($connection));
}else {
  $total_internships = mysqli_num_rows($internship_details);
  while ($row = mysqli_fetch_assoc($internship_details)) {
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

}




 ?>



     <?php

          $total_active_posts= 0;
          $total_archived_posts=0;
          $total_deleted_posts=0;
          $total_likes=0;
           $post_user_email = $session_email;
           $query = "SELECT * FROM posts  WHERE post_user_email = '{$post_user_email}'";
           $post_details = mysqli_query($connection,$query);
           if(!$post_details){
           die("query failed".mysqli_error($connection));
           }
               $total_posts = mysqli_num_rows($post_details);

                           while ($row = mysqli_fetch_assoc($post_details)) {


                if($row["post_status"] == 0){
                   $total_active_posts++;
                }
                if($row["post_status"] == 1){
                   $total_archived_posts++;
                }
                if($row["post_status"] == -1){
                   $total_deleted_posts++;
                }

                $total_likes = $total_likes+$row["post_like_count"];

               }
      ?>


<?php

if (isset($_POST["delete_post"])) {
$post_id = $_POST["delete_post"];
echo $post_id;
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
CYBERATIC RVITM - Dashboard
  </title>

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

     <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/view_profile.css">

  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />

  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <link href="../assets/demo/demo.css" rel="stylesheet" />






<style>

.total_numbers{
  font-size: 30px;
}

  .chart-container {
width:  80%;
height: 600px;
margin: 0 auto;
}
  @media (max-width:700px) {
    .bio-row{
        width: 100%;

    }
    .panel-body{
      padding-left:0px;
    }
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
      <li class="active ">
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
      <li>
        <a href="notifications">
          <i class="tim-icons icon-bell-55"></i>
          <p>Notifications </p>
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
          <p> Tests</p>
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
            <a class="navbar-brand" href="javascript:void(0)">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
        <li class=" nav-item pt-2 text-primary">
                <?php $user_name           =          substr($user_email, 0, strpos($user_email, "_")); ?>

                      <span > <a target="_blank" href="../../profile.php/<?php echo $user_name.$user_semester; ?> " class="btn btn-success btn-sm pull-right view_profile">Your Profile
                      </a> </span>
              </li>
              <li class="dropdown nav-item">

                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                  <div class="photo">

                    <img src="../../images/<?php if(isset($user_image)){echo $user_image;} ?>" alt="Profile Photo">
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

        <div class="row ">
          <div class="col-lg-12">
<?php
if(isset($_SESSION["login_message"]) && $_SESSION["login_message"] ==1){
  ?>
  <div class="alert alert-success">
    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
      <i class="tim-icons icon-simple-remove"></i>
    </button>
    <span> <strong> </strong>  Hey <strong><?php $user_first_name  =   strtoupper($user_first_name); $user_last_name = strtoupper($user_last_name);  echo "$user_first_name  $user_last_name"; ?></strong>
      Welcome Back ,   Hope you are doing good!! <i class="fa fa-smile-o" aria-hidden="true"></i> </span>

  </div>


  <?php
$_SESSION["login_message"] =NULL;

}


 ?>
            <?php if($query_message == 1){echo ' <div class="alert alert-success">
              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
              <span> <strong><i class="fa fa-smile-o" aria-hidden="true"></i> Success! </strong>  Project Deleted   Successfully </span>

            </div>';} if($query_message == -1){echo ' <div class="alert alert-danger">
              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
              <span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i>  Sorry!   </strong>  Project  could not be Deleted try again or contact the admin</span>

            </div>';} ?>

        <div class="container ">



        <div class="row pb-5">

 <legend><h1 class="text-center text-primary pt-3">Dashboard</h1></legend>


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
                                 <h5 class="pull-right"> Score</h5>
                                   <h5 class="pull-right"> Your - </h5>


                               </div>
                               <div class="col-12">
                                 <h6 class="pull-right mt-3 total_numbers">
                                     <?php if (isset($user_score)) {  echo $user_score; }

                                     ?>

                                 </h6>
                               </div>
                             </div>
                          </div>
                      </div>
                  </div>
                  <a href="analysis">
                      <div class="card-footer">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
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
                                  <h5 class="pull-right"> Tests </h5>
                                    <h5 class="pull-right"> Total - </h5>


                                </div>
                                <div class="col-12">
                                  <h6 class="pull-right mt-3 total_numbers">
                                      <?php if (isset($total_tests)) {  echo $total_tests; }

                                      ?>

                                  </h6>
                                </div>
                              </div>
                           </div>
                       </div>
                   </div>
                   <a href="tests">
                       <div class="card-footer">
                           <span class="pull-left">View Details</span>
                           <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                           <div class="clearfix"></div>
                       </div>
                   </a>
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
                                                    <?php if (isset($todays_notifications)) {  echo $todays_notifications; }

                                                    ?>

                                                </h6>
                                              </div>
                                            </div>
                                         </div>
                                     </div>
                                 </div>
                                 <a href="notifications">
                                     <div class="card-footer">
                                         <span class="pull-left">View Details</span>
                                         <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                         <div class="clearfix"></div>
                                     </div>
                                 </a>
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
                                 <h5 class="pull-right"> Projects</h5>
                                   <h5 class="pull-right"> Total - </h5>


                               </div>
                               <div class="col-12">
                                 <h6 class="pull-right mt-3 total_numbers">
                                     <?php if (isset($total_posts)) {  echo $total_posts; }

                                     ?>

                                 </h6>
                               </div>
                             </div>
                          </div>
                      </div>
                  </div>
                  <a href="posts">
                      <div class="card-footer">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
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
                                       <h5 class="pull-right"> Total - </h5>


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
                      <a href="notifications">
                          <div class="card-footer">
                              <span class="pull-left">View Details</span>
                              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                              <div class="clearfix"></div>
                          </div>
                      </a>
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
                       <a href="internships">
                           <div class="card-footer">
                               <span class="pull-left">View Details</span>
                               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                               <div class="clearfix"></div>
                           </div>
                       </a>
                   </div>
                </div>










       

</div>
</div>
</div>


        </div>



        <legend><h1 class="text-center pt-5">General  Analysis</h1></legend>



                  <script src="../assets/js/core/jquery.min.js"></script>
                    <script src="../assets/js/plugins/chartjs.min.js"></script>


                    <div class="chart-container">
                      <canvas id="bar-chartcanvas" style="height:75px;width:150px;"></canvas>

                    </div>

                  <script type="text/javascript">
                    $(document).ready(function () {

                    var ctx = $("#bar-chartcanvas");

                    var data = {
                      labels : ["Score ", "tests ", "Posts ", "Collaborations " ,"Internships"],
                      datasets : [

                        {


                          label : "Count",
                          data : [<?php if(isset($user_score)){ echo $user_score;} ?>, <?php if(isset($total_tests)){ echo $total_tests;} ?>, <?php if(isset($total_posts)){ echo $total_posts;} ?>,
                             <?php if(isset($total_successful_collaborations)){ echo $total_successful_collaborations;} ?>, <?php if(isset($total_internships)){ echo $total_internships;} ?>],
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
$('table').addClass('table-responsive');
  $('#bar-chartcanvas').css("height", "100px");
  $('#bar-chartcanvas').css("width", "50px");
}

  $('.confirm-delete').on('click', function(e) {
      e.preventDefault();
      var id = $(this).data('id');

      var title = $(this).data('title');
      var modal_text= "Do you really want to delete project with title "+title+"?";
      $('#myModal').data('id', id).modal('show');
      $(".modal-footer #post_id").val( id );
         $(" .modal_content").text(modal_text);
  });


  $('#myModal').on('show', function() {
      var id = $(this).data('id'),
          removeBtn = $(this).find('.danger');
  })


  $('#btnYes').click(function() {
    	var id = $('#myModal').data('id');
    	$('[data-id='+id+']').remove();
    	$('#myModal').modal('hide');
  });

  function myFunction_to_submit() {
                  document.getElementById("GFG").submit();
              }

  $('.notification_ajax').on('click', function(){

    var with_userscore = $(this).data('notification_target');

    var notification_target = with_userscore.replace( "_" , " ");



        $post = $(this);

    $.ajax({
      url: 'notifications',
      type: 'post',
      data: {
        'notification_target_check': 1,

        'notification_target':notification_target

      },
      success: function(response){
window.location = "notifications";
      }
    });
  });


var todays_notifications = <?php echo $todays_notifications; ?>;
if(todays_notifications > 0){
  showNotification('top','center',1)
}
function showNotification(from, align,type) {
  var show_message ="You have <b>" + todays_notifications + "</b> notifications for today ";
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






  $(document).ready(function() {
    $().ready(function() {




      $sidebar = $('.sidebar');
      $navbar = $('.navbar');
      $main_panel = $('.main-panel');
      notification_button = $('.notification_button');

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

        if (notification_button.length != 0) {
          notification_button.attr('data', new_color);
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
  echo "Please go back to login page and return back";
} ?>
