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

  if(isset($session_role) &&  $session_role == 2 || $session_role == 6 ){




 ?>

<?php include "navigation.php"; ?>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" /> -->
<!-- <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
<style >
  table.dataTable{
    bordor-collapse:collapse;
  }
  .table-dark{
    background-color: #212529;

  }
  /* div{
    display: inline;
  } */
</style>

<?php


if(isset($_POST["edit_post_status_set_block_count"])){

  $edited_internship_id              =      $_POST["edited_internship_id"];
  $edited_internship_name            =      $_POST["edited_internship_name"];
  $notify_user_email                 =      $_POST["notify_user_email"];
  $edited_internship_status          =      $_POST["edited_internship_status"];


 $edited_post=mysqli_query($connection,"UPDATE internships SET internship_status = $edited_internship_status , internship_block_count = internship_block_count+1   WHERE internship_id ='$edited_internship_id'");

 if (!$edited_post) {

 die("posts Update  query failed".mysqli_error($connection));
 }
 else {


   $notification_date =  date('Y-m-d');
   $post_name_for_notification = $edited_internship_name;
   $notification_content = $edited_internship_name;
   $notification_link ="https://www.coursera.org/specializations/full-stack-mobile-app-development#courses";
   $notification_target = $notify_user_email;
   $notification_sender = $session_email;

   if($edited_internship_status == -2){
     $notification_type = "internship_block";

   }
   if($edited_internship_status == 0){
     $notification_type = "internship_unblock";

   }
   $notification_deadline = date('Y-m-d', strtotime("+5 days"));

   // $query_to_check = "SELECT notification_id FROM notifications WHERE notification_content = '$notification_content' AND notification_target = '$notification_target' AND notification_type ='$notification_type' ";
   // $if_already_exsists = mysqli_query($connection,$query_to_check);
   // $if_notifacation_exsists = mysqli_num_rows($if_already_exsists);
   $query = "INSERT INTO notifications (notification_date , notification_content , notification_link , notification_target , notification_type, notification_deadline,notification_sender)
             VALUES ('{$notification_date}','{$notification_content}','{$notification_link}','{$notification_target}','{$notification_type}','{$notification_deadline}' , '{$notification_sender}' )";

  $create_notification = mysqli_query($connection , $query);
  if(!$create_notification){
     die("notification didnot happen".mysqli_error($connection));

   ?><div class="alert alert-danger"> <strong>Failed! </strong>Notification Could Not Be Sent to User  About the Internship Status</div> <?php
  }else {
   ?><div class="alert alert-success"> <strong>Success! </strong> Notification Sent Successfully to User  About the Internship Status</div> <?php
  }



   ?><div class="alert alert-success"> <strong>Success! </strong> Internship  Blocked  Succesfully</div> <?php

 }
 }




 ?>


<?php





if(isset($_POST["increase_deadline_to_update_post"])){

 $edited_internship_id              =      $_POST["edited_internship_id"];
 $edited_internship_name            =      $_POST["edited_internship_name"];
 $notify_user_email                 =      $_POST["notify_user_email"];
 $edited_internship_status          =      $_POST["edited_internship_status"];



   if($edited_internship_status == -2){

           $notification_date =  date('Y-m-d');
           $post_name_for_notification = $edited_internship_name;
           $notification_content = $edited_internship_name;
           $notification_link ="https://www.coursera.org/specializations/full-stack-mobile-app-development#courses";
           $notification_target = $notify_user_email;
           $notification_sender = $session_email;
           $notification_type = "internship_block";


           $notification_deadline = date('Y-m-d', strtotime("+5 days"));

           $query = "UPDATE notifications SET notification_deadline = DATE_ADD(`notification_deadline` , INTERVAL 5 DAY) WHERE  notification_content = '$notification_content' AND notification_target = '$notification_target' AND
           notification_type ='$notification_type' ";
           $update_notification = mysqli_query($connection , $query);
           if(!$update_notification){
                   die("notification didnot happen".mysqli_error($connection));
                 ?><div class="alert alert-danger"> <strong>Failed! </strong>User Didnot get 5 more days to update the internship  before you can delete it ,please contatc admin </div> <?php
           }else {
                 ?><div class="alert alert-success"> <strong>Success! </strong> User Got 5 more days to update the internship before you can delete it </div> <?php
           }
     }



     if($edited_internship_status == 0){

           $notification_type = "internship_unblock";
           $notification_date =  date('Y-m-d');
           $post_name_for_notification = $edited_internship_name;
           $notification_content = $edited_internship_name;
           $notification_link ="https://www.coursera.org/specializations/full-stack-mobile-app-development#courses";
           $notification_target = $notify_user_email;
           $notification_sender = $session_email;

           $notification_deadline = date('Y-m-d', strtotime("+5 days"));


           $edited_post=mysqli_query($connection,"UPDATE internships SET internship_status = $edited_internship_status    WHERE internship_id ='$edited_internship_id'");

         if (!$edited_post) {

             die("posts Update  query failed".mysqli_error($connection));
         }else {
               $query = "INSERT INTO notifications (notification_date , notification_content , notification_link , notification_target , notification_type, notification_deadline,notification_sender)
                         VALUES ('{$notification_date}','{$notification_content}','{$notification_link}','{$notification_target}','{$notification_type}','{$notification_deadline}' , '{$notification_sender}' )";
               $create_notification = mysqli_query($connection , $query);
               if(!$create_notification){
                    die("notification didnot happen".mysqli_error($connection));
                  ?><div class="alert alert-danger"> <strong>Failed! </strong>Notification Could Not Be Sent to User   About Unblocking the internship</div> <?php
               }else {
                  ?><div class="alert alert-success"> <strong>Success! </strong> Notification Sent Successfully to User About Unblocking the internship</div> <?php
               }
               ?><div class="alert alert-success"> <strong>Success! </strong> internship  UnBlocked  Succesfully</div> <?php

         }



     }


 }





 ?>




<?php

if(isset($_POST["delete_post"])){

 $delete_post_id              =      $_POST["delete_post_id"];
 $delete_internship_company   =      $_POST["delete_internship_company"];
 $delete_internship_email     =      $_POST["delete_internship_user_email"];

 $deleted_post=mysqli_query($connection,"UPDATE internships SET internship_status=-1 WHERE internship_id='$delete_post_id'");

 if (!$deleted_post) {

 die("Users total count query failed".mysqli_error($connection));
 }
 else {

   $notification_date =  date('Y-m-d');
   $internship_name_for_notification = $delete_internship_company;
   $notification_content = $internship_name_for_notification;
   $notification_link ="https://www.coursera.org/specializations/full-stack-mobile-app-development#courses";
   $notification_target = $delete_internship_email;
   $notification_type = "internship_delete";
   $notification_deadline = date('Y-m-d', strtotime("+5 days"));
   $notification_sender = $session_email;




   $query = "INSERT INTO notifications (notification_date , notification_content , notification_link , notification_target , notification_type, notification_deadline,notification_sender)
             VALUES ('{$notification_date}','{$notification_content}','{$notification_link}','{$notification_target}','{$notification_type}','{$notification_deadline}','{$notification_sender}' )";

 $create_notification = mysqli_query($connection , $query);
 if(!$create_notification){
     die("notification didnot happen".mysqli_error($connection));
   ?><div class="alert alert-danger"> <strong>Failed! </strong>Notification Could Not Be Sent About Deleting the Internship</div> <?php
 }else {
   ?><div class="alert alert-success"> <strong>Success! </strong> Notification Sent Successfully About Deleting the Internship</div> <?php
 }

   ?><div class="alert alert-success"> <strong>Success! </strong> internship  Deleted Succesfully</div> <?php

 }
 }


 $total_active_internships= 0;
 $total_archived_internships=0;
 $total_deleted_internships=0;

 $total_internships_count = 0;

 $internships_count_query = "SELECT * FROM internships ORDER BY internship_status ASC , internship_id DESC";
 $total_internships = mysqli_query($connection,$internships_count_query);
 if (!$total_internships) {
 die("Users total count query failed".mysqli_error($connection));
 }


$internships_array=array();

 while ($row = mysqli_fetch_assoc($total_internships)) {
$internships_array[]=$row;
$total_internships_count++;




      if($row["internship_status"] == 1){
         $total_active_internships++;
      }
      if($row["internship_status"] == 0){
         $total_archived_internships++;
      }
      if($row["internship_status"] == -1){
         $total_deleted_internships++;
      }



}

 ?>







<h3 class="text-center pb-3 text-muted">All Internships Of Coding Club</h3>
<div class="row pb-5">









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
                         <h5 class="pull-right"> Internships </h5>
                           <h5 class="pull-right"> Total - </h5>


                       </div>
                       <div class="col-12">
                         <h6 class="pull-right mt-3 total_numbers">
                             <?php if (isset($total_internships_count)) {  echo $total_internships_count; }

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
                             <h5 class="pull-right"> Internships </h5>
                               <h5 class="pull-right"> Active - </h5>


                           </div>
                           <div class="col-12">
                             <h6 class="pull-right mt-3 total_numbers">
                                 <?php if (isset($total_active_internships)) {  echo $total_active_internships; }

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
                                 <h5 class="pull-right"> Archived - </h5>


                             </div>
                             <div class="col-12">
                               <h6 class="pull-right mt-3 total_numbers">
                                   <?php if (isset($total_archived_internships)) {  echo $total_archived_internships; }

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
                                   <h5 class="pull-right"> Deleted - </h5>


                               </div>
                               <div class="col-12">
                                 <h6 class="pull-right mt-3 total_numbers">
                                     <?php if (isset($total_deleted_internships)) {  echo $total_deleted_internships; }

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




  <!-- <div class="col-md-4">
    <p>Search by User Name :</p>
    <div class="input-group">
      <div class="form-outline">
        <input type="text" id="myInput" onkeyup="myFunction()"   class="form-control" >
      </div>
      <button id="search-button" type="button" class="btn btn-primary">
        <i class="fa fa-search"></i>
      </button>
    </div>
  </div>


  <div class="col-md-4">
    <p>Search by Email :</p>
    <div class="input-group">
      <div class="form-outline">
        <input type="text" id="myInput2" onkeyup="myFunction2()"   class="form-control" >
      </div>
      <button id="search-button" type="button" class="btn btn-primary">
        <i class="fa fa-search"></i>
      </button>
    </div>
  </div> -->

  <legend><h3 class="text-center pt-5">Quick  Analysis</h3></legend>


  <script src="../../admin/assets/js/plugins/chartjs.min.js"></script>


  <div class="chart-container">
    <canvas id="bar-chartcanvas" style="height:75px;width:150px;"></canvas>

  </div>

<script type="text/javascript">
  $(document).ready(function () {

  var ctx = $("#bar-chartcanvas");

  var data = {
    labels : ["Total Internships","Active Internships ", "Archived Internships ","Deleted Internships"],
    datasets : [

      {


        label : "Count",
        data : [<?php if(isset($total_internships_count)){ echo $total_internships_count;} ?>, <?php if(isset($total_active_internships)){ echo $total_active_internships;} ?>,
          <?php if(isset($total_archived_internships)){ echo $total_archived_internships;} ?>, <?php if(isset($total_deleted_internships)){ echo $total_deleted_internships;} ?>  ],
        backgroundColor : [
          "rgba(50, 150, 250, 0.3)",
          "rgba(50, 150, 250, 0.3)",
          "rgba(50, 150, 250, 0.3)",
          "rgba(50, 150, 250, 0.3)",
          "rgba(50, 150, 250, 0.3)",
          "rgba(50, 150, 250, 0.3)",
          "rgba(50, 150, 250, 0.3)",
          "rgba(50, 150, 250, 0.3)",
          "rgba(50, 150, 250, 0.3)",


        ],
        borderColor : [
          "rgba(55, 150, 250, 1)",
          "rgba(55, 150, 250, 1)",
          "rgba(55, 150, 250, 1)",
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






  <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


  <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
          var data = new google.visualization.arrayToDataTable([
            ['Move', 'Count'],
            ["Total Projects",<?php  if(isset($total_posts)){echo $total_posts;} ?>],
            [" Active Projects",<?php if (isset($total_active_posts)) { echo $total_active_posts;  } ?>],
            ["Archived  Projects ",  <?php if (isset($total_archived_posts)) { echo $total_archived_posts;  } ?>],
            ["Deleted Projects",<?php if (isset($total_deleted_posts)) {echo $total_deleted_posts;}  ?>]




          ]);

          var options = {
            width: 700,
            legend: { position: 'none' },
            chart: {
              title: 'Quick Analysis',
              subtitle: '' },
            axes: {
              x: {
                0: { side: 'top', label: ''} // Top x-axis.
              }
            },
            bar: { groupWidth: "50%" }
          };

          var chart = new google.charts.Bar(document.getElementById('top_x_div'));
          // Convert the Classic options to Material options.
          chart.draw(data, google.charts.Bar.convertOptions(options));
        };
      </script>

      <div class="pt-5 col-md-12" id="top_x_div" style="width:'auto'; height: 900px;"></div> -->


















</div>


<legend><h3 class="text-center pt-3">All Internships</h3></legend>

<table class="table  table-dark table-hover"  id="myTable" >
  <thead class="thead-light">
    <tr>
      <th style="width:1%">S.No</th>
      <th style="width:3%">User Email</th>
      <th >Company</th>
      <!--<th >Role</th>-->
      <!--<th >Start Date</th>-->
      <!--<th >End Date</th>-->
      <th style="width: 89%" >Description</th>
      <th style="width:3%">Status</th>


      <th colspan="2" style ="width:4%">Options</th>
      <!-- <th></th> -->
    </tr>
  </thead>
  <tbody class="">


    <?php

       $i =1;



foreach ($internships_array as $rec ) :




        $internship_id           =     $rec["internship_id"];
    $internship_company          =     $rec["internship_company"];
    $internship_user_email       =     $rec["internship_user_email"];
    $internship_start_date       =     $rec["internship_start_date"];
    $internship_status           =     $rec["internship_status"];
    $internship_end_date         =     $rec["internship_end_date"] ;
    $internship_role             =     $rec["internship_role"];
    $internship_description      =     $rec["internship_description"];



?>
<tr style="color:white;">
<td><?php echo $i; ?></td>
<td><?php echo $internship_user_email; ?></td>
<td><?php echo $internship_company; ?></td>
<!--<td><?php echo $internship_role; ?></td>-->
<!--<td><?php echo  date(' d-m-y', strtotime($internship_start_date)) ;?></td>-->
<!--<td><?php echo date(' d-m-y', strtotime($internship_end_date)) ; ?></td>-->
<td style="max-width: 40px; text-overflow: ellipsis;overflow: hidden;"><?php echo $internship_description ; ?></td>



<td><?php if (isset($internship_status) ) {
if ( $internship_status == 0) {
 ?><button data-user_email="<?php echo $internship_user_email; ?>" data-internship_status="<?php echo $internship_status; ?>" data-internship_title = "<?php echo $internship_company; ?>"  data-internship_id="<?php echo $internship_id; ?>"
    data-toggle="modal"  data-target="#exampleModal" data-whatever="@getbootstrap" type="button" name="button" class="btn btn-primary btn-sm">Archived</button> <?php
}elseif ( $internship_status == -1) {
  ?><button data-user_email="<?php echo $internship_user_email; ?>" data-internship_status="<?php echo $internship_status; ?>" data-internship_title = "<?php echo $internship_company; ?>" data-internship_id="<?php echo $internship_id; ?>"
    data-toggle="modal"   data-target="#exampleModal" data-whatever="@getbootstrap" type="button" name="button" class="btn btn-disabled btn-sm">Deleted</button> <?php
}
elseif ( $internship_status == 1) {
  ?><button data-user_email="<?php echo $internship_user_email; ?>" data-internship_status="<?php echo $internship_status; ?>" data-internship_title = "<?php echo $internship_company; ?>" data-internship_id="<?php echo $internship_id; ?>"
    data-toggle="modal"  data-target="#exampleModal" data-whatever="@getbootstrap" type="button" name="button" class="btn btn-warning btn-sm">Published</button> <?php
}
else if($internship_status == -2) {
  ?> <button data-user_email="<?php echo $internship_user_email; ?>" data-internship_status="<?php echo $internship_status; ?>" data-internship_title = "<?php echo $internship_company; ?>" data-internship_id="<?php echo $internship_id; ?>"
     data-toggle="modal"  data-target="#exampleModal" data-whatever="@getbootstrap" type="button" name="button" class="btn btn-danger btn-sm">Blocked</button> <?php
}
else if($internship_status == -3) {
  ?> <button data-user_email="<?php echo $internship_user_email; ?>" data-internship_status="<?php echo $internship_status; ?>" data-internship_title = "<?php echo $internship_company; ?>" data-internship_id="<?php echo $internship_id; ?>"
     data-toggle="modal"  data-target="#exampleModal" data-whatever="@getbootstrap" type="button" name="button" class="btn btn-danger btn-sm">Verify Now</button> <?php
}
} ?></td>




<td>

<!--
<button type="submit" name="edit_internship" data-status="<?php echo $internship_status  ?>"data-id="<?php echo $internship_id  ?>" data-description="<?php echo $internship_description  ?>"
data-end_date="<?php echo $internship_end_date  ?>" data-start_date="<?php echo $internship_start_date  ?>" data-role="<?php echo $internship_role  ?>"
data-company="<?php echo $internship_company  ?>" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"  class="btn btn-success btn-sm">
<i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button> -->


</td>
<td>
<button type="submit" name="delete_internship" data-title="<?php echo $internship_company; ?>"  data-id="<?php echo $internship_id; ?>" data-internship_user_email = <?php echo $internship_user_email; ?> class="btn btn-danger confirm-delete btn-sm">  <i class="fa fa-trash-o" aria-hidden="true"></i></button>

</td>

</tr>

<?php
  $i++;  endforeach;
    ?>
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
      <input type="hidden" id="post_id" name="delete_post_id" value="">
      <input type="hidden" id="internship_company" name="delete_internship_company" value="">
      <input type="hidden" id="delete_internship_user_email" name="delete_internship_user_email" value="">

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





<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Internship Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <p class="modal_post_title"></p>
        <p class="modal_content"></p>
        <form action="" method="post" class="pb-5">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Internship Status:</label>
            <input type="hidden" name="edited_internship_id" id="form_internship_id" value="">
            <input type="hidden" name="notify_user_email" id="form_internship_user_email" value="">
            <input type="hidden" name="edited_internship_name" id="form_internship_name" value="">


            <select id="" class="form-control browser-default custom-select" name="edited_internship_status" value="">


              <option value="-2">Block</option>
              <option value="0">Unblock(Archieve)</option>
              <!-- <option value="2">Admin</option> -->



        </select>

          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name=" edit_post_status_set_block_count" class="btn btn-primary" id="not_blocked">Update Status</button>
        <button type="submit" style="display:none;" name="increase_deadline_to_update_post" class="btn btn-primary" id="already_blocked">Update Status / Re-Warn</button>
      </div>
        </form>
    </div>
  </div>
</div>




<script>


$('[data-toggle="modal"]').on('click', function(e) {
    e.preventDefault();

    var internship_id = $(this).data('internship_id');
    var internship_status =$(this).data('internship_status');
    var internship_title =$(this).data('internship_title');
    var internship_user_email =$(this).data('user_email');


    var status_in_words ="";
    if(internship_status == -1){
        status_in_words =" Deleted";
    }
    if(internship_status == 0){

        status_in_words = "Archived";
    }
    if(internship_status == 1){
        status_in_words =" Published";
    }
    if(internship_status == -2){
        status_in_words = "Blocked";
    }
    if(internship_status == -3){
        status_in_words = "Under Verification";
    }


    var modal_text= "Current status is " +status_in_words;
    var modal_internship_title = "You are about to change the status of " + internship_title;

    $("#form_internship_id").val(internship_id);
    $("#form_internship_user_email").val(internship_user_email);
    $("#form_internship_name").val(internship_title);
    $(" .modal_content").text(modal_text);
    $(" .modal_post_title").text(modal_internship_title);


    if(internship_status == -2 || internship_status == -3){
    $("#already_blocked").css("display", "inline");
    $("#not_blocked").css("display", "none");

    }else {
    $("#not_blocked").css("display", "inline");
    $("#already_blocked").css("display", "none");



    }
});




$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    var title =$(this).data('title');
    var internship_user_email =$(this).data('internship_user_email');

    var modal_text= "Do you really want to delete "+title+" Internship?";
    $('#myModal').data('id', id).modal('show');
    $(".modal-footer #post_id").val( id );
    $(".modal-footer #internship_company").val(title);
    $(".modal-footer #delete_internship_user_email").val(internship_user_email);

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
    td = tr[i].getElementsByTagName("td")[2];
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
$(document).ready(function(){
     $('#posts_table').DataTable();
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
