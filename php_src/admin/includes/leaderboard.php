<?php include "admin_header.php" ?>
<?php include "functions.php" ?>
<?php include "db.php" ?>

<?php
$tests_array = array();
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
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../images/logo.png">
  <title>
CYBERATIC RVITM - Leaderboard
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


.focus {
  background-color: #ff00ff;
  color: #fff;
  cursor: pointer;
  font-weight: bold;
}
.selected {
  background-color: #ff00ff;
  color: #fff;
 font-weight: bold;
}
.asc:after {  content: "\25B2"; }
.desc:after { content: "\25BC"; }


table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
td,th {
 border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
tr:nth-child(even) {
Â  background-color: #dddddd;
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
   

    <li class="">
      <a href="tests">
        <i class="tim-icons icon-puzzle-10"></i>
        <p> Tests</p>
      </a>
    </li>

    <li class="active ">
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
          <a class="navbar-brand" href="javascript:void(0)">LeaderBoard</a>
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
            <div class="card card-plain">
              <div class="card-header">

              </div>
              <div class="card-body">


               <legend><h1 class="text-center text-primary pb-3">LeaderBoard</h1></legend>


                <ul class="nav nav-pills navtab-bg pt-5 pb-5">
                  <?php


                  $query2 = "SELECT user_score , user_email , user_semester FROM users  ";
                  $all_users_details = mysqli_query($connection,$query2);
                  if(!$all_users_details){
                  die("all_test_query failed".mysqli_error($connection));
                  }else {
                  while ($row2 = mysqli_fetch_assoc($all_users_details)) {


                  $users_score[] = array(


                     'user_score'        =>     $row2["user_score"],
                     'user_email'        =>     $row2["user_email"],
                     'user_semester'     =>     $row2["user_semester"]



                  );



                  }

}



                  $i =0;
    $query = "SELECT * FROM score  ";
    $all_test_details = mysqli_query($connection,$query);
    if(!$all_test_details){
    die("all_test_query failed".mysqli_error($connection));
    }else {
    while ($row = mysqli_fetch_assoc($all_test_details)) {


    $tests_array['all_test_details'][] = array(

       'score_test_name'         =>     $row["score_test_name"],
       'score_test_marks'        =>     $row["score_test_marks"],
       'score_user_email'        =>     $row["score_user_email"]


    );



    }







    $test_name_array = array();
    if(count($tests_array) > 0){
        
    
    $k = 0;
    for ($i=0; $i < count($tests_array['all_test_details'])  ; $i++) {
      $x = $i;
    $k = $i+1;
      $test_name_array[$i] = $tests_array['all_test_details'][(string)$i]['score_test_name'];
      if ($k < count($tests_array['all_test_details'])) {
        if($tests_array['all_test_details'][(string)$i+1]['score_test_name'] == $tests_array['all_test_details'][(string)$i]['score_test_name'] ){

          $scores_emails[$tests_array['all_test_details'][(string)$i]['score_test_name']][$i] = array(


             'score_test_marks'        =>     $tests_array['all_test_details'][(string)$x]['score_test_marks'],
             'score_user_email'        =>    $tests_array['all_test_details'][(string)$x]['score_user_email']


          );
        }else {
          $scores_emails[$tests_array['all_test_details'][(string)$i]['score_test_name']][$i] = array(


             'score_test_marks'        =>     $tests_array['all_test_details'][(string)$x]['score_test_marks'],
             'score_user_email'        =>    $tests_array['all_test_details'][(string)$x]['score_user_email']


          );
        }


      }else {
        $scores_emails[$tests_array['all_test_details'][(string)$i]['score_test_name']][$i] = array(


           'score_test_marks'        =>     $tests_array['all_test_details'][(string)$x]['score_test_marks'],
           'score_user_email'        =>    $tests_array['all_test_details'][(string)$x]['score_user_email']


        );
      }

    }

}





    $unique_tests_array = array_unique($test_name_array);
    $unique_tests_array = array_values($unique_tests_array);
    $unique_tests_array = array_reverse($unique_tests_array);



    function sortByAge($a, $b) {
    return $a['score_test_marks'] < $b['score_test_marks'];
}

for ($i=0; $i <count($unique_tests_array)   ; $i++) {
usort($scores_emails[$unique_tests_array[$i]], 'sortByAge');
}



function sortByScore($a, $b) {
return $a['user_score'] < $b['user_score'];
}

for ($i=0; $i <count($users_score)   ; $i++) {
usort($users_score, 'sortByScore');
}





    }


       ?>


                      <?php for ($i=0; $i < count($unique_tests_array); $i++) {
$test_name_replaced_with_underscore = str_replace(' ', '_', $unique_tests_array[$i]);
                           ?>
                           <li class="nav-item">

                               <a href="#<?php    echo $test_name_replaced_with_underscore; ?>" class="to_get_test_name btn btn-primary mr-3" data-toggle="tab"
                                 aria-expanded="true" class="nav-link ml-0 active" data-test_name = <?php  echo $test_name_replaced_with_underscore; ?>>
                                   <i class="mdi mdi-face-profile mr-1"></i><?php echo $unique_tests_array[$i]; ?>
                               </a>
                           </li>

                           <?php
                      } ?>





                </ul>

                <div class="">

                    <div class="" id="about-me">





                        <h5 class=""><i class="1"></i>
                            </h5>
                        <div class="">
                           <h1 class="text-center text-primary pb-3 pt-3">  <b id="test_name"> </b> LEADERBOARD </h1>
                            <table id="myTable" class="table  table-borderless  table-hover pt-5 Muted Text" id="leaderboard_main_table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>User Email</th>
                                        <th>Score </th>
                                        <th>view user</th>

                                    </tr>
                                </thead>
                                <tbody id="leaderboard_table">



                                </tbody>
                            </table>
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

  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>



  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script>
  <script src="../assets/demo/demo.js"></script>
  <script type="text/javascript">





  var sorted_array = new Array();
  sorted_array = <?php echo json_encode($scores_emails); ?>;

var users_array = new Array();
users_array = <?php echo json_encode($users_score); ?>;


var test_name = "general_leaderboard";


  $('.to_get_test_name').on('click', function(){


    var count =0;
    document.getElementById("leaderboard_table").innerHTML = "";
     test_name = $(this).data('test_name');
     test_name =  test_name.replace(/_/g, ' ');
    
     
     document.getElementById("test_name").innerHTML = test_name.toUpperCase();


    if(test_name!="general_leaderboard"){
var first_to_third =1;
var row_color_for_top_3 = "";
    for (var j = 0; j < sorted_array[test_name].length; j++)
    {



         var email =   sorted_array[test_name][j]['score_user_email'];
         var view_profile  = email.split("_")[0];

         
         
         
           for (var user_count = 0; user_count < users_array.length; user_count++) {
          if(users_array[user_count]['user_email'] == email )  {
            var user_semester = users_array[user_count]['user_semester'];
        }
      }
   

          count++;

          if(first_to_third == 1){row_color_for_top_3 = 'text-success'}
          else if(first_to_third == 2){row_color_for_top_3 = 'text-info'}
          else  if(first_to_third == 3){row_color_for_top_3 = 'text-danger'}
          else {  row_color_for_top_3 = ''    }


            document.getElementById("leaderboard_table").innerHTML +=
              "<tr >" +
              "<td>" +
                count+
              "</td>" +
              "<td >" +
              sorted_array[test_name][j]['score_user_email']+
              "</td>" +
              "<td >" +
            sorted_array[test_name][j]['score_test_marks']+
              "</td>" +
              "<td >" +
            '<span > <a target="_blank" href="../../profile.php/'+  view_profile  + user_semester + ' " class=" btn btn-disabled btn-sm  view_profile ">View Profile  </a> </span>'+
              "</td>" +

              "</tr>";




    first_to_third++;
  }

}

  });


  if(test_name == "general_leaderboard") {
      var heading = "Overall";
      document.getElementById("test_name").innerHTML = heading.toUpperCase();
  var count =0;
  var row_color_for_top_3_default ="";
  var first_to_third_default =1;
    for (var j = 0; j < users_array.length; j++)
    {
        if(first_to_third_default == 1){row_color_for_top_3_default = 'text-success'}
          else if(first_to_third_default == 2){row_color_for_top_3_default = 'text-info'}
          else  if(first_to_third_default == 3){row_color_for_top_3_default = 'text-danger'}
          else {  row_color_for_top_3_default = ''    }

         var email =   users_array[j]['user_email'];
         var  view_profile  = email.split("_")[0];
        var user_semester = users_array[j]['user_semester'];


          count++;
             document.getElementById("leaderboard_table").innerHTML +=
               "<tr>" +
               "<td >" +
                 count+
               "</td>" +
               "<td >" +
               users_array[j]['user_email']+
               "</td>" +
               "<td id='scores' >" +
             users_array[j]['user_score']+
               "</td>" +
               "<td>" +
            '<span > <a target="_blank" href="../../profile.php/'+  view_profile  + user_semester + ' " class=" btn btn-disabled btn-sm  view_profile ">View Profile  </a> </span>'+
               "</td>" +

               "</tr>";
    first_to_third_default++;
  }



  }


  </script>
  <script>
  
  
    if($(window).width() < 767)
  {
     
  $('#myTable').addClass('table-responsive');
 
  }
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
