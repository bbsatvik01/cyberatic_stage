<?php include 'super_admin_header.php'; ?>
<?php  include '../../includes/db.php'; ?>
<?php include '../../admin/includes/functions.php' ?>

<?php

if(isset($_SESSION["user_role"]) &&  isset($_SESSION["user_id"]) && isset($_SESSION["user_email"]) && isset($_SESSION["user_image"])   && !empty($_SESSION["user_role"]) && !empty($_SESSION["user_email"]) && !empty($_SESSION["user_id"])
        && !empty($_SESSION["user_image"]) )
{




  $session_email           =          encrypt_decrypt($_SESSION["user_email"], 'decrypt');
  $session_role            =          encrypt_decrypt($_SESSION["user_role"], 'decrypt');
  $session_user_id         =          encrypt_decrypt($_SESSION["user_id"], 'decrypt');
  $session_user_image      =          encrypt_decrypt($_SESSION["user_image"], 'decrypt');

  if(isset($session_role) &&  $session_role == 6 ){




 ?>

<?php include "navigation.php"; ?>



<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> -->

<!-- <h3 class="text-center pb-3 text-muted">All Users Of Coding Club</h3> -->
<?php
if (isset($_POST["delete_user"])) {
$delete_user_id=$_POST["delete_user_id"];
$deleted_user_role=mysqli_query($connection,"UPDATE users SET user_role=-1 WHERE user_id=$delete_user_id");
if (!$deleted_user_role) {
die("Users total count query failed".mysqli_error($connection));
}
else {
  ?><div class="alert alert-success"> <strong>Success! </strong> User  Deleted Succesfully</div> <?php

}

}




if (isset($_POST["edit_user_role"])) {
$edit_user_id=$_POST["edit_user_id"];
$edit_user_email = $_POST["edit_user_email"];  
$edit_user_name = $_POST["edit_user_name"];  
$edit_user_role=$_POST["selected_user_role"];

$edited_user_role=mysqli_query($connection,"UPDATE users SET user_role=$edit_user_role WHERE user_id='$edit_user_id'");
if (!$edited_user_role) {
  echo "string" ;
die("Users total count query failed".mysqli_error($connection));
}
else {
$to_email = $edit_user_email;


$to_name = $edit_user_name;

$otp ="";
$email_subject ="Welcome To Cyberatic";
$template_path ="../../admin/includes/email_templates/template_welcome.php";
$mail_sent = send_email($to_email,$to_name,$otp,$email_subject,$template_path);
if($mail_sent){
   ?><div class="alert alert-success"> <strong>Success! </strong> User Role Updated  Succesfully</div> <?php
}else{
    ?><div class="alert alert-danger"> <strong>Failed! </strong> User Role Updated  Succesfully But Mail could not be sent </div> <?php
}
  

}


}

$normal_users =0;
$moderator_users =0;
$admin_users=0;
$deleted_users =0;
$total_users_count=0;
$pending_users=0;
$project_managers =0;
$internship_managers =0;
$event_managers =0;
$test_managers =0;
$notification_managers =0;

$users_count_query = "SELECT * FROM users ORDER BY user_role DESC ,  user_id DESC";
$total_users = mysqli_query($connection,$users_count_query);
if (!$total_users) {
die("Users total count query failed".mysqli_error($connection));
}
$user_array=array();
// $total_users_count = mysqli_num_rows($total_users);
while ($row = mysqli_fetch_assoc($total_users)) {
$user_array[]=$row;
$total_users_count++;
if($row["user_role"] == 0){
  $normal_users++;
}
if($row["user_role"] == 1){
  $project_managers++;
}
if($row["user_role"] == 2){
  $internship_managers++;
}
if($row["user_role"] == 3){
  $event_managers++;
}
if($row["user_role"] == 4){
  $test_managers++;
}
if($row["user_role"] == 5){
  $notification_managers++;
}
if($row["user_role"] == 6){
  $admin_users++;
}
if($row["user_role"] == -1){
  $deleted_users++;
}
if($row["user_role"] == -2){
  $pending_users++;
}

}



// print_r($user_array);




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



);













$a++;
}


$unique_users_array = array_unique($for_unique_users);
$unique_users_array = array_values($unique_users_array);


for ($i=0; $i < count($unique_users_array) ; $i++) {
$post_count = 0;

for ($j=0; $j < count($posts_array) ; $j++) {
if($unique_users_array[$i] == $posts_array[$j]["post_user_email"]){
$post_count++;

}
}
$final_posts_count[$i] = array(

'post_user_email' =>$unique_users_array[$i],
'total_posts' => $post_count,



);


}


?>
<h3 class="text-center pb-3 text-muted">All Users Of Coding Club</h3>




      <div class="container">

        <legend><h3 class="text-center pt-5">Quick Overview</h3></legend>

            <div class="row mt-3">
               <div class="col-6 col-md-4 mt-3">
                   <div class="card">
                       <div class="card-body bg-warning">
                           <div class="row">
                               <div class="col-3">
                                 <i class="fa fa-users fa-5x" aria-hidden="true"></i>

                               </div>
                               <div class="col-9">
                                  <div class="row">
                                    <div class="col-12">
                                      <h5 class="pull-right"> users</h5>
                                        <h5 class="pull-right"> Total - </h5>


                                    </div>
                                    <div class="col-12">
                                      <h6 class="pull-right mt-3">
                                          <?php if (isset($total_users_count)) {  echo $total_users_count; }
                                          ?>
                                      </h6>
                                    </div>
                                  </div>
                               </div>
                           </div>
                       </div>
                       <span>
                           <div class="card-footer">
                               <span class="pull-left">Scroll Down</span>
                               <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                               <div class="clearfix"></div>
                           </div>
                       </span>
                   </div>
                </div>
                <div class="col-6 col-md-4 mt-3">
                   <div class="card">
                       <div class="card-body bg-success">
                           <div class="row">
                               <div class="col-3">
                              <i class="fa fa-bullseye fa-5x" aria-hidden="true"></i>
                               </div>
                               <div class="col-9">
                                  <div class="row">
                                    <div class="col-12">
                                      <h5 class="pull-right"> users</h5>
                                      <h5 class="pull-right"> Admin -</h5>
                                    </div>
                                    <div class="col-12">
                                      <h6 class="pull-right mt-3">
                                          <?php if (isset($admin_users)) {     echo $admin_users;  }  ?>
                                      </h6>
                                    </div>
                                  </div>
                               </div>
                           </div>
                       </div>
                       <span>
                           <div class="card-footer">
                               <span class="pull-left">Scroll Down</span>
                               <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                               <div class="clearfix"></div>
                           </div>
                       </span>
                   </div>
                 </div>
                 <div class="col-6 col-md-4 mt-3">
                   <div class="card">
                       <div class="card-body bg-info">
                           <div class="row">
                               <div class="col-3">
                                <i class="fa fa-plus-circle fa-5x" aria-hidden="true"></i>
                               </div>
                               <div class="col-9">
                                  <div class="row">
                                    <div class="col-12">
                                      <h5 class="pull-right">users</h5>
                                      <h5 class="pull-right"> Moderator - </h5>
                                    </div>
                                    <div class="col-12">
                                      <h6 class="pull-right mt-3">
                                          <?php if (isset($moderator_users)) { echo $moderator_users;  }    ?>
                                      </h6>
                                    </div>
                                  </div>
                               </div>
                           </div>
                       </div>
                       <span>
                           <div class="card-footer">
                               <span class="pull-left">Scroll Down</span>
                               <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                               <div class="clearfix"></div>
                           </div>
                       </span>
                   </div>
                  </div>
                  <div class="col-6 col-md-4 mt-3">
                   <div class="card">
                       <div class="card-body bg-success">
                           <div class="row">
                               <div class="col-3">
                                <i class="fa fa-hourglass fa-5x" aria-hidden="true"></i>
                               </div>
                               <div class="col-9">
                                  <div class="row">
                                    <div class="col-12">
                                      <h5 class="pull-right">users</h5>

                                      <h5 class="pull-right">Normal - </h5>
                                    </div>
                                    <div class="col-12">
                                      <h6 class="pull-right mt-3">
                                          <?php if (isset($normal_users)) {echo $normal_users;}  ?>
                                      </h6>
                                    </div>
                                  </div>
                               </div>
                           </div>
                       </div>
                       <span>
                           <div class="card-footer">
                               <span class="pull-left">Scroll Down</span>
                               <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                               <div class="clearfix"></div>
                           </div>
                       </span>
                   </div>
                  </div>
                <div class="col-6 col-md-4 mt-3">
                   <div class="card">
                       <div class="card-body bg-danger">
                           <div class="row">
                               <div class="col-3">
                                <i class="fa fa-hourglass-o fa-5x" aria-hidden="true"></i>
                               </div>
                               <div class="col-9">
                                  <div class="row">
                                    <div class="col-12">
                                      <h5 class="pull-right">users</h5>
                                      <h5 class="pull-right"> Deleted - </h5>
                                    </div>
                                    <div class="col-12">
                                      <h6 class="pull-right mt-3">
                                          <?php if (isset($deleted_users)) {echo $deleted_users;}  ?>
                                      </h6>
                                    </div>
                                  </div>
                               </div>
                           </div>
                       </div>
                       <span>
                           <div class="card-footer">
                               <span class="pull-left">Scroll Down</span>
                               <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                               <div class="clearfix"></div>
                           </div>
                       </span>
                   </div>
                  </div>


                  <div class="col-6 col-md-4 mt-3">
                     <div class="card">
                         <div class="card-body bg-danger">
                             <div class="row">
                                 <div class="col-3">
                                  <i class="fa fa-hourglass-o fa-5x" aria-hidden="true"></i>
                                 </div>
                                 <div class="col-9">
                                    <div class="row">
                                      <div class="col-12">
                                        <h5 class="pull-right">users</h5>
                                        <h5 class="pull-right"> Pending - </h5>
                                      </div>
                                      <div class="col-12">
                                        <h6 class="pull-right mt-3">
                                            <?php if (isset($pending_users)) {echo $pending_users;}  ?>
                                        </h6>
                                      </div>
                                    </div>
                                 </div>
                             </div>
                         </div>
                         <span>
                             <div class="card-footer">
                                 <span class="pull-left">Scroll Down</span>
                                 <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                                 <div class="clearfix"></div>
                             </div>
                         </span>
                     </div>
                    </div>



             </div>
      </div>










<div class="">

              <legend><h3 class="text-center pt-5">General Analysis</h3></legend>

                <script src="../../admin/assets/js/plugins/chartjs.min.js"></script>


                <div class="chart-container">
                  <canvas id="bar-chartcanvas" style="height:75px;width:150px;"></canvas>

                </div>

              <script type="text/javascript">
                $(document).ready(function () {

                var ctx = $("#bar-chartcanvas");

                var data = {
                  labels : ["Total Users ", "Admins ", "Moderators ", "Normal Users " ,"Deleted Users" ,"Pending Users"],
                  datasets : [

                    {


                      label : "Count",
                      data : [<?php if(isset($total_users_count)){ echo $total_users_count;} ?>, <?php if(isset($admin_users)){ echo $admin_users;} ?>, <?php if(isset($moderator_users)){ echo $moderator_users;} ?>,
                         <?php if(isset($normal_users)){ echo $normal_users;} ?> , <?php if (isset($deleted_users)) {echo $deleted_users;}  ?>  , <?php if (isset($pending_users)) {echo $pending_users;}  ?> ],
                      backgroundColor : [
                        "rgba(50, 150, 250, 0.3)",
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



<legend><h3 class="text-center pt-5">All users</h3></legend>


<table class="table  table-dark table-hover pt-3" id="user_table" id="myTable">
  <thead class="thead-light">
    <tr>
      <th >S.No</th>
      <th >Name</th>
      <th >Email</th>
      <th >Role</th>
      <th>Branch</th>
      <th >Sem</th>
      <th >Domain</th>
      <th > Score</th>
      <th >Projects</th>
      <th >View User</th>



      <th>Options</th>
      <!-- <th></th> -->
    </tr>
  </thead>
  <tbody>


<?php


 $i =1;
foreach ($user_array as $user ) {


    $user_id                =     $user["user_id"];
    $user_email             =     $user["user_email"];
    $user_first_name        =     $user["user_first_name"];
    $user_last_name         =     $user["user_last_name"];
    $user_branch            =     $user["user_branch"];
    $user_semester          =     $user["user_semester"];
    $user_description       =     $user["user_description"];
    $user_image             =     $user["user_image"];
    $user_domain            =     $user["user_domain"];
    $user_skills            =     $user["user_skills"];
    $user_gender            =     $user["user_gender"];
    $user_dob               =     $user["user_dob"];
    $user_score             =     $user["user_score"];
    $user_role              =     $user["user_role"];



?>
<tr>
<td><?php echo $i; ?></td>


<td>
<?php
$user_first_name  =   ucfirst($user_first_name);
$user_last_name = ucfirst($user_last_name);
echo "$user_first_name  $user_last_name";
?>
</td>


<td> <?php echo $user_email ;    ?>   </td>
<td><?php if (isset($user_role) ) {
if ( $user_role == 0) {
 ?><button data-id="<?php echo $user_id; ?>" data-name = "<?php echo $user_first_name. " ".$user_last_name ; ?>" data-mail = "<?php echo $user_email; ?>" data-role="<?php echo $user_role; ?>" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" 
 type="button" name="button" class="btn btn-primary btn-sm">User</button> <?php
}elseif ( $user_role == -1) {
  ?><button data-id="<?php echo $user_id; ?>" data-name = "<?php echo $user_first_name. " ".$user_last_name ; ?>" data-mail = "<?php echo $user_email; ?>"  data-role="<?php echo $user_role; ?>" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" type="button" name="button" class="btn btn-disabled btn-sm">Deleted</button> <?php
}
elseif ( $user_role == 1) {
  ?><button data-id="<?php echo $user_id; ?>" data-name = "<?php echo $user_first_name. " ".$user_last_name ; ?>" data-mail = "<?php echo $user_email; ?>" data-role="<?php echo $user_role; ?>" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" type="button" name="button" class="btn btn-warning btn-sm">Proj </button> <?php
}
elseif ( $user_role == 2){
  ?> <button data-id="<?php echo $user_id; ?>" data-name = "<?php echo $user_first_name. " ".$user_last_name ; ?>" data-mail = "<?php echo $user_email; ?>" data-role="<?php echo $user_role; ?>" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" type="button" name="button" class="btn btn-warning btn-sm">Intern </button> <?php
}
elseif ( $user_role == 3){
  ?> <button data-id="<?php echo $user_id; ?>" data-name = "<?php echo $user_first_name. " ".$user_last_name ; ?>" data-mail = "<?php echo $user_email; ?>" data-role="<?php echo $user_role; ?>" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" type="button" name="button" class="btn btn-warning btn-sm">Event </button> <?php
}
elseif ( $user_role == 4){
  ?> <button data-id="<?php echo $user_id; ?>" data-name = "<?php echo $user_first_name. " ".$user_last_name ; ?>" data-mail = "<?php echo $user_email; ?>" data-role="<?php echo $user_role; ?>" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" type="button" name="button" class="btn btn-warning btn-sm">Test </button> <?php
}
elseif ( $user_role == 5){
  ?> <button data-id="<?php echo $user_id; ?>" data-name = "<?php echo $user_first_name. " ".$user_last_name ; ?>" data-mail = "<?php echo $user_email; ?>" data-role="<?php echo $user_role; ?>" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" type="button" name="button" class="btn btn-warning btn-sm">Notifi </button> <?php
}
elseif ( $user_role == 6){
  ?> <button data-id="<?php echo $user_id; ?>" data-name = "<?php echo $user_first_name. " ".$user_last_name ; ?>" data-mail = "<?php echo $user_email; ?>" data-role="<?php echo $user_role; ?>" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" type="button" name="button" class="btn btn-success btn-sm">Admin</button> <?php
}

elseif ( $user_role == -2){
  ?> <button data-id="<?php echo $user_id; ?>" data-name = "<?php echo $user_first_name. " ".$user_last_name ; ?>" data-mail = "<?php echo $user_email; ?>"  data-role="<?php echo $user_role; ?>" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" type="button" name="button" class="btn btn-danger btn-sm">Review</button> <?php
}
} ?></td>
<td>


     <?php
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

     ?>


     </td>
<td> <?php echo $user_semester;  ?>   </td>
<td> <?php echo $user_domain;    ?>   </td>





<td>
 <?php echo $user_score;     ?>

<!--<form class="" action="" method="post">-->
<!--  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">-->
<!--  <button type="submit" name="edit" class="btn btn-warning"> <?php echo $user_score;     ?>  <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>-->
<!--</form>-->
 </td>


<td>

<?php
$final_count=0;
foreach ($final_posts_count as $count ) {
  if(isset($count["post_user_email"]) && $count["post_user_email"]==$user_email ){
  $final_count=   $count["total_posts"];
    break;
  }
}
    echo $final_count;





 ?>



</td>


<td>

  <?php
  $user_name           =          substr($user_email, 0, strpos($user_email, "_"));
  $user_name           =          $user_name . $user_semester;
  ?>

        <span > <a href="../../profile.php/<?php echo $user_name; ?> " class="btn btn-primary btn-sm view_profile">View </a> </span>



</td>

<td>
  <form class="" action="" method="post">
    <input type="hidden" name="post_id" value="<?php echo $user_id; ?>">
    <button type="submit" name="delete_post" data-email="<?php echo $user_email ;    ?>" data-id="<?php echo $user_id; ?>" class="btn btn-danger confirm-delete">  <i class="fa fa-trash-o" aria-hidden="true"></i></button>
  </form>

</tr>



<?php  $i++;  }  ?>



</tbody>
</table>



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
      <input type="hidden" id="post_id" name="delete_user_id" value="">
      <button type="submit" name="delete_user" class="btn btn-danger">Delete</button>
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













<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <p class="modal_content"></p>
        <form action="" method="post" class="pb-5">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">User Role:</label>
            <input type="hidden" name="edit_user_id" id="form_user_id" value="">
            <input type="hidden" name="edit_user_email" id="form_user_mail" value="">
            <input type="hidden" name="edit_user_name" id="form_user_name" value="">
            <select id="" class="form-control browser-default custom-select" name="selected_user_role" value="">


              <option value="0">Normal Users</option>
              <option value="1">Project Manager</option>
              <option value="2">Internship Manager</option>
              <option value="3">Event Manager</option>
              <option value="4">Test Manager</option>
              <option value="5">Notification Manager</option>
              <option value="6">Admin</option>




        </select>

          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="edit_user_role" class="btn btn-primary">Update Role</button>
      </div>
        </form>
    </div>
  </div>
</div>






<script>



// $('#myModal').on('show', function() {
//     var id = $(this).data('id');
//     console.log("string");
//         removeBtn = $(this).find('.danger');
//         console.log(id);
//         $("#myModalLabel").text(id);
// });
$('[data-toggle="modal"]').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    var mail = $(this).data('mail');
    var name = $(this).data('name');
    var role =$(this).data('role');
    var role_in_words ="";
    if(role == -1){
        role_in_words =" Deleted";
    }
    if(role == 0){

        role_in_words = "Normal User";
    }
    if(role == 1){
        role_in_words =" Project Manager";
    }
    if(role == 2){
        role_in_words =" Internships  Manager";
    }
    if(role == 3){
        role_in_words =" Event Manager";
    }
    if(role == 4){
        role_in_words =" Test Manager";
    }
    if(role == 5){
        role_in_words =" Notification Manager";
    }
    if(role == 6){
        role_in_words =" Super Admin";
    }



    var modal_text= "Current role is " +role_in_words;

    $("#form_user_id").val( id );
    $("#form_user_mail").val( mail );
    $("#form_user_name").val( name );
    
    
       $(" .modal_content").text(modal_text);
});




$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    var email =$(this).data('email');
    var modal_text= "Do you really want to delete "+email+" user?";
    $('#myModal').data('id', id).modal('show');
    $(".modal-footer #post_id").val( id );
       $(" .modal_content").text(modal_text);
});

$('#btnYes').click(function() {
    // handle deletion here
  	var id = $('#myModal').data('id');
  	$('[data-id='+id+']').remove();
  	$('#myModal').modal('hide');
});


function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  console.log(input);
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  console.log(table);
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    console.log(tr.length);
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



function myFunction2() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput2");
  console.log(input);
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  console.log(table);
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    console.log(tr.length);
    td = tr[i].getElementsByTagName("td")[5];
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


function myFunction3() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput3");
  console.log(input);
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  console.log(table);
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    console.log(tr.length);
    td = tr[i].getElementsByTagName("td")[6];
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

$(document).ready(function(){
     $('#user_table').DataTable();
});
</script>

<?php
  }else{
      echo " You are not authorized to visit the page";
  }
}else {
  echo "Please go back to login page and return back";
}


 ?>
