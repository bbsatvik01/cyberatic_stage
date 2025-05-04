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

  if(isset($session_role) &&  $session_role >= 1 ){




 ?>

<?php include "navigation.php"; ?>


<?php


$users_count_query = "SELECT * FROM users";
$total_users = mysqli_query($connection,$users_count_query);
if (!$total_users) {
die("Users total count query failed".mysqli_error($connection));
}else {
  $total_users_count = mysqli_num_rows($total_users);
}





 ?>


 <?php
 $posts_count_query = "SELECT * FROM posts";
 $total_posts = mysqli_query($connection,$posts_count_query);
 if (!$total_posts) {
 die("Users total count query failed".mysqli_error($connection));
 }else {
   $total_posts_count = mysqli_num_rows($total_posts);
 }



  ?>




  <?php
  $internships_count_query = "SELECT * FROM internships";
  $total_internships = mysqli_query($connection,$internships_count_query);
  if (!$total_internships) {
  die("Users total count query failed".mysqli_error($connection));
  }else {
    $total_internships_count = mysqli_num_rows($total_internships);
  }



   ?>





  <?php
  $total_completed_events_count =0;
  $today = date("Y-m-d");
  $total_upcoming_events_count =0;
  $events_count_query = "SELECT event_start_date FROM events";
  $total_events = mysqli_query($connection,$events_count_query);
  if (!$total_events) {
  die("Users total count query failed".mysqli_error($connection));
  }else {
    $total_events_count = mysqli_num_rows($total_events);
    // while ($row = mysqli_fetch_assoc($total_events)) {
    //   if($row["event_start_date"] > $today ){
    //      $total_completed_events_count ++;
    //
    //   }
    //
    //   if($row["event_start_date"] < $today){
    //     $total_upcoming_events_count ++;
    //   }
    // }
  }



   ?>


   <?php
$today = date("Y-m-d");
$today_notifications_count =0;
$upcoming_notifications_count =0;
   $query = "SELECT notification_date FROM notifications";
   $notification_details = mysqli_query($connection,$query);
   if(!$notification_details){
   die("query failed".mysqli_error($connection));
 }else {
   $total_notifications_count = mysqli_num_rows($notification_details);

   //    while ($row = mysqli_fetch_assoc($notification_details)) {
   //
   // if(  $row["notification_date"]  ==  $today){
   // $today_notifications_count++;
   // }
   // if( $row["notification_date"]  <  $today ){
   //
   // $upcoming_notifications_count++;
   //
   // }
   //
   //
   // }
 }

    ?>



    <?php


    $today = date("Y-m-d");

       $query = "SELECT test_id FROM tests";
       $test_details = mysqli_query($connection,$query);
       if(!$test_details){
       die("query failed".mysqli_error($connection));
     }else {
       $total_tests_count = mysqli_num_rows($test_details);


     }


     ?>




<h1>Welcome <?php  ?></h1>

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
                                <h5 class="pull-right"> Users</h5>
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
                 <a href="view_all_users.php">
                     <div class="card-footer">
                         <span class="pull-left">View Details</span>
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
                                <h5 class="pull-right">Posts</h5>
                                <h5 class="pull-right"> Total -</h5>
                              </div>
                              <div class="col-12">
                                <h6 class="pull-right mt-3">
                                    <?php if (isset($total_posts_count)) {     echo $total_posts_count;  }  ?>
                                </h6>
                              </div>
                            </div>
                         </div>
                     </div>
                 </div>
                 <a href="view_all_posts.php">
                     <div class="card-footer">
                         <span class="pull-left">View Details</span>
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
                                <h5 class="pull-right">Events</h5>
                                <h5 class="pull-right"> Total - </h5>
                              </div>
                              <div class="col-12">
                                <h6 class="pull-right mt-3">
                                    <?php if (isset($total_events_count)) { echo $total_events_count;  }    ?>
                                </h6>
                              </div>
                            </div>
                         </div>
                     </div>
                 </div>
                 <a href="view_all_events.php">
                     <div class="card-footer">
                         <span class="pull-left">View Details</span>
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

                                <h5 class="pull-right">Total - </h5>
                              </div>
                              <div class="col-12">
                                <h6 class="pull-right mt-3">
                                    <?php if (isset($total_notifications_count)) {echo $total_notifications_count;}  ?>
                                </h6>
                              </div>
                            </div>
                         </div>
                     </div>
                 </div>
                 <a href="view_all_notifications.php">
                     <div class="card-footer">
                         <span class="pull-left">View Details</span>
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
                                <h5 class="pull-right">Tests</h5>
                                <h5 class="pull-right"> Total - </h5>
                              </div>
                              <div class="col-12">
                                <h6 class="pull-right mt-3">
                                    <?php if (isset($total_tests_count)) {echo $total_tests_count;}  ?>
                                </h6>
                              </div>
                            </div>
                         </div>
                     </div>
                 </div>
                 <a href="view_all_tests.php">
                     <div class="card-footer">
                         <span class="pull-left">View Details</span>
                         <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                         <div class="clearfix"></div>
                     </div>
                 </a>
             </div>
            </div>


            <div class="col-6 col-md-4 mt-3">
               <div class="card">
                   <div class="card-body bg-primary">
                       <div class="row">
                           <div class="col-3">
                            <i class="fa fa-hourglass-o fa-5x" aria-hidden="true"></i>
                           </div>
                           <div class="col-9">
                              <div class="row">
                                <div class="col-12">
                                  <h5 class="pull-right">internships</h5>
                                  <h5 class="pull-right"> Total - </h5>
                                </div>
                                <div class="col-12">
                                  <h6 class="pull-right mt-3">
                                      <?php if (isset($total_internships_count)) {echo $total_internships_count;}  ?>
                                  </h6>
                                </div>
                              </div>
                           </div>
                       </div>
                   </div>
                   <a href="view_all_tests.php">
                       <div class="card-footer">
                           <span class="pull-left">View Details</span>
                           <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                           <div class="clearfix"></div>
                       </div>
                   </a>
               </div>
              </div>



       </div>
</div>



<!--

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


  <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
          var data = new google.visualization.arrayToDataTable([
            ['Move', 'Count'],
            ["Total Users",<?php   echo $total_users_count; ?>],
            ["Total Projects",<?php if (isset($total_posts_count)) { echo $total_posts_count;  } ?>],
            ["Total events ",  <?php if (isset($total_events_count)) { echo $total_events_count;  } ?>],
            ["Total Notifications",<?php if (isset($total_notifications_count)) {echo $total_notifications_count;}  ?>],
            ["Total Tests",  <?php if (isset($total_tests_count)) {echo $total_tests_count;}  ?>],
            ["Total Internships", 5]



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

      <div class="pt-5 col-md-12" id="top_x_div" style="width:'auto'; height: 500px;"></div> -->







            <legend><h3 class="text-center pt-5">General Analysis</h3></legend>

              <script src="../../admin/assets/js/plugins/chartjs.min.js"></script>


              <div class="chart-container">
                <canvas id="bar-chartcanvas" style="height:75px;width:150px;"></canvas>

              </div>

            <script type="text/javascript">
              $(document).ready(function () {

              var ctx = $("#bar-chartcanvas");

              var data = {
                labels : ["Total Users", "Total Projects", "Total events", "Total Notifications" ,"Total Tests" ,"Total Internships"],
                datasets : [

                  {


                    label : "Count",
                    data : [<?php if(isset($total_users_count)){ echo $total_users_count;} ?>, <?php if(isset($total_posts_count)){ echo $total_posts_count;} ?>, <?php if(isset($total_events_count)){ echo $total_events_count;} ?>,
                       <?php if(isset($total_notifications_count)){ echo $total_notifications_count;} ?> , <?php if (isset($total_tests_count)) {echo $total_tests_count;}  ?>
                       , <?php if (isset($total_internships_count)) {echo $total_internships_count;}  ?>],
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

















<?php
  }
}else {
  echo "Please go back to login page and return back";
  // if(empty($_SESSION["user_role"])){
  //   echo "string";
  // }

}


 ?>
