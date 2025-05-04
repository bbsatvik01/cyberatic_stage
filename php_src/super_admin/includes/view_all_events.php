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

  if(isset($session_role) &&  $session_role == 3 || $session_role == 6 ){




 ?>

<?php include "navigation.php"; ?>

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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 ?>

<?php

if(isset($_POST["button_status"])){
  $event_edit_id=$_POST["event_edit_id"];
  $event_edit_status=$_POST["event_edit_status"];
  if($event_edit_status==0){
    $edited_event_status=mysqli_query($connection,"UPDATE events SET event_status=1 , event_created_by = '{$session_email}' WHERE event_id='$event_edit_id'");
  }
  elseif ($event_edit_status==1) {
    $edited_event_status=mysqli_query($connection,"UPDATE events SET event_status=0 , event_created_by = '{$session_email}' WHERE event_id='$event_edit_id'");

  }

  if (!$edited_event_status) {

  die("Users total count query failed".mysqli_error($connection));
  }
  else {
    ?><div class="alert alert-success"> <strong>Success!</strong> Event Status Updated Succesfully</div> <?php

  }
}





 ?>





 <?php

if(isset($_POST["delete_event"])){

  $delete_event_id=$_POST["delete_event_id"];
  $deleted_event=mysqli_query($connection,"UPDATE events SET event_status=-1 , event_created_by = '{$session_email}' WHERE event_id='$delete_event_id'");

  if (!$deleted_event) {

  die("Users total count query failed".mysqli_error($connection));
  }
  else {
    ?><div class="alert alert-success"> <strong>Success!</strong> Event Deleted Succesfully</div> <?php

  }
  }





  ?>

<!-- <style media="screen">
#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}
</style> -->

<h3 class="text-center pb-3 text-muted">All Events Of Coding Club</h3>








<?php

if (isset($_POST["form_edit_event"])) {


$form_edit_event_id = $_POST["form_edit_event_id"];

$query3 = "SELECT * FROM events WHERE event_id = $form_edit_event_id";
$edit_event_query = mysqli_query($connection,$query3);
if(!$edit_event_query){
die("query failed".mysqli_error($connection));
}

while ($row1 = mysqli_fetch_assoc($edit_event_query)) {


$event_id                =       $row1["event_id"];
$event_title             =       $row1["event_title"];
$event_imagee            =       $row1["event_image"];
$event_date              =       $row1["event_date"];
$event_deadline          =       $row1["event_deadline"];
$event_link              =       $row1["event_link"];
$event_start_date        =       $row1["event_start_date"];
$event_caption           =       $row1["event_caption"];
$event_status            =       $row1["event_status"];
$event_domain            =       $row1["event_domain"];




}
?>

    <div class="container">
        <form enctype="multipart/form-data" class="" action="" method="post">
            <h2 class="text-center">Edit Event</h2>
        <div class="row jumbotron">
            <div class="col-sm-6 form-group">
                <label for="name-f">Event Title</label>
                <input type="text" class="form-control" name="submitted_edit_event_title" id="" value="<?php if(isset($event_title)){echo $event_title;} ?>" placeholder="Event Name " required>
            </div>

            <div class="col-sm-6 form-group">
                <label for="address-1">Event Link</label>
                <input type="text" class="form-control" name="submitted_edit_event_link" id="" value="<?php if(isset($event_link)){echo $event_link;} ?>"  placeholder=" Form / Website Link" required>
            </div>

            <div class="col-sm-6 form-group">
                <label for="name-l">Last Date to Register</label>
                <input type="Date" class="form-control" name="submitted_edit_event_deadline" id="-l" value="<?php if(isset($event_deadline)){echo $event_deadline;} ?>" placeholder="Enter your last name " required>
            </div>

            <div class="col-sm-6 form-group">
                <label for="email">Event Start Date</label>
                <input type="Date" class="form-control" name="submitted_edit_event_start_date" id="" value="<?php if(isset($event_start_date)){echo $event_start_date;} ?>" placeholder="Enter your email " required>
            </div>



            <div class="col-sm-6 form-group">
                <label for="">Status</label>
                <select id="" class="form-control browser-default custom-select" name="submitted_edit_event_status" value="">
                  <option value="<?php if(isset($event_status)){echo $event_status;} ?>"> <?php if(isset($event_status ) && $event_status == 0){echo "previously publsihed";}
                  else{echo "previously drafted";} ?> </option>
                <option value="0">Publish</option>
                <option value="1">Draft</option>

            </select>
            </div>
            <div class="col-sm-6 form-group">
                <label for="">Domain</label>
                <select id="" class="form-control browser-default custom-select" name="submitted_edit_event_domain" value="">
                  <option value="<?php if(isset($event_domain)){echo $event_domain;} ?>"><?php if(isset($event_domain)){echo $event_domain;} ?></option>
                <option value="Python">Python</option>
                <option value="Web Development">Web Development</option>
                <option value="App Development">App Development</option>
                <option value="Cyber Security">Cyber Security</option>
                <option value="Ethical Hacking">Ethical Hacking</option>

            </select>
            </div>

            <div class="col-sm-6 form-group">
                <label for="name-f">Current image</label>


                <img src="../../images/<?php if(isset($event_imagee)){echo $event_imagee;} ?>" alt="" class="img-responsive  " style="width:150px;height:100px" >

            </div>


            <div class="form-group col-sm-6">

              <label for="user-image">Event Image</label>

              <input type="file" name="image" value="" class="form-control" value="" name="image">

            </div>




              <div class="col-sm-12 form-group">
                  <label for="name-f">Event Caption</label>

                  <textarea class="form-control" name="submitted_edit_event_caption" rows="4" cols="50" required><?php if(isset($event_caption)){echo $event_caption;} ?></textarea>
              </div>


<input type="hidden" name="submitted_edit_event_id" value="<?php if(isset($event_id)){echo $event_id;} ?>">
<input type="hidden" name="submitted_exsisting_image" value="<?php if(isset($event_imagee)){echo $event_imagee;} ?>">


<div class="col-sm-12 form-group mb-0">
    <a href="view_all_events.php" class="btn btn-secondary"> Cancel</a>
   <button class="btn btn-primary float-right" name="submit_edited_event">Update Event</button>
</div>

        </div>
        </form>
    </div>




<?php


}




 ?>



<?php

if (isset($_POST["submit_edited_event"])) {



$edited_event_id                         =        escape($_POST["submitted_edit_event_id"]);
$edited_event_title                      =        escape($_POST["submitted_edit_event_title"]);
$edited_event_link                       =        escape($_POST["submitted_edit_event_link"]);
$edited_event_dealine                    =        escape($_POST["submitted_edit_event_deadline"]);
$edited_event_start_date                 =        escape($_POST["submitted_edit_event_start_date"]);
$edited_event_status                     =        escape($_POST["submitted_edit_event_status"]);
$edited_event_domain                     =        escape($_POST["submitted_edit_event_domain"]);
$edited_event_caption                    =        escape($_POST["submitted_edit_event_caption"]);
$edited_event_image                      =        $_FILES['image']['name'];
$edited_event_image_temp                 =        $_FILES['image']['tmp_name'];
$event_created_by                        =        $session_email;

$exsisting_event_image                  =        $_POST["submitted_exsisting_image"];
if (empty($edited_event_image)) {
$edited_event_image = $exsisting_event_image;
}

  move_uploaded_file($edited_event_image_temp,"../../images/$edited_event_image");



  $query_to_update_event =  "UPDATE events SET event_title = '{$edited_event_title}' , event_link ='{$edited_event_link} ' , event_deadline  = '{$edited_event_dealine}' , event_start_date = '{$edited_event_start_date}' , event_status = '{$edited_event_status}', event_domain = '{$edited_event_domain}',event_caption = '{$edited_event_caption}' " .
  ",event_image = '{$edited_event_image}',event_created_by = '{$event_created_by}' WHERE event_id = $edited_event_id";

  $updated_event = mysqli_query($connection,$query_to_update_event);
  if (!$updated_event) {
    die("update  post query failed".mysqli_error($connection));

  }else {
    ?><div class="alert alert-success"> <strong>Success!</strong> Event Updated Succesfully</div> <?php

  }

}


                   $total_completed_events_count =0;
                   $today = date("Y-m-d");
                   $total_upcoming_events_count =0;
                   $total_active_events =0;
                   $total_archived_events =0;
                   $total_deleted_events =0;


                $query = "SELECT * FROM events ORDER BY event_id DESC";
                $post_details = mysqli_query($connection,$query);
                if(!$post_details){
                die("query failed".mysqli_error($connection));
                }
                $total_events = mysqli_num_rows($post_details);

                $event_array=array();
                while ($row = mysqli_fetch_assoc($post_details)) {
                    $event_array[]=$row;
                    if($row["event_start_date"] > $today ){
                       $total_upcoming_events_count ++;

                    }
                    if($row["event_start_date"] < $today){
                      $total_completed_events_count ++;
                    }
                    if($row["event_status"] == 0){
                       $total_active_events++;
                    }
                    if($row["event_status"] == 1){
                       $total_archived_events++;
                    }
                    if($row["event_status"] == -1){
                       $total_deleted_events++;
                    }


                }

 ?>









<div class="row pb-5">




  <legend><h3 class="text-center pt-3">Quick  Overview</h3></legend>



  <!-- <div class="col-md-4">
    <p>Search by Event Name :</p>
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
    <p>Search by Event Registration Date :</p>
    <div class="input-group">
      <div class="form-outline">
        <input type="date" id="myInput2" onkeyup="myFunction()2"   class="form-control" >
      </div>
      <button id="search-button" type="button" class="btn btn-primary">
        <i class="fa fa-search"></i>
      </button>
    </div>
  </div> -->




<!--
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


  <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
          var data = new google.visualization.arrayToDataTable([
            ['Move', 'Count'],
            ["Total Events",<?php  if(isset($total_events)){echo $total_events;} ?>],
            ["Completed Events",<?php if (isset($total_completed_events_count)) { echo $total_completed_events_count;  } ?>],
            ["Upcoming events ",  <?php if (isset($total_upcoming_events_count)) { echo $total_upcoming_events_count;  } ?>],
            ["Published Events",<?php if (isset($total_active_events)) {echo $total_active_events;}  ?>],
            ["Archived Events",  <?php if (isset($total_archived_events)) {echo $total_archived_events;}  ?>],
            [" Deleted Events", <?php if (isset($total_deleted_events)) {echo $total_deleted_events;}  ?>]



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

          var chart = new google.charts.Bar(document.getElementById('nalysis_div'));
          // Convert the Classic options to Material options.
          chart.draw(data, google.charts.Bar.convertOptions(options));
        };
      </script>

      <div class="pt-5 col-md-12" id="nalysis_div" style="width:'auto'; height: 900px;"></div> -->

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
                                      <h5 class="pull-right"> Events</h5>
                                        <h5 class="pull-right"> Total - </h5>


                                    </div>
                                    <div class="col-12">
                                      <h6 class="pull-right mt-3">
                                          <?php if (isset($total_events)) {  echo $total_events; }
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
                                      <h5 class="pull-right"> Events</h5>
                                      <h5 class="pull-right"> Completed -</h5>
                                    </div>
                                    <div class="col-12">
                                      <h6 class="pull-right mt-3">
                                          <?php if (isset($total_completed_events_count)) {     echo $total_completed_events_count;  }  ?>
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
                                      <h5 class="pull-right">Events</h5>
                                      <h5 class="pull-right"> Upcoming - </h5>
                                    </div>
                                    <div class="col-12">
                                      <h6 class="pull-right mt-3">
                                          <?php if (isset($total_upcoming_events_count)) { echo $total_upcoming_events_count;  }    ?>
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
                                      <h5 class="pull-right">Events</h5>

                                      <h5 class="pull-right">Published - </h5>
                                    </div>
                                    <div class="col-12">
                                      <h6 class="pull-right mt-3">
                                          <?php if (isset($total_active_events)) {echo $total_active_events;}  ?>
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
                                      <h5 class="pull-right">Events</h5>
                                      <h5 class="pull-right"> Archived - </h5>
                                    </div>
                                    <div class="col-12">
                                      <h6 class="pull-right mt-3">
                                          <?php if (isset($total_archived_events)) {echo $total_archived_events;}  ?>
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
                                        <h5 class="pull-right">Events</h5>
                                        <h5 class="pull-right"> Deleted - </h5>
                                      </div>
                                      <div class="col-12">
                                        <h6 class="pull-right mt-3">
                                            <?php if (isset($total_deleted_events)) {echo $total_deleted_events;}  ?>
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


      <legend><h3 class="text-center pt-5">General Analysis</h3></legend>

        <script src="../../admin/assets/js/plugins/chartjs.min.js"></script>


        <div class="chart-container">
          <canvas id="bar-chartcanvas" style="height:75px;width:150px;"></canvas>

        </div>

      <script type="text/javascript">
        $(document).ready(function () {

        var ctx = $("#bar-chartcanvas");

        var data = {
          labels : ["Total Events ", "Completed Events ", "Upcoming events ", "Published Events " ,"Archived Events" ,"Deleted Events"],
          datasets : [

            {


              label : "Count",
              data : [<?php if(isset($total_events)){ echo $total_events;} ?>, <?php if(isset($total_completed_events_count)){ echo $total_completed_events_count;} ?>, <?php if(isset($total_upcoming_events_count)){ echo $total_upcoming_events_count;} ?>,
                 <?php if(isset($total_active_events)){ echo $total_active_events;} ?> , <?php if (isset($total_archived_events)) {echo $total_archived_events;}  ?> , <?php if (isset($total_deleted_events)) {echo $total_deleted_events;}  ?>],
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



<legend><h3 class="text-center pt-5">All Events</h3></legend>



            <table class="table  table-dark table-hover" id="events_table">
            	<thead class="thead-light">
            		<tr>
            			<th>S.No</th>
                  <th>Title</th>
                  <th>Image</th>
                  <th>Register By </th>
                  <th>Date of event</th>
                  <th>Caption</th>
                  <th>Status</th>
                  <th>Domain</th>
                  <th>Likes</th>

            			<th >Options</th>
<th >Options</th>
            		</tr>
            	</thead>
              <tbody>


                <?php
                   $i =1;

foreach ($event_array as $event ) {




                $event_id                =       $event["event_id"];
                $event_title             =       $event["event_title"];
                $event_image             =       $event["event_image"];
                $event_date              =       $event["event_date"];
                $event_deadline          =       $event["event_deadline"];
                $event_link              =       $event["event_link"];
                $event_start_date        =       $event["event_start_date"];
                $event_caption           =       $event["event_caption"];
                $event_status            =       $event["event_status"];
                $event_domain            =       $event["event_domain"];
                $event_interested_count  =       $event["event_interested_count"];






?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo ucfirst($event_title) ; ?></td>

<td> <img src="../../images/<?php echo $event_image ?>" alt="" class="img-responsive img-fluid" style="width:100px;height :50px;"> </td>
<!-- <td><?php echo  date(' d-m-y', strtotime($event_date)) ;?></td> -->
<td><?php echo date(' d-m-y', strtotime($event_deadline)) ; ?></td>
<!-- <td > <a target="_blank"  href="<?php echo $event_link; ?>" class="btn btn-primary"><i class="fa fa-hand-o-right" aria-hidden="true"></i></a> </td> -->
<td><?php echo date(' d-m-y', strtotime($event_start_date)) ; ?></td>
<td><?php echo $event_caption; ?></td>


<td><?php if (isset($event_status) ) {
if ( $event_status == 0) {
 ?>
 <form class="" action="" method="post">
   <input type="hidden" name="event_edit_id" value="<?php echo $event_id ?>">
   <input type="hidden" name="event_edit_status" value="<?php echo $event_status ?>">

<button  type="submit" name="button_status" class="btn btn-primary btn-sm">Active</button>
 </form> <?php
}elseif ( $event_status == -1) {
  ?><button type="button" name="button" class="btn btn-danger btn-sm">Deleted</button> <?php
}
else {
  ?>  <form class="" action="" method="post">
     <input type="hidden" name="event_edit_id" value="<?php echo $event_id ?>">
     <input type="hidden" name="event_edit_status" value="<?php echo $event_status ?>">

<button type="submit" name="button_status" class="btn btn-disabled btn-sm">Archive</button>
   </form> <?php
}
} ?></td>



<td><?php if (isset($event_domain)) { echo $event_domain; } ?></td>


<td> <?php if ($event_interested_count > 0) {
echo $event_interested_count;
}else {
  echo "0";
} ?>
</td>


<td>
  <form class="" action="" method="post">
  <input type="hidden" name="form_edit_event_id" value="<?php echo $event_id; ?>">
  <button type="submit" name="form_edit_event" class="btn btn-warning">  <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
  </form>
</td>

<td>

  <form class="" action="" method="post">
    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
    <button type="submit" name="delete_event" data-title="<?php echo $event_title; ?>"  data-id="<?php echo $event_id; ?>" class="btn btn-danger confirm-delete">  <i class="fa fa-trash-o" aria-hidden="true"></i></button>
  </form>
</td>


</tr>

<?php
              $i++; }
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
      <input type="hidden" id="post_id" name="delete_event_id" value="">
      <button type="submit" name="delete_event" class="btn btn-danger">Delete</button>
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
    var title =$(this).data('title');
    var modal_text= "Do you really want to delete "+title+" event?";
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
     $('#events_table').DataTable();
});
// $('#events_table').DataTable( {
//     responsive: true
// } );
</script>
<?php
  }else{
      echo " You are not authorized to visit the page";
  }
}else {
  echo "Please go back to login page and return back";
}


 ?>
