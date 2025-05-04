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






  $query_message = 0;
  $query_message_for_delete =0;

  if(isset($_POST["create_post"]))
  {
    $post_type          =         escape($_POST["post_type"]);
    $post_title          =        escape($_POST["post_title"]);
    $post_user_email     =        escape($session_email);
    $post_status         =        escape($_POST["post_status"]);
    $post_image          =        $_FILES['post_image']['name'];
    $post_image_temp     =        $_FILES['post_image']['tmp_name'];
    $project_start_date  =        escape($_POST["project_start_date"]);
    $project_end_date    =        escape($_POST["project_end_date"]);
    $post_link           =        escape($_POST["post_link"]);
    $post_description    =        escape($_POST["post_description"]);
    $post_date              =            date("Y-m-d H:i:s");


    if (empty($post_image)) {
      if($post_type == 1){
          $post_image = 'default_project_image.jpg';
      }else{
           $post_image = 'default_certificate_image.jpg';
      }
     move_uploaded_file($post_image_temp,"../../images/$post_image");

    }
   else if(!empty($_POST["cropped_image"])){

       $post_cropped_image    =        escape($_POST["cropped_image"]);
       $data =  str_replace('"','',$post_cropped_image);

         $image_array_1 = explode(";", $data);



         $image_array_2 = explode(",", $image_array_1[1]);



         $data = base64_decode($image_array_2[1]);
         $user_name            =          substr($session_email, 0, strpos($session_email, "."));
         $user_name            =          $user_name;
         $post_image           =          strval($user_name) . $post_image;
         escape(htmlspecialchars($post_image));

         $image_name = '../../images/' . $post_image ;

         file_put_contents($image_name, $data);

    }







    $query = "INSERT INTO posts(post_type,post_title,post_user_email,post_status,post_image,
      project_start_date,project_end_date,post_link,post_date,post_like_count,post_description)
    VALUES ('{$post_type}','{$post_title}','{$post_user_email}','{$post_status}','{$post_image}'
      ,'{$project_start_date}','{$project_end_date}' ,'{$post_link}','{$post_date}',0,'{$post_description}')";

  $create_post = mysqli_query($connection , $query);
  if(!$create_post){
   
    $query_message =-1;
  }else {
    $query_message =1;
  }
 }

 if (isset($_POST["delete_post"])) {
      $post_id                =            escape(htmlspecialchars($_POST["delete_post_id"]));
      $query2 = "UPDATE posts SET  post_status = -1 WHERE post_id  = $post_id  "   ;
      $updated_post = mysqli_query($connection,$query2);
      if (!$updated_post) {
        // die("update  post query failed".mysqli_error($connection));
 $query_message_for_delete = -1;
      }else {
        $query_message_for_delete = 1;
      }
 }





$query_message_for_update ="";
$query_message_for_update ="";
$query_message_for_notification ="";
  if (isset($_POST["update_post"])) {




       $post_id                =            escape($_POST["post_id"]);
       $post_type              =            escape($_POST["post_type"]);
       $post_title             =            escape($_POST["post_title"]);
       $post_link              =            escape($_POST["post_link"]);
       $project_start_date     =            escape($_POST["project_start_date"]);
       $project_end_date       =            escape($_POST["project_end_date"]);
       $post_image             =            $_FILES['post_image']['name'];
       $post_image_temp        =            $_FILES['post_image']['tmp_name'];
       $post_existing_image    =            escape($_POST["existing_image"]);
       $post_description       =            escape($_POST["post_description"]);
       $post_date              =            date("Y-m-d H:i:s");
       
       


       if (empty($post_image)) {
       $post_image = $post_existing_image;
        move_uploaded_file($post_image_temp,"../../images/$post_image");

       }
      else if(!empty($_POST["cropped_image"])){

          $post_cropped_image    =        escape($_POST["cropped_image"]);
          $data =  str_replace('"','',$post_cropped_image);

            $image_array_1 = explode(";", $data);



            $image_array_2 = explode(",", $image_array_1[1]);



            $data = base64_decode($image_array_2[1]);
            $user_name            =          substr($session_email, 0, strpos($session_email, "."));
            $post_image           =          strval($user_name) . $post_image;

            $image_name = '../../images/' . $post_image ;
            $post_image = escape($post_image);

            file_put_contents($image_name, $data);

       }

       if(isset($_POST["post_status"])){
         $post_status            =            $_POST["post_status"];
       }else {
         $post_status = -3;
       }


$post_status = intval($post_status);




       $query2 = "UPDATE posts SET post_type ='{$post_type}' ,post_title ='{$post_title}' , post_link ='{$post_link}'
       , project_start_date ='{$project_start_date}' , project_end_date ='{$project_end_date}',post_image='{$post_image}'
       , post_status = $post_status, post_description ='{$post_description}' , post_date = '{$post_date}'  WHERE post_id  = $post_id  "   ;
       $updated_post = mysqli_query($connection,$query2);
       if (!$updated_post) {
         die("update  post query failed".mysqli_error($connection));
  $query_message_for_update = -1;
       }else {
         $query_message_for_update = 1;
if($post_status == -2 || $post_status == -3 ){
  $notification_date =  date('Y-m-d');
  $notification_content = $post_title;
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
  }




  $user_session_email = $session_email;
$query = "SELECT * FROM posts WHERE post_user_email = '$user_session_email' ORDER BY post_status DESC , post_date ASC ";
$post_details = mysqli_query($connection,$query);
if(!$post_details){
die("query failed ,yeah".mysqli_error($connection));
}else {
    $total_posts =0;
  $total_archived_projects= 0;
  $total_active_projects=0;
  $total_archived_certi= 0;
  $total_active_certi=0;
  $total_deleted_posts=0;
  $total_likes=0;
  $total_projects =0;
  $total_certi=0;
  $total_active_posts=0;
  $total__certi_likes= 0;
  $total_archived_posts=0;
  $total_project_likes=0;
$record = array();
   while ($row = mysqli_fetch_assoc($post_details)) {
  $record[]=$row;
  $total_posts++;
if($row["post_status"] == 0){
             $total_archived_posts++;
          }
if($row["post_status"] == 1){
             $total_active_posts++;
          }
  if($row["post_type"] == 1){

     $total_projects++;
          if($row["post_status"] == 0){
             $total_archived_projects++;
          }
          if($row["post_status"] == 1){
             $total_active_projects++;
          }
      $total_project_likes = $total_project_likes+$row["post_like_count"];

  }


  if($row["post_type"] == 0){
             $total_certi++;
          if($row["post_status"] == 0){
             $total_archived_certi++;
          }
          if($row["post_status"] == 1){
             $total_active_certi++;
          }
           $total__certi_likes = $total__certi_likes+$row["post_like_count"];
  }

  $total_likes = $total_likes+$row["post_like_count"];



}

$record = array_reverse($record);


}



 ?>










<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
   <link rel="icon" type="image/png" href="../../images/logo.png">
   <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
   <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
   <script src="https://unpkg.com/dropzone"></script>
   <script src="https://unpkg.com/cropperjs"></script>
  <title>
CYBERATIC RVITM - Posts
  </title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
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
    .modal-backdrop.show {
    opacity: 1;
}
.container{
  position: relative
}
.scrollTop{
  position: fixed;
  bottom: 40px;
  right: 40px;
  width: 60px;
  height: 60px;
  background-size: 40px;
  background-position: center;
  background-repeat: no-repeat;
  cursor: pointer;
  z-index: 100000;
  /* visibility: hidden;
  opacity: 0; */
  transition: 0.5s;

}
.scrollTop.active{
  visibility: visible;
  opacity: 1;
}
.preview {
    overflow: hidden;
    width: 160px;
    height: 160px;
    margin: 10px;
    border: 1px solid red;
}

.modal-lg{
    max-width: 1000px !important;
}
.modal {
  overflow-y:auto;
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
        <li  class="active">
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
              <a class="navbar-brand" href="javascript:void(0)">Posts</a>
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

              <?php if($query_message_for_delete == 1){echo ' <div class="alert alert-success">
              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
              <span> <strong><i class="fa fa-smile-o" aria-hidden="true"></i> Success! </strong> Post Deleted Successfully </span>

            </div>';} if($query_message_for_delete == -1){echo ' <div class="alert alert-danger">
              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
              <span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i> Sorry!   </strong>  Post could not be Deleted try again or contact the admin</span>

            </div>';} ?>




            <?php if($query_message_for_update == 1){echo ' <div class="alert alert-success">
              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
              <span> <strong><i class="fa fa-smile-o" aria-hidden="true"></i> Success! </strong> Post Updated Successfully </span>

            </div>';} if($query_message_for_update == -1){echo ' <div class="alert alert-danger">
              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
              <span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i> Sorry!   </strong>  Post could not be Updated try again or contact the admin</span>

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
              <span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i> Sorry!   </strong>  We didnot get  notified , Please contact the admin or re-try</span>

            </div>';}
            if($query_message_for_notification == 2){echo ' <div class="alert alert-success">
              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
              <span> <strong> <i class="fa fa-smile-o fa-3x" aria-hidden="true"> </i> Do not  Worry!  </strong> We are notified again of your changes  ,  we will look into it and do the need full. </span>

            </div>';}


             ?>





            <?php if($query_message == 1){echo ' <div class="alert alert-success">
              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
              <span> <strong><i class="fa fa-smile-o" aria-hidden="true"></i> Success! </strong> Project Created Successfully </span>

            </div>';} if($query_message == -1){echo ' <div class="alert alert-danger">
              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
              <span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i> Sorry!   </strong>  project could not be created try again or contact the admin</span>

            </div>';} ?>
          </div>


<div onscroll="scrollFunction()" class="container">
  <div class="row">

             <legend><h1 class="text-center text-primary ">Posts Forum</h1></legend>


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
                                     <h5 class="pull-right"> Projects </h5>
                                       <h5 class="pull-right"> Total - </h5>


                                   </div>
                                   <div class="col-12">
                                     <h6 class="pull-right mt-3 total_numbers">
                                         <?php if (isset($total_projects)) {  echo $total_projects; }

                                         ?>

                                     </h6>
                                   </div>
                                 </div>
                              </div>
                          </div>
                      </div>
                      <a  href="#table_div_after_scroll_down" class="scroll_to_table_div">
                          <div class="card-footer">
                              <span class="pull-left">Scroll Down</span>
                              <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
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
                                      <h5 class="pull-right"> Projects  </h5>
                                        <h5 class="pull-right"> Published - </h5>


                                    </div>
                                    <div class="col-12">
                                      <h6 class="pull-right mt-3 total_numbers">
                                          <?php if (isset($total_active_projects)) {  echo $total_active_projects; }

                                          ?>

                                      </h6>
                                    </div>
                                  </div>
                               </div>
                           </div>
                       </div>
                       <a href="#table_div_after_scroll_down" class="scroll_to_table_div">
                           <div class="card-footer">
                               <span class="pull-left">Scroll Down</span>
                               <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
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
                                                    <h5 class="pull-right"> Projects </h5>
                                                      <h5 class="pull-right"> Archived - </h5>


                                                  </div>
                                                  <div class="col-12">
                                                    <h6 class="pull-right mt-3 total_numbers">
                                                        <?php if (isset($total_archived_projects)) {  echo $total_archived_projects; }

                                                        ?>

                                                    </h6>
                                                  </div>
                                                </div>
                                             </div>
                                         </div>
                                     </div>
                                     <a href="#table_div_after_scroll_down">
                                         <div class="card-footer">
                                             <span class="pull-left">Scroll Down</span>
                                             <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
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
                                                                    <h5 class="pull-right"> Certifications </h5>
                                                                      <h5 class="pull-right"> Total - </h5>


                                                                  </div>
                                                                  <div class="col-12">
                                                                    <h6 class="pull-right mt-3 total_numbers">
                                                                        <?php if (isset($total_certi)) {  echo $total_certi; }

                                                                        ?>

                                                                    </h6>
                                                                  </div>
                                                                </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <a href="#table_div_after_scroll_down" class="scroll_to_table_div">
                                                         <div class="card-footer">
                                                             <span class="pull-left">Scroll Down</span>
                                                             <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
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
                                      <h5 class="pull-right"> Certifications  </h5>
                                        <h5 class="pull-right"> Published - </h5>


                                    </div>
                                    <div class="col-12">
                                      <h6 class="pull-right mt-3 total_numbers">
                                          <?php if (isset($total_active_certi)) {  echo $total_active_certi; }

                                          ?>

                                      </h6>
                                    </div>
                                  </div>
                               </div>
                           </div>
                       </div>
                       <a href="#table_div_after_scroll_down" class="scroll_to_table_div">
                           <div class="card-footer">
                               <span class="pull-left">Scroll Down</span>
                               <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
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
                                                    <h5 class="pull-right"> Certifications </h5>
                                                      <h5 class="pull-right"> Archived - </h5>


                                                  </div>
                                                  <div class="col-12">
                                                    <h6 class="pull-right mt-3 total_numbers">
                                                        <?php if (isset($total_archived_certi)) {  echo $total_archived_certi; }

                                                        ?>

                                                    </h6>
                                                  </div>
                                                </div>
                                             </div>
                                         </div>
                                     </div>
                                     <a href="#table_div_after_scroll_down">
                                         <div class="card-footer">
                                             <span class="pull-left">Scroll Down</span>
                                             <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                                             <div class="clearfix"></div>
                                         </div>
                                     </a>
                                 </div>
                              </div>









  </div>
</div>
<legend><h3 class="text-center pt-5">General  Analysis  </h3></legend>



          <script src="../assets/js/core/jquery.min.js"></script>
                          <script src="../assets/js/plugins/chartjs.min.js"></script>


                          <div class="chart-container pb-5">
                            <canvas id="bar-chartcanvas" style="height:75px;width:150px;"></canvas>

                        	</div>

                        <script type="text/javascript">
                          $(document).ready(function () {

                        	var ctx = $("#bar-chartcanvas");

                        	var data = {
                        		labels : ["Total ", "Active ", "Archived ", "Deleted ", "Total  Likes"],
                        		datasets : [

                        			{


                        				label : "Count",
                        				data : [<?php if(isset($total_posts)){ echo $total_posts;} ?>, <?php if(isset($total_active_posts)){ echo $total_active_posts;} ?>, <?php if(isset($total_archived_posts)){ echo $total_archived_posts;} ?>,
                                   <?php if(isset($total_deleted_posts)){ echo $total_deleted_posts;} ?>, <?php if(isset($total_likes)){ echo $total_likes;} ?>],
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










          <div class="col-md-12 pt-5">

            <div class="card card-plain">
              <div class="card-header">

              </div>
              <div class="card-body">





                <legend><h3 class="text-center pt-5 pb-0">Add Post</h3></legend>

                          <div class="container pb-5 ">
                            <form class="" enctype="multipart/form-data" action="posts" method="post">

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
                                    <h5 class="user-name pb-5">YOUR POST :</h5>
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
                                      <h6 class="mb-3 text-primary">Post Details</h6>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                      <p>Post Type</p>
                                      <div class=" form-group">
                                          <!-- <label for="">Status</label> -->
                                          <select id="" class="form-control browser-default custom-select" name="post_type" value="">
                                          <option value="1" style="color:black;">Project</option>
                                          <option value="0" style="color:black;">Certification</option>

                                      </select>
                                      </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                      <div class="form-group">
                                        <label for="fullName"> Title </label>
                                        <input type="text" class="form-control" id="fullName" name="post_title" placeholder="Enter Post title " required>
                                      </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                      <div class="form-group">
                                        <label for="phone">Post Start Date</label>
                                          <input type="Date"  class="form-control startDate " name="project_start_date" onchange="dateFunction()" id="Date" placeholder="Enter project start date" required>
                                      </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                      <div class="form-group">
                                        <label for="website">Post End Date </label>
                                        <input type="Date" class="form-control mb-0 endDate"  name="project_end_date" onchange="dateFunction()"  id="Date" placeholder="" required>
                                        <label for="website" class="warning text-danger pull-right"></label>

                                      </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                      <div class="form-group">
                                        <label for="eMail"> Post Link</label>
                                        <input type="text" class="form-control" id="eMail" name="post_link" placeholder="Enter Git link " >
                                      </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 ">
                                        <p>Upload An Image </p>
                                                    <div class="input-group text-primary">



                                            <div class="custom-file text-primary" style="border:2px #2b3553 solid ; ">
                                              <input type="file" class=" text-primary upload_image" name="post_image" id="upload_image" aria-describedby="inputGroupFileAddon01" >
                                              <input type="hidden" name="cropped_image" class="object" value="">

                                              <!-- <label class="custom-file-label text-primary" for="inputGroupFile01"></label> -->
                                            </div>
                                          </div>
                                    </div>



                          <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                            <p>Post Status</p>
                            <div class=" form-group">
                                <!-- <label for="">Status</label> -->
                                <select id="" class="form-control browser-default custom-select" name="post_status" value="">
                                <option value="1" style="color:black;">Publish</option>
                                <option value="0" style="color:black;">Draft</option>

                            </select>
                            </div>
                          </div>

                          <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <label for="eMail">Post Details</label>
                            <textarea  class="form-control limit_description_add" name="post_description" rows="11" cols="80" maxlength="250" required ></textarea>
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
                                       
                                        <button type="submit" id="submit" name="create_post" class="btn btn-primary ml-3">Add Post</button>
                                      </div>
                                    </div>
                                  </div>
                                          </form>
                                </div>
                              </div>
                            </div>
                          </div>

            <div class="full_table-including_search pt-3" id="table_div_after_scroll_down">

                  <legend><h3 class="text-center pt-5 pb-0">All Posts</h3></legend>

                          <div class="row ml pb-3 pt-3" >

                            <div class="col-md-4">
                              <p class="text-primary">  <i class="tim-icons icon-zoom-split " ></i> Search by Project Name : </p>
                              <div class="">
                                <div class="form-outline">
                                  <input type="text" id="myInput" onkeyup="myFunction()"   class="form-control" >
                                </div>

                              </div>
                            </div>

                            <div class="col-md-8 ">
            <a href="analysis#project_comparision" class="pull-right btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" id="comparitive_analysis">Comparitive Analysis</a>
                            </div>
                          </div>

            <div class="row">

            <div class="col-md-12" >

              <table class="table  table-striped table-hover pt-5 Muted Text"  id="myTable" >
                <thead class="thead-light">
                  <tr>
                    <th>S.No</th>

                    <th >Post Title</th>
                    <th >Start Date</th>
                    <th >End Date</th>
                    <th >Likes</th>
                      <th >Post Status</th>
                        <th >Post Type</th>
                    <th>Git Link</th>

                    <th colspan="2">Options</th>

                  </tr>
                </thead>
                <tbody class="text-success">


                  <?php
                  if($total_posts > 0 ){


                     $i =1;

                   foreach ($record as $rec):

                     $post_id                =     $rec["post_id"];
                     $post_type              =     $rec["post_type"];
                     $post_status            =     $rec["post_status"];
                     $post_image             =     $rec["post_image"];
                     $post_title             =     $rec["post_title"];
                     $project_start_date     =     $rec["project_start_date"] ;
                     $project_end_date       =     $rec["project_end_date"] ;
                     $post_like_count        =     $rec["post_like_count"];
                     $post_link              =     $rec["post_link"];
                     $post_date              =     $rec["post_date"];
                     $post_description       =     $rec["post_description"];


                  if($post_status != -1){


          ?>

          <tr style="color:white;">
          <td><?php echo $i; ?></td>

          <td><?php echo $post_title; ?></td>
          <td><?php echo  date(' d-m-y', strtotime($project_start_date)) ;?></td>
          <td><?php echo date(' d-m-y', strtotime($project_end_date)) ; ?></td>
          <td> <?php if ($post_like_count > 0) {
          echo $post_like_count;
          }else {
          echo "0";
          } ?></td>
          <td><?php if (isset($post_status) ) {
          if ( $post_status == 1) {
          ?><button  type="button" name="button" class="btn btn-sm btn-link text-primary">Published</button> <?php
          }elseif ( $post_status == 0) {
          ?><button  name="button" class="btn btn-sm btn-link text-info">Archived</button> <?php
          }
          elseif ( $post_status == -2) {
          ?><button  name="button" class="btn btn-sm btn-link text-danger">Blocked</button> <?php
          }
          elseif ( $post_status == -3) {
          ?><button  name="button" class="btn btn-sm btn-link text-danger">Under Verification</button> <?php
          }

          } ?></td>
          <td><?php if (isset($post_type) ) {
          if ( $post_type == 1) {
          ?><button  type="button" name="button" class="btn btn-sm btn-success">Project</button> <?php
          }elseif ( $post_type == 0) {
          ?><button  name="button" class="btn btn-sm btn-warning">Certification</button> <?php
          }

          } ?></td>
          <td><a target="_blank"  href="<?php echo $post_link; ?>" id="" class="btn btn-primary btn-sm desktop_git_link" > <i class="fa fa-github-square" aria-hidden="true"  ></i> GIT </a>
          <a target="_blank"  href="<?php echo $post_link; ?>" style="display:none;" id="" class="btn btn-primary btn-sm phone_git_link" > <i class="fa fa-github-square" aria-hidden="true"  ></i>  </a>
          </td>




          <td>


          <button type="submit" name="edit_post" data-description="<?php echo htmlspecialchars($post_description) ?>" data-type="<?php echo $post_type;  ?>"
             data-status="<?php echo $post_status  ?>"data-id="<?php echo $post_id  ?>" data-title="<?php echo $post_title  ?>"
          data-end_date="<?php echo $project_end_date  ?>" data-start_date="<?php echo $project_start_date  ?>" data-link="<?php echo $post_link  ?>"
          data-image="<?php echo $post_image  ?>" data-like_count="<?php echo $post_like_count; ?>"
           data-toggle="modal" data-target="#exampleModal"  data-whatever="@getbootstrap" class="btn btn-success btn-sm">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
           </button>


          </td>
          <td>
          <button type="submit" name="delete_post" data-title="<?php echo $post_title ?>" data-id="<?php echo $post_id; ?>" class="btn btn-sm btn-danger confirm-delete">  <i class="fa fa-trash-o" aria-hidden="true"></i></button>
   </td>


          <tr>

          <?php
          $i++;     }    endforeach;
                     } ?>
          </tbody>
          </table>
          </div>

          </div>


          </div>

          <!-- </div> -->
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
                  <input type="hidden" id="post_id" name="delete_post_id" value="">
                  <button type="submit" name="delete_post" class="btn btn-danger">Delete</button>
                </form>
              </div>
            </div>
            </div>
            </div>


            <div id="myModal" class="modal hide">
                <div class="modal-header">
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
                     <h3>Delete</h3>
                </div>
                <div class="modal-body">
                    <p>You are about to delete.</p>
                    <p>Do you want to proceed?</p>
                </div>
                <div class="modal-footer">
                  <a href="#" id="btnYes" class="btn danger">Yes</a>
                  <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
                </div>
            </div>


            <footer class="footer">
              <div class="container-fluid">

              </div>
            </footer>






          <div  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div  class="modal-dialog" role="document">
          <div class="modal-content edit_modal_content">
            <div class="modal-header  " style="background-color:#1e1e2f; ">
              <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                <span class="text-primary" aria-hidden="true">&times;</span>
              </button>
            </div>
            <div  class=" modal-body" style="background-color:#1e1e2f; ">

                  <div class="card-body">


                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
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
                      <div class="text-cente">
                        <h5 class="user-name">Current Image :</h5>
              <img style="width:100px; height:100px; text-align:center; " id="form_img" src="" alt="" class="img-responsive img-fluid ">
                      </div>
                    </div>
                  </div>
                </div>


                                    <h5 class="user-name text-center"> EDIT PROJECT :</h5>


                            <form class="" enctype="multipart/form-data" action="" method="post">






                              <div class="card h-100">
                                <div class="card-body">

                                  <div class="row gutters">

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                      <h6 class="mb-3 text-primary">Project Details</h6>
                                    </div>

                                    <input type="hidden" id="form_existing_image" name="existing_image" value="">

                                    <input type="hidden" id="form_id" name="post_id" value="">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                      <p>Post Type</p>
                                      <div class=" form-group">
                                          <!-- <label for="">Status</label> -->
                                          <select  class="form-control browser-default custom-select" id="form_type" name="post_type" value="">
                                          <option value="1" style="color:black;">Project</option>
                                          <option value="0" style="color:black;">Certification</option>

                                      </select>
                                      </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                      <div class="form-group">
                                        <label for="fullName"> Title </label>
                                        <input type="text" class="form-control" id="form_title" name="post_title" placeholder="Enter project title " >
                                      </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                      <div class="form-group">
                                        <label for="phone">Project Start Date</label>
                                          <input type="Date"  class="form-control" name="project_start_date" onchange="dateModalFunction()" id="form_start_date" placeholder="Enter project start date" required>
                                      </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                      <div class="form-group">
                                        <label for="website">Project End Date </label>
                                        <input type="Date" class="form-control mb-0"  name="project_end_date"  onchange="dateModalFunction()" id="form_end_date" placeholder="" required>
                                        <label for="website" class="modal_warning text-danger pull-right"></label>

                                      </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                      <div class="form-group">
                                        <label for="eMail"> Project Link</label>
                                        <input type="text" class="form-control" id="form_link" name="post_link" placeholder="Enter Git link " >
                                      </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 ">
                                        <p>Upload An Image </p>
                                                    <div class="input-group text-primary">



                                            <div class="custom-file text-primary" style="border:2px #2b3553 solid ; ">
                                              <input type="file" class=" text-primary upload_image" name="post_image" id="form_image" aria-describedby="inputGroupFileAddon01" >
                                              <input type="hidden" name="cropped_image" class="object" value="">

                                              <!-- <label class="custom-file-label text-primary" for="inputGroupFile01"></label> -->
                                            </div>
                                          </div>
                                    </div>


<div class="if_blocked_text pl-3 pb-3 pt-3" style="display:none">
  <input type="hidden" name="post_status_blocked" id="post_status_blocked" value="">
<label class="">Post Status </label>
<p class="text-danger pb-3 action_text_if_blocked">Blocked by Admin</p>
</div>
                          <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 select_input_block pb-3">
                          <label for="form_status"> Post Status</label>
                            <div class=" form-group ">
                                <!-- <label for="">Status</label> -->
                                <select id="form_status" class="form-control browser-default custom-select" name="post_status" value="">
                                <option value="1" style="color:black;">Publish</option>
                                <option value="0" style="color:black;">Draft</option>

                            </select>
                            </div>
                          </div>

                          <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <label for="eMail"> Post Description</label>
                            <textarea id="form_description" class="form-control limit_description_edit" name="post_description" rows="11" cols="80" maxlength="250" required></textarea>
                           <span class="pull-right " id="">
                           <span id="length_desc" class="characters_limiting_edit"></span> Character(s) Remaining</span>

                            </div>
                          </div>


                                  </div>
                                  <div class="row gutters">


                                    </div>
                                  </div>


                                </div>



            </div>
            <div class="modal-footer" style="background-color:#1e1e2f">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="update_post" class="btn btn-primary">Update Post</button>
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

          </div>
          </div>





          <div class="modal fade" id="modalCrop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  			  	<div class="modal-dialog modal-lg" role="document">
  			    	<div class="modal-content">
  			      		<div class="modal-header">
  			        		<h5 class="modal-title">Crop Image Before Upload</h5>
  			        		<button type="button" onclick="functionEmpty()" class="close" data-dismiss="modal" aria-label="Close">
  			          			<span aria-hidden="true">×</span>
  			        		</button>
  			      		</div>
  			      		<div class="modal-body">
  			        		<div class="img-container">
  			            		<div class="row">
  			                		<div class="col-md-8">
  			                    		<img src="" id="sample_image" />
  			                		</div>
  			                		<div class="col-md-4">
  			                    		<div class="preview"></div>
  			                		</div>
  			            		</div>
  			        		</div>
  			      		</div>
  			      		<div class="modal-footer">
                    <button type="button" onclick="functionEmpty()" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

  			      			<button type="button" id="crop" class="btn btn-primary pull-right">Crop</button>
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
  <script src="  https://cdnjs.cloudflare.com/ajax/libs/vquery/5.0.1/v.min.js"></script>

  <script>
  function functionEmpty(){
        $(".upload_image").val("");
  }

  $(document).ready(function(){

  	var $modal = $('#modalCrop');

  	var image = document.getElementById('sample_image');

  	var cropper;

  	$('.upload_image').change(function(event){
      $(".object").val("");


  		var files = event.target.files;

  		var done = function(url){
  			image.src = url;
        $modal.modal({
          backdrop: 'static',
          keyboard: false
        });
  			$modal.modal('show');
  		};

  		if(files && files.length > 0)
  		{
  			reader = new FileReader();
  			reader.onload = function(event)
  			{
  				done(reader.result);
  			};
  			reader.readAsDataURL(files[0]);
  		}
  	});

  	$modal.on('shown.bs.modal', function() {
  		cropper = new Cropper(image, {
  			aspectRatio: 5.7/3,
  			viewMode: 5,
  			preview:'.preview'
  		});
  	}).on('hidden.bs.modal', function(){
  		cropper.destroy();
     		cropper = null;
  	});

  	$('#crop').click(function(){
  		canvas = cropper.getCroppedCanvas({
  			width:400,
  			height:400
  		});

  		canvas.toBlob(function(blob){
  			url = URL.createObjectURL(blob);
  			var reader = new FileReader();
  			reader.readAsDataURL(blob);
  			reader.onloadend = function(){
  				var base64data = reader.result;
          $(".object").val(JSON.stringify({image:base64data}));
          $modal.modal('hide');


  			};
  		});
  	});

  });

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

function scrollFunction(){

}




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



  $(".scroll_to_table_div").click(function() {

      $('html,body').animate({
          scrollTop: $("#table_div_after_scroll_down").offset().top},
          'slow');
  });


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
    $('.desktop_git_link').css("display", "none");
    $('.phone_git_link').css("display", "block");
  }


  $('.confirm-delete').on('click', function(e) {
      e.preventDefault();
      var id = $(this).data('id');
var title = $(this).data('title');

      var modal_text= "Do you really want to delete "+title;
      $('#myModal').data('id', id).modal('show');
      $(".modal-footer #post_id").val( id );
         $(" .modal_content").text(modal_text);
  });








$('[data-toggle="modal"]').on('click', function(e) {
    e.preventDefault();
    var id =$(this).data('id');
    var status = $(this).data('status');
    var type = $(this).data('type');
    var description = $(this).data('description');
    var description_length = description.length;
    description_length = 250 - description_length;
    var end_date = $(this).data('end_date');
    var start_date = $(this).data('start_date');
    var title = $(this).data('title');
    var link = $(this).data('link');

    var image =$(this).data('image');




    $("#form_id").val( id );
        $("#form_type").val( type );
       $("#form_title").val( title );
       $("#form_link").val( link );
       $("#form_start_date").val( start_date );

       $("#form_end_date").val( end_date );
if(status == -2){
  $('.select_input_block').css("display", "none");
  $('.if_blocked_text').css("display", "inline");
  $('.action_text_if_blocked').html("Blocked By Admin");
  $("#post_status_blocked").val( status );


}else if (status == -3) {
  $('.select_input_block').css("display", "none");
  $('.if_blocked_text').css("display", "inline");
  $('.action_text_if_blocked').html("Under Verification");
  $("#post_status_blocked").val( status );
}
else {
  $('.select_input_block').css("display", "inline");
  $('.if_blocked_text').css("display", "none");


}
          $("#form_status").val( status );

$("#form_img").attr("src","../../images/"+image);

$("#form_description").val( description );

$("#form_existing_image").val( image );

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
  echo "Please go back to login page and return back";
} ?>
