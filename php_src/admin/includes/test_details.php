<?php include "admin_header.php" ?>
<?php include "functions.php" ?>
<?php include "db.php" ?>


<?php

if(isset($_SESSION["after_registration_test"])){
  


 ?>


<?php


if(isset($_GET["page"])){
  $page = $_GET["page"];
}else {
  $page ="";
}
if($page == "" || $page == 1){
  $page_1 = 0;
}else {
  $page_1 =($page*15) - 15;
}


// $user_idd = $session_user_id;


if(isset($_POST['liked'])){

  $post_id = $_POST['post_id'];
  $result = mysqli_query($connection,"SELECT post_like_count FROM posts WHERE post_id=$post_id");
  $row = mysqli_fetch_array($result);
  $n = $row['post_like_count'];

  mysqli_query($connection,"INSERT INTO likes (likes_user_id, likes_post_id) VALUES ($user_idd, $post_id)");
  mysqli_query($connection,"UPDATE posts SET post_like_count=$n+1 WHERE post_id=$post_id");

  echo   $n+1;
  exit();
}

 	if (isset($_POST['unliked'])) {
 		$post_id = $_POST['post_id'];
 		$result = mysqli_query($connection, "SELECT post_like_count FROM posts WHERE post_id=$post_id");
 		$row = mysqli_fetch_array($result);
 		$n = $row['post_like_count'];

 		mysqli_query($connection, "DELETE FROM likes WHERE likes_post_id=$post_id AND likes_user_id=$user_idd");
 		mysqli_query($connection, "UPDATE posts SET post_like_count=$n-1 WHERE post_id=$post_id");

 		echo $n-1;
 		exit();
 	}




$query = "SELECT * FROM posts WHERE post_status=1   ORDER BY post_date DESC LIMIT $page_1,15" ;
$post_details = mysqli_query($connection,$query);
if(!$post_details){
die("query failed".mysqli_error($connection));
}else {
$record = array();
$total_posts_count =mysqli_num_rows($post_details);
while ($row = mysqli_fetch_assoc($post_details)) {
 $record[] = $row;
$total_posts_count++;
// $post_id               =     $row["post_id"];
// $post_title            =     $row["post_title"];
// $post_user_email       =     $row["post_user_email"];
// $post_date             =     $row["post_date"];
// $post_link             =     $row["post_link"];
// $project_start_date     =     $row["project_start_date"];
// $project_end_date       =     $row["project_end_date"];
// $post_image            =     $row["post_image"];



}

$count = ceil($total_posts_count/10);

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
Coding Club Rvitm
  </title>

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
    <!-- <link rel="stylesheet" href="../css/timeline.css"> -->
      <link rel="stylesheet" href="../css/new_timeline.css">
  <link href="../assets/demo/demo.css" rel="stylesheet" />


    <style media="screen">
*{
  padding: 0;
  margin: 0;
}
.content{
  padding-left: 200px;
  padding-right: 200px;
}
::-webkit-scrollbar {
display: none;
}
.post_type{

  line-height: 1rem;
  font-size: 0.6rem;
  padding: 6px;

}
@media (max-width:700px){
  /* .btn-sm{
    font-size: 0.7rem;
    margin-left: 10px;
      border-radius: 0.2857rem;
      line-height: 0.55;
  } */
  .timeline .timeline-body {
      width: 240px;
      margin-left: 23%;
      margin-right: 17%;
      background: #fff;
      position: relative;
      padding: 20px 25px;
      border-radius: 6px;
  }


  .btn-sm {
    font-size: 0.45rem;
    margin-left: 0px;
    border-radius: 0.2857rem;
    line-height: 0.55;
}
  .timeline .timeline-time .time {
    line-height: 24px;
    font-size: 10px;

}

.timeline .timeline-time .date {
    line-height: 16px;
    font-size: 9px;
}

.post_title {
    color: black;
    font-size: 14px;
}

.post_link {
    font-size: 20px;
}

.view_profile {
    left: 20px;
}

    }

.content.timeline-align{
  padding-left:200px;
  padding-right:200px;
  padding-top: 0px;

}
@media (max-width:800px) {
.content.timeline-align{
  padding-left: 10px;
  padding-right: 50px;
}
}
    </style>
</head>

<body>



<body class="">

  <div class="wrapper ">

      <div class="main-panel pt-5">
        <!-- Navbar -->
<div style="" class="container cards">

  <h1 class="text-center text-primary pt-5 pb-3"> ENTRANCE TEST DETAILS</h1>
  <div class="row pb-5">


  <div class="col-sm-6 col-md-6 mt-3">
      <div class="card">
          <div class="card-body bg-info">
              <div class="row">
                  <div class="col-12">
                    <h3> TEST TYPE </h3>
                  </div>
              </div>
              <div class="row">
                  <div class="col-12">
                    <h4>Basic Coding</h4>
                 </div>
              </div>
          </div>
      </div>
   </div>


   <div class="col-sm-6 col-md-6 mt-3">
       <div class="card">
           <div class="card-body bg-info">
               <div class="row">
                   <div class="col-12">
                     <h3>PLATFORM</h3>
                   </div>
               </div>
               <div class="row">
                   <div class="col-12">
                     <h4>HackerRank</h4>
                  </div>
               </div>
           </div>
       </div>
    </div>

    <div class="col-sm-6 col-md-6 mt-3">
        <div class="card">
            <div class="card-body bg-info">
                <div class="row">
                    <div class="col-12">
                      <h3>DATE & TIME</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                      <h4>16 <sup>th</sup>  JUNE (5PM TO 6PM)</h4>

                   </div>
                </div>
            </div>
        </div>
     </div>



     <div class="col-sm-6 col-md-6 mt-3">
         <div class="card">
             <div class="card-body bg-info">
                 <div class="row">
                     <div class="col-12">
                       <h3>NUMBER OF QUESTIONS</h3>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-12">
                       <h4>8</h4>
                    </div>
                 </div>
             </div>
         </div>
      </div>





</div>

</div>
      <!-- End Navbar -->
      <legend>
          <h1 class="text-center text-primary pt-5">RECRUITMENT FLOW</h1></legend>

      <div style="" class="content timeline-align">



        <div class="row">
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header text-center">

              </div>
              <div class="card-body">






                <div class="profile-content">
                   <!-- begin tab-content -->
                   <div class="tab-content p-0">
                      <!-- begin #profile-post tab -->
                      <div class="tab-pane fade active show" id="profile-post">
                         <!-- begin timeline -->
                         <ul class="timeline">
                            <li class="col-sm-12">
                               <!-- begin timeline-time -->
                               <div class="timeline-time ">
                                  <span class="time text-info">STEP 1</span>
                               </div>
                               <!-- end timeline-time -->
                               <!-- begin timeline-icon -->
                               <div class="timeline-icon ">
                                  <a href="javascript:;">&nbsp;</a>
                               </div>
                               <!-- end timeline-icon -->
                               <!-- begin timeline-body -->
                               <div class="timeline-body">
                                      <div class="timeline-header">
                                      <span class="userimage" ><img src="../../images/logo.png" alt="" class="rounded "></span>
                                      <p style="color:black" class="font-italic">CODEATIC<small></small></p>
                                      <!-- <span class="pull-right text-muted">18 Views</span> -->
                                   </div>
                                  <div class="timeline-content">
                                  <h5 class="" >
                                        <span class="pull-left h3 post_title " style="color:black">Round 1</span>
                                   </h5>
                                       <span class="userimage img-fluid img-responsive  " ><img class="post_image"  src="../../images/step1_recruiting.png" alt="" style="" ></span>

                                  </div>
                               </div>
                               <!-- end timeline-body -->
                            </li>
                          </ul>
                         <!-- end timeline -->
                      </div>
                      <!-- end #profile-post tab -->
                   </div>
                   <!-- end tab-content -->
                </div>
                <div class="profile-content">
                   <!-- begin tab-content -->
                   <div class="tab-content p-0">
                      <!-- begin #profile-post tab -->
                      <div class="tab-pane fade active show" id="profile-post">
                         <!-- begin timeline -->
                         <ul class="timeline">
                            <li class="col-sm-12">
                               <!-- begin timeline-time -->
                               <div class="timeline-time ">
                                  <span class="time text-info">STEP 2</span>
                               </div>
                               <!-- end timeline-time -->
                               <!-- begin timeline-icon -->
                               <div class="timeline-icon ">
                                  <a href="javascript:;">&nbsp;</a>
                               </div>
                               <!-- end timeline-icon -->
                               <!-- begin timeline-body -->
                               <div class="timeline-body">
                                      <div class="timeline-header">
                                      <span class="userimage" ><img src="../../images/logo.png" alt="" class="rounded "></span>
                                      <p style="color:black" class="font-italic">CODEATIC<small></small></p>
                                      <!-- <span class="pull-right text-muted">18 Views</span> -->
                                   </div>
                                  <div class="timeline-content">
                                  <h5 class="" >
                                        <span class="pull-left h3 post_title " style="color:black">Round 2</span>
                                   </h5>
                                       <span class="userimage img-fluid img-responsive  " ><img class="post_image"  src="../../images/step2_recruiting.png" alt="" style="widht:1000px;" ></span>

                                  </div>
                               </div>
                               <!-- end timeline-body -->
                            </li>
                          </ul>
                         <!-- end timeline -->
                      </div>
                      <!-- end #profile-post tab -->
                   </div>
                   <!-- end tab-content -->
                </div>
                <div class="profile-content">
                   <!-- begin tab-content -->
                   <div class="tab-content p-0">
                      <!-- begin #profile-post tab -->
                      <div class="tab-pane fade active show" id="profile-post">
                         <!-- begin timeline -->
                         <ul class="timeline">
                            <li class="col-sm-12">
                               <!-- begin timeline-time -->
                               <div class="timeline-time ">
                                  <span class="time text-info">STEP 3</span>
                               </div>
                               <!-- end timeline-time -->
                               <!-- begin timeline-icon -->
                               <div class="timeline-icon ">
                                  <a href="javascript:;">&nbsp;</a>
                               </div>
                               <!-- end timeline-icon -->
                               <!-- begin timeline-body -->
                               <div class="timeline-body">
                                      <div class="timeline-header">
                                      <span class="userimage " ><img src="../../images/logo.png" alt="" class="rounded "></span>
                                      <p style="color:black" class="font-italic">CODEATIC<small></small></p>
                                      <!-- <span class="pull-right text-muted">18 Views</span> -->
                                   </div>
                                  <div class="timeline-content">
                                  <h5 class="" >
                                        <span class="pull-left h3 post_title " style="color:black">Round 3</span>
                                   </h5>
                                       <span class="userimage img-fluid img-responsive  " ><img class="post_image"  src="" alt="" style="widht:1000px;" ></span>

                                  </div>
                               </div>
                               <!-- end timeline-body -->
                            </li>
                          </ul>
                         <!-- end timeline -->
                      </div>
                      <!-- end #profile-post tab -->
                   </div>
                   <!-- end tab-content -->
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
</body>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- Place this tag in your head or just before your close body tag. -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <!-- <script src="../assets/js/plugins/chartjs.min.js"></script> -->
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script>
  <script src="../assets/demo/demo.js"></script>
  <script>

  $('.post_image').on('click', function(){
    console.log("yes");
    var source = $(this).data('image');
    $('.embed-responsive-item').attr("src", source);

  });

  $('[data-toggle="modal"]').on('click', function(e) {
      e.preventDefault();

      var type = $(this).data('type');
      var description = $(this).data('description');
      var end_date = $(this).data('end_date');
      var start_date = $(this).data('start_date');
      var title = $(this).data('title');
      var link = $(this).data('link');
      var image =$(this).data('image');
  console.log(link);

  if(type==1){
    $(".model_type").text( "Project Deatails" );

  }else{
    $(".model_type").text( "Certification Deatails" );
  }

  $(".modal_title").text( title );
  $(".model_link").attr("href",link);
  $(".modal_start_date").text( "Started: "+start_date );
  $(".modal_end_date").text( "Completed: "+end_date );
  $(".modal_image").attr("src","../../images/"+image);
  $(".modal_description").text( description );


  });











    // when the user clicks on like
    $(document).ready(function(){
  		// when the user clicks on like

  		$('.like').on('click', function(){
  			var postid = $(this).data('id');
        var liked = $(this).data('liked');
        var likes = $(this).data('likes');
  			    $post = $(this);
            console.log("like");

  			$.ajax({
  				url: 'timeline.php',
  				type: 'post',
  				data: {
  					'liked': 1,
  					'post_id': postid
  				},
  				success: function(response){

           $('[data-id='+postid+']').filter('.like').css('display', 'none');
           $('[data-id='+postid+']').filter('.unlike').css('display', 'inline');
  if(liked=="yes"){
    $('[data-likes='+postid+']').filter('.likes_count').text(likes+1);

  }
  else {
    $('[data-likes='+postid+']').filter('.likes_count').text(likes);

  }




  				}
  			});
  		});

  		// when the user clicks on unlike
  		$('.unlike').on('click', function(){
  			var postid = $(this).data('id');
        var liked = $(this).data('liked');
        var likes = $(this).data('likes');
  		    $post = $(this);
          console.log("unlike");

  			$.ajax({
  				url: 'timeline.php',
  				type: 'post',
  				data: {
  					'unliked': 1,
  					'post_id': postid
  				},
  				success: function(response){
            $('[data-id='+postid+']').filter('.like').css('display', 'inline');
            $('[data-id='+postid+']').filter('.unlike').css('display', 'none');
              if(liked=="yes"){

                  $('[data-likes='+postid+']').filter('.likes_count').text(likes-1);
                }
                else{
                $('[data-likes='+postid+']').filter('.likes_count').text(likes);
              }


  				}
  			});
  		});
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
  <!-- <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initGoogleMaps();
    });
  </script> -->
  <!-- <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "black-dashboard-free"
      });
  </script> -->
</body>

</html>
<?php

}else{
    echo "Register first";
}
?>