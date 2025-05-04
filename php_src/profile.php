<?php include "admin/includes/admin_header.php" ?>
<?php include "admin/includes/functions.php" ?>
<?php include "includes/db.php" ?>
<?php
?>
<?php

$str = escape(htmlspecialchars($_SERVER['REQUEST_URI']));
$s = explode("/",$str);
$url_email_with_semester =  end($s);

$user_semester =  substr($url_email_with_semester, -1);
$user_name     =  substr($url_email_with_semester, 0, -1);



$query = "SELECT * FROM users WHERE user_email LIKE '$user_name%' AND user_semester = $user_semester ";
$user_details2 = mysqli_query($connection,$query);
if(!$user_details2){
die("query failed ,yeah".mysqli_error($connection));


}

if(mysqli_num_rows($user_details2) != 0) {


while ($row = mysqli_fetch_assoc($user_details2)) {


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
$user_view_email        =     $row["user_view_email"];
$user_linkedin          =     $row["user_linkedin"];
$user_git               =     $row["user_git"];





}

if(isset($_SESSION["user_email"])){
  $session_email           =          encrypt_decrypt($_SESSION["user_email"], 'decrypt');
  $session_role            =          encrypt_decrypt($_SESSION["user_role"], 'decrypt');
//   $session_domain          =          encrypt_decrypt($_SESSION["user_domain"], 'decrypt');
  $session_user_id         =          encrypt_decrypt($_SESSION["user_id"], 'decrypt');
  $session_user_image      =          encrypt_decrypt($_SESSION["user_image"], 'decrypt');
}









$total_internships=0;
$query4 = "SELECT * FROM internships  WHERE internship_user_email = '{$user_email}' AND internship_status =1 ORDER BY internship_id DESC";
$internship_details = mysqli_query($connection,$query4);
if(!$internship_details){
die("query failed".mysqli_error($connection));
}else {
        $internship_arr=array();
while ($row = mysqli_fetch_assoc($internship_details)) {

$internship_arr[]=$row;
$total_internships++;
}
}

$total_posts=0;

$query3 = "SELECT * FROM posts  WHERE post_user_email = '{$user_email}' AND post_status =1 ORDER BY post_date DESC";
$post_details = mysqli_query($connection,$query3);
if(!$post_details){
die("query failed".mysqli_error($connection));
}else {
$post_arr=array();
while ($row = mysqli_fetch_assoc($post_details)) {
$post_arr[]=$row;
$total_posts++;
}
}




 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
         <link rel="logo-icon" sizes="76x76" href="../images/logo.png">
  <link rel="icon" type="image/png" href="../images/logo.png">
  <title>
CYBEREATIC RVITM - Member
  </title>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">-->



   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

   <!-- <link rel="stylesheet" href="../css/index.css"> -->

   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

      <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">



   <link rel="stylesheet" href="../css/profile.css">
<style >
.modal-content.mail_content.big_screen{
  margin-top: 50px;
  padding-top:50px;
}
.progress{
width: 150px;
height: 150px;
line-height: 150px;
background: none;
margin: 0 auto;
box-shadow: none;
position: relative;

}
.progress:after{
content: "";
width: 100%;
height: 100%;
border-radius: 50%;
border: 8px solid #fff;
position: absolute;
top: 0;
left: 0;
}
.progress > span{
width: 50%;
height: 100%;
overflow: hidden;
position: absolute;
top: 0;
z-index: 1;
}
.progress .progress-left{
left: 0;
}
.progress .progress-bar{
width: 100%;
height: 100%;
background: none;
border-width: 8px;
border-style: solid;
position: absolute;
top: 0;


}
.progress .progress-left .progress-bar{
left: 100%;
border-top-right-radius: 80px;
border-bottom-right-radius: 80px;
border-left: 0;
-webkit-transform-origin: center left;
transform-origin: center left;
}
.progress .progress-right{
right: 0;
}

.progress .progress-right .progress-bar{
left: -100%;
border-top-left-radius: 80px;
border-bottom-left-radius: 80px;
border-right: 0;
-webkit-transform-origin: center right;
transform-origin: center right;
animation: loading-1 1.8s linear forwards;
}
.progress .progress-value{
width: 90%;
height: 90%;
border-radius: 50%;

font-size: 24px;
color: #fff;
line-height: 135px;
text-align: center;
position: absolute;
top: 5%;
left: 5%;
}
.progress.blue .progress-bar{
border-color: #049dff;
}
.progress.blue .progress-left .progress-bar{
animation: loading-2 1.5s linear forwards 1.8s;
}
.progress.yellow .progress-bar{
border-color: #fdba04;
}
.progress.yellow .progress-left .progress-bar{
animation: loading-3 1s linear forwards 1.8s;
}
.progress.pink .progress-bar{
border-color: #ed687c;
}
.progress.pink .progress-left .progress-bar{
animation: loading-4 0.4s linear forwards 1.8s;
}
.progress.green .progress-bar{
border-color: #1abc9c;
}
.progress.green .progress-left .progress-bar{
animation: loading-5 1.2s linear forwards 1.8s;
}
@keyframes loading-1{
0%{
  -webkit-transform: rotate(0deg);
  transform: rotate(0deg);
}
100%{
  -webkit-transform: rotate(<?php if($user_score>=5) {echo "180";} else { echo $user_score/10*360;}?>deg);
  transform: rotate(<?php if($user_score>=5) {echo "180";} else { echo $user_score/10*360;}?>deg);
}
}
@keyframes loading-2{
0%{
  -webkit-transform: rotate(0deg);
  transform: rotate(0deg);
}
100%{
  -webkit-transform: rotate(<?php if($user_score>5) {echo ($user_score)/10*180; } ?>deg);
  transform: rotate(<?php if($user_score>5) {echo ($user_score)/10*180; } ?>deg);
}
}
@keyframes loading-3{
0%{
  -webkit-transform: rotate(0deg);
  transform: rotate(0deg);
}
100%{
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}
}
@keyframes loading-4{
0%{
  -webkit-transform: rotate(0deg);
  transform: rotate(0deg);
}
100%{
  -webkit-transform: rotate(36deg);
  transform: rotate(36deg);
}
}
@keyframes loading-5{
0%{
  -webkit-transform: rotate(0deg);
  transform: rotate(0deg);
}
100%{
  -webkit-transform: rotate(126deg);
  transform: rotate(126deg);
}
}
@media only screen and (max-width: 990px){
.progress{ margin-bottom: 20px; }
}

</style>
<style >
.profile-nav .user-heading.round a {
  border-radius: 50%;
  -webkit-border-radius: 50%;
border: 0px  solid;
  display: inline-block;
}
.profile-nav .user-heading a img {
    width: 138px;
    height: 138px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
}
/* .progress .progress-right .progress-bar {
    left: -100%;
    border-top-left-radius: 80px;
    border-bottom-left-radius: 80px;
    border-right: 0;
    border-width: 5px;
    -webkit-transform-origin: center right;
    transform-origin: center right;
    animation: loading-1 1.8s linear forwards;
} */

.fade:not(.show) {
    opacity: 1;
}
.modal-backdrop.fade {
    opacity: 0.5;
}
@media (max-width:700px) {
  .modal-dialog{
    top: 40px;
  }
  .mail_content.modal-content.big_screen{
    padding-top: 0px;
  }
}

</style>
</head>
<body>


<!-- Navbar-->

<!-- Navbar -->
 <div class="container bootstrap snippets bootdey">
<div class="row">
  <div class="profile-nav col-md-4">
      <div class="panel">
          <div class="user-heading round">
            <div class="progress blue">

                <span data-progress="<?php echo $user_score;  ?>deg" class="progress-left">
                    <span class="progress-bar"></span>
                </span>
                <span class="progress-right">
                    <span class="progress-bar"></span>
                </span>
                <div  class="progress-value"><a href="#">

                    <img src="../images/<?php echo $user_image ?>" alt="">
                </a></div>
            </div>

              <h1>
                <?php
                  $user_first_name  =   strtoupper($user_first_name);
                  $user_last_name = strtoupper($user_last_name);
                  echo "$user_first_name  $user_last_name";
                 ?>
               </h1>
              <p><?php if(isset($user_view_email)&&$user_view_email == 0){echo "$user_email"; } ?></p>







              <?php
if(isset($_SESSION["user_email"])){

               $user_session_email = $session_email;
               if($user_session_email != $user_email){
                $query1="SELECT * FROM collaborate WHERE collab_receiver_email='$user_email' AND collab_sender_email	='$user_session_email' ";
                $results = mysqli_query($connection,$query1);
                $results1 =mysqli_fetch_assoc($results);

              if(!$results1): ?>

            <div class=""  >

              <button type="submit" data-toggle="modal" data-target="#mailModal"  data-whatever="@getbootstrap" class=" collab btn btn-primary pull-right" data-toggle="yes" data-user_session_email="<?php echo $user_session_email?>"  data-user_email="<?php echo $user_email ?>" >Collaborate</button>
              <button style="display:none"  type=" submit" class="uncollab  btn btn-warning pull-right" data-user_session_email="<?php echo $user_session_email?>" data-toggle="yes" data-user_email="<?php echo $user_email ?>">Request Sent</button>

            </div>
          <?php else:


            $status= $results1["collab_status"];

            if($status==-1){  ?>


                          <div class=""  >

                            <button type="submit" data-toggle="modal" data-target="#mailModal"  data-whatever="@getbootstrap" class=" collab btn btn-primary pull-right" data-toggle="yes" data-user_session_email="<?php echo $user_session_email?>"  data-user_email="<?php echo $user_email ?>" >Collaborate</button>
                            <button style="display:none"  type=" submit" class="uncollab  btn btn-warning pull-right" data-user_session_email="<?php echo $user_session_email?>" data-toggle="yes" data-user_email="<?php echo $user_email ?>">Request Sent</button>

                          </div>

            <?php  }

            elseif ($status==0) {?>


                                        <div class=""  >

                                          <button style="display:none" type="submit" data-toggle="modal" data-target="#mailModal"  data-whatever="@getbootstrap" class=" collab btn btn-primary pull-right" data-toggle="yes" data-user_session_email="<?php echo $user_session_email?>"  data-user_email="<?php echo $user_email ?>" >Collaborate</button>
                                          <button   type=" submit" class="uncollab  btn btn-warning pull-right" data-user_session_email="<?php echo $user_session_email?>" data-user_email="<?php echo $user_email ?>">Request Sent</button>

                                        </div>
            <?php  }


            elseif ($status==1) {?>
            <button  type="submit" class=" btn btn-success pull-right" data-toggle="yes" data-user_session_email="<?php echo $user_session_email?>"  data-user_email="<?php echo $user_email ?>" >Collaborated</button>

<?php } ?>
<?php endif ?>
<?php }  }else{
?>
  <div class=""  >

    <button type="submit" class=" collab btn btn-primary pull-right" data-toggle="modal" data-target="#mailModalPublic"  data-whatever="@getbootstrap"  data-toggle="yes" data-user_session_email="<?php echo $user_session_email?>"  data-user_email="<?php echo $user_email ?>" >Collaborate</button>
    <button style="display:none"  type=" submit" class="uncollab  btn btn-warning pull-right" data-user_session_email="<?php echo $user_session_email?>" data-user_email="<?php echo $user_email ?>">Request Sent</button>


  </div>



<?php

} ?>
          </div>

          <ul class="nav nav-pills nav-stacked">
               <li class=""><a target ="_blank" href="<?php echo  $user_linkedin;  ?>"><i class="fa fa-linkedin-square" aria-hidden="true"></i>LINKED IN</a></li>
              <li class=""><a target ="_blank" href="<?php echo $user_git;  ?>"><i class="fa fa-github-square" aria-hidden="true"></i> GIT HUB</a></li>
             

          </ul>
      </div>
      <div class="panel">
        <div class="panel-heading">
          <span class="panel-icon">
            <i class="fa fa-trophy"></i>
          </span>
          <span class="panel-title"> My Skills</span>
        </div>
        <div class="panel-body pb5">
          <?php
$skills_arr = explode (",", $user_skills);
for ($i=0; $i <count($skills_arr) ; $i++) {
?>            <span class=" btn btn-primary btn-lg mr-2  mb-3"><?php echo $skills_arr[$i]; ?></span>
<?php
}?>
  
        </div>
      </div>

<?php if($total_posts>$total_internships){ ?>
      <?php foreach ($internship_arr as $internship ): ?>



         <div class="panel">
           <div class="panel-heading">

             <span class="panel-title"> <b><?php echo substr(strtoupper($internship["internship_role"]),0,26); if(strlen($internship["internship_role"])>26){echo "...";}   ?></b></span><sub class="pl-3 "></sub>
             <h6><?php echo strtoupper($internship["internship_company"]); ?></h6>
             <h4 class="pt-3"><b><?php echo  $internship["internship_start_date"]; ?></b> through <b><?php echo $internship["internship_end_date"]; ?></b></h4>
           </div>
           <div class="panel-body pb5">






             <h6></h6>


             <p class="text-muted pb-3 "> <?php echo $internship["internship_description"];  ?>
               <br>
             </p>





           </div>
         </div>

       <?php endforeach; } ?>



      <div class="row">
<?php if($total_posts<=$total_internships){ ?>

            <?php


           // $user_id = $_POST["user_id"];


foreach ($post_arr as $rec) {




            $post_id                =     $rec["post_id"];
            $post_image             =     $rec["post_image"];
            $post_title             =     $rec["post_title"];
            $project_start_date     =     $rec["project_start_date"] ;
            $project_end_date       =     $rec["project_end_date"] ;
            $post_link              =     $rec["post_link"];
            $post_date              =     $rec["post_date"];
            $post_description       =     $rec["post_description"];


            ?>
        <div class="col-md-12 shadow_div">
            <div class="panel">

                <div class="panel-body">
                    <div class="bio-chart">
                      <div style="display:inline;width:100px;height:100px;">  <img src="../images/<?php echo "$post_image"; ?>" class="img-fluid img-responsive img-circle" alt="..." style="display:inline;width:100px;height:100px;"> </div>
                    </div>
                    <div class="bio-desk">
                      <button  type="button" name="button"class="btn btn-link" data-link="<?php echo $post_link; ?>" data-image="<?php echo $post_image;  ?>" data-type="<?php echo $post_type;  ?>" data-title="<?php echo $post_title;  ?>" data-start_date="<?php  echo date(' d F Y', strtotime($project_start_date));  ?>"
                         data-end_date="<?php  echo date(' d F Y', strtotime($project_end_date));  ?>"
                        data-description="<?php echo htmlspecialchars($post_description) ?>"
                         data-toggle="modal" data-target="#exampleModal"  data-whatever="@getbootstrap" >
                         <h4 class="red"><?php echo substr($post_title,0,26); if(strlen($post_title)>26){echo "...";} ?></h4>
                      </button>
                        <p>Started : <?php

                        // $timestamp = strtotime($project_start_date);
                        // // Creating new date format from that timestamp
                        // $project_start_date = date("d-m-Y", $timestamp);
                         // Outputs: 31-03-2019
                        echo date(' d F Y', strtotime($project_start_date));
                         ?></p>
                         <p>Completion : <?php

                         // $timestamp = strtotime($project_end_date);
                         // // Creating new date format from that timestamp
                         // $project_end_date = date("d-m-Y", $timestamp);
                          // Outputs: 31-03-2019
                        echo date(' d F Y', strtotime($project_end_date));
                          ?></p>
<a target="_blank" class="btn btn-primary "  href="<?php echo "$post_link"; ?> "> <i class="fa fa-github-square  pr-1  pt-0 mt-0 pb-0 post_link" aria-hidden="true"> </i> Git Link </a>


                    </div>
                </div>
            </div>
            </div>


            <?php


            }



}



             ?>











</div>









  </div>

  <div class="profile-info col-md-8">
    
        <p>My Lines/Quote :</p>
      <div class="panel">

          <div class="bio-graph-heading">

              <?php echo "$user_description"; ?>
          </div>
          <div class="panel-body bio-graph-info">
              <h1>Bio Graph</h1>
              <div class="row">
                  <div class="bio-row">
                      <p><span>First Name </span>: <?php echo "$user_first_name"; ?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Last Name </span>: <?php echo "$user_last_name"; ?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Gender </span>: <?php echo "$user_gender"; ?></p>
                  </div>
                  <div class="bio-row">

<!-- code to change date format , usually it is in yyyy-mm-dd ,now we change it to dd-mm-yyyy -->
                  <?php
                      // $timestamp = strtotime($user_dob);
                      // // Creating new date format from that timestamp
                      // $user_dob = date("d-m-Y", $timestamp);
                       // Outputs: 31-03-2019
                      ?>

                      <p><span>Birthday</span>: <?php echo date(' d F Y', strtotime($user_dob)) ?></p>
                  </div>

                  <div class="bio-row">
                      <p><span>Branch  </span> :   <?php
     if($user_branch == "Information Science Engineering" ){
         echo "ISE";
     }
     if($user_branch == "Computer Science Engineering" ){
         echo "CSE";
     }
     if($user_branch == "Electronics and Communication Science Engineering" ){
         echo "ECE";
     }
     if($user_branch == "Mechanical Engineering" ){
         echo "MECH";
     }

     ?> </p>
                  </div>
                  <div class="bio-row">
                      <p><span>Semester  </span> :  <?php echo "$user_semester";  ?></p>
                  </div>

                  <div class="bio-row">
                      <p><span>Domain </span>: <?php echo "$user_domain"; ?></p>
                  </div>
                  <?php if(isset($user_view_email) &&$user_view_email == 0){
                    ?>  <div class="bio-row">
                          <p><span>Email </span>: <?php echo "$user_email";  ?></p>
                      </div><?php
               } ?>


              </div>
          </div>
      </div>




       <div>
         <?php if($total_posts<=$total_internships){ ?>
         <div class="row">


             <?php foreach ($internship_arr as $internship ): ?>


              <div class="col-md-6">
                <div class="panel">
                  <div class="panel-heading">

                    <span class="panel-title"> <b><?php echo substr(strtoupper($internship["internship_role"]),0,26); if(strlen($internship["internship_role"])>26){echo "...";} ?></b></span><sub class="pl-3 "></sub>
                    <h6><?php echo strtoupper($internship["internship_company"]); ?></h6>
                    <h4 class="pt-3"><b><?php echo  $internship["internship_start_date"]; ?></b> through <b><?php echo $internship["internship_end_date"]; ?></b></h4>

                  </div>
                  <div class="panel-body pb5">






                    <h6></h6>


                    <p class="text-muted pb-3 "> <?php echo $internship["internship_description"];  ?>
                      <br>
                    </p>





                  </div>
                </div>
              </div>
              <?php endforeach; ?>



         </div>
       <?php }
       if($total_posts>$total_internships){
         ?> <div class="row"><?php
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

                   ?>



               <div class="col-md-6 shadow_div">
                   <div class="panel">

                       <div class="panel-body">
                           <div class="bio-chart">
                             <div style="display:inline;width:100px;height:100px;">  <img src="../images/<?php echo "$post_image"; ?>" class="img-fluid img-responsive img-circle" alt="..." style="display:inline;width:100px;height:100px;"> </div>
                           </div>
                           <div class="bio-desk">
                              <button  type="button" name="button"class="btn btn-link" data-link="<?php echo $post_link; ?>" data-image="<?php echo $post_image;  ?>" data-type="<?php echo $post_type;  ?>" data-title="<?php echo $post_title;  ?>" data-start_date="<?php  echo date(' d F Y', strtotime($project_start_date));  ?>"
                                 data-end_date="<?php  echo date(' d F Y', strtotime($project_end_date));  ?>"
                                data-description="<?php echo htmlspecialchars($post_description) ?>"
                                 data-toggle="modal" data-target="#exampleModal"  data-whatever="@getbootstrap" >
                                <h4 class="red"><?php echo substr($post_title,0,26); if(strlen($post_title)>26){echo "...";} ?></h4>
                              </button>

                               <p>Started : <?php

                            
                               echo date(' d F Y', strtotime($project_start_date));
                                ?></p>
                                <p>Completion : <?php

                               echo date(' d F Y', strtotime($project_end_date));
                                 ?></p>
       <a target="_blank"  class="btn btn-primary "  href="<?php echo "$post_link"; ?> "><i class="fa fa-github-square  pr-1  pt-0 mt-0 pb-0 post_link" aria-hidden="true"> </i> Git Link </a>


                           </div>
                       </div>
                   </div>
                   </div>


                   <?php


                 }
               }?>
                 </div>

</div>
<!-- The modal -->

<div class="modal fade mt-5 mb-5 pt-5" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">



      <div class="modal-header mt-5 pt-5 pb-0 text-centre">
        <h3 class="modal-title model_type" id="exampleModalLabel">Details</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>



      <div class="modal-body ">
        <div class="col-md-12 shadow_div">
            <div class="">

                <div class="panel-body">
                    <div class="bio-chart">
                      <div style="display:inline;width:100px;height:100px;">
                         <img src="" class="img-fluid img-responsive img-circle modal_image" alt="..." style="display:inline;width:100px;height:100px;">
                       </div>
                    </div>
                    <div class="bio-desk">
                      <h4 class="red modal_title"></h4>
                       <p class="modal_description" </p>
                         <p class="modal_start_date"></p>
                         <p class="modal_end_date"></p>

<a target="_blank"  class="btn btn-primary model_link "  href=" "><i class="fa fa-github-square  pr-1  pt-0 mt-0 pb-0 post_link" aria-hidden="true"> </i> Git Link </a>


                    </div>
                </div>
            </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>
  </div>
</div>




<div  class="modal fade mt-5  mb-5 pt-1" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div style="" class="modal-content mail_content big_screen">
      <div  class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <b>Collaborate With Me</b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  ">
        <div class="before">


        <p class="modal_content first"> Please enter your reason for collaboration   </p>
        <form>
         
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea id="req_content" class="form-control" rows="10"name="req_content"  required></textarea>
            <label for="recipient-name" style="font-size:1rem;" class=" content_warning text-danger pull-right"></label>

          </div>
        </form>
    </div>

<div style="display:none;" class="after">

<div class="alert alert-success"> <strong>Success! </strong> Collaboration Request Sent Successfully</div>
        <div class="form-group">
<div style="display:none;" class="mail">
  <label for="message-text" class="col-form-label">Draft a Mail To Me:</label>


<a class="btn btn-primary mail_anchor" target="_blank" rel="noopener noreferrer" href=""><i  class="far  fa-envelope fa-2x pull-right"></i></a>
        <!-- <button type="button" name="button" class="btn btn-primary">  <i  class="far  fa-envelope fa-2x pull-right"></i></button> -->
</div>

<div style="display:none;" class="not_mail">
  <label for="message-text" class="col-form-label">I have been notified!!! </label>

</div>

  </div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" onclick="submitFunction()" name="edit_user_role" class="btn btn-primary">Submit Details</button>
      </div>

    </div>
  </div>
</div>

<div  class="modal fade mt-5  mb-5 pt-4" id="mailModalPublic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div style="" class="modal-content mail_content big_screen">
      <div  class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <b>Collaborate With Me</b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  ">
        <div class="before">


        <p class="modal_content first"> Please enter your Email and reason for collaboration   </p>
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Your Email:</label>
            <input type="email" id="req_emailPublic" class="form-control" name="req_email" id="sender_email" value="" required>
            <label for="recipient-name" style="font-size:1rem;" class=" email_warning text-danger pull-right"></label>

          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea id="req_contentPublic" class="form-control" rows="10"name="req_content"  required></textarea>
            <label for="recipient-name" style="font-size:1rem;" class=" content_warning text-danger pull-right"></label>

          </div>
        </form>
    </div>

<div style="display:none;" class="after">

<div class="alert alert-success"> <strong>Success! </strong> Collaboration Request Sent Successfully</div>
        <div class="form-group">
<div style="display:none;" class="mail">
  <label for="message-text" class="col-form-label">Draft a Mail To Me:</label>


<a class="btn btn-primary mail_anchor" target="_blank" rel="noopener noreferrer" href=""><i  class="far  fa-envelope fa-2x pull-right"></i></a>


        <!-- <button type="button" name="button" class="btn btn-primary">  <i  class="far  fa-envelope fa-2x pull-right"></i></button> -->
</div>

<div style="display:none;" class="not_mail">
  <label for="message-text" class="col-form-label">I have been notified!!! </label>

</div>

  </div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" onclick="submitFunctionPublic()" name="edit_user_role" class="btn btn-primary">Submit Details</button>
      </div>

    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>





<script type="text/javascript">

function submitFunction(){

var content=  $('#req_content').val();
var sender_email ='<?php if(isset($session_email)){ echo $session_email;} ?>';
var subject= "To Collaborate With You";
var reciever_email =  '<?php echo $user_email;  ?>';
var user_view_email = '<?php echo $user_view_email ?>';


if (content){
  // $('.email_warning').text("");

  $('.content_warning').text("");
  $('.mail_anchor').attr("href","https://mail.google.com/mail/?view=cm&fs=1&to="+reciever_email+"&su="+subject+"&body="+content);
$.ajax({
  url: '../ajax.php',
  type: 'post',
  data: {
    'collab':1,
    'content': content,

    'sender_email':sender_email,
    'reciever_email':reciever_email
  },
  success: function(response){

// $('#mailModal').modal('toggle');

if(response.trim()=='success'){
$('.modal-content.mail_content.big_screen').css('padding-top', '0px');
$('.collab').css('display', 'none');
 $('.before').css('display', 'none');
  $('.after').css('display', 'inline');
  $('.uncollab').css('display', 'inline');
if (user_view_email==0){

  $('.mail').css('display', 'inline');
}else if(user_view_email==1){

  $('.not_mail').css('display', 'inline');
}


}
  }
});
}else{
  if(!content){
    $('.content_warning').text("*Enter Something");
  }

}
}
function submitFunctionPublic(){
var content=  $('#req_contentPublic').val();
var sender_email =  $('#req_emailPublic').val();
var subject= "To Collaborate With You";
var reciever_email =  '<?php echo $user_email;  ?>';
var user_view_email = '<?php echo $user_view_email ?>';
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var correct_email= regex.test(sender_email);
console.log(content);
if (correct_email && content){
  $('.email_warning').text("");
  $('.content_warning').text("");
  $('.mail_anchor').attr("href","https://mail.google.com/mail/?view=cm&fs=1&to="+reciever_email+"&su="+subject+"&body="+content);
$.ajax({
  url: '../ajax.php',
  type: 'post',
  data: {
    'publicCollab':1,
    'content': content,

    'sender_email':sender_email,
    'reciever_email':reciever_email
  },
  success: function(response){

// $('#mailModal').modal('toggle');

if(response.trim()=='success'){
$('.modal-content.mail_content.big_screen').css('padding-top', '0px');
$('.collab').css('display', 'none');
 $('.before').css('display', 'none');
  $('.after').css('display', 'inline');
if (user_view_email==0){

  $('.mail').css('display', 'inline');
}else if(user_view_email==1){

  $('.not_mail').css('display', 'inline');
}


}
  }
});
}else{
  if(!correct_email && !content){
    $('.email_warning').text("*Invalid Email");
    $('.content_warning').text("*Enter Something");
  }else if(!correct_email){
        $('.email_warning').text("*Invalid Email");
        $('.content_warning').text("");
  }else if(!content){
    console.log(content);
    $('.content_warning').text("*Enter Something");
    $('.email_warning').text("");
  }

}
}

$('[data-toggle="modal"]').on('click', function(e) {
    e.preventDefault();

    var type = $(this).data('type');
    var description = $(this).data('description');
    var end_date = $(this).data('end_date');
    var start_date = $(this).data('start_date');
    var title = $(this).data('title');
    var link = $(this).data('link');
    var image =$(this).data('image');


if(type==1){
  $(".model_type").text( "Project Deatails" );

}else{
  $(".model_type").text( "Certification Deatails" );
}

$(".modal_title").text( title );
$(".model_link").attr("href",link);
$(".modal_start_date").text( "Started: "+start_date );
$(".modal_end_date").text( "Completed: "+end_date );
$(".modal_image").attr("src","../images/"+image);
$(".modal_description").text( description );


});





$(document).ready(function(){






    // when the user clicks on unlike
    $('.uncollab').on('click', function(){
      var sessionEmail = $(this).data('user_session_email');
      var userEmail = $(this).data('user_email');
      var toggle = $(this).data('toggle');

          $post = $(this);
          console.log("going");

      $.ajax({
        url: 'ajax.php',
        type: 'post',
        data: {
          'uncollab': 1,

          'user_session_email':sessionEmail,
          'user_email':userEmail,
        },
        success: function(response){
  console.log("interested");
         $('.uncollab').css('display', 'none');
         $('.collab').css('display', 'inline');
           $('.before').css('display', 'block');
             $('.after').css('display', 'none');
             $('#req_content').val("");



        }
      });
    });


		$('.edit_post_with_id').on('click', function(){
			var postid = $(this).data('post_id');

		    // $post = $(this);


			$.ajax({
				url: 'view_profile.php',
				type: 'post',
				data: {
					'edit_post': 1,
					'post_id': postid
				},
				// success: function(response){
        //
        //
        //
        //
				// }
			});
		});
	});
</script>
</body>
</html>
<?php  }else {
  echo "User is not a Cyeratic memeber";
} ?>
