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




if (isset($session_user_id)) {
$query_message = 0;


  if (isset($_POST["user_first_name"])) {


    $user_idd           =      $session_user_id;
    $user_first_name    =      escape($_POST["user_first_name"]) ;

    $user_last_name     =      escape($_POST["user_last_name"]) ;
    $user_image         =      $_FILES['image']['name'];
    $user_image_temp    =      $_FILES['image']['tmp_name'];
    $user_branch        =      escape($_POST["user_branch"]) ;
    $user_semester      =      escape($_POST["user_semester"])  ;
    $user_description   =      escape($_POST["user_description"]);
    $user_domain        =      escape($_POST["user_domain"])  ;
    $user_skills        =      escape($_POST["user_skills"]) ;
    $user_gender        =      escape ($_POST["user_gender"]);
    $exsisting_image    =      $_POST["exsisting_image"];
    $user_dob           =      $_POST["user_dob"];
    $user_linkedin      =      escape ($_POST["user_linedin"]);
    $user_git           =      escape ($_POST["user_git"]);

    if (empty($user_image)) {
    $user_image = $exsisting_image;
    move_uploaded_file($user_image_temp,"../../images/$user_image");

    }else if(!empty($_POST["cropped_image"])){

         $post_cropped_image    =        escape($_POST["cropped_image"]);
         $data =  str_replace('"','',$post_cropped_image);

           $image_array_1 = explode(";", $data);



           $image_array_2 = explode(",", $image_array_1[1]);



           $data = base64_decode($image_array_2[1]);
           $user_name            =          substr($session_email, 0, strpos($session_email, "_"));
           $user_name            =          $user_name . strval($user_semester);
           $user_image           =          strval($user_name) . $user_image;

           $image_name = '../../images/' . $user_image ;

           file_put_contents($image_name, $data);

      }



  $query = "UPDATE users SET  user_first_name ='{$user_first_name} ' , user_last_name ='{$user_last_name}' ,  user_image = '{$user_image}' ,
   user_branch ='{$user_branch}' , user_semester ='{$user_semester}' ,  user_description='{$user_description}', user_domain = '{$user_domain}' , user_skills = '{$user_skills}'  , user_gender = '{$user_gender}' , user_dob = '{$user_dob}' , user_linkedin ='{$user_linkedin}'  ,
  user_git = '{$user_git}'  WHERE user_id = $user_idd ";




      $user_details = mysqli_query($connection , $query);
      if(!$user_details){
        die("query failed".mysqli_error($connection));
        $query_message =-1;
      }else {
    $_SESSION["user_image"]       =             encrypt_decrypt($user_image, 'encrypt');
    $session_user_image      =          encrypt_decrypt($_SESSION["user_image"], 'decrypt');


        $query_message = 1;

      }




  }






  $user_id = $session_user_id ;

  $query = "SELECT * FROM users WHERE user_id = $user_id";
  $user_details = mysqli_query($connection,$query);
  if(!$user_details){
  die("query failed".mysqli_error($connection));
  }else {

  while ($row = mysqli_fetch_assoc($user_details)) {

  $user_id                =     $row["user_id"];
  $user_email             =     $row["user_email"];
  $user_first_name        =     $row["user_first_name"];
  $user_last_name         =     $row["user_last_name"];
  $user_branch            =     $row["user_branch"];
  $user_semester          =     $row["user_semester"];
  $user_description       =     $row["user_description"];
  $user_imagee            =     $row["user_image"];
  $user_domain            =     $row["user_domain"];
  $user_skills            =     $row["user_skills"];
  $user_gender            =     $row["user_gender"];
  $user_dob               =     $row["user_dob"];
  $user_score             =     $row["user_score"];
  $user_linkedin          =     $row["user_linkedin"];
  $user_git               =     $row["user_git"];
  $user_favourite         =     $row["user_favourite"];



  }






  }










?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../images/logo.png">
  <link rel="icon" type="image/png" href="../../images/logo.png">
  <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
  <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>

  <title>
CYBERATIC RVITM - Member
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
  

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"> -->



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
              <a class="navbar-brand" href="javascript:void(0)">Edit Profile</a>
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
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
<div class="col-md-12">
  <?php if($query_message == 1){echo ' <div class="alert alert-success">
    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
      <i class="tim-icons icon-simple-remove"></i>
    </button>
    <span> <strong><i class="fa fa-smile-o" aria-hidden="true"></i> Success! </strong>  Your profile Have Been Updated  Successfully </span>

  </div>';} if($query_message == -1){echo ' <div class="alert alert-danger">
    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
      <i class="tim-icons icon-simple-remove"></i>
    </button>
    <span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i>  Sorry!   </strong>  Your profile  could not be Updated try again or contact the admin</span>

  </div>';} ?>
   <legend><h1 class="text-center text-primary pt-3">Your Profile</h1></legend>

</div>

          <div class="col-md-4">
            <div class="card card-user">
              <div class="card-body">
                <p class="card-text">
                  <div class="author">
                    <div class="block block-one"></div>
                    <div class="block block-two"></div>
                    <div class="block block-three"></div>
                    <div class="block block-four"></div>
                    <a href="javascript:void(0)">
                      <img class="avatar" src="../../images/<?php if(isset($user_imagee)) {echo "$user_imagee";} ?>" alt="...">
                      <h5 class="title"><?php
                        $user_first_name  =   strtoupper($user_first_name);
                        $user_last_name = strtoupper($user_last_name);
                        echo "$user_first_name  $user_last_name";
                       ?></h5>
                    </a>
                    <p class="description">
                  <?php if (isset($user_domain)) { echo "$user_domain";}  ?>
                    </p>
                  </div>
                </p>
                <div class="card-description">
                                <?php if (isset($user_description)) { echo "$user_description";}  ?>

                </div>
              </div>
              <div class="card-footer">
                <div class="button-container">
                  <a href="<?php echo $user_linkedin; ?>" class="btn btn-icon btn-round btn-facebook">
                    <i class="fa fa-linkedin-square"></i>
                  </a>

                  <a href="<?php echo $user_git; ?>" class="btn btn-icon btn-round btn-google">
                    <i class="fa fa-github-square"></i>
                  </a>
                </div>
              </div>
            </div>


            <div class="card ">
              <div class="card-body all_pills">
                <h3>Your Skills</h3>
                <p class="card-text " id="tagpills">

<?php
$existing_skills_arr = explode (",", $user_skills);


 ?>


                </p>

              </div>

            </div>

         

     <div class="card ">
                       <div class="card-body all_pills">
                         <h3>View Saved Posts</h3>
                         <form class="" action="saved" method="post">
                           <p class="card-text " id="tagpills">
                              <input type="hidden" id="saved_id" name="saved_id" value="<?php echo $user_favourite ?>">
                             <button class=" btn btn-secondary " type="submit" name="saved_posts"> View Saved</button>
                           </p>
                         </form>

                       </div>
                     </div>
          </div>

          <div class="col-md-8">

            <div class="card">
              <div class="card-header">
                <h5 class="title">Edit Profile</h5>
              </div>
              <div class="card-body">
                <form  enctype="multipart/form-data" class="" action="" method="post" id="submit_final_form">
                  <div class="row">
                    <div class="col-md-6 ">
                      <div class="form-group">
                        <label>First Name</label>
                      <input type="text" class="form-control" name="user_first_name" id="name-f" value="<?php if (isset($user_first_name)) { echo "$user_first_name";}  ?>" placeholder="Enter your first name." required>

                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="user_last_name" id="name-l" value="<?php if (isset($user_last_name)) { echo "$user_last_name";}  ?>"  placeholder="Enter your last name." required>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Gender</label>
                        <select id="sex" class="form-control browser-default custom-select" name="user_gender" value="<?php if (isset($user_gender)) { echo "$user_gender";}  ?>">
                        <option  value="Male">Male</option>
                        <option   value="Female">Female</option>
                        <option  value="Unspesified">Unspecified</option>
                    </select>
                      </div>
                    </div>


                    <div class="col-md-6 ">
                      <div class="form-group">
                        <label>Dob</label>
                        <input type="Date" name="user_dob" class="form-control"  value="<?php if (isset($user_dob)) { echo "$user_dob";}  ?>" id="Date" placeholder="" required>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="form-group">
                        <label>Branch</label>
                        <select  class="form-control browser-default custom-select" name="user_branch" value="">
                          <option value="<?php if (isset($user_branch)) { echo "$user_branch";}  ?>"><?php if (isset($user_branch)) { echo "$user_branch";}  ?></option>
                        <option  value="Information Science Engineering">Information Science Engineering</option>
                        <option  value="Computer Science Engineering">Computer Science Engineering</option>
                        <option  value="Electronics and Communication Science Engineering">Electronics and Communication Science Engineering</option>
                        <option  value="Mechanical Engineering">Mechanical Engineering</option>

                        </select>                      </div>
                    </div>


                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Semester</label>
                        <select  class="form-control browser-default custom-select " name="user_semester">
                          <option value="<?php if (isset($user_semester)) { echo "$user_semester";}  ?>"><?php if (isset($user_semester)) { echo "$user_semester";}  ?></option>
                        <option  value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        </select>
                      </div>
                    </div>


                    <div class="col-md-6 ">
                      <div class="form-group">
                        <label>Domain</label>
                        <select id="user_domain" class="form-control browser-default custom-select" name="user_domain" >
                          <option value="<?php if (isset($user_domain)) { echo "$user_domain";}  ?>"><?php if (isset($user_domain)) { echo "$user_domain";}  ?></option>
                         <option value="Web Development">Web Development</option>
                         <option value="App Development">App Development</option>
                         <option value="Cyber Security">Cyber Security </option>
                         <option value="Languages">Languages</option>
                         <option value="Hackathon">Hackathon</option>
                        </select>                      </div>
                    </div>


                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <p>Change Image </p>
                                    <div class="input-group">



                            <div class="custom-file">
                              <input type="file" class="custom-file-input upload_image" name="image" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                              <input type="hidden" name="cropped_image" class="object" value="">

                              <input type="hidden" name="exsisting_image" value="<?php if (isset($user_imagee)) { echo "$user_imagee";}  ?>">
                              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                          </div>
                    </div>

   <div class="col-md-6 pt-1 pb-2">
                    <div class="form-group">
                      <label>Linked In</label>
                    <input type="text" class="form-control" name="user_linedin"  value="<?php if (isset($user_linkedin)) { echo "$user_linkedin";}  ?>" placeholder="Enter your Linkedin Profile." required>

                        </div>
                  </div>

                        <div class="col-md-6 pt-1 pb-2">
                    <div class="form-group">
                      <label>Git Profile</label>
                    <input type="text" class="form-control" name="user_git"  value="<?php if (isset($user_git)) { echo "$user_git";}  ?>" placeholder="Enter your Git Profile" required>

                    </div>
                  </div>





                    <div class="col-md-12">
                      <div class="form-group">
                        <label>About Me</label>
                        <textarea rows="4" cols="80" class="form-control" name="user_description" ><?php if (isset($user_description)) { echo "$user_description";}  ?></textarea>
                      </div>
                    </div>


                    <?php
                    $skills = array("aa", "bb", "cc","dd","php","css","html","node","express.js", "ajax","web-designing","javascript" ,"pinky-pink","aa-bb");

                    ?>

<div class="col-md-12 pt-3 pb-3">


  <div class="panel-group" id="accordionSingleClosed" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
          <a class="collapsed" role="button" data-toggle="collapse" href="#collapseItemCloseOne" aria-expanded="true" aria-controls="collapseItemCloseOne">
        Add New Skills
          </a>
        </h4>
      </div>
      <div id="collapseItemCloseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
<div class="row">
  <div class="col-sm-6 pb-3 ">
   <label for="">Skills</label>
      <div id="tags">



         <input type="hidden" name="user_skills" id="browser" value="">
        <input list="user_skills" name=""  class="form-control"  value="">


        <datalist id="user_skills" >
<?php

for ($i=0; $i < count($skills); $i++) {
?><option value="<?php echo $skills[$i] ?>"></option><?php
}

?>


        </datalist>

      </div>

  </div>


  <div class="col-md-6   ">
    <div class="" id="tagpills">

    </div>


  </div>
</div>




        </div>
      </div>
    </div>





  </div>
</div>













<input type="hidden" name="user_id" value="<?php if (isset($user_id)) { echo $user_id;}  ?>">

                    <div class="card-footer">
                  <span class="pr-3 "><a href="" class="btn btn-secondary "> Cancel</a></span>
                  <a href="#" class="btn btn-primary final_stringfy"  name="submitted_user_details" id="submit_final">Submit</a>


              
                    </div>






                </div>
              </div>

            </div>
          </div>
      
        </div>
      </div>
    </form>
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

  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>


 
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>

  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script>
  <script src="../assets/demo/demo.js"></script>



  <script src="https://unpkg.com/dropzone"></script>
  <script src="https://unpkg.com/cropperjs"></script>
  <script type="text/javascript">

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
        $('#modalCrop').modal({
          backdrop: 'static',
          keyboard: false
        });
  			$('#modalCrop').modal('show');
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
  			aspectRatio: 8/8,
  			viewMode: 3,
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

  jQuery(function($) {

  if($(window).width() < 767)
    {
       // change functionality for smaller screens
    
    $('.navbar-toggler').on('click',function(){
      $('.navbar').removeClass('navbar-transparent');
      $('.navbar').addClass('bg-white');
    });
    }



});

  </script>




  <script>

      var arr = new Array();
      var exsist = 0;


      var skills_arr = new Array();
      skills_arr = <?php echo json_encode($skills) ?>;



    var existing_skills_arr = new Array();
    existing_skills_arr = <?php echo json_encode($existing_skills_arr) ?>




  for (var a = 0; a < existing_skills_arr.length; a++) {

    $('#tagpills').before('<span class="tag btn btn-success btn-sm">' + existing_skills_arr[a] + '</span>');

  }




    $('#tags input').on('focusout', function() {

      var txt = this.value.replace(/[^a-zA-Z0-9\+\-\.\#]/g, ''); // allowed characters list


      for (var j = 0; j < existing_skills_arr.length; j++) {

      if (existing_skills_arr[j] == txt ) {
       exsist =1;

     }

      }
    if (exsist ==1) {
 
    }else {
      if (txt) {
        for (var a = 0; a < skills_arr.length; a++) {
          if(skills_arr[a] == txt){
            existing_skills_arr[existing_skills_arr.length] =  txt;
            // i++;
         $('#tagpills').before('<span class="tag btn btn-success btn-sm">' + txt + '</span>');
          }

        }


      }



    }
      exsist =0;
    

      this.value = "";
      // this.focus();
    }).on('keyup', function(e) {

      if (/(188|13)/.test(e.which)) $(this).trigger('focusout');
    });





  $('.all_pills').on('click', '.tag', function() {

        if (confirm("Really delete this tag?")) {
      var del = $(this).text();
      for( var i = 0; i < existing_skills_arr.length; i++){

             if ( existing_skills_arr[i] == del) {

                 existing_skills_arr.splice(i, 1);
             }
         }

          $(this).remove();

        }
   
    });



  $( "#tags button" ).on( "click", function() {

   
  });

  $( ".final_stringfy" ).on( "click", function() {
           var verified_skills ="";

         verfied_skills =   JSON.stringify(existing_skills_arr);
        
           
           var filter = existing_skills_arr.filter(function (el) {
          return el != null;
        });
        $("#browser").val(filter);
        $('#submit_final_form').submit();

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
<?php   } ?>
<?php }else {
  echo "Please go back to login page and return back";
} ?>
