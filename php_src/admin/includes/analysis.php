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






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../images/logo.png">
  <link rel="icon" type="image/png" href="../../images/logo.png">
  <title>
    CYBERATIC RVITM - Analysis
  </title>
  <style media="screen">


.panel,
.panel-body {
  box-shadow: none;
}

.panel-group .panel-heading {
  padding: 0;
}

.panel-group .panel-heading a {
  display: block;
  padding: 10px 15px;
  text-decoration: none;
  position: relative;
}

.panel-group .panel-heading a:after {
  content: '-';
  float: right;
}

.panel-group .panel-heading a.collapsed:after {
  content: '+';
}
</style>

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />

  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />

  <link href="../assets/demo/demo.css" rel="stylesheet" />
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
    <li class="active ">
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
          <a class="navbar-brand" href="javascript:void(0)">Analysis</a>
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
<?php
$k =0;
$user_email_id      =    $session_email;
$query_for_users = "SELECT * FROM users  ";
$user_details = mysqli_query($connection,$query_for_users);
if(!$user_details){
 die("query failed ,yeah".mysqli_error($connection));
}else {
$unique_emails =array();

while ($row = mysqli_fetch_assoc($user_details)) {
$unique_emails[$k] = $row["user_email"];

if($row["user_email"] ==  $session_email){


  $users_score[] = array(


     'user_score'        =>     $row["user_score"],
     'user_email'        =>     "Your Score"


  );
}else {
  $users_score[] = array(


     'user_score'        =>     $row["user_score"],
     'user_email'        =>     ""
  );
}

$k++;
}

}




function sortByMarks($a, $b) {
return $a['user_score'] > $b['user_score'];
}

for ($i=0; $i <count($users_score)   ; $i++) {
usort($users_score, 'sortByMarks');
}
// print_r($users_score);


 ?>






 <?php

                $total_active_posts= 0;
                $total_archived_posts=0;
                $total_deleted_posts=0;
                $total_likes=0;

             $post_user_email = $session_email;
             $query = "SELECT * FROM posts ";
             $post_details = mysqli_query($connection,$query);
             if(!$post_details){
             die("query failed".mysqli_error($connection));
             }
 $total_posts = mysqli_num_rows($post_details);
 $for_unique_users[] = array();
 $a=0;

             while ($row = mysqli_fetch_assoc($post_details)) {


$for_unique_users[$a] = $row["post_user_email"];
  $posts_array[] = array(

   'post_user_email' => $row["post_user_email"],
   'post_like_count' => $row["post_like_count"]


      );


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




$a++;
 }


$unique_users_array = array_unique($for_unique_users);
$unique_users_array = array_values($unique_users_array);



for ($i=0; $i < count($unique_users_array) ; $i++) {
  $post_count = 0;
  $post_likes = 0;
   for ($j=0; $j < count($posts_array) ; $j++) {
     if($unique_users_array[$i] == $posts_array[$j]["post_user_email"]){
             $post_count++;
             $post_likes =  $post_likes +  $posts_array[$j]["post_like_count"];
     }
   }
   if($unique_users_array[$i] == $session_email){
     $final_posts_count[] = array(

      'post_user_email' => "Your Score",
      'total_posts' => $post_count,
      'all_post_likes' => $post_likes


         );
   }else {
     $final_posts_count[] = array(

      'post_user_email' => "",
      'total_posts' => $post_count,
      'all_post_likes' => $post_likes


         );
   }


}




  ?>





<?php


$query = "SELECT  *  FROM collaborate WHERE collab_status = 1" ;
$collab_details = mysqli_query($connection,$query);
if(!$collab_details){
die("query failed".mysqli_error($connection));
}else {

while ($row = mysqli_fetch_assoc($collab_details)) {

  $collaborations[] =array(
    "collab_sender_email" => "$row[collab_sender_email]",
    "collab_receiver_email" => "$row[collab_receiver_email]",

  );






}
}

for ($i=0; $i < count($unique_emails); $i++) {
  $collab_count =0;
for ($j=0; $j < count( $collaborations); $j++) {
  if($unique_emails[$i] == $collaborations[$j]["collab_sender_email"] || $unique_emails[$i]==$collaborations[$j]["collab_receiver_email"]){


$collab_count=$collab_count+1;


  }

}
if($unique_emails[$i] == $session_email){

  $final_collaborations[] = array(

    "collab_name" => "Your Collabs",
    "collab_count" => $collab_count
  );


}else {
  $final_collaborations[] = array(

    "collab_name" => "",
    "collab_count" => $collab_count
  );
}


}


 ?>


<?php



  $j=0;
$internship_user_email = $session_email;
$query = "SELECT * FROM internships  ";
$internship_details = mysqli_query($connection,$query);
if(!$internship_details){
die("query failed".mysqli_error($connection));
}else {

  while ($row = mysqli_fetch_assoc($internship_details)) {
    $internships[$j] = $row["internship_user_email"];
    $j++;
  }

  for ($i=0; $i < count($unique_emails); $i++) {
    $internships_count =0;
  for ($j=0; $j < count( $internships); $j++) {

    if($unique_emails[$i] == $internships[$j]){
        $internships_count=$internships_count+1;
    }

  }
  if($unique_emails[$i] == $session_email){

    $final_internships[] = array(

      "internship_user_email" => "Your Internships",
      "internships_count" => $internships_count
    );


  }else {
    $final_internships[] = array(

      "internship_user_email" => "",
      "internships_count" => $internships_count
    );
  }


  }

}







 ?>







 
      <div class="content ">
                   <legend><h1 class="text-center text-primary pt-5 pb-5">Analysis </h1></legend>
<div class="phone_view_text" style="display:none">
    <h5 class="text-danger text-center">Please Switch to Desktop to view this page</h5>
</div>
        <div class="row main_div">

                  <div class="col-md-12 pt-5">
                    <div class="card card-plain">
                      <div class="card-header">

                      </div>
                      <div class="card-body">
                        <div class="col-md-12">
                          <legend><h1 class="text-center pt-3">  Score Comparision Analysis  <sub class="text-muted">(with other users)</sub> </h1></legend>

                          <canvas id="lineChart"></canvas>
                          <font face="Roboto, sans-serif"><span style="font-size: 16px; white-space: normal;">
                          </span></font>
                        </div>
                          <script src="../assets/js/core/jquery.min.js"></script>

                        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>


                        <script type="text/javascript">
                        var scores = new Array();
                        var only_test = new Array();
                        var tests = new Array();
                        var j =0;
                        tests = <?php echo json_encode($users_score); ?>;
                   
                        for (var i = 0; i < tests.length; i++) {
                        only_test[j]  =   tests[i]["user_email"] ;
                        scores [j]    =   tests[i]["user_score"];
                        j++;
                        }


                          var ctxL = document.getElementById("lineChart").getContext('2d');

                            var gradientFill = ctxL.createLinearGradient(0, 0, 0, 290);

                            gradientFill.addColorStop(0, "rgba(173, 53, 186, 1)");

                            gradientFill.addColorStop(1, "rgba(173, 53, 186, 0.1)");

                            var myLineChart = new Chart(ctxL, {

                              type: 'line',

                              data: {

                                labels: only_test,

                                datasets: [

                                  {

                                    label: "",

                                    data: scores ,

                                    backgroundColor: gradientFill,

                                    borderColor: [

                                      '#AD35BA',

                                    ],

                                    borderWidth: 2,

                                    pointBorderColor: "#fff",

                                    pointBackgroundColor: "rgba(173, 53, 186, 0.1)",

                                  }

                                ]

                              },

                              options: {

                                responsive: true

                              }

                            });

                        </script>
                        <!--Grid column-->

                        <!--Grid column-->
                      </div>
                    </div>
                  </div>






                  <div class="col-md-12 pt-5 pb-3">
                    <div class="card card-plain">
                      <div class="card-header">

                      </div>
                      <div class="card-body">
                        <div class="col-md-12">
                          <div class="" id="project_comparision">
                            <legend><h1 class="text-center pt-3">Project Comparision Analysis <sub class="text-muted">(with other users)</sub> </h1></legend>

                            <canvas id="lineChart2"></canvas>

                          </div>
                          <font face="Roboto, sans-serif"><span style="font-size: 16px; white-space: normal;">
                          </span></font>
                        </div>
                       


                        <script type="text/javascript">
                        var master_posts = new Array();
                        var only_user_post = new Array();
                        var post_counts = new Array();
                        var k =0;

                        master_posts = <?php echo json_encode($final_posts_count); ?>;
                   
                        for (var i = 0; i < master_posts.length; i++) {
                          if(master_posts[i]["post_user_email"] == "Your Score"){
                            only_user_post[k]   = "Your Projects" ;
                          }else {

                          only_user_post[k]   = "" ;
                          }
                            post_counts[k]      = master_posts[i]["total_posts"];
                          k++;
                        }
                        only_user_post[only_user_post.length] = "  ";
                        post_counts[post_counts.length] = "";


                          var ctxL = document.getElementById("lineChart2").getContext('2d');

                            var gradientFill = ctxL.createLinearGradient(0, 0, 0, 290);

                            gradientFill.addColorStop(0, "rgba(173, 53, 186, 1)");

                            gradientFill.addColorStop(1, "rgba(173, 53, 186, 0.1)");

                            var myLineChart = new Chart(ctxL, {

                              type: 'line',

                              data: {

                                labels: only_user_post,

                                datasets: [

                                  {

                                    label: "",

                                    data: post_counts ,

                                    backgroundColor: gradientFill,

                                    borderColor: [

                                      '#AD35BA',

                                    ],

                                    borderWidth: 2,

                                    pointBorderColor: "#fff",

                                    pointBackgroundColor: "rgba(173, 53, 186, 0.1)",

                                  }

                                ]

                              },

                              options: {

                                responsive: true

                              }

                            });

                        </script>
                      </div>
                    </div>
                  </div>


                                          <div class="col-md-12 pt-5 pb-3">
                                            <div class="card card-plain">
                                              <div class="card-header">

                                              </div>
                                              <div class="card-body">
                                                <div class="col-md-12">
                                                  <legend><h1 class="text-center pt-3">Project Likes Analysis <sub class="text-muted">(with other users)</sub> </h1></legend>

                                                  <canvas id="lineChart3"></canvas>
                                                  <font face="Roboto, sans-serif"><span style="font-size: 16px; white-space: normal;">
                                                  </span></font>
                                                </div>
                                               


                                                <script type="text/javascript">
                                                var master_posts = new Array();
                                                var only_user_post = new Array();
                                                var likes_counts = new Array();
                                                var k =0;

                                                master_posts = <?php echo json_encode($final_posts_count); ?>;
                                               
                                                for (var i = 0; i < master_posts.length; i++) {
                                                  if(master_posts[i]["post_user_email"] == "Your Score"){
                                                    only_user_post[k]   = "Your Likes" ;
                                                  }else {

                                                  only_user_post[k]   = "" ;
                                                  }

                                                    likes_counts[k]      = master_posts[i]["all_post_likes"];
                                                  k++;
                                                }
                                                only_user_post[only_user_post.length] = "  ";
                                                likes_counts[likes_counts.length] = "";


                                                  var ctxL = document.getElementById("lineChart3").getContext('2d');

                                                    var gradientFill = ctxL.createLinearGradient(0, 0, 0, 290);

                                                    gradientFill.addColorStop(0, "rgba(173, 53, 186, 1)");

                                                    gradientFill.addColorStop(1, "rgba(173, 53, 186, 0.1)");

                                                    var myLineChart = new Chart(ctxL, {

                                                      type: 'line',

                                                      data: {

                                                        labels: only_user_post,

                                                        datasets: [

                                                          {

                                                            label: "",

                                                            data: likes_counts ,

                                                            backgroundColor: gradientFill,

                                                            borderColor: [

                                                              '#AD35BA',

                                                            ],

                                                            borderWidth: 2,

                                                            pointBorderColor: "#fff",

                                                            pointBackgroundColor: "rgba(173, 53, 186, 0.1)",

                                                          }

                                                        ]

                                                      },

                                                      options: {

                                                        responsive: true

                                                      }

                                                    });

                                                </script>
                                              </div>
                                            </div>
                                          </div>




                                                <div class="col-md-12 pt-5 pb-3">
                                                  <div class="card card-plain">
                                                    <div class="card-header">

                                                    </div>
                                                    <div class="card-body">
                                                      <div class="col-md-12">
                                                        <legend><h1 class="text-center pt-3">Your Collaborations Comparision <sub class="text-muted">(with other users)</sub>  </h1></legend>

                                                        <canvas id="lineChart4"></canvas>
                                                        <font face="Roboto, sans-serif"><span style="font-size: 16px; white-space: normal;">
                                                        </span></font>
                                                      </div>
                                                     


                                                      <script type="text/javascript">
                                                      var master_collab = new Array();
                                                      var only_callb_user = new Array();
                                                      var collab_counts = new Array();
                                                      var k =0;

                                                      master_collab = <?php echo json_encode($final_collaborations); ?>;
                                                
                                                
                                                      for (var i = 0; i < master_collab.length; i++) {
                                                          only_callb_user[k]   = master_collab[i]["collab_name"];
                                                          collab_counts[k]      = master_collab[i]["collab_count"];
                                                        k++;
                                                      }
                                                      only_user_post[only_user_post.length] = "  ";
                                                      likes_counts[likes_counts.length] = "";


                                                        var ctxL = document.getElementById("lineChart4").getContext('2d');

                                                          var gradientFill = ctxL.createLinearGradient(0, 0, 0, 290);

                                                          gradientFill.addColorStop(0, "rgba(173, 53, 186, 1)");

                                                          gradientFill.addColorStop(1, "rgba(173, 53, 186, 0.1)");

                                                          var myLineChart = new Chart(ctxL, {

                                                            type: 'line',

                                                            data: {

                                                              labels: only_callb_user,

                                                              datasets: [

                                                                {

                                                                  label: "",

                                                                  data: collab_counts ,

                                                                  backgroundColor: gradientFill,

                                                                  borderColor: [

                                                                    '#AD35BA',

                                                                  ],

                                                                  borderWidth: 2,

                                                                  pointBorderColor: "#fff",

                                                                  pointBackgroundColor: "rgba(173, 53, 186, 0.1)",

                                                                }

                                                              ]

                                                            },

                                                            options: {

                                                              responsive: true

                                                            }

                                                          });

                                                      </script>
                                                    </div>
                                                  </div>
                                                </div>





                                                      <div class="col-md-12 pt-5 pb-3">
                                                        <div class="card card-plain">
                                                          <div class="card-header">

                                                          </div>
                                                          <div class="card-body">
                                                            <div class="col-md-12">

                                                              <div class="" id="internships_comparision">
                                                                <legend><h1 class="text-center pt-3">Your Internships Comparision <sub class="text-muted">(with other users)</sub> </h1></legend>
                                                               <canvas id="lineChart5"></canvas>
                                                              </div>

                                                              <font face="Roboto, sans-serif"><span style="font-size: 16px; white-space: normal;">
                                                              </span></font>
                                                            </div>
                                                           


                                                            <script type="text/javascript">
                                                            var master_internships = new Array();
                                                            var only_internship_user = new Array();
                                                            var internship_counts = new Array();
                                                            var k =0;

                                                            master_internships = <?php echo json_encode($final_internships); ?>;
                                                           
                                                            for (var i = 0; i < master_internships.length; i++) {
                                                                only_internship_user[k]   = master_internships[i]["internship_user_email"];
                                                                internship_counts[k]      = master_internships[i]["internships_count"];
                                                              k++;
                                                            }
                                                            only_internship_user[only_user_post.length] = "  ";
                                                            internship_counts[likes_counts.length] = "";


                                                              var ctxL = document.getElementById("lineChart5").getContext('2d');

                                                                var gradientFill = ctxL.createLinearGradient(0, 0, 0, 290);

                                                                gradientFill.addColorStop(0, "rgba(173, 53, 186, 1)");

                                                                gradientFill.addColorStop(1, "rgba(173, 53, 186, 0.1)");

                                                                var myLineChart = new Chart(ctxL, {

                                                                  type: 'line',

                                                                  data: {

                                                                    labels: only_internship_user,

                                                                    datasets: [

                                                                      {

                                                                        label: "",

                                                                        data: internship_counts ,

                                                                        backgroundColor: gradientFill,

                                                                        borderColor: [

                                                                          '#AD35BA',

                                                                        ],

                                                                        borderWidth: 2,

                                                                        pointBorderColor: "#fff",

                                                                        pointBackgroundColor: "rgba(173, 53, 186, 0.1)",

                                                                      }

                                                                    ]

                                                                  },

                                                                  options: {

                                                                    responsive: true

                                                                  }

                                                                });

                                                            </script>

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


    $('.main_div').css("display", "none");
    $('.phone_view_text').css("display","block");

  }


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
  echo "Please go back to login page and return back";
} ?>
