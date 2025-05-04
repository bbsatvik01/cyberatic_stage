<?php include "admin_header.php" ?>
<?php include "functions.php" ?>
<?php include "db.php" ?>



<?php


$new_user_created =0;

  if (isset($_POST["user_first_name"])) {
    $user_email         =      $_POST["user_email"];
    $password           =      $_POST["user_password"];
    $user_first_name    =      escape($_POST["user_first_name"]);
    $user_first_name    =      str_replace(" ", "",$user_first_name) ;
    $user_last_name     =      escape($_POST["user_last_name"]) ;
    $user_last_name     =      str_replace(" ", "",$user_last_name) ;
    $user_image         =      $_FILES['image']['name'];
    $user_image_temp    =      $_FILES['image']['tmp_name'];
    $user_branch        =      escape($_POST["user_branch"]) ;
    $user_semester      =      escape($_POST["user_semester"])  ;
    $user_description   =      escape ($_POST["user_description"]);
    $user_domain        =      escape($_POST["user_domain"])  ;
    $user_skills        =      escape($_POST["user_skills"]) ;
    $user_gender        =      escape ($_POST["user_gender"]);
    $user_dob           =      $_POST["user_dob"];
    $user_linkedin      =      escape ($_POST["user_linkedin"]);
    $user_git           =      escape ($_POST["user_git"]);
    $user_role          =      -2;

      if(empty($user_image)){
        if($user_gender == "Female"){
          $user_image == "../../images/default_female_user.png";
        }else {
          $user_image == "../../images/default_male_user.png";

        }
      }

      move_uploaded_file($user_image_temp,"../../images/$user_image");




$query = "INSERT INTO users (user_email,user_password,user_first_name,user_last_name,user_image,user_branch,user_semester,user_description,user_domain,user_skills,user_gender,user_dob,user_git,user_linkedin,user_role)
      VALUES('{$user_email}','{$password}','{$user_first_name}','{$user_last_name}','{$user_image}','{$user_branch}','{$user_semester}','{$user_description}','{$user_domain}','{$user_skills}','{$user_gender}','{$user_dob}','{$user_git}','{$user_linkedin}' ,'{$user_role}'  )";


      $user_details = mysqli_query($connection , $query);
      if(!$user_details){
        // die("query failed".mysqli_error($connection));
        $new_user_created = -1;
        ?>  <div class="alert alert-danger"> <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">  <i class="tim-icons icon-simple-remove"></i> </button> '
          '<span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i>  Sorry!   </strong>  Your profile could not be Made try again or contact the admin</span> </div><?php



      }else {
          $_SESSION["after_registration_test"] = 1;

        echo "<script type='text/javascript'>  window.location.replace('test_details.php'); </script>";
      }

  }


if(isset($_POST["verified"])){
  $user_email_verified=$_POST["user_email"];
  $password_verified=$_POST["password"];

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
CYBERATIC RVITM - Details
  </title>

    
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://codepen.io/skjha5993/pen/bXqWpR.css">
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
    <title>Registration Form Using Bootstrap 4</title>


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
body{margin-top:20px;
color: #bcd0f7;
  background: #1A233A;
}
.account-settings .user-profile {
  margin: 0 0 1rem 0;
  padding-bottom: 1rem;
  text-align: center;
}
.account-settings .user-profile .user-avatar {
  margin: 0 0 1rem 0;
}
.account-settings .user-profile .user-avatar img {
  width: 90px;
  height: 90px;
  -webkit-border-radius: 100px;
  -moz-border-radius: 100px;
  border-radius: 100px;
}
.account-settings .user-profile h5.user-name {
  margin: 0 0 0.5rem 0;
}
.account-settings .user-profile h6.user-email {
  margin: 0;
  font-size: 0.8rem;
  font-weight: 400;
}
.account-settings .about {
  margin: 1rem 0 0 0;
  font-size: 0.8rem;
  text-align: center;
}
.card {
  background: #272E48;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  border: 0;
  margin-bottom: 1rem;
}
.form-control {
  border: 1px solid #596280;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  font-size: .825rem;
  background: #1A233A;
  color: #bcd0f7;
}

</style>

<style media="screen">
  option{
    color: black !important;

  }
  .image_upload{
    cursor: pointer;
  }
</style>
</head>
<body>




    <div class="container">
<h2 class="text-center text-primary">Fill  Your Details To Proceed </h2>
<div class="row">
  <div class="col-md-12" id="display_error">

  </div>
</div>

      <div class="container">

        <!--<div class="progress mb-5 text-center mt-5 mr-auto" style="width:45%; height:15px;  margin: auto;">-->

        <!--  <div class="progress-bar  " role="progressbar" style="width: 98%; background-color:#007bff" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">98%</div>-->

        <!--</div>-->





      <form enctype="multipart/form-data" class="" action="" method="post" id="submit_final_form">
    <div class="row gutters">
    	<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
    		<div class="card h-100">
    			<div class="card-body">
    				<div class="account-settings">
    					<div class="user-profile">
    						<div class="user-avatar">
    							<img src="../../images/logo.png" alt="Maxwell Admin">
    						</div>
    						<h5 class="">CYBERATIC</h5>
    						<p class=""> <?php if (isset($user_email_verified)) {
                echo $user_email_verified;
                } ?>  </p>
    					</div>
    					<div class="about">
    						<h5 class="mb-2 text-primary">About</h5>
    						<p>I'm Yuki. Full Stack Designer I enjoy creating user-centric, delightful and human experiences.</p>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    		<div class="card h-100">
    			<div class="card-body">
    				<div class="row gutters">
    					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    						<h6 class="mb-3 text-primary">Personal Details</h6>
    					</div>

              <div class="col-sm-6 form-group">
                  <label for="name-f">First Name</label>
                  <input type="text" class="form-control" name="user_first_name" id="user_first_name" value="" placeholder="Enter your first name." required>
              </div>



              <div class="col-sm-6 form-group">
                  <label for="name-l">Last name</label>
                  <input type="text" class="form-control" name="user_last_name" id="user_last_name" value=""  placeholder="Enter your last name." required>
              </div>





              <div class="col-sm-6 form-group">
                  <label for="Date">Date Of Birth</label>
                  <input type="Date" name="user_dob" class="form-control"  value="" id="user_dob" placeholder="" required>
              </div>


              <div class="col-sm-6 form-group">
                  <label for="user_gender">Gender</label>
                  <select id="user_gender" class="form-control browser-default custom-select" name="user_gender" value="" required>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Unspesified">Unspecified</option>
              </select>
              </div>


              <div class="col-sm-6 form-group">
                  <label for="">Branch</label>
                  <select id="user_branch" class="form-control browser-default custom-select" name="user_branch" value="" required>
                  <option value="Information Science Engineering">Information Science Engineering</option>
                  <option value="Computer Science Engineering">Computer Science Engineering</option>
                  <option value="Electronics and Communication Science Engineering">Electronics and Communication Science Engineering</option>
                  <option value="Mechanical Engineering">Mechanical Engineering</option>

              </select>
              </div>


              <div class="col-sm-6 form-group">
                  <label for="">Semester</label>
                  <select id="user_semester" class="form-control browser-default custom-select" name="user_semester" required>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
              </select>
              </div>


              <div class="col-sm-6 form-group">
                  <label for="user_domain">interested Domain</label>
                  <select id="user_domain" class="form-control browser-default custom-select" name="user_domain" required >
                  <option value="Web Development">Web Development</option>
                  <option value="App Development">App Development</option>
                  <option value="Cyber Security">Cyber Security </option>
                  <option value="Languages">Languages</option>
                <option value="Hackathon">Hackathon</option>
              </select>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <p>Upload Image </p>
                              <div class="input-group">



                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                      </div>
                    </div>
              </div>


              <!--<div class="form-group col-sm-6">-->
              <!--  <label for="user-image">Image</label>-->

              <!--  <div class="custom-file">-->
              <!--    <input type="file" class="custom-file-input" name="image" id="image" aria-describedby="inputGroupFileAddon01">-->
              <!--    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>-->
              <!--  </div>-->
              <!--</div>-->

              <?php
              $skills = array('Algorithms',
'Analytical Skills',
'Big Data',
'Calculating',
'Compiling Statistics',
'Data Analytics',
'Data Mining',
'Database Design',
'Database Management',
'Documentation',
'Modeling',
'Modification',
'Needs Analysis',
'Quantitative Research',
'Quantitative Reports',
'Statistical Analysis',
'Applications',
'Certifications',
'Coding',
'Computing',
'Configuration',
'Customer Support',
'Debugging',
'Design',
'Development',
'Hardware',
'Implementation',
'Information Technology',
'Infrastructure',
'Languages',
'Maintenance',
'Network Architecture',
'Network Security',
'Networking',
'New Technologies',
'Operating Systems',
'Programming',
'Restoration',
'Security',
'Servers',
'Software',
'Solution Delivery',
'Storage',
'Structures',
'Systems Analysis',
'Technical Support',
'Technology',
'Testing',
'Tools',
'Training',
'Troubleshooting',
'Usability',
'Benchmarking',
'Budget Planning',
'Engineering',
'Fabrication',
'Following Specifications',
'Operations',
'Performance Review',
'Project Planning',
'Quality Assurance',
'Quality Control',
'Scheduling',
'Task Delegation',
'Task Management',
'Blogging',
'Digital Photography',
'Digital Media',
'Facebook',
'Instagram',
'Networking',
'Pinterest',
'SEO',
'Social Media Platforms',
'Twitter',
'Web Analytics',
'Client Relations',
'Email',
'Requirements Gathering',
'Research',
'Subject Matter Experts (SMEs)',
'Technical Documentation');

              ?>







                      <div class="col-sm-6 pb-3 ">
                       <label for="">Select Skills</label>
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
                      <!-- <label for="" class="pl-3 pt-1"> Your Skills :</label> -->

  <div class="col-md-12  all_pills pb-4 ">

    <div class="" id="tagpills">

    </div>


  </div>


  <div class="col-md-12">
    <div class="form-group">
      <label>About Me</label>
      <textarea rows="4" cols="80" class="form-control" name="user_description" id="user_description"  required><?php if (isset($user_description)) { echo "$user_description";}  ?></textarea>
    </div>
  </div>
  
  
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pt-3">
    						<h6 class="mb-3 text-primary">Additional  Details</h6>
    					</div>
  
  <div class="col-sm-6 form-group">
                  <label for="name-l">LinkedIn Profile</label>
    
                  <input type="text" class="form-control" name="user_linkedin" id="user_linedin" value=""  placeholder="LinkedIn Profile Link" required>
              </div>
              
              
    <div class="col-sm-6 form-group">
                  <label for="name-l">Git Profile</label>
                  <input type="text" class="form-control" name="user_git" id="user_git" value=""  placeholder="Git Profile Link" required>
              </div>          

<input type="hidden" name="user_email" id="user_email" value="<?php echo $user_email_verified; ?>">
<input type="hidden" name="user_password" id="user_password" value="<?php echo $password_verified; ?>">
            <div class="card-footer">
          <span class="pr-3 "><a href="#" class="btn btn-secondary "> Cancel</a></span>
          <!-- <span class=""><button type="submit"class="btn btn-primary final_stringfy" name="submitted_user_details_for_registration" id="submit_final">Submit</button></span> -->
          <a href="#" class="btn btn-primary final_stringfy"  name="submitted_user_details_for_registration" id="submit_final">Submit</a>

            </div>
    			</div>
    		</div>
    	</div>
    </div>
    </div>


</form>
  </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">

    jQuery(function($) {

      var i =0;
      var arr = new Array();
      var exsist = 0;
      var correct_skills = 0;
      var skills_arr = new Array();
      var if_verfied_for_ul = 0;
    skills_arr = <?php echo json_encode($skills) ?>;

    var final_checked_array = new Array();
    var final_array_index = 0;


    $('#tags input').on('focusout', function() {

      // var txt = this.value.replace(/[^a-zA-Z0-9\+\-\.\#]/g, ''); // allowed characters list
var txt = this.value;

      for (var j = 0; j < arr.length; j++) {

      if (arr[j] == txt ) {
       exsist =1;

     }

      }
    if (exsist ==1) {
    console.log("ssss");
    }else {
      if (txt) {
        for (var a = 0; a < skills_arr.length; a++) {
          if(skills_arr[a] == txt){
            arr[i] =  txt;
            i++;
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
      for( var i = 0; i < arr.length; i++){

             if ( arr[i] == del) {

                 arr.splice(i, 1);
             }
         }

          $(this).remove();

        }

    });



  $( "#tags button" ).on( "click", function() {

  });


 $( ".final_stringfy" ).on( "click", function() {
           var verified_skills ="";

         verfied_skills =   JSON.stringify(arr);
           var filter = arr.filter(function (el) {
          return el != null;
        });
        $("#browser").val(filter);
        $('#submit_final_form').submit();



//
//
// var user_email = document.getElementById("user_email").value;
// var user_password = document.getElementById("user_password").value;
// var user_first_name = document.getElementById("user_first_name").value;
// var user_last_name = document.getElementById("user_last_name").value;
// // var image = document.getElementById("image").value;
// var user_branch = document.getElementById("user_branch").value;
// var user_semester = document.getElementById("user_semester").value;
// var user_description = document.getElementById("user_description").value;
// var user_domain = document.getElementById("user_domain").value;
// var user_skills = document.getElementById("browser").value;
// var user_dob = document.getElementById("user_dob").value;
//
// $.ajax({
//
//     type: "POST",
//     url: "submitted_user_details.php",
//     data: {
//         user_email: user_email,
//         user_password:user_password,
//         user_first_name :user_first_name,
//         user_last_name:user_last_name,
//         // image : image,
//         user_branch:user_branch,
//         user_semester:user_semester,
//         user_description:user_description,
//         user_domain:user_domain,
//         user_skills:user_skills,
//         user_dob:user_dob
//
//
//
//
//     },
//     cache: false,
//     success: function (data) {
//          window.location.replace("https://codingclubrvitm.000webhostapp.com/admin/includes/dashboard.php");
//
//     }
// });



var user_created = <?php echo $new_user_created; ?>;

if(user_created == -1){

$("#display_error").html('<div class="alert alert-danger"> <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">  <i class="tim-icons icon-simple-remove"></i> </button> '+
'<span> <strong> <i class="fa fa-frown-o fa-3x" aria-hidden="true"> </i>  Sorry!   </strong>  Your profile could not be Made try again or contact the admin</span> </div>');

}
if(user_created == 1){
    // window.location.replace("https://codingclubrvitm.000webhostapp.com/admin/includes/dashboard.php");
    window.location.replace("dashboard.php");


}
});
});







    </script>





<?php include "admin_footer.php" ?>
