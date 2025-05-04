<?php include "admin_header.php" ?>
<?php include "functions.php" ?>
<?php include "db.php" ?>

<?php

if(isset($_SESSION["user_role"]) && isset($_SESSION["user_domain"]) && isset($_SESSION["user_id"]) && isset($_SESSION["user_email"]) && $_SESSION["user_role"] > -1 && !empty($_SESSION["user_domain"]) && !empty($_SESSION["user_email"]))
{

  $session_email           =          encrypt_decrypt($_SESSION["user_email"], 'decrypt');
  $session_role            =          encrypt_decrypt($_SESSION["user_role"], 'decrypt');
  $session_domain          =          encrypt_decrypt($_SESSION["user_domain"], 'decrypt');
  $session_user_id             =          encrypt_decrypt($_SESSION["user_id"], 'decrypt');
  $session_user_image          =          encrypt_decrypt($_SESSION["user_image"], 'decrypt');
  $session_user_theme_setting  =  encrypt_decrypt($_SESSION["user_theme_setting"], 'decrypt');

?>


<?php

$change_user_view_email = "";
$change_user_theme_setting = "";

if(isset($_POST["change_email_settings"])){

$form_user_id_collab = escape($_POST["user_id"]);


    

if(isset($_POST["user_view_email_setting"])){
  $user_view_email = 0;

}else {
   $user_view_email = 1;
}

if($form_user_id_collab == $session_user_id){
  $query = "UPDATE users SET user_view_email = $user_view_email  WHERE user_id = $form_user_id_collab";

      $user_details = mysqli_query($connection , $query);
          if(!$user_details){
                die("query failed".mysqli_error($connection));
                $change_user_view_email  =-1;
          }else {
                $change_user_view_email = 1;
         }
}





}





if(isset($_POST["change_user_theme_setting"])){

$form_user_id_theme = escape($_POST["user_id"]);

if($form_user_id_theme == $session_user_id) {
    

if(isset($_POST["user_theme_setting"])){
  $user_theme_setting = 0;

}else {
   $user_theme_setting = 1;
}

if($form_user_id_theme == $session_user_id){
  $query = "UPDATE users SET user_theme_setting = $user_theme_setting  WHERE user_id = $form_user_id_theme";

      $user_details = mysqli_query($connection , $query);
          if(!$user_details){
                die("query failed".mysqli_error($connection));
                $change_user_theme_setting  =-1;
          }else {
                $_SESSION["user_theme_setting"]       = encrypt_decrypt($user_theme_setting, 'encrypt');
                $session_user_theme_setting           = encrypt_decrypt($_SESSION["user_theme_setting"], 'decrypt');
                $change_user_theme_setting = 1;
         }
}


}else{
    echo "ssss";
    $change_user_theme_setting  =-1;

}
}




 ?>

<?php
if (isset($session_user_id)) {

$change_password_error= "";
$query_message = 0;

  $user_id = $session_user_id ;

  $query = "SELECT * FROM users WHERE user_id = $user_id";
  $user_details = mysqli_query($connection,$query);
  if(!$user_details){
  die("query failed".mysqli_error($connection));
  }else {

  while ($row = mysqli_fetch_assoc($user_details)) {

  $user_id                =     $row["user_id"];
  $db_user_password       =     $row["user_password"];
  $user_email             =     $row["user_email"];
  $user_first_name        =     $row["user_first_name"];
  $user_last_name         =     $row["user_last_name"];
  $user_description       =     $row["user_description"];
  $user_imagee            =     $row["user_image"];
  $user_domain            =     $row["user_domain"];
  $user_view_email        =     $row["user_view_email"];
  $user_theme_setting     =     $row["user_theme_setting"];





  }






  }




  if (isset($_POST["submitted_user_details"])) {

     $current_password          =        escape($_POST["current_password"]);
     $new_password              =        escape($_POST["new_password"]);
     $re_Confirmed_password     =        escape($_POST["re_Confirmed_password"]);
     $user_form_email           =        escape($_POST["user_email"]);

      if(password_verify($current_password,$db_user_password) && $user_form_email == $session_email){

        $change_password_error =  change_password ($re_Confirmed_password,$new_password,$user_form_email);



     }else {
       $change_password_error = -3;
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
CYBERATIC RVITM - Settings
  </title>

<style media="screen">
#tagpills {
float: left;
/* border: 1px solid #ccc; */
padding: 4px;
font-family: Arial;
}

 span.tag {
cursor: pointer;
display: block;
float: left;
/* color: #555; */
/* background: #add; */
padding: 5px 10px;
padding-right: 30px;
margin: 4px;
}

 /* span.tag:hover {
opacity: 0.7;
} */

 span.tag:after {
position: absolute;
content: "x";
border: 1px solid;
border-radius: 10px;
padding: 0 4px;
margin: 3px 0 10px 7px;
font-size: 10px;
}

/* #tags input {
background: #eee;
border: 0;
margin: 4px;
padding: 7px;
width: auto;
} */
</style>

<style media="screen">
  option{
    color: black !important;

  }
  .image_upload{
    cursor: pointer;
  }



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

<style media="screen">
.switch {
position: relative;
display: inline-block;
width: 60px;
height: 34px;
}

.switch input {
opacity: 0;
width: 0;
height: 0;
}

.slider {
position: absolute;
cursor: pointer;
top: 0;
left: 0;
right: 0;
bottom: 0;
background-color: #ccc;
-webkit-transition: .4s;
transition: .4s;
}

.slider:before {
position: absolute;
content: "";
height: 26px;
width: 26px;
left: 4px;
bottom: 4px;
background-color: white;
-webkit-transition: .4s;
transition: .4s;
}

input:checked + .slider {
background-color: #2196F3;
}

input:focus + .slider {
box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
-webkit-transform: translateX(26px);
-ms-transform: translateX(26px);
transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
border-radius: 34px;
}

.slider.round:before {
border-radius: 50%;
}
</style>



  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

  



 
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
              <a class="navbar-brand" href="javascript:void(0)">User Settings</a>
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
                      <img src="../../images/<?php  if(isset($session_user_image)){echo $session_user_image;}   ?>" alt="Profile Photo">
                    </div>
                    <b class="caret d-none d-lg-block d-xl-block"></b>
                    <p class="d-lg-none">
                      <!-- Log out -->
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
        <div class="row">
<div class="col-md-12">
  <?php if($change_password_error == 1){echo ' <div class="alert alert-success">
    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
      <i class="tim-icons icon-simple-remove"></i>
    </button>
    <span> <strong><i class="fa fa-smile-o" aria-hidden="true"></i> Success! </strong>  Your Password Has Been Changed  Successfully .</span>

  </div>';} if($change_password_error == -1){echo ' <div class="alert alert-danger">
    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
      <i class="tim-icons icon-simple-remove"></i>
    </button>
    <span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i>  Sorry!   </strong> Your Password Could Not Be  Changed   Please Contact Admin .</span>

  </div>';}  if($change_password_error == -2){echo ' <div class="alert alert-danger">
    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
      <i class="tim-icons icon-simple-remove"></i>
    </button>
    <span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i>  Sorry!   </strong> New Password and Re-Entered Password do not match please try again .</span>

  </div>';}  if($change_password_error == -3){echo ' <div class="alert alert-danger">
    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
      <i class="tim-icons icon-simple-remove"></i>
    </button>
    <span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i>  Sorry!   </strong> Your Current Password is wrong please try again .   </span>

  </div>';}

  ?>

<?php




if($change_user_view_email == 1){echo ' <div class="alert alert-success">
  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
    <i class="tim-icons icon-simple-remove"></i>
  </button>
  <span> <strong><i class="fa fa-smile-o" aria-hidden="true"></i> Success! </strong>  Your Collaboration Email setting  Has Been Changed  Successfully .</span>

</div>';} if($change_user_view_email == -1){echo ' <div class="alert alert-danger">
  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
    <i class="tim-icons icon-simple-remove"></i>
  </button>
  <span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i>  Sorry!   </strong> Your Collaboration Email setting  Could Not Be  Changed  , Please Contact Admin .</span>

</div>';}







 ?>




 <?php




 if($change_user_theme_setting == 1){echo ' <div class="alert alert-success">
   <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
     <i class="tim-icons icon-simple-remove"></i>
   </button>
   <span> <strong><i class="fa fa-smile-o" aria-hidden="true"></i> Success! </strong>  Theme Chaned Successfully .</span>

 </div>';} if($change_user_theme_setting == -1){echo ' <div class="alert alert-danger">
   <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
     <i class="tim-icons icon-simple-remove"></i>
   </button>
   <span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i>  Sorry!   </strong> Theme   Could Not Be  Changed  , Please Contact Admin .</span>

 </div>';}







  ?>






   <legend><h1 class="text-center text-primary pt-3 pb-3">User Setting</h1></legend>


</div>

          <div class="col-md-3">
         

                <div class="card">
                  <div class="card-header">
                    <h5 class="title">Change Collaboration Settings</h5>
                  </div>
                  <div class="card-body">
                    <form  enctype="multipart/form-data" class="" action="" method="post" >

                      <h5 class=" pb-4"> <b>Current Status : </b> <span class="text-muted">
                        <?php if(isset($user_view_email) && $user_view_email == 0){echo "Accepting Emails ";}else{echo "Not Accepting Emails ";} ?>
                      </span>   </h5>

                    <form  enctype="multipart/form-data" class="" action="" method="post" >
                      <div class="row">




                        <div class="col-md-4 pb-4">

                        <label class="switch">
                        <input type="checkbox" <?php if(isset($user_view_email) && $user_view_email == 0){echo "checked";}  ?> id="checkbox_clicked" name="user_view_email_setting">
                        <span class="slider round"></span>



                        </label>
                        </div>





            <input type="hidden" name="user_id" value="<?php if (isset($user_id)) { echo $user_id;}  ?>">








                    </div>
                  </div>
                  <div class="card-footer">

                <span class="pull-right"><button type="submit"class="btn btn-primary " name="change_email_settings">Submit</button></span>
                  </div>
                </div>
              </form>





          </div>




          <div class="col-md-3">


                <div class="card">
                  <div class="card-header">
                    <h5 class="title">Change  Theme</h5>
                  </div>
                  <div class="card-body">

                      <h5 class=" pb-4"> <b>Current Theme : </b> <span class="text-muted">
                        <?php if(isset($user_theme_setting) && $user_theme_setting == 0){echo "Dark Theme ";}else{echo "Light Theme ";} ?>
                      </span>   </h5>

                    <form  enctype="multipart/form-data" class="" action="" method="post" >
                      <div class="row">




                        <div class="col-md-4 pb-4">

                        <label class="switch">
                        <input type="checkbox" <?php if(isset($user_theme_setting) && $user_theme_setting == 0){echo "checked";}  ?> id="checkbox_theme_clicked" name="user_theme_setting">
                        <span class="slider round"></span>



                        </label>
                        </div>





            <input type="hidden" name="user_id" value="<?php if (isset($user_id)) { echo $user_id;}  ?>">








                    </div>
                  </div>
                  <div class="card-footer">

                <span class="pull-right"><button type="submit"class="btn btn-primary btn-block " name="change_user_theme_setting">Submit</button></span>
                  </div>
                </div>
              </form>





          </div>




          <div class="col-md-6">

            <div class="card">
              <div class="card-header">
                <h5 class="title">Change Password</h5>
              </div>
              <div class="card-body">
                <form  enctype="multipart/form-data" class="" action="" method="post" >
                  <div class="row">

<div class="col-md-3 pt-2">
  <label> Current password :</label>

</div>

  <div class="col-md-9 pb-3">
    <div class="form-group">
    <input type="password" class="form-control" name="current_password"   placeholder="Enter  Current Password" required>

    </div>
  </div>






  <div class="col-md-3  pt-2">
    <label> New Password :</label>

  </div>
  <div class="col-md-9 pb-3">
    <div class="form-group">
    <input type="password" class="form-control" name="new_password"  placeholder="Enter New Password." required>

    </div>
  </div>




  <div class="col-md-3  pt-2">
    <label>Confirm  Password :</label>

  </div>


  <div class="col-md-9 pb-3">
    <div class="form-group">
      <input type="password" class="form-control" name="re_Confirmed_password"   placeholder="Re-Confirm New Password." required>
    </div>
  </div>









<input type="hidden" name="user_email" value="<?php if (isset($user_email)) { echo $user_email;}  ?>">

                    <div class="card-footer">
                  <span class="pr-3 "><a href="" class="btn btn-secondary "> Cancel</a></span>
                  

                  <span class=""><button type="submit"class="btn btn-primary " name="submitted_user_details">Submit</button></span>


                    </div>






                </div>
              </div>

            </div>
          </div>
    </form>




        </div>
      </div>





    </div>
  </div>

  <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-spin fa-2x"> </i>
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
 
 
 
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
 
  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script>
  <script src="../assets/demo/demo.js"></script>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


  <script>






    $(document).ready(function() {
        
        
        
         if($(window).width() < 767)
    {
    
      
    $('.navbar-toggler').on('click',function(){
      $('.navbar').removeClass('navbar-transparent');
      $('.navbar').addClass('bg-white');
    });
    }
        
        
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
<?php   } ?>
<?php }else {
  echo "Please go back to login page and return back";
} ?>
