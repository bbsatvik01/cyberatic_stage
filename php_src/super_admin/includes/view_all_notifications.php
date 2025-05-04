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

  if(isset($session_role) &&  $session_role == 5 || $session_role == 6 ){




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

// mysqli_query($connection,"DELETE FROM notifications WHERE notification_deadline<CURRENT_DATE");


 ?>











<?php

if(isset($_POST["delete_notification"])){

 $delete_notification_id=$_POST["delete_notification_id"];
 $deleted_notification=mysqli_query($connection,"DELETE FROM notifications WHERE notification_id='$delete_notification_id'");

 if (!$deleted_notification) {

 die("Users total count query failed".mysqli_error($connection));
 }
 else {
   ?><div class="alert alert-success"> <strong>Success! </strong> Notification deleted  Succesfully</div> <?php

 }
 }





 ?>


<h3 class="text-center pb-3 text-muted">All Notifications Of Coding Club</h3>



<?php

if (isset($_POST["edit_notification"])) {

$form_sent_edit_notification_id = $_POST["notification_id"];


  $query = "SELECT * FROM notifications WHERE  notification_id = $form_sent_edit_notification_id ORDER BY notification_id DESC";
  $found_notification = mysqli_query($connection,$query);
  if (!$found_notification) {
    die("Query failed you".mysqli_error($connection));
  }else {
    while ($row1 = mysqli_fetch_assoc($found_notification)) {

      $edit_notification_id              =       $row1["notification_id"];
      $edit_notification_date            =       $row1["notification_date"];
      $edit_notification_content         =       $row1["notification_content"];
      $edit_notification_link            =       $row1["notification_link"];
      $edit_notification_target          =       $row1["notification_target"];
      $edit_notification_type            =       $row1["notification_type"];
      $edit_notification_deadline        =       $row1["notification_deadline"];


    }
  }





?>



<div class="container">
    <form enctype="multipart/form-data" class="" action="" method="post">
        <h2 class="text-center pb-3 pt-3">Edit Notification</h2>
    <div class="row jumbotron">
      <div class="col-sm-6 form-group">
          <label for="">Target Users</label>
          <select id="" class="form-control browser-default custom-select" name="notification_target" value="">

         <option value="<?php echo $edit_notification_target; ?>"><?php if (isset($edit_notification_target)) {echo $edit_notification_target;} ?></option>
          <option value="all">All Users</option>
          <option value="Web Development">Web Development users</option>
          <option value="App Development">App Development users</option>
          <option value="Python">Python users</option>
          <option value="Cyber Security">Cyber Security users</option>
          <option value="Hackathon">Hackathon</option>


      </select>
      </div>


      <div class="col-sm-6 form-group">
          <label for="">Notification Type</label>
          <select id="" class="form-control browser-default custom-select" name="notification_type" value="">
          <option value="<?php if (isset($edit_notification_type)) {echo $edit_notification_type;} ?>"><?php if (isset($edit_notification_type)) {echo $edit_notification_type;} ?></option>
          <option value="alert alert-info">Normal Notification</option>
          <option value="alert alert-success">Succesful Notification</option>
          <option value="alert alert-danger">Urgent Notification</option>


      </select>
      </div>




        <div class="col-sm-6 form-group">
            <label for="name-l">Notification Date</label>
            <input type="Date" class="form-control" name="notification_date" value="<?php if (isset($edit_notification_date)) {echo $edit_notification_date;} ?>" id="-l" placeholder="Enter your last name." required>
        </div>

        <div class="col-sm-6 form-group">
            <label for="name-l">Notification Deadline</label>
            <input type="Date" class="form-control" name="notification_deadline" value="<?php if (isset($edit_notification_deadline)) {echo $edit_notification_deadline;} ?>" id="-l" placeholder="Enter your last name." required>
        </div>

        <div class="col-sm-6 form-group">
            <label for="address-1">Notification link</label>
            <input type="text" class="form-control" name="notification_link" value="<?php if (isset($edit_notification_link)) {echo $edit_notification_link;} ?>" id="" placeholder="." required>
        </div>

        <div class="col-sm-6 form-group">
            <label for="name-f">Notification Content</label>

            <textarea class="form-control" name="notification_content"  rows="4" cols="40" required><?php if (isset($edit_notification_content)) {echo $edit_notification_content;} ?></textarea>
        </div>




<input type="hidden" name="notification_id" value="<?php if (isset($edit_notification_id)) {echo $edit_notification_id;} ?>">



        <div class="col-sm-12 form-group mb-0">
            <a href="view_all_notifications.php" class="btn btn-secondary"> Cancel</a>
           <button class="btn btn-primary float-right" name="submit_edit_notification">Update Notification</button>
        </div>

    </div>
    </form>
</div>

<?php


}


 ?>






<?php

if (isset($_POST["submit_edit_notification"])) {


$submitted_notification_id              =         escape($_POST["notification_id"]);
$submitted_notification_date            =         escape($_POST["notification_date"]);
$submitted_notification_content         =         escape($_POST["notification_content"]);
$submitted_notification_link            =         escape($_POST["notification_link"]);
$submitted_notification_target          =         escape($_POST["notification_target"]);
$submitted_notification_type            =         escape($_POST["notification_type"]);
$submitted_notification_deadline        =         escape($_POST["notification_deadline"]);
$notification_sender                    =        $session_email;




$query2 =  "UPDATE notifications SET notification_date = '{$submitted_notification_date}' , notification_content ='{$submitted_notification_content} ' , notification_link  = '{$submitted_notification_link}' , notification_target = '{$submitted_notification_target}' , notification_type = '{$submitted_notification_type}', notification_deadline= '{$submitted_notification_deadline}' , notification_sender = '{$notification_sender}'  WHERE notification_id = $submitted_notification_id";
$updated_notification = mysqli_query($connection,$query2);
if (!$updated_notification) {
  die("update  post query failed".mysqli_error($connection));

}else {
  ?><div class="alert alert-success"> <strong>Success! </strong> Notification Updated  Succesfully</div> <?php

}






}



 ?>
<?php


                   $total_active_nottifications =0;
                   $today = date("Y-m-d");
                   $total_upcoming_notification =0;
                   $total_notifications_count=0;
                   $priority_1_notification =0;
                   $priority_2_notification =0;
                   $priority_3_notification=0;
                $query = "SELECT * FROM notifications";
                $notification_details = mysqli_query($connection,$query);
                if(!$notification_details){
                die("query failed".mysqli_error($connection));
                }
                else {
                  $record =array();
                  while ($row = mysqli_fetch_assoc($notification_details)) {
                     $record[] = $row;
                     $total_notifications_count++;
                     if($row["notification_date"] > $today  || $row["notification_deadline"] < $today){
                         $total_upcoming_notification++;

                     }
                     if($row["notification_date"] < $today){
                        $total_active_nottifications++;

                     }
                     if($row["notification_type"] == "alert alert-danger"){
                       $priority_1_notification++;
                     }
                     if($row["notification_type"] == "alert alert-info"){
                       $priority_2_notification++;
                     }
                     if($row["notification_type"] == "alert alert-success"){
                       $priority_3_notification++;
                     }

                  }
                }




 ?>


 <legend><h3 class="text-center pt-5">Quick Overview</h3></legend>






<div class="row pb-5">




  <div class="container">


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
                                  <h5 class="pull-right"> Notifications</h5>
                                    <h5 class="pull-right"> Total - </h5>


                                </div>
                                <div class="col-12">
                                  <h6 class="pull-right mt-3">
                                      <?php if (isset($total_notifications_count)) {  echo $total_notifications_count; }
                                      ?>
                                  </h6>
                                </div>
                              </div>
                           </div>
                       </div>
                   </div>
                   <a href="view_all_users.php">
                       <div class="card-footer">
                           <span class="pull-left">Scroll Down</span>
                           <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                           <div class="clearfix"></div>
                       </div>
                   </a>
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
                                  <h5 class="pull-right"> Notifications</h5>
                                  <h5 class="pull-right"> Active -</h5>
                                </div>
                                <div class="col-12">
                                  <h6 class="pull-right mt-3">
                                      <?php if (isset($total_active_nottifications)) {     echo $total_active_nottifications;  }  ?>
                                  </h6>
                                </div>
                              </div>
                           </div>
                       </div>
                   </div>
                   <a href="view_all_posts.php">
                       <div class="card-footer">
                           <span class="pull-left">Scroll Down</span>
                           <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                           <div class="clearfix"></div>
                       </div>
                   </a>
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
                                  <h5 class="pull-right">Notifications</h5>
                                  <h5 class="pull-right"> Upcoming - </h5>
                                </div>
                                <div class="col-12">
                                  <h6 class="pull-right mt-3">
                                      <?php if (isset($total_upcoming_notification)) { echo $total_upcoming_notification;  }    ?>
                                  </h6>
                                </div>
                              </div>
                           </div>
                       </div>
                   </div>
                   <a href="view_all_events.php">
                       <div class="card-footer">
                           <span class="pull-left">Scroll Down</span>
                           <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                           <div class="clearfix"></div>
                       </div>
                   </a>
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
                                  <h5 class="pull-right">Notifications</h5>

                                  <h5 class="pull-right">Priority 1 - </h5>
                                </div>
                                <div class="col-12">
                                  <h6 class="pull-right mt-3">
                                      <?php if (isset($priority_1_notification)) {echo $priority_1_notification;}  ?>
                                  </h6>
                                </div>
                              </div>
                           </div>
                       </div>
                   </div>
                   <a href="view_all_notifications.php">
                       <div class="card-footer">
                           <span class="pull-left">Scroll Down</span>
                           <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                           <div class="clearfix"></div>
                       </div>
                   </a>
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
                                  <h5 class="pull-right">Notifications</h5>
                                  <h5 class="pull-right"> Priority 2 - </h5>
                                </div>
                                <div class="col-12">
                                  <h6 class="pull-right mt-3">
                                      <?php if (isset($priority_2_notification)) {echo $priority_2_notification;}  ?>
                                  </h6>
                                </div>
                              </div>
                           </div>
                       </div>
                   </div>
                   <a href="view_all_tests.php">
                       <div class="card-footer">
                           <span class="pull-left">Scroll Down</span>
                           <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                           <div class="clearfix"></div>
                       </div>
                   </a>
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
                                    <h5 class="pull-right">Notifications</h5>
                                    <h5 class="pull-right"> Priority 3 - </h5>
                                  </div>
                                  <div class="col-12">
                                    <h6 class="pull-right mt-3">
                                        <?php if (isset($priority_3_notification)) {echo $priority_3_notification;}  ?>
                                    </h6>
                                  </div>
                                </div>
                             </div>
                         </div>
                     </div>
                     <a href="view_all_tests.php">
                         <div class="card-footer">
                             <span class="pull-left">Scroll Down</span>
                             <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                             <div class="clearfix"></div>
                         </div>
                     </a>
                 </div>
                </div>



         </div>
  </div>




  <legend><h3 class="text-center pt-5">General Analysis</h3></legend>

    <script src="../../admin/assets/js/plugins/chartjs.min.js"></script>


    <div class="chart-container">
      <canvas id="bar-chartcanvas" style="height:75px;width:150px;"></canvas>

    </div>

  <script type="text/javascript">
    $(document).ready(function () {

    var ctx = $("#bar-chartcanvas");

    var data = {
      labels : ["Total Notifications ", "Active Notifications", "Upcoming  Notifications ", "  Priority 1 " ," Priority 2" ," Priority 3"],
      datasets : [

        {


          label : "Count",
          data : [<?php if(isset($total_notifications_count)){ echo $total_notifications_count;} ?>, <?php if(isset($total_active_nottifications)){ echo $total_active_nottifications;} ?>,
             <?php if(isset($total_upcoming_notification)){ echo $total_upcoming_notification;} ?>, <?php if(isset($priority_1_notification)){ echo $priority_1_notification;} ?> , <?php if (isset($priority_2_notification)) {echo $priority_2_notification;}  ?> ,
             <?php if (isset($priority_3_notification)) {echo $priority_3_notification;}  ?>],
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














<legend><h3 class="text-center pt-5"> Notifications By Admin</h3></legend>




            <table class="table  table-dark table-hover" id="notification_table">
            	<thead class="thead-light">
            		<tr>
            			<th>S.No</th>
                  <th>Creater</th>
                  <th> Content</th>
                  <th> Link</th>

                  <th> Target </th>

                  <th> Type</th>
                  <th> Date</th>
                  <th>Deadline</th>


            			<th >Options</th>
                  <th >Options</th>
            			<!-- <th></th> -->
            		</tr>
            	</thead>
              <tbody>


                <?php
                   $i =1;


                   foreach ($record as $row1 ):
                     $notification_type            =       $row1["notification_type"];
                     $notification_target          =       $row1["notification_target"];

                     if($notification_type != 'post_block' && $notification_type != 'post_unblock' && $notification_type != 'internship_block' && $notification_type != 'internship_unblock' && $notification_target != 'admin' ){




                  $notification_id              =       $row1["notification_id"];
                  $notification_date            =       $row1["notification_date"];
                  $notification_content         =       $row1["notification_content"];
                  $notification_link            =       $row1["notification_link"];
                  $notification_target          =       $row1["notification_target"];
                  $notification_type            =       $row1["notification_type"];
                  $notification_deadline        =       $row1["notification_deadline"];
                  $notification_sender          =       $row1["notification_sender"];






?>
<tr>
<td><?php echo $i; ?></td>
<td><?php if(isset($notification_sender)){echo $notification_sender;} ?></td>
<td width="25%"><?php if (isset($notification_content)) {echo $notification_content;} ?></td>
<td>  <a target="_blank" href=" <?php if (isset($notification_link)) {echo $notification_link;} ?>" class="btn btn-primary">Link</a>  </td>
<td><?php if (isset($notification_target)) {echo $notification_target;} ?></td>
<td><?php if (isset($notification_type)) {echo $notification_type;} ?></td>
<td><?php if (isset($notification_date)) {echo date(' d-m-y', strtotime($notification_date));} ?></td>
<td><?php if (isset($notification_deadline)) {echo date(' d-m-y', strtotime($notification_deadline));} ?></td>


<td>

    <form class="" action="" method="post">
  <input type="hidden" name="notification_id" value="<?php echo $notification_id; ?>">
  <button type="submit" name="edit_notification" class="btn btn-warning">  <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
  </form>
</td>

<td>
  <form class="" action="" method="post">
    <input type="hidden" name="notification_id" value="<?php echo $notification_id; ?>">

    <button type="submit" name="delete_notification"  data-id="<?php echo $notification_id; ?>" class="btn btn-danger confirm-delete ">  <i class="fa fa-trash-o" aria-hidden="true"></i></button>
  </form>
</td>


</tr>

<?php

              $i++;
                       }
            endforeach;
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
      <input type="hidden" id="post_id" name="delete_notification_id" value="">
      <button type="submit" name="delete_notification" class="btn btn-danger">Delete</button>
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















<script>




$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    var modal_text= "Do you really want to delete this notification?";
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
    td = tr[i].getElementsByTagName("td")[3];
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
    td = tr[i].getElementsByTagName("td")[3];
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
     $('#notification_table').DataTable();
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
