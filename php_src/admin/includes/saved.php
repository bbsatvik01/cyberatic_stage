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





if(isset($_POST["saved_posts"])){
  $message="";
  $post_id= $_POST["saved_id"];

$post_str="";
  $temp_arr = explode (",", $post_id);

  foreach ($temp_arr as $id ) {

    $post_str.="$id','";
  }
  $post_str=substr($post_str, 0, -3);



$user_idd = $session_user_id;












$query = "SELECT * FROM posts WHERE post_status=1 AND post_id IN ('$post_str')   ORDER BY post_date DESC " ;
$post_details = mysqli_query($connection,$query);
if(!$post_details){
die("query failed".mysqli_error($connection));
}else {
$post_arr = array();
$total_posts_count =mysqli_num_rows($post_details);
while ($row = mysqli_fetch_assoc($post_details)) {
 $post_arr[] = $row;
$total_posts_count++;
// $post_id               =     $row["post_id"];
// $post_title            =     $row["post_title"];
// $post_user_email       =     $row["post_user_email"];
// $post_date             =     $row["post_date"];
// $post_link             =     $row["post_link"];
// $project_start_date     =     $row["project_start_date"];
// $project_end_date       =     $row["project_end_date"];
// $post_image            =     $row["post_image"];



}

$count = ceil($total_posts_count/10);

}

 ?>


<?php
$empty_flag = "";
  $for_user_fav = mysqli_query($connection,"SELECT 	user_favourite FROM users WHERE user_email = '$session_email' AND user_id = $session_user_id");
  $for_user_fav = mysqli_fetch_array($for_user_fav);
  $user_fav = $for_user_fav['user_favourite'];

    $fav_array = array();
    $fav_array = explode(",",$user_fav);
    $empty_flag = 0;




 ?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../images/logo.png">
  <title>
CYBERATIC RVITM - Saved
  </title>


  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />

      <link rel="stylesheet" href="../css/new_timeline.css">
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">








        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">





    <style media="screen">
*{
  padding: 0;
  margin: 0;
  font-size: 12px;

}
.dropdown-menu .dropdown-item, .bootstrap-select .dropdown-menu.inner li a {
  font-size: 1.3rem;

}
.navbar .navbar-brand {
    margin-left: 30px;
    margin-top: 15px;
    font-size: 1.6rem;
    padding-left: 20px;
}
legend{
  border-bottom: 0;
}
::-webkit-scrollbar {
display: none;
}
.nav>li>a:focus, .nav>li>a:hover {
    text-decoration: none;
     background-color: transparent;
}
.btn.btn-link:hover, .btn.btn-link:focus, .btn.btn-link:active, .navbar .navbar-nav>a.btn.btn-link:hover, .navbar .navbar-nav>a.btn.btn-link:focus, .navbar .navbar-nav>a.btn.btn-link:active {
    color: #db2dc0 !important;
   
}
.post_type{

  line-height: 1rem;
  font-size: 0.6rem;
  padding: 6px;

}
.post_image{
   height:300px;
   width:700px;
}
.user_name{
  padding: 3px;
  padding-top:0;


}
@media (max-width:576px){
  /* .btn-sm{
    font-size: 0.7rem;
    margin-left: 10px;
      border-radius: 0.2857rem;
      line-height: 0.55;
  } */
  .timeline .timeline-body {
      width: 240px;
      margin-left: 23%;
      margin-right: 17%;
      background: #fff;
      position: relative;
      padding: 20px 25px;
      border-radius: 6px;
  }


  .btn-sm {
    font-size: 0.45rem;
    margin-left: 0px;
    border-radius: 0.2857rem;
    line-height: 0.55;
}
  .timeline .timeline-time .time {
    line-height: 24px;
    font-size: 10px;

}

.timeline .timeline-time .date {
    line-height: 16px;
    font-size: 9px;
}

.post_title {
    color: black;
    font-size: 14px;
}

.post_link {
    font-size: 20px;
}

.view_profile {
    left: 20px;
}
.post_image{
    height: 150px;
}
.user_name{


}

    }

.fade{
  opacity: 1;
}
.btn-link:hover {
  color: brown;
  background-color: blue;
  border-color: white;
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
            <p>Projects Forum</p>
          </a>
        </li>
        <li class="">
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
            <p> Test Scores</p>
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
              <a class="navbar-brand" href="javascript:void(0)">Saved Posts</a>
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
                    <p class="d-lg-none">
                    </p>
                  </a>
                  <ul class="dropdown-menu dropdown-navbar">
                    <li class="nav-link"><a href="profile" class="nav-item dropdown-item"> <i class="fas fa-id-card"></i>Profile</a></li>
                   
                     <li class="nav-link"><a href="settings" class="nav-item dropdown-item"> <i class="fas fa-id-card"></i>Settings</a></li>

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
        <div class="">
          <div class="">
            <div class=" card-plain">
              <div class="card-header text-center">
                <?php if($total_posts_count!=0){ ?>
              <legend>
                  <h1 class="text-center text-primary pt-3">Saved Posts</h1>
                </legend>
                <?php
              } ?>
              </div>
              <div class="card-body">


<?php if($total_posts_count==0){
?>
  <div style="color:white;  text-align:center; padding-top:15%;" class="">
      <h1>No saved posts.</h1>
  </div>
  <?php
} ?>


                   <div class="row "><?php
                foreach ($post_arr as $rec) {



                            $post_type              =     $rec["post_type"];
                            $post_id                =     $rec["post_id"];
                            $post_image             =     $rec["post_image"];
                            $post_title             =     $rec["post_title"];
                            $project_start_date     =     $rec["project_start_date"] ;
                            $project_end_date       =     $rec["project_end_date"] ;
                            $post_link              =     $rec["post_link"];
                            $post_date              =     $rec["post_date"];
                            $post_description       =     $rec["post_description"];
                            $post_user_email        =     $rec["post_user_email"];


                            $query3 = "SELECT user_image, user_first_name, user_last_name,user_id ,user_semester FROM users WHERE user_email='{$post_user_email}'  " ;
                                   $user_details = mysqli_query($connection,$query3);
                                   if(!$user_details){
                                   die("query failed".mysqli_error($connection));
                                   }else {

                                   while ($row1 = mysqli_fetch_assoc($user_details)) {
                                            $user_id              =          $row1["user_id"];
                                            $user_image           =          $row1['user_image'];
                                            $user_first_name      =          $row1['user_first_name'];
                                            $user_last_name       =          $row1['user_last_name'];
                                            $user_semester        =          $row1['user_semester'];




                                            $user_name           =          substr($post_user_email, 0, strpos($post_user_email, "_"));
                                             $user_name           =          $user_name . $user_semester;

                                     ?>


                            



                        <div class="col-md-4 shadow_div">
                            <div  class="panel">


                                <div  class="panel-body">



                                      <div style="width:40%; position: absolute;" class="">
                                        <div style="display:inline;width:100px;height:100px;">
                                           <img src="../../images/<?php echo "$post_image"; ?>" class="img-fluid img-responsive img-circle" alt="..." style="display:inline;width:100px;height:100px;">
                                       </div>
                                      </div>




                                      <div  style="width:60%; margin-left:auto;" class="">
                                          
                                              <div class="timeline-header">


                                    <span>

                                            <a target="_blank" style="color:black;" class="font-italic" href="../../profile.php/<?php echo $user_name; ?> " class="user_name">
                                              <span class="userimage" >
                                                <img src="../../images/<?php echo $user_image; ?>" alt="" class="rounded ">
                                              </span><?php echo  $user_first_name .  " " . $user_last_name; ?>
                                            </a>

                                        </span>
                             <span class="pull-right ">
                                        <div class="dropdown " >
                                            
                                            
                                          <button   type="button" class="btn btn-link   dropdown-toggle btn-icon" data-toggle="dropdown">
                                            <i class="tim-icons icon-settings-gear-63 text-primary" ></i>
                                          </button>
                                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                             <a href="#" class="dropdown-item" data-id="<?php echo $rec["post_id"];  ?>" data-toggle="modal" data-target="#reportModal-1"  data-whatever="@getbootstrap"><i   class="fas fa-1x  fa-exclamation-circle report"> </i> Report </a>
                                            <?php if(count($fav_array)){
                                              $if_saved = in_array($rec['post_id'],$fav_array);
                                              if($if_saved){
                                                ?>  <a href="#" class="user_fav_unsave dropdown-item" data-id="<?php echo $rec["post_id"];  ?>" ><i class="fas fa-minus-square "> </i> UnSave</a>
                                               <a style="display:none;" href="#" data-id="<?php echo $rec["post_id"];  ?>" class="user_fav_click dropdown-item"><i class="fas fa-plus-square"> </i>
                                                Save </a>
                                              <?php
                                              }else {
                                                ?>
                                         <a href="#" style="display:none;" class="user_fav_unsave dropdown-item" data-id="<?php echo $rec["post_id"];  ?>" > <i class="fas fa-minus-square"> </i>
                                         UnSave</a>
                                     <a href="#" data-id="<?php echo $rec["post_id"];  ?>" class="user_fav_click dropdown-item"><i class="fas fa-plus-square"> </i> Save</a>
                                        <?php
                                              }
                                            }else {
                                            ?>
                                             <a style="display:none;" href="#" class="user_fav_unsave dropdown-item" data-id="<?php echo $rec["post_id"];  ?>" >
                                               <i class="fas fa-minus-square"> </i> UnSave</a>

                                       <a href="#" data-id="<?php echo $rec["post_id"];  ?>" class="user_fav_click dropdown-item"><i class="fas fa-plus-square"> </i> Save</a>
                                      <?php

                                            } ?>
                                          </div>
                                        </div>
                                    </span>    
                                     </div>

                                  <?php      }


                                      }

                                       ?>
                                         <button style="color: #e14eca; font-size: 1.5rem;" type="button" name="button"class="btn btn-link btn-sm pl-0" data-link="<?php echo $post_link; ?>" data-image="<?php echo $post_image;  ?>" data-type="<?php echo $post_type;  ?>" data-title="<?php echo $post_title;  ?>" data-start_date="<?php  echo date(' d F Y', strtotime($project_start_date));  ?>"
                                            data-end_date="<?php  echo date(' d F Y', strtotime($project_end_date));  ?>"
                                           data-description="<?php echo htmlspecialchars($post_description) ?>"
                                            data-toggle="modal" data-target="#exampleModal"  data-whatever="@getbootstrap" >
                                           <h4 class="red"><?php echo substr($post_title,0,26); if(strlen($post_title)>26){echo "...";} ?></h4>
                                         </button>

                                          <p style="color: #5e4e04; font-size: 1.5rem;">Started : <?php

                                          
                                          echo date(' d F Y', strtotime($project_start_date));
                                           ?></p>
                                           <p style="color: #5e4e04; font-size: 1.5rem;">Completion : <?php

                                          
                                          echo date(' d F Y', strtotime($project_end_date));
                                            ?></p>
                  <a target="_blank"  class="btn btn-primary btn-lg "  href="<?php echo "$post_link"; ?> "><i class="fa fa-github-square  pr-1  pt-0 mt-0 pb-0 post_link" aria-hidden="true"> </i> Git Link </a>


                                      </div>






                                </div>
                            </div>
                            </div>


                            <?php


                          }
                        ?>
                          </div>











                          <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">



                                <div class="modal-header  text-centre">
                                  <h3 class="modal-title model_type" id="exampleModalLabel">Details</h3>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>



                                <div class="modal-body mt-0">
                                  <div class="col-md-12 shadow_div">
                                      <div class="">

                                          <div class="panel-body ">

                                              <div style="width:40%; position: absolute; " class=" ">
                                                <div style="display:inline;width:100px;height:100px;">
                                                   <img src="" class="img-fluid img-responsive img-circle modal_image" alt="..." style="display:inline;width:100px;height:100px;">
                                                 </div>
                                              </div>
                                              <div style="width:60%; margin-left:auto;" class="  ">
                                                <h4 class="text-primary modal_title"></h4>
                                                 <p class="modal_description"></p>
                                                 <p>
                                                   <p class="modal_start_date"></p>
                                                   <p class="modal_end_date"></p>

                                                 </p>
                                                 <a target="_blank"  class="btn btn-primary model_link "  href=" "><i class="fa fa-github-square  pr-1  pt-0 mt-0 pb-0 post_link" aria-hidden="true"> </i> Git Link </a>


                                              </div>
                                          </div>
                                      </div>
                                      </div>
                                </div>
                                <div class="modal-footer  ">

                                    <button type="button" style="margin-left: auto;" class="btn btn-primary  btn-lg   " data-dismiss="modal">Close</button>



                                </div>
                                  </form>
                              </div>
                            </div>
                          </div>

  <div class="modal fade " id="reportModal-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">



        <div class="modal-header  text-centre">
          <h3 class="modal-title model_type " id="exampleModalLabel">Report</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>



        <div class="modal-body mt-0">
          <div class="col-md-12 shadow_div">
              <div class="">

                  <div class="panel-body row">


                      <div class="  bio-desk">
                        <h4 class="text-primary ">What are you reporting in this post?</h4>
                         <p class="">
                           <input type="radio"  name="report_field" value="Title">
                             <label ></label>
                           <label style="color:black; font-size:1rem;"for="html">Title</label>
                        <br>
                          <input type="radio"  name="report_field" value="Image">
                          <label ></label>
                          <label style="color:black; font-size:1rem;"for="html">Image</label>
                          <br>
                          <input type="radio"  name="report_field" value="Content">
                          <label ></label>
                          <label style="color:black; font-size:1rem;"for="html">Content</label>
                          <br>
                          <input type="radio"  name="report_field" value="Link">
                          <label ></label>
                          <label style="color:black; font-size:1rem;"for="html">Link</label>

                         </p>

                         <p>
                           <p class=""></p>
                           <p class=""></p>

                         </p>


                      </div>
                  </div>
              </div>
              </div>
        </div>
        <div class="modal-footer pull-right ">
          <button type="button" class="btn btn-secondary text-right pull-right " data-dismiss="modal">Close</button>
          <button  type="button" class="btn btn-primary text-right pull-right report_next " >Next</button>

        </div>
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade " id="reportModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">



        <div class="modal-header  text-centre">
          <h3 class="modal-title model_type " id="exampleModalLabel">Report</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>



        <div class="modal-body mt-0">
          <div class="col-md-12 shadow_div">
              <div class="">

                  <div class="panel-body row">


                      <div class="  bio-desk">
                        <h4 class="text-primary ">Why are you reporting this post?</h4>
                         <p class="">
                           <input type="radio"  name="report_reason" value="It's_spam">
                             <label ></label>
                           <label style="color:black; font-size:1rem;"for="html">It's spam</label>
                        <br>
                          <input type="radio"  name="report_reason" value="It's_inappropriate">
                          <label ></label>
                          <label style="color:black; font-size:1rem;"for="html">It's inappropriate</label>
                          <br>
                          <input type="radio"  name="report_reason" value="False_information">
                          <label ></label>
                          <label style="color:black; font-size:1rem;"for="html">False information</label>
                          <br>
                          <input type="radio"  name="report_reason" value="It's_offensive">
                          <label ></label>
                          <label style="color:black; font-size:1rem;"for="html">It's offensive</label>
                          <br>
                          <input type="radio"  name="report_reason" value="I_just_don't_like_it">
                          <label ></label>
                          <label style="color:black; font-size:1rem;"for="html">I just don't like it</label>


                         </p>

                         <p>
                           <p class=""></p>
                           <p class=""></p>

                         </p>


                      </div>
                  </div>
              </div>
              </div>
        </div>
        <div class="modal-footer pull-right ">
          <button type="button" class="btn btn-secondary text-right pull-right " data-dismiss="modal">Close</button>
          <button  type="button" class="btn btn-primary text-right pull-right report_next_2 " >Next</button>

        </div>
          </form>
      </div>
    </div>
  </div>












              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>


  <div class="modal fade" id="modalImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

      <!--Content-->
      <div class="modal-content">

        <!--Body-->
        <div class="modal-body mb-0 p-0">

          <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">

              <img class="embed-responsive-item" src=""
                  >
          </div>

        </div>

        <!--Footer-->


      </div>
     

    </div>
  </div>
</body>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script>
  <script src="../assets/demo/demo.js"></script>
  <script>




  $(document).ready(function(){
$('[data-target="#reportModal-1"]').unbind('click').on('click',function(e){
    e.preventDefault();
$('input[type="radio"][name="report_field"]').prop( "checked", false );
var post_report_id=$(this).data('id');
var report_sender= '<?php echo $session_email; ?>';
  $('.report_next').unbind('click').on('click',function(){
  var field= $('input[type="radio"][name="report_field"]:checked').val();
  if(field!= null){
     $("#reportModal-1").modal('hide');
     $('input[type="radio"][name="report_reason"]').prop( "checked", false );
     $("#reportModal-2").modal('show');
   }
     $('.report_next_2').unbind('click').on('click',function(){
       var reason = $('input[type="radio"][name="report_reason"]:checked').val();
         if(reason!= null){
       $.ajax({

         url: 'report',
         type: 'post',

         data: {
           'reported': 1,
           'post_id': post_report_id,
           'field':field,
           'reason':reason,
           'sender_email':report_sender,
         },
         success: function(response){
           field=null;
           $("#reportModal-2").modal('hide');
           if(response.trim()=="success"){
             var response_message = "You have successfully reported this post!";
          showNotification('top','center',1,response_message,1000);
         }
         else if(response.trim()=="exists"){
          var response_message =  "You have already reported this post!";
           showNotification('top','center',0,response_message,1000);

         }
         }
       });
     }
     });

});
});
  });

function showNotification(from, align,type,message,time) {

     var   color = "";
    if(type == 1){

      color = 'success';

    }else {

      color = 'danger';


    }

    $.notify({
      icon: "tim-icons icon-bell-55",
      message :message

    }, {
      type: color,
      timer: 10,
      placement: {
        from: from,
        align: align
      }
    });
  }



//image enlarge
  $('.post_image').on('click', function(){
    var source = $(this).data('image');
    $('.embed-responsive-item').attr("src", source);
  });





  $('[data-target="#exampleModal"]').on('click', function(e) {
      e.preventDefault();

      var type = $(this).data('type');
      var description = $(this).data('description');
      var end_date = $(this).data('end_date');
      var start_date = $(this).data('start_date');
      var title = $(this).data('title');
      var link = $(this).data('link');
      var image =$(this).data('image');
      

var description = description.replace("#$%^&*#$$%", ' " ');
  if(type==1){
    $(".model_type").text( "Project Deatails" );

  }else{
    $(".model_type").text( "Certification Deatails" );
  }

  $(".modal_title").text( title );
  $(".model_link").attr("href",link);
  $(".modal_start_date").text( "Started: "+start_date );
  $(".modal_end_date").text( "Completed: "+end_date );
  $(".modal_image").attr("src","../../images/"+image);
  $(".modal_description").text(description);


  });


  $('.user_fav_click').on('click', function(){
    var postid = $(this).data('id');

    $.ajax({
      url: 'save_post_ajax',
      type: 'post',
      data: {
        'user_fav': 1,
        'post_id': postid
      },
      success: function(response){

        if(response.trim()=="success"){
        var response_message = "Saved";
        $('[data-id='+postid+']').filter('.user_fav_click').css('display', 'none');
        $('[data-id='+postid+']').filter('.user_fav_unsave').css('display', 'inline');

       showNotification('top','center',1,response_message,100);

      }
      else if(response.trim()=="exists"){
      var response_message = "Already Saved";
     showNotification('top','center',0,response_message,100);

      }
      else if(response.trim()=="fail"){
      var response_message = "Something went wrong , try again later";
     showNotification('top','center',0,response_message,100);

      }





      }
    });
  });


  $('.user_fav_unsave').on('click', function(){
    var postid = $(this).data('id');

    $.ajax({
      url: 'save_post_ajax',
      type: 'post',
      data: {
        'user_fav_unsave': 1,
        'post_id': postid
      },
      success: function(response){

        if(response.trim()=="success"){
        var response_message = "UnSaved";
       showNotification('top','center',1,response_message,100);
       $('[data-id='+postid+']').filter('.user_fav_unsave').css('display', 'none');
       $('[data-id='+postid+']').filter('.user_fav_click').css('display', 'inline');

      }
      else if(response.trim()=="fail"){
      var response_message = "Something went wrong , try again later";
     showNotification('top','center',0,response_message,100);

      }
      else if(response.trim()=="dbfail"){
      var response_message = "Something went wrong , try again later";
     showNotification('top','center',0,response_message,100);

      }





      }
    });
  });






    $(document).ready(function(){

      $('.like').on('click', function(){
        var postid = $(this).data('id');
        var liked = $(this).data('liked');
        var likes = $(this).data('likes');
            $post = $(this);

        $.ajax({
          url: 'timeline',
          type: 'post',
          data: {
            'liked': 1,
            'post_id': postid
          },
          success: function(response){

           $('[data-id='+postid+']').filter('.like').css('display', 'none');
           $('[data-id='+postid+']').filter('.unlike').css('display', 'inline');
  if(liked=="yes"){
    $('[data-likes='+postid+']').filter('.likes_count').text(likes+1);

  }
  else {
    $('[data-likes='+postid+']').filter('.likes_count').text(likes);

  }




          }
        });
      });

      $('.unlike').on('click', function(){
        var postid = $(this).data('id');
        var liked = $(this).data('liked');
        var likes = $(this).data('likes');
          $post = $(this);

        $.ajax({
          url: 'timeline',
          type: 'post',
          data: {
            'unliked': 1,
            'post_id': postid
          },
          success: function(response){
            $('[data-id='+postid+']').filter('.like').css('display', 'inline');
            $('[data-id='+postid+']').filter('.unlike').css('display', 'none');
              if(liked=="yes"){

                  $('[data-likes='+postid+']').filter('.likes_count').text(likes-1);
                }
                else{
                $('[data-likes='+postid+']').filter('.likes_count').text(likes);
              }


          }
        });
      });
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

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
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

<?php
}else {
    echo "Please go back to your profile page and return.";
}


 }else {
  echo "Please go back to login page and return back";
} ?>
