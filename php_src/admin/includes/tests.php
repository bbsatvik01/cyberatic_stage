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






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../images/logo.png">
  <link rel="icon" type="image/png" href="../../images/logo.png">
  <title>
CYBERATIC RVITM - Tests
  </title>
  <style media="screen">


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
</style>
  
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

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
   

    <li class="active ">
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
          <a class="navbar-brand" href="javascript:void(0)">Your tests</a>
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
<?php
$user_email_id      =    $session_email;
$query = "SELECT * FROM score WHERE score_user_email = '$user_email_id' ";
$score_details = mysqli_query($connection,$query);
if(!$score_details){
 die("query failed ,yeah".mysqli_error($connection));
}else {

  $record3 = array();
while ($row = mysqli_fetch_assoc($score_details)) {
  $record3[] = $row;
}
}

 ?>


      <!-- End Navbar -->
      <div class="content">
        <div class="row">
             <legend><h1 class="text-center text-primary pt-3">Your Scores</h1></legend>


   
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">

              </div>
              <div class="card-body">


                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-plain">
                      <div class="card-header">
                      Growth Analysis
                      </div>
                      <div class="card-body">
                        <div class="col-md-12">

                          <canvas id="lineChart"></canvas>
                          <font face="Roboto, sans-serif"><span style="font-size: 16px; white-space: normal;">
                          </span></font>
                        </div>

                         <script src="../assets/js/core/jquery.min.js"></script>

                        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
                        <script type="text/javascript">
                        var scores = new Array();
                        var only_test = new Array();
                        var tests = new Array();
                        var j =0;
                        tests = <?php echo json_encode($record3); ?>;
                    
                        for (var i = 0; i < tests.length; i++) {
                        only_test[j] = tests[i]["score_test_name"] ;
                        scores [j]    =tests[i]["score_test_marks"];
                        j++;
                        }
                        

                          var ctxL = document.getElementById("lineChart").getContext('2d');

                            var gradientFill = ctxL.createLinearGradient(0, 0, 0, 290);

                            gradientFill.addColorStop(0, "rgba(173, 53, 186, 1)");

                            gradientFill.addColorStop(1, "rgba(173, 53, 186, 0.1)");

                            var myLineChart = new Chart(ctxL, {

                              type: 'line',

                              data: {

                                labels: only_test,

                                datasets: [

                                  {

                                    label: "Your Score",

                                    data: scores ,

                                    backgroundColor: gradientFill,

                                    borderColor: [

                                      '#AD35BA',

                                    ],

                                    borderWidth: 2,

                                    pointBorderColor: "#fff",

                                    pointBackgroundColor: "rgba(173, 53, 186, 0.1)",

                                  }

                                ]

                              },

                              options: {

                                responsive: true,
                                scales: {
                                  y: {
                                      max: 10,
                                      min: 0,
                                      ticks: {
                                          stepSize: 1
                                      }
                                  }
                              }

                              }
                              

                            });

                        </script>
                     
                      </div>
                    </div>
                  </div>
                </div>





                <h3 class="text-center">Test Details</h3>












                <div class="panel-group" id="accordionGroupOpen" role="tablist" aria-multiselectable="true">



          <?php




                             if(!$score_details){
                              die("query failed ,yeah".mysqli_error($connection));
                            }else {


                      $query2="SELECT * FROM tests";
                      $test_details = mysqli_query($connection,$query2);
                      if(!$test_details){
                      die("query failed ,yeah".mysqli_error($connection));
                      }else {
                      $record = array();
                      while ($row = mysqli_fetch_assoc($test_details)) {

                     $record[] = $row;
                   }
                      $i=1;
                  foreach ($record3 as $rec3) {





                    $score_test_name           =     $rec3["score_test_name"];
                    $score_test_marks          =     $rec3["score_test_marks"];

                    ?><div class="panel panel-default card">
                                      <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                          <a role="button" class="collapse" aria-expanded="false" data-toggle="collapse" data-parent="#accordionGroupOpen" href="#collapseOpen<?php echo $i; ?>"  aria-controls="collapseOpenOne">
                                          <?php echo $score_test_name; ?>
                                          </a>
                                        </h4>
                                      </div>
                                      <div id="collapseOpen<?php echo $i; ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body mr-3">
                                          <p class="pl-3 pb-3">Test Marks :  <span class="text-primary h3"><?php if(!isset($score_test_marks)){echo 0;} echo $score_test_marks; ?></span>
                                             <span class="pull-right">
                                            <?php foreach ($record as $rec) { if($rec['test_name']==$score_test_name){
                                        ?>   <a target="_blank" class="ml-3 mb-3 btn btn-sm " href="../../file-upload-download/uploads/<?php echo $rec['test_file']; ?>">View Soluton</a>

                                      <?php    } } ?>
                                    </span>  </p>

                                          <div style="height:50%" class="progress ml-3 mb-3">
                                            <div class="progress-bar" style="width:<?php echo $score_test_marks/10*100 ?>%"><?php echo $score_test_marks/10*100 ?>%</div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                    <?php $i+=1; }


                  }}?>



                </div>

                <hr>





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


  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>


  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script>
  <script src="../assets/demo/demo.js"></script>
  <script>
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
