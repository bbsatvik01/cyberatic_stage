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
$user_id = $session_user_id;
if(isset($_POST['interested'])){

  $event_id = $_POST['event_id'];
  $result = mysqli_query($connection,"SELECT event_interested_count FROM events WHERE event_id=$event_id");
  $row = mysqli_fetch_array($result);
  $n = $row['event_interested_count'];

  mysqli_query($connection,"INSERT INTO interested (interested_user_id, interested_event_id) VALUES ($user_id, $event_id)");
  mysqli_query($connection,"UPDATE events SET event_interested_count=$n+1 WHERE event_id=$event_id");

  echo   $n+1;
  exit();
}

 	if (isset($_POST['uninterested'])) {
 		$event_id = $_POST['event_id'];
 		$result = mysqli_query($connection, "SELECT event_interested_count FROM events WHERE event_id=$event_id");
 		$row = mysqli_fetch_array($result);
 		$n = $row['event_interested_count'];

 		mysqli_query($connection, "DELETE FROM interested WHERE interested_event_id=$event_id AND interested_user_id=$user_id");
 		mysqli_query($connection, "UPDATE events SET event_interested_count=$n-1 WHERE event_id=$event_id");

 		echo $n-1;
 		exit();
 	}

$query = "SELECT * FROM events WHERE event_status = 0  ORDER BY event_start_date DESC" ;
$event_details = mysqli_query($connection,$query);
if(!$event_details){
die("query failed".mysqli_error($connection));
}else {
$record = array();
while ($row = mysqli_fetch_assoc($event_details)) {
 $record[] = $row;





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
CYBERATIC RVITM - Events
  </title>
  <!--     Fonts and icons     -->




  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

 
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
 
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />

  <link href="../assets/demo/demo.css" rel="stylesheet" />

  <link rel="stylesheet" href="../css/events.css">

  <style media="screen">
  ::-webkit-scrollbar {
  display: none;
  }
  body{
    margin-top: 0px;
  }
  .timeline-row .timeline-content i {
    font-size: inherit;
    line-height: 100%;
    padding: 0px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: inherit;
    background: none;
    margin-bottom: 0px;
    display: inline-block;
}
hr.style3 {
	border-top: 1px dashed #8c8b8b;
}
.event_on_date{
  font-size:1.5rem;
  padding-left:5px;
}
.btn-sm, .btn-group-sm>.btn {
    font-size: 0.875rem;
    border-radius: 0.2857rem;
    padding: 5px 15px;
    bottom: 9px;
}

@media (max-width:700px){



  /* .btn-sm {
    font-size: 0.45rem;
    margin-left: 0px;
    border-radius: 0.2857rem;
    line-height: 0.55;
} */

.btn-sm {
    font-size: 0.5rem;
    margin-left: 0px;
    border-radius: 0.2857rem;
    line-height: 0.55;
    left: 23px;

    bottom: 7px;
}


.timeline-row .timeline-content p {
    margin-bottom: 30px;
    font-size: 0.6rem;
    line-height: 150%;
}
.event_on_date {
    font-size: 0.9rem;
    padding-left: 5px;
}

.btn-block {
    display: block;
    width: 100%;
    width: 120%;
    right: 15px;
    line-height: 75%;

    bottom: 20px;
}

.timeline-row .timeline-time small {
    display: block;
    font-size: 0.5rem;
}
.timeline .timeline-row .timeline-time {
    position: relative;
    top: 0;
    left: 0;
    margin: 0 0 10px 0;
    font-size: 0.9rem;
}
.last_date_span{
  left: 30px;
}

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
        <li class="active ">
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
              <a class="navbar-brand" href="javascript:void(0)">Events</a>
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
           <legend><h1 class="text-center text-primary pt-3">Events</h1></legend>



            <div class="card card-plain">
              <div class="card-header">

              </div>
              <div class="card-body">


                <div class="container">
                <div class="timeline">

                     <?php foreach($record as $rec){?>
                		<div class="timeline-row">
                			<div class="timeline-time">
                			<?php

                  echo date('h:i a ', strtotime($rec['event_date']));
                   ?><small><?php  echo date(' d F Y', strtotime($rec['event_date'])) ?></small>
                			</div>
                			<div class="timeline-content">
                        <a><img class="img-fluid z-depth-1" data-image="../../images/<?php echo $rec['event_image'] ?>"  src="../../images/<?php echo $rec['event_image'] ?>"alt=""
                            data-toggle="modal" data-target="#modal1"></a>
                				<h4 class="pb-0 mb-0"><?php echo strtoupper($rec['event_title']) ?></h4>


                <div class="pull-right pt-0 mt-0">
            <p class="pull-right text-primary"><span class=" fa fa-thumbs-up">
            </span>   <span class="interested_count stats-total" data-id="<?php echo $rec['event_id'] ?>" data-interested_count="<?php echo $rec['event_interested_count']?>" data-interested="<?php echo $rec['event_id'] ?>" >
              <?php echo $rec['event_interested_count']; ?>
           </span></p>



                </div>
                <div class="pt-3">
                  <p class="pull-left"><?php echo $rec['event_caption'] ?> </p>

                </div>


                        <!-- <div class=" col-md-12 pb-3">

                          <span class="pull-left ">Event On <i class="fa fa-calendar " aria-hidden="true" style="font-size:1.2rem;">   :  </i>

                            <span class="">
                            <?php
                                                $timestamp = strtotime($rec['event_start_date']);
                                               
                                                $rec['event_start_date'] = date("d-m-Y", $timestamp);
                                              
                                                ?> <?php echo $rec['event_start_date'] ?></span>
                                              </span>
                        </div> -->
                        <div class="pt-2">
                          <div class="pull-left">
                            <p class="pull-left">  Event On  <strong>  <span class="text-primary event_on_date" style="">    <?php  echo " ". "  ". date(' d-m-y', strtotime($rec['event_start_date']));  ?> </span></strong> </p>

                          </div>


                      <div class="thumbs pull-right pt-0">
                        <?php
                        $interested_event_id=$rec['event_id'];
                          $query1="SELECT * FROM interested WHERE interested_user_id=$user_id AND interested_event_id=$interested_event_id ";
                          $results = mysqli_query($connection,$query1);
                          $results1 =mysqli_fetch_assoc($results);

                        if(!$results1): ?>

                      <div class=""  >

                        <button type="submit" class=" going btn btn-primary pull-right btn-sm" data-toggle="yes" data-interested_count="<?php echo $rec['event_interested_count']?>"  data-id="<?php echo $rec['event_id'] ?>">Interested</button>
                        <button style="display:none"  type=" submit" class="notgoing  btn btn-primary pull-right btn-sm" data-interested_count="<?php echo $rec['event_interested_count']?>" data-id="<?php echo $rec['event_id'] ?>">Not Interested</button>

                      </div>
                      <?php else:  ?>
                      <div class="" >

                        <button  type="submit" data-toggle="yes" class="notgoing btn btn-primary pull-right btn-sm" data-interested_count="<?php echo $rec['event_interested_count']?>"  data-id="<?php echo $rec['event_id'] ?>">Not Interested</button>
                        <button style="display:none"  type="submit" class="going btn btn-primary pull-right btn-sm" data-interested_count="<?php echo $rec['event_interested_count']?>" data-id="<?php echo $rec['event_id'] ?>">Interested</button>


                      </div>

                      <?php endif ?>

                      </div>
                        </div>

<hr class="style3">

                        <div class="col-md-12 ">


                            <p>  <a target="_blank" href="<?php echo $rec['event_link']?>" type="submit"  class=" pull-left  btn btn-success btn-block" data-interested_count="<?php echo $rec['event_interested_count']?>"  data-id="<?php echo $rec['event_id'] ?>">Register Now!!!!</a>
                              <span class="pull-right last_date_span"> - > <span class="pull-right text-primary"> Last Date <?php  echo " ". date(' d-m-y', strtotime($rec['event_deadline']));  ?> </span> </span>   </p>

                        </div>


                				<!-- <div class="thumbs">
                          <?php ;
                          $interested_event_id=$rec['event_id'];
                            $query1="SELECT * FROM interested WHERE interested_user_id=$user_id AND interested_event_id=$interested_event_id ";
                            $results = mysqli_query($connection,$query1);
                            $results1 =mysqli_fetch_assoc($results);

                          if(!$results1): ?>

                        <div class=""  >

                          <button type="submit" class=" going btn btn-warning pull-right" data-toggle="yes" data-interested_count="<?php echo $rec['event_interested_count']?>"  data-id="<?php echo $rec['event_id'] ?>">going</button>
                          <button style="display:none"  type=" submit" class="notgoing  btn btn-warning pull-right" data-interested_count="<?php echo $rec['event_interested_count']?>" data-id="<?php echo $rec['event_id'] ?>">not going</button>

                        </div>
                      <?php else:  ?>
                        <div class="" >

                          <button  type="submit" data-toggle="yes" class="notgoing btn btn-warning pull-right" data-interested_count="<?php echo $rec['event_interested_count']?>"  data-id="<?php echo $rec['event_id'] ?>">not going</button>
                          <button style="display:none"  type="submit" class="going btn btn-warning pull-right" data-interested_count="<?php echo $rec['event_interested_count']?>" data-id="<?php echo $rec['event_id'] ?>">going</button>


                        </div>

                        <?php endif ?>

                				</div> -->


                			</div>
                		</div>




                  <?php } ?>
                  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">

                      <!--Content-->
                      <div class="modal-content">

                        <!--Body-->
                        <div class="modal-body mb-0 p-0">

                          <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">

                              <img class="embed-responsive-item" src=""
                                  >
                          </div>

                        </div>

                        <!--Footer-->


                      </div>
                      <!--/.Content-->

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



  <script src="../assets/js/plugins/bootstrap-notify.js"></script>

  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script>
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {




      $('img').on('click', function(){
        var source = $(this).data('image');
        $('.embed-responsive-item').attr("src", source);

      }

      )
        $('.going').on('click', function(){
          var eventid = $(this).data('id');
          var interests = $(this).data('interested_count');
          var toggle = $(this).data('toggle');

              $post = $(this);
         

          $.ajax({
            url: 'events',
            type: 'post',
            data: {
              'interested': 1,
              'event_id': eventid
            },
            success: function(response){
      
             $('[data-id='+eventid+']').filter('.going').css('display', 'none');
             $('[data-id='+eventid+']').filter('.notgoing').css('display', 'inline');

             if(toggle=="yes"){
             
               $('[data-id='+eventid+']').filter('.interested_count').text(interests+1);
               }
               else{
                 $('[data-id='+eventid+']').filter('.interested_count').text(interests);
             }



            }
          });
        });

        // when the user clicks on unlike
        $('.notgoing').on('click', function(){
          var eventid = $(this).data('id');
          var interests = $(this).data('interested_count');
          var toggle = $(this).data('toggle');


            $post = $(this);
        

          $.ajax({
            url: 'events',
            type: 'post',
            data: {
              'uninterested': 1,
              'event_id': eventid
              },
            success: function(response){
              $('[data-id='+eventid+']').filter('.notgoing').css('display', 'none');
              $('[data-id='+eventid+']').filter('.going').css('display', 'inline');
                if(toggle=="yes"){

                  $('[data-id='+eventid+']').filter('.interested_count').text(interests-1);
                  }
                  else{
                    $('[data-id='+eventid+']').filter('.interested_count').text(interests);
                }


            }
          });
        });












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
<?php }else {
  echo "Please go back to login page and return back";
} ?>
